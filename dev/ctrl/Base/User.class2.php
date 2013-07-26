<?php

/**
 * Users controller -for Auth, Registration and Forgot
 * User: ssergy
 * Date: 12.12.11
 * Time: 18:38
 *
 */

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
        if ($this->mUser->IsAuth())
        {
            $redirect = $this->GetRedirectUrl();
            if($redirect)
            {
                uni_redirect(PATH_ROOT . $redirect);
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
            $this->mSmarty->assign('loginerr_text', (is_string($this->mUser->mLastAuthResult)) ? 'Your account was blocked. Reason: ' . $this->mUser->mLastAuthResult : ($this->mUser->mLastAuthResult == 5 ? 'This email address has not been confirmed yet. We can <a href="/base/user/resendemail">resend</a> a confirmation email to you.' : 'The email/password you entered is incorrect. Please try again.'));
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
                $err = 'Please specify correct email';
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
                    $err = 'No users found with that not confirmed email';
                }
                else
                {
                    $this->mSmarty->assign('checksum', $ui['Checksum']);
                    $this->mSmarty->assign('name', $ui['Name']);
                    $this->mSmarty->assign('email', $ui['Email']);
                    $this->mSmarty->assign('SITE_NAME', SITE_NAME);
                    $this->mSmarty->assign('DOMAIN', DOMAIN);

                    include 'libs/Phpmailer_v5.1/class.phpmailer.php';
                    $gMail = new PHPMailer();
                    $gMail->SetFrom('do-not-reply@' . DOMAIN, SITE_NAME);
                    $gMail->AddAddress($ui['Email'], $ui['Name']);
                    $gMail->WordWrap = 50;
                    $gMail->IsHTML(true);

                    $gMail->Subject = 'Registration ' . SITE_NAME;
                    $gMail->Body = $this->mSmarty->fetch('mails/mail_confirm.html');

                    $gMail->Send();
                    echo json_encode(array('q' => 'ok'));
                }
            }
            if(!empty($err))
            {
                echo json_encode(array('q' => 'err', 'err' => $err));
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
                $errs['status'] = 'Please select your role!';
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
        if ($this->mUser->IsAuth() && ((!$this->mUser->mUserInfo['FbId']  || $this->mUser->mUserInfo['FbStart']) && (!$this->mUser->mUserInfo['TwId'] || $this->mUser->mUserInfo['TwStart'])))
        {
            uni_redirect( PATH_ROOT . 'u/'.$this->mUser->mUserInfo['Name'] );
        }

        //fb/tw auth status
        define('FB_AUTH',  ($this->mUser->IsAuth() && ($this->mUser->mUserInfo['FbId'] && !$this->mUser->mUserInfo['FbStart'] || $this->mUser->mUserInfo['TwId'] && !$this->mUser->mUserInfo['TwStart'] )) ? 1 : 0);

        $this->mlObj['mSession']->Del('regstatus');
        //user status
        $status = _v('status', 0);
        if ( !in_array($status, array(1, 2)) )
        {
            uni_redirect( PATH_ROOT . 'reg/select/' );
        }
        $this->mSmarty->assign('status', $status);

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


        //genres list
        $genres_list = User::GetGenresList();

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



            if (empty($fm['email']) || !verify_email($fm['email']))
            {
                $errs['email'] = 'Please specify correct email';
            }
            else
            {
                $eml = UserQuery::create()->Select(array('Id'))
                        ->where('LOWER(user.email)="' . mysql_escape_string(ToLower($fm['email'])) . '"');
                if($this->mUser->IsAuth())
                {
                    $eml = $eml->filterById($this->mUser->mUserInfo['Id'], Criteria::NOT_EQUAL);
                }
                $eml = $eml->findOne();
                if (!empty($eml))
                {
                    $errs['email'] = 'User with that email already exist';
                }
            }

            if (!FB_AUTH)
            {
                if (empty($fm['pass']))
                {
                    $errs['pass'] = 'Please specify password';
                }
                elseif (strlen($fm['pass']) < 6)
                {
                    $errs['pass'] = 'Min password length - 6 symbols';
                    $fm['pass'] = '';
                    $fm['pass2'] = '';
                }
                elseif (empty($fm['pass2']) || strlen($fm['pass2']) < 6)
                {
                    $errs['pass2'] = 'Please repeat password';
                    $fm['pass'] = '';
                    $fm['pass2'] = '';
                }
                elseif ($fm['pass2'] != $fm['pass'])
                {
                    $errs['pass'] = 'Passwords do not match';
                    $fm['pass'] = '';
                    $fm['pass2'] = '';
                }
            }


            if (empty($fm['first_name']))
            {
                $errs['first_name'] = 'Please specify first name';
            }

            if (empty($fm['last_name']))
            {
                $errs['last_name'] = 'Please specify last name';
            }

            if (!empty($fm['first_name']) && strlen($fm['first_name']) > 26)
            {
                $errs['first_name'] = 'Max first name length - 26 symbols';
            }

            if (!empty($fm['last_name']) && strlen($fm['last_name']) > 26)
            {
                $errs['last_name'] = 'Max last name length - 26 symbols';
            }

            if (empty($fm['name']))
            {
                $errs['name'] = 'Please specify username';
            }
            else
            {
                $regName = '/^([a-zA-Z0-9_\-])+$/';
                $matches = array();
                if (!preg_match($regName, $fm['name'], $matches))
                {
                    $errs['name'] = 'Username can be John Public or User1234.';
                }
                elseif (strlen($fm['name']) > 40)
                {
                    $errs['name'] = 'Max username length - 40 symbols';
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
                        $errs['name'] = 'User with that username already exists';
                    }
                }
            }


            if (USER_ARTIST==$status)
            {
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
                    $errs['genres'] = 'You must select genres';
                }
                elseif (MAX_GENRES_COUNT < count($genres))
                {
                    $errs['genres'] = 'You can choose to not more than 2 genres';
                }

            }

            if (empty($errs))
            {
                if (!FB_AUTH)
                {
                    $mUser = new User();
                }
                else
                {
                    $mUser = UserQuery::create()->findPk( $this->mUser->mUserInfo['Id'] );
                }
                //dob
                $month = (isset($fm['mm']) && isset($dd[$fm['mm']])) ? $fm['mm'] : 0;
                $day = (isset($fm['dd']) && isset($dd[$fm['dd']])) ? $fm['dd'] : 0;
                $year = (isset($fm['yy']) && isset($yy[$fm['yy']])) ? $fm['yy'] : 0;
                $dob = $year . '-' . ($month < 10 ? '0' . $month : $month) . '-' . ($day < 10 ? '0' . $day : $day);

                $mUser->setEmail($fm['email']);
                $mUser->setFirstName($fm['first_name']);
                $mUser->setLastName($fm['last_name']);
                $mUser->setName($fm['name']);

                $mUser->setStatus($status);//1 - fan, 2 - artist
                $mUser->setDob($dob);
                $mUser->setGender((!empty($fm['gender']) && in_array($fm['gender'], array(1, 2))) ? $fm['gender'] : 0);

                //password && checksum
                if (!FB_AUTH)
                {
                    //if not facebook or twitter registration
                    $orig_pass = $fm['pass'];
                    $this->mUser->mRc4->crypt($fm['pass']);
                    $fm['pass'] = bin2hex($fm['pass']);
                    $mUser->setPass($fm['pass']);
                    $mUser->setRegDate(mktime());
                }
                if(!FB_AUTH || ($this->mUser->IsAuth() && $this->mUser->mUserInfo['Email'] != $fm['email']))
                {
                    //if not facebook or twitter registration or email was changed
                    $checksum = substr(md5(mktime() . rand(11, 99)), 0, 10);
                    $mUser->setChecksum($checksum);
                    $mUser->setEmailConfirmed(0);
                }
                if(FB_AUTH)
                {
                    if($this->mUser->mUserInfo['FbId'] && !$this->mUser->mUserInfo['FbStart'])
                    {
                        $mUser->setFbStart(1);
                    }
                    else if($this->mUser->mUserInfo['TwId'] && !$this->mUser->mUserInfo['TwStart'])
                    {
                        $mUser->setTwStart(1);
                    }
                }

                //additional fields for fan
                if (USER_FAN==$status)
                {
                    $mUser->setLocation( Valid::String($fm, 'city') );
                    $mUser->setCountry( Valid::String($fm, 'country') );
                    $mUser->setZip( Valid::String($fm, 'zip') );
                    $mUser->setHideLoc( !empty($fm['hide_loc']) ? 1 : 0 );
                }
                //additional fields for artist
                elseif (USER_ARTIST==$status)
                {

                    if (!empty($fm['record_label']))
                    {
                        foreach ($fm['record_label'] as &$v)
                        {
                            $v = trim(strip_tags($v));
                        }
                        unset($v);
                    }

                    if (!empty($fm['record_label_link']))
                    {
                        foreach ($fm['record_label_link'] as &$v)
                        {
                            $v = trim(strip_tags($v));
                        }
                        unset($v);
                    }

                    $record_label       = !empty($fm['record_label']) ? serialize($fm['record_label']) : '';
                    $record_label_link  = !empty($fm['record_label_link']) ? serialize($fm['record_label_link']) : '';


                    $mUser->setBandName( Valid::String($fm, 'band_name') );
                    $mUser->setYearsActive( Valid::String($fm, 'years_active') );
                    $mUser->setGenres( implode(',',$genres) );
                    $mUser->setMembers( Valid::String($fm, 'members') );
                    $mUser->setWebsite( str_replace('http://', '', check_valid_url(Valid::String($fm, 'website'))) );
                    $mUser->setBio( Valid::String($fm, 'bio') );
                    $mUser->setRecordLabel( $record_label );
                    $mUser->setRecordLabelLink( $record_label_link );
                    $mUser->setLocation( Valid::String($fm, 'location') );
                }



                $mUser->save();

                //send email if not twitter/facebook registration or email was changed
				
                if (!FB_AUTH || ($this->mUser->IsAuth() && $this->mUser->mUserInfo['Email'] != $fm['email']))
                {
                    $this->mSmarty->assign('checksum', $checksum);
                    $this->mSmarty->assign('name', $fm['name']);
                    $this->mSmarty->assign('email', $fm['email']);
                    $this->mSmarty->assign('SITE_NAME', SITE_NAME);
                    $this->mSmarty->assign('DOMAIN', DOMAIN);

                    include 'libs/Phpmailer_v5.1/class.phpmailer.php';
                    $gMail = new PHPMailer();
                    $gMail->SetFrom('do-not-reply@' . DOMAIN, SITE_NAME);
                    $gMail->AddAddress($fm['email'], $fm['name']);
                    $gMail->WordWrap = 50;
                    $gMail->IsHTML(true);

                    $gMail->Subject = 'Registration ' . SITE_NAME;
                    $gMail->Body = $this->mSmarty->fetch('mails/mail_confirm.html');

                    if (!$gMail->Send())
                    {
                        $errs[] = $gMail->ErrorInfo;
                    }

                    if($this->mUser->IsAuth())
                    {
                        $this->mUser->Logout();
                    }
                    uni_redirect(PATH_ROOT . 'reg/confirm/');
                }
                else
                {
                    //go to profile
                    //$this->mSession->Del('fb_id');
                    uni_redirect(PATH_ROOT);
                }

            }
            else
            {
                $this->mSmarty->assignByRef('errs', $errs);
                $this->mSmarty->assignByRef('fm', $fm);
                //deb($fm);
                //echo json_encode(array('q' => 'err', 'errs' => $errs));
            }
        }
        elseif ( FB_AUTH )
        {
            //for facebook and twitter users - init registration
            $fm = array(
                       'email' => $this->mUser->mUserInfo['Email'],
                       'name' => $this->mUser->mUserInfo['Name'],
                       'first_name' => $this->mUser->mUserInfo['FirstName'],
                       'last_name' => $this->mUser->mUserInfo['LastName']
                       );
            $this->mSmarty->assignByRef('fm', $fm);
        }

        if (1==$status)
        {
            //geo for fan
            include_once 'libs/Geografy/Main.class.php';
            $this->mSmarty->assign('GeoIp', Model_Geografy_Main::GeoIPInit());

            $this->mSmarty->assignByRef('countries', Countries::GetCountries($this->mCache));

        }
        if (2==$status)
        {
            $this->mSmarty->assignByRef('genres', $genres_list);
        }
        $this->mSmarty->assign('FB_AUTH', FB_AUTH);

        $this->mSmarty->display('mods/user/registration.html');
    }


    /**
     * Registration confirm page - show confirmation text
     * @return void
     */
    public function RegistrationConfirm()
    {
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

        $res = array('q' => 'ok', 'err' => '');
        switch($what)
        {
            case 'email':
                if (empty($field) || !verify_email($field))
                {
                    $res['err'] = 'This isn\'t a valid address';
                }
                else
                {
                    $eml = UserQuery::create()->Select(array('Id'))
                            ->where('LOWER(user.email)="' . mysql_escape_string(ToLower($field)) . '"');
                    if($id)
                    {
                        $eml -> filterById($id, Criteria::NOT_EQUAL);
                    }
                    $eml = $eml -> findOne();
                    if (!empty($eml))
                    {
                        $res['err'] = 'Address already registered';
                    }
                }
                break;
            case 'name':
                if(strlen($field) > 40)
                {
                    $res['err'] = 'The Username is too long';
                }
                else
                {
                    $regName = '/^([a-zA-Z0-9_\-])+$/';
                    $matches = array();
                    if (!preg_match($regName, $field, $matches))
                    {
                        $res['err'] = 'Username can be JohnPublic or User1234.';
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
                            $res['err'] = 'That Username is already taken';
                        }
                    }
                }
                break;
        }
        if(!empty($res['err']))
        {
            $res['q'] = 'err';
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
            $res = array('q' => 'err');
            $email = !empty($_REQUEST['email']) && verify_email($_REQUEST['email']) ? $_REQUEST['email'] : '';

            if (empty($email))
            {
                $err = 'Please specify correct email';
            }

            if(empty($err))
            {
                $ui = UserQuery::create()
                                -> select(array('Id', 'Email', 'Pass', 'Checksum', 'Name', 'FbStart', 'TwStart'))
                                -> filterByEmail($email)
                                -> findOne();
                if (empty($ui))
                {
                    $err = 'No users found with specified email';
                }
                else if($ui['FbStart'] == 1)
                {
                    $err = 'You signed up with Facebook. Use "Connect with Facebook" button to sign in.';
                }
                else if($ui['TwStart'] == 1)
                {
                    $err = 'You signed up with Twitter. Use "Sign in with Twitter" button to sign in.';
                }
                else
                {
                    $checksum = md5(mktime().rand(11, 99));
                    UserQuery::create() -> select(array('Id')) -> filterById($ui['Id']) -> update(array('Checksum' => $checksum));

                    $this -> mSmarty -> assign('checksum', $checksum);
                    $this -> mSmarty -> assignByRef('name', $ui['Name']);
                    $this -> mSmarty -> assign('DOMAIN', DOMAIN);

                    include 'libs/Phpmailer_v5.1/class.phpmailer.php';
                    $gMail = new PHPMailer();
                    $gMail->From = 'do-not-reply@' . DOMAIN;
                    $gMail->FromName = SITE_NAME;
                    $gMail->AddAddress($ui['Email'], $ui['Name']);
                    $gMail->WordWrap = 50;
                    $gMail->IsHTML(true);

                    $gMail->Subject = 'Restore password ' . SITE_NAME;
                    $gMail->Body = $this->mSmarty->fetch('mails/pass_restore.html');

                    if (!$gMail->Send())
                    {
                        $err = $gMail->ErrorInfo;
                    }
                    else
                    {
                        $res['q'] = 'ok';
                    }
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
                    $res = array('q' => 'err');
                    $fm = $_POST['fm'];

                    if (empty($fm['pass']))
                    {
                        $errs['pass'] = 'Please specify password';
                    }
                    elseif (strlen($fm['pass']) < 6)
                    {
                        $errs['pass'] = 'Min password length - 6 symbols';
                    }
                    elseif (empty($fm['pass2']) || strlen($fm['pass2']) < 6)
                    {
                        $errs['pass2'] = 'Please repeat password';
                    }
                    elseif ($fm['pass2'] != $fm['pass'])
                    {
                        $errs['pass'] = 'Passwords do not match';
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

                        $res['q'] = 'ok';
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
                $errs['email'] = 'Please specify correct email';
            }
            else
            {
                $eml = UserQuery::create()->Select(array('Id'))
                        ->where( 'LOWER(user.email)="' . mysql_escape_string(ToLower($fm['email'])) . '" AND user.Id <> '.$this->mUser->mUserInfo['Id'] )
                        ->findOne();

                if (!empty($eml))
                {
                    $errs['email'] = 'User with that email already exist';
                }
            }

            if (!empty($fm['pass']) && strlen($fm['pass']) < 6)
            {
                $errs['pass'] = 'Min password length - 6 symbols';
            }

            if (!empty($fm['first_name']) && strlen($fm['first_name']) > 26)
            {
                $errs['first_name'] = 'Max first name length - 26 symbols';
            }

            if (!empty($fm['last_name']) && strlen($fm['last_name']) > 26)
            {
                $errs['last_name'] = 'Max last name length - 26 symbols';
            }

            if (empty($fm['name']))
            {
                $errs['name'] = 'Please specify Display name';
            }
            else
            {
                $regName = '/^([a-zA-Z0-9_\-])+$/';
                $matches = array();
                if (!preg_match($regName, $fm['name'], $matches))
                {
                    $errs['name'] = 'Display name can be John Public or User1234.';
                }
                elseif (strlen($fm['name']) > 40)
                {
                    $errs['name'] = 'Max display name length - 40 symbols';
                }
                else
                {
                    $usr = UserQuery::create()->Select(array('Id'))
                            ->where('LOWER(user.name)="' . mysql_escape_string(ToLower($fm['name'])) . '" AND user.Id <> '.$this->mUser->mUserInfo['Id'] )
                            ->findOne();

                    if (!empty($usr))
                    {
                        $errs['name'] = 'User with that display name already exists';
                    }
                }
            }


            if (empty($errs))
            {
                $avatar = $this->UploadAvatar();
                if (is_array($avatar))
                {
                    //errors
                    echo json_encode(array('q' => 'err', 'errs' => $avatar));
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
                $mUser->setLocation(!empty($fm['location']) ? strip_tags($fm['location']) : '');
                $mUser->setAbout(!empty($fm['about']) ? strip_tags($fm['about']) : '');

                //save
                $mUser->save();

                echo json_encode(array('q' => 'ok'));
            }
            else
            {
                echo json_encode(array('q' => 'err', 'errs' => $errs));
            }

            exit();
        }

        $this->mSmarty->display('mods/user/edit.html');
    }


    /**
     * Upload current user avatar (ajax)
     * @param int $id
     * @param string $field
     * @return void
     */
    private function UploadAvatar($id, $field)
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
                $errs[$field] = 'Error file type. Only JPG, PNG, GIF allowed';
                return $errs;
            }

            //check type
            $fs = @getimagesize($_FILES[$field]['tmp_name']);
            if (empty($fs))
            {
                $errs[$field] = 'Error file type. Only JPG, PNG, GIF allowed';
                return $errs;
            }

            //check size
            if(ceil(filesize($_FILES[$field]['tmp_name'])/1000) > 500)
            {
                $errs[$field] = 'Your picture is too large. Max picture size is 500 Kb';
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
        $res = array('q' => 'err', 'redirect' => '');

        if (!$this->mUser->IsAuth() && $this->mSession->GetCookie( 'fbsr_' . FACEBOOK_API_ID ))
        {
            //user is auth in facebook and not auth in our site

            //validate facebook cookie
            $signed_request = $this->mSession->GetCookie( 'fbsr_' . FACEBOOK_API_ID );
            list($encoded_sig, $payload) = explode('.', $signed_request, 2);
            $sig = base64_decode(strtr($encoded_sig, '-_', '+/'));
            $expected_sig = hash_hmac('sha256', $payload, FACEBOOK_API_SECRET, $raw = true);

            if ($sig == $expected_sig)
            {
                $id = _v('id', 0); //FB id
                $email = _v('email', '');
                if ($id)
                {
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
                            $res['q'] = 'ok';
                            $res['id'] = $ui['Id'];
                            $res['isfirst'] = !$this->mUser->mUserInfo['FbStart'] ? 1 : 0;
                            if(!$res['isfirst'])
                            {
                                $res['redirect'] = $this->GetRedirectUrl();
                            }
                        }
                        else
                        {
                            $res['err'] = ($r == 5 ? 'Account email is not comfirmed' : 'Could not find your account.');
                        }
                    }
                    else
                    {
                        //create account
                        $name = strip_tags(_v('name', ''));
                        //translit and replace not allowed symbols
                        //$name = genNameFromFB($name);
                        //if (strlen($name) > 17)
                        //{
                        //    $name = substr($name, 0, 17);
                        //}

                        //check uniqueness
                        /*$k = 1;
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
                        }*/

                        $first_name = strip_tags(_v('fname', ''));
                        $last_name = strip_tags(_v('lname', ''));

                        $mUser = new User();
                        $mUser->setEmail($email);
                        $mUser->setFirstName($first_name);
                        $mUser->setLastName($last_name);
                        //$mUser->setName($name);
                        $mUser->setFbStart(0);
                        $mUser->setPass('');
                        $mUser->setStatus(1);
                        $mUser->setRegDate(mktime());
                        $mUser->setEmailConfirmed(1);

                        $mUser->setFbId($id);

                        require_once 'libs/facebook-php-sdk/src/facebook.php';
                        $facebook = new Facebook(array('appId'  => FACEBOOK_API_ID, 'secret' => FACEBOOK_API_SECRET));

                        //existing token
                        $token = $facebook->getAccessToken();
                        //get extending access_token expiration time
                        $ext_token = $facebook->getExtendedAccessToken($token);
                        $mUser->setFbToken($ext_token);

                        $mUser->save();
                        $uid = $mUser->getId();

                        $this->mlObj['mSession']->set('fb_id', $id);
                        $this->mUser->CheckAuth();

                        $res['q'] = 'ok';
                        $res['id'] = $uid;
                        $res['isfirst'] = 1; //first auth with facebook
                    }
                }
            }
        }

        echo json_encode($res);
        exit();
    }

    /**
     * get twitter authorize url
     * @return void
     */
    public function TwtGetAuthUrl()
    {
        $res = array('q' => 'err');

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
            $url = $con->getAuthorizeURL($request_token['oauth_token']);
            $res['q'] = 'ok';
            $res['url'] = $url;
        }
        else
        {
            $res['err'] = 'Could not connect to Twitter. Refresh the page or try again later.';
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
            uni_redirect(PATH_ROOT.'reg/select/');
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
                $ui = UserQuery::create()
                        ->select(array('Id', 'Pass', 'Email'))
                        ->filterByTwId($id)
                        ->findOne();
                if (!empty($ui))
                {
                    //user found - authenticate
                    UserQuery::create()->select(array('Id'))->filterById($ui['Id'])->update(
                            array(
                                'TwOauthToken' => $access_token['oauth_token'],
                                'TwOauthTokenSecret' => $access_token['oauth_token_secret']
                            )
                    );

                    $r = $this->mUser->CheckAuth();
                    if($r == 1)
                    {
                        //check if need to complete some actions
                        $redirect = $this->GetRedirectUrl();
                        if($redirect)
                        {
                            uni_redirect(PATH_ROOT . $redirect);
                        }
                        uni_redirect(PATH_ROOT);
                    }
                    else
                    {
                        $this->mlObj['mSession']->set('error', $r == 5 ? 'Account email is not comfirmed' : 'Could not find your account.');
                        uni_redirect(PATH_ROOT . 'base/user/login');
                    }
                }
                else
                {
                    //user not found - create account
                    $email = '';
                    //get profile info from twitter
                    $profile_info = $con->get('users/show', array('user_id' => $id));
                    if(empty($profile_info))
                    {
                        $this->mlObj['mSession']->set('error', 'Could not find your Twitter account.');
                        uni_redirect(PATH_ROOT.'reg/select/');
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

                    $mUser = new User();
                    $mUser->setEmail($email);
                    $mUser->setFirstName($first_name);
                    $mUser->setLastName($last_name);
                    $mUser->setName($name);
                    $mUser->setTwStart(0);

                    //password && checksum
                    $orig_pass = '';
                    $pass = '';

                    $mUser->setPass($pass);
                    $mUser->setStatus($st ? $st : 1);
                    $mUser->setRegDate(mktime());
                    $mUser->setEmailConfirmed(1);

                    $mUser->setTwId($id);
                    $mUser->setTwOauthToken($access_token['oauth_token']);
                    $mUser->setTwOauthTokenSecret($access_token['oauth_token_secret']);
                    $mUser->save();

                    $uid = $mUser->getId();

                    $this->mUser->CheckAuth();
                    if(!$st)
                    {
                        uni_redirect(PATH_ROOT.'reg/select/');
                    }
                    else
                    {
                        uni_redirect(PATH_ROOT.'reg/?status='.$st);
                    }
                }
            }
            else
            {
                $this->mlObj['mSession']->set('error', 'Could not find your Twitter account.');
                uni_redirect(PATH_ROOT.'reg/select/');
            }
        }
        else
        {
            //redirect user to registration page with error text
            $this->mlObj['mSession']->set('error', 'Could not find your Twitter account.');
            uni_redirect(PATH_ROOT.'reg/select/');
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
                    $err = 'Your specified twitter account ID does not match account you logged in.';
                }
            }
            else
            {
                $err = 'Could not find your Twitter account.';
            }
        }
        else
        {
            $err = 'Could not find your Twitter account.';
        }
        if(!empty($err))
        {
            $this->mlObj['mSession']->set('error', 'Account was not connected. ' . $err);
        }
        uni_redirect(PATH_ROOT . ($this->mUser->mUserInfo['Status'] == 1 ? 'fan' : 'artist') . '/settings');
    }

    /**
     * get facebook authorize url for login redirect
     * @return void
     */
    public function FbGetAuthUrl()
    {
        $res = array('q' => 'err');

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
        $res['q'] = 'ok';
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
                    $this->mlObj['mSession']->set('error', 'You must sign in with your facebook account.');
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
                        $this->mlObj['mSession']->set('error', $r == 5 ? 'Account email is not comfirmed' : 'Could not find your account.');
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
                    $mUser->setFirstName($first_name);
                    $mUser->setLastName($last_name);
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
                        uni_redirect(PATH_ROOT.'reg/select/');
                    }
                    else
                    {
                        uni_redirect(PATH_ROOT.'reg/?status='.$st);
                    }
                }
            }
            else
            {
                $this->mlObj['mSession']->set('error', 'Could not find your Facebook account.');
                uni_redirect(PATH_ROOT.'reg/select/');
            }
        }
        uni_redirect(PATH_ROOT.'reg/select/');
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
                $err = 'You must sign in with your facebook account.';
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
                $err = 'Your specified Facebook account ID does not match account you logged in.';
            }
        }
        else
        {
            $err = 'Could not find your Facebook account.';
        }
        if(!empty($err))
        {
            $this->mlObj['mSession']->set('error', 'Account was not connected. ' . $err);
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
        $res = array('q' => 'ok');

        $page = _v('page', 1);
        $status = _v('status', 0);
        $pcnt = _v('pcnt', !empty($_SESSION['upcnt']) ? $_SESSION['upcnt'] : 10);
        $_SESSION['upcnt'] = $pcnt;
        
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
            uni_redirect(PATH_ROOT . 'base/user/indexadmin');
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
                    $errs['Email'] = 'Please specify email';
                }
                elseif (!verify_email($fm['Email']))
                {
                    $errs['Email'] = 'Please specify correct email';
                }
                else
                {
                    $eml = UserQuery::create()->Select(array('Id'))
                            ->where('LOWER(user.email)="' . mysql_escape_string(ToLower($fm['Email'])) . '"')
                            ->filterById($id, Criteria::NOT_EQUAL)
                            ->findOne();
                    if (!empty($eml))
                    {
                        $errs['Email'] = 'User with that email already exist';
                    }
                }
            }

            if (!empty($fm['Pass']))
            {
                if (strlen($fm['Pass']) < 6)
                {
                    $errs['Pass'] = 'Min password length - 6 symbols';
                    $fm['Pass'] = '';
                }
            }
            else
            {
                unset($fm['Pass']);
            }

            if (empty($fm['FirstName']))
            {
                $errs['FirstName'] = 'Please specify first name';
            }
            if (empty($fm['LastName']))
            {
                $errs['LastName'] = 'Please specify last name';
            }
            if (!empty($fm['FirstName']) && strlen($fm['FirstName']) > 26)
            {
                $errs['FirstName'] = 'Max first name length - 26 symbols';
            }
            if (!empty($fm['LastName']) && strlen($fm['LastName']) > 26)
            {
                $errs['LastName'] = 'Max last name length - 26 symbols';
            }
            if (empty($fm['Name']))
            {
                $errs['Name'] = 'Please specify username';
            }
            else
            {
                $regName = '/^([a-zA-Z0-9_\-])+$/';
                $matches = array();
                if (!preg_match($regName, $fm['Name'], $matches))
                {
                    $errs['Name'] = 'Username can be John Public or User1234.';
                }
                elseif (strlen($fm['Name']) > 40)
                {
                    $errs['Name'] = 'Max username length - 40 symbols';
                }
                else
                {
                    $usr = UserQuery::create()->Select(array('Id'))
                            ->where('LOWER(user.name)="' . mysql_escape_string(ToLower($fm['Name'])) . '"')
                            ->filterById($id, '<>')
                            ->findOne();

                    if (!empty($usr))
                    {
                        $errs['Name'] = 'User with that username already exists';
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
                    $errs['Genres'] = 'You must select genres';
                }
                elseif (MAX_GENRES_COUNT < count($genres))
                {
                    $errs['Genres'] = 'You can choose to not more than 2 genres';
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
                        echo json_encode(array('q' => 'err', 'errs' => $avatar));
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
                        'Featured' => !empty($fm['Featured']) ? 1: 0
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
                    include 'libs/Phpmailer_v5.1/class.phpmailer.php';
                    $gMail = new PHPMailer();

                    $gMail->SetFrom('do-not-reply@' . DOMAIN, SITE_NAME);

                    $gMail->AddAddress($ui['Email'], $ui['FirstName'] . ' ' . $ui['LastName']);
                    if (!empty($up['Email']))
                    {
                        $gMail->AddAddress($up['Email'], $ui['FirstName'] . ' ' . $ui['LastName']);
                    }
                    $gMail->WordWrap = 50;
                    $gMail->IsHTML(true);

                    $gMail->Subject = 'Changed profile data on site ' . SITE_NAME;
                    $gMail->Body = $this->mSmarty->fetch('mails/_change_profile.html');
                    $gMail->Send();
                }
                echo json_encode(array('q' => 'ok'));
            }
            else
            {
                echo json_encode(array('q' => 'err', 'errs' => $errs));
                
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
}
?>