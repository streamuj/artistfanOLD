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
	function __construct($srcFile, $destFile = '', $destWidth=0, $destHeight=0, $ffmpegPath='/usr/local/bin/ffmpeg', $flvToolPath='/usr/bin/flvtool2')
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
		$this->sourceWidth = $this->makeMultipleOfTwo($this->movie->getFrameWidth());
		$this->sourceHeight = $this->makeMultipleOfTwo($this->movie->getFrameHeight());
		$this->audioBitRate = intval($this->movie->getAudioBitRate());
		$this->videoBitRate = intval($this->movie->getVideoBitRate());
		$this->audioSampleRate = $this->movie->getAudioSampleRate();
		$this->duration = floor($this->movie->getduration());
		if($destWidth && $destHeight){
			$this->destDimension = $this->makeMultipleOfTwo($destWidth).'x'.$this->makeMultipleOfTwo($destHeight);
		} else {
			$this->destDimension = $this->sourceWidth.'x'.$this->sourceHeight;
		}
		$this->setAudioSampleRate();
		if(!$this->audioBitRate){
			$this->audioBitRate = $this->defaultAudioBitRate;
		}
		$this->setFfmpegPath($ffmpegPath);
		$this->setFlvToolPath($flvToolPath);
	}
	/* Set flv tool path*/
	function setFlvToolPath($path='')
	{
		if($path){
			$this->flvToolPath = $path;
		} else {
			if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
				$this->flvToolPath = 'c:\\windows\\flvtool2.exe';
			} else {
				$this->flvToolPath = '/usr/bin/flvtool2';
			}
		}
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
		
		/*
		exec($this->ffmpegPath." -i ".$this->srcFile. 
		" -vcodec libx264".
		" -vpre normal".
		" -b 250k". //$this->videoBitRate .
		" -bt 50k ".
		" -acodec libfaac -ab 56k".
		" -crf 22".
		//" -threads 0".
		//" -qmax 10 ".
		" -s ".$this->destDimension.
		" -f ".$this->destFileType.
		" ".$this->destFile. " 2>&1", $output, $return);
		*/
		exec($this->ffmpegPath." -i ".$this->srcFile. ' -strict -2 '. $this->destFile .' 2>&1', $output, $return);
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
				//if($this->destFileType == 'flv') {
				//exec($this->flvToolPath. ' -U '.$this->destFile);
				//}
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
	/*Set the audio sample for the destination file */
	function setAudioSampleRate()
	{
		$audioSampleRate = $this->audioSampleRate;
		foreach($this->audioSampleRateArray as $sampleRate){
			if($audioSampleRate > $sampleRate){
				$audioSampleRate = $sampleRate;
				break;
			}
		}
		//If audion sample rate less than 11025 set
		if(!in_array($audioSampleRate, $this->audioSampleRateArray)){
			$audioSampleRate = $this->audioSampleRateArray[2];
		}
		//$this->audioSampleRate = $audioSampleRate;
		$this->audioSampleRate = 44100;
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
		if($this->movie){
			$this->movie = null;
		}
	}
	
}
?>