<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'testwordpress_db' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'ZZ~&a.xE_(M^GPNRiV~$b]CYY5,wGrhdcCpO.< oPc-G-T@36R|eUNg2}%<>?lM.' );
define( 'SECURE_AUTH_KEY',  'VtIlCHckB[.qt{9i`,?&=kLIdSw!cZ2fj5|Z+9Y`}mm^7#=m1E:NoG>rrI^p~5Tp' );
define( 'LOGGED_IN_KEY',    'b)GlRfOw;X%iUxcnmDMd<g,vSjv/AdZ4q-XGUV^`6d_({uN[3>[^I>.rxMK:~cy+' );
define( 'NONCE_KEY',        'yne)uuqftoXlNXGzoF ]tmf@<rYp`nArS~Or.YhJ[crp>I?tap)s+X*&HmtrfL)i' );
define( 'AUTH_SALT',        '&jBX3f/,XzKAc!}%jD~`fB-pz-b`v;Zm>3ae|IZkViZOv*%5a(o!F;kz,6CV,%^u' );
define( 'SECURE_AUTH_SALT', 'kbmd 5rv/`@iNMv|4I4>0IlB]8r=NQj+:%DE &3]h?}wUexp4!fz?3Hj*tC`bG~H' );
define( 'LOGGED_IN_SALT',   '3,ExM58MYZ3].@i=%BVJJ 11cHDhmqqWA{8rk~5_^bAmvAQ^OQ/3N!,#.K%AA$!j' );
define( 'NONCE_SALT',       '_o%gTMEkw/M]t8leO(#%]YxZb0&V|YDAAg/1j[#iI0eNkQ#6Zfc8HM*Fs0V<P<F(' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
