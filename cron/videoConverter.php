<?php
/**
 * Cron Job for converting videos
 *
 */

$trackLength = array();
GetVideosForProcess();
GetProcessedVideo();
updateErrorVideoStatus();
/* Function get Videos from queue for process */
function GetVideosForProcess()
{
	global $conf;
	$gPdo = new PDO(VBASE, $conf['datasources']['artistfan']['connection']['user'], $conf['datasources']['artistfan']['connection']['password']);
	$gPdo->query('SET CHARACTER SET utf8');
	
	$stmnt = $gPdo->query("SELECT id, from_fname, to_fname FROM " . VTABLE . " WHERE in_proc = 1 LIMIT 1");
	if($stmnt)
	{
		$ids = array();
		while ($v = $stmnt->fetch(PDO::FETCH_ASSOC))
		{
			$ids[] = $v['id'];
		}
		unset($stmnt);
		unset($v);
		if(count($ids)){
			die;//Exit the cron job as we already have a running job.
		}
	}

	$limit = 5;
	include_once BPATH.'libs/videoConverter.php';

	$converted_from = array();
	$ids = array();
	global $trackLength;
	//get $limit processed video
	$stmnt = $gPdo->query("SELECT id, from_fname, to_fname FROM " . VTABLE . " WHERE in_proc = 0 AND mp3 = 0 AND status = 0 LIMIT " . $limit);
	if($stmnt)
	{
		$converted_from = array();
		while ($v = $stmnt->fetch(PDO::FETCH_ASSOC))
		{
			$converted_from[] = $v['from_fname'];
			$converted_to[] = $v['to_fname'];
			$ids[] = $v['id'];
		}
		unset($stmnt);
		unset($v);
	}
	for($cnt = 0; $cnt < count($ids); $cnt++){
		$srcFile = VPATH.'source'.DS.$converted_from[$cnt];
		if(!file_exists($srcFile)) {
			$gPdo->query("UPDATE " . VTABLE . " SET status= 1 WHERE id= ".$ids[$cnt] );
		 	continue;
		 }
		$destFile = VPATH.'result'.DS.'video'.DS.$converted_to[$cnt];
		$previewFile = VPATH.'result'.DS.'video'.DS.'pre'.$converted_to[$cnt];
		$videoObj = new video($srcFile, $destFile, VIDEO_IMAGE_WIDTH, VIDEO_IMAGE_HEIGHT);
		$error = $videoObj->getError();
		if($error){
			$gPdo->query("UPDATE " . VTABLE . " SET status= 1 WHERE id= ".$ids[$cnt] );
			continue;
		}
		$videoObj->setDesingationFileType('mp4');
		$gPdo->query("UPDATE  " . VTABLE . " SET in_proc = 1 WHERE id = " . $ids[$cnt]);
		$videoObj->convertVideo();
		$error = $videoObj->getError();
		if($error){
			$gPdo->query("UPDATE " . VTABLE . " SET status= 2 WHERE id= ".$ids[$cnt] );
			continue;
		}
		$id = $converted_from[$cnt];
		$trackLength[$id] = $videoObj->getDurationString();
		//create preview video
		//$videoObj->createPreviewVideo($previewFile);
		$imgName = VPATH.'result'.DS.'images'.DS.$converted_from[$cnt].'_15.jpg';
		$videoObj->createImage($imgName, VIDEO_IMAGE_WIDTH, VIDEO_IMAGE_HEIGHT);
		if(!$error) {
			$gPdo->query("UPDATE  " . VTABLE . " SET in_proc = 2 WHERE id = " . $ids[$cnt]);
			@unlink($srcFile);
		}
	}
}
/* Function to update error status indicate user as error in processing the video */
function updateErrorVideoStatus()
{
	$conf = include(BPATH . 'dev/db/build/conf/artistfan-conf.php');
	//connect to vc base
	$gPdo = new PDO(VBASE, $conf['datasources']['artistfan']['connection']['user'], $conf['datasources']['artistfan']['connection']['password']);
	$gPdo->query('SET CHARACTER SET utf8');
	$stmnt = $gPdo->query("SELECT id, from_fname, to_fname FROM " . VTABLE . " WHERE (status = 1 OR status = 2) AND mp3 = 0");
	if($stmnt)
	{
		$converted_from = array();
		while ($v = $stmnt->fetch(PDO::FETCH_ASSOC))
		{
			$converted_from[] = $v['from_fname'];
			$ids[] = $v['id'];
		}
		unset($stmnt);
		unset($v);
	}
	if(count($converted_from) > 0)
	{
		foreach($converted_from as $item) {   
			$stmnt = $gPdo->query("SELECT * FROM video WHERE video = '" . $item . "' OR video_preview = '" . $item . "'");
			if($stmnt) {
				$v = $stmnt->fetch(PDO::FETCH_ASSOC);
				if($item == $v['video_preview'] || $item = $v['video']){
					$gPdo->query("UPDATE video SET status = 3 WHERE id = " . $v['id']);
				}
				unset($stmnt);
				unset($v);
				$srcFile = VPATH.'source'.DS.$item;
				@unlink($srcFile);
			}
		}
		$gPdo->query("DELETE FROM " . VTABLE . " WHERE id IN(" . implode(', ', $ids) . ")");
		unset($item);
	}
	$gPdo = null;
}
/* Function to upload the video to ftp from the server */
function GetProcessedVideo()
{
	$conf = include(BPATH . 'dev/db/build/conf/artistfan-conf.php');
	global $trackLength;
	//connect to vc base
	$gPdo = new PDO(VBASE, $conf['datasources']['artistfan']['connection']['user'], $conf['datasources']['artistfan']['connection']['password']);
	$gPdo->query('SET CHARACTER SET utf8');

	$limit = 10;

	$converted_from = array();
	$ids = array();
	
	//get $limit processed video
	$stmnt = $gPdo->query("SELECT id, from_fname, to_fname FROM " . VTABLE . " WHERE in_proc = 2 AND mp3 = 0 LIMIT " . $limit);
	if($stmnt)
	{
		while ($v = $stmnt->fetch(PDO::FETCH_ASSOC))
		{
			$converted_from[] = $v['from_fname'];
			$ids[] = $v['id'];
		}
		unset($stmnt);
		unset($v);

		if(count($ids) > 0)
		{
			//delete found records from queue
			$gPdo->query("DELETE FROM " . VTABLE . " WHERE id IN(" . implode(', ', $ids) . ")");
		}
	}
	$gPdo = null;

	if(count($converted_from) > 0)
	{
		
		//connect to artistfan base
		$gPdo = new PDO($conf['datasources']['artistfan']['connection']['dsn'], $conf['datasources']['artistfan']['connection']['user'], $conf['datasources']['artistfan']['connection']['password']);
		$gPdo->query('SET CHARACTER SET utf8');

		include_once BPATH . 'libs/Crop/Image_Transform.php';
		include_once BPATH . 'libs/Crop/Image_Transform_Driver_GD.php';
		foreach($converted_from as $item)
		{   
			//select video from video table
			$stmnt = $gPdo->query("SELECT * FROM video WHERE video = '" . $item . "' OR video_preview = '" . $item . "'");
			if($stmnt)
			{
				$v = $stmnt->fetch(PDO::FETCH_ASSOC);
				if($item == $v['video_preview'])
				{
					$mp4VideoName = substr($v['video_preview'], 0, strrpos($v['video_preview'], '.')).'.mp4';
					$videoName = $v['video_preview'].'.mp4';
					//move processed file
					$dir = MakeUserDir('files'.DS.'video'.DS.'u', $v['user_id'], BPATH);
					copy(VPATH . 'result'.DS.'video'.DS. $videoName, BPATH . $dir . DS. $mp4VideoName);
					@unlink(VPATH . 'result'.DS.'video'.DS. $videoName);
					
					
					$srcVideo = BPATH.'files'.DS.'video'.DS.'u'.DS. $v['user_id']. DS. $mp4VideoName;
					uploadVideoToFTP($v['user_id'], $srcVideo, $mp4VideoName);

					//update record in video table
					//check processed main video file
					$mainVideo = substr($v['video'], 0, strrpos($v['video'], '.')).'.mp4';
					if(file_exists(BPATH . $dir . DS. $mainVideo))
					{
						//set status equal 2
						$gPdo->query("UPDATE video SET video_preview = '" . $mp4VideoName . "', status = 2 WHERE id = " . $v['id']);
					}
					else
					{
						//update only filename
						$gPdo->query("UPDATE video SET video_preview = '" . $mp4VideoName . "' WHERE id = " . $v['id']);
					}
				} else if($item == $v['video']) {
					$videoLength = $trackLength[$item];
					$mp4VideoName = substr($v['video'], 0, strrpos($v['video'], '.')).'.mp4';
					$videoName = $v['video'].'.mp4';

					//move processed file
					$dir = MakeUserDir('files'.DS.'video'.DS.'u', $v['user_id'], BPATH);
				  
					//copy(VPATH . 'result'.DS.'video'.DS. $videoName, BPATH . $dir . DS. $mp4VideoName);
					

					//move thumbnail image
					$dir_th = MakeUserDir('files'.DS.'video'.DS.'thumbnail', $v['user_id'], BPATH);
					copy(VPATH . 'result'.DS.'images'.DS. $v['video'] . '_15.jpg', BPATH . $dir_th . DS. $mp4VideoName . '.jpg');
					@unlink(VPATH . 'result'.DS.'images'.DS. $v['video'] . '_15.jpg');
					
					$srcVideo = BPATH.'files'.DS.'video'.DS.'u'.DS. $v['user_id']. DS. $mp4VideoName;
					
					uploadVideoToFTP($v['user_id'], $srcVideo, $mp4VideoName);
					
					@unlink(VPATH . 'result'.DS.'video'.DS. $videoName);

					//make preview of image 96x96
					i_crop_copy(VIDEO_MEDIUM_IMAGE_WIDTH, VIDEO_MEDIUM_IMAGE_HEIGHT, BPATH . $dir_th . DS. $mp4VideoName . '.jpg', BPATH . $dir_th . DS.'s_' . $mp4VideoName . '.jpg', 1);
					//make small preview of image 22x22
					i_crop_copy(VIDEO_THUMB_IMAGE_WIDTH, VIDEO_THUMB_IMAGE_HEIGHT, BPATH . $dir_th . DS.'s_' . $mp4VideoName . '.jpg',	BPATH . $dir_th . DS.'x_' . $mp4VideoName . '.jpg', 1);

					//update record in video table
					//check processed preview video file
					if(!empty($v['video_preview']))
					{
						$previewVideo = substr($v['video_preview'], 0, strrpos($v['video_preview'], '.')).'.mp4';
						if(file_exists(BPATH . $dir . DS. $previewVideo))
						{
							//set status equal 2 //preview video and video converted
							$gPdo->query("UPDATE video SET video = '" . $mp4VideoName . "', video_length = '".$videoLength."', status = 2 WHERE id = " . $v['id']);
						}
						else
						{
							//update only filename Video only converted
							$gPdo->query("UPDATE video SET video = '" . $mp4VideoName . "'video_length = '".$videoLength."' WHERE id = " . $v['id']);
						}
					}
					else
					{
						// no preview video and video converted.
						$gPdo->query("UPDATE video SET video = '" . $mp4VideoName . "', video_length = '".$videoLength."', status = 2 WHERE id = " . $v['id']);
					}
				}
			}
			unset($stmnt);
			unset($v);
		}
		unset($item);
		$gPdo = null;
	}
	//echo 'Complete';
}

/* Function to upload video to ftp */
function uploadVideoToFTP($userId, $srcVideo, $videoName)
{
	include_once BPATH . 'libs/ftp/ftp.class.php';
	$flashDir = '/flash/u/'. $userId;
	$mobileDir = '/mobile/u/'.$userId;
	$updateFlash = uploadCurlFileToFTP($srcVideo, $flashDir.'/'.$videoName);
	if($updateFlash) {
		$updateMobile = uploadCurlFileToFTP($srcVideo, $mobileDir.'/'.$videoName);
	}
	if($updateFlash && $updateMobile) {
		return true;
	} 
	return false;
}