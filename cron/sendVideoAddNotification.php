<?php 
require_once('cronHeader.php');

//init Smarty
require BPATH.'libs/Smarty/Smarty.class.php';
$mSmarty                  = new Smarty();
$mSmarty -> compile_check = true;
$mSmarty -> debugging     = false;//DEBUG ? true : false;
$mSmarty -> setTemplateDir(BPATH.'dev/skin');
$mSmarty -> setCompileDir(BPATH.'files/templ/');
$mSmarty -> setCacheDir(BPATH.'files/cache/');
$mSmarty -> setConfigDir(BPATH.'dev/templates/conf/');
$mSmarty -> error_reporting  = E_ALL & ~E_NOTICE/* & ~E_WARNING*/;
$mSmarty -> setPluginsDir( array(
			BPATH.'libs/Smarty/plugins',
			BPATH.'dev/templates/plugins', 
));

$mSmarty->assign('SUB_DOMAIN', SUB_DOMAIN);


	$video = Video::GetVideoEmailSendList();
//deb($video);
	include BPATH.'libs/Phpmailer_v5.1/class.phpmailer.php';

	foreach($video as $val)
	{
			$userInfo = User::GetUser($val['UserId']);
	
			$mSmarty->assign('mAlbmId', $val['Id']);
			$mSmarty->assign('Image', $val['Image']);
			$mSmarty->assign('Title', $val['Title']);							
			$mSmarty->assign('VideoDate', $val['VideoDate']);				
			$mSmarty->assign('Video', $val['Video']);			
			$mSmarty->assign('Price', $val['Price']);
			$mSmarty->assign('FromYt', $val['FromYt']);
			
			$mSmarty->assign('Free', 0 );	
								
			$mSmarty->assign('artistId',$userInfo['Id']);																						
			$mSmarty->assign('artistName',$userInfo['Name']);	
			$mSmarty->assign('artistFirstName',$userInfo['FirstName']);																						
			$mSmarty->assign('artistlastName',$userInfo['LastName']);																											
			$mSmarty->assign('artistBandName',$userInfo['BandName']);
			$mSmarty->assign('artistLocation',$userInfo['Location']);
			$mSmarty->assign('artistState',$userInfo['State']);
																					
																																																				
			$fromEmail = ADMIN_EMAIL;
			$fromName = SITE_NAME;								
			if( $userInfo['BandName']) 
			{
				$subjectName =  $userInfo['BandName'];
			}
			else
			{
				$subjectName =  $userInfo['FirstName'].'  '.$userInfo['LastName'];		
			}	
			$follow 	 = UserFollow::GetFollowersUserList($userInfo['Id'], USER_ARTIST);
			$fellow_fans = UserFollow::GetFollowersUserList($userInfo['Id'], USER_FAN);	    
		
			if($follow)
			{      		     
				foreach($follow as $followers)
				{	
					$name = $followers['BandName'] ? $followers['BandName'] : $followers['FirstName'].' '.$followers['LastName'];																
					$mSmarty->assign('name', $name );  
			
					$toEmail = $followers['Email'];
					$toName = $name;
					
					$subject = $subjectName." has uploaded a new video!";
					$message = $mSmarty->fetch('mails/video_add_notification.html');

					sendEmail($fromEmail,$fromName, $toEmail, $toName, $subject, $message);					
					
				}
	  
			}
			
			if($fellow_fans)
			{
				foreach($fellow_fans as $fellow_fanslist)
				{		
					$name = $fellow_fanslist['BandName'] ? $fellow_fanslist['BandName'] : $fellow_fanslist['FirstName'].' '.$fellow_fanslist['LastName'];																
					$mSmarty->assign('name', $name );  
									
					$toEmail = $fellow_fanslist['Email'];
					$toName = $name;
					
					$subject = $subjectName." has uploaded a new video!";
					$message = $mSmarty->fetch('mails/video_add_notification.html');
					
					sendEmail($fromEmail,$fromName, $toEmail, $toName, $subject, $message);					
												
				}					
			}	
					
			Video::UpdateVideoEmailSend($val['Id']);				
	
	}		
?>