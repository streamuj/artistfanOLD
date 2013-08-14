<?php 
//Cron settings
define('FTP_QUEUE_VIDEO', 1);
define('FTP_QUEUE_MUSIC', 2);
define('FTP_STATUS_DEFAULT', 0);
define('FTP_STATUS_INPROCESS', 1);
define('FTP_STATUS_ERROR_PROCESS', 2);
define('FTP_STATUS_COMPLETE', 3);
define('FTP_VIDEO_FLASH_DIR', '/flash/u/');
define('FTP_VIDEO_MOBILE_DIR', '/mobile/u/');
define('FTP_MUSIC_FLASH_DIR', '/flash/track/u/');
define('FTP_MUSIC_MOBILE_DIR', '/mobile/track/u/');
if(!defined('FFMPEG_PATH')){
	define('FFMPEG_PATH', '/usr/bin/ffmpeg');
}
define('LOG_FILE', $currentDir.'cron_log.txt');

set_error_handler( 'ErrorHandler');
set_exception_handler('ExceptionHandler');

function sendConversionEmail($subject, $message, $params=array())
{	
	$params['to'] = 'np@usaweb.net';
	$params['cc'] = 'el@artistfan.com';
	error_log('['.wallTime(mktime()).'] '.$subject.':'.$message."\n", 3, LOG_FILE);
	$subject .= ' '.DOMAIN;
	sendEmail('admin@artistfan.com', 'Admin', 'bks@usaweb.net', 'Bala', $subject, $message, $params);
}

function ExceptionHandler($exception)
{
	global $currentUrl;
	$msg = "Error In URL: {$currentUrl}<br />";
	$msg .= "<b>Exception: </b> $exception<br />\n";
	sendConversionEmail('Artistfan Exception', $msg);
}
	
function ErrorHandler($errno, $errstr, $errfile, $errline)
{
	global $currentUrl;
	$msg = "Error In URL: {$currentUrl}<br />";
	switch ($errno) {
		case E_USER_ERROR:
			$msg .= "<b>My ERROR</b> [$errno] $errstr<br />\n";
			$msg .= "  Fatal error on line $errline in file $errfile";
			$msg .= ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
			require_once(BPATH.'files/index.php');
			sendConversionEmail('Artistfan Error', $msg);
			exit(1);
			break;
		case E_USER_WARNING:
			$msg .= "<b>My WARNING</b> [$errno] $errstr<br />\n";
			sendConversionEmail('Artistfan Warning Error', $msg);
			break;
		case E_USER_NOTICE:
			$msg .= "<b>My NOTICE</b> [$errno] $errstr<br />\n";
			break;
	
		default:
			$msg .= "Unknown error type: [$errno] $errstr<br />\n";
			break;
	}
	return true;
}

function insertFTPQueue($uploadType, $uploadId, $uploadName, $uploadToName, $userId)
{
	$qry = 'INSERT INTO ftp_queue (type, type_id, type_name, type_to_name, user_id) VALUES ('.$uploadType.', '.$uploadId.',"'.$uploadName.'", "'.$uploadToName.'", '.$userId.')';
	$rslt = Query::Execute($qry);
	return $rslt;
}

function executeNonQuery($qry)
{
	try{
		$rslt = Query::Execute($qry);
	} catch(Exception $ex){
		$fp = fopen('query'.mktime().'.txt');
		
	}
	return $rslt;
}

function getResultSet($qry)
{
	$result = Query::GetAll($qry);
	return $result;
}

function checkFileExists($remoteFile)
{
	$fileExists = false;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'ftp://'.STREAMING_FTP_HOST.$remoteFile);
	curl_setopt($ch, CURLOPT_USERPWD, STREAMING_FTP_USER.':'.STREAMING_FTP_PASSWORD);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_NOBODY, true);
	$data = curl_exec($ch);
	if(curl_errno($ch)){
		sendConversionEmail('Curl File Exist Error', curl_error($ch). ' '. 'Error Code: ', curl_errno($ch));
		echo $fileExists = 'Error';
		exit;
	} else {
		$curlInfo = curl_getinfo($ch);
		if($curlInfo['download_content_length'] != -1){
			$fileExists = true;
		}
	}
	curl_close($ch);
	return $fileExists;
}

function deleteFileInFTP($remoteFile)
{
	$fileDeleted = false;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'ftp://'.STREAMING_FTP_HOST);
	curl_setopt($ch, CURLOPT_USERPWD, STREAMING_FTP_USER.':'.STREAMING_FTP_PASSWORD);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_QUOTE, array('DELE ' . $remoteFile));
	$data = curl_exec($ch);
	if(curl_errno($ch)){
		echo 'Curl File Delete Error: '.  curl_error($ch). ' '. 'Error Code: ', curl_errno($ch);
		sendConversionEmail('Curl File Delete Error', curl_error($ch). ' '. 'Error Code: ', curl_errno($ch));
	} else {
		$fileDeleted = true;
	}
	curl_close($ch);
	return $fileDeleted;
}

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
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($ch);
	$error_no = curl_errno($ch);
	if(curl_errno($ch)){
		$error = 'Error In CURL Upload: '.curl_error($ch). ' Error Code: '. $error_no;
		echo '<hr>';
		$params['to'] = 'np@usaweb.net';
		sendConversionEmail('FTP Upload Error', $error);
	}
	curl_close ($ch);
	fclose($fp);
	if($error_no){
		return false;
	}
	return true;
}

function uploadToFTP($srcFile, $uploadDir, $uploadFile, $tryCount=0)
{
	$remoteFile = $uploadDir.'/'.$uploadFile;
	if($tryCount){
		$fileExists = checkFileExists($remoteFile);
		if($fileExists === 'Error'){
			return false;
		} else if($fileExists){
			//Delete the file
			if(!deleteFileInFTP($remoteFile)){
				return false;
			}
		}
	}
	$uploadFTP = uploadCurlFileToFTP($srcFile, $remoteFile);
	return $uploadFTP;
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
		$error = 'Error In CURL Listing: '.curl_error($ch). ' Error Code: '. $error_no;
		echo '<hr>';
		sendConversionEmail('FTP List Error', $error);
	}
	curl_close ($ch);
	if($error_no){
		return false;
	}
	$dirList=preg_split("/\r\n/",$result);
	return $dirList;
}
?>