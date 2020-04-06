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
define('DB_NAME', 'nhadat');

/** MySQL database username */
define('DB_USER', 'bds');

/** MySQL database password */
define('DB_PASSWORD', 'bds');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'ByPqI&iOR|ACV{QZ{w}=c=,CU^<-Yx}Cq{]G^%Du@%EJ*m1hjeOOt?|>-1t#wH66');
define('SECURE_AUTH_KEY',  '$b,S~}lY]M8xaPQTF)iy@l7}6*0wD;Bo@%{h?%O[HFT3 G],_lFKurdd9@qN-I- ');
define('LOGGED_IN_KEY',    'OzgNZLn{3j`I2||Bv[+|caTm#R+m/#cZIn`HXJAS7y2anJkKys,s3^@M$aXZ6Btn');
define('NONCE_KEY',        'C!;%f<%wjx+p=@61e+),q?vS|hKnPW-7d_|f2The2qMq-Y&#<ry_Y)[>w=mfS&rb');
define('AUTH_SALT',        '|!$O6@33wsq733D:ZNfqi|Y1%qocNi*oZCY%2-pr0wW72WClmQJ~h!1E95~uoU5?');
define('SECURE_AUTH_SALT', '6o!`C4_iyWA;H$G+K5KOs,ez&2~> ]L!L^]*|f(.s.UI4i*r|/Otf]i)aXz-[M/f');
define('LOGGED_IN_SALT',   '+Ey-rSg-(=2T(t@}O7a:(m1nU|oa]9Wt}3.O83UO:cTYYSZEY|*}j)Kx|,pZ+nu#');
define('NONCE_SALT',       'X[I,vh9gC--k:6!r>8|/1CS._,b=V$X,Gz#A)%o!!6-.Drag,^Jy,r8m_B<`~f!?');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
