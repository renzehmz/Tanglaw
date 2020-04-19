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
define( 'AUTH_KEY',         '<9W%o-^A[x)0z8qJG,38%9]nRYkcV$m8(zV:i,R]F/C6,Ed.nI;CS<]m*5P_|{/.' );
define( 'SECURE_AUTH_KEY',  '4+q&^NWlE0FkMPLtVBx.fh!ock!*2!7X-iTO-_PC=@c!xCSz&2zu>iC4DOWbyaP#' );
define( 'LOGGED_IN_KEY',    '5*Ab`]ca1<$(}qJ;TC4x//>&Jiurpg;Y]yIv(LbsCAuZ5(.PF3S-G[^-QV#bCvj0' );
define( 'NONCE_KEY',        'a9.JL)Y|X5l2A]gt:d<yBKl|5fY@6tJ3=EG}Vw*|)^i{r#d}ZdE[]:9&@ s4+4!x' );
define( 'AUTH_SALT',        ',%*L!5fJSZG|(f(*2&v|6SGKiL)tg!6:Dua%Wk/BP}>1NOFl[DjHMRf`6o[.7:@G' );
define( 'SECURE_AUTH_SALT', 'U!k<jk?i}m[!Ol/]Fb/?|_Pv>GYDfOC:S-[7Tf4vK*cb# f4% >ox56&j7Yo$=tl' );
define( 'LOGGED_IN_SALT',   'Y-5A=dce9{!.2jI@6$gnDZeB)0O]ZeMV7B(~t#/~M8ozaykH(Ps`1ky}_34@aJvu' );
define( 'NONCE_SALT',       'e1:Jd4/Z7<0nm:/&?/aNxi2S|NXmDKAh9L|q*%k&p*eLETbZhniR{sq;[Qxv~#S4' );

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
