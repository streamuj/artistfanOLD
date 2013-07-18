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
        /*   
        if (!$this->mUser->IsAuth())
        {
            uni_redirect( PATH_ROOT . 'base/user/login' );
        }
        */
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

                    case 'music':

                        break;

                    case 'video':

                        break;

                    case 'events':

                        break;
                }

                //artists
                $this->mSmarty->assignByRef( 'follow', UserFollow::GetFollowList( $ui['Id'] ) );

                if (!$IsOther)
                {
                    //show not public info
                    $this->mSmarty->assignByRef('music', Music::GetPurchasedMusicList( $ui['Id'], 0, 1, 6, 1));

                    $this->mSmarty->assignByRef('video', Video::GetPurchasedVideoList($ui['Id'], 0, 1, 6));
                    
                }

                //events
                $events = Event::EventsAttendAndPurchasedList(0, $ui['Id'], 1, 6, array('from' => date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s'), date("m"), date("d")-1, date("Y")))), array(1, 2));
                $aids = array();
                foreach($events as $item)
                {
                    $aids[$item['UserId']] = $item['UserId'];
                }
                $artists = User::GetUsersNames($aids);
                foreach($events as &$item)
                {
                    $item['Artist'] = !empty($artists[$item['UserId']]) ? $artists[$item['UserId']] : array();
                }
                unset($item);
                unset($artists);
                $this->mSmarty->assignByRef('events', $events);

                $this->mSmarty->display('mods/profile/profile_fan.html');
            break;
            
            case 2: 
                //show artist page

                //genres list
                $genres_list = User::GetGenresList();
                $this->mSmarty->assignByRef('genres', $genres_list);
                
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
                            }
                        }
                        if($this->mUser->IsAuth())
                        {
                            //add viewer of this broadcasting - only if user is auth
                            BroadcastViewers::AddViewer('u' . $ui['Name'], $this->mUser->mUserInfo['Id']);
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
                        $this->mSmarty->assignByRef('events', Event::EventsList($ui['Id'], 1, 6, array('from' => date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s'), date("m"), date("d")-1, date("Y")))), array(), array(1, 2), $this->mCache));
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
                }
                //count fans
                $fans_count = UserFollow::GetFollowersCount($ui['Id']);
                $this->mSmarty->assign('fans_count', $fans_count);

                //count fans countries
                $fans_cntr_count = UserFollow::GetFollowersCountriesCount($ui['Id']);
                $this->mSmarty->assign('fans_cntr_count', $fans_cntr_count);

                //locations with count fans
                $cities = UserFollow::GetFollowListByCities($ui['Id']);
                $this->mSmarty->assignByRef('cities', $cities);

                //sum +credits
                $add_sum = ShoppingLog::GetPointsForToday($this->mUser->mUserInfo['Id']);
                $this->mSmarty->assign('add_sum', $add_sum);

                //music
                if ($this->mUser->IsAuth() && $ui['Id'] != $this->mUser->mUserInfo['Id'])
                {
                    $this->mSmarty->assignByRef('music', Music::GetMusicListWithPurchase($ui['Id'], $this->mUser->mUserInfo['Id'], -1, 1, 1, 6, 1));
                }
                else
                {
                    $this->mSmarty->assignByRef('music', Music::GetMusicList( $ui['Id'], -1, 1, 1, 6, 1 ));
                }


                //videos
                if ($this->mUser->IsAuth() && $ui['Id'] != $this->mUser->mUserInfo['Id'])
                {
                    $this->mSmarty->assignByRef('video', Video::GetVideoListWithPurchase( $ui['Id'], $this->mUser->mUserInfo['Id'], 1, 1, 6 ));
                }
                else
                {
                    $this->mSmarty->assignByRef('video', Video::GetVideoList( $ui['Id'], 1, 1, 6 ));
                }
                //events
                $this->mSmarty->assignByRef('events', Event::EventsList($ui['Id'], 1, 6, array('from' => date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s'), date("m"), date("d")-1, date("Y")))), array(), array(1, 2), $this->mCache));
				//fans
	           if ($this->mUser->IsAuth() && $ui['Id'] == $this->mUser->mUserInfo['Id'])
                {
					$this->mSmarty->assignByRef('fans', UserFollow::GetFollowersList($this->mUser->mUserInfo['Id']));
				}
                $this->mSmarty->display('mods/profile/profile_artist.html');
            break;
        }
    }


    /**
     * Follow/Unfollow artist
     */
    public function Follow()
    {
        $res = array('q' => 'err');

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

                    //clear cache followers count
                    $this->mCache->set('count_followers' . $user_id_follow, '', 1);

                    //log - for artists only
                    if($ui['Status']==2)
                    {
                        ShoppingLog::LogAdd($user_id_follow, $this->mUser->mUserInfo['Id'], 'follow', array(), $this->mCache);
                    }

                    $res['q'] = 'ok';
                    $res['data'] = 1;
                }
                else
                {
                    //unfollow
                    UserFollowQuery::create()->select('Id')->filterById($follow)->delete();
                    //clear cache followers count
                    $this->mCache->set('count_followers' . $user_id_follow, '', 1);
                    //log - for artists only
                    if($ui['Status']==2)
                    {
                        ShoppingLog::LogAdd($user_id_follow, $this->mUser->mUserInfo['Id'], 'unfollow', array(), $this->mCache);
                    }
                    $res['q'] = 'ok';
                    $res['data'] = 2;
                }
            }
        }
        echo json_encode($res);
    }

     
    /**
     * Post something to artist/
     */ 
    public function WallPost()
    {
        if (!$this->mUser->IsAuth())
        {
            echo json_encode(array('q' => 'err', 'msg'=>'No auth'));
            exit();
        }
        
        $id = _v('id', 0);
        $mesg = trim( strip_tags(_v('mesg', '')) );
		$image = trim( strip_tags(_v('image', '')) );
		$video = trim( strip_tags(_v('video', '')) );
		
		if($image && file_exists($this->GetRootPath().'/'.$image)) {
			$imgNameArr = explode('/', $image);
			$imgName = array_pop($imgNameArr);
			$orginalImage = 'files/wall/orginal/'.$imgName;
			$thumbImage = 'files/wall/thumb/'.getJpgFileName($imgName);
			//copy($this->GetRootPath().'/'.$image, $orginalImage);
			include_once $this->GetRootPath() . 'libs/Crop/Image_Transform.php';
            include_once $this->GetRootPath() . 'libs/Crop/Image_Transform_Driver_GD.php';
			i_crop_copy(WALL_PHOTO_THUMB_WIDTH, WALL_PHOTO_THUMB_WIDTH, $this->GetRootPath().'/'.$image,
                                $this->GetRootPath() . '/'.$thumbImage, 1);
			i_crop_copy(WALL_PHOTO_WIDTH, WALL_PHOTO_HEIGHT, $this->GetRootPath().'/'.$image,
                                $this->GetRootPath() . '/'.$orginalImage, 1);
			@unlink($this->GetRootPath().'/'.$image);
		} else {
			$imgName = '';
		}
        if (!$id)
        {
            echo json_encode(array('q' => 'err', 'msg'=>'No user'));
            exit();
        }
        
        if ($id != $this->mUser->mUserInfo['Id'])
        { 
            $ui = User::GetUser( $id );
            if (empty($ui))
            {
                echo json_encode(array('q' => 'err', 'msg'=>'No user'));
                exit();
            }
        }
        
        if (empty($mesg))
        {
            echo json_encode(array('q' => 'err', 'msg'=>'Please specify message text'));
            exit();
        }
        
        //security
        if (!empty($_SESSION['last_mesg_time']) && mktime()-$_SESSION['last_mesg_time'] < 2)
        {
            echo json_encode(array('q' => 'err', 'msg'=>'You are sending too many messages.Please wait a few seconds.'));
            exit();
        }
        
		Wall::Add( $id, $this->mUser->mUserInfo['Id'], $mesg, $imgName, $video, $this->mCache );
        $_SESSION['last_mesg_time'] = mktime();

        //re-post to twitter
        if ($id == $this->mUser->mUserInfo['Id'] && !empty($this->mUser->mUserInfo['TwOauthToken']) && !empty($this->mUser->mUserInfo['TwOauthTokenSecret']))
        {
            require_once('libs/twitteroauth/twitteroauth.php');
            $tweet = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, $this->mUser->mUserInfo['TwOauthToken'], $this->mUser->mUserInfo['TwOauthTokenSecret']);
            $tweet->post('statuses/update', array('status' => $mesg));
        }
        //re-post to facebook
        if ($id == $this->mUser->mUserInfo['Id'] && !empty($this->mUser->mUserInfo['FbId']))
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
        
        echo json_encode(array('q' => 'ok'));
        exit();   
    }
	
	public function AddWallComment()
	{
		if (!$this->mUser->IsAuth())
        {
            echo json_encode(array('q' => 'err', 'msg'=>'No auth'));
            exit();
        }
        
        $mesg = trim( strip_tags(_v('mesg', '')) );
		$wallId = _v('wallId', '0');
		
        $id = $this->mUser->mUserInfo['Id'];
        
		if(!$wallId){
			echo json_encode(array('q' => 'err', 'msg'=>'No Valid parameters'));
            exit();
		}
        if (empty($mesg))
        {
            echo json_encode(array('q' => 'err', 'msg'=>'Please specify message text'));
            exit();
        }
        
        //security
        if (!empty($_SESSION['last_comment_time']) && mktime()-$_SESSION['last_comment_time'] < 2)
        {
            echo json_encode(array('q' => 'err', 'msg'=>'You are sending too many messages.Please wait a few seconds.'));
            exit();
        }
        
        $commentId = Comment::Add( $id, WALL, $wallId, $mesg);
		Wall::UpdateWallTime($wallId);
		
		$commentList = Comment::getComment($commentId);
		$this->mSmarty->assign('commentList', $commentList);
		$comment = $this->mSmarty->fetch('ajax/comment.html');
		
        $_SESSION['last_comment_time'] = mktime();
 
        echo json_encode(array('q' => 'ok', 'comment' => $comment));
        exit(); 
	}
    
    
    /**
     * Get wall data
     */
    public function WallLoad()
    {
        $id = _v('id', 0);
        $after_id = _v('after_id', 0);
        $before_id = _v('before_id', 0);
        $log_last_id = _v('log_last_id', 0);
        $items_count = 10;
        
        if (!$id)
        {
            echo json_encode(array('q' => 'err', 'msg'=>'Wrong user ID'));
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

            //get shopping log only for artist wall
            $log = Wall::GetLogList($id, $ids, $log_last_id);
            foreach($log as $key => $item)
            {
                if(($after_id && $key != $after_id) || (!$after_id && !$before_id && $key != $wall[0]['Id']))
                {
                    //if wall post is not lastest and wall post not earlier 2 days and log is not in cache
                    //save log to cache
                    if($wdate[$key] >= mktime()-86400*10)
                    {
                        $this->mCache->set($id . '_wall_post_' . $key, serialize($item), 12*60*60);
                    }
                }
            }
            if(!empty($log_from_cache))
            {
                foreach($log_from_cache as $key=>$item)
                {
                    $log[$key] = $item;
                }
            }
        }
        $fanscount = UserFollow::GetFollowersCount($id, '', $this->mCache);
		$this->mSmarty->assign('wallInfo', $wall);
        $this->mSmarty->assign('log', $log);
		$this->mSmarty->assign('artist', $artist);
		
		require_once(BPATH.'libs/video/video.php');
		$videoObj=new video();
		$this->mSmarty->assign('videoObj', $videoObj);
		
		$wallDetail = $this->mSmarty->fetch('ajax/wall.html');
		$count = 0;
		if($wall) {
			$count = $wall[0]['cnt_all'];
		} 
        
        echo json_encode(array('q'=>'ok', /*'data'=>$wall,*/ 'countAll' => $count,  'log' => $log, 'artist' => $artist, 'wallDetail' => $wallDetail, 'fanscount' => $fanscount));
        exit();
    }


    /**
     * Get wall notes from featured artists walls for main page
     */
    public function WallLoadMain()
    {
        $after_id = _v('after_id', 0);
        $items_count = 4;

        $wall = Wall::GetFeaturedList( $after_id, 0, $items_count);

        echo json_encode(array('q'=>'ok', 'data'=>$wall));
        exit();
    }

    /**
     * Get news feed data
     */
    public function FeedLoad()
    {
        $after_id = _v('after_id', 0);
        $before_id = _v('before_id', 0);
        $status = _v('status', 0);
        $items_count = 10;

        $wall = array();

        $users = UserFollow::GetFollowIds($this->mUser->mUserInfo['Id'], $status);
        if(count($users) > 0)
        {
            $wall = Wall::GetNewsFeed( $users, $after_id, $before_id, $items_count);
        }
		
		require_once(BPATH.'libs/video/video.php');
		$videoObj=new video();
		$this->mSmarty->assign('videoObj', $videoObj);

		$this->mSmarty->assign('wallInfo', $wall);		
		$wallDetail = $this->mSmarty->fetch('ajax/wall.html');
		
		$count = 0;
		if($wall) {
			$count = $wall[0]['cnt_all'];
		}

        echo json_encode(array('q'=>'ok', 'countAll' => $count, 'wallDetail' => $wallDetail));
        exit();
    }
    


    /**
     * Show Artist music
     */
    private function ArtistMusic( &$ui )
    {
        $this->mSmarty->assign('submodule', 'Music');
        $id = _v('id', 0);
        if ($id)
        {
            $album = MusicAlbum::GetAlbum($id, 0, 1);
			
            if (empty($album) || $album['UserId'] != $ui['Id'] || empty($album['Active']) || $album['Deleted'] == 1)
            {
                $id = 0;
                $album = array();
            }
        }

        if (!$id)
        {

            //main music page

            //albums list
           $this->mSmarty->assignByRef('albums', MusicAlbum::GetAlbumList($ui['Id'], 1, 1));
			

            

            //tracks without albums
            if ($this->mUser->IsAuth() && $ui['Id'] != $this->mUser->mUserInfo['Id'])
            {
                $this->mSmarty->assignByRef('tracks', Music::GetMusicListWithPurchase($ui['Id'], $this->mUser->mUserInfo['Id'], 0, 1, 0, 0, 1));
            }
            else
            {
                $this->mSmarty->assignByRef('tracks', Music::GetMusicList($ui['Id'], 0, 1, 0, 0, 0, 1));
            }

            $this->mSmarty->display('mods/profile/show_artist/music.html');
        }
        else
        {
            //show album

            //tracks
			
            if ($this->mUser->IsAuth() && $ui['Id'] != $this->mUser->mUserInfo['Id'])
            {
                $this->mSmarty->assignByRef('tracks', Music::GetMusicListWithPurchase($ui['Id'], $this->mUser->mUserInfo['Id'], $id, 1));
            }
            else
            {
                $this->mSmarty->assignByRef('tracks', Music::GetMusicList($ui['Id'], $id, 1));
            }
			
            $this->mSmarty->assignByRef('album', $album);
            $this->mSmarty->assign('id', $id);
            $this->mSmarty->display('mods/profile/show_artist/music_album.html');
        }
        exit();
    }


    /**
     * Show Artist video
     */
    private function ArtistVideo( &$ui )
    {
        $this->mSmarty->assign('submodule', 'Video');

        $id = _v('id', 0);
        if (!$id)
        {
            //main video page
            //videos
            if ($this->mUser->IsAuth() && $ui['Id'] != $this->mUser->mUserInfo['Id'])
            {
                $this->mSmarty->assignByRef('video', Video::GetVideoListWithPurchase($ui['Id'], $this->mUser->mUserInfo['Id'], 1, 1));
            }
            else
            {
                $this->mSmarty->assignByRef('video', Video::GetVideoList($ui['Id'], 1, 1));
            }
            $this->mSmarty->display('mods/profile/show_artist/video.html');
        }
        else
        {
            $this->mSmarty->assign('submodule', 'VideoOne');

            //show one video
            $video = Video::GetVideoInfo($id, $ui['Id']);
            if (empty($video) || empty($video['Active']) || $video['Deleted'] == 1 || $video['Status'] < 2)
            {
                uni_redirect( PATH_ROOT . 'u/'.$ui['Name'].'/video' );
            }
            if ($this->mUser->IsAuth() && $ui['Id'] != $this->mUser->mUserInfo['Id'])
            {
                $video['VideoPurchase'] = VideoPurchase::Get($this->mUser->mUserInfo['Id'], $id);
            }
            $this->mSmarty->assignByRef('video', $video);
            $this->mSmarty->display('mods/profile/show_artist/video_one.html');
        }
        exit();
    }
	
	public function WaterMark()
	{
		extract($_REQUEST);
		$stamp	=	BPATH.'/files/images/stamp.png';				
		$images	=	BPATH.'/files/photo/mid/'.$u.'/'.$ph.'';							
		$stamp = imagecreatefrompng($stamp);
		$im = imagecreatefromjpeg($images);
		$marge_right = 50;
		$marge_bottom = 50;
		$sx = imagesx($stamp);
		$sy = imagesy($stamp);
		imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
		header('Content-type: image/jpeg');
		imagejpeg($im);		
		imagedestroy($im);
	}

    /**
     * Show Artist photo
     */
    private function ArtistPhoto( &$ui )
    {
		
        $this->mSmarty->assign('submodule', 'Photo');
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
            $photo = Photo::GetPhoto($ph);
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
			
		    $photo = Photo::GetPhoto($ph);
			
            //show one photo
			
			//$stamp	=	BPATH.'/files/images/stamp.png';	
			//$images	=	BPATH.'/files/photo/thumbs/'.$photo['UserId'].'/'.$photo['Image'].'';	
			//$watermarkImages = waterMark($stamp,$images);
			//$this->mSmarty->assign('watermark', $watermarkImages);
			

            $this->mSmarty->assignByRef('photo', $photo);
            //prev and next photos ids
            $this->mSmarty->assignByRef('links', Photo::GetPrevNext($id, $ph));
            $this->mSmarty->assignByRef('album', $album);
            $this->mSmarty->assign('submodule', 'PhotoOne');
            $this->mSmarty->display('mods/profile/show_artist/photo_one.html');
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
     * Show Artist events
     */
    private function ArtistEvents( $ui )
    {
        $this->mSmarty->assign('submodule', 'Events');
        $id = _v('id', 0);

        if (!$id)
        {
            //show events list
            $page = _v('page', 1);
            $pcnt = 10;
            $df = _v('df', '');
            $df = !in_array($df, array('tw', 'nw', 'tm', 'nm')) ? '' : $df;
            $this->mSmarty->assignByRef('df', $df);

            $period = Event::GetPeriod($df);
            /*if(!$period['from'] || strtotime($period['from']) < mktime())
            {
                $period['from'] = date("Y-m-d H:i:s");
            }*/

            if ($this->mUser->IsAuth() && $ui['Id'] != $this->mUser->mUserInfo['Id'])
            {
                $rcnt = Event::EventsCount($ui['Id'], $period);
                $events = Event::EventsWithAttendAndPurchasedList($ui['Id'], $this->mUser->mUserInfo['Id'], $page, $pcnt, $period);
            }
            else
            {
                $rcnt = Event::EventsCount($ui['Id'], $period);
                $events = Event::EventsList($ui['Id'], $page, $pcnt, $period);
            }
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
        for ($i=date("Y"); $i >=date("Y")-2; $i--)
        {
            $yy[$i] = $i;
        }

        $this->mSmarty->assignByRef('mm', $mm);
        $this->mSmarty->assignByRef('yy', $yy);

        //get events for selected month
        $from = mktime(0, 0, 0, $month, 1, $year);
        $to   = mktime(0, 0, 0, $next_month, 1, $next_year) - 1;
        $events_list = Event::EventsList( $ui['Id'], 0, 0, array('from' => date("Y-m-d H:i:s", $from), 'to' => date("Y-m-d H:i:s", $to)));
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
        if(empty($event_id))
        {
            uni_redirect(PATH_ROOT);
        }

        $this->mSmarty->assign('module', 'events');
        $this->mSmarty->assign('submodule', 'VideoOne');
        
        if (!is_numeric($event_id))
        {
            if ($event_id[0]=='u')
            {
                $login = substr($event_id, 1);
                $ui = User::GetUserByLogin($login);
                if (empty($ui) || $ui['Status'] != 2)
                {
                    uni_redirect(PATH_ROOT);
                }
                if($this->mUser->IsAuth())
                {
                    //add viewer of this broadcasting - only if user has access
                    //TODO: check access
                    BroadcastViewers::AddViewer($event_id, $this->mUser->mUserInfo['Id']);
                }
                $access = 1; //access to broadcasting

                $online = 0;
                //$flow = BroadcastFlows::GetEventLatestFlow($ui['Id'], 0);
                //check online broadcast
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
                    $flow = 'u'.$event_id;
                }
                $this->mSmarty->assign('flow', $flow);
                $this->mSmarty->assign('event_id', $event_id);
                $this->mSmarty->assignByRef('ui', $ui);
                $this->mSmarty->assign('access', $access);
                $this->mSmarty->assign('online', $online);
            }
            else
            {
                uni_redirect(PATH_ROOT);
            }
        }
        else
        {
            $event = Event::GetEvent($event_id);
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
                if($this->mUser->mUserInfo['Status'] == 1)
                {
                    //for fan check the access to that brroadcast
                    $purchase = EventPurchase::Get($this->mUser->mUserInfo['Id'], $event['Id']);
                    if(!empty($purchase))
                    {
                        $access = 1;
                        $this->mSmarty->assignByRef('purchase', $purchase);
                    }
                }
                if($event['Status'] < 3)
                {
                    //add viewer of this broadcasting - only if user has access
                    //BroadcastViewers::AddViewer($event['Code'], $this->mUser->mUserInfo['Id']);
                }
            }
            $this->mSmarty->assign('event_id', $event['Code']);
            //latest flow
            $online = 0;
            //$flow = BroadcastFlows::GetEventLatestFlow($ui['Id'], $event['Id']);

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
        

        include_once 'dev/config/wowza.php';
        $this->mSmarty->assign('WOWZA_SERVER', WOWZA_SERVER);
        $this->mSmarty->display('mods/profile/show_artist/broadcasting_play.html');
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
        $fans_count = UserFollow::GetFollowersCount($ui['Id'], '', $this->mCache);
        $this->mSmarty->assign('fans_count', $fans_count);

        //music
        //if ($this->mUser->IsAuth() && $ui['Id'] != $this->mUser->mUserInfo['Id'])
        //{
        //    $this->mSmarty->assignByRef('music', Music::GetMusicListWithPurchase($ui['Id'], $this->mUser->mUserInfo['Id'], -1, 1, 1, 4, 1));
        //}
        //else
        //{
            $this->mSmarty->assignByRef('music', Music::GetMusicList( $ui['Id'], -1, 1, 1, 6, 1, 0, $this->mCache ));
        //}


        //videos
        //if ($this->mUser->IsAuth() && $ui['Id'] != $this->mUser->mUserInfo['Id'])
        //{
        //    $this->mSmarty->assignByRef('video', Video::GetVideoListWithPurchase( $ui['Id'], $this->mUser->mUserInfo['Id'], 1, 1, 4 ));
        //}
        //else
        //{
            $this->mSmarty->assignByRef('video', Video::GetVideoList( $ui['Id'], 1, 1, 6, $this->mCache ));
        //}
			$this->mSmarty->assignByRef('fans', UserFollow::GetFollowersList($ui['Id']));
			
        $this->mSmarty->assign('submodule', 'Profile');
        $this->mSmarty->display('mods/profile/show_artist/wall.html');

        exit();
    }

    /**
     * Show fan profile
     */
    private function FanProfile( $ui )
    {

        $ui['CountryName'] = Countries::GetCountryName($ui['Country']);
        $this->mSmarty->assignByRef('ui', $ui);
        $this->mSmarty->display('mods/profile/show_fan/profile.html');

        exit();
    }


     /**
     * Show fan wall
     */
    private function FanWall( $ui )
    {
        //artists
        $this->mSmarty->assignByRef( 'follow', UserFollow::GetFollowList( $ui['Id'] ) );        
        $this->mSmarty->display('mods/profile/show_fan/wall.html');

        exit();
    }
    
    
   

    /**
     * get video status
     * @return void
     */
    public function CheckVideoStatus()
    {
        $res = array('q' => 'ok', 'status' => 0);
        $id = _v('id', 0);
        if($id)
        {
            $res['status'] = Video::GetVideoStatus($id);
        }
        echo json_encode($res);
        exit();
    }

    public function Download()
    {
        $id = _v('id', 0);
        $act = trim(strip_tags(_v('act', '')));
        switch($act)
        {
            case 'video':
                $video = Video::GetVideoInfo($id);
                if(empty($video) || $video['FromYt'] || $video['Status'] < 2)
                {
                    die('File Not Found');
                }
                if(!$this->mUser->CheckAdminStatus())
                {
                    if (!empty($video['Price']) && $this->mUser->IsAuth() && $video['UserId'] != $this->mUser->mUserInfo['Id'])
                    {
                        $video['VideoPurchase'] = VideoPurchase::Get($this->mUser->mUserInfo['Id'], $id);
                        if(empty($video['VideoPurchase']))
                        {
                            die('File Not Found');
                        }
                    }
                }
                //file path
                $filepath = BPATH . 'files/video/u/' . $video['UserId'] . '/' . $video['Video'];
                if(!file_exists($filepath))
                {
                    die('File Not Found');
                }
                $fsize = filesize($filepath);
                header("Pragma: public");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Cache-Control: private", false);
                header("Content-type: application/zip;");
                header("Content-Disposition: attachment; filename=\"" . basename($filepath) . "\";" );
                header("Content-Transfer-Encoding: binary");
                header("Content-Length: " . $fsize);

                readfile($filepath);
                break;
            default:
                die('File Not Found');
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
        echo 'Done!';
        exit();
    }

    /**
     * Init purchase/add content by not auth user
     * @return void
     */
    public function ActionNotAuth()
    {
        $id = _v('id', 0);
        $what = trim(strip_tags(_v('what', '')));
        $res = array('q' => 'err');
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
                $this->mlObj['mSession']->set('notice', 'You have to be a registered artistsfan.com user to ' . (!empty($content['Price']) ?  'buy' : 'add') . '  content from artists. Please sign up or sign in below.');
                $res['q'] = 'ok';
            }
        }
        echo json_encode($res);
        exit();
    }

        /**
     * Buy/add music track
     * @return void
     */
    public function PurchaseMusic()
    {
        $id = _v('id', 0);

        $music = Music::GetMusic($id);

        $res = array('q' => 'ok', 'errs' => array());

        if (!$this->mUser->IsAuth())
        {
            $this->mlObj['mSession']->set('redirect', array('content' => 'track', 'id' => $id));
            $this->mlObj['mSession']->set('notice', 'You have to be a registered artistsfan.com user to ' . (!empty($music['Price']) ?  'buy' : 'add') . '  content from artists. Please sign up or sign in below.');
            $res['q'] = 'err';
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
                if (empty($music['Price']) || $music['Price'] < $this->mUser->mUserInfo['Wallet'])
                {
                    //buy music
                    MusicPurchase::Purchase($this->mUser->mUserInfo['Id'], $music['Id'], $music['Price']);
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

                        //log
                        ShoppingLog::LogAdd($music['UserId'], $this->mUser->mUserInfo['Id'], 'buy_track', array('Id' => $music['Id'], 'Title' => $music['Title'], 'Price' => $music['Price']), $this->mCache);
                        //for artist transaction history
                        Payout::PayoutMoney($music['UserId'], 1, 0, $music['Price'], $artist['Wallet'], $this->mUser->mUserInfo['Id'], 1, array('type' => 'track', 'id' => $music['Id'], 'title' => $music['Title']));
                        //for fan transaction history
                        Payout::PayoutMoney($this->mUser->mUserInfo['Id'], 0, 0, $music['Price'], $sum, $this->mUser->mUserInfo['Id'], 1, array('type' => 'track', 'id' => $music['Id'], 'title' => $music['Title'], 'user_id' => $music['UserId']));
                    }
                    //fan rating
                    UserFollow::ChangeRating($this->mUser->mUserInfo['Id'], $music['UserId'], ($music['Price'] > 0 ? 'buy_track' : 'add_track'));

                    //check if all album is purchased
                    /*if($music['AlbumId'])
                    {
                        $album_songs = Music::GetMusicListWithPurchase($music['UserId'], $this->mUser->mUserInfo['Id'], $music['AlbumId'], 1);
                        $ids_purchased = array();
                        foreach($album_songs as $item)
                        {
                            if(!empty($item['MusicPurchase.Id']))
                            {
                                $ids_purchased[] = $item['Id'];
                            }
                        }
                        if(count($ids_purchased) == count($album_songs))
                        {
                            //all songs of album is purchased
                            MusicPurchase::PurchaseUpdate($this->mUser->mUserInfo['Id'], $ids_purchased);
                        }
                    }*/

                    $res['q'] = 'ok';
                    $res['track'] = $music['Track'];
                }
                else
                {
                    $res['errs'][] = 'You do not have enough points in the account';
                }
            }
            else
            {
                $res['errs'][] = ($music['Price'] > 0) ? 'The track has already purchased' : 'The track has already added';
            }
        }
        else
        {
            $res['errs'][] = 'The track not found';
        }
        echo json_encode($res);
        exit();
    }
	
	
	/**
	*Pay More music album By Lenin Kumar K
	*
	*/
   public function buyphoto()
   	{
	
	$payMore=	_v('PayMore',0);	

	if(isset($payMore))
		{
		$id 	= 	_v('id', 0);	
		
	$photo 	=	Photo::GetPhoto( $id );	
	$photo['Price']	=	$payMore;
	$res = array('q' => 'ok', 'errs' => array());
        if (!$this->mUser->IsAuth())
        {
            $this->mlObj['mSession']->set('redirect', array('content' => 'album', 'id' => $id));
            $this->mlObj['mSession']->set('notice', 'You have to be a registered artistsfan.com user to ' . (!empty($album['Price']) ?  'buy' : 'add') . '  content from artists. Please sign up or sign in below.');
            $res['q'] = 'err';
            echo json_encode($res);
            exit();
        }
	$this->mlObj['mSession']->Del('redirect');
    $this->mlObj['mSession']->Del('notice');
	 if (!empty($photo))
      {
	  	$photosa = Photo::GetPhotoListWithPurchase($photo['UserId'], $this->mUser->mUserInfo['Id'], $id, 1);
	if(!empty($photosa))
      {			
		error_reporting(0);
		$alreadypurchaesed = Photo::GetCheckPurchasedPhoto($photo['UserId']);
		if($alreadypurchaesed['with_all_album'] == 1)
		 {
			$res['errs'][] = ($photo['Price'] > 0) ? 'The album has already purchased' : 'The album has already added';
			break;
		}
		if(empty($res['errs']))
		 {
      $purchase = PhotoPurchase::Get($this->mUser->mUserInfo['Id'], $id);

	 
      if (empty($purchase))
            {	  

		if (empty($photo['Price']) || $photo['Price'] < $this->mUser->mUserInfo['Wallet'])
		 {
		  PhotoPurchase::Purchase($this->mUser->mUserInfo['Id'], $photo['Id'], $photo['Price']);		
		if($photo['Price'] > 0)
		 {			
		 	$sum = $this->mUser->mUserInfo['Wallet'] - $photo['Price'];
			User::UpdateWallet($this->mUser->mUserInfo['Id'], $sum);
			//update artist's wallet

			$artist = User::GetphotoUser($photo['UserId']);
			$artist['Wallet']	=	$artist['wallet'];
		if(empty($artist['Wallet']))
		 {
		 	$artist['Wallet'] = 0;
		 }
			$artist['Wallet'] = $artist['Wallet'] + $photo['Price'];
			
			User::UpdateWallet($artist['Id'], $artist['Wallet']);
			//log
			 ShoppingLog::LogAdd($photo['UserId'], $this->mUser->mUserInfo['Id'], 'buy_photo', array('Id' => $photo['Id'], 'Title' => $photo['Title'], 'Price' => $photo['Price']), $this->mCache);
			//for artist transaction history
			Payout::PayoutMoney($photo['UserId'], 1, 0, $photo['Price'], $artist['Wallet'], $this->mUser->mUserInfo['Id'], 1, array('type' => 'photo', 'id' => $photo['Id'], 'title' => $photo['Title']));
			//for fan transaction history
			Payout::PayoutMoney($this->mUser->mUserInfo['Id'], 0, 0, $photo['Price'], $sum, $this->mUser->mUserInfo['Id'], 1, array('type' => 'photo', 'id' => $photo['Id'], 'title' => $photo['Title'], 'user_id' => $photo['UserId']));
			}
			UserFollow::ChangeRating($this->mUser->mUserInfo['Id'], $photo['UserId'], $photo['Price'] > 0 ? 'buy_photo' : 'add_photo');
			$res['q'] = 'ok';
			//   $res['tracks'] = $tracks;
			}
			else
			{
			$res['errs'][] = 'You do not have enough points in the account';
			}
		}
		else
		{
		$res['errs'][] = ($music['Price'] > 0) ? 'The Photo has already purchased' : 'The Photo has already added';
		}	
			}
		}
		else
		{
			$res['errs'][] = 'The album has no Photos';
		}
		}
        echo json_encode($res);
        exit();
			
		}
		else
		{
		$id 	= 	_v('id', 0);	
	$photo 	=	Photo::GetPhoto( $id );	
	$res = array('q' => 'ok', 'errs' => array());
        if (!$this->mUser->IsAuth())
        {
            $this->mlObj['mSession']->set('redirect', array('content' => 'album', 'id' => $id));
            $this->mlObj['mSession']->set('notice', 'You have to be a registered artistsfan.com user to ' . (!empty($album['Price']) ?  'buy' : 'add') . '  content from artists. Please sign up or sign in below.');
            $res['q'] = 'err';
            echo json_encode($res);
            exit();
        }
	$this->mlObj['mSession']->Del('redirect');
    $this->mlObj['mSession']->Del('notice');
	 if (!empty($photo))
      {
	  	$photosa = Photo::GetPhotoListWithPurchase($photo['UserId'], $this->mUser->mUserInfo['Id'], $id, 1);
	if(!empty($photosa))
      {			
		error_reporting(0);
		$alreadypurchaesed = Photo::GetCheckPurchasedPhoto($photo['UserId']);
		if($alreadypurchaesed['with_all_album'] == 1)
		 {
			$res['errs'][] = ($photo['Price'] > 0) ? 'The album has already purchased' : 'The album has already added';
			break;
		}
		if(empty($res['errs']))
		 {
      $purchase = PhotoPurchase::Get($this->mUser->mUserInfo['Id'], $id);

	 
      if (empty($purchase))
            {	  

		if (empty($photo['Price']) || $photo['Price'] < $this->mUser->mUserInfo['Wallet'])
		 {
		  PhotoPurchase::Purchase($this->mUser->mUserInfo['Id'], $photo['Id'], $photo['Price']);		
		if($photo['Price'] > 0)
		 {			
		 	$sum = $this->mUser->mUserInfo['Wallet'] - $photo['Price'];
			User::UpdateWallet($this->mUser->mUserInfo['Id'], $sum);
			//update artist's wallet

			$artist = User::GetphotoUser($photo['UserId']);
			$artist['Wallet']	=	$artist['wallet'];
		if(empty($artist['Wallet']))
		 {
		 	$artist['Wallet'] = 0;
		 }
			$artist['Wallet'] = $artist['Wallet'] + $photo['Price'];
			
			User::UpdateWallet($artist['Id'], $artist['Wallet']);
			//log
			 ShoppingLog::LogAdd($photo['UserId'], $this->mUser->mUserInfo['Id'], 'buy_photo', array('Id' => $photo['Id'], 'Title' => $photo['Title'], 'Price' => $photo['Price']), $this->mCache);
			//for artist transaction history
			Payout::PayoutMoney($photo['UserId'], 1, 0, $photo['Price'], $artist['Wallet'], $this->mUser->mUserInfo['Id'], 1, array('type' => 'photo', 'id' => $photo['Id'], 'title' => $photo['Title']));
			//for fan transaction history
			Payout::PayoutMoney($this->mUser->mUserInfo['Id'], 0, 0, $photo['Price'], $sum, $this->mUser->mUserInfo['Id'], 1, array('type' => 'photo', 'id' => $photo['Id'], 'title' => $photo['Title'], 'user_id' => $photo['UserId']));
			}
			UserFollow::ChangeRating($this->mUser->mUserInfo['Id'], $photo['UserId'], $photo['Price'] > 0 ? 'buy_photo' : 'add_photo');
			$res['q'] = 'ok';
			//   $res['tracks'] = $tracks;
			}
			else
			{
			$res['errs'][] = 'You do not have enough points in the account';
			}
		}
		else
		{
		$res['errs'][] = ($music['Price'] > 0) ? 'The Photo has already purchased' : 'The Photo has already added';
		}	
			}
		}
		else
		{
			$res['errs'][] = 'The album has no Photos';
		}
		}
        echo json_encode($res);
        exit();
			
		}
	
	}	
	
   public function PayMoreAlbumPurchaseMusic()
    {
        $id = _v('id', 0);

        $album = MusicAlbum::GetAlbum($id);
		
		
		
		$album['Price']	=	$_REQUEST['payMore'];
		


        $res = array('q' => 'ok', 'errs' => array());
        if (!$this->mUser->IsAuth())
        {
            $this->mlObj['mSession']->set('redirect', array('content' => 'album', 'id' => $id));
            $this->mlObj['mSession']->set('notice', 'You have to be a registered artistsfan.com user to ' . (!empty($album['Price']) ?  'buy' : 'add') . '  content from artists. Please sign up or sign in below.');
            $res['q'] = 'err';
            echo json_encode($res);
            exit();
        }
        $this->mlObj['mSession']->Del('redirect');
        $this->mlObj['mSession']->Del('notice');
        if (!empty($album) && $album['Active'] == 1 && $album['Deleted'] != 1)
        {
            $music = Music::GetMusicListWithPurchase($album['UserId'], $this->mUser->mUserInfo['Id'], $id, 1);
            if(!empty($music))
            {
                foreach($music as $item)
                {
                    if($item['MusicPurchase.WithAllAlbum'] == 1)
                    {
                        $res['errs'][] = ($album['Price'] > 0) ? 'The album has already purchased' : 'The album has already added';
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
                                MusicPurchase::Purchase($this->mUser->mUserInfo['Id'], $item['Id'], $item['Price'], 1);
                                $tracks[$item['Id']] = $item['Track'];
                            }
                        }
                        if(count($already_purchased) > 0)
                        {
                            //update already purchased music
                            MusicPurchase::PurchaseUpdate($this->mUser->mUserInfo['Id'], $already_purchased);
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
                        $res['q'] = 'ok';
                        $res['tracks'] = $tracks;
                    }
                    else
                    {
                        $res['errs'][] = 'You do not have enough points in the account';
                    }
                }
            }
            else
            {
                $res['errs'][] = 'The album has no songs';
            }
        }
        else
        {
            $res['errs'][] = 'The album not found';
        }
        echo json_encode($res);
        exit();
    }
	
	public function payMoreMusic()
		{
		

		
        $id = _v('id', 0);

        $music = Music::GetMusic($id);	

		$music['Price'] =	$_REQUEST['payMore'];		
		

        $res = array('q' => 'ok', 'errs' => array());

        if (!$this->mUser->IsAuth())
        {
            $this->mlObj['mSession']->set('redirect', array('content' => 'track', 'id' => $id));
            $this->mlObj['mSession']->set('notice', 'You have to be a registered artistsfan.com user to ' . (!empty($music['Price']) ?  'buy' : 'add') . '  content from artists. Please sign up or sign in below.');
            $res['q'] = 'err';
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
                if (empty($music['Price']) || $music['Price'] < $this->mUser->mUserInfo['Wallet'])
                {
                    //buy music
                    MusicPurchase::Purchase($this->mUser->mUserInfo['Id'], $music['Id'], $music['Price']);
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

                        //log
                        ShoppingLog::LogAdd($music['UserId'], $this->mUser->mUserInfo['Id'], 'buy_track', array('Id' => $music['Id'], 'Title' => $music['Title'], 'Price' => $music['Price']), $this->mCache);
                        //for artist transaction history
                        Payout::PayoutMoney($music['UserId'], 1, 0, $music['Price'], $artist['Wallet'], $this->mUser->mUserInfo['Id'], 1, array('type' => 'track', 'id' => $music['Id'], 'title' => $music['Title']));
                        //for fan transaction history
                        Payout::PayoutMoney($this->mUser->mUserInfo['Id'], 0, 0, $music['Price'], $sum, $this->mUser->mUserInfo['Id'], 1, array('type' => 'track', 'id' => $music['Id'], 'title' => $music['Title'], 'user_id' => $music['UserId']));
                    }
                    //fan rating
                    UserFollow::ChangeRating($this->mUser->mUserInfo['Id'], $music['UserId'], ($music['Price'] > 0 ? 'buy_track' : 'add_track'));

                    //check if all album is purchased
                    /*if($music['AlbumId'])
                    {
                        $album_songs = Music::GetMusicListWithPurchase($music['UserId'], $this->mUser->mUserInfo['Id'], $music['AlbumId'], 1);
                        $ids_purchased = array();
                        foreach($album_songs as $item)
                        {
                            if(!empty($item['MusicPurchase.Id']))
                            {
                                $ids_purchased[] = $item['Id'];
                            }
                        }
                        if(count($ids_purchased) == count($album_songs))
                        {
                            //all songs of album is purchased
                            MusicPurchase::PurchaseUpdate($this->mUser->mUserInfo['Id'], $ids_purchased);
                        }
                    }*/

                    $res['q'] = 'ok';
                    $res['track'] = $music['Track'];
                }
                else
                {
                    $res['errs'][] = 'You do not have enough points in the account';
                }
            }
            else
            {
                $res['errs'][] = ($music['Price'] > 0) ? 'The track has already purchased' : 'The track has already added';
            }
        }
        else
        {
            $res['errs'][] = 'The track not found';
        }
        echo json_encode($res);
        exit();
    }

    /**
     * Buy/add music album
     * @return void
     */
    public function PurchaseAlbum()
    {
        $id = _v('id', 0);

        $album = MusicAlbum::GetAlbum($id);

        $res = array('q' => 'ok', 'errs' => array());
        if (!$this->mUser->IsAuth())
        {
            $this->mlObj['mSession']->set('redirect', array('content' => 'album', 'id' => $id));
            $this->mlObj['mSession']->set('notice', 'You have to be a registered artistsfan.com user to ' . (!empty($album['Price']) ?  'buy' : 'add') . '  content from artists. Please sign up or sign in below.');
            $res['q'] = 'err';
            echo json_encode($res);
            exit();
        }
        $this->mlObj['mSession']->Del('redirect');
        $this->mlObj['mSession']->Del('notice');
        if (!empty($album) && $album['Active'] == 1 && $album['Deleted'] != 1)
        {
            $music = Music::GetMusicListWithPurchase($album['UserId'], $this->mUser->mUserInfo['Id'], $id, 1);
            if(!empty($music))
            {
                foreach($music as $item)
                {
                    if($item['MusicPurchase.WithAllAlbum'] == 1)
                    {
                        $res['errs'][] = ($album['Price'] > 0) ? 'The album has already purchased' : 'The album has already added';
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
                                MusicPurchase::Purchase($this->mUser->mUserInfo['Id'], $item['Id'], $item['Price'], 1);
                                $tracks[$item['Id']] = $item['Track'];
                            }
                        }
                        if(count($already_purchased) > 0)
                        {
                            //update already purchased music
                            MusicPurchase::PurchaseUpdate($this->mUser->mUserInfo['Id'], $already_purchased);
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
                        $res['q'] = 'ok';
                        $res['tracks'] = $tracks;
                    }
                    else
                    {
                        $res['errs'][] = 'You do not have enough points in the account';
                    }
                }
            }
            else
            {
                $res['errs'][] = 'The album has no songs';
            }
        }
        else
        {
            $res['errs'][] = 'The album not found';
        }
        echo json_encode($res);
        exit();
    }

    /**
     * Buy/add video
     * @return void
     */
    public function PurchaseVideo()
    {
        $id = _v('id', 0);

        $video = Video::GetVideoInfo($id);
        $res = array('q' => 'ok', 'errs' => array());
        if (!$this->mUser->IsAuth())
        {
            $this->mlObj['mSession']->set('redirect', array('content' => 'video', 'id' => $id));
            $this->mlObj['mSession']->set('notice', 'You have to be a registered artistsfan.com user to ' . (!empty($video['Price']) ?  'buy' : 'add') . '  content from artists. Please sign up or sign in below.');
            $res['q'] = 'err';
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
                    //fan rating
                    UserFollow::ChangeRating($this->mUser->mUserInfo['Id'], $video['UserId'], $video['Price'] > 0 ? 'buy_video' : 'add_video');
                    $res['q'] = 'ok';
                }
                else
                {
                    $res['errs'][] = 'You do not have enough points in the account';
                }
            }
            else
            {
                $res['errs'][] = ($video['Price'] > 0) ? 'This video has already purchased' : 'This video has already added to your list';
            }
        }
        else
        {
            $res['errs'][] = 'The video not found';
        }
        echo json_encode($res);
        exit();
    }

    /**
     * Buy event access
     * @return void
     */
    public function PurchaseEventAccess()
    {
        $id = _v('id', 0);

        $event = Event::GetEvent($id);

        $res = array('q' => 'ok', 'errs' => array());
        if (!$this->mUser->IsAuth())
        {
            $this->mlObj['mSession']->set('redirect', array('content' => 'event', 'id' => $id, 'act' => 'access'));
            $this->mlObj['mSession']->set('notice', 'You have to be a registered artistsfan.com user to ' . (!empty($event['Price']) ?  'buy' : 'add') . ' content from artists. Please sign up or sign in below.');
            $res['q'] = 'err';
            echo json_encode($res);
            exit();
        }
        $this->mlObj['mSession']->Del('redirect');
        $this->mlObj['mSession']->Del('notice');
        if (!empty($event))
        {
            $purchase = EventPurchase::Get($this->mUser->mUserInfo['Id'], $id);
            if (empty($purchase))
            {
                if (empty($event['Price']) || $event['Price'] < $this->mUser->mUserInfo['Wallet'])
                {
                    //buy access
                    EventPurchase::Purchase($this->mUser->mUserInfo['Id'], $event['Id'], $event['Price']);

                    if($event['EventType'] == STREAM_EVENT)
                    {
                        //attend event
                        $attend = EventAttend::Get($this->mUser->mUserInfo['Id'], $id);
                        if (empty($attend))
                        {
                            EventAttend::Attend($this->mUser->mUserInfo['Id'], $event['Id']);
                        }
                    }
                    if($event['Price'] > 0)
                    {
                        $sum = $this->mUser->mUserInfo['Wallet'] - $event['Price'];
                        //update user's wallet
                        User::UpdateWallet($this->mUser->mUserInfo['Id'], $sum);

                        //update artist's wallet
                        $artist = User::GetUser($event['UserId']);
                        if(empty($artist['Wallet']))
                        {
                            $artist['Wallet'] = 0;
                        }
                        if(empty($artist['WalletBlock']))
                        {
                            $artist['WalletBlock'] = 0;
                        }
                        $artist['Wallet'] = $artist['Wallet'] + $event['Price'];
                        $artist['WalletBlock'] = $artist['WalletBlock'] + $event['Price'];
                        User::UpdateWallet($artist['Id'], $artist['Wallet'], $artist['WalletBlock']);

                        //log
                        ShoppingLog::LogAdd($event['UserId'], $this->mUser->mUserInfo['Id'], 'buy_access', array('Id' => $event['Id'], 'Title' => $event['Title'], 'Price' => $event['Price']), $this->mCache);

                        //for artist transaction history
                        Payout::PayoutMoney($event['UserId'], 1, 0, $event['Price'], $artist['Wallet'], $this->mUser->mUserInfo['Id'], 1, array('type' => 'event', 'id' => $event['Id'], 'title' => $event['Title']));
                        //for fan transaction history
                        Payout::PayoutMoney($this->mUser->mUserInfo['Id'], 0, 0, $event['Price'], $sum, $this->mUser->mUserInfo['Id'], 1, array('type' => 'event', 'id' => $event['Id'], 'title' => $event['Title'], 'user_id' => $event['UserId']));
                    }
                    //fan rating
                    UserFollow::ChangeRating($this->mUser->mUserInfo['Id'], $event['UserId'], $event['Price'] > 0 ? 'add_access' : 'buy_access');

                    $res['q'] = 'ok';
                }
                else
                {
                    $res['errs'][] = 'You do not have enough points in the account';
                }
            }
            else
            {
                $res['errs'][] = ($event['Price'] > 0) ? 'The access has already purchased' : 'The access has already gotten';
            }
        }
        echo json_encode($res);
        exit();
    }

    /**
     * Attend event
     * @return void
     */
    public function AttendEvent()
    {
        $id = _v('id', 0);

        $event = Event::GetEvent($id);

        $res = array('q' => 'ok', 'errs' => array());
        if (!$this->mUser->IsAuth())
        {
            $this->mlObj['mSession']->set('redirect', array('content' => 'event', 'id' => $id, 'act' => 'attend'));
            $this->mlObj['mSession']->set('notice', 'You have to be a registered artistsfan.com user to buy content from artists. Please sign up or sign in below.');
            $res['q'] = 'err';
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
                //log
                //ShoppingLog::LogAdd($event['UserId'], $this->mUser->mUserInfo['Id'], 'attend_event', array('Id' => $event['Id'], 'Title' => $event['Title'], 'Date' => $event['EventDate']), $this->mCache);

                $res['q'] = 'ok';
            }
            else
            {
                $res['errs'][] = 'The event is already in your calendar';
            }
        }
        echo json_encode($res);
        exit();
    }

    /**
     * Remove event from attend event list
     * @return void
     */
    public function RemoveAttendEvent()
    {
        $id = _v('id', 0);

        $event = Event::GetEvent($id);

        $res = array('q' => 'ok', 'errs' => array());
        if (!$this->mUser->IsAuth())
        {
            $this->mlObj['mSession']->set('redirect', array('content' => 'event', 'id' => $id, 'act' => 'removeattend'));
            $this->mlObj['mSession']->set('notice', 'You have to be a registered artistsfan.com user to complete this action. Please sign up or sign in below.');
            $res['q'] = 'err';
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

                $res['q'] = 'ok';
            }
            else
            {
                $res['errs'][] = 'This event is not in your calendar';
            }
        }
        echo json_encode($res);
        exit();
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
                $this->mCache->set('broadcast_' . $event_id, serialize(array('flow' => $newflow, 'time' => mktime())), 3*3600);
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
        $this->mCache->set('broadcast_' . $event_id, serialize(array('flow' => $newflow, 'time' => mktime())), 3*3600);
        echo $newflow;
        exit();
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
        if ($event_id[0]=='u')
        {
            $msg = 'Broadcast starting <a href="/broadcasting/u' . $this->mUser->mUserInfo['Name'] . '/">here</a>';
            $link = 'http://' . DOMAIN . '/broadcasting/u' . $this->mUser->mUserInfo['Name'] . '/';
        }
        else
        {
            $event = Event::GetEventByCode($event_id);
            $msg = 'Broadcast starting <a href="/broadcasting/' . $event . '/">here</a>';
            $link = 'http://' . DOMAIN . '/broadcasting/' . $event . '/';
        }
        Wall::Add( $this->mUser->mUserInfo['Id'], $this->mUser->mUserInfo['Id'], $msg, $this->mCache );
        //re-post to twitter
        if (!empty($this->mUser->mUserInfo['TwOauthToken']) && !empty($this->mUser->mUserInfo['TwOauthTokenSecret']))
        {
            require_once('libs/twitteroauth/twitteroauth.php');
            $tweet = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, $this->mUser->mUserInfo['TwOauthToken'], $this->mUser->mUserInfo['TwOauthTokenSecret']);
            $tweet->post('statuses/update', array('status' => $msg));
        }
        //re-post to facebook
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


    /**
     * Ajax get broadcast viewers count
     */
    public function GetViewersCount()
    {
        $res = array('q' => 'ok');
        
        $event_id = trim(strip_tags(_v('event_id', '')));
        if($event_id)
        {
            $res['count'] = BroadcastViewers::GetCount($event_id);
        }
        echo json_encode($res);
        exit();
    }

    /**
     * Ajax get broadcast viewers list
     */
    public function GetViewersList()
    {
        $res = array('q' => 'ok', 'count' => 0, 'list' => array(), 'length' => 0, 'time' => 0);

        $event_id = trim(strip_tags(_v('event_id', '')));
        $page = _v('page', 1);
        $time = _v('time', 0);
        $limit = 10;
        if($event_id)
        {
            $res = BroadcastViewers::GetListViewers($event_id, $limit, $page);
            $res['q'] = 'ok';
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

    /**
     * Ajax update viewer (last time)
     */
    public function UpdateViewer()
    {
        $res = array('q' => 'ok');
        $event_id = trim(strip_tags(_v('event_id', '')));
        if($event_id && $this->mUser->IsAuth())
        {
            BroadcastViewers::UpdateViewer($event_id, $this->mUser->mUserInfo['Id']);
        }
        echo json_encode($res);
        exit();
    }

    /**
     * check broadcast event status - online or offline
     * @return void
     */
    public function CheckEventOnline()
    {
        $res = array('q' => 'ok', 'online' => 0);
        /*$event_id = _v('event_id', 0);
        $user_id = _v('user_id', 0);
        
        $flow = BroadcastFlows::GetEventLatestFlow($user_id, $event_id);*/
        $event_id = trim(strip_tags(_v('event_id', '')));
        
        //get current flow from cache
        $cache = $this->mCache->get('broadcast_' . $event_id);
        if(!empty($cache))
        {
            $cache = unserialize($cache);
            $flow = $cache['flow'];
            $time = $cache['time'];
        }
        
        $res['online'] = (!empty($flow) && !empty($time) && $time > mktime()-60) ? 1 : 0;
        
        echo json_encode($res);
        exit();
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
}
