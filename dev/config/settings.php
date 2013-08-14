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

$currentUrl = (($_SERVER['HTTPS']) ? 'https://': 'http://'). $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

//Define admin details
define('ADMIN_NAME','admin');
define('ADMIN_EMAIL', 'no-reply@artistfan.com'); //no-reply@artistfan.com
define('ADMIN_EMAIL_RECEIVED', 'admin@artistfan.com'); //admin@artistfan.com

//Define different login status
define('STATUS_LOGGED_OUT', 0);
define('STATUS_LOGGED_IN', 1);
define('STATUS_LOGGED_IN_ANOTHER_SYSTEM', 2);
define('STATUS_LOGGED_TIME_OUT', 3);

// music allowed date
define('ALLOWED_DATE', 90);
define('ALBUM_DISCOUNT_PERCENT', 10);

//Define Recent wall comment count
define('RECENT_WALL_COMMENT', 4);
define('WALL_PHOTO_HEIGHT', 750);
define('WALL_PHOTO_WIDTH', 750);
define('WALL_PHOTO_THUMB_WIDTH', 200);
define('WALL_PHOTO_THUMB_HEIGHT', 200);

/* Stremaing Media FTP Information */
//define('STREAMING_FTP_HOST', 'upload.streamingmediahosting.com');
define('STREAMING_FTP_HOST', '66.116.101.136');
define('STREAMING_FTP_USER', 'artistfan');
//define('STREAMING_FTP_PASSWORD', 'stream616af');
define('STREAMING_FTP_PASSWORD', 'artistfan01managed!');
define('STREAMING_LIVE_SERVER', 'rtmp://lvip.smhcdn.com/artistfan-live');
define('STREAMING_MOBILE_SERVER', 'rtmp://live001.sna1.mobile.streamingmediahosting.com/artistfan-live');
define('STREAM_KEY', '8914fc8b');
//define('STREAMING_FLASH_CLIENT_SERVER', 'rtmp://flash.streamingmediahosting.com/artistfan-live');
define('STREAMING_FLASH_CLIENT_SERVER', 'rtmp://cvip.smhcdn.com/artistfan-live/');
//define('STREAMING_MOBILE_CLIENT_SERVER', 'rtmp://mobile.streamingmediahosting.com/artistfan-live');
define('STREAMING_MOBILE_CLIENT_SERVER', 'http://cvip.smhcdn.com/artistfan-live/_definst_/');
define('STREAMING_LIVE_UPLOAD', 'http://lvip.smhcdn.com:8086/smhliverecordupload?app=artistfan-live');
define('STREAMING_LIVE_UPLOAD_NEW', 'http://lvip.smhcdn.com:8086/smhliverecordupload?app=artistfan-live&key=8914fc8b&record=true');
define('STREAMING_FLV_FORMAT', 1);
define('STREAMING_FLV_FORMAT_STRING', 'flv');
define('STREAMING_MP4_FORMAT', 2);
define('STREAMING_MP4_FORMAT_STRING', 'mp4');
//define('STREAMING_HTML5_VOD', 'http://mobile.streamingmediahosting.com/artistfan/_definst_/');
define('STREAMING_HTML5_VOD', 'http://dvip.smhcdn.com/artistfan/_definst_/');
define('STREAMING_HTML5_SUFFIX', '/playlist.m3u8');
//define('STREAMING_FLASH_VOD', 'rtmp://flash.streamingmediahosting.com/artistfan/');
define('STREAMING_FLASH_VOD', 'rtmp://dvip.smhcdn.com/artistfan/');
//define('STREAMING_MOBILE_VOD', 'rtmp://mobile.streamingmediahosting.com/artistfan/');
define('STREAMING_MOBILE_VOD', 'rtmp://dvip.smhcdn.com/artistfan/');

//Broadcast Status
define('BROADCAST_INPROCESS', 0);
define('BROADCAST_CLOSED', 1);
define('BROADCAST_DOWNLOADED', 2);
define('BROADCAST_DOWNLOAD_ERROR', 3);

//Common image width and height
define('COMMON_IMAGE_WIDTH', 72);
define('COMMON_IMAGE_HEIGHT', 72);

/*Video images width and height */
define('VIDEO_THUMB_IMAGE_WIDTH', 100);
define('VIDEO_THUMB_IMAGE_HEIGHT', 100);
define('VIDEO_MEDIUM_IMAGE_WIDTH', 350);
define('VIDEO_MEDIUM_IMAGE_HEIGHT', 210);
define('VIDEO_IMAGE_WIDTH', 640);
define('VIDEO_IMAGE_HEIGHT', 480);

/* Define Video File size*/
define('VIDEO_FILE_SIZE', 500*1024*1024);
define('MUSIC_FILE_SIZE', 200*1024*1024);

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

//Album Slide image width and height
define('ALBUM_SLIDE_WIDTH', 1025);
define('ALBUM_SLIDE_HEIGHT', 350);

//Album Slide image width and height
define('ALBUM_EXPLORE_WIDTH', 210);
define('ALBUM_EXPLORE_HEIGHT', 118);

//Album Slide image width and height
define('ALBUM_IMG_WIDTH', 200);
define('ALBUM_IMG_HEIGHT', 200);

//Album & Track Images Path
define('TRACK_IMG_PATH','files/track/images');

//Top Banner Width And Height
define('TOP_BANNER_WIDTH', 728);
define('TOP_BANNER_HEIGHT', 90);
//Right Banner Width And Height
define('RIGHT_BANNER_WIDTH', 300);
define('RIGHT_BANNER_HEIGHT', 250);
//Center Banner Width And Height
define('CENTER_BANNER_WIDTH', 340);
define('CENTER_BANNER_HEIGHT', 186);

define('HOME_SLD_WIDTH', 1025);
define('HOME_SLD_HEIGHT', 400);

// Photo Thumb size
define('PHOTO_THUMB_SIZE_WIDTH', 235);
define('PHOTO_THUMB_SIZE_HEIGHT', 235);

// PHOTO MAXIMUM SIZE

define('PHOTO_MID_IMAGE_SIZE_WIDTH', 700);
define('PHOTO_MID_IMAGE_SIZE_HEIGHT', 700);

//Event image as thumb size
define('HOME_THUMB_EVENTS_WIDTH', 200);
define('HOME_THUMB_EVENTS_HEIGHT', 115);

//Event image as midium size
define('HOME_MID_EVENTS_WIDTH', 400);
define('HOME_MID_EVENTS_HEIGHT', 230);

//Event home slide
define('HOME_SLD_EVENTS_WIDTH', 769);
define('HOME_SLD_EVENTS_HEIGHT', 442);

define('POPUP_IMAGE_WIDTH', 750);
define('POPUP_IMAGE_HEIGHT', 500);

// event Types
define('LIVE_EVENT', 1);
define('STREAM_EVENT', 2);
define('ONLINE_EVENT', 3);
define('SEARCH_RESULT', 4);
define('SEARCH_VIDEO_RESULT', 3);

//Admin payment & artist payment percentage
define('ADMIN_PRICE_PERCENT', 30);
define('ARTIST_PRICE_PERCENT', 70);

//Event Approval Status
define('EVENT_PENDING', 0);
define('EVENT_APPROVED', 1);
define('EVENT_DENIED', 2);

//Explore Categories
define('EXPLORE_VIDEO', 1);
define('EXPLORE_ARTIST', 2);
define('EXPLORE_MUSIC_ALBUM', 3);
define('EXPLORE_SHOWS', 4);
define('MUSIC_SLIDE_CAT_ID', 15);
define('VIDEO_SLIDE_CAT_ID', 8);

//Home Recent
define('LIVE_SHOW', 5);
define('RECENT_VIDEOS', 6);
define('RECENT_ARTIST', 7);
define('INDEX_EVENT_SHOW', 23);

//Video Types
define('MUSIC_VIDEO', 1);
define('RE_LIVE_STREAM', 2);
define('YT_VIDEO', 3);

define('BANNER_IMAGES','Banner Images');
define('PROFILE_PICTURES','Profile Pictures');

define('PHOTO_PER_PAGE', 12);

define('SESSION_TIME', 60*60);

//cc key 
define('dbkey','UsaWeb rulez!');

//mandrillapp.com
define('MANDRILL_KEY', 'kTD_pntL9OPrYtNbFZ50Yw');


?>