<?php 


/** 
 * Base Artist profile class
 * User: ssergy
 * Date: 08.02.12
 * Time: 17:46  
 *          
 **/        
             
class Base_Artist extends Base
{ 
    public function __construct($glObj)
    { 
        parent :: __construct($glObj); 
		
		$this->mlObj['mSession']->Del('redirect');
		 
        if (!$this->mUser->IsAuth()) 
        {
            uni_redirect( PATH_ROOT . 'base/user/login' );
        }

        if ($this->mUser->mUserInfo['Status'] != 2)
        {
            uni_redirect( PATH_ROOT );
        }
    }

    /** 
     * Main dashboard page
     */
	 
    public function Index()
    {
		$this->mSmarty->display('mods/profile/edit_artist/dashboard.html'); 
    } 


    /**
     * Edit profile
     * @return void
     */
    public function Profile()
    {
	//deb(date('d-m-Y H:s:i', getEstTime()));
	
        $this->mSmarty->assign('module', 'profile');
		
		$rand_id = _v('rand_id', rand(100000, 999999));
        $this->mSmarty->assign('rand_id', $rand_id);
		
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
		
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
		
		$mem_act_tracks = array(1, 2, 3, 4, 5, 6, 7, 8, 9, '10+'); 		
		$this->mSmarty->assignByRef('mem_act_tracks', $mem_act_tracks);	

		$states_list = State::GetStates();
		$this->mSmarty->assignByRef('statesList', $states_list);			
		
        //genres list
        $genres_list = User::GetGenresList();
        $this->mSmarty->assignByRef('genres', $genres_list);

        //countries
        $countries = Countries::GetCountries($this->mCache);
        $this->mSmarty->assignByRef('countries', $countries);
		
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
                                $err['new_pass'] = 'THE_NEW_PASSWORD_MUST_NOT_MATCH_WITH_THE_OLD';
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
						/*//change primary email
						$primary_email = $fm['email']?$fm['email']:$fm['primary_email'];			
						foreach($altEmailTmp as $value)
						{
							if($value == $primary_email)
							{
								$_SESSION['system_login'] = $primary_email;
							 
								UserQuery::create()->select('Id')->filterById($this->mUser->mUserInfo['Id'])
						->update( array( 'Email' => $primary_email ));
							}
						}	*/
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
                        if ($err != ERR)
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

            include_once 'model/Valid.class.php';

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
                $errs['FirstName'] = MAX_FIRST_NAME_LENGTH_26_SYMBOLS;
            }

            if (!empty($fm['LastName']) && strlen($fm['LastName']) > 26)
            {
                $errs['LastName'] = MAX_LAST_NAME_LENGTH_26_SYMBOLS;
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
                    $errs['Name'] = MAX_USERNAME_LENGTH_40_SYMBOLS;
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
			if($fm['UserPhone'])
			{	
				$user_phone = Valid::Integer($fm, 'UserPhone');
	
				if (empty($user_phone))
				{
					$errs['UserPhone'] = PLEASE_SPECIFY_USER_PHONE_NUMBER_AS_INTEGER;
				}
			}
			if($fm['zip'])
			{	
				$zip = Valid::Integer($fm, 'zip');
	
				if (empty($zip))
				{
					$errs['zip'] = PLEASE_SPECIFY_USER_ZIP_CODE_AS_INTEGER;
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


            if (empty($errs))
            {
                //dob
                $month = (isset($fm['mm']) && isset($dd[$fm['mm']])) ? $fm['mm'] : 0;
                $day = (isset($fm['dd']) && isset($dd[$fm['dd']])) ? $fm['dd'] : 0;
                $year = (isset($fm['yy']) && isset($yy[$fm['yy']])) ? $fm['yy'] : 0;
                $dob = $year . '-' . ($month < 10 ? '0' . $month : $month) . '-' . ($day < 10 ? '0' . $day : $day);

                $record_label       = !empty($fm['RecordLabel']) ? serialize($fm['RecordLabel']) : '';
                $record_label_link  = !empty($fm['RecordLabelLink']) ? serialize($fm['RecordLabelLink']) : '';
//deb($fm);
				$member = isset($fm['Members']) ? $fm['Members'] : '';
				$track = isset($fm['Tracks']) ? $fm['Tracks'] : '';
				
				
				if($member || $track)
				{
					$memTrack = array($member, $track);
					$members_tracks  = serialize($memTrack);
				}
				else
					$members_tracks ='';
					
					
                $up = array(
                    'FirstName' => $fm['FirstName'],
                    'LastName' => $fm['LastName'],
                    'Name' => $fm['Name'],
                    'Dob' => $dob,
                    'Location' => !empty($fm['Location']) ? strip_tags($fm['Location']) : '',
                    'Likes' => !empty($fm['Likes']) ? trim(strip_tags($fm['Likes'])) : '',
                    'About' => !empty($fm['About']) ? trim(strip_tags($fm['About'])) : '',
                    'Gender' => (!empty($fm['Gender']) && in_array($fm['Gender'], array(1, 2))) ? $fm['Gender'] : 0,
                    'BandName' => Valid::String($fm, 'BandName'),
                    'YearsActive' => Valid::String($fm, 'YearsActive'),
                    'Genres' => implode(',', $genres),
                    'Members' => $members_tracks,
                    'Website' => str_replace('http://', '', check_valid_url(Valid::String($fm, 'Website'))),
                    'HashTag' => $fm['HashTag'],
                    'Bio' => Valid::String($fm, 'Bio'),
                    'RecordLabel' => $record_label,
                    'RecordLabelLink' => $record_label_link,
					'State' => $fm['State'],
                    'Location' => Valid::String($fm, 'Location'),
                    'UserPhone' => $fm['UserPhone']
                );

                UserQuery::create()->select(array('Id'))->filterById($this->mUser->mUserInfo['Id'])->update($up);

                //uni_redirect(PATH_ROOT . 'artist/profile?confirm=1');
				  setRedirect(PATH_ROOT . 'artist/profile?confirm=1');				

            }
            else
            {
                $this->mSmarty->assignByRef('errs', $errs);
                $this->mSmarty->assignByRef('fm', $fm);
            }
        }
        else
        {
            if (!empty($this->mUser->mUserInfo['RecordLabel']))
            {
                $this->mUser->mUserInfo['RecordLabel'] =  @unserialize($this->mUser->mUserInfo['RecordLabel']);
            }
            
            if (!empty($this->mUser->mUserInfo['RecordLabelLink']))
            {
                $this->mUser->mUserInfo['RecordLabelLink'] =  @unserialize($this->mUser->mUserInfo['RecordLabelLink']);
            }

            if (!empty($this->mUser->mUserInfo['Genres']))
            {
                $this->mUser->mUserInfo['Genres'] = make_array_keys_1( explode(',', $this->mUser->mUserInfo['Genres']) );
            }

			$fm = $this->mUser->mUserInfo;

            $this->mSmarty->assignByRef('fm', $fm);
        }
		$confirm = _v('confirm', 0);
//deb($fm);		
        $this->mSmarty->assign('confirm', $confirm);
        $this->mSmarty->display('mods/profile/edit_artist/profile_data.html');
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
		
		//$reSizeToWidthImage	=	$thumbImage->resizeImage(135,110,true,'',false);
						
		include_once 'libs/Crop/Image_Transform.php';
		include_once 'libs/Crop/Image_Transform_Driver_GD.php';
							
		$rand = rand(100, 9999);
		
		/*$crop_fnamem = 'files/images/avatars/m_user_'.$this->mUser->mUserInfo['Id'].$rand.'.jpg';		
		if($newImage) {
			include_once 'libs/Crop/class.image.php';
			$thumbImage = new simpleImage();
			$thumbImage->load($newImage);
			$thumbImage->resizeImage(135,110,false);
			$thumbImage->saveThumb($crop_fnamem);			
		}*/
		
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
		$mesg = I_HAVE_CHANGED_MY_PROFILE_PHOTO;
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
					UserQuery::create()->select(array('Id', 'Avatar'))
						->filterById($this->mUser->mUserInfo['Id'])
						->update(array('Avatar' => 'user_'.$this->mUser->mUserInfo['Id'].$rand.'.jpg'));
		
					$phId = Photo::AddPhoto($this->mUser->mUserInfo['Id'], $album_id, $image, $sld, 0, PROFILE_PICTURES, '',  1);
					$link = '/base/profile/showPhotoOne?id='.$phId.'';				
					$wallId	=	Wall::Add( $this->mUser->mUserInfo['Id'], $this->mUser->mUserInfo['Id'], $mesg, $crop_fnamem, '', 0, $this->mCache, $link );

					Photo::UpdatePhotoWallId($phId, $wallId);								
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


    /**********************
     *        Events
     ***********************/ 

    /**
     * Events list
     */
 
    public function Events()
    {
        $id = _v('id', 0);
		$ajaxMode =_v('ajaxMode', 0);
		$this->mSmarty->assign('event_finished', _v('event_finished', 0));
		
        $this->mSmarty->assign('module', 'events');
		
		//Change event status  as finished if the broadcast time is expired
		Event::FinishEventNotBroadcasted($this->mUser->mUserInfo['Id']);
			
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
				
        if (!$id)
        {
            //show events list
            $page = _v('page', 1);
            $pcnt = 10;
            $df = _v('df', 'tm');
            $df = !in_array($df, array('tw', 'nw', 'tm', 'nm', 'up', 'all','pa')) ? '' : $df;
			
			// today event is not shoing  by defualt start			
			if($df=='') 
			{
            	$df = 'up';			
			}

			// today event is not shoing  by defualt start			
			$this->mSmarty->assignByRef('df', $df);
            $this->mSmarty->assign('event_added', _v('event_added', 0));			
            $this->mSmarty->assign('event_type', _v('event_type', 1));

            $rcnt = Event::EventsCount( $this->mUser->mUserInfo['Id'], Event::GetPeriod($df), '', '', '', $df  );
            $events = Event::EventsList( $this->mUser->mUserInfo['Id'], $page, $pcnt, Event::GetPeriod($df) ,'','','','','','' ,$df );
			
			include_once 'model/Pagging.class.php';
			$link = 'oUsers.Event';
			
			$mpg = new Pagging($pcnt, $rcnt, $page, $link);

			$res['pagging'] = $mpg->Make($this->mSmarty, 1);
			$res['page'] = $page;
						
			$this->mSmarty->assignByRef('pagging', $res['pagging']);			
            $this->mSmarty->assignByRef('events', $events);
			
			
			if($_REQUEST['ajaxMode'])
			{
				$res['q'] = OK;
				$res['data'] = $this->mSmarty->fetch('mods/profile/edit_artist/ajax/event_list.html');			
				
				echo json_encode($res);
				exit();	
			}
			$this->mSmarty->display('mods/profile/edit_artist/events.html'); 
        }   
        else
        {					
            //show one event
            $event = Event::GetEvent($id, $this->mUser->mUserInfo['Id']);

            if (empty($event))
            {
                uni_redirect( PATH_ROOT . 'artist/events' );
            }

			$this->mSmarty->assign('smodule', 'broadcast');
            $this->mSmarty->assignByRef('event', $event);
			
			if($ajaxMode)
			{
				$res['q'] = OK;
				if($ajaxMode ==1)
				{					
					$video = EventVideo::GetListEventVideo($id);
					$this->mSmarty->assignByRef('recordings', $video);
					
					$res['data'] = $this->mSmarty->Fetch('mods/profile/edit_artist/ajax/event_broadcast.html');
				}
				else
				{
					$this->mSmarty->assign('smodule', 'viewers');
					
					$viewers = BroadcastViewers::GetListViewersReport($this->mUser->mUserInfo['Id'], $id);
					$broadcastTime = BroadcastFlows::GetEventFirstFlowDate($this->mUser->mUserInfo['Id'], $id);
					$this->mSmarty->assignByRef('broadcastTime', $broadcastTime);
					$viewers = BroadcastViewers::ViewersReportList($this->mUser->mUserInfo['Id'], $id);
					$totalPrice =0;
					foreach($viewers['list'] as $val)
					{
						$totalPrice += $val['Price'];
						$title		 = $val['Title'];
						$Pdate		 = $val['Pdate'];
					}
					
					$this->mSmarty->assign('totalPrice', $totalPrice);
					
					$this->mSmarty->assignByRef('viewers', $viewers['list']);
					$this->mSmarty->assignByRef('title', $title);					
					$this->mSmarty->assignByRef('Pdate', $Pdate);										
					
					$res['data'] = $this->mSmarty->Fetch('mods/profile/edit_artist/ajax/broadcast_viewers.html');
					
										
				}
				echo json_encode($res);
				exit();	
								
			}
            if($event['EventType'] != LIVE_EVENT && $event['Status'] == 4)
            {
                //get broadcast recordings list
                $video = EventVideo::GetListEventVideo($id);
                $this->mSmarty->assignByRef('recordings', $video);
            }

			//deb(BroadcastViewers::ViewersReportList($this->mUser->mUserInfo['Id'], $id));
            $this->mSmarty->assignByRef('event', $event);
            //$this->mSmarty->display('../../skin/mods/profile/edit_artist/event_one.html'); 
            $this->mSmarty->display('mods/profile/edit_artist/event_one.html'); 			
        }
    }

    
    /**
     * Calendar of events
     */
    public function EventCalendar()
    {
        $this->mSmarty->assign('module', 'events');
        //selected date
        $month = _v('month', date('n'));
        $year = _v('year', date('Y'));

		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
		
        $this->mSmarty->assign('month', $month);
        $this->mSmarty->assign('year', $year);

        //next month date
        $next_month = $month == 12 ? 1 : $month+1;
        $next_year = $month == 12 ? $year+1 : $year;
        //prev month date
        $prev_month = $month == 1 ? 12 : $month-1;
        $prev_year = $month == 1 ? $year-1 : $year;

        $this->mSmarty->assign('next_month', $next_year <= date('Y') ? '/artist/eventcalendar?month=' . $next_month . '&year=' . $next_year : '');
        $this->mSmarty->assign('prev_month', $prev_year >= date("Y")-2 ? '/artist/eventcalendar?month=' . $prev_month . '&year=' . $prev_year : '');

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
		
        $events_list = Event::EventsList( $this->mUser->mUserInfo['Id'], 0, 0, array('from' => date("Y-m-d H:i:s", $from), 'to' => date("Y-m-d H:i:s", $to)));
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
        $this->mSmarty->display('mods/profile/edit_artist/event_calendar.html');
    }


    /**
     * Add / Edit event 
     */ 
    public function EventEdit()
    {	
		$rand_id = _v('rand_id', rand(100000, 999999));
        $this->mSmarty->assign('rand_id', $rand_id);
		
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
				 
		$image = $this->mSession->Get('upl_photo_' . $rand_id);
		if (empty($id) && empty($image))
		{
			$errs['Image'] = PLEASE_UPLOAD_PHOTO_FILE;
		}
		
		$this->mSmarty->assign('module', 'events');
		$this->mSmarty->assign('duration', getTimeValueArray());
	
        $id = _v('id', 0);
		
	
        if ($id)
        {
            //get event
            $event = Event::GetEvent($id, $this->mUser->mUserInfo['Id']);
	
            if (empty($event))
            {
                $id = 0;
            }
            else
            {
                $dt = strtotime($event['EventDate']);
                $event['EventDate'] = date('m/d/Y', $dt);
                $event['EventTime'] = date('g:i A', $dt);
            }
/*            if(empty($event['Price']) && $event['EventType'] != LIVE_EVENT)
            {
                $event['PriceFree'] = 1;
            }*/
			 $event['PriceFree'] = 1;
        }

        //check form
        if (!empty($_POST['fm']))
        {
            $fm = $_POST['fm'];
            $errs = array();
			
            include_once 'model/Valid.class.php';

            //event date
            $event_date = Valid::Date($fm, 'EventDate');
            if (-1==$event_date)
            {
                $errs['EventDate'] = PLEASE_SPECIFY_EVENT_DATE;
            }
            elseif(-2==$event_date)
            {
                $errs['EventDate'] = WRONG_EVENT_DATE;
            } 
            
            //event time
            $event_time = Valid::Time($fm, 'EventTime'); 
            if ($event_time==-1)
            {
                $errs['EventTime'] = PLEASE_SPECIFY_EVENT_TIME;
            }
            elseif ($event_time==-2)
            {
                $errs['EventTime'] = WRONG_EVENT_TIME;
            }
            $fm['Title'] = Valid::String($fm, 'Title');
            if (empty($fm['Title']))
            {
                $errs['Title'] = PLEASE_SPECIFY_EVENT_TITLE;
            }

/*            $fm['EventType'] = Valid::Integer($fm, 'EventType');

			if(!$fm['EventType'])
			{*/
			$fm['EventType'] = ($event['EventType'])?$event['EventType']:ONLINE_EVENT;
//			}

			if(!$fm['Duration'] && $fm['EventType'] != LIVE_EVENT)
			{
				$fm['Duration'] = $event['Duration'];
			}			
			
			
/*            if (!$fm['EventType'] || !in_array($fm['EventType'], array(1, 2, 3)))
            {
                $errs['EventType'] = 'Please select event type'; 
            }
			if($fm['EventType'] > 1)
			{*/
				$fm['Price'] = Valid::Integer($fm, 'Price');

				if (empty($fm['Price']))
				{
					$errs['Price'] = PLEASE_SPECIFY_EVENT_PRICE;
				}
			//}
            $fm['TicketUrl'] = Valid::String($fm, 'TicketUrl');
            if (!empty($fm['TicketUrl']) && !check_valid_url($fm['TicketUrl']))
            {
			
                $errs['TicketUrl'] = PLEASE_SPECIFY_VALID_EVENT_URL;
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
					
                    $image = $fn;

				 	$imageLocation = BPATH.$dir .'/'.$image;
					$imgJpgName = getJpgFileName($image);
					
					
					$thumbLocation = MakeUserDir('files/photo/thumbs', $this->mUser->mUserInfo['Id']) . '/' . $fn;
					$midImgLocation = MakeUserDir('files/photo/mid', $this->mUser->mUserInfo['Id']) . '/' . $fn;
					$slideImgLocation = MakeUserDir('files/photo/slide', $this->mUser->mUserInfo['Id']) . '/' . $fn;
					
					include_once 'libs/Crop/class.image.php';
					$thumbImage = new simpleImage();
					$thumbImage->load($imageLocation);
					
					$x1 = $fm['x1'];								
					$y1 = $fm['y1'];
					$x2 = $fm['x2'];
					$y2 = $fm['y2'];
					
										
					//Crop Event Image for thumb
					if(file_exists($imageLocation))
					{
						$w = ($fm['w'])?$fm['w']:HOME_THUMB_EVENTS_WIDTH;								 
						$h = ($fm['h'])?$fm['h']:HOME_THUMB_EVENTS_HEIGHT;
						//Scale the image to the thumb_width set above
						$scale = HOME_THUMB_EVENTS_WIDTH/$w;
						$reSizeImage = $thumbImage->resizeThumbnailImage($thumbLocation, $w,$h,$x1,$y1,$scale);
					}
					
					//Crop Event Image for midium
					if(file_exists($imageLocation))
					{
						$w = ($fm['w'])?$fm['w']:HOME_MID_EVENTS_WIDTH;								 
						$h = ($fm['h'])?$fm['h']:HOME_MID_EVENTS_HEIGHT;
						//Scale the image to the thumb_width set above
						$scale = HOME_MID_EVENTS_WIDTH/$w;
						$reSizeImage = $thumbImage->resizeThumbnailImage($midImgLocation, $w,$h,$x1,$y1,$scale);
					}
					
					//Crop Event Image for slide
					if(file_exists($imageLocation))
					{
						$w = ($fm['w'])?$fm['w']:HOME_SLD_EVENTS_WIDTH;								 
						$h = ($fm['h'])?$fm['h']:HOME_SLD_EVENTS_HEIGHT;
						
						//Scale the image to the thumb_width set above
						$scale = HOME_SLD_EVENTS_WIDTH/$w;
						$reSizeImage = $thumbImage->resizeThumbnailImage($slideImgLocation, $w,$h,$x1,$y1,$scale);
					}
					
						
                    //delete tmp
				//	@unlink($imageLocation);					
                    $this->mSession->Del('upl_photo_' . $rand_id);
									

                }	
									
						
                if (!$id)
                {
                    //generate code
                    $code = $this->mUser->mUserInfo['Id'] . substr(md5(mktime() . rand(11, 99)), rand(0, 20), 10);
                    //Add event
                    $mEvent = new Event();
                    $mEvent->setUserId($this->mUser->mUserInfo['Id']);
                    $mEvent->setTitle(ucwords(strtolower($fm['Title'])));
                    $mEvent->setDescr( Valid::String($fm, 'Descr') );
                    $mEvent->setEventType( $fm['EventType'] );
                    $mEvent->setPrice($fm['Price']);//($fm['EventType'] == LIVE_EVENT || !empty($fm['PriceFree']) || empty($fm['Price'])) ? 0 : $fm['Price']);
                    $mEvent->setLocation( ucwords(strtolower(Valid::String($fm, 'Location'))));//($fm['EventType'] == ONLINE_EVENT) ? 'online only' : Valid::String($fm, 'Location') );
                    $mEvent->setEventDate( $event_date.' '.$event_time );
                    $mEvent->setCode($code);
					$mEvent->setTicketUrl($fm['TicketUrl']);
					$mEvent->setEventPhoto($image);	
					$mEvent->setDuration($fm['Duration']);	
					if($fm['Duration'] > 120)
					{
						$mEvent->setEventApp(0);	
					}
					else
					{
						$mEvent->setEventApp(1);						
					}
					
														
                    $mEvent->setPdate(mktime());
                    $mEvent->save();
                    $id = $mEvent->getId();
					$follow 	 = UserFollow::GetFollowersUserList($this->mUser->mUserInfo['Id'], USER_ARTIST);
					$fellow_fans = UserFollow::GetFollowersUserList($this->mUser->mUserInfo['Id'], USER_FAN);										
					$MailImages = Event::GetEvent($id);
					if($follow)
					{      		     
						foreach($follow as $followers)
						{
							$name = $followers['BandName'] ? $followers['BandName'] : $followers['FirstName'].' '.$followers['LastName'];														
							$this->mSmarty->assign('name', $name);  
							$this->mSmarty->assign('event', $fm);										
							$this->mSmarty->assign('userId',$this->mUser->mUserInfo['Id']);															
							$this->mSmarty->assign('artistName',$this->mUser->mUserInfo['Name']);	
							$this->mSmarty->assign('artistFirstName',$this->mUser->mUserInfo['FirstName']);																						
							$this->mSmarty->assign('artistlastName',$this->mUser->mUserInfo['LastName']);																											
							$this->mSmarty->assign('artistBandName',$this->mUser->mUserInfo['BandName']);							
							$this->mSmarty->assign('event_date', $event_date);																									
							$this->mSmarty->assign('event_time', $event_time);	
							$this->mSmarty->assign('MailInfo', $MailImages);							
							$this->mSmarty->assign('Image', ROOT_HTTP_PATH.'/files/photo/mid/'.$MailImages['UserId'].'/'.$MailImages['EventPhoto']);
							
							$fromEmail = ADMIN_EMAIL;
							$fromName = SITE_NAME;							
							$toEmail = $followers['Email'];
							$toName = $name ;
							
							if( $this->mUser->mUserInfo['BandName']) {
							$subjectName =  $this->mUser->mUserInfo['BandName'];
							}else{
							$subjectName =  $this->mUser->mUserInfo['FirstName'].'  '.$this->mUser->mUserInfo['LastName'];		
							}														
							$subject = $subjectName." has added a new event!";
							$message = $this->mSmarty->fetch('mails/event_add_notification.html');

							sendEmail($fromEmail,$fromName, $toEmail, $toName, $subject, $message);
						}
					}
					if($fellow_fans){
						foreach($fellow_fans as $fellow_fanslist){
							$name = $fellow_fanslist['BandName'] ? $fellow_fanslist['BandName'] : $fellow_fanslist['FirstName'].' '.$fellow_fanslist['LastName'];																			
							$this->mSmarty->assign('name', $name);
							$this->mSmarty->assign('event', $fm);
							$this->mSmarty->assign('userId',$this->mUser->mUserInfo['Id']);
							$this->mSmarty->assign('artistName',$this->mUser->mUserInfo['Name']);
							$this->mSmarty->assign('artistFirstName',$this->mUser->mUserInfo['FirstName']);
							$this->mSmarty->assign('artistlastName',$this->mUser->mUserInfo['LastName']);
							$this->mSmarty->assign('artistBandName',$this->mUser->mUserInfo['BandName']);
							$this->mSmarty->assign('event_date', $event_date);
							$this->mSmarty->assign('event_time', $event_time);
							$this->mSmarty->assign('MailInfo', $MailImages);
							$this->mSmarty->assign('Image', ROOT_HTTP_PATH.'/files/photo/mid/'.$MailImages['UserId'].'/'.$MailImages['EventPhoto']);
							$fromEmail = ADMIN_EMAIL;
							$fromName = SITE_NAME;
							$toEmail = $fellow_fanslist['Email'];
							$toName = $name;
							if( $this->mUser->mUserInfo['BandName']) {
							$subjectName =  $this->mUser->mUserInfo['BandName'];
							}else{
							$subjectName =  $this->mUser->mUserInfo['FirstName'].'  '.$this->mUser->mUserInfo['LastName'];		
							}							
							$subject = $subjectName." has added a new event!";							
							$message = $this->mSmarty->fetch('mails/event_add_notification.html');
							sendEmail($fromEmail,$fromName, $toEmail, $toName, $subject, $message);
						}					
					}				 
				 //					
                    //clear artist events cache
                    $this->mCache->set('events_onwall' . $this->mUser->mUserInfo['Id'], '', 1);
                    uni_redirect( PATH_ROOT . 'artist/events?event_added=' . $id.'&event_type='.$fm['EventType']);
                }   
                else
                {

                    $up = array(
                    'Title' => ucwords(strtolower($fm['Title'])),
                    'Descr' => Valid::String($fm, 'Descr'),
                    'EventType' => $fm['EventType'],
                    'Price'  => $fm['Price'], //($fm['EventType'] == LIVE_EVENT || !empty($fm['PriceFree']) || empty($fm['Price'])) ? 0 : $fm['Price'],
                    'Location' => ucwords(strtolower(Valid::String($fm, 'Location'))),//($fm['EventType'] == ONLINE_EVENT) ? 'online only' : Valid::String($fm, 'Location'),
					'TicketUrl' => $fm['TicketUrl'],
                    'EventDate' => $event_date.' '.$event_time,
					'Duration' => $fm['Duration'],
					'EventApp' => ($fm['Duration'] > 120 && $fm['EventApp']==0)?0:1);
					

					
					if($image)
					{
						$up = array_merge($up, array('EventPhoto' =>$image));
                    }
					
                    EventQuery::create()->select('Id')->filterById($id)->update( $up );
                    //clear artist events cache
                    $this->mCache->set('events_onwall' . $this->mUser->mUserInfo['Id'], '', 1);
                    uni_redirect( PATH_ROOT . 'artist/events' ); 
                } 
            } 

            $this->mSmarty->assignByRef('fm', $fm);
            $this->mSmarty->assignByRef('errs', $errs);

        }
        elseif ($id)
        {
            $this->mSmarty->assignByRef('fm', $event);
        }
			$thumb_width = HOME_SLD_EVENTS_WIDTH;
			$thumb_height = HOME_SLD_EVENTS_HEIGHT;
			$ratio = $thumb_height / $thumb_width;
			$this->mSmarty->assign('tHeight', $thumb_height);
			$this->mSmarty->assign('tWidth', $thumb_width);
			$this->mSmarty->assign('ratio', $ratio);
	        $this->mSmarty->assign('SITE_NAME', SITE_NAME);			
         
        $this->mSmarty->assign('id', $id);
        $this->mSmarty->display('mods/profile/edit_artist/edit_event.html'); 
    }

    /**
     * Announce event to fans
     */
    public function EventAnnounce()
    {
        $id = _v('id', 0);
        $json = _v('json', 0);
        
        $event = Event::GetEvent($id);

        $res = array('q' => 'ok', 'errs' => array());
        if (!empty($event) && $event['Status'] == 1)
        {
  		
            $mesg = 'New ' . ($event['EventType']==1 ? 'live' : ($event['EventType']==2 ? 'stream' : 'online')) . ' event ';
            /*
			$mesg .= ' "<a href="http://'.DOMAIN.'/u/' . $this->mUser->mUserInfo['Name'] . '/events/' . $event['Id'] . '">' . $event['Title'] . '</a>"';
			*/
			$link = ' http://'.DOMAIN.'/u/' . $this->mUser->mUserInfo['Name'] . '/events/' . $event['Id'];
			$mesg .= $event['Title'];
            if($event['EventType'] != ONLINE_EVENT)
            {
                $mesg .= ' in ' . $event['Location'];
            }
            $mesg .= ' on ' . date('m/d/Y \a\t g:i A', strtotime($event['EventDate']));
			$mesg .= $link;
            
			$wallLink = '/u/' . $this->mUser->mUserInfo['Name'] . '/events/' . $event['Id'];
			
			$wallDate = date('M d,Y \| l g:i A', strtotime($event['EventDate']));

			$eventType = ($event['EventType']==1 ? 'Live Event' : ($event['EventType']==2 ? 'Stream Event' : 'Online Event'));

							
		 	 $wallMesg ='<a href="'.$wallLink.'" >'.I_HAVE_CREATED_AN_EVENT.'</a> 
			 	<p class="wallEvent font12"><a href="'.$wallLink.'" class="LF"> <img width="100" vspace="5" hspace="5" align="left" alt="" src="/files/photo/thumbs/'.$this->mUser->mUserInfo['Id'].'/'.$event['EventPhoto'].'" style="" class="prof-Img"></a><a href="'.$wallLink.'" class="black">'.substr($event['Title'], 0, 125).'</a><a href="'.$wallLink.'" class="block black bold">'.($event['EventType']==1 ? 'Live Event' : ($event['EventType']==2 ? 'Stream Event' : 'Online Event')).'</a> <a href="'.$wallLink.'" class="block black" >'.$wallDate.'</a></p>';

            Wall::Add( $this->mUser->mUserInfo['Id'], $this->mUser->mUserInfo['Id'], $wallMesg,'','', 0, $this->mCache );
         
		  /*  //re-post to twitter
            if (!empty($this->mUser->mUserInfo['TwOauthToken']) && !empty($this->mUser->mUserInfo['TwOauthTokenSecret']))
            {
                require_once('libs/twitteroauth/twitteroauth.php');
                $tweet = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, $this->mUser->mUserInfo['TwOauthToken'], $this->mUser->mUserInfo['TwOauthTokenSecret']);
				
				//start 	
                          
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
							
				$code = $tweet->post('https://api.twitter.com/1.1/statuses/update_with_media.json',
									  array(
										'media[]'  => '/files/photo/thumbs/'.$this->mUser->mUserInfo['Id'].'/'.$event['EventPhoto'].'',
										'status'   => $mesg // Don't give up..
									  ),
									  true, // use auth
									  true  // multipart
				);

				 var_dump($code); die;
				if ($code == 200) 
				{
					echo "OK";
				  deb(json_decode($tweet->response['response']));
				} 
				else 
				{
					echo "ERROR";
					  deb($tweet->response['response']);
				}
				//end
				
				
                //$tweet->post('statuses/update', array('status' => $mesg));
            }*/
            //re-post to facebook
            if (!empty($this->mUser->mUserInfo['FbId']))
            {
                require_once 'libs/facebook-php-sdk/src/facebook.php';
                $facebook = new Facebook(array('appId'  => FACEBOOK_API_ID, 'secret' => FACEBOOK_API_SECRET));
                $token = !empty($this->mUser->mUserInfo['FbToken']) ? $this->mUser->mUserInfo['FbToken'] : $facebook->getAccessToken();
                try
                {
                    $facebook->api('/'.$this->mUser->mUserInfo['FbId'] . '/feed', 'POST', array('access_token' => $token, 'message' => $mesg, 'link' => $link));
                }
                catch(FacebookApiException $e)
                {
                }
            }
            //update event status
            EventQuery::create()->select(array('Id'))->filterById($id)->update(array('Status' => 2));
            $res['q'] = OK;
        }
        if($json)
        {
            echo json_encode($res);
            exit();
        }
        else
        {
            uni_redirect( PATH_ROOT . 'artist/events');
        }
    }

    /**
     * Remove event
     */
    public function EventRemove()
    {
        $this->mSmarty->assign('module', 'events');
        $id = _v('id', 0);
        
        if (!$id)
        {
            uni_redirect( PATH_ROOT . 'artist/events' );
        }

        if ($id)
        {
            //get event
            $event = Event::GetEvent($id, $this->mUser->mUserInfo['Id']);
            if (empty($event))
            {
                uni_redirect( PATH_ROOT . 'artist/events' );
            }
        }

        //delete
        EventQuery::create()->select('Id')->filterById($id)->delete();
        //clear artist events cache
        $this->mCache->set('events_onwall' . $this->mUser->mUserInfo['Id'], '', 1);
        uni_redirect( PATH_ROOT . 'artist/events' );
    }

    /**
     * Cancel event
     */
    public function EventCancel()
    {
        $id = _v('id', 0);
        $event = Event::GetEvent($id);

        $res = array('q' => OK, 'errs' => array());
        if (!empty($event) && $event['Status'] < 3)
        {
            //update event status
            EventQuery::create()->select(array('Id'))->filterById($id)->update(array('Status' => 3));

            //return money
            $purshased = EventPurchase::GetEventPurchased($id);
            foreach($purshased as $item)
            {
                //for artist transaction history
				
                $this->mUser->mUserInfo['Wallet'] = $this->mUser->mUserInfo['Wallet'] - $event['Price'];
				
				// for our  refference wallet block will be hiding this wallet block cause of functionality confusion
				
               // $this->mUser->mUserInfo['WalletBlock'] = $this->mUser->mUserInfo['WalletBlock'] - $event['Price'];
                Payout::PayoutMoney($this->mUser->mUserInfo['Id'], 0, 0, $event['Price'], $this->mUser->mUserInfo['Wallet'], $this->mUser->mUserInfo['Id'], 4, array('type' => 'event', 'id' => $event['Id'], 'title' => $event['Title'], 'user_id' => $item['UserId']));
                //for fan transaction history
                $user_balance = User::GetBalance($item['UserId']);
                $user_balance += $event['Price'];
                Payout::PayoutMoney($item['UserId'], 1, 0, $event['Price'], $user_balance, $this->mUser->mUserInfo['Id'], 4, array('type' => 'event', 'id' => $event['Id'], 'title' => $event['Title'], 'user_id' => $event['UserId']));
                //update user's wallet
                User::UpdateWallet($item['UserId'], $user_balance);
            }
            //update artist's wallet
            User::UpdateWallet($this->mUser->mUserInfo['Id'], $this->mUser->mUserInfo['Wallet'], $this->mUser->mUserInfo['WalletBlock']);

            //clear artist events cache
            $this->mCache->set('events_onwall' . $this->mUser->mUserInfo['Id'], '', 1);
            $res['q'] = OK;
        }
        echo json_encode($res);
        exit();
    }

    /**
     * Finish broadcast
     */
    public function EventFinish()
    {
        $id = _v('id', 0);
        $event = Event::GetEvent($id);

        $res = array('q' => OK, 'errs' => array());
        if (!empty($event) && $event['Status'] < 3 && $event['UserId'] == $this->mUser->mUserInfo['Id'])
        {
            //update event status
            EventQuery::create()->select(array('Id'))->filterById($id)->update(array('Status' => 4));
            //close flows of that broadcast
            BroadcastFlows::CloseEventFlows($event['Id']);
            //clean flow name in cache
            $this->mCache->set('broadcast_' . $event['Code'], '', 1);
			/*
            //get sum of purchase event
            $blocksum = EventPurchase::GetEventSum($event['Id']);

            //update artist wallet
            User::UpdateWallet($this->mUser->mUserInfo['Id'], $this->mUser->mUserInfo['Wallet'], $this->mUser->mUserInfo['WalletBlock']-$blocksum);
			*/
            //clear artist events cache
            $this->mCache->set('events_onwall' . $this->mUser->mUserInfo['Id'], '', 1);
            $res['id'] = $event['Id'];
            $res['q'] = OK;
        }
		else
		{
			$cache = $this->mCache->get('broadcast_u' . $this->mUser->mUserInfo['Name'], 4 * 3600);
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
				$this->mCache->set('broadcast_u' . $this->mUser->mUserInfo['Name'], '', 1);
				$this->mCache->set('events_onwall' . $this->mUser->mUserInfo['Id'], '', 1);
				
				$res['id'] = 1;
				$res['q'] = OK;
			}
		}
		echo json_encode($res);
        exit();

    }


    /**********************
     *        Music
     ***********************/ 

    /**
     * Artist music page
     * @return void
     */
    public function Music()
    {
	

        $this->mSmarty->assign('module', 'music');
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
				
        $id = _v('id', 0);
		$page = _v('page', 1);
		$redirect = _v('redirect', 0);
		
		if($redirect)
		{
			$redirectAlbumId = _v('albumId', 0);	
			$this->mSmarty->assignByRef('redirectAlbumId', $redirectAlbumId);
		}
		
        $pcnt = 10;
        if ($id)
        {
            $album = MusicAlbum::GetAlbum( $id, 0, 1);
			
            if (empty($album) || $album['Deleted']==1 || $album['UserId'] != $this->mUser->mUserInfo['Id'])
            {
                $id = 0;
                $album = array();
            } 
        }

        $this->mSmarty->assign('track_added', isset($_REQUEST['track_added']) ? 1 : 0);
        $this->mSmarty->assign('track_updated', isset($_REQUEST['track_updated']) ? 1 : 0);
        $this->mSmarty->assign('track_removed', isset($_REQUEST['track_removed']) ? 1 : 0);
        $this->mSmarty->assign('album_removed', isset($_REQUEST['album_removed']) ? 1 : 0);
        $this->mSmarty->assign('album_added', isset($_REQUEST['album_added']) ? 1 : 0);
        $this->mSmarty->assign('album_updated', isset($_REQUEST['album_updated']) ? 1 : 0);
		
		if (!$id)
        {
                        
     
          	$album = MusicAlbum::GetAlbumList($this->mUser->mUserInfo['Id'], $page, $pcnt ,0, 1, 0, 1);
		//	deb($album);
			$rcnt = MusicAlbum::GetAlbumCount($this->mUser->mUserInfo['Id'], 0);
		//	deb($rcnt);
			$this->mSmarty->assignByRef('albums', $album);
		  	
			// Pagging
			include_once 'model/Pagging.class.php';
			$link = PATH_ROOT . 'artist/music';
			$mpg = new Pagging($pcnt, $rcnt, $page, $link);
			
			$pagging = $mpg->Make2($this->mSmarty, 0, 1);
			$this->mSmarty->assignByRef('pagging', $pagging);
	
			$this->mSmarty->assign('page', $page);
			$this->mSmarty->assign('pcnt', $pcnt);

            //tracks without albums
            $this->mSmarty->assignByRef('tracks', Music::GetMusicList($this->mUser->mUserInfo['Id'], 0, 0));

            $this->mSmarty->display('mods/profile/edit_artist/music.html');
        }
        else
        {
			
            $tracks = $this->mSmarty->assignByRef('tracks', Music::GetMusicList($this->mUser->mUserInfo['Id'], $id, 0));
			$this->mSmarty->assignByRef('album', $album);
            $this->mSmarty->assign('id', $id);
            $this->mSmarty->display('mods/profile/edit_artist/music_album_social.html');
        }
		
		
    }

	public function PricedTracks()
	{
		$user_id = $this->mUser->mUserInfo['Id'];		
        $this->mSmarty->assign('module', 'music');
	    $this->mSmarty->assign('user_id', 'user_id');	

         $ui =& $this->mUser->mUserInfo;
		 $this->mSmarty->assign('ui', $ui);		 
		
	     $IsFollow1 = UserFollow::GetFollow($ui['Id'], $this->mUser->mOtherUserId);
		 if(empty($IsFollow1))
		 	{
				$IsFollow1	=	1;
			}
    	 $this->mSmarty->assign('IsFollow1', $IsFollow1);         			
		$page = _v('page', 1);
		$pcnt = 10;	
		$id = _v('id', 0);	
		if($id)
		{
			
			 MusicPurchase::PurchaseDeleteUpdate($user_id, $id);
			 
			$this->mSmarty->assignByRef('tracks', Music::GetPurchasedMusicList( $this->mUser->mUserInfo['Id'], 0, 0, 0, 1 ));
	
			$res['q'] = OK;
			
			$res['data'] = $this->mSmarty->Fetch('mods/profile/show_artist/ajax/pricedfilter_music.html');
			
        	echo json_encode($res);
			exit();			
		}
				$tracks 	=	Music::GetPurchasedMusicList( $this->mUser->mUserInfo['Id'], 0, 0, 0, 1 );

				$albumIds	=	'';//array();	
				
							
				foreach($tracks as $track)
				{
					if($track['Id'])
						{
							$albumIds .= $track['AlbumId'].',';
							
						}
			  }
					$albumIds = substr($albumIds, 0, -1);
					if($albumIds)
					{
						$albmIds = $albumIds;
					}else{
						$albmIds = 0;
					}

			$AlbumDetails =	Music::ShowAlbumsByMusicPurchaseId($this->mUser->mUserInfo['Id'],  $page, $pcnt , $albmIds, 1);

			$rcnt = $AlbumDetails['cnt'];
			$this->mSmarty->assignByRef('albums', $AlbumDetails);
			
			include_once 'model/Pagging.class.php';
			$link = PATH_ROOT . 'artist/music';
			$mpg = new Pagging($pcnt, $rcnt, $page, $link);
			
			$pagging = $mpg->Make2($this->mSmarty, 0, 1);
			$this->mSmarty->assignByRef('pagging', $pagging);
	
			$this->mSmarty->assign('page', $page);
			$this->mSmarty->assign('pcnt', $pcnt);
	   
        $this->mSmarty->assignByRef('tracks', Music::GetPurchasedMusicList( $this->mUser->mUserInfo['Id'], 0, 0, 0, 1 ));
        $this->mSmarty->display('mods/profile/edit_artist/pricedmusic.html');
        exit();
    }

	 /**
     * Show Artist music
     */	
	 
    public function ArtistMusicByAlbum()
    {
	    $this->mSmarty->assign('submodule', 'Music');
		
        $u_id = _v('u_id', 0);
 	    $a_id = _v('a_id', 0);
        if ($a_id)
        {
			
            //tracks
			$aid['a_id'] = $a_id;
			$this->mSmarty->assignByRef('aid' ,$aid);
			$this->mSmarty->assignByRef('tracks', Music::GetMusicList($this->mUser->mUserInfo['Id'], $a_id, 0 ));
			$album = $this->mSmarty->assignByRef('album', MusicAlbum::GetAlbum( $a_id ));
			//deb($album);
			$res['q'] = OK; 
			$res['data'] = $this->mSmarty->fetch('mods/profile/edit_artist/ajax/album_track.html');		
			
			echo json_encode($res);
			exit(); 
		}					
    }
	
	
	public function ArtistPurchasedMusicList()
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
			$res['data'] = $this->mSmarty->fetch('mods/profile/show_artist/ajax/priced_album_track.html');		
			
			echo json_encode($res);
			exit(); 
		}					
    }
	     
    /**
     * Add / Edit Album
     */
	 
    public function EditAlbum()
    {	
   	    $this->mSmarty->assign('module', 'music');
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
				
        $id = _v('id', 0);
        $rand_id = _v('rand_id', rand(100000, 999999));
		
        $this->mSmarty->assign('rand_id', $rand_id);
		
		include_once 'model/Valid.class.php';
		$getExtList = Valid::GetMusicExt();
		$validExt = '';
		foreach($getExtList as $val)
		{
			$validExt .='\''.$val.'\',';
		}
		$validExt = substr($validExt, 0, -1);		
		$this->mSmarty->assign('validExt', $validExt);
		
        //check album rights
        if ($id)
        {
			
            $album = MusicAlbum::GetAlbum( $id );
            if (empty($album) || $album['Deleted']==1 || $album['UserId'] != $this->mUser->mUserInfo['Id'])
            {
                $id = 0;
                $album = array();
            }
            if(empty($album['Price']))
            {
                $album['PriceFree'] = 1;
            }
        }


        if (!empty($_POST['fm']))
        {
            $fm = $_POST['fm'];
            $errs = array();
           
            include_once 'model/Valid.class.php';
			
		  //release date
            $date_release = Valid::Date($fm, 'DateRelease');
            if (-1==$date_release)
            {
                $errs['DateRelease'] = PLEASE_SPECIFY_RELEASE_DATE;
            }
            elseif(-2==$date_release)
            {
                $errs['DateRelease'] = WRONG_RELEASE_DATE;
            } 
            
			$fm['Title'] = Valid::String($fm, 'Title');
            //title
			if($fm['Title'])
			{
			     $mached = MusicAlbum::checkAlbumNameExist($this->mUser->mUserInfo['Id'], $fm['Title']);
				 if($mached == 1)
				 {
				 	$errs['Title'] = ALBUM_NAME_ALREADY_EXIST;
				 }
			}
			
            if (empty($fm['Title']))
            {
                $errs['Title'] = PLEASE_SPECIFY_ALBUM_TITLE;
            }
            
            if (empty($errs))
            {
                //image
                $image = $this->mSession->Get('upl_image_'.$rand_id);


                if (!empty($image))
                {
 
 				    include_once 'libs/Crop/Image_Transform.php';
                    include_once 'libs/Crop/Image_Transform_Driver_GD.php';
                    
                    $pathinfo = pathinfo($image);
                    $ext = ToLower($pathinfo['extension']);                   
				    $dir = MakeUserDir(TRACK_IMG_PATH, $this->mUser->mUserInfo['Id']);
                    $fn = substr(md5(mktime()), 0, 10) . date("hm") . '.' . $ext;
                    copy(BPATH . $image, BPATH . $dir . '/' . $fn);
					
                    $image = $fn;

				 	$imageLocation = BPATH.$dir .'/'.$image;
					$imgJpgName = getJpgFileName($image);
					
					$albumImgLocation = $dir .'/m_' .$imgJpgName;
					$expImgLocation = $dir.'/x_' .$imgJpgName;
					
					include_once 'libs/Crop/class.image.php';
					$thumbImage = new simpleImage();
					$thumbImage->load($imageLocation);
						
					$x1 = $_POST["x1"] ? $_POST["x1"] : 0;
					$y1 = $_POST["y1"] ? $_POST["y1"] : 0;
					$x2 = $_POST["x2"];
					$y2 = $_POST["y2"];

					
					/////Crop Album List Page Album Image
					if(file_exists($imageLocation))
					{
						$w = $_POST["w"] ? $_POST["w"] : ALBUM_IMG_WIDTH;
						$h = $_POST["h"] ? $_POST["h"] : ALBUM_IMG_HEIGHT;
						//Scale the image to the thumb_width set above
						$scale = ALBUM_IMG_WIDTH/$w;
						$reSizeImage = $thumbImage->resizeThumbnailImage($albumImgLocation, $w,$h,$x1,$y1,$scale);
					}
					/////Crop Album Image for Explore Music
					if(file_exists($imageLocation))
					{
						$w = $_POST["w"] ? $_POST["w"] : ALBUM_EXPLORE_WIDTH;
						$h = $_POST["h"] ? $_POST["h"] : ALBUM_EXPLORE_HEIGHT;
						//Scale the image to the thumb_width set above
						$scale = ALBUM_EXPLORE_WIDTH/$w;
						$reSizeImage = $thumbImage->resizeThumbnailImage($expImgLocation, $w,$h,$x1,$y1,$scale);
					}	
                    //delete tmp
					@unlink($imageLocation);					
                    $this->mSession->Del('upl_image_' . $rand_id);
									

                }	


                if (!$id)
                {
					//add new album
                    $mAlbum = new MusicAlbum();
                    $mAlbum->setUserId($this->mUser->mUserInfo['Id']);
                    $mAlbum->setTitle(ucwords(strtolower($fm['Title'])));
                    $mAlbum->setDescr(!empty($fm['Descr']) ? trim(strip_tags($fm['Descr'])) : '');
                    $mAlbum->setDateRelease($date_release);
                    $mAlbum->setImage( $imgJpgName );
                    $mAlbum->setPrice((!empty($fm['PriceFree']) || empty($fm['Price'])) ? 0 : $fm['Price']);
                    $mAlbum->setPdate( mktime() );
                   // $mAlbum->setActive( 0 ); // 0 on initial stage
				//	if($fm['Type'] == 1)
					//{
						$mAlbum->setActive( 1 ); // active pulished status for single music album 
					//}
                    $mAlbum->setAlbumPayMore(0);
					$mAlbum->setGenre(!empty($fm['Genre']) ? $fm['Genre'] : '');
					$mAlbum->setLabel(!empty($fm['Label']) ? $fm['Label'] : '');
					$mAlbum->setIsSingle($fm['Type']);					
					$mAlbum->save();
					$mAlbmId = $mAlbum->getId();
					
					if($fm['Type'] == 1)
					{
						$track = $this->mSession->Get('upl_track_' . $rand_id);
						$track_preview = $this->mSession->Get('upl_track_preview_' . $rand_id);
						
						$track_length = '';
						$track_preview_length = '';
						
						if ($track)
						{
							$dir = is_dir(VPATH . 'source') ? VPATH . 'source' : BPATH . MakeUserDir('files/track/u', $this->mUser->mUserInfo['Id']);
							$ext = ToLower(strrchr($track, '.'));
							$fn = substr(md5(uniqid(mt_rand(), true)), 0, 10). date("hm") . $ext;
							
							copy(BPATH . $track, $dir . '/' . $fn);
		
							//delete tmp
							@unlink(BPATH . $track);
							$this->mSession->Del('upl_track_' . $rand_id);
							
							//insert record to convertation table
							$conf = include(BPATH . 'dev/db/build/conf/artistfan-conf.php');
							$gPdo = new PDO(VBASE, $conf['datasources']['artistfan']['connection']['user'], $conf['datasources']['artistfan']['connection']['password']);
							$gPdo->query('SET CHARACTER SET utf8');
							$gPdo->query("INSERT INTO " . VTABLE . " (from_fname, to_fname, mp3) VALUES ('" . $fn . "', '" . $fn . ".mp3', 1)");
							$gPdo = null;
		
							$track = $fn;
							$status = 1; //send to convertation
							
						}
						if($track_preview)
						{
							$dir = is_dir(VPATH . 'source') ? VPATH . 'source' : BPATH . MakeUserDir('files/track/u', $this->mUser->mUserInfo['Id']);
							$ext = ToLower(strrchr($track_preview, '.'));
							$fn_preview = substr(md5(uniqid(mt_rand(), true)), 0, 10). date("hm") . $ext;
							copy(BPATH . $track_preview, $dir . '/' . $fn_preview);
							
							//delete tmp
							@unlink(BPATH . $track_preview);
							$this->mSession->Del('upl_track_preview_' . $rand_id);
							$track_preview = $fn_preview;
							
							//insert record to convertation table
							$conf = include(BPATH . 'dev/db/build/conf/artistfan-conf.php');
							$gPdo = new PDO(VBASE, $conf['datasources']['artistfan']['connection']['user'], $conf['datasources']['artistfan']['connection']['password']);
							$gPdo->query('SET CHARACTER SET utf8');
							$gPdo->query("INSERT INTO " . VTABLE . " (from_fname, to_fname, mp3) VALUES ('" . $fn_preview . "', '" . $fn_preview . ".mp3', 1)");
							$gPdo = null;
						}
						
							//add
							$mMusic = new Music();
							$mMusic->setUserId($this->mUser->mUserInfo['Id']);
							$mMusic->setTitle(ucwords(strtolower($fm['Title'])));
							$mMusic->setAlbumId($mAlbmId);
							$mMusic->setGenre( Valid::String($fm, 'Genre') );
							$mMusic->setDateRelease($date_release);
							$mMusic->setLabel( Valid::String($fm, 'Label') );
							$mMusic->setPrice((!empty($fm['PriceFree']) || empty($fm['Price'])) ? 0 : $fm['Price']);
							$mMusic->setTrack( $track );
							$mMusic->setTrackPreview( $track_preview );
							$mMusic->setPdate( mktime() );
							//$mMusic->setActive( !empty($fm['Active']) ? 1 : 0);
							$mMusic->setActive(1);
							$mMusic->setStatus( 1 );
							$mMusic->setUpcCode($fm['UpcCode']);
							$mMusic->setPayMore( 1 );
							$mMusic->save();
						
							//clear artist music cache
							$this->mCache->set('music_onwall' . $this->mUser->mUserInfo['Id'], '', 1);
							// uni_redirect(PATH_ROOT.'artist/music'.($fm['AlbumId'] ? '/' . $fm['AlbumId'] : '').'?track_added');  											
		}
		
					/* add album with single track end*/					
				if($fm['Type'] == 0)
				{						
                    //clear artist music cache
                    $this->mCache->set('music_onwall' . $this->mUser->mUserInfo['Id'], '', 1);
			  }	
					if($fm['Type'] == 1)
					{	
						setRedirect(ROOT_HTTP_PATH.'/artist/music?album_added');			
						//uni_redirect(PATH_ROOT.'artist/music?album_added'); 
					}
					else
					{
						setRedirect(ROOT_HTTP_PATH.'/artist/edittrack?albumId='.$mAlbmId);			
						//uni_redirect(PATH_ROOT.'artist/edittrack?albumId='.$mAlbmId); 
							 
					}  
                }
                else
                {
                    //edit
                    $up = array( 
                        'Title' => ucwords(strtolower($fm['Title'])),
                        'Descr' => !empty($fm['Descr']) ? trim(strip_tags($fm['Descr'])) : '',
                        'DateRelease' => $date_release,
                        'Price'  => (!empty($fm['PriceFree']) || empty($fm['Price'])) ? 0 : $fm['Price'],
                        'Active' => !empty($fm['Active']) ? 1 : 0,
						'AlbumPayMore' =>$fm['PayMore'] = 1,
						'Genre' => $fm['Genre'],
						'Label' => $fm['Label'],
						'IsSingle' => $fm['Type'],
                        );
					
                    if(!empty($image))
                    {
                        $up['Image'] = $imgJpgName;
                    }

                  	MusicAlbumQuery::create()->select('Id')->filterById($id)->update( $up );
				    if($up['IsSingle']==1)
					{
						$track = Music::GetMusicList($this->mUser->mUserInfo['Id'], $id);
						if($track[0]['Id'])
						{
							$trackId= $track[0]['Id'];
							
							   $up = array( 
								'Title' => ucwords(strtolower($fm['Title'])),
								'AlbumId' => $id, 
								'Genre' =>  Valid::String($fm, 'Genre'),
								'DateRelease' => $date_release,
								'Label'  => Valid::String($fm, 'Label'),
								'Price'  => (!empty($fm['PriceFree']) || empty($fm['Price'])) ? 0 : $fm['Price'],
								'Active' => !empty($fm['Active']) ? 1 : 0,
							);
							MusicQuery::create()->select('Id')->filterById($trackId)->update( $up );
					      }
					}
					
                    //clear artist music cache
                    $this->mCache->set('music_onwall' . $this->mUser->mUserInfo['Id'], '', 1);
                    uni_redirect(PATH_ROOT.'artist/music?album_updated');  
                }

            }  
            else
            {
                $this->mSmarty->assignByRef('errs', $errs);

               // $image = $this->mSession->Get('upl_image_'.$rand_id);
			
              /*  if (!empty($image))
                {
                   
					 $this->mSmarty->assignByRef('imageTemp', $image);
				
                }
               */
                $this->mSmarty->assignByRef('fm', $fm);


            }
        } 
        elseif ($id)
        {
            //edit data
            $album['DateRelease'] = date('m/d/Y', strtotime($album['DateRelease']));
            $this->mSmarty->assignByRef('fm', $album);
        }
		//deb($album);
		
		//genres list
        $genres_list = User::GetGenresList();
        $this->mSmarty->assignByRef('genres_list', $genres_list);

        $this->mSmarty->assign('id', $id);
        $this->mSmarty->display('mods/profile/edit_artist/music_edit_album.html');
    }    


    /**
     * Remove Album
     */
    public function RemoveAlbum()
    {
        //check album rights
        $id = _v('id', 0);
        if ($id)
        {
            $album = MusicAlbum::GetAlbum( $id );
            if (empty($album) || $album['UserId'] != $this->mUser->mUserInfo['Id'])
            {
                uni_redirect( PATH_ROOT . 'artist/music' );
            } 
        }
        $this->mSmarty->assign('module', 'music');


        //remove album (set flag "deleted" equal 1)
        MusicAlbumQuery::create()->select('Id')->filterById($id)->update(array('Deleted' => 1));
        //remove album tracks (set flag "deleted" equal 1)
        MusicQuery::create()->select('Id')->filterByAlbumId($id)->update(array('Deleted' => 1));
        //clear artist music cache
        $this->mCache->set('music_onwall' . $this->mUser->mUserInfo['Id'], '', 1);
        uni_redirect(PATH_ROOT.'artist/music?album_removed');  
    }


    /**
     * Upload image for album
     * @return void
     */
    public function UploadAlbumImage()
    {
        $this->mSmarty->assign('module', 'music');
        $rand_id = _v('rand_id', 0);
        
        include_once 'model/FileUpload.class.php';
        $mFu = new FileUpload(array('jpg', 'jpeg', 'gif', 'png'));

        //upload to tmp directory
        $result = $mFu->handleUpload( 'files/images/tmp/');

		$tmpFileName = 'files/images/tmp/'.$result['name'];
		list($width, $height) = getimagesize($tmpFileName);
		
		//print_r($width.'--'.$height);
		
		if($width < ALBUM_IMG_WIDTH || $height < ALBUM_IMG_HEIGHT){
			@unlink($tmpFileName);
			echo json_encode(array('success'=>false, 'message'=> ALBUM_IMAGE_SIZE_ERR));
			exit;
		}
		
        //crop to small size
        if (!empty($result['success']) && 1==$result['success'])
        {
            $this->mSession->Set( 'upl_image_'.$rand_id, $mFu->GetSavedFile() );
            $result['image'] = $mFu->GetSavedFile();
			
						
			include_once BPATH. 'libs/Crop/class.image.php';
			
			$imgObj = new simpleImage();
			$imgObj->load($result['image']);
			$imgObj->resizeToWidth(600);
			$imgObj->save($result['image']);
			
			$result['width'] = $imgObj->getWidth();
			$result['height'] = $imgObj->getHeight();
			
        }

        echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
        exit();
    }
	public function DeleteTrack()
	{
		$trackIdArr = $_POST['track'];
		if(empty($trackIdArr)){
			echo json_encode(array('success'=>false, 'message'=>PLEASE_SELECT_TRACKS_TO_DELETE));
			exit;
		}
		foreach($trackIdArr as $id){
			$music = Music::GetMusic( $id );
            if (empty($music) || $music['UserId'] != $this->mUser->mUserInfo['Id'])
            {
                echo json_encode(array('success'=>false, 'message'=>YOU_ARE_NOT_AUTHORIZED_TO_DELETE_THE_TRACK));
				exit;
            } 
			 MusicQuery::create()->select('Id')->filterById($id)->update(array('Deleted' => 1));
			//clear artist music cache
			$this->mCache->set('music_onwall' . $this->mUser->mUserInfo['Id'], '', 1);
		}
		MusicAlbum::UpdateAlbumPrice($music['AlbumId'], $price = 0);
		$album = MusicAlbum::GetAlbum($music['AlbumId'], 0, 1);
		$res['success'] = true;
		$res['price'] = round($album['TracksPrice'], 2);
		$res['trackCount'] = $album['Tracks'].' Track'.($album['Tracks'] > 1 ? 's':'');
		echo json_encode($res);
		exit;
	}
	
	public function deleteMusicAlbumTarck()
	{
		
		   $id = $_POST['delTrack'];
		   $music = Music::GetMusic( $id );
		   if (empty($music) || $music['UserId'] != $this->mUser->mUserInfo['Id'])
		   {
					echo json_encode(array('success'=>false, 'message'=>YOU_ARE_NOT_AUTHORIZED_TO_DELETE_THE_TRACK));
					exit;
		   } 
		   
			MusicQuery::create()->select('Id')->filterById($id)->update(array('Deleted' => 1));
			$this->mCache->set('music_onwall' . $this->mUser->mUserInfo['Id'], '', 1);
			MusicAlbum::UpdateAlbumPrice($music['AlbumId'], $price = 0);
			$album = MusicAlbum::GetAlbum($music['AlbumId'], 0, 1);
			$res['success'] = true;
			$res['price'] = round($album['TracksPrice'], 2);
			$res['trackCount'] = $album['Tracks'].' Track'.($album['Tracks'] > 1 ? 's':'');
			echo json_encode($res);
			exit;
	}
	
	
	public function SaveTrack()
	{
		
		$rand_id = _v('rand_id', rand(100000, 999999));
		$id = _v('id', 0);
		$Genres = urldecode(_v('Genres', ''));
			
        $fm = $_POST['fm'];
		
		include_once 'model/Valid.class.php';
            $errs = array();
            //title
            $fm['Title'] = Valid::String($fm, 'Title');
            if (empty($fm['Title']))
            {
                $errs['Title'] = PLEASE_SPECIFY_TRACK_TITLE;
            }
			
			// add multiple genres
			/*foreach($fm['Genre'] as $val)
			{
				$genresVal .=$val.','; 
			}*/
			//deb(substr($genresVal, 0, -1));
            if (empty($errs))
            {			
                //track
                $track = $this->mSession->Get('upl_track_' . $rand_id);
                $track_preview = $this->mSession->Get('upl_track_preview_' . $rand_id);
                
                $track_length = '';
                $track_preview_length = '';
                $this->mSmarty->assignByRef('Genres', $Genres);
                if ($track)
                {
					$dir = is_dir(VPATH . 'source') ? VPATH . 'source' : BPATH . MakeUserDir('files/track/u', $this->mUser->mUserInfo['Id']);
					$ext = ToLower(strrchr($track, '.'));
					$fn = substr(md5(uniqid(mt_rand(), true)), 0, 10). date("hm") . $ext;
                    copy(BPATH . $track, $dir . '/' . $fn);
                    //delete tmp
                    @unlink(BPATH . $track);
                    $this->mSession->Del('upl_track_' . $rand_id);
					//insert record to convertation table
                    $conf = include(BPATH . 'dev/db/build/conf/artistfan-conf.php');
                    $gPdo = new PDO(VBASE, $conf['datasources']['artistfan']['connection']['user'], $conf['datasources']['artistfan']['connection']['password']);
                    $gPdo->query('SET CHARACTER SET utf8');
                    $gPdo->query("INSERT INTO " . VTABLE . " (from_fname, to_fname, mp3) VALUES ('" . $fn . "', '" . $fn . ".mp3', 1)");
                    $gPdo = null;
                    $track = $fn;
                    $status = 1; //send to convertation
                }
				
                if($track_preview)
                {
					$dir = is_dir(VPATH . 'source') ? VPATH . 'source' : BPATH . MakeUserDir('files/track/u', $this->mUser->mUserInfo['Id']);
					$ext = ToLower(strrchr($track_preview, '.'));
					$fn_preview = substr(md5(uniqid(mt_rand(), true)), 0, 10). date("hm") . $ext;
                    copy(BPATH . $track_preview, $dir . '/' . $fn_preview);
					
                    //delete tmp
                    @unlink(BPATH . $track_preview);
                    $this->mSession->Del('upl_track_preview_' . $rand_id);
                    $track_preview = $fn_preview;
					
					//insert record to convertation table
                    $conf = include(BPATH . 'dev/db/build/conf/artistfan-conf.php');
                    $gPdo = new PDO(VBASE, $conf['datasources']['artistfan']['connection']['user'], $conf['datasources']['artistfan']['connection']['password']);
                    $gPdo->query('SET CHARACTER SET utf8');
                    $gPdo->query("INSERT INTO " . VTABLE . " (from_fname, to_fname, mp3) VALUES ('" . $fn_preview . "', '" . $fn_preview . ".mp3', 1)");
                    $gPdo = null;
                }
				
                if (!$id && $fm['AlbumId'])
                {
					$maxSortOrder = Music::GetMaxSortOder($fm['AlbumId']);
                    $mMusic = new Music();
                    $mMusic->setUserId($this->mUser->mUserInfo['Id']);
                    $mMusic->setTitle(ucwords(strtolower($fm['Title'])));
                    $mMusic->setAlbumId($fm['AlbumId']);
					$mMusic->setGenre($Genres);
                    $mMusic->setPrice(empty($fm['Price']) ? 0 : $fm['Price']);
                    $mMusic->setTrack($track);
                    $mMusic->setTrackPreview($track_preview);
                    $mMusic->setPdate(mktime());
                    $mMusic->setActive(1);
					$mMusic->setStatus(1);
					$mMusic->setUpcCode($fm['UpcCode']);
					$mMusic->setPayMore(1);
					$mMusic->setSortOrder($maxSortOrder);
                    $mMusic->save();
					
					
					$fm['Id'] = $mMusic->getId();
					$fm['SortOrder'] = $maxSortOrder;
                    //clear artist music cache
                    $this->mCache->set('music_onwall' . $this->mUser->mUserInfo['Id'], '', 1);
					MusicAlbum::UpdateAlbumPrice($fm['AlbumId'], $price = 0);
					$album = MusicAlbum::GetAlbum($fm['AlbumId'], 0, 1);
					$this->mSmarty->assign('album', $album);
					$this->mSmarty->assign('siNo', $album['Tracks']);
					$this->mSmarty->assign('track', $fm);
				
					$newTrack = $this->mSmarty->fetch('mods/profile/edit_artist/ajax/edit_track.html');
					$res['message'] = $newTrack;
					$res['success'] = true;
					$res['price'] = round($album['TracksPrice'], 2);
					$res['rand_id'] = _v('rand_id', rand(100000, 999999));
					$res['trackCount'] = $album['Tracks'].' Track'.($album['Tracks'] > 1 ? 's':'');
					echo json_encode($res);
					exit;
					//uni_redirect(PATH_ROOT.'artist/music'.($fm['AlbumId'] ? '/' . $fm['AlbumId'] : '').'?track_added');
                } else {
                    $up = array( 
							'Title' => ucwords(strtolower($fm['Title'])),
							'AlbumId' => $fm['AlbumId'], 
							'Genre' =>  $Genres,
							'DateRelease' => $date_release,
							'Label'  => Valid::String($fm, 'Label'),
							'Price'  => empty($fm['Price']) ? 0 : $fm['Price'],
							'Active' => 1,
							'UpcCode' => $fm['UpcCode'],
							'PayMore'	=> $fm['payMore'],
							'TrackLength' => '',
							'Status' => 1
                        );
					
                    if ($track)
                    {
                        $up['Track']  =  $track;
						$up['Status'] = 1;
                    }
                    if ($track_preview)
                    {
                        $up['TrackPreview']  =  $track_preview;
						$up['Status'] = 1;
                    }

                    MusicQuery::create()->select('Id')->filterById($id)->update( $up );    
                    //clear artist music cache
                    $this->mCache->set('music_onwall' . $this->mUser->mUserInfo['Id'], '', 1);
					$album = MusicAlbum::GetAlbum($fm['AlbumId'], 0, 1);
					
					//MusicAlbum::UpdateAlbumPrice($fm['AlbumId'], $price = 0);
					 $music = Music::GetMusic( $id );
					$this->mSmarty->assign('album', $album);
					$this->mSmarty->assign('siNo', $album['Tracks']);
					$this->mSmarty->assign('track', $music);
				
					$newTrack = $this->mSmarty->fetch('mods/profile/edit_artist/ajax/edit_ajax_file.html');
					$res['message'] = $newTrack;
					$res['success'] = true;
					$res['TrackPrice'] = number_format($music['Price'],2);
					$res['price'] = round($album['TracksPrice'], 2);
					$res['trackCount'] = $album['Tracks'].' Track'.($album['Tracks'] > 1 ? 's':'');
					echo json_encode($res);
					exit;				
					
					
                  //  uni_redirect(PATH_ROOT.'artist/music'.($fm['AlbumId'] ? '/' . $fm['AlbumId'] : '').'?track_updated');  
                }
				
            } else {
			    $this->mSmarty->assignByRef('errs', $errs);

                $track = $this->mSession->Get('upl_track_'.$rand_id);
                if (!empty($track))
                {
                    $fm['Track'] = $track;
                }
                $track_preview = $this->mSession->Get('upl_track_preview_'.$rand_id);
                if (!empty($track_preview))
                {
                    $fm['TrackPreview'] = $track_preview;
                }
                $this->mSmarty->assignByRef('fm', $fm);
				
           }
	}


    /**
     * Add / Edit Track
     */
    public function EditTrack()
    {
        $id = _v('id', 0);
        $album = _v('album', 0);
		$albumId = _v('albumId', 0);
	
        $rand_id = _v('rand_id', rand(100000, 999999));
        $this->mSmarty->assign('rand_id', $rand_id);
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
		include_once 'model/Valid.class.php';

		$getExtList = Valid::GetMusicExt();
		$validExt = '';
		foreach($getExtList as $val)
		{
			$validExt .='\''.$val.'\',';
		}
		$validExt = substr($validExt, 0, -1);	
		//deb($validExt);	
		$this->mSmarty->assign('validExt', $validExt);
		
		$price = MusicAlbum::GetAlbumPriceByTrack($albumId);
		if($price > 0){
			$this->mSmarty->assign('free', 0);
		} else {
			$this->mSmarty->assign('free', 1);
		}
        // check music rights
        if ($id)
        {	
            $music = Music::GetMusic( $id );
			$fm['Title'] = $music['Title'];
			$fm['Track'] = $music['Track'];
			$fm['TrackPreview'] = $music['TrackPreview'];
			$fm['Genre'] = $music['Genre'];
			$fm['Price'] = $music['Price'];
            if (empty($music) || $music['Deleted']==1 || $music['UserId'] != $this->mUser->mUserInfo['Id'])
            {
                $id = 0;
                $music = array();
            }
            if(empty($music['Price']))
            {
                $music['PriceFree'] = 1;
            }
        }
		
        $this->mSmarty->assign('module', 'music');
        $albums = MusicAlbum::GetAlbumList($this->mUser->mUserInfo['Id'], 0);
		$albums = make_assoc_array( $albums, 'Id' );
		$albumInfo = MusicAlbum::GetAlbum($albumId, 0, 1);
		if($albumInfo['Tracks'] > 0) {
			$trackList = MusicAlbum::GetAlbumTracks($albumId);
			$this->mSmarty->assign('trackList', $trackList);
		}
		if(!$fm['Genre']) {
			$Genres = $albumInfo['Genre'];
		}
        
        $genres_list = User::GetGenresList();
        $this->mSmarty->assignByRef('genres_list', $genres_list);
        $this->mSmarty->assign('id', $id);
        $this->mSmarty->assignByRef('albums', $albums);
        $this->mSmarty->assign('albumInfo', $albumInfo);
		$this->mSmarty->assign('albumPrice', $albumPrice);	
        if($albumId)
		{
			$fm['AlbumId'] = $albumId;
			$this->mSmarty->assignByRef('fm', $fm); 
			$this->mSmarty->assignByRef('Genres', $Genres); 
		}
		
		if($id)
		{
			$albumInfo = MusicAlbum::GetAlbum($music['AlbumId'], 0, 1);
			
			$music['AlbumPrice'] = $albumInfo['Price'];
			$music['DateRelease'] = date('m/d/Y', strtotime($music['DateRelease']));
			$this->mSmarty->assign('albumInfo', $albumInfo);
            $this->mSmarty->assignByRef('fm', $music);
			$this->mSmarty->assign('track', $music);
			$this->mSmarty->assignByRef('Genres', $music['Genre']); 
			//deb($music);
			$this->mSmarty->display('mods/profile/edit_artist/music_track_edit.html');
			exit();
		}
     	$this->mSmarty->display('mods/profile/edit_artist/music_edit_track.html');
    }
	
		
	
	
	
    /**
     * Upload image for album
     * @return void
     */
    public function UploadTrack()
    {
        $this->mSmarty->assign('module', 'music');

        $rand_id = _v('rand_id', 0);
        $preview = _v('preview', 0);

        include_once 'model/FileUpload.class.php';
        $mFu = new FileUpload(array(), MUSIC_FILE_SIZE);

        //upload to tmp directory
        $result = $mFu->handleUpload( 'files/track/tmp/');
	//	deb($result);

        //crop to small size
        if (!empty($result['success']) && 1==$result['success'])
        {
            if($preview)
            {
                $this->mSession->Set( 'upl_track_preview_'.$rand_id, $mFu->GetSavedFile() );
            }
            else
            {
                $this->mSession->Set( 'upl_track_'.$rand_id, $mFu->GetSavedFile() );
            }
            $result['track'] = $mFu->GetSavedFile();
        }

        echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
        exit();
    }

    
    /**
     * Remove Track
     */
    public function RemoveTrack()
    {
        //check music rights
        $id = _v('id', 0);
        if ($id)
        {
            $music = Music::GetMusic( $id );
            if (empty($music) || $music['UserId'] != $this->mUser->mUserInfo['Id'])
            {
                $id = 0;
                uni_redirect(PATH_ROOT.'artist/music');  
            } 
        }
        
        $this->mSmarty->assign('module', 'music');

        //remove track (set flag "deleted" equal 1)
        MusicQuery::create()->select('Id')->filterById($id)->update(array('Deleted' => 1));
        //clear artist music cache
        $this->mCache->set('music_onwall' . $this->mUser->mUserInfo['Id'], '', 1);
        uni_redirect(PATH_ROOT.'artist/music?track_removed');  
    }
    
    
    /**********************
     *        Video
     ***********************/ 

    /**
     * Artist video page
     * @return void
     */
	public function ArtisttwoartistVideoDelete()
	{
	
        $this->mSmarty->assign('module', 'video');

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
				
		if($delete_video_id)
		{
			 VideoPurchase::PurchaseDeleteUpdate($this->mUser->mUserInfo['Id'], $delete_video_id);			 

		    $this->mSmarty->assignByRef('videos', Video::GetPurchasedVideoList( $this->mUser->mUserInfo['Id'], 0 ));
			$res['q'] = OK;
			
			$res['data'] = $this->mSmarty->Fetch('mods/profile/edit_artist/ajax/pricedfilter_video.html');
			
        	echo json_encode($res);
			exit();			
		}
				
        if (!$id)
        {
            //video list
            $this->mSmarty->assignByRef('videos', Video::GetPurchasedVideoList( $this->mUser->mUserInfo['Id'], 0 ));
            //broadcast recordings
            //get events with purchased access
            $event_ids = Event::FinishedEventsPurchasedList($this->mUser->mUserInfo['Id']);
          
            $this->mSmarty->display('mods/profile/edit_artist/pricedvideo.html');
        }
        else
        {
            if(!$is_broadcasting)
            {
                //show one video
                $video = Video::GetVideoInfo($id, 0, 1);
                if (empty($video))
                {
                    uni_redirect( PATH_ROOT . 'artist/video' );
                }
                $video['VideoPurchase'] = VideoPurchase::Get($this->mUser->mUserInfo['Id'], $id);
                if(empty($video['VideoPurchase']))
                {
                    uni_redirect( PATH_ROOT . 'artist/video' );
                }
                $this->mSmarty->assignByRef('video', $video);
            }
            else
            {
                //show broadcasting recording
                $video = EventVideo::Get($id, 1);
                if(empty($video))
                {
                    uni_redirect( PATH_ROOT . 'artist/video' );
                }
                $video['VideoPurchase'] = EventPurchase::Get($this->mUser->mUserInfo['Id'], $video['EventId']);
                $video['Status'] = 2;
                $this->mSmarty->assignByRef('video', $video);
				$this->mSmarty->assign('broadcasting', 1);
            }
            $this->mSmarty->display('mods/profile/edit_artist/pricedvideo_one.html');
        }
        exit();
    
	} 
    public function Video()
    {	
		 $res = array('q' => OK);
        //main video page
        $this->mSmarty->assign('module', 'video');
				
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
						
		$page = _v('page', 1);
		$video_type = _v('video_type', _v('vt', 1));				
		$pcnt = _v('pcnt', !empty($_SESSION['vpcnt']) ? $_SESSION['vpcnt'] : 6);
        $_SESSION['vpcnt'] = $pcnt;
		
		$delete_video_id = _v('delete_video_id', 0);
				
		$this->mSmarty->assign('video_type', $video_type);
		
		if($delete_video_id)
		{
			 Video::DeleteVideoByArtist($delete_video_id);			 

			$videos = Video::GetEditArtistVideoList($this->mUser->mUserInfo['Id'], 1, $page, $pcnt, '', $video_type);
			
			$rcnt = $videos['rcnt'];
			$videos = $videos['list'];
			include_once 'model/Pagging.class.php';
			$link = 'oUsers.Video';
			$mpg = new Pagging($pcnt, $rcnt, $page, $link);
			$res['pagging'] = $mpg->Make($this->mSmarty, 1);
            $res['page'] = $page;
			$this->mSmarty->assignByRef('pagging', $res['pagging']);
            $this->mSmarty->assignByRef('videos', $videos);
			$res['data'] = $this->mSmarty->fetch('mods/profile/edit_artist/ajax/video.html');			
			echo json_encode($res);
			exit();			
		}
        $id = trim(strip_tags(_v('id', '')));
        $is_broadcasting = 0;
        if (!empty($id) && $id[0]=='b')
        {
            $is_broadcasting = 1;
            $id = substr($id, 1);
        }
        $id = (int)$id;
        $this->mSession->Del( 'upl_video_rnd' );
        $this->mSmarty->assign('video_added', isset($_REQUEST['video_added']) ? 1 : 0);
        $this->mSmarty->assign('video_updated', isset($_REQUEST['video_updated']) ? 1 : 0);
        $this->mSmarty->assign('video_removed', isset($_REQUEST['video_removed']) ? 1 : 0);
        if (!$id)
        {
            //video list			
			$videos = Video::GetEditArtistVideoList($this->mUser->mUserInfo['Id'], 1, $page, $pcnt, '', $video_type);
			$rcnt = $videos['rcnt'];
			$videos = $videos['list'];
			include_once 'model/Pagging.class.php';
			$link = 'oUsers.Video';
			$mpg = new Pagging($pcnt, $rcnt, $page, $link);
			$res['pagging'] = $mpg->Make($this->mSmarty, 1);
            $res['page'] = $page;
			$this->mSmarty->assignByRef('pagging', $res['pagging']);
            $this->mSmarty->assignByRef('videos', $videos);
			if($_REQUEST['page'])
			{
					$res['data'] = $this->mSmarty->fetch('mods/profile/edit_artist/ajax/video.html');
					echo json_encode($res);
					exit();
			} 
			else 
			{
            	$this->mSmarty->display('mods/profile/edit_artist/video.html');
			}
        }
        else
        {
            if(!$is_broadcasting)
            {
                //show one video			
                $video = Video::GetVideoInfoForArtist($id, 0, 1);					
				if($video['Status'] == 1 || $video['Status'] == 4)
				{
					$processingVideoList = Video::getProcessingVideoList($this->mUser->mUserInfo['Id'], 1 , 1);
					foreach($processingVideoList['list'] as &$prVideo){
						$prVideo['Pdate'] = videoProcessingTime($prVideo['Pdate']);
					}
					$this->mSmarty->assignByRef('processingVideo', $processingVideoList['list']);
					$musicVideo = Video::GetEditArtistVideoList($this->mUser->mUserInfo['Id'], 1);
					$this->mSmarty->assignByRef('musicVideo', $musicVideo['list']);
					$streamVideo = Video::GetEditArtistVideoList($this->mUser->mUserInfo['Id'], 1, '', '', '', RE_LIVE_STREAM);
					$this->mSmarty->assignByRef('streamVideo', $streamVideo['list']);			
					$vidCnt = Video::videoCount($id);
					$this->mSmarty->display('mods/profile/edit_artist/video_inprocess.html');
					exit();	
				}		
                if (empty($video) || $video['Deleted']==1)
                {
                    uni_redirect( PATH_ROOT . 'artist/video' );
                }
                $this->mSmarty->assignByRef('video', $video);
            }
            else
            {
                //show broadcasting recording
                $video = EventVideo::Get($id);
                if(empty($video))
                {
                    uni_redirect( PATH_ROOT . 'artist/video' );
                }
                $video['Status'] = 2;
                $this->mSmarty->assignByRef('video', $video);
				$this->mSmarty->assign('broadcasting', 1);
            }
			$musicVideo = Video::GetEditArtistVideoList($this->mUser->mUserInfo['Id'], 1);
			$this->mSmarty->assignByRef('musicVideo', $musicVideo['list']);
			$streamVideo = Video::GetEditArtistVideoList($this->mUser->mUserInfo['Id'], 1, '', '', '', RE_LIVE_STREAM);
			$this->mSmarty->assignByRef('streamVideo', $streamVideo['list']);			
			$vidCnt = Video::videoCount($id);
            $this->mSmarty->display('mods/profile/edit_artist/video_one.html');
        }
    }

    /**
     * Upload video file and save info to base
     * @return void
     */
    public function UploadVideo()
    {
        $this->mSmarty->assign('module', 'video');

        $rand_id = _v('rand_id', 0);
        $preview = _v('preview', 0);
        $id = _v('id', 0);

        include_once 'model/FileUpload.class.php';
        $mFu = new FileUpload(array(), VIDEO_FILE_SIZE);

        //upload to tmp directory
        $result = $mFu->handleUpload( 'files/video/tmp/');

        if (!empty($result['success']) && 1==$result['success'])
        {
            $result['video'] = $mFu->GetSavedFile();
            if($preview)
            {
                $this->mSession->Set( 'upl_video_preview_'.$rand_id, $result['video'] );
            }
            else
            {
                $this->mSession->Set( 'upl_video_'.$rand_id, $result['video'] );
            }
        }
        echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
        exit();
    }

     
    /**
     * Add / Edit video
     */
    public function EditVideo()
    {
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
			
        $id = _v('id', 0);
		include_once 'model/Valid.class.php';
		$getExtList = Valid::GetVideoExt();
		$validExt = '';
		foreach($getExtList as $val)
		{
			$validExt .='\''.$val.'\',';
		}
		$validExt = substr($validExt, 0, -1);		
		$this->mSmarty->assign('validExt', $validExt);						
        $rand_id = _v('rand_id', $this->mSession->Get( 'upl_video_rnd' ) ? $this->mSession->Get( 'upl_video_rnd' ) : rand(100000, 999999));
        $this->mSession->Set( 'upl_video_rnd', $rand_id );
        $this->mSmarty->assign('rand_id', $rand_id);
        $video = array();
        //check video rights
        if ($id)
        {
            $video = Video::GetVideoInfo( $id, '','', 1 );

            if (empty($video) || $video['Deleted']==1 || $video['UserId'] != $this->mUser->mUserInfo['Id'])
            {
                $id = 0;
                $video = array();
            }
            else if($video['Price'] == 0)
            {
                $video['PriceFree'] = 1;
				

		
            }
			$tDate = date('Y-m-d', strtotime("+1 day", getEstTime()));
			$vDate = $video['VideoDate'];
			
			if($tDate < $vDate)
			{
				$this->mSmarty->assign('editDate', 1);
			}			 			
		
        }
        $this->mSmarty->assign('module', 'video');

        if (!empty($_POST['fm']))
        {
            include_once 'model/Valid.class.php';
            $fm = $_POST['fm'];
            $errs = array();
			
			if($fm['VideoType']!=YT_VIDEO)
			{
				$video_m = $this->mSession->Get('upl_video_' . $rand_id);
				if(!$id && (empty($video_m) || !file_exists(BPATH . $video_m)))
				{
					$errs['video'] = PLEASE_UPLOAD_VIDEO_FILE;
				}
				else
				{
					$fm['Video'] = $video_m;
				}
				//title
				$fm['Title'] = Valid::String($fm, 'Title');
				if (empty($fm['Title']))
				{
					$errs['Title'] = PLEASE_SPECIFY_VIDEO_TITLE;
				}
			if(!$_POST['id'])
			{	
				$video_date = Valid::Date($fm, 'VideoDate');
				
				
				if (-1==$video_date)
				{
					$errs['VideoDate'] = PLEASE_SPECIFY_EVENT_DATE;
				}
				elseif(-2==$video_date)
				{
					$errs['VideoDate'] = WRONG_EVENT_DATE;
				}
			}

			if (empty($errs))
				{
					$status = !empty($video['Status']) ? $video['Status'] : 0;
				
					if($video_m)
					{
						$ext = ToLower(strrchr($video_m, '.'));
						$fn = substr(md5(uniqid(mt_rand(), true)), 0, 10). date("hm") . $ext;
						//substr(md5(mktime()), 0, 10) . date("hm") . $ext;
						$dir = is_dir(VPATH . 'source') ? VPATH . 'source' : BPATH . MakeUserDir('files/video/u', $this->mUser->mUserInfo['Id']);
						copy(BPATH . $video_m, $dir . '/' . $fn);
	
						//delete tmp
						@unlink(BPATH . $video_m);
						$this->mSession->Del('upl_video_' . $rand_id);
	
						//insert record to convertation table
						$conf = include(BPATH . 'dev/db/build/conf/artistfan-conf.php');
						$gPdo = new PDO(VBASE, $conf['datasources']['artistfan']['connection']['user'], $conf['datasources']['artistfan']['connection']['password']);
						$gPdo->query('SET CHARACTER SET utf8');
						$gPdo->query("INSERT INTO " . VTABLE . " (from_fname, to_fname, cdate, save_frames, in_proc, pdate) VALUES ('" . $fn . "', '" . $fn . ".mp4', 0, '15', 0, 0)");
						$gPdo = null;
						$video_m = $fn;
						$status = 1; //send to convertation
					}
	
					if (!$id)
					{
						//new video
						
						$mVideo = new Video();
						$mVideo->setUserId($this->mUser->mUserInfo['Id']);
						$mVideo->setTitle(ucwords(strtolower($fm['Title'])));
						$mVideo->setVideoDate($video_date);
						$mVideo->setPrice((!empty($fm['PriceFree']) || empty($fm['Price'])) ? 0 : $fm['Price']);						
						$mVideo->setStatus( 1 );						
						$mVideo->setVideo( $video_m );
						$mVideo->setVideoPreview( $video_pr );
						$mVideo->setPdate(mktime());
						$mVideo->setStatus( 1 );
						$mVideo->setActive( !empty($fm['Active']) ? 1 : 0);
						$mVideo->setPayMore(!empty($fm['payMore']) ? 1 : 0);	
						$mVideo->setVideoType($fm['VideoType']);
						$mVideo->save();
						$id = $mVideo->getId();
				
						//clear artist video cache
						$this->mCache->set('video_onwall' . $this->mUser->mUserInfo['Id'], '', 1);
						uni_redirect(PATH_ROOT.'artist/video/' . $id . '?video_added');
					}
					else
					{				
						//update video
						$up = array(
							'Title' => ucwords(strtolower($fm['Title'])),
							/*'VideoDate' =>	$VDate,*/
							'Price'  => (!empty($fm['PriceFree']) || empty($fm['Price'])) ? 0 : $fm['Price'],
							'Status' => $status,
							'Active' => !empty($fm['Active']) ? 1 : 0,
							'PayMore' => !empty($fm['payMore']) ? 1 : 0,
							'VideoType' =>$fm['VideoType']
						);
						if ($video_m)
						{
							$up['Video']  =  $video_m;
						}
						if ($video_pr)
						{
							$up['VideoPreview']  =  $video_pr;
						}

						VideoQuery::create()->select('Id')->filterById($id)->update( $up );
	
						//delete old video files, if exist
						include_once BPATH . 'libs/ftp/ftp.class.php';
						if($video_m && !empty($video['Video']))
						{
							$ftpServer = new Ftp(STREAMING_FTP_HOST, STREAMING_FTP_USER, STREAMING_FTP_PASSWORD);							
							$flashFile = '/flash/u/'. $video['UserId'].'/'.$video['Video'];
							$mobileFile = '/mobile/u/'. $video['UserId'].'/'.$video['Video'];
							$ftpServer->connect();
							$ftpServer->delete($flashFile);
							$ftpServer->delete($mobileFile);
							if(file_exists(BPATH . $video['Video']))
							{
								//old tmp file
								@unlink(BPATH . $video['Video']);
							}
							else if(file_exists(BPATH . 'files/video/u/' . $video['UserId'] . '/' . $video['Video']))
							{
								@unlink(BPATH . 'files/video/u/' . $video['UserId'] . '/' . $video['Video']);
								if(file_exists(BPATH . 'files/video/thumbnail/' . $video['UserId'] . '/' . $video['Video'] . '.jpg'))
								{
									//images
									@unlink(BPATH . 'files/video/thumbnail/' . $video['UserId'] . '/' . $video['Video'] . '.jpg');
									@unlink(BPATH . 'files/video/thumbnail/' . $video['UserId'] . '/s_' . $video['Video'] . '.jpg');
									@unlink(BPATH . 'files/video/thumbnail/' . $video['UserId'] . '/x_' . $video['Video'] . '.jpg');
								}
							}
						}
					
						//clear artist video cache
						$this->mCache->set('video_onwall' . $this->mUser->mUserInfo['Id'], '', 1);
	
						uni_redirect(PATH_ROOT.'artist/video/' . $id . '?video_updated');
					}
				}  
				else
				{
					$this->mSmarty->assignByRef('errs', $errs);
					$this->mSmarty->assignByRef('fm', $fm);
				}
			} 
			else
			{
	            $track = '';

				//title
				$fm['Title'] = Valid::String($fm, 'Title');
				if (empty($fm['Title']))
				{
					$errs['Title'] = PLEASE_SPECIFY_VIDEO_TITLE;
				}
			
			if(!$_POST['id'])
			{
				$video_date = Valid::Date($fm, 'VideoDate');			
				if (-1==$video_date)
				{
					$errs['VideoDate'] = PLEASE_SPECIFY_EVENT_DATE;
				}
				elseif(-2==$video_date)
				{
					$errs['VideoDate'] = WRONG_EVENT_DATE;
				}
			}	
				$fm['VideoCode'] = trim($fm['VideoCode']);
				$fm['VideoLink'] = Valid::String($fm, 'VideoLink');
				if(empty($fm['VideoCode']) && empty($fm['VideoLink']))
				{
					$errs['VideoCode'] = PLEASE_SPECIFY_VIDEO_CODE_OR_VIDEO_LINK;
					$errs['VideoLink'] = PLEASE_SPECIFY_VIDEO_CODE_OR_VIDEO_LINK;
				}
				if(empty($fm['VideoLink']))
				{	
                	$errs['VideoLink'] = PLEASE_SPECIFY_CORRECT_VIDEO_LINK;
				}
				if(!empty($fm['VideoLink']))
				{
	                if(preg_match('~(\.be/|/embed/|/v/|/watch\?v=)([A-Za-z0-9_-]{5,11})~', $fm['VideoLink'], $match))
					{
						$track = !empty($match[2]) ? $match[2] : '';
					}
					if(empty($track))
					{
						$errs['VideoLink'] = PLEASE_SPECIFY_CORRECT_VIDEO_LINK;
					}
				}
				if (empty($errs))
				{
					$this->mSmarty->assign('FromYt', 1);
					$this->mSmarty->assign('Video', $track);
							
					if (!$id)
					{
						//add
						$mVideo = new Video();
						$mVideo->setUserId($this->mUser->mUserInfo['Id']);
						$mVideo->setTitle(ucwords(strtolower($fm['Title'])));
						$mVideo->setVideoDate($video_date);						
						$mVideo->setPrice(0);
						$mVideo->setVideo( $track );
						$mVideo->setFromYt(1);
						$mVideo->setStatus(2);
						$mVideo->setPdate( mktime() );
						$mVideo->setActive( !empty($fm['Active']) ? 1 : 0);
						$mVideo->setVideoType($fm['VideoType']);
						$mVideo->save();
						$id = $mVideo->getId();				
						//clear artist video cache
						$this->mCache->set('video_onwall' . $this->mUser->mUserInfo['Id'], '', 1);
						uni_redirect(PATH_ROOT.'artist/video?video_added');
					}
					else
					{
						$track = explode('=', $fm['VideoLink']);
						//edit
						$up = array(
							'Title' => ucwords(strtolower($fm['Title'])),
							//'Video'  =>  $track,
							 'Video'  =>  $track[1] ? $track[1] : '',
							'Active' => !empty($fm['Active']) ? 1 : 0,
							'VideoType' =>$fm['VideoType']
						);
						VideoQuery::create()->select('Id')->filterById($id)->update( $up );
						//clear artist video cache
						$this->mCache->set('video_onwall' . $this->mUser->mUserInfo['Id'], '', 1);
						uni_redirect(PATH_ROOT.'artist/video?video_updated');
					}
				}
				else
				{
					$this->mSmarty->assignByRef('errs', $errs);
					$this->mSmarty->assignByRef('fm', $fm);
				}						
			
			}
        }
        else
        {
            //edit data
            $video_m = $this->mSession->Get('upl_video_' . $rand_id);
            if(!empty($video_m) && file_exists(BPATH . $video_m))
            {
                $video['Video'] = $video_m;
            }
            $video_pr = $this->mSession->Get('upl_video_preview_' . $rand_id);
            if(!empty($video_pr) && file_exists(BPATH . $video_pr))
            {
                $video['VideoPreview'] = $video_pr;
            }
		
            $this->mSmarty->assignByRef('fm', $video);
			//deb($video);
        }
        $this->mSmarty->assign('id', $id);

        $this->mSmarty->display('mods/profile/edit_artist/video_edit.html');
    }

  
    
    /**
     * Remove Video
     */
    public function RemoveVideo()
    {
        //check music rights
        $id = _v('id', 0);
        if ($id)
        {
            $video = Video::GetVideoInfo( $id );
            if (empty($video) || $video['UserId'] != $this->mUser->mUserInfo['Id'])
            {
                $id = 0;
                $album = array();
            } 
        }

        $this->mSmarty->assign('module', 'video');

        //remove track (set flag "deleted" equal 1)
        VideoQuery::create()->select('Id')->filterById($id)->update(array('Deleted' => 1));
        //clear artist video cache
        $this->mCache->set('video_onwall' . $this->mUser->mUserInfo['Id'], '', 1);
        uni_redirect(PATH_ROOT.'artist/video?video_removed');  
    }


    /**********************
     *        Funs
     ***********************/

    /**
     * Artist funs list
     */
    public function Fans()
    {
        //show followers list
        $this->mSmarty->assign('module', 'fans');

		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
		
        $page = _v('page', 1);
        $pcnt = 10;

        $rcnt = UserFollow::GetFollowersUserListCount($this->mUser->mUserInfo['Id'], USER_FAN);
        $users = UserFollow::GetFollowersUserList($this->mUser->mUserInfo['Id'], USER_FAN, $page, $pcnt);

        include_once 'model/Pagging.class.php';
        $link = PATH_ROOT . 'artist/fans';

        $mpg = new Pagging($pcnt, $rcnt, $page, $link);
        $pagging = $mpg->Make2($this->mSmarty, 0, 1);

        $this->mSmarty->assignByRef('pagging', $pagging);
        $this->mSmarty->assignByRef('users', $users);
        $this->mSmarty->assignByRef('countries', Countries::GetCountries($this->mCache));
       
        $this->mSmarty->display('mods/profile/edit_artist/fans.html');
    }

    /**********************
     *        Funs
     ***********************/

    /**
     * Artist funs list
     */
    public function FellowArtist()
    {
        //show followers list
        $this->mSmarty->assign('module', 'artist');
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
		
        $page = _v('page', 1);
        $pcnt = 10;

        $rcnt = UserFollow::GetFollowersUserCount($this->mUser->mUserInfo['Id'], USER_ARTIST);
        $users = UserFollow::GetFollowersUserList($this->mUser->mUserInfo['Id'], USER_ARTIST, $page, $pcnt);

        include_once 'model/Pagging.class.php';
        $link = PATH_ROOT . 'artist/fellowartist';

        $mpg = new Pagging($pcnt, $rcnt, $page, $link);
        $pagging = $mpg->Make2($this->mSmarty, 0, 1);

        $this->mSmarty->assignByRef('pagging', $pagging);
        $this->mSmarty->assignByRef('users', $users);
        $this->mSmarty->assignByRef('countries', Countries::GetCountries($this->mCache));
     
        $this->mSmarty->display('mods/profile/edit_artist/fellow_artist.html');
    }

    /**********************
     *        Settings
     ***********************/

    /**
     * User settings (change password && email)
     */
    public function Settings()
    {
        $this->mSmarty->assign('module', 'settings');
                //locations with count fans

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
		//$primary_email = '';
		//$this->mSmarty->assignByRef('primary_email', $primary_email);
		
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
						/*//change primary email
						$primary_email = $fm['email']?$fm['email']:$fm['primary_email'];			
						foreach($altEmailTmp as $value)
						{
							if($value == $primary_email)
							{
								$_SESSION['system_login'] = $primary_email;
							 
								UserQuery::create()->select('Id')->filterById($this->mUser->mUserInfo['Id'])
						->update( array( 'Email' => $primary_email ));
							}
						}	*/
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
                                $errs['tw_id'] = THAT_ACCOUNT_ALREADY_TAKEN;
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


        $this->mSmarty->display('mods/profile/edit_artist/settings.html');
        exit();
    }



    /**********************
     *        Wallet
     ***********************/


    /**
     * Show wallet page
     */ 
    public function Wallet()
    {
        $this->mSmarty->assign('module', 'wallet');
		
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
		
        //payouts list
        $page = _v('page', 1);
        $pcnt = 10;
        $status = 0;//pending

        $rcnt = Payout::PaymentsCount($this->mUser->mUserInfo['Id'], $status, 0);
        if ($rcnt)
        {
            $payouts = Payout::PaymentsList($this->mUser->mUserInfo['Id'], $status, '', 0, $page, $pcnt);
            $this->mSmarty->assignByRef('payouts', $payouts);
             
            include_once 'model/Pagging.class.php';
            $link = PATH_ROOT . 'artist/wallet';
            $mpg = new Pagging($pcnt, $rcnt, $page, $link);
            $pagging = $mpg->Make2($this->mSmarty, 0, 1);
            $this->mSmarty->assignByRef('pagging', $pagging);
            $this->mSmarty->assignByRef('methods', Payout::MethodsList());
            $this->mSmarty->assignByRef('statuses', Payout::StatusesList());
			
        }
		 
        $this->mSmarty->display('mods/profile/edit_artist/wallet.html');
        exit();
    }


    /**
     * User transaction history
     */
    public function WalletHistory()
    {
		
        $this->mSmarty->assign('module', 'wallet');
	    //$this->mSmarty->assign('module', 'payout');
				
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
		
        $page = _v('page', 1);
        $pcnt = 10;
        $status = -1;//all
        $sort = trim(strip_tags(_v('sort', '')));
        $this->mSmarty->assign('sort', $sort);
        
        $rcnt = Payout::PaymentsCount($this->mUser->mUserInfo['Id'], $status, -1);
        if ($rcnt)
        {
            $payments = Payout::PaymentsList($this->mUser->mUserInfo['Id'], $status, $sort, -1, $page, $pcnt, 1, 1, 1);
            $this->mSmarty->assignByRef('payments', $payments);

            include_once 'model/Pagging.class.php';
            $link = PATH_ROOT . 'artist/wallethistory' . ($sort ? '?sort=' . $sort : '');
            $mpg = new Pagging($pcnt, $rcnt, $page, $link);
            $pagging = $mpg->Make2($this->mSmarty, 0, 1);
            $this->mSmarty->assignByRef('pagging', $pagging);
            $this->mSmarty->assignByRef('methods', Payout::MethodsList());
            $this->mSmarty->assignByRef('statuses', Payout::StatusesList());
        }
        $this->mSmarty->display('mods/profile/edit_artist/wallet_history.html');
        exit();
    }
	public function PaymentMode()
	{
        $this->mSmarty->assign('module', 'wallet');		
		
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
					
		$this->mSmarty->display('mods/profile/edit_artist/payment_mode.html');
        exit();	
	}

    public function Payout()
    {
		$acType = PaymentInfo::AccountTypesList();
	
        $this->mSmarty->assign('module', 'wallet');
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
				

        if (!empty($_POST['fm']) || !empty($_POST['pfm']))
        {
            $fm = !empty($_POST['fm']) ? $_POST['fm'] : array();
            $pfm = !empty($_POST['pfm']) ? $_POST['pfm'] : array();
            $errs = array();

            try
            {
                if (empty($fm['Payout']) || $fm['Payout'] <= 0)
                {
                    $errs['Payout'] = PLEASE_SPECIFY_PAYOUT_AMOUNT;
                }
                else
                {
                    $fm['Payout'] = abs($fm['Payout']);
                    if ($fm['Payout'] > ($this->mUser->mUserInfo['Wallet'] - $this->mUser->mUserInfo['WalletBlock']))
                    {
                        $errs['Payout'] = IT_IS_NOT_ENOUGH_MONEY_IN_THE_ACCOUNT;
                    }
                }

                /*$methods = Payout::MethodsList();
                if (empty($fm['Method']) || !isset($methods[$fm['Method']]))
                {
                    $errs[] = 'Please select payment method';
                }*/

                if(empty($fm['PaymentInfoId']) || (int)$fm['PaymentInfoId'] == 0)
                {
                    //add or edit payment info
                    if(empty($pfm['RoutingCode']))
                    {
                        $errs['RoutingCode'] = PLEASE_SPECIFY_ROUTING_ABA_CODE;
                    }
                    if(empty($pfm['AccountNumber']))
                    {
                        $errs['AccountNumber'] = PLEASE_SPECIFY_BANK_ACCOUNT_NUMBER;
                    }
                    if(empty($pfm['HolderName']))
                    {
                        $errs['HolderName'] = PLEASE_SPECIFY_BANK_ACCOUNT_HOLDER_NAME;
                    }
                    if(empty($pfm['AccountType']))
                    {
                        $errs['AccountType'] = PLEASE_SPECIFY_ACCOUNT_TYPE;
                    }
                }

                if (!empty($errs))
                {
                    throw new Exception('err');
                }

                if(empty($pfm['Id']))
                {
                    //add new payment info template
                    $fm['PaymentInfoId'] = PaymentInfo::AddPaymentInfo($this->mUser->mUserInfo['Id'], $pfm['RoutingCode'], $pfm['AccountNumber'], $pfm['HolderName'], $pfm['AccountType']);
                }

                $sum = $this->mUser->mUserInfo['Wallet'] - $fm['Payout'];
                Payout::PayoutMoney($this->mUser->mUserInfo['Id'], 0, 0, $fm['Payout'], $sum, 0, 0, array('type' => 'points','mode' => 'direct'), $fm['PaymentInfoId']);
                User::UpdateWallet($this->mUser->mUserInfo['Id'], $sum);
				
                $this->mSmarty->assign('artist_name', $this->mUser->mUserInfo['Name']);        
	            $this->mSmarty->assign('email', $this->mUser->mUserInfo['Email']);					
                $this->mSmarty->assign('amount', $fm['Payout']);					
                $this->mSmarty->assign('routing_code', $pfm['RoutingCode']);	
                $this->mSmarty->assign('acc_no', $pfm['AccountNumber']);			
                $this->mSmarty->assign('hoder_name', $pfm['HolderName']);
                $this->mSmarty->assign('acc_type', $acType[$pfm['AccountType']]);										
                $this->mSmarty->assign('mode', 'direct');

				$this->mSmarty->assign('avatar', $this->mUser->mUserInfo['Avatar']);										
                $this->mSmarty->assign('SITE_NAME', SITE_NAME);
                $this->mSmarty->assign('DOMAIN', DOMAIN);

				$userName = $this->mUser->mUserInfo['BandName'] ?  $this->mUser->mUserInfo['BandName'] :  $this->mUser->mUserInfo['FirstName'].' '. $this->mUser->mUserInfo['LastName'];		

				//send mail to admin and artist with payout info
     	        include 'libs/Phpmailer_v5.1/class.phpmailer.php';					

                if($this->mUser->mUserInfo['Email'])
				{    

	                $this->mSmarty->assign('name', $this->mUser->mUserInfo['Name']);
					$this->mSmarty->assign('userName', $userName);
					
                    $this->mSmarty->assign('mail_to', 'artist');   	
					$fromEmail = ADMIN_EMAIL;
					$fromName = SITE_NAME;
					$toEmail = $this->mUser->mUserInfo['Email'];
					$toName = $this->mUser->mUserInfo['Name'];
					$subject = PAYOUT_INFO_FROM . SITE_NAME;
					$message = $this->mSmarty->fetch('mails/payout_info_mail.html');					
					sendEmail($fromEmail,$fromName, $toEmail, $toName, $subject, $message);				
					
				}
				if(ADMIN_EMAIL_RECEIVED)	
				{		 		
					$this->mSmarty->assign('userName', ADMIN_NAME);					
					$this->mSmarty->assign('artistFullName', $userName);
					
                    $this->mSmarty->assign('mail_to', 'admin');
					$fromEmail = ADMIN_EMAIL;
					$fromName = SITE_NAME;
					$toEmail = ADMIN_EMAIL_RECEIVED;
					$toName = ADMIN_NAME;
					$subject = $userName.' '.PAYOUT_INFO_FROM . SITE_NAME;
					$message = $this->mSmarty->fetch('mails/payout_info_mail.html');
					sendEmail($fromEmail,$fromName, $toEmail, $toName, $subject, $message);					
				}
									
                uni_redirect( PATH_ROOT . 'artist/wallet' ); 
            }
            catch (Exception $e)
            {
                $err = $e->getMessage();
                if ($err != 'err')
                {
                    $errs[] = $err;
                }
                $this->mSmarty->assign('fm', $fm);
                $this->mSmarty->assign('pfm', $pfm);
                $this->mSmarty->assignByRef('errs', $errs);   
            } 

        }
        if(empty($errs))
        {
            //last saved payment info
            $this->mSmarty->assign('pfm', PaymentInfo::GetLastPaymentInfo($this->mUser->mUserInfo['Id']));
        }
        
        $this->mSmarty->assignByRef('account_types', $acType);
        $this->mSmarty->assignByRef('methods', Payout::MethodsList());
        $this->mSmarty->display('mods/profile/edit_artist/payout.html');
        exit();
    }
    public function RequestCheckMail()
    {
        $this->mSmarty->assign('module', 'wallet');	
		
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
					
		if (!empty($_POST['fm']) && !empty($_POST['pfm']))
        {
            $fm = !empty($_POST['fm']) ? $_POST['fm'] : array();
			$pfm = !empty($_POST['pfm']) ? $_POST['pfm'] : array();
            $errs = array();					
								
			try
            {
				
                if (empty($fm['Payout']) || $fm['Payout'] <= 0)
                {
                    $errs['Payout'] = PLEASE_SPECIFY_PAYOUT_AMOUNT;
                }
                else
                {
                    $fm['Payout'] = abs($fm['Payout']);
                    if ($fm['Payout'] > ($this->mUser->mUserInfo['Wallet'] - $this->mUser->mUserInfo['WalletBlock']))
                    {
                        $errs['Payout'] = IT_IS_NOT_ENOUGH_MONEY_IN_THE_ACCOUNT;
                    }
                }

				if(empty($pfm['MailName']))
				{				
					$errs['MailName'] = PLEASE_SPECIFY_CHECK_ADDRESS_TO;
				}
				if(empty($pfm['MailAdd1']))
				{
					$errs['MailAdd1'] = PLEASE_SPECIFY_MAIL_ADDRESS_1;
				}
				if(empty($pfm['MailCity']))
				{
					$errs['MailCity'] = PLEASE_SPECIFY_MAIL_CITY;
				}
				if(empty($pfm['MailZip']))
				{
					$errs['MailZip'] = PLEASE_SPECIFY_MAIL_ZIP;
				}
				 if (!empty($errs))
                {
                    throw new Exception('err');
                }

				if(empty($errs))
				{												
					//add new payment info template
					$fm['PaymentInfoId'] = PaymentInfo::AddAddressPaymentInfo($this->mUser->mUserInfo['Id'], $pfm['MailName'], $pfm['MailAdd1'], $pfm['MailAdd2'], $pfm['MailCity'], $pfm['MailState'], $pfm['MailZip']);
	
					$sum = $this->mUser->mUserInfo['Wallet'] - $fm['Payout'];
					Payout::PayoutMoney($this->mUser->mUserInfo['Id'], 0, 0, $fm['Payout'], $sum, 0, 0, array('type' => 'points','mode' => 'check'), $fm['PaymentInfoId']);
					User::UpdateWallet($this->mUser->mUserInfo['Id'], $sum);
					
					//send mail to admin and artist with payout info
					
                    $this->mSmarty->assign('artist_name', $this->mUser->mUserInfo['Name']); 
					$this->mSmarty->assign('email', $this->mUser->mUserInfo['Email']);					
					$this->mSmarty->assign('amount', $fm['Payout']);					
					$this->mSmarty->assign('mail_name', $pfm['MailName']);	
					$this->mSmarty->assign('mail_addr1', $pfm['MailAdd1']);			
					$this->mSmarty->assign('mail_addr2', $pfm['MailAdd2']);	
					$this->mSmarty->assign('mail_city', $pfm['MailCity']);			
					$this->mSmarty->assign('mail_state', $pfm['MailState']);	
					$this->mSmarty->assign('mail_zip', $pfm['MailZip']);										
					$this->mSmarty->assign('mode', 'check');
					
					$this->mSmarty->assign('avatar', $this->mUser->mUserInfo['Avatar']);											
				    $this->mSmarty->assign('SITE_NAME', SITE_NAME);
					$this->mSmarty->assign('DOMAIN', DOMAIN);
					
					$userName = $this->mUser->mUserInfo['BandName'] ?  $this->mUser->mUserInfo['BandName'] :  $this->mUser->mUserInfo['FirstName'].' '. $this->mUser->mUserInfo['LastName'];		
	
					if($this->mUser->mUserInfo['Email'])
					{
						$this->mSmarty->assign('userName', $userName);					
						$this->mSmarty->assign('mail_to', 'artist');
						$fromEmail = ADMIN_EMAIL;
						$fromName = SITE_NAME;
						$toEmail = $this->mUser->mUserInfo['Email'];
						$toName = $this->mUser->mUserInfo['Name'];
						$subject = PAYOUT_INFO_FROM . SITE_NAME;
						$message = $this->mSmarty->fetch('mails/payout_info_mail.html');						
						sendEmail($fromEmail, $fromName,$toEmail, $toName, $subject, $message);					
						
					}
					if(ADMIN_EMAIL_RECEIVED)	
					{
						$this->mSmarty->assign('userName', ADMIN_NAME);						
						$this->mSmarty->assign('artistFullName', $userName);				
						$this->mSmarty->assign('mail_to', 'admin');						
						$fromEmail = ADMIN_EMAIL;
						$fromName = SITE_NAME;
						$toEmail = ADMIN_EMAIL_RECEIVED;
						$toName = ADMIN_NAME;
						$subject = $userName.' '.PAYOUT_INFO_FROM . SITE_NAME;
						$message = $this->mSmarty->fetch('mails/payout_info_mail.html');
						sendEmail($fromEmail,$fromName, $toEmail, $toName, $subject, $message);					
						
					}					
					uni_redirect( PATH_ROOT . 'artist/wallet' ); 
				}
            }
            catch (Exception $e)
            {
                $err = $e->getMessage();
                if ($err != 'err')
                {
                    $errs[] = $err;
                }				
                $this->mSmarty->assign('fm', $fm);
				$this->mSmarty->assign('pfm', $pfm);
                $this->mSmarty->assignByRef('errs', json_encode($errs));   	
            } 
        }
		if(empty($errs))
		{
			//last saved payment info
			$pfm = PaymentInfo::GetLastAddressPaymentInfo($this->mUser->mUserInfo['Id']);
	        $this->mSmarty->assign('pfm', $pfm);	
		}							
		
      	$this->mSmarty->display('mods/profile/edit_artist/request_check_mail.html');      		
		exit();	
		
    }
	public function WalletPaypal()
	{
        $this->mSmarty->assign('module', 'wallet');	
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
		
		//last saved payment info
		$pfm = PaymentInfo::GetLastPaypalIdPaymentInfo($this->mUser->mUserInfo['Id']);		
	    $this->mSmarty->assign('pfm', $pfm);

		if(!empty($_POST['fm']))
        {
		    $fm = !empty($_POST['fm']) ? $_POST['fm'] : array();
            $errs = array();
			try
            {
                if (empty($fm['Payout']) || $fm['Payout'] <= 0)
                {
                    $errs['Payout'] = PLEASE_SPECIFY_PAYOUT_AMOUNT;
                }
                else
                {
                    $fm['Payout'] = abs($fm['Payout']);
                    if ($fm['Payout'] > ($this->mUser->mUserInfo['Wallet'] - $this->mUser->mUserInfo['WalletBlock']))
                    {
                        $errs['Payout'] = IT_IS_NOT_ENOUGH_MONEY_IN_THE_ACCOUNT;
                    }
                }	

		        if (!empty($fm['PaypalId']))
				{
					$email = !empty($fm['PaypalId']) && verify_email($fm['PaypalId']) ? $fm['PaypalId'] : '';
		
					if (empty($email))
					{
						$errs['PaypalId'] = PLEASE_SPECIFY_CORRECT_PAYMENT_ID;
					}
					else
					{
						$eml = PaymentInfoQuery::create()->Select(array('Id'))
								->where('LOWER(payment_info.paypal_id)="' . mysql_escape_string(ToLower($fm['PaypalId'])).'"');
						if($this->mUser->IsAuth())
						{
							$eml = $eml->filterByUserId($this->mUser->mUserInfo['Id'], Criteria::NOT_EQUAL);
						}
						$eml = $eml->findOne();
						if (!empty($eml))
						{
							$errs['PaypalId'] = USER_WITH_THAT_PAYPAL_ID_ALREADY_EXIST;
						}					
					}
				}
				else
				{
						$errs['PaypalId'] = PLEASE_SPECIFY_PAYMENT_ID;
				}

				if (!empty($errs))
                {
                    throw new Exception('err');
                }		
			}
			catch (Exception $e)
            {	
                $err = $e->getMessage();
                if ($err != 'err')
                {
                    $errs[] = $err;
                }				
                $this->mSmarty->assign('fm', $fm);
                $this->mSmarty->assignByRef('errs', json_encode($errs));			
			}
			if(empty($errs))
			{
				$eml = PaymentInfoQuery::create()->Select(array('Id'))
						->where('LOWER(payment_info.paypal_id)="' . mysql_escape_string(ToLower($fm['PaypalId'])).'"');
				if($this->mUser->IsAuth())
				{
					$eml = $eml->filterByUserId($this->mUser->mUserInfo['Id'], Criteria::EQUAL);
				}
				$eml = $eml->findOne();				
				if (!empty($eml))
				{
					$fm['PaymentInfoId'] = $eml;
				}
				else
				{
					$fm['PaymentInfoId'] = PaymentInfo::AddPaypalIdPaymentInfo($this->mUser->mUserInfo['Id'], $fm['PaypalId']);
				}	

				
				
				$sum = $this->mUser->mUserInfo['Wallet'] - $fm['Payout'];
				Payout::PayoutMoney($this->mUser->mUserInfo['Id'], 0, 0, $fm['Payout'], $sum, 0, 0, array('type' => 'points','mode' => 'paypal'), $fm['PaymentInfoId']);
				User::UpdateWallet($this->mUser->mUserInfo['Id'], $sum);

					$userName = $this->mUser->mUserInfo['BandName'] ?  $this->mUser->mUserInfo['BandName'] :  $this->mUser->mUserInfo['FirstName'].' '. $this->mUser->mUserInfo['LastName'];		

					//send mail to admin and artist with payout info
					include 'libs/Phpmailer_v5.1/class.phpmailer.php';

					
                    $this->mSmarty->assign('artist_name', $this->mUser->mUserInfo['Name']); 
					$this->mSmarty->assign('email', $this->mUser->mUserInfo['Email']);					
					$this->mSmarty->assign('amount', $fm['Payout']);					
					$this->mSmarty->assign('paypal_id', ($pfm['PaypalId'])?$pfm['PaypalId']:$fm['PaypalId']);										
					$this->mSmarty->assign('mode', 'paypal');
					$this->mSmarty->assign('avatar', $this->mUser->mUserInfo['Avatar']);
											
					 $this->mSmarty->assign('SITE_NAME', SITE_NAME);
					 $this->mSmarty->assign('DOMAIN', DOMAIN);
						
					if($this->mUser->mUserInfo['Email'])
					{
						$this->mSmarty->assign('userName', $userName);					
						$this->mSmarty->assign('mail_to', 'artist');						
						$fromEmail = ADMIN_EMAIL;
						$fromName = SITE_NAME;
						$toEmail = $this->mUser->mUserInfo['Email'];
						$toName = $this->mUser->mUserInfo['Name'];
						$subject = PAYOUT_INFO_FROM . SITE_NAME;
						$message = $this->mSmarty->fetch('mails/payout_info_mail.html');	
						sendEmail($fromEmail,$fromName, $toEmail, $toName, $subject, $message);																	
					}
					if(ADMIN_EMAIL_RECEIVED)	
					{
						$this->mSmarty->assign('userName', ADMIN_NAME);							
						$this->mSmarty->assign('artistFullName', $userName);	
										
						$this->mSmarty->assign('mail_to', 'admin');
						$fromEmail = ADMIN_EMAIL;
						$fromName = SITE_NAME;
						$toEmail = ADMIN_EMAIL_RECEIVED;
						$toName  = ADMIN_NAME;
						$subject = $userName.' '.PAYOUT_INFO_FROM . SITE_NAME;
						$message = $this->mSmarty->fetch('mails/payout_info_mail.html');	
						sendEmail($fromEmail,$fromName, $toEmail, $toName, $subject, $message);		
					}					
				uni_redirect( PATH_ROOT . 'artist/wallet' );
			}						
		}	
      	$this->mSmarty->display('mods/profile/edit_artist/wallet_paypal.html');      		
		exit();			
	}

    public function CancelPayout()
    {
        $id = _v('id', 0);
        $payout = Payout::GetOne($id, $this->mUser->mUserInfo['Id']);
        if (empty($payout) || $payout['Status'] != 0)
        {
            uni_redirect( PATH_ROOT . 'artist/wallet' );
        }

        $this->mSmarty->assign('module', 'wallet');

        //cancel payout - return money to user account
        Payout::CancelPayout( $id );
        $sum = $this->mUser->mUserInfo['Wallet'] + $payout['Money'];
        Payout::PayoutMoney($this->mUser->mUserInfo['Id'], 1, 0, $payout['Money'], $sum, 0, 4, array('type' => 'points'));

        //update wallet
        User::UpdateWallet($this->mUser->mUserInfo['Id'], $sum);

        echo json_encode(array('q' => OK ));
        exit(); 
    }


    /**********************
     *        Artist tools
     ***********************/

    
    public function Tools()
    {

        $this->mSmarty->assign('module', 'fanfinder');
		
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
		
        //locations with count fans
        $cities = UserFollow::GetFollowListByCities($this->mUser->mUserInfo['Id'], USER_FAN);	
        $this->mSmarty->assignByRef('cities', $cities);		

		//genres list
        $genres_list = User::GetGenresList();
        $this->mSmarty->assignByRef('genres_list', $genres_list);
		
		$states_list = State::GetStates();
		$this->mSmarty->assignByRef('statesList', $states_list);
		
        //geo for fan
        include_once 'libs/Geografy/Main.class.php';
        $this->mSmarty->assign('GeoIp', Model_Geografy_Main::GeoIPInit());
			
	 	$this->mSmarty->assignByRef('countries', Countries::GetCountries($this->mCache));

		$country = _v('country', '');
		$location = _v('location', '');		
		$music_genre = _v('music_genre', '');
		$state = _v('state', '');	
		$gender = _v('gender', '');	
		$search = _v('search', '');
		
       
		$cit =array();
		if($location || $country || $music_genre || $state || $gender )
		{
			$fans = UserFollow::GetFollowersUserList($this->mUser->mUserInfo['Id'], 1, '', '', '', $location, $country, $music_genre, $state, $gender);
					
			$fan_ids = '';
			foreach($fans as $value)
			{
				$fan_ids =$value['Id'].','.$fan_ids;
				
				array_push($cit, $value['Location']);
			}
       		$this->mSmarty->assign('fan_ids', $fan_ids);
			
			$this->mSmarty->assignByRef('fans', $fans);
			
			$res['q'] = OK;
			$res['fan_ids'] = $fan_ids;
			
			$res['data'] = $this->mSmarty->Fetch('mods/profile/edit_artist/ajax/filter_fans.html');
			
        	echo json_encode($res);
			exit();
		}
		else
		{
			$fans = UserFollow::GetFollowersUserList($this->mUser->mUserInfo['Id'], 1);

        	$this->mSmarty->assignByRef('fans', $fans);
			
			$fan_ids = '';
			$country = array();
			foreach($fans as $value)
			{
				if($value['Location']) {
					$fan_ids =$value['Id'].','.$fan_ids;
				}
			}
       		$this->mSmarty->assign('fan_ids', $fan_ids);

			$this->mSmarty->assign('cit', $cit);
			$this->mSmarty->assign('country', $country);
			$this->mSmarty->display('mods/profile/edit_artist/tools.html');
	
			exit();
		}
			      
    }

    /**
     * Google map and top fans for each locality
     */
    public function FanFinder()
    {
        $this->mSmarty->assign('module', 'fanfinder');

        $page = _v('page', 1);
        $pcnt = 10;
        $location = strip_tags(trim(_v('loc', '')));        
		$country = strip_tags(trim(_v('country', '')));
        
		$this->mSmarty->assign('location', $location);
						
        $cities = UserFollow::GetFollowListByCities($this->mUser->mUserInfo['Id'], USER_FAN);	
        $this->mSmarty->assignByRef('cities', $cities);

        //top fan 100 (first 10) in location $location
        $rcnt = UserFollow::GetFollowersUserListCount($this->mUser->mUserInfo['Id'], USER_FAN, '', $location, $country);
    
	    $fans = UserFollow::GetFollowersUserList($this->mUser->mUserInfo['Id'], USER_FAN, $page, $pcnt, '', $location, $country );

		$fan_ids = '';
		$count =0;
		foreach($fans as $value)
		{
			$fan_ids =$value['Id'].','.$fan_ids;
		//	if($value['Location']) 
		//	{
				if( (strtolower($value['Location']) == strtolower($location)) || (strtolower($value['Country']) == strtolower($country)))
				{
					$count++;
				}
		//	}
		}
		$this->mSmarty->assign('fan_ids', $fan_ids);	
        $this->mSmarty->assign('count', $count);
        $this->mSmarty->assignByRef('fans', $fans);
		
		
/*        $this->mSmarty->assign('page', $page);
        $this->mSmarty->assign('pcnt', $pcnt);
        
        include_once 'model/Pagging.class.php';
        $link = PATH_ROOT . 'artist/fanfinder' . ($location != '' ? '?loc=' . $location : '');
        $mpg = new Pagging($pcnt, $rcnt, $page, $link);
        $pagging = $mpg->Make2($this->mSmarty, 0, 1);
        $this->mSmarty->assignByRef('pagging', $pagging);*/

        $this->mSmarty->assignByRef('countries', Countries::GetCountries($this->mCache));

        $this->mSmarty->display('mods/profile/edit_artist/fan_finder.html');
        exit();
    }

    /**
     * Top fan 100
     */
    public function FanTop100()
    {
        $this->mSmarty->assign('module', 'tools');

        $page = _v('page', 1);
        $pcnt = 10;

        $rcnt = UserFollow::GetFollowersCount($this->mUser->mUserInfo['Id']);
        $fans = UserFollow::GetFollowTopList($this->mUser->mUserInfo['Id'], '', $page, $pcnt);
        $this->mSmarty->assignByRef('fans', $fans);

        include_once 'model/Pagging.class.php';
        $link = PATH_ROOT . 'artist/fantop100';
        $mpg = new Pagging($pcnt, $rcnt, $page, $link);
        $pagging = $mpg->Make2($this->mSmarty, 0, 1);
        $this->mSmarty->assignByRef('pagging', $pagging);

        $this->mSmarty->assign('page', $page);
        $this->mSmarty->assign('pcnt', $pcnt);

        $this->mSmarty->assignByRef('countries', Countries::GetCountries($this->mCache));

        $this->mSmarty->display('mods/profile/edit_artist/fantop100.html');
        exit();
    }
    
    
    /**
     * Atist broadcasting 
     */
    public function Broadcasting()
    {
        $this->mSmarty->assign('module', 'broadcasting');
		
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
		
		$timeOut = _v('timeOut', '');		
		$this->mSmarty->assign('timeOut', $timeOut);
		
		$event_id = _v('eId', '');
		
		if(($timeOut) && ($event_id))
		{
			//update event status
            EventQuery::create()->select(array('Id'))->filterById($event_id)->update(array('Status' => 4));
			$res['q'] = OK;
			
			echo json_encode($res);
			exit;			
//			uni_redirect(PATH_ROOT . 'artist/broadcasting');
		}
			
        $events = Event::EventsList($this->mUser->mUserInfo['Id'], 0, 0, array('from' => date("Y-m-d H:i:s", mktime(date('H'), date('i'), date('s'), date("m"), date("d"), date("Y")))), array(2, 3), array(1, 2), '', EVENT_APPROVED);

        $this->mSmarty->assignByRef('events', $events);

        $this->mSmarty->assign('event_finished', _v('event_finished', 0));

        //broadcast recordings
        $page = _v('page', 1);
        $pcnt = 10;
        $rcnt = EventVideo::GetEventsRecordingsCount($this->mUser->mUserInfo['Id']);
        $list = EventVideo::GetListEventsRecordings($this->mUser->mUserInfo['Id'], array(), $pcnt, $page);

        $this->mSmarty->assignByRef('recordings', $list);

        include_once 'model/Pagging.class.php';
        $link = PATH_ROOT . 'artist/broadcasting';
        $mpg = new Pagging($pcnt, $rcnt, $page, $link);
        $pagging = $mpg->Make2($this->mSmarty, 0, 1);
        $this->mSmarty->assignByRef('pagging', $pagging);

        $this->mSmarty->assign('page', $page);
        $this->mSmarty->assign('pcnt', $pcnt);

        $this->mSmarty->display('mods/profile/edit_artist/broadcasting.html');
        exit();
    }
	
	public function BroadcastVideo()
	{
		$this->mSmarty->assign('module', 'broadcasting');
		$id = _v('id', 0);
		$video = EventVideo::GetEventVideoById($id, $this->mUser->mUserInfo['Id']);
		$this->mSmarty->assign('video', $video);
		$this->mSmarty->display('mods/profile/edit_artist/broadcast_one.html');
        exit();
	}
	public function exportbroadcastviewersreport()
	{
		$header = " \n Broadcast Viewers Report\n\n";	

		$viewers = BroadcastViewers::GetListViewersReport($this->mUser->mUserInfo['Id']);					
		
		$totalPrice =0;
		foreach($viewers['list'] as $val)
		{
			$totalPrice += $val['Total'];
		}
								
		$header .= "Event Title,  Viewers Count, Ticket Price , Total \r\n";				
		
		foreach($viewers['list'] as $value)
		{
			if($value['Price']){					
			$arr = array();			
			$arr[] = $value['Title'];
			$arr[] = $value['Count'];															
			$arr[] = '$'.number_format($value['Price'], 2);
			$arr[] = '$'.number_format($value['Total'], 2);											
			$list = implode($arr, '","');
			$list = '"'.trim($list, ',"').'"';
			$header .= $list."\r\n";
			}
		}
		$header .= "\n\n Sum Of Total\n";		
		$header .= "\n".number_format($totalPrice,2)."\r\n";
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=viewerReport.csv");
		header("Pragma: no-cache");
		header("Expires: 0");
		print "$header"; 
		die;		
	}
	public function BroadcastViewers()
	{
        $this->mSmarty->assign('module', 'broadcasting');
		 
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
				
        $events = Event::EventsList($this->mUser->mUserInfo['Id'], 0, 0, array('from' => date("Y-m-d H:i:s", mktime(date('H'), date('i'), date('s'), date("m"), date("d"), date("Y")))), array(2, 3), array(1, 2), '', EVENT_APPROVED);

        $this->mSmarty->assignByRef('events', $events);
			
		$id = _v('id', 0);
        //broadcast viewers report
        $page = _v('page', 1);
        $pcnt = 10;		
		$viewers = BroadcastViewers::GetListViewersReport($this->mUser->mUserInfo['Id']);

		$this->mSmarty->assign('viewers', $viewers);
		$totalPrice =0;
		foreach($viewers['list'] as $val)
		{
			$totalPrice += $val['Total'];
		}
		
		$this->mSmarty->assign('totalPrice', $totalPrice);
		$this->mSmarty->assign('viewers', $viewers['list']);
		
		$this->mSmarty->display('mods/profile/edit_artist/viewers_report.html');
        exit();
	}
	public function BroadcastViewersDetails($id)
	{
	 	$this->mSmarty->assign('module', 'broadcasting');
		$event_id = _v('id', 0);	
		BroadcastViewers::broadcastdetails($event_id , $this->mUser->mUserInfo['Id']);
		$this->mSmarty->display('mods/profile/edit_artist/broadcastingdetails.html');		 
		exit();
		 
	}
	public function mailToViewers()
	{
		 $event_id = _v('id', 0);
		 $subject = _v('subject', '');
		 $message = _v('message', '');		
         $res['q'] = 'ok';
			 
		$viewers = BroadcastViewers::GetListViewersReport($this->mUser->mUserInfo['Id'], $event_id);
		
		$MailImages = Event::GetEvent($event_id);
		$this->mSmarty->assign('Image', ROOT_HTTP_PATH.'/files/photo/mid/'.$MailImages['UserId'].'/'.$MailImages['EventPhoto']);

		if($viewers['list'])
		{
		   	include 'libs/Phpmailer_v5.1/class.phpmailer.php';	
																								
	        $this->mSmarty->assign('DOMAIN', $DOMAIN);  			
	        $this->mSmarty->assign('message', nl2br($message));
			
			foreach($viewers['list'] as $val)
			{
				$userName = $val['BandName'] ?  $val['BandName'] :  $val['FirstName'].' '. $val['LastName'];
				
				$this->mSmarty->assign('name', $userName);				 
				$this->mSmarty->assign('Avatar',$this->mUser->mUserInfo['Avatar']);				 										
				$fromEmail = ADMIN_EMAIL;
				$fromName = SITE_NAME;
				$toEmail = $val['Email'];
				$toName = $userName;
				$subject = $subject;
				$message = $this->mSmarty->fetch('mails/viewers_mail.html');
				
				sendEmail($fromEmail,$fromName, $toEmail, $toName, $subject, $message);					
				 
				 
			}
            $res['data'] = 1;					  
		}
		else
		{
            $res['data'] = 2;
		}
        echo json_encode($res);
		exit;	 
	}
	
    public function StartBroadcasting()
    {
        $this->mSmarty->assign('module', 'broadcasting');
        $event_id = _v('id', 0);
		$getTime = _v('getTime', 0);

		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
				
        $event = Event::GetEvent($event_id, $this->mUser->mUserInfo['Id']);

		$this->mSmarty->assign('eTime', $event['Duration']); 
					
		//If broadcast started earlier get start time to find remaining time
		$firstBroadcastTime = BroadcastFlows::GetEventFirstFlowUsed($this->mUser->mUserInfo['Id'], $event_id);

		if($firstBroadcastTime)
		{
			$rtime = mktime()-$firstBroadcastTime;	
			$this->mSmarty->assign('reTime', $rtime);

			if($getTime)
			{	
				$res['q'] = OK;
				$res['reTime'] = $rtime;
				echo json_encode($res);
				exit();						
			}
		}
		else
		{
			if($getTime)
			{
				$res['q'] = OK;
				$res['reTime'] = 0;
				echo json_encode($res);
				exit();						
			}
		}	
		
        if(empty($event))
        {
            uni_redirect(PATH_ROOT . 'artist/broadcasting');
        }
        else
        {
            //if event is calcelled or finished or date start is earlier than 1 day ago
            if($event['Status'] > 2 || strtotime($event['EventDate']) < mktime(date('H'), date('i'), date('s'), date("n"), date("j")-1, date("Y")))
            {
                uni_redirect(PATH_ROOT . 'artist/broadcasting');
            }
        }

        $this->mSmarty->assign('event', $event);
        $this->mSmarty->assign('event_id', $event_id);
		        
        $this->mSmarty->display('mods/profile/edit_artist/broadcasting_start.html');
        exit();
    }

    /**********************
     *        Gallery
     ***********************/

    /**
     * Artist photo page
     * @return void
     */
    public function Photo()
    {
        $this->mSmarty->assign('module', 'photo');
		$ui = & $this->mUser->mUserInfo;
		
		$rand_id = _v('rand_id', rand(100000, 999999));
        $this->mSmarty->assign('rand_id', $rand_id);
		
		$this->mSmarty->assign('ui', $ui);
		$PhotoCount = Photo::GetCountAllPhotoAlbum($this->mUser->mUserInfo['Id']);
		$this->mSmarty->assign('totalAlbum', $PhotoCount['CountAlbum']);
		$this->mSmarty->assign('totalPhotos', $PhotoCount['CountPhoto']);
		
		$this->mSmarty->assign('PhotoCounts', Photo::PhotoCounts($this->mUser->mUserInfo['Id']));				
				
        $id = _v('id', 0);
        $ph = (int)_v('ph', 0);
		$ajaxMode = _v('ajaxMode', 0);		
		$page = _v('page', 1);		
        $pcnt = 12;		
			
		$albums = PhotoAlbum::GetAlbumList($this->mUser->mUserInfo['Id'], 1, 0,0,0);
        $albums = make_assoc_array( $albums, 'Id' );
//		echo count($albums)."<br/>";
//		deb($albums);
		$moreAlbums = PhotoAlbum::GetAlbumList($this->mUser->mUserInfo['Id'], 1, 0,0,0);
        $moreAlbums = make_assoc_array( $moreAlbums , 'Id' );

        if ($album && !isset($albums[$album]))
        {
            $album = 0;
        }
		$this->mSmarty->assignByRef('albums', $albums);			
		$this->mSmarty->assignByRef('moreAlbums', $moreAlbums);	
		
        if(!$ph)
        {
            $id = 0;
        }
        if ($id)
        {

            $album = PhotoAlbum::GetAlbum( $id );

            if (empty($album) || $album['UserId'] != $this->mUser->mUserInfo['Id'])
            {
                $id = 0;
                $ph = 0;
                $album = array();
            }
            else
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
            }
        }
        /*Add Start */
		/*Add End */

        $this->mSmarty->assign('photo_added', isset($_REQUEST['photo_added']) ? 1 : 0);
        $this->mSmarty->assign('photo_updated', isset($_REQUEST['photo_updated']) ? 1 : 0);
        $this->mSmarty->assign('photo_removed', isset($_REQUEST['photo_removed']) ? 1 : 0);
        $this->mSmarty->assign('album_removed', isset($_REQUEST['album_removed']) ? 1 : 0);
        $this->mSmarty->assign('album_added', isset($_REQUEST['album_added']) ? 1 : 0);
        $this->mSmarty->assign('album_updated', isset($_REQUEST['album_updated']) ? 1 : 0);
		
			include_once 'model/Pagging.class.php';
			$link = PATH_ROOT.'/artist/photo';
			$mpg = new Pagging($pcnt, $rcnt, $page, $link);
			$pagging = $mpg->Make2($this->mSmarty, 0, 1);
			$this->mSmarty->assignByRef('pagging', $pagging);	
			$this->mSmarty->assign('page', $page);
			$this->mSmarty->assign('pcnt', $pcnt);

		
		

        if (!$id)
        {
            //albums list	
			if($ajaxMode)
			{	
				$totalpages = ceil(count(PhotoAlbum::GetAlbumList($this->mUser->mUserInfo['Id'],1,1,0, 0)) / 12);													
				if($totalpages>$page)
				{
						$page = $page+1;
				}
				$this->mSmarty->assign('page', $page);
				$this->mSmarty->assign('totalAlbums', PhotoAlbum::GetAlbumList($this->mUser->mUserInfo['Id'],1,1,0, 0));																			
            	$this->mSmarty->assignByRef('albums', PhotoAlbum::GetAlbumList($this->mUser->mUserInfo['Id'],1,1,$page, $pcnt));			
				$res['data'] = $this->mSmarty->fetch('mods/profile/edit_artist/ajax/scrollPhotoPagination.html');
				echo json_encode($res);				
				exit();					
			}
			$totalpages = ceil(count(PhotoAlbum::GetAlbumList($this->mUser->mUserInfo['Id'],1,1,0, 0)) / 12);			
			$this->mSmarty->assign('totalpages', $totalpages);			
			$this->mSmarty->assign('totalAlbums', PhotoAlbum::GetAlbumList($this->mUser->mUserInfo['Id'],1,1,0, 0));						
            $this->mSmarty->assignByRef('albums', PhotoAlbum::GetAlbumList($this->mUser->mUserInfo['Id'],1,1,$page, $pcnt));
            $this->mSmarty->display('mods/profile/edit_artist/photo.html');
			
        }
        else
        {
            //show album photo
            $this->mSmarty->assignByRef('photo', $photo);
            //prev and next photos ids
            $this->mSmarty->assignByRef('links', Photo::GetPrevNext($id, $ph));
            $this->mSmarty->assignByRef('album', $album);
            $this->mSmarty->assign('id', $id);
			$this->mSmarty->assign('totalAlbums', PhotoAlbum::GetAlbumList($this->mUser->mUserInfo['Id'],1,1,0, 0));						
            $this->mSmarty->display('mods/profile/edit_artist/photo_one.html');
        }
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
		$this->mSmarty->assign('TotalPhotos', $photoCount);		
		$this->mSmarty->assign('totalpages', $totalpages);	
		
		$AllPhotos = Photo::ShowPhotoAll($this->mUser->mUserInfo['Id'] , $page , PHOTO_PER_PAGE);

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
		$this->mSmarty->assign('page', $page);
		if($ajaxMode)
			{	
				$res['data'] = $this->mSmarty->fetch('mods/profile/edit_artist/ajax/AllPhotoPagination.html');
				$res['userId'] = $this->mUser->mUserInfo['Id'];
				$res['page'] = $page;
				echo json_encode($res);				
				exit();					
			}
        $this->mSmarty->display('mods/profile/edit_artist/showphotosAll.html');		
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
		
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
		$this->mSmarty->assign('PhotoCounts', Photo::PhotoCounts($this->mUser->mUserInfo['Id']));						
		
		$photoCount = Photo::GetPhotosListFromAlbum($this->mUser->mUserInfo['Id'],$id);
		$totalPages = ceil(count($photoCount) / PHOTO_PER_PAGE);
		$photos = Photo::GetPhotoList($this->mUser->mUserInfo['Id'], $id, $page , PHOTO_PER_PAGE);			
		if($totalPages>$page)
		{
			$page = $page+1;
		} else {
			$page = 0;
		}

		
        //check album rights
        if ($id)
        {
            $album = PhotoAlbum::GetAlbum($id);
			$this->mSmarty->assign('album',$album);
			
			
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
                    uni_redirect(PATH_ROOT.'artist/photo?album_added&id=' . $id);
                }
                else
                {
                    //edit
                    PhotoAlbum::EditAlbum($id, trim(strip_tags(ucwords(strtolower($fm['Title'])))));
                    uni_redirect(PATH_ROOT.'artist/photo?album_updated');
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
        $this->mSmarty->assignByRef('AllPhotos', $photos);					
		$this->mSmarty->assign('page', $page);
		if($ajaxMode)
			{	
				$res['data'] = $this->mSmarty->fetch('mods/profile/edit_artist/ajax/albumPhotos.html');
				$res['userId'] = $this->mUser->mUserInfo['Id'];
				$res['AlbumId'] = $id;
				$res['page'] = $page;
				echo json_encode($res);				
				exit();					
			}
		$photoCount = Photo::GetCountAllPhotoAlbum($this->mUser->mUserInfo['Id']);
		$totalAlbum = $photoCount['CountAlbum'];
		$totalPhotos = $photoCount['CountPhoto'];
        $this->mSmarty->assign('totalAlbum', $totalAlbum);
		$this->mSmarty->assign('totalPhotos', $totalPhotos);
		$this->mSmarty->assign('photo_added', isset($_REQUEST['photo_added']) ? 1 : 0);
        $this->mSmarty->assign('photo_updated', isset($_REQUEST['photo_updated']) ? 1 : 0);
        $this->mSmarty->assign('photo_removed', isset($_REQUEST['photo_removed']) ? 1 : 0);
        $this->mSmarty->assign('album_removed', isset($_REQUEST['album_removed']) ? 1 : 0);
        $this->mSmarty->assign('album_added', isset($_REQUEST['album_added']) ? 1 : 0);
        $this->mSmarty->assign('album_updated', isset($_REQUEST['album_updated']) ? 1 : 0);
        $this->mSmarty->assign('id', $id);
        $this->mSmarty->display('mods/profile/edit_artist/photo_album.html');
    }

    /**
     * Add / Edit Photo
     */
    public function EditPhoto()
    {
        $id = _v('id', 0);
        $album = _v('album', 0);
        $rand_id = _v('rand_id', rand(100000, 999999));
        $this->mSmarty->assign('rand_id', $rand_id);
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
		
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
 	    
		//Atfer album add or edit albumStatus come from album function
		$this->mSmarty->assignByRef('albumStatus', $albumStatus);	
		
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
                $errs['Image'] = PLEASE_UPLOAD_PHOTO_FILE;
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
						$imgWatermark	=	BPATH.'files/photo/thumbs/'.$this->mUser->mUserInfo['Id'].'/'.$fn.'';						
						include_once 'libs/Crop/class.image.php';
						$imgObj = new simpleImage();
						$imgObj->load($imgWatermark);
						$imgObj->imageWaterMark();
						$imgObj->save($imgWatermark);
						
					}
                    //mid size
                    $mfn = MakeUserDir('files/photo/mid', $this->mUser->mUserInfo['Id']) . '/' . $fn;
                    //i_crop_copy(1000, 1400, BPATH . $dir . '/' . $fn,  BPATH . $mfn, 2);
					i_crop_copy(700, 700, BPATH . $dir . '/' . $fn,  BPATH . $mfn, 2);

                    //delete tmp
                    @unlink(BPATH . $image);
                    $this->mSession->Del('upl_photo_' . $rand_id);

                    $image = $fn;
                }

                if(!$fm['AlbumId'] && !empty($fm['AlbumTitle']))
                {
                    //create album first
                    $fm['AlbumId'] = PhotoAlbum::AddAlbum($this->mUser->mUserInfo['Id'], ucwords(strtolower($fm['AlbumTitle'])));
                }
			
				
                if (!$id)
                {
                    //get count photos in album
                    $count = PhotoAlbum::GetAlbumCountPhotos($fm['AlbumId']);
                    //add photo
				 $photoPrice = ((!empty($fm['PriceFree']) || empty($fm['Price'])) ? 0 : $fm['Price']);
				 $sld = (empty($fm['Slide']) ? 0 : $fm['Slide']);
                 $id = Photo::AddPhoto($this->mUser->mUserInfo['Id'], $fm['AlbumId'], $image, $sld, $photoPrice, ucwords(strtolower($fm['Title'])), $photo_date, ($count ? 0 : 1));
				 //
					$follow 	 = UserFollow::GetFollowersUserList($this->mUser->mUserInfo['Id'], USER_ARTIST);
					$fellow_fans = UserFollow::GetFollowersUserList($this->mUser->mUserInfo['Id'], USER_FAN);
				    include 'libs/Phpmailer_v5.1/class.phpmailer.php';										
					
																	
	                
					$artistName = $this->mUser->mUserInfo['Name'];
					$artistFirstName = $this->mUser->mUserInfo['FirstName'];
					$artistlastName = $this->mUser->mUserInfo['LastName'];
					$artistBandName = $this->mUser->mUserInfo['BandName'];

					$this->mSmarty->assign('artistName',$artistName);
	                $this->mSmarty->assign('artistFirstName', $artistFirstName);																						
	                $this->mSmarty->assign('artistlastName', $artistlastName);																											
		            $this->mSmarty->assign('artistBandName',$artistBandName);
										
					if($follow)
					{      		     
						foreach($follow as $followers)
						{
							$this->mSmarty->assign('name', $followers['FirstName'].' '.$followers['LastName']);  
							$this->mSmarty->assign('photoalbum', $fm);										
							$this->mSmarty->assign('userId',$this->mUser->mUserInfo['Id']);			
								
																																																				
							$this->mSmarty->assign('Image', $image);																				
							$fromEmail = ADMIN_EMAIL;
							$fromName = SITE_NAME;
							$toEmail = $followers['Email'];
							$toName = $followers['Name'];
							
							$subName = ($artistBandName)?$artistBandName:$artistFirstName.''.$artistlastName;
							$subject = $subName.' '.PHOTO_HAS_UPLOADED_FROM;
							
							$message = $this->mSmarty->fetch('mails/photo_add_notification.html');		
							sendEmail($fromEmail, $fromName,$toEmail, $toName, $subject, $message);												  
						}
			  
					}
					if($fellow_fans)
					{
						foreach($fellow_fans as $fellow_fanslist)
						{					
							$this->mSmarty->assign('name', $fellow_fanslist['FirstName'].' '.$fellow_fanslist['LastName']);  
							$this->mSmarty->assign('photoalbum', $fm);	
							$this->mSmarty->assign('userId',$this->mUser->mUserInfo['Id']);																																														
							$this->mSmarty->assign('Image', $image);															
							
							$fromEmail = ADMIN_EMAIL;
							$fromName = SITE_NAME;
							$toEmail = $fellow_fanslist['Email'];
							$toName = $fellow_fanslist['Name'];
							
							$subName = ($artistBandName)?$artistBandName:$artistFirstName.''.$artistlastName;
							$subject = $subName.' '.PHOTO_HAS_UPLOADED_FROM;
							
							$message = $this->mSmarty->fetch('mails/photo_add_notification.html');		

							sendEmail($fromEmail,$fromName, $toEmail, $toName, $subject, $message);					
						
						}					
					}				 
				 //
				 
				 
                    //new post on artist wall
                    $mesg = I_HAVE_JUST_ADDED_A.' <a href="/u/' . $this->mUser->mUserInfo['Name'] . '/photo/' . $fm['AlbumId'] . '?ph=' . $id . '"  name="popBox" id="popBox" rel="group1" >new photo</a> ';
                    $wallId = Wall::Add( $this->mUser->mUserInfo['Id'], $this->mUser->mUserInfo['Id'], $mesg, $tfn, '', 0, $this->mCache );
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
                    uni_redirect(PATH_ROOT.'artist/editphotoalbum?id=' . $fm['AlbumId'] . '&photo_added');
                }
                else
                {
                    //edit
				 $photoPrice = ((!empty($fm['PriceFree']) || empty($fm['Price'])) ? 0 : $fm['Price']);
				 $sld = (empty($fm['Slide']) ? 0 : $fm['Slide']);
                 $up = array('Title' => ucwords(strtolower($fm['Title'])), 'AlbumId' => $fm['AlbumId'], 'Slide' => $sld, 'Price' => $photoPrice, 'PhotoDate' => $photo_date);
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
                    }
					else
					{
						// if image has not updated
						$sourceImage = explode("/",$_REQUEST['sourceImage']);
						$sourceImage	=	$sourceImage[5];
				         if ($sourceImage!='' && $image=='')
							{
								include_once 'libs/Crop/Image_Transform.php';
								include_once 'libs/Crop/Image_Transform_Driver_GD.php';
								
								$pathinfo = pathinfo($sourceImage);
								$ext = ToLower($pathinfo['extension']);
								$dir = MakeUserDir('files/photo/origin', $this->mUser->mUserInfo['Id']);
								$fn = substr(md5(mktime()), 0, 10) . date("hm") . '.' . $ext;
								
								copy(BPATH .$dir.'/'. $sourceImage, BPATH . $dir . '/' . $fn);
			
								//photo thumbnail
								
			
								$tfn = MakeUserDir('files/photo/thumbs', $this->mUser->mUserInfo['Id']) . '/' . $fn;
								
								i_crop_copy(203, 168, BPATH . $dir . '/' . $fn,  BPATH . $tfn, 1);
								
								if($fm['Price']!=0)
								{
									$imgWatermark	=	BPATH.'files/photo/thumbs/'.$this->mUser->mUserInfo['Id'].'/'.$fn.'';		

									include_once 'libs/Crop/class.image.php';
									$imgObj = new simpleImage();
									$imgObj->load($imgWatermark);
									$imgObj->imageWaterMark();
									$imgObj->save($imgWatermark);									
									
								}
								//mid size
								$mfn = MakeUserDir('files/photo/mid', $this->mUser->mUserInfo['Id']) . '/' . $fn;
								//i_crop_copy(1000, 1400, BPATH . $dir . '/' . $fn,  BPATH . $mfn, 2);
								i_crop_copy(700, 700, BPATH . $dir . '/' . $fn,  BPATH . $mfn, 2);
			
								//delete tmp
								@unlink(BPATH . $sourceImage);
//								$this->mSession->Del('upl_photo_' . $rand_id);
			
								$image = $fn;
								
							}
							if ($fm['PriceFree'] && $sourceImage!='' && $image=='')
						 	{
							
								include_once 'libs/Crop/Image_Transform.php';
								include_once 'libs/Crop/Image_Transform_Driver_GD.php';
								$pathinfo = pathinfo($sourceImage);
								$ext = ToLower($pathinfo['extension']);
								$dir = MakeUserDir('files/photo/origin', $this->mUser->mUserInfo['Id']);
								$fn = substr(md5(mktime()), 0, 10) . date("hm") . '.' . $ext;
								
								copy(BPATH .$dir.'/'. $sourceImage, BPATH . $dir . '/' . $fn);
			
								//photo thumbnail
								
			
								$tfn = MakeUserDir('files/photo/thumbs', $this->mUser->mUserInfo['Id']) . '/' . $fn;
								
								i_crop_copy(203, 168, BPATH . $dir . '/' . $fn,  BPATH . $tfn, 1);
								
								if($fm['Price']!=0)
								{
									$imgWatermark	=	BPATH.'files/photo/thumbs/'.$this->mUser->mUserInfo['Id'].'/'.$fn.'';		

									include_once 'libs/Crop/class.image.php';
									$imgObj = new simpleImage();
									$imgObj->load($imgWatermark);
									$imgObj->imageWaterMark();
									$imgObj->save($imgWatermark);									
									
								}
								//mid size
								$mfn = MakeUserDir('files/photo/mid', $this->mUser->mUserInfo['Id']) . '/' . $fn;
								//i_crop_copy(1000, 1400, BPATH . $dir . '/' . $fn,  BPATH . $mfn, 2);
								i_crop_copy(700, 700, BPATH . $dir . '/' . $fn,  BPATH . $mfn, 2);
			
								//delete tmp
								@unlink(BPATH . $sourceImage);
//								$this->mSession->Del('upl_photo_' . $rand_id);
			
								$image = $fn;
							}
														
							
						$up['Image']  =  $image;
					
					}
                    Photo::EditPhoto($id, $up);
                    uni_redirect(PATH_ROOT.'artist/editphotoalbum?id=' . $fm['AlbumId'] . '&photo_updated');
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

        $this->mSmarty->display('mods/profile/edit_artist/photo_edit.html');
    }
	public function addPhotoNewAjax()
	{
		
        $id 			= $_REQUEST['id'];
        $photo_image 	= $_REQUEST['photo_image'];
        $PhotoTitle 	= $_REQUEST['AlbumDesc'];
        $AlbumTitle		= $_REQUEST['AlbumTitle'];		
        $rand_id 		= $_REQUEST['rand_id'];		
		//deb($id);		
        $this->mSmarty->assign('rand_id', $rand_id);
		$ui = & $this->mUser->mUserInfo;
	    if(empty($id) &&  !empty($AlbumTitle))				
		{
			 $getExistingAlbum = PhotoAlbum::getexistalbumbytitle($AlbumTitle);			
			 if($getExistingAlbum){
	        $res['existing'] = ALBUM_ALREADY_EXIST_PLEASE_TRY_AGAIN_WITH_OTHER_ALBUM_TITLE;				 
			 }else{
			 $id = PhotoAlbum::AddAlbum($this->mUser->mUserInfo['Id'], ucwords(strtolower($AlbumTitle)));	
			 }
		}		
		
		if($id)
		{
			if($id == -1)
			{
				$id = 0;
			}
			
			// add the photos in the old album
			$image = $this->mSession->Get('upl_photo_' . $rand_id);
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
					
						if($fm['Price']!=0)
						{
							$imgWatermark	=	BPATH.'files/photo/thumbs/'.$this->mUser->mUserInfo['Id'].'/'.$fn.'';						
							include_once 'libs/Crop/class.image.php';
							$imgObj = new simpleImage();
							$imgObj->load($imgWatermark);
							$imgObj->imageWaterMark();
							$imgObj->save($imgWatermark);
							
						}
						//mid size
						$mfn = MakeUserDir('files/photo/mid', $this->mUser->mUserInfo['Id']) . '/' . $fn;
						i_crop_copy(PHOTO_MID_IMAGE_SIZE_WIDTH, PHOTO_MID_IMAGE_SIZE_HEIGHT, BPATH . $dir . '/' . $fn,  BPATH . $mfn, 2);
	
						//delete tmp
						@unlink(BPATH . $image);
						$this->mSession->Del('upl_photo_' . $rand_id);
	
						$image = $fn;
						
						
             
			      //get count photos in album
                    $count = PhotoAlbum::GetAlbumCountPhotos($id);
                    //add photo
				 $sld = (empty($fm['Slide']) ? 0 : $fm['Slide']);
				 
				 $phId = Photo::AddPhoto($this->mUser->mUserInfo['Id'], $id, $image, $sld, 0, ucwords(strtolower($PhotoTitle)), $photo_date, 1);
				 PhotoAlbum::UpdateDateAlbum($id);
				 //
					$follow 	 = UserFollow::GetFollowersUserList($this->mUser->mUserInfo['Id'], USER_ARTIST);
					$fellow_fans = UserFollow::GetFollowersUserList($this->mUser->mUserInfo['Id'], USER_FAN);
				    include 'libs/Phpmailer_v5.1/class.phpmailer.php';										
					if($follow){      		     
					foreach($follow as $followers)
					{
	                $this->mSmarty->assign('name', $followers['FirstName'].' '.$followers['LastName']);  
	                $this->mSmarty->assign('photoalbum', $fm);										
	                $this->mSmarty->assign('userId',$this->mUser->mUserInfo['Id']);															
	                $this->mSmarty->assign('artistName',$this->mUser->mUserInfo['Name']);	
	                $this->mSmarty->assign('artistFirstName',$this->mUser->mUserInfo['FirstName']);																						
	                $this->mSmarty->assign('artistlastName',$this->mUser->mUserInfo['LastName']);																											
		            $this->mSmarty->assign('artistBandName',$this->mUser->mUserInfo['BandName']);																																														
	                $this->mSmarty->assign('Image', $image);																				
  					$fromEmail = ADMIN_EMAIL;
					$fromName = SITE_NAME;
					$toEmail = $followers['Email'];
					$toName = $followers['Name'];
					$subject = PHOTO_HAS_UPLOADED_FROM . SITE_NAME;
					$message = $this->mSmarty->fetch('mails/photo_add_notification.html');					
					//sendEmail($fromEmail,$fromName, $toEmail, $toName, $subject, $message);					
			  
					}
			  
					}
					if($fellow_fans){
					foreach($fellow_fans as $fellow_fanslist){					
	                $this->mSmarty->assign('name', $fellow_fanslist['FirstName'].' '.$fellow_fanslist['LastName']);  
	                $this->mSmarty->assign('photoalbum', $fm);	
	                $this->mSmarty->assign('userId',$this->mUser->mUserInfo['Id']);																				
	                $this->mSmarty->assign('artistName',$this->mUser->mUserInfo['Name']);		
	                $this->mSmarty->assign('artistFirstName',$this->mUser->mUserInfo['FirstName']);																						
	                $this->mSmarty->assign('artistlastName',$this->mUser->mUserInfo['LastName']);																											
		            $this->mSmarty->assign('artistBandName',$this->mUser->mUserInfo['BandName']);																																													
	                $this->mSmarty->assign('Image', $image);																			   
					$fromEmail = ADMIN_EMAIL;
					$fromName = SITE_NAME;
					$toEmail = $fellow_fanslist['Email'];
					$toName = $fellow_fanslist['Name'];
					$subject = PHOTO_HAS_UPLOADED_FROM . SITE_NAME;
					$message = $this->mSmarty->fetch('mails/photo_add_notification.html');					
					//sendEmail($fromEmail,$fromName, $toEmail, $toName, $subject, $message);					
				   
					}					
					}				 
				 //
				 
				 
                    //new post on artist wall					
                    $mesg = ''.$PhotoTitle;  //' <a href="/base/profile/showPhotoOne?id=' . $phId . '"  name="popBox" id="popBox" rel="group1" >new photo</a> ';
					$link = '/base/profile/showPhotoOne?id='.$phId.'';				
					
                    $wallId = Wall::Add( $this->mUser->mUserInfo['Id'], $this->mUser->mUserInfo['Id'], $mesg, $tfn, '', 0, $this->mCache,$link );
					Photo::UpdatePhotoWallId($phId, $wallId);
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
                            $facebook->api('/'.$this->mUser->mUserInfo['FbId'] . '/feed', 'POST', array('access_token' => $token, 'message' => strip_tags($mesg), 'link' => 'http://' . DOMAIN . '/u/' . $this->mUser->mUserInfo['Name'] . '/photo/' . $id . '?ph=' . $phId));
                        }
                        catch(FacebookApiException $e)
                        {
                        }
                    }
                
                }
				
			}
			else
			{
			// add new album and add photo to that album
	
			}
		$photoCount = Photo::GetCountAllPhotoAlbum($this->mUser->mUserInfo['Id']);	
		$this->mSmarty->assign('ui', $ui);
        $res['q'] = OK;	
		$res['UserId'] = $this->mUser->mUserInfo['Id'];
		$res['Id'] = $id;
		$res['PhotoName'] = $image;
		$res['totAlb'] = $photoCount['CountAlbum'];
		$res['totPhoto'] = $photoCount['CountPhoto'];		   	
		$this->mSmarty->assign('Append_IscoverPhotoName', $image);
		$this->mSmarty->assign('Append_PhotoTitle', $PhotoTitle);	
		$this->mSmarty->assign('Append_AlbumTitle', $AlbumTitle);	
			
		$this->mSmarty->assign('Append_UserId', $this->mUser->mUserInfo['Id']);		
		$this->mSmarty->assign('PhotoCounts', Photo::PhotoCounts($this->mUser->mUserInfo['Id']));								
		$this->mSmarty->assign('Append_Date', mktime());				
		$this->mSmarty->assign('Append_AlbumId', $id);				
		
		$res['AppendNewAlbum']	=	$this->mSmarty->Fetch('mods/profile/edit_artist/ajax/_photoNewAlbum.html');
		
		
		echo json_encode($res);
		exit();	
		
	}
	
	public function EditAjaxPhotoAlbum()
	{
        $id 			= $_REQUEST['id'];
        $title 			= $_REQUEST['title'];		
		PhotoAlbum::EditAlbum($id,ucwords(strtolower($title)));
		$res['q']	=	OK;
		$res['title']	=	$title;		
		echo json_encode($res);
		exit();	
	}	
	public function GetUpdatedPhotoTitleById(){
    $id 			= $_REQUEST['id'];
	$data = PhotoAlbum::GetAlbum($id);
	$res['q']	=	OK;
	$res['title']	=	$data['Title'];			
	$res['id']	=	$data['Id'];	
				
	echo json_encode($res);
	exit();	

	
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
            uni_redirect(PATH_ROOT . 'artist/editphotoalbum?id=' . $photo['AlbumId']);
        }
        uni_redirect(PATH_ROOT . 'artist/photo');
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
			$res['totAlb'] = $photoCount['CountAlbum'];
			$res['totPhoto'] = $photoCount['CountPhoto'];
	   		$res['q'] = OK; 
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
        if ($id)
        {
            $album = PhotoAlbum::GetAlbum($id);
            if (empty($album) || $album['UserId'] != $this->mUser->mUserInfo['Id'])
            {
                $id = 0;
                $album = array();
            }
        }
        if($id)
        {
            $photos = Photo::GetPhotoList($this->mUser->mUserInfo['Id'], $id);
            foreach($photos as $item)
            {
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
        }
		PhotoAlbum::Remove($id);
		$photoCount = Photo::GetCountAllPhotoAlbum($this->mUser->mUserInfo['Id']);
		$res['q'] = OK; 
		$res['totAlb'] = $photoCount['CountAlbum'];
		$res['totPhoto'] = $photoCount['CountPhoto'];
		echo json_encode($res);
		exit();
      //  uni_redirect(PATH_ROOT . 'artist/photo?album_removed');
    }
	
    public function ExportData()
    {
		$header = " \nFans Information\n\n";
		$header .= " Name , Gender , DOB , Email , Location \r\n";
		
		$fan_ids = _v('fan_ids', '');
		$fan_ids = substr($fan_ids,0,-1);

		$fans = UserFollow::GetFollowersUserList($this->mUser->mUserInfo['Id'], 1, '', '', $fan_ids);
//deb($fans);
		foreach($fans as $value)
		{
			$gen = $value['Gender'];
			if($gen == 1)
			{
				$gen = "Male";
			}
			elseif($gen == 2)
			{
				$gen = "Female";
			}
			else
			{
				$gen = "--";
			}

			$ymd = strtotime($value['Dob']);
			$dob = date("d-m-Y", $ymd);

			$header .= " ".$value['FirstName']." ".$value['LastName']." , ".$gen." , ".$dob." , ".$value['Email']." , ".$value['Location']."\n";
		}
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=export.csv");
		header("Pragma: no-cache");
		header("Expires: 0");
		print "$header"; 
		die;		
	}	

    public function ExportViewersReport()
    {
		$header = " \n Broadcast Viewers Report\n\n";		
		
		$viewers_ids = _v('viewers_ids', '');
		$viewers_ids = substr($viewers_ids,0,-1);		
		$event_id = _v('id', '');
		
		$event = Event::GetEvent($event_id, $this->mUser->mUserInfo['Id']);

		$datetime = new DateTime($event['EventDate']);
		$eDate = " ".$datetime->format('F j, Y')." ";
		$eTime = " ".$datetime->format('g:i A')." ";

		$viewers = BroadcastViewers::GetListViewersReport($this->mUser->mUserInfo['Id'], $event_id);					
		$broadcastTime = BroadcastFlows::GetEventFirstFlowDate($this->mUser->mUserInfo['Id'], $event_id);
		
		$totalPrice =0;
		foreach($viewers['list'] as $val)
		{
			$totalPrice += $val['Price'];
		}
		
		$datetime = new DateTime(date('y-m-d H:i:s', $broadcastTime));
		$bDate = " ".$datetime->format('F j, Y')." ";	
		
		$header .= '"'.trim('Event Title :'.$event['Title']).'"';
		$header .="\r\n";		
		$header .= '"'.trim('Event Time :'.$eDate.'|'.$eTime).'"';			
		$header .="\r\n";				
		$header .= '"'.trim('Broadcast Time :'.$bDate).'"';
		$header .="\r\n";				
		$header .= '"'.trim('Event Total :$'.number_format($totalPrice, 2)).'"';		
		$header .="\r\n\r\n";				
								
		$header .= " Viewers , Price \r\n";				
		
		foreach($viewers['list'] as $value)
		{
			$arr = array();			
			$arr[] = $value['Name'];
			$arr[] = '$'.number_format($value['Price'], 2);
								
			$list = implode($arr, '","');
			$list = '"'.trim($list, ',"').'"';
			$header .= $list."\r\n";
		}
		
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=viewerReport.csv");
		header("Pragma: no-cache");
		header("Expires: 0");
		print "$header"; 
		die;		
	}	

	
    /**
     * News feed
     * @return void
     */
    public function Feed()
    {
	
        $this->mSmarty->assign('module', 'feed');
		
		$this->mSmarty->assign('feedWall', 1);	
				
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
		
        $this->mSmarty->display('mods/profile/edit_artist/feed.html');
        exit();
    }	
	
	public function PricedPhotos()
	{
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
			
		$userId	=	$_REQUEST['id'];		
        $sql = sprintf('SELECT * FROM `photo_purchase` inner join photo on photo.id = photo_purchase.photo_id where photo_purchase.user_id = "'.$userId.'" ORDER BY `photo_purchase`.`id`  DESC');
	  	 $photos = Query::GetAll($sql);		 
		 $this->mSmarty->assign('pricedphotos',$photos);		 
         $this->mSmarty->display('mods/profile/edit_artist/priced_photos.html');
	}	

	public function PricedPhotoLightBox()
	{
        $this->mSmarty->assign('module', 'photo');
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
				
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
            $this->mSmarty->display('mods/profile/edit_artist/SinglePopup.html');
        
    }
	public function pricedvideos()
	{
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
			
        $this->mSmarty->assign('module', 'video');

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
				
		if($delete_video_id)
		{
			 VideoPurchase::PurchaseDeleteUpdate($this->mUser->mUserInfo['Id'], $delete_video_id);			 

		    $this->mSmarty->assignByRef('videos', Video::GetPurchasedVideoList( $this->mUser->mUserInfo['Id'], 0 ));
			$res['q'] = OK;
			
			$res['data'] = $this->mSmarty->Fetch('mods/profile/edit_artist/ajax/pricedfilter_video.html');
			
        	echo json_encode($res);
			exit();			
		}
				
        if (!$id)
        {
            //video list
            $this->mSmarty->assignByRef('videos', Video::GetPurchasedVideoList( $this->mUser->mUserInfo['Id'], 0 ));
            //broadcast recordings
            //get events with purchased access
            $event_ids = Event::FinishedEventsPurchasedList($this->mUser->mUserInfo['Id']);
            /*
			$recordings = EventVideo::GetListEventsRecordings(0, $event_ids);
            $this->mSmarty->assignByRef('recordings', $recordings);
			*/
            $this->mSmarty->display('mods/profile/edit_artist/pricedvideo.html');
        }
        else
        {
            if(!$is_broadcasting)
            {
                //show one video
                $video = Video::GetVideoInfo($id, 0, 1);
                if (empty($video))
                {
                    uni_redirect( PATH_ROOT . 'artist/video' );
                }
                $video['VideoPurchase'] = VideoPurchase::Get($this->mUser->mUserInfo['Id'], $id);
                if(empty($video['VideoPurchase']))
                {
                    uni_redirect( PATH_ROOT . 'artist/video' );
                }
                $this->mSmarty->assignByRef('video', $video);
            }
            else
            {
                //show broadcasting recording
                $video = EventVideo::Get($id, 1);
                if(empty($video))
                {
                    uni_redirect( PATH_ROOT . 'artist/video' );
                }
                $video['VideoPurchase'] = EventPurchase::Get($this->mUser->mUserInfo['Id'], $video['EventId']);
                $video['Status'] = 2;
                $this->mSmarty->assignByRef('video', $video);
				$this->mSmarty->assign('broadcasting', 1);
            }
            $this->mSmarty->display('mods/profile/edit_artist/pricedvideo_one.html');
        }
        exit();
    
	}
	
	public function artistsevents()
	{
        $this->mSmarty->assign('module', 'events');
        $id = _v('id', 0);
		
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
				
        if (!$id)
        {
            //show events list
            $page = _v('page', 1);
            $pcnt = 10;
            $df = _v('df', '');
            $df = !in_array($df, array('tw', 'nw', 'tm', 'nm', 'up', 'all','pa')) ? '' : $df;
            $this->mSmarty->assignByRef('df', $df);
			//$follow = UserFollow::GetFollowList( $this->mUser->mUserInfo['Id'] );
			$follow = UserFollow::GetFollowersUserListIds( $this->mUser->mUserInfo['Id'], 0);
			$artist_arr = array();
			$follower_events =array();
			foreach($follow as $val)
			{
				array_push($artist_arr, $val['Id']);					
			}
			$test = Event::GetPeriod($df);
			$follower_events = Event::FelowArtistEventList($this->mUser->mUserInfo['Id'], $artist_arr, $page, $pcnt, Event::GetPeriod($df),'','','',$df);
			//deb($follower_events);

			$this->mSmarty->assignByRef('follower_events', $follower_events);			
			$rcnt = Event::FelowArtistEventListCount($this->mUser->mUserInfo['Id'], $artist_arr, Event::GetPeriod($df), '', '', $df);
			
            include_once 'model/Pagging.class.php';
            $link = PATH_ROOT . 'artist/artistsevents' . ($df ? '?df=' . $df : '');
            $mpg = new Pagging($pcnt, $rcnt, $page, $link);
            $pagging = $mpg->Make2($this->mSmarty, 0, 1);
            $this->mSmarty->assignByRef('pagging', $pagging);
            $this->mSmarty->assignByRef('events', $events);			
            $this->mSmarty->assignByRef('artists', $artists);
            $this->mSmarty->display('mods/profile/edit_artist/pricedevents.html');
			
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
            $this->mSmarty->display('mods/profile/edit_artist/pricedevent_one.html');
        }
        exit();
    } 
	
	public function EventCropOption()
	{			
		$rand_id = _v('rand_id', 0);
		// $rand_id = _v('rand_id', rand(100000, 999999));		 
        include_once 'model/FileUpload.class.php';
        $mFu = new FileUpload(array('jpg', 'jpeg', 'gif', 'png'));
		
        //upload to tmp directory
        $result = $mFu->handleUpload( 'files/photo/tmp/');

		$tmpFileName = 'files/photo/tmp/'.$result['name'];
		list($width, $height) = getimagesize($tmpFileName);
		
		//print_r($width.'--'.$height);
		
		if($width < HOME_SLD_EVENTS_WIDTH || $height < HOME_SLD_EVENTS_HEIGHT){ 
			@unlink($tmpFileName);
			echo json_encode(array('success'=>false, 'message'=> HOMEPAGE_EVENT_SLIDE_IMAGE_SIZE_ERR));
			exit;
		}
		
        if (!empty($result['success']) && 1==$result['success'])
        {
            $this->mSession->Set( 'upl_photo_'.$rand_id, $mFu->GetSavedFile() );
            $result['photo'] = $mFu->GetSavedFile();
			include_once BPATH. 'libs/Crop/class.image.php';
			$imgObj = new simpleImage();
			$imgObj->load($result['photo']);
			$imgObj->resizeToWidth(769);
			$imgObj->save($result['photo']);
			$result['width'] = $imgObj->getWidth();
			$result['height'] = $imgObj->getHeight();

        }

        echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
        exit();
    	
	} 
	public function multiselector()
	{
	
			$genres_list = User::GetGenresList();
			$this->mSmarty->assignByRef('genres_list', $genres_list);
		    $this->mSmarty->display('mods/profile/edit_artist/multi_selecter.html');
	}
	
	public function musicUploadStep3()
	{
		 	$this->mSmarty->assign('module', 'music');
			
			$AlbumId = _v('AlbumId', 0);
			$PublishId = _v('PublishId', 0);
			$SaveLaterId =_v('SaveLaterId', 0);
			if($AlbumId)
			{
				$albumInfo = MusicAlbum::GetAlbum($AlbumId, 0, 1);
				$discountPrice = ($albumInfo['TracksPrice'] * ALBUM_DISCOUNT_PERCENT)/100;
				$albumMaxPrice = $albumInfo['TracksPrice'] - $discountPrice;
				$this->mSmarty->assign('albumMaxPrice', $albumMaxPrice);
				$this->mSmarty->assign('discountPrice', $discountPrice);
				$this->mSmarty->assign('albumInfo', $albumInfo);
				$this->mSmarty->assign('dateRealse', $albumInfo['DateRelease']);
				
				if($albumInfo['Tracks'] > 0)
				{
					$trackList = MusicAlbum::GetAlbumTracks($albumInfo['Id']);
					$freeTrack = MusicAlbum::GetCountofFreeTrack($albumInfo['Id']);
					$this->mSmarty->assign('freeTrack', $freeTrack);
					$this->mSmarty->assign('trackList', $trackList);
				}
				
				$this->mSmarty->display('mods/profile/edit_artist/musicUploadStep3.html');
				exit();
			}
			if($PublishId)
			{
				    $albumInfo = MusicAlbum::GetAlbum($PublishId, 1, 1);
					
					if($albumInfo['Price'] > 0)
					{
						$MaUp = array('Active' => 1, 'AlbumPayMore' => 1);
						
					}else{
					
						$MaUp = array('Active' => 1, 'AlbumPayMore' => 0);
					}
					
					MusicAlbumQuery::create()->select('Id')->filterById($PublishId)->update($MaUp);	

				 	uni_redirect( PATH_ROOT . 'artist/music');
			}
			
			if($SaveLaterId)
			{
				$MaUp = array('Active' => 0, 'AlbumPayMore' => 2);
				MusicAlbumQuery::create()->select('Id')->filterById($SaveLaterId)->update($MaUp);
				uni_redirect( PATH_ROOT . 'artist/music');
			}
	}
	
	
	public function AlbumEditData()
	{
			$AlbumId = _v('AlbumId', 0);
			$albumInfo = MusicAlbum::GetAlbum($AlbumId, 0, 1);
			$genres_list = User::GetGenresList();
			$discountPrice = ($albumInfo['TracksPrice'] * ALBUM_DISCOUNT_PERCENT)/100;
			$albumMaxPrice = $albumInfo['TracksPrice'] - $discountPrice;
			$this->mSmarty->assign('genreslist', $genres_list);
			$this->mSmarty->assign('albumMaxPrice', $albumMaxPrice);
			$this->mSmarty->assign('discountPrice', $discountPrice);
			$this->mSmarty->assign('albumInfo', $albumInfo);
			$res['q'] = OK; 
			$res['data'] = $this->mSmarty->fetch('mods/profile/edit_artist/ajax/edit_music_album_step3.html');		
			echo json_encode($res);
			exit();
	}
	
	public function SaveAlbumData()
	{
		
				 include_once 'model/Valid.class.php';
			     $mached = MusicAlbum::checkAlbumNameExist($this->mUser->mUserInfo['Id'], $_REQUEST['Title']);
				 $albumInfo = MusicAlbum::GetAlbum($_REQUEST['Id'], 0, 1);
				 $ti = Valid::String($_REQUEST, 'Title');
				 $validtitle = strcmp($albumInfo['Title'], $_REQUEST['Title']);
				 
				 if(!empty($_REQUEST['DateRelease']))
				 {
				 	 $date_release = Valid::Date($_REQUEST, 'DateRelease');
				 }
				 
				 if($mached == 1 && !$validtitle == 0)
				 {
				 	$res['Error'] = ALBUM_NAME_ALREADY_EXIST;
				 }
				 // as per client request we removed discount price for album edit price
				 /*elseif($_REQUEST['AlbumDiscountPrice'] > $_REQUEST['AlbumPrice'])
				 {
				 	$res['priceError'] = YOU_ARE_NOT_ALLOW_TO_REDUCE_THE_ALBUM_PRICE;
				 }*/
				 else
				 {
				 	$up = array('Title' => ucwords(strtolower($_REQUEST['Title'])), 'Price' => $_REQUEST['Price'], 'Genre' => $_REQUEST['Genre'], 'DateRelease' => $date_release, 'Descr' => $_REQUEST['Descr']);
					MusicAlbumQuery::create()->select('Id')->filterById($_REQUEST['Id'])->update($up);
					$albumInfo = MusicAlbum::GetAlbum($_REQUEST['Id'], 0, 1);
					//$realeaseDate = mktime($albumInfo['DateRelease']);
					$freeTrack = MusicAlbum::GetCountofFreeTrack($_REQUEST['Id']);
					$discountPrice = ($albumInfo['TracksPrice'] * ALBUM_DISCOUNT_PERCENT)/100;
					$albumMaxPrice = $albumInfo['TracksPrice'] - $discountPrice;
					$this->mSmarty->assign('albumMaxPrice', $albumMaxPrice);
					$this->mSmarty->assign('discountPrice', $discountPrice);
					$this->mSmarty->assign('freeTrack', $freeTrack);
					$this->mSmarty->assign('albumInfo', $albumInfo);
					$this->mSmarty->assign('dateRealse', $albumInfo['DateRelease']);
					$res['q'] = OK; 
					$res['data'] = $this->mSmarty->fetch('mods/profile/edit_artist/ajax/album_track_updated.html');		
				 }
				echo json_encode($res);
				exit();
	}
	
		
	public static function EditAlbumDetails()
	{
		$this->mSmarty->assign('module', 'music');
		
		$AlbumId = _v('id', 0);
		
		$albumInfo = MusicAlbum::GetAlbum($AlbumId, 0, 1);
		$this->mSmarty->assign('albumInfo', $albumInfo);
		$discountPrice = ($albumInfo['TracksPrice'] * ALBUM_DISCOUNT_PERCENT)/100;
		$albumMaxPrice = $albumInfo['TracksPrice'] - $discountPrice;
		$this->mSmarty->assign('albumMaxPrice', $albumMaxPrice);
		$this->mSmarty->assign('discountPrice', $discountPrice);
		if($albumInfo['Tracks'] > 0)
		{
					$trackList = MusicAlbum::GetAlbumTracks($albumInfo['Id']);
					$freeTrack = MusicAlbum::GetCountofFreeTrack($albumInfo['Id']);
					$this->mSmarty->assign('freeTrack', $freeTrack);
					$this->mSmarty->assign('trackList', $trackList);
					
		}
	 	$this->mSmarty->display('mods/profile/edit_artist/edit_music_album.html');		
	}	
		
	public static function SaveMusicOrder()
	{
        $res = array('q' => 'ok');
        $id = _v('id', 0);	
        $saveOrder = _v('saveOrder', 0);	
		Music::musicOrder($id, $saveOrder);
		echo json_encode($res);
		exit();			
	}
	
	public function updateMusicSaveOrder()
	{
			$AlbumId = _v('Id', 0);
			$albumInfo = MusicAlbum::GetAlbum($AlbumId, 0, 1);
			//deb($albumInfo);
			$this->mSmarty->assignByRef('albumInfo', $albumInfo);
			$this->mSmarty->assignByRef('dateRealse', $albumInfo['DateRelease']);
			if($albumInfo['Tracks'] > 0)
			{
					$trackList = MusicAlbum::GetAlbumTracks($AlbumId);
					$freeTrack = MusicAlbum::GetCountofFreeTrack($AlbumId);
					$this->mSmarty->assign('freeTrack', $freeTrack);
					$this->mSmarty->assign('trackList', $trackList);
			}
		$res['q'] = OK; 
		$res['message'] = $this->mSmarty->fetch('mods/profile/edit_artist/ajax/updateSaveOrder.html');
		$res['success'] = true;
		echo json_encode($res);
		exit();		
	}

    
}
