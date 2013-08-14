<?php

class Base_User extends Base
{
    public function __construct($glObj)
    {
        parent :: __construct($glObj);
    }

    /**
     * Login form
     * @return void
     */
    public function Login()
    {
		if($this->mlObj['mSession']->Get('nactive'))
        {
			 $this->mSmarty->assign('err', YOUR_SESSION_EXPIRED_LOGIN_AGAIN);
			 $this->mlObj['mSession']->Del('nactive');
		}				
        if ($this->mUser->IsAuth())
        {
//			$this->mlObj['mSession']->Del('nactive');
            $redirect = $this->GetRedirectUrl();
			if($redirect)
			{
				if(preg_match('/WallLoad|FeedLoad|AjaxNotificationCount/i', $redirect) == false)
				{				
					uni_redirect(PATH_ROOT . $redirect);
				} 
			}	
			uni_redirect(PATH_ROOT . 'u/'.$this->mUser->mUserInfo['Name']);
        }
		

        if($this->mlObj['mSession']->Get('error'))
        {
				
            $this->mSmarty->assign('error', $this->mlObj['mSession']->Get('error'));
            $this->mlObj['mSession']->Del('error');
        }
        if($this->mlObj['mSession']->Get('notice'))
        {
		
            $this->mSmarty->assign('notice', $this->mlObj['mSession']->Get('notice'));
            $this->mlObj['mSession']->Del('notice');
        }

        if (!empty($_REQUEST['system_login']))
        {
			
            $this->mSmarty->assign('loginerr', 1);
            $this->mSmarty->assign('system_login_data', $_REQUEST['system_login']);
			if(is_string($this->mUser->mLastAuthResult)) {
				$error = YOUR_ACCOUNT_WAS_BLOCKED_REASON . $this->mUser->mLastAuthResult;
			} 
			elseif($this->mUser->mLastAuthResult == 3){
				$error = THE_EMAIL_PASSWORD_YOU_ENTERED_IS_INCORRECT_PLEASE_TRY_AGAIN;
			}
			elseif($this->mUser->mLastAuthResult == 2){
				$error = THE_EMAIL_PASSWORD_YOU_ENTERED_IS_INCORRECT_PLEASE_TRY_AGAIN;
			}
			elseif($this->mUser->mLastAuthResult == 7 ){
				$error = YOU_ARE_ALREADY_LOGGED_IN_ANOTHER_SYSYTEM;
			}
			else if($this->mUser->mLastAuthResult == 5 )
			{		
			       
					if ($this->mUser->mUserType == USER_ARTIST) 
						$error = ADMIN_NEED_TO_APPROVE_YOUR_PROFILE_PLEASE_CHECK_LATER;
					elseif($this->mUser->mUserType == USER_FAN) 
						$error = THIS_EMAIL_ADDRESS_HAS_NOT_BEEN_CONFIRMED_YET;
			}			
            $this->mSmarty->assign('loginerr_text', $error);
		
			
        }
		if($_REQUEST['err'])
		{
			 $this->mSmarty->assign('err', TO_CREATE_YOUR_FB_ACCOUNT_SELECT_STATUS);
		}
		
        $this->mSmarty->display('mods/user/login.html');
    }

    public function ResendEmail()
    {
			
        if ($this->mUser->IsAuth())
        {
            uni_redirect(PATH_ROOT . 'u/'.$this->mUser->mUserInfo['Name']);
        }
        $err = '';
        if (!empty($_REQUEST['email']))
        {
            $email = !empty($_REQUEST['email']) && verify_email($_REQUEST['email']) ? $_REQUEST['email'] : '';

            if (empty($email))
            {
                $err = PLEASE_SPECIFY_CORRECT_EMAIL;
            }

            if(empty($err))
            {
                $ui = UserQuery::create()
                            -> select(array('Id', 'Email', 'Checksum', 'Name'))
                            -> filterByEmail($email)
                            -> filterByEmailConfirmed(0)
                            -> findOne();
                if (empty($ui))
                {
                    $err = NO_USERS_FOUND_WITH_THAT_NOT_CONFIRMED_EMAIL;
                }
                else
                {
					$name = $ui['BandName'] ? $ui['BandName'] : $ui['FirstName'].' '.$ui['LastName'];				
                    $this->mSmarty->assign('checksum', $ui['Checksum']);
                    $this->mSmarty->assign('name', $name);
                    $this->mSmarty->assign('email', $ui['Email']);
                    $this->mSmarty->assign('SITE_NAME', SITE_NAME);
                    $this->mSmarty->assign('DOMAIN', DOMAIN);
					/* Send Email */
					$fromEmail = ADMIN_EMAIL;
					$fromName = SITE_NAME;
					$toEmail = $ui['Email'];
					$toName = $name;
					$subject = REGISTRATION . SITE_NAME;
					$message = $this->mSmarty->fetch('mails/mail_confirm.html');
					sendEmail($fromEmail,$fromName, $toEmail, $toName, $subject, $message);
                    echo json_encode(array('q' => OK ));
                }
            }
            if(!empty($err) && $_REQUEST['ajaxMode'])
            {
                echo json_encode(array('q' => ERR, 'err' => $err));
            }
            exit();
        }

        $this->mSmarty->display('mods/user/resend.html');
    }


    /**
     * Select registration type
     * @return void
     */
	 
    public function RegistrationSelect()
    {

        if (!empty($_POST))
        {
            if (!empty($_POST['status']) && in_array($_POST['status'], array(1, 2)))
            {
                //redirect to second step
                uni_redirect(PATH_ROOT.'reg/?status=' . $_POST['status']);
            }
            else
            {
                $errs['status'] = PLEASE_SELECT_YOUR_ROLE;
            }

            if (!empty($errs))
            {
                $this->mSmarty->assignByRef('errs', $errs);
            }
        }
        if($this->mlObj['mSession']->Get('error'))
        {
            $this->mSmarty->assign('error', $this->mlObj['mSession']->Get('error'));
            $this->mlObj['mSession']->Del('error');
        }
        $this->mSmarty->assign('FB_AUTH',  ($this->mUser->IsAuth() && (($this->mUser->mUserInfo['FbId'] && !$this->mUser->mUserInfo['FbStart']) || ($this->mUser->mUserInfo['TwId'] && !$this->mUser->mUserInfo['TwStart'] ))) ? 1 : 0);
		
        $this->mSmarty->display('mods/user/registration_select.html');
    }


    /**
     * Registration form
     * @return void
     */
	 
    public function Registration()
    {
	
		if($this->mlObj['mSession']->Get('error'))
        {				
            $this->mSmarty->assign('error', $this->mlObj['mSession']->Get('error'));
            $this->mlObj['mSession']->Del('error');
        }
		
        if ($this->mUser->IsAuth() && ((!$this->mUser->mUserInfo['FbId']  || $this->mUser->mUserInfo['FbStart']) && (!$this->mUser->mUserInfo['TwId'] || $this->mUser->mUserInfo['TwStart'])))
        {
            uni_redirect( PATH_ROOT . 'u/'.$this->mUser->mUserInfo['Name'] );
        }

        //fb/tw auth status
        define('FB_AUTH',  (($this->mUser->IsAuth() && ($this->mUser->mUserInfo['FbId'] && !$this->mUser->mUserInfo['FbStart'] || $this->mUser->mUserInfo['TwId'] && !$this->mUser->mUserInfo['TwStart'] )) || $_SESSION['fbAuth_fbId']  || $_SESSION['twAuth_name']) ? 1 : 0);
		

        $this->mlObj['mSession']->Del('regstatus');
        //user status
        $status = _v('status', 0);
        if ( !in_array($status, array(1, 2)) )
        {
            uni_redirect( PATH_ROOT . 'base/user/login' );
        }
        $this->mSmarty->assign('status', $status);
		
        //ajax registration submit
        if (!empty($_POST['fm']))
        {
            $fm = $_POST['fm'];
			
            include_once 'model/Valid.class.php';

            $errs = array();

            foreach ($fm as &$v)
            {
                if (!is_array($v))
                {
                    $v = trim(strip_tags($v));
                }
            }
            unset($v);


				// Email feild 
				
				if (empty($fm['email']) || !verify_email($fm['email']))
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
					if (!empty($eml) && $eml != $this->mUser->mUserInfo['Id'])
					{
						$errs['email'] = USER_WITH_THAT_EMAIL_ALREADY_EXIST;
					}
				}
				
				// Password feild
                if (empty($fm['pass']))
                {
                    $errs['pass'] = PLEASE_SPECIFY_PASSWORD;
                }
                elseif (strlen($fm['pass']) < 6)
                {
                    $errs['pass'] = MIN_PASSWORD_LENGTH_6_SYMBOLS;
                    $fm['pass'] = '';
                    $fm['pass2'] = '';
                }
				/*
                elseif (empty($fm['pass2']) || strlen($fm['pass2']) < 6)
                {
                    $errs['pass2'] = PLEASE_REPEAT_PASSWORD;
                    $fm['pass'] = '';
                    $fm['pass2'] = '';
                }
                elseif ($fm['pass2'] != $fm['pass'])
                {
                    $errs['pass'] = PASSWORDS_DO_NOT_MATCH;
                    $fm['pass'] = '';
                    $fm['pass2'] = '';
                }
				
				// First name Field
				if (empty($fm['first_name']))
				{
					$errs['first_name'] = PLEASE_SPECIFY_FIRST_NAME;
				}
				
				// Last name Field
				if (empty($fm['last_name']))
				{
					$errs['last_name'] = PLEASE_SPECIFY_LAST_NAME;
				}

				if (!empty($fm['first_name']) && strlen($fm['first_name']) > 26)
				{
					$errs['first_name'] = MAX_FIRST_NAME_LENGTH_26_SYMBOLS;
				}

				if (!empty($fm['last_name']) && strlen($fm['last_name']) > 26)
				{
					$errs['last_name'] = MAX_LAST_NAME_LENGTH_26_SYMBOLS;
				}
				*/
				// Name Field
				if (empty($fm['name']))
				{
					$errs['name'] = PLEASE_SPECIFY_USERNAME;
				}
				else
				{
					$regName = '/^([a-zA-Z0-9_\-])+$/';
					$matches = array();
					if (!preg_match($regName, $fm['name'], $matches))
					{
						$errs['name'] = USERNAME_MUST_CONTAIN_ALPHABETS_AND_NUMERICS_WITHOUT_ANY_SPACE;
					}
					elseif (strlen($fm['name']) > 40)
					{
						$errs['name'] = MAX_USERNAME_LENGTH_40_SYMBOLS;
					}
					else
					{
						$usr = UserQuery::create()->Select(array('Id'))
								->where('LOWER(user.name)="' . mysql_escape_string(ToLower($fm['name'])) . '"');
						if($this->mUser->IsAuth())
						{
							$usr = $usr -> filterById($this->mUser->mUserInfo['Id'], Criteria::NOT_EQUAL);
						}
						$usr = $usr->findOne();
	
						if (!empty($usr))
						{
							$errs['name'] = USER_WITH_THAT_USERNAME_ALREADY_EXISTS;
						}
					}
				}
			
            if (empty($errs))
            {
				$mUser = new User();
                $mUser->setEmail($fm['email']);
				$mUser->setAltEmail(serialize(array($fm['email'])));
                //$mUser->setFirstName(ucwords(strtolower($fm['first_name'])));
                //$mUser->setLastName(ucwords(strtolower($fm['last_name'])));
                $mUser->setName($fm['name']);
                $mUser->setStatus(ucwords(strtolower($status))); //1 - fan, 2 - artist
                //password && checksum
           		$orig_pass = $fm['pass'];
                $this->mUser->mRc4->crypt($fm['pass']);
                $fm['pass'] = bin2hex($fm['pass']);
                $mUser->setPass($fm['pass']);
                $mUser->setRegDate(mktime());

                if(!FB_AUTH || ($this->mUser->IsAuth() && $this->mUser->mUserInfo['Email'] != $fm['email']))
                {
                    //if not facebook or twitter registration or email was changed
                    $checksum = substr(md5(mktime() . rand(11, 99)), 0, 10);
                    $mUser->setChecksum($checksum);
                }
				
				
                if(FB_AUTH)
                {
                    if($this->mSession->Get('fbAuth_fbId'))
                    {
						$mUser->setFbId($this->mSession->Get('fbAuth_fbId')); 
                        $mUser->setFbStart(1);
                    }
                    else if(($this->mUser->mUserInfo['TwId'] && !$this->mUser->mUserInfo['TwStart']) || $this->mSession->Get('twAuth_name'))
                    {
						$tw_session = $_SESSION['access_token'];
						$mUser->setTwStart(1);
          		        $mUser->setTwId($tw_session['user_id']);
          		        $mUser->setTwOauthToken($tw_session['oauth_token']);
                        $mUser->setTwOauthTokenSecret($tw_session['oauth_token_secret']);
                    }
                }

                //additional fields for fan
                if (USER_FAN==$status)
                {	
					$mUser->setEmailConfirmed(1);
                }
				else
				{
					$mUser->setEmailConfirmed(0);
				}
				$avator = $this->mUser->mUserInfo['Avatar'];
				
				if(USER_ARTIST==$status)
				{
					$mUser->setCountry('US');
				}

              	$mUser->save();
				$usrId = $mUser->getId();
				$this->mlObj['mSession']->Set('usrId', $usrId);
								
				if($usrId)
				{						
					$abumId = PhotoAlbum::AddAlbum($usrId, trim(strip_tags(BANNER_IMAGES)));
					$userDetail = UserQuery::create()->Select(array('Id', 'Email', 'Status', 'Pass', 'FirstName', 'LastName', 'BandName', 'Name', 'Blocked', 'BlockReason', 'Avatar', 'Location', 'About', 'Wallet', 'WalletBlock', 'IsOnline', 'AltEmail', 'UserPhone', 'FbId', 'FbToken'));
         		    $userDetail = $userDetail->filterById($usrId)->findOne();	
				
					//**add fb profile photo add
					if( $userDetail['Avatar'] == '' && $userDetail['FbId'] != '')
					{
						$fbimage = 'https://graph.facebook.com/'.$userDetail['FbId'].'/picture?width=400&height=400';
								
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
					
							$crop_fnamem = 'files/images/avatars/m_user_'.$userDetail['Id'].$rand.'.jpg';
							i_crop_copy(USER_MEDIUM_IMAGE_WIDTH, USER_MEDIUM_IMAGE_HEIGHT, $newImage,  BPATH .$crop_fnamem, 1);
					
							$crop_fnames = 'files/images/avatars/s_user_'.$userDetail['Id'].$rand.'.jpg';
							i_crop_copy(USER_PROFILE_IMAGE_WIDTH, USER_PROFILE_IMAGE_HEIGHT, $newImage,  BPATH .$crop_fnames, 1);
					
							$crop_fnamex = 'files/images/avatars/x_user_'.$userDetail['Id'].$rand.'.jpg';
							i_crop_copy(USER_THUMB_IMAGE_WIDTH, USER_THUMB_IMAGE_HEIGHT,  BPATH .$crop_fnames, BPATH .$crop_fnamex, 1);
							
							$crop_fnamec = 'files/images/avatars/c_user_'.$userDetail['Id'].$rand.'.jpg';
							i_crop_copy(COMMON_IMAGE_WIDTH, COMMON_IMAGE_HEIGHT, BPATH .$crop_fnames, BPATH .$crop_fnamec, 1);
					
							$user_obj = UserQuery::create()->select(array('Id', 'Avatar'))
										->filterById($userDetail['Id'])->findOne();
					
					
							UserQuery::create()->select(array('Id', 'Avatar'))
										->filterById($userDetail['Id'])
										->update(array('Avatar' => 'user_'.$userDetail['Id'].$rand.'.jpg'));
										
							$image = $newImage;
							
							 if (!empty($image))
							 {	 
									$ext = 'jpg';
									$dir = MakeUserDir('files/photo/origin', $userDetail['Id']);
									$fn = substr(md5(mktime()), 0, 10) . date("hm") . '.' . $ext;
									copy(BPATH . $image, BPATH . $dir . '/' . $fn);
									//photo thumbnail
									$tfn = MakeUserDir('files/photo/thumbs',$userDetail['Id']) . '/' . $fn;
									i_crop_copy(203, 168, BPATH . $dir . '/' . $fn,  BPATH . $tfn, 1);
									//mid size
									$mfn = MakeUserDir('files/photo/mid', $userDetail['Id']) . '/' . $fn;
									i_crop_copy(700, 700, BPATH . $dir . '/' . $fn,  BPATH . $mfn, 2);
									$image = $fn;
									$profileAbumId = PhotoAlbum::AddAlbum($userDetail['Id'], trim(strip_tags(PROFILE_PICTURES)));
									$mesg = I_HAVE_JUST_ADDED_A_NEW_PHOTO;
									
//									$wallId = Wall::Add( $userDetail['Id'], $userDetail['Id'], $mesg, $image, '', 0, $this->mCache );																		
									
									$phId = Photo::AddPhoto($userDetail['Id'], $profileAbumId, $image, 0, 0, PROFILE_PICTURES, '',  1);
									
									$link = '/base/profile/showPhotoOne?id='.$phId.'';
									$mesg = I_HAVE_CHANGED_MY_PROFILE_PHOTO;
									$wallId	=	Wall::Add( $userDetail['Id'], $userDetail['Id'], $mesg, $crop_fnamem, '', 0, $this->mCache, $link );
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
									@unlink( BPATH.'files/images/avatars/x_'.$user_obj['Avatar'] );
									@unlink( BPATH.'files/images/avatars/c_'.$user_obj['Avatar'] );
								}
							}	
						}			
					}
				}

                //send email if not twitter/facebook registration or email was changed
				
                if ($userDetail['Email'] == $fm['email'])
                {
					$name = $fm['band_name'] ? $fm['band_name'] : $fm['first_name'].' '.$fm['last_name'];
                    $this->mSmarty->assign('checksum', $checksum);
					$this->mSmarty->assign('FirstName', ucwords($fm['first_name']));
					$this->mSmarty->assign('LastName', ucwords($fm['last_name']));
                    $this->mSmarty->assign('name', ucwords($name));
                    $this->mSmarty->assign('email', $fm['email']);
                    $this->mSmarty->assign('SITE_NAME', SITE_NAME);
                    $this->mSmarty->assign('DOMAIN', DOMAIN);
					
				    
					include 'libs/Phpmailer_v5.1/class.phpmailer.php';
					
						if(USER_ARTIST==$status){															
							$fromEmail = ADMIN_EMAIL;
							$fromName = SITE_NAME;
							$toEmail = $fm['email'];
							$toName = ucwords($name);
							$subject = REGISTRATION_ARTIST . SITE_NAME;							
							$message = $this->mSmarty->fetch('mails/welcome_mail_artist.html');

							sendEmail($fromEmail,$fromName, $toEmail, $toName, $subject, $message);	
							
							$toEmail = ADMIN_EMAIL_RECEIVED;
							$toName = SITE_NAME;
							$fromEmail = $fm['email'];
							$fromName = ucwords($name);
							$subject = REGISTRATION_APPROVAL_REQUEST;
							$message = $this->mSmarty->fetch('mails/admin_rigister.html');
							sendEmail($fromEmail,$fromName, $toEmail, $toName, $subject, $message);
							
						}
						
						if(USER_FAN==$status){
							$fromEmail = ADMIN_EMAIL;
							$fromName = SITE_NAME;
							$toEmail = $fm['email'];
							$toName = ucwords($name);
							$subject = REGISTRATION_FAN . SITE_NAME;							
							$message = $this->mSmarty->fetch('mails/welcome_mail_fan.html');
							sendEmail($fromEmail,$fromName, $toEmail, $toName, $subject, $message);
						}
						
                    /*
                    if($this->mUser->IsAuth())
                    {
                       $this->mUser->Logout();
                    }*/
					
					 uni_redirect(PATH_ROOT.'base/user/RegistrationStep2');
                }
                else
                {
					
                    uni_redirect(PATH_ROOT.'base/user/RegistrationStep2');
                }

            }
            else
            {
                $this->mSmarty->assignByRef('errs', $errs);
                $this->mSmarty->assignByRef('fm', $fm);
            }
			
        }
        elseif ( FB_AUTH )
        {
		   
            //for facebook and twitter users - init registration			
			if($this->mSession->Get('fbAuth_email'))
			{
				$fm = array(
						   'email' => $this->mSession->Get('fbAuth_email'),
						   'first_name' => $this->mSession->Get('fbAuth_first_name'),
						   'last_name' => $this->mSession->Get('fbAuth_last_name')
						   );
	
				//$this->mSession->Del('fbAuth_email');
				//$this->mSession->Del('fbAuth_first_name');
				//$this->mSession->Del('fbAuth_last_name');
			}
			else if($this->mSession->Get('twAuth_name'))
			{
				$fm = array(
						   'email' => $this->mSession->Get('twAuth_email'),
						   'name' => $this->mSession->Get('twAuth_name'),
						   'first_name' => $this->mSession->Get('twAuth_first_name'),
						   'last_name' => $this->mSession->Get('twAuth_last_name')
						   );

				//$this->mSession->Del('twAuth_email');
				//$this->mSession->Del('twAuth_first_name');
				//$this->mSession->Del('twAuth_last_name');
			}

            $this->mSmarty->assignByRef('fm', $fm);
			
        }

        $this->mSmarty->assign('FB_AUTH', FB_AUTH);

        $this->mSmarty->display('mods/user/registration.html');
    }

	public function RegistrationStep2()
	{
		 $Id = $this->mSession->Get('usrId');
		 
		 $rand_id = _v('rand_id', rand(100000, 999999));
		 $this->mSmarty->assign('rand_id', $rand_id);	
		 
		 $user = UserQuery::create()->Select(array('Id', 'Email', 'Status', 'Pass', 'BandName', 'Name', 'Blocked', 'BlockReason',
			'Avatar', 'Location', 'About', 'Wallet', 'WalletBlock', 'IsOnline', 'Website', 'AltEmail', 'UserPhone','HashTag'));
		 $user = $user->filterById($Id)->findOne();	

		  //month-day-year
		$dd = array();
		for ($i=1; $i<=31;$i++)
		{
			$dd[$i] = $i;
		}

		$mm = array();
		$mme = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
		for ($i=1; $i<=12;$i++)
		{
			$mm[$i] = $mme[ $i-1 ];
		}

		$yy = array();
		for ($i=date("Y"); $i >=date("Y")-110; $i--)
		{
			$yy[$i] = $i;
		}
		$this->mSmarty->assignByRef('mm', $mm);
		$this->mSmarty->assignByRef('dd', $dd);
		$this->mSmarty->assignByRef('yy', $yy);
		
		$mem_act_tracks = array(1, 2, 3, 4, 5, 6, 7, 8, 9, '10+'); 
		
		$this->mSmarty->assignByRef('mem_act_tracks', $mem_act_tracks);
				
		  if (USER_FAN==$user['Status'])
		  {
				include_once 'libs/Geografy/Main.class.php';
				$this->mSmarty->assign('GeoIp', Model_Geografy_Main::GeoIPInit());
				$this->mSmarty->assignByRef('countries', Countries::GetCountries($this->mCache));
		  }
		  
		  if(USER_ARTIST==$user['Status'])
		  {
				$states_list = State::GetStates();
				$this->mSmarty->assignByRef('statesList', $states_list);
		  }	
		  
		//genres list
		$genres_list = User::GetGenresList();
		$this->mSmarty->assignByRef('genres', $genres_list);
	 	//checking fb /twitter / instragram
		$checkfb = $this->mSession->Get('fbAuth_fbId');
		$twAuth_name = $this->mSession->Get('twAuth_name');		

		if( $checkfb !='' && $twAuth_name=='' ) 
		{
			$this->mSmarty->assign('checkfb', true);		
		}
		if( $checkfb =='' && $twAuth_name!='' ) 
		{
			$this->mSmarty->assign('twAuth_name', true);		
		}
		
	 
		
		if (!empty($_POST['fm']))
		{
			$fm = $_POST['fm'];

			include_once 'model/Valid.class.php';

			$errs = array();

			foreach ($fm as &$v)
			{
				if (!is_array($v))
				{
					$v = trim(strip_tags($v));
				}
			}
			unset($v);
						
			

//			$strTweet = preg_replace('/(^|\s)#(\w+)/', '\1#<a href="http://search.twitter.com/search?q=%23\2">\2</a>', $fm['HashTag']);
/*			if($fm['HashTag'])
			{
				$strTweet =	preg_match('/^(?=.{2,140}$)(#|\x{ff03}){1}([0-9_\p{L}]*[_\p{L}][0-9_\p{L}]*)$/u', $fm['HashTag']);
	
				if (!$strTweet)
				{
					$errs['HashTag'] = ITS_NOT_VALID_HASHTAG;
				} 
			}*/
			
				// First name Field
				if (empty($fm['first_name']))
				{
					$errs['first_name'] = PLEASE_SPECIFY_FIRST_NAME;
				}
				
				// Last name Field
				if (empty($fm['last_name']))
				{
					$errs['last_name'] = PLEASE_SPECIFY_LAST_NAME;
				}

				if (!empty($fm['first_name']) && strlen($fm['first_name']) > 26)
				{
					$errs['first_name'] = MAX_FIRST_NAME_LENGTH_26_SYMBOLS;
				}

				if (!empty($fm['last_name']) && strlen($fm['last_name']) > 26)
				{
					$errs['last_name'] = MAX_LAST_NAME_LENGTH_26_SYMBOLS;
				}
				
							
			$genres = array();

			if (!empty($fm['genres']))
			{
				foreach ($fm['genres'] as $k => $v)
				{
					if (isset($genres_list[$k]))
					{
						$genres[] = $k;
					}
				}
			}
			if (empty($genres))
			{
				$errs['genres'] = YOU_MUST_SELECT_GENRES;
			}
			elseif (MAX_GENRES_COUNT < count($genres))
			{
				$errs['genres'] = YOU_CAN_CHOOSE_TO_NOT_MORE_THAN_3_GENRES;
			}
			
			if($fm['UserPhone'])
			{	
				$user_phone = Valid::Integer($fm, 'UserPhone');
				if (empty($user_phone))
				{
					$errs['UserPhone'] = PLEASE_SPECIFY_USER_PHONE_NUMBER_AS_INTEGER;
				}
			}
//		deb($fm);
		if (empty($errs))
		{
			 include_once 'model/Valid.class.php';
			
			$month = (isset($fm['mm']) && isset($dd[$fm['mm']])) ? $fm['mm'] : 0;
			$day = (isset($fm['dd']) && isset($dd[$fm['dd']])) ? $fm['dd'] : 0;
			$year = (isset($fm['yy']) && isset($yy[$fm['yy']])) ? $fm['yy'] : 0;
			
			if($day == 0 && $month == 0 && $year == 0)
			{
				$dob = '0000-00-00';
			}
			else
			{
				$dob = $year . '-' . ($month < 10 ? '0' . $month : $month) . '-' . ($day < 10 ? '0' . $day : $day);
			}
			
			$member = isset($fm['band_member']) ? $fm['band_member'] : '';
			$track = isset($fm['tracks_created']) ? $fm['tracks_created'] : '';
			
			
			if($member || $track)
			{
				$memTrack = array($member, $track);
				$members_tracks  = serialize($memTrack);
			}
			else
				$members_tracks ='';
			
			//echo $Id;
			//echo "<pre>";
			//print_r($this->mUser->mUserInfo);								

			
			
			$mUser = UserQuery::create()->findPk($Id);
		
			//print_r($mUser);
			//deb($fm);
						
			if($fm['Status'] == USER_ARTIST){
				$mUser->setUserPhone($fm['UserPhone']);
				$mUser->setBandName(ucwords(strtolower(Valid::String($fm, 'band_name'))));
				$mUser->setYearsActive( $fm['years_active'] );			
				$mUser->setMembers( $members_tracks );			
				$mUser->setState($fm['state'] );
				$mUser->setWebsite( str_replace('http://', '', check_valid_url(Valid::String($fm, 'website'))) );
				$mUser->setBio( Valid::String($fm, 'bio') );
				$record_label       = !empty($fm['record_label']) ? serialize($fm['record_label']) : '';
				$record_label_link  = !empty($fm['record_label_link']) ? serialize($fm['record_label_link']) : '';
				$mUser->setRecordLabel( $record_label );
				$mUser->setRecordLabelLink( $record_label_link );
				$mUser->setHashTag($fm['HashTag']);
			}
			else{
				$mUser->setCountry( $fm['country']);
			}	
			
			$mUser->setDob($dob);			
			$mUser->setGender((!empty($fm['gender']) && in_array($fm['gender'], array(1, 2))) ? $fm['gender'] : 0);			
			$mUser->setLocation( ucwords(strtolower(Valid::String($fm, 'city'))) );			
			$mUser->setGenres( implode(',',$genres) );		

			//start
            $mUser->setFirstName(ucwords(strtolower($fm['first_name'])));
	        $mUser->setLastName(ucwords(strtolower($fm['last_name'])));	
			if(empty($fm['fb'])) {
			$ufb = 0;
			}else {
			$ufb = 1;
			}
					
			if(empty($fm['tw'])) 
			{
				$utw = 0;
			}
			else 
			{
				$utw = 1;
			}		
			if(empty($fm['ig'])) 
			{
				$uig = 0;
			}
			else 
			{
				$uig = 1;
			}					
			$mUser->setFbOn($ufb);					
			$mUser->setTwOn($utw);					
			$mUser->setInOn($uig);																				
			//end
			
			
			$mUser->save();
			$usrId = $mUser->getId();
						
			if($this->mUser->IsAuth())
			{
					$this->mUser->Logout();
			}
			//$this->mlObj['mSession']->Set('usrId', $usrId);
			$this->mlObj['mSession']->Del('usrId');
			$status = $user['Status'];

			uni_redirect(PATH_ROOT . 'reg/confirm/?status='.$status);
		}
		else
		{	
			$this->mSmarty->assignByRef('errs', $errs);

			$fm['Avatar'] = $user['Avatar'];
			
			$this->mSmarty->assignByRef('fm', $fm);
			$this->mSmarty->display('mods/user/registrationStep2.html');
			exit;
		}
		
	  }	
	  else
	  {
		  $fm	= array();	
		  $fm = $user;	
		    
		  //for facebook and twitter users - init registration			
		if($this->mSession->Get('fbAuth_email'))
		{
		   $fm['first_name'] = $this->mSession->Get('fbAuth_first_name');		   
		   $fm['last_name'] = $this->mSession->Get('fbAuth_last_name');
		   $this->mSession->Del('fbAuth_first_name');
		   $this->mSession->Del('fbAuth_last_name');
		}
		else if($this->mSession->Get('twAuth_name'))
		{
		   $fm['name'] = $this->mSession->Get('twAuth_name');					
		   $fm['first_name'] = $this->mSession->Get('twAuth_first_name');		   
		   $fm['last_name'] = $this->mSession->Get('twAuth_last_name');
		   
			$this->mSession->Del('twAuth_email');
			$this->mSession->Del('twAuth_first_name');
			$this->mSession->Del('twAuth_last_name');
		}
		  $this->mSmarty->assignByRef('fm', $fm);		  

		  $this->mSmarty->display('mods/user/registrationStep2.html');
		  exit;
	  }

	}

    /**
     * Registration confirm page - show confirmation text
     * @return void
     */
	 
    public function RegistrationConfirm()
    {
		$this->mSmarty->assign('status', _v('status', ''));
		$this->mSmarty->display('mods/user/registration_confirm.html');
    }

    /**
     * Registration fields validation
     * @return void
     */
    public function ValidateRegisterFields()
    {
        $what = _v('what', '');
        $field = _v($what, '');
        $id = _v('id', 0);
        if(!$id && $this->mUser->IsAuth())
        {
            $id = $this->mUser->mUserInfo['Id'];
        }
        else if($this->mUser->IsAuth() && ($this->mUser->mUserInfo['FbId'] && !$this->mUser->mUserInfo['FbStart'] || $this->mUser->mUserInfo['TwId'] && !$this->mUser->mUserInfo['TwStart']))
        {
            $id = $this->mUser->mUserInfo['Id'];
        }
		

        $res = array('q' => OK , 'err' => '');
        switch($what)
        {
            case 'email':
                if (empty($field) || !verify_email($field))
                {
                    $res['err'] = PLEASE_ENTER_VALID_EMAIL;
                }
                else
                {
                    $eml = UserQuery::create()->Select(array('Id', 'Email'))
                            ->where('LOWER(user.email)="' . mysql_escape_string(ToLower($field)) . '" OR LOWER(user.alt_email) LIKE "%\"'.mysql_escape_string(ToLower($field)) . '\"%"');
                    /*
					if($id)
                    {
						 $eml = $eml->filterById($id, '!=');
                    }*/
                    $eml = $eml -> findOne();
					if (!empty($eml) && $eml['Id'] != $id)
                    {
                        $res['err'] = ADDRESS_ALREADY_REGISTERED;
                    }
                }
                break;
            case 'name':
                if(strlen($field) > 40)
                {
                    $res['err'] = THE_USERNAME_IS_TOO_LONG;
                }
                else
                {
                    $regName = '/^([a-zA-Z0-9_\-])+$/';
                    $matches = array();
                    if (!preg_match($regName, $field, $matches))
                    {
                        $res['err'] = USERNAME_CAN_BE_JOHNPUBLIC_OR_USER1234;
                    }
                    else
                    {
                        $usr = UserQuery::create()->Select(array('Id'))
                                ->where('LOWER(user.name)="' . mysql_escape_string(ToLower($field)) . '"');
                        if($id)
                        {
                            $usr -> filterById($id, Criteria::NOT_EQUAL);
                        }
                        $usr = $usr -> findOne();

                        if (!empty($usr))
                        {
                            $res['err'] = THAT_USERNAME_IS_ALREADY_TAKEN;
                        }
                    }
                }
                break;
        }
        if(!empty($res['err']))
        {
            $res['q'] = ERR;
        }

        echo json_encode($res);
        exit();
    }


    /**
     * Confirm registration by code
     * @return void
     */
    public function Confirm()
    {
        $code = _v('code', '');
        if ($code)
        {
            $uc = UserQuery::create()->select(array('Id', 'Email', 'Pass', 'Name', 'TwId', 'FbId', 'TwOauthToken', 'TwOauthTokenSecret'))->filterByChecksum($code)
                    ->filterByEmailConfirmed(0)
                    ->findOne();
            if (!empty($uc))
            {
                //confirmed
                UserQuery::create()->select(array('Id'))->filterById($uc['Id'])
                        ->update(array('Checksum' => '', 'EmailConfirmed' => 1));

                //auto-login 
                $_REQUEST['system_login'] = $uc['Email'];
                if(!empty($uc['Pass']))
                {
                    $uc['Pass'] = hex2bin($uc['Pass']);
                    $this->mUser->mRc4->decrypt($uc['Pass']);
                    $_REQUEST['system_pass']  =  $uc['Pass'];
                }
                else if(!empty($uc['FbId']))
                {
                    $this->mlObj['mSession']->Set('fb_id', $uc['FbId']);
                }
                else if(!empty($uc['TwId']))
                {
                    $this->mlObj['mSession']->Set('access_token', array(
                        'oauth_token' => $uc['TwOauthToken'],
                        'user_id' => $uc['TwId'],
                        'oauth_token_secret' => $uc['TwOauthTokenSecret']));
                }
                $this->mUser->CheckAuth();
                //check if need to complete some actions
                $redirect = $this->GetRedirectUrl();
                if($redirect)
                {
                    uni_redirect(PATH_ROOT . $redirect);
                }
                //go to profile
                uni_redirect( PATH_ROOT . 'u/'.$uc['Name'].'?conf=1' );

            }
        }
        $this->mSmarty->display('mods/user/confirm.html');
    }


    /**
     * Forgot password form
     * @return void
     */
    public function Forgot()
    {
        if ($this->mUser->IsAuth())
        {
            uni_redirect(PATH_ROOT . 'u/'.$this->mUser->mUserInfo['Name']);
        }        
        if (!empty($_REQUEST['email']))
        {
            $err = '';
            $res = array('q' => ERR);
            $email = !empty($_REQUEST['email']) && verify_email($_REQUEST['email']) ? $_REQUEST['email'] : '';

            if (empty($email))
            {
                $err = PLEASE_SPECIFY_CORRECT_EMAIL;
            }

            if(empty($err))
            {
                $ui = UserQuery::create()
                                -> select(array('Id', 'Email', 'Pass', 'EmailConfirmed', 'Checksum', 'Name', 'FbStart', 'TwStart', 'FirstName', 'LastName', 'BandName'))
                                -> filterByEmail($email)
                                -> findOne();
                
				
				if (empty($ui))
                {
                    $err = NO_USERS_FOUND_WITH_SPECIFIED_EMAIL;
                }
				elseif(empty($ui['EmailConfirmed']))
                {
					$err = ADMIN_NEED_TO_APPROVE_YOUR_PROFILE_PLEASE_CHECK_LATER;
                }
               /* else if($ui['FbStart'] == 1)
                {
                    $err = YOU_SIGNED_UP_WITH_FACEBOOK_USE_CONNECT_WITH_FACEBOOK_BUTTON_TO_SIGN_IN;
                }
                else if($ui['TwStart'] == 1)
                {
                    $err = YOU_SIGNED_UP_WITH_TWITTER_USE_SIGN_IN_WITH_TWITTER_BUTTON_TO_SIGN_IN;
                }*/
                else
                {
                    $checksum = md5(mktime().rand(11, 99));
                    UserQuery::create() -> select(array('Id')) -> filterById($ui['Id']) -> update(array('Checksum' => $checksum));

                    $this -> mSmarty -> assign('checksum', $checksum);
					$name = ($ui['BandName'] ? $ui['BandName']: $ui['FirstName'].' '.$ui['LastName']);
                    $this -> mSmarty -> assignByRef('name', $name);
                    $this -> mSmarty -> assign('DOMAIN', DOMAIN);
					
					$fromEmail = ADMIN_EMAIL;
					$fromName = SITE_NAME;
					$toEmail = $ui['Email'];
					$toName =  $name;
					$subject = RESTORE_PASSWORD . SITE_NAME.'!';
					$message = $this->mSmarty->fetch('mails/pass_restore.html');
					sendEmail($fromEmail,$fromName, $toEmail, $toName, $subject, $message);
                    $res['q'] = OK;
                }
            }
            if(!empty($err))
            {
                $res['err'] = $err;
            }
            echo json_encode($res);
            exit();
        }

        $this->mSmarty->display('mods/user/forgot.html');
    }

    /**
     * Change password
     * @return void
     */
    public function Restorepass()
    {
        $code = _v('code', '');

        if (!empty($code))
        {
            $uq = UserQuery::create() -> select(array('Id', 'Name'))
                    -> filterByChecksum($code)
                    -> findOne();
            if (!empty($uq))
            {
                if (!empty($_POST['fm']))
                {
                    $errs = array();
                    $res = array('q' => ERR);
                    $fm = $_POST['fm'];

                    if (empty($fm['pass']))
                    {
                        $errs['pass'] = PLEASE_SPECIFY_PASSWORD;
                    }
                    elseif (strlen($fm['pass']) < 6)
                    {
                        $errs['pass'] = MIN_PASSWORD_LENGTH_6_SYMBOLS;
                    }
                    elseif (empty($fm['pass2']) || strlen($fm['pass2']) < 6)
                    {
                        $errs['pass2'] = PLEASE_REPEAT_PASSWORD;
                    }
                    elseif ($fm['pass2'] != $fm['pass'])
                    {
                        $errs['pass'] = PASSWORDS_DO_NOT_MATCH;
                    }

                    if (empty($errs))
                    {
                        $pass_orig = $fm['pass'];

                        $this->mUser->mRc4->crypt($fm['pass']);
                        $pass = bin2hex($fm['pass']);
                        $up = array();
                        $up['Pass'] = $pass;
                        $up['Checksum'] = substr(md5(mktime() . rand(11, 99)), 0, 10);

                        UserQuery::create()
                                -> select(array('Id'))
                                -> filterById($uq['Id'])
                                -> update($up);

                        $res['q'] = OK;
                    }
                    else
                    {
                        $res['errs'] = $errs;
                    }
                    echo json_encode($res);
                    exit();
                }
            }
            else
            {
                $this -> mSmarty -> assign('errcode', 1);
            }
            $this -> mSmarty -> assign('code', $code);
        }
        else
        {
            $this -> mSmarty -> assign('errcode', 1);
        }

        $this->mSmarty->display('mods/user/restorepass.html');
    }

    /**
     * Restore password confirm page - show success change password message
     * @return void
     */
    public function Passchanged()
    {
        $this->mSmarty->display('mods/user/passchanged.html');
    }


    /**
     * User logout
     */
    public function Logout()
    {
        if ($this->mUser->IsAuth())
        {
			
            $this->mUser->Logout();
        }
		$this->mlObj['mSession']->Del('redirect');	
		$this->mlObj['mSession']->Del('error');		
		$this->mlObj['mSession']->Del('fbAuth_fbId');
		$this->mlObj['mSession']->Del('usrId');	
		$this->mlObj['mSession']->Del('twAuth_name');		
		//$this->mlObj['mSession']->Del('nactive');	

        uni_redirect(PATH_ROOT);
    }


    /**
     * Edit user profile
     * @return void
     */
    public function Edit()
    {
        //edit profile
        if (!empty($_POST['fm']))
        {
            $fm = $_POST['fm'];
            $errs = array();

            foreach ($fm as &$v)
            {
                $v = trim(strip_tags($v));
            }
            unset($v);


            if (empty($fm['email']) || !verify_email($fm['email']))
            {
                $errs['email'] = PLEASE_SPECIFY_CORRECT_EMAIL;
            }
            else
            {
                $eml = UserQuery::create()->Select(array('Id', 'Email'))
                        ->where( 'LOWER(user.email)="' . mysql_escape_string(ToLower($fm['email'])) . '" OR LOWER(user.alt_email) LIKE "%\"'.mysql_escape_string(ToLower($fm['email'])) . '\"%" AND user.Id <> '.$this->mUser->mUserInfo['Id'] )
                        ->findOne();
				if (!empty($eml))
                {
					
                    $errs['email'] = USER_WITH_THAT_EMAIL_ALREADY_EXIST;
                }
            }

            if (!empty($fm['pass']) && strlen($fm['pass']) < 6)
            {
                $errs['pass'] = MIN_PASSWORD_LENGTH_6_SYMBOLS;
            }

            if (!empty($fm['first_name']) && strlen($fm['first_name']) > 26)
            {
                $errs['first_name'] = MAX_FIRST_NAME_LENGTH_26_SYMBOLS;
            }

            if (!empty($fm['last_name']) && strlen($fm['last_name']) > 26)
            {
                $errs['last_name'] = MAX_LAST_NAME_LENGTH_26_SYMBOLS;
            }

            if (empty($fm['name']))
            {
                $errs['name'] = PLEASE_SPECIFY_DISPLAY_NAME;
            }
            else
            {
                $regName = '/^([a-zA-Z0-9_\-])+$/';
                $matches = array();
                if (!preg_match($regName, $fm['name'], $matches))
                {
                    $errs['name'] = DISPLAY_NAME_CAN_BE_JOHN_PUBLIC_OR_USER1234;
                }
                elseif (strlen($fm['name']) > 40)
                {
                    $errs['name'] = MAX_DISPLAY_NAME_LENGTH_40_SYMBOLS;
                }
                else
                {
                    $usr = UserQuery::create()->Select(array('Id'))
                            ->where('LOWER(user.name)="' . mysql_escape_string(ToLower($fm['name'])) . '" AND user.Id <> '.$this->mUser->mUserInfo['Id'] )
                            ->findOne();

                    if (!empty($usr))
                    {
                        $errs['name'] = USER_WITH_THAT_DISPLAY_NAME_ALREADY_EXISTS;
                    }
                }
            }


            if (empty($errs))
            {
                $avatar = $this->UploadAvatar();
                if (is_array($avatar))
                {
                    //errors
                    echo json_encode(array('q' => ERR, 'errs' => $avatar));
                    exit();
                }

                //save data

                //base info
                $mUser = UserQuery::create()->findPk( $this->mUser->mUserInfo['Id'] );
                $mUser->setEmail($fm['email']);
                $mUser->setFirstName($fm['first_name']);
                $mUser->setLastName($fm['last_name']);
                $mUser->setName($fm['name']);

                //change password
                if (!empty($fm['pass']))
                {
                    $orig_pass = $fm['pass'];
                    $this->mUser->mRc4->crypt($fm['pass']);
                    $fm['pass'] = bin2hex($fm['pass']);
                    $mUser->setPass($fm['pass']);
                }

                //access
                $mUser->setAnonymousCheckin((!empty($fm['anonymous_checkin']) && 1 == $fm['anonymous_checkin']) ? 1 : 0);
                $mUser->setAllowMessage((!empty($fm['allow_message']) && 1 == $fm['allow_message']) ? 1 : 0);

                //avatar
                if ($avatar)
                {
                    $mUser->setAvatar($avatar);
                }
                elseif(!empty($fm['delete_avatar']))
                {
                    $mUser->setAvatar('');
                }

                //additional info
				$u_location = !empty($fm['location']) ? strip_tags($fm['location']) : '';
				
                $mUser->setLocation(ucwords(strtoupper($u_location)));
                $mUser->setAbout(!empty($fm['about']) ? strip_tags($fm['about']) : '');

                //save
                $mUser->save();

                echo json_encode(array('q' => OK));
            }
            else
            {
                echo json_encode(array('q' => ERR, 'errs' => $errs));
            }

            exit();
        }

        $this->mSmarty->display('mods/user/edit.html');
    }


    public function UploadAvatarAjax()
    {
        include_once 'model/FileUpload.class.php';
        $mFu = new FileUpload(array('jpg', 'jpeg', 'gif', 'png'));

        //upload to tmp directory
        $result = $mFu->handleUpload( 'files/images/tmp/');

		$tmpFileName = 'files/images/tmp/'.$result['name'];
		list($width, $height) = getimagesize($tmpFileName);
		
		if($width < USER_PROFILE_IMAGE_WIDTH || $height < USER_PROFILE_IMAGE_HEIGHT){
			@unlink($tmpFileName);
			echo json_encode(array('success'=>false, 'message'=> POFILE_IMAGE_ERR ));
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
			
			$imgObj->resizeToWidth(300);
			$imgObj->save($result['image']);
			
			$result['width'] = $imgObj->getWidth();
			$result['height'] = $imgObj->getHeight();
        }
		echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
		exit();
	}


	public function SaveAvatar()
	{
		$rand_id = _v('rand_id', 0);
		$user_id = _v('user_id', 0);
				
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
		$scale = USER_PROFILE_IMAGE_WIDTH/$w;
		$reSizeImage = $thumbImage->resizeThumbnailImage($newImage, $w,$h,$x1,$y1,$scale);
		
						
		include_once 'libs/Crop/Image_Transform.php';
		include_once 'libs/Crop/Image_Transform_Driver_GD.php';
							
		$rand = rand(100, 9999);
		
		$crop_fnamem = 'files/images/avatars/m_user_'.$user_id.$rand.'.jpg';				
		i_crop_copy(USER_MEDIUM_IMAGE_WIDTH, USER_MEDIUM_IMAGE_HEIGHT, $newImage,  BPATH .$crop_fnamem, 1);

		$crop_fnames = 'files/images/avatars/s_user_'.$user_id.$rand.'.jpg';
		i_crop_copy(USER_PROFILE_IMAGE_WIDTH, USER_PROFILE_IMAGE_HEIGHT, $newImage,  BPATH .$crop_fnames, 1);

		$crop_fnamex = 'files/images/avatars/x_user_'.$user_id.$rand.'.jpg';
		i_crop_copy(USER_THUMB_IMAGE_WIDTH, USER_THUMB_IMAGE_HEIGHT,  BPATH .$crop_fnames, BPATH .$crop_fnamex, 1);
		
		$crop_fnamec = 'files/images/avatars/c_user_'.$user_id.$rand.'.jpg';
		i_crop_copy(COMMON_IMAGE_WIDTH, COMMON_IMAGE_HEIGHT, BPATH .$crop_fnames, BPATH .$crop_fnamec, 1);
		@unlink(BPATH.$orginalImage);
		@unlink(BPATH.$newImage);
		$user_obj = UserQuery::create()->select(array('Id', 'Avatar'))
					->filterById($user_id)->findOne();

		if ($user_obj['Avatar'])
		{
			if (file_exists(BPATH.'files/images/avatars/s_'.$user_obj['Avatar']))
			{
				@unlink( BPATH.'files/images/avatars/s_'.$user_obj['Avatar'] );
				@unlink( BPATH.'files/images/avatars/x_'.$user_obj['Avatar'] );
				@unlink( BPATH.'files/images/avatars/c_'.$user_obj['Avatar'] );
			}
		}

	  
		$image = $crop_fnames;
		$result['image'] = $image;
		$mesg = I_HAVE_CHANGED_MY_PROFILE_PHOTO;
		 if (!empty($image))
		 {
				$pathinfo = pathinfo($image);

				$ext = ToLower($pathinfo['extension']);
				$dir = MakeUserDir('files/photo/origin', $user_id);
				$fn = substr(md5(mktime()), 0, 10) . date("hm") . '.' . $ext;
				copy(BPATH . $image, BPATH . $dir . '/' . $fn);

				//photo thumbnail

				$tfn = MakeUserDir('files/photo/thumbs', $user_id) . '/' . $fn;
				
				i_crop_copy(203, 168, BPATH . $dir . '/' . $fn,  BPATH . $tfn, 1);
				

				//mid size
				$mfn = MakeUserDir('files/photo/mid', $user_id) . '/' . $fn;
				i_crop_copy(700, 700, BPATH . $dir . '/' . $fn,  BPATH . $mfn, 2);

				$image = $fn;

				$album_id = PhotoAlbum::getProfilePictureAlbum($user_id);

				if(!$album_id)
				{
					$album_id  = PhotoAlbum::AddAlbum($user_id, PROFILE_PICTURES);
				}
				if($album_id)
				{
					UserQuery::create()->select(array('Id', 'Avatar'))
						->filterById($user_id)
						->update(array('Avatar' => 'user_'.$user_id.$rand.'.jpg'));
		
					$phId = Photo::AddPhoto($user_id, $album_id, $image, $sld, 0, PROFILE_PICTURES, '',  1);
					$link = '/base/profile/showPhotoOne?id='.$phId.'';				
					$wallId	=	Wall::Add( $user_id, $user_id, $mesg, $crop_fnamem, '', 0, $this->mCache, $link );

					Photo::UpdatePhotoWallId($phId, $wallId);								
				}
				$res['q'] = OK; 
				
				
		  }
		  echo htmlspecialchars(json_encode($res), ENT_NOQUOTES);
		  exit();	
	}

	
    /**
     * Upload current user avatar (ajax)
     * @param int $id
     * @param string $field
     * @return void
     */
    public function UploadAvatar($id, $field)
    {
        if (!isset($_FILES[$field]) || empty($_FILES[$field]['name']))
        {
            return false;
        }
        else
        {

            $errs = array();
            $ext = ToLower(strrchr($_FILES[$field]['name'], '.'));

            //check extension
            if (!in_array($ext, array('.jpg', '.jpeg', '.gif', '.png')))
            {
                $errs[$field] = ERROR_FILE_TYPE_ONLY_JPG_PNG_GIF_ALLOWED;
                return $errs;
            }

            //check type
            $fs = @getimagesize($_FILES[$field]['tmp_name']);
            if (empty($fs))
            {
                $errs[$field] = ERROR_FILE_TYPE_ONLY_JPG_PNG_GIF_ALLOWED;
                return $errs;
            }

            //check size
            if(ceil(filesize($_FILES[$field]['tmp_name'])/1000) > 500)
            {
                $errs[$field] = YOUR_PICTURE_IS_TOO_LARGE_MAX_PICTURE_SIZE_IS_500_KB;
                return $errs;
            }

            /**
             * Upload
             **/
            require_once 'libs/Crop/Image_Transform.php';
            require_once 'libs/Crop/Image_Transform_Driver_GD.php';

            $rand = rand(100, 9999);
            $crop_fname = 'files/images/avatars/m_user_'.$id.$rand.'.jpg';
            i_crop_copy(223, 186, $_FILES[$field]['tmp_name'],  BPATH .$crop_fname, 1);

            $crop_fname = 'files/images/avatars/s_user_'.$id.$rand.'.jpg';
            i_crop_copy(144, 144, $_FILES[$field]['tmp_name'],  BPATH .$crop_fname, 1);

            $crop_fnamex = 'files/images/avatars/x_user_'.$id.$rand.'.jpg';
            i_crop_copy(48, 48, BPATH .$crop_fname, BPATH .$crop_fnamex, 1);

            return 'user_'.$id.$rand.'.jpg';
        }
    }


    /**
     * Display channel page for facebook
     * @return void
     */
    public function FbChannel()
    {
        $cache_expire = 60 * 60 * 24 * 365;
        header("Pragma: public");
        header("Cache-Control: max-age=" . $cache_expire);
        header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $cache_expire) . ' GMT');
        echo '<script src="//connect.facebook.net/en_US/all.js"></script>';
        exit();
    }


    /**
     *  Login with facebook
     * @return void
     */
    public function FbAuth()
    {
        $res = array('q' => ERR, 'redirect' => '');


        if (!$this->mUser->IsAuth())
        {

		   //user is auth in facebook and not auth in our site

            //validate facebook cookie
			
            /*
			$signed_request = $this->mSession->GetCookie( 'fbsr_' . FACEBOOK_API_ID );
            list($encoded_sig, $payload) = explode('.', $signed_request, 2);
            $sig = base64_decode(strtr($encoded_sig, '-_', '+/'));
            $expected_sig = hash_hmac('sha256', $payload, FACEBOOK_API_SECRET, $raw = true);
			*/

            //if ($sig == $expected_sig)
            //{
                $id = _v('id', 0); //FB id
                $email = _v('email', '');
                if ($id)
                {

                    $ui = UserQuery::create()
                            ->select(array('Id', 'Pass', 'Email', 'Name'))
                            ->filterByFbId($id)
                            ->findOne();

                    if (empty($ui) && !empty($email))
                    {
                        /**
                         * no user with such FB id
                         * get user by email
                         */
                        $ui = UserQuery::create()
                                ->select(array('Id', 'Pass', 'Email','Name'))
                                ->filterByEmail($email)
                                ->findOne();
								
                        if (!empty($ui))
                        {
                            /**
                             * found user by email, bind him to FB id
                             */
                            UserQuery::create()->select(array('Id'))->filterById($ui['Id'])->update(array('FbId' => $id, 'FbStart' => 2));
                        }
						$ui = UserQuery::create()
                                ->select(array('Id', 'Pass', 'Email','Name'))
								->filterByAltEmail('%\"'.$email.'\"%')
                                ->findOne();
						if (!empty($ui))
                        {
                            /**
                             * found user by email, bind him to FB id
                             */
                            UserQuery::create()->select(array('Id'))->filterById($ui['Id'])->update(array('FbId' => $id, 'FbStart' => 2));
                        }
						
                    }

                    if (!empty($ui))
                    {
                        //update token
                        require_once 'libs/facebook-php-sdk/src/facebook.php';
                        $facebook = new Facebook(array('appId'  => FACEBOOK_API_ID, 'secret' => FACEBOOK_API_SECRET));

                        //existing token
                        $token = $facebook->getAccessToken();
                        //get extending access_token expiration time
                        $ext_token = $facebook->getExtendedAccessToken($token);
                        if(!empty($ext_token))
                        {
                            //update extended tokens in base
                            UserQuery::create()->select(array('Id'))->filterById($ui['Id'])->update(array('FbToken' => $ext_token, 'FbStart' => 2));
                        }
                        //login
                        $pass = hex2bin($ui['Pass']);
                        $this->mUser->mRc4->decrypt($pass);
						
                        $_REQUEST['system_login'] = $ui['Email'];
                        $_REQUEST['system_pass'] = $pass;
						
						$this->mSession->Set('fb_id', $id);
						$this->mSession->Set('facebook_id', $id);						
                      //  $this->mlObj['mSession']->set('fb_id', $id);

			           $r = $this->mUser->CheckAuth();

                       if($r == 1)
                        {
                            $res['q'] = OK;
                            $res['id'] = $ui['Id'];
                            //$res['isfirst'] = !$this->mUser->mUserInfo['FbStart'] ? 1 : 0;
							$res['isfirst'] = 0;
							$res['uname'] = $ui['Name'];
							//echo $res['isfirst'];
                            if(!$res['isfirst'])
                            {
                                $res['redirect'] = $this->GetRedirectUrl();
								
                            }
                        }
                        else
                        {
                            $res['err'] = ($r == 5 ? ACCOUNT_EMAIL_IS_NOT_CONFIRMED : ($r == 7 ? YOU_ARE_ALREADY_LOGGED_IN_ANOTHER_SYSYTEM :COULD_NOT_FIND_YOUR_ACCOUNT));
/*							if($r == 5) {
							$res['err'] = ACCOUNT_EMAIL_IS_NOT_CONFIRMED;														
							}
*/                            
                        }
                    }
                    else
                    {
                        //create account
                        $name = strip_tags(_v('name', ''));
                        //translit and replace not allowed symbols
                        $name = seoUrl($name);
                        if (strlen($name) > 17) {
                            $name = substr($name, 0, 17);
                        }
                        //check uniqueness
                        $k = 1;
                        while (1)
                        {
                            $usr = UserQuery::create()->Select(array('Id'))
                                    ->where('LOWER(user.name)="' . mysql_escape_string(ToLower($name)) . '"')
                                    ->findOne();

                            if (!empty($usr))
                            {
                                $name .= $k;
                                $k++;
                            }
                            else
                            {
                                break;
                            }
                        }

                        $first_name = strip_tags(_v('fname', ''));
                        $last_name = strip_tags(_v('lname', ''));
						
						$this->mSession->Set('fbAuth_email', $email);
						$this->mSession->Set('fbAuth_first_name', $first_name);
						$this->mSession->Set('fbAuth_last_name', $last_name);
						$this->mSession->Set('fbAuth_fbId', $id);
						$this->mSession->Set('fb_id', $id);

                        require_once 'libs/facebook-php-sdk/src/facebook.php';
                        $facebook = new Facebook(array('appId'  => FACEBOOK_API_ID, 'secret' => FACEBOOK_API_SECRET));

                        //existing token
                        $token = $facebook->getAccessToken();
                        //get extending access_token expiration time
                        $ext_token = $facebook->getExtendedAccessToken($token);
                        //$mUser->setFbToken($ext_token);
						$this->mSession->Set('fbAuth_ext_token', $ext_token);
						//$mUser->save();
                        //$uid = $mUser->getId();

                        //$this->mlObj['mSession']->set('fb_id', $id);
                        $this->mUser->CheckAuth();

                        $res['q'] = OK;
                        //$res['id'] = $uid;
                        $res['isfirst'] = 1; //first auth with facebook
                    }
                }
            //}
        }
		else
		{
			$r = $this->mUser->CheckAuth();
			$this->mlObj['mSession']->set('error', ($r == 5 ? ACCOUNT_EMAIL_IS_NOT_CONFIRMED : ($r == 7 ? YOU_ARE_ALREADY_LOGGED_IN_ANOTHER_SYSYTEM : COULD_NOT_FIND_YOUR_ACCOUNT )));

			uni_redirect(PATH_ROOT.'base/user/login');
		}
//		USER_WITH_THAT_EMAIL_ALREADY_EXIST

        echo json_encode($res);
        exit();
    }
    /**
     * get twitter authorize url
     * @return void
     */
    public function TwtGetAuthUrl()
    {
        $res = array('q' => ERR );
        $st = _v('st', 0);
        if(!in_array($st, array(1, 2)))
        {
            $st = 0;
        }

        require_once('libs/twitteroauth/twitteroauth.php');
        $con = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET); 

        $request_token = $con->getRequestToken(TWITTER_OAUTH_CALLBACK);
	    $this->mlObj['mSession']->set('oauth_token', $request_token['oauth_token']);
        $this->mlObj['mSession']->set('oauth_token_secret', $request_token['oauth_token_secret']);
        $this->mlObj['mSession']->set('regstatus', $st);
		
        if($con->http_code == 200)
        {
            $url = $con->getAuthenitcateURL($request_token['oauth_token'], true);
            $res['q'] = OK;
            $res['url'] = $url;
        }
        else
        {
            $res['err'] = COULD_NOT_CONNECT_TO_TWITTER_REFRESH_THE_PAGE_OR_TRY_AGAIN_LATER;
        }
        echo json_encode($res);
        exit();
    }

    /**
     * Login with twitter
     * @return void
     */
    public function TwitterAuth()
    {
        require_once('libs/twitteroauth/twitteroauth.php');
        $token = _v('oauth_token', '');
        $verifier = _v('oauth_verifier', '');

        $st = $this->mlObj['mSession']->get('regstatus');
		
        if ($token && $this->mlObj['mSession']->get('oauth_token') !== $token)
        {
            $this->mlObj['mSession']->del('oauth_token');
            $this->mlObj['mSession']->del('oauth_token_secret');
            uni_redirect(PATH_ROOT.'base/user/login');
        }

        $con = new TwitterOAuth(TWITTER_CONSUMER_KEY,
                                TWITTER_CONSUMER_SECRET,
                                $this->mlObj['mSession']->get('oauth_token'),
                                $this->mlObj['mSession']->get('oauth_token_secret'));

        //get access tokens from twitter
        $access_token = $con->getAccessToken($verifier);
        //clean old tokens
        $this->mlObj['mSession']->del('oauth_token');
        $this->mlObj['mSession']->del('oauth_token_secret');
        if($con->http_code == 200)
        {
            $this->mlObj['mSession']->set('access_token', $access_token);
			$this->mlObj['mSession']->set('twitter_id', $access_token['user_id']);
            if(!empty($access_token['user_id']))
            {
                $id = $access_token['user_id']; //twitter user id
                $ui = UserQuery::create()
                        ->select(array('Id', 'Name', 'Pass', 'Email'))
                        ->filterByTwId($id)
                        ->findOne();
				
                if (!empty($ui))
                {
                    //user found - authenticate
                    UserQuery::create()->select(array('Id'))->filterById($ui['Id'])->update(
                    array('TwOauthToken' => $access_token['oauth_token'],'TwOauthTokenSecret' => $access_token['oauth_token_secret']));
                    $r = $this->mUser->CheckAuth();
			        if($r == 1)
                    {
                        //check if need to complete some actions
                        $redirect = $this->GetRedirectUrl();
                        if($redirect)
                        {
                            uni_redirect(PATH_ROOT . $redirect);
                        }
						
                        uni_redirect(PATH_ROOT . 'u/'.$ui['Name']);
						
                    }
                    else
                    {
                        $this->mlObj['mSession']->set('error', ($r == 5 ? ACCOUNT_EMAIL_IS_NOT_CONFIRMED : ($r == 7 ? YOU_ARE_ALREADY_LOGGED_IN_ANOTHER_SYSYTEM : COULD_NOT_FIND_YOUR_ACCOUNT )));
                       uni_redirect(PATH_ROOT . 'base/user/login');
                    }
                }
                else
                {
                    //user not found - create account
                    $email = '';
                    $profile_info = $con->get('users/show', array('user_id' => $id));
                    if(empty($profile_info))
                    {
                        $this->mlObj['mSession']->set('error', COULD_NOT_FIND_YOUR_TWITTER_ACCOUNT );
                        uni_redirect(PATH_ROOT.'base/user/login');
                    }
					
                    $name = $profile_info->screen_name;
                    //remove not allowed symbols in name
                    $name = preg_replace('/[^a-zA-Z0-9_\-]/', '', $name);

                    if(StringLen($name) > 0)
                    {
                        //check uniqueness
                        $k = 1;
                        while (1)
                        {
                            $usr = UserQuery::create()->Select(array('Id'))
                                    ->where('LOWER(user.name)="' . mysql_escape_string(ToLower($name)) . '"')
                                    ->findOne();
                            if (!empty($usr))
                            {
                                $name .= $k;
                                $k++;
                            }
                            else
                            {
                                break;
                            }
                        }
                    }
                    $first_name = '';
                    $last_name = '';
                    if(!empty($profile_info->name))
                    {
                        $nm = explode(' ', $profile_info->name, 2);
                        $first_name = $nm[0];
                        $last_name = !empty($nm[1]) ? $nm[1] : '';
                    }
					
					$this->mSession->Set('twAuth_email', $email);
					$this->mSession->Set('twAuth_first_name', $first_name);
					$this->mSession->Set('twAuth_last_name', $last_name);
					$this->mSession->Set('twAuth_name', $name);
					
//					deb($_SESSION);
                    if(!$st)
                    {
						$this->mlObj['mSession']->set('error', TO_CREATE_YOUR_TWITTER_ACCOUNT_SELECT_STATUS );	
                      	uni_redirect(PATH_ROOT.'base/user/login');
                    }
                    else
                    {
                        uni_redirect(PATH_ROOT.'reg/?status='.$st);
                    }
                }
            }
            else
            {
                $this->mlObj['mSession']->set('error', COULD_NOT_FIND_YOUR_TWITTER_ACCOUNT );
                uni_redirect(PATH_ROOT.'base/user/login');
            }
        }
        else
        {
            //redirect user to registration page with error text
            $this->mlObj['mSession']->set('error', COULD_NOT_FIND_YOUR_TWITTER_ACCOUNT );
			uni_redirect(PATH_ROOT.'reg/?status='.$_SESSION['regstatus']);
        }

    }


    /**
     * Connect to twitter account
     * @return void
     */
    public function TwitterConnect()
    {
        if(!$this->mUser->IsAuth())
        {
            uni_redirect(PATH_ROOT);
        }
        $err = '';
        require_once('libs/twitteroauth/twitteroauth.php');
        $token = _v('oauth_token', '');
        $verifier = _v('oauth_verifier', '');

        if ($token && $this->mlObj['mSession']->get('oauth_token') !== $token)
        {
            $this->mlObj['mSession']->del('oauth_token');
            $this->mlObj['mSession']->del('oauth_token_secret');
            uni_redirect(PATH_ROOT);
        }

        $con = new TwitterOAuth(TWITTER_CONSUMER_KEY,
                                TWITTER_CONSUMER_SECRET,
                                $this->mlObj['mSession']->get('oauth_token'),
                                $this->mlObj['mSession']->get('oauth_token_secret'));

        //get access tokens from twitter
        $access_token = $con->getAccessToken($verifier);

        //clean old tokens
        $this->mlObj['mSession']->del('oauth_token');
        $this->mlObj['mSession']->del('oauth_token_secret');

        if($con->http_code == 200)
        {
            $this->mlObj['mSession']->set('access_token', $access_token);

            if(!empty($access_token['user_id']))
            {
                $id = $access_token['user_id']; //twitter user id
                if($this->mUser->mUserInfo['TwId'] == $id)
                {
                    //update tokens in base
                    UserQuery::create()->select(array('Id'))->filterById($this->mUser->mUserInfo['Id'])->update(
                            array(
                                'TwOauthToken' => $access_token['oauth_token'],
                                'TwOauthTokenSecret' => $access_token['oauth_token_secret']
                            )
                    );
                }
                else
                {
                    $err = YOUR_SPECIFIED_TWITTER_ACCOUNT_ID_DOES_NOT_MATCH_ACCOUNT_YOU_LOGGED_IN;
                }
            }
            else
            {
                $err = COULD_NOT_FIND_YOUR_TWITTER_ACCOUNT;
            }
        }
        else
        {
            $err = COULD_NOT_FIND_YOUR_TWITTER_ACCOUNT;
        }
        if(!empty($err))
        {
            $this->mlObj['mSession']->set('error', ACCOUNT_WAS_NOT_CONNECTED . $err);
        }
        uni_redirect(PATH_ROOT . ($this->mUser->mUserInfo['Status'] == 1 ? 'fan' : 'artist') . '/settings');
    }

    /**
     * get facebook authorize url for login redirect
     * @return void
     */
    public function FbGetAuthUrl()
    {
        $res = array('q' => ERR );

        $st = _v('st', 0);
        if(!in_array($st, array(1, 2)))
        {
            $st = 0;
        }
        $this->mlObj['mSession']->set('regstatus', $st);

        require_once 'libs/facebook-php-sdk/src/facebook.php';
        $facebook = new Facebook(array('appId'  => FACEBOOK_API_ID, 'secret' => FACEBOOK_API_SECRET, 'cookie' => true));
        $loginUrl = $facebook->getLoginUrl(array(
                                'scope' => 'email,read_stream,publish_stream',
                                'redirect_uri' => 'http://' . DOMAIN . '/base/user/facebookauth'
                                ));
        $res['q'] = OK;
        $res['url'] = $loginUrl;
        echo json_encode($res);
        exit();
    }

    /**
     * Login with facebook (without javascript)
     * @return void
     */
    public function FacebookAuth()
    {
        if (!$this->mUser->IsAuth())
        {
            $st = $this->mlObj['mSession']->get('regstatus');

            require_once 'libs/facebook-php-sdk/src/facebook.php';
            $facebook = new Facebook(array('appId'  => FACEBOOK_API_ID, 'secret' => FACEBOOK_API_SECRET, 'cookie' => true));

            //facebook user ID
            $id = $facebook->getUser();
            if($id)
            {
                try
                {
                    //Proceed knowing you have a logged in user who's authenticated.
                    $user_profile = $facebook->api('/me');
                }
                catch (FacebookApiException $e)
                {
                    $this->mlObj['mSession']->set('error', YOU_MUST_SIGN_IN_WITH_YOUR_FACEBOOK_ACCOUNT);
                    $id = null;
                }
            }
            if ($id)
            {
                $email = $user_profile['email'];

                $ui = UserQuery::create()
                            ->select(array('Id', 'Pass', 'Email'))
                            ->filterByFbId($id)
                            ->findOne();

                if (empty($ui) && !empty($email))
                {
                    /**
                     * no user with such FB id
                     * get user by email
                     */
                    $ui = UserQuery::create()
                            ->select(array('Id', 'Pass', 'Email'))
                            ->filterByEmail($email)
                            ->findOne();
                    if (!empty($ui))
                    {
                        /**
                         * found user by email, bind him to FB id
                         */
                        UserQuery::create()->select(array('Id'))->filterById($ui['Id'])->update(array('FbId' => $id, 'FbStart' => 2));
                    }
                }

                if (!empty($ui))
                {
                    //existing token
                    $token = $facebook->getAccessToken();
                    //get extending access_token expiration time
                    $ext_token = $facebook->getExtendedAccessToken($token);
                    if(!empty($ext_token))
                    {
                        //update extended tokens in base
                        UserQuery::create()->select(array('Id'))->filterById($ui['Id'])->update(array('FbToken' => $ext_token));
                    }
                    //login
                    $pass = hex2bin($ui['Pass']);
                    $this->mUser->mRc4->decrypt($pass);
                    $_REQUEST['system_login'] = $ui['Email'];
                    $_REQUEST['system_pass'] = $pass;
                    $this->mlObj['mSession']->set('fb_id', $id);


                    $r = $this->mUser->CheckAuth();
                    if($r == 1)
                    {
                        uni_redirect(PATH_ROOT);
                    }
                    else
                    {
                        $this->mlObj['mSession']->set('error', ($r == 5 ? ACCOUNT_EMAIL_IS_NOT_CONFIRMED : ($r == 7 ? YOU_ARE_ALREADY_LOGGED_IN_ANOTHER_SYSYTEM : COULD_NOT_FIND_YOUR_ACCOUNT )));
                        uni_redirect(PATH_ROOT . 'base/user/login');
                    }
                }
                else
                {
                    //create account
                    $name = $user_profile['name'];
                    $first_name = $user_profile['first_name'];
                    $last_name = $user_profile['last_name'];

                    $mUser = new User();
                    $mUser->setEmail($email);
                    $mUser->setFirstName(ucwords(strtolower($first_name)));
                    $mUser->setLastName(ucwords(strtolower($last_name)));
                    //$mUser->setName($name);
                    $mUser->setFbStart(0);
                    $mUser->setPass('');
                    $mUser->setStatus(1);
                    $mUser->setRegDate(mktime());
                    $mUser->setEmailConfirmed(1);

                    $mUser->setFbId($id);

                    //existing token
                    $token = $facebook->getAccessToken();
                    //get extending access_token expiration time
                    $ext_token = $facebook->getExtendedAccessToken($token);
                    $mUser->setFbToken($ext_token);

                    $mUser->save();
                    $uid = $mUser->getId();

                    $this->mlObj['mSession']->set('fb_id', $id);
                    $this->mUser->CheckAuth();

                    if(!$st)
                    {
                        uni_redirect(PATH_ROOT.'base/user/login');
                    }
                    else
                    {
                        uni_redirect(PATH_ROOT.'reg/?status='.$st);
                    }
                }
            }
            else
            {
                $this->mlObj['mSession']->set('error', COULD_NOT_FIND_YOUR_FACEBOOK_ACCOUNT);
                uni_redirect(PATH_ROOT.'base/user/login');
            }
        }
        uni_redirect(PATH_ROOT.'base/user/login');
    }

    /**
     * Connect to facebook account
     * @return void
     */
    public function FacebookConnect()
    {
        if(!$this->mUser->IsAuth())
        {
            uni_redirect(PATH_ROOT);
        }
        $err = '';
        require_once 'libs/facebook-php-sdk/src/facebook.php';
        $facebook = new Facebook(array('appId'  => FACEBOOK_API_ID, 'secret' => FACEBOOK_API_SECRET));

        //facebook user ID
        $id = $facebook->getUser();
        if($id)
        {
            try
            {
                //Proceed knowing you have a logged in user who's authenticated.
                $user_profile = $facebook->api('/me');
            }
            catch (FacebookApiException $e)
            {
                $err = YOU_MUST_SIGN_IN_WITH_YOUR_FACEBOOK_ACCOUNT;
                $id = null;
            }
        }
        if ($id)
        {
            if($this->mUser->mUserInfo['FbId'] == $id)
            {
                //existing token
                $token = $facebook->getAccessToken();

                //get extending access_token expiration time
                $ext_token = $facebook->getExtendedAccessToken($token);

                if(!empty($ext_token))
                {
                    //update extended tokens in base
                    UserQuery::create()->select(array('Id'))->filterById($this->mUser->mUserInfo['Id'])->update(
                        array('FbToken' => $ext_token)
                    );
                    $facebook->setAccessToken($ext_token);
                }
            }
            else
            {
                $err = YOUR_SPECIFIED_FACEBOOK_ACCOUNT_ID_DOES_NOT_MATCH_ACCOUNT_YOU_LOGGED_IN;
            }
        }
        else
        {
            $err = COULD_NOT_FIND_YOUR_FACEBOOK_ACCOUNT;
        }
        if(!empty($err))
        {
            $this->mlObj['mSession']->set('error', ACCOUNT_WAS_NOT_CONNECTED . $err);
        }
        uni_redirect(PATH_ROOT . ($this->mUser->mUserInfo['Status'] == 1 ? 'fan' : 'artist') . '/settings');
    }

    /**
     * Admin manage users page
     * @return void
     */
    public function IndexAdmin()
    {
        //check admin status
        if(!$this->mUser->CheckAdminStatus())
        {
            uni_redirect(PATH_ROOT);
        }

        $status = _v('status', 1);
        if(!in_array($status, array(1, 2)))
        {
            $status = 1;
        }
        $this->mSmarty->assign('status', $status);
        $this->mSmarty->assign('pcnt', !empty($_SESSION['upcnt']) ? $_SESSION['upcnt'] : 10);
        $this->mSmarty->assign('no_right', 1);

        $this->mSmarty->assign('SITE_NAME', SITE_NAME);
        
        //show template
        $this->mSmarty->assign('amodule', 'users');
        $this->mSmarty->display('mods/admin/users/_list.html');
    }

    /**
     * Ajax users list
     * @return void
     */
    public function AdminUsersList()
    {
        //check admin status
        if(!$this->mUser->CheckAdminStatus())
        {
            exit();
        }
        $res = array('q' => OK );

        $page = _v('page', 1);
        $status = _v('status', 0);
        $pcnt = _v('pcnt', !empty($_SESSION['upcnt']) ? $_SESSION['upcnt'] : 10);
        $_SESSION['upcnt'] = $pcnt;

        $this->mSmarty->assignByRef('status', $status);		
		$s_email = $_POST['s']['email'];
        $this->mSmarty->assignByRef('s_email', $s_email);
		$s_name = $_POST['s']['name'];
        $this->mSmarty->assignByRef('s_name', $s_name);				
		$s_location = $_POST['s']['location'];
        $this->mSmarty->assignByRef('s_location', $s_location);
		
		$featured = $_POST['s']['featured'];
        $this->mSmarty->assignByRef('featured', $featured);	
					
		$emailConfirmed = $_POST['s']['emailConfirmed'];
        $this->mSmarty->assignByRef('emailConfirmed', $emailConfirmed);		
		        
        //filters
        $filters = '';
        if (empty($_POST['s']) && !empty($_POST['flist']))
        {
            $_POST['s'] = @unserialize($_POST['flist']);
        }
        if (!empty($_POST['s']))
        {
            $res['flist'] = serialize($_POST['s']);

            foreach ($_POST['s'] as $k => $v)
            {
                $v = addslashes(trim(strip_tags($v)));
                switch ($k)
                {
                    case 'email':
                        if ($v)
                        {
                            $filters .= ($filters ? ' AND ' : '') . '(user.email LIKE "%' . $v . '%")';
                        }
                        break;

                    case 'name':
                        if ($v)
                        {
                            $vq = explode(' ', $v);
                            $sq = '';
                            foreach ($vq as $v2)
                            {
                                if (strlen($v2) > 1)
                                {
                                    $sq .= (!$sq ? '' : ' AND ') . '(user.first_name LIKE "%' . $v2 . '%" OR user.last_name LIKE "%' . $v2 . '%" OR user.name LIKE "%' . $v2 . '%" OR user.band_name LIKE "%' . $v2 . '%")';
                                }
                            }
                            if ($sq)
                            {
                                $filters .= ($filters ? ' AND ' : '') . '('.$sq.')';
                            }
                        }
                        break;

                    case 'location':
                        if ($v)
                        {
                            $filters .= ($filters ? ' AND ' : '') . '(user.location LIKE "%' . $v . '%")';
                        }
                        break;
                    case 'featured':
                        if ($v)
                        {
                            $filters .= ($filters ? ' AND ' : '') . '(user.featured=1)';
                        }
                        break;
					 case 'emailConfirmed':
                        if ($v)
                        {
                            $filters .= ($filters ? ' AND ' : '') . '(user.email_confirmed=0)';
							
                        }
                }
            }
        }

        $list = User::GetUsersList($status, $page, $pcnt, $filters);
		
		$rcnt = $list['rcnt'];
        $list = $list['list'];
        include_once 'model/Pagging.class.php';
        $link = 'oUsers.UsersList';
        $mpg = new Pagging($pcnt, $rcnt, $page, $link);
        $res['pagging'] = $mpg->Make($this->mSmarty, 1);
        $res['page'] = $page;

        $this->mSmarty->assignByRef('list', $list);


		
        $res['data'] = $this->mSmarty->Fetch('mods/admin/users/ajax/_list_ajax.html');

        echo json_encode($res);
        exit();
    }

    /**
     * Ajax users list
     * @return void
     */
    public function AdminSlideUsersList()
    {
        //check admin status
        if(!$this->mUser->CheckAdminStatus())
        {
            exit();
        }
        $res = array('q' => OK );
		
		$email = _v('email', '');
		$name = _v('name', '');
		$location = _v('location', '');
		$featured = _v('featured', '');

        
        //filters
        $filters = '';
	
		if($email)
		{
               $filters .= ($filters ? ' AND ' : '') . '(user.email LIKE "%' . $email . '%")';
		}
		if($name)
		{	
              $vq = explode(' ', $name);
              $sq = '';
              foreach ($vq as $v2)
              {
                     if (strlen($v2) > 1)
                     {
                           $sq .= (!$sq ? '' : ' AND ') . '(user.first_name LIKE "%' . $v2 . '%" OR user.last_name LIKE "%' . $v2 . '%" OR user.name LIKE "%' . $v2 . '%" OR user.band_name LIKE "%' . $v2 . '%")';
                      }
              }
               if ($sq)
              {
                      $filters .= ($filters ? ' AND ' : '') . '('.$sq.')';
	          }    
		}
		if($location)
		{
			$filters .= ($filters ? ' AND ' : '') . '(user.location LIKE "%' . $location . '%")';
		}
		
	   $list = User::GetUsersList(USER_ARTIST, '', '', $filters);

        $this->mSmarty->assignByRef('list', $list);
        $res['data'] = $this->mSmarty->Fetch('mods/admin/slide/ajax/_user_list_ajax.html');

        echo json_encode($res);
        exit();
    }
	
    /**
     * User info in admin panel
     * @return void
     */
    public function AdminShowUser()
    {
        //check admin status
        if(!$this->mUser->CheckAdminStatus())
        {
            uni_redirect(PATH_ROOT);
        }

        $id = _v('id', 0);
        if(!$id)
        {
            uni_redirect(PATH_ROOT . 'base/user/');
        }
        //get user info
        $ui = User::GetUserFullInfo($id);
        if(empty($ui))
        {
            uni_redirect(PATH_ROOT . 'base/user/indexadmin');
        }

        if(!empty($ui['Country']))
        {
            $ui['Country'] = Countries::GetCountryName($ui['Country']);
        }
        if (!empty($ui['RecordLabel']))
        {
            $ui['RecordLabel'] =  @unserialize($ui['RecordLabel']);
        }
        if (!empty($ui['RecordLabelLink']))
        {
            $ui['RecordLabelLink'] =  @unserialize($ui['RecordLabelLink']);
        }
        if (!empty($ui['Genres']))
        {
            $ui['Genres'] =  make_array_keys_1( explode(',', $ui['Genres']) );
        }

        $this->mSmarty->assignByRef('ui', $ui);

        //genres
        $this->mSmarty->assignByRef('genres', User::GetGenresList());
        
        $this->mSmarty->assign('no_right', 1);
		
		// Item Sales/Purchase count and price
		$video = Video::AdminVideoCount( $id, $ui['Status'], $this->mCache );		
        $this->mSmarty->assignByRef('video', $video);

		$music = Music::AdminMusicCount( $id, $ui['Status'], $this->mCache );		
        $this->mSmarty->assignByRef('music', $music);
		
		$photo = Photo::AdminPhotoCount( $id, $ui['Status'], $this->mCache );		
        $this->mSmarty->assignByRef('photo', $photo);

		$event = Event::AdminEventCount( $id, $ui['Status'], $this->mCache );		
        $this->mSmarty->assignByRef('event', $event);	
		
		$total_count = $video['count']+$music['count']+$photo['count']+$event['count']; 
        $this->mSmarty->assignByRef('total_count', $total_count);			
		
		$total_price = $video['price']+$music['price']+$photo['price']+$event['price']; 
        $this->mSmarty->assignByRef('total_price', $total_price);					
		//end
		
        //show template
        $this->mSmarty->assign('SITE_NAME', SITE_NAME);
        $this->mSmarty->assign('amodule', 'users');
        $this->mSmarty->display('mods/admin/users/_user_info.html');
    }

    /**
     * User profile edit in admin panel
     * @return void
     */
    public function AdminEditUser()
    {
        //check admin status
        if(!$this->mUser->CheckAdminStatus())
        {
            uni_redirect(PATH_ROOT);
        }

        $id = _v('id', 0);
        if(!$id)
        {
            uni_redirect(PATH_ROOT . 'base/user/indexadmin');
        }
        //get user info
        $ui = User::GetUserFullInfo($id);
        if(empty($ui))
        {
            uni_redirect(PATH_ROOT . 'base/user/indexadmin');
        }


        $genres_list = User::GetGenresList();

        //ajax edit submit
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

            if (!empty($fm['Email']) && $ui['Email'] != $fm['Email'])
            {
                if (empty($fm['Email']))
                {
                    $errs['Email'] = PLEASE_SPECIFY_EMAIL;
                }
                elseif (!verify_email($fm['Email']))
                {
                    $errs['Email'] = PLEASE_SPECIFY_CORRECT_EMAIL;
                }
                else
                {
                    $eml = UserQuery::create()->Select(array('Id'))
                            ->where('LOWER(user.email)="' . mysql_escape_string(ToLower($fm['Email'])) . '" OR LOWER(user.alt_email) LIKE "%\"'.mysql_escape_string(ToLower($fm['Email'])) . '\"%"')
                            ->filterById($id, Criteria::NOT_EQUAL)
                            ->findOne();
                    if (!empty($eml))
                    {
                        $errs['Email'] = USER_WITH_THAT_EMAIL_ALREADY_EXIST;
                    }
                }
            }

            if (!empty($fm['Pass']))
            {
                if (strlen($fm['Pass']) < 6)
                {
                    $errs['Pass'] = MIN_PASSWORD_LENGTH_6_SYMBOLS;
                    $fm['Pass'] = '';
                }
            }
            else
            {
                unset($fm['Pass']);
            }

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
                            ->filterById($id, '<>')
                            ->findOne();

                    if (!empty($usr))
                    {
                        $errs['Name'] = USER_WITH_THAT_USERNAME_ALREADY_EXISTS;
                    }
                }
            }

            //genres
            if($ui['Status'] == 2)
            {
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
            }
			if($fm['UserPhone'])
			{	
				$user_phone = Valid::Integer($fm, 'UserPhone');
	
				if (empty($user_phone))
				{
					$errs['UserPhone'] = PLEASE_SPECIFY_USER_PHONE_NUMBER_AS_INTEGER;
				}
			}

            if (empty($errs))
            {
                if(!empty($_FILES['file']['name']))
                {
                    $avatar = $this->UploadAvatar($id, 'file');
                    if (is_array($avatar))
                    {
                        //errors
                        echo json_encode(array('q' => ERR , 'errs' => $avatar));
                        exit();
                    }
                }
                //dob
                $month = (isset($fm['mm']) && isset($dd[$fm['mm']])) ? $fm['mm'] : 0;
                $day = (isset($fm['dd']) && isset($dd[$fm['dd']])) ? $fm['dd'] : 0;
                $year = (isset($fm['yy']) && isset($yy[$fm['yy']])) ? $fm['yy'] : 0;
                $dob = $year . '-' . ($month < 10 ? '0' . $month : $month) . '-' . ($day < 10 ? '0' . $day : $day);

                if($ui['Status'] == 2)
                {
                    $record_label       = !empty($fm['RecordLabel']) ? serialize($fm['RecordLabel']) : '';
                    $record_label_link  = !empty($fm['RecordLabelLink']) ? serialize($fm['RecordLabelLink']) : '';
                    $up = array(
                        'FirstName' => $fm['FirstName'],
                        'LastName' => $fm['LastName'],
                        'Name' => $fm['Name'],
                        'Dob' => $dob,
                        'Country' => !empty($fm['Country']) ? strip_tags($fm['Country']) : '',
                        'Location' => !empty($fm['Location']) ? strip_tags($fm['Location']) : '',
                        'Likes' => !empty($fm['Likes']) ? trim(strip_tags($fm['Likes'])) : '',
                        'About' => !empty($fm['About']) ? trim(strip_tags($fm['About'])) : '',
                        'Gender' => (!empty($fm['Gender']) && in_array($fm['Gender'], array(1, 2))) ? $fm['Gender'] : 0,
                        'BandName' => Valid::String($fm, 'BandName'),
                        'YearsActive' => Valid::String($fm, 'YearsActive'),
                        'Genres' => implode(',', $genres),
                        'Members' => Valid::String($fm, 'Members'),
                        'Website' => str_replace('http://', '', check_valid_url(Valid::String($fm, 'Website'))),
                        'Bio' => Valid::String($fm, 'Bio'),
                        'RecordLabel' => $record_label,
                        'RecordLabelLink' => $record_label_link,
                        'Location' => Valid::String($fm, 'Location'),
                        'Featured' => !empty($fm['Featured']) ? 1: 0,
						'UserPhone' => $fm['UserPhone']
                    );
                }
                else
                {
                    $up = array(
                        'FirstName' => $fm['FirstName'],
                        'LastName' => $fm['LastName'],
                        'Name' => $fm['Name'],
                        'Dob' => $dob,
                        'Country' => !empty($fm['Country']) ? strip_tags($fm['Country']) : '',
                        'Location' => !empty($fm['Location']) ? strip_tags($fm['Location']) : '',
                        'HideLoc' => !empty($fm['HideLoc']) ? 1 : 0,
                        'Zip' => !empty($fm['Zip']) ? strip_tags($fm['Zip']) : '',
                        'Likes' => !empty($fm['Likes']) ? trim(strip_tags($fm['Likes'])) : '',
                        'About' => !empty($fm['About']) ? trim(strip_tags($fm['About'])) : '',
                        'Gender' => (!empty($fm['Gender']) && in_array($fm['Gender'], array(1, 2))) ? $fm['Gender'] : 0
                    );
                }
                if(!empty($fm['Pass']))
                {
                    $origpass = $fm['Pass'];
                    $this->mUser->mRc4->crypt($fm['Pass']);
                    $fm['Pass'] = bin2hex($fm['Pass']);
                    if($fm['Pass'] != $ui['Pass'])
                    {
                        $up['Pass'] = $fm['Pass'];
                    }
                }
                if ((!empty($fm['DeleteAvatar']) || !empty($avatar)) && !empty($ui['Avatar']))
                {
                    //delete avatar
                    if (file_exists(BPATH.'files/images/avatars/m_'.$ui['Avatar']))
                    {
                        @unlink( BPATH.'files/images/avatars/s_'.$ui['Avatar'] );
                        @unlink( BPATH.'files/images/avatars/m_'.$ui['Avatar'] );
                        @unlink( BPATH.'files/images/avatars/x_'.$ui['Avatar'] );
                    }
                    $up['Avatar'] = '';
                }
                if(!empty($avatar))
                {
                    $up['Avatar'] = $avatar;

                }
                if(!empty($fm['Email']) && $fm['Email'] != $ui['Email'])
                {
                    $up['Email'] = $fm['Email'];
                }

                UserQuery::create()->select(array('Id'))->filterById($id)->update($up);

                //send email if e-mail or password was changed
                if(!empty($up['Email']) || !empty($up['Pass']))
                {
                    $this->mSmarty->assign('name', $ui['FirstName'] . ' ' . $ui['LastName']);
                    $this->mSmarty->assign('SITE_NAME', SITE_NAME);
                    $this->mSmarty->assign('DOMAIN', DOMAIN);

                    if(!empty($up['Email']))
                    {
                        $this->mSmarty->assign('email', $up['Email']);
                    }
                    if(!empty($up['Pass']))
                    {
                        $this->mSmarty->assign('pass', $origpass);
                    }
					
					$fromEmail = ADMIN_EMAIL;
					$fromName = SITE_NAME;
					if (!empty($up['Email'])) {
						$toEmail = $up['Email'];
						$toName =  $up['FirstName'] . ' ' . $up['LastName'];
					} else {
						$toEmail = $ui['Email'];
						$toName =  $ui['FirstName'] . ' ' . $ui['LastName'];
					}
					$subject = CHANGED_PROFILE_DATA_ON_SITE . SITE_NAME;
					$message = $this->mSmarty->fetch('mails/_change_profile.html');
					sendEmail($fromEmail,$fromName, $toEmail, $toName, $subject, $message);
                }
                echo json_encode(array('q' => OK ));
            }
            else
            {
                echo json_encode(array('q' => ERR, 'errs' => $errs));
                
            }
            exit();
        }

        if (!empty($ui['RecordLabel']))
        {
            $ui['RecordLabel'] =  @unserialize($ui['RecordLabel']);
        }
        if (!empty($ui['RecordLabelLink']))
        {
            $ui['RecordLabelLink'] =  @unserialize($ui['RecordLabelLink']);
        }
        if (!empty($ui['Genres']))
        {
            $ui['Genres'] =  make_array_keys_1( explode(',', $ui['Genres']) );
        }

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

        if($ui['Dob'] != '0000-00-00')
        {
            $ui['dd'] = date('j', strtotime($ui['Dob']));
            $ui['mm'] = date('n', strtotime($ui['Dob']));
            $ui['yy'] = date('Y', strtotime($ui['Dob']));
        }
        $this->mSmarty->assignByRef('fm', $ui);

        //genres
        $this->mSmarty->assignByRef('genres', $genres_list);
        //countries
        $this->mSmarty->assignByRef('countries', Countries::GetCountries($this->mCache));

        $this->mSmarty->assign('no_right', 1);

        //show template
        $this->mSmarty->assign('SITE_NAME', SITE_NAME);
        $this->mSmarty->assign('amodule', 'users');
        $this->mSmarty->display('mods/admin/users/_user_edit.html');
    }

    /**
     * User block/unblock
     * @return void
     */
	 
	 
	 
    public function AdminBlockUser()
    {
        //check admin status
        if(!$this->mUser->CheckAdminStatus())
        {
            uni_redirect(PATH_ROOT);
        }

        $id = _v('id', 0);
        if(!$id)
        {
            uni_redirect(PATH_ROOT . 'base/user/indexadmin');
        }
        //get user info
        $ui = User::GetUser($id, 1);
        if(empty($ui))
        {
            uni_redirect(PATH_ROOT . 'base/user/indexadmin');
        }

        if (empty($ui['Blocked']))
        {
            //block user
            $block_descr = strip_tags(_v('block_descr', ''));
            User::UpdateUser($id, array('Blocked' => 1, 'BlockReason' => $block_descr));
        }
        else
        {
            //unblock user
            User::UpdateUser($id, array('Blocked' => 0, 'BlockReason' => ''));
        }
        uni_redirect(PATH_ROOT . 'base/user/AdminShowUser?id=' . $id);
    }


    /**
     * User activate/
     * @return void
     */
	 
	 
	 
    public function AdminArtistActivate()
    {
		
		 $res = array('q' => OK );
        //check admin status
        if(!$this->mUser->CheckAdminStatus())
        {
            uni_redirect(PATH_ROOT);
        }

        $id = _v('id', 0);
		$activeStatus = _v('active', 0);
		
		if(!$id)
        {
			uni_redirect(PATH_ROOT . 'base/user/indexadmin');
        }
        //get user info
        $ui = User::GetUser($id, 1);
        if(empty($ui))
        {
            uni_redirect(PATH_ROOT . 'base/user/indexadmin');
        }
        if (empty($ui['email_confirmed']))
        {
		     //activate user
            User::UpdateUser($id, array('EmailConfirmed' => $activeStatus));
			$ud = User::GetUserFullInfo($id);
			$name = $ud['BandName'] ? $ud['BandName'] : $ud['FirstName'].' '.$ud['LastName'];			
			if($activeStatus == 1)
			{

					$this->mSmarty->assign('name', $name);
                    $this->mSmarty->assign('email', $ud['Email']);
                    $this->mSmarty->assign('SITE_NAME', SITE_NAME);
                    $this->mSmarty->assign('DOMAIN', DOMAIN);
					
					$fromEmail = ADMIN_EMAIL;
					$fromName = SITE_NAME;
					$toEmail = $ud['Email'];
					$toName = $name;
					$subject = ACCOUNT_ACTIVATION;
					$message = $this->mSmarty->fetch('mails/activation_mail.html');
					sendEmail($fromEmail,$fromName, $toEmail, $toName, $subject, $message);										
			}
			if($activeStatus == 0)
			{
					$this->mSmarty->assign('name', $name);
                    $this->mSmarty->assign('email', $ud['Email']);
                    $this->mSmarty->assign('SITE_NAME', SITE_NAME);
                    $this->mSmarty->assign('DOMAIN', DOMAIN);
					
					$fromEmail = ADMIN_EMAIL;
					$fromName = SITE_NAME;
					$toEmail = $ud['Email'];
					$toName = $name;
					$subject = ACCOUNT_DE_ACTIVATION;
					$message = $this->mSmarty->fetch('mails/deActivation_mail.html');
					sendEmail($fromEmail,$fromName, $toEmail, $toName, $subject, $message);
			}
        }
		echo json_encode($res);
        exit();
    }





    /**
     * User activate/
     * @return void
     */
	 
	 
	 
    public function AdminArtistVideosSetAsFeatured()
    {
		
		 $res = array('q' => OK );
        //check admin status
        if(!$this->mUser->CheckAdminStatus())
        {
            uni_redirect(PATH_ROOT);
        }

        $id = _v('id', 0);
		$activeStatus = _v('active', 0);
		
		if(!$id)
        {
			uni_redirect(PATH_ROOT . 'base/user/indexadmin');
        }
        //get user info
        $ui = Video::GetVideoInfo($id);
        if(empty($ui))
        {
            uni_redirect(PATH_ROOT . 'base/user/indexadmin');
        }
		
        if(empty($ui['featured']))
        {
		  //activate user
          $vd = Video::UpdateFeaturedVideo($id, $activeStatus);
		  //$ud = Video::GetVideoInfo($id);			
        }
		
		echo json_encode($res);
        exit();
    }




    /**
     * User delete
     * @return void
     */
    public function AdminDeleteUser()
    {
        //check admin status
        if(!$this->mUser->CheckAdminStatus())
        {
            uni_redirect(PATH_ROOT);
        }

        $id = _v('id', 0);
        if(!$id)
        {
            uni_redirect(PATH_ROOT . 'base/user/indexadmin');
        }
        //get user info
        $ui = User::GetUser($id, 1);
        if(empty($ui))
        {
            uni_redirect(PATH_ROOT . 'base/user/indexadmin');
        }

        /**
         * delete user info
         */
        //wall
        Wall::DeleteUserWall($ui['Id']);
        //shopping log
        ShoppingLog::DeleteUserLog($ui['Id']);
        //payments
        Payout::DeleteUserPayments($ui['Id']);
        //follow
        UserFollow::DeleteUserFollows($ui['Id']);

        if($ui['Status'] == 2)
        {
            //delete artist's content ????
            Music::DeleteUserContent($ui['Id']);
            MusicAlbum::DeleteUserContent($ui['Id']);
            Video::DeleteUserContent($ui['Id']);
            Event::DeleteUserContent($ui['Id']);
        }
        else
        {
            //delete fan's purchase
            MusicPurchase::DeleteUserPurchase($ui['Id']);
            VideoPurchase::DeleteUserPurchase($ui['Id']);
            EventPurchase::DeleteUserPurchase($ui['Id']);
            EventAttend::DeleteUserPurchase($ui['Id']);
        }

        if(!empty($ui['Avatar']))
        {
            //delete avatar
            if (file_exists(BPATH.'files/images/avatars/m_'.$ui['Avatar']))
            {
                @unlink( BPATH.'files/images/avatars/s_'.$ui['Avatar'] );
                @unlink( BPATH.'files/images/avatars/m_'.$ui['Avatar'] );
                @unlink( BPATH.'files/images/avatars/x_'.$ui['Avatar'] );
            }
        }

        //delete user
        User::DeleteUser($ui['Id']);
        uni_redirect(PATH_ROOT . 'base/user/indexadmin' . ($ui['Status'] == 2 ? '?status=2' : ''));
    }

	public function DeleteAvatar()
	{
				
		$res = array('q'=> OK );
		$avator = UserQuery::create()->select(array('Id', 'Avatar')) ->filterById($this->mUser->mUserInfo['Id']) ->findOne();
		if($avator['Avatar']){
			$delete = Wall::DeleteAwatorWall($avator['Avatar']);
		}
	    UserQuery::create()->select(array('Id', 'Avatar')) ->filterById($this->mUser->mUserInfo['Id']) ->update(array('Avatar' => ''));
				
		echo json_encode($res);
		exit;						
	}
	
    /**
     * Login page for admin
     * @return void
     */
    public function AdminLogin()
    {
        if ($this->mUser->IsAuth())
        {
            if (!$this->mUser->CheckAdminStatus())
            {
                $this->mUser->LogOut();
            }
            else
            {
                uni_redirect( PATH_ROOT . 'siteadmin' );
            }
        }
        $this->mSmarty->assign('SITE_NAME', SITE_NAME);
        $this-> mSmarty->Display('mods/admin/users/_login.html');
    }

	
	public function AddSlider() 
	{	
	
		$id = _v('id', 0);
        $album = _v('album', 0);
        $rand_id = _v('rand_id', rand(100000, 999999));
        $this->mSmarty->assign('rand_id', $rand_id);	
	
	
		if (!empty($_POST['fm']))
        {
	
            include_once 'model/Valid.class.php';
            $fm = $_POST['fm'];
            $errs = array();
						
			if(!$fm['AlbumId'] && !empty($fm['AlbumTitle']))
                {
				  //create album first
                    $fm['AlbumId'] = PhotoAlbum::AddAlbum($this->mUser->mUserInfo['Id'], $fm['AlbumTitle']);
                }
 			include_once 'model/Valid.class.php';
            
			$photo_date = date('Y-m-d');
            
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
			$image = $this->mSession->Get('upl_photo_' . $rand_id);	
				
				
			 //get count photos in album
			$count = PhotoAlbum::GetAlbumCountPhotos($fm['AlbumId']);
			//add photo
			$photoPrice = ((!empty($fm['PriceFree']) || empty($fm['Price'])) ? 0 : $fm['Price']);
			
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
					
                    //mid size
                    $mfn = MakeUserDir('files/photo/mid', $this->mUser->mUserInfo['Id']) . '/' . $fn;
                    i_crop_copy(700, 700, BPATH . $dir . '/' . $fn,  BPATH . $mfn, 2);
					
                    //delete tmp
                    @unlink(BPATH . $image);
                    $this->mSession->Del('upl_photo_' . $rand_id);

                    $image = $fn;
                }
					$sld = 1;
				 	$imageLocation = BPATH.'files/photo/origin/'. $this->mUser->mUserInfo['Id'] .'/'.$image;
					$imgJpgName = getJpgFileName($image);
					MakeUserDir('files/photo/slide', $this->mUser->mUserInfo['Id']);
					$slideLocation = BPATH . 'files/photo/slide/'. $this->mUser->mUserInfo['Id'] .'/' .$imgJpgName;
					if(file_exists($slideLocation))
					{
						unlink(BPATH . 'files/photo/slide/'. $this->mUser->mUserInfo['Id'] .'/' .$imgJpgName);
					}
					if(file_exists($imageLocation))
					{
						$tes = include_once 'libs/Crop/class.image.php';
						$thumbImage = new simpleImage();
						$thumbImage->load($imageLocation);
						
						$x1 = $_POST["x1"] ? $_POST["x1"] : 0;
						$y1 = $_POST["y1"] ? $_POST["y1"] : 0;
						$x2 = $_POST["x2"];
						$y2 = $_POST["y2"];
						$w = $_POST["w"] ? $_POST["w"] : SLIDE_WIDTH;
						$h = $_POST["h"] ? $_POST["h"] : SLIDE_HEIGHT;
						//Scale the image to the thumb_width set above
						$scale = SLIDE_WIDTH/$w;
						$reSizeImage = $thumbImage->resizeThumbnailImage($slideLocation, $w,$h,$x1,$y1,$scale);
					}
					
		$id = Photo::AddPhoto($this->mUser->mUserInfo['Id'], $fm['AlbumId'], $image, $sld, $photoPrice, $fm['Title'], $photo_date, ($count ? 0 : 1), $fm['Link'], $fm['IsNew']);
		
		$mesg = I_HAVE_JUST_ADDED_A_NEW_PHOTO;
		$link = '/base/profile/showPhotoOne?id='.$id.'';		
		//<a href="/u/' . $this->mUser->mUserInfo['Name'] . '/photo/' . $fm['AlbumId'] . '?ph=' . $id . '"  name="popBox" id="popBox" rel="group1" >new photo</a> '
		
      $wallId = Wall::Add( $this->mUser->mUserInfo['Id'], $this->mUser->mUserInfo['Id'], $mesg, $tfn, '', 0, $this->mCache, $link);
	  Photo::UpdatePhotoWallId($id, $wallId);
				
		}
		
		if($id)
		{
				  uni_redirect('/u/'.$this->mUser->mUserInfo['Name']);
				 exit;
		}
        $albums = PhotoAlbum::GetAlbumList($this->mUser->mUserInfo['Id'], 0, 0);
        $albums = make_assoc_array( $albums, 'Id' );
		if ($album && !isset($albums[$album]))
        {
            $album = 0;
        }
		$thumb_width = SLIDE_WIDTH;
		$thumb_height = SLIDE_HEIGHT;
		$ratio = $thumb_height / $thumb_width;
		$this->mSmarty->assign('tHeight', $thumb_height);
		$this->mSmarty->assign('tWidth', $thumb_width);
		
		$this->mSmarty->assign('ratio', $ratio);
		$this->mSmarty->assign('albums', $albums);
		$this->mSmarty->display('mods/user/add_slider.html');	
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
     * Upload photo file
     * @return void
     */
    public function UploadSlidePhoto()
    {
		 $rand_id = _v('rand_id', 0);

        include_once 'model/FileUpload.class.php';
        $mFu = new FileUpload(array('jpg', 'jpeg', 'gif', 'png'));
		
        //upload to tmp directory
        $result = $mFu->handleUpload( 'files/photo/tmp/');

		
/*		$tmpFileName = 'files/photo/tmp/'.$result['name'];
		list($width, $height) = getimagesize($tmpFileName);

		if($width < SLIDE_WIDTH || $height < SLIDE_HEIGHT){

			@unlink($tmpFileName);
			echo json_encode(array('success'=>false, 'message'=>'Could not uploaded.Image size should be above '.SLIDE_WIDTH.' x '.SLIDE_HEIGHT));
			exit;
		}*/
		
        if (!empty($result['success']) && 1==$result['success'])
        {
            $this->mSession->Set( 'upl_photo_'.$rand_id, $mFu->GetSavedFile() );
            $result['photo'] = $mFu->GetSavedFile();
			
			include_once BPATH. 'libs/Crop/class.image.php';
			
			$imgObj = new simpleImage();
			$imgObj->load($result['photo']);
			$imgObj->resizeToWidth(1025);
			$imgObj->save($result['photo']);
			
			$result['width'] = $imgObj->getWidth();
			$result['height'] = $imgObj->getHeight();

        }

        echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
        exit();
    }
	
	public function makePrimaryEmail()
	{
		$email = _v('email', '');
		if($email){
								
						UserQuery::create()->select('Id')->filterById($this->mUser->mUserInfo['Id'])
						->update( array( 'Email' => $email ));
						
						
						$uFullinfo = User::GetUserFullInfo($this->mUser->mUserInfo['Id']);
						$altEmailArr = unserialize($uFullinfo['AltEmail']);
						$this->mSmarty->assignByRef('altEmailArr', $altEmailArr);

						$this->mSmarty->assignByRef('primary_email', $email);
						if($this->mUser->mUserInfo['Status'] == USER_ARTIST)
							$res['data'] = $this->mSmarty->Fetch('mods/profile/edit_artist/ajax/changed_mail.html');						
						else
							$res['data'] = $this->mSmarty->Fetch('mods/profile/edit_fan/ajax/changed_mail.html');
							
                        $res['q'] = OK;			
						echo json_encode($res);
						exit();	
		}
	}



	public function removeEmail()
	{
		$delEmail = _v('Delemail', '');
		
				
		
		if($delEmail){
						$uFullinfo = User::GetUserFullInfo($this->mUser->mUserInfo['Id']);
						
						$altEmailArr = unserialize($uFullinfo['AltEmail']);
						$keyId = array_search($delEmail,$altEmailArr);
						unset($altEmailArr[$keyId]);
						
						$newArr = serialize($altEmailArr);
						

							UserQuery::create()->select('Id')->filterById($this->mUser->mUserInfo['Id'])
						->update( array( 'AltEmail' => $newArr ));

						$Fullinfo = User::GetUserFullInfo($this->mUser->mUserInfo['Id']);
						
						$altEmailA = unserialize($Fullinfo['AltEmail']);
						
						$this->mSmarty->assignByRef('altEmailArr', $altEmailA);

						$this->mSmarty->assignByRef('primary_email', $email);
						
						$res['data'] = $this->mSmarty->Fetch('mods/profile/edit_fan/ajax/changed_mail.html');
                        $res['q'] = OK;			
						echo json_encode($res);
						exit();	
		}
	}

    public function SlideLinkVideo()
    {
        $this->mSmarty->assign('module', 'Video');
		
		$res = array('q' => OK );				
        $u_id = _v('id', 0);

			$video = Video::GetVideoList( $u_id, 1, 1 );
            //videos            			
			$this->mSmarty->assignByRef('video', $video['list']);			   
            
			$res['data'] = $this->mSmarty->Fetch('mods/user/ajax/_video_list_ajax.html');
		
			echo json_encode($res);
			exit();			
    }
    public function SlideLinkMusic()
    {
        $this->mSmarty->assign('module', 'Music');
     
		$res = array('q' => OK );				
        $u_id = _v('id', 0);

			$albums = MusicAlbum::GetAlbumList($u_id, 1, 1);

            $this->mSmarty->assignByRef('albums', $albums);
            
			$res['data'] = $this->mSmarty->Fetch('mods/user/ajax/_music_list_ajax.html');
		
			echo json_encode($res);
			exit();			
    }	
    public function SlideLinkEvent()
    {
        $this->mSmarty->assign('module', 'Events');
	
	    $res = array('q' => OK );				
        $u_id = _v('id', 0);


        $u_events = Event::EventsList( $u_id, 0, 0, array('from' => date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s'), date("m"), date("d")-1, date("Y")))), '', '', '', EVENT_APPROVED);

            $this->mSmarty->assignByRef('u_events', $u_events);
	   
            
			$res['data'] = $this->mSmarty->Fetch('mods/user/ajax/_event_list_ajax.html');
		
			echo json_encode($res);
			exit();			
    }
    public function SlideLinkPhoto()
    {
        $this->mSmarty->assign('module', 'Photo');
		        
		$res = array('q' => OK );				
        $u_id = _v('id', 0);

			$albums = PhotoAlbum::GetAlbumList($u_id);
            //videos
            			
			$this->mSmarty->assignByRef('albums', $albums);			   
            
			$res['data'] = $this->mSmarty->Fetch('mods/user/ajax/_photo_list_ajax.html');
		
			echo json_encode($res);
			exit();			
    }
	
	
	public function EditUserPhotoDetail()
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
			if($mode && $id ){
			$photo_date = date('Y-m-d');
			// for now im using desc as title 
			if($desc) { 
				$phTitle = $desc; 
			} else { 
				$phTitle = $photo['Title'];  
			}			
			$up = array('Title' => $phTitle  , 'AlbumId' => $albumId,  'PhotoDate' => $photo_date);				

            $updatedId  = Photo::EditPhoto($id, $up);
		    $res['q'] = OK;			
			echo json_encode($res);
			exit();				
			}
	    return $this->mSmarty->display('mods/profile/blocks/_edit_allphoto.html');	

		}
	
	
	
	
	public function UserFollowRemove()
	{	
		$res = array('q' => OK );
		
		$delete_id = _v('delete_id', 0);

		if($delete_id)
		{
			UserFollow::UserFollowRemove($delete_id);
			
			echo json_encode($res);
		    exit();	
        }
	
	}
		
	public function ExportData()
    {
		$header = " \nUser Information\n\n";
	
		$status = _v('status', '');		
		$email = _v('s_email', '');
		$name = _v('s_name', '');
		$location = _v('s_location', '');		
		$featured = _v('featured', '');		
		$emailConfirmed = _v('emailConfirmed','');

		$arr = array();
		$arr[] = 'UserName';
		$arr[] = 'Name';
		$arr[] = 'BandName';
		$arr[] = 'Gender';
		$arr[] = 'DOB';
		$arr[] = 'Email';
		$arr[] = 'Location';
		
		if($status == USER_ARTIST)
		{
			$arr[] = 'Phone';
		}
				
		$list = implode($arr,',');
		$header .= $list."\r\n";
			
		//$f = $fan_ids;
		

		
		$filters ='';
		$sq ='';
		if($email)	
		{
				$filters .= ($filters ? ' AND ' : '') . '(user.email LIKE "%' . $email . '%")';
		}
		if($name)
		{
			$sq .= (!$sq ? '' : ' AND ') . '(user.first_name LIKE "%' . $name . '%" OR user.last_name LIKE "%' . $name . '%" OR user.name LIKE "%' . $name . '%" OR user.band_name LIKE "%' . $name . '%")';
	 
			$filters .= ($filters ? ' AND ' : '') . '('.$sq.')';
		}
		if($location)
		{
				$filters .= ($filters ? ' AND ' : '') . '(user.location LIKE "%' . $location . '%")';
		}
		if($status == 2)
		{		
			if($featured)
			$filters .= ($filters ? ' AND ' : '') . '(user.featured=' . $featured . ')';
			if($emailConfirmed)
			$filters .= ($filters ? ' AND ' : '') . '(user.email_confirmed = 0)';							  									
		}	
       $userList = User::GetUsersList($status, '', '', $filters);		
	   $userList = $userList['list'];

		foreach($userList as $value)
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

			$arr = array();			
			$arr[] = $value['Name'];
			$arr[] = $value['FirstName'].' '.$value['LastName'];
			$arr[] = $value['BandName'];
			$arr[] = $gen;
			$arr[] = $dob;
			$arr[] = $value['Email'];
			$arr[] = $value['Location'];
			
			if($status == USER_ARTIST)
			{
				$arr[] = $value['UserPhone'];
			}
			
			$list = implode($arr, '","');
			$list = '"'.trim($list, ',"').'"';
			$header .= $list."\r\n";		
		
			//$header .= " ".$value['Name']." , ".$value['FirstName'].' '.$value['LastName']." , ".$value['BandName']." , ".$gen." , ".$dob." , ".$value['Email']." , ".$value['Location']."\n";
		
		}
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=user_list.csv");
		header("Pragma: no-cache");
		header("Expires: 0");
		print "$header"; 
		die;
	}	

	public function checkNotificationLogin()
	{
        if ($this->mUser->IsAuth())
        {
		$res['q']	=	true;
		}
		else
		{
		$res['q']	=	false;		
		}
        
		echo json_encode($res);
		exit;
	}	
	public function ConnectFB()
	{
/*		print_r($_REQUEST);
		echo "#";
		print_r($this->mUser->mUserInfo['AltEmail']);
		echo "#";
		print_r($this->mUser->IsAuth());
		echo "#";
		deb($_SESSION);*/
		
		$userId = $_SESSION['system_uid'];
		$userEmail = $_SESSION['system_login'];


		
		$ajaxMode = _v('ajaxMode', '');
		
		$cFb_id = _v('id', '');
		$cFb_firstname = _v('fname', '');
		$cFb_lastname = _v('lname', '');
		$cFb_name = _v('name', '');
		$cFb_email = _v('email', '');		
		
		$eml = UserQuery::create()->Select(array('Id'))
										->where('LOWER(user.email)="' . mysql_escape_string(ToLower($cFb_email)) . '" OR LOWER(user.alt_email) LIKE "%\"'.mysql_escape_string(ToLower($cFb_email)) . '\"%"');

		$eml = $eml->findOne();
		if (!empty($eml))
		{
			$res['q'] = 'err';			
			$res['err'] = USER_WITH_THAT_EMAIL_ALREADY_EXIST;
		}
		else
		{	
			$res['q'] = 'ok';
			$res['msg'] = YOU_ARE_CONNECTED_SUCCESSFULLY;
			
			$this->mlObj['mSession']->set('facebook_id', $cFb_id);
					
			$altEmailArr = unserialize($this->mUser->mUserInfo['AltEmail']);	
								
			//merge the email ids with existing
			$new_email = $cFb_email;
	
			if(!in_array($new_email, $altEmailArr))
			{		
				$altEmailTmp = array_merge($altEmailArr, array($new_email));
			}
			$add_email = serialize($altEmailTmp);

			if($ajaxMode)
			{
				UserQuery::create()->select(array('Id'))->filterById($userId)
							->update(array('FbId' => $cFb_id, 'FbStart' => 1, 'AltEmail' => $add_email));
			}
		}			
		echo json_encode($res);
		exit;
	}
	
    public function ConnectTwtGetAuthUrl()
    {
        $res = array('q' => ERR );
        $st = _v('st', 0);
        if(!in_array($st, array(1, 2)))
        {
            $st = 0;
        }

        require_once('libs/twitteroauth/twitteroauth.php');
        $con = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET); 

        $request_token = $con->getRequestToken(CONNECT_TWITTER_OAUTH_CALLBACK);
	    $this->mlObj['mSession']->set('oauth_token', $request_token['oauth_token']);
        $this->mlObj['mSession']->set('oauth_token_secret', $request_token['oauth_token_secret']);
        $this->mlObj['mSession']->set('regstatus', $st);
		
        if($con->http_code == 200)
        {
            $url = $con->getAuthenitcateURL($request_token['oauth_token'], true);
            $res['q'] = OK;
            $res['url'] = $url;
        }
        else
        {
            $res['err'] = COULD_NOT_CONNECT_TO_TWITTER_REFRESH_THE_PAGE_OR_TRY_AGAIN_LATER;
        }
        echo json_encode($res);
        exit();
    }
	
		
    public function ConnectTwitter()
    {	
        require_once('libs/twitteroauth/twitteroauth.php');
        $token = _v('oauth_token', '');
        $verifier = _v('oauth_verifier', '');
		$userId = $this->mlObj['mSession']->get('system_uid');
        
		$this->mSmarty->assign('confirm', 1);
		$fm = $this->mUser->mUserInfo;

        $this->mSmarty->assignByRef('fm', $fm);
					
        if ($token && $this->mlObj['mSession']->get('oauth_token') !== $token)
        {
	        //clean old tokens
        	$this->mlObj['mSession']->del('oauth_token');
	        $this->mlObj['mSession']->del('oauth_token_secret');

			$this->mSmarty->assign('twError', ACCOUNT_WAS_NOT_CONNECTED);
			if($this->mUser->mUserInfo['Status'] == USER_ARTIST)
			{
				$this->mSmarty->display('mods/profile/edit_artist/profile_data.html');
			}
			else
			{
				$this->mSmarty->display('mods/profile/edit_fan/profile_data.html');
			}
			exit();
        }
/*echo "<pre>";
print_r($this->mlObj['mSession']->get('system_uid'));		
echo "<hr>";
print_r($_SESSION);
echo "<hr>userId= ".$userId;
deb("exit");*/
        $con = new TwitterOAuth(TWITTER_CONSUMER_KEY,
                                TWITTER_CONSUMER_SECRET,
                                $this->mlObj['mSession']->get('oauth_token'),
                                $this->mlObj['mSession']->get('oauth_token_secret'));

        //get access tokens from twitter
        $access_token = $con->getAccessToken($verifier);

/*echo "access toke :<br>";		
print_r($access_token);
echo "<hr> con :";
print_r($con);
echo "<hr>";*/		
		//clean old tokens
        $this->mlObj['mSession']->del('oauth_token');
        $this->mlObj['mSession']->del('oauth_token_secret');
		
        if($con->http_code == 200)
        {            
			if(!empty($access_token['user_id']))
            {												
                $id = $access_token['user_id']; //twitter user id
                $cUserInfo = '';
				$cUserInfo = UserQuery::create()->select(array('Id'))
                        ->filterById($userId)
						//->filterByTwId('', Criteria::IN)
                        ->findOne();
				$eml = 0;
				$eml = UserQuery::create()->Select(array('Id'))->filterByTwId($access_token['user_id']);
				$eml = $eml->findOne();

                if ((!empty($cUserInfo)) && (empty($eml)))
                {			
        		    $this->mlObj['mSession']->set('access_token', $access_token);
					$this->mlObj['mSession']->set('twitter_id', $id);
					
                    //user found - authenticate
                    UserQuery::create()->select(array('Id'))->filterById($userId)->update(
                    array('TwId' => $id, 'TwOauthToken' => $access_token['oauth_token'],'TwOauthTokenSecret' => $access_token['oauth_token_secret']));

					$this->mSmarty->assign('twSuccess', YOU_ARE_CONNECTED_SUCCESSFULLY);
					if($this->mUser->mUserInfo['Status'] == USER_ARTIST)
					{
						$this->mSmarty->display('mods/profile/edit_artist/profile_data.html');
					}
					else
					{
						$this->mSmarty->display('mods/profile/edit_fan/profile_data.html');
					}
					exit();
					
				}
                else
                {
					$this->mSmarty->assign('twError', THAT_ACCOUNT_ALREADY_TAKEN);
					if($this->mUser->mUserInfo['Status'] == USER_ARTIST)
					{
						$this->mSmarty->display('mods/profile/edit_artist/profile_data.html');
					}
					else
					{
						$this->mSmarty->display('mods/profile/edit_fan/profile_data.html');
					}
					exit();
				}
            }
        }
       else
        {
			$this->mSmarty->assign('twError', COULD_NOT_FIND_YOUR_TWITTER_ACCOUNT);
			if($this->mUser->mUserInfo['Status'] == USER_ARTIST)
			{
				$this->mSmarty->display('mods/profile/edit_artist/profile_data.html');
			}
			else
			{
				$this->mSmarty->display('mods/profile/edit_fan/profile_data.html');
			}
			exit();
        }
	}
}	
?>
