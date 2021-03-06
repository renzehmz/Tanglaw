<?php
/**
 * Envato Elements: Options
 *
 * Making option management a bit easier for us.
 *
 * @package Envato/Envato_Elements
 * @since 0.0.7
 */

namespace Envato_Elements;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**
 * Feedback registration and management.
 *
 * @since 0.0.2
 */
class Options extends Base {

	const OPTION_KEY = 'envato_elements_options';

	/**
	 * Feedback constructor.
	 */
	public function __construct() {
		parent::__construct();
	}

	public function get( $key = false, $default = false, $top_level = false ) {

		if ( $key === 'project_name' && ! $default ) {
			$default = get_home_url();
		}

		$options = get_option( self::OPTION_KEY, [] );
		if ( ! $options || ! is_array( $options ) ) {
			$options = [];
		}
		$user_id = get_current_user_id();
		if ( ! $top_level && $user_id ) {
			$user_options = isset( $options[ $user_id ] ) ? $options[ $user_id ] : [];
			if ( $key !== false ) {
				if ( ! isset( $user_options[ $key ] ) && isset( $options[ $key ] ) ) {
					// transitioning a global option to a user option.
					$this->set( $key, $options[ $key ] );
					$this->set( $key, false, true );

					return $options[ $key ];
				}

				return isset( $user_options[ $key ] ) ? $user_options[ $key ] : $default;
			}

			return $user_options;
		} else {
			if ( $key !== false ) {
				return isset( $options[ $key ] ) ? $options[ $key ] : $default;
			}

			return $options;
		}
	}

	public function set( $key, $value, $top_level = false ) {
		$options = $this->get( false, false, true );
		$user_id = get_current_user_id();
		if ( ! $top_level && $user_id ) {
			if ( ! isset( $options[ $user_id ] ) ) {
				$options[ $user_id ] = [];
			}
			$options[ $user_id ][ $key ] = $value;
		} else {
			$options[ $key ] = $value;
		}
		update_option( self::OPTION_KEY, $options );
	}

	public function rest_permission_check( $request ) {
		return true;
	}

	public function init_rest_endpoints( $namespace ) {

		register_rest_route(
			$namespace, '/options/set', [
				[
					'methods'             => \WP_REST_Server::CREATABLE,
					'callback'            => [ $this, 'rest_options_set' ],
					'permission_callback' => [ $this, 'rest_permission_check' ],
					'args'                => [],
				],
			]
		);

	}

	public function rest_options_set( $request ) {
		$result = [
			'status'  => 0,
			'message' => 'Unknown error',
		];
		// Only allow certain keys to be set via the REST API
		$key   = $request->get_param( 'key' );
		$value = trim( $request->get_param( 'value' ) );
		switch ( $key ) {
			case 'show_premium_notice':
				switch ( $value ) {
					case 'dismissed':
					case 'licensed':
						$this->set( 'show_premium_notice', $value );
						$result['status']  = 1;
						$result['message'] = 'Thank you.';
						break;
				}
				break;
			case 'elements_project':
				if ( $value && strlen( $value ) > 0 ) {
					$this->set( 'project_name', $value );
					$result['status']  = 1;
					$result['message'] = 'Thank you.';
				}
				break;
			case 'elements_token':
				if ( $value ) {
					// Throw this token at our Elements API class, if it's valid we save it.
					$verify_result = License::get_instance()->verify_elements_token( $value );
					if ( is_array( $verify_result ) && ! empty( $verify_result['valid'] ) && ! empty( $verify_result['status'] ) ) {
						// valid token received, but we may still not be a paid account.
						if ( $verify_result['status'] === License::SUBSCRIPTION_PAID ) {
							$result['status']  = 1;
							$result['message'] = 'Thank you.';
						} else {
							$result['error_code']     = 'no_paid_account';
							$result['license_result'] = $verify_result;
						}
					} else {
						// Some sort of error with the token. Don't save it.
						if ( ! empty( $verify_result['error_status'] ) && ! empty( $verify_result['error_data']['code'] ) ) {
							$result['error_status'] = $verify_result['error_status'];
							$result['error_code']   = $verify_result['error_data']['code'];
						}
					}
				} else {
					$result['status']     = 0;
					$result['error_code'] = '404';
					$result['message']    = 'No token code provided.';
				}
				break;
		}
		if ( $result['status'] ) {
			// Return the updated config so front end can track state.
			$result['config'] = $this->get_public_settings();
		}

		return new \WP_REST_Response( $result, 200 );

	}

	public function get_imported_templates( $limit ) {
		$imported_templates = [];
		foreach ( CPT_Kits::get_instance()->get_imported_templates() as $imported_template ) {
			$imported_template_data = [
				'templateId' => $imported_template['templateId'],
			];
			if ( ! empty( $imported_template['inserted'] ) ) {
				// We've got some links we can show to the user about where their item has been inserted/imported.
				$imported_template_data['links'] = [];
				foreach ( $imported_template['inserted'] as $insert ) {
					$imported_template_data['links'][] = [
						'pageName' => $insert['pageName'],
						'pageUrl'  => $insert['pageUrl'],
					];
				}
			}
			$imported_templates[ $imported_template['ID'] ] = $imported_template_data;
			if ( $limit && count( $imported_templates ) > $limit ) {
				break;
			}
		}

		// Check if we've got an Elementor template library
		if ( class_exists( '\Elementor\Plugin' ) ) {
			$cc_args               = [
				'posts_per_page' => - 1,
				'post_type'      => 'elementor_library',
			];
			$has_elementor_library = false;
			$cc_query              = new \WP_Query( $cc_args );
			if ( $cc_query->have_posts() ) {
				$posts = $cc_query->get_posts();
				$post  = current( $posts );
				if ( $post && $post->ID ) {
					$source_kit_id = get_post_meta( $post->ID, '_source_kit_id', true );
					if ( $source_kit_id && isset( $imported_templates[ $source_kit_id ] ) ) {
						// We've found a template that was imported into the Elementor library from our plugin.
						// Update our client side info with this extra data
						$imported_templates[ $source_kit_id ]['itemImportedUrl'] = Linker::get_instance()->get_edit_link( $post->ID );
					}
				}
			}
		}

		// This removes any library items that have been removed from our Elementor media library
		foreach ( $imported_templates as $imported_template_id => $imported_template ) {
			if ( ! isset( $imported_template['itemImportedUrl'] ) ) {
				unset( $imported_templates[ $imported_template_id ] );
			}
		}

		return array_values( $imported_templates );
	}

	public function get_installed_plugin_versions() {
		return [
			'envato-elements' => Required_Plugin::get_instance()->get_plugin_version( 'envato-elements' ),
			'elementor-pro'   => Required_Plugin::get_instance()->get_plugin_version( 'elementor-pro' ),
			'elementor'       => Required_Plugin::get_instance()->get_plugin_version( 'elementor' ),
			'beaver-builder'  => Required_Plugin::get_instance()->get_plugin_version( 'beaver-builder' ),
		];
	}

	public function get_public_settings() {

		$categories = Category::get_instance()->categories;
		$navigation = [];
		foreach ( $categories as $category_id => $category ) {
			if ( $category['main_nav'] ) {
				$subtypes = [];
				if ( ! empty( $category['subtypes'] ) ) {
					foreach ( $category['subtypes'] as $subtype => $subtype_name ) {
						$subtypes[] = [
							'slug' => $subtype,
							'name' => $subtype_name,
						];
					}
				}
				$navigation[] = [
					'slug'      => $category['slug'],
					'nav_title' => $category['nav_title'],
					'sub_nav'   => $subtypes,
					'new_flag'  => ! empty( $category['new_flag'] ),
				];
			}
		}
		$collections_url = Collection::get_instance()->get_url();
		$bits            = wp_parse_url( $collections_url );

		// Put the notifications into our server side rendered options so we can show them straight away.
		$has_viewed_notifications = $this->get( 'viewed_notifications' );
		if ( ! is_array( $has_viewed_notifications ) ) {
			$has_viewed_notifications = [];
		}
		$current_notifications = Notifications::get_instance()->get_notifications();
		$unseen_notifications  = [];
		if ( $current_notifications ) {
			// figure out if anything has not been seen before.
			foreach ( $current_notifications as $notification ) {
				if ( ! empty( $notification['id'] ) && ! isset( $has_viewed_notifications[ $notification['id'] ] ) ) {
					$unseen_notifications[] = $notification['id'];
				}
			}
		}

		return [
			'api_nonce'             => wp_create_nonce( 'wp_rest' ),
			'api_url'               => admin_url( 'admin-ajax.php?action=envato_elements&endpoint=' ),
			'license_activated'     => License::get_instance()->is_activated(),
			'elements_status'       => License::get_instance()->subscription_status(),
			'elements_project'      => $this->get( 'project_name', get_bloginfo( 'name' ) ),
			'maintenance_mode'      => false, // We can prevent API calls if in maintenance mode.
			'admin_base'            => trailingslashit( dirname( $bits['path'] ) ),
			'admin_slug'            => $bits['query'],
			'collections_base'      => $bits['path'] . '?' . $bits['query'],
			'categories'            => $categories,
			'navigation'            => $navigation,
			'license_deactivate'    => wp_nonce_url( admin_url( 'admin.php?action=envato_elements_deactivate' ), 'deactivate' ),
			'elements_token_url'    => Elements_API::get_instance()->get_token_url(),
			'unseen_notifications'  => $unseen_notifications,
			'current_notifications' => $current_notifications,
			'show_premium_notice'   => $this->get( 'show_premium_notice', 'yes' ),
			'imported_templates'    => $this->get_imported_templates( 30 ),
			'installed_plugins'     => $this->get_installed_plugin_versions(),
		];
	}

}
