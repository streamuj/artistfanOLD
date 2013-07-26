<?php
$dirList = getFTPDirectoryList('flash');
$max = 10;
$flows = BroadcastFlows::GetClosedFlows($max);
if(count($dirList) ==1){
	$dirList=preg_split("/[\r|\n]/",$dirList[0]);
}
if($flows){
	foreach($flows as &$flow){
		$flow['date'] = date('m-d-Y.H-i-s', $flow['Pdate']);
		$eventName = $flow['Flow'];
		$eventId = $flow['EventId'];
		$userId = $flow['UserId'];
		$fileCount = 0;
		foreach($dirList as $key => $file){
			if(!$file) continue;
			$match = substr($file, 0, strlen($eventName)) == $eventName;
			
			if($match){
				echo 'Match Found for Event: '. $eventId;
				echo '<hr>';
				$flow['file'][$fileCount++] = $file;
				unset($dirList[$key]);
				EventVideo::Add($file, $flow['UserId'], $flow['EventId'], $flow['Pdate']);
			}
		}
		BroadcastFlows::SetDownloadedFlow($flow['Id']);
	}
}
