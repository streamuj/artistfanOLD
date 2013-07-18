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
				
						
		} else {	
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
     * Events calendar page
     * @return void
     */
    public function EventsCalendar()
    {
		$crawler = crawlerDetect($_SERVER['HTTP_USER_AGENT']);		

		if (!$this->mUser->IsAuth() && !$crawler)
        {
            $this->mlObj['mSession']->set('redirect', array('url' => $_SERVER['REQUEST_URI']));		

			uni_redirect( PATH_ROOT . 'base/user/login' );
        }
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
			
        //selected date
        $month = _v('month', date('n'));
        $year = _v('year', date('Y'));

        //if selected date is past make it current
        if($month < date('n') && $year <= date('Y'))
        {
            $month = date('n');
        }
        if($year < date('Y'))
        {
            $year = date('Y');
        }

        $this->mSmarty->assign('month', $month);
        $this->mSmarty->assign('year', $year);

        //next month date
        $next_month = $month == 12 ? 1 : $month+1;
        $next_year = $month == 12 ? $year+1 : $year;
        //prev month date
        $prev_month = $month == 1 ? 12 : $month-1;
        $prev_year = $month == 1 ? $year-1 : $year;
        

        $this->mSmarty->assign('next_month', $next_year <= date('Y')+2 ? '/base/index/eventscalendar?month=' . $next_month . '&year=' . $next_year : '');
        $this->mSmarty->assign('prev_month', ($prev_year >= date('Y') && $prev_month >= date('n')) ? '/base/index/eventscalendar?month=' . $prev_month . '&year=' . $prev_year : '');

        //build calendar
        $time = mktime(0, 0, 0, $month, 1, $year);
        $dayofmonth = date('t', $time);

        $day_count = 1;

        //first week
        $num = 0;
        for($i = 0; $i < 7; $i++)
        {
            //day of week number
            $dayofweek = date('w', mktime(0, 0, 0, $month, $day_count, $year));
            if($dayofweek == $i)
            {
                $week[$num][$i] = $day_count;
                $day_count++;
            }
            else
            {
                $week[$num][$i] = '';
            }
        }
        //all next weeks
        while(true)
        {
            $num++;
            for($i = 0; $i < 7; $i++)
            {
                $week[$num][$i] = $day_count;
                $day_count++;
                if($day_count > $dayofmonth)
                {
                    break;
                }
            }
            if($day_count > $dayofmonth)
            {
                break;
            }
        }

        $this->mSmarty->assignByRef('week', $week);

        $mm = array();
        $mme = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        for ($i = 1; $i <= 12; $i++)
        {
            $mm[$i] = $mme[ $i-1 ];
        }

        $yy = array();
        for ($i=date("Y"); $i <=date("Y")+2; $i++)
        {
            $yy[$i] = $i;
        }

        $this->mSmarty->assignByRef('mm', $mm);
        $this->mSmarty->assignByRef('yy', $yy);

        //get events for selected month
        $from = mktime(0, 0, 0, $month, 1, $year);
        if($from < mktime())
        {
            $from = mktime();
        }
        $to   = mktime(0, 0, 0, $next_month, 1, $next_year) - 1;

        $events_list = Event::EventsList(0, 0, 0, array('from' => date("Y-m-d H:i:s", $from), 'to' => date("Y-m-d H:i:s", $to)), array(), array(1, 2));
        $events = array();
        $aids = array();
        foreach($events_list as $item)
        {
            $day = date('j', strtotime($item['EventDate']));
            if(empty($events[$day]))
            {
                $events[$day] = array();
            }
            $events[$day][] = $item;
            $aids[$item['UserId']] = $item['UserId'];
        }

        //artists info
        $artists = User::GetUsersNames($aids);

        $this->mSmarty->assignByRef('events', $events);
        $this->mSmarty->assignByRef('artists', $artists);
        $this->mSmarty->assign('topmenu', 'events');

        $this->mSmarty->display('mods/index/events_calendar.html');
    }

    /**
     * Whats hot page
     * @return void
     */
    public function Hot()
    {
		$crawler = crawlerDetect($_SERVER['HTTP_USER_AGENT']);		

		if (!$this->mUser->IsAuth() && !$crawler)
        {
            $this->mlObj['mSession']->set('redirect', array('url' => $_SERVER['REQUEST_URI']));		

			uni_redirect( PATH_ROOT . 'base/user/login' );
        }
	
        /**
         * featured artists wall posts
         */
        $page = _v('page', 1);
        $pcnt = 10;

        $rcnt = Wall::GetFeaturedCount();
        $wall = Wall::GetFeaturedList( 0, $page, $pcnt);

        include_once 'model/Pagging.class.php';
        $link = PATH_ROOT . 'base/index/hot';
        $mpg = new Pagging($pcnt, $rcnt, $page, $link);
        $pagging = $mpg->Make2($this->mSmarty, 0, 1);
        $this->mSmarty->assignByRef('pagging', $pagging);


        $this->mSmarty->assignByRef('wall', $wall);


        //featured albums
        $albums = MusicAlbum::GetFeaturedAlbums(6);
        $this->mSmarty->assignByRef('albums', $albums);

        $this->mSmarty->assign('topmenu', 'hot');
        $this->mSmarty->display('mods/index/hot.html');
    }	
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
				$music_album = MusicAlbum::GetRecentAlbumList(1, 1, '', 1, '', $this->mUser->mUserInfo['Id']); 
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
			
			//deb($music_album);
						
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