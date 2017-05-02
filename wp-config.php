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
define('DB_NAME', 'slideshow-plugin');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '/e`3lmn0,D:#OZzB]i/DY|!P]^Gy>F;-C~+R3)J#R6S>n|WP(6:oE)WdaAChix#P');
define('SECURE_AUTH_KEY',  'MR(;I(NE.-Or6@62a#HQlr~Bl(tM^ifM%or_FR@_*xQ}]MW^$+gmWIDN_]jPM<WF');
define('LOGGED_IN_KEY',    '=K!<:KR~1fEuTLv()ksdE}0sy}&a2hG`ZJBGbgiv=:TL)~_8MGvS-u-DmOfr|{T^');
define('NONCE_KEY',        'qmd:I=|4+kSJ-25UecOCN_6[Bz#l^u&F;y4^Y=u@l[eX4.^^H;Xlrr__d`M4.+Zd');
define('AUTH_SALT',        'x|wPfsd,`43vv$=SEU>o0{9[KSjXMS/^+r;t&(vWG|(y]-/%ngb=Th;$3wbAU:m<');
define('SECURE_AUTH_SALT', '%dCCiW?Gld=BQd<1&tq(pqZ-Yu`!=Q}^,.B7_:Bc<G>b#OC4`GLE?0tRegX_r5~E');
define('LOGGED_IN_SALT',   '*ZG{WB`O|L}/WMC/M12n B~d}vq{Y%[1Jx_<4HZ8e0A`9DN}|w]4a){Kb]1Abo0|');
define('NONCE_SALT',       'ZLT0H}@}uy@^k].3xD(~E|}vKzzsy_^sjm>>(j6`l&k*Uo&m_=S<Y&G($(eNI^c,');

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
