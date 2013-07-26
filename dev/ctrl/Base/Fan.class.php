<?php
/**
 * Base Fun profile class
 * User: ssergy
 * Date: 08.02.12
 * Time: 17:45
 *
 */

class Base_Fan extends Base
{
    public function __construct($glObj)
    {
        parent :: __construct($glObj);

        if (!$this->mUser->IsAuth())
        {
            uni_redirect(PATH_ROOT . 'base/user/login');
        }

        if ($this->mUser->mUserInfo['Status'] != 1)
        {
            uni_redirect(PATH_ROOT);
        }
		//Fellow Fans as Friends
        $friends = UserFollow::GetFollowList($this->mUser->mUserInfo['Id'], 1, 6);
        $this->mSmarty->assignByRef('friends', $friends);		
    }


    /**
     * Main dashboard page
     * @return void
     */
    public function Index()
    {

        $this->mSmarty->display('mods/profile/edit_fan/dashboard.html');
        exit();
    }
    /**
     * Fan's artists list
     */
    public function Artists()
    {
        $this->mSmarty->assign('module', 'artists');

        $follow_artist = UserFollow::GetFollowersUserList($this->mUser->mUserInfo['Id'], USER_ARTIST);
        $this->mSmarty->assignByRef('follow_artist', $follow_artist);

        $this->mSmarty->display('mods/profile/edit_fan/artists.html');
        exit();
    }

    /**
     * Fan's fellow fans list
     */
    public function Fans()
    {
	    $this->mSmarty->assign('module', 'fans');

		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
				
        $fans_follow = UserFollow::GetFollowersUserList($this->mUser->mUserInfo['Id'], USER_FAN);
        $this->mSmarty->assignByRef('fans_follow', $fans_follow);
		
        $this->mSmarty->display('mods/profile/edit_fan/fans.html');
        exit();
    }

    /**
     * News feed
     * @return void
     */
    public function Feed()
    {
        $this->mSmarty->assign('module', 'feed');
		
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
        $this->mSmarty->display('mods/profile/edit_fan/feed.html');
        exit();
    }


    /**
     * Music
     * @return void
     */
    public function Music()
    {
		$user_id = $this->mUser->mUserInfo['Id'];		
        $this->mSmarty->assign('module', 'music');
	    $this->mSmarty->assign('user_id', 'user_id');	

		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);			

		$id = _v('id', 0);	
		if($id)
		{
			MusicPurchase::PurchaseDeleteUpdate($user_id, $id);
			 
			$track = $this->mSmarty->assignByRef('tracks', Music::GetPurchasedMusicList( $this->mUser->mUserInfo['Id'], 0, 0, 0, 1 ));
			$res['q'] = OK;
			
			$res['data'] = $this->mSmarty->Fetch('mods/profile/edit_fan/ajax/filter_music.html');
			
        	echo json_encode($res);
			exit();			
		}
		
		$tracks 	=	Music::GetPurchasedMusicList( $this->mUser->mUserInfo['Id'], 0, 0, 0, 1 );

		//$albumIds	=	array();	
		$albumIds	=	'';			
		foreach($tracks as $track)
		{
			//deb($track['Id']);
			if($track['Id'])
			{
							$albumIds .= $track['AlbumId'].',';
							
			}else if($track['WithAllAlbum']){
				$albumIds .= $track['WithAllAlbum'].',';
			}
		}	
		$albumIds = substr($albumIds, 0, -1);
		
		if($albumIds)
		{
				$albmIds = $albumIds;
		}else{
				$albmIds = 0;
		}
		$AlbumDetails =	Music::ShowAlbumsByMusicPurchaseId($this->mUser->mUserInfo['Id'], 0, 0, $albmIds, 1);
		
	    $this->mSmarty->assignByRef('albums', $AlbumDetails['music']);

        $this->mSmarty->display('mods/profile/edit_fan/music.html');
        exit();
    }
	
	public function Play()
    {
        $user_id = $this->mUser->mUserInfo['Id'];
		
        $this->mSmarty->assign('module', 'music');
	    $this->mSmarty->assign('user_id', 'user_id');
		
        $id = _v('id', 0);
		if ($id)
        {
            $music = Music::GetMusic($id, 1, 1);
			$this->mSmarty->assign('submodule', 'MusicOne');
			//show one music
            if (empty($music) || empty($music['Active']) || $music['Deleted'] == 1 || $music['Status'] > 0)
            {
                uni_redirect( PATH_ROOT . 'fan/music' );
            }
			
		
            $music['MusicPurchase'] = MusicPurchase::Get($this->mUser->mUserInfo['Id'], $id);

			if(!$music['MusicPurchase']){
				//check album
				
			}
			if(!$music['MusicPurchase']){
				uni_redirect( PATH_ROOT . 'fan/music' );
			}
            $this->mSmarty->assignByRef('music', $music);
            $this->mSmarty->display('mods/profile/edit_fan/music_one.html');
        } else {
			uni_redirect( PATH_ROOT . 'fan/music' );
		}
	   
        exit();
    }


    /**
     * Video
     * @return void
     */
    public function Video()
    {
        $this->mSmarty->assign('module', 'video');
		
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
		
		$page = _v('page', 1);
		$pcnt = _v('pcnt', 6);

		
        //$id = _v('id', 0);
        $id = trim(strip_tags(_v('id', '')));
        $is_broadcasting = 0;
        if (!empty($id) && $id[0]=='b')
        {
            $is_broadcasting = 1;
            $id = substr($id, 1);
        }
        $id = (int)$id;
		$delete_video_id = _v('delete_video_id', 0);

        include_once 'model/Pagging.class.php';
        $link = ROOT_HTTP_PATH . '/fan/video';
					
		if($delete_video_id)
		{
			VideoPurchase::PurchaseDeleteUpdate($this->mUser->mUserInfo['Id'], $delete_video_id);	
					 
		  	$video = Video::GetPurchasedVideoList( $this->mUser->mUserInfo['Id'], 0, $page, $pcnt );			
			$rcnt = Video::GetPurchasedVideoListCount( $this->mUser->mUserInfo['Id'], 0);
			
			$this->mSmarty->assignByRef('videos', $video);
						
			$res['q'] = OK;
		
		    $mpg = new Pagging($pcnt, $rcnt, $page, $link);
        	$pagging = $mpg->Make2($this->mSmarty, 0, 1);

			
			$res['data'] = $this->mSmarty->Fetch('mods/profile/edit_fan/ajax/filter_video.html');
			$res['pagging'] = $pagging;
			
        	echo json_encode($res);
			exit();			
		}
				
        if (!$id)
        {
		//deb(Video::GetPurchasedVideoList( $this->mUser->mUserInfo['Id'], 0 ));
            //video list
            $this->mSmarty->assignByRef('videos', Video::GetPurchasedVideoList( $this->mUser->mUserInfo['Id'], 0, $page, $pcnt ));
			$rcnt = Video::GetPurchasedVideoListCount( $this->mUser->mUserInfo['Id'], 0);
//        deb($rcnt);
			$mpg = new Pagging($pcnt, $rcnt, $page, $link);
			$pagging = $mpg->Make2($this->mSmarty, 0, 1);
	
			$this->mSmarty->assignByRef('pagging', $pagging);
				  
            //broadcast recordings
            //get events with purchased access
            $event_ids = Event::FinishedEventsPurchasedList($this->mUser->mUserInfo['Id']);
            /*
			$recordings = EventVideo::GetListEventsRecordings(0, $event_ids);
            $this->mSmarty->assignByRef('recordings', $recordings);
			*/
            $this->mSmarty->display('mods/profile/edit_fan/video.html');
        }
        else
        {
            if(!$is_broadcasting)
            {
                //show one video
                $video = Video::GetVideoInfo($id, 0, 1);
				
                if (empty($video))
                {
                    uni_redirect( PATH_ROOT . 'fan/video' );
                }
                $video['VideoPurchase'] = VideoPurchase::Get($this->mUser->mUserInfo['Id'], $id);
                if(empty($video['VideoPurchase']))
                {
                    uni_redirect( PATH_ROOT . 'fan/video' );
                }
                $this->mSmarty->assignByRef('video', $video);
            }
            else
            {
                //show broadcasting recording
                $video = EventVideo::Get($id, 1);
                if(empty($video))
                {
                    uni_redirect( PATH_ROOT . 'fan/video' );
                }
                $video['VideoPurchase'] = EventPurchase::Get($this->mUser->mUserInfo['Id'], $video['EventId']);
                $video['Status'] = 2;
                $this->mSmarty->assignByRef('video', $video);
				$this->mSmarty->assign('broadcasting', 1);
            }
			$vids = Video::GetPurchasedVideoList($this->mUser->mUserInfo['Id'], 0 );	
			$this->mSmarty->assignByRef('vids', $vids);
			
			$vidCnt = Video::videoCount($id);				
			$this->mSmarty->assign('module', 'video');
            $this->mSmarty->display('mods/profile/edit_fan/video_one.html');
        }
        exit();
    }

    /**
     * Wall Video
     * @return void
     */
    public function WallVideo()
    {
        $this->mSmarty->assign('module', 'video');

        $id = trim(strip_tags(_v('id', '')));
		
		$wall_video = Wall::GetWallById( $id );
		
		require_once(BPATH.'libs/video/EmbededVideo.php');
		$videoObj=new EmbededVideo();
		$this->mSmarty->assign('videoObj', $videoObj);	
		
		$getVideoId = $videoObj->getVideoId($wall_video['Video']);
		
		$this->mSmarty->assignByRef('getVideoId', $getVideoId );
		
		$this->mSmarty->display('mods/profile/edit_fan/wall_video_one.html');
        exit();
    }

    /**
     * Events
     * @return void
     */
    public function Events()
    {
        $this->mSmarty->assign('module', 'events');
		
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
				
        $id = _v('id', 0);
        if (!$id)
        {
            //show events list
            $page = _v('page', 1);
            $pcnt = 10;
            $df = _v('df', '');
            $df = !in_array($df, array('tw', 'nw', 'tm', 'nm', 'up', 'all','pa')) ? '' : $df;
            $this->mSmarty->assignByRef('df', $df);
						
			$follow = UserFollow::GetFollowersUserList($this->mUser->mUserInfo['Id'], USER_ARTIST);

			$artist_arr = array();
			$artist_ids = '';
			$follower_events =array();
			foreach($follow as $val)
			{
				array_push($artist_arr, $val['Id']);	//Artist user ids as array
				$artist_ids .=$val['Id'].','; //Artist user ids as string				
			}
			$artist_ids = substr($artist_ids, 0, -1);

			//Change event status  as finished if the broadcast time is expired
			Event::FinishEventNotBroadcasted($artist_ids);
						
			$follower_events = Event::FelowArtistEventList($this->mUser->mUserInfo['Id'], $artist_arr, $page, $pcnt, Event::GetPeriod($df), '', '', '', $df);
								
			$this->mSmarty->assignByRef('follower_events', $follower_events);	
			$rcnt = Event::FelowArtistEventListCount($this->mUser->mUserInfo['Id'], $artist_arr, Event::GetPeriod($df), '', '', $df);
            
			include_once 'model/Pagging.class.php';
            $link = PATH_ROOT . 'fan/events' . ($df ? '?df=' . $df : '');
            $mpg = new Pagging($pcnt, $rcnt, $page, $link);
            $pagging = $mpg->Make2($this->mSmarty, 0, 1);
            $this->mSmarty->assignByRef('pagging', $pagging);
            $this->mSmarty->assignByRef('events', $events);			
            $this->mSmarty->assignByRef('artists', $artists);
            $this->mSmarty->display('mods/profile/edit_fan/events.html');
        }
        else
        {
            //show one event
            $event = Event::GetEvent($id);
            if (empty($event))
            {
                uni_redirect(PATH_ROOT . 'fan/events');
            }
            $event['EventAttend'] = EventAttend::Get($this->mUser->mUserInfo['Id'], $id);
            $event['EventPurchase'] = EventPurchase::Get($this->mUser->mUserInfo['Id'], $id);
            if(empty($event['EventAttend']) && empty($event['EventPurchase']))
            {
                uni_redirect( PATH_ROOT . 'fan/events' );
            }
            if($event['EventType'] != LIVE_EVENT && $event['Status'] == 4 && !empty($event['EventPurchase']['Id']))
            {
                //get broadcast recordings list
                /*
				$video = EventVideo::GetListEventVideo($id);
                $this->mSmarty->assignByRef('recordings', $video);
				*/
            }
            $this->mSmarty->assignByRef('event', $event);			
            $this->mSmarty->display('mods/profile/edit_fan/event_one.html');
        }
        exit();
    }

    /**
     * Calendar of fans events
     */
    public function EventCalendar()
    {
        $this->mSmarty->assign('module', 'events');
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

        $this->mSmarty->assign('next_month', $next_year <= date('Y') ? '/fan/eventcalendar?month=' . $next_month . '&year=' . $next_year : '');
        $this->mSmarty->assign('prev_month', $prev_year >= date("Y")-2 ? '/fan/eventcalendar?month=' . $prev_month . '&year=' . $prev_year : '');

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
        for ($i=date("Y"); $i >=date("Y")-2; $i--)
        {
            $yy[$i] = $i;
        }

        $this->mSmarty->assignByRef('mm', $mm);
        $this->mSmarty->assignByRef('yy', $yy);

        //get events for selected month
        $from = mktime(0, 0, 0, $month, 1, $year);
        $to   = mktime(0, 0, 0, $next_month, 1, $next_year) - 1;

		
		//Show All Artist's Events for this Fan
		$follow = UserFollow::GetFollowList( $this->mUser->mUserInfo['Id'] );
			
		if($follow)
		{
			$artist_arr = array();
			$follower_events =array();
			foreach($follow as $val)
			{
				array_push($artist_arr, $val['UserIdFollow']);					
			}
			$follower_events = Event::FelowArtistEventList($this->mUser->mUserInfo['Id'], $artist_arr, $page, $pcnt, array('from' => date("Y-m-d H:i:s", $from), 'to' => date("Y-m-d H:i:s", $to)));
		
			$this->mSmarty->assignByRef('follower_events', $follower_events);
		
			$events = array();
			$aids = array();
			foreach($follower_events as $item)
			{
				$aids[$item['UserId']] = $item['UserId'];
				$day = date('j', strtotime($item['EventDate']));
				if(empty($events[$day]))
				{
					$events[$day] = array();
				}
				$events[$day][] = $item;
			}		
			$this->mSmarty->assignByRef('events', $events);
		}		
        $this->mSmarty->display('mods/profile/edit_fan/event_calendar.html');
    }


    /**
     * Edit profile
     * @return void
     */
    public function Profile()
    {
        $this->mSmarty->assign('module', 'profile');
		
		$rand_id = _v('rand_id', rand(100000, 999999));
        $this->mSmarty->assign('rand_id', $rand_id);
		
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
		
		include_once 'model/Valid.class.php';
		
        //month-day-year
        $dd = array();
        for ($i = 1; $i <= 31; $i++)
        {
            $dd[$i] = $i;
        }

        $mm = array();
        $mme = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
        for ($i = 1; $i <= 12; $i++)
        {
            $mm[$i] = $mme[$i - 1];
        }

        $yy = array();
        for ($i = date("Y"); $i >= date("Y") - 110; $i--)
        {
            $yy[$i] = $i;
        }
        $this->mSmarty->assignByRef('mm', $mm);
        $this->mSmarty->assignByRef('dd', $dd);
        $this->mSmarty->assignByRef('yy', $yy);

        //countries
        $countries = Countries::GetCountries($this->mCache);
        $this->mSmarty->assignByRef('countries', $countries);
        
		//genres list
        $genres_list = User::GetGenresList();
        $this->mSmarty->assignByRef('genres', $genres_list);
		
		$uFullinfo = User::GetUserFullInfo($this->mUser->mUserInfo['Id']);
		$this->mSmarty->assignByRef('uFullinfo', $uFullinfo);
		
		$altEmailArr = array();
		$altEmailArr = unserialize($uFullinfo['AltEmail']);
		
		if(!$altEmailArr)
		{
			$altEmailArr = serialize(array($uFullinfo['Email'] ));
			
			UserQuery::create()->select('Id')->filterById($this->mUser->mUserInfo['Id'])
						->update( array( 'AltEmail' => $altEmailArr ));

			$altEmailArr = unserialize($altEmailArr);
			$this->mSmarty->assignByRef('altEmailArr', $altEmailArr);
		}
		else
		{
			$this->mSmarty->assignByRef('altEmailArr', $altEmailArr);
		}
		
				
		$do = trim(strip_tags(_v('do', '')));
		if (!empty($_POST['fm']) && $do)
        {	
            $fm  = $_POST['fm'];
            $res = array();
            
            switch($do)
            {
                case 'pass':
                    try
                    {
                        if (empty($fm['old_pass']))
                        {
                            $errs['old_pass'] = PLEASE_SPECIFY_OLD_PASSWORD;
                        }
                        else
                        {
                            $this->mUser->mRc4->crypt($fm['old_pass']);
                            if (bin2hex($fm['old_pass']) != $this->mUser->mUserInfo['Pass'])
                            {
                                $errs['old_pass'] = INCORRECT_OLD_PASSWORD;
                            }
                        }

                        if (empty($fm['new_pass']))
                        {
                            $errs['new_pass'] = PLEASE_SPECIFY_NEW_PASSWORD;
                        }
                        elseif ($fm['new_pass'] != $fm['new_pass2'])
                        {
                            $errs['new_pass2'] = THE_PASSWORD_DONT_MATCH;
                        }
                        else
                        {
                            $this->mUser->mRc4->crypt($fm['new_pass2']);
                            if (bin2hex($fm['new_pass2']) == $this->mUser->mUserInfo['Pass'])
                            {
                                $err['new_pass'] = THE_NEW_PASSWORD_MUST_NOT_MATCH_WITH_THE_OLD;
                            }
                        }

                        if (!empty($errs))
                        {
                            throw new Exception('err');
                        }

                        //change password

                        UserQuery::create()->select('Id')->filterById($this->mUser->mUserInfo['Id'])
                        ->update( array( 'Pass' => bin2hex($fm['new_pass2']) ));

                        //re-login
                        $_REQUEST['system_login'] = $this->mUser->mUserInfo['Name'];
                        $_REQUEST['system_pass']  = bin2hex($fm['new_pass2']);
                        $this->mUser->CheckAuth();


                        $res['q'] = OK;
                    }
                    catch (Exception $e)
                    {
                        $err = $e->getMessage();
                        if ($err != 'err')
                        {
                            $errs[] = $err;
                        }
                        $res['errs'] = $errs;
                        $res['q'] = ERR;
                    }
                    break;
					
  				case 'do_email':
                    try
                    {
						 if(!empty($fm['email']))
						 {
							if (!verify_email($fm['email']))
							{
								$errs['email'] = PLEASE_SPECIFY_CORRECT_EMAIL;
							}
							else
							{
								$eml = UserQuery::create()->Select(array('Id'))
										->where('LOWER(user.email)="' . mysql_escape_string(ToLower($fm['email'])) . '" OR LOWER(user.alt_email) LIKE "%\"'.mysql_escape_string(ToLower($fm['email'])) . '\"%"');
								if($this->mUser->IsAuth())
								{
									//$eml = $eml->filterById($this->mUser->mUserInfo['Id'], Criteria::NOT_EQUAL);
								}
								$eml = $eml->findOne();
								if (!empty($eml))
								{
									$errs['email'] = USER_WITH_THAT_EMAIL_ALREADY_EXIST;
								}
							}
						}						
						else
						{
							$errs['email'] = PLEASE_SPECIFY_CORRECT_EMAIL;
						}

                        if (!empty($errs))
                        {
                            throw new Exception('err');
                        }
						
						if(!empty($fm['email']))
						{						
							//merge the email ids with existing
							$new_email = $fm['email'];
					
							if(!in_array($new_email, $altEmailArr))
							{		
								$altEmailTmp = array_merge($altEmailArr, array($new_email));
							}
							else
							{
								$altEmailTmp = $altEmailArr;
							}
										
							$add_email = serialize($altEmailTmp);
							//add email
							UserQuery::create()->select('Id')->filterById($this->mUser->mUserInfo['Id'])
							->update( array( 'AltEmail' => $add_email ));							
						}
						else
						{
							$altEmailTmp = $altEmailArr;
						}	
						
						$uFullinfo = User::GetUserFullInfo($this->mUser->mUserInfo['Id']);
						$altEmailArr = unserialize($uFullinfo['AltEmail']);						
						$this->mSmarty->assignByRef('altEmailArr', $altEmailArr);

						$this->mSmarty->assignByRef('primary_email', $primary_email);
						
						$res['data'] = $this->mSmarty->Fetch('mods/profile/edit_artist/ajax/changed_mail.html');
                        $res['q'] = OK;			
						echo json_encode($res);
						exit();	
						
                    }
                    catch (Exception $e)
                    {
                        $err = $e->getMessage();
                        if ($err != 'err')
                        {
                            $errs[] = $err;
                        }
                        $res['errs'] = $errs['email'];
                        $res['q'] = ERR;
                    }
                    break;					
            }
            echo json_encode($res);
            exit();
        
		
		}
				
        //ajax registration submit
        if (!empty($_POST['fm']))
        {
            $fm = $_POST['fm'];
            $errs = array();

            foreach ($fm as &$v)
            {
                if (!is_array($v))
                {
                    $v = trim(strip_tags($v));
                }
            }
            unset($v);
			

            if (empty($fm['FirstName']))
            {
                $errs['FirstName'] = PLEASE_SPECIFY_FIRST_NAME;
            }

            if (empty($fm['LastName']))
            {
                $errs['LastName'] = PLEASE_SPECIFY_LAST_NAME;
            }

            if (!empty($fm['FirstName']) && strlen($fm['FirstName']) > 26)
            {
                $errs['FirstName'] = MAX_FIRST_NAME_LENGTH_26_CHARACTERS;
            }

            if (!empty($fm['LastName']) && strlen($fm['LastName']) > 26)
            {
                $errs['LastName'] = MAX_LAST_NAME_LENGTH_26_CHARACTERS;
            }

            if (empty($fm['Name']))
            {
                $errs['Name'] = PLEASE_SPECIFY_USERNAME;
            }
            else
            {
                $regName = '/^([a-zA-Z0-9_\-])+$/';
                $matches = array();
                if (!preg_match($regName, $fm['Name'], $matches))
                {
                    $errs['Name'] = USERNAME_MUST_CONTAIN_ALPHABETS_AND_NUMERICS_WITHOUT_ANY_SPACE;
                }
                elseif (strlen($fm['Name']) > 40)
                {
                    $errs['Name'] = MAX_USERNAME_LENTH_40_CHARACTERS;
                }
                else
                {
                    $usr = UserQuery::create()->Select(array('Id'))
                            ->where('LOWER(user.name)="' . mysql_escape_string(ToLower($fm['Name'])) . '"')
                            ->filterById($this->mUser->mUserInfo['Id'], '<>')
                            ->findOne();

                    if (!empty($usr))
                    {
                        $errs['Name'] = USER_WITH_THAT_USERNAME_ALREADY_EXISTS;
                    }
                }
            }

            //genres
            $genres = array();

            if (!empty($fm['Genres']))
            {
                foreach ($fm['Genres'] as $k => $v)
                {
                    if (isset($genres_list[$k]))
                    {
                        $genres[] = $k;
                    }
                }
            }

            if (empty($genres))
            {
                $errs['Genres'] = YOU_MUST_SELECT_GENRES;
            }
            elseif (MAX_GENRES_COUNT < count($genres))
            {
                $errs['Genres'] = YOU_CAN_CHOOSE_TO_NOT_MORE_THAN_3_GENRES;
            }
			if($fm['Zip'])
			{	
				$zip = Valid::Integer($fm, 'Zip');
	
				if (empty($zip))
				{
					$errs['Zip'] = PLEASE_SPECIFY_USER_ZIP_CODE_AS_INTEGER;
				}
			}			
            if (empty($errs))
            {
                //dob
                $month = (isset($fm['mm']) && isset($dd[$fm['mm']])) ? $fm['mm'] : 0;
                $day = (isset($fm['dd']) && isset($dd[$fm['dd']])) ? $fm['dd'] : 0;
                $year = (isset($fm['yy']) && isset($yy[$fm['yy']])) ? $fm['yy'] : 0;
                $dob = $year . '-' . ($month < 10 ? '0' . $month : $month) . '-' . ($day < 10 ? '0' . $day : $day);


                $up = array(
                    'FirstName' => $fm['FirstName'],
                    'LastName' => $fm['LastName'],
					'Name' => $fm['Name'],
                    'Dob' => $dob,
                    'Country' => !empty($fm['Country']) ? strip_tags($fm['Country']) : '',
                    'Genres' => implode(',', $genres),
                    'Location' => !empty($fm['Location']) ? strip_tags($fm['Location']) : '',
                    'HideLoc' => !empty($fm['HideLoc']) ? 1 : 0,
                    'Zip' => !empty($fm['Zip']) ? strip_tags($fm['Zip']) : '',
                    'Likes' => !empty($fm['Likes']) ? trim(strip_tags($fm['Likes'])) : '',
                    'About' => !empty($fm['About']) ? trim(strip_tags($fm['About'])) : '',
                    'Gender' => (!empty($fm['Gender']) && in_array($fm['Gender'], array(1, 2))) ? $fm['Gender'] : 0
                );

                UserQuery::create()->select(array('Id'))->filterById($this->mUser->mUserInfo['Id'])->update($up);

                uni_redirect(PATH_ROOT . 'fan/profile?confirm');

            }
            else
            {
                $this->mSmarty->assignByRef('errs', $errs);
                $this->mSmarty->assignByRef('fm', $fm);
            }
        }
        else
        {
            if (!empty($this->mUser->mUserInfo['Genres']))
            {
                $this->mUser->mUserInfo['Genres'] = make_array_keys_1( explode(',', $this->mUser->mUserInfo['Genres']) );
            }
					
            $this->mSmarty->assignByRef('fm', $this->mUser->mUserInfo);
        }


        $this->mSmarty->assign('confirm', isset($_REQUEST['confirm']) ? 1 : 0);
        $this->mSmarty->display('mods/profile/edit_fan/profile_data.html');
        exit();
    }
   
   public function SaveAvatar()
	{
		$rand_id = _v('rand_id', 0);
		$orginalImage = $this->mSession->Get( 'upl_photo_'.$rand_id);
		include_once 'libs/Crop/class.image.php';
		$thumbImage = new simpleImage();
		$thumbImage->load($orginalImage);
		$newImage = BPATH.'files/images/tmp/'.$rand_id.'_'.basename($orginalImage);
		
		$x1 = $_POST["x1"] ? $_POST["x1"] : 0;
		$y1 = $_POST["y1"] ? $_POST["y1"] : 0;
		$x2 = $_POST["x2"];
		$y2 = $_POST["y2"];
		$w = $_POST["w"] ? $_POST["w"] : USER_PROFILE_IMAGE_WIDTH;
		$h = $_POST["h"] ? $_POST["h"] : USER_PROFILE_IMAGE_HEIGHT;
		//Scale the image to the thumb_width set above
		$scale = USER_PROFILE_IMAGE_WIDTH/$w;
		$reSizeImage = $thumbImage->resizeThumbnailImage($newImage, $w,$h,$x1,$y1,$scale);
						
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
		@unlink(BPATH.$orginalImage);
		@unlink(BPATH.$newImage);
		$user_obj = UserQuery::create()->select(array('Id', 'Avatar'))
					->filterById($this->mUser->mUserInfo['Id'])->findOne();

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

		
	  
		$image = $crop_fnames;
		$result['image'] = $image;
		//dd( $user_id, $user_id_from, $mesg, $image, $video, $timeline, $mCache = '' )
		//To Add profile Picture in My Photos
		 if (!empty($image))
		 {
				$pathinfo = pathinfo($image);

				$ext = ToLower($pathinfo['extension']);
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
				
				$album_id = PhotoAlbum::getProfilePictureAlbum($this->mUser->mUserInfo['Id']);

				if(!$album_id)
				{
					$album_id  = PhotoAlbum::AddAlbum($this->mUser->mUserInfo['Id'], PROFILE_PICTURES);
				}
				if($album_id)
				{
					$phId = Photo::AddPhoto($this->mUser->mUserInfo['Id'], $album_id, $image, $sld, 0, PROFILE_PICTURES, '',  1);					
					$mesg = I_HAVE_CHANGED_MY_PROFILE_PHOTO;
					$link = '/base/profile/showPhotoOne?id='.$phId.'';		
					$wallId = Wall::Add( $this->mUser->mUserInfo['Id'], $this->mUser->mUserInfo['Id'], $mesg, $crop_fnamem, '', 0, $this->mCache, $link);			
					Photo::UpdatePhotoWallId($phId, $wallId);
	
					UserQuery::create()->select(array('Id', 'Avatar'))
						->filterById($this->mUser->mUserInfo['Id'])
						->update(array('Avatar' => 'user_'.$this->mUser->mUserInfo['Id'].$rand.'.jpg'));
				}
				
		  }
		  echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
		  exit();	
	}


    public function UploadAvatar()
    {
        include_once 'model/FileUpload.class.php';
        $mFu = new FileUpload(array('jpg', 'jpeg', 'gif', 'png'));

        //upload to tmp directory
        $result = $mFu->handleUpload( 'files/images/tmp/');
		
		$tmpFileName = 'files/images/tmp/'.$result['name'];
		list($width, $height) = getimagesize($tmpFileName);
		
		//print_r($width.'--'.$height);
		
		if($width < USER_PROFILE_IMAGE_WIDTH || $height < USER_PROFILE_IMAGE_HEIGHT){
			@unlink($tmpFileName);
			echo json_encode(array('success'=>false, 'message'=> POFILE_IMAGE_ERR));
			exit;
		}
				
		 $rand_id = _v('rand_id', 0);

        //crop to small size
        if (!empty($result['success']) && 1==$result['success'])
        {	
			$this->mSession->Set( 'upl_photo_'.$rand_id, $mFu->GetSavedFile() );
			$result['image'] = $mFu->GetSavedFile();
			include_once BPATH. 'libs/Crop/class.image.php';
			$imgObj = new simpleImage();
			$imgObj->load($result['image']);
			
			$imgObj->resizeToWidth(500);
			$imgObj->save($result['image']);
			
			$result['width'] = $imgObj->getWidth();
			$result['height'] = $imgObj->getHeight();
        }
		echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
		exit();
	}

	

    /**
     * User settings (change password, email, social accounts)
     */
    public function Settings()
    {

        $this->mSmarty->assign('module', 'settings');
				
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
					
		$uFullinfo = User::GetUserFullInfo($this->mUser->mUserInfo['Id']);
		
		
		
		$this->mSmarty->assignByRef('uFullinfo', $uFullinfo);
		
		$altEmailArr = array();
		$altEmailArr = unserialize($uFullinfo['AltEmail']);
		
		if(!$altEmailArr)
		{
			$altEmailArr = serialize(array($uFullinfo['Email'] ));
			
			UserQuery::create()->select('Id')->filterById($this->mUser->mUserInfo['Id'])
						->update( array( 'AltEmail' => $altEmailArr ));

			$altEmailArr = unserialize($altEmailArr);
			$this->mSmarty->assignByRef('altEmailArr', $altEmailArr);
		}
		else
		{
			$this->mSmarty->assignByRef('altEmailArr', $altEmailArr);
		}
		
        if($this->mlObj['mSession']->Get('error'))
        {
            $this->mSmarty->assign('error', $this->mlObj['mSession']->Get('error'));
            $this->mlObj['mSession']->Del('error');
        }
		$primary_email = '';
		$this->mSmarty->assignByRef('primary_email', $primary_email);
        if (!empty($_POST['fm']))
        {
		
		
            $fm  = $_POST['fm'];
            $res = array();
            $do = trim(strip_tags(_v('do', '')));
			
            switch($do)
            {
                case 'pass':
                    try
                    {
                        if (empty($fm['old_pass']))
                        {
                            $errs['old_pass'] = PLEASE_SPECIFY_OLD_PASSWORD;
                        }
                        else
                        {
                            $this->mUser->mRc4->crypt($fm['old_pass']);
                            if (bin2hex($fm['old_pass']) != $this->mUser->mUserInfo['Pass'])
                            {
                                $errs['old_pass'] = INCORRECT_OLD_PASSWORD;
                            }
                        }

                        if (empty($fm['new_pass']))
                        {
                            $errs['new_pass'] = PLEASE_SPECIFY_NEW_PASSWORD;
                        }
                        elseif ($fm['new_pass'] != $fm['new_pass2'])
                        {
                            $errs['new_pass2'] = THE_PASSWORD_DONT_MATCH;
                        }
                        else
                        {
                            $this->mUser->mRc4->crypt($fm['new_pass2']);
                            if (bin2hex($fm['new_pass2']) == $this->mUser->mUserInfo['Pass'])
                            {
                                $err['new_pass'] = THE_NEW_PASSWORD_MUST_NOT_MATCH_WITH_THE_OLD;
                            }
                        }

                        if (!empty($errs))
                        {
                            throw new Exception('err');
                        }

                        //change password

                        UserQuery::create()->select('Id')->filterById($this->mUser->mUserInfo['Id'])
                        ->update( array( 'Pass' => bin2hex($fm['new_pass2']) ));

                        //re-login
                        $_REQUEST['system_login'] = $this->mUser->mUserInfo['Name'];
                        $_REQUEST['system_pass']  = bin2hex($fm['new_pass2']);
                        $this->mUser->CheckAuth();


                        $res['q'] = OK;
                    }
                    catch (Exception $e)
                    {
                        $err = $e->getMessage();
                        if ($err != 'err')
                        {
                            $errs[] = $err;
                        }
                        $res['errs'] = $errs;
                        $res['q'] = ERR;
                    }
                    break;
  				case 'do_email':
                    try
                    {
						 if(!empty($fm['email']))
						 {
							if (!verify_email($fm['email']))
							{
								$errs['email'] = PLEASE_SPECIFY_CORRECT_EMAIL;
							}
							else
							{
								$eml = UserQuery::create()->Select(array('Id'))
										->where('LOWER(user.email)="' . mysql_escape_string(ToLower($fm['email'])) . '" OR LOWER(user.alt_email) LIKE "%\"'.mysql_escape_string(ToLower($fm['email'])) . '\"%"');
								if($this->mUser->IsAuth())
								{
									$eml = $eml->filterById($this->mUser->mUserInfo['Id'], Criteria::NOT_EQUAL);
								}
								$eml = $eml->findOne();
								if (!empty($eml))
								{
									$errs['email'] = USER_WITH_THAT_EMAIL_ALREADY_EXIST;
								}
							}
						}

                        if (!empty($errs))
                        {
                            throw new Exception('err');
                        }
						
						if(!empty($fm['email']))
						{

						
							//merge the email ids with existing
							$new_email = $fm['email'];
					
							if(!in_array($new_email, $altEmailArr))
							{		
								$altEmailTmp = array_merge($altEmailArr, array($new_email));
							}
							else
							{
								$altEmailTmp = $altEmailArr;
							}
										
							$add_email = serialize($altEmailTmp);
							//add email
							UserQuery::create()->select('Id')->filterById($this->mUser->mUserInfo['Id'])
							->update( array( 'AltEmail' => $add_email ));							
						}
						else
						{
							$altEmailTmp = $altEmailArr;
						}	
						//change primary email
						/*$primary_email = $fm['email']?$fm['email']:$fm['primary_email'];					
						foreach($altEmailTmp as $value)
						{
							if($value == $primary_email)
							{
								$_SESSION['system_login'] = $primary_email;
								$this->mUser->mUserInfo['Email'] = $primary_email;				 
								
								UserQuery::create()->select('Id')->filterById($this->mUser->mUserInfo['Id'])
						->update( array( 'Email' => $primary_email ));
							}
						}	*/
						$uFullinfo = User::GetUserFullInfo($this->mUser->mUserInfo['Id']);
						$altEmailArr = unserialize($uFullinfo['AltEmail']);	
						$this->mSmarty->assignByRef('altEmailArr', $altEmailArr);

						$this->mSmarty->assignByRef('primary_email', $primary_email);
						
						$res['data'] = $this->mSmarty->Fetch('mods/profile/edit_fan/ajax/changed_mail.html');
                        $res['q'] = OK;			
						echo json_encode($res);
						exit();			
                    }
                    catch (Exception $e)
                    {
                        $err = $e->getMessage();
                        if ($err != 'err')
                        {
                            $errs[] = $err;
                        }
                        $res['errs'] = $errs;
                        $res['q'] = ERR;
                    }
                    break;		
                case 'social_fb':
                    try
                    {
                        $fm['fb_id'] = trim(strip_tags($fm['fb_id']));
                        if (!empty($fm['fb_id']) && !is_numeric($fm['fb_id']))
                        {
                            $errs['fb_id'] = FACEBOOK_ID_MUST_BE_NUMERIC;
                        }
                        else if($fm['fb_id'] != $this->mUser->mUserInfo['FbId'] && $this->mUser->mUserInfo['FbStart'] == 1)
                        {
                            $errs['fb_id'] = YOU_CAN_NOT_CHANGE_YOUR_FACEBOOK_ACCOUNT;
                        }
                        else if(!empty($fm['fb_id']) && $fm['fb_id'] != $this->mUser->mUserInfo['FbId'])
                        {
                            $fbexist = UserQuery::create()->select(array('Id'))->filterByFbId($fm['fb_id'])->findOne();
                            if(!empty($fbexist))
                            {
                                $errs['fb_id'] = THAT_ACCOUNT_ALREADY_TAKEN;
                            }
                        }

                        if (!empty($errs))
                        {
                            throw new Exception('err');
                        }
                        if(!empty($fm['fb_id']))
                        {
                            require_once 'libs/facebook-php-sdk/src/facebook.php';
                            $facebook = new Facebook(array('appId'  => FACEBOOK_API_ID, 'secret' => FACEBOOK_API_SECRET));
                            $loginUrl = $facebook->getLoginUrl(array(
                                'scope' => 'email,read_stream,publish_stream',
                                'redirect_uri' => 'http://' . DOMAIN . '/base/user/facebookconnect'
                                ));
                            $res['url'] = $loginUrl;
                        }
                        //change accounts
                        $update = array();
                        if($fm['fb_id'] != $this->mUser->mUserInfo['FbId'] || empty($this->mUser->mUserInfo['FbToken']))
                        {
                            $update['FbId'] = $fm['fb_id'];
                            $update['FbStart'] = !empty($fm['fb_id']) ? 2 : 0;
                            $update['FbToken'] = '';
                        }
                        if(!empty($update))
                        {
                            UserQuery::create()->select('Id')->filterById($this->mUser->mUserInfo['Id'])->update( $update );
                            $res['q'] = OK;
                        }
                    }
                    catch (Exception $e)
                    {
                        $err = $e->getMessage();
                        if ($err != 'err')
                        {
                            $errs[] = $err;
                        }
                        $res['errs'] = $errs;
                        $res['q'] = ERR;
                    }
                    break;
                case 'social_tw':
                    try
                    {
                        $fm['tw_id'] = trim(strip_tags($fm['tw_id']));

                        if (!empty($fm['tw_id']) && !is_numeric($fm['tw_id']))
                        {
                            $errs['tw_id'] = TWITTER_ID_MUST_BE_NUMERIC;
                        }
                        else if($fm['tw_id'] != $this->mUser->mUserInfo['TwId'] && $this->mUser->mUserInfo['TwStart'] == 1)
                        {
                            $errs['tw_id'] = YOU_CAN_NOT_CHANGE_YOUR_TWITTER_ACCOUNT;
                        }
                        else if(!empty($fm['tw_id']) && $fm['tw_id'] != $this->mUser->mUserInfo['TwId'])
                        {
                            $twexist = UserQuery::create()->select(array('Id'))->filterByTwId($fm['tw_id'])->findOne();
                            if(!empty($twexist))
                            {
                                $errs['tw_id'] = 'THAT_ACCOUNT_ALREADY_TAKEN';
                            }
                        }

                        if (!empty($errs))
                        {
                            throw new Exception('err');
                        }
                        if(!empty($fm['tw_id']))
                        {
                            $this->mlObj['mSession']->del('access_token');
                            require_once('libs/twitteroauth/twitteroauth.php');
                            $con = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET);
                            $request_token = $con->getRequestToken('http://' . DOMAIN . '/base/user/twitterconnect');
                            $this->mlObj['mSession']->set('oauth_token', $request_token['oauth_token']);
                            $this->mlObj['mSession']->set('oauth_token_secret', $request_token['oauth_token_secret']);
                            if($con->http_code == 200)
                            {
                                $url = $con->getAuthorizeURL($request_token['oauth_token']);
                                $res['url'] = $url;
                            }
                            else
                            {
                                $errs['tw_id'] = COULD_NOT_CONNECT_TO_TWITTER_REFRESH_THE_PAGE_OR_TRY_AGAIN_LATER;
                                throw new Exception('err');
                            }
                        }

                        //change accounts
                        $update = array();
                        if($fm['tw_id'] != $this->mUser->mUserInfo['TwId'] || empty($this->mUser->mUserInfo['TwOauthToken']))
                        {
                            $update['TwId'] = $fm['tw_id'];
                            $update['TwStart'] = !empty($fm['tw_id']) ? 2 : 0;
                            $update['TwOauthToken'] = '';
                            $update['TwOauthTokenSecret'] = '';
                        }
                        if(!empty($update))
                        {
                            UserQuery::create()->select('Id')->filterById($this->mUser->mUserInfo['Id'])->update( $update );
                            $res['q'] = OK;
                        }
                    }
                    catch (Exception $e)
                    {
                        $err = $e->getMessage();
                        if ($err != 'err')
                        {
                            $errs[] = $err;
                        }
                        $res['errs'] = $errs;
                        $res['q'] = ERR;
                    }
                    break;
            }
            echo json_encode($res);
            exit();
        }


        $this->mSmarty->display('mods/profile/edit_fan/settings.html');
        exit();
    }
	
      /**********************
     *        Gallery
     ***********************/

    /**
     * Fan photo page
     * @return void
     */
    public function Photo()
    {		
		
        $this->mSmarty->assign('module', 'photo');
		$ajaxMode = _v('ajaxMode', 0);		
		
		$rand_id = _v('rand_id', rand(100000, 999999));
        $this->mSmarty->assign('rand_id', $rand_id);
			
		$photoCount = Photo::GetCountAllPhotoAlbum($this->mUser->mUserInfo['Id']);
		$totalPages = ceil($photoCount['CountAlbum'] / PHOTO_PER_PAGE);
		$page = _v('page', 1);
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
		$this->mSmarty->assign('totalpages', $totalpages);
		$this->mSmarty->assign('totalAlbums', $photoCount['CountAlbum']);   
		$this->mSmarty->assignByRef('totalPhotos', $photoCount['CountPhoto']);		
		$id = _v('id', 0);
        $ph = (int)_v('ph', 0);
        
        if($ph)
        {
            $photo = Photo::GetPhoto($ph);
			if (empty($photo) || $photo['AlbumId'] != $id || !file_exists(BPATH . 'files/photo/origin/' . $photo['UserId'] . '/' . $photo['Image']))
			{
				$id = 0;
				$ph = 0;
				$album = array();
				$photo = array();
			}
			else
			{
				$photo['Sizes'] = getimagesize(BPATH . 'files/photo/origin/' . $photo['UserId'] . '/' . $photo['Image']);
			}
        } else if ($id) {

            $album = PhotoAlbum::GetAlbum( $id );

            if (empty($album) || $album['UserId'] != $this->mUser->mUserInfo['Id'])
            {
                $id = 0;
                $ph = 0;
                $album = array();
            }
            
        }
        

        $this->mSmarty->assign('photo_added', isset($_REQUEST['photo_added']) ? 1 : 0);
        $this->mSmarty->assign('photo_updated', isset($_REQUEST['photo_updated']) ? 1 : 0);
        $this->mSmarty->assign('photo_removed', isset($_REQUEST['photo_removed']) ? 1 : 0);
        $this->mSmarty->assign('album_removed', isset($_REQUEST['album_removed']) ? 1 : 0);
        $this->mSmarty->assign('album_added', isset($_REQUEST['album_added']) ? 1 : 0);
        $this->mSmarty->assign('album_updated', isset($_REQUEST['album_updated']) ? 1 : 0);

		if($id || $ph){
			//show album photo			
            $this->mSmarty->assignByRef('photo', $photo);
            //prev and next photos ids
            $this->mSmarty->assignByRef('links', Photo::GetPrevNext($id, $ph));
            $this->mSmarty->assignByRef('album', $album);
            $this->mSmarty->assign('id', $id);

            $this->mSmarty->display('mods/profile/edit_fan/photo_one.html');
		} else {
			
			$this->mSmarty->assignByRef('albums', PhotoAlbum::GetAlbumList($this->mUser->mUserInfo['Id'] , 1, 1, $page, PHOTO_PER_PAGE));
			$this->mSmarty->assignByRef('addalbums', PhotoAlbum::GetAlbumList($this->mUser->mUserInfo['Id'] , 1, 1, 0, 0));			
			
			if($totalPages>$page)
			{
				$page = $page+1;
			} else {
				$page = 0;
			}
			
			$this->mSmarty->assign('page', $page);
			if($ajaxMode)
			{
				$res['data'] = $this->mSmarty->fetch('mods/profile/edit_fan/ajax/albumPagination.html');
				$res['userId'] = $this->mUser->mUserInfo['Id'];
				$res['page'] = $page;
				echo json_encode($res);				
				exit();	
			}	
            $this->mSmarty->display('mods/profile/edit_fan/photo.html');	
        }
		
    }
	public function getAlbums()
	{
		$album = PhotoAlbum::GetAlbumList($this->mUser->mUserInfo['Id'] , 1, 1, 0, 0);
		
		$res['q'] = OK;
		$res['album'] = $album;
		
		echo json_encode($res);
		exit;
		
	}
    /**
     * Add / Edit Photo Album
     */
    public function EditPhotoAlbum()
    {
        $this->mSmarty->assign('module', 'photo');
        $id = _v('id', 0);
		$ajaxMode = _v('ajaxMode', 0);			
		$page = _v('page', 1);								
		

        //check album rights
        if ($id)
        {
            $album = PhotoAlbum::GetAlbum($id);
            if (empty($album) || $album['UserId'] != $this->mUser->mUserInfo['Id'])
            {
                $id = 0;
                $album = array();
            }
        }


        if (!empty($_POST['fm']))
        {
            $fm = $_POST['fm'];
            $errs = array();

            include_once 'model/Valid.class.php';

            //title
            $fm['Title'] = Valid::String($fm, 'Title');
            if (empty($fm['Title']))
            {
                $errs['Title'] = PLEASE_SPECIFY_ALBUM_TITLE;
            }

            if (empty($errs))
            {
                if (!$id)
                {
                    //add
                    $id = PhotoAlbum::AddAlbum($this->mUser->mUserInfo['Id'], trim(strip_tags($fm['Title'])));
                    uni_redirect(PATH_ROOT.'fan/editphotoalbum?album_added&id=' . $id);
                }
                else
                {
                    //edit
                    PhotoAlbum::EditAlbum($id, trim(strip_tags($fm['Title'])));
                    uni_redirect(PATH_ROOT.'fan/photo?album_updated');
                }
            }
            else
            {
                $this->mSmarty->assignByRef('errs', $errs);
                $this->mSmarty->assignByRef('fm', $fm);
            }
        }
        elseif ($id)
        {
            //edit data
            $this->mSmarty->assignByRef('fm', $album);
        }
		
        //albums photos
		$allPhotos =  Photo::GetPhotosListFromAlbum($this->mUser->mUserInfo['Id'], $id);
		$photoCount = Photo::GetPhotosListFromAlbum($this->mUser->mUserInfo['Id'],$id);
		$totalPages = ceil(count($photoCount) / PHOTO_PER_PAGE);
		$allPhotos = Photo::GetPhotoList($this->mUser->mUserInfo['Id'], $id, $page , PHOTO_PER_PAGE);			
		if($totalPages>$page)
		{
			$page = $page+1;
		} else {
			$page = 0;
		}


		$this->mSmarty->assign('page', $page);

		$photoCount = Photo::GetCountAllPhotoAlbum($this->mUser->mUserInfo['Id']);
		$totalAlbums = $photoCount['CountAlbum'];
		$totalPhotos = $photoCount['CountPhoto'];
        $this->mSmarty->assign('totalAlbums', $totalAlbums);
		$this->mSmarty->assign('totalPhotos', $totalPhotos);
		
        $this->mSmarty->assignByRef('AllPhotos',$allPhotos);
        $this->mSmarty->assign('photo_added', isset($_REQUEST['photo_added']) ? 1 : 0);
        $this->mSmarty->assign('photo_updated', isset($_REQUEST['photo_updated']) ? 1 : 0);
        $this->mSmarty->assign('photo_removed', isset($_REQUEST['photo_removed']) ? 1 : 0);
        $this->mSmarty->assign('album_removed', isset($_REQUEST['album_removed']) ? 1 : 0);
        $this->mSmarty->assign('album_added', isset($_REQUEST['album_added']) ? 1 : 0);
        $this->mSmarty->assign('album_updated', isset($_REQUEST['album_updated']) ? 1 : 0);
		$this->mSmarty->assign('album', $album);
        $this->mSmarty->assign('id', $id);
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);	
		
		if($ajaxMode)
			{	
				$res['data'] = $this->mSmarty->fetch('mods/profile/edit_fan/ajax/albumPhotos.html');
				$res['userId'] = $this->mUser->mUserInfo['Id'];
				$res['AlbumId'] = $id;
				$res['page'] = $page;
				echo json_encode($res);				
				exit();					
			}

			
        $this->mSmarty->display('mods/profile/edit_fan/photo_album.html');
    }

    /**
     * Add / Edit Photo
     */
    public function EditPhoto()
    {
		/*echo"<pre/>";
		print_r($_POST);
		die;*/
        $id = _v('id', 0);
        $album = _v('album', 0);
        $rand_id = _v('rand_id', rand(100000, 999999));
        $this->mSmarty->assign('rand_id', $rand_id);

        //check photo rights
        if ($id)
        {
            $photo = Photo::GetPhoto($id);
            if (empty($photo) || $photo['UserId'] != $this->mUser->mUserInfo['Id'])
            {
                $id = 0;
                $photo = array();
            }
        }

        $this->mSmarty->assign('module', 'photo');

        //albums list
        $albums = PhotoAlbum::GetAlbumList($this->mUser->mUserInfo['Id'], 0, 0);
        $albums = make_assoc_array( $albums, 'Id' );

        if ($album && !isset($albums[$album]))
        {
            $album = 0;
        }

        if (!empty($_POST['fm']))
        {
            include_once 'model/Valid.class.php';
            $fm = $_POST['fm'];
            $errs = array();

            //release date
            $photo_date = Valid::Date($fm, 'PhotoDate');
            if(-2 == $photo_date)
            {
                $errs['PhotoDate'] = WRONG_PHOTO_DATE;
            }
            else if(-1 == $photo_date)
            {
                $photo_date = date('Y-m-d');
            }

            //title
            $fm['Title'] = Valid::String($fm, 'Title');

            //album id
            $fm['AlbumId'] = (int)$fm['AlbumId'];
            if(empty($fm['AlbumId']))
            {
                //new album
                $fm['AlbumTitle'] = Valid::String($fm, 'AlbumTitle');
                if(empty($fm['AlbumTitle']))
                {
                    $errs['AlbumTitle'] = PLEASE_SPECIFY_NAME_FOR_NEW_ALBUM;
                }
            }
            //photo
            $image = $this->mSession->Get('upl_photo_' . $rand_id);
            if (empty($id) && empty($image))
            {
                $errs['Image'] = PLEASE_UPLOAD_PHOTO_COVER_IMAGE;
            }

            if (empty($errs))
            {
                if (!empty($image))
                {
                    include_once 'libs/Crop/Image_Transform.php';
                    include_once 'libs/Crop/Image_Transform_Driver_GD.php';
                    
                    $pathinfo = pathinfo($image);
                    $ext = ToLower($pathinfo['extension']);
                    $dir = MakeUserDir('files/photo/origin', $this->mUser->mUserInfo['Id']);
                    $fn = substr(md5(mktime()), 0, 10) . date("hm") . '.' . $ext;
                    copy(BPATH . $image, BPATH . $dir . '/' . $fn);

                    //photo thumbnail

                    $tfn = MakeUserDir('files/photo/thumbs', $this->mUser->mUserInfo['Id']) . '/' . $fn;
					
                    i_crop_copy(203, 168, BPATH . $dir . '/' . $fn,  BPATH . $tfn, 1);
					
					if($fm['Price']!=0)
						{
						
	/*					$stamp	=	BPATH.'/files/images/stamp.png';				
						$images	=	BPATH.'/files/photo/thumbs/'.$this->mUser->mUserInfo['Id'].'/'.$fn.'';					
						$stamp = imagecreatefrompng($stamp);
						$im = imagecreatefromjpeg($images);
						$marge_right = 10;
						$marge_bottom = 10;
						$sx = imagesx($stamp);
						$sy = imagesy($stamp);
						imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
						//header('Content-type: image/jpeg');
						imagejpeg($im,$images, 85);		
						imagedestroy($im);
	*/					}

					//mid size
                    $mfn = MakeUserDir('files/photo/mid', $this->mUser->mUserInfo['Id']) . '/' . $fn;
                    i_crop_copy(700, 700, BPATH . $dir . '/' . $fn,  BPATH . $mfn, 2);
					
					// slide image crop
					$sfn = MakeUserDir('files/photo/slide', $this->mUser->mUserInfo['Id']) . '/' . $fn;
                    //i_crop_copy(1025, 350, BPATH . $dir . '/' . $fn,  BPATH . $sfn, 2);

                    //delete tmp
                    @unlink(BPATH . $image);
                    $this->mSession->Del('upl_photo_' . $rand_id);

                    $image = $fn;
                }

                if(!$fm['AlbumId'] && !empty($fm['AlbumTitle']))
                {
                    //create album first
                    $fm['AlbumId'] = PhotoAlbum::AddAlbum($this->mUser->mUserInfo['Id'], $fm['AlbumTitle']);
                }

                if (!$id)
                {
                    //get count photos in album
                    $count = PhotoAlbum::GetAlbumCountPhotos($fm['AlbumId']);
                    //add photo
				 $photoPrice = ((!empty($fm['PriceFree']) || empty($fm['Price'])) ? 0 : $fm['Price']);
				 
				 
				 /*$sld = (empty($fm['Slide']) ? 0 : $fm['Slide']);
				 
				 if(!empty($fm['Slide']))
				 {	
				 
				 	$imageLocation = BPATH.'files/photo/origin/'. $this->mUser->mUserInfo['Id'] .'/'.$image;
					
					$slideLocation = BPATH . 'files/photo/slide/'. $this->mUser->mUserInfo['Id'] .'/' .$image;
					if(file_exists($slideLocation))
					{
						unlink(BPATH . 'files/photo/slide/'. $this->mUser->mUserInfo['Id'] .'/' .$image);
						if(file_exists($imageLocation))
						{
							$tes = include_once 'libs/Crop/class.image.php';
							$thumbImage = new simpleImage();
							$thumbImage->load($imageLocation);
							$thumbImage->resizeImage(SLIDE_WIDTH,  SLIDE_HEIGHT, false);
							$thumbImage->saveThumb($slideLocation);
						}
					}
					else
					{
					   if(file_exists($imageLocation))
						{
							$tes = include_once 'libs/Crop/class.image.php';
							$thumbImage = new simpleImage();
							$thumbImage->load($imageLocation);
							$thumbImage->resizeImage(SLIDE_WIDTH,  SLIDE_HEIGHT, false);
							$thumbImage->saveThumb($slideLocation);
						}
					}									
				 }*/
				 
                 $id = Photo::AddPhoto($this->mUser->mUserInfo['Id'], $fm['AlbumId'], $image, $sld, $photoPrice, $fm['Title'], $photo_date, ($count ? 0 : 1));
                    //new post on artist wall
                    $mesg = I_HAVE_JUST_ADDED_A . '<a href="/u/' . $this->mUser->mUserInfo['Name'] . '/photo/' . $fm['AlbumId'] . '?ph=' . $id . '"  name="popBox" id="popBox" rel="group1" >new photo</a>';
                    $wallId = Wall::Add( $this->mUser->mUserInfo['Id'], $this->mUser->mUserInfo['Id'], $mesg, $tfn , '', 0, $this->mCache );
					Photo::UpdatePhotoWallId($id, $wallId);
                    //re-post to twitter
                    if (!empty($this->mUser->mUserInfo['TwOauthToken']) && !empty($this->mUser->mUserInfo['TwOauthTokenSecret']))
                    {
                        require_once('libs/twitteroauth/twitteroauth.php');
                        $tweet = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, $this->mUser->mUserInfo['TwOauthToken'], $this->mUser->mUserInfo['TwOauthTokenSecret']);
                        $tweet->post('statuses/update', array('status' => strip_tags($mesg)));
                    }
                    //re-post to facebook
                    if (!empty($this->mUser->mUserInfo['FbId']))
                    {
                        require_once 'libs/facebook-php-sdk/src/facebook.php';
                        $facebook = new Facebook(array('appId'  => FACEBOOK_API_ID, 'secret' => FACEBOOK_API_SECRET));
                        $token = !empty($this->mUser->mUserInfo['FbToken']) ? $this->mUser->mUserInfo['FbToken'] : $facebook->getAccessToken();
                        try
                        {
                            $facebook->api('/'.$this->mUser->mUserInfo['FbId'] . '/feed', 'POST', array('access_token' => $token, 'message' => strip_tags($mesg), 'link' => 'http://' . DOMAIN . '/u/' . $this->mUser->mUserInfo['Name'] . '/photo/' . $fm['AlbumId'] . '?ph=' . $id));
                        }
                        catch(FacebookApiException $e)
                        {
                        }
                    }
                    uni_redirect(PATH_ROOT.'fan/editphotoalbum?id=' . $fm['AlbumId'] . '&photo_added');
                }
                else
                {
                    //edit
				 $photoPrice = ((!empty($fm['PriceFree']) || empty($fm['Price'])) ? 0 : $fm['Price']);
				 $sld = (empty($fm['Slide']) ? 0 : $fm['Slide']);
                 $up = array('Title' => $fm['Title'], 'AlbumId' => $fm['AlbumId'], 'Slide' => $sld, 'Price' => $photoPrice, 'PhotoDate' => $photo_date);
				 if(!empty($fm['Slide']))
				 {
				 	$imageLocation = BPATH.'files/photo/origin/'. $this->mUser->mUserInfo['Id'] .'/' .$photo['Image'];
					$slideLocation = BPATH . 'files/photo/slide/'. $this->mUser->mUserInfo['Id'] .'/' .$photo['Image'];
					if(file_exists($slideLocation))
					{
						unlink(BPATH . 'files/photo/slide/'. $this->mUser->mUserInfo['Id'] .'/' .$photo['Image']);
					}
						if(file_exists($imageLocation))
						{
							$tes = include_once 'libs/Crop/class.image.php';
							$thumbImage = new simpleImage();
							$thumbImage->load($imageLocation);
							$thumbImage->resizeImage(SLIDE_WIDTH,  SLIDE_HEIGHT, false);
							$thumbImage->saveThumb($slideLocation);
						}
 				 }
				 else
				 {
				 	$slideLocation = BPATH . 'files/photo/slide/'. $this->mUser->mUserInfo['Id'] .'/' .$photo['Image'];
					if(file_exists($slideLocation))
					{
						unlink(BPATH . 'files/photo/slide/'. $this->mUser->mUserInfo['Id'] .'/' .$photo['Image']);
					}
				 
				 }
				 
                    if ($image)
                    {
                        $up['Image']  =  $image;
                        //delete old image
                        if(file_exists(BPATH . 'files/photo/origin/' . $photo['UserId'] . '/' . $photo['Image']))
                        {
                            unlink(BPATH . 'files/photo/origin/' . $photo['UserId'] . '/' . $photo['Image']);
                        }
                        if(file_exists(BPATH . 'files/photo/mid/' . $photo['UserId'] . '/' . $photo['Image']))
                        {
                            unlink(BPATH . 'files/photo/mid/' . $photo['UserId'] . '/' . $photo['Image']);
                        }
                        if(file_exists(BPATH . 'files/photo/thumbs/' . $photo['UserId'] . '/' . $photo['Image']))
                        {
                            unlink(BPATH . 'files/photo/thumbs/' . $photo['UserId'] . '/' . $photo['Image']);
                        }
						if(file_exists(BPATH . 'files/photo/slide/' . $photo['UserId'] . '/' . $photo['Image']))
                        {
                            unlink(BPATH . 'files/photo/slide/' . $photo['UserId'] . '/' . $photo['Image']);
                        }   
                    }
                    Photo::EditPhoto($id, $up);
                    uni_redirect(PATH_ROOT.'fan/editphotoalbum?id=' . $fm['AlbumId'] . '&photo_updated');
                }
            }
            else
            {
                $this->mSmarty->assignByRef('errs', $errs);

                $image = $this->mSession->Get('upl_photo_'.$rand_id);
                if (!empty($image))
                {
                    $fm['Image'] = '/' . $image;
                }
                $this->mSmarty->assignByRef('fm', $fm);
            }
        }
        elseif ($id)
        {
            //edit data
            $photo['PhotoDate'] = date('m/d/Y', strtotime($photo['PhotoDate']));
            $photo['ahref'] = $photo['Image'];									
            $photo['Image'] = '/files/photo/thumbs/' . $photo['UserId'] . '/' . $photo['Image'];
            $photo['ImageOrigin'] = '/files/photo/origin/' . $photo['UserId'] . '/' . $photo['Image'];
            $this->mSmarty->assignByRef('fm', $photo);
        }

        $this->mSmarty->assign('id', $id);
        $this->mSmarty->assignByRef('albums', $albums);
        $this->mSmarty->assign('album', $album);

        $this->mSmarty->display('mods/profile/edit_fan/photo_edit.html');
    }

    /**
     * Upload photo file
     * @return void
     */
    public function UploadPhoto()
    {
        $rand_id = _v('rand_id', 0);

        include_once 'model/FileUpload.class.php';
        $mFu = new FileUpload(array('jpg', 'jpeg', 'gif', 'png'));
		
		

        //upload to tmp directory
        $result = $mFu->handleUpload( 'files/photo/tmp/');

        if (!empty($result['success']) && 1==$result['success'])
        {
            $this->mSession->Set( 'upl_photo_'.$rand_id, $mFu->GetSavedFile() );
            $result['photo'] = $mFu->GetSavedFile();
        }

        echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
        exit();
    }

    /**
     * Make photo cover of its album
     */
    public function MakeCover()
    {
        $id = _v('id', 0);
        //check photo rights
        if ($id)
        {
            $photo = Photo::GetPhoto($id);
            if (empty($photo) || $photo['UserId'] != $this->mUser->mUserInfo['Id'])
            {
                $id = 0;
                $photo = array();
            }
        }
        if($id)
        {
            Photo::MakeCover($id, $photo['AlbumId']);
            uni_redirect(PATH_ROOT . 'fan/editphotoalbum?id=' . $photo['AlbumId']);
        }
        uni_redirect(PATH_ROOT . 'fan/photo');
    }

    /**
     * Remove photo
     */
    public function RemovePhoto()
    {
		$res = array();
        $id = _v('id', 0);
		$albumId = _v('albumId', 0);
		
        if($id)
        {
			 $photo = Photo::GetPhoto($id);
			 if($photo['WallId']){
			 	$wallId = Wall::DeleteWall($photo['WallId']);
			 }
			
            //delete files
            if(file_exists(BPATH . 'files/photo/origin/' . $photo['UserId'] . '/' . $photo['Image']))
            {
                unlink(BPATH . 'files/photo/origin/' . $photo['UserId'] . '/' . $photo['Image']);
            }
            if(file_exists(BPATH . 'files/photo/mid/' . $photo['UserId'] . '/' . $photo['Image']))
            {
                unlink(BPATH . 'files/photo/mid/' . $photo['UserId'] . '/' . $photo['Image']);
            }
            if(file_exists(BPATH . 'files/photo/thumbs/' . $photo['UserId'] . '/' . $photo['Image']))
            {
                unlink(BPATH . 'files/photo/thumbs/' . $photo['UserId'] . '/' . $photo['Image']);
            }
			if(file_exists(BPATH . 'files/photo/slide/' . $photo['UserId'] . '/' . $photo['Image']))
            {
                unlink(BPATH . 'files/photo/slide/' . $photo['UserId'] . '/' . $photo['Image']);
            }  
           
        }
			
	        Photo::Remove($id);
			if($photo['AlbumId']){
				$photoId = Photo::GetMaxPhotoId($photo['AlbumId']);
				Photo::MakeCover($photoId['id'], $photo['AlbumId']);
			}
			$photoCount = Photo::GetCountAllPhotoAlbum($this->mUser->mUserInfo['Id']);
	   		$res['q'] = OK; 
			$res['totAlb'] = $photoCount['CountAlbum'];
			$res['totPhoto'] = $photoCount['CountPhoto'];
			echo json_encode($res);
			exit();
    }

    /**
     * Remove photo album
     */
    public function RemovePhotoAlbum()
    {
        $id = _v('id', 0);
        //check photo album rights
		/* if ($id)
        {
            $album = PhotoAlbum::GetAlbum($id);
            if (empty($album) || $album['UserId'] != $this->mUser->mUserInfo['Id'])
            {
                $id = 0;
                $album = array();
            }
        }*/
        if($id)
        {
            $photos = Photo::GetPhotoList($this->mUser->mUserInfo['Id'], $id);
						
            foreach($photos as $item)
            {
				if($item['WallId'])
				{
			 			$wallId = Wall::DeleteWall($item['WallId']);
			 	}
                //delete files
                if(file_exists(BPATH . 'files/photo/origin/' . $item['UserId'] . '/' . $item['Image']))
                {
                    unlink(BPATH . 'files/photo/origin/' . $item['UserId'] . '/' . $item['Image']);
                }
                if(file_exists(BPATH . 'files/photo/mid/' . $item['UserId'] . '/' . $item['Image']))
                {
                    unlink(BPATH . 'files/photo/mid/' . $item['UserId'] . '/' . $item['Image']);
                }
                if(file_exists(BPATH . 'files/photo/thumbs/' . $item['UserId'] . '/' . $item['Image']))
                {
                    unlink(BPATH . 'files/photo/thumbs/' . $item['UserId'] . '/' . $item['Image']);
                }
            }
			
			
			
            PhotoAlbum::Remove($id);
			$photoCount = Photo::GetCountAllPhotoAlbum($this->mUser->mUserInfo['Id']);
			$res['q'] = OK; 
			$res['totAlb'] = $photoCount['CountAlbum'];
			$res['totPhoto'] = $photoCount['CountPhoto'];
			echo json_encode($res);
			exit(); 
        }
       // uni_redirect(PATH_ROOT . 'fan/photo?album_removed');
    }
	
	
	
function PricedPhotos()
	{
		$userId	=	$_REQUEST['id'];		
        $sql = sprintf('SELECT * FROM `photo_purchase` inner join photo on photo.id = photo_purchase.photo_id where photo_purchase.user_id = "'.$userId.'" ORDER BY `photo_purchase`.`id`  DESC');
	  	 $photos = Query::GetAll($sql);		 
		 $this->mSmarty->assign('pricedphotos',$photos);		 
         $this->mSmarty->display('mods/profile/edit_fan/priced_photos.html');
	}	
	
	public function FanPurchasedMusicList()
    {
	    $this->mSmarty->assign('submodule', 'Music');
		
        $u_id = _v('u_id', 0);
 	    $a_id = _v('a_id', 0);
        if ($a_id)
        {
			
            //tracks
			$aid['a_id'] = $a_id;
			$this->mSmarty->assignByRef('aid' ,$aid);
			$track = Music::GetPurchaseMusicTrackByAlbumId($a_id, $this->mUser->mUserInfo['Id'], 1);
			$this->mSmarty->assignByRef('tracks', $track);		
			$res['q'] = OK; 
			$res['data'] = $this->mSmarty->fetch('mods/profile/edit_fan/ajax/album_track.html');		
			
			echo json_encode($res);
			exit(); 
		}				
    }
	
	
	
	
	
function PricedPhotoLightBox()
	{
        $this->mSmarty->assign('module', 'photo');
        $id = _v('id', 0);
        $ph = (int)_v('ph', 0);
		//show album photo			
                $photo = Photo::GetPhoto($ph);
                if (empty($photo) || !file_exists(BPATH . 'files/photo/origin/' . $photo['UserId'] . '/' . $photo['Image']))
                {
                    $id = 0;
                    $ph = 0;
                    $album = array();
                    $photo = array();
                }
                else
                {
                    $photo['Sizes'] = getimagesize(BPATH . 'files/photo/origin/' . $photo['UserId'] . '/' . $photo['Image']);
                }
            			
            $this->mSmarty->assignByRef('photo', $photo);
            $this->mSmarty->display('mods/profile/edit_fan/SinglePopup.html');
        
    }

public function addPhotoNewAjax()
{
	//deb($_SESSION);
		$id 			= $_REQUEST['id'];
        $photo_image 	= $_REQUEST['photoImage'];
        $PhotoTitle 	= $_REQUEST['AlbumDesc'];
        $AlbumTitle		= $_REQUEST['AlbumTitle'];		
        $rand_id 		= $_REQUEST['rand_id'];
       	$this->mSmarty->assign('rand_id', $rand_id);
		
		$ui = & $this->mUser->mUserInfo;
		
		if(empty($id) &&  !empty($AlbumTitle))				
		{
			 $getExistingAlbum = PhotoAlbum::getexistalbumbytitle($AlbumTitle);			
			 
			 if($getExistingAlbum)
			 {
	        	$res['existing'] = ALBUM_ALREADY_EXIST_PLEASE_TRY_AGAIN_WITH_OTHER_ALBUM_TITLE;				 
			 }
			 else
			 {
			 	$id = PhotoAlbum::AddAlbum($this->mUser->mUserInfo['Id'], $AlbumTitle);	
			 }
			 
		}
		
		if($id)
		{
			if($id == -1)
			{
				$n_album = 0;				
				$id = 0;
			}
			// add the photos in the old album
			if($rand_id)
			{
				$image = $this->mSession->Get('upl_photo_' . $rand_id);
			}else{
				$image = $this->mSession->Get('upl_photo_0');
			}
			if (!empty($image))
			{
					include_once 'libs/Crop/Image_Transform.php';
                    include_once 'libs/Crop/Image_Transform_Driver_GD.php';
                    
                    $pathinfo = pathinfo($image);
                    $ext = ToLower($pathinfo['extension']);
                    $dir = MakeUserDir('files/photo/origin', $this->mUser->mUserInfo['Id']);
                    $fn = substr(md5(mktime()), 0, 10) . date("hm") . '.' . $ext;
                    copy(BPATH . $image, BPATH . $dir . '/' . $fn);

                    //photo thumbnail
                    $tfn = MakeUserDir('files/photo/thumbs', $this->mUser->mUserInfo['Id']) . '/' . $fn;
                    i_crop_copy(PHOTO_THUMB_SIZE_WIDTH, PHOTO_THUMB_SIZE_WIDTH, BPATH . $dir . '/' . $fn,  BPATH . $tfn, 1);
					
					//mid size
                    $mfn = MakeUserDir('files/photo/mid', $this->mUser->mUserInfo['Id']) . '/' . $fn;
                    i_crop_copy(PHOTO_MID_IMAGE_SIZE_WIDTH, PHOTO_MID_IMAGE_SIZE_HEIGHT, BPATH . $dir . '/' . $fn,  BPATH . $mfn, 2);
					
					//delete tmp
                    @unlink(BPATH . $image);
                    $this->mSession->Del('upl_photo_' . $rand_id);
                    $image = $fn;			
				
			}
			
			 $count = PhotoAlbum::GetAlbumCountPhotos($id);
			 
            //add photo
			 $sld = (empty($fm['Slide']) ? 0 : $fm['Slide']);
			 $photoPrice = ((!empty($fm['PriceFree']) || empty($fm['Price'])) ? 0 : $fm['Price']);
			 $id = Photo::AddPhoto($this->mUser->mUserInfo['Id'], $id, $image, $sld, 0, $PhotoTitle, $photo_date, ($count ? 0 : 1));
			 
			 //new post on artist wall
             $mesg = ''.$PhotoTitle; //.' a <a href="/u/' . $this->mUser->mUserInfo['Name'] . '/photo/' . $fm['AlbumId'] . '?ph=' . $id . '"  name="popBox" id="popBox" rel="group1" >new photo</a>';
		 	 $link = '/base/profile/showPhotoOne?id='.$id.'';				 
			 $wallId = Wall::Add( $this->mUser->mUserInfo['Id'], $this->mUser->mUserInfo['Id'], $mesg, $tfn , '', 0, $this->mCache ,$link );
			 Photo::UpdatePhotoWallId($id, $wallId);
			 
			 //re-post to twitter
             if (!empty($this->mUser->mUserInfo['TwOauthToken']) && !empty($this->mUser->mUserInfo['TwOauthTokenSecret']))
             {
                 require_once('libs/twitteroauth/twitteroauth.php');
                 $tweet = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, $this->mUser->mUserInfo['TwOauthToken'], $this->mUser->mUserInfo['TwOauthTokenSecret']);
                 $tweet->post('statuses/update', array('status' => strip_tags($mesg)));
             }
			 
			 //re-post to facebook
			if (!empty($this->mUser->mUserInfo['FbId']))
			{
				require_once 'libs/facebook-php-sdk/src/facebook.php';
				$facebook = new Facebook(array('appId'  => FACEBOOK_API_ID, 'secret' => FACEBOOK_API_SECRET));
				$token = !empty($this->mUser->mUserInfo['FbToken']) ? $this->mUser->mUserInfo['FbToken'] : $facebook->getAccessToken();
				try
				{
					$facebook->api('/'.$this->mUser->mUserInfo['FbId'] . '/feed', 'POST', array('access_token' => $token, 'message' => strip_tags($mesg), 'link' => 'http://' . DOMAIN . '/u/' . $this->mUser->mUserInfo['Name'] . '/photo/' . $fm['AlbumId'] . '?ph=' . $id));
				}
				catch(FacebookApiException $e)
				{
				}
			}
		 
		}
		
		$photoCount = Photo::GetCountAllPhotoAlbum($this->mUser->mUserInfo['Id']);
		
		$this->mSmarty->assign('ui', $ui);
        $res['q'] = OK;	
		$res['UserId'] = $this->mUser->mUserInfo['Id'];
		$res['Id'] = $id;
		$res['PhotoName'] = $image;	
		$res['totAlb'] = $photoCount['CountAlbum'];
		$res['totPhoto'] = $photoCount['CountPhoto'];	
		$res['AlbumId'] = $id;
		$res['AlbumTitle'] = $AlbumTitle;
		  	
		$this->mSmarty->assign('Append_IscoverPhotoName', $image);
		$this->mSmarty->assign('Append_PhotoTitle', $PhotoTitle);			
		$this->mSmarty->assign('Append_AlbumTitle', $AlbumTitle);	
			
		$this->mSmarty->assign('Append_UserId', $this->mUser->mUserInfo['Id']);		
		$this->mSmarty->assign('Append_Count', $ui);		
		$this->mSmarty->assign('Append_Date', mktime());				
		$this->mSmarty->assign('Append_AlbumId', $id);				
		$this->mSmarty->assign('Append_Date', mktime());				
		$this->mSmarty->assignByRef('albums', PhotoAlbum::GetAlbumList($this->mUser->mUserInfo['Id'] , 1, 1, $page, PHOTO_PER_PAGE));
		

		$res['AppendNewAlbum']	=	$this->mSmarty->Fetch('mods/profile/edit_fan/ajax/_photoNewAlbum.html');
		$res['newContent']	=	$this->mSmarty->Fetch('mods/profile/edit_fan/ajax/albumPagination.html');
		
		echo json_encode($res);
		exit();	
}

	public function EditAjaxPhotoAlbum()
	{
        $id 			= $_REQUEST['id'];
        $title 			= $_REQUEST['title'];		
		PhotoAlbum::EditAlbum($id,$title);
		
		$res['q']	=	OK;
				
		$res['albumId']	=	$id;
		$res['albumTitle']	=	$title;
		
		echo json_encode($res);
		exit();	
	}	
	
	public function EditAjaxPhotoName()
	{
        $id 			= $_REQUEST['id'];
        $title 			= $_REQUEST['title'];
		Photo::EditPhotoName($id, $title);
		$res['q']	=	Ok;
		echo json_encode($res);
		exit();	
	}	

	public function showAllPhotosById()
	{
	
		$this->mSmarty->assign('module', 'photo');		
		$ajaxMode = _v('ajaxMode', 0);			
		$photoCount = Photo::GetCountAllPhotoAlbum($this->mUser->mUserInfo['Id']);
		$totalPages = ceil($photoCount['CountPhoto'] / PHOTO_PER_PAGE);
		$page = _v('page', 1);				
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
		$this->mSmarty->assign('totalpages', $totalpages);		
		
		$profilePhotoMaxId = Photo::GetMaxProfilePhotoId(PROFILE_PICTURES, $this->mUser->mUserInfo['Id']);		
		$bannerAlbumMaxId = Photo::GetMaxBannerAlbumId(BANNER_IMAGES, $this->mUser->mUserInfo['Id']);		

		$this->mSmarty->assign('profilePhotoMaxId', $profilePhotoMaxId['id']);
		$this->mSmarty->assign('bannerAlbumMaxId', $bannerAlbumMaxId['id']);
		
		$this->mSmarty->assignByRef('AllPhotos', Photo::ShowPhotoAll($this->mUser->mUserInfo['Id'] , $page , PHOTO_PER_PAGE));	
		if($totalPages>$page)
		{
			$page = $page+1;
		} else {
			$page = 0;
		}
		
		$this->mSmarty->assign('totalAlbums', $photoCount['CountAlbum']);
		$this->mSmarty->assign('totalPhotos', $photoCount['CountPhoto']);
		$this->mSmarty->assign('page', $page);
		if($ajaxMode)
			{	
				$res['data'] = $this->mSmarty->fetch('mods/profile/edit_fan/ajax/AllPhotoPagination.html');
				$res['userId'] = $this->mUser->mUserInfo['Id'];
				$res['page'] = $page;
				echo json_encode($res);				
				exit();					
			}
        $this->mSmarty->display('mods/profile/edit_fan/showphotosAll.html');	
		
	}
	public function EditAllPhotos()
		{
		$id = _v('id', 0);
		$mode		= 	$_REQUEST['mode'];
		$title		=	$_REQUEST['title'];				
		$desc		=	$_REQUEST['desc'];
		$albumId	=	$_REQUEST['albumId'];
		if($id) {
			$photo 		= Photo::GetPhoto($id);
			$photoAlbum = PhotoAlbum::GetAlbumList( $photo['UserId'], $with_cover = 1, $with_counts = 1, $page = 0, $items_on_page = 0 );
			$this->mSmarty->assign('photoAlbum', $photoAlbum);					
			$this->mSmarty->assign('photo', $photo);		
			
		 }	
			// for now im using desc as title 		 
			if($mode && $id ){
			$photo_date = date('Y-m-d');
			if($desc) { 
				$phTitle = $desc; 
			} else { 
				$phTitle = $photo['Title'];  
			}			
			$up = array('Title' => $phTitle  , 'AlbumId' => $albumId,  'PhotoDate' => $photo_date);				
            $updatedId  =Photo::EditPhoto($id, $up);
		    $res['q'] = OK;			
			echo json_encode($res);
			exit();				
			}
	    return $this->mSmarty->display('mods/profile/blocks/_edit_allphoto.html');	

		}		

	
}
?>