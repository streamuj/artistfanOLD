<?php
/**
 * Base Search profile class
 * User: ssergy
 * Date: 08.02.12
 * Time: 17:46
 * 
 */

class Base_Search extends Base
{
    public function __construct($glObj)
    {
        parent :: __construct($glObj);
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
/*
        if ($this->mUser->mUserInfo['Status'] != 2)
        {
            uni_redirect( PATH_ROOT );
        }*/
        
    }
    /**
     * Search page
     * @return void
     */
    public function Search()
    {
	
		if (!$this->mUser->IsAuth())
        {
            uni_redirect( PATH_ROOT . 'base/user/login' );
        }
		
		$search_key = _v('search_key', '');
		
		if($search_key == 'Search')
		{
			$search_key = '';
		}
		
		if($_POST['search_key']) {
			uni_redirect(PATH_ROOT . 'base/search/search?search_key='.$search_key);
		}
        $this->mSmarty->assign('topmenu', 'search');			
		$this->mSmarty->assign('search_key', $search_key);


				
		$music = Music::GetMusicListByTitle( $search_key, 0, SEARCH_RESULT );
		
		$musicCount = Music::GetMusicListByTitleCount( $search_key );
		
		$video = Video::GetVideoListByTitle( $search_key, 0, SEARCH_VIDEO_RESULT );		
		$videoCount = Video::GetVideoListByTitleCount( $search_key );		
		
		
		$artist = UserFollow::GetUserListByName( $search_key, USER_ARTIST, 0, SEARCH_RESULT );			
		$artistCount = UserFollow::GetUserListByNameCount( $search_key, USER_ARTIST );	
		
			
		$fans = UserFollow::GetUserListByName( $search_key, USER_FAN, 0, SEARCH_RESULT);		
		$fanCount = UserFollow::GetUserListByNameCount( $search_key, USER_FAN );	
				
		$events = Event::GetEventListByTitle($search_key, 0, SEARCH_VIDEO_RESULT);		
		$eventsCount = Event::GetEventListByTitleCount($search_key );
		
		

		$this->mSmarty->assign('music', $music);
		$this->mSmarty->assign('musicCount', $musicCount);
				
		$this->mSmarty->assign('video', $video);
		$this->mSmarty->assign('videoCount', $videoCount);		
		
		$this->mSmarty->assign('artist', $artist);
		$this->mSmarty->assign('artistCount', $artistCount);
				
		$this->mSmarty->assign('fans', $fans);
		$this->mSmarty->assign('fanCount', $fanCount);
		
		$this->mSmarty->assign('events', $events);
		$this->mSmarty->assign('eventsCount', $eventsCount);

		$this->mSmarty->assign('module', 'Search');																

        $this->mSmarty->display('mods/search/search.html');
    }
	public function AutoSearch()
    {
		$search_key = _v('query', '');
		$sendData = _v('sendData', 0);

		if($search_key != '') {
			$music = Music::GetMusicListByTitle($search_key, 0, SEARCH_RESULT, $this->mUser->mUserInfo['Id'] );
			$video = Video::GetVideoListByTitle($search_key, 0, SEARCH_RESULT, $this->mUser->mUserInfo['Id']  );
			$artist = UserFollow::GetUserListByName($search_key, 2, 0, SEARCH_RESULT, $this->mUser->mUserInfo['Id'] );
			$fans = UserFollow::GetUserListByName($search_key, 1, 0, SEARCH_RESULT, $this->mUser->mUserInfo['Id'] );
			$events = Event::GetEventListByTitle($search_key, 0, SEARCH_RESULT, $this->mUser->mUserInfo['Id'] );
		}

		if($sendData){
			$items = array_merge($artist, $video, $music, $fans, $events);
			//deb($items);
			echo json_encode($items);
			exit;
		} else {
						deb($search_key);
						
			$this->mSmarty->assign('music', $music);
			$this->mSmarty->assign('video', $video);
			$this->mSmarty->assign('artist', $artist);
			$this->mSmarty->assign('fans', $fans);
        	$this->mSmarty->display('mods/search/autoSearch.html');
		}
    }
	
    public function SearchMusic()
    {
	
		if (!$this->mUser->IsAuth())
        {
            uni_redirect( PATH_ROOT . 'base/user/login' );
        }

		$search_key = _v('search_key', '');
		
        $this->mSmarty->assign('topmenu', 'search');
		
		$this->mSmarty->assign('search_key', $search_key);
		
		$music=Music::GetMusicListByTitle( $search_key );
		$musicCount = count($music);
		$this->mSmarty->assign('musicCount', $musicCount);
		$this->mSmarty->assign('music', $music);
		$this->mSmarty->assign('module', 'SearchMusic');																
        $this->mSmarty->display('mods/search/search_music.html');
    }
	public function SearchVideo()
    {
	
		if (!$this->mUser->IsAuth())
        {
            uni_redirect( PATH_ROOT . 'base/user/login' );
        }

		$search_key = _v('search_key', '');
		
        $this->mSmarty->assign('topmenu', 'search');
		
		$this->mSmarty->assign('search_key', $search_key);
		
		$video = Video::GetVideoListByTitle( $search_key );
		$videoCount = count($video);
		$this->mSmarty->assign('videoCount', $videoCount);
		$this->mSmarty->assign('video', $video);
		$this->mSmarty->assign('module', 'SearchVideo');												
        $this->mSmarty->display('mods/search/search_video.html');
    }
	
	public function SearchArtist()
    {
		if (!$this->mUser->IsAuth())
        {
            uni_redirect( PATH_ROOT . 'base/user/login' );
        }
		
		$search_key = _v('search_key', '');
		
        $this->mSmarty->assign('topmenu', 'search');
		
		$this->mSmarty->assign('search_key', $search_key);
		
		$artist = UserFollow::GetUserListByName( $search_key, 2 );
		$artistCount = count($artist);
		$this->mSmarty->assign('artistCount', $artistCount);
		$this->mSmarty->assign('artist', $artist);
		$this->mSmarty->assign('module', 'SearchArtist');								
        $this->mSmarty->display('mods/search/search_artist.html');
    }	
	
	public function SearchFan()
    {
	
		if (!$this->mUser->IsAuth())
        {
            uni_redirect( PATH_ROOT . 'base/user/login' );
        }

		$search_key = _v('search_key', '');
		
        $this->mSmarty->assign('topmenu', 'search');
		
		$this->mSmarty->assign('search_key', $search_key);
		
		$fans = UserFollow::GetUserListByName( $search_key, 1 );
		$fansCount = count($fans);
		$this->mSmarty->assign('fansCount', $fansCount);
		$this->mSmarty->assign('fans', $fans);
		$this->mSmarty->assign('module', 'SearchFan');				
        $this->mSmarty->display('mods/search/search_fans.html');
    }			
    public function SearchEvent()
    {
		if (!$this->mUser->IsAuth())
        {
            uni_redirect( PATH_ROOT . 'base/user/login' );
        }

		$search_key = _v('search_key', '');
		
        $this->mSmarty->assign('topmenu', 'search');
		
		$this->mSmarty->assign('search_key', $search_key);
		
		$events = Event::GetEventListByTitle($search_key);
		$eventCount = count($events);
		
		$this->mSmarty->assign('eventCount', $eventCount);
		$this->mSmarty->assign('events', $events);
		$this->mSmarty->assign('module', 'SearchEvent');								
        $this->mSmarty->display('mods/search/search_event.html');
	}
}
