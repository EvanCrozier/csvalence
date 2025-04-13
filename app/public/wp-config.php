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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',          'BejF{xB9GC5reQex,U`9cVu8zW>ZhS7]oUr{G#x 8w[.!` zziLG_FMlNbQXTT-`' );
define( 'SECURE_AUTH_KEY',   'EbFRS+%UsdH>@K;P~eUGCaQr#Xo}3MrJ0q5l%ExSI;W32_AZfLlNx*v`r=$t!&Di' );
define( 'LOGGED_IN_KEY',     'jZh+5VZ=K5PNu6QZ*-G! J3O],y| EoCPsyS55^:o$@rU}]-]>:ew.?(Mn()por2' );
define( 'NONCE_KEY',         'i<U J;$[5.YHG=E%qI9i%5v[}yH&Xqg5622%fz d*>pVD@S*W/;D.mgmM?%O/$lU' );
define( 'AUTH_SALT',         'noRldcg#1xHPADUxD]dQ5NdVgRza-VymNFe65YF}~!5c@?UEIDF!1~~j8k@8W]j>' );
define( 'SECURE_AUTH_SALT',  '2Y1<8ymuv[3{_RG+aQU0PWA3 ODB#<MvU~@`$m6R^@B_]=]E`:g)kb9L;jS&-.v2' );
define( 'LOGGED_IN_SALT',    'Ah%@h>H5nC0Ld;>Bsv=zyBY>$,U[uIDSm)[lbGm3Yc6jxS@u;W[Q0Nl#SBYdc9!>' );
define( 'NONCE_SALT',        'lU(MjDtC~5purThATB>*eX~rNe;on<-D(nE{Wop*q3f?AKmDng)f/r0?v<QcyW7$' );
define( 'WP_CACHE_KEY_SALT', ';<u@%Q#c{wXh-kY&C?fC~QT+,i?#[tvpdF=(F]3%wC?~3o GC.hn< rJ;~bzN2 m' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
