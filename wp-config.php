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
define( 'DB_NAME', 'chimerav2' );

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
define( 'AUTH_KEY',         '0xV.Y!66(wUxb6*YWY%F.K}7e`F];T[)}P9N#9MAU$x!z`?9yA,iL8&z9fhy0Ym-' );
define( 'SECURE_AUTH_KEY',  ']2mt1J_$DIF/@0hmF (f$$hg;)bK$.=p?=(#Bw?[[6tbDNX}X2D_<D2`Qe$Z)KUC' );
define( 'LOGGED_IN_KEY',    'WHw@zc[S/_80/`:FAiaE_%8oyI!cy67URpPip=@bNX9$P$a4M;b:08kGf5hv|/[V' );
define( 'NONCE_KEY',        '9eQ-EqF}T&MhI$^F;n93lb2!X*cN:3bm [:H}E-.HUA<|krzI@4GNHe@WbLp2k,A' );
define( 'AUTH_SALT',        '7[}XsbaKe#[~`XR%U65Hd|5KUsj*Ml,cC(+0X!(ljCQT>big%|WqS9Jy83fS.Hd(' );
define( 'SECURE_AUTH_SALT', ':e!tH>0:dWdG!}lGhH<e]r::2V.cyf`R;0:R0<i96>^Y`; co-G7.qsp^~Lv,{3}' );
define( 'LOGGED_IN_SALT',   'Ay<YE`GjwkX^<Hz&A]@.t==g=/[a-tZ{%RNY%/n:TdvZC{z}nLNa|&2[qR1KGhi?' );
define( 'NONCE_SALT',       'q$~{gPH7/d6b6$z(e.uA1O^y*KnLDu u)tA:bcc<Q)o~INwTQy0@gr`JF =n&HQ#' );

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
