<?php
/**
 * Common settings
 * 
 */
//Define reference types
error_reporting(E_ALL^E_NOTICE);
define('WALL', 1);

//Define DB Date only format
define('DB_DATE_ONLY', date('Y-m-d', time()));

//Define Database date & time
define('DB_DATE', date('Y-m-d H:i:s', time()));

define('DBDATE', mktime(DB_DATE));

//Define different login status
define('STATUS_LOGGED_OUT', 0);
define('STATUS_LOGGED_IN', 1);
define('STATUS_LOGGED_IN_ANOTHER_SYSTEM', 2);
define('STATUS_LOGGED_TIME_OUT', 3);


//Define Recent wall comment count
define('RECENT_WALL_COMMENT', 4);
define('WALL_PHOTO_HEIGHT', 750);
define('WALL_PHOTO_WIDTH', 750);
define('WALL_PHOTO_THUMB_WIDTH', 200);
define('WALL_PHOTO_THUMB_HEIGHT', 200);

/* Stremaing Media FTP Information */
define('STREAMING_FTP_HOST', 'upload.streamingmediahosting.com');
define('STREAMING_FTP_USER', 'artistfan');
define('STREAMING_FTP_PASSWORD', 'stream616af');
define('STREAMING_LIVE_SERVER', 'rtmp://lvip.smhcdn.com/artistfan-live');
define('STREAMING_MOBILE_SERVER', 'rtmp://live001.sna1.mobile.streamingmediahosting.com/artistfan-live');
define('STREAM_KEY', '8914fc8b');
define('STREAMING_FLASH_CLIENT_SERVER', 'rtmp://flash.streamingmediahosting.com/artistfan-live');
define('STREAMING_MOBILE_CLIENT_SERVER', 'rtmp://mobile.streamingmediahosting.com/artistfan-live');
define('STREAMING_LIVE_UPLOAD', 'http://lvip.smhcdn.com:8086/smhliverecordupload?app=artistfan-live');
define('STREAMING_FLV_FORMAT', 1);
define('STREAMING_MP4_FORMAT', 2);
define('STREAMING_HTML5_VOD', 'http://mobile.streamingmediahosting.com/artistfan/_definst_/');
define('STREAMING_HTML5_SUFFIX', '/playlist.m3u8');
define('STREAMING_FLASH_VOD', 'rtmp://flash.streamingmediahosting.com/artistfan/');
define('STREAMING_MOBILE_VOD', 'rtmp://mobile.streamingmediahosting.com/artistfan/');

//Common image width and height
define('COMMON_IMAGE_WIDTH', 72);
define('COMMON_IMAGE_HEIGHT', 72);

/*Video images width and height */
define('VIDEO_THUMB_IMAGE_WIDTH', 100);
define('VIDEO_THUMB_IMAGE_HEIGHT', 100);
define('VIDEO_MEDIUM_IMAGE_WIDTH', 350);
define('VIDEO_MEDIUM_IMAGE_HEIGHT', 210);
define('VIDEO_IMAGE_WIDTH', 640);
define('VIDEO_IMAGE_HEIGHT', 360);

/* Define Video File size*/
define('VIDEO_FILE_SIZE', 500*1024*1024);

/*Define User size */
define('USER_MEDIUM_IMAGE_WIDTH', 135);
define('USER_MEDIUM_IMAGE_HEIGHT', 110);
define('USER_PROFILE_IMAGE_WIDTH', 234);
define('USER_PROFILE_IMAGE_HEIGHT', 234);
define('USER_THUMB_IMAGE_WIDTH', 50);
define('USER_THUMB_IMAGE_HEIGHT', 50);

// Type of user registration.
define('USER_ARTIST', 2);
define('USER_FAN' , 1);

//Slide image width and height
define('SLIDE_WIDTH', 1025);
define('SLIDE_HEIGHT', 350);

define('HOME_SLD_WIDTH', 800);
define('HOME_SLD_HEIGHT', 400);


define('POPUP_IMAGE_WIDTH', 750);
define('POPUP_IMAGE_HEIGHT', 500);

// event Types
define('LIVE_EVENT', 1);
define('STREAM_EVENT', 2);
define('ONLINE_EVENT', 3);
define('SEARCH_RESULT', 5);

// authorize.net Payment gateway details
define('API_LOGIN_ID','cnpdev3537');
define('TRANSACTION_KEY','J3L8Z82A8USDd432');
define('AUTHORIZENET_SANDBOX', true);

//Admin payment & artist payment percentage
define('ADMIN_PRICE_PERCENT', 30);
define('ARTIST_PRICE_PERCENT', 70);

//Event Approval Status
define('EVENT_PENDING', 0);
define('EVENT_APPROVED', 1);
define('EVENT_DENIED', 2);

//cc key 
define('dbkey','UsaWeb rulez!');

?>