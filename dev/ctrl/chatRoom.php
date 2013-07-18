<?php
/**
 * Cron Job for converting tracks
 *
 */
error_reporting(2047);
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
ini_set('max_execution_time', 0);

include_once 'dev/config/main.php';
//init functions
include_once 'libs/functions.php';

$log = array();
$file = _v('file', '');
if(!$file) {
	$log['error'] = 'No File';
	echo json_encode($log);
	exit;
}
$chatFile = BPATH.'files/chat/'.$file.'.txt';
$nickname = htmlentities(strip_tags(_v('nickname')), ENT_QUOTES); 
$avatar = htmlentities(strip_tags(_v('avatar')), ENT_QUOTES); 
if($avatar)
{
	$avatar_path= "/files/images/avatars/x_".$avatar;
}
else
{
	$avatar_path= "/si/ph/user300x300.jpg";
}

$patterns = array("/:\)/", "/:D/", "/:p/", "/:P/", "/:\(/");
$replacements = array("<img src='/si/smiles/smile.gif'/>", 
	"<img src='/si/smiles/bigsmile.png'/>", 
	"<img src='/si/smiles/tongue.png'/>", 
	"<img src='/si/smiles/tongue.png'/>", 
	"<img src='/si/smiles/sad.png'/>");
$message = trim(strip_tags(_v('message'),'<a>'));
if(!$message){
	$log['error'] = 'No Message';
	echo json_encode($log);
	exit;
}
$message = nl2br(makeTextAsHyperLink($message));
$message = preg_replace($patterns, $replacements, $message);
//$message = htmlentities($message, ENT_QUOTES);
//fwrite(fopen($this->chatFile, 'a'), "<span>". $nickname . "</span>" . $message."\n"); 
$fp = fopen($chatFile, 'a');
flock($fp, LOCK_EX);
fwrite($fp, "<a href=\"/u/".$nickname."\"><span class=\"imgTb\"><img src='".$avatar_path."' alt=\"user\" /></span></a><span class=\"conTxt\">" . $message . "</span><div class=\"clear\"></div>\n"); 
fclose($fp);
$log['success'] = 1;
echo json_encode($log);
exit;