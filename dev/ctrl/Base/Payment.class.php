<?php

/**
 * Base Fun profile class
 * User: ssergy
 * Date: 08.02.12
 * Time: 17:45
 *
 */

class Base_Payment extends Base
{
    public function __construct($glObj)
    {
        parent :: __construct($glObj);

        if (!$this->mUser->IsAuth())
        {
            uni_redirect(PATH_ROOT . 'base/user/login');
        }
    }
	public function getEventInfo($id)
	{
        $this->mSmarty->assign('module', 'events');				
		$purchase = EventPurchase::Get($this->mUser->mUserInfo['Id'], $id);
		$event = Event::GetEvent($id);
		if($purchase) {
	//		$this->mSmarty->assign('purchase', 'Already Purchased');
			$this->mSmarty->assign('ErrorMsg',	$this->alreadyPurchased('Already Purchased'));			
		} else {
			$EventUserInfo = User::GetUserFullInfo($event['UserId']);
			$this->mSmarty->assign('ui', $EventUserInfo);
			$this->mSmarty->assign('event',$event);	
			$content = $this->mSmarty->fetch('mods/profile/show_artist/checkoutEventFan.html');
			$this->mSmarty->assign('content',$content);	
		}
		return $event;
	}
	public function getMusicAlbumInfo($id)
	{
        $this->mSmarty->assign('module', 'music');			
		$purchase = Music::GetMusicAlbumWithPurchase($this->mUser->mUserInfo['Id'],$id);
        $MusicAlbum = MusicAlbum::GetAlbum($id);
		if($purchase) {
			$this->mSmarty->assign('EventmusicAlbumMsg',	$this->alreadyPurchased('Already Purchased'));			
		} else {
			$MusicAlbumUserInfo = User::GetUserFullInfo($MusicAlbum['UserId']);
			$this->mSmarty->assign('ui', $MusicAlbumUserInfo);
			$this->mSmarty->assign('album',$MusicAlbum);	
			$content = $this->mSmarty->fetch('mods/profile/show_artist/checkoutFan.html');
			$this->mSmarty->assign('content',$content);	
		}
		return $MusicAlbum;
	}
	public function getMusicTrackInfo($id)
	{
        $this->mSmarty->assign('module', 'music');			
		$purchase = Music::GetMusicAlbumWithPurchase($this->mUser->mUserInfo['Id'],$id);
        //$MusicAlbum = MusicAlbum::GetAlbum($id);
		$MusicTrack = Music::GetMusic($id);
		
		
		if($purchase) {
	//		$this->mSmarty->assign('purchase', 'Already Purchased');
			$this->mSmarty->assign('EventmusicAlbumMsg',	$this->alreadyPurchased('Already Purchased'));			
		} else {
			$MusicTrackUserInfo = User::GetUserFullInfo($MusicTrack['UserId']);
			$this->mSmarty->assign('ui', $MusicTrackUserInfo);
			$this->mSmarty->assign('album',$MusicTrack);	
			$content = $this->mSmarty->fetch('mods/profile/show_artist/musicTrackCheckout.html');
			$this->mSmarty->assign('content',$content);	
		}
		return $MusicTrack;
	}
	public function getVideoInfoPayment($id)
	{	
        $this->mSmarty->assign('module', 'video');			
		$purchase = Music::GetMusicAlbumWithPurchase($this->mUser->mUserInfo['Id'],$id);
        //$MusicAlbum = MusicAlbum::GetAlbum($id);
        $video  = Video::GetVideoInfo($id);
		
		
		
		if($purchase) {
	//		$this->mSmarty->assign('purchase', 'Already Purchased');
			$this->mSmarty->assign('EventmusicAlbumMsg',	$this->alreadyPurchased('Already Purchased'));			
		} else {
			$videoUserInfo = User::GetUserFullInfo($video['UserId']);
			$this->mSmarty->assign('ui', $videoUserInfo);
			$this->mSmarty->assign('video',$video);	
			$content = $this->mSmarty->fetch('mods/profile/show_artist/checkoutVideoFan.html');
			$this->mSmarty->assign('content',$content);	
		}
		return $video;
	}
		
	
	public function checkOut()	
	{
		$type = _v('ptype');
		$id = _v('id', 0);
		$payMore = _v('payMore', 0);
		if($id && $type	&& $payMore){
			$this->mSession->Set('pid', $id);
			$this->mSession->Set('ptype', $type);
			$this->mSession->Set('payMore', $payMore);
			//uni_redirect('/base/payment/doPayment',3);
			setRedirect(ROOT_HTTP_PATH.'/base/payment/doPayment', true );			
		} else {	
			$this->NotFound();
			exit;
		}
	}
	
	public function doPayment()
	{		

		$type = $this->mSession->Get('ptype');
		$id = $this->mSession->Get('pid');
		$payMore = $this->mSession->Get('payMore');
		if($id && $type	&& $payMore){		
		if($type == 'event'){
			$this->getEventInfo($id);
		} elseif($type == 'musicAlbum') {
			$this->getMusicAlbumInfo($id);		
		}elseif($type == 'musicTrack') {
			$this->getMusicTrackInfo($id);		
		}elseif($type == 'video') {
			$this->getVideoInfoPayment($id);		
		}
		$mm = array(1=>'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
        $yy = array();
        for ($i=date("Y"); $i <= date("Y")+10; $i++)
        {
            $yy[$i] = $i;
        }
        $this->mSmarty->assignByRef('mm', $mm);
        $this->mSmarty->assignByRef('yy', $yy);
		$this->mSmarty->assignByRef('countries', Countries::GetCountries($this->mCache));
        $this->mSmarty->assignByRef('id', $id);
		$this->mSmarty->assign('payMore',$payMore);
		$this->mSmarty->assign('ptype', $type);
		$this->mSmarty->display('mods/profile/show_artist/checkout.html');	
		exit;
		}else{
		$this->NotFound();
		exit;		
		}
	}
	
	public function makePayment()
	{

		$ptype = $this->mSession->Get('ptype');
		$id = $this->mSession->Get('pid');
		$payMore = $this->mSession->Get('payMore');		
		include_once 'model/Valid.class.php';
		$error = $this->validationcerditCard();	
		$fm  = $_POST['fm'];
		$cardHolder				=	$fm['cardHolder'];
		$cardNumber				=	$fm['cardNumber'];
		$type					=	$fm['type'];
		$cardExpiryMonth		=	$fm['cardExpiryMonth'];
		$cardExpiryYear			=	$fm['cardExpiryYear'];
		$address				=	$fm['address'];
		$zipcode				=	$fm['zipcode'];

		if($error) {
			$this->doPayment();
		}
		if($ptype == 'event')
		{
			$event = $this->getEventInfo($id);
			if($payMore) {
				$price = $payMore;
			}else {
				$price = $event['Price'];
			}
			$event['Price'] = $price;
			$functioName	=	"PurchaseEventAccess";
			$success = $this->AuthorizeNet($id,$event,$functioName,$event['Price'],$cardHolder,$cardNumber,$cardExpiryMonth,$cardExpiryYear,$zipcode,$address);
			if($success) {
				$purchase = $this->PurchaseEventAccess();
				if($purchase['success'][0]){
				//redirect here
				setRedirect( 'u/'.$purchase['artist'][0].'/eventdetails/'.$id.'?thanks=thanks' );
				//uni_redirect( PATH_ROOT.'u/'.$purchase['artist'][0].'/eventdetails/'.$id.'?thanks=thanks' );
				} else {
				//
				//$this->checkOut();
				$this->doPayment();				
				}
			}
		} elseif( $ptype=='musicAlbum'){						
			$album = $this->getMusicAlbumInfo($id);
			if($payMore) {
				$price = $payMore;
			}else {
				$price = $album['Price'];
			}
			$album['Price'] = $price;
			//function name is not used
			$functioName	=	"PurchaseEventAccess";
			$success = $this->AuthorizeNet($id,$album,$functioName,$album['Price'],$cardHolder,$cardNumber,$cardExpiryMonth,$cardExpiryYear,$zipcode,$address);						
			if($success) {												
				$purchase = $this->PurchaseAlbum();
				if($purchase['success'][0])
				{
					$album = MusicAlbum::GetAlbum($id, 1, 1);	
					setRedirect( ROOT_HTTP_PATH.'/u/'.$album['Name'].'/music/'.$id.'?thanks=thanks&userId='.$album['UserId'].'&album=album');				
				    //uni_redirect( ROOT_HTTP_PATH.'/u/'.$album['Name'].'/music/'.$id.'?thanks=thanks&userId='.$album['UserId'].'&album=album');
				}else{	$this->doPayment(); }
			}
					
		}elseif( $ptype=='musicTrack' ){
				
			$album = $this->getMusicTrackInfo($id);
			if($payMore) {
				$price = $payMore;
			}else {
				$price = $album['Price'];
			}
			$album['Price'] = $price;
			$functioName	=	"PurchaseEventAccess";
			$success = $this->AuthorizeNet($id,$album,$functioName,$album['Price'],$cardHolder,$cardNumber,$cardExpiryMonth,$cardExpiryYear,$zipcode,$address);
			if($success) {							
				$purchase = $this->PurchaseMusic();				
				if($purchase['track'])
				{		
				setRedirect( PATH_ROOT.'u/'.$purchase['ArtistName'].'/music/'.$album['AlbumId'].'?thanks=thanks&userId='.$album['UserId'].'&musicId='.$id );
				    //uni_redirect( PATH_ROOT.'u/'.$purchase['ArtistName'].'/music/'.$album['AlbumId'].'?thanks=thanks&userId='.$album['UserId'].'&musicId='.$id);
				}else{ 	$this->doPayment(); }
			}
									
		}elseif( $ptype=='video' ){				
			$album = $this->getVideoInfoPayment($id);			
			if($payMore) {
				$price = $payMore;
			}else {
				$price = $album['Price'];
			}
			$album['Price'] = $price;
			$functioName	=	"PurchaseEventAccess";
			$success = $this->AuthorizeNet($id,$album,$functioName,$album['Price'],$cardHolder,$cardNumber,$cardExpiryMonth,$cardExpiryYear,$zipcode,$address);
			if($success) {							
				$purchase = $this->PurchaseVideo();
				if($purchase['success'][0])
				{
					setRedirect( PATH_ROOT.'u/'.$purchase['ArtistName'].'/video/'.$album['Id'].'?thanks=thanks&userId='.$album['UserId'] );	
					//uni_redirect( PATH_ROOT.'u/'.$purchase['ArtistName'].'/video/'.$album['Id'].'?thanks=thanks&userId='.$album['UserId'] );
				}else{	$this->doPayment();}
			}								
		
		}
		
		
	}
public function validationcerditCard()
	{
		$fm  = $_POST['fm'];		
		$cardHolder				=	$fm['cardHolder'];
		$cardNumber				=	$fm['cardNumber'];
		$type					=	$fm['type'];
		$cardExpiryMonth		=	$fm['cardExpiryMonth'];
		$cardExpiryYear			=	$fm['cardExpiryYear'];
		$cvv					=	$fm['cvv'];	
		$userName				=	$fm['userName'];														
		$address				=	$fm['address'];
		$city					=	$fm['city'];
		$country				=	$fm['country'];
		$state					=	$fm['state'];
		$zipcode				=	$fm['zipcode'];
		$phone					=	$fm['phone'];										
		$submit			=	$_REQUEST['submit'];
		$error = false;
		if($cardHolder=='')
			{
			$error = true;			
			$this->mSmarty->assign('errorcardHolder', PLEASE_ENTER_THE_CARD_HOLDER_NAME );
			}
		if($cardNumber=='')
			{
			$error = true;
			$this->mSmarty->assign('errorcardNumber', PLEASE_ENTER_THE_CARD_NUMBER );
			}
		if($type=='')
			{
			$error = true;
			$this->mSmarty->assign('errortype', PLEASE_ENTER_THE_CARD_TYPE );
			}
		if($cardExpiryMonth==0 || $cardExpiryYear==0 )
			{
			$error = true;
			$this->mSmarty->assign('cardExpiry', true);
			}
		if($cvv=='')
			{
			$error = true;
			$this->mSmarty->assign('errorcvv', PLEASE_ENTER_THE_CVV );
			}
		if($userName=='')
			{			
			$error = true;
			$this->mSmarty->assign('erroruserName', PLEASE_ENTER_THE_USERNAME );
			}
		if($address=='')
			{
			$error = true;
			$this->mSmarty->assign('erroraddress', PLEASE_ENTER_THE_ADDRESS );
			}			
		if($city=='')
			{
			$error = true;
			$this->mSmarty->assign('errorcity', PLEASE_ENTER_THE_CITY );
			}
		if($country=='')
			{
			$error = true;
			$this->mSmarty->assign('errorcountry', PLEASE_ENTER_THE_COUNTRY );
			}
		if($state=='')
			{
			$error = true;
			$this->mSmarty->assign('errorstate', PLEASE_ENTER_THE_STATE );
			}
		if($zipcode=='')
			{
			$error = true;
			$this->mSmarty->assign('errorzipcode', PLEASE_ENTER_THE_ZIP );
			}
		if($phone=='')
			{			
			$error = true;
			$this->mSmarty->assign('errorphone', PLEASE_ENTER_THE_PHONENUMBER );
			}
			
// here verify the ceridt card and type
		if($cardNumber!='' && $type!='')			
		{
		$verifycard =  $this->validateCC($cardNumber, $type);
		$this->mSmarty->assign('errorcardNumber', $verifycard);								
		}
			
	if($phone)
			{
			$user_phone = is_numeric($phone);	
				if ($user_phone!==true)
				{
					$this->mSmarty->assign('errorphone', PLEASE_SPECIFY_PHONE_NUMBER_AS_INTEGER);
				}
			}
		if($cvv!=''){
		if(!preg_match('/^[0-3]{3}$/', $cvv)){
		 		$error = true;			
				$this->mSmarty->assign('errorcvv', PLEASE_ENTER_A_VALID_CVV_CODE );											
				$cvvvalidation = true;
			}else {
				$cvvvalidation = false;			
			} 
		}			

		
	
		    $this->mSmarty->assignByRef('fm', $fm);		
			return $error;
	
	}	
		
	public function music()
	{		
        $this->mSmarty->assign('module', 'music');
        $id = _v('id', 0);
 	    $a_id = _v('a_id', 0);		
		$payMore=	_v('payMore');	
        $album = MusicAlbum::GetAlbum($id, 0, 1);
		$MusicUserInfo = User::GetUserFullInfo($album['UserId']);
		$this->mSmarty->assign('ui', $MusicUserInfo);		
		if($payMore) {
			$price = $payMore;			
		$this->mSmarty->assignByRef('payMore',$payMore);			
		}else {
			$price = $album['Price'];
		}
		
		$album['Price'] = $price;
        if ($id)
        {
            $album = MusicAlbum::GetAlbum($id, 0, 1);
			        $mm = array();
        $mme = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
        for ($i=1; $i<=12;$i++)
        {
            $mm[$i] = $mme[ $i-1 ];
        }

        $yy = array();
        for ($i=date("Y"); $i <= date("Y")+10; $i++)
        {
            $yy[$i] = $i;
        }
        $this->mSmarty->assignByRef('mm', $mm);
        $this->mSmarty->assignByRef('yy', $yy);
		$this->mSmarty->assign('musicAlbumId',$id );						
		$this->mSmarty->assignByRef('album', $album);
		$this->mSmarty->assignByRef('countries', Countries::GetCountries($this->mCache));								
		$this->mSmarty->assign('id', $id);				
		$this->mSmarty->display('mods/profile/show_artist/checkoutFan.html');		
	   }
		exit();
    
	}
	public function musicTrack()
	{
        $this->mSmarty->assign('module', 'music');

		$id = _v('id', 0);
		$a_id = _v('a_id', 0);		
        $payMore = _v('payMore');		
		$music = Music::GetMusic($id);
		//$music['UserId'];
		$MusicUserInfo = User::GetUserFullInfo($music['UserId']);
		$this->mSmarty->assign('ui', $MusicUserInfo);		

		if($payMore) {
			$paywhatyoulike = $payMore;			
		$this->mSmarty->assignByRef('payMore',$payMore);			
		}else {
			$paywhatyoulike = $music['Price'];
		}
//
		$fm  = $_POST['fm'];
		$cardHolder				=	mysql_escape_string(trim($_REQUEST['fm']['cardHolder']));
		$cardNumber				=	mysql_escape_string(trim($_REQUEST['fm']['cardNumber']));
		$type					=	mysql_escape_string(trim($_REQUEST['fm']['type']));
		$cardExpiryMonth		=	mysql_escape_string(trim($_REQUEST['fm']['cardExpiryMonth']));
		$cardExpiryYear			=	mysql_escape_string(trim($_REQUEST['fm']['cardExpiryYear']));
		$cvv					=	mysql_escape_string(trim($_REQUEST['fm']['cvv']));	
		$userName				=	mysql_escape_string(trim($_REQUEST['fm']['userName']));														
		$address				=	mysql_escape_string(trim($_REQUEST['fm']['address']));
		$city					=	mysql_escape_string(trim($_REQUEST['fm']['city']));
		$country				=	mysql_escape_string(trim($_REQUEST['fm']['country']));
		$state					=	mysql_escape_string(trim($_REQUEST['fm']['state']));
		$zipcode				=	mysql_escape_string(trim($_REQUEST['fm']['zipcode']));
		$phone					=	mysql_escape_string(trim($_REQUEST['fm']['phone']));										
		$submit			=	$_REQUEST['submit'];
		$error = false;
//		
        $purchase = MusicPurchase::Get($this->mUser->mUserInfo['Id'], $id);
		if(empty($purchase))
			{
		if ($id)
        {
			$music = Music::GetMusic($id);
			$mm = array();
			$mme = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
        for ($i=1; $i<=12;$i++)
        {
            $mm[$i] = $mme[ $i-1 ];
        }

        $yy = array();
        for ($i=date("Y"); $i <= date("Y")+10; $i++)
        {
            $yy[$i] = $i;
        }
        $this->mSmarty->assignByRef('mm', $mm);
        $this->mSmarty->assignByRef('yy', $yy);
		$this->mSmarty->assignByRef('album', $music);
		$this->mSmarty->assignByRef('countries', Countries::GetCountries($this->mCache));								
		$this->mSmarty->assign('id', $id);				
		}	
		include_once 'model/Valid.class.php';
		
		if (!empty($_POST['fm']))
        {
			$this->validationcerditCard();
			if($cvv!='')		
			{
				error_reporting(E_ALL ^ E_DEPRECATED);
			 	if (!ereg('([0-9]{3})', $cvv))  
		        { 	
					$error = true;			
					$this->mSmarty->assign('errorcvv', PLEASE_ENTER_A_VALID_CVV_CODE );											
	        	} 	 
			}
			if($fm['phone'])
			{	
				$user_phone = Valid::Integer($fm, 'phone');
	
				if (empty($user_phone))
				{
				
					$this->mSmarty->assign('errorphone', PLEASE_SPECIFY_PHONE_NUMBER_AS_INTEGER );
				}
			}
/*			if($fm['zipcode'])
			{	
				$zip = Valid::Integer($fm, 'zipcode');
	
				if (empty($zip))
				{
					$this->mSmarty->assign('errorzipcode', 'Please specify zip code as integer');
				}
			}*/
		if($cvv!=''){
		if(!preg_match('/^[0-3]{3}$/', $cvv)){
		 		$error = true;			
				$this->mSmarty->assign('errorcvv', PLEASE_ENTER_A_VALID_CVV_CODE );											
				$cvvvalidation = true;
			}else {
				$cvvvalidation = false;			
			} 
		}


		}	


		
		if(isset($submit) && $error!=true && $cvv!='' && $userName!='' && $address!='' && $city!='' && $country!='' && $state!='' && $zipcode!='' && $phone!='' && $cvvvalidation!=true )
			{
		
		$album =  Music::GetMusic($id);		   		   
		$functioName	=	"musicTrack";
		$MusicUserInfo = User::GetUserFullInfo($album['UserId']);
		$this->mSmarty->assign('ui', $MusicUserInfo);		
		
		//
		$paywhatyoulike	= _v('payMore');
		if($paywhatyoulike>=$album['Price']){
		$this->mSmarty->assign('musicAlbumId',$id );											
		$this->AuthorizeNet($id,$album,$functioName,$paywhatyoulike,$cardHolder,$cardNumber,$cardExpiryMonth,$cardExpiryYear,$zipcode,$address);		
		if(!empty($_SESSION['PaymentError']['errs']['common'])){
		$this->mSmarty->assign('alreadyExistMusic',$_SESSION['PaymentError']['errs']['common']);	
		unset($_SESSION['PaymentError']['errs']['common']);
		}
		 }else {		 
		$this->mSmarty->assign('alreadyExistMusic', ERROR_OOPS_NOT_LESS_THAN_PRICED_RATES . $album['Price'] );													 
		 }
		//
		//$this->PaypalPro($id,$album,$functioName,$type,$cardNumber,$cardExpiryMonth,$cardExpiryYear,$cvv,$cardHolder,$userName,$address,$city,$state,$zipcode);
			}
				}
				else
				{
				$album =  Music::GetMusic($id);		
				$this->mSmarty->assign('musicAlbumId',$id );							
				$this->mSmarty->assign('album',$album);							
				$this->mSmarty->assign('alreadyExistMusic', ALREADY_MUSIC_HAS_PURCHASED );											
				}
				$this->mSmarty->assign('musicAlbumId',$id );			
				$this->mSmarty->display('mods/profile/show_artist/musicTrackCheckout.html');			
	}	
	
	public function musicpayment()
	{
        $this->mSmarty->assign('module', 'music');
					
        $id = _v('id', 0);
 	    $a_id = _v('a_id', 0);
        $payMore = _v('payMore');		
        $album = MusicAlbum::GetAlbum($id, 0, 1);	
		$MusicUserInfo = User::GetUserFullInfo($album['UserId']);
		$this->mSmarty->assign('ui', $MusicUserInfo);		
			
		if($payMore) {
			$paywhatyoulike = $payMore;			
		$this->mSmarty->assignByRef('payMore',$payMore);			
		}else {
			$paywhatyoulike = $album['Price'];
		}
	/*		if($fm['UserPhone'])
			{	
				$user_phone = Valid::Integer($fm, 'UserPhone');
	
				if (empty($user_phone))
				{
					$errs['UserPhone'] = 'Please specify user phone number as integer';
				}
			}
			if($fm['zip'])
			{	
				$zip = Valid::Integer($fm, 'zip');
	
				if (empty($zip))
				{
					$errs['zip'] = 'Please specify user zip code as integer';
				}
			}	*/	

		
//
		$fm  = $_POST['fm'];
		$cardHolder				=	mysql_escape_string(trim($_REQUEST['fm']['cardHolder']));
		$cardNumber				=	mysql_escape_string(trim($_REQUEST['fm']['cardNumber']));
		$type					=	mysql_escape_string(trim($_REQUEST['fm']['type']));
		$cardExpiryMonth		=	mysql_escape_string(trim($_REQUEST['fm']['cardExpiryMonth']));
		$cardExpiryYear			=	mysql_escape_string(trim($_REQUEST['fm']['cardExpiryYear']));
		$cvv					=	mysql_escape_string(trim($_REQUEST['fm']['cvv']));	
		$userName				=	mysql_escape_string(trim($_REQUEST['fm']['userName']));														
		$address				=	mysql_escape_string(trim($_REQUEST['fm']['address']));
		$city					=	mysql_escape_string(trim($_REQUEST['fm']['city']));
		$country				=	mysql_escape_string(trim($_REQUEST['fm']['country']));
		$state					=	mysql_escape_string(trim($_REQUEST['fm']['state']));
		$zipcode				=	mysql_escape_string(trim($_REQUEST['fm']['zipcode']));
		$phone					=	mysql_escape_string(trim($_REQUEST['fm']['phone']));										
		$submit			=	$_REQUEST['submit'];
		$error = false;
//		
	if ($id)
        {
            $album = MusicAlbum::GetAlbum($id, 0, 1);
	        $mm = array();
        $mme = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
        for ($i=1; $i<=12;$i++)
        {
            $mm[$i] = $mme[ $i-1 ];
        }

        $yy = array();
        for ($i=date("Y"); $i <= date("Y")+10; $i++)
        {
            $yy[$i] = $i;
        }
        $this->mSmarty->assignByRef('mm', $mm);
        $this->mSmarty->assignByRef('yy', $yy);
		$this->mSmarty->assignByRef('album', $album);
		$this->mSmarty->assignByRef('countries', Countries::GetCountries($this->mCache));								
		$this->mSmarty->assign('id', $id);				
		}
		
		include_once 'model/Valid.class.php';
		
		if (!empty($_POST['fm']))
        {
			$this->validationcerditCard();
			if($cvv!='')		
			{
				error_reporting(E_ALL ^ E_DEPRECATED);
				if (!ereg('([0-9]{3})', $cvv))  
				{ 	
					$error = true;			
					$this->mSmarty->assign('errorcvv', PLEASE_ENTER_A_VALID_CVV_CODE );											
				} 	 
			}
			if($fm['phone'])
			{	
				$user_phone = Valid::Integer($fm, 'phone');
	
				if (empty($user_phone))
				{
				
					$this->mSmarty->assign('errorphone', PLEASE_SPECIFY_PHONE_NUMBER_AS_INTEGER );
				}
			}
/*			if($fm['zipcode'])
			{	
				$zip = Valid::Integer($fm, 'zipcode');
	
				if (empty($zip))
				{
					$this->mSmarty->assign('errorzipcode', 'Please specify zip code as integer');
				}
			}*/	
		if($cvv!=''){
		if(!preg_match('/^[0-3]{3}$/', $cvv)){
		 		$error = true;			
				$this->mSmarty->assign('errorcvv', PLEASE_ENTER_A_VALID_CVV_CODE);											
				$cvvvalidation = true;
			}else {
				$cvvvalidation = false;			
			} 
		}
					


		}
		
		
		

		if(isset($submit) && $error!=true && $cvv!='' && $userName!='' && $address!='' && $city!='' && $country!='' && $state!='' && $zipcode!='' && $phone!='' && $cvvvalidation!=true )
			{
		$MusicUserInfo = User::GetUserFullInfo($album['UserId']);
		$this->mSmarty->assign('ui', $MusicUserInfo);		
		$functioName	=	"musicpayment";
		//$this->PaypalPro($id,$album,$functioName,$type,$cardNumber,$cardExpiryMonth,$cardExpiryYear,$cvv,$cardHolder,$userName,$address,$city,$state,$zipcode);
		if($payMore)
			{
				if($album['Price']<=$payMore)
					{				
					$this->mSmarty->assign('musicAlbumId',$id );											
					$this->AuthorizeNet($id,$album,$functioName,$payMore,$cardHolder,$cardNumber,$cardExpiryMonth,$cardExpiryYear,$zipcode,$address);			
					if(!empty($_SESSION['PaymentError']['errs']['common'])){					
					$this->mSmarty->assign('musicAlbumMsgadded',$_SESSION['PaymentError']['errs']['common']);	
					unset($_SESSION['PaymentError']['errs']['common']);
					}					
					}
					else
					{
			
					$this->mSmarty->assign('musicAlbumMsgadded', ERROR_OOPS_NOT_LESS_THAN_PRICED_RATES .$album['Price'] );					
					}

	
			}
		else
			{
		$this->mSmarty->assign('musicAlbumId',$id );									
		$this->AuthorizeNet($id,$album,$functioName,$album['Price'],$cardHolder,$cardNumber,$cardExpiryMonth,$cardExpiryYear,$zipcode,$address);			
		if(!empty($_SESSION['PaymentError']['errs']['common'])){		
		$this->mSmarty->assign('musicAlbumMsgadded',$_SESSION['PaymentError']['errs']['common']);	
		unset($_SESSION['PaymentError']['errs']['common']);		
		}
			}	

			
			}

		$this->mSmarty->assign('musicAlbumId',$id );						
		$this->mSmarty->display('mods/profile/show_artist/checkoutFan.html');						
//		$this->mSmarty->display('mods/profile/show_artist/commonCheckout.html');						
		exit();
    
	}

	public function photoPayment()
	{
       $this->mSmarty->assign('module', 'photo');

	   $id = _v('id', 0);
       $payMore = _v('payMore');	
  	   $photo = Photo::GetPhoto($id);	 			 			 	   
		$fm  = $_POST['fm'];
		$cardHolder				=	mysql_escape_string(trim($_REQUEST['fm']['cardHolder']));
		$cardNumber				=	mysql_escape_string(trim($_REQUEST['fm']['cardNumber']));
		$type					=	mysql_escape_string(trim($_REQUEST['fm']['type']));
		$cardExpiryMonth		=	mysql_escape_string(trim($_REQUEST['fm']['cardExpiryMonth']));
		$cardExpiryYear			=	mysql_escape_string(trim($_REQUEST['fm']['cardExpiryYear']));
		$cvv					=	mysql_escape_string(trim($_REQUEST['fm']['cvv']));	
		$userName				=	mysql_escape_string(trim($_REQUEST['fm']['userName']));														
		$address				=	mysql_escape_string(trim($_REQUEST['fm']['address']));
		$city					=	mysql_escape_string(trim($_REQUEST['fm']['city']));
		$country				=	mysql_escape_string(trim($_REQUEST['fm']['country']));
		$state					=	mysql_escape_string(trim($_REQUEST['fm']['state']));
		$zipcode				=	mysql_escape_string(trim($_REQUEST['fm']['zipcode']));
		$phone					=	mysql_escape_string(trim($_REQUEST['fm']['phone']));										
		$submit			=	$_REQUEST['submit'];
		$error = false;
//		
	   
	   //geo for fan
      include_once 'libs/Geografy/Main.class.php';
      $this->mSmarty->assign('GeoIp', Model_Geografy_Main::GeoIPInit());
	    $ui =& $this->mUser->mOtherUserInfo;
	  
		
		  $purchase = PhotoPurchase::Get($this->mUser->mUserInfo['Id'], $id);		  
			$MusicUserInfo = User::GetUserFullInfo($photo['UserId']);
			$this->mSmarty->assign('ui', $MusicUserInfo);		

			 $mme = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
				for ($i=1; $i<=12;$i++)
				{
					$mm[$i] = $mme[ $i-1 ];
				}
		
				$yy = array();
				for ($i=date("Y"); $i <= date("Y")+10; $i++)
				{
					$yy[$i] = $i;
				}
				$this->mSmarty->assignByRef('mm', $mm);
				$this->mSmarty->assignByRef('yy', $yy);
				$this->mSmarty->assignByRef('photo', $photo);	
				$this->mSmarty->assignByRef('countries', Countries::GetCountries($this->mCache));								
				$this->mSmarty->assign('id', $id);			
		
	  include_once 'model/Valid.class.php';
			
	  if(empty($purchase))
	  {	 
	  
		if (!empty($_POST['fm']))
        {
			$this->validationcerditCard();
			if($cvv!='')		
			{
				error_reporting(E_ALL ^ E_DEPRECATED);
				if (!ereg('([0-9]{3})', $cvv))  
				{ 	
					$error = true;			
					$this->mSmarty->assign('errorcvv',PLEASE_ENTER_A_VALID_CVV_CODE );											
				} 		 
			}
			if($fm['phone'])
			{	
				$user_phone = Valid::Integer($fm, 'phone');
	
				if (empty($user_phone))
				{
				
					$this->mSmarty->assign('errorphone', PLEASE_SPECIFY_PHONE_NUMBER_AS_INTEGER );
				}
			}
/*			if($fm['zipcode'])
			{	
				$zip = Valid::Integer($fm, 'zipcode');
	
				if (empty($zip))
				{
					$this->mSmarty->assign('errorzipcode', 'Please specify zip code as integer');
				}
			}*/	
		if($cvv!=''){
		if(!preg_match('/^[0-3]{3}$/', $cvv)){
		 		$error = true;			
				$this->mSmarty->assign('errorcvv', PLEASE_ENTER_A_VALID_CVV_CODE);											
				$cvvvalidation = true;
			}else {
				$cvvvalidation = false;			
			} 
		}				
		}
		if(isset($submit) && $error!=true && $cvv!='' && $cvvvalidation!=true )
		{	
//		$this->mSmarty->assign('musicAlbumSuccessMsg',"Success Purchased" );									
		$functionName	=	"buyphoto";
	    $photo 	 = Photo::GetPhoto($id);	
        $payMore = _v('paywhatyoulike');					
		if($payMore>=$photo['Price']){ 
	   	if($payMore) {
		$price = $payMore;
		}else {
		$price = $photo['Price'];
		}
		$photo['Price'] = $price;
		//$this->PaypalPro($id,$album,$functioName,$type,$cardNumber,$cardExpiryMonth,$cardExpiryYear,$cvv,$cardHolder,$userName,$address,$city,$state,$zipcode);
		$this->AuthorizeNet($id,$photo,$functionName,$photo['Price'],$cardHolder,$cardNumber,$cardExpiryMonth,$cardExpiryYear,$zipcode,$address);
		if(!empty($_SESSION['PaymentError']['errs']['common']))
		{
		$this->mSmarty->assign('musicAlbumMsgadded',$_SESSION['PaymentError']['errs']['common']);	
		unset($_SESSION['PaymentError']['errs']['common']);		
		}
		}else { 
		$this->mSmarty->assign('musicAlbumMsgadded',ERROR_OOPS_NOT_LESS_THAN_PRICED_RATES . $photo['Price'] );									
		}
			}				
		}
	else
	{
		// already Added ...
		$this->mSmarty->assign('musicAlbumMsgadded', ALREADY_PHOTO_HAS_PURCHASED );		
	}	

	$this->mSmarty->display('mods/profile/show_artist/checkoutPhotoFan.html');				
	exit();
	}
	
	public function videopayment()
	{
        $this->mSmarty->assign('module', 'video');
		
		$id = _v('id', 0);
        $payMore = _v('payMore');		
		$video  = Video::GetVideoInfo($id);					
		$MusicUserInfo = User::GetUserFullInfo($video['UserId']);
		$this->mSmarty->assign('ui', $MusicUserInfo);				
		
		if($payMore) {
			$paywhatyoulike = $payMore;			
		$this->mSmarty->assignByRef('payMore',$payMore);			
		}else {
			$paywhatyoulike = $video['Price'];
		}
		
		
//
		$fm  = $_POST['fm'];
		$cardHolder				=	mysql_escape_string(trim($_REQUEST['fm']['cardHolder']));
		$cardNumber				=	mysql_escape_string(trim($_REQUEST['fm']['cardNumber']));
		$type					=	mysql_escape_string(trim($_REQUEST['fm']['type']));
		$cardExpiryMonth		=	mysql_escape_string(trim($_REQUEST['fm']['cardExpiryMonth']));
		$cardExpiryYear			=	mysql_escape_string(trim($_REQUEST['fm']['cardExpiryYear']));
		$cvv					=	mysql_escape_string(trim($_REQUEST['fm']['cvv']));	
		$userName				=	mysql_escape_string(trim($_REQUEST['fm']['userName']));														
		$address				=	mysql_escape_string(trim($_REQUEST['fm']['address']));
		$city					=	mysql_escape_string(trim($_REQUEST['fm']['city']));
		$country				=	mysql_escape_string(trim($_REQUEST['fm']['country']));
		$state					=	mysql_escape_string(trim($_REQUEST['fm']['state']));
		$zipcode				=	mysql_escape_string(trim($_REQUEST['fm']['zipcode']));
		$phone					=	mysql_escape_string(trim($_REQUEST['fm']['phone']));										
		$submit			=	$_REQUEST['submit'];
		$error = false;
//		
		
        $purchase = VideoPurchase::Get($this->mUser->mUserInfo['Id'], $id);	

		if(empty($purchase))
			{
		
		if($id)
			{
		$video  = Video::GetVideoInfo($id);					


	   $mme = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
        for ($i=1; $i<=12;$i++)
        {
            $mm[$i] = $mme[ $i-1 ];
        }

        $yy = array();
        for ($i=date("Y"); $i <= date("Y")+10; $i++)
        {
            $yy[$i] = $i;
        }
        $this->mSmarty->assignByRef('mm', $mm);
        $this->mSmarty->assignByRef('yy', $yy);
		$this->mSmarty->assign('video',$video);			
		$this->mSmarty->assignByRef('countries', Countries::GetCountries($this->mCache));								
		$this->mSmarty->assign('id', $id);			
			
			}
											
		include_once 'model/Valid.class.php';

		if (!empty($_POST['fm']))
        {
			$this->validationcerditCard();
			if($cvv!='')		
			{
				error_reporting(E_ALL ^ E_DEPRECATED);
				if (!ereg('([0-9]{3})', $cvv))  
				{ 	
					$error = true;			
					$this->mSmarty->assign('errorcvv', PLEASE_ENTER_A_VALID_CVV_CODE );											
				} 	 
			}
			if($fm['phone'])
			{	
				$user_phone = Valid::Integer($fm, 'phone');
	
				if (empty($user_phone))
				{
				
					$this->mSmarty->assign('errorphone', PLEASE_SPECIFY_PHONE_NUMBER_AS_INTEGER );
				}
			}

		if($cvv!=''){
		if(!preg_match('/^[0-3]{3}$/', $cvv)){
		 		$error = true;			
				$this->mSmarty->assign('errorcvv', PLEASE_ENTER_A_VALID_CVV_CODE );											
				$cvvvalidation = true;
			}else {
				$cvvvalidation = false;			
			} 
		}					
		
		}
		

	
	
	
		if(isset($submit) && $error!=true && $cvv!='' && $userName!='' && $address!='' && $city!='' && $country!='' && $state!='' && $zipcode!='' && $phone!='' && $cvvvalidation!=true )
			{

//			$this->mSmarty->assign('musicAlbumSuccessMsg',"Success Purchased" );												
			$functioName	=	"PurchaseVideo";
			$video  = Video::GetVideoInfo($id);	
			$MusicUserInfo = User::GetUserFullInfo($video['UserId']);			
			//				
			//$this->PaypalPro($id,$album,$functioName,$type,$cardNumber,$cardExpiryMonth,$cardExpiryYear,$cvv,$cardHolder,$userName,$address,$city,$state,$zipcode);
			$videoPurcheck = $this->AuthorizeNet($id,$video,$functioName,$paywhatyoulike,$cardHolder,$cardNumber,$cardExpiryMonth,$cardExpiryYear,$zipcode,$address);
			if($videoPurcheck)
				{
			$this->mSmarty->assign('PurchasedResult',$this->alreadyPurchased(SUCCESSFULLY_PURCHASED));		
				}
				else
				{
//			$this->mSmarty->assign('musicAlbumMsg',$_SESSION['PaymentError']['errs']['common']);		
		if(!empty($_SESSION['PaymentError']['errs']['common'])){
			$this->mSmarty->assign('musicAlbumMsg',$this->alreadyPurchased($_SESSION['PaymentError']['errs']['common']) );
			unset($_SESSION['PaymentError']['errs']['common']);	
			}						
				}
			}
			else
			{
			}
			
			
			}
			else
			{
				$video  = Video::GetVideoInfo($id);		
				$this->mSmarty->assign('id', $id);	
				$this->mSmarty->assign('video',$video);				
			// already purchased....
				$this->mSmarty->assign('musicAlbumMsg',$this->alreadyPurchased( ALREADY_VIDEO_HAS_PURCHASED ) );
			
			}


		$this->mSmarty->display('mods/profile/show_artist/checkoutVideoFan.html');				
		exit();
	
	
	}
	
	public function eventpayment()
	{
        $this->mSmarty->assign('module', 'events');
        $id = _v('id', 0);
		$this->mSmarty->assign('type', 'event');
        $purchase = EventPurchase::Get($this->mUser->mUserInfo['Id'], $id);
		if(empty($purchase))
			{
		        $event = Event::GetEvent($id);	
				//Start
				   $mme = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
					for ($i=1; $i<=12;$i++)
					{
						$mm[$i] = $mme[ $i-1 ];
					}			
					$yy = array();
					for ($i=date("Y"); $i <= date("Y")+10; $i++)
					{
						$yy[$i] = $i;
					}
					$this->mSmarty->assignByRef('mm', $mm);
					$this->mSmarty->assignByRef('yy', $yy);
					$this->mSmarty->assign('event',$event);	
					$this->mSmarty->assignByRef('countries', Countries::GetCountries($this->mCache));								
					$this->mSmarty->assign('id', $id);											
				//End
					$fm = $_POST['fm'];
				//validation start 
					if (!empty($_POST['fm']))
						{
							$error = $this->validationcerditCard();
						}
					//validation end					
					//submit with data start	
					if(isset($_POST['fm']) && $error!==true)
						{
					//$this->mSmarty->assign('musicAlbumSuccessMsg',"Success Purchased" );		
					$functioName	=	"PurchaseEventAccess";
					$event = Event::GetEvent($id);	
					$EventUserInfo = User::GetUserFullInfo($event['UserId']);
					$this->mSmarty->assign('ui', $EventUserInfo);						
					$payMore = _v('paywhatyoulike');					
					if($payMore>=$event['Price']){ 
					if($payMore) {
					$price = $payMore;
					}else {
					$price = $event['Price'];
					}
					$event['Price'] = $price;					
					
					
					$this->AuthorizeNet($id,$event,$functioName,$event['Price'],$fm['cardHolder'],$cardNumber,$cardExpiryMonth,$cardExpiryYear,$zipcode,$address);
					}else { 
					$this->mSmarty->assign('EventPriceMsg',ERROR_OOPS_NOT_LESS_THAN_PRICED_RATES . $event['Price'] );									
					}		
						}
						//submit with data end	
			}
		else
			{
				$event = Event::GetEvent($id);			
				$this->mSmarty->assign('event',$event);	
				$this->mSmarty->assign('EventmusicAlbumMsg',	$this->alreadyPurchased( ALREADY_EVENT_HAS_PURCHASED ));
			}							
		$this->mSmarty->display('mods/profile/show_artist/checkoutEventFan.html');				
		exit;
	
	}
	

		
	
public function	alreadyPurchased($err)
	{
	 $res['errs']	=			$err;
	 return  $res;
	}

public function paymentCurl($api_endpoint,$nvp_string)
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_VERBOSE, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		curl_setopt($curl, CURLOPT_URL, $api_endpoint);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $nvp_string);
		return $result = curl_exec($curl);
		curl_close($curl);

	}

public function NVPToArray($NVPString)
{
	$proArray = array();
	while(strlen($NVPString))
	{
		// name
		$keypos= strpos($NVPString,'=');
		$keyval = substr($NVPString,0,$keypos);
		// value
		$valuepos = strpos($NVPString,'&') ? strpos($NVPString,'&'): strlen($NVPString);
		$valval = substr($NVPString,$keypos+1,$valuepos-$keypos-1);
		// decoding the respose
		$proArray[$keyval] = urldecode($valval);
		$NVPString = substr($NVPString,$valuepos+1,strlen($NVPString));
	}
	return $proArray;
}

public function validateCC($cc_num, $type) {

	if($type == "American") {
	$denum = "American Express";
	} elseif($type == "Dinners") {
	$denum = "Diner's Club";
	} elseif($type == "Discover") {
	$denum = "Discover";
	} elseif($type == "MasterCard") {
	$denum = "MasterCard";
	} elseif($type == "Visa") {
	$denum = "Visa";
	}

	if($type == "American") {
	$pattern = "/^([34|37]{2})([0-9]{13})$/";//American Express
	if (preg_match($pattern,$cc_num)) {
	$verified = true;
	} else {
	$verified = false;
	}


	} elseif($type == "Dinners") {
	$pattern = "/^([30|36|38]{2})([0-9]{12})$/";//Diner's Club
	if (preg_match($pattern,$cc_num)) {
	$verified = true;
	} else {
	$verified = false;
	}


	} elseif($type == "Discover") {
	$pattern = "/^([6011]{4})([0-9]{12})$/";//Discover Card
	if (preg_match($pattern,$cc_num)) {
	$verified = true;
	} else {
	$verified = false;
	}


	} elseif($type == "Master") {
	$pattern = "/^([51|52|53|54|55]{2})([0-9]{14})$/";//Mastercard
	if (preg_match($pattern,$cc_num)) {
	$verified = true;
	} else {
	$verified = false;
	}


	} elseif($type == "Visa") {
	$pattern = "/^([4]{1})([0-9]{12,15})$/";//Visa
	if (preg_match($pattern,$cc_num)) {
	$verified = true;
	} else {
	$verified = false;
	}

	}

	if($verified == false) {
	//Do something here in case the validation fails
//	return  "Credit card invalid. Please make sure that you entered a valid <em>" . $denum . "</em> credit card ";

	} else { //if it will pass...do something
	return $error = false;
	
	}


	}



   public function buyphoto($id,$payMore)
   	{
       $this->mSmarty->assign('module', 'photo');
			
	$photo 	=	Photo::GetPhoto( $id );		
	if($payMore) {
		$price = $payMore;
	}else {
		$price = $photo['Price'];
	}
	
	$photo['Price'] = $price;
	$res = array('q' => OK , 'errs' => array());
        if (!$this->mUser->IsAuth())
        {
            $this->mlObj['mSession']->set('redirect', array('content' => 'album', 'id' => $id));
            $this->mlObj['mSession']->set('notice', YOU_HAVE_TO_BE_A_REGISTERED_ARTISTSFAN_COM_USER_TO . (!empty($album['Price']) ?  'buy' : 'add') . CONTENT_FROM_ARTISTS_PLEASE_SIGNUP_OR_SIGNIN_BELOW );
            $res['q'] = ERR;
            echo json_encode($res);
            exit();
        }
	$this->mlObj['mSession']->Del('redirect');
    $this->mlObj['mSession']->Del('notice');
	
	 if (!empty($photo))
      {




	  	$photosa = Photo::GetPhotoListWithPurchase('',$photo['UserId'], $_SESSION['system_uid'], $id, 1);
	if(empty($photosa))
      {			

		error_reporting(0);
		
		$alreadypurchaesed = Photo::GetCheckPurchasedPhoto($photo['UserId'],$_SESSION['system_uid']);			  	
		
		if($alreadypurchaesed['with_all_album'] == 1)
		 {
			$res['errs'][] = ($photo['Price'] > 0) ? THE_ALBUM_HAS_ALREADY_PURCHASED : THE_ALBUM_HAS_ALREADY_ADDED . $photo['UserId'];
			break;
		}
		if(empty($res['errs']))
		 {
      		$purchase = PhotoPurchase::Get($this->mUser->mUserInfo['Id'], $id);

	 
      if (empty($purchase))
            {	  
								// admin purchase  Start
								$adminPrice  = ($photo['Price'] * ADMIN_PRICE_PERCENT / 100);
								$artistPrice = ($photo['Price'] * ARTIST_PRICE_PERCENT / 100);	
								// admin purchase  End			
						 		 PhotoPurchase::Purchase($this->mUser->mUserInfo['Id'], $photo['Id'], $artistPrice);									
                                //buy/add music								
                               // MusicPurchase::Purchase($this->mUser->mUserInfo['Id'], $photo['Id'], $artistPrice, $photo['Id']);
								//$photo['Price']	=	$artistPrice;	
														   
	
			 


		if($photo['Price'] > 0)
		 {			
		 	$sum = $this->mUser->mUserInfo['Wallet'] - $photo['Price'];
			User::UpdateWallet($this->mUser->mUserInfo['Id'], $sum);
			//update artist's wallet

			$artist = User::GetphotoUser($photo['UserId']);
			$artist['Wallet']	=	$artist['wallet'];
			$artist['Id']		=	$artist['id'];
		if(empty($artist['Wallet']))
		 {
		 	$artist['Wallet'] = 0;
		 }

			$photo['Price']	=	$artistPrice;
			$artist['Wallet'] = $artist['Wallet'] + $photo['Price'];
			User::UpdateWallet($artist['Id'], $artist['Wallet']);
			//log
			$res['success'][] = SUCCESSFULLY_PURCHASED;		
			$res['photo_datas']	=	$photo;

								// admin purchase  Start
							$pc_type_name	 = 'BuyPhoto';
							$pc_type_id		 =	$photo['Id'];
							$pc_price		 =	$adminPrice;
							$pc_user_id	 	 =	$this->mUser->mUserInfo['Id'];	
							$pc_artist_id	 =  $photo['UserId'];							
							//$pc_description	 =	serialize(array('type' => 'PhotoPhoto', 'id' => $photo['Id'], 'title' => $photo['Title']));							
							$pc_description	 =	serialize(array('type' => 'PhotoPhoto', 'id' => $photo['Id'], 'title' => addslashes($photo['Title']),'Price'=>$photo['Price'],'commision  Price'=>$pc_price));								
							Payout::Admin_PurchaseInsert($pc_type_name,$pc_type_id,$pc_price,$pc_description,$pc_user_id,$pc_artist_id);
							// admin purchase  End
							

			 
			$userName = $this->mUser->mUserInfo['BandName'] ?  $this->mUser->mUserInfo['BandName'] :  $this->mUser->mUserInfo['FirstName'].' '. $this->mUser->mUserInfo['LastName'];		
//			$wallprice	=	$photo['Price']+$adminPrice;
//			$mesg	=	 "<a href=/u/".$this->mUser->mUserInfo['Name']." class=icon_03>{$userName}</a> just bought {artist} photo: ".$photo['Title'].' Price: $'.$wallprice;
			
$wallprice	=	sprintf("%0.2f",$photo['Price']+$adminPrice);	
$mesg	=	 '<a href="/u/'.$this->mUser->mUserInfo['Name'].'" class="icon_03">'.$userName.'</a> has purchased '.'<b>'.$photo['Title'].'</b>"'."<br/><font color=green><b>$".$wallprice."</b></font> From {artist} Photos";			
			
			$image	=	'files/photo/thumbs/'.$photo['UserId'].'/'.$photo['Image'];
  		    $wallConfirmation	=	 Wall::Add( $photo['UserId'],  $this->mUser->mUserInfo['Id'], $mesg, $image, $video, $timeline = 1, $mCache = '' );
			ShoppingLog::LogAdd($photo['UserId'], $this->mUser->mUserInfo['Id'], 'buy_photo', array('Id' => $photo['Id'], 'Title' => $photo['Title'], 'Price' => $photo['Price']), $this->mCache);
						$followers	=	Notification::GetFollowersid( $wallConfirmation, $comment_id='', $mesg='', $this->mUser->mUserInfo['Id'], $mCache = '' );						

						if($wallConfirmation){ Notification::Add( $wallConfirmation, $comment_id='', $mesg='', $photo['UserId'], $mCache = '' ); }			
								
										
		
			 
			//for artist transaction history
			Payout::PayoutMoney($photo['UserId'], 1, 0, $photo['Price'], $artist['Wallet'], $this->mUser->mUserInfo['Id'], 1, array('type' => 'photo', 'id' => $photo['Id'], 'title' => $photo['Title']));
			//for fan transaction history
			//Payout::PayoutMoney($this->mUser->mUserInfo['Id'], 0, 0, $photo['Price'], $sum, $this->mUser->mUserInfo['Id'], 1, array('type' => 'photo', 'id' => $photo['Id'], 'title' => $photo['Title'], 'user_id' => $photo['UserId']));
			}
			UserFollow::ChangeRating($this->mUser->mUserInfo['Id'], $photo['UserId'], $photo['Price'] > 0 ? 'buy_photo' : 'add_photo');
			$res['q'] = OK;
			//   $res['tracks'] = $tracks;
			
// Ebill via mail  start 
		if($this->mUser->mUserInfo['Email']) {

	                $this->mSmarty->assign('name', $this->mUser->mUserInfo['Name']);  
	                $this->mSmarty->assign('photorawdatas', $photo);
					$fromEmail = ADMIN_EMAIL;
					$fromName = SITE_NAME;
					$toEmail = $this->mUser->mUserInfo['Email'];
					$toName = $this->mUser->mUserInfo['Name'];
					$subject = PHOTO_PURCHASED_INFO_FROM;
					$message = $this->mSmarty->fetch('mails/photo-ebill.html');
					sendEmail($fromEmail,$fromName, $toEmail, $toName, $subject, $message);
					
			  }		
							
// Ebill via mail  End					
			

		}
		else
		{
		$res['errs'][] = ($music['Price'] > 0) ? ALREADY_PHOTO_HAS_PURCHASED : THE_PHOTO_HAS_ALREADY_ADDED;
		}	
			}
		}
		else
		{
			$res['errs'][] = THE_ALBUM_HAS_NO_PHOTOS;
		}
		}
//        echo json_encode($res);
		return $res;
  //      exit();
			
		


	
	}	


    public function PurchaseMusic()
    {
        $this->mSmarty->assign('module', 'music');
			
        $id = _v('id', 0);
        $payMore = _v('payMore');		
		$music = Music::GetMusic($id);
		if($payMore) {
			$paywhatyoulike = $payMore;			
		$this->mSmarty->assignByRef('payMore',$payMore);			
		}else {
			$paywhatyoulike = $music['Price'];
		}
			$music['Price']	=	$paywhatyoulike;

        $res = array('q' => OK , 'errs' => array());

        if (!$this->mUser->IsAuth())
        {
            $this->mlObj['mSession']->set('redirect', array('content' => 'track', 'id' => $id));
            $this->mlObj['mSession']->set('notice', YOU_HAVE_TO_BE_A_REGISTERED_ARTISTSFAN_COM_USER_TO . (!empty($music['Price']) ?  'buy' : 'add') . CONTENT_FROM_ARTISTS_PLEASE_SIGNUP_OR_SIGNIN_BELOW );
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
				
													// admin purchase  Start
								$adminPrice  = ($music['Price'] * ADMIN_PRICE_PERCENT / 100);
								$artistPrice = ($music['Price'] * ARTIST_PRICE_PERCENT / 100);	
								// admin purchase  End				
                                //buy/add music								
                                MusicPurchase::Purchase($this->mUser->mUserInfo['Id'], $music['Id'], $artistPrice, $music['Id']);
                    //buy music
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
						$music['Price']	=	$artistPrice;
                        $artist['Wallet'] = $artist['Wallet'] + $music['Price'];
                        User::UpdateWallet($artist['Id'], $artist['Wallet']);
						
													// admin purchase  Start
							$pc_type_name	 = 'PurchaseMusic';
							$pc_type_id		 =	$music['Id'];
							$pc_price		 =	$adminPrice;
							$pc_user_id		 =	$this->mUser->mUserInfo['Id'];	
							$pc_artist_id	 =  $music['UserId'];
							//$pc_description	 =	serialize(array('type' => 'PurchaseMusic', 'id' => $music['Id'], 'title' => $music['Title']));							
							$pc_description	 =	serialize(array('type' => 'PurchaseMusic', 'id' => $music['Id'], 'title' => addslashes($music['Title']),'Price'=>$music['Price'],'commision  Price'=>$pc_price));								
							Payout::Admin_PurchaseInsert($pc_type_name,$pc_type_id,$pc_price,$pc_description,$pc_user_id,$pc_artist_id);						
							// admin purchase  End

			$userName = $this->mUser->mUserInfo['BandName'] ?  $this->mUser->mUserInfo['BandName'] :  $this->mUser->mUserInfo['FirstName'].' '. $this->mUser->mUserInfo['LastName'];
			$wallprice	=	sprintf("%0.2f",$music['Price']+$adminPrice);	
			$mesg	=	 '<a href="/u/'.$this->mUser->mUserInfo['Name'].'" class="icon_03">'.$userName.'</a> has purchased '.'<b>'.$music['Title'].'</b>"'."<br/><font color=green><b>$".$wallprice."</b></font> From {artist} Music Tracks";
		//	$mesg	=	 "Music Track has purchased ".$music['Title'];
						//$image	=	'files/photo/thumbs/'.$photo['UserId'].'/'.$photo['Image'];
						$image	=	'i/ph/album-96x96.png';
						$wallConfirmation = Wall::Add( $music['UserId'],  $this->mUser->mUserInfo['Id'], $mesg, $image, $videos=0,$timeline = 1, $mCache = '' );
                        //log
                        ShoppingLog::LogAdd($music['UserId'], $this->mUser->mUserInfo['Id'], 'buy_track', array('Id' => $music['Id'], 'Title' => $music['Title'], 'Price' => $music['Price']), $this->mCache);
						$followers	=	Notification::GetFollowersid( $wallConfirmation, $comment_id='', $mesg='', $this->mUser->mUserInfo['Id'], $mCache = '' );						
						if($wallConfirmation){ Notification::Add( $wallConfirmation, $comment_id='', $mesg='', $music['UserId'], $mCache = '' ); }									

                        //for artist transaction history
                        Payout::PayoutMoney($music['UserId'], 1, 0, $music['Price'], $artist['Wallet'], $this->mUser->mUserInfo['Id'], 1, array('type' => 'track', 'id' => $music['Id'], 'title' => $music['Title']));
                        
                    }
                    //fan rating
                    UserFollow::ChangeRating($this->mUser->mUserInfo['Id'], $music['UserId'], ($music['Price'] > 0 ? 'buy_track' : 'add_track'));

                 

                    $res['q'] = OK;
                    $res['track'] = $music['Track'];
					
					$UserInfo = User::GetUserFullInfo($music['UserId']);					
					$res['ArtistName']	= $UserInfo['Name'];
					$this->mSession->Set('DownloadCode',true);													
					// Ebill via mail  start 
			if($this->mUser->mUserInfo['Email'])
			 {
	                $this->mSmarty->assign('name', $this->mUser->mUserInfo['Name']);  					
					$musicrawdatas =  Music::GetMusic($music['Id']);
	                $this->mSmarty->assign('musicrawdatas',$musicrawdatas);										
	                $this->mSmarty->assign('ArtistName', $UserInfo['Name']);															
					if( $this->mUser->mUserInfo['BandName']) {
					$toNameModify =  $this->mUser->mUserInfo['BandName'];
					}else{
					$toNameModify =  $this->mUser->mUserInfo['FirstName'].' '.$this->mUser->mUserInfo['LastName'];		
					}
	                $this->mSmarty->assign('ArtistBandname', ucfirst($toNameModify));															
					$fromEmail = ADMIN_EMAIL;
					$fromName = SITE_NAME;
					$toEmail = $this->mUser->mUserInfo['Email'];
					$toName = $toNameModify;
					$subject = MUSIC_PURCHASED_INFO_FROM;
					$message = $this->mSmarty->fetch('mails/music-ebill.html');					
					sendEmail($fromEmail,$fromName, $toEmail, $toName, $subject, $message);
					
					
			  }		
							
// Ebill via mail  End	
                

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
        //echo json_encode($res);
        //exit();
		return $res;
    }
		
	
    public function PurchaseAlbum()
    {  		
	    $this->mSmarty->assign('module', 'music');
        $id = _v('id', 0);
		$payMore = _v('payMore');		
        $album = MusicAlbum::GetAlbum($id);		
		if($payMore) {
			$paywhatyoulike = $payMore;			
		$this->mSmarty->assignByRef('payMore',$payMore);			
		}else {
			$paywhatyoulike = $album['Price'];
		}
			$album['Price']	=	$paywhatyoulike;

		
        $res = array('q' => OK, 'errs' => array());
        if (!$this->mUser->IsAuth())
        {
            $this->mlObj['mSession']->set('redirect', array('content' => 'album', 'id' => $id));
            $this->mlObj['mSession']->set('notice', YOU_HAVE_TO_BE_A_REGISTERED_ARTISTSFAN_COM_USER_TO . (!empty($album['Price']) ?  'buy' : 'add') .   CONTENT_FROM_ARTISTS_PLEASE_SIGNUP_OR_SIGNIN_BELOW );
            $res['q'] = ERR;
            echo json_encode($res);
            exit();
        }
        $this->mlObj['mSession']->Del('redirect');
        $this->mlObj['mSession']->Del('notice');
        if (!empty($album) && $album['Active'] == 1 && $album['Deleted'] != 1)
        {
            $music = Music::GetMusicListWithPurchase($album['UserId'], $this->mUser->mUserInfo['Id'], $id, 1);
			$albumbuyed	=	Music::GetMusicAlbumWithPurchase($this->mUser->mUserInfo['Id'],$id);					
			if($albumbuyed)
					{
						//sorry 						
					 	$res['errs'][] = ($album['Price'] > 0) ? THE_ALBUM_HAS_ALREADY_PURCHASED : THE_ALBUM_HAS_ALREADY_ADDED;
					}			

			
			 $tracks = array();
			if($music){
				 foreach($music as $item)
                {
							$albumbuyed	=	Music::GetMusicAlbumWithPurchase($this->mUser->mUserInfo['Id'],$id);					
							if($albumbuyed)
								{
								//sorry 
								
								 	$res['success'][] = ($album['Price'] > 0) ? THE_ALBUM_HAS_ALREADY_PURCHASED : THE_ALBUM_HAS_ALREADY_ADDED;


				
								}else
								{
                $sum = $this->mUser->mUserInfo['Wallet'] - $album['Price'];	
                User::UpdateWallet($this->mUser->mUserInfo['Id'], $sum);	
												
                $res['success'][] = THANKS_FOR_PURCHASING_MUSIC;					 
			    $artist = User::GetUser($album['UserId']);				
				$adminPrice  = ($album['Price'] * ADMIN_PRICE_PERCENT / 100);
				$artistPrice = ($album['Price'] * ARTIST_PRICE_PERCENT / 100);	
				MusicPurchase::Purchase($this->mUser->mUserInfo['Id'], 0, $artistPrice, $id);
				$album['Price']	=	$artistPrice;				
                $tracks[$item['Id']] = $item['Track'];				
				$artist['Wallet'] = $artist['Wallet'] + $artistPrice;
										
                User::UpdateWallet($artist['Id'], $artist['Wallet']);
				// admin purchase  Start
				$pc_type_name	 = 'PurchaseAlbum';
				$pc_type_id		 =	$album['Id'];
				$pc_price		 =	$adminPrice;
				$pc_user_id	 	 =	$this->mUser->mUserInfo['Id'];	
				$pc_artist_id	 =  $album['UserId'];							
				$pc_description	 =	serialize(array('type' => 'album', 'id' => $album['Id'], 'title' => addslashes($album['Title']),'Price'=>$album['Price'],'commision  Price'=>$pc_price));							
				Payout::Admin_PurchaseInsert($pc_type_name,$pc_type_id,$pc_price,$pc_description,$pc_user_id,$pc_artist_id);						
				// admin purchase  End
				//log

			$userName = $this->mUser->mUserInfo['BandName'] ?  $this->mUser->mUserInfo['BandName'] :  $this->mUser->mUserInfo['FirstName'].' '. $this->mUser->mUserInfo['LastName'];
			
			$wallprice	=	sprintf("%0.2f",$album['Price']+$adminPrice);

	//$mesg	=	 '<a href="/u/"'.$this->mUser->mUserInfo['Name'].' class="icon_03">'.$userName.'</a> just bought {artist} Music Album: '.$album['Title']."Price: $".$wallprice;
$mesg	=	 '<a href="/u/'.$this->mUser->mUserInfo['Name'].'" class="icon_03">'.$userName.'</a> has purchased '.'<b>'.$album['Title'].'</b>"'."<br/><font color=green><b>$".$wallprice."</b></font> From {artist} Music Album";
		//	$mesg	=	 "Music Track has purchased ".$music['Title'];
						//$image	=	'files/photo/thumbs/'.$photo['UserId'].'/'.$photo['Image'];
						//$image	=	$album['Image']; 
						$image	=	'';
						$wallConfirmation = Wall::Add( $album['UserId'],  $this->mUser->mUserInfo['Id'], $mesg, $image, $videos=0,$timeline = 1, $mCache = '' );				
				ShoppingLog::LogAdd($album['UserId'], $this->mUser->mUserInfo['Id'], 'buy_album', array('Id' => $album['Id'], 'Title' => $album['Title'], 'Price' => $album['Price']), $this->mCache);
						$followers	=	Notification::GetFollowersid( $wallConfirmation, $comment_id='', $mesg='', $this->mUser->mUserInfo['Id'], $mCache = '' );						
						if($wallConfirmation){ Notification::Add( $wallConfirmation, $comment_id='', $mesg='', $album['UserId'], $mCache = '' ); }							
				//for artist transaction history
				Payout::PayoutMoney($album['UserId'], 1, 0, $artistPrice, $artist['Wallet'], $this->mUser->mUserInfo['Id'], 1, array('type' => 'album', 'id' => $album['Id'], 'title' => $album['Title']));
				//for fan transaction history
				//Payout::PayoutMoney($this->mUser->mUserInfo['Id'], 0, 0, $album['Price'], $sum, $this->mUser->mUserInfo['Id'], 1, array('type' => 'album', 'id' => $album['Id'], 'title' => $album['Title'], 'user_id' => $album['UserId']));
							UserFollow::ChangeRating($this->mUser->mUserInfo['Id'], $album['UserId'], $album['Price'] > 0 ? 'buy_album' : 'add_album');
			$res['q'] = OK;
			$res['tracks'] = $tracks;
			$this->mSession->Set('DownloadCode',true);								
			$UserInfo = User::GetUserFullInfo($album['UserId']);					
			
			// Ebill via mail  start 
		if($this->mUser->mUserInfo['Email']) {
	                $this->mSmarty->assign('name', $this->mUser->mUserInfo['Name']);  
	                $this->mSmarty->assign('ArtistName', $UserInfo['Name']);  					
					$albumrawdatas = MusicAlbum::GetAlbum($album['Id']);
	                $this->mSmarty->assign('albumrawdatas', $albumrawdatas);
					if( $this->mUser->mUserInfo['BandName']) {
					$toNameModify =  $this->mUser->mUserInfo['BandName'];
					}else{
					$toNameModify =  $this->mUser->mUserInfo['FirstName'].' '.$this->mUser->mUserInfo['LastName'];		
					}
	                $this->mSmarty->assign('ArtistBandname', ucfirst($toNameModify));																														
					$fromEmail = ADMIN_EMAIL;
					$fromName = SITE_NAME;
					$toEmail = $this->mUser->mUserInfo['Email'];
					$toName = $toNameModify;					
					$subject = ALBUM_MUSIC_PURCHASED_INFO_FROM;
					$message = $this->mSmarty->fetch('mails/musicalbum-ebill.html');					
					sendEmail($fromEmail,$fromName, $toEmail, $toName, $subject, $message);
					
			  }		
							
// Ebill via mail  End	
					 
					 
					 }
				}
				

			
			//fan rating
			} else {
                $res['errs'][] = THE_ALBUM_HAS_NO_SONGS;
            }
			
        }
        else
        {
            $res['errs'][] = THE_ALBUM_NOT_FOUND;
        }
		return $res;
    }
	
    public function PurchaseVideo()
    {
        $this->mSmarty->assign('module', 'video');

    	$payMore=	_v('payMore');	
		$id 	= 	_v('id', 0);	
        $video  = Video::GetVideoInfo($id);
		if($payMore>=$video['Price']){ 
	if($payMore) {
		$price = $payMore;
	}else {
		$price = $video['Price'];
	}
	$video['Price'] = $price;
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
				
                    //buy/add video
					$adminPrice  = ($video['Price'] * ADMIN_PRICE_PERCENT / 100);
					$artistPrice = ($video['Price'] * ARTIST_PRICE_PERCENT / 100);	
					// admin purchase  End				
                    

                    VideoPurchase::Purchase($this->mUser->mUserInfo['Id'], $video['Id'], $artistPrice);
                   
                    if($video['Price'] > 0)
                    {
						
						//$res['errs'][] = 'Thanks For Purchasing This Video';
                        $sum = $this->mUser->mUserInfo['Wallet'] - $video['Price'];
                        //update wallet
                        User::UpdateWallet($this->mUser->mUserInfo['Id'], $sum);

                        //update artist's wallet
                        $artist = User::GetUser($video['UserId']);
                        if(empty($artist['Wallet']))
                        {
                            $artist['Wallet'] = 0;
                        }
						$video['Price']	=	$artistPrice;						
                        $artist['Wallet'] = $artist['Wallet'] + $video['Price'];
                        User::UpdateWallet($artist['Id'], $artist['Wallet']);						
			            $res['success'][] = SUCCESSFULLY_PURCHASED;	
						$VideoUserInfo = User::GetUserFullInfo($video['UserId']);											
			            $res['ArtistName'] = $VideoUserInfo['Name'];												
							// admin purchase  Start
							$pc_type_name	 = 'PurchaseVideo';
							$pc_type_id		 =	$video['Id'];
							$pc_price		 =	$adminPrice;
							$pc_user_id	 	 =	$this->mUser->mUserInfo['Id'];	
							$pc_artist_id	 =  $video['UserId'];							
							//$pc_description	 =	serialize(array('type' => 'PurchaseVideo', 'id' => $video['Id'], 'title' => $video['Title']));							
							$pc_description	 =	serialize(array('type' => 'PurchaseVideo', 'id' => $video['Id'], 'title' => addslashes($video['Title']),'Price'=>$video['Price'],'commision  Price'=>$pc_price));								
							Payout::Admin_PurchaseInsert($pc_type_name,$pc_type_id,$pc_price,$pc_description,$pc_user_id,$pc_artist_id);
							// admin purchase  End
							


                        //log
						

			$userName = $this->mUser->mUserInfo['BandName'] ?  $this->mUser->mUserInfo['BandName'] :  $this->mUser->mUserInfo['FirstName'].' '. $this->mUser->mUserInfo['LastName'];
	$wallprice	=	sprintf("%0.2f",$video['Price']+$adminPrice);	
$mesg	=	 '<a href="/u/'.$this->mUser->mUserInfo['Name'].'" class="icon_03">'.$userName.'</a> has purchased '.'<b>'.$video['Title'].'</b>"'."<br/><font color=green><b>$".$wallprice."</b></font> From {artist} videos";
                      
//						$mesg	=	 "Video has purchased ".$video['Title'];
						//$image	=	'files/video/thumbnail/'.$video['UserId'].'/s_'.$video['Video'].'.jpg';
						$image	=	'';
						$wallConfirmation	=	Wall::Add( $video['UserId'],  $this->mUser->mUserInfo['Id'], $mesg, $image, $videos='', $timeline=1, $mCache = '' );
  ShoppingLog::LogAdd($video['UserId'], $this->mUser->mUserInfo['Id'], 'buy_video', array('Id' => $video['Id'], 'Title' => $video['Title'], 'Price' => $video['Price']), $this->mCache);						
						
						$followers	=	Notification::GetFollowersid( $wallConfirmation, $comment_id='', $mesg='', $_SESSION['system_uid'], $mCache = '' );
						if($wallConfirmation){ Notification::Add( $wallConfirmation, $comment_id='', $mesg='', $video['UserId'], $mCache = '' ); }																					
                        //for artist transaction history
                        Payout::PayoutMoney($video['UserId'], 1, 0, $video['Price'], $artist['Wallet'], $this->mUser->mUserInfo['Id'], 1, array('type' => 'video', 'id' => $video['Id'], 'title' => $video['Title']));
                        //for fan transaction history
                    }
                    //fan rating
                    UserFollow::ChangeRating($this->mUser->mUserInfo['Id'], $video['UserId'], $video['Price'] > 0 ? 'buy_video' : 'add_video');
                    $res['q'] = OK;
					$this->mSession->Set('VideoDownloadCode',true);					
					$UserInfo = User::GetUserFullInfo($video['UserId']);										
// Ebill via mail  start 
		if($this->mUser->mUserInfo['Email']){
		
	                $this->mSmarty->assign('name', $this->mUser->mUserInfo['Name']);  
					$videorawdatas = Video::GetVideoInfo($id);
	                $this->mSmarty->assign('videorawdatas', $videorawdatas);															
	                $this->mSmarty->assign('ArtistName', $UserInfo['Name']);
					if( $this->mUser->mUserInfo['BandName']) {
					$toNameModify =  $this->mUser->mUserInfo['BandName'];
					}else{
					$toNameModify =  $this->mUser->mUserInfo['FirstName'].' '.$this->mUser->mUserInfo['LastName'];		
					}
	                $this->mSmarty->assign('ArtistBandname', ucfirst($toNameModify));										
					$fromEmail = ADMIN_EMAIL;
					$fromName = SITE_NAME;
					$toEmail = $this->mUser->mUserInfo['Email'];
					$toName = $toNameModify;
					$subject = VIDEO_PURCHASED_INFO_FROM;
					$message = $this->mSmarty->fetch('mails/video-ebill.html');
					sendEmail($fromEmail, $fromName,$toEmail, $toName, $subject, $message);
					
			  }		
							
// Ebill via mail  End						
                
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
		}
		else{
            $res['validatepriceerrs'] = ERROR_OOPS_NOT_LESS_THAN_PRICED_RATES . $video['Price'] ;		
            $res['validateprice'] = true;					
		}
		return $res;
//        echo json_encode($res);

    }
	
    public function PurchaseEventAccess()
    {
        $this->mSmarty->assign('module', 'events');
			
        $id = _v('id', 0);
		$payMore = _v('payMore');				
        $event = Event::GetEvent($id);
		
		if($payMore) {
			$paywhatyoulike = $payMore;			
		$this->mSmarty->assignByRef('payMore',$payMore);			
		}else {
			$paywhatyoulike = $event['Price'];
		}
			$event['Price']	=	$paywhatyoulike;
		
		$artisttoartist	=	$_REQUEST['artist_to_artist'];
        $res = array('q' => OK , 'errs' => array());
		//$sum = $this->mUser->mUserInfo['Wallet'] - $event['Price'];
        //update user's wallet
        //User::UpdateWallet($this->mUser->mUserInfo['Id'], $sum);
                        $sum = $this->mUser->mUserInfo['Wallet'] - $event['Price'];
                        //update user's wallet
                        User::UpdateWallet($this->mUser->mUserInfo['Id'], $sum);
		
		
		$adminPrice  = ($event['Price'] * ADMIN_PRICE_PERCENT / 100);
		$artistPrice = ($event['Price'] * ARTIST_PRICE_PERCENT / 100);	
		$event['Price']	=	$artistPrice;
		
        if (!$this->mUser->IsAuth())
        {
            $this->mlObj['mSession']->set('redirect', array('content' => 'event', 'id' => $id, 'act' => 'access'));
            $this->mlObj['mSession']->set('notice', YOU_HAVE_TO_BE_A_REGISTERED_ARTISTSFAN_COM_USER_TO . (!empty($event['Price']) ?  'buy' : 'add') . CONTENT_FROM_ARTISTS_PLEASE_SIGNUP_OR_SIGNIN_BELOW );
            $res['q'] = ERR;
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
						
													// admin purchase  Start
							$pc_type_name	 = 'PurchaseVideo';
							$pc_type_id		 =	$event['Id'];
							$pc_price		 =	$adminPrice;
							$pc_user_id	 	 =	$this->mUser->mUserInfo['Id'];	
							$pc_artist_id	 =  $event['UserId'];							
							//$pc_description	 =	serialize(array('type' => 'PurchaseVideo', 'id' => $video['Id'], 'title' => $video['Title']));														
							$pc_description	 =	serialize(array('type' => 'event', 'id' => $event['Id'], 'title' => addslashes($event['Title']),'Price'=>$event['Price'],'commision  Price'=>$pc_price));								
							Payout::Admin_PurchaseInsert($pc_type_name,$pc_type_id,$pc_price,$pc_description,$pc_user_id,$pc_artist_id);
							// admin purchase  End

						//
						
			$userName = $this->mUser->mUserInfo['BandName'] ?  $this->mUser->mUserInfo['BandName'] :  $this->mUser->mUserInfo['FirstName'].' '. $this->mUser->mUserInfo['LastName'];
			$wallprice	=	sprintf("%0.2f",$event['Price']+$adminPrice);	
$mesg	=	 '<a href="/u/'.$this->mUser->mUserInfo['Name'].'" class="icon_03">'.$userName.'</a> has purchased '.'<b>'.$event['Title'].'</b>"'."<br/><font color=green><b>$".$wallprice."</b></font> From {artist} Events";                      
//						$mesg	=	 "Video has purchased ".$video['Title'];
						//$image	=	'files/video/thumbnail/'.$video['UserId'].'/s_'.$video['Video'].'.jpg';
						$image	=	'';
						$wallConfirmation	=	Wall::Add( $event['UserId'],  $this->mUser->mUserInfo['Id'], $mesg, $image, $videos='', $timeline=1, $mCache = '' );
                        ShoppingLog::LogAdd($event['UserId'], $this->mUser->mUserInfo['Id'], 'buy_access', array('Id' => $event['Id'], 'Title' => $event['Title'], 'Price' => $event['Price']), $this->mCache);
						
						$followers	=	Notification::GetFollowersid( $wallConfirmation, $comment_id='', $mesg='', $_SESSION['system_uid'], $mCache = '' );
						if($wallConfirmation){ Notification::Add( $wallConfirmation, $comment_id='', $mesg='', $event['UserId'], $mCache = '' ); }									
								
						//
						
                        $artist['Wallet'] = $artist['Wallet'] + $event['Price'];
                        $artist['WalletBlock'] = $artist['WalletBlock'] + $event['Price'];
                        User::UpdateWallet($artist['Id'], $artist['Wallet'], $artist['WalletBlock']);
						
		                $res['success'][] 	= THANKS_FOR_PURCHASING_EVENT;
						$res['artist'][]	=		$artisttoartist;
                        //log


                        //for artist transaction history
                        Payout::PayoutMoney($event['UserId'], 1, 0, $event['Price'], $artist['Wallet'], $this->mUser->mUserInfo['Id'], 1, array('type' => 'event', 'id' => $event['Id'], 'title' => $event['Title']));
                        //for fan transaction history
                       // Payout::PayoutMoney($this->mUser->mUserInfo['Id'], 0, 0, $event['Price'], $sum, $this->mUser->mUserInfo['Id'], 1, array('type' => 'event', 'id' => $event['Id'], 'title' => $event['Title'], 'user_id' => $event['UserId']));
                    }
                    //fan rating
                    UserFollow::ChangeRating($this->mUser->mUserInfo['Id'], $event['UserId'], $event['Price'] > 0 ? 'add_access' : 'buy_access');

                    $res['q'] = OK;
					$this->mSession->Set('DownloadCode',true);													
// Ebill via mail  start 
		if($this->mUser->mUserInfo['Email']) {		
	                $this->mSmarty->assign('name', $this->mUser->mUserInfo['Name']);  
					$eventrawdatas = Event::GetEvent($event['Id']);					
	                $this->mSmarty->assign('eventrawdatas', $eventrawdatas);										
	                $this->mSmarty->assign('ArtistUserInfo', $this->mUser->mUserInfo);					
	                $this->mSmarty->assign('ArtistName', $artisttoartist);
					$fromEmail = ADMIN_EMAIL;
					$fromName = SITE_NAME;
					$toEmail = $this->mUser->mUserInfo['Email'];
					$toName = $this->mUser->mUserInfo['Name'];
					$subject = EVENT_PURCHASED_INFO_FROM;
					$message = $this->mSmarty->fetch('mails/event_ticket_info_mail.html');
					sendEmail($fromEmail,$fromName, $toEmail, $toName, $subject, $message);					
			  }		
							
// Ebill via mail  End					
					
					
                

            }
            else
            {
		        $res['q'] = OK;
                $res['errs'][] = ($event['Price'] > 0) ? THE_ACCESS_HAS_ALREADY_PURCHASED : THE_ACCESS_HAS_ALREADY_GOTTEN;
            }
        }
       // echo json_encode($res);
        //exit();
		return $res;
    }
public function PaypalPro($id,$album,$functioName,$type,$cardNumber,$cardExpiryMonth,$cardExpiryYear,$cvv,$cardHolder,$userName,$address,$city,$state,$zipcode)
	{

			// here verify the ceridt card and type
            include_once 'libs/Paypal/PaymentPro/config.php';
		    $request_params = array
					(
					'METHOD' => 'DoDirectPayment', 
					'USER' => $api_username, 
					'PWD' => $api_password, 
					'SIGNATURE' => $api_signature, 
					'VERSION' => $api_version, 
					'PAYMENTACTION' => 'Sale', 					
					'IPADDRESS' => $_SERVER['REMOTE_ADDR'],
					'CREDITCARDTYPE' => $type, 
					'ACCT' => $cardNumber, 						
					'EXPDATE' => $cardExpiryMonth.$cardExpiryYear, 			
					'CVV2' => $cvv, 
					'FIRSTNAME' =>$cardHolder , 
					'LASTNAME' =>$userName , 
					'STREET' =>$address , 
					'CITY' =>$city , 
					'STATE' => $state, 					
					'COUNTRYCODE' => 'US', 
					'ZIP' => $zipcode, 
					'AMT' =>$album['Price'] , 
					'CURRENCYCODE' => 'USD', 
					'DESC' => 'Music Album Payment' 
					);
					
				// Loop through $request_params array to generate the NVP string.
				$nvp_string = '';
				foreach($request_params as $var=>$val)
				{
					$nvp_string .= '&'.$var.'='.urlencode($val);	
				}
				
				$result 		= $this->paymentCurl($api_endpoint,$nvp_string);
				$paymenyResult	= $this->NVPToArray($result);	
					if(strtolower($paymenyResult['ACK'])=='failure')
					{
					
					}
				if(strtolower($paymenyResult['ACK'])=='success')
					{	
						//insert database function 
								/*$key = "artisifan UsaWeb rulez!";
								$message = "UsaWeb rulez!";
								$rc4 = new Security_Rc4();
								$rc4->key($key);
								$rc4->crypt($message);		
								$rc4->decrypt($message);*/
								
						if($functioName=="musicTrack")
							{
						$this->mSmarty->assign('musicAlbumMsg',$this->PurchaseMusic() );
						$this->mSmarty->display('mods/profile/show_artist/musicTrackCheckout.html');			
						exit;
						
							}
						if($functioName=="musicpayment")
							{
						$this->mSmarty->assign('musicAlbumMsg',$this->PurchaseAlbum() );
						$this->mSmarty->display('mods/profile/show_artist/checkoutFan.html');												
						exit;
						
							}
							
							
					
					}
					
	}
	
public function AuthorizeNet($id,$album,$functioName,$albumPrice,$cardHolder,$cardNumber,$cardExpiryMonth,$cardExpiryYear,$zipcode,$address)
	{
				$fm['amount']			=	$albumPrice;
				$fm['cardHolder']		=	$cardHolder;
				$fm['cardNumber']		=	$cardNumber;			
				$fm['cardExpiryMonth']	=	$cardExpiryMonth;
				$fm['cardExpiryYear']	=	$cardExpiryYear;
				$fm['avsZip']			=	$zipcode;
				$fm['avsAddress']		=	$address;			
                //do request to authorizenet payment

                $fm['trackingMemberCode'] = md5(mktime() . rand(11, 99)); //unique code
				require_once(BPATH.'libs/AuthorizeNet/AuthorizeNet.php');
                $transaction = new AuthorizeNetAIM(API_LOGIN_ID, TRANSACTION_KEY);
				$transaction->cust_id = $this->mUser->mUserInfo['Id'];
				$transaction->first_name = $fm['cardHolder'];
				//$transaction->last_name = $value['csp_cclastname'];
				$transaction->amount = $fm['amount'];
				$transaction->card_num = $fm['cardNumber'];
				$transaction->exp_date = sprintf('%02d/%d', $fm['cardExpiryMonth'], $fm['cardExpiryYear']);
				$transaction->zip = $fm['avsZip'];
				$transaction->address = $fm['avsAddress'];
				$transaction->invoice_num = $fm['trackingMemberCode'];
				$response = $transaction->authorizeAndCapture();
                if ($response->approved) {
                    //payment success - update user wallet
                    $sum = $this->mUser->mUserInfo['Wallet'] + $fm['amount'];
                    User::UpdateWallet($this->mUser->mUserInfo['Id'], $sum);
                    //create transaction for transaction history
                    $tid = Payout::PayoutMoney($this->mUser->mUserInfo['Id'], 1, 0, $fm['amount'], $sum, $this->mUser->mUserInfo['Id'], 1, array('type' => 'price', 'TransactionId' => $response->transaction_id, 'TransactionGuid' => $response->invoice_number));
                    
                    $res['ballance'] = $sum;
                    $res['q'] = OK;

                    //for generate redurect url need new value of user wallet
                    $this->mUser->mUserInfo['Wallet'] = $this->mUser->mUserInfo['Wallet'] + $fm['amount'];

///

/*						if($functioName=="musicTrack")
							{
						$this->mSmarty->assign('id', $id);								
						$this->mSmarty->assign('musicAlbumMsg',$this->PurchaseMusic() );
						$this->mSmarty->display('mods/profile/show_artist/musicTrackCheckout.html');			
						exit;
						
							}
						if($functioName=="musicpayment")
							{
						$this->mSmarty->assign('id', $id);								
						$this->mSmarty->assign('musicAlbumMsg',$this->PurchaseAlbum() );
						$this->mSmarty->display('mods/profile/show_artist/checkoutFan.html');												
						exit;						
							}
						if(strtolower($functioName)=="buyphoto")
							{
				        $payMore = _v('payMore', 0);
						$this->mSmarty->assign('id', $id);								
						$this->mSmarty->assign('musicAlbumMsg',$this->buyphoto($id,$payMore) );
						$this->mSmarty->display('mods/profile/show_artist/checkoutPhotoFan.html');												
						exit;					
							}

						if($functioName=="PurchaseVideo")
							{
						$this->mSmarty->assign('id', $id);	
						$this->mSmarty->assign('video',$album);	
						$this->mSmarty->assign('musicAlbumMsg',$this->PurchaseVideo() );
						$this->mSmarty->display('mods/profile/show_artist/checkoutVideoFan.html');												
						exit;
							}
						if($functioName=="PurchaseEventAccess")
							{
						$this->mSmarty->assign('id', $id);	
						$this->mSmarty->assign('event',$album);	
						$this->mSmarty->assign('musicAlbumMsg',$this->PurchaseEventAccess() );
						//$this->mSmarty->display('mods/profile/show_artist/checkoutEventFan.html');												
						
						$this->mSmarty->display('mods/profile/show_artist/checkout.html');																		
						exit;
							}*/
						return true;	

                } elseif($response->declined) {
						
                    //payment error - transaction in payvision created
                    //create error transaction for transaction history
                    $tid = Payout::PayoutMoney($this->mUser->mUserInfo['Id'], 1, 0, $fm['amount'], $this->mUser->mUserInfo['Wallet'], $this->mUser->mUserInfo['Id'], 2, array('type' => 'points', 'TransactionId' => $response->transaction_id, 'TransactionGuid' => $response->purchase_order_number));
                    $res['q'] = CANCEL;
                    $res['errs']['common'] = !empty($response->error_message) ? $response->error_message : ERROR_IN_PAYMENT_PROCESS;
					$_SESSION['PaymentError']	=	$res;
					return false;
                } else {
                    //payment error - transaction in payvision not created
                    $res['errs']['common'] = !empty($response->error) ? $response->error : ERROR_IN_PAYMENT_PROCESS;
					$_SESSION['PaymentError']	=	$res;					
					return false;					
                }
            
	}
	


}
?>
