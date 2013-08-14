<?php
/**
 * Cron Job for converting tracks
 *
 */
require_once('cronHeader.php');
GetAudiosForProcess();
function GetAudiosForProcess()
{
	$limit = 5;
	include_once BPATH.'libs/audio/audioConverter.php';
	$converted_from = array();
	$ids = array();
	//get $limit processed video
	$result = getResultSet("SELECT id, from_fname, to_fname FROM " . VTABLE . " WHERE in_proc = 0 AND mp3 = 1 AND status = 0 LIMIT " . $limit);
	if($result)
	{
		foreach($result as $v)
		{
			$converted_from[] = $v['from_fname'];
			$converted_to[] = $v['to_fname'];
			$ids[] = $v['id'];
		}
	}
	$ds = DIRECTORY_SEPARATOR;
	for($cnt = 0; $cnt < count($ids); $cnt++){
		$srcFile = VPATH.'source'.DS.$converted_from[$cnt];
		$destFile = VPATH.'result'.DS.'track'.DS.$converted_to[$cnt];
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
			sendConversionEmail('Audio Conversion Error', $conversionMsg);
			executeNonQuery("UPDATE " . VTABLE . " SET status= 1 WHERE id= ".$ids[$cnt] );
		 	continue;
		 }
		$srcFileSize = filesize($srcFile);
		$audioObj = new audioConverter($srcFile, $destFile, FFMPEG_PATH);
		$error = $audioObj->getError();
		if($error){
			$conversionMsg .= 'Conversion Error : '. $error ."<br />";
			sendConversionEmail('Audio Conversion Error', $conversionMsg);
			executeNonQuery("UPDATE " . VTABLE . " SET status= 1 WHERE id= ".$ids[$cnt] );
			continue;
		}
		executeNonQuery("UPDATE  " . VTABLE . " SET in_proc = 1 WHERE id = " . $ids[$cnt]);
		$conversionMsg .= "Conversion Start: ". wallTime(getEstTime())."<br/>";
		$audioObj->convert();
		$error = $audioObj->getError();
		if($error){
			$conversionMsg .= "Conversion Error: $error";
			executeNonQuery("UPDATE " . VTABLE . " SET status= 2 WHERE id= ".$ids[$cnt] );
			sendConversionEmail('Audio Conversion Error', $conversionMsg);
			continue;
		}
		$destFileSize = filesize($destFile);
		$conversionMsg .= "Conversion Ends: ". wallTime(getEstTime())."<br />";
		$conversionMsg .= "Converted File Size: {$destFileSize}<br />";
		sendConversionEmail('Audio Conversion', $conversionMsg);
		$id = $converted_from[$cnt];
		@unlink($srcFile);
	}
}