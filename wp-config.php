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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'stevens-lee' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

if ( !defined('WP_CLI') ) {
    define( 'WP_SITEURL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
    define( 'WP_HOME',    $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
}



/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'XxQXrMS7fauZazeOhDVhVnbGXFXKM1LWjU0i4lb2KF4AgDmMZklauzmUvAaMniZP' );
define( 'SECURE_AUTH_KEY',  'zu3i4TO37DezoJzxwrfDsPJvuJHSpOSx2g7abqyM7cCzw4aoOcGZwSAZA0eVhzMb' );
define( 'LOGGED_IN_KEY',    'LFOJuBMfgARoB5R0UWob6VBdR2jsaZjImjojaiqXr5q8myzrs1AEHtRss6fOgryn' );
define( 'NONCE_KEY',        '9ZhvUxYuGPsdGukSxtizsnqc41OWba6vKNH48SfKMJPwhRm7M6JGqSzIzcmEGWhH' );
define( 'AUTH_SALT',        'w07lJ81XaIrCw92eCqKlXIQ2p871Exw2zLeitnhE8LKvCW2S4Zwb5DYjWJ7hM0nF' );
define( 'SECURE_AUTH_SALT', '4adJUZoZzezt6E94W28qKvrGM0uUreZEfc685HfUyEp3XxeY5uFNysaG8P9mAone' );
define( 'LOGGED_IN_SALT',   'GXK9VLb9umHE63HpDd19qPzntl2BxeLYm4evAJOMUwvADJUHQcE7u868rPPjbozd' );
define( 'NONCE_SALT',       'yyH3J4RKL7AZuYU9tgLs9gO4lv2mOEdnniNuSkJuiUe9ehIhaRaKOkO3uQRMArsB' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
