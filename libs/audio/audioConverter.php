<?php
class audioConverter
{
	private	$srcFile;
	private	$destFile;
	private $destFileType = 'mp3';
	private $destFileExtn = '.mp3'; 
	private $audioBitRate;
	private $audioSampleRate;
	private $duration;
	private $movie;
	private $error;
	private $errorFlag = false;
	private $ffmpegPath;
	function __construct($srcFile, $destFile = '', $ffmpegPath='/usr/bin/ffmpeg')
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
		$this->duration = floor($this->duration);
		if($destFile){
			$this->destFile = $destFile;
		} else {
			$this->getDesignationFileFromSource();
		}
	}
	function analyzeVideo()
	{
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
		$this->duration = $duration;
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
				$this->ffmpegPath = '/usr/bin/ffmpeg';
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
	function convert()
	{
		if($this->error) {
			return false;
		}
		if(file_exists($this->destFile)) unlink($this->destFile);
		
		exec($this->ffmpegPath.' -i '.$this->srcFile. 
		' -acodec libmp3lame -ab 320k -ac 2 -ar 44100 -vn '.
		//' -map_meta_data '.$this->destFile.':'.$this->srcFile. 
		' -f mp3 '.$this->destFile, $output, $return);
		
		//Check for the output file created
		if($return ){
			$this->error = 'Error in Conversion: ';
			if(is_array($output)){
				$this->error .= implode(' ', $output);
			} 
			return false;
		}
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
	
	/*Set Designation File */
	function getDesignationFileFromSource()
	{
		$fileNameArr = explode('.', $this->srcFile);
		$extension = array_pop($fileNameArr);
		$fileNameOnly = implode('.', $fileNameArr);
		$destFile = $fileNameOnly.$this->destFileExtn;
		$this->destFile = $destFile;
	}
	/*Get error message*/
	function getError()
	{
		return $this->error;
	}
	/* Get the images from given video*/
	function createImage($imgName, $imgWidth, $imgHeight)
	{
		$imgDimension = $imgWidth.'x'.$imgHeight;
		/* Calculate half time */
		$duration = intval($this->duration/2);
		$halfDuration = getHourString($duration);
		exec($this->ffmpegPath." -i ".$this->srcFile." -s ".$imgDimension." -ss ".$halfDuration." -t 00:00:01 ".$imgName, $output, $return);
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
	
	function __destruct(){
	}
}
?>