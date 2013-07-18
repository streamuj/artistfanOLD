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
	function __construct($srcFile, $destFile = '', $ffmpegPath='/usr/local/bin/ffmpeg')
	{
		if(function_exists('ffmpeg_movie')){
			$this->error = 'ffmpeg extension not loaded';
			return false;
		}
		$this->movie = new ffmpeg_movie($srcFile);
		if(!$this->movie){
			$this->error = 'File is not supported for conversion';
			return false;
		}
		$this->srcFile = $srcFile;
		if($destFile){
			$this->destFile = $destFile;
		} else {
			$this->getDesignationFileFromSource();
		}
		$this->audioBitRate = intval($this->movie->getAudioBitRate());
		$this->audioSampleRate = $this->movie->getAudioSampleRate();
		$this->duration = floor($this->movie->getduration());
		$this->setFfmpegPath($ffmpegPath);
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
		' -acodec libmp3lame -ab 320k -vn'.
		' -map_meta_data '.$this->destFile.':'.$this->srcFile. 
		' -f mp3 '.
		$this->destFile, $output, $return);
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
		if($this->movie){
			$this->movie = null;
		}
	}
}
?>