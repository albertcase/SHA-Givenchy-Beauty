<?php
/** Enable W3 Total Cache */
 // Added by W3 Total Cache

/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clefs secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur 
 * {@link http://codex.wordpress.org/Editing_wp-config.php Modifier
 * wp-config.php} (en anglais). C'est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d'installation. Vous n'avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('WP_CACHE', true); //Added by WP-Cache Manager
define('DB_NAME', 'givenchyconversations');

/** Utilisateur de la base de données MySQL. */
//define('DB_USER', 'root');
//define('DB_PASSWORD', '');

//define('DB_USER', 'givenchy');
//define('DB_PASSWORD', 'VQAdJTX37EnpMdCE');

define('DB_USER', 'root');
define('DB_PASSWORD', '');


/** Adresse de l'hébergement MySQL. */
define('DB_HOST', '127.0.0.1');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8');

/** Type de collation de la base de données. 
  * N'y touchez que si vous savez ce que vous faites. 
  */
define('DB_COLLATE', '');

/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant 
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'ap&4B:W{Fbz6I%mw8u?`Y(wt5VIF5n`G-^B|$@UCvBWz;B/!NvMw]muTvm@neyJc'); 
define('SECURE_AUTH_KEY',  'bj[5R2x>0:Rw;i7[lB*#e(Ue2HUeo,5~pb.X>4!,=:1rP3jbdedC)i$Xx+t/75.z'); 
define('LOGGED_IN_KEY',    '7Zu~Ya=3P5k/lJE&&5w*RMT`P~},;i8ItT>uz5ZV[y58l]83!J;55`MYmSUv Yue'); 
define('NONCE_KEY',        '3nMy/$/dEk>@q]SF[=la6EB<`UJWUp)Tff kp7i8GC@DW kcU9wny9wusL%:j#+|'); 
define('AUTH_SALT',        'BkW(I1nS -M9GQ7peIo2=gZG?Wdi!Hqp_g;[mj=IAPrY?WAXdO];)o:W>yRhrF<0'); 
define('SECURE_AUTH_SALT', 'oyW|MljD`SqOq6`JVCH>5ztaMT3P]<aU06=>Hp]R_6Gn:<^*Uo6^dg?T.;]`B/$D'); 
define('LOGGED_IN_SALT',   'y0td??|}>wUUZZ]WLVKtOih$zP]OfRsIDgWbUY&iPuC$wBGEzN4~bAoVi<@RQo.L'); 
define('NONCE_SALT',       '/xf{`7Q>9c$09MW[zGw`d{mO]gYyK_W>J)%U272JMF=sT~M|b-]OF7;n1jtke%VB'); 
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique. 
 * N'utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = 'wp_';

/**
 * Langue de localisation de WordPress, par défaut en Anglais.
 *
 * Modifiez cette valeur pour localiser WordPress. Un fichier MO correspondant
 * au langage choisi doit être installé dans le dossier wp-content/languages.
 * Par exemple, pour mettre en place une traduction française, mettez le fichier
 * fr_FR.mo dans wp-content/languages, et réglez l'option ci-dessous à "fr_FR".
 */
//define('WPLANG', 'fr_FR');
define('WPLANG', 'zh_CN');

/** 
 * Pour les développeurs : le mode deboguage de WordPress.
 * 
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant votre essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de 
 * développement.
 */ 
define('WP_DEBUG', false); 
define('WP_ALLOW_MULTISITE', true);
define( 'MULTISITE', true );
define( 'SUBDOMAIN_INSTALL', false );

//$base = '/wp/';
//define( 'DOMAIN_CURRENT_SITE', 'localhost' );
//define( 'PATH_CURRENT_SITE', '/wp/' );
$base = '/';
define( 'DOMAIN_CURRENT_SITE', '127.0.0.1:8001' );
//define( 'DOMAIN_CURRENT_SITE', 'www.albertshen.com' );
define( 'PATH_CURRENT_SITE', '/' );

//纪梵希日志log开启（true），（false）
//define('WP_DB_QUERY_LOG', true);

define( 'SITE_ID_CURRENT_SITE', 1 );
define( 'BLOG_ID_CURRENT_SITE', 1 );

/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
