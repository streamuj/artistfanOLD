<?php 

/**
 * User profile class
 * User: ssergy
 * Date: 14.12.11 
 * Time: 21:40  
 *
 */                
        
class Base_Profile extends Base 
{  
    public function __construct($glObj) 
    { 
        parent :: __construct($glObj);  
		  
		$crawler = crawlerDetect($_SERVER['HTTP_USER_AGENT']);	
		
		$this->mlObj['mSession']->Del('redirect');

		if (!$this->mUser->IsAuth() && !$crawler)
        {
			
            $this->mlObj['mSession']->set('redirect', array('url' => $_SERVER['REQUEST_URI']));		

			uni_redirect( PATH_ROOT . 'base/user/login' );
        }
		
        if ($this->mUser->mOtherUserId)
        {
			if($this->mUser->mOtherUserId == -1){
				$this->NotFound();
				exit;
			}
            $ui =& $this->mUser->mUserInfo;
	        $IsFollow1 = UserFollow::GetFollow($ui['Id'], $this->mUser->mOtherUserId);
    	    $this->mSmarty->assign('IsFollow1', $IsFollow1);			
        }
		else
		{
			if($this->mUser->mUserInfo['Status']==USER_ARTIST)
			{
				$cUrl = $_SERVER['REQUEST_URI'];
				$cUrlArray = explode('/', $cUrl);
				if($cUrlArray[3]=='events')
				{
					uni_redirect( PATH_ROOT . 'artist/events/'.$cUrlArray[4] );
				}
				else if($cUrlArray[1]=='broadcasting')
				{
					$event = Event::GetEvent($cUrlArray[2], '', 1);

					if($event['UserId'] == $this->mUser->mUserInfo['Id'])				
					{
						uni_redirect( PATH_ROOT . 'artist/events/'.$cUrlArray[2] );
					}
					//else
						//uni_redirect( PATH_ROOT . 'u/'.$event['Name'].'/events/'.$cUrlArray[2] );
				}
			}
		}	
    }


    /**
     * Main user profile page
     */
	 
    public function Index()
    {

        $act = _v('act', '');
        $this->mSmarty->assign('act', $act);
        if ($this->mUser->mOtherUserId)
        {
            $ui =& $this->mUser->mOtherUserInfo;

            //set "other" flag
            $IsOther = $this->mUser->mOtherUserInfo['Id'];
            $this->mSmarty->assign('IsOther', $IsOther);
        }
        else
        {
		
            $IsOther = 0;
    			
			if($this->mUser->mUserInfo['TwId'])
			{
				$fbTwFollower = Invitation::CheckTwInvitationFollower( $this->mUser->mUserInfo['Id']);	
				$fbTwInviter = Invitation::getTwInviter($this->mUser->mUserInfo['Id']);
			}
			else if($this->mUser->mUserInfo['FbId'])
			{
				$fbTwFollower = Invitation::CheckFbInvitationFollower( $this->mUser->mUserInfo['Id']);
				$fbTwInviter = Invitation::getFbInviter($this->mUser->mUserInfo['Id']);
			}
			if(($this->mUser->mUserInfo['Avatar'] == '' && $this->mUser->mUserInfo['FbId'] != '') || $fbTwInviter)
			{
					$this->UpdateFbTwRequest();
			}
            $ui =& $this->mUser->mUserInfo;

            //facebook (or twitter) registration not completed
            if (($ui['FbId'] && !$ui['FbStart']) || ($ui['TwId'] && !$ui['TwStart']))
            {
                uni_redirect( PATH_ROOT . 'reg/select/' );
            }
        }	
				
        if (!empty($ui['Genres']))
        {
            $ui['Genres'] = make_array_keys_1( explode(',', $ui['Genres']) );
        }
        $this->mSmarty->assignByRef('ui', $ui);
        switch ($ui['Status'])
        {
	
            case 1:
                //genres list
                $genres_list = User::GetGenresList();
                $this->mSmarty->assignByRef('genres', $genres_list);	
                if($IsOther)
                {
                    if (!$act)
                    {
                        $act = 'wall';
                    }
                    //check follow
                    if($act == 'wall')
                    {
                        $IsFollow = UserFollow::GetFollow($this->mUser->mUserInfo['Id'], $ui['Id']);
                        $this->mSmarty->assign('IsFollow', $IsFollow);
                    }
                    
                }
				
                //show fan page
                switch ($act)
                {
                    case 'wall':
                        $this->mSmarty->assign('module', 'wall');
                        $this->FanWall( $ui );
                        break;

                    case 'profile':
                        $this->mSmarty->assign('module', 'profile');
                        $this->FanProfile( $ui );
                        break;

                    case 'fans':
                        $this->mSmarty->assign('module', 'fans');
                        $this->FanFans( $ui );
                        break;

                    case 'artists':
                        $this->mSmarty->assign('module', 'artists');
                        $this->FanArtists( $ui );
                        break;
												
/* 					case 'music':
                        $this->mSmarty->assign('module', 'music');
                        $this->FanMusic( $ui );
                        break;
*/
                    case 'video':
                        $this->mSmarty->assign('module', 'video');
                        $this->FanVideo( $ui );
                        break;
						
                    case 'photo':
                        $this->mSmarty->assign('module', 'photo');
                        $this->FanPhoto( $ui );
                        break;
						
                    case 'viewphotoalbum':
                        $this->mSmarty->assign('module', 'viewphotoalbum');
                        $this->FanViewPhotoAlbum( $ui );
                        break;																		
/*                    case 'events':
                        $this->mSmarty->assign('module', 'events');
                        $this->FanEvents( $ui );
                        break;						
*/						
                }

                //All Fellow artists
				$follow = UserFollow::GetFollowersUserList($this->mUser->mUserInfo['Id'], USER_ARTIST);
				
				//Top six fellow artists
				$artistCount = UserFollow::GetFollowersUserListCount($this->mUser->mUserInfo['Id'], USER_ARTIST);	
				$fellow_artist =UserFollow::GetFollowersUserList($this->mUser->mUserInfo['Id'], USER_ARTIST, 1, 9);
												
				//fans
				$fansCount = UserFollow::GetFollowersUserListCount($this->mUser->mUserInfo['Id'], USER_FAN);	
				$fellow_fans =UserFollow::GetFollowersUserList($this->mUser->mUserInfo['Id'], USER_FAN, 1, 9);			

				$this->mSmarty->assignByRef('fansCount', $fansCount);	
				$this->mSmarty->assignByRef('fellow_fans', $fellow_fans);					

				$this->mSmarty->assignByRef('artistCount', $artistCount);	
				$this->mSmarty->assignByRef('fellow_artist', $fellow_artist);	
				
                if (!$IsOther)
                {
                    //show not public info
					$videoCount = Video::GetPurchasedVideoListCount($ui['Id'], 0);
					
					$this->mSmarty->assignByRef('videoCount', $videoCount);
                    $this->mSmarty->assignByRef('video', Video::GetPurchasedVideoList($ui['Id'], 0, 1, 9));

					$photoCount = Photo::GetUserPhotosCount( $ui['Id']);
					
					$this->mSmarty->assignByRef('photoCount', $photoCount);                    
					$this->mSmarty->assignByRef('photo', Photo::GetUserPhotos( $ui['Id'], 1, 9 ));
                }
				
				$artist_arr = array();
				$follower_events =array();
	            $df = _v('df', 'tm');
				foreach($follow as $val)
				{
					array_push($artist_arr, $val['Id']);					
				}
				$follower_events = Event::FelowArtistEventList($this->mUser->mUserInfo['Id'], $artist_arr, '', 5, array('from' => date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s'), date("m"), date("d"), date("Y")))), '', array(2));
				
				$followerEventsCount = Event::FelowArtistEventListCount($this->mUser->mUserInfo['Id'], $artist_arr, array('from' => date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s'), date("m"), date("d"), date("Y")))), '', array(2));
				
				$this->mSmarty->assignByRef('followerEventsCount', $followerEventsCount);
				$this->mSmarty->assignByRef('follower_events', $follower_events);							 
				
				$this->mSmarty->assignByRef('slide', Photo::GetSliderList( $ui['Id'], $ui['Status']));
				
                $this->mSmarty->display('mods/profile/profile_fan.html');
            break;
            
            case 2: 
                //show artist page
				
                //genres list
                $genres_list = User::GetGenresList();
                $this->mSmarty->assignByRef('genres', $genres_list);				
   	            $df = _v('df', 'tm');

                //some actions for other users
                if ($IsOther)
                {
                    if (!$act)
                    {
                        $act = 'wall';
                    }
                    if($act == 'wall')
                    {
                        //check follow
                        $IsFollow = UserFollow::GetFollow($this->mUser->mUserInfo['Id'], $ui['Id']);

                        $this->mSmarty->assign('IsFollow', $IsFollow);

                        //check for active ad-hoc broadcast
                        $cache = $this->mCache->get('broadcast_u' . $ui['Name']);
                        if(!empty($cache))
                        {
                            $cache = unserialize($cache);
                            if(!empty($cache['flow']) && !empty($cache['time']) && $cache['time'] > mktime()-3*60)
                            {
                                include_once 'dev/config/wowza.php';
                                $this->mSmarty->assign('WOWZA_SERVER', WOWZA_SERVER);
                                $this->mSmarty->assign('broadcast', $cache['flow']);
								$this->mSmarty->assign('flow', $cache['flow']);
                            }
                        }
                        if($this->mUser->IsAuth())
                        {
                            //BroadcastViewers::AddViewer('u' . $ui['Name'], $this->mUser->mUserInfo['Id']);
                        }
                    }
                    if(!empty($ui['RecordLabel']))
                    {
                        $ui['RecordLabel'] =  @unserialize($ui['RecordLabel']);
                        if(empty($ui['RecordLabel'][0]))
                        {
                            $ui['RecordLabel'] = array();
                        }
                    }
                    if(!empty($ui['RecordLabelLink']))
                    {
                        $ui['RecordLabelLink'] =  @unserialize($ui['RecordLabelLink']);
                        if(empty($ui['RecordLabelLink'][0]))
                        {
                            $ui['RecordLabelLink'] = array();
                        }
                    }
                    
                    $this->mSmarty->assignByRef('ui', $ui);
                    if($act != 'events' && $act != 'eventcalendar')
                    {
                        //events
                        $this->mSmarty->assignByRef('events', Event::EventsList($ui['Id'], 1, 6, array('from' => date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s'), date("m"), date("d")-1, date("Y")))), array(), array(1, 2)));
                    }
                }

                switch ($act)
                {
                    case 'wall':
                        $this->mSmarty->assign('module', 'wall');
                        $this->ArtistWall( $ui );
                        break;
                    
                    case 'profile':
                        $this->mSmarty->assign('module', 'profile');
                        $this->ArtistProfile( $ui );
                        break;

                    case 'music':
                        $this->mSmarty->assign('module', 'music');
                        $this->ArtistMusic( $ui );
                        break;
						
					/*
					case 'play':
						$this->mSmarty->assign('module', 'music');
                        $this->PlayMusic( $ui );
                        break;
						*/

                    case 'video':
                        $this->mSmarty->assign('module', 'video');
                        $this->ArtistVideo( $ui );
                        break;

                    case 'photo':
                        $this->mSmarty->assign('module', 'photo');
                        $this->ArtistPhoto( $ui );
                        break;
					//photo payment modules
                    case 'buyphoto':
                        $this->mSmarty->assign('module', 'buyphoto');
                        $this->ArtistBuyPhoto( $ui );
                        break;			
                    case 'events':
						$this->mSmarty->assign('module', 'events');
                        $this->ArtistEvents( $ui );
                        break;
                    case 'eventcalendar':
                        $this->mSmarty->assign('module', 'events');
                        $this->ArtistEventCalendar( $ui );
                        break;
                    case 'artistevents':
                        $this->mSmarty->assign('module', 'events');
                        $this->ArtistToArtistEventAllCalendar( $ui );
                        break;						
                    case 'fans':
                        $this->mSmarty->assign('module', 'fans');
                        $this->ArtistFans( $ui );
                        break;	
                    case 'fellowartist':
                        $this->mSmarty->assign('module', 'fellowartist');
                        $this->FellowArtistFans( $ui );
                        break;						
                    case 'eventdetails':
                        $this->mSmarty->assign('module', 'events');
                        $this->eventdetails( $ui );
                        break;						
											
                }

                //locations with count fans
                $cities = UserFollow::GetFollowListByCities($ui['Id'], USER_FAN);
                $this->mSmarty->assignByRef('cities', $cities);
				

                //sum +credits
                $add_sum = ShoppingLog::GetPointsForToday($this->mUser->mUserInfo['Id']);
                $this->mSmarty->assign('add_sum', $add_sum);
                //music
				$this->mSmarty->assignByRef('musicCount', Music::GetMusicListCount( $ui['Id'], -1, 1, $this->mCache ));	
             	$this->mSmarty->assignByRef('music', Music::GetMusicList( $ui['Id'], -1, 1, 1, 5, $this->mCache ));
				$this->mSmarty->assignByRef('videoCount', Video::GetVideoListCount( $ui['Id'], 1));
                $this->mSmarty->assignByRef('video', Video::GetVideoList( $ui['Id'], 1, 1, 9));
				
                //events
				$eventCount = Event::EventsListCount($ui['Id'], array('from' => date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s'), date("m"), date("d"), date("Y")))), '1,2' );
				$events = Event::EventsList($ui['Id'], 1, 5,  array('from' => date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s'), date("m"), date("d"), date("Y")))), array(), array(1, 2));
				 
                $this->mSmarty->assignByRef('eventsCount', $eventCount);
				$this->mSmarty->assignByRef('events', $events);


				//fans
				$fansCount = UserFollow::GetFollowersUserListCount($this->mUser->mUserInfo['Id'], USER_FAN);				
				$fellow_fan =UserFollow::GetFollowersUserList($this->mUser->mUserInfo['Id'], USER_FAN, 1, 9);
				

				//artists
				$artistCount = UserFollow::GetFollowersUserListCount($this->mUser->mUserInfo['Id'], USER_ARTIST);				
				$fellow_artist =UserFollow::GetFollowersUserList($this->mUser->mUserInfo['Id'], USER_ARTIST, 1, 9);

				$this->mSmarty->assignByRef('fans', $fellow_fan);	
				$this->mSmarty->assignByRef('fansCount', $fansCount);	
				
				$this->mSmarty->assignByRef('artistfans', $fellow_artist);	
				$this->mSmarty->assignByRef('artistCount', $artistCount);										

				$this->mSmarty->assignByRef('slide', Photo::GetSliderList( $ui['Id'], $ui['Status']));		
						
				
				$this->mSmarty->assign('photoCount', Photo::GetUserPhotosCount( $ui['Id']));				
				$this->mSmarty->assignByRef('photo', Photo::GetUserPhotos( $ui['Id'], 1, 9));

                $this->mSmarty->display('mods/profile/profile_artist.html');
				
            break;
        }
    }

    public function PurchaseVideo()
    {
        $id = _v('id', 0);

        $video = Video::GetVideoInfo($id);
        $res = array('q' => OK, 'errs' => array());
        if (!$this->mUser->IsAuth())
        {
            $this->mlObj['mSession']->set('redirect', array('content' => 'video', 'id' => $id));
            $this->mlObj['mSession']->set('notice', YOU_HAVE_TO_BE_A_REGISTERED_ARTISTSFAN_COM_USER_TO . (!empty($video['Price']) ?  'buy' : 'add') . CONTENT_FROM_ARTISTS_PLEASE_SIGNUP_OR_SIGNIN_BELOW);
            $res['q'] = ERR;
            echo json_encode($res);
            exit();
        }
        $this->mlObj['mSession']->Del('redirect');
        $this->mlObj['mSession']->Del('notice');
        if (!empty($video) && $video['Active'] == 1 && $video['Deleted'] != 1)
        {
            $purchase = VideoPurchase::Get($this->mUser->mUserInfo['Id'], $id);
            if (empty($purchase))
            {
                if (empty($video['Price']) || $video['Price'] < $this->mUser->mUserInfo['Wallet'])
                {
                    //buy/add video
                    VideoPurchase::Purchase($this->mUser->mUserInfo['Id'], $video['Id'], $video['Price']);

                    if($video['Price'] > 0)
                    {
                        $sum = $this->mUser->mUserInfo['Wallet'] - $video['Price'];
                        //update wallet
                        User::UpdateWallet($this->mUser->mUserInfo['Id'], $sum);

                        //update artist's wallet
                        $artist = User::GetUser($video['UserId']);
                        if(empty($artist['Wallet']))
                        {
                            $artist['Wallet'] = 0;
                        }
                        $artist['Wallet'] = $artist['Wallet'] + $video['Price'];
                        User::UpdateWallet($artist['Id'], $artist['Wallet']);

                        //log
                        ShoppingLog::LogAdd($video['UserId'], $this->mUser->mUserInfo['Id'], 'buy_video', array('Id' => $video['Id'], 'Title' => $video['Title'], 'Price' => $video['Price']), $this->mCache);

                        //for artist transaction history
                        Payout::PayoutMoney($video['UserId'], 1, 0, $video['Price'], $artist['Wallet'], $this->mUser->mUserInfo['Id'], 1, array('type' => 'video', 'id' => $video['Id'], 'title' => $video['Title']));
                        //for fan transaction history
                        Payout::PayoutMoney($this->mUser->mUserInfo['Id'], 0, 0, $video['Price'], $sum, $this->mUser->mUserInfo['Id'], 1, array('type' => 'video', 'id' => $video['Id'], 'title' => $video['Title'], 'user_id' => $video['UserId']));
                    }
					
					$this->mSession->Set('DownloadCode',true);	
					$res['Download'] = '/base/download/Download/?id='.$id.'&act=video';
                    //fan rating
                    UserFollow::ChangeRating($this->mUser->mUserInfo['Id'], $video['UserId'], $video['Price'] > 0 ? 'buy_video' : 'add_video');
                    $res['q'] = OK;
                  //  $res['msg'] = 'This video has added to your list';					
					
                }
                else
                {
                    $res['errs'][] = YOU_DO_NOT_HAVE_ENOUGH_POINTS_IN_THE_ACCOUNT;
                }
            }
            else
            {
                $res['errs'][] = ($video['Price'] > 0) ? THIS_VIDEO_HAS_ALREADY_PURCHASED : THIS_VIDEO_HAS_ALREADY_ADDED_TO_YOUR_LIST;
            }
        }
        else
        {
            $res['errs'][] = THE_VIDEO_NOT_FOUND;
        }
        echo json_encode($res);
        exit();
    }
	
    public function PurchaseAlbum()
    {
        $id = _v('id', 0);

        $album = MusicAlbum::GetAlbum($id);
		

        $res = array('q' => OK, 'errs' => array());
        if (!$this->mUser->IsAuth())
        {
            $this->mlObj['mSession']->set('redirect', array('content' => 'album', 'id' => $id));
            $this->mlObj['mSession']->set('notice', YOU_HAVE_TO_BE_A_REGISTERED_ARTISTSFAN_COM_USER_TO. (!empty($album['Price']) ?  'buy' : 'add') . CONTENT_FROM_ARTISTS_PLEASE_SIGNUP_OR_SIGNIN_BELOW );
            $res['q'] = ERR;
            echo json_encode($res);
            exit();
        }
        $this->mlObj['mSession']->Del('redirect');
        $this->mlObj['mSession']->Del('notice');
        if (!empty($album) && $album['Active'] == 1 && $album['Deleted'] != 1)
        {
            $music = Music::GetMusicListWithPurchase($album['UserId'], $this->mUser->mUserInfo['Id'], $id, 1);
			//deb($music);
            if(!empty($music))
            {
                foreach($music as $item)
                {
                    if($item['MusicPurchase.WithAllAlbum'] == 1)
                    {
                        $res['errs'][] = ($album['Price'] > 0) ? THE_ALBUM_HAS_ALREADY_PURCHASED : THE_ALBUM_HAS_ALREADY_ADDED;
                        break;
                    }
                }
                if(empty($res['errs']))
                {
                    if (empty($album['Price']) || $album['Price'] < $this->mUser->mUserInfo['Wallet'])
                    {
                        $tracks = array();
                        $already_purchased = array();
                        foreach($music as $item)
                        {
							if($item['MusicPurchase.Id'])
                            {
                                $already_purchased[] = $item['Id'];
                            }
                            else
                            {
                                //buy/add music
                                MusicPurchase::Purchase($this->mUser->mUserInfo['Id'], $item['Id'], $item['Price'], $id);
                                $tracks[$item['Id']] = $item['Track'];
                            }
                        }
                        if(count($already_purchased) > 0)
                        {
                            //update already purchased music
                            MusicPurchase::PurchaseUpdate($this->mUser->mUserInfo['Id'], $already_purchased, $id);
                        }
                        //update wallet
                        if(count($tracks) > 0 && $album['Price'] > 0)
                        {
                            $sum = $this->mUser->mUserInfo['Wallet'] - $album['Price'];
                            User::UpdateWallet($this->mUser->mUserInfo['Id'], $sum);
                            //update artist's wallet
                            $artist = User::GetUser($album['UserId']);
                            if(empty($artist['Wallet']))
                            {
                                $artist['Wallet'] = 0;
                            }
                            $artist['Wallet'] = $artist['Wallet'] + $album['Price'];
                            User::UpdateWallet($artist['Id'], $artist['Wallet']);

                            //log
                            ShoppingLog::LogAdd($album['UserId'], $this->mUser->mUserInfo['Id'], 'buy_album', array('Id' => $album['Id'], 'Title' => $album['Title'], 'Price' => $album['Price']), $this->mCache);
                            //for artist transaction history
                            Payout::PayoutMoney($album['UserId'], 1, 0, $album['Price'], $artist['Wallet'], $this->mUser->mUserInfo['Id'], 1, array('type' => 'album', 'id' => $album['Id'], 'title' => $album['Title']));
                            //for fan transaction history
                            Payout::PayoutMoney($this->mUser->mUserInfo['Id'], 0, 0, $album['Price'], $sum, $this->mUser->mUserInfo['Id'], 1, array('type' => 'album', 'id' => $album['Id'], 'title' => $album['Title'], 'user_id' => $album['UserId']));
                        }
                        //fan rating
                        UserFollow::ChangeRating($this->mUser->mUserInfo['Id'], $album['UserId'], $album['Price'] > 0 ? 'buy_album' : 'add_album');
                        $res['q'] = OK;
                        $res['tracks'] = $tracks;
						$this->mSession->Set('DownloadCode',true);		
						$res['Download'] = '/base/profile/AblumZipDownload/?u_id='.$this->mUser->mUserInfo['Id'].'&a_id='.$id.'&download=true';
                    }
                    else
                    {
                        $res['errs'][] = YOU_DO_NOT_HAVE_ENOUGH_POINTS_IN_THE_ACCOUNT;
                    }
                }
            }
            else
            {
                $res['errs'][] = THE_ALBUM_HAS_NO_SONGS;
            }
        }
        else
        {
            $res['errs'][] = THE_ALBUM_NOT_FOUND;
        }
        echo json_encode($res);
        exit();
    }

    /**
     * Follow/Unfollow artist
     */
	public function eventdetails()
	{
        $this->mSmarty->assign('submodule', 'Events');
        $id = _v('id', 0);
	   if($_SESSION['system_uid']==false)
	   	{
		$this->mSmarty->assign('guestId', true);
		}
		if (!$id)  
        {
            //show events list
            $page = _v('page', 1);
            $pcnt = 10;
            $df = _v('df', '');
            $df = !in_array($df, array('tw', 'nw', 'tm', 'nm', 'up', 'all','pa')) ? '' : $df;
            $this->mSmarty->assignByRef('df', $df);
            $period = Event::GetPeriod($df);

            if ($this->mUser->IsAuth() && $ui['Id'] != $this->mUser->mUserInfo['Id'])
            {
                $rcnt = Event::EventsWithAttendAndPurchasedListCount( $ui['Id'], $this->mUser->mUserInfo['Id'], $period, array(2), EVENT_APPROVED);				
                $events = Event::EventsWithAttendAndPurchasedList($ui['Id'], $this->mUser->mUserInfo['Id'], $page, $pcnt, $period, array(2), EVENT_APPROVED);
            }
            else
            {
                $rcnt = Event::EventsCount($ui['Id'], $period, EVENT_APPROVED);
                $events = Event::EventsList($ui['Id'], $page, $pcnt, $period, '', '', '', EVENT_APPROVED);
				
            }


            include_once 'model/Pagging.class.php';
            $link = PATH_ROOT . 'u/'.$ui['Name'].'/events' . ($df ? '?df=' . $df : '');
            $mpg = new Pagging($pcnt, $rcnt, $page, $link);
            $pagging = $mpg->Make2($this->mSmarty, 0, 1);
            $this->mSmarty->assignByRef('pagging', $pagging);
            $this->mSmarty->assignByRef('events', $events);
            $this->mSmarty->display('mods/profile/show_artist/pricedevents.html');
        }
        else
        {
            //show one event
            $event = Event::GetEvent($id, $ui['Id']);
            if (empty($event) || $event['Deleted'] == 1)
            {
                uni_redirect(PATH_ROOT . 'u/'.$ui['Name'].'/events');
            }
            if ($this->mUser->IsAuth() && $ui['Id'] != $this->mUser->mUserInfo['Id'])
            {
                $event['EventAttend'] = EventAttend::Get($this->mUser->mUserInfo['Id'], $id);
                $event['EventPurchase'] = EventPurchase::Get($this->mUser->mUserInfo['Id'], $id);
                if($event['EventType'] != LIVE_EVENT && $event['Status'] == 4 && !empty($event['EventPurchase']['Id']))
                {
                    //get broadcast recordings list
                    $video = EventVideo::GetListEventVideo($id);
                    $this->mSmarty->assignByRef('recordings', $video);
                }
            }

			
            $this->mSmarty->assignByRef('event', $event);
            $this->mSmarty->display('mods/profile/show_artist/pricedevent_one.html');
        }
        exit();
    }
		 
    public function Follow()
    {
	  $redirect = $this->GetRedirectUrl();
	 if($_REQUEST['ajaxMode'])
	 {
        $res = array('q' => ERR);
        //check auth
        if (!$this->mUser->IsAuth())
        {
            echo json_encode($res);
            exit();
        }

        //check user
        $user_id_follow = _v('user_id_follow', 0);

        if ($user_id_follow)
        {
            $ui = User::GetUser( $user_id_follow );
            if (!empty($ui)/* && $ui['Status']==2*/)
            {
                //we can follow artists only
                $follow = UserFollow::GetFollow($this->mUser->mUserInfo['Id'], $ui['Id']);
                if (empty($follow))
                {
                    //follow
                    $mUf = new UserFollow();
                    $mUf->setUserId( $this->mUser->mUserInfo['Id'] );
                    $mUf->setUserIdFollow($user_id_follow);
                    $mUf->save();
					$fromuser 	= User::GetUserFullInfo($this->mUser->mUserInfo['Id']);
					$touser 	= User::GetUserFullInfo($user_id_follow);
					
					
			        $uFollowersCount = UserFollow::GetFollowersUserCount($this->mUser->mUserInfo['Id'], USER_ARTIST);	
					$this->mSmarty->assign('uFollowersCount', $uFollowersCount);

					if($touser['Status']==USER_ARTIST)
					{					
						$artistSince = date('Y', $touser['RegDate'])-$touser['YearsActive'] ;
						$this->mSmarty->assign('artistSince', $artistSince);
					}
					$purcahsedMusicAlbumCount = Music::GetPurchasedAlbumIdByUserId($this->mUser->mUserInfo['Id']);

					$this->mSmarty->assign('purcahsedMusicAlbumCount', count($purcahsedMusicAlbumCount));

					$this->mSmarty->assign('avatar', $this->mUser->mUserInfo['Avatar']);
					
					$userName = $this->mUser->mUserInfo['BandName'] ?  $this->mUser->mUserInfo['BandName'] :  $this->mUser->mUserInfo['FirstName'].' '. $this->mUser->mUserInfo['LastName'];		

					if($touser['Email'])
					{				
						$this->mSmarty->assign('fromuser', $fromuser);
						$this->mSmarty->assign('touser', $touser);
						$fromEmail = ADMIN_EMAIL;
						$fromName = SITE_NAME;
						$toEmail = $touser['Email'];
						$toName = $touser['Name'];
						
						$sub = ($fromuser['Status']==USER_FAN)?NEW_FOLLOWER_FROM:NEW_FRIEND_FROM;						
						$subject = $sub.' '.$userName.' From '.SITE_NAME;
						
						$message = $this->mSmarty->fetch('mails/follow_add_notification.html');

						sendEmail($fromEmail,$fromName,$toEmail, $toName, $subject, $message);						
					}					
					

                    //clear cache followers count
                    $this->mCache->set('count_followers' . $user_id_follow, '', 1); 

                    //log - for artists only
                    if($ui['Status']==2 || $ui['Status']==1 )
                    {
			
			if($this->mUser->mUserInfo['Status'] == 1)
			{
				    $iconClass = 'icon_04';
			}else{
					$iconClass = 'icon_05';
			}

			$mesg	=	 '<a href="/u/'.$this->mUser->mUserInfo['Name'].'"  class="'.$iconClass.'">'.$userName.'</a> is now following '.$ui['FirstName'].'';


						$wallConfirmation = Wall::Add( $ui['Id'],  $this->mUser->mUserInfo['Id'], $mesg, '', '', 1 );		
														
                        ShoppingLog::LogAdd($user_id_follow, $this->mUser->mUserInfo['Id'], 'follow', '', $this->mCache);						
						
						$followers	=	UserFollow::GetFollowersUserList( $this->mUser->mUserInfo['Id'] );	
												
						if($wallConfirmation)
						{														
							 Notification::Add( $wallConfirmation, $comment_id='', $mesg, $ui['Id'] );																	
						 }						
						
                    }

                    $res['q'] = OK;
                    $res['data'] = 1;
					$res['status'] = $ui['Status'];
                }
                else
                {
                    //unfollow
                    UserFollowQuery::create()->select('Id')->filterById($follow)->delete();
                    //clear cache followers count
                    $this->mCache->set('count_followers' . $user_id_follow, '', 1);
                    //log - for artists only						
						
                    					
                    $res['q'] = OK;
                    $res['data'] = 2;
					$res['status'] = $ui['Status'];					
                }
            }
        }
        echo json_encode($res);
	 } 
	 else 
	 {
			uni_redirect(PATH_ROOT . 'u/'.$this->mUser->mUserInfo['Name']);
	 }		
   }

     
    /**
     * Post something to artist/
     */ 
    public function WallPost()
    {

      $redirect = $this->GetRedirectUrl();
		
	  if($_REQUEST['ajaxMode'])
	  {	
        if (!$this->mUser->IsAuth())
        {
            echo json_encode(array('q' => ERR, 'msg'=> NO_AUTH ));
            exit();
        }
        
        $id = _v('id', 0);
        $mesg = trim( strip_tags(_v('mesg', '')) );
		$image = trim( strip_tags(_v('image', '')) );
		$video = trim( strip_tags(_v('video', '')) );
		
		if($mesg == 'Say something...')
		{
			$mesg ='';
		}
		
		if($image && file_exists($this->GetRootPath().'/'.$image)) {
			$imgNameArr = explode('/', $image);
			$imgName = array_pop($imgNameArr);
			$orginalImage = 'files/wall/orginal/'.$imgName;
			$thumbImage = 'files/wall/thumb/'.getJpgFileName($imgName);
			//copy($this->GetRootPath().'/'.$image, $orginalImage);
			include_once $this->GetRootPath() . 'libs/Crop/Image_Transform.php';
            include_once $this->GetRootPath() . 'libs/Crop/Image_Transform_Driver_GD.php';
			
			i_crop_copy(WALL_PHOTO_THUMB_WIDTH, WALL_PHOTO_THUMB_HEIGHT, $this->GetRootPath().'/'.$image,
                                $this->GetRootPath() . '/'.$thumbImage, 1);
			i_crop_copy(WALL_PHOTO_WIDTH, WALL_PHOTO_HEIGHT, $this->GetRootPath().'/'.$image,
                                $this->GetRootPath() . '/'.$orginalImage, 1);
			@unlink($this->GetRootPath().'/'.$image);
		} else {
			$imgName = '';
		}
        if (!$id)
        {
            echo json_encode(array('q' => ERR , 'msg'=>'No user'));
            exit();
        }
        
        if ($id != $this->mUser->mUserInfo['Id'])
        { 
            $ui = User::GetUser( $id );
            if (empty($ui))
            {
                echo json_encode(array('q' => ERR, 'msg'=>'No user'));
                exit();
            }
        }
        
        if($image == '' && $video=='')
		{
			if (empty($mesg))
        	{
            	echo json_encode(array('q' => ERR, 'msg'=>PLEASE_SPECIFY_MESSAGE_TEXT));
            	exit();
        	}
        }
        //security
        if (!empty($_SESSION['last_mesg_time']) && mktime()-$_SESSION['last_mesg_time'] < 2)
        {
            echo json_encode(array('q' => 'err', 'msg'=> YOU_ARE_SENDING_TOO_MANY_MESSAGES_PLEASE_WAIT_A_FEW_SECONDS));
            exit();
        }
		
		$wallConfirmation = Wall::Add( $id, $this->mUser->mUserInfo['Id'], $mesg, $imgName, $video, 0 , $this->mCache   );		
		$followers	=	UserFollow::GetFollowersUserList( $this->mUser->mUserInfo['Id'] );	
		if($wallConfirmation)
		{
				 Notification::Add($wallConfirmation, 0, '', $ui['Id'] );				 
				 $this->mCache->set($ui['Id'].'_notification', 1);
		}
		
		$_SESSION['last_mesg_time'] = mktime();
        //re-post to twitter
        if ($id == $this->mUser->mUserInfo['Id'] && !empty($this->mUser->mUserInfo['TwOauthToken']) && !empty($this->mUser->mUserInfo['TwOauthTokenSecret']) && !empty($this->mUser->mUserInfo['TwOn']))
        {
            require_once('libs/twitteroauth/twitteroauth.php');
            $tweet = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, $this->mUser->mUserInfo['TwOauthToken'], $this->mUser->mUserInfo['TwOauthTokenSecret']);
            $tweet->post('statuses/update', array('status' => $mesg));
        }
        //re-post to facebook
        if ($id == $this->mUser->mUserInfo['Id'] && !empty($this->mUser->mUserInfo['FbId']) && !empty($this->mUser->mUserInfo['FbOn']))
        {
            require_once 'libs/facebook-php-sdk/src/facebook.php';
            $facebook = new Facebook(array('appId'  => FACEBOOK_API_ID, 'secret' => FACEBOOK_API_SECRET));
            $token = !empty($this->mUser->mUserInfo['FbToken']) ? $this->mUser->mUserInfo['FbToken'] : $facebook->getAccessToken();

		    try
            {
                $facebook->api('/'.$this->mUser->mUserInfo['FbId'] . '/feed', 'POST', array('access_token' => $token, 'message' => $mesg, 'link' => 'http://' . DOMAIN . '/u/' . $this->mUser->mUserInfo['Name']));
            }
            catch(FacebookApiException $e)
            {
            }
			
        }
        
        echo json_encode(array('q' => OK ));
        exit();   
	  } 
	  else 
	  {
		uni_redirect(PATH_ROOT . 'u/'.$this->mUser->mUserInfo['Name']);
	  }		
    }
	
	public function AddWallComment()
	{
	

      $redirect = $this->GetRedirectUrl();
		
	  if($_REQUEST['ajaxMode'])
	  {	
		if (!$this->mUser->IsAuth())
        {
            echo json_encode(array('q' => ERR , 'msg'=>NO_AUTH));
            exit();
        }
        
        $mesg = trim( strip_tags(_v('mesg', '')) );
		$wallId = _v('wallId', '0');
		$otherUserId = _v('id', 0);
		$fancyBox = $_REQUEST['fancybox'];
		
        $id = $this->mUser->mUserInfo['Id'];
        
		if(!$wallId){
			echo json_encode(array('q' => ERR, 'msg'=> NO_VALID_PARAMETERS ));
            exit();
		}
        if (empty($mesg))
        {
            echo json_encode(array('q' => ERR , 'msg'=> PLEASE_SPECIFY_MESSAGE_TEXT ));
            exit();
        }
        
        //security
        if (!empty($_SESSION['last_comment_time']) && mktime()-$_SESSION['last_comment_time'] < 2)
        {
            echo json_encode(array('q' => ERR, 'msg'=>YOU_ARE_SENDING_TOO_MANY_MESSAGES_PLEASE_WAIT_A_FEW_SECONDS));
            exit();
        }
        
        $commentId = Comment::Add( $id, WALL, $wallId, $mesg);
		Wall::UpdateWallTime($wallId);
		if($commentId)
		{
		 	Notification::Add( 0, $commentId, '', $ui['Id'] );
			$this->mCache->set($ui['Id'].'_notification', 1);
		}

		$this->mCache->set($id. '_wall_post_last', $wallId, mktime());
		if ($otherUserId && $otherUserId != $id)
        {
			$this->mCache->set($otherUserId. '_wall_post_last', $wallId, mktime());
        }
		$limit = _v('limit');
		if(!empty($limit)){ $seemore = $limit;	}else{$seemore = 5;}
			
		$commentList = Comment::getComment($commentId,$start=0,$seemore);


		$this->mSmarty->assign('commentList', $commentList);

		$wall = Wall::GetWallById($wallId,$start=0,5);
	
		$this->mSmarty->assign('wall', $wall);
		if($fancyBox) {			
		$fancyComment = $this->mSmarty->fetch('ajax/_wall_Appended.html');		
					} else {
		$fancyComment = $this->mSmarty->fetch('ajax/_wall_ajax.html');							
					}
        $_SESSION['last_comment_time'] = mktime();
        echo json_encode(array('q' => OK,  'fancyComment' => $fancyComment));
        exit(); 
	  } 
	  else 
	  {
		uni_redirect(PATH_ROOT . 'u/'.$this->mUser->mUserInfo['Name']);
	  }		
	}
    
    public function SeeMoreComments()
	{
      $redirect = $this->GetRedirectUrl();
	  if($_REQUEST['ajaxMode'])
	  {	
		if (!$this->mUser->IsAuth())
        {
            echo json_encode(array('q' => ERR, 'msg'=> NO_AUTH ));
            exit();
        }
        
        $mesg = trim( strip_tags(_v('mesg', '')) );
		$wallId = _v('wallId', '0');
		$otherUserId = _v('id', 0);
		$fancyBox = _v('fancybox', '0');
		$start = _v('start', '0');	
		$lateCmntId = _v('lateCmntId', '0');	
		
		$this->mSmarty->assign('lateCmntId', $lateCmntId);
				
			
		
        $id = $this->mUser->mUserInfo['Id'];
        
		if(!$wallId){
			echo json_encode(array('q' => ERR, 'msg'=> NO_VALID_PARAMETERS ));
            exit();
		}
        
        
		$limit = _v('limit', 0);
		$wallId = _v('wallId', 0);	
		$cmttype = _v('cmttype', 0);								
		if($limit){ $seemore = $limit;	}else{$seemore = 5;}

		$commentList = Comment::GetCommentList($cmttype,$wallId,$start,$seemore,$lateCmntId);

		
		$this->mSmarty->assign('commentList', $commentList);

		//$wall = Wall::GetWallById($wallId,0,$seemore);
		$wall['commentList'] = $commentList;
	
		$this->mSmarty->assign('wall', $wall);
			
		$fancyComment = $this->mSmarty->fetch('ajax/_wall_ajax.html');
        $_SESSION['last_comment_time'] = mktime();
        echo json_encode(array('q' => OK,  'comment' => $fancyComment));
        exit(); 
	  } 
	  else 
	  {
		uni_redirect(PATH_ROOT . 'u/'.$this->mUser->mUserInfo['Name']);
	  }				
	}
	public function SeeMoreWallComments()
		{

      $redirect = $this->GetRedirectUrl();
	  if($_REQUEST['ajaxMode'])
	  {	
		if (!$this->mUser->IsAuth())
        {
            echo json_encode(array('q' => ERR, 'msg'=>NO_AUTH));
            exit();
        }
        
        $mesg = trim( strip_tags(_v('mesg', '')) );
		$wallId = _v('wallId', '0');
		$otherUserId = _v('id', 0);
		$fancyBox = _v('fancybox', '0');
		$start = _v('start', '0');	
		$lateCmntId = _v('lateCmntId', '0');	
		
		$this->mSmarty->assign('lateCmntId', $lateCmntId);
				
			
		
        $id = $this->mUser->mUserInfo['Id'];
        
		if(!$wallId){
			echo json_encode(array('q' => ERR , 'msg'=> NO_VALID_PARAMETERS ));
            exit();
		}        
        
		$limit = _v('limit', 0);
		$wallId = _v('wallId', 0);	
		$cmttype = _v('cmttype', 0);								
		if($limit){ $seemore = $limit;	}else{$seemore = 5;}

		$commentList = Comment::GetCommentList($cmttype,$wallId,$start,$seemore,$lateCmntId);

		
		$this->mSmarty->assign('commentList', $commentList);

		//$wall = Wall::GetWallById($wallId,0,$seemore);
		$wall['commentList'] = $commentList;
	
		$this->mSmarty->assign('wall', $wall);
			
		$fancyComment = $this->mSmarty->fetch('ajax/_popupwall_one.html');
        $_SESSION['last_comment_time'] = mktime();
        echo json_encode(array('q' => OK ,  'comment' => $fancyComment));
        exit(); 
	  } 
	  else 
	  {
		uni_redirect(PATH_ROOT . 'u/'.$this->mUser->mUserInfo['Name']);
	  }							
		}
    /**
     * Get wall data
     */
    public function WallLoad()
    {

      $redirect = $this->GetRedirectUrl();
	  if($_REQUEST['ajaxMode'])
	  {	
        $id = _v('id', 0);
        $after_id = _v('after_id', 0);
        $before_id = _v('before_id', 0);
        $log_last_id = _v('log_last_id', 0);
        $items_count = 10;		
        if (!$id)
        {
            echo json_encode(array('q' => ERR, 'msg'=>WRONG_USER_ID));
        }

        //check  - is it need to request to db?
        $req_wall = 1;
        $req_log = 1;
		
        if(!$before_id && $after_id)
        {
            $cache_post_id = $this->mCache->get($id . '_wall_post_last', 30*24*60*60);
					
            if(empty($cache_post_id) || $cache_post_id == $after_id)
            {
                $req_wall = 0;
            }
            $cache_log_id = $this->mCache->get($id . '_wall_log_last', 30*24*60*60);
            if(empty($cache_log_id) || $cache_log_id == $log_last_id)
            {
                $req_log = 0;
            }
        }
        

        $wall = array();
        $log = array();
        $artist = '';
        
        if($req_wall || $req_log)
        {
            $owner_status = 0;

            if($id != $this->mUser->mUserInfo['Id'])
            {
                $owner = User::GetUserName($id);
                $artist = $owner['BandName'] ? $owner['BandName'] : $owner['FirstName'] . ' ' . $owner['LastName'];
                $owner_status = $owner['Status'];
            }
            else
            {
                $owner_status = $this->mUser->mUserInfo['Status'];
                $artist = '';
            }
        }

        if($req_wall)
        {
            $wall = Wall::GetList( $id, $after_id, $before_id, $items_count);
			foreach($wall as &$item){
				if(strstr($item['Mesg'], '{artist}')){
					if($item['Uid'] == $this->mUser->mUserInfo['Id']){
						$item['Mesg'] = str_replace('{artist}', "your's", $item['Mesg']);
					} else {
						$artistName = $item['ArtistBand'] ? $item['ArtistBand'] : $item['ArtistName'];
						$item['Mesg'] = str_replace('{artist}', $artistName, $item['Mesg']);
					}
				}
			}
        }
        if($req_log && $owner_status != 1)
        {
            //log only for artists wall
            $ids = array();
            $wdate = array();
            $log_from_cache = array();
            if(count($wall) > 0)
            {
                foreach($wall as $item)
                {
                    //try to get post log from cache
                    $post_log = $this->mCache->get($id . '_wall_post_' . $item['Id'], 12*60*60);
                    if(!empty($post_log))
                    {
                        $log_from_cache[$item['Id']] = unserialize($post_log);
                    }
                    else
                    {
                        $ids[] = $item['Id'];
                        $wdate[$item['Id']] = $item['cdate'];
                    }
                }
            }
            if($after_id)
            {
                $ids[] = $after_id; //latest wall post
            }
        }
        $fanscount = UserFollow::GetFollowersCount($id, '', $this->mCache);

		$this->mSmarty->assign('wallInfo', $wall);
        $this->mSmarty->assign('log', $log='');
		$this->mSmarty->assign('artist', $artist);
		
		require_once(BPATH.'libs/video/EmbededVideo.php');
		$videoObj=new EmbededVideo();
		$this->mSmarty->assign('videoObj', $videoObj);
		
		$wallDetail = $this->mSmarty->fetch('ajax/wall.html');		
		$count = 0;
		if($wall) {
			$count = $wall[0]['cnt_all'];
		} 		        
        echo json_encode(array('q'=>OK, /*'data'=>$wall,*/ 'countAll' => $count,  'log' => $log, 'artist' => $artist, 'wallDetail' => $wallDetail, 'fanscount' => $fanscount));
        exit();
		
	  } 
	  else 
	  {
		uni_redirect(PATH_ROOT . 'u/'.$this->mUser->mUserInfo['Name']);
	  }			
    }


    /**
     * Get wall notes from featured artists walls for main page
     */
    public function WallLoadMain()
    {

      $redirect = $this->GetRedirectUrl();
		
  	  if($_REQUEST['ajaxMode'])
	  {	
        $after_id = _v('after_id', 0);
        $items_count = 4;

        $wall = Wall::GetFeaturedList( $after_id, 0, $items_count);

        echo json_encode(array('q'=> OK , 'data'=>$wall));
        exit();
	  } 
	  else 
	  {
		uni_redirect(PATH_ROOT . 'u/'.$this->mUser->mUserInfo['Name']);
	  }			
    }

    /**
     * Get news feed data
     */
    public function FeedLoad()
    {
      $redirect = $this->GetRedirectUrl();
		
  	  if($_REQUEST['ajaxMode'])
	  {		
        $after_id = _v('after_id', 0);
        $before_id = _v('before_id', 0);
        $status = _v('status', 0);
        $items_count = 10;

        $wall = array();

		if($this->mUser->mUserInfo['Status']==USER_FAN)
		{
	        $users = UserFollow::GetFollowersUserListIds($this->mUser->mUserInfo['Id'], $status);	
		}
		else
		{			
			$users = UserFollow::GetFollowersUserListIds($this->mUser->mUserInfo['Id'], USER_ARTIST);			
		}
		
		$users =array_keys(make_assoc_array($users, 'Id'));
		
		if($status == 0)
		{
			array_push($users, $this->mUser->mUserInfo['Id']);
		}

        if(count($users) > 0)
        {
			$usr_id = $this->mUser->mUserInfo['Id'];
            $wall = Wall::GetNewsFeed( $users, $after_id, $before_id, $items_count, $usr_id);
        }
		
		require_once(BPATH.'libs/video/EmbededVideo.php');
		$videoObj=new EmbededVideo();
		$this->mSmarty->assign('videoObj', $videoObj);


		$this->mSmarty->assign('wallInfo', $wall);	
		$wallDetail = $this->mSmarty->fetch('ajax/_feed_wall.html');
		
		$count = 0;
		if($wall) {
			$count = $wall[0]['cnt_all'];
		}

		
        echo json_encode(array('q'=> OK , 'countAll' => $count, 'wallDetail' => $wallDetail));
        exit();
	  } 
	  else 
	  {
		uni_redirect(PATH_ROOT . 'u/'.$this->mUser->mUserInfo['Name']);
	  }		
    }
    

    /**
     * Show Artist music
     */
    private function ArtistMusic( &$ui )
    {
		$this->mSmarty->assign('submodule', 'Music');
        $id = _v('id', 0);
 	    $a_id = _v('a_id', 0);
		
		$page = _v('page', 1);
        $pcnt = 10;
		if($_SESSION['system_uid']==false)
	   	{
		$this->mSmarty->assign('guestId', true);
		}
		$userStatus	=	User::GetUser($_SESSION['system_uid']);		
		$this->mSmarty->assign('userStatus', $userStatus['Status']);		
		$IsFollow1 = UserFollow::GetFollow($_SESSION['system_uid'],$ui['Id']);	
	//deb($IsFollow1);
				
		$this->mSmarty->assign('IsFollow1', $IsFollow1);						
		
        if ($id)
        {
            $album = MusicAlbum::GetAlbum($id, 1, 1, $this->mUser->mUserInfo['Id'], 1);
			if (empty($album) || $album['UserId'] != $ui['Id'] || empty($album['Active']) || $album['Deleted'] == 1 || $album['Tracks']==0)
            {
                $id = 0;
                $album = array();
            }
        }

        if (!$id)
        {
			$albums	= MusicAlbum::GetArtistAlbumList($ui['Id'] , $this->mUser->mUserInfo['Id'], $page, $pcnt, 1);	
			//deb($albums);
			$rcnt =	MusicAlbum::GetArtistAlbumListCount($ui['Id'] , $this->mUser->mUserInfo['Id']);		
			
            $this->mSmarty->assignByRef('albums',$albums );
			// Pagging
			include_once 'model/Pagging.class.php';
			$link = PATH_ROOT . 'u/'.$ui['Name'].'/music';
						
			$mpg = new Pagging($pcnt, $rcnt, $page, $link);
			
			$pagging = $mpg->Make2($this->mSmarty, 0, 1);

			
			$this->mSmarty->assignByRef('pagging', $pagging);
			
			
			$this->mSmarty->assign('page', $page);
			$this->mSmarty->assign('pcnt', $pcnt);
			

            //tracks without albums
            if ($this->mUser->IsAuth() && $ui['Id'] != $this->mUser->mUserInfo['Id'])
            {
				if($albums)
				{
					foreach($albums as $val)
					{
						
						$tracks	=	Music::GetMusicListWithPurchase($ui['Id'], $this->mUser->mUserInfo['Id'], $val['Id'], 1, 0, 0, 1);
	
						$co = 1;
						foreach($tracks as $tra)
						{	
							if(!empty($tra['MusicPurchase.Id'])){
							if($co==count($tracks))
								{						
									$Buyed = true;
								}
								$co++;
							}	
								
						}
					} // 0, 1, 0, 0, 1);		
				}	
                $this->mSmarty->assignByRef('Buyed', $Buyed );			
                $this->mSmarty->assignByRef('tracks', $tracks );
			
            }
            else
            {
                $this->mSmarty->assignByRef('tracks', Music::GetMusicList($ui['Id'], 0, 1, 0, 0, 0, 1));
            }
            $this->mSmarty->display('mods/profile/show_artist/music.html');
        }
        else
        {
            //tracks
            if ($this->mUser->IsAuth() && $ui['Id'] != $this->mUser->mUserInfo['Id'])
            {
			
			  $track = Music::GetMusicListWithPurchase($ui['Id'], $this->mUser->mUserInfo['Id'], $id, 1);
              $this->mSmarty->assignByRef('tracks',  $track);
            }
            else
            {
             	 $tracks = $this->mSmarty->assignByRef('tracks', Music::GetMusicList($ui['Id'], $id, 1));
				
		    }
			if($a_id && $_REQUEST['ajaxMode'])
			{
				$res['q'] = OK; 
				$res['data'] = $this->mSmarty->fetch('mods/profile/show_artist/ajax/album_track.html');		
				echo json_encode($res);
				exit(); 					
			}
			else
			{
				$this->mSmarty->assignByRef('album', $album);
	
				//deb($album);
				$this->mSmarty->assign('ui', $ui);
				$this->mSmarty->assign('id', $id);
				$albums = $this->mSmarty->display('mods/profile/show_artist/music_album.html');
				
			}
        }
        exit();
    }
	 /**
     * Show Artist music
     */	
	 
	public function AblumZipDownload()
	{
	
		$DownloadCode = $this->mSession->Get('DownloadCode');
		if($DownloadCode) { 
		unset($_SESSION['DownloadCode']);
		$u_id = _v('u_id', 0);
 	    $a_id = _v('a_id', 0);
		$download	=	$_REQUEST['download'];
		
		if($download)
		{
			$album = MusicAlbum::GetAlbum($a_id, 0, 1);	
			$TrackListedarray = Music::GetMusicListWithPurchase($album['UserId'], $this->mUser->mUserInfo['Id'], $a_id, 1);
			$albumName	=	trim($this->safeFile($album['Title']), '-');
			$zipFile = BPATH.'files/track/u/'.$album['UserId'].'/'.$albumName.'.zip';	
			$files = $TrackListedarray;
			//deb($files);
			$zipname = $zipFile;
			$zip = new ZipArchive;
			$zip->open($zipname, ZipArchive::CREATE);
		foreach ($files as $file)
		{
		  $musicName = trim($this->safeFile($file['Title']), '-');	
		  $zip->addFile(BPATH.$file['Track'], $musicName.'.mp3');		  
		}
		
		$zip->close();				
		header('Content-Type: application/zip');
		header('Content-disposition: attachment; filename='.$albumName.'.zip');
		header('Content-Length: ' . filesize($zipname));
		readfile($zipname);
		}
		}else {
		$this->NotFound();
		exit;
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
	
	 
    public function ArtistMusicByAlbum()
    {
	
       // $this->mSmarty->assign('submodule', 'Music');		
	    
		$u_id = _v('u_id', 0);
 	    $a_id = _v('a_id', 0);
		$ExistingAlbum	=	$_REQUEST['ExistingAlbum'];	
		// deb($a_id);

		if($_SESSION['system_uid']==false)
	   		{
			$this->mSmarty->assign('guestId', true);
			}
			
		$ui =& $this->mUser->mUserInfo;
		$IsFollow1 = UserFollow::GetFollow($ui['Id'],$u_id);			
		$this->mSmarty->assign('IsFollow1', $IsFollow1);	
        if ($a_id && $_REQUEST['ajaxMode'])
        {
            $album = MusicAlbum::GetAlbum($a_id, 1, 1);
            if (empty($album) || $album['UserId'] != $u_id || empty($album['Active']) || $album['Deleted'] == 1)
            {
                $id = 0;
                $album = array();
            }
            //tracks
            if ($this->mUser->IsAuth() && $u_id != $this->mUser->mUserInfo['Id'])
            {
				$trackajax	=	Music::GetMusicListWithPurchase($u_id, $this->mUser->mUserInfo['Id'], $a_id, 1);
				$this->mSmarty->assignByRef('album',$album);
                $this->mSmarty->assignByRef('tracks',$trackajax);
				
            }
            else
            {
			   $this->mSmarty->assignByRef('album',$album);
               $track = $this->mSmarty->assignByRef('tracks', Music::GetMusicList($u_id, $a_id, 1, 0, 0, 0, $u_id));
			
            }
			
            if ($this->mUser->IsAuth())
            {
                $this->mSmarty->assign('IsAuth', 1);
                $this->mSmarty->assign('UserInfo', $this->mUser->mUserInfo);
            }		
			$IsOther = $u_id;
			$this->mSmarty->assign('IsOther', $IsOther);
			$this->mSmarty->assign('ExistingAlbum', $ExistingAlbum);			
			$res['q'] = OK; 
			$res['data'] = $this->mSmarty->fetch('mods/profile/show_artist/ajax/album_track.html');		

			echo json_encode($res);
			exit(); 
		}					
    }
	public function ArtisttwoArtistAlbumTrackList()
	{
      $redirect = $this->GetRedirectUrl();
		
  	  if($_REQUEST['ajaxMode'])
	  {	
       // $this->mSmarty->assign('submodule', 'Music');		
 	    $a_id = _v('a_id', 0);
		if($_SESSION['system_uid']==false)
	   		{
			$this->mSmarty->assign('guestId', true);
			}
			

        if ($a_id)
        {
            //show album
            //tracks			
            if ($this->mUser->IsAuth() && $u_id != $this->mUser->mUserInfo['Id'])
            {
				$trackajax	=	Music::GetTrackByAlbumId($a_id);
				$this->mSmarty->assignByRef('tracks',$trackajax);		
				
            }  

            if ($this->mUser->IsAuth())
            {
                $this->mSmarty->assign('IsAuth', 1);
                $this->mSmarty->assign('UserInfo', $this->mUser->mUserInfo);
            }		
			
			
			$IsOther = $u_id;
			$this->mSmarty->assign('IsOther', $IsOther);
			$this->mSmarty->assign('ExistingAlbum', $ExistingAlbum);			
	         $ui =& $this->mUser->mUserInfo;
	 	     $IsFollow1 = UserFollow::GetFollow($ui['Id'], $this->mUser->mOtherUserId);
			 if(empty($IsFollow1))
		 		{
				$IsFollow1	=	1;
				}
    		 $this->mSmarty->assign('IsFollow1', $IsFollow1);         			
			 $res['q'] = OK; 
			 $res['data'] = $this->mSmarty->fetch('mods/profile/show_fan/ajax/album_track.html');		
			 echo json_encode($res);
			 exit(); 
		}	
	  } 
	  else 
	  {
		uni_redirect(PATH_ROOT . 'u/'.$this->mUser->mUserInfo['Name']);
	  }						
    } 

		
    /**
     * Show Artist video
     */
    private function ArtistVideo( &$ui )
    {
        $this->mSmarty->assign('submodule', 'Video');
        $res = array('q' => OK );				
        $id = _v('id', 0);		
		$page = _v('page', 1);		
		$video_type= _v('video_type', '');

		$pcnt = _v('pcnt', !empty($_SESSION['vpcnt']) ? $_SESSION['vpcnt'] : 6);

       // $_SESSION['vpcnt'] = $pcnt;
	   if($_SESSION['system_uid']==false)
	   	{
		$this->mSmarty->assign('guestId', true);
		}

		if(!$id){
			$videoId = Video::GetLatestVideo( $ui['Id'], 1);
			$id = $videoId['Id'];
		}
	
        if ($video_type)
        {
			$video = Video::GetVideoList( $ui['Id'], 1,  $page, $pcnt );	
			
            //videos
            if ($this->mUser->IsAuth() && $ui['Id'] != $this->mUser->mUserInfo['Id'])
            {
				$video = Video::GetVideoRelatedListAlongPaggination($ui['Id'], 1, $video_type, $page, $pcnt);
                $this->mSmarty->assignByRef('video', $video['list']);			
            }
            else
            {		
			    $this->mSmarty->assignByRef('video', $video['list']);
            }
			$rcnt = $video['rcnt'];
			include_once 'model/Pagging.class.php';	
            $link = 'oUsers.ShowArtistVideo';//PATH_ROOT . 'u/'.$ui['Name'].'/video';					
			$mpg = new Pagging($pcnt, $rcnt, $page, $link);			
			$res['pagging'] = $mpg->Make($this->mSmarty, 1);
            $res['page'] = $page;
			$this->mSmarty->assignByRef('pagging', $res['pagging']);

						
			if($_REQUEST['page'])
			{
				$res['data'] = $this->mSmarty->fetch('mods/profile/show_artist/ajax/video.html');
				echo json_encode($res);
				exit();
			} 
			else
			{		
				$this->mSmarty->display('mods/profile/show_artist/video.html');
				exit;
			}
		}
        else
        {
            $this->mSmarty->assign('submodule', 'VideoOne');
            $video = Video::GetVideoInfo($id, $ui['Id'], 1);

			
			//Video Type as music video & youtube video
			$Relatedvideo = Video::GetVideoRelatedListAlongPaggination($ui['Id'],1);
	
			//Video Type as recorded live stream
			$streamVideo = Video::GetVideoRelatedListAlongPaggination($ui['Id'], 1, RE_LIVE_STREAM);			

			//end
            //show one video

			
/*            if (empty($video) || empty($video['Active']) || $video['Deleted'] == 1 || $video['Status'] < 2)
            {
					$this->mSmarty->display('mods/profile/show_artist/noVideo.html');
					exit();	
            }*/
            if ($this->mUser->IsAuth() && $ui['Id'] != $this->mUser->mUserInfo['Id'] && $video)
            {
                $video['VideoPurchase'] = VideoPurchase::Get($this->mUser->mUserInfo['Id'], $id);
            }

            $this->mSmarty->assignByRef('video', $video);
			$this->mSmarty->assignByRef('Relatedvideoui', $ui);			
			$this->mSmarty->assignByRef('Relatedvideo', $Relatedvideo['list']);	

			$this->mSmarty->assignByRef('streamVideo', $streamVideo['list']);				

			$vidCnt = Video::videoCount($id);
			if($_REQUEST['video_page'])
			{	
			
					$res['data'] = $this->mSmarty->fetch('mods/profile/show_artist/ajax/video_one.html');
					echo json_encode($res);
					exit();		
			} 
			else
			{	
           	 	$this->mSmarty->display('mods/profile/show_artist/video_one.html');
			}
        }
        exit();
    }
	
    /**
     * Show Artist video
     */
    private function ArtistFans( &$ui )
    {
        $this->mSmarty->assign('submodule', 'Fans');
   	 
		$this->mSmarty->assignByRef('fans', UserFollow::GetFollowersUserList($ui['Id'], USER_FAN));
			
        $this->mSmarty->display('mods/profile/show_artist/fans.html');
        exit();
    }

    private function FellowArtistFans( &$ui )
    {
        $this->mSmarty->assign('submodule', 'FellowArtist');
	  
		$this->mSmarty->assignByRef('fellow_artist', UserFollow::GetFollowersUserList($ui['Id'], USER_ARTIST));
			
        $this->mSmarty->display('mods/profile/show_artist/fellowartistfans.html');
        exit();
    }
		
	public function WaterMark()
	{
		extract($_REQUEST);
		$orgImage =	BPATH.'/files/photo/mid/'.$u.'/'.$ph.'';		
		include_once 'libs/Crop/class.image.php';						
		$imgObj = new simpleImage();
		$imgObj->load($orgImage);
		$imgObj->imageWaterMark();
		$imgObj->output();
	}

    /**
     * Show Artist photo
     */
    private function ArtistPhoto( &$ui )
    {
        $this->mSmarty->assign('submodule', 'Photo');
        $id = _v('id', 0);//album id
        $ph = _v('ph', 0);//album id		
		$allPhoto = _v('allPhoto', 0);
		$ajaxMode = _v('ajaxMode', 0);	
		$page = _v('page', 1);									
		if($ph) { 
			$Photo = Photo::GetPhoto($ph);		
			$this->mSmarty->assignByRef('Photo', $Photo);		
			$wall = Wall::GetWallById($Photo['WallId'],0,5);	
			$this->mSmarty->assignByRef('wall', $wall);
			$this->mSmarty->assign('ui', $this->mUser->mUserInfo);
			require_once(BPATH.'libs/video/EmbededVideo.php');
			$videoObj=new EmbededVideo();
			$this->mSmarty->assign('videoObj', $videoObj);
			$image = BPATH.'/files/photo/mid/'.$Photo['UserId'].'/'.$Photo['Image'];		
			try{
				$aSize = getimagesize($image); // get image info
				$iWidth = $aSize[0];
				$iHeight = $aSize[1];
				$this->mSmarty->assign('iWidth', $iWidth);
				$this->mSmarty->assign('iHeight', $iHeight);
			} catch(Exception $ex){}			
            $this->mSmarty->display('ajax/photo_one.html');			
			exit;
			} 
        if ($id)
        {
			  //album info
            $album = PhotoAlbum::GetAlbum($id);	
			
			//$photos = Photo::GetPhotosListFromAlbum($ui['Id'], $id);			
			
			$photoCount = Photo::GetPhotoList($ui['Id'], $id);
			$totalPages = ceil(count($photoCount) / PHOTO_PER_PAGE);					
			
			$countList = Photo::GetCountAllPhotoAlbum($ui['Id']);		
			$this->mSmarty->assign('totalAlbums', $countList['CountAlbum']);						
            $this->mSmarty->assignByRef('totalPhotos', $countList['CountPhoto']);
			
			$photos = Photo::GetPhotoList($ui['Id'], $id , $page , PHOTO_PER_PAGE);			
			$this->mSmarty->assignByRef('totalPages', $totalPages);							
			$this->mSmarty->assignByRef('photos', $photos);				
            $this->mSmarty->assignByRef('album', $album);

			if($totalPages>$page)
			{
				$page = $page+1;
			} else {
				$page = 0;
			}
			$this->mSmarty->assign('page', $page);						
		if($ajaxMode)
			{	
				$res['data'] = $this->mSmarty->fetch('mods/profile/edit_artist/ajax/AllPhotoPagination.html');
				$res['userId'] = $this->mUser->mUserInfo['Id'];
				$res['page'] = $page;
				echo json_encode($res);				
				exit();					
			}			
            $this->mSmarty->display('mods/profile/show_artist/photo_album.html');
				
			

        }
		else if($allPhoto)
		{
	
			
			$countList = Photo::GetCountAllPhotoAlbum($ui['Id']);

			$photos = Photo::GetUserPhotos($ui['Id'],$page , PHOTO_PER_PAGE);
			
			$this->mSmarty->assignByRef('photos', $photos);
			
			$countList = Photo::GetCountAllPhotoAlbum($ui['Id']);		
			$this->mSmarty->assign('totalAlbums', $countList['CountAlbum']);						
            $this->mSmarty->assignByRef('totalPhotos', $countList['CountPhoto']);
			
		$totalPages = ceil($countList['CountPhoto'] / PHOTO_PER_PAGE);		
		if($totalPages>$page)
		{
			$page = $page+1;
		} else {
			$page = 0;
		}
		$this->mSmarty->assign('page', $page);	
			
		if($ajaxMode)
			{	

				$res['data'] = $this->mSmarty->fetch('mods/profile/show_artist/ajax/AllPhotoPagination.html');
				$res['userId'] = $this->mUser->mUserInfo['Id'];
				$res['page'] = $page;
				echo json_encode($res);				
				exit();					
			}

			
            $this->mSmarty->display('mods/profile/show_artist/photo_all.html');
		}
        else
        {
		
		//	$albums = PhotoAlbum::GetAlbumList($ui['Id']);
			$albums	=	PhotoAlbum::GetAlbumList($ui['Id'],1,1,$page, PHOTO_PER_PAGE);		

	        $this->mSmarty->assignByRef('albums', $albums);	
			$countList = Photo::GetCountAllPhotoAlbum($ui['Id']);	
			
			$this->mSmarty->assign('totalAlbums', $countList['CountAlbum']);						
            $this->mSmarty->assignByRef('totalPhotos', $countList['CountPhoto']);
			$totalPages = ceil($countList['CountAlbum'] / PHOTO_PER_PAGE);		
				if($totalPages>$page)
				{
					$page = $page+1;
				} else {
					$page = 0;
				}
				$this->mSmarty->assign('page', $page);	
			
		if($ajaxMode)
			{	
				$res['data'] = $this->mSmarty->fetch('mods/profile/show_artist/ajax/scrollPhotoPagination.html');
				$res['userId'] = $this->mUser->mUserInfo['Id'];
				$res['page'] = $page;
				echo json_encode($res);				
				exit();					
			}
						
            $this->mSmarty->display('mods/profile/show_artist/photo.html');
        }
        exit();
    }
	
// buy photo ajax 
private function ArtistBuyPhoto( $ui )	
	{

        $this->mSmarty->assign('submodule', 'buyPhoto');
        $id = _v('id', 0);//album id
        $ph = (int)_v('ph', 0);//photo id
        if ($id)
        {
            //album info
            $album = PhotoAlbum::GetAlbum($id);
            if (empty($album) || $album['UserId'] != $ui['Id'])
            {
                $id = 0;
                $album = array();
            }
        }

        if(!$id)
        {
            $ph = 0;
        }

        if($ph)
        {
            //photo info
            $photo = Photo::BuyPhoto($ph);
            if (empty($photo) || $photo['AlbumId'] != $id || !file_exists(BPATH . 'files/photo/origin/' . $photo['UserId'] . '/' . $photo['Image']))
            {
                $ph = 0;
                $photo = array();
            }
            else
            {
                $photo['Sizes'] = getimagesize(BPATH . 'files/photo/origin/' . $photo['UserId'] . '/' . $photo['Image']);
            }
        }

        if (!$id)
        {
            //main photo page

            //albums list
            $this->mSmarty->assignByRef('albums', PhotoAlbum::GetAlbumList($ui['Id']));
            $this->mSmarty->display('mods/profile/show_artist/photo.html');
        }
        else if($ph)
        {
            //show one photo
            $this->mSmarty->assignByRef('photo', $photo);
            //prev and next photos ids
            $this->mSmarty->assignByRef('links', Photo::GetPrevNext($id, $ph));
            $this->mSmarty->assignByRef('album', $album);
            $this->mSmarty->assign('submodule', 'PhotoOne');
            $this->mSmarty->display('mods/profile/show_artist/buyphoto_one.html');
        }
        else
        {
            //show album


            //albums photos
            $this->mSmarty->assignByRef('photos', Photo::GetPhotoList($ui['Id'], $id));
            $this->mSmarty->assignByRef('album', $album);
            $this->mSmarty->assign('id', $id);
            $this->mSmarty->display('mods/profile/show_artist/photo_album.html');
        }
        exit();
    	
	}
    
	 /**
     * Delete User Wall
     */
	 
	public function wallDelete()
	{
		$res = array('q' => OK, 'status' => 0);
        $id = _v('id', 0);
        if($id)
        {
			Notification::DeleteWall($id);
			$photoDetail= Photo::GetWallPhotoDetails($id);
			if($photoDetail['id'])
			{
				Photo::Remove($photoDetail['id']);			
			}
            $res['status'] = Wall::DeleteWall($id);
			
			
        }
        echo json_encode($res);
        exit();
	}

 	/**
     * Delete User Wall Comment
     */
	 
	public function commentDelete()
	{
		$res = array('q' => OK , 'status' => 0);
        $id = _v('id', 0);
        if($id)
        {
            $res['status'] = Comment::deleteComment($id);
        }
        echo json_encode($res);
        exit();
	}
    
	 /**
     * Delete User Wall
     */

	public function showWallOne()
	{
        $id = _v('id', 0);
        $ajaxMode = _v('ajaxMode', 0);
		$wall = Wall::GetWallById($id,0,5);
		$this->mSmarty->assignByRef('wall', $wall);
		require_once(BPATH.'libs/video/EmbededVideo.php');
		$videoObj=new EmbededVideo();
		$this->mSmarty->assign('videoObj', $videoObj);
		$image = BPATH.'/files/wall/orginal/'.$wall['Photo'];
			try{
				$aSize = getimagesize($image); // get image info
				$iWidth = $aSize[0];
				$iHeight = $aSize[1];
				$this->mSmarty->assign('iWidth', $iWidth);
				$this->mSmarty->assign('iHeight', $iHeight);
			} catch(Exception $ex){}
		if($ajaxMode)
		{
			$this->mSmarty->assign('ui', $this->mUser->mUserInfo);
			
			$this->mSmarty->display('ajax/wall_one.html');
		}
		else 
		{
			$userInf = User::GetUserFullInfo($wall['Uid']);
			$content = $this->mSmarty->fetch('ajax/wall_one.html');
			$this->mSmarty->assign('ui', $ui);
			
			$this->mSmarty->assign('content', $content);
			if($this->mUser->mUserInfo['Status'] == USER_FAN && ($this->mUser->mUserInfo['Id'] == $wall['Uid'] || $this->mUser->mUserInfo['Id'] == $wall['UfId'])) {
				$this->mSmarty->display('mods/profile/edit_fan/wall.html');
				exit;
			} else {
				$this->mSmarty->assign('ui', $userInf);
				$this->mSmarty->display('mods/profile/show_fan/wall_one.html');	
				exit;
			}
			if($this->mUser->mUserInfo['Status'] == USER_ARTIST && 
			   ($this->mUser->mUserInfo['Id'] == $wall['Uid'] || $this->mUser->mUserInfo['Id'] == $wall['UfId'])) {
				$this->mSmarty->display('mods/profile/edit_artist/wall.html');
			} else {
				$this->mSmarty->assign('ui', $userInf);
				$this->mSmarty->display('mods/profile/show_artist/wall_one.html');
			}if($userInf['Status'] == USER_FAN) {
				$this->mSmarty->assign('ui', $userInf);
				$this->mSmarty->display('mods/profile/show_fan/wall_one.html');
			}if($userInf['Status'] == USER_ARTIST) {
				$this->mSmarty->assign('ui', $userInf);
				$this->mSmarty->display('mods/profile/show_artist/wall_one.html');
			}
		}
	}

	public function showPhotoOne()
	{
        $id = _v('id', 0);
        $ajaxMode = _v('ajaxMode', 0);
		$Photo = Photo::GetPhoto($id);		
		$this->mSmarty->assignByRef('Photo', $Photo);		
		$wall = Wall::GetWallById($Photo['WallId'],0,5);	
		$this->mSmarty->assignByRef('wall', $wall);
		require_once(BPATH.'libs/video/EmbededVideo.php');
		$videoObj=new EmbededVideo();
		$this->mSmarty->assign('videoObj', $videoObj);
		$image = BPATH.'/files/photo/mid/'.$Photo['UserId'].'/'.$Photo['Image'];
		
			try{
				//echo $image;
				$aSize = getimagesize($image); // get image info
				$iWidth = $aSize[0];
				$iHeight = $aSize[1];
				//deb($aSize);
				$this->mSmarty->assign('iWidth', $iWidth);
				$this->mSmarty->assign('iHeight', $iHeight);
			} catch(Exception $ex){}
		if($ajaxMode)
		{
			$this->mSmarty->assign('ui', $this->mUser->mUserInfo);
			
			$this->mSmarty->display('ajax/photo_one.html');
		}
		else 
		{
			$userInf = User::GetUserFullInfo($wall['UserId']);
			$content = $this->mSmarty->fetch('ajax/photo_one.html');
			$this->mSmarty->assign('ui', $ui);
			
			$this->mSmarty->assign('content', $content);
			if($this->mUser->mUserInfo['Status'] == USER_FAN && ($this->mUser->mUserInfo['Id'] == $wall['Uid'] || $this->mUser->mUserInfo['Id'] == $wall['UfId'])) {
				$this->mSmarty->display('mods/profile/edit_fan/wall.html');
				exit;
			} else {
				$this->mSmarty->assign('ui', $userInf);
				$this->mSmarty->display('mods/profile/show_fan/wall_one.html');	
				exit;
			}
			if($this->mUser->mUserInfo['Status'] == USER_ARTIST && 
			   ($this->mUser->mUserInfo['Id'] == $wall['Uid'] || $this->mUser->mUserInfo['Id'] == $wall['UfId'])) {
				$this->mSmarty->display('mods/profile/edit_artist/wall.html');
			} else {
				$this->mSmarty->assign('ui', $userInf);
				$this->mSmarty->display('mods/profile/show_artist/wall_one.html');
			}if($userInf['Status'] == USER_FAN) {
				$this->mSmarty->assign('ui', $userInf);
				$this->mSmarty->display('mods/profile/show_fan/wall_one.html');
			}if($userInf['Status'] == USER_ARTIST) {
				$this->mSmarty->assign('ui', $userInf);
				$this->mSmarty->display('mods/profile/show_artist/wall_one.html');
			}
		}
	}
	

    /**
     * Show Artist events
     */
    private function ArtistEvents( $ui )
    {
	
        $this->mSmarty->assign('submodule', 'Events');
        $id = _v('id', 0);
	   if($_SESSION['system_uid']==false)
	   	{
		$this->mSmarty->assign('guestId', true);
		}
	     $IsFollow1 = UserFollow::GetFollow($ui['Id'], $this->mUser->mUserInfo['Id']);
		if (!$id)  
        {
            //show events list
            $page = _v('page', 1);
            $pcnt = 10;
            $df = _v('df', 'tm');
            $df = !in_array($df, array('tw', 'nw', 'tm', 'nm', 'up', 'all','pa')) ? '' : $df;
			// today event is not shoing  by defualt start			
			if($df=='') {
            $df = 'up';			
			}			
			// today event is not shoing  by defualt start								
	
            $this->mSmarty->assignByRef('df', $df);
            $period = Event::GetPeriod($df);
			
			//Change event status  as finished if the broadcast time is expired
			Event::FinishEventNotBroadcasted($ui['Id']);
		
            if ($this->mUser->IsAuth() && $ui['Id'] != $this->mUser->mUserInfo['Id'])
            {
                $rcnt = Event::EventsWithAttendAndPurchasedListCount( $ui['Id'], $this->mUser->mUserInfo['Id'], $period, '', EVENT_APPROVED , $df );
                $events = Event::EventsWithAttendAndPurchasedList($ui['Id'], $this->mUser->mUserInfo['Id'], $page, $pcnt, $period, '', EVENT_APPROVED ,  $df );				
			}
            else
            {
                $rcnt = Event::EventsCount($ui['Id'], $period, EVENT_APPROVED );
                $events = Event::EventsList($ui['Id'], $page, $pcnt, $period, '', '', '', EVENT_APPROVED);				

            }

	    	 $this->mSmarty->assign('IsFollow1', $IsFollow1);         					
            include_once 'model/Pagging.class.php';
            $link = PATH_ROOT . 'u/'.$ui['Name'].'/events' . ($df ? '?df=' . $df : '');
            $mpg = new Pagging($pcnt, $rcnt, $page, $link);
            $pagging = $mpg->Make2($this->mSmarty, 0, 1);
            $this->mSmarty->assignByRef('pagging', $pagging);
            $this->mSmarty->assignByRef('events', $events);
            $this->mSmarty->display('mods/profile/show_artist/events.html');
        }
        else
        {
            //show one event
/*		 if(empty($IsFollow1))
		 	{
				$IsFollow1	=	1;
			}
*/			 $this->mSmarty->assign('IsFollow1', $IsFollow1);         						
            $event = Event::GetEvent($id, $ui['Id'], 1);
            if (empty($event) || $event['Deleted'] == 1)
            {
                uni_redirect(PATH_ROOT . 'u/'.$ui['Name'].'/events');
            }
            if ($this->mUser->IsAuth() && $ui['Id'] != $this->mUser->mUserInfo['Id'])
            {
                $event['EventAttend'] = EventAttend::Get($this->mUser->mUserInfo['Id'], $id);
                $event['EventPurchase'] = EventPurchase::Get($this->mUser->mUserInfo['Id'], $id);
                if($event['EventType'] != LIVE_EVENT && $event['Status'] == 4 && !empty($event['EventPurchase']['Id']))
                {
                    //get broadcast recordings list
                    $video = EventVideo::GetListEventVideo($id);
                    $this->mSmarty->assignByRef('recordings', $video);
                }
            }
			
            $this->mSmarty->assignByRef('event', $event);
            $this->mSmarty->display('mods/profile/show_artist/event_one.html');
        }
        exit();
    }

    /**
     * Artists calendar of events
     */
    private function ArtistEventCalendar( $ui )
    {
        $this->mSmarty->assign('submodule', 'EventCalendar');
        //selected date
        $month = _v('month', date('n'));
        $year = _v('year', date('Y'));

        $this->mSmarty->assign('month', $month);
        $this->mSmarty->assign('year', $year);

        //next month date
        $next_month = $month == 12 ? 1 : $month+1;
        $next_year = $month == 12 ? $year+1 : $year;
        //prev month date
        $prev_month = $month == 1 ? 12 : $month-1;
        $prev_year = $month == 1 ? $year-1 : $year;

        $this->mSmarty->assign('next_month', $next_year <= date('Y') ? '/u/' . $ui['Name'] . '/eventcalendar?month=' . $next_month . '&year=' . $next_year : '');
        $this->mSmarty->assign('prev_month', $prev_year >= date("Y")-2 ? '/u/' . $ui['Name'] . '/eventcalendar?month=' . $prev_month . '&year=' . $prev_year : '');

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
        $mme = array('January', 'Febrary', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        for ($i = 1; $i <= 12; $i++)
        {
            $mm[$i] = $mme[ $i-1 ];
        }

        $yy = array();
        for ($i=date("Y")+1; $i >=date("Y")-1; $i--)
        {
            $yy[$i] = $i;
        }

        $this->mSmarty->assignByRef('mm', $mm);
        $this->mSmarty->assignByRef('yy', $yy);

        //get events for selected month
        $from = mktime(0, 0, 0, $month, 1, $year);
        $to   = mktime(0, 0, 0, $next_month, 1, $next_year) - 1;
        $events_list = Event::EventsList( $ui['Id'], 0, 0, array('from' => date("Y-m-d H:i:s", $from), 'to' => date("Y-m-d H:i:s", $to)), '', '', '', EVENT_APPROVED);
        $events = array();
        foreach($events_list as $item)
        {
            $day = date('j', strtotime($item['EventDate']));
            if(empty($events[$day]))
            {
                $events[$day] = array();
            }
            $events[$day][] = $item;
        }

        $this->mSmarty->assignByRef('events', $events);
        $this->mSmarty->display('mods/profile/show_artist/event_calendar.html');
        exit();
    }
	
    
    public function Broadcasting()
    {
        $event_id = trim(strip_tags(_v('id', '')));
		$mode = trim(strip_tags(_v('mode', '')));
		$getTime = _v('getTime', '');

        if(empty($event_id))
        {
            uni_redirect(PATH_ROOT);
        }

        $this->mSmarty->assign('module', 'events');
       
       //deb($mode); 
	   
        if ($mode)
        {
			$login = $event_id;
			$event_id = 'u'.$event_id;
			
			$ui = User::GetUserByLogin($login);
			if (empty($ui) || $ui['Status'] != 2)
			{
				uni_redirect(PATH_ROOT);
			}
			if($this->mUser->IsAuth())
			{
				BroadcastViewers::AddViewer($event_id, $this->mUser->mUserInfo['Id']);
			}
			$access = 1; //access to broadcasting

			$online = 1;
			
			
			$cache = $this->mCache->get('broadcast_' . $event_id);
			if(!empty($cache))
			{
				$cache = unserialize($cache);
				$flow = $cache['flow'];
				$time = $cache['time'];
			}
			if(!empty($flow) && !empty($time) && $time > mktime()-60)
			{
				$online = 1;
			}
			else
			{
				//if flow
				$flow = $event_id;
			}
			$this->mSmarty->assign('flow', $flow);
			$this->mSmarty->assign('event_id', $event_id);
			$this->mSmarty->assignByRef('ui', $ui);
			$this->mSmarty->assign('access', $access);
			$this->mSmarty->assign('online', $online);
        }  
		else
		{
		

            $event = Event::GetEvent($event_id, '', 1);
            if (empty($event))
            {
                uni_redirect(PATH_ROOT);
            }


            $this->mSmarty->assignByRef('event', $event);

            $ui = User::GetUser($event['UserId']);
            if (empty($ui))
            {
				
                uni_redirect(PATH_ROOT);
            }
            $access = 0; //access to broadcasting
			            

            if($this->mUser->IsAuth())
            {
                if($this->mUser->mUserInfo['Status'] == 2 && $event['UserId'] == $this->mUser->mUserInfo['Id'])
                {
                    //event owner
                    $access = 1;
                }
                /*if($this->mUser->mUserInfo['Status'] == 1)
                {*/
                    //for fan check the access to that brroadcast
                    $purchase = EventPurchase::Get($this->mUser->mUserInfo['Id'], $event['Id']);
                    if(!empty($purchase))
                    {
                        $access = 1;
                        $this->mSmarty->assignByRef('purchase', $purchase);
                    }
					//BroadcastViewers::AddViewer($event['Code'], $this->mUser->mUserInfo['Id']);
                //}
                if($event['Status'] < 3 && $access)
                {
                    //add viewer of this broadcasting - only if user has access
                    BroadcastViewers::AddViewer($event['Code'], $this->mUser->mUserInfo['Id']);
                }
            }

            $this->mSmarty->assign('event_id', $event['Code']);
            //latest flow
            $online = 0;
			
            //check online broadcast
            $cache = $this->mCache->get('broadcast_' . $event['Code']);
            if(!empty($cache))
            {
                $cache = unserialize($cache);
                $flow = $cache['flow'];
                $time = $cache['time'];
            }
            if(!empty($flow) && !empty($time) && $time > mktime()-60)
            {
                $online = 1;
            }
            else
            {
                $flow = $event['Code'];
            }

            $this->mSmarty->assign('flow', $flow);
            $this->mSmarty->assignByRef('ui', $ui);
            $this->mSmarty->assign('access', $access);
            $this->mSmarty->assign('online', $online);
        }
		$sflow = BroadcastFlows::GetEventLatestFlow($ui['Id'], $event_id, 0, 1);
		
		$this->mSmarty->assign('eTime', $event['Duration']); 	

		$firstBroadcastTime = BroadcastFlows::GetEventFirstFlowUsed($ui['Id'], $event_id);

		if($firstBroadcastTime)
		{
			$rtime = mktime()-$firstBroadcastTime;		
			$this->mSmarty->assign('reTime', $rtime);
			$online = 1;
			$this->mSmarty->assign('online', $online);
			
			if($getTime)
			{
				$res['q'] = OK;
				$res['reTime'] = $rtime;
				echo json_encode($res);
				exit();			
			}
		}
		if(!$sflow)
		{
			$online = 0;
			$this->mSmarty->assign('online', $online);
		}

		if($online && $purchase && $event['Status'] < 3)
		{
			$this->mSmarty->display('mods/profile/show_artist/broadcasting_play.html');
		}
		else
		{
			$this->mSmarty->display('mods/profile/show_artist/broadcasting_off.html');
		}
        exit();
    }


    /**
     * Show artist profile
     */
    private function ArtistProfile( $ui )
    {
        $this->mSmarty->assign('submodule', 'Profile');
        $this->mSmarty->display('mods/profile/show_artist/profile.html');
        exit();
    }


     /**
     * Show artist wall
     */
    private function ArtistWall( $ui )
    {
       //genres list
       $genres_list = User::GetGenresList();
       $this->mSmarty->assignByRef('genres', $genres_list);				

				
        $fans_count = UserFollow::GetFollowersCount($ui['Id'], '', $this->mCache);
        $this->mSmarty->assign('fans_count', $fans_count);

        //music		
		$musicCount = Music::GetShowartistMusicListCount($ui['Id']);
		// deb($musicCount);	
		$music = Music::getShowartistMusicList( $ui['Id'], $this->mCache, 0, 5);
	 // deb($music);
     // $music = Music::GetMusicList( $ui['Id'], -1, 1, 1, 5, 1, 0, $this->mCache, 1);
		$this->mSmarty->assignByRef('musicCount', $musicCount);	
		$this->mSmarty->assignByRef('music', $music);	

		//videos
		$video = Video::GetVideoListWithPurchase($ui['Id'], $this->mUser->mUserInfo['Id'], 1, 1, 9);
        $this->mSmarty->assignByRef('video', $video['list']);
		$this->mSmarty->assignByRef('videoCount', $video['rcnt']);		

		//photos		
        $this->mSmarty->assignByRef('photo', Photo::GetUserPhotos( $ui['Id'], 1, 9));
        $this->mSmarty->assignByRef('photoCount', Photo::GetUserPhotosCount( $ui['Id'] ));
		
		//events
		$eventCount = Event::EventsListCount($ui['Id'], array('from' => date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s'), date("m"), date("d"), date("Y")))), '2' );
		$events = Event::EventsList($ui['Id'], 1, 5, array('from' => date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s'), date("m"), date("d"), date("Y")))), array(), array(2),'', EVENT_APPROVED);


       $this->mSmarty->assignByRef('eventCount',$eventCount );
	   $this->mSmarty->assignByRef('events',$events );

		
		//fans
		$fanCount =UserFollow::GetFollowersUserListCount($ui['Id'], USER_FAN );
		$fellow_fan =UserFollow::GetFollowersUserList($ui['Id'], USER_FAN, 1, 9);
		
		//artists
		
		$artistCount =UserFollow::GetFollowersUserListCount($ui['Id'], USER_ARTIST );				
		$fellow_artist =UserFollow::GetFollowersUserList($ui['Id'], USER_ARTIST, 1, 9);

		$this->mSmarty->assignByRef('fanCount', $fanCount);					
		$this->mSmarty->assignByRef('fans', $fellow_fan);

		$this->mSmarty->assignByRef('artistCount', $artistCount);
		$this->mSmarty->assignByRef('fellow_artist', $fellow_artist);
					

		$this->mSmarty->assignByRef('slide', Photo::GetSliderList( $ui['Id'], $ui['Status']));	
        $this->mSmarty->display('mods/profile/show_artist/wall.html');

        exit();
    }
	

     /**
     * Show fan wall
     */
    private function FanWall( $ui )
    {	
        //videos
		$videoCount = Video::GetPurchasedVideoListCount($ui['Id'], 1);		
		$video = Video::GetPurchasedVideoList( $ui['Id'], 1, 1, 6 );
		
        $this->mSmarty->assignByRef('videoCount', $videoCount);		
	    $this->mSmarty->assignByRef('video', $video);		
		

		//photos				
		$photo =Photo::GetUserPhotos( $ui['Id'], 1, 6 );
        $this->mSmarty->assignByRef('photo', $photo);		
        $this->mSmarty->assignByRef('photoCount', Photo::GetUserPhotosCount( $ui['Id'] ));
			
        //artists
		$artistCount =UserFollow::GetFollowersUserListCount($ui['Id'], USER_ARTIST );	
		$fellow_artist =UserFollow::GetFollowersUserList($ui['Id'], USER_ARTIST, 1, 9);	
		
		$this->mSmarty->assignByRef('artistCount', $artistCount);					
	    $this->mSmarty->assignByRef( 'fellow_artist', $fellow_artist);   
		
		//follow fans
		$fanCount =UserFollow::GetFollowersUserListCount($ui['Id'], USER_FAN );
        $fellow_fans = UserFollow::GetFollowersUserList($ui['Id'], USER_FAN, 1, 9);	
		
		$this->mSmarty->assignByRef('fanCount', $fanCount);			
        $this->mSmarty->assignByRef('fellow_fans', $fellow_fans);		
		
		$this->mSmarty->assignByRef('slide', Photo::GetSliderList( $ui['Id'], $ui['Status']));

        $this->mSmarty->display('mods/profile/show_fan/wall.html');

        exit();
    }
 
    /**
     * Show fan profile
     */
    private function FanProfile( $ui )
    {

        $ui['CountryName'] = Countries::GetCountryName($ui['Country']);
        $this->mSmarty->assignByRef('ui', $ui);

        $this->mSmarty->assign('submodule', 'Profile');
        $this->mSmarty->display('mods/profile/show_fan/profile.html');

        exit();
    }   
    
  
    /**
     * Show fan fellow fans
     */
    private function FanFans( $ui )
    {
        $ui['CountryName'] = Countries::GetCountryName($ui['Country']);
        $this->mSmarty->assignByRef('ui', $ui);
		
        //fan
		$fellow_fans =UserFollow::GetFollowersUserList($ui['Id'], USER_FAN);						
	    $this->mSmarty->assignByRef( 'fellow_fans', $fellow_fans);

        $this->mSmarty->display('mods/profile/show_fan/fans.html');
        exit();		
    }
	 
    /**
     * Show fan artists fans
     */
    private function FanArtists( $ui )
    {
		
	
        $ui['CountryName'] = Countries::GetCountryName($ui['Country']);
        $this->mSmarty->assignByRef('ui', $ui);

        //artists
		$fellow_artist =UserFollow::GetFollowersUserList($ui['Id'], USER_ARTIST);						
	    $this->mSmarty->assignByRef( 'fellow_artist', $fellow_artist); 		

        $this->mSmarty->display('mods/profile/show_fan/artists.html');
        exit();		
    }	
    /**
     * Show fan photos
     */
    private function FanPhoto( $ui )
    {
		$this->mSmarty->assign('submodule', 'Photo');
		$id = _v('id', 0);
        $ph = (int)_v('ph', 0);	
		$allPhoto = (int)_v('allPhoto', 0);	
		$ajaxMode = _v('ajaxMode', 0);		
		$page = _v('page', 1);		
        $pcnt = 12;	
		
		$countList = Photo::GetCountAllPhotoAlbum($ui['Id']);		
		$this->mSmarty->assign('totalAlbums', $countList['CountAlbum']);						
		$this->mSmarty->assignByRef('totalPhotos', $countList['CountPhoto']);
		
		if($allPhoto)
		{
			//$photos = Photo::ShowPhotoAll( $ui['Id']);
			$photos = Photo::GetUserPhotos($ui['Id'],$page , PHOTO_PER_PAGE);
			$this->mSmarty->assignByRef('photos', $photos);
			$totalPages = ceil($countList['CountPhoto'] / PHOTO_PER_PAGE);		
			if($totalPages>$page)
			{
				$page = $page+1;
			}else{
				$page = 0;
			}
			$this->mSmarty->assign('page', $page);	
			if($ajaxMode)
			{	
	
					$res['data'] = $this->mSmarty->fetch('mods/profile/show_fan/ajax/AllPhotoPagination.html');
					$res['userId'] = $this->mUser->mUserInfo['Id'];
					$res['page'] = $page;
					echo json_encode($res);				
					exit();					
			}
			
            $this->mSmarty->display('mods/profile/show_fan/photo_all.html');
			exit();
		}
		if($ph) {
			$Photo = Photo::GetPhoto($ph);		
			$this->mSmarty->assignByRef('Photo', $Photo);		
			$wall = Wall::GetWallById($Photo['WallId'],0,5);	
			$this->mSmarty->assignByRef('wall', $wall);
			$this->mSmarty->assign('ui', $this->mUser->mUserInfo);
			require_once(BPATH.'libs/video/EmbededVideo.php');
			$videoObj=new EmbededVideo();
			$this->mSmarty->assign('videoObj', $videoObj);
			$image = BPATH.'/files/photo/mid/'.$Photo['UserId'].'/'.$Photo['Image'];		
			try{
				$aSize = getimagesize($image); // get image info
				$iWidth = $aSize[0];
				$iHeight = $aSize[1];
				$this->mSmarty->assign('iWidth', $iWidth);
				$this->mSmarty->assign('iHeight', $iHeight);
			} catch(Exception $ex){}			
            $this->mSmarty->display('ajax/photo_one.html');			
			exit;							
				}  
        if (!$id)
        {
			$albums	=	PhotoAlbum::GetAlbumList($ui['Id'],1,1,$page, PHOTO_PER_PAGE);		
	        $this->mSmarty->assignByRef('albums', $albums);	
			$countList = Photo::GetCountAllPhotoAlbum($ui['Id']);		
			$this->mSmarty->assign('totalAlbums', $countList['CountAlbum']);						
            $this->mSmarty->assignByRef('totalPhotos', $countList['CountPhoto']);
			$totalPages = ceil($countList['CountPhoto'] / PHOTO_PER_PAGE);		
				if($totalPages>$page)
				{
					$page = $page+1;
				} else {
					$page = 0;
				}
				$this->mSmarty->assign('page', $page);	
			
		if($ajaxMode)
			{	
				$res['data'] = $this->mSmarty->fetch('mods/profile/show_fan/ajax/scrollPhotoPagination.html');
				$res['userId'] = $this->mUser->mUserInfo['Id'];
				$res['page'] = $page;
				$Otherui = & $this->mUser->mOtherUserInfo;
				if($Otherui['BandName'])
					{
				$res['Name'] = $Otherui['BandName'];					
					}else{									
				$res['Name'] = $Otherui['Name'];									
					}
				echo json_encode($res);				
				exit();					
			}
			
            $this->mSmarty->display('mods/profile/show_fan/photo.html');
			
        }
        else
        {
		
			$album = PhotoAlbum::GetAlbum($id);	
			
			//$photos = Photo::GetPhotosListFromAlbum($ui['Id'], $id);			
			$photoCount = Photo::GetPhotoList($ui['Id'], $id);
			$totalPages = ceil(count($photoCount) / PHOTO_PER_PAGE);					
			
			
			$photos = Photo::GetPhotoList($ui['Id'], $id , $page , PHOTO_PER_PAGE);			
			$this->mSmarty->assignByRef('photos', $photos);				
            $this->mSmarty->assignByRef('album', $album);

			if($totalPages>$page)
			{
				$page = $page+1;
			} else {
				$page = 0;
			}
			$this->mSmarty->assign('page', $page);						
			if($ajaxMode)
				{	
					$res['data'] = $this->mSmarty->fetch('mods/profile/show_fan/ajax/AllPhotoPagination.html');
					$res['userId'] = $this->mUser->mUserInfo['Id'];
					$res['page'] = $page;
					echo json_encode($res);				
					exit();					
				}			
            $this->mSmarty->display('mods/profile/show_fan/photo_album.html');

            //show album photo			
            //$this->mSmarty->assignByRef('photo', $photo);
//            //prev and next photos ids
//            $this->mSmarty->assignByRef('links', Photo::GetPrevNext($id, $ph));
//            $this->mSmarty->assignByRef('album', $album);
//            $this->mSmarty->assign('id', $id);
//			
//            $this->mSmarty->display('mods/profile/show_fan/photo_one.html');				
			
        }
        exit();		
    }		 
    /**
     * Show fan fellow fans
     */
    private function FanViewPhotoAlbum( $ui )
    {	
        $this->mSmarty->assign('module', 'photo');
        $id = _v('id', 0);

        //check album rights
        if ($id)
        {
			$countList = Photo::GetCountAllPhotoAlbum($ui['Id']);		
			$this->mSmarty->assign('totalAlbums', $countList['CountAlbum']);						
            $this->mSmarty->assignByRef('totalPhotos', $countList['CountPhoto']);
				
			$album = PhotoAlbum::GetAlbum($id);		
			
			$photos = Photo::GetPhotosListFromAlbum($ui['Id'], $id);		

	        $this->mSmarty->assignByRef('photos', $photos);			
			$this->mSmarty->assignByRef('albumTitle', $album['Title']);			
        }

        $this->mSmarty->display('mods/profile/show_fan/photo_album.html');
		exit;		
	}
	
    private function FanVideo( $ui )
    {   

//		$this->mSmarty->assign('module', 'video');
        $id = trim(strip_tags(_v('id', '')));
        $is_broadcasting = 0;

		$page = _v('page', 1);
		$pcnt = _v('pcnt', 6);
		
        if (!empty($id) && $id[0]=='b')
        {
            $is_broadcasting = 1;
            $id = substr($id, 1);
        }
        $id = (int)$id;
		//$delete_video_id = _v('delete_video_id', 0);

        include_once 'model/Pagging.class.php';
        $link = ROOT_HTTP_PATH . '/u/'.$ui['Name'].'/video';

				
		if(!$id)
		{
			$video = Video::GetPurchasedVideoList( $ui['Id'], 0, $page, $pcnt );			
			$rcnt = Video::GetPurchasedVideoListCount( $ui['Id'], 0);
			
			$mpg = new Pagging($pcnt, $rcnt, $page, $link);
			$pagging = $mpg->Make2($this->mSmarty, 0, 1);
	
			$this->mSmarty->assignByRef('pagging', $pagging);
			
			$this->mSmarty->assignByRef('videos', $video);
			
		//deb(Video::GetPurchasedVideoList( $ui['Id'], 0 ));  
		
	        $this->mSmarty->display('mods/profile/show_fan/video.html');
			exit;
		}
		else
        {
            if(!$is_broadcasting)
            {
                //show one video
                $video = Video::GetVideoInfo($id, 0, 1);
                if (empty($video))
                {
                    uni_redirect( PATH_ROOT . 'profile/video' );
                }
                $video['VideoPurchase'] = VideoPurchase::Get($ui['Id'], $id);
                if(empty($video['VideoPurchase']))
                {
                    uni_redirect( PATH_ROOT . 'profile/video' );
                }
                $this->mSmarty->assignByRef('video', $video);
            }
            else
            {
                //show broadcasting recording
                $video = EventVideo::Get($id, 1);
                if(empty($video))
                {
                    uni_redirect( PATH_ROOT . 'profile/video' );
                }
                $video['VideoPurchase'] = EventPurchase::Get($ui['Id'], $video['EventId']);
                $video['Status'] = 2;
                $this->mSmarty->assignByRef('video', $video);
				$this->mSmarty->assign('broadcasting', 1);
            }
			//deb($id);
			$vids = Video::GetPurchasedVideoList( $ui['Id'], 0 );	
			$vidCnt = Video::videoCount($id);
			$this->mSmarty->assignByRef('vids', $vids);
			$this->mSmarty->display('mods/profile/show_fan/video_one.html');
			
        }
		exit;		
	}	

	
    /**
     * get video status
     * @return void
     */
    public function CheckVideoStatus()
    {
      $redirect = $this->GetRedirectUrl();
		
  	  if($_REQUEST['ajaxMode'])
	  {	
        $res = array('q' => OK , 'status' => 0);
        $id = _v('id', 0);
        if($id)
        {
            $res['status'] = Video::GetVideoStatus($id);
        }
        echo json_encode($res);
        exit();
	  } 
	  else 
	  {
		uni_redirect(PATH_ROOT . 'u/'.$this->mUser->mUserInfo['Name']);
	  }		
    }
	
	/**
     * get video status
     * @return void
     */
    public function CheckMusicStatus()
    {
      $redirect = $this->GetRedirectUrl();
		
  	  if($_REQUEST['ajaxMode'])
	  {	
        $res = array('q' => OK, 'status' => 1);
        $id = _v('id', 0);
        if($id)
        {
			$status = Music::GetMusicStatus($id);
            $res['status'] = $status == NULL ? 0 :  $status;
        }
        echo json_encode($res);
        exit();
	  } 
	  else 
	  {
		uni_redirect(PATH_ROOT . 'u/'.$this->mUser->mUserInfo['Name']);
	  }			
    }

    public function Download()
    {	
        $id = _v('id', 0);
        $act = trim(strip_tags(_v('act', '')));
        switch($act)
        {
            case 'video':
				$VideoDownloadCode = $this->mSession->Get('VideoDownloadCode');									
				if($VideoDownloadCode){	
				unset($_SESSION['VideoDownloadCode']);									
                $video = Video::GetVideoInfo($id);
				if(empty($video) || $video['FromYt'] || $video['Status'] < 2)
                {
                    die(FILE_NOT_FOUND);
                }
                if(!$this->mUser->CheckAdminStatus())
                {
                    if (!empty($video['Price']) && $this->mUser->IsAuth() && $video['UserId'] != $this->mUser->mUserInfo['Id'])
                    {
                        $video['VideoPurchase'] = VideoPurchase::Get($this->mUser->mUserInfo['Id'], $id);
                        if(empty($video['VideoPurchase']))
                        {
                            die(FILE_NOT_FOUND);
                        }
                    }
                }
                //file path
                /*
				$filepath = BPATH . 'files/video/u/' . $video['UserId'] . '/' . $video['Video'];
                if(!file_exists($filepath))
                {
                    die(FILE_NOT_FOUND);
                }
				*/
				///
			$file	=	'/flash/u/'.$video['UserId'].'/'.$video['Video'];
			$UserDetails = User::GetUser($video['UserId'], 1);
			$userName = $UserDetails['BandName'] ? $UserDetails['BandName'] : ($UserDetails['FirstName'].' '.$UserDetails['LastName']);
			$fileName = $this->safeFile($video['Title'].'-'.$userName.'.mp4');
			//$fileName = basename($video['Title']);
			$url  = 'ftp://'.STREAMING_FTP_USER.':'.STREAMING_FTP_PASSWORD.'@'.STREAMING_FTP_HOST.'/'.$file;
			$fsize = filesize($url);
			if(!$fsize){
				echo THERE_IS_NO_SUCH_FILE . $file;
			}
			header("Content-disposition: attachment; filename=\"$fileName\"");
			header("Content-type: application/octet-stream");
			header("Pragma: ");
			header("Cache-Control: cache");
			header("Expires: 0");
			header("Content-Length: " . $fsize);
			@readfile($url);
			}else{
			$this->NotFound();
			}
	        break;
			case 'music':
				$music = Music::GetMusic($id, 1, 1);
				if(empty($music)){

					die(FILE_NOT_FOUND);
				}
				$filepath = BPATH .$music['Track'];

				if(!file_exists($filepath))
                {
                    die(FILE_NOT_FOUND);
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
                            die(FILE_NOT_FOUND);
                        }
                    }
                }
				
				///
			$file	=	str_replace("files","flash",$music['Track']);
			$fileName = trim($this->safeFile($music['Title'].'.mp3'));
			//$filenme	=	str_replace("files","flash",$music['Title']);			
			//$fileName = basename($file);			
			$url  = 'ftp://'.STREAMING_FTP_USER.':'.STREAMING_FTP_PASSWORD.'@'.STREAMING_FTP_HOST.'/'.$file;
			$fsize = filesize($url);
			if(!$fsize){
				echo THERE_IS_NO_SUCH_FILE. $file;
			}
			header("Content-disposition: attachment; filename={$fileName}");
			header("Content-type: application/octet-stream");
			header("Pragma: ");
			header("Cache-Control: cache");
			header("Expires: 0");
			header("Content-Length: " . $fsize);
			@readfile($url);		
			break;
			case 'photo':
				$photo 	=	Photo::GetPhoto( $id );	
				if(empty($photo)){
					die(FILE_NOT_FOUND);
				}
				$filepath = BPATH .'files/photo/origin/'.$photo['UserId'].'/'.$photo['Image'];
				

				
				if(!file_exists($filepath))
                {
                  //  die('File Not Found');
                }
				if(!$this->mUser->CheckAdminStatus())
				{
				
                    if (!empty($photo['Price']) && $this->mUser->IsAuth() && $photo['UserId'] != $this->mUser->mUserInfo['Id'])
                    {
						$fanId = $this->mUser->mUserInfo['Id'];
						$purchase = PhotoPurchase::Get($fanId, $id);					
                 }
                
				}
				$fsize = filesize($filepath);
                header("Pragma: public");
                header("Expires: 0");							
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Cache-Control: private", false);
                header("Content-type: application/image");
                header("Content-Disposition: attachment; filename=\"" . basename($filepath) . "\";" );
                header("Content-Transfer-Encoding: binary");
                header("Content-Length: " . $fsize);
                readfile($filepath);			
			  	break;	
				
            default:
                die(FILE_NOT_FOUND);
                break;
        }
    }

    /**
     * Console method to close event and unblock artists money
     */
    public function EventClose()
    {
        $max = 3;//events per one start
        $events_to_close = Event::EventsToCloseList($max);
        foreach($events_to_close as $item)
        {
            //update evevnt status
            EventQuery::create()->select(array('Id'))->filterById($item['Id'])->update(array('Status' => 4));
            //close flows of that broadcast
            BroadcastFlows::CloseEventFlows($item['Id']);
            //clean flow name in cache
            $this->mCache->set('broadcast_' . $item['Code'], '', 1);
            //get sum of purchase event
            $blocksum = EventPurchase::GetEventSum($item['Id']);

            //update artist wallet
            $artist = User::GetUser($item['UserId']);
            if(empty($artist['Wallet']))
            {
                $artist['Wallet'] = 0;
            }
            if(empty($artist['WalletBlock']))
            {
                $artist['WalletBlock'] = 0;
            }
            $artist['WalletBlock'] = $artist['WalletBlock'] - $blocksum;
            User::UpdateWallet($artist['Id'], $artist['Wallet'], $artist['WalletBlock']);
        }
        echo DONE;
        exit();
    }

    /**
     * Init purchase/add content by not auth user
     * @return void
     */
    public function ActionNotAuth()
    {/*
      $redirect = $this->GetRedirectUrl();
		
  	  if($_REQUEST['ajaxMode'])
	  {	
        $id = _v('id', 0);
        $what = trim(strip_tags(_v('what', '')));
        $res = array('q' => ERR );
        if (!$this->mUser->IsAuth())
        {
            $content = array();
            $save = array();
            switch($what)
            {
                case 'track':
                    $content = Music::GetMusic($id);
                    $save = array('content' => 'track', 'id' => $id);
                    break;
                case 'album':
                    $content = MusicAlbum::GetAlbum($id);
                    $save = array('content' => 'album', 'id' => $id);
                    break;
                case 'video':
                    $content = Video::GetVideoInfo($id);
                    $save = array('content' => 'video', 'id' => $id);
                    break;
                case 'event_access':
                    $content = Event::GetEvent($id);
                    $save = array('content' => 'event', 'id' => $id, 'act' => 'access');
                    break;
                case 'event_attend':
                    $content = Event::GetEvent($id);
                    $save = array('content' => 'event', 'id' => $id, 'act' => 'attend');
                    break;
                case 'event_remove_attend':
                    $content = Event::GetEvent($id);
                    $save = array('content' => 'event', 'id' => $id, 'act' => 'removeattend');
                    break;
            }
            if(!empty($content))
            {
                $this->mlObj['mSession']->set('redirect', $save);
                $this->mlObj['mSession']->set('notice', YOU_HAVE_TO_BE_A_REGISTERED_ARTISTSFAN_COM_USER_TO . (!empty($content['Price']) ?  'buy' : 'add') . CONTENT_FROM_ARTISTS_PLEASE_SIGNUP_OR_SIGNIN_BELOW );
                $res['q'] = OK;
            }
        }
        echo json_encode($res);
        exit();
	  } 
	  else 
	  {
		uni_redirect(PATH_ROOT . 'u/'.$this->mUser->mUserInfo['Name']);
	  }			
    */}

  
    /**
     * Attend event
     * @return void
     */
    public function AttendEvent()
    {
      $redirect = $this->GetRedirectUrl();
		
  	  if($_REQUEST['ajaxMode'])
	  {		
        $id = _v('id', 0);

        $event = Event::GetEvent($id);

        $res = array('q' => OK, 'errs' => array());
        if (!$this->mUser->IsAuth())
        {
            $this->mlObj['mSession']->set('redirect', array('content' => 'event', 'id' => $id, 'act' => 'attend'));
            $this->mlObj['mSession']->set('notice', YOU_HAVE_TO_BE_A_REGISTERED_ARTISTSFAN_COM_USER_TO.' buy '.CONTENT_FROM_ARTISTS_PLEASE_SIGNUP_OR_SIGNIN_BELOW);
            $res['q'] = ERR;
            echo json_encode($res);
            exit();
        }
        $this->mlObj['mSession']->Del('redirect');
        $this->mlObj['mSession']->Del('notice');
        if (!empty($event))
        {
            $attend = EventAttend::Get($this->mUser->mUserInfo['Id'], $id);
            if (empty($attend))
            {
                //add event to fan's list
                EventAttend::Attend($this->mUser->mUserInfo['Id'], $event['Id']);

                //fan rating
                UserFollow::ChangeRating($this->mUser->mUserInfo['Id'], $event['UserId'], $event['Price'] > 0 ? 'add_access' : 'attend_event');
               $res['q'] = OK;
            }
            else
            {
                $res['errs'][] = THE_EVENT_IS_ALREADY_IN_YOUR_CALENDAR;
            }
        }
        echo json_encode($res);
        exit();
	  } 
/*	  else 
	  {
		uni_redirect(PATH_ROOT . 'u/'.$this->mUser->mUserInfo['Name']);
	  }	*/	
    }

    /**
     * Remove event from attend event list
     * @return void
     */
    public function RemoveAttendEvent()
    {
      $redirect = $this->GetRedirectUrl();
		
  	  if($_REQUEST['ajaxMode'])
	  {		
        $id = _v('id', 0);

        $event = Event::GetEvent($id);

        $res = array('q' => OK, 'errs' => array());
        if (!$this->mUser->IsAuth())
        {
            $this->mlObj['mSession']->set('redirect', array('content' => 'event', 'id' => $id, 'act' => 'removeattend'));
            $this->mlObj['mSession']->set('notice', YOU_HAVE_TO_BE_A_REGISTERED_ARTISTSFAN_COM_USER_TO_COMPLETE_THIS_ACTION_PLEASE_SIGN_UP_OR_SIGN_IN_BELOW);
            $res['q'] = ERR;
            echo json_encode($res);
            exit();
        }
        $this->mlObj['mSession']->Del('redirect');
        $this->mlObj['mSession']->Del('notice');
        if (!empty($event))
        {
            $attend = EventAttend::Get($this->mUser->mUserInfo['Id'], $id);
            if (!empty($attend))
            {
                //remove event from fan's list
                EventAttend::Remove($this->mUser->mUserInfo['Id'], $event['Id']);

                $res['q'] = OK;
            }
            else
            {
                $res['errs'][] = THIS_EVENT_IS_NOT_IN_YOUR_CALENDAR;
            }
        }
        echo json_encode($res);
        exit();
	  } 
	  else 
	  {
		uni_redirect(PATH_ROOT . 'u/'.$this->mUser->mUserInfo['Name']);
	  }		
    }
    
    /**
     * Check access for broadcasting
     */
    public function CheckVideoAccess()
    {

        //check auth
        if(!$this->mUser->IsAuth())
        {
            echo '0';
            exit();
        }

        $data = file_get_contents('php://input');
        //TODO: get event_id from $data
        $event_id = trim(strip_tags(_v('id', '')));
		
        if(empty($event_id))
        {
            echo '0';
            exit();
        }
        if ($event_id[0]=='u')
        {
            //ad-hoc broadcast
			$event_id = substr($event_id, 1);
			$ui = User::GetUserByLogin($event_id);
            if (empty($ui) || $ui['Status'] != 2)
            {
                echo '0';
            }
            else
            {
                echo '1';
            }
            exit();
        }
        $event = Event::GetEventByCode($event_id, 1);
        if(empty($event) || empty($data))
        {
            echo '0';
            exit();
        }
        elseif ($event['UserId']==$this->mUser->mUserInfo['Id'])
        {
            //access for author
            echo '1';
            exit();
        }
        //set event to event ID
        $event = $event['Id'];

        $pass = '';
        if(preg_match("~^.*?check::([^<:]+).*?$~is", $data, $pass))
        {
            $pass = !empty($pass[1]) ? $pass[1] : '';
        }
        if(!$pass)
        {
            //password not found
            echo '0';
            exit();
        }
        $access = EventPurchase::Get($this->mUser->mUserInfo['Id'], $event);
        if(!empty($access))
        {
            if($access['Code'] == $pass)
            {
                //add viewer of this broadcasting
                BroadcastViewers::AddViewer($event_id, $this->mUser->mUserInfo['Id']);
                echo '1';
                exit();
            }
        }
        echo '0';
    }
    /**
     * Add new flow on click button "Start broadcast" in flash
     * get from input data:
     * event_id - base flow code
     * flow - old flow name (if it is equal event_id - open first flow, else close old flow)
     * return new flow name in success or '0' in other cases
     */
    public function NewBroadcastFlow()
    {

        $data = file_get_contents('php://input');
        //get event_id and flow name from $data
        $event_id = '';
         
        if(preg_match("~^.*?event_id::([^<:]+).*?$~is", $data, $event_id))
	
        { 
            $event_id = !empty($event_id[1]) ? strip_tags( $event_id[1] ) : '';
        }
        if(!$event_id)
        {
            echo '0';
            exit();
        }
        if ($event_id[0]=='u')
        {
            //ad-hoc broadcast 
            $login = substr($event_id, 1);
            $ui = User::GetUserByLogin($login);
            if (empty($ui) || $ui['Status'] != 2)
            {
                echo '0';
            }
            else
            {
                //count of used flows
                $num = BroadcastFlows::GetEventFlowsCount($ui['Id']);
                if($num == 0)
                {
                    $newflow = $event_id;
                }
                else
                {
                    $newflow = $event_id . $num; //new flow name

                    //if flow exist, but not used
                    $old_flow = BroadcastFlowsQuery::create()->select('Id')->filterByFlow($newflow)->findOne();
                }


                if (empty($old_flow))
                {
                    if ($newflow != $event_id)
                    {
                        //close old flow
                        BroadcastFlowsQuery::create()->select(array('Id'))->filterByUserId($ui['Id'])->filterByEventId(0)
                            ->filterByFlow($newflow, '<>')->filterByStatus(0)->update(array('Status' => 1));
                    }
                    //add new flow
                    BroadcastFlows::AddFlow($ui['Id'], $newflow);
                }
                //save to cache
                $this->mCache->set('broadcast_' . $event_id, serialize(array('flow' => $newflow, 'recording' => 0, time => mktime())), 3*3600);
                echo $newflow;
            }
            exit();
        }
        $event = Event::GetEventByCode($event_id, 1);
        if(empty($event))
        {
            echo '0';
            exit();
        }
        
        //count of flows
        $num = BroadcastFlows::GetEventFlowsCount($event['UserId'], $event['Id']);
        if($num == 0)
        {
            $newflow = $event_id; //first flow name equal base flow name
        }
        else
        {
            $newflow = $event_id . $num; //new flow name

            //if flow exist, but not used
            $old_flow = BroadcastFlowsQuery::create()->select('Id')->filterByFlow($newflow)->findOne();
        }

        if (empty($old_flow))
        {
            if ($newflow != $event_id)
            {
                //close old flow if it specified
                BroadcastFlowsQuery::create()->select(array('Id'))->filterByUserId($event['UserId'])->filterByEventId($event['Id'])
                    ->filterByFlow($newflow, '<>')->filterByStatus(0)->update(array('Status' => 1));
            }
            //add flow
            BroadcastFlows::AddFlow($event['UserId'], $newflow, $event['Id']);
        }

        //save to cache
        $this->mCache->set('broadcast_' . $event_id, serialize(array('flow' => $newflow, 'recording'=>0, 'time' => mktime())), 3*3600);
		//Start the flow recording in the server
        echo $newflow;
        exit();
    }
	
	public function StopFlow()
    {
        $data = file_get_contents('php://input');
        //get event_id and flow name from $data
        $event_id = '';

        if(preg_match("~^.*?event_id::([^<:]+).*?$~is", $data, $event_id))
        {
            $event_id = !empty($event_id[1]) ? strip_tags( $event_id[1] ) : '';
        }
		if(!$event_id)
        {
            echo '0';
            exit();
        } 
		$cache = $this->mCache->get('broadcast_' . $event_id, 4 * 3600);
		if(!empty($cache)){
			$cache = unserialize($cache);
			$recording = $cache['recording'];
			if($recording) echo '0';
			else echo '1';
			exit();
		} else {
			echo '1';
			exit;
		}
	}


    /**
     * Set used status to flow
     */
    public function UseFlow()
    {	
        $data = file_get_contents('php://input');
        //get event_id and flow name from $data
        $event_id = '';

        if(preg_match("~^.*?event_id::([^<:]+).*?$~is", $data, $event_id))
        {
            $event_id = !empty($event_id[1]) ? strip_tags( $event_id[1] ) : '';
        } 
		
        if(!$event_id)
        {
            echo '0'; 
            exit();
        }    

        $fl = BroadcastFlowsQuery::create()->select('Id')->filterByFlow($event_id)->filterByUsed(0)->findOne();
        if (empty($fl))
        {
            echo '0';
            exit();
        }

        BroadcastFlowsQuery::create()->select('Id')->filterById($fl)->update(array('Used'=>mktime()));

        //post message on artist wall about starting broadcast
        if ($event_id[0] == 'u')
        {
            $link = 'http://'.DOMAIN.'/broadcasting/'.$this->mUser->mUserInfo['Name'].'/live';
			
        }
        else
        {
			$event = BroadcastFlowsQuery::create()->select('EventId')->filterById($fl)->findOne();
			$link ='http://'.DOMAIN.'/broadcasting/'.$event.'/';
        }
		$msg = 'Broadcast started here '.$link ;
		//$wallMsg = 'Broadcast started <a href="'.$link.'" target="_blank">here</a>';
        Wall::Add( $this->mUser->mUserInfo['Id'], $this->mUser->mUserInfo['Id'], $msg, '','', 0, $this->mCache );
        //re-post to twitter
        if (!empty($this->mUser->mUserInfo['TwOauthToken']) && !empty($this->mUser->mUserInfo['TwOauthTokenSecret']))
        {
            require_once('libs/twitteroauth/twitteroauth.php');
            $tweet = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, $this->mUser->mUserInfo['TwOauthToken'], $this->mUser->mUserInfo['TwOauthTokenSecret']);
            $tweet->post('statuses/update', array('status' => $msg));
        }

        if (!empty($this->mUser->mUserInfo['FbId']))
        {
            require_once 'libs/facebook-php-sdk/src/facebook.php';
            $facebook = new Facebook(array('appId'  => FACEBOOK_API_ID, 'secret' => FACEBOOK_API_SECRET));
            $token = !empty($this->mUser->mUserInfo['FbToken']) ? $this->mUser->mUserInfo['FbToken'] : $facebook->getAccessToken();
            try
            {
                $facebook->api('/'.$this->mUser->mUserInfo['FbId'] . '/feed', 'POST', array('access_token' => $token, 'message' => strip_tags($msg), 'link' => $link));
            }
            catch(FacebookApiException $e)
            {
            }
        }
        echo '1';
        exit();
    }
	
	public function LiveRecording($recording="on", $flow="")
	{
		if($recording =="on"){
			$action = 'startRecording';
			$recordMode = 'true';
		} else {
			$action = 'stopRecording';
			$recordMode ='false';
		}
		
		$mode = _v('mode');
		if($mode=="new"){
			$request = sprintf(STREAMING_LIVE_UPLOAD_NEW."&streamname=%s&format=%s&recInterval=0&action=%s&recTimer=0", $flow, STREAMING_MP4_FORMAT_STRING, $action);
		} else {
			$request = sprintf(STREAMING_LIVE_UPLOAD."&streamname=%s&format=%s&recInterval=0&action=%s&recTimer=0", $flow, STREAMING_MP4_FORMAT, $action);
		}
		
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $request);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		$response = curl_exec($curl);
		if(curl_error($curl)){
			$error = 'Error In Start Recording: '.curl_error($curl).' Error Code: '. curl_errno($curl);
			sendEmail('admin@artistfan.com', 'Admin', 'bks@usaweb.net', 'Bala', DOMAIN. ' '. $action, ' Error', $error);
		}
		curl_close($curl);
		if($recording == "on"){
			if(stristr($response, 'recording:start')) {
				return 1;
			} 
		} else {
			if(stristr($response, 'recording:stop')) {
				return 1;
			}
		}
		$params['to'] = 'np@usaweb.net';
		sendEmail('admin@artistfan.com', 'Admin', 'bks@usaweb.net', 'Bala', DOMAIN. ' '.$action, ' Response '. $request. '<br />'.$response, $params);
		return 0;
	}
	
	public function StartRecord()
	{
      $redirect = $this->GetRedirectUrl();

  	  if($_REQUEST['ajaxMode'])
	  {		
		$event_id = _v('event_id', '');
		
		$res['success'] = 0;
		if(!$event_id){
			$res['message'] = NO_EVENT_TO_RECORD;
			echo json_encode($res);
        	exit();
		}
		$cache = $this->mCache->get('broadcast_' . $event_id, 4 * 3600);
		$res['message'] = RECORDING_NOT_STARTED_YET;
		if(!empty($cache))
		{
			$cache = unserialize($cache);
			$flow = $cache['flow'];
			$time = $cache['time'];
			$recordStart = $this->LiveRecording("on", $flow);
			if($recordStart) 
			{
				$res['success'] = 1;
				$res['message'] = RECORDING_STARTED;
				$res['flow'] = $flow;
				$this->mCache->set('broadcast_' . $event_id, serialize(array('flow' => $flow, 'recording' => 1, 'time' => mktime())), 4 * 3600);
			} 
			else 
			{
				$res['message'] = PLEASE_START_BROADCAST_OR_TRY_AGAIN;
			}
		}
		echo json_encode($res);
        exit();
	  } 
	  else 
	  {
		uni_redirect(PATH_ROOT . 'u/'.$this->mUser->mUserInfo['Name']);
	  }		
	}
	
	public function StopRecord()
	{
      $redirect = $this->GetRedirectUrl();
		
  	  if($_REQUEST['ajaxMode'])
	  {	
		$event_id = _v('event_id', '');
		$cache = $this->mCache->get('broadcast_' . $event_id, 4 * 3600);
		$res['success'] = 0;
		$res['message'] = RECORDING_NOT_STOPPED;
		if(!empty($cache))
		{
			$cache = unserialize($cache);
			$flow = $cache['flow'];
			$time = $cache['time'];
			$res['flow'] = $flow;
			$recording = $cache['recording'];
			if(!$recording){
				$res['success'] = 1;
				$res['message'] = RECORDING_NOT_STARTED;
			} else {
				$recordStop = $this->LiveRecording("off", $flow);
				if($recordStop) {
					$res['success'] = 1;
					$res['message'] = 'Recording Stopped';
					$this->mCache->set('broadcast_' . $event_id, serialize(array('flow' => $flow, 'recording' => 0, 'time' => mktime())), 4 * 3600);
				}
			}
		}
		echo json_encode($res);
        exit();
	  } 
	  else 
	  {
		uni_redirect(PATH_ROOT . 'u/'.$this->mUser->mUserInfo['Name']);
	  }			
	}
	
	public function StopRecordFlash()
	{
		$data = file_get_contents('php://input');
        //get event_id and flow name from $data
        $event_id = '';
        if(preg_match("~^.*?event_id::([^<:]+).*?$~is", $data, $event_id))
        {
            $event_id = !empty($event_id[1]) ? strip_tags( $event_id[1] ) : '';
        }
		if(!$event_id)
        { 
            echo '0';
            exit();
        } 
		$cache = $this->mCache->get('broadcast_' . $event_id, 4 * 3600);
		if(!empty($cache)){
			$cache = unserialize($cache);
			$flow = $cache['flow'];
			$time = $cache['time'];
			$recording = $cache['recording'];
			if(!$recording){
				echo '1';
				exit;
			}
			$res['flow'] = $flow;
			$recordStop = $this->LiveRecording("off", $flow);
			if($recordStop) {
				$this->mCache->set('broadcast_' . $event_id, serialize(array('flow' => $flow, 'recording' => 0, 'time' => mktime())), 4 * 3600);
				echo '1';
				exit;
			} 
		}
		echo '0';
        exit();
	}
	
	
	public function StopBroadcastFlash()
	{
		$data = file_get_contents('php://input');
        //get event_id and flow name from $data
        $event_id = '';
        if(preg_match("~^.*?event_id::([^<:]+).*?$~is", $data, $event_id))
        {
            $event_id = !empty($event_id[1]) ? strip_tags( $event_id[1] ) : '';
        }
		if(!$event_id)
        {
            echo '0';
            exit();
        } 
		
		 if ($event_id[0]=='u')
        {
            //ad-hoc broadcast
            $userEvent = substr($event_id, 1); 			
		} else {
		 	$eventCode = Event::GetEventByCode($event_id, 1);
		} 
		$cache = $this->mCache->get('broadcast_' . $event_id, 4 * 3600);
		if(!empty($cache))
		{
			$cache = unserialize($cache);
			$flow = $cache['flow'];
			$time = $cache['time'];
			$recording = $cache['recording'];
			if($eventCode){
				EventQuery::create()->select(array('Id'))->filterById($id)->update(array('Status' => 4));
			} 
			BroadcastFlows::CloseEventByFlow($flow);
			$this->mCache->set('broadcast_' . $event_id, '', 1);
			$this->mCache->set('events_onwall' . $this->mUser->mUserInfo['Id'], '', 1);
			echo '1';
			exit;
		}
		echo '0';
        exit();
	}	
	public function CheckEventFinished()
	{	
      $redirect = $this->GetRedirectUrl();
		
  	  if($_REQUEST['ajaxMode'])
	  {		
		$event_id = _v('id', '');
		$res['status'] = 0;
		$cache = $this->mCache->get('broadcast_' . $event_id);
		if(empty($cache))
		{
			$res['status'] = 1;
			$res['q'] = OK;	
		}
        echo json_encode($res);
        exit();
	  }/* 
	  else 
	  {
		uni_redirect(PATH_ROOT . 'u/'.$this->mUser->mUserInfo['Name']);
	  }	*/		
	}

    /**
     * Ajax get broadcast viewers count
     */
    public function GetViewersCount()
    {
      $redirect = $this->GetRedirectUrl();
		
  	  if($_REQUEST['ajaxMode'])
	  {	
        $res = array('q' => OK);
        
        $event_id = trim(strip_tags(_v('event_id', '')));
        if($event_id)
        {
            $res['count'] = BroadcastViewers::GetCount($event_id);
        }
        echo json_encode($res);
        exit();
	  } /*
	  else 
	  {
		uni_redirect(PATH_ROOT . 'u/'.$this->mUser->mUserInfo['Name']);
	  }		*/	
    }

    /**
     * Ajax get broadcast viewers list
     */
    public function GetViewersList()
    {
      $redirect = $this->GetRedirectUrl();
		
  	  if($_REQUEST['ajaxMode'])
	  {	
        $res = array('q' => OK, 'count' => 0, 'list' => array(), 'length' => 0, 'time' => 0);

        $event_id = trim(strip_tags(_v('event_id', '')));
        $page = _v('page', 1);
        $time = _v('time', 0);
        $limit = 10;
        if($event_id)
        {
            $res = BroadcastViewers::GetListViewers($event_id, $limit, $page);
            $res['q'] = OK;
        }
        if(!$time)
        {
            $event = Event::GetEventByCode($event_id);
            $time = BroadcastFlows::GetEventFirstFlowDate($this->mUser->mUserInfo['Id'], !empty($event) ? $event : 0);
            $res['time'] = $time;
        }
        if($time != 0)
        {
            $res['length'] = floor((mktime() - $time) / 60);
        }
        echo json_encode($res);
        exit();
	  } 
/*	  else 
	  {
		uni_redirect(PATH_ROOT . 'u/'.$this->mUser->mUserInfo['Name']);
	  }	*/		
    }

    /**
     * Ajax update viewer (last time)
     */
    public function UpdateViewer()
    {
      $redirect = $this->GetRedirectUrl();
		
  	  if($_REQUEST['ajaxMode'])
	  {	
        $res = array('q' => OK );
        $event_id = trim(strip_tags(_v('event_id', '')));
        if($event_id && $this->mUser->IsAuth())
        {
            BroadcastViewers::UpdateViewer($event_id, $this->mUser->mUserInfo['Id']);
        }
        echo json_encode($res);
        exit();
	  } 
/*	  else 
	  {
		uni_redirect(PATH_ROOT . 'u/'.$this->mUser->mUserInfo['Name']);
	  }	*/		
    }

    /**
     * check broadcast event status - online or offline
     * @return void
     */
    public function CheckEventOnline()
    {
      $redirect = $this->GetRedirectUrl();

  	  if($_REQUEST['ajaxMode'])
	  {	
        $res = array('q' => OK , 'online' => 0);
        $event_id = trim(strip_tags(_v('event_id', '')));
		$uid = trim(strip_tags(_v('uid', '')));
        
        //get current flow from cache
        $cache = $this->mCache->get('broadcast_' . $event_id);
		
		$time = 0;
        if(!empty($cache))
        {
            $cache = unserialize($cache);
            $flow = $cache['flow'];
            $time = $cache['time'];
        } 
		else 
		{
			$res['online'] = 0;
			$res['eventFinish'] = 1;
		}
        
        $res['online'] = (!empty($flow) && !empty($time) && $time > mktime()-60) ? 1 : 0;
		
        if($res['online'] == 0)
		{
			if($time != 0) 
			{
				$res['eventFinish'] = 1;
			}
		}
		
		if($res['online'])
		{
			$sflow = BroadcastFlows::GetEventLatestFlow($uid, 0, 0, 1, $event_id);

			if(!$sflow)
			{
				$res['online'] = 0;
			}
		}
		
        echo json_encode($res);
        exit();
	  } 
/*	  else 
	  {
		uni_redirect(PATH_ROOT . 'u/'.$this->mUser->mUserInfo['Name']);
	  }	*/
    }
	/**
	* Upload photos on the wall
	* @return json_code
	*/
	 public function UploadWallPhoto()
    {

        include_once 'model/FileUpload.class.php';
        $mFu = new FileUpload(array('jpg', 'jpeg', 'gif', 'png'));

        //upload to tmp directory
        $result = $mFu->handleUpload( 'files/wall/tmp/');

        //crop to small size
        if (!empty($result['success']) && 1==$result['success'])
        {
            //$result['image'] = $mFu->GetSavedFile();
            $result['image'] = $mFu->GetSavedFile();
        }

        echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
        exit();
    }
	
	 /**
     * Buy/add music track
     * @return void
     */
    
	public function UpdateFbTwRequest()
	{
		if($this->mUser->mUserInfo['TwId'])
		{
			$fbTwFollower = Invitation::CheckTwInvitationFollower( $this->mUser->mUserInfo['Id']);	
			$fbTwInviter = Invitation::getTwInviter($this->mUser->mUserInfo['Id']);
		}
		else if($this->mUser->mUserInfo['FbId'])
		{
			$fbTwFollower = Invitation::CheckFbInvitationFollower( $this->mUser->mUserInfo['Id']);
			$fbTwInviter = Invitation::getFbInviter($this->mUser->mUserInfo['Id']);
		}
		
		if (empty($fbTwFollower))
		{
			$ui = User::GetUser( $fbTwInviter );
			
			if (!empty($ui))
			{
				//we can follow artists only
				$follow = UserFollow::GetFollow( $ui['Id'], $this->mUser->mUserInfo['Id']);
				
				
				if (empty($follow))
				{
					//follow
					$mUf = new UserFollow();
					$mUf->setUserId( $fbTwInviter );
					$mUf->setUserIdFollow($this->mUser->mUserInfo['Id']);
					$mUf->save();
					
					$fromuser 	= User::GetUserFullInfo($fbTwInviter);
					$touser 	= User::GetUserFullInfo($this->mUser->mUserInfo['Id']);
					
					if($touser['Email'])
					{
						$this->mSmarty->assign('formuser', $fromuser);
						$this->mSmarty->assign('touser', $touser);
						$fromEmail = ADMIN_EMAIL;
						$fromName = SITE_NAME;
						$toEmail = $touser['Email'];
						$toName = $touser['Name'];
						$subject = NEW_FOLLOWER_FROM.SITE_NAME;
						$message = $this->mSmarty->fetch('mails/follow_add_notification.html');
						sendEmail($fromEmail,$fromName, $toEmail, $toName, $subject, $message);
					}
					

					//clear cache followers count
					$this->mCache->set('count_followers' . $fbTwInviter, '', 1);

					//log - for artists only
					if($ui['Status']==2 || $ui['Status']==1 )
					{
						if($this->mUser->mUserInfo['Status'] == USER_FAN)
						{
								$iconClass = 'icon_04';
						}else{
								$iconClass = 'icon_05';
						}
			
			$userName = $ui['BandName'] ?  $ui['BandName'] :  $ui['FirstName'].' '. $ui['LastName'];

			$mesg	=	 '<a href="/u/'.$ui['Name'].'" class="'.$iconClass.'">'.$userName.'</a> is now following '.$this->mUser->mUserInfo['FirstName'].'';


						$wallConfirmation = Wall::Add( $this->mUser->mUserInfo['Id'], $ui['Id'], $mesg, '', '', 1 );		
														
						ShoppingLog::LogAdd($this->mUser->mUserInfo['Id'], $fbTwInviter, 'follow', '', $this->mCache);						
						
						$followers	=	UserFollow::GetFollowersUserList( $fbTwInviter );	
												
						if($wallConfirmation)
						{														
							 Notification::Add( $wallConfirmation, $comment_id='', $mesg, $ui['Id'] );																	
						 }						
						
					}

					$res['q'] = OK;
					$res['data'] = 1;
					$res['status'] = $ui['Status'];
				}
				else
				{
					//unfollow
					UserFollowQuery::create()->select('Id')->filterById($follow)->delete();
					//clear cache followers count
					$this->mCache->set('count_followers' . $fbTwInviter, '', 1);
					//log - for artists only						
						
										
					$res['q'] = OK;
					$res['data'] = 2;
					$res['status'] = $ui['Status'];					
				}
			}
		}

		//**add fb profile photo add
		if($this->mUser->mUserInfo['Avatar'] == '' && $this->mUser->mUserInfo['FbId'] != '')
		{
			$fbimage = 'https://graph.facebook.com/'.$this->mUser->mUserInfo['FbId'].'/picture?width=400&height=400';
					
			$filename = mt_rand().'_tmp.jpg';
			$mt_rand = 'files/photo/'.$filename;
	
			if($fbimage) 
			{
				if(copy($fbimage,$mt_rand))
					$newImage =  $mt_rand;
			}
			if(!empty($newImage))
			{
				$scale = 1;
		
				include_once 'libs/Crop/Image_Transform.php';
				include_once 'libs/Crop/Image_Transform_Driver_GD.php';
									
				$rand = rand(100, 9999);
		
				$crop_fnamem = 'files/images/avatars/m_user_'.$this->mUser->mUserInfo['Id'].$rand.'.jpg';
				i_crop_copy(USER_MEDIUM_IMAGE_WIDTH, USER_MEDIUM_IMAGE_HEIGHT, $newImage,  BPATH .$crop_fnamem, 1);
		
				$crop_fnames = 'files/images/avatars/s_user_'.$this->mUser->mUserInfo['Id'].$rand.'.jpg';
				i_crop_copy(USER_PROFILE_IMAGE_WIDTH, USER_PROFILE_IMAGE_HEIGHT, $newImage,  BPATH .$crop_fnames, 1);
		
				$crop_fnamex = 'files/images/avatars/x_user_'.$this->mUser->mUserInfo['Id'].$rand.'.jpg';
				i_crop_copy(USER_THUMB_IMAGE_WIDTH, USER_THUMB_IMAGE_HEIGHT,  BPATH .$crop_fnames, BPATH .$crop_fnamex, 1);
				
				$crop_fnamec = 'files/images/avatars/c_user_'.$this->mUser->mUserInfo['Id'].$rand.'.jpg';
				i_crop_copy(COMMON_IMAGE_WIDTH, COMMON_IMAGE_HEIGHT, BPATH .$crop_fnames, BPATH .$crop_fnamec, 1);
		
				$user_obj = UserQuery::create()->select(array('Id', 'Avatar'))
							->filterById($this->mUser->mUserInfo['Id'])->findOne();
		
		
				UserQuery::create()->select(array('Id', 'Avatar'))
							->filterById($this->mUser->mUserInfo['Id'])
							->update(array('Avatar' => 'user_'.$this->mUser->mUserInfo['Id'].$rand.'.jpg'));
				
				
				$image = $newImage;
				
				 if (!empty($image))
				 {	 
						$ext = 'jpg';
						
						$dir = MakeUserDir('files/photo/origin', $this->mUser->mUserInfo['Id']);
						$fn = substr(md5(mktime()), 0, 10) . date("hm") . '.' . $ext;
						copy(BPATH . $image, BPATH . $dir . '/' . $fn);
		
						//photo thumbnail
		
						$tfn = MakeUserDir('files/photo/thumbs', $this->mUser->mUserInfo['Id']) . '/' . $fn;
						
						i_crop_copy(203, 168, BPATH . $dir . '/' . $fn,  BPATH . $tfn, 1);
						
		
						//mid size
						$mfn = MakeUserDir('files/photo/mid', $this->mUser->mUserInfo['Id']) . '/' . $fn;
						i_crop_copy(700, 700, BPATH . $dir . '/' . $fn,  BPATH . $mfn, 2);
		
						$image = $fn;
				
						$profileAbumId = PhotoAlbum::getProfilePictureAlbum($this->mUser->mUserInfo['Id']);
		
						if(!$profileAbumId)
						{
							$profileAbumId = PhotoAlbum::AddAlbum($this->mUser->mUserInfo['Id'], trim(strip_tags(PROFILE_PICTURES)));
						}
						
						
						
						$mesg = I_HAVE_JUST_ADDED_A_NEW_PHOTO;
						$wallId = Wall::Add( $this->mUser->mUserInfo['Id'], $this->mUser->mUserInfo['Id'], $mesg, $image, '', 0, $this->mCache );																		
						$phId = Photo::AddPhoto($this->mUser->mUserInfo['Id'], $profileAbumId, $image, 0, 0, PROFILE_PICTURES, '',  1);
						Photo::UpdatePhotoWallId($phId, $wallId);
							
						
				  }
				  
				@unlink(BPATH.$orginalImage);
				@unlink(BPATH.$newImage);		  
				//delete old
				if ($user_obj['Avatar'])
				{
					if (file_exists(BPATH.'files/images/avatars/s_'.$user_obj['Avatar']))
					{
						@unlink( BPATH.'files/images/avatars/s_'.$user_obj['Avatar'] );
						//@unlink( BPATH.'files/images/avatars/m_'.$user_obj['Avatar'] );
						@unlink( BPATH.'files/images/avatars/x_'.$user_obj['Avatar'] );
						@unlink( BPATH.'files/images/avatars/c_'.$user_obj['Avatar'] );
					}
				}	
			}			
		}
				
	
	}
	
	public function PurchaseMusic()
    {
		
      $redirect = $this->GetRedirectUrl();

  	  if($_REQUEST['ajaxMode'])
	  {	
        $id = _v('id', 0);
        $music = Music::GetMusic($id);

        $res = array('q' => OK, 'errs' => array());

        if (!$this->mUser->IsAuth())
        {
            $this->mlObj['mSession']->set('redirect', array('content' => 'track', 'id' => $id));
            $this->mlObj['mSession']->set('notice', YOU_HAVE_TO_BE_A_REGISTERED_ARTISTSFAN_COM_USER_TO . (!empty($music['Price']) ?  'buy' : 'add') . CONTENT_FROM_ARTISTS_PLEASE_SIGNUP_OR_SIGNIN_BELOW );
            $res['q'] = ERR;
            echo json_encode($res);
            exit();
        }
        $this->mlObj['mSession']->Del('redirect');
        $this->mlObj['mSession']->Del('notice');

        if (!empty($music) && $music['Active'] == 1 && $music['Deleted'] != 1)
        {
            $purchase = MusicPurchase::Get($this->mUser->mUserInfo['Id'], $id);
            if (empty($purchase))
            {
                if (empty($music['Price']))
                {
								$adminPrice  = floor($music['Price'] * ADMIN_PRICE_PERCENT / 100);
								$artistPrice = ceil($music['Price'] * ARTIST_PRICE_PERCENT / 100);	
                                MusicPurchase::Purchase($this->mUser->mUserInfo['Id'], $music['Id'], $artistPrice);
						
                   // MusicPurchase::Purchase($this->mUser->mUserInfo['Id'], $music['Id'], $music['Price']);
                    if($music['Price'] > 0)
                    {
                        $sum = $this->mUser->mUserInfo['Wallet'] - $music['Price'];
                        //update user's wallet
                        User::UpdateWallet($this->mUser->mUserInfo['Id'], $sum);

                        //update artist's wallet
                        $artist = User::GetUser($music['UserId']);
                        if(empty($artist['Wallet']))
                        {
                            $artist['Wallet'] = 0;
                        }
                        $artist['Wallet'] = $artist['Wallet'] + $music['Price'];
                        User::UpdateWallet($artist['Id'], $artist['Wallet']);
						
													// admin purchase  Start
							$pc_type_name	 = 'PurchaseMusic';
							$pc_type_id		 =	$music['Id'];
							$pc_price		 =	$adminPrice;
							$pc_user_id		 =	$this->mUser->mUserInfo['Id'];	
							$pc_artist_id	 =  $music['UserId'];
							//$pc_description	 =	serialize(array('type' => 'PurchaseMusic', 'id' => $music['Id'], 'title' => $music['Title']));							
							$pc_description	 =	serialize(array('type' => 'PurchaseMusic', 'id' => $music['Id'], 'title' => $music['Title'],'Price'=>$music['Price'],'commision  Price'=>$pc_price));								
							Payout::Admin_PurchaseInsert($pc_type_name,$pc_type_id,$pc_price,$pc_description,$pc_user_id,$pc_artist_id);						
							// admin purchase  End

                        //log
                        ShoppingLog::LogAdd($music['UserId'], $this->mUser->mUserInfo['Id'], 'buy_track', array('Id' => $music['Id'], 'Title' => $music['Title'], 'Price' => $music['Price']), $this->mCache);
                        //for artist transaction history
                        Payout::PayoutMoney($music['UserId'], 1, 0, $music['Price'], $artist['Wallet'], $this->mUser->mUserInfo['Id'], 1, array('type' => 'track', 'id' => $music['Id'], 'title' => $music['Title']));
                        //for fan transaction history
                        Payout::PayoutMoney($this->mUser->mUserInfo['Id'], 0, 0, $music['Price'], $sum, $this->mUser->mUserInfo['Id'], 1, array('type' => 'track', 'id' => $music['Id'], 'title' => $music['Title'], 'user_id' => $music['UserId']));
                    } 
					$this->mSession->Set('DownloadCode',true);	
					$res['Download'] = '/base/download/Download/?id='.$id.'&act=music';
					//base/download/Download/?id={$smarty.request.musicId}&act=music

                    //fan rating
                    UserFollow::ChangeRating($this->mUser->mUserInfo['Id'], $music['UserId'], ($music['Price'] > 0 ? 'buy_track' : 'add_track'));

                    //check if all album is purchased
                    $res['q'] = OK;
                  //  $res['track'] = $music['Track'];		
					
					
                }
                else
                {
                    $res['errs'][] = YOU_DO_NOT_HAVE_ENOUGH_POINTS_IN_THE_ACCOUNT;
                }
            }
            else
            {
                $res['errs'][] = ($music['Price'] > 0) ? THE_TRACK_HAS_ALREADY_PURCHASED : THE_TRACK_HAS_ALREADY_ADDED;
            }
        }
        else
        {
            $res['errs'][] = THE_TRACK_NOT_FOUND;
        }
        echo json_encode($res);
        exit();
	  } 
	  else 
	  {
		uni_redirect(PATH_ROOT . 'u/'.$this->mUser->mUserInfo['Name']);
	  }		
		
    }
	
	
	
}