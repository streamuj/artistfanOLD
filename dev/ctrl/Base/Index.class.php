<?php
/**
 * Default project class
 * User: ssergy
 * Date: 10.01.2011
 * Time: 21:59:04
 *
 */

class Base_Index extends Base
{
    public function __construct( $glObj )
    {
        parent :: __construct( $glObj );		
    }

    /**
     * Client home page
     * @return void
     */
	 
    public function Index()
    {   
		$this->mlObj['mSession']->Del('redirect');	
		if ($this->mUser->IsAuth()) {	
			uni_redirect( PATH_ROOT . 'u/'.$this->mUser->mUserInfo['Name'] );		
		} else {    
			$this->mSmarty->display('mods/index/home_visitors1.html');
		}
    }
	
	/**
	 * Switch user design
	 */
	 public function SwitchDesign()
	 {
	 	$skin = $this->mSession->Get('theme');
		if(!$skin || $skin == 'skin'){
			$this->mSession->Set('theme', 'templates');
		} else {
			$this->mSession->Set('theme', 'skin');
		}
		uni_redirect( PATH_ROOT );
	 }
	 
	 public function OldDesign()
	 {
	 	$this->mSession->Set('theme', 'templates');
		uni_redirect( PATH_ROOT );
	 }
	 
	 public function NewDesign()
	 {
	 	$this->mSession->Set('theme', 'skin');
		uni_redirect( PATH_ROOT );
	 }


    /**
     * Events page
     * @return void
     */
   public function Events()
    {
        /**
         * all artists events list
         */
		
		$crawler = crawlerDetect($_SERVER['HTTP_USER_AGENT']);		

		if (!$this->mUser->IsAuth() && !$crawler)
        {
            $this->mlObj['mSession']->set('redirect', array('url' => $_SERVER['REQUEST_URI']));		

			uni_redirect( PATH_ROOT . 'base/user/login' );
        }
		
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
				
        $page = _v('page', 1);
	
        $pcnt = 10;
		$iterm_count = 10;
        $df = _v('df', '');		
        $ajx = _v('ajx', '');
		$genresId = _v('genresId', 0);
		//deb($genresId);
		if($df==''){
		$df	=	'up';
		}
//        $df = !in_array($df, array('td', 'twd', 'tw', 'nw')) ? '' : $df;
         $df = !in_array($df, array('td', 'tw', 'nw', 'tm', 'nm', 'up', 'all','pa')) ? '' : $df;

        $this->mSmarty->assignByRef('df', $df);
		// generes list
		$genresList = User::GetGenresList();
		$this->mSmarty->assignByRef('genresId', $genresId);
		$this->mSmarty->assignByRef('genresList', $genresList);
		
		
        $period = Event::GetPeriod($df);
	
        if(!$period['from'] || strtotime($period['from']) < mktime())
        {
            $period['from'] = date("Y-m-d H:i:s");
        }	
        $rcnt = Event::EventsCount(0, $period);
        if($genresId || $period)
		{								
				$events = Event::genresEventList($genresId, $iterm_count, $period ,'' , $df );						
				$indexevent = Home::getEventList('', '',INDEX_EVENT_SHOW, '');							
		} 
		else 
		{	
         	    $events = Event::EventsList(0, $page, $pcnt, $period, array(), array(1, 2),'','','','',$df);	
		}
        include_once 'model/Pagging.class.php';
        $link = PATH_ROOT . 'base/index/events' . ($df ? '?df=' . $df : '');
        $mpg = new Pagging($pcnt, $rcnt, $page, $link);
        $pagging = $mpg->Make2($this->mSmarty, 0, 1);
        $this->mSmarty->assignByRef('pagging', $pagging);

        //artists info
        $aids = array();
        foreach($events as $item)
        {
            $aids[$item['UserId']] = $item['UserId'];
        }
        $artists = User::GetUsersNames($aids);
		
        $this->mSmarty->assignByRef('events', $events);
        $this->mSmarty->assignByRef('artists', $artists);
        $this->mSmarty->assign('topmenu', 'events');	
        $this->mSmarty->assign('indexevent', $indexevent);			
		if($ajx)
		{
			 $res['q'] = "ok"; 
			 $res['data'] = $this->mSmarty->fetch('mods/index/ajax/eventList.html');  
			 echo json_encode($res);
			 exit();
		}
		//deb($events);	
        $this->mSmarty->assign('system_uid', $_SESSION['system_uid']);					
        $this->mSmarty->display('mods/index/events.html');
    }



    /**
     * Whats hot page
     * @return void
     */
 
	public function Explore()
	{
		$crawler = crawlerDetect($_SERVER['HTTP_USER_AGENT']);		

		if (!$this->mUser->IsAuth() && !$crawler)
        {
            $this->mlObj['mSession']->set('redirect', array('url' => $_SERVER['REQUEST_URI']));		

			uni_redirect( PATH_ROOT . 'base/user/login' );
        }
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
			
		$artist = Home::getArtistList();
		$video = Home::getVideoList();
		$event = Home::getEventList();				
		$music_album = Home::getMusicAlbumList();

        $this->mSmarty->assign('music_album', $music_album);
        $this->mSmarty->assign('artist', $artist);	
        $this->mSmarty->assign('video', $video);	
        $this->mSmarty->assign('event', $event);						
			
        $this->mSmarty->assign('topmenu', 'video');
        $this->mSmarty->display('mods/index/explore.html');
	}
	
	public function Artists()
	{
		$crawler = crawlerDetect($_SERVER['HTTP_USER_AGENT']);		

		if (!$this->mUser->IsAuth() && !$crawler)
        {
            $this->mlObj['mSession']->set('redirect', array('url' => $_SERVER['REQUEST_URI']));		

			uni_redirect( PATH_ROOT . 'base/user/login' );
        }
				
        $this->mSmarty->assign('topmenu', 'artist');

		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
			
		$id = _v('id','');
		$vCat =new HomeCategory();								
		$this->mSmarty->assign('vCat', $vCat);	
		
		if($id)
		{
			$artist = Home::getArtistList('', '', $id);

			$this->mSmarty->assign('artist', $artist);			
			$this->mSmarty->assign('id', $id);
			
	        $this->mSmarty->display('mods/index/artists_single_cat.html');		
		}
		else
		{			
			$artist = Home::getArtistList('', '', '', RECENT_ARTIST);
			
			$artistCat =array();
			
			foreach($artist as $val)
			{
				$artistCat[$val['Category']][] = $val;
			}
			
			$this->mSmarty->assign('artistCat', $artistCat);	

	        $this->mSmarty->display('mods/index/artists.html');			
		}
	}	
	
	public function Video()
	{

		$crawler = crawlerDetect($_SERVER['HTTP_USER_AGENT']);		

		if (!$this->mUser->IsAuth() && !$crawler)
        {
            $this->mlObj['mSession']->set('redirect', array('url' => $_SERVER['REQUEST_URI']));		
			uni_redirect( PATH_ROOT . 'base/user/login' );
        }

        $this->mSmarty->assign('topmenu', 'video');
		
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
						
		$id = _v('id','');
		$vCat =new HomeCategory();								
		$this->mSmarty->assign('vCat', $vCat);	
	

		if($id)
		{

			if($id == 'nr')
			{
				$video = Video::GetNewReleaseVideoList(1);		
			}
			else if($id == 'mv')
			{
				$video = Video::GetMostViewedVideoList(1, 1, 60);
			}
			else
			{
				$video = Home::getVideoList('', '', $id);
			}

			
			$this->mSmarty->assign('video', $video);			
			$this->mSmarty->assign('id', $id);
			
	        $this->mSmarty->display('mods/index/video_single_cat.html');	
			exit;	
		}
		else
		{
			$video = Home::getVideoList('', '', '', RECENT_VIDEOS);
			
			$video_slide = Home::getVideoList('', '', VIDEO_SLIDE_CAT_ID, RECENT_VIDEOS);
			
			$this->mSmarty->assign('video_slide', $video_slide);
											
			$videoCat =array();

			foreach($video as $val)
			{
				if($val['Category'] != VIDEO_SLIDE_CAT_ID)
				$videoCat[$val['Category']][] = $val;
			}

			$this->mSmarty->assign('videoCat', $videoCat);
			
			$newRelease = Video::GetNewReleaseVideoList(1, 1, 30, $this->mCache, $ui['Id']);			
		
			$mostViewed = Video::GetMostViewedVideoList(1, 1, 30, $this->mCache, $ui['Id']);


			$this->mSmarty->assign('newRelease', $newRelease);
			$this->mSmarty->assign('mostViewed', $mostViewed);
						
	        $this->mSmarty->display('mods/index/video.html');
			exit;
		}	

	}	
	
	public function Event()
	{
		$crawler = crawlerDetect($_SERVER['HTTP_USER_AGENT']);		

		if (!$this->mUser->IsAuth() && !$crawler)
        {
            $this->mlObj['mSession']->set('redirect', array('url' => $_SERVER['REQUEST_URI']));		

			uni_redirect( PATH_ROOT . 'base/user/login' );
        }
	    $this->mSmarty->assign('topmenu', 'event');
		
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
				
		$id = _v('id','');
		$vCat =new HomeCategory();								
		$this->mSmarty->assign('vCat', $vCat);	
		
		if($id)
		{
			$event = Home::getEventList('', '', $id);

			$this->mSmarty->assign('event', $event);			
			$this->mSmarty->assign('id', $id);
			
	        $this->mSmarty->display('mods/index/event_single_cat.html');
			exit;		
		}
		else
		{			
			$event = Home::getEventList('', '', '', LIVE_SHOW);			
			$eventCat =array();
			
			foreach($event as $val)
			{
				$eventCat[$val['Category']][] = $val;
			}
			//deb($eventCat);
			$this->mSmarty->assign('eventCat', $eventCat);	
	        $this->mSmarty->display('mods/index/event.html');	
			exit;	
		}
	}
	
	public function Music()
	{
		$crawler = crawlerDetect($_SERVER['HTTP_USER_AGENT']);		

		if (!$this->mUser->IsAuth() && !$crawler)
        {
            $this->mlObj['mSession']->set('redirect', array('url' => $_SERVER['REQUEST_URI']));		

			uni_redirect( PATH_ROOT . 'base/user/login' );
        }
			
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
				
		$id = _v('id','');
		$vCat =new HomeCategory();	
		
		$vHCat =new Home();	
				
		$this->mSmarty->assign('vCat', $vCat);	
		$this->mSmarty->assign('vHCat', $vHCat);	
						
		$album_slide = Home::getMusicAlbumList('', '', MUSIC_SLIDE_CAT_ID);

		$this->mSmarty->assign('album_slide', $album_slide);			
		$this->mSmarty->assign('id', $id);

		if($id)
		{	
			if($id == 'rr')
			{
				$music_album = MusicAlbum::GetRecentAlbumList(1, 1, '', $this->mUser->mUserInfo['Id']); 
				$title = "RECENT RELEASES";
			}
			else if($id == 'bs')
			{
				$music_album = MusicAlbum::GetBestSellerAlbumList('', 0, $this->mUser->mUserInfo['Id']);
				$title = "BEST SELLERS";
			}
			else if($id == 'hs')
			{
				$music_album = MusicAlbum::GetHotSinglesAlbumList('', 0, $this->mUser->mUserInfo['Id']);
				$title = "HOT SINGLES";
			}			
			else
			{
				$music_album = Home::getMusicAlbumList('', '', $id, $this->mUser->mUserInfo['Id']);	
				$title = $vCat->GetCategoryInfoById($id);			
			}	
									
			$this->mSmarty->assign('music_album', $music_album);	
			$this->mSmarty->assign('title', $title);	
			
	        $this->mSmarty->display('mods/index/music_single_cat.html');	
			exit;
			
	    }			
		$music_album = Home::getMusicAlbumList('', '', '', $this->mUser->mUserInfo['Id']);		

		$musicCat =array();
			
		foreach($music_album as $val)
		{
				if($val['Category'] != MUSIC_SLIDE_CAT_ID)
				$musicCat[$val['Category']][] = $val;
		}

		//shows album that are recently released eg: now=>17-04-2013 between last month=>17-03-2013
		$recentRelease = MusicAlbum::GetRecentAlbumList(1, 1, 30, $this->mUser->mUserInfo['Id']); 
		$recentReleaseCount = MusicAlbum::GetRecentAlbumListCount(); 		

		//shows albums are the bought maximum 
		$bestSellers = MusicAlbum::GetBestSellerAlbumList(30, 0, $this->mUser->mUserInfo['Id']);//,  $this->mCache, $ui['Id']
		$bestSellersCount = MusicAlbum::GetBestSellerAlbumListCount();

		//shows single tracked that are bought most 
		$hotSingles = MusicAlbum::GetHotSinglesAlbumList(30, 0, $this->mUser->mUserInfo['Id']);
		$hotSinglesCount = MusicAlbum::GetHotSinglesAlbumListCount();


		$this->mSmarty->assign('musicCat', $musicCat);	
		
		$this->mSmarty->assign('recentRelease', $recentRelease);
		$this->mSmarty->assign('recentReleaseCount', $recentReleaseCount);		
		
		$this->mSmarty->assign('bestSellers', $bestSellers);	
		$this->mSmarty->assign('bestSellersCount', $bestSellersCount);	
						
		$this->mSmarty->assign('hotSingles', $hotSingles);
		$this->mSmarty->assign('hotSinglesCount', $hotSinglesCount);	

		
	    $this->mSmarty->display('mods/index/music.html');		
	
	}
				
	public function notification()
	{
		if (!$this->mUser->IsAuth())
        {
            $this->mlObj['mSession']->set('redirect', array('url' => $_SERVER['REQUEST_URI']));		

			uni_redirect( PATH_ROOT . 'base/user/login' );
        }
        $ui =& $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
				
		$ArtistTimeline	=	$ui['Name'];
        $Notifications_Wall = Notification::ShowNotification_Wall($ui['Id']);	
        $Notifications_comment = Notification::ShowNotification_Comment($ui['Id']);
		
		$this->mSmarty->assign('ArtistTimeline', $ArtistTimeline);						
		$this->mSmarty->assign('Notifications_Wall', $Notifications_Wall);				
        $this->mSmarty->assign('Notifications_comment', $Notifications_comment);				
		
		$notificationCount	=	count($Notifications_Wall) + count($Notifications_comment);
        
		$this->mSmarty->assign('notificationCountnpage', $notificationCount);						
		$this->mSmarty->assign('topmenu', 'music');
				
		Notification::ChangeStatusWall($ui['Id']);				
		Notification::ChangeStatusComment($ui['Id']);	
		$newNotification = $this->mCache->set($ui['Id'].'_notification', 0);
        $this->mSmarty->display('mods/index/notification.html');				
	}
	
	
}
?>