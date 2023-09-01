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
define( 'DB_NAME', 'registration' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'EL3L;8w=t_01T5esC25>xMSl^#TbI@Y=C>[E8|;odh{hs_P}$;!K{F!u-//A[(T@' );
define( 'SECURE_AUTH_KEY',  '5%1qI<wjmxC=9eJoF[j4PNn~ZSPFd8$ORqTV62]}RF`9n4`v<(Xs~{qb- a;*uTS' );
define( 'LOGGED_IN_KEY',    'mygrlQdthe5%JYE(4vK}uS4@bH$JO|sx8O/cDtDAj0$g.M[hq?K&)GHE6Q|,vigX' );
define( 'NONCE_KEY',        ':Ey6LZd9Cru5;/ZHK8RTyS@8aW?]L_jIw9ng@m.X,T4ll|1-}$1og_Q._]Ho8B/r' );
define( 'AUTH_SALT',        '5*zq3n-fop#VCqq4S=wYfZ%IqvZx>VnpYJX}:4%6z2w_`UT8*q{9-tGB5RUk[}3~' );
define( 'SECURE_AUTH_SALT', '_3h>/d$T{B#<MO9,i(:-,yFZ)uNiv/qUc=?Nz=P~?.Jy$F#<ZbT8#MDlUVb}M1!F' );
define( 'LOGGED_IN_SALT',   '^(kcnd~BO(YtHTLh~[RGy2L88e/29GMKNRmR}DMJadWZn]:WZtc_`N;cG|b0-B}F' );
define( 'NONCE_SALT',       'Bkz4Ep ,=0oHGMNEu9:X9$AH_G$AV9P^]KqO$[ZNK@PM!w!3`sqokk`>7j*&h,sl' );

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
