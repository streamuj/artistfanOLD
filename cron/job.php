<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
ini_set('max_execution_time', 0);

$siteDir = dirname(dirname(__FILE__));

//init config
include_once $siteDir.'/dev/config/main.php';

error_reporting(E_ALL);

//init functions
include_once BPATH .'libs/functions.php';

$currentDir = dirname(__FILE__).DS;

define('CLASS_PATH', 'dev/');
ini_set("include_path", ini_get('include_path').PATH_SEPARATOR. BPATH . CLASS_PATH);
require_once BPATH.'libs/Propel/lib/Propel.php';
set_include_path(BPATH . "dev/db/build/classes" . PATH_SEPARATOR . get_include_path());
include_once BPATH.'dev/db/Query.class.php';

require_once(BPATH . "dev/db/build/conf/artistfan-conf.php");

Propel::init(BPATH . "dev/db/build/conf/artistfan-conf.php");

require_once($currentDir.'videoConverter.php');
require_once($currentDir.'audioConverter.php');
require_once($currentDir.'saveEventVideo.php');

function uploadCurlFileToFTP($localFile, $remoteFile)
{
	$ch = curl_init();
	$fp = fopen($localFile, 'r');
	curl_setopt($ch, CURLOPT_URL, 'ftp://'.STREAMING_FTP_HOST.$remoteFile);
	curl_setopt($ch, CURLOPT_USERPWD, STREAMING_FTP_USER.':'.STREAMING_FTP_PASSWORD);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	//curl_setopt($ch, CURLOPT_TIMEOUT, 300);
	curl_setopt($ch, CURLOPT_TIMEOUT, 0);
	curl_setopt($ch, CURLOPT_FTP_CREATE_MISSING_DIRS, TRUE);
	curl_setopt($ch, CURLOPT_UPLOAD, 1);
	curl_setopt($ch, CURLOPT_INFILE, $fp);
	curl_setopt($ch, CURLOPT_INFILESIZE, filesize($localFile));
	curl_exec ($ch);
	$error_no = curl_errno($ch);
	if(curl_errno($ch)){
		echo 'Error In CURL Upload: '.curl_error($ch);
		echo '<hr>';
		return false;
	}
	curl_close ($ch);
	fclose($fp);
}

function getFTPDirectoryList($directory)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'ftp://'.STREAMING_FTP_HOST."/{$directory}/");
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_USERPWD, STREAMING_FTP_USER.':'.STREAMING_FTP_PASSWORD);
	curl_setopt($ch, CURLOPT_TIMEOUT, 300);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FTPLISTONLY, TRUE);
	$result =  curl_exec($ch);
	$error_no = curl_errno($ch);
	if(curl_errno($ch)){
		echo 'Error In CURL Listing: '.curl_error($ch);
		echo '<hr>';
		return false;
	}
	curl_close ($ch);
	$dirList=preg_split("/\r\n/",$result);
	return $dirList;
}