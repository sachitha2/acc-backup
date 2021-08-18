<?php
// BEGIN iThemes Security - Do not modify or remove this line
// iThemes Security Config Details: 2
define( 'DISALLOW_FILE_EDIT', true ); // Disable File Editor - Security > Settings > WordPress Tweaks > File Editor
// END iThemes Security - Do not modify or remove this line
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
define('DB_NAME', "wp");
/** MySQL database username */
define('DB_USER', "wp");
/** MySQL database password */
define('DB_PASSWORD', "chata");
/** MySQL hostname */
define('DB_HOST', "accbackup_mysql_1");
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
define('AUTH_KEY',         '}%JM`2Y%c)Ql*hX`,vVE`NhFscyE<FHZH^R|b28v-(!P2BuqVdvZ%MUXLmNH4<fR');
define('SECURE_AUTH_KEY',  'DyuBM,NF%<_5 !t(5~KvxX4Q4F Dw,u:69i>d$p<RA!E v&^V#@M6oP{3BDf8::>');
define('LOGGED_IN_KEY',    'j+AWNK(,2R859$x^gbx1VFWa[tPrw]VM=P1b3E:G<npz3*Nvv<x/Z%M$9)Qo#P>~');
define('NONCE_KEY',        'd<?.h(*@e9&q=:MCIQKL)!wLTSY3#_fL[1_5w?,/%OVO~$g`@xJ,<+NA& 6QB0^=');
define('AUTH_SALT',        'fp1;iuM$hJ80sT):Q+@(AyrHg!~Sx*x_]5_.]^2W7~C9Y^&[kQo>,<Jt6hpQ@:=%');
define('SECURE_AUTH_SALT', 'rVXN= +epIh)C`QNh@:!c^%DZREBp:##W}8jn^s|!V)`Uy: V4x}Y$@qWX#ppN3?');
define('LOGGED_IN_SALT',   'EZGy}3~q[icOk^{/RfwRlKI/mK~YE*6J][{:>?b/ggZ;>)6[]U ]7^EV1zO5W<fB');
define('NONCE_SALT',       'tYO/})SxJlzj|<Ie#N@yR!G>w69.,5B$f%4S#vO#&*P7yD%r]u_*V*a.x/1R-WZ)');
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
