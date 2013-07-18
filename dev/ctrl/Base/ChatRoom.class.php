<?php 
/**
 * Chat Room class
 * User: Balakrishnan
 *
 */
class Base_ChatRoom extends Base
{ 
	private $chatFile;
	private $fileName;
    public function __construct($glObj)
    {
        parent :: __construct($glObj);
		if (!$this->mUser->IsAuth())
        {
			uni_redirect( PATH_ROOT . 'base/user/login' );
        }
		$file = _v('file', '');
		if($file == ''){
			$log['error'] = NO_FILE;
			echo json_encode($log);
		 	exit;
		} else {
			$this->fileName = $file;
			$this->chatFile = BPATH.'files/chat/'.$file.'.txt';
		}
    }

    public function getState()
	{
		$lines = 0;
		 if (file_exists($this->chatFile)) {
		   $count = $this->getLinesCount();
		 } else {
		 	$fp = fopen($this->chatFile, 'w');
			fclose($fp);
			//$this->setLineCount(0);
		 }
		 $log['state'] = $lines;
		 echo json_encode($log);
		 exit;
	}
	
	public function updateChat()
	{
		$state = htmlentities(strip_tags(_v('state')), ENT_QUOTES);
    	$file = htmlentities(strip_tags(_v('file')), ENT_QUOTES);
		$finish = mktime() + 20;
		$count = $this->getLinesCount();
		while ($count <= $state) {
			$now = mktime();
			//usleep(10000);
			sleep(1);
			if ($now <= $finish) {
				$count = $this->getLinesCount();
			} else {
				break;	
			}
    	}
		if ($state == $count) {
			$log['state'] = $state;
			$log['t'] = "continue";
		} else {
			$text= array();
			$log['state'] = $count;
			$lines = $this->getLines();
			foreach ($lines as $lineNum => $line) {
				if ($lineNum >= $state) {
					$text[] =  $line = str_replace("\n", "", $line);
				}
				$log['text'] = $text; 
			}
		}
		 echo json_encode($log);
		 exit;
	}
	
	public function getLines()
	{
		 $lines = file($this->chatFile);
		 return $lines;
	}
	public function getLinesCount()
	{
		
		$lines = $this->getLines();
		return count($lines);
		/*
		$count = $this->mCache->get('chat_'.$this->fileName, 4*60*60);
		return $count;
		*/
	}
	
	public function setLineCount($count)
	{
		$this->mCache->set('chat_'.$this->fileName, $count, 4*60*60);
	}
	
	
	
}
