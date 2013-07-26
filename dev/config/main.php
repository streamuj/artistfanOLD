<?php
/**
 * Main config
 * User: ssergy
 * Date: 10.01.2011
 * Time: 19:27:19
 * 
 */

date_default_timezone_set('UTC');
define('DOMAIN', 'localartistfan.com');
define('SITE_NAME', 'ArtistFan');

error_reporting(E_ALL^E_NOTICE);

//$http = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ) ? 'https://' : 'http://';
$http = 'http://';

define('PATH_ROOT', '/');
define('PATH_ROOT_ADM', '/siteadmin/');
//define('BPATH', getenv('DOCUMENT_ROOT') . '' . PATH_ROOT );
if(!defined('DS')){
	define('DS', DIRECTORY_SEPARATOR);
}
$siteDir = dirname(dirname(dirname(__FILE__)));
define('ROOT_HTTP_PATH', $http.DOMAIN);

//define('SUB_DOMAIN', 'http://localartistfan.com/files/');
/*if($_SERVER['HTTPS']) {
	define('SUB_DOMAIN', ROOT_HTTP_PATH.'/files/');
} else {
	define('SUB_DOMAIN', $http.'sub.localartistfan.com/');
}*/
define('SUB_DOMAIN', $http.'sub.localartistfan.com/');

define('BPATH', $siteDir . DS );
define('VPATH', BPATH. 'data'.DS);
define('VBASE', 'mysql:host=localhost;dbname=artistfan');
define('VTABLE', 'queue');

require_once(dirname(__FILE__).DS.'settings.php');
require_once(dirname(__FILE__).DS.'errorLabelstr.php');

define('SUPPORT_SITENAME', 'localartistfan.com');
define('SESSION_NAME', 'h_ses');

define('DEBUG', 0);
define('MEMCACHE_SERVER',serialize(array('127.0.0.1:11211')));

//additional info
define('MAX_GENRES_COUNT', 3);

//facebook api id
define('FACEBOOK_API_ID', '508096875882048');
define('FACEBOOK_API_SECRET', '01ee9820d816304dc16f95c858462c41');
define('FB_APP_NAME', 'localartistfan');

define('TWITTER_CONSUMER_KEY', '0PZqWX4zovUazIZgSdHnlw'); //hr4K9G7p5npPghPsTjAgBg
define('TWITTER_CONSUMER_SECRET', 'HbOllyX0YsKPV8ZYAi46325Zj3eZzadSRRZ56byejsw'); //QSRnX5CYu4lmXQ5RbxYxiWmA8jVCcBcutWQAMH4s
define('TWITTER_OAUTH_CALLBACK', 'http://' . DOMAIN . '/base/user/twitterauth');
define('TWITTER_VIA', 'lenin2ud');
define('TWITTER_HASH', '#lenin2ud');


define('INFLUXIS_FTP_HOST', 'mpz7wc2y.rtmphost.com');
define('INFLUXIS_FTP_USER', 'mpz7wc2y');
define('INFLUXIS_FTP_PASSWORD', 'fr8b42l8');
define('INFLUXIS_DIRNAME_SRC', '/mpz7wc2y_apps/VideoBroadcast/streams/_definst_');
define('INFLUXIS_DIRNAME_DEST', '/mpz7wc2y_apps/http/video');

define('PAYVISION_MEMBER_ID', '4041');
define('PAYVISION_MEMBER_GUID', '7CF48583-6D57-4A87-B17C-0CF130A8E165');

// authorize.net Payment gateway details
define('API_LOGIN_ID','3C2Za6b79');
define('TRANSACTION_KEY','6W3jmAvW2y58k527');
define('AUTHORIZENET_SANDBOX', false);

//SMTP Settings
define('SMTP_HOST', 'mail.emailsrvr.com');
define('SMTP_PORT', 25);
define('SMTP_EMAIL', 'artistfan1@usawebdept.com');
define('SMTP_PASSWORD', 'P@ssw0rd');
define('REPLY_EMAIL', 'artistfan@usawebdept.com');
?>