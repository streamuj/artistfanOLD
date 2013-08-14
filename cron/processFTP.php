<?php
require_once('cronHeader.php');

getFilesForFTPProcess();

function getFilesForFTPProcess()
{
	$qry = 'SELECT * FROM ftp_queue WHERE status = 1 LIMIT 1';
	$result = getResultSet($qry);
	if($result) {
		echo 'File upload is in process';
		exit;
	}
	$qry = 'SELECT * FROM ftp_queue WHERE (status = 0 OR status = 2) LIMIT 10';
	$result = getResultSet($qry);
	foreach($result as $value){
		if($value['type'] == FTP_QUEUE_VIDEO){
			$flashDir = FTP_VIDEO_FLASH_DIR.$value['user_id'];
			$mobileDir = FTP_VIDEO_MOBILE_DIR.$value['user_id'];
			$sourceFile = VPATH . 'result'.DS.'video'.DS. $value['type_name'];
			$destFile = $value['type_to_name'];
		} else {
			$flashDir = FTP_MUSIC_FLASH_DIR.$value['user_id'];
			$mobileDir = FTP_MUSIC_MOBILE_DIR.$value['user_id'];
			$sourceFile = VPATH . 'result'.DS.'track'.DS. $value['type_name'];
			$destFile = $value['type_to_name'];
		}
		$qry = 'UPDATE ftp_queue SET status = 1 WHERE id='.$value['id'].' AND status=0';
		executeNonQuery($qry);
		$uploadFlash = 0;
		$tryCount = $value['try_count'];
		$srcFileSize = filesize($sourceFile);
		$conversionMsg = "Upload Starts of {$sourceFile}($srcFileSize) to {$destFile}<br/>";
		$startTime = mktime();
		if($value['status'] == 0 || ($value['status'] == 2 && $value['flash_upload'] == 0)) {
			$conversionMsg .= "Flash Folder Start: ". wallTime(mktime()).'<br />';
			$uploadFlash = uploadToFTP($sourceFile, $flashDir, $destFile, $tryCount);
			if($uploadFlash){
				$qry = 'UPDATE ftp_queue SET flash_upload = 1 WHERE id='.$value['id'];
				executeNonQuery($qry);
			} else {
				$conversionMsg .= 'File upload failed on '.($tryCount+1).' Attempt';
				sendConversionEmail('File Upload Fail', $conversionMsg);
				$qry = 'UPDATE ftp_queue SET status = 2, try_count  = try_count +1 WHERE id='.$value['id'];
				executeNonQuery($qry);
				continue;
			}
		} else if($value['status'] == 2 && $value['flash_upload'] == 1){
			$uploadFlash = 1;
		}
		$uploadMobile = 0;
		if($value['status'] == 0 || ($value['status'] == 2 && $value['mobile_upload'] == 0)) {
			$conversionMsg .= "Mobile Folder Start: ". wallTime(mktime()).'<br />';
			$uploadMobile = uploadToFTP($sourceFile, $mobileDir, $destFile, $tryCount);
			if($uploadMobile){
				$qry = 'UPDATE ftp_queue SET mobile_upload = 1 WHERE id='.$value['id'];
				executeNonQuery($qry);
			} else {
				$conversionMsg .= 'File upload failed on '.($tryCount+1).' Attempt';
				sendConversionEmail('File Upload Fail', $conversionMsg);
				$qry = 'UPDATE ftp_queue SET status = 2, try_count  = try_count +1 WHERE id='.$value['id'];
				executeNonQuery($qry);
				continue;
			}
		} else if($value['status'] == 2 && $value['mobile_upload'] == 1){
			$uploadMobile = 1;
		}
		$endTime = mktime();
		$totalTime = $endTime - $startTime;
		$conversionMsg .= 'Upload time in seconds: '. $totalTime.'<br />';
		if($uploadMobile && $uploadFlash){
			$conversionMsg .= 'Upload completed in '.($tryCount + 1).' Attempt(s)';
			sendConversionEmail('File Upload', $conversionMsg);
			@unlink($sourceFile);
			$qry = 'UPDATE ftp_queue SET status = 3, try_count  = try_count +1 WHERE id='.$value['id'];
			executeNonQuery($qry);
		}
	}
	updateVideoStatus();
	updateMusicStatus();
}
function updateVideoStatus()
{
	//Update the video status
	$qry = 'SELECT video.id as ID, IFNULL(upVideo.id, 0) as upID, IFNULL(prevVideo.id, 0) as prevID, 
			video.video as item, video.video_preview as itemPreview, upVideo.type as type
			FROM video 
			INNER JOIN ftp_queue upVideo ON upVideo.type_id=video.id AND upVideo.type_to_name = video.video AND upVideo.status = 3
			LEFT JOIN ftp_queue prevVideo ON prevVideo.type_id=video.id AND prevVideo.type_to_name = video.video_preview 
				AND prevVideo.status = 3
			WHERE video.status=4';
	$result = getResultSet($qry);
	processStatus($result);
	
}
function updateMusicStatus()
{
	//Update the video status
	$qry = 'SELECT music.id as ID, IFNULL(upMusic.id, 0) as upID, IFNULL(prevMusic.id, 0) as prevID, 
			music.track as item, music.track_preview as itemPreview, upMusic.type as type
			FROM music 
			INNER JOIN ftp_queue upMusic ON upMusic.type_id=music.id AND upMusic.type_to_name = music.track AND upMusic.status = 3
			LEFT JOIN ftp_queue prevMusic ON prevMusic.type_id=music.id AND prevMusic.type_to_name = music.track_preview 
				AND prevMusic.status = 3
			WHERE music.status=4';
	$result = getResultSet($qry);
	processStatus($result);
	
}
function processStatus($result)
{
	foreach($result as $value){
		//Check Video is uploaded
		if($value['item'] && $value['upID']){
			//Check Video Preview uploaded
			$updateStatus = false;
			if($value['itemPreview'] == ''){
				$updateStatus = true;
			} else if($value['itemPreview'] && $value['prevID']){
				$updateStatus = true;
			}
			if($updateStatus){
				if($value['type'] == FTP_QUEUE_VIDEO) {
					//$qry = "UPDATE video SET status = 5 WHERE id = " . $value['ID'];//Make video not processed for 20 hours
					$qry = "UPDATE video SET status = 2 WHERE id = " . $value['ID'];
				} else {
					$qry = "UPDATE music SET status = 0 WHERE id = " . $value['ID'];
				}
				executeNonQuery($qry);
				$qry = "UPDATE ftp_queue SET status=4 WHERE id = " . $value['upID'];
				executeNonQuery($qry);
				if($value['prevID']){
					$qry = "UPDATE ftp_queue SET status=4 WHERE id = " . $value['prevID'];
					executeNonQuery($qry);
				}
			}
		}
	}
}
?>