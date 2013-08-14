<?php
/**
 * Cron Job for converting videos
 *
 */
GetVideosForProcess();
/* Function get Videos from queue for process */
function GetVideosForProcess()
{
	$limit = 5;
	include_once BPATH.'libs/videoConverter.php';
	$converted_from = array();
	$ids = array();
	//get $limit processed video
	$qry = "SELECT id, from_fname, to_fname FROM " . VTABLE . " WHERE in_proc = 0 AND mp3 = 0 AND status = 0 LIMIT " . $limit;
	$result = getResultSet($qry);
	$converted_from = array();
	if($result){		
		foreach($result as $v)
		{
			$converted_from[] = $v['from_fname'];
			$converted_to[] = $v['to_fname'];
			$ids[] = $v['id'];
		}
		
	}
	for($cnt = 0; $cnt < count($ids); $cnt++){
		$srcFile = VPATH.'source'.DS.$converted_from[$cnt];
		$destFile = VPATH.'result'.DS.'video'.DS.$converted_to[$cnt];
		//Check file already in process or processed
		$result = getResultSet('SELECT * FROM '.VTABLE.' WHERE from_fname="'.$converted_from[$cnt].'"');
		if($result){
			$value = $result[0];
			if($value['in_proc'] == 1 || $value['in_proc'] == 2){
				//File is in process
				if($value['in_proc'] == 1){
					if(!file_exists($srcFile)) {
						//Make File Process as completed
						executeNonQuery("UPDATE  " . VTABLE . " SET in_proc = 2 WHERE id = " . $value['id']);
					} 
				}
				continue;
			} else if($value['status'] > 0) {
				//Error in processing
				continue;
			}
		} else {
			//Queue process for File is completed
			continue;
		}
		$srcFileSize = filesize($srcFile);
		$conversionMsg = "Conversion of {$srcFile} ({$srcFileSize}): to {$destFile}<br/>";
		if(!file_exists($srcFile)) {
			$conversionMsg .= "Conversion Error: {$srcFile} Not Found";
			sendConversionEmail('Conversion Error', $conversionMsg);
			executeNonQuery("UPDATE " . VTABLE . " SET status= 1 WHERE id= ".$ids[$cnt] );
		 	continue;
		 }
		
		$previewFile = VPATH.'result'.DS.'video'.DS.'pre'.$converted_to[$cnt];
		$videoObj = new video($srcFile, $destFile, VIDEO_IMAGE_WIDTH, VIDEO_IMAGE_HEIGHT, FFMPEG_PATH);
		$error = $videoObj->getError();
		if($error){
			$conversionMsg .= "Conversion Error: $error";
			sendConversionEmail('Conversion Error', $conversionMsg);
			executeNonQuery("UPDATE " . VTABLE . " SET status= 1 WHERE id= ".$ids[$cnt] );
			continue;
		}
		$videoObj->setDesingationFileType('mp4');
		$conversionMsg .= "Conversion Start: ". wallTime(mktime())."<br/>";
		executeNonQuery("UPDATE  " . VTABLE . " SET in_proc = 1 WHERE id = " . $ids[$cnt]);
		$videoObj->convertVideo();
		$error = $videoObj->getError();
		if($error){
			$conversionMsg .= "Conversion Error: $error";
			executeNonQuery("UPDATE " . VTABLE . " SET status= 2 WHERE id= ".$ids[$cnt] );
			sendConversionEmail('Conversion Error', $conversionMsg);
			continue;
		}
		$id = $converted_from[$cnt];
		$destFileSize = filesize($destFile);
		$conversionMsg .= "Conversion Ends: ". wallTime(mktime())."<br/>";
		$conversionMsg .= "Converted File Size: {$destFileSize}<br/>";
		sendConversionEmail('Video Conversion', $conversionMsg, $params);
		//create preview video
		//$videoObj->createPreviewVideo($previewFile);
		$imgName = VPATH.'result'.DS.'images'.DS.$converted_from[$cnt].'.jpg';
		$videoObj->createImage($imgName, VIDEO_IMAGE_WIDTH, VIDEO_IMAGE_HEIGHT);
		@unlink($srcFile);
	}
}