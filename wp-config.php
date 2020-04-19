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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

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
define( 'AUTH_KEY',         'l6G-S|c`&-cp[|NCgibw+8NU]QVj[ZCdUG!PP0mWza6i,v.D?yhs:>sp/sI:z^?E' );
define( 'SECURE_AUTH_KEY',  'P1L?0GaN.+l.Z_m)Y wPx?a^Dx[/[=+F*j.bmF DLh&=Dl[5)URsgVe/Uo>1<o(N' );
define( 'LOGGED_IN_KEY',    'Feb/CBC+iLZD/RW#+Rq;^l^oF@V9hF+LOoEQFMOl@$]wwFIg%bLL^{kX`A!r*U6C' );
define( 'NONCE_KEY',        'kyB:/$^761W)lGwl?,bi04lhA^cZjsAxf}(cfF)]>?e5@~<=N?$$XgUcs^qAvK{n' );
define( 'AUTH_SALT',        'e7;VotoIqp^NM5(zv~noDCUblI</eW*A/d.`2TU1*-B,.Be jUo?#p&/i+/|JUbU' );
define( 'SECURE_AUTH_SALT', 't=6YRdm:]ye;]/%J(96I3H&HIv{7fv+DG^?}=YJbq6D2.Zx2>4d=}8lyc`KMCps2' );
define( 'LOGGED_IN_SALT',   '!uBMi?:vi;Y~D8,D{9b,*E&8 YZsF<_5`hc3D0A.4KkNPkH+~xpZ4Ax!Yw}*3wH8' );
define( 'NONCE_SALT',       'h6u%)v4/|zHQE;&8/H!+_VW{>*0i0_S8=+&^x+Q/-CN *Hrley%6 8[aH9`amz/K' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
