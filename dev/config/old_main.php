<?php
/**
 * Main config
 * User: ssergy
 * Date: 10.01.2011
 * Time: 19:27:19
 * 
 */

define('DOMAIN', 'artistsfan.preview.elro.com');
define('SITE_NAME', 'ArtistFan');

define('PATH_ROOT', '/');
define('PATH_ROOT_ADM', '/siteadmin/');
define('BPATH', getenv('DOCUMENT_ROOT') . '' . PATH_ROOT );

define('VPATH', '/opt/vc_server2/data/');
define('VBASE', 'mysql:host=localhost;dbname=optimevideo');
define('VTABLE', 'queue');


define('SUPPORT_SITENAME', 'artistsfan.preview.elro.com');
define('SESSION_NAME', 'h_ses');

define('DEBUG', 1);
define('MEMCACHE_SERVER',serialize(array('127.0.0.1:11211')));

//additional info
define('MAX_GENRES_COUNT', 2);

//facebook api id
define('FACEBOOK_API_ID', '354473637937559');
define('FACEBOOK_API_SECRET', '29f6dd45fb1281ebd5ed6c5ade8c7377');

define('TWITTER_CONSUMER_KEY', 'hr4K9G7p5npPghPsTjAgBg');
define('TWITTER_CONSUMER_SECRET', 'QSRnX5CYu4lmXQ5RbxYxiWmA8jVCcBcutWQAMH4s');
define('TWITTER_OAUTH_CALLBACK', 'http://' . DOMAIN . '/base/user/twitterauth');


define('INFLUXIS_FTP_HOST', 'mpz7wc2y.rtmphost.com');
define('INFLUXIS_FTP_USER', 'mpz7wc2y');
define('INFLUXIS_FTP_PASSWORD', 'fr8b42l8');
define('INFLUXIS_DIRNAME_SRC', '/mpz7wc2y_apps/VideoBroadcast/streams/_definst_');
define('INFLUXIS_DIRNAME_DEST', '/mpz7wc2y_apps/http/video');

define('PAYVISION_MEMBER_ID', '4041');
define('PAYVISION_MEMBER_GUID', '7CF48583-6D57-4A87-B17C-0CF130A8E165');
?>
