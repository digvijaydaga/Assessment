<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', '' );

/** Database username */
define( 'DB_USER', '' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
define('SHORTCODE_API', 'https://dummyjson.com/products?limit=8');
define('QUOTES_API', 'https://dummyjson.com/quotes?limit=9');

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
define( 'AUTH_KEY',         '~d)h)Y1J/G,F%67?u_*B1w<~4h:tlLs!g_F$J2RQjwXJ(TYf{&0?ccvIOI@6n+-t' );
define( 'SECURE_AUTH_KEY',  'jA$^HWpiFSr.|pLt3C!X0[gE.G_mMl}#O$#!mC{9zL8]|M-YE%+5!IdxgQzTj/s2' );
define( 'LOGGED_IN_KEY',    '3s5l1O*gW.*/#r_*I>Y= ZK1IGHySg]zovX+nF:UHzq&2uyUGCO-!2*eRrx7zy/@' );
define( 'NONCE_KEY',        'bj$cRNZ$*x5N /YqcfVMh`F.P}|QH<Qz*a;z(ik:G6R,5-YWU}bs*D~# .]{pHXK' );
define( 'AUTH_SALT',        'Xq>(_/pl6@cjP6`VmU]=>[1iSfNlH>D5df7tzVz[v<f(fjRB5_a?]0n-KE_%/qw;' );
define( 'SECURE_AUTH_SALT', '#akRM_uei`b<Cg,JN]1rE|mzSzd!(M}g2T~*,^Tb~x.q$vRG?0ICUW,j<,gmop>k' );
define( 'LOGGED_IN_SALT',   '.?fell<q8aI3|U#xz+<?3U6n~$w2q=O:aYt0gahfw9O8jU^+Hc1V_HcqK7%fW!LT' );
define( 'NONCE_SALT',       '|6&@b!,L$afj[fUjLvx729D0Ow#&7M@w+(TSZv~|Kg3-6cyo)C1$2R+x@,^-oyn/' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp3x0_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
