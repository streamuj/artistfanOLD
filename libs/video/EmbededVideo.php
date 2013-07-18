<?php
class EmbededVideo 
{
	public $params;
	function __construct()
	{
		
	}
	/* Get Video Id and Type from link */
	function getVideoId($videoLink)
	{
		$videoId = '';
		$youtubePattern = '#http://www\.youtube.com/#';
		$vimeoPattern = '#http://(www\.)?vimeo.com/#';
		$videoType = 0;
		if(preg_match($youtubePattern, $videoLink)){
			$videoType = 1;
			if(preg_match('#embed/([^?"]+)#', $videoLink, $videoMatch)) {
				$videoId = $videoMatch[1];
			} else if(preg_match('#/user/#', $videoLink)){
				$videoTags = explode('/', $videoLink);
				$videoId = array_pop($videoTags);
			} else if (preg_match('#v=([^?&\#!]*)#', $videoLink, $videoMatch)) {
				$videoId = $videoMatch[1];
			} 
		} elseif(preg_match($vimeoPattern, $videoLink)) {
			$videoType = 2;
			$videoTags = explode('/', $videoLink);
			$videoId = array_pop($videoTags);
		} else {
			$videoId = $videoLink;
			$videoType = 3;
		}
		return array('id'=>$videoId, 'type'=>$videoType);
	}
		
	/* Get Video as iframe object with given width and height */
	function setVideoWidthAndHeight($videoLink, $width, $height, $autoPlay = false)
	{
		$arr = $this->getVideoId($videoLink);
		//list($videoId, $videoType)
		$videoId = $arr['id'];
		$videoType = $arr['type'];
		
		$auto = '';
		if($autoPlay){
			$auto='&amp;autoplay=1';
			$autoStart = '&autoStart=true';
			$autoStartParam = '<param name="autoStart" value="true" />';
		} else {
			$auto='&amp;autoplay=0';
			$autoStart = '&autoStart=false';
			$autoStartParam = '<param name="autoStart" value="false" />';
		}
		if($videoId && $videoType == 1){
			$newFrame = '<iframe width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/'.$videoId.'?wmode=opaque'.$auto.'" frameborder="0" allowfullscreen allowtransparency="true"></iframe>';
		} else if($videoId && $videoType == 2) {
			$newFrame = '<iframe src="http://player.vimeo.com/video/'.$videoId.'?byline=0&amp;portrait=0'.$auto.'" width="'.$width.'" height="'.$height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen allowtransparency="true"></iframe>';
		} else if($videoId && $videoType == 3){
			$newFrame = '<object id="myExperience'.$videoId.'" class="BrightcoveExperience">
                  <param name="bgcolor" value="#000000" />
                  <param name="width" value="'.$width.'" />
                  <param name="height" value="'.$height.'" />
                  <param name="playerID" value="'.$videoId.'" />
                  <param name="playerKey" value="AQ~~,AAABWOeEpiE~,AGzPHSMd9p2Ttfvxd-jzj84Tp3uyPCXJ" />
                  <param name="isVid" value="true" />
                  <param name="isUI" value="true" />
                  <param name="dynamicStreaming" value="true" />
                  <param name="autoStart" value="true" />
      			  <param name="wmode" value="transparent" />
                  <param name="@videoPlayer" value="'.$videoId.'" />
                </object>';
		}
		return $newFrame;
	}
	/* Function to get thumbnail for a given video */
	function getVideoThumbnail($videoLink='', $default = true, $videoId='')
	{
			
		//Get the Video Id from given video Link
		if($videoLink) {
			$arr =  $this->getVideoId($videoLink);
			$videoId = $arr['id'];
			$videoType = $arr['type'];
		}
		if($videoType == 1){
			//Youtube thumbnail url
			$thumbUrl = 'http://img.youtube.com/vi/'. $videoId .'/';
			//Get the default Thumb
			if($default) {
				//Return the default thumb url
				$thumb = $thumbUrl.'default.jpg';
			} else {
				//Get the Big Image
				$thumb = $thumbUrl.'0.jpg';
			}
		} else if ($videoType == 2){
			$hash = unserialize(@file_get_contents("http://vimeo.com/api/v2/video/$videoId.php"));
			if($default){
				$thumb = $hash[0]['thumbnail_medium'];  
			} else {
				$thumb = $hash[0]['thumbnail_small']; 
			}
		}
		return $thumb;
	}
	
}
?>