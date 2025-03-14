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
define( 'DB_NAME', 'wordpress' );

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
define( 'AUTH_KEY',         'MO6#ub:*hr junF##%jA-A5YRfxx5p-/V+MjVvMPFls~q,D%iQkNg`Fq5i<50iQ-' );
define( 'SECURE_AUTH_KEY',  '89Jz hZ|6+J%v(ADsvu3{y?|:*~^8pCV=9c+5@/u`i|c6p[/#L(im4E6PlXCPj=*' );
define( 'LOGGED_IN_KEY',    '78u3hmsXc.73q#{Ur)t0X@7jFuS05WgXh3Rw{)sMi.y W=CK_M O&Z^Z,RV>LQ;]' );
define( 'NONCE_KEY',        'b~`e E1V:ut,3tJCPwy4plOhO)C[0v>d`*>MP`,&wj6YDL,,c7^p5Rsdo.ejsoH=' );
define( 'AUTH_SALT',        'FD! De(Be4B,Z*po70xl]lJ=SkH6$D:lL}W8w&zc!m+H wd?J9]<JFW;e33^y8X1' );
define( 'SECURE_AUTH_SALT', 'Jyb+S$}@u1pENvrKYh*I&7/c:EKB5bl=#]*f2L|4:?rSMLmwwvv#@byn:Zd+`uXb' );
define( 'LOGGED_IN_SALT',   '<?|=b=@T=ZqQO7cNSwfqg6e=@JZaR{a4&9S?V`I.gTH,?$H99^@+gY>jx-a_>SUf' );
define( 'NONCE_SALT',       'DlZmA!7Y5oT70qRQ+pz! %%6]Cp3[*VHYPdwyXK(1F7_T_)brr0<y6VHo0F>C[e9' );

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
