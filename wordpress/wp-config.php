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
define( 'DB_NAME', 'wordpressbrief' );

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
define( 'AUTH_KEY',         'ADun#X$`WOLQ10y.*B?4)iNDL*?Zr;u2G<cQ|4iNpF[H{7d,L#_-<8&QLF?Ix] h' );
define( 'SECURE_AUTH_KEY',  'PO!QO^f*GBV!J}>,n.){xW##^KB_PZ_vil0?R+GtA2Er]K_/?y|ShF!pI<:13KpR' );
define( 'LOGGED_IN_KEY',    'hpmi<Y@MZnlg-|MBah1V}}zT[@}y RI=9}XOt*dyQ$!4an#MuCHSW3~pv#dD<)N]' );
define( 'NONCE_KEY',        'kxO;8R2=:=6]3-PZa][OL6~5S^HqW{{.EVj{g&NjB]$C[Tq%FEcrur&|.(esG(#Q' );
define( 'AUTH_SALT',        '1d.IjRSl)?oC@:9g`cl3pJP42AcoDm[5|/}>/v3`dG:9=GajP@NC#j`d{23FWdD*' );
define( 'SECURE_AUTH_SALT', '6{6uXa`rJ@b]n$N_b:bQ/m+*&T%87~/e9u#pczADu(VX03?;}XEv{6xA*~4}#D?G' );
define( 'LOGGED_IN_SALT',   '7+R1HL4B<l>}~#)Fx?+)oI(?o_N@U6TgFZq#rEo=yOL%5dUfK+%9Q/kQil}$x.Tp' );
define( 'NONCE_SALT',       'X?_ ^In=dorZh>cqJf}9!30H--Q%x,kEq8x1CS+~?.j]h)A:VyXmT>&(R0 n/|oN' );

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
