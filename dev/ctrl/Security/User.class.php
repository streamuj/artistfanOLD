<?php
/**
 * Users controller
 * User: ssergy
 * Date: 09.12.11
 * Time: 15:07
 *
 */
class Security_User
{
    /**
     * Current user info
     * @var
     */
    public $mUserInfo;


    /**
     * Current user login
     * @var
     */
    public $mSystemLogin;

    /**
     * Current user facebook ID
     * @var
     */
    public $mFacebookId;

    /**
     * Current user twitter ID
     * @var
     */
    public $mTwitterId;

    /**
     * Logout after ... seconds, 0 - disabled
     * @var int
     */
    private $mLogoutAfter;


    /**
     * Last Auth result
     * @var
     */
    public $mLastAuthResult;


    /**
     * Crypt object
     * @var \Security_Rc4
     */
    public $mRc4;

    /**
     * Session object
     * @var
     */
    private $mSession;

    /**
     * Other user Id (&& flag)
     * @var int
     */
    public $mOtherUserId;

    /**
     * Other user information
     * @var array
     */
    public $mOtherUserInfo;
	
	public $mUserType;
	

    
    public function __construct( $mSession )
    {
        //Rc4
        include_once 'libs/Crypt/Rc4.class.php';
        $this -> mRc4 = new Security_Rc4();
        $this -> mRc4  -> setKey('119dsgeggfgfg!!d$$hhddXYZd');

        //session object
        $this->mSession = $mSession;

        //Logout after ... seconds, 0 - disabled
        $this->mLogoutAfter = 0;
    }


    /**
     * Check Auth method
     * @param $this->mSession
     * @return int
     */
    public function CheckAuth()
    {
        $user_fields = array('Id', 'Email', 'Status', 'Pass', 'FirstName', 'LastName', 'BandName', 'Name', 'Blocked', 'BlockReason',
                             'Avatar', 'Location', 'About', 'EmailConfirmed', 'Likes', 'Country', 'Zip', 'HideLoc',
                             'Gender', 'Dob', 'Wallet', 'WalletBlock', 'FbId', 'FbToken', 'FbStart', 'TwStart', 'TwId', 'TwOauthToken', 'TwOauthTokenSecret',
                             'RecordLabel', 'RecordLabelLink', 'Bio', 'Members', 'Website', 'Genres', 'YearsActive', 'IsAdmin', 'IsOnline', 'UserPhone');

        
		if (strlen(session_id()) <= 0
            || !$this->mSession->Get('system_uid')
            || (!$this->mSession->Get('system_login') && !$this->mSession->Get('facebook_id') && !$this->mSession->Get('twitter_id'))
            || !$this->mSession->Get('system_status')
        )
        {
            $this->mSession->Set('system_uid', 0);
            $this->mSession->Set('system_login', '');
            $this->mSession->Set('system_status', 0);
            $this->mSession->Set('twitter_id', '');
            $this->mSession->Set('facebook_id', '');
			
			

            $system_login = trim(strip_tags(_v('system_login', '')));
            $system_pass  = trim(strip_tags(_v('system_pass', '')));
            //$fb_access = $this->GetFbUserFromCookie();
            $tw_access = $this->mSession->Get('access_token');
            $fb_id  = $this->mSession->Get('fb_id');
            $this->mSession->Del('fb_id');

            if (($system_login && $system_pass) || $fb_id || $tw_access)
            {
                $row = UserQuery::create()->Select($user_fields);
                if($system_login && $system_pass)
                {
                    $row = $row->where('LOWER(Email) = "' . ToLower( $system_login ) . '" ');
                }
                else if($fb_id)
                {
                    $row = $row->filterByFbId($fb_id);
                }
                else if($tw_access)
                {
                    $row = $row->filterByTwId($tw_access['user_id'])->filterByTwOauthToken($tw_access['oauth_token']);
                }
                $row = $row->filterByStatus(1, '>=')->findOne();
                if (empty($row))
                {
                    $this->mLastAuthResult = 3;
                    return 3;
                }
				
				$this->mUserType=$row['Status'];
                if(empty($row['EmailConfirmed']))
                {
                    $this->mLastAuthResult = 5;
                    return 5;
                }

                $this->mRc4->crypt($system_pass);


                if ( ($system_pass != '' && bin2hex($system_pass) == $row['Pass']) || ($fb_id > 0 && $fb_id == $row['FbId']) || $tw_access)
                {
                    if($row['Blocked'] == 0)
                    {
                        $this->mSession->Set('system_uid', $row['Id']);
                        $this->mSession->Set('system_login', $system_login);
                        $this->mSession->Set('system_status', $row['Status']);
                        $this->mSession->Set('twitter_id', $row['TwId']);
                        $this->mSession->Set('facebook_id', $row['FbId']);

                        $this->mSystemLogin = $system_login;
                        $this->mFacebookId = $row['FbId'];
                        $this->mTwitterId = $row['TwId'];

                        //date of birthday
                        $dob = explode('-', $row['Dob']);
                        $row['dd'] = 1 * $dob[2];
                        $row['mm'] = 1 * $dob[1];
                        $row['yy'] = 1 * $dob[0];

   						$genres_list = User::GetGenresList();
						
						$genresListArr = explode(',',$row['Genres']);
									
						foreach($genresListArr as $key=> $val)
						{
		 					$userGenres .= $genres_list[$val].'/';
						}
						$row['GenresList'] = trim($userGenres, '/');	

						//Fellow count	
						$row['FollowersCount'] = UserFollow::GetFollowersUserListCount($row['Id'], USER_FAN);

						$this->mUserInfo = $row;
						
                        // update last login && last reload to current date
                        UserQuery::create()->Select(array('Id'))->filterById($row['Id'])->Update(array('LastLogin' => mktime(), 'LastReload' => mktime(), 'Ip' => real_ip(), 'IsOnline' => 1));

                        $this->mLastAuthResult = 1;
                        return 1;
                    }
                    else
                    {
                        $this->mLastAuthResult = !empty($row['BlockReason']) ? $row['BlockReason'] : 5;
                        return 6;
                    }
                }
                else
                {
                    $this->mLastAuthResult = 3;
                    return 3;
                }
            }
            else
            {
                $this->mLastAuthResult = 2;
			
                return 2;
            }
        }
        else
        {
			//deb($_REQUEST);
			
            $row = UserQuery::create()
                    ->Select($user_fields);
            if($this->mSession->Get('twitter_id'))
            {
                $row = $row->filterByTwId($this->mSession->Get('twitter_id'));
            }
            else if($this->mSession->Get('facebook_id'))
            {
                $row = $row->filterByFbId($this->mSession->Get('facebook_id'));
            }
            else
            {
                $row = $row->where('(LOWER(Email) = "' . ToLower( $this->mSession->Get('system_login') ) . '" OR LOWER(alt_email) LIKE "%\"'.ToLower( $this->mSession->Get('system_login') ) . '\"%")');
            }
             
            $row = $row->filterByStatus(1, '>=')->findOne();//->filterByEmailConfirmed(1)

            if (empty($row))
            {
                $this->mLastAuthResult = 3;
                return 3;
            }

            if ( ToLower($this->mSession->Get('system_login')) == ToLower($row['Email']) 
                    || ($this->mSession->Get('twitter_id') == $row['TwId']) || ($this->mSession->Get('facebook_id') == $row['FbId']) )
            {
                // if last reload time < N minutes - logout
                if ($this->mLogoutAfter && $row['LastReload'] && ($row['LastReload'] - (mktime() - $this->mLogoutAfter)) <= 0)
                {
                    // save redirect session
                    if (!empty($_SERVER['REQUEST_URI']))
                    {
                        $this->mSession->Set('nactive', 1);
                        $this->mSession->Set('redir', $_SERVER['REQUEST_URI']);
                    }
                    $this -> Logout();

                    $this->mLastAuthResult = 4;
                    return 4;
                }
                if($row['Blocked'] == 1)
                {
                    //user is blocked
                    $this -> Logout();
                    $this->mLastAuthResult = !empty($row['BlockReason']) ? $row['BlockReason'] : 5;
                    return 6;
                }
				
				$this->mUserType=$row['Status'];
                if(empty($row['EmailConfirmed']))
                {
                    $this->mLastAuthResult = 5;
                    return 5;
                }

                //date of birthday
                $dob = explode('-', $row['Dob']);
                $row['dd'] = 1*$dob[2];
                $row['mm'] = 1*$dob[1];
                $row['yy'] = 1*$dob[0];

   				$genres_list = User::GetGenresList();
						
				$genresListArr = explode(',',$row['Genres']);
								
				foreach($genresListArr as $key=> $val)
				{
					$userGenres .= $genres_list[$val].'/';
				}
				$row['GenresList'] = trim($userGenres, '/');

				//Fellow count
				$row['FollowersCount'] = UserFollow::GetFollowersUserListCount($row['Id'], USER_FAN);

				
				if($row['Status'] == USER_FAN)
				{
					$wallcount	=	Notification::ShowNotification_Wall($row['Id']);
					$commentcount	=	Notification::ShowNotification_Comment($row['Id']);
					$row['notificationCount'] = count($wallcount) + count($commentcount);										
				}
				else
				{
					$wallcount	=	Notification::ShowNotification_Wall($row['Id']);
					$commentcount	=	Notification::ShowNotification_Comment($row['Id']);
					$row['notificationCount'] = count($wallcount) + count($commentcount);										
				}
				

												
				$this->mUserInfo = $row;
				
                $this->mSystemLogin = $this->mSession->Get('system_login');
                $this->mFacebookId = $this->mSession->Get('facebook_id');
                $this->mTwitterId = $this->mSession->Get('twitter_id');


                // update last login && last reload to current date
                UserQuery::create()->Select(array('Id'))->filterById($row['Id'])->update(array('LastLogin' => mktime(), 'LastReload' => mktime(), 'Ip' => real_ip(), 'IsOnline' => 1));

                $this->mLastAuthResult = 0;
                return 0;
            }
            else
            {
                $this->mSession->Del('system_login');
                $this->mSession->Del('facebook_id');
                $this->mSession->Del('twitter_id');

                $this->mLastAuthResult = 2;
                return 2;
            }
        }
    }


    /**
     * Logout method
     * @return void
     */
    public function Logout()
    {
		UserQuery::create()->Select(array('Id'))->filterById($this->mSession->get('system_uid'))->Update(array('IsOnline' => 0));
		
        $this->mSession->Del('system_uid');
        $this->mSession->Del('system_login');
        $this->mSession->Del('system_status');
        $this->mSession->Del('facebook_id');
        $this->mSession->Del('twitter_id');

        $this->mSession->Del('fb_id');
        $this->mSession->Del('access_token');

        //$this->mSession->Del('error');
        //$this->mSession->Del('notice');
        //$this->mSession->Del('redirect');
    }


    /**
     * Return current auth status
     * @return bool
     */
    public function IsAuth()
    {
        if ($this->mSystemLogin || $this->mFacebookId || $this->mTwitterId)
        {
            return true;
        }
        else
        {
            return false;
        }
    }


    /**
     * Init other user profile
     */ 
    public function InitOtherUser()
    {
        $login = trim( strip_tags( _v('login', '') ) );
        //if link has login
        if ($login)
        {
            if ($this->IsAuth() && $login==$this->mUserInfo['Name'])
            {
                //show current user profile
                $this->mOtherUserId = 0;
                return false;    
            }
            else
            {
                $this->mOtherUserInfo = UserQuery::create()
                    ->Select(array('Id', 'Email', 'Status', 'Pass', 'LastReload', 'FirstName', 'LastName', 'Name', 'Blocked', 'BlockReason', 'Country',
                                   'Avatar', 'Location', 'HideLoc', 'About', 'BandName', 'Likes', 'Dob', 'Gender', 'YearsActive', 'Genres', 'Members', 'Website', 'Bio', 'RecordLabel', 'RecordLabelLink', 'UserPhone'))
                    ->where('LOWER(Name) = "' . ToLower( $login ) . '"')
                    ->filterByStatus(1, '>=')->findOne();

                if (!empty($this->mOtherUserInfo))    
                {
                    $this->mOtherUserId = $this->mOtherUserInfo['Id'];

					$genres_list = User::GetGenresList();
					
					$genresListArr = explode(',',$this->mOtherUserInfo['Genres']);
									
					foreach($genresListArr as $key=> $val)
					{
						$userGenres .= $genres_list[$val].'/';
					}
					$this->mOtherUserInfo['GenresList'] = trim($userGenres, '/');	

				//Fellow count
				$this->mOtherUserInfo['FollowersCount'] = UserFollow::GetFollowersUserListCount($this->mOtherUserInfo['Id'], USER_FAN);

										
                }
                return true;
            }
        }
    }
	

    /**
     * Check if exists valid facebook cookie and return FbId from cookie
     * @return array
     */
    public function GetFbUserFromCookie()
    {
        $res = array();
        if ($this->mSession->GetCookie( 'fbsr_' . FACEBOOK_API_ID ))
        {
            //validate facebook cookie
            $signed_request = $this->mSession->GetCookie( 'fbsr_' . FACEBOOK_API_ID );
            list($encoded_sig, $payload) = explode('.', $signed_request, 2);
            $sig = base64_decode(strtr($encoded_sig, '-_', '+/'));
            $expected_sig = hash_hmac('sha256', $payload, FACEBOOK_API_SECRET, $raw = true);

            if ($sig == $expected_sig)
            {
                $data = json_decode(base64_decode($payload), true);
                if (array_key_exists('user_id', $data)) 
                {
                    $res['user_id'] = $data['user_id'];
                }
                if (array_key_exists('oauth_token', $data))
                {
                    $res['access_token'] = $data['oauth_token'];
                }
                if (array_key_exists('code', $data))
                {
                    $res['code'] = $data['code'];
                }
                if (array_key_exists('state', $data))
                {
                    $res['state'] = $data['state'];
                }
            }
        }
        return $res;
    }

    /**
     * Check if user is admin
     * @return void
     */
    public function CheckAdminStatus()
    {
        if (!$this->IsAuth() || $this->mUserInfo['IsAdmin'] != 1)
        {
            return false;
        }
        else
        {
            return true;
        }
    }


}
