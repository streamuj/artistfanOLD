<?php
/**
 * Base Artist profile class
 * User: ssergy
 * Date: 08.02.12
 * Time: 17:46
 * 
 */
 
class Base_Artist extends Base
{
    public function __construct($glObj)
    {
        parent :: __construct($glObj);

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
        $this->mSmarty->assign('module', 'profile');

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

        //genres list
        $genres_list = User::GetGenresList();
        $this->mSmarty->assignByRef('genres', $genres_list);

        //countries
        $countries = Countries::GetCountries($this->mCache);
        $this->mSmarty->assignByRef('countries', $countries);

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
                            ->filterById($this->mUser->mUserInfo['Id'], '<>')
                            ->findOne();

                    if (!empty($usr))
                    {
                        $errs['Name'] = 'User with that username already exists';
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
                $errs['Genres'] = 'You must select genres';
            }
            elseif (MAX_GENRES_COUNT < count($genres))
            {
                $errs['Genres'] = 'You can choose to not more than 2 genres';
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
                    'Members' => Valid::String($fm, 'Members'),
                    'Website' => str_replace('http://', '', check_valid_url(Valid::String($fm, 'Website'))),
                    'Bio' => Valid::String($fm, 'Bio'),
                    'RecordLabel' => $record_label,
                    'RecordLabelLink' => $record_label_link,
                    'Location' => Valid::String($fm, 'Location')
                );

                if (!empty($fm['DeleteAvatar']))
                {
                    $up['Avatar'] = '';
                }


                UserQuery::create()->select(array('Id'))->filterById($this->mUser->mUserInfo['Id'])->update($up);

                uni_redirect(PATH_ROOT . 'artist/profile?confirm');

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

            //deb($this->mUser->mUserInfo);

            $this->mSmarty->assignByRef('fm', $this->mUser->mUserInfo);
        }

        $this->mSmarty->assign('confirm', isset($_REQUEST['confirm']) ? 1 : 0);
        $this->mSmarty->display('mods/profile/edit_artist/profile_data.html');
        exit();
    }


    public function UploadAvatar()
    {
        
        include_once 'model/FileUpload.class.php';
        $mFu = new FileUpload(array('jpg', 'jpeg', 'gif', 'png'));

        //upload to tmp directory
        $result = $mFu->handleUpload( 'files/images/tmp/');

        //crop to small size
        if (!empty($result['success']) && 1==$result['success'])
        {
            include_once 'libs/Crop/Image_Transform.php';
            include_once 'libs/Crop/Image_Transform_Driver_GD.php';

            $rand = rand(100, 9999);
            $crop_fname = 'files/images/avatars/m_user_'.$this->mUser->mUserInfo['Id'].$rand.'.jpg';
            i_crop_copy(223, 186, $mFu->GetSavedFile(),  BPATH .$crop_fname, 1);

            $crop_fname = 'files/images/avatars/s_user_'.$this->mUser->mUserInfo['Id'].$rand.'.jpg';
            i_crop_copy(144, 144, $mFu->GetSavedFile(),  BPATH .$crop_fname, 1);

            $crop_fnamex = 'files/images/avatars/x_user_'.$this->mUser->mUserInfo['Id'].$rand.'.jpg';
            i_crop_copy(48, 48, BPATH .$crop_fname, BPATH .$crop_fnamex, 1);


            $user_obj = UserQuery::create()->select(array('Id', 'Avatar'))
                        ->filterById($this->mUser->mUserInfo['Id'])->findOne();

            //delete old
            if ($user_obj['Avatar'])
            {
                if (file_exists(BPATH.'files/images/avatars/m_'.$user_obj['Avatar']))
                {
                    @unlink( BPATH.'files/images/avatars/s_'.$user_obj['Avatar'] );
                    @unlink( BPATH.'files/images/avatars/m_'.$user_obj['Avatar'] );
                    @unlink( BPATH.'files/images/avatars/x_'.$user_obj['Avatar'] );
                }
            }
            UserQuery::create()->select(array('Id', 'Avatar'))
                        ->filterById($this->mUser->mUserInfo['Id'])
                        ->update(array('Avatar' => 'user_'.$this->mUser->mUserInfo['Id'].$rand.'.jpg'));
            
            $result['image'] = $crop_fname.'?'.rand(1000, 9999999);
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
        $this->mSmarty->assign('module', 'events');

        if (!$id)
        {
            //show events list
            $page = _v('page', 1);
            $pcnt = 10;
            $df = _v('df', '');
            $df = !in_array($df, array('tw', 'nw', 'tm', 'nm')) ? '' : $df;
            $this->mSmarty->assignByRef('df', $df);

            $this->mSmarty->assign('event_added', _v('event_added', 0));

            $rcnt = Event::EventsCount( $this->mUser->mUserInfo['Id'], Event::GetPeriod($df) );
            $events = Event::EventsList( $this->mUser->mUserInfo['Id'], $page, $pcnt, Event::GetPeriod($df) );
            
            include_once 'model/Pagging.class.php';
            $link = PATH_ROOT . 'artist/events' . ($df ? '?df=' . $df : '');
            $mpg = new Pagging($pcnt, $rcnt, $page, $link);
            $pagging = $mpg->Make2($this->mSmarty, 0, 1);
            $this->mSmarty->assignByRef( 'pagging', $pagging );

            $this->mSmarty->assignByRef('events', $events);
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
            if($event['EventType'] != 1 && $event['Status'] == 4)
            {
                //get broadcast recordings list
                $video = EventVideo::GetListEventVideo($id);
                $this->mSmarty->assignByRef('recordings', $video);
            }

            $this->mSmarty->assignByRef('event', $event);
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
        for ($i=date("Y"); $i >=date("Y")-2; $i--)
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
        $this->mSmarty->assign('module', 'events');
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
            if(empty($event['Price']) && $event['EventType'] != 1)
            {
                $event['PriceFree'] = 1;
            }
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
                $errs['EventDate'] = 'Please speicfy event date';
            }
            elseif(-2==$event_date)
            {
                $errs['EventDate'] = 'Wrong event date';
            } 
            
            //event time
            $event_time = Valid::Time($fm, 'EventTime'); 
            if ($event_time==-1)
            {
                $errs['EventTime'] = 'Please speicfy event time';
            }
            elseif ($event_time==-2)
            {
                $errs['EventTime'] = 'Wrong event time';
            }

            $fm['Title'] = Valid::String($fm, 'Title');
            if (empty($fm['Title']))
            {
                $errs['Title'] = 'Please specify event title';
            }

           

            $fm['EventType'] = Valid::Integer($fm, 'EventType');
            if (!$fm['EventType'] || !in_array($fm['EventType'], array(1, 2, 3)))
            {
                $errs['EventType'] = 'Please select event type'; 
            }

            
            
            if (empty($errs))
            {
                if (!$id)
                {
                    //generate code
                    $code = $this->mUser->mUserInfo['Id'] . substr(md5(mktime() . rand(11, 99)), rand(0, 20), 10);
                    //Add event
                    $mEvent = new Event();
                    $mEvent->setUserId($this->mUser->mUserInfo['Id']);
                    $mEvent->setTitle($fm['Title']);
                    $mEvent->setDescr( Valid::String($fm, 'Descr') );
                    $mEvent->setEventType( $fm['EventType'] );
                    $mEvent->setPrice(($fm['EventType'] == 1 || !empty($fm['PriceFree']) || empty($fm['Price'])) ? 0 : $fm['Price']);
                    $mEvent->setLocation( ($fm['EventType'] == 3) ? 'online only' : Valid::String($fm, 'Location') );
                    $mEvent->setEventDate( $event_date.' '.$event_time );
                    $mEvent->setCode($code);
                    $mEvent->setPdate(mktime());
                    $mEvent->save();
                    $id = $mEvent->getId();
                    //clear artist events cache
                    $this->mCache->set('events_onwall' . $this->mUser->mUserInfo['Id'], '', 1);
                    uni_redirect( PATH_ROOT . 'artist/events?event_added=' . $id);
                }   
                else
                {
                    //Edit event
                    $up = array(
                    'Title' => $fm['Title'],
                    'Descr' => Valid::String($fm, 'Descr'),
                    'EventType' => $fm['EventType'],
                    'Price'  => ($fm['EventType'] == 1 || !empty($fm['PriceFree']) || empty($fm['Price'])) ? 0 : $fm['Price'],
                    'Location' => ($fm['EventType'] == 3) ? 'online only' : Valid::String($fm, 'Location'),
                    'EventDate' => $event_date.' '.$event_time );
                    
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
            $mesg = 'New ' . ($event['EventType']==1 ? 'live' : ($event['EventType']==2 ? 'stream' : 'online')) . ' event';
            $mesg .= ' "<a href="/u/' . $this->mUser->mUserInfo['Name'] . '/events/' . $event['Id'] . '">' . $event['Title'] . '</a>"';
            if($event['EventType'] != 3)
            {
                $mesg .= ' in ' . $event['Location'];
            }
            $mesg .= ' at ' . date('H:i m/d/Y', strtotime($event['EventDate']));
            
            
            Wall::Add( $this->mUser->mUserInfo['Id'], $this->mUser->mUserInfo['Id'], $mesg, $this->mCache );
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
                    $facebook->api('/'.$this->mUser->mUserInfo['FbId'] . '/feed', 'POST', array('access_token' => $token, 'message' => strip_tags($mesg), 'link' => 'http://' . DOMAIN . '/u/' . $this->mUser->mUserInfo['Name'] . '/events/' . $event['Id']));
                }
                catch(FacebookApiException $e)
                {
                }
            }
            //update event status
            EventQuery::create()->select(array('Id'))->filterById($id)->update(array('Status' => 2));
            $res['q'] = 'ok';
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

        $res = array('q' => 'ok', 'errs' => array());
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
                $this->mUser->mUserInfo['WalletBlock'] = $this->mUser->mUserInfo['WalletBlock'] - $event['Price'];
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
            $res['q'] = 'ok';
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

        $res = array('q' => 'ok', 'errs' => array());
        if (!empty($event) && $event['Status'] < 3 && $event['UserId'] == $this->mUser->mUserInfo['Id'])
        {
            //update event status
            EventQuery::create()->select(array('Id'))->filterById($id)->update(array('Status' => 4));
            //close flows of that broadcast
            BroadcastFlows::CloseEventFlows($event['Id']);
            //clean flow name in cache
            $this->mCache->set('broadcast_' . $event['Code'], '', 1);

            //get sum of purchase event
            $blocksum = EventPurchase::GetEventSum($event['Id']);

            //update artist wallet
            User::UpdateWallet($this->mUser->mUserInfo['Id'], $this->mUser->mUserInfo['Wallet'], $this->mUser->mUserInfo['WalletBlock']-$blocksum);

            //clear artist events cache
            $this->mCache->set('events_onwall' . $this->mUser->mUserInfo['Id'], '', 1);
            $res['id'] = $event['Id'];
            $res['q'] = 'ok';
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
        $id = _v('id', 0);
        if ($id)
        {
            $album = MusicAlbum::GetAlbum( $id );
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
            //main music page
            
            //albums list
            $this->mSmarty->assignByRef('albums', MusicAlbum::GetAlbumList($this->mUser->mUserInfo['Id'], 0));

            //tracks without albums
            $this->mSmarty->assignByRef('tracks', Music::GetMusicList($this->mUser->mUserInfo['Id'], 0, 0));

            $this->mSmarty->display('mods/profile/edit_artist/music.html');
        }
        else
        {
            //show album
         
            //tracks
            $this->mSmarty->assignByRef('tracks', Music::GetMusicList($this->mUser->mUserInfo['Id'], $id, 0));

            $this->mSmarty->assignByRef('album', $album);
            $this->mSmarty->assign('id', $id);

            $this->mSmarty->display('mods/profile/edit_artist/music_album.html');
        }
        
    }

     
    /**
     * Add / Edit Album
     */
    public function EditAlbum()
    {
        $this->mSmarty->assign('module', 'music');
        $id = _v('id', 0);
        $rand_id = _v('rand_id', rand(100000, 999999));
        $this->mSmarty->assign('rand_id', $rand_id);
        
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
                $errs['DateRelease'] = 'Please speicfy release date';
            }
            elseif(-2==$date_release)
            {
                $errs['DateRelease'] = 'Wrong release date';
            } 
            
            //title
            $fm['Title'] = Valid::String($fm, 'Title');
            if (empty($fm['Title']))
            {
                $errs['Title'] = 'Please specify album title';
            }
            
            if (empty($errs))
            {
                //image
                $image = $this->mSession->Get('upl_image_'.$rand_id);
                if ($image)
                {
                    copy( BPATH . $image[1], BPATH . str_replace('tmp/', MakeDirName($this->mUser->mUserInfo['Id']), $image[1]) );
                    copy( BPATH . $image[2], BPATH . str_replace('tmp/', MakeDirName($this->mUser->mUserInfo['Id']), $image[2]) );

                    //delete tmp
                    @unlink(BPATH . $image[1]);
                    @unlink(BPATH . $image[2]);
                    $this->mSession->Del('upl_image_'.$rand_id);

                    $image = str_replace('/', '', strrchr($image[1], '/'));
                }


                if (!$id)
                {
                    //add
                    $mAlbum = new MusicAlbum();
                    $mAlbum->setUserId($this->mUser->mUserInfo['Id']);
                    $mAlbum->setTitle($fm['Title']);
                    $mAlbum->setDescr(!empty($fm['Descr']) ? trim(strip_tags($fm['Descr'])) : '');
                    $mAlbum->setDateRelease($date_release);
                    $mAlbum->setImage( $image );
                    $mAlbum->setPrice((!empty($fm['PriceFree']) || empty($fm['Price'])) ? 0 : $fm['Price']);
                    $mAlbum->setPdate( mktime() );
                    $mAlbum->setActive( !empty($fm['Active']) ? 1 : 0);
                    $mAlbum->save();
                    //clear artist music cache
                    $this->mCache->set('music_onwall' . $this->mUser->mUserInfo['Id'], '', 1);
                    uni_redirect(PATH_ROOT.'artist/music?album_added');  
                }
                else
                {
                    //edit
                    $up = array( 
                        'Title' => $fm['Title'],
                        'Descr' => !empty($fm['Descr']) ? trim(strip_tags($fm['Descr'])) : '',
                        'DateRelease' => $date_release,
                        'Price'  => (!empty($fm['PriceFree']) || empty($fm['Price'])) ? 0 : $fm['Price'],
                        'Active' => !empty($fm['Active']) ? 1 : 0
                        );
                    if(!empty($image))
                    {
                        $up['Image'] = $image;
                    }
                    MusicAlbumQuery::create()->select('Id')->filterById($id)->update( $up );
                    //clear artist music cache
                    $this->mCache->set('music_onwall' . $this->mUser->mUserInfo['Id'], '', 1);
                    uni_redirect(PATH_ROOT.'artist/music?album_updated');  
                }

            }  
            else
            {
                $this->mSmarty->assignByRef('errs', $errs);

                $image = $this->mSession->Get('upl_image_'.$rand_id);
                if (!empty($image))
                {
                    $fm['Image'] = $image[1];
                }
                
                $this->mSmarty->assignByRef('fm', $fm);


            }
        } 
        elseif ($id)
        {
            //edit data
            $album['DateRelease'] = date('m/d/Y', strtotime($album['DateRelease']));
            $this->mSmarty->assignByRef('fm', $album);
        }

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

        //crop to small size
        if (!empty($result['success']) && 1==$result['success'])
        {
            include_once 'libs/Crop/Image_Transform.php';
            include_once 'libs/Crop/Image_Transform_Driver_GD.php';

            $crop_fname = str_replace('tmp/', 'tmp/m_', $mFu->GetSavedFile());
            i_crop_copy(96, 96, $mFu->GetSavedFile(),  $crop_fname, 1);

            $crop_fnamex = str_replace('tmp/', 'tmp/x_', $mFu->GetSavedFile());
            i_crop_copy(22, 22, BPATH .$crop_fname, BPATH .$crop_fnamex, 2);
            @unlink( BPATH . $mFu->GetSavedFile());

            $this->mSession->Set( 'upl_image_'.$rand_id, array($mFu->GetSavedFile(), $crop_fname, $crop_fnamex) );
            $result['image'] = $crop_fname;
        }

        echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
        exit();
    }


    /**
     * Add / Edit Track
     */
    public function EditTrack()
    {
        $id = _v('id', 0);
        $album = _v('album', 0);
        $rand_id = _v('rand_id', rand(100000, 999999));
        $this->mSmarty->assign('rand_id', $rand_id);

        //check music rights
        if ($id)
        {
            $music = Music::GetMusic( $id );
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

        //full albums list
        $albums = MusicAlbum::GetAlbumList($this->mUser->mUserInfo['Id'], 0);
        $albums = make_assoc_array( $albums, 'Id' );
        
        if ($album && !isset($albums[$album]))
        {
            $album = 0;
        }
        //deb($_SESSION);

        if (!empty($_POST['fm']))
        {
            include_once 'model/Valid.class.php';
            $fm = $_POST['fm'];
            $errs = array();
            
            //release date
            $date_release = Valid::Date($fm, 'DateRelease');
            if (-1==$date_release)
            {
                $errs['DateRelease'] = 'Please speicfy release date';
            }
            elseif(-2==$date_release)
            {
                $errs['DateRelease'] = 'Wrong release date';
            } 
            
            //title
            $fm['Title'] = Valid::String($fm, 'Title');
            if (empty($fm['Title']))
            {
                $errs['Title'] = 'Please specify track title';
            }

            if (empty($errs))
            {
                //track
                $track = $this->mSession->Get('upl_track_' . $rand_id);
                $track_preview = $this->mSession->Get('upl_track_preview_' . $rand_id);
                
                $track_length = '';
                $track_preview_length = '';
                
                //include ID3 lib
                include_once 'libs/id3tag/modules/getid3.php';
                $getID3 = new getID3;
                
                if ($track)
                {
                    $dir = MakeUserDir('files/track/u', $this->mUser->mUserInfo['Id']);
                    $fn = substr(md5(mktime()), 0, 10) . date("hm") . '.mp3';
                    copy(BPATH . $track, BPATH . $dir . '/' . $fn);

                    //delete tmp
                    @unlink(BPATH . $track);
                    $this->mSession->Del('upl_track_' . $rand_id);

                    $track = $fn;
                    
                    //get ID3
                    $finfo = $getID3 -> analyze( BPATH . $dir . '/' . $fn );
                    $track_length = !empty($finfo['playtime_string']) ? $finfo['playtime_string'] : '';
                    
                }
                if($track_preview)
                {
                    $dir = MakeUserDir('files/track/u', $this->mUser->mUserInfo['Id']);
                    $fn_preview = 'pr_' . substr(md5(mktime()), 0, 10) . date("hm") . '.mp3';;
                    copy(BPATH . $track_preview, BPATH . $dir . '/' . $fn_preview);
                    //delete tmp
                    @unlink(BPATH . $track_preview);
                    $this->mSession->Del('upl_track_preview_' . $rand_id);
                    $track_preview = $fn_preview;
                    
                    //get ID3
                    $finfo = $getID3 -> analyze( BPATH . $dir . '/' . $fn_preview );
                    $track_preview_length = !empty($finfo['playtime_string']) ? $finfo['playtime_string'] : '';
                }

                if (!$id)
                {
                    //add
                    $mMusic = new Music();
                    $mMusic->setUserId($this->mUser->mUserInfo['Id']);
                    $mMusic->setTitle($fm['Title']);
                    $mMusic->setAlbumId($fm['AlbumId']);
                    $mMusic->setGenre( Valid::String($fm, 'Genre') );
                    $mMusic->setDateRelease($date_release);
                    $mMusic->setLabel( Valid::String($fm, 'Label') );
                    $mMusic->setPrice((!empty($fm['PriceFree']) || empty($fm['Price'])) ? 0 : $fm['Price']);
                    $mMusic->setTrack( $track );
                    $mMusic->setTrackLength($track_length);
                    $mMusic->setTrackPreview( $track_preview );
                    $mMusic->setTrackPreviewLength($track_preview_length);
                    $mMusic->setPdate( mktime() );
                    $mMusic->setActive( !empty($fm['Active']) ? 1 : 0);
                    $mMusic->save();
                    //clear artist music cache
                    $this->mCache->set('music_onwall' . $this->mUser->mUserInfo['Id'], '', 1);
                    uni_redirect(PATH_ROOT.'artist/music'.($fm['AlbumId'] ? '/' . $fm['AlbumId'] : '').'?track_added');  
                }
                else
                {
                    //edit
                    $up = array( 
                        'Title' => $fm['Title'],
                        'AlbumId' => $fm['AlbumId'], 
                        'Genre' =>  Valid::String($fm, 'Genre'),
                        'DateRelease' => $date_release,
                        'Label'  => Valid::String($fm, 'Label'),
                        'Price'  => (!empty($fm['PriceFree']) || empty($fm['Price'])) ? 0 : $fm['Price'],
                        'Active' => !empty($fm['Active']) ? 1 : 0
                        );
                    if ($track)
                    {
                        $up['Track']  =  $track;
                        $up['TrackLength'] = $track_length;
                    }
                    if ($track_preview)
                    {
                        $up['TrackPreview']  =  $track_preview;
                        $up['TrackPreviewLength'] = $track_preview_length;
                    }

                    MusicQuery::create()->select('Id')->filterById($id)->update( $up );    
                    //clear artist music cache
                    $this->mCache->set('music_onwall' . $this->mUser->mUserInfo['Id'], '', 1);
                    uni_redirect(PATH_ROOT.'artist/music'.($fm['AlbumId'] ? '/' . $fm['AlbumId'] : '').'?track_updated');  
                }
            }  
            else
            {
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
        elseif ($id)
        {
            //edit data
            $music['DateRelease'] = date('m/d/Y', strtotime($music['DateRelease']));
            $this->mSmarty->assignByRef('fm', $music);
        }

        //genres list
        $genres_list = User::GetGenresList();
        $this->mSmarty->assignByRef('genres_list', $genres_list);

        $this->mSmarty->assign('id', $id);
        $this->mSmarty->assignByRef('albums', $albums);
        $this->mSmarty->assign('album', $album);
        
        
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
        $mFu = new FileUpload(array('mp3'), 15360000);

        //upload to tmp directory
        $result = $mFu->handleUpload( 'files/track/tmp/');

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
    public function Video()
    {
        //main video page
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

        $this->mSession->Del( 'upl_video_rnd' );

        $this->mSmarty->assign('video_added', isset($_REQUEST['video_added']) ? 1 : 0);
        $this->mSmarty->assign('video_updated', isset($_REQUEST['video_updated']) ? 1 : 0);
        $this->mSmarty->assign('video_removed', isset($_REQUEST['video_removed']) ? 1 : 0);
        if (!$id)
        {
            //video list
            $this->mSmarty->assignByRef('videos', Video::GetVideoList($this->mUser->mUserInfo['Id'], 0, 0));
            $this->mSmarty->display('mods/profile/edit_artist/video.html');
        }
        else
        {
            if(!$is_broadcasting)
            {
                //show one video
                $video = Video::GetVideoInfo($id);
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
            }
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
        $mFu = new FileUpload(array(), 153600000);

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
        $id = _v('id', 0);

        $rand_id = _v('rand_id', $this->mSession->Get( 'upl_video_rnd' ) ? $this->mSession->Get( 'upl_video_rnd' ) : rand(100000, 999999));
        $this->mSession->Set( 'upl_video_rnd', $rand_id );
        $this->mSmarty->assign('rand_id', $rand_id);

        $video = array();
        //check video rights
        if ($id)
        {
            $video = Video::GetVideoInfo( $id );
            if (empty($video) || $video['Deleted']==1 || $video['UserId'] != $this->mUser->mUserInfo['Id'])
            {
                $id = 0;
                $video = array();
            }
            else if($video['Price'] == 0)
            {
                $video['PriceFree'] = 1;
            }
        }
        $this->mSmarty->assign('module', 'video');

        if (!empty($_POST['fm']))
        {
            include_once 'model/Valid.class.php';
            $fm = $_POST['fm'];
            $errs = array();

            $video_m = $this->mSession->Get('upl_video_' . $rand_id);
            if(!$id && (empty($video_m) || !file_exists(BPATH . $video_m)))
            {
                $errs['video'] = 'Please upload video file';
            }
            else
            {
                $fm['Video'] = $video_m;
            }

            $video_pr = $this->mSession->Get('upl_video_preview_' . $rand_id);
            if(!empty($video_pr) && !file_exists(BPATH . $video_pr))
            {
                $errs['video_preview'] = 'Not found video preview file. Please upload video preview';
            }
            else if(!empty($video_pr))
            {
                $fm['VideoPreview'] = $video_pr;
            }
           
            //title
            $fm['Title'] = Valid::String($fm, 'Title');
            if (empty($fm['Title']))
            {
                $errs['Title'] = 'Please specify video title';
            }

            if (empty($errs))
            {
                $status = !empty($video['Status']) ? $video['Status'] : 0;
                if($video_pr)
                {
                    //send to cinvertation preview file first
                    $ext = ToLower(strrchr($video_pr, '.'));
                    $fn_preview = substr(md5(mktime()), 5, 10) . date("hm") . $ext;
                    $dir = is_dir(VPATH . 'source') ? VPATH . 'source' : BPATH . MakeUserDir('files/video/u', $this->mUser->mUserInfo['Id']);
                    copy(BPATH . $video_pr, $dir . '/' . $fn_preview);
                    //delete tmp
                    @unlink(BPATH . $video_pr);
                    $this->mSession->Del('upl_video_preview_' . $rand_id);

                    //insert record to convertation table
                    $conf = include(BPATH . 'dev/db/build/conf/artistfan-conf.php');
                    $gPdo = new PDO(VBASE, $conf['datasources']['artistfan']['connection']['user'], $conf['datasources']['artistfan']['connection']['password']);
                    $gPdo->query('SET CHARACTER SET utf8');
                    $gPdo->query("INSERT INTO " . VTABLE . " (from_fname, to_fname, cdate, save_frames, in_proc, pdate) VALUES ('" . $fn_preview . "', '" . $fn_preview . ".flv', 0, '', 0, 0)");
                    $gPdo = null;

                    $video_pr = $fn_preview;
                    $status = 1;
                }
                if($video_m)
                {
                    $ext = ToLower(strrchr($video_m, '.'));
                    $fn = substr(md5(mktime()), 0, 10) . date("hm") . $ext;
                    $dir = is_dir(VPATH . 'source') ? VPATH . 'source' : BPATH . MakeUserDir('files/video/u', $this->mUser->mUserInfo['Id']);
                    copy(BPATH . $video_m, $dir . '/' . $fn);

                    //delete tmp
                    @unlink(BPATH . $video_m);
                    $this->mSession->Del('upl_video_' . $rand_id);

                    //insert record to convertation table
                    $conf = include(BPATH . 'dev/db/build/conf/artistfan-conf.php');
                    $gPdo = new PDO(VBASE, $conf['datasources']['artistfan']['connection']['user'], $conf['datasources']['artistfan']['connection']['password']);
                    $gPdo->query('SET CHARACTER SET utf8');
                    $gPdo->query("INSERT INTO " . VTABLE . " (from_fname, to_fname, cdate, save_frames, in_proc, pdate) VALUES ('" . $fn . "', '" . $fn . ".flv', 0, '15', 0, 0)");
                    $gPdo = null;

                    $video_m = $fn;
                    $status = 1; //send to convertation
                }

                if (!$id)
                {
                    //new video
                    $mVideo = new Video();
                    $mVideo->setUserId($this->mUser->mUserInfo['Id']);
                    $mVideo->setTitle($fm['Title']);
                    $mVideo->setPrice((!empty($fm['PriceFree']) || empty($fm['Price'])) ? 0 : $fm['Price']);
                    $mVideo->setVideo( $video_m );
                    $mVideo->setVideoPreview( $video_pr );
                    $mVideo->setPdate( mktime() );
                    $mVideo->setStatus( 1 );
                    $mVideo->setActive( !empty($fm['Active']) ? 1 : 0);
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
                        'Title' => $fm['Title'],
                        'Price'  => (!empty($fm['PriceFree']) || empty($fm['Price'])) ? 0 : $fm['Price'],
                        'Status' => $status,
                        'Active' => !empty($fm['Active']) ? 1 : 0
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
                    if($video_m && !empty($video['Video']))
                    {
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
                    if($video_pr && !empty($video['VideoPreview']))
                    {
                        if(file_exists(BPATH . $video['VideoPreview']))
                        {
                            //old tmp file preview
                            @unlink(BPATH . $video['VideoPreview']);
                        }
                        else if(file_exists(BPATH . 'files/video/u/' . $video['UserId'] . '/' . $video['VideoPreview']))
                        {
                            //old preview file
                            @unlink(BPATH . 'files/video/u/' . $video['UserId'] . '/' . $video['VideoPreview']);
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
        }


        $this->mSmarty->assign('id', $id);

        $this->mSmarty->display('mods/profile/edit_artist/video_edit.html');
    }

    /**
     * Add / Edit video from youtube
     */
    public function EditVideoyt()
    {
        $id = _v('id', 0);

        //check video rights
        if ($id)
        {
            $video = Video::GetVideoInfo( $id );
            if (empty($video) || $video['Deleted']==1 || $video['UserId'] != $this->mUser->mUserInfo['Id'])
            {
                $id = 0;
                $video = array();
            }
        }
        $this->mSmarty->assign('module', 'video');

        if (!empty($_POST['fm']))
        {
            include_once 'model/Valid.class.php';
            $fm = $_POST['fm'];
            $errs = array();
            //track
            $track = '';

            //title
            $fm['Title'] = Valid::String($fm, 'Title');
            if (empty($fm['Title']))
            {
                $errs['Title'] = 'Please specify video title';
            }
            $fm['VideoCode'] = trim($fm['VideoCode']);
            $fm['VideoLink'] = Valid::String($fm, 'VideoLink');
            if(empty($fm['VideoCode']) && empty($fm['VideoLink']))
            {
                $errs['VideoCode'] = 'Please specify video code or video link';
                $errs['VideoLink'] = 'Please specify video code or video link';
            }
            if(!empty($fm['VideoLink']))
            {
                //get youtube video id from link
                /*if (!preg_match("~^(http://)?(www\.)?youtube.com/watch?v=[_\-a-z0-9]+[&\.]*$~i", $fm['VideoLink']))
                {
                    $errs['VideoLink'] = 'Please specify correct video link';
                }
                else
                {
                    $query = parse_url($fm['VideoLink'], PHP_URL_QUERY);
                    $url = array();
                    parse_str($url['query'], $url);
                    $track = Valid::String($url, 'v');
                    if(!$track)
                    {
                        $errs['VideoLink'] = 'Please specify correct video link';
                    }
                }*/
                if(preg_match('~(\.be/|/embed/|/v/|/watch\?v=)([A-Za-z0-9_-]{5,11})~', $fm['VideoLink'], $match))
                {
                    $track = !empty($match[2]) ? $match[2] : '';
                }
                if(empty($track))
                {
                    $errs['VideoLink'] = 'Please specify correct video link';
                }
            }
            if(!empty($fm['VideoCode']))
            {
                //get youtube video id from code
                if(preg_match('~(\.be/|/embed/|/v/|/watch\?v=)([A-Za-z0-9_-]{5,11})~', $fm['VideoCode'], $match))
                {
                    $track = !empty($match[2]) ? $match[2] : '';
                }
                if(empty($track))
                {
                    $errs['VideoCode'] = 'Please specify correct video code';
                }
            }

            if (empty($errs))
            {
                if (!$id)
                {
                    //add
                    $mVideo = new Video();
                    $mVideo->setUserId($this->mUser->mUserInfo['Id']);
                    $mVideo->setTitle($fm['Title']);
                    $mVideo->setPrice(0);
                    $mVideo->setVideo( $track );
                    $mVideo->setFromYt(1);
                    $mVideo->setStatus(2);
                    $mVideo->setPdate( mktime() );
                    $mVideo->setActive( !empty($fm['Active']) ? 1 : 0);
                    $mVideo->save();
                    //clear artist video cache
                    $this->mCache->set('video_onwall' . $this->mUser->mUserInfo['Id'], '', 1);
                    uni_redirect(PATH_ROOT.'artist/video?video_added');
                }
                else
                {
                    //edit
                    $up = array(
                        'Title' => $fm['Title'],
                        'Video'  =>  $track,
                        'Active' => !empty($fm['Active']) ? 1 : 0
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
        elseif ($id)
        {
            //edit data
            $video['VideoLink'] = 'http://www.youtube.com/watch?v=' . $video['Video'];
            $video['VideoCode'] = '<iframe width="560" height="315" src="http://www.youtube.com/embed/' . $video['Video'] . '" frameborder="0" allowfullscreen></iframe>';
            $this->mSmarty->assignByRef('fm', $video);
        }


        $this->mSmarty->assign('id', $id);

        $this->mSmarty->display('mods/profile/edit_artist/video_edit_yt.html');
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

        $page = _v('page', 1);
        $pcnt = 10;

        $rcnt = UserFollow::GetFollowersCount($this->mUser->mUserInfo['Id']);
        $users = UserFollow::GetFollowersList($this->mUser->mUserInfo['Id'], $page, $pcnt);

        include_once 'model/Pagging.class.php';
        $link = PATH_ROOT . 'artist/fans';

        $mpg = new Pagging($pcnt, $rcnt, $page, $link);
        $pagging = $mpg->Make2($this->mSmarty, 0, 1);

        $this->mSmarty->assignByRef('pagging', $pagging);
        $this->mSmarty->assignByRef('users', $users);
        $this->mSmarty->assignByRef('countries', Countries::GetCountries($this->mCache));

        //deb($users);
        $this->mSmarty->display('mods/profile/edit_artist/fans.html');
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
        if($this->mlObj['mSession']->Get('error'))
        {
            $this->mSmarty->assign('error', $this->mlObj['mSession']->Get('error'));
            $this->mlObj['mSession']->Del('error');
        }

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
                            $errs['old_pass'] = 'Please specify old password';
                        }
                        else
                        {
                            $this->mUser->mRc4->crypt($fm['old_pass']);
                            if (bin2hex($fm['old_pass']) != $this->mUser->mUserInfo['Pass'])
                            {
                                $errs['old_pass'] = 'Incorrect old password';
                            }
                        }

                        if (empty($fm['new_pass']))
                        {
                            $errs['new_pass'] = 'Please specify new password';
                        }
                        elseif ($fm['new_pass'] != $fm['new_pass2'])
                        {
                            $errs['new_pass2'] = 'The passwords don\'t match';
                        }
                        else
                        {
                            $this->mUser->mRc4->crypt($fm['new_pass2']);
                            if (bin2hex($fm['new_pass2']) == $this->mUser->mUserInfo['Pass'])
                            {
                                $err['new_pass'] = 'The new password must not match with the old';
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


                        $res['q'] = 'ok';
                    }
                    catch (Exception $e)
                    {
                        $err = $e->getMessage();
                        if ($err != 'err')
                        {
                            $errs[] = $err;
                        }
                        $res['errs'] = $errs;
                        $res['q'] = 'err';
                    }
                    break;
                case 'social_fb':
                    try
                    {
                        $fm['fb_id'] = trim(strip_tags($fm['fb_id']));
                        if (!empty($fm['fb_id']) && !is_numeric($fm['fb_id']))
                        {
                            $errs['fb_id'] = 'Facebook ID must be numeric';
                        }
                        else if($fm['fb_id'] != $this->mUser->mUserInfo['FbId'] && $this->mUser->mUserInfo['FbStart'] == 1)
                        {
                            $errs['fb_id'] = 'You can not change your Facebook account';
                        }
                        else if(!empty($fm['fb_id']) && $fm['fb_id'] != $this->mUser->mUserInfo['FbId'])
                        {
                            $fbexist = UserQuery::create()->select(array('Id'))->filterByFbId($fm['fb_id'])->findOne();
                            if(!empty($fbexist))
                            {
                                $errs['fb_id'] = 'That account already taken';
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
                            $res['q'] = 'ok';
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
                        $res['q'] = 'err';
                    }
                    break;
                case 'social_tw':
                    try
                    {
                        $fm['tw_id'] = trim(strip_tags($fm['tw_id']));

                        if (!empty($fm['tw_id']) && !is_numeric($fm['tw_id']))
                        {
                            $errs['tw_id'] = 'Twitter ID must be numeric';
                        }
                        else if($fm['tw_id'] != $this->mUser->mUserInfo['TwId'] && $this->mUser->mUserInfo['TwStart'] == 1)
                        {
                            $errs['tw_id'] = 'You can not change your Twitter account';
                        }
                        else if(!empty($fm['tw_id']) && $fm['tw_id'] != $this->mUser->mUserInfo['TwId'])
                        {
                            $twexist = UserQuery::create()->select(array('Id'))->filterByTwId($fm['tw_id'])->findOne();
                            if(!empty($twexist))
                            {
                                $errs['tw_id'] = 'That account already taken';
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
                                $errs['tw_id'] = 'Could not connect to Twitter. Refresh the page or try again later.';
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
                            $res['q'] = 'ok';
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
                        $res['q'] = 'err';
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

        $page = _v('page', 1);
        $pcnt = 10;
        $status = -1;//all
        $sort = trim(strip_tags(_v('sort', '')));
        $this->mSmarty->assign('sort', $sort);
        
        $rcnt = Payout::PaymentsCount($this->mUser->mUserInfo['Id'], $status, -1);
        if ($rcnt)
        {
            $payments = Payout::PaymentsList($this->mUser->mUserInfo['Id'], $status, $sort, -1, $page, $pcnt, 1, 1);
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


    

    public function Payout()
    {
        $this->mSmarty->assign('module', 'wallet');

        if (!empty($_POST['fm']) || !empty($_POST['pfm']))
        {
            $fm = !empty($_POST['fm']) ? $_POST['fm'] : array();
            $pfm = !empty($_POST['pfm']) ? $_POST['pfm'] : array();
            $errs = array();

            try
            {
                if (empty($fm['Payout']) || $fm['Payout'] <= 0)
                {
                    $errs['Payout'] = 'Please specify payout amount';
                }
                else
                {
                    $fm['Payout'] = abs($fm['Payout']);
                    if ($fm['Payout'] > ($this->mUser->mUserInfo['Wallet'] - $this->mUser->mUserInfo['WalletBlock']))
                    {
                        $errs['Payout'] = 'It is not enough money in the account';
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
                        $errs['RoutingCode'] = 'Please specify Routing / ABA Code';
                    }
                    if(empty($pfm['AccountNumber']))
                    {
                        $errs['AccountNumber'] = 'Please specify Bank Account Number';
                    }
                    if(empty($pfm['HolderName']))
                    {
                        $errs['HolderName'] = 'Please specify Bank Account Holder Name';
                    }
                    if(empty($pfm['AccountType']))
                    {
                        $errs['AccountType'] = 'Please specify Account Type';
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
                Payout::PayoutMoney($this->mUser->mUserInfo['Id'], 0, 0, $fm['Payout'], $sum, 0, 0, array('type' => 'points'), $fm['PaymentInfoId']);
                User::UpdateWallet($this->mUser->mUserInfo['Id'], $sum);
                
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
        
        $this->mSmarty->assignByRef('account_types', PaymentInfo::AccountTypesList());
        $this->mSmarty->assignByRef('methods', Payout::MethodsList());
        $this->mSmarty->display('mods/profile/edit_artist/payout.html');
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

        echo json_encode(array('q' => 'ok'));
        exit(); 
    }


    /**********************
     *        Artist tools
     ***********************/

    
    public function Tools()
    {
        $this->mSmarty->assign('module', 'tools');

        //locations with count fans
        $cities = UserFollow::GetFollowListByCities($this->mUser->mUserInfo['Id']);
        $this->mSmarty->assignByRef('cities', $cities);

        //top fan 100 (first 10)
        $fans = UserFollow::GetFollowTopList($this->mUser->mUserInfo['Id'], '', 1, 10);
        $this->mSmarty->assignByRef('fans', $fans);

        $this->mSmarty->assignByRef('countries', Countries::GetCountries($this->mCache));

        $this->mSmarty->display('mods/profile/edit_artist/tools.html');
        exit();
    }

    /**
     * Google map and top fans for each locality
     */
    public function FanFinder()
    {
        $this->mSmarty->assign('module', 'tools');

        $page = _v('page', 1);
        $pcnt = 10;
        $location = strip_tags(trim(_v('loc', '')));

        $count = 0;
        //all locations with count fans
        $cities = UserFollow::GetFollowListByCities($this->mUser->mUserInfo['Id']);
        foreach($cities as $item)
        {
            if($item['Location'] == $location)
            {
                $count = $item['Cnt'];
                break;
            }
        }
        $this->mSmarty->assignByRef('cities', $cities);

        $this->mSmarty->assign('location', $location);
        $this->mSmarty->assign('count', $count);

        //top fan 100 (first 10) in location $location
        $rcnt = UserFollow::GetFollowersCount($this->mUser->mUserInfo['Id'], $location);
        $fans = UserFollow::GetFollowTopList($this->mUser->mUserInfo['Id'], $location, $page, $pcnt);

        $this->mSmarty->assignByRef('fans', $fans);
        $this->mSmarty->assign('page', $page);
        $this->mSmarty->assign('pcnt', $pcnt);
        
        include_once 'model/Pagging.class.php';
        $link = PATH_ROOT . 'artist/fanfinder' . ($location != '' ? '?loc=' . $location : '');
        $mpg = new Pagging($pcnt, $rcnt, $page, $link);
        $pagging = $mpg->Make2($this->mSmarty, 0, 1);
        $this->mSmarty->assignByRef('pagging', $pagging);

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
        $events = Event::EventsList($this->mUser->mUserInfo['Id'], 0, 0, array('from' => date("Y-m-d H:i:s", mktime(date('H'), date('i'), date('s'), date("m"), date("d")-1, date("Y")))), array(2, 3), array(1, 2));
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

    
    public function StartBroadcasting()
    {
        $this->mSmarty->assign('module', 'broadcasting');
        $event_id = _v('id', 0);

        
        $event = Event::GetEvent($event_id, $this->mUser->mUserInfo['Id']);
        if(empty($event))
        {
            //uni_redirect(PATH_ROOT . 'artist/broadcasting');
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
        $this->mSmarty->assign('DOMAIN', DOMAIN);
        include_once 'dev/config/wowza.php';
        $this->mSmarty->assign('WOWZA_SERVER', WOWZA_SERVER);
        
        
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
        $id = _v('id', 0);
        $ph = (int)_v('ph', 0);
        
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
        

        $this->mSmarty->assign('photo_added', isset($_REQUEST['photo_added']) ? 1 : 0);
        $this->mSmarty->assign('photo_updated', isset($_REQUEST['photo_updated']) ? 1 : 0);
        $this->mSmarty->assign('photo_removed', isset($_REQUEST['photo_removed']) ? 1 : 0);
        $this->mSmarty->assign('album_removed', isset($_REQUEST['album_removed']) ? 1 : 0);
        $this->mSmarty->assign('album_added', isset($_REQUEST['album_added']) ? 1 : 0);
        $this->mSmarty->assign('album_updated', isset($_REQUEST['album_updated']) ? 1 : 0);

        if (!$id)
        {
            //albums list
            $this->mSmarty->assignByRef('albums', PhotoAlbum::GetAlbumList($this->mUser->mUserInfo['Id']));
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

            $this->mSmarty->display('mods/profile/edit_artist/photo_one.html');
        }
    }

    /**
     * Add / Edit Photo Album
     */
    public function EditPhotoAlbum()
    {
        $this->mSmarty->assign('module', 'photo');
        $id = _v('id', 0);

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
                $errs['Title'] = 'Please specify album title';
            }

            if (empty($errs))
            {
                if (!$id)
                {
                    //add
                    $id = PhotoAlbum::AddAlbum($this->mUser->mUserInfo['Id'], trim(strip_tags($fm['Title'])));
                    uni_redirect(PATH_ROOT.'artist/editphotoalbum?album_added&id=' . $id);
                }
                else
                {
                    //edit
                    PhotoAlbum::EditAlbum($id, trim(strip_tags($fm['Title'])));
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
        $this->mSmarty->assignByRef('photos', Photo::GetPhotoList($this->mUser->mUserInfo['Id'], $id));

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
                $errs['PhotoDate'] = 'Wrong photo date';
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
                    $errs['AlbumTitle'] = 'Please specify name for new album';
                }
            }
            //photo
            $image = $this->mSession->Get('upl_photo_' . $rand_id);
            if (empty($id) && empty($image))
            {
                $errs['Image'] = 'Please upload photo file';
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

                    //mid size
                    $mfn = MakeUserDir('files/photo/mid', $this->mUser->mUserInfo['Id']) . '/' . $fn;
                    i_crop_copy(1000, 1400, BPATH . $dir . '/' . $fn,  BPATH . $mfn, 2);

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
                    $id = Photo::AddPhoto($this->mUser->mUserInfo['Id'], $fm['AlbumId'], $image, $fm['Title'], $photo_date, ($count ? 0 : 1));
                    //new post on artist wall
                    $mesg = 'I have just added a <a href="/u/' . $this->mUser->mUserInfo['Name'] . '/photo/' . $fm['AlbumId'] . '?ph=' . $id . '">new photo</a>';
                    Wall::Add( $this->mUser->mUserInfo['Id'], $this->mUser->mUserInfo['Id'], $mesg, $this->mCache );
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
                    $up = array(
                        'Title' => $fm['Title'],
                        'AlbumId' => $fm['AlbumId'],
                        'PhotoDate' => $photo_date
                        );
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
            $photo['Image'] = '/files/photo/thumbs/' . $photo['UserId'] . '/' . $photo['Image'];
            $photo['ImageOrigin'] = '/files/photo/origin/' . $photo['UserId'] . '/' . $photo['Image'];
            $this->mSmarty->assignByRef('fm', $photo);
        }

        $this->mSmarty->assign('id', $id);
        $this->mSmarty->assignByRef('albums', $albums);
        $this->mSmarty->assign('album', $album);

        $this->mSmarty->display('mods/profile/edit_artist/photo_edit.html');
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
            Photo::Remove($id);
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
            //if in album only one photo or deleted photo was cover, make new album cover
            $count = PhotoAlbum::GetAlbumCountPhotos($photo['AlbumId']);
            if($count == 1)
            {
                PhotoAlbum::MakeSinglePhotoCover($photo['AlbumId']);
            }
            uni_redirect(PATH_ROOT . 'artist/editphotoalbum?id=' . $photo['AlbumId'] . '&photo_removed');
        }
        uni_redirect(PATH_ROOT . 'artist/photo');
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
            PhotoAlbum::Remove($id);
        }
        uni_redirect(PATH_ROOT . 'artist/photo?album_removed');
    }
    
}
