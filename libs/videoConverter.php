<?php
class video
{
	private	$srcFile;
	private	$destFile;
	private $destFileType = 'mp4';
	private $destFileExtn = '.mp4'; 
	private	$sourceWidth;
	private $sourceHeight;
	private $audioBitRate;
	private $defaultAudioBitRate = 5000;
	private $audioSampleRate;
	private $bitRateInKb = 750;
	private $duration;
	private $audioSampleRateArray = array(44100, 22050, 11025); //Acceptable audio sample rate for FLV.
	private $movie;
	private $error;
	private $errorFlag = false;
	private $ffmpegPath;
	private $destDimension;
	private $flvToolPath;
	private $videoBitRate;
	function __construct($srcFile, $destFile = '', $destWidth=0, $destHeight=0, $ffmpegPath="/usr/bin/ffmpeg", $flvToolPath='flvtool2')
	{		
		$this->srcFile = $srcFile;
		$this->setFfmpegPath($ffmpegPath);
		$movie = $this->analyzeVideo();
		if(!$movie){
			echo $this->error;
			return false;
		}
		if($destFile){
			$this->destFile = $destFile;
		} else {
			$this->getDesignationFileFromSource();
		}
		$this->sourceWidth = $this->makeMultipleOfTwo($this->sourceWidth);
		$this->sourceHeight = $this->makeMultipleOfTwo($this->sourceHeight);
		$this->duration = floor($this->duration);
		if($destWidth && $destHeight){
			$this->destDimension = $this->makeMultipleOfTwo($destWidth).'x'.$this->makeMultipleOfTwo($destHeight);
		} else {
			$this->destDimension = $this->sourceWidth.'x'.$this->sourceHeight;
		}
		
	}
	function analyzeVideo()
	{
		echo $this->ffmpegPath." -i ".$this->srcFile; 
		echo '<hr>';
		exec($this->ffmpegPath." -i ".$this->srcFile. ' 2>&1', $output, $result);
		
		$output = implode('#', $output);
		if(stristr($output, 'No such file or directory')){
			$this->error = 'No File';
			return false;
		} else if(strstr($output, 'Invalid data found')){
			$this->error = 'Invalid File';
			return false;
		}else if(strstr($output, 'image2')){
			$this->error = 'Image File';
			return false;
		}
		$res = preg_match('/Duration: (\d{2}):(\d{2}):(\d{2})/', $output, $matches);
		$duration = intval($matches[1])* 60 * 60;
		$duration += intval($matches[2])* 60;
		$duration += intval($matches[3])*1;
		echo 'Duration: '. $this->duration = $duration;
		echo '<hr>';
		$dimension = preg_match('/(\d+)x(\d+)/', $output, $dimArr);
		echo 'Width: '.$this->sourceWidth = $dimArr[1];
		echo '<hr>';
		echo 'Height: '.$this->sourceHeight = $dimArr[2];
		/*
		if(!$this->sourceWidth){
			$this->error = 'Invalid Video';
			return false;
		}
		*/
		return true;
	}
	
	/* set ffmpeg path */
	function setFfmpegPath($path='')
	{
		if($path){
			$this->ffmpegPath = $path;
		} else {
			if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
				$this->ffmpegPath = 'c:\\windows\\ffmpeg';
			} else {
				$this->ffmpegPath = '/usr/local/bin/ffmpeg';
			}
		}
	}
	/* Function set designation file type */
	function setDesingationFileType($fileType)
	{
		$this->destFileType = $fileType;
		$this->destFileExtn = $fileType;
	}
	/* Convert video */
	function convertVideo()
	{
		if($this->error) {
			return false;
		}
		if(file_exists($this->destFile)) unlink($this->destFile);
		echo $this->ffmpegPath." -i ".$this->srcFile. 
		" -vcodec libx264".
		" -b:v 500k". 
		" -acodec libfaac -ab 256k".
		//" -acodec libvo_aacenc -ab 256k".
		" -ar 44100 -ac 2 ".
		" -aspect 4:3 ".
		" -crf 22".
		" -f ".$this->destFileType.
		" ".$this->destFile;
		echo '<hr>';
		
		exec($this->ffmpegPath." -i ".$this->srcFile. 
		" -vcodec libx264 ".
		" -b:v 500k". 
		" -acodec libfaac -ab 256k".
		//" -acodec libvo_aacenc -ab 256k".
		" -ar 44100 -ac 2 ".
		" -r 30 ".
		" -aspect 4:3 ".
		" -crf 22".
		" -f ".$this->destFileType.
		" ".$this->destFile. " 2>&1", $output, $return);
		
		echo '<hr>';
		print_r($output);
		echo '<hr>';
		echo $return;
		
		//exec($this->ffmpegPath." -i ".$this->srcFile. ' -strict -2 '. $this->destFile .' 2>&1', $output, $return);
		if($return ){
			$this->error = 'Error in Conversion: ';
			if(is_array($output)){
				$this->error .= implode(' ', $output);
			} 
			return false;
		}
		//Check for the output file created
		if(file_exists($this->destFile)){
			$size = sprintf("%u", filesize($this->destFile));
			if(!$size) {
				$this->error = 'Error In Conversion';
				return false;
			} else {
				return true;
			}
			return true;				
		} else {
			$this->error = 'Error In Conversion';
			return false;
		}
		return true;
	}
	/* Create Preview Video */
	function createPreviewVideo($previewVideoName)
	{
		if($this->duration > 30) {
			$t = '00:00:30';
		} else {
			$t = sprintf('00:00:%02d', $this->duration);
		}
		exec($this->ffmpegPath." -i ".$this->srcFile. 
		" -ss 00:00:00 -t ". $t.
		" -vcodec libx264".
		" -vpre default".
		" -b 250k".
		" -bt 50k ".
		" -acodec libfaac -ab 56k".
		" -crf 22".
		" -s ".$this->destDimension.
		" -map_meta_data ".$previewVideoName.':'.$this->srcFile. 
		" -f ".$this->destFileType.
		" ".$previewVideoName, $output, $return);
	}
	/* Get the images from given video*/
	function createImage($imgName, $imgWidth, $imgHeight)
	{
		$imgDimension = $imgWidth.'x'.$imgHeight;
		/* Calculate half time */
		$duration = intval($this->duration/2);
		$halfDuration = getHourString($duration); //sprintf('%02d:%02d:%02d',  $hour, $minute, $second);
		exec($this->ffmpegPath." -ss ".$duration." -i ".$this->srcFile." -vframes 1 ".$imgName, $output, $return);
		if(file_exists($imgName)){
			$size = sprintf("%u", filesize($imgName));
			if(!$size) {
				$this->error = 'Error In Creating Image';
				return false;
			}
			return true;
		} else {
			$this->error = 'Error In Creating Image';
			return false;
		}
		return true;
	}
	/*Set Designation File */
	function getDesignationFileFromSource()
	{
		$fileNameArr = explode('.', $this->srcFile);
		$extension = array_pop($fileNameArr);
		$fileNameOnly = implode('.', $fileNameArr);
		$destFile = $fileNameOnly.$this->destFileExtn;
		$this->destFile = $destFile;
	}
	/*Fucntion to set Bit Rate of Video*/
	function setBitRateInKb($bitRate)
	{
		$this->bitRateInKb = $bitRate;
	}
	/* Get the value as multipication of 2 */
	function makeMultipleOfTwo($val)
	{
		return $val - ($val % 2);
	}
	/*Get error message*/
	function getError()
	{
		return $this->error;
	}
	
	/* Get Duration String */
	function getDurationString()
	{
		return getHourString($this->duration);
	}
	/* Get Duration */
	function getDuration()
	{
		return $this->duration;
	}
	
	function __destruct(){
	}
	
}
?>