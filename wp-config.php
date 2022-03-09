<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'danilauser' );

/** Database password */
define( 'DB_PASSWORD', 'O$stap2003danila' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'A!XH;_u<uv53_t$V Q7tI<clE%o63^.>CSxb`H)=*/oxkq3:WQ&e-F.&YM3RjsDx' );
define( 'SECURE_AUTH_KEY',  '4= 8nyQCW1.s*RQa[zE-c2~<pvA=}r-1^1T<F0HPtPi>c/Gh={TJ!UVHTK^FXNym' );
define( 'LOGGED_IN_KEY',    'H]t|CWc}:YWU_#~bHo^DX,g{|&<GJ#>ooY?@L9SMH8&ve)@0b/3B^>#A(9ExGlN?' );
define( 'NONCE_KEY',        '& L%{iC|nb+Ra}W<lCEJb9L)yVuhnChg1|UDLXXi_r9y9t7#?X>CN-qpv;Bcg(tI' );
define( 'AUTH_SALT',        '< 8`j2B2RM9U?h+s>/]VrD)%*-g.P<ZPpjYq--#yG25$,^*T4(RBabkel_T=Rpwf' );
define( 'SECURE_AUTH_SALT', 'U?Dgjn{A=sjq/x8Ei^ixfQWrWSwK^<2OEa8#LSN5 mM,[QCSp7Ub#$oVU5{3mq-b' );
define( 'LOGGED_IN_SALT',   'Nwll~~N(I`#^23^aa+/e-`n, =k+KX%Q615SX+4B:TJJ{V^._|%:fys^%Q>5M/t@' );
define( 'NONCE_SALT',       'QfXh`?/1~Rord*_ dwx:(Mt>>er!ErC9lLuH>9VT9rXf;|@*Y~=(^_5GmOBHtc|q' );

/**#@-*/

/**
 * WordPress database table prefix.
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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
