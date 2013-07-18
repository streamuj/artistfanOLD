<?php
/**
 * User profile class
 * User: ssergy
 * Date: 14.12.11
 * Time: 21:40
 *
 */
    
class Base_Download extends Base
{
    public function __construct($glObj)
    {
        parent :: __construct($glObj);
           
        if (!$this->mUser->IsAuth())
        {
            uni_redirect( PATH_ROOT . 'base/user/login' );
        }
        
    }
	
	public function Index()
	{}

	public function DownloadContent($file)
	{
		$fsize = filesize($file);
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private", false);
		header("Content-type: application/zip;");
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");
		header("Content-Disposition: attachment; filename=\"" . basename($file) . "\";" );
		header("Content-Transfer-Encoding: binary");
		header("Content-Length: " . $fsize);

		readfile($file);
		exit;
	}
	
	public function DownloadMusic()
	{
		$url = html_entity_decode( _v('file', ''));
		$urlParts = explode('/', $url);
		if(stristr($url, STREAMING_HTML5_VOD)){
			array_pop($urlParts);
		}
		$fileName = array_pop($urlParts);
		$user = array_pop($urlParts);
		$music = Music::getMusicByFile($fileName, $user);
		if(empty($music) || $music['Status']!=0){
			die( FILE_NOT_FOUND );
		}
		$filepath = BPATH .$music['Track'];
		if(!file_exists($filepath))
		{
			die( FILE_NOT_FOUND );
		}
		if(!$this->mUser->CheckAdminStatus())
		{
			if (!empty($music['Price']) && $this->mUser->IsAuth() && $music['UserId'] != $this->mUser->mUserInfo['Id'])
			{
				$fanId = $this->mUser->mUserInfo['Id'];
				$musicPurchase = MusicPurchase::Get($fanId, $id);
				if(!$musicPurchase) {
					$musicPurchase = Music::GetMusicListWithPurchase($music['UserId'], $fanId, $music['AlbumId']);
				}
				if(!$musicPurchase)
				{
					die( FILE_NOT_FOUND );
				}
			}
		}
		$this->DownloadContent($filepath);
		
		/*
		$file = BPATH.$music['Track'];
		$curl = curl_init();
		$file = fopen($file, 'w');
		curl_setopt($curl, CURLOPT_URL, "ftp://".STREAMING_FTP_HOST); #input
		curl_setopt($curl, CURLOPT_FILE, $file); #output
		curl_setopt($curl, CURLOPT_USERPWD, "STREAMING_FTP_USER:STREAMING_FTP_PASSWORD");
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_exec($curl);
		*/
	}
	
	public function DownloadFromFTP($file='', $fileName='')
	{
		$url  = 'ftp://'.STREAMING_FTP_USER.':'.STREAMING_FTP_PASSWORD.'@'.STREAMING_FTP_HOST.'/flash/'.$file;
		$fsize = filesize($url);
		if(!$fsize){
			//echo THERE_IS_NO_SUCH_FILE . $file;
			$this->NotFound();
		}
		if(!$fileName){
			$fileName = basename($file)
		}
		header("Content-disposition: attachment; filename=\"$file\"");
        header("Content-type: application/octet-stream");
        header("Pragma: ");
        header("Cache-Control: cache");
        header("Expires: 0");
		header("Content-Length: " . $fsize);
		@readfile($url);
	}
	
	public function BroadcastVideo()
	{
		$id = _v('id', 0);
		$video  = EventVideo::GetEventVideoById($id, $this->mUser->mUserInfo['Id']);
		if($video) {
			$this->DownloadFromFTP($video['Video']);
		} else {
			//echo YOU_ARE_NOT_AUTHORIZED_TO_DOWNLOAD_THE_VIDEO;
			$this->NotFound();
		}
	}
	public function safeFile($fileName)
	{
		//skip the special characters other than dot(.) and _
		$find = array('/[^a-z0-9\_\.]/i', '/[\_]+/');
		$repl = array('_', '_');
		$fileName = preg_replace ($find, $repl, $fileName);
		return (strtolower($fileName));
	}
    

    public function Download()
    {

        $id = _v('id', 0);
        $act = trim(strip_tags(_v('act', '')));
        switch($act)
        {
            case 'video':
				$VideoDownloadCode = $this->mSession->Get('VideoDownloadCode');									
				if($VideoDownloadCode) {
                $video = Video::GetVideoInfo($id);
				$FileName = $video['Title'];
                if(empty($video) || $video['FromYt'] || $video['Status'] < 2)
                {
                    //die( FILE_NOT_FOUND );
					$this->NotFound();
                }
                if(!$this->mUser->CheckAdminStatus())
                {
                    if (!empty($video['Price']) && $this->mUser->IsAuth() && $video['UserId'] != $this->mUser->mUserInfo['Id'])
                    {
                        $video['VideoPurchase'] = VideoPurchase::Get($this->mUser->mUserInfo['Id'], $id);
                        if(empty($video['VideoPurchase']))
                        {
                            //die( FILE_NOT_FOUND );
							$this->NotFound();
                        }
                    }
                }
				$file	=	'u/'.$video['UserId'].'/'.$video['Video'];
				$fileName = trim($this->safeFile($video['Title'].'.mp4'));
				$this->DownloadFromFTP($file, $fileName);
				}else{
					$this->NotFound();
				}
                break;
			case 'music':
				$DownloadCode = $this->mSession->Get('DownloadCode');
				if($DownloadCode) { 			
				unset($_SESSION['DownloadCode']);
				$music = Music::GetMusic($id, 1, 1);
				$FileName = $music['Title'].'.mp3';				
				if(empty($music) || $music['Status']!=0){
					//die( FILE_NOT_FOUND );
					$this->NotFound();
				}
				$filepath = BPATH .$music['Track'];
				if(!file_exists($filepath))
                {
                    //die( FILE_NOT_FOUND );
					$this->NotFound();
                }
				if(!$this->mUser->CheckAdminStatus())
                {
                    if (!empty($music['Price']) && $this->mUser->IsAuth() && $music['UserId'] != $this->mUser->mUserInfo['Id'])
                    {
						$fanId = $this->mUser->mUserInfo['Id'];
                        $musicPurchase = MusicPurchase::Get($fanId, $id);
						if(!$musicPurchase) {
							$musicPurchase = Music::GetMusicListWithPurchase($music['UserId'], $fanId, $music['AlbumId']);
						}
                        if(!$musicPurchase)
                        {
                            //die( FILE_NOT_FOUND );
							$this->NotFound();
                        }
                    }
                }
				$fsize = filesize($filepath);
				$FileName	= $this->safeFile($FileName);				
                header("Pragma: public");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Cache-Control: private", false);
                header("Content-type: application/zip;");
				
                header("Content-Disposition: attachment; filename=\"" . basename($FileName) . "\";" );
                header("Content-Transfer-Encoding: binary");
                header("Content-Length: " . $fsize);

                readfile($filepath);
				}else{
				$this->NotFound();
				exit;
				}
                break;
				
            default:
                die( FILE_NOT_FOUND );
                break;
        }
    }
}
