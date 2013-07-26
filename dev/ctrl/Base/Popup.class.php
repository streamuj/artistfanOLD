<?php
/**
 * Base Fun popup class
 * User: USA Web Solutions PHP Team
 * Date: 08.02.12
 * Time: 17:45
 *
 */

class Base_Popup extends Base
{
    public function __construct($glObj)
    {
        parent :: __construct($glObj);

        if (!$this->mUser->IsAuth())
        {
            uni_redirect(PATH_ROOT . 'base/user/login');
        }

    }	
public function MusicTrack()	
	{
    $id = _v('id', 0);	
	$Trackdetails =	Music::GetMusic($id);	
	$Albumdetails =	MusicAlbum::GetAlbum($Trackdetails['AlbumId'],0,1);		
    $ui = User::GetUserFullInfo($Trackdetails['UserId']);
	$this->mSmarty->assign('ui', $ui);
    $this->mSmarty->assign('Albumdetails', $Albumdetails);	
    $this->mSmarty->assign('Trackdetails', $Trackdetails);		
	$content = $this->mSmarty->fetch('mods/profile/blocks/_music_track.html');
	echo json_encode(array('message'=>$content));
	exit;		
	}
public function FreeMusicTrack()	
	{
    $id = _v('id', 0);	
	$Trackdetails =	Music::GetMusic($id);	
	$Albumdetails =	MusicAlbum::GetAlbum($Trackdetails['AlbumId'],0,1);			
    $ui = User::GetUserFullInfo($Trackdetails['UserId']);	
	$this->mSmarty->assign('ui', $ui);
    $this->mSmarty->assign('Albumdetails', $Albumdetails);		
    $this->mSmarty->assign('Trackdetails', $Trackdetails);
	$content = $this->mSmarty->fetch('mods/profile/blocks/_freemusic_track.html');
	echo json_encode(array('message'=>$content));
	exit;			
	}
	
public function MusicAlbum()	
	{
    $id = _v('id', 0);	
	$Albumdetails =	MusicAlbum::GetAlbum($id,0,1);	
    $ui = User::GetUserFullInfo($Albumdetails['UserId']);
	$this->mSmarty->assign('ui', $ui);
    $this->mSmarty->assign('Albumdetails', $Albumdetails);
	$content = $this->mSmarty->fetch('mods/profile/blocks/_music_album.html');
	echo json_encode(array('message'=>$content));
	exit;			
	}
public function Video()	
	{
    $id = _v('id', 0);	
	$video  = Video::GetVideoInfo($id);					
    $ui = User::GetUserFullInfo($video['UserId']);
	$this->mSmarty->assign('ui', $ui);
    $this->mSmarty->assign('video', $video);
	$content = $this->mSmarty->fetch('mods/profile/blocks/_video.html');
	echo json_encode(array('message'=>$content));
	exit;	
	}
public function Photo()	
	{
    $id = _v('id', 0);	
	$photo 	=	Photo::GetPhoto( $id );	
    $ui = User::GetUserFullInfo($photo['UserId']);
	$this->mSmarty->assign('ui', $ui);
    $this->mSmarty->assign('photo', $photo);
	$content = $this->mSmarty->fetch('mods/profile/blocks/_photo.html');
	echo json_encode(array('message'=>$content));
	exit;		
	}
public function Event()	
	{
    $id = _v('id', 0);	
    $event = Event::GetEvent($id);			
    $ui = User::GetUserFullInfo($event['UserId']);
	$this->mSmarty->assign('ui', $ui);
    $this->mSmarty->assign('event', $event);
	$content = $this->mSmarty->fetch('mods/profile/blocks/_event.html');
	echo json_encode(array('message'=>$content));
	exit;
	}
	
public function MailToViewer()	
	{
	    return $this->mSmarty->display('mods/profile/blocks/_mail_to_viewer.html');	
	}	
	
public function whatiscvv()
	{
    return $this->mSmarty->display('mods/profile/blocks/whatiscvv.html');		
	}	
public function connect()
	{
    $id = _v('id', 0);	
    $user1 = User::GetUserFullInfo($id);	
    $user2 = User::GetUserFullInfo($_SESSION['system_uid']);		
	$this->mSmarty->assign('user1', $user1);
	$this->mSmarty->assign('user2', $user2);		
	$content = $this->mSmarty->fetch('mods/profile/blocks/_connect.html');
	echo json_encode(array('message'=>$content));
	exit;	
	}
public function connectinplayer()
	{
    $id = _v('id', 0);	
    $user1 = User::GetUserFullInfo($id);	
    $user2 = User::GetUserFullInfo($_SESSION['system_uid']);		
	$this->mSmarty->assign('user1', $user1);
	$this->mSmarty->assign('user2', $user2);		
	$content = $this->mSmarty->fetch('mods/profile/blocks/_connectinplayer.html');
	echo json_encode(array('message'=>$content));
	exit;		
	}
public function connectinvideo()
	{
    $id = _v('id', 0);	
    $user1 = User::GetUserFullInfo($id);	
    $user2 = User::GetUserFullInfo($_SESSION['system_uid']);		
	$this->mSmarty->assign('user1', $user1);
	$this->mSmarty->assign('user2', $user2);		
	$content = $this->mSmarty->fetch('mods/profile/blocks/_connectinvideo.html');
	echo json_encode(array('message'=>$content));
	exit;			
	}
public function connectinphoto()
	{
    $id = _v('id', 0);	
    $user1 = User::GetUserFullInfo($id);	
    $user2 = User::GetUserFullInfo($_SESSION['system_uid']);		
	$this->mSmarty->assign('user1', $user1);
	$this->mSmarty->assign('user2', $user2);		
	$content = $this->mSmarty->fetch('mods/profile/blocks/_connectinphoto.html');
	echo json_encode(array('message'=>$content));
	exit;				
	}
public function connectinevent()
	{
    $id = _v('id', 0);	
    $user1 = User::GetUserFullInfo($id);	
    $user2 = User::GetUserFullInfo($_SESSION['system_uid']);		
	$this->mSmarty->assign('user1', $user1);
	$this->mSmarty->assign('user2', $user2);		
	$content = $this->mSmarty->fetch('mods/profile/blocks/_connectinevent.html');
	echo json_encode(array('message'=>$content));
	exit;					
	}
public function indexvideo()
	{
	$id = _v('id', 0);		
    $userid = _v('userid', 0);	
    $user1 = User::GetUserFullInfo($userid);		
    $user2 = User::GetUserFullInfo($_SESSION['system_uid']);		
	$this->mSmarty->assign('user1', $user1);
	$this->mSmarty->assign('user2', $user2);	
	$IsFollow = UserFollow::GetFollow($user1['Id'], $user2['Id']);		
	
	if($IsFollow){
	//Load buy option    
	$video  = Video::GetVideoInfo($id);	
    $ui = User::GetUserFullInfo($video['UserId']);
	$this->mSmarty->assign('ui', $ui);
    $this->mSmarty->assign('video', $video);	
	$content = $this->mSmarty->fetch('mods/profile/blocks/_video.html');
	echo json_encode(array('message'=>$content));
	exit;	
	}else{
	//Load follow template
	$content = $this->mSmarty->fetch('mods/profile/blocks/_connectinvideo.html');
	echo json_encode(array('message'=>$content));
	exit;		
	}
	}
public function addVideo()
	{	
	$id = _v('id', 0);	
    $userid = _v('userid', 0);	
    $user1 = User::GetUserFullInfo($userid);		
    $user2 = User::GetUserFullInfo($_SESSION['system_uid']);		
	$this->mSmarty->assign('user1', $user1);
	$this->mSmarty->assign('user2', $user2);

	//Load Add option    
	$video  = Video::GetVideoInfo($id);		
    $ui = User::GetUserFullInfo($video['UserId']);
	$this->mSmarty->assign('ui', $ui);
    $this->mSmarty->assign('video', $video);	
	$content = $this->mSmarty->fetch('mods/profile/blocks/_indexaddvideo.html');
	echo json_encode(array('message'=>$content));
	exit;				
	
	}	
public function indexaddvideo()
	{
	$id = _v('id', 0);		
    $userid = _v('userid', 0);	
    $user1 = User::GetUserFullInfo($userid);		
    $user2 = User::GetUserFullInfo($_SESSION['system_uid']);		
	$this->mSmarty->assign('user1', $user1);
	$this->mSmarty->assign('user2', $user2);	
	$IsFollow = UserFollow::GetFollow($user1['Id'], $user2['Id']);			
	if($userid==$_SESSION['system_uid']){
	$this->mSmarty->assign('msg', "you can't Add/Buy this Video");	
	$content = $this->mSmarty->fetch('mods/profile/blocks/_Owner.html');
	echo json_encode(array('message'=>$content));
	exit;				
	}else{		
	if($IsFollow){
	//Load Add option    
	$video  = Video::GetVideoInfo($id);		
    $ui = User::GetUserFullInfo($video['UserId']);
	$this->mSmarty->assign('ui', $ui);
    $this->mSmarty->assign('video', $video);	
	$content = $this->mSmarty->fetch('mods/profile/blocks/_indexaddvideo.html');
	echo json_encode(array('message'=>$content));
	exit;					
	}else{
	//Load follow template
	$content = $this->mSmarty->fetch('mods/profile/blocks/_connectinvideo.html');
	echo json_encode(array('message'=>$content));
	exit;						
	}
	}
	}
public function indexmusicalbum()
	{
	$id = _v('id', 0);		
    $userid = _v('userid', 0);	
    $user1 = User::GetUserFullInfo($userid);		
    $user2 = User::GetUserFullInfo($_SESSION['system_uid']);		
	$this->mSmarty->assign('user1', $user1);
	$this->mSmarty->assign('user2', $user2);	
	$IsFollow = UserFollow::GetFollow($user1['Id'], $user2['Id']);		
	if($userid==$_SESSION['system_uid']){
	$this->mSmarty->assign('msg', "you can't Add/Buy this Music Album");	
	$content = $this->mSmarty->fetch('mods/profile/blocks/_Owner.html');
	echo json_encode(array('message'=>$content));
	exit;							
	}else{		
	if($IsFollow){
	//Load buy option    
	$Albumdetails =	MusicAlbum::GetAlbum($id,0,1);	
    $ui = User::GetUserFullInfo($Albumdetails['UserId']);
	$this->mSmarty->assign('ui', $ui);
    $this->mSmarty->assign('Albumdetails', $Albumdetails);
	$content = $this->mSmarty->fetch('mods/profile/blocks/_music_album.html');
	echo json_encode(array('message'=>$content));
	exit;								
	}else{
	//Load follow template
	$content = $this->mSmarty->fetch('mods/profile/blocks/_connect.html');
	echo json_encode(array('message'=>$content));
	exit;									
	}
	}		
	}
public function indexaddmusicalbum()
	{
	$id = _v('id', 0);		
    $userid = _v('userid', 0);	
    $user1 = User::GetUserFullInfo($userid);		
    $user2 = User::GetUserFullInfo($_SESSION['system_uid']);		
	$this->mSmarty->assign('user1', $user1);
	$this->mSmarty->assign('user2', $user2);	
	$IsFollow = UserFollow::GetFollow($user1['Id'], $user2['Id']);			
	if($userid==$_SESSION['system_uid']){
	$this->mSmarty->assign('msg', "Sorry! You cannot buy your own event");	
	$content = $this->mSmarty->fetch('mods/profile/blocks/_Owner.html');
	echo json_encode(array('message'=>$content));
	exit;				
	}else{	
	if($IsFollow){
	//Load Add option    
	$Albumdetails =	MusicAlbum::GetAlbum($id,0,1);	
    $ui = User::GetUserFullInfo($Albumdetails['UserId']);
	$this->mSmarty->assign('ui', $ui);
    $this->mSmarty->assign('Albumdetails', $Albumdetails);
	$content = $this->mSmarty->fetch('mods/profile/blocks/_indexaddmusic.html');
	echo json_encode(array('message'=>$content));
	exit;					
	}else{
	//Load follow template
	$content = $this->mSmarty->fetch('mods/profile/blocks/_connect.html');
	echo json_encode(array('message'=>$content));
	exit;						
	}
	}		
	}
public function indexevent()
	{
		$id = _v('id', 0);		
		$userid = _v('userid', 0);	
		$user1 = User::GetUserFullInfo($userid);		
		$user2 = User::GetUserFullInfo($_SESSION['system_uid']);		
		$this->mSmarty->assign('user1', $user1);
		$this->mSmarty->assign('user2', $user2);	
		$IsFollow = UserFollow::GetFollow($user1['Id'], $user2['Id']);			
		if($userid==$_SESSION['system_uid']){
		$this->mSmarty->assign('msg', " You cannot buy your own event");	
		$content = $this->mSmarty->fetch('mods/profile/blocks/_Owner.html');					
		echo json_encode(array('follow'=> $IsFollow, 'message'=>$content, 'button'=> 3 ));
		exit;		
		}else{	
			if($IsFollow){
			//Load Add option    
				$id = _v('id', 0);	
				$event = Event::GetEvent($id);	
				$ui = User::GetUserFullInfo($event['UserId']);
				$this->mSmarty->assign('ui', $ui);
				$this->mSmarty->assign('event', $event);
				
				$content = $this->mSmarty->fetch('mods/profile/blocks/_event.html');	
			}else{
				//Load follow template
				$this->mSmarty->assign('follow', 0);
				$content = $this->mSmarty->fetch('mods/profile/blocks/_connectinevent.html');
			}
			echo json_encode(array('follow'=>$IsFollow, 'message'=>$content));
			exit;
		}
	}
public function ViewersReportList()
	{
	$UserId  = _v('UserId', 0);		
    $EventId = _v('EventId', 0);	
	$viewers = BroadcastViewers::ViewersReportList($UserId,$EventId);	
	$this->mSmarty->assign('viewers', $viewers['list']);	
    return $this->mSmarty->display('mods/profile/blocks/_viewersreportlist.html');				
	}
public function Share()
	{	
    $id = _v('id', 0);	
	$Albumdetails =	MusicAlbum::GetAlbum($id,0,1);	
    $ui = User::GetUserFullInfo($Albumdetails['UserId']);
	$this->mSmarty->assign('ui', $ui);
	$this->mSmarty->assign('Albumdetails', $Albumdetails);
	$content = $this->mSmarty->fetch('mods/profile/blocks/_music_album_share.html');
	echo json_encode(array('message'=>$content));
	exit;				
	}					
public function ShareVideo()
	{
    $id = _v('id', 0);		 
	$video  = Video::GetVideoInfo($id);	
    $ui = User::GetUserFullInfo($video['UserId']);
	$this->mSmarty->assign('ui', $ui);
    $this->mSmarty->assign('video', $video);	
	$content = $this->mSmarty->fetch('mods/profile/blocks/_video_share.html');
	echo json_encode(array('message'=>$content));
	exit;					
	}	
public function shareEvents()
	{
	//Load Add option    
    $id = _v('id', 0);	
    $event = Event::GetEvent($id);	
    $ui = User::GetUserFullInfo($event['UserId']);
	$this->mSmarty->assign('ui', $ui);
    $this->mSmarty->assign('event', $event);
	$content = $this->mSmarty->fetch('mods/profile/blocks/_event_share.html');
	echo json_encode(array('message'=>$content));
	exit;					
	}	
public function confirmationforPhotoAlbum()
	{
    $id = _v('id', 0);	
	$album = PhotoAlbum::GetAlbum($id);
    $ui = User::GetUserFullInfo($album['UserId']);	
	$this->mSmarty->assign('ui', $ui);
	$this->mSmarty->assign('Albumdetails', $album);	
    return $this->mSmarty->display('mods/profile/blocks/dialog-confirm.html');		
	}		
public function videoFocusPublish()
	{
    return $this->mSmarty->display('mods/profile/blocks/video_focus_publish.html');		
	}		

}
?>
