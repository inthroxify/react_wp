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

define( 'DB_NAME', 'bitnami_wordpress' );


/** MySQL database username */

define( 'DB_USER', 'bn_wordpress' );


/** MySQL database password */

define( 'DB_PASSWORD', '' );


/** MySQL hostname */

define( 'DB_HOST', 'mariadb:3306' );


/** Database charset to use in creating database tables. */

define( 'DB_CHARSET', 'utf8' );


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

define( 'AUTH_KEY',         '7A7u4k%^tj58}iM~GTvc-?8j8G^nJURqQ}XC,t&7OWq;zJKy=|@7$?}v#B= l Y3' );

define( 'SECURE_AUTH_KEY',  'J.lk9z+%3_qosFQ>^v-3}<u5AwbklU;5Bh@ozdG#=Xy2g>h/:!G!F;f1_z~I47NX' );

define( 'LOGGED_IN_KEY',    'OeL[O625]ZqFG_4s%2A5(f|Uyn(:Dla!mV9<+%HKtm|uPbS@!r5w_{NA/%Kr(ouc' );

define( 'NONCE_KEY',        'IXivRH|&~V:$cm6#;j_V=~MX^$$ictC0MU? gKz`w# {2,]MbOVNEp^%%UT^2^S%' );

define( 'AUTH_SALT',        '7p~5c]<0i^{<6}ReqpiW:jy<cdj},vuzZa/IA[tALif|C} p,v}ZD6j&czm@/YYM' );

define( 'SECURE_AUTH_SALT', '9|4:A_>D)jViX/(?]6WMA4T;$nn::&f;Qf/]2youlSIQPtSEb2Aa=XQGHlCO yqW' );

define( 'LOGGED_IN_SALT',   '<>}RuKS(!BHUt+!X,Ir7{G([@S|wSZpCZn%@].x9[*P!W_wqsoxoYDeW*7~bz(^_' );

define( 'NONCE_SALT',       'yEP1nyqoi`{X:Ai=bj_oN#`51.c8 >7LW!+wQFCmp6}Yf(spjg ASxIAc39il3:W' );


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




define( 'FS_METHOD', 'direct' );
/**
 * The WP_SITEURL and WP_HOME options are configured to access from any hostname or IP address.
 * If you want to access only from an specific domain, you can modify them. For example:
 *  define('WP_HOME','http://example.com');
 *  define('WP_SITEURL','http://example.com');
 *
 */
if ( defined( 'WP_CLI' ) ) {
	$_SERVER['HTTP_HOST'] = '127.0.0.1';
}

define( 'WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_AUTO_UPDATE_CORE', false );
/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', __DIR__ . '/' );

}


/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';

/**
 * Disable pingback.ping xmlrpc method to prevent WordPress from participating in DDoS attacks
 * More info at: https://docs.bitnami.com/general/apps/wordpress/troubleshooting/xmlrpc-and-pingback/
 */
if ( !defined( 'WP_CLI' ) ) {
	// remove x-pingback HTTP header
	add_filter("wp_headers", function($headers) {
		unset($headers["X-Pingback"]);
		return $headers;
	});
	// disable pingbacks
	add_filter( "xmlrpc_methods", function( $methods ) {
		unset( $methods["pingback.ping"] );
		return $methods;
	});
}
