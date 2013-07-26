<?php

class Base_Invite extends Base
{
    public function __construct($glObj)
    {
        parent :: __construct($glObj);
    }
	public function addFBUser()
	{
		$email =_v('email', '');
		
		$invApiId = InviteApi::CheckInviteApi( $email, 'facebook');

		if($email && empty($invApiId))
		{
			$mInv = new InviteApi();
					
			$mInv->setIaUserId($this->mUser->mUserInfo['Id']);
					
			$mInv->setIaEmail($email);
			$mInv->setIaType('facebook');					
			$mInv->setCdate(mktime());					
			$mInv->setMdate(mktime());															
					
			$mInv->save();
			$mInvId = $mInv->getIaId();
			echo json_encode(array('id'=>$mInvId));
			exit;
		}
		else
		{
			echo json_encode(array('id'=>$invApiId));
			exit;
		}
	}

	public function addFBFriends()
	{
		$friends = _v('frVal', '');
		$apiId = _v('apiId', '');

		foreach($friends as $val)
		{
			$fCount = InviteDetail::CheckFBInviterDetail( $apiId, $val['id']);
			
			if(empty($fCount))
			{
				$mInvDetail = new InviteDetail();
				
				$mInvDetail->setIdApiId($apiId);					
				$mInvDetail->setIdName($val['name']);				
				$mInvDetail->setIdFbid($val['id']);					
				$mInvDetail->setCdate(mktime());
				$mInvDetail->setMdate(mktime());																			
				$mInvDetail->save();
			}		
		}
	
		echo json_encode(array('q'=>'ok'));
		exit;
	} 	
	public function addFbInvitation()
	{
		$inviter = _v('inviter', ''); //invite this friend from the list of friends
		$invitee = _v('invitee', ''); //current fb logged user
		$invName = _v('invName', '');	// friend fb name
		$invFbid = _v('invFbid', '');	//friend fb id	

		//check if invitation already send 
		$fCount = Invitation::CheckFbInvitationDetail( $invitee, $invFbid);
			
		if(empty($fCount))
		{
			$mInvitation = new Invitation();
			
			$mInvitation->setInvInviter($inviter);								
			$mInvitation->setInvInvitee($invitee);							
			$mInvitation->setInvName($invName);				
			$mInvitation->setInvEmail('');							
			$mInvitation->setInvFbid($invFbid);	
		//	$mInvitation->setInvStatus(0);	// if status 0 , still user not follow <==> if status 1 , user following this artist or fan											
			$mInvitation->setCdate(mktime());
			$mInvitation->setMdate(mktime());																			
			$mInvitation->save();
			
			echo json_encode(array('q'=>'ok'));
			exit;
		}
		else
		{
			echo json_encode(array('q'=>'err'));
			exit;
		}
	} 
		
	public function addTwInvitation()
	{
		$inviter = _v('inviter', ''); //invite this friend from the list of friends
		$invitee = _v('invitee', ''); //current fb logged user
		$invName = _v('invName', '');	// friend fb name
		$invTwid = _v('invTwid', '');	//friend fb id	

		//check if invitation already send 
		$fCount = Invitation::CheckTwInvitationDetail( $invitee, $invTwid);
			
		if(empty($fCount))
		{
			$mInvitation = new Invitation();
			
			$mInvitation->setInvInviter($inviter);								
			$mInvitation->setInvInvitee($invitee);							
			$mInvitation->setInvName($invName);				
			$mInvitation->setInvEmail('');							
			$mInvitation->setInvTwid($invTwid);	
		//	$mInvitation->setInvStatus(0);	// if status 0 , still user not follow <==> if status 1 , user following this artist or fan											
			$mInvitation->setCdate(mktime());
			$mInvitation->setMdate(mktime());																			
			$mInvitation->save();
			
			echo json_encode(array('q'=>'ok'));
			exit;
		}
		else
		{
			echo json_encode(array('q'=>'err'));
			exit;
		}
	} 
    public function InviteFriends()
    {
	    $this->mSmarty->assign('module', 'fbfriends');
	
		$ui = & $this->mUser->mUserInfo;
		$this->mSmarty->assign('ui', $ui);
		$this->mSmarty->assign('appId', FACEBOOK_API_ID);
		
		$res = array('q' => 'ok');	
        $page = _v('page', 1);
        $pcnt = 10;
		$msg = _v('msg', '');
		$search = _v('openListSearch', 'Search Contacts');
		$this->mSmarty->assign('openListSearch', $search);

		if($search == 'Search Contacts')
		{
			$search = '';
		}
		if($msg == 1)
		$this->mSmarty->assign('msg', 'Friends added successfully...');
		
		
		$fbFriends = InviteDetail::GetFBFriendsList($page, $pcnt, $this->mUser->mUserInfo['Id'], $search);
		$rcnt = $fbFriends['rcnt'];
		//deb($fbFriends);
		include_once 'model/Pagging.class.php';
        $link = 'oUsers.InitFbFriends';;
        $mpg = new Pagging($pcnt, $rcnt, $page, $link);
		
		$res['pagging'] = $mpg->Make($this->mSmarty, 1);
		$this->mSmarty->assign('fbFriends', $fbFriends['list']);	
					
		if($_REQUEST['page'] || $_REQUEST['openListSearch'])
		{
			if($this->mUser->mUserInfo['Status'] == USER_FAN)
				$res['data'] = $this->mSmarty->fetch('mods/profile/edit_fan/ajax/fb_friends.html');
			else
				$res['data'] = $this->mSmarty->fetch('mods/profile/edit_artist/ajax/fb_friends.html');
				
			$this->mSmarty->assignByRef('pagging', $res['pagging']);
			echo json_encode($res);
			exit();
		}
		else
		{ 		
			if($this->mUser->mUserInfo['Status'] == USER_FAN)
			$this->mSmarty->display('mods/profile/edit_fan/invite_friends.html');
			else
			$this->mSmarty->display('mods/profile/edit_artist/invite_friends.html');
			
			exit();
		}
	}
	public function addTwUser()
	{
		if(!$_SESSION['access_token'])
		{
			$res = 	array('q'=>"err");
			
			echo json_encode($res);
			exit;
		}
		else
		{
			$email =_v('email', '');
			
			$invApiId = InviteApi::CheckInviteApi( $email, 'twitter');
			if($email && empty($invApiId))
			{
				$mInv = new InviteApi();
						
				$mInv->setIaUserId($this->mUser->mUserInfo['Id']);
						
				$mInv->setIaEmail($email);
				$mInv->setIaType('twitter');					
				$mInv->setCdate(mktime());					
				$mInv->setMdate(mktime());															
						
				$mInv->save();
				$mInvId = $mInv->getIaId();
				if($mInvId)
				{
					$this->addTwFriends( $mInvId );
				}
			}
			else
			{
				if($invApiId)
				{
					$this->addTwFriends( $invApiId );
				}
			}
		}
	}

	public function addTwFriends( $invApiId )
	{
		require_once('libs/twitteroauth/twitteroauth.php');		
		$tweet = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, $this->mUser->mUserInfo['TwOauthToken'], $this->mUser->mUserInfo['TwOauthTokenSecret']);

		$parameters['skip_status'] = true;
		$parameters['cursor'] = -1;

		do
		{
			$twFriends = $tweet->getFriends($this->mUser->mUserInfo['TwId'], 1, $parameters );

			$users = $twFriends->users;
	
			foreach($users as $key=>$user)
			{
				$friendTwid = $user->id_str;
				$fCount = InviteDetail::CheckTwInviterDetail( $invApiId, $friendTwid);
			
				if(empty($fCount))
				{
					$mInvDetail = new InviteDetail();
					
					$mInvDetail->setIdApiId($invApiId);					
					$mInvDetail->setIdName($user->screen_name);
					$mInvDetail->setIdTwid($friendTwid);		
					$mInvDetail->setIdImage($user->profile_image_url);
					$mInvDetail->setCdate(mktime());
					$mInvDetail->setMdate(mktime());																			
					$mInvDetail->save();
				}
			}
			
			$parameters['cursor'] = $twFriends->next_cursor_str; 
		
		}while($parameters['cursor'] != 0);

		$res = array('q'=>'ok');

		echo json_encode($res);
		exit;
	} 	
	public function sendMsgTwFriend()
	{
		$screenName = _v('invName', '');
				
		require_once('libs/twitteroauth/twitteroauth.php');		
		$tweet = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, $this->mUser->mUserInfo['TwOauthToken'], $this->mUser->mUserInfo['TwOauthTokenSecret']);
			
		//$parameters['text'] = '<b>Invitaion to ArtistFan</b> <br/> <a href="'.ROOT_HTTP_PATH.'">Accept </a> & Sign Up With Twitter';		
		$parameters['text'] = 'Invitaion to ArtistFan '.ROOT_HTTP_PATH;
		$parameters['screen_name'] = $screenName;	
		
		try
		{
			$twFriends = $tweet->sendMessage( $parameters );
			$res = array('q'=>'ok');
		}
		catch(Exception $e)
		{
			$res = array('q'=>'err');
		}	

		echo json_encode($res);
		exit;		
	}

	public function InviteTwitterFriends()
	{
		$this->mSmarty->assign('module', 'twfriends');
		
		$res = array('q' => 'ok');	
        $page = _v('page', 1);
        $pcnt = 10;
		$msg = _v('msg', '');
		$search = _v('openListSearch', 'Search Contacts');
		$this->mSmarty->assign('openListSearch', $search);

		if($search == 'Search Contacts')
		{
			$search = '';
		}
	
		$twFriends = InviteDetail::GetTwitterFriendsList($page, $pcnt, $this->mUser->mUserInfo['Id'], $search);
		$rcnt = $twFriends['rcnt'];

		include_once 'model/Pagging.class.php';
        $link = 'oUsers.InitTwFriends';;
        $mpg = new Pagging($pcnt, $rcnt, $page, $link);
		
		$res['pagging'] = $mpg->Make($this->mSmarty, 1);
		$this->mSmarty->assign('twFriends', $twFriends['list']);	
		
		if($msg == 1)
		$this->mSmarty->assign('msg', 'Friends added successfully...');
		
				
		//deb($twFriends);		
		
		if($_REQUEST['page'] || $_REQUEST['openListSearch'])
		{
			if($this->mUser->mUserInfo['Status'] == USER_FAN)
				$res['data'] = $this->mSmarty->fetch('mods/profile/edit_fan/ajax/tw_friends.html');
			else
				$res['data'] = $this->mSmarty->fetch('mods/profile/edit_artist/ajax/tw_friends.html');
				
			$this->mSmarty->assignByRef('pagging', $res['pagging']);
			echo json_encode($res);
			exit();
		}
		else
		{ 		
			if($this->mUser->mUserInfo['Status'] == USER_FAN)
			$this->mSmarty->display('mods/profile/edit_fan/twitter_friends.html');
			else
			$this->mSmarty->display('mods/profile/edit_artist/twitter_friends.html');
			
			exit();
		}		
	}
}
?>
