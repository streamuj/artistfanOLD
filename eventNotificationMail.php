<?php
/**
 * Cron Job for send event notification mail
 *
 */
error_reporting(2047);
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
ini_set('max_execution_time', 0);

include_once 'dev/config/main.php';
include_once 'dev/config/settings.php';
include_once 'libs/functions.php';

/* Get the EST Time*/
/*
$estDate = new DateTime();
$estTimeZone = new DateTimeZone('EST');
$estDate->setTimezone($estTimeZone);
$offset = $estDate->getOffset();
$estTime = mktime() + $offset;
$estDate = date('Y-m-d', $estTime);
*/
$estTime = getEstTime();

$laterTime = $estTime + (30 * 60); // 11:30 will get data for >=12:00 to <12:15 - 11:45 data >=12:15 to <12:30 - 12:00 12:30 to 12:45
$laterDate = date('Y-m-d H:i:00', $laterTime);

$endTime = $laterTime + (15 * 60); // Once every 15 minutes
$endDate = date('Y-m-d H:i:00', $endTime);

//init functions
include_once 'libs/functions.php';

define('CLASS_PATH', '/dev/');
ini_set("include_path", ini_get('include_path').PATH_SEPARATOR. PATH_SEPARATOR . BPATH . CLASS_PATH);
require_once 'libs/Propel/lib/Propel.php';
set_include_path(BPATH . "dev/db/build/classes" . PATH_SEPARATOR . get_include_path());
include_once 'dev/db/Query.class.php';

require_once(BPATH . "dev/db/build/conf/artistfan-conf.php");

  //init Smarty
  require 'libs/Smarty/Smarty.class.php';
  $mSmarty                  = new Smarty();
  $mSmarty -> compile_check = true;
  $mSmarty -> debugging     = false;//DEBUG ? true : false;
  $mSmarty -> setTemplateDir(BPATH.'dev/skin');
  $mSmarty -> setCompileDir(BPATH.'files/templ/');
  $mSmarty -> setCacheDir(BPATH.'files/cache/');
  $mSmarty -> setConfigDir(BPATH.'dev/templates/conf/');
  $mSmarty -> error_reporting  = E_ALL & ~E_NOTICE/* & ~E_WARNING*/;
  $mSmarty -> setPluginsDir( array(
                BPATH.'libs/Smarty/plugins',
                BPATH.'dev/templates/plugins', 
  ));
	
Propel::init(BPATH . "dev/db/build/conf/artistfan-conf.php");

/* Get the Event list who need to broadcast the event */

$eventArtist =getEventArtistId($laterDate, $endDate);

foreach($eventArtist as $val)
{
	$uId = $val['UserId'];	
	$eId = $val['EventId'];	
	$ArtistName = $eventAndUser['name'];
    $mSmarty->assign('event_id', $eId);				
    $mSmarty->assign('event_title', $val['title']);	
    $mSmarty->assign('event_dateTime', $eventAndUser['event_date']);	
	$name = $val['band_name'] ? $val['band_name'] : ($val['first_name'].' '.$val['last_name']);
    $mSmarty->assign('name', $name);	
    $mSmarty->assign('ArtistName', $ArtistName);
    $mSmarty->assign('DOMAIN', DOMAIN);
	
	$fromEmail = ADMIN_EMAIL;
	$fromName = SITE_NAME;
	$toEmail = $val['email'];
	$toName = $name;
	$subject = 'Event Notification From ' . SITE_NAME;
	$message = $mSmarty->fetch('mails/artist_event_notify_mail.html');
	sendEmail($fromEmail, $fromName, $toEmail, $toName, $subject, $message);
}
/* Get the fan list who purchased the events */
$eventFans =getEventFansId($laterDate, $endDate);

foreach($eventFans as $val)
{
	$uId = $val['UserId'];	
	$eId = $val['EventId'];		
	
	$ArtistName = $val['name'];	
    $mSmarty->assign('event_id', $eId);				
    $mSmarty->assign('event_title', $val['title']);	
    $mSmarty->assign('event_dateTime', $val['event_date']);	
	
	$name = $val['band_name'] ? $val['band_name'] : ($val['first_name'].' '.$val['last_name']);
	
    $mSmarty->assign('name', $name);
    $mSmarty->assign('ArtistName', $ArtistName);
    $mSmarty->assign('DOMAIN', DOMAIN);
	$fromEmail = ADMIN_EMAIL;
	$fromName = SITE_NAME;
	$toEmail = $val['email'];
	$toName = $name;
	$subject = 'Event Notification From ' . SITE_NAME;
	$message = $mSmarty->fetch('mails/fan_event_notify_mail.html');
	sendEmail($fromEmail, $fromName, $toEmail, $toName, $subject, $message);
}

function getEventFansId($laterDate, $endDate)
{
	global $conf;
	$gPdo = new PDO(VBASE, $conf['datasources']['artistfan']['connection']['user'], $conf['datasources']['artistfan']['connection']['password']);
	$gPdo->query('SET CHARACTER SET utf8');
	
	$stmnt = $gPdo->query("SELECT e.id AS EventId, u.id AS UserId, u.email,u.name,u.first_name,u.last_name,u.band_name,
		e.title, event_date
	FROM event_purchase AS ep 
	INNER JOIN user AS u ON u.id = ep.user_id AND email_confirmed = 1 AND blocked = 0
	INNER JOIN event AS e ON e.id=ep.event_id 
	WHERE e.event_date>='".$laterDate."' AND e.event_date<'".$endDate."' AND (e.status=1 or e.status=2) AND e.deleted=0");
		
	$list = array();
	
	while ($v = $stmnt->fetch(PDO::FETCH_ASSOC))
	{
            $list[] = $v;			
	}
	unset($stmnt);
	unset($v);
	$gPdo = null;
	return $list;
}

function getEventArtistId($laterDate, $endDate)
{
	global $conf;
	$gPdo = new PDO(VBASE, $conf['datasources']['artistfan']['connection']['user'], $conf['datasources']['artistfan']['connection']['password']);
	$gPdo->query('SET CHARACTER SET utf8');

	$stmnt = $gPdo->query("SELECT e.id AS EventId,e.user_id AS UserId, u.email, u.name, u.first_name, u.last_name, u.band_name, e.title, event_date
	FROM event AS e 
	INNER JOIN user AS u ON u.id = e.user_id AND u.status = ".USER_ARTIST." AND email_confirmed = 1 AND blocked = 0
	WHERE e.event_date>='".$laterDate."' AND e.event_date<'".$endDate."' AND (e.status=1 or e.status=2) AND e.deleted=0 AND  	event_app=1");
	
	$list = array();		
	
	while ($v = $stmnt->fetch(PDO::FETCH_ASSOC))
	{
            $list[] = $v;			
	}
	unset($stmnt);
	unset($v);
	$gPdo = null;
	return $list;
}

?>