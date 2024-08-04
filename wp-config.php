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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'g5_case_study_db' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         'JXn! 034*N~V7}x;aWwlGH%K*$LBV<^k|p_u}9eq-g{yJ+$b-ZRTBF[09Nb4E7`q' );
define( 'SECURE_AUTH_KEY',  'k|y4;_]gXTe!I`gT,}`b_pJ>56~;&0!%%O021HRMMOv}1rMv*sq*@E&S5Ce2*WS>' );
define( 'LOGGED_IN_KEY',    'F]`,^6Pl1 U^h5#[9c&uginBo#/hmYZK{&`)6zpPD]wH<pAU&.K=$01G xZ=Q7Zz' );
define( 'NONCE_KEY',        ',FK<+#7&*utq{^G~l45*N@8N1xI`@@JQi|]R7}MB]Pz1Z7:XA#GL4;z](EB7*sw3' );
define( 'AUTH_SALT',        'G4> [GK`Fo!;Ue2iHq.{b`q#yoXc~]FUu:E_pK`-AO?xPJ30/a-z!dXa``YQ TB}' );
define( 'SECURE_AUTH_SALT', '^x%<t|Ty4_j+=xKCOWK|,_5ggaPyD)UwoWpkj0^V Pt/482ys;q%^C4aM.]:zL?Z' );
define( 'LOGGED_IN_SALT',   's4PfGVzfv)eG[dPszcM3 Qd=kp`#&(AW.pSFE`$fu?-`MN;V7HjhmM5sHu[3MLcC' );
define( 'NONCE_SALT',       '2ZZ$7[/.uLQ&|{G/!W?^-:X.h&`3}SuWA-om=p_N#NZSds|p{+yYfdZL^E3ROb9.' );

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



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
