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
define( 'AUTH_KEY',         'A*mqsEW-WICUtUQs]xsvSQY[f5PM+T}32j. hIn]sH)GXMrQ4q{e@;HOB.Ck,RzR' );
define( 'SECURE_AUTH_KEY',  'K/(40q :UlLwWoZIg1o.,A(,+6{S-}k+tHm]./w=SnF?&U%iXCBt4*>/bBb<2pG*' );
define( 'LOGGED_IN_KEY',    'ZxCz74_r]:/qG9|{Sl~pRyj(@9 |`na,P8=y+n(L4ka>i0F[pkZ;@I8E4&~tZoN3' );
define( 'NONCE_KEY',        'iH)S7r.wyWPt*f`?k6DX1yr0d:{7%,d{)6u9y_!FujRB%N-sw{<]r2V W$R5@T3#' );
define( 'AUTH_SALT',        '}#f<6m<IMb{U7Q?bDz`6+P$2*m:NL8a^-iUWL*A1V1nZsoQu5&f%+<?&`K?xaD#9' );
define( 'SECURE_AUTH_SALT', '{tym/g]GoyJAteOx+!1mCwvW)7xI|)05@yTmp^y1GBV2PE]80Ta)){2nkW3tWHIA' );
define( 'LOGGED_IN_SALT',   'ZPNS.h9sH#iz8KAd_JZfy~5D%4^>o:W;!NQ^Q6,,U=#u`*N@C+`%!u_=[.G~!wd5' );
define( 'NONCE_SALT',       '^c[}P.>P$qw%$JsfDAuT_xfuwGa{cCctuG]5{)DVXF31XA1C8A8(ii?oEkfP/mid' );

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
