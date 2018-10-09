<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home2/safe24/public_html/pgdev/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'safe24_pgdev');

/** MySQL database username */
define('DB_USER', 'safe24_pgdevu');

/** MySQL database password */
define('DB_PASSWORD', 'PK08DPE37f');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define ('WPCF7_LOAD_JS', false );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'ERs:0ea<a]|HH@_5F-GokR+F*$DLi<8w?H,a+Cn(r-+:e=iS|m:IvP-QVVYrzQA`');
define('SECURE_AUTH_KEY',  '798yJ<=.ee`XEVr?fS7#~PNh&^jb~9|8;sA@^jOlO#D8z2WGiE0S<z3Y+2Dp(QMz');
define('LOGGED_IN_KEY',    '`|td,xZRR)zHJ,FJh/Z!?je3j,CM9UsN5G+ W%ZnX/<)/qI_Q:vU`q|e[JgN4wU}');
define('NONCE_KEY',        'wQ4.F(O3v[m>lU;o,W05gdA-S0!7kZWe}L:?t@Nmpku2jWU&kaE%OQ]!^YpR5y+X');
define('AUTH_SALT',        'ZnkrOPKyCxd=U(eO2c7n!8iNy7iSn-=Q&qRyul8p?$ROr /ZIIX2(Vpv:YI:]jHk');
define('SECURE_AUTH_SALT', 'd33JE6<7=|WCvf]EY x2~DP;[Xfu6R=hN`NFM +`pyb!`u&v_VycE4Ti Y{N|27_');
define('LOGGED_IN_SALT',   '%%Gx6^k$.#FfgU8~!H.SN3W:|ryG:S5-|RRg%C0Tbe(WZ/SRDI):/{{W?{sGaxDE');
define('NONCE_SALT',       'o-r4$_O`U%]HGH[99K#(kb|U1)U3q }t:O+`Q|soWBI6M-HtmdOZ(kBpp=cJiOcj');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
