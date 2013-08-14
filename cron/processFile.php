<?php
require_once('cronHeader.php');

updateErrorStatus();
UpdateProcessVideo();
GetProcessedVideo();
GetProcessedAudio();

/* Function to update error status indicate user as error in processing the video */
function updateErrorStatus()
{
	$qry = "SELECT id, from_fname, to_fname FROM " . VTABLE . " WHERE (status = 1 OR status = 2)";
	$result = getResultSet($qry);
	$converted_from = array();
	if($result)
	{
		foreach ($result as $v )
		{
			$item = $v['from_fname'];
			$id = $v['id'];
			if($v['mp3'] == 0){
				$qry = "SELECT * FROM video WHERE video = '" . $item . "' OR video_preview = '" . $item . "'";
				$video = getResultSet($qry);
				if($video) {
					$vd = $video[0];
					if($item == $vd['video_preview'] || $item = $vd['video']){
						executeNonQuery("UPDATE video SET status = 3 WHERE id = " . $id);
						$srcFile = VPATH.'source'.DS.$item;
						@unlink($srcFile);
					}
				}	
			} else {
				$stmnt = getResultSet("SELECT * FROM music WHERE track = '" . $item . "' OR track_preview = '" . $item . "'");
				if($stmnt) {
					$ad = $stmnt[0];
					if($item == $ad['track'] || $item = $ad['track_preview']){
						executeNonQuery("UPDATE music SET status = 3 WHERE id = " . $id);
						$srcFile = VPATH.'source'.DS.$item;
						@unlink($srcFile);
					}
				}
			}
			$qry = "DELETE FROM " . VTABLE . " WHERE id = {$id}";
			executeNonQuery($qry);
		}
	}
}

function UpdateProcessVideo()
{
	$qry = 'UPDATE video SET status= 2 WHERE status=5 AND TIMESTAMPDIFF(HOUR, from_unixtime(pdate), Now())=21';
	executeNonQuery($qry);
	return true;
}

function GetProcessedVideo()
{
	$limit = 5;
	$qry = "SELECT id, from_fname, to_fname, in_proc FROM " . VTABLE . " WHERE in_proc=1 AND mp3 = 0 AND status = 0 LIMIT " . $limit;
	$prVideo = getResultSet($qry);
	foreach($prVideo as $value){
		$srcFile = VPATH.'source'.DS.$value['from_fname'];	
		if(!file_exists($srcFile)) {
			//Make File Process as completed
			executeNonQuery("UPDATE  " . VTABLE . " SET in_proc = 2 WHERE id = " . $value['id']);
		} 
	}
	$converted_from = array();
	$ids = array();
	
	//get $limit processed video
	$rslt = getResultSet("SELECT id, from_fname, to_fname FROM " . VTABLE . " WHERE in_proc = 2 AND mp3 = 0 LIMIT " . $limit);
	if($rslt)
	{
		foreach ($rslt as  $v)
		{
			$converted_from[] = $v['from_fname'];
			$ids[] = $v['id'];
		}
		if(count($ids) > 0)
		{
			//delete found records from queue
			executeNonQuery("DELETE FROM " . VTABLE . " WHERE id IN(" . implode(', ', $ids) . ")");
		}
	}

	if(count($converted_from) > 0)
	{
		include_once BPATH . 'libs/Crop/Image_Transform.php';
		include_once BPATH . 'libs/Crop/Image_Transform_Driver_GD.php';
		foreach($converted_from as $item)
		{   
			//select video from video table
			$result = getResultSet("SELECT * FROM video WHERE video = '" . $item . "' OR video_preview = '" . $item . "'");
			if($result)
			{
				$v = $result[0];
				$mp4VideoName = substr($item, 0, strrpos($item, '.')).'.mp4';
				$videoName = $item.'.mp4';
				//move processed file
				$dir = MakeUserDir('files'.DS.'video'.DS.'u', $v['user_id'], BPATH);
				copy(VPATH . 'result'.DS.'video'.DS. $videoName, BPATH . $dir . DS. $mp4VideoName);
				$srcVideo = VPATH . 'result'.DS.'video'.DS. $videoName;
				
				insertFTPQueue(FTP_QUEUE_VIDEO, $v['id'], $videoName, $mp4VideoName, $v['user_id']);
				if($item == $v['video_preview']) {
					executeNonQuery("UPDATE video SET video_preview = '" . $mp4VideoName . "', status = 4 WHERE id = " . $v['id']);
				} else if($item == $v['video']){
					require_once BPATH.'libs/videoConverter.php';
					$videoObj = new video($srcVideo, $srcVideo, VIDEO_IMAGE_WIDTH, VIDEO_IMAGE_HEIGHT, FFMPEG_PATH);
					$videoLength = $videoObj->getDurationString();
					//move thumbnail image
					$dir_th = MakeUserDir('files'.DS.'video'.DS.'thumbnail', $v['user_id'], BPATH);
					copy(VPATH . 'result'.DS.'images'.DS. $v['video'] . '.jpg', BPATH . $dir_th . DS. $mp4VideoName . '.jpg');
					@unlink(VPATH . 'result'.DS.'images'.DS. $v['video'] . '.jpg');
					//make image previews
					i_crop_copy(VIDEO_MEDIUM_IMAGE_WIDTH, VIDEO_MEDIUM_IMAGE_HEIGHT, BPATH . $dir_th . DS. $mp4VideoName . '.jpg', BPATH . $dir_th . DS.'s_' . $mp4VideoName . '.jpg', 1);
					i_crop_copy(VIDEO_THUMB_IMAGE_WIDTH, VIDEO_THUMB_IMAGE_HEIGHT, BPATH . $dir_th . DS.'s_' . $mp4VideoName . '.jpg',	BPATH . $dir_th . DS.'x_' . $mp4VideoName . '.jpg', 1);
					executeNonQuery("UPDATE video SET video = '" . $mp4VideoName . "', video_length = '".$videoLength."', status = 4 WHERE id = " . $v['id']);
					
				}
			}
		}
	}
}

function GetProcessedAudio()
{
	$limit = 5;
	$qry = "SELECT id, from_fname, to_fname, in_proc FROM " . VTABLE . " WHERE in_proc=1 AND mp3 = 1 AND status = 0 LIMIT " . $limit;
	$prVideo = getResultSet($qry);
	foreach($prVideo as $value){
		$srcFile = VPATH.'source'.DS.$value['from_fname'];	
		if(!file_exists($srcFile)) {
			//Make File Process as completed
			executeNonQuery("UPDATE  " . VTABLE . " SET in_proc = 2 WHERE id = " . $value['id']);
		} 
	}
	$converted_from = array();
	$ids = array();
	
	//get $limit processed video
	$stmnt = getResultSet("SELECT id, from_fname, to_fname FROM " . VTABLE . " WHERE in_proc = 2 LIMIT " . $limit);
	if($stmnt)
	{
		foreach( $stmnt as $v )
		{
			$converted_from[] = $v['from_fname'];
			$ids[] = $v['id'];
		}
		if(count($ids) > 0)
		{
			//delete found records from queue
			executeNonQuery("DELETE FROM " . VTABLE . " WHERE id IN(" . implode(', ', $ids) . ")");
		}
	}
	if(count($converted_from) > 0)
	{
		foreach($converted_from as $count => $item)
		{
			//select video from video table
			$stmnt = getResultSet("SELECT * FROM music WHERE track = '" . $item . "' OR track_preview = '" . $item . "'");
			if($stmnt)
			{
				$v = $stmnt[0];
				$trackMp3Name = substr($item, 0, strrpos($item, '.')).'.mp3';
				$trackName = $item.'.mp3';
				$dir = MakeUserDir('files'.DS.'track'.DS.'u', $v['user_id'], BPATH);
				$srcFile = VPATH . 'result'.DS.'track'.DS. $trackName;
				@copy($srcFile, BPATH . $dir . DS. $trackMp3Name);
				insertFTPQueue(FTP_QUEUE_MUSIC, $v['id'], $trackName, $trackMp3Name, $v['user_id']);
				if($item == $v['track_preview']) {
					executeNonQuery("UPDATE music SET track_preview = '" . $trackMp3Name . "', status = 4 WHERE id = " . $v['id']);
				} else if($item == $v['track']){
					if($trackLength[$item]) {
						$audioLength = $trackLength[$item];
					} else {
						require_once BPATH.'libs/audio/audioConverter.php';
						$audioObj = new audioConverter($srcFile, $srcFile, FFMPEG_PATH);
						$audioLength = $audioObj->getDurationString();
					}
					executeNonQuery("UPDATE music SET track = '" . $trackMp3Name . "', track_length = '".$audioLength."', status = 4 WHERE id = " . $v['id']);
				}
			}
		}
	}
}

?>