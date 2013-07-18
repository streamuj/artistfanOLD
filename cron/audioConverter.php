<?php
/**
 * Cron Job for converting tracks
 *
 */
GetAudiosForProcess();
GetProcessedAudio();
updateErrorStatus();
$trackLength = array();
function GetAudiosForProcess()
{
	global $conf;
	$gPdo = new PDO(VBASE, $conf['datasources']['artistfan']['connection']['user'], $conf['datasources']['artistfan']['connection']['password']);
	$gPdo->query('SET CHARACTER SET utf8');

	$limit = 5;
	include_once BPATH.'libs/audio/audioConverter.php';

	$converted_from = array();
	$ids = array();
	global $trackLength;
	//get $limit processed video
	$stmnt = $gPdo->query("SELECT id, from_fname, to_fname FROM " . VTABLE . " WHERE in_proc = 0 AND mp3 = 1 AND status = 0 LIMIT " . $limit);
	if($stmnt)
	{
		while ($v = $stmnt->fetch(PDO::FETCH_ASSOC))
		{
			$converted_from[] = $v['from_fname'];
			$converted_to[] = $v['to_fname'];
			$ids[] = $v['id'];
		}
		unset($stmnt);
		unset($v);
	}
	$ds = DIRECTORY_SEPARATOR;
	for($cnt = 0; $cnt < count($ids); $cnt++){
		$srcFile = VPATH.'source'.DS.$converted_from[$cnt];
		if(!file_exists($srcFile)) {
			$gPdo->query("UPDATE " . VTABLE . " SET status= 1 WHERE id= ".$ids[$cnt] );
		 	continue;
		 }
		$destFile = VPATH.'result'.DS.'track'.DS.$converted_to[$cnt];
		$audioObj = new audioConverter($srcFile, $destFile);
		$error = $audioObj->getError();
		if($error){
			$gPdo->query("UPDATE " . VTABLE . " SET status= 1 WHERE id= ".$ids[$cnt] );
			continue;
		}
		$gPdo->query("UPDATE  " . VTABLE . " SET in_proc = 1 WHERE id = " . $ids[$cnt]);
		$audioObj->convert();
		$error = $audioObj->getError();
		if($error){
			$gPdo->query("UPDATE " . VTABLE . " SET status= 2 WHERE id= ".$ids[$cnt] );
			continue;
		}
		$id = $converted_from[$cnt];
		$trackLength[$id] = $audioObj->getDurationString();
		$error = $audioObj->getError();
		if($error){
			$gPdo->query("UPDATE " . VTABLE . " SET status= 3 WHERE id= ".$ids[$cnt] );
			continue;
		}
		$gPdo->query("UPDATE  " . VTABLE . " SET in_proc = 2 WHERE id = " . $ids[$cnt]);
		@unlink($srcFile);
	}
}

/* Function to update error status indicate user as error in processing the audio */
function updateErrorStatus()
{
	$conf = include(BPATH . 'dev/db/build/conf/artistfan-conf.php');
	//connect to vc base
	$gPdo = new PDO(VBASE, $conf['datasources']['artistfan']['connection']['user'], $conf['datasources']['artistfan']['connection']['password']);
	$gPdo->query('SET CHARACTER SET utf8');
	$stmnt = $gPdo->query("SELECT id, from_fname, to_fname FROM " . VTABLE . " WHERE (status = 1 OR status = 2) AND mp3 = 1");
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
			$stmnt = $gPdo->query("SELECT * FROM music WHERE track = '" . $item . "' OR track_preview = '" . $item . "'");
			if($stmnt) {
				$v = $stmnt->fetch(PDO::FETCH_ASSOC);
				if($item == $v['track'] || $item = $v['track_preview']){
					$gPdo->query("UPDATE music SET status = 3 WHERE id = " . $v['id']);
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

function GetProcessedAudio()
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
	$stmnt = $gPdo->query("SELECT id, from_fname, to_fname FROM " . VTABLE . " WHERE in_proc = 2 LIMIT " . $limit);
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

		foreach($converted_from as $count => $item)
		{   
			//select video from video table
			$stmnt = $gPdo->query("SELECT * FROM music WHERE track = '" . $item . "' OR track_preview = '" . $item . "'");
			if($stmnt)
			{
				$v = $stmnt->fetch(PDO::FETCH_ASSOC);
				$audioLength = $trackLength[$item];
				if($item == $v['track_preview'])
				{
					$trackMp3Name = substr($v['track_preview'], 0, strrpos($v['track_preview'], '.')).'.mp3';
					$trackName = $v['track_preview'].'.mp3';
					//move processed file
					$dir = MakeUserDir('files'.DS.'track'.DS.'u', $v['user_id'], BPATH);
					copy(VPATH . 'result'.DS.'track'.DS. $trackName, BPATH . $dir . DS. $trackMp3Name);
					@unlink(VPATH . 'result'.DS.'track'.DS. $trackName);
					
					$strTrack = BPATH.'files'.DS.'track'.DS.'u'.DS. $v['user_id']. DS. $trackMp3Name;
					uploadTrackToFTP($v['user_id'], $strTrack, $trackMp3Name);

					//update record in track table
					//check processed main track file
					$mainTrack = substr($v['track'], 0, strrpos($v['track'], '.')).'.mp3';
					if(file_exists(BPATH . DS. $dir . DS. $mainTrack))
					{
						//set status equal 2
						$gPdo->query("UPDATE music SET track_preview = '" . $trackMp3Name . "', track_preview_length = '".$audioLength."', status = 0 WHERE id = " . $v['id']);
					}
					else
					{
						//update only filename
						$gPdo->query("UPDATE music SET track_preview = '" . $trackMp3Name . "', track_preview_length = '".$audioLength."' WHERE id = " . $v['id']);
					}
				}
				else if($item == $v['track'])
				{
					$trackMp3Name = substr($v['track'], 0, strrpos($v['track'], '.')).'.mp3';
					$trackName = $v['track'].'.mp3';

					//move processed file
					$dir = MakeUserDir('files'.DS.'track'.DS.'u', $v['user_id'], BPATH);
				  
					@copy(VPATH . 'result'.DS.'track'.DS. $trackName, BPATH . $dir . DS. $trackMp3Name);
					@unlink(VPATH . 'result'.DS.'track'.DS. $trackName);
					
					$strTrack = BPATH.'files'.DS.'track'.DS.'u'.DS. $v['user_id']. DS. $trackMp3Name;

					uploadTrackToFTP($v['user_id'], $strTrack, $trackMp3Name);

					//update record in track table
					//check processed preview track file
					if(!empty($v['track_preview']))
					{
						$previewTrack = substr($v['track_preview'], 0, strrpos($v['track_preview'], '.')).'.mp3';
						if(file_exists(BPATH .  $dir . DS. $previewTrack))
						{
							//set status equal 0
							$gPdo->query("UPDATE music SET track= '" . $trackMp3Name . "', track_length = '".$audioLength."', status = 0 WHERE id = " . $v['id']);
						}
						else
						{
							//update only filename
							$gPdo->query("UPDATE music SET track = '" . $trackMp3Name . "', track_length = '".$audioLength."' WHERE id = " . $v['id']);
						}
					}
					else
					{
						$gPdo->query("UPDATE music SET track = '" . $trackMp3Name . "', track_length = '".$audioLength."', status = 0 WHERE id = " . $v['id']);
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

/* Function to upload track to ftp */
function uploadTrackToFTP($userId, $strTrack, $trackName)
{
	//include_once BPATH . 'libs/ftp/ftp.class.php';
	$flashDir = '/flash/track/u/'. $userId;
	$mobileDir = '/mobile/track/u/'.$userId;
	$updateFlash = uploadCurlFileToFTP($strTrack, $flashDir.'/'.$trackName);
	if($updateFlash) {
		$updateMobile = uploadCurlFileToFTP($strTrack, $flashDir.'/'.$trackName);
	}
	if($updateFlash && $updateMobile) {
		return true;
	} 
	return false;
}