<?php
/**
 * Admin panel module
 * User: ssergy
 * Date: 20.12.11
 * Time: 16:42
 * 
 */
 
class Base_Admin extends Base
{
    public function __construct($glObj)
    {
        parent :: __construct($glObj);

        if(!$this->mUser->CheckAdminStatus())
        {
            uni_redirect( PATH_ROOT . 'base/user/AdminLogin' );
        }

        $this->mSmarty->assign('SITE_NAME', SITE_NAME);
    }


    /**
     * Main admin page
     * @return void
     */
    public function Index()
    {   
        //show template
        $this->mSmarty->assign('amodule', 'main');
        $this->mSmarty->display('mods/admin/index/main.html');
    }

    /**
     * Admin transactions list
     * @return void
     */
    public function Payments()
    {
        $tp = _v('tp', 0);
        if(!in_array($tp, array(0, 1, 2)))
        {
            $tp = 0;
        }
        $this->mSmarty->assign('tp', $tp);
        $this->mSmarty->assign('pcnt', !empty($_SESSION['ppcnt']) ? $_SESSION['ppcnt'] : 10);
        $this->mSmarty->assign('no_right', 1);

        //statuses
        $this->mSmarty->assignByRef('statuses', Payout::StatusesList());
        
        //show template
        $this->mSmarty->assign('amodule', 'payments');
        $this->mSmarty->display('mods/admin/payments/_list.html');
    }

    /**
     * Ajax payments list
     * @return void
     */
    public function PaymentsList()
    {       
        $res = array('q' => OK );

        $page = _v('page', 1);
        $tp = _v('tp', 0);
		

        $pcnt = _v('pcnt', !empty($_SESSION['ppcnt']) ? $_SESSION['ppcnt'] : 10);
        $_SESSION['ppcnt'] = $pcnt;
		if($tp== 0 || $tp== 1)
			{
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
                            $filters .= ($filters ? ' AND ' : '') . '(u.email LIKE "%' . $v . '%")';
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
                                    $sq .= (!$sq ? '' : ' AND ') . '(u.first_name LIKE "%' . $v2 . '%" OR u.last_name LIKE "%' . $v2 . '%" OR u.name LIKE "%' . $v2 . '%" OR u.band_name LIKE "%' . $v2 . '%")';
                                }
                            }
                            if ($sq)
                            {
                                $filters .= ($filters ? ' AND ' : '') . '('.$sq.')';
                            }
                        }
                        break;

                    case 'status':
                        $v = (int) $v;
                        if ($v != -1)
                        {
                            $filters .= ($filters ? ' AND ' : '') . '(payout.status = ' . $v . ')';
                        }
                        break;
                    case 'ptype':
                        $v = (int) $v;
                        if ($v != -1)
                        {
                            $filters .= ($filters ? ' AND ' : '') . '(payout.ptype = ' . $v . ')';
                        }
                        break;
                    case 'dfrom':
                        if ($v)
                        {
                            $dc = explode('/', $v);
                            if (3 == count($dc) && $dc[0] >= 1 && $dc[0] <= 12 && $dc[1] >= 1 && $dc[1] <= 31
                                && $dc[2] >= date("Y") - 5 && $dc[2] <= date("Y")
                            )
                            {
                                $dc = mktime(0, 0, 0, $dc[0], $dc[1], $dc[2]);
                                $filters .= ($filters ? ' AND ' : '') . '(payout.pdate >= '.$dc.')';
                            }
                        }
                        break;
                    case 'dto':
                        if ($v)
                        {
                            $dc = explode('/', $v);
                            if (3 == count($dc) && $dc[0] >= 1 && $dc[0] <= 12 && $dc[1] >= 1 && $dc[1] <= 31
                                && $dc[2] >= date("Y") - 5 && $dc[2] <= date("Y")
                            )
                            {
                                $dc = mktime(23, 59, 59, $dc[0], $dc[1], $dc[2]);
                                $filters .= ($filters ? ' AND ' : '') . '(payout.pdate <= '.$dc.')';
                            }
                        }
                        break;
                }
            }
        }

        if($tp == 1)
        {
            //payout requests
            $filters .= ($filters ? ' AND ' : '') . '(payout.user_from = 0 AND payout.ptype = 0 AND payout.status = 0)';
        }

        $list = Payout::AdminPaymentsList($page, $pcnt, $filters);
        $rcnt = $list['rcnt'];
        $list = $list['list'];
        if($tp == 1)
        {
            //payment info for payout requests
            $pids = array();
            foreach($list as $item)
            {
                if(!in_array($item['PaymentInfoId'], $pids))
                {
                    $pids[] = $item['PaymentInfoId'];
                }
            }
            if(!empty($pids))
            {
                $pinfo = PaymentInfo::GetListPaymentInfo($pids);
                unset($pids);
                $pinfo1 = array();
                foreach($pinfo as $item)
                {
                    $pinfo1[$item['Id']] = $item;
                }
                unset($item);
                unset($pinfo);

                foreach($list as &$item)
                {
                    $item['PaymentInfo'] = !empty($pinfo1[$item['PaymentInfoId']]) ? $pinfo1[$item['PaymentInfoId']] : array();
                }
                unset($item);
                unset($pinfo1);
            }
        }
        include_once 'model/Pagging.class.php';
        $link = 'oAdmin.PaymentsList';
        $mpg = new Pagging($pcnt, $rcnt, $page, $link);
        $res['pagging'] = $mpg->Make($this->mSmarty, 1);
        $res['page'] = $page;

        $this->mSmarty->assign('tp', $tp);
        $this->mSmarty->assignByRef('list', $list);
        $this->mSmarty->assignByRef('account_types', PaymentInfo::AccountTypesList());
        $this->mSmarty->assignByRef('statuses', Payout::StatusesList());
        $this->mSmarty->assignByRef('methods', Payout::MethodsList());
        $res['data'] = $this->mSmarty->Fetch('mods/admin/payments/ajax/_list_ajax.html');
		}
		else
		{
			$list = Payout::Admin_PurchaseShow();

			foreach($list as &$item)
	        {
				$item['data_serialize'] = unserialize($item['pc_description']);
			}		
			$this->mSmarty->assign('tp', $tp);					
        	$this->mSmarty->assignByRef('list', $list);	
			$res['data'] 	= $this->mSmarty->Fetch('mods/admin/payments/ajax/_commision_list_ajax.html');						
		}
		echo json_encode($res);
        exit();
    }

    /**
     * Ajax decline/accept payout
     */
    public function PaymentChangeStatus()
    {
        $res = array('q' => OK );
        $id = _v('id', 0);
        $status = _v('status', 0);

        if($id && in_array($status, array(1, 3)))
        {
            $payout = Payout::GetOne($id);
			if(!empty($payout))
            {
				
				if(strtolower($payout['Description']['mode'])=='paypal')
					{
				
					$preappreovaladmindetails = AdaptivePayment::getLastUpdatedRecord();				
					$actionType = 'PAY';
					$cancelUrl	=	'http://artistfan.usawebdept.com/base/admin/prepaymentCancel';
					$currencyCode	=	'USD';
					$returnUrl	=	'http://artistfan.usawebdept.com/base/admin/prepaymentSuccess';					
					//$feesPayer	=	$preappreovaladmindetails['ap_sender_email'];
				
					$feesPayer	=	'';					
					$ipnNotificationUrl	=	'';
					$memo	=	ADMIN_TO_ARTIST_PAYMENT;
					$pin	=	'';
					//pull from db 
					$preapprovalKey	=	$preappreovaladmindetails['ap_approval_key'];
					$reverseAllParallelPaymentsOnError	=	'';
					$senderEmail	=	$preappreovaladmindetails['ap_sender_email'];
					$trackingId	=	'';
					$fundingConstraint	=	'';
					$emailIdentifier	=	'';
					$senderCountryCode	=	'';
					$senderPhoneNumber	=	'';
					$senderExtension	=	'';
					$useCredentials		=	'';	
					
										
					//pull for db paypal Email Id 

					$receiver_email = PaymentInfo::GetListPaymentInfo($payout['PaymentInfoId']);					
					$receiverEmail	=	$receiver_email[0]['PaypalId'];
					$receiverAmount	=	$payout['Money'];
					$primaryReceiver = false;	
					$invoiceId	=	'';
					$paymentType	=	'';
					$paymentSubType	=	'';
					$phoneNumber	=	'';
					$phoneExtn		=	'';
					// pre approaval start 

		$path = '../lib';
		set_include_path(get_include_path() . PATH_SEPARATOR . $path);
		require_once('libs/Paypal/SDK/lib/services/AdaptivePayments/AdaptivePaymentsService.php');
		require_once('libs/Paypal/SDK/lib/PPLoggingManager.php');
		require_once('libs/Paypal/SDK/lib/Common/Constants.php');
		
		define("DEFAULT_SELECT", "- Select -");
		
		$logger = new PPLoggingManager('Pay');
		if(isset($receiverEmail)) {
			$receiver = array(); 
			

			 
				$receiver[0] = new Receiver();
				$receiver[0]->email = $receiverEmail;
				$receiver[0]->amount = $receiverAmount;
				$receiver[0]->primary = $primaryReceiver;
		
				if($invoiceId != "") {
					$receiver[0]->invoiceId = $invoiceId;
				}
				if($paymentType != "" && $paymentType != DEFAULT_SELECT) {
					$receiver[0]->paymentType = $paymentType;
				}
				if($paymentSubType != "") {
					$receiver[0]->paymentSubType = $paymentSubType;
				}
				if($phoneCountry != "" && $phoneNumber) {
					$receiver[0]->phone = new PhoneNumberType($phoneCountry, $phoneNumber);
					if($phoneExtn != "") {
						$receiver[0]->phone->extension = $phoneExtn;
					}
				}
			
			
			
			$receiverList = new ReceiverList($receiver);
		}
		
		/*
		$actionType = '';
		$cancelUrl	=	'';
		$currencyCode	=	'';
		$returnUrl	=	'';
		
		$feesPayer	=	'';
		$ipnNotificationUrl	=	'';
		$memo	=	'';
		$pin	=	'';
		$preapprovalKey	=	'';
		$reverseAllParallelPaymentsOnError	=	'';
		$senderEmail	=	'';
		$trackingId	=	'';
		$fundingConstraint	=	'';
		$emailIdentifier	=	'';
		$senderCountryCode	=	'';
		$senderPhoneNumber	=	'';
		$senderExtension	=	'';
		$useCredentials		=	'';
		*/
		
		
		
		$payRequest = new PayRequest(new RequestEnvelope("en_US"), $actionType, $cancelUrl, $currencyCode, $receiverList, $returnUrl);
		// Add optional params
		if($feesPayer != "") {
			$payRequest->feesPayer = $feesPayer;
		}
		if($preapprovalKey != "") {
			$payRequest->preapprovalKey  = $preapprovalKey;
		}
		if($ipnNotificationUrl != "") {
			$payRequest->ipnNotificationUrl = $ipnNotificationUrl;
		}
		if($memo != "") {
			$payRequest->memo = $memo;
		}
		if($pin != "") {
			$payRequest->pin  = $pin;
		}
		if($preapprovalKey != "") {
			$payRequest->preapprovalKey  = $preapprovalKey;
		}
		if($reverseAllParallelPaymentsOnError != "") {
			$payRequest->reverseAllParallelPaymentsOnError  = $reverseAllParallelPaymentsOnError;
		}
		if($senderEmail != "") {
			$payRequest->senderEmail  = $senderEmail;
		}
		if($trackingId != "") {
			$payRequest->trackingId  = $trackingId;
		}
		if($fundingConstraint != "" && $fundingConstraint != DEFAULT_SELECT) {
			$payRequest->fundingConstraint = new FundingConstraint();
			$payRequest->fundingConstraint->allowedFundingType = new FundingTypeList();
			$payRequest->fundingConstraint->allowedFundingType->fundingTypeInfo = array();
			$payRequest->fundingConstraint->allowedFundingType->fundingTypeInfo[]  = new FundingTypeInfo($fundingConstraint);
		}
		
		if($emailIdentifier != "" || $senderCountryCode != "" || $senderPhoneNumber != "" 
				|| $senderExtension != "" || $useCredentials != "" ) {
			$payRequest->sender = new SenderIdentifier();
			if($emailIdentifier != "") {
				$payRequest->sender->email  = $emailIdentifier;
			}
			if($senderCountryCode != "" || $senderPhoneNumber != "" || $senderExtension != "") {
				$payRequest->sender->phone = new PhoneNumberType();
				if($senderCountryCode != "") {
					$payRequest->sender->phone->countryCode  = $senderCountryCode;
				}
				if($senderPhoneNumber != "") {
					$payRequest->sender->phone->phoneNumber  = $senderPhoneNumber;
				}
				if($senderExtension != "") {
					$payRequest->sender->phone->extension  = $senderExtension;
				}
			}
			if($useCredentials != "") {
				$payRequest->sender->useCredentials  = $useCredentials;
			}
		}
		$service = new AdaptivePaymentsService();
		try {
			$response = $service->Pay($payRequest);
		} catch(Exception $ex) {
//			require_once 'Common/Error.php';
			exit;
		}

		//ack Msg Goes Here
		$ack = strtoupper($response->responseEnvelope->ack);
		if($ack != "SUCCESS") {
			$info	=	$response;
			$infoStored =	$info->error[0];
			$desc	=	serialize(array('type' => 'Price','mode' => 'paypal','Ack' => $ack,'PayKey'=>$payKey,'info'=>$infoStored->message));
			Payout::ChangePayoutStatus($id, 0,$desc);
			} else {
			$payKey = $response->payKey;
			if(($response->paymentExecStatus == "COMPLETED" )) {
				$case ="1";
			} else if(($actionType== "PAY") && ($response->paymentExecStatus == "CREATED" )) {
				$case ="2";
			} else if(($preapprovalKey != null ) && ($actionType == "CREATE") && ($response->paymentExecStatus == "CREATED" )) {
				$case ="3";
			} else if(($actionType== "PAY_PRIMARY")) {
				$case ="4";
			} else if(($actionType== "CREATE") && ($response->paymentExecStatus == "CREATED" )) {
				$apiCred = PPCredentialManager::getInstance()->getCredentialObject(null);
				if(str_replace('_api1.', '@', $apiCred->getUserName()) == $senderEmail) {
					$case ="3";
				} else {
					$case ="2";
				}
			}
			$token = $response->payKey;
			$payPalURL = PAYPAL_REDIRECT_URL . '_ap-payment&paykey=' . $token;
			switch($case) {
				case "1" :
					$desc	=	serialize(array('type' => 'Price','mode' => 'paypal','Ack' => $ack,'PayKey'=>$payKey));
					Payout::ChangePayoutStatus($id, $status,$desc);
					break;
				case "2" :
					$desc	=	serialize(array('type' => 'Price','mode' => 'paypal','Ack' => $ack,'PayKey'=>$payKey,'payPalURL'=>$payPalURL));
					Payout::ChangePayoutStatus($id, $status,$desc);				
					break;
				case "3" :
					$desc	=	serialize(array('type' => 'Price','mode' => 'paypal','Ack' => $ack,'PayKey'=>$payKey,'payPalURL'=>$payPalURL));
					Payout::ChangePayoutStatus($id, $status,$desc);							
					break;
				case "4" :
					$info	=	'"Payment to \"Primary Receiver\" is Complete<br/>";';
					$desc	=	serialize(array('type' => 'Price','mode' => 'paypal','Ack' => $ack,'PayKey'=>$payKey,'payPalURL'=>$payPalURL,'info'=>$info));
					Payout::ChangePayoutStatus($id, $status,$desc);											
					break;
			}
		}
		}
		else
		{
					$desc	=	serialize($payout['Description']);
					Payout::ChangePayoutStatus($id, $status,$desc);							
		
		}
//		require_once 'libs/Paypal/SDK/lib/Common/Response.php';

		
	// pre approval end		
				
                if($status == 3)
                {
                    //cancel payout - return money to user account
                    $user_balance = User::GetBalance($payout['UserId']);
                    $user_balance += $payout['Money'];
                    Payout::PayoutMoney($payout['UserId'], 1, 0, $payout['Money'], $user_balance, 0, 4, array('type' => 'Price'));
					
		//AdaptivePayment::preapprovalPay($actionType,$cancelUrl,$returnUrl,$currencyCode,$feesPayer,$preapprovalKey,$ipnNotificationUrl,$memo,$pin,$reverseAllParallelPaymentsOnError,$senderEmail,$trackingId,$fundingConstraint,$emailIdentifier,$senderCountryCode,$senderPhoneNumber,$senderExtension,$useCredentials,$receiverEmail,$receiverAmount,$primaryReceiver,$invoiceId,$paymentType,$paymentSubType,$phoneNumber,$phoneExtn);
					

                    //update wallet
                    User::UpdateWallet($payout['UserId'], $user_balance);						
                }

					$this->mSmarty->assign('artist_name', $payout['u.Name']);						
					$this->mSmarty->assign('status', $status);
					$this->mSmarty->assign('amount', $payout['Money']);
					$mode = $payout['Description']['mode'];
					if($mode == 'direct')
					{
						$mode = 'ACH Direct Payment';
					}
					if($mode == 'check')
					{
						$mode = 'Check Payment';
					}
					else
					{
						$mode = 'Paypal Payment';
					}										
					$this->mSmarty->assign('mode', $mode);					
					
					//send mail to admin and artist with payout status
					if($payout['u.Email'])
					{
						$this->mSmarty->assign('name', $payout['u.Name']);					
						$this->mSmarty->assign('mail_to', 'artist');
						$fromEmail = ADMIN_EMAIL;
						$fromName = SITE_NAME;
						$toEmail = $payout['u.Email'];
						$toName = $payout['u.Name'];
						$subject = PAYOUT_STATUS_FROM . SITE_NAME;
						$message = $this->mSmarty->fetch('mails/payout_status_admin_mail.html');
						sendEmail($fromEmail,$fromName, $toEmail, $toName, $subject, $message);
					}
					if(ADMIN_EMAIL_RECEIVED)	
					{
						$this->mSmarty->assign('name', ADMIN_NAME);					
						$this->mSmarty->assign('mail_to', 'admin');
						$fromEmail = ADMIN_EMAIL;
						$fromName = SITE_NAME;
						$toEmail = ADMIN_EMAIL_RECEIVED;
						$toName = SITE_NAME;
						$subject = PAYOUT_STATUS_FROM . SITE_NAME;
						$message = $this->mSmarty->fetch('mails/payout_status_admin_mail.html');
						sendEmail($fromEmail,$fromName, $toEmail, $toName, $subject, $message);
					}				
            }
        }
        echo json_encode($res);
        exit();
    }

    /**
     * Music tracks/albums list in admin panel
     * @return void
     */
    public function Music()
    {
        $tp = _v('tp', 0);
        if(!in_array($tp, array(0, 1)))
        {
            $tp = 0;
        }
        $this->mSmarty->assign('tp', $tp);
        $this->mSmarty->assign('pcnt', !empty($_SESSION['mpcnt']) ? $_SESSION['mpcnt'] : 10);
        $this->mSmarty->assign('no_right', 1);

        //show template
        $this->mSmarty->assign('amodule', 'music');
        $this->mSmarty->display('mods/admin/music/_list.html');
    }
	

    /**
     * Ajax music list
     * @return void
     */
    public function MusicList()
    {
        $res = array('q' => OK);

        $page = _v('page', 1);
        $tp = _v('tp', 0);
        $pcnt = _v('pcnt', !empty($_SESSION['mpcnt']) ? $_SESSION['mpcnt'] : 10);
        $_SESSION['mpcnt'] = $pcnt;

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
                            $filters .= ($filters ? ' AND ' : '') . '(u.email LIKE "%' . $v . '%")';
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
                                    $sq .= (!$sq ? '' : ' AND ') . '(u.first_name LIKE "%' . $v2 . '%" OR u.last_name LIKE "%' . $v2 . '%" OR u.name LIKE "%' . $v2 . '%" OR u.band_name LIKE "%' . $v2 . '%")';
                                }
                            }
                            if ($sq)
                            {
                                $filters .= ($filters ? ' AND ' : '') . '('.$sq.')';
                            }
                        }
                        break;
                    case 'track_title':
                        if ($v)
                        {
                            $vq = explode(' ', $v);
                            $sq = '';
                            foreach ($vq as $v2)
                            {
                                if (strlen($v2) > 1)
                                {
                                    $sq .= (!$sq ? '' : ' AND ') . '(music.title LIKE "%' . $v2 . '%")';
                                }
                            }
                            if ($sq)
                            {
                                $filters .= ($filters ? ' AND ' : '') . '('.$sq.')';
                            }
                        }
                        break;
                    case 'album_title':
                        if ($v)
                        {
                            $vq = explode(' ', $v);
                            $sq = '';
                            foreach ($vq as $v2)
                            {
                                if (strlen($v2) > 1)
                                {
                                    if(!$tp)
                                    {
                                        $sq .= (!$sq ? '' : ' AND ') . '(a.title LIKE "%' . $v2 . '%")';
                                    }
                                    else
                                    {
                                        $sq .= (!$sq ? '' : ' AND ') . '(music_album.title LIKE "%' . $v2 . '%")';
                                    }
                                }
                            }
                            if ($sq)
                            {
                                $filters .= ($filters ? ' AND ' : '') . '('.$sq.')';
                            }
                        }
                        break;

                    case 'featured':
                        if ($v)
                        {
                            $filters .= ($filters ? ' AND ' : '') . '(music_album.featured=1)';
                        }
                        break;
                    case 'dfrom':
                        if ($v)
                        {
                            $dc = explode('/', $v);
                            if (3 == count($dc) && $dc[0] >= 1 && $dc[0] <= 12 && $dc[1] >= 1 && $dc[1] <= 31
                                && $dc[2] >= date("Y") - 25 && $dc[2] <= date("Y")
                            )
                            {
                                $dc = mktime(0, 0, 0, $dc[0], $dc[1], $dc[2]);
                                if(!$tp)
                                {
                                    $filters .= ($filters ? ' AND ' : '') . '(music.date_release >= "'.date('Y-m-d', $dc).'")';
                                }
                                else
                                {
                                    $filters .= ($filters ? ' AND ' : '') . '(music_album.date_release >= "'.date('Y-m-d', $dc).'")';
                                }
                            }
                        }
                        break;
                    case 'dto':
                        if ($v)
                        {
                            $dc = explode('/', $v);
                            if (3 == count($dc) && $dc[0] >= 1 && $dc[0] <= 12 && $dc[1] >= 1 && $dc[1] <= 31
                                && $dc[2] >= date("Y") - 25 && $dc[2] <= date("Y")
                            )
                            {
                                $dc = mktime(23, 59, 59, $dc[0], $dc[1], $dc[2]);
                                if(!$tp)
                                {
                                    $filters .= ($filters ? ' AND ' : '') . '(music.date_release <= "'.date('Y-m-d', $dc).'")';
                                }
                                else
                                {
                                    $filters .= ($filters ? ' AND ' : '') . '(music_album.date_release <= "'.date('Y-m-d', $dc).'")';
                                }
                            }
                        }
                        break;
                }
            }
        }

        if($tp == 1)
        {
            //albums
            $list = MusicAlbum::AdminAlbumsList($page, $pcnt, $filters);
        }
        else
        {
            //tracks
            $list = Music::AdminMusicList($page, $pcnt, $filters);
        }

        
        $rcnt = $list['rcnt'];
        $list = $list['list'];
        include_once 'model/Pagging.class.php';
        $link = 'oAdmin.MusicList';
        $mpg = new Pagging($pcnt, $rcnt, $page, $link);
        $res['pagging'] = $mpg->Make($this->mSmarty, 1);
        $res['page'] = $page;

        $this->mSmarty->assign('tp', $tp);
        $this->mSmarty->assignByRef('list', $list);
        $res['data'] = $this->mSmarty->Fetch('mods/admin/music/ajax/_list_ajax.html');

        echo json_encode($res);
        exit();
    }

    /**
     * Ajax add/remove album to/from featured list
     * @return void
     */
    public function MusicAlbumFeatured()
    {
        $res = array('q' => OK );
        $id = _v('id', 0);

        if($id)
        {
            $album = MusicAlbum::GetAlbum($id);
            if(!empty($album))
            {
                MusicAlbum::ChangeFeaturedStatus($id, ($album['Featured'] ? 0 : 1));
            }
        }
        echo json_encode($res);
        exit();
    }

    /**
     * Ajax delete music track/album
     * @return void
     */
    public function MusicDelete()
    {
        $res = array('q' => OK );
        $id = _v('id', 0);
        $is_album = _v('is_album', 0);

        if($id)
        {
            if(!$is_album)
            {
                MusicQuery::create()->select('Id')->filterById($id)->update(array('Deleted' => 1));
                /*$track = Music::GetMusic($id);
                if(!empty($track))
                {
                    //delete music files and db record
                    Music::DeleteMusicTrack($track);
                    //delete purchase info
                    MusicPurchase::DeleteMusicPurchase(array($id));
                    //delete artist log
                    ShoppingLog::DeleteLog('track', array($id));
                }*/
            }
            else
            {
                MusicAlbumQuery::create()->select('Id')->filterById($id)->update(array('Deleted' => 1));
                MusicQuery::create()->select('Id')->filterByAlbumId($id)->update(array('Deleted' => 1));
                /*$album = MusicAlbum::GetAlbum($id);
                if(!empty($album))
                {
                    $ids = array();
                    $tracks = MusicAlbum::GetAlbumTracks($id);
                    if(!empty($tracks))
                    {
                        //delete album tracks
                        foreach($tracks as $item)
                        {
                            Music::DeleteMusicTrack($item);
                            $ids[] = $item['Id'];
                        }
                        //delete purchase info
                        MusicPurchase::DeleteMusicPurchase($ids);
                        //delete artist log
                        ShoppingLog::DeleteLog('track', $ids);
                    }
                    //delete album
                    MusicAlbum::DeleteAlbum($album);
                    //delete log
                    ShoppingLog::DeleteLog('album', array($id));
                }*/
            }
        }
        echo json_encode($res);
        exit();
    }

    /**
     * Ajax restore music track/album
     * @return void
     */
    public function MusicRestore()
    {
        $res = array('q' => OK );
        $id = _v('id', 0);
        $is_album = _v('is_album', 0);

        if($id)
        {
            if(!$is_album)
            {
                MusicQuery::create()->select('Id')->filterById($id)->update(array('Deleted' => 0));
            }
            else
            {
                MusicAlbumQuery::create()->select('Id')->filterById($id)->update(array('Deleted' => 0));
                MusicQuery::create()->select('Id')->filterByAlbumId($id)->update(array('Deleted' => 0));
            }
        }
        echo json_encode($res);
        exit();
    }

    /**
     * Video list in admin panel
     * @return void
     */
    public function Video()
    {
        $this->mSmarty->assign('pcnt', !empty($_SESSION['vpcnt']) ? $_SESSION['vpcnt'] : 10);
        $this->mSmarty->assign('no_right', 1);

        //show template
        $this->mSmarty->assign('amodule', 'video');
        $this->mSmarty->display('mods/admin/video/_list.html');
    }

    /**
     * Ajax video list
     * @return void
     */
    public function VideoList()
    {
				
        $res = array('q' => OK );

        $page = _v('page', 1);
        $pcnt = _v('pcnt', !empty($_SESSION['vpcnt']) ? $_SESSION['vpcnt'] : 10);
        $_SESSION['vpcnt'] = $pcnt;
		
		$s_email = $_POST['s']['email'];
		$this->mSmarty->assignByRef('s_email', $s_email);
		$s_name = $_POST['s']['name'];
		$this->mSmarty->assignByRef('s_name', $s_name);
		$s_title = $_POST['s']['title'];
		$this->mSmarty->assignByRef('s_title', $s_title);
		$s_dfrom = $_POST['s']['dfrom'];
		$this->mSmarty->assignByRef('s_dfrom', $s_dfrom);
		$s_dto = $_POST['s']['dto'];
		$this->mSmarty->assignByRef('s_dto', $s_dto);
		$s_vtype = $_POST['s']['vtype'];
		if($s_vtype == '')
		{
			$s_vtype = -1;
		}
		$this->mSmarty->assignByRef('s_vtype', $s_vtype);
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
                            $filters .= ($filters ? ' AND ' : '') . '(u.email LIKE "%' . $v . '%")';
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
                                    $sq .= (!$sq ? '' : ' AND ') . '(u.first_name LIKE "%' . $v2 . '%" OR u.last_name LIKE "%' . $v2 . '%" OR u.name LIKE "%' . $v2 . '%" OR u.band_name LIKE "%' . $v2 . '%")';
                                }
                            }
                            if ($sq)
                            {
                                $filters .= ($filters ? ' AND ' : '') . '('.$sq.')';
                            }
                        }
                        break;
                    case 'title':
                        if ($v)
                        {
                            $vq = explode(' ', $v);
                            $sq = '';
                            foreach ($vq as $v2)
                            {
                                if (strlen($v2) > 1)
                                {
                                    $sq .= (!$sq ? '' : ' AND ') . '(video.title LIKE "%' . $v2 . '%")';
                                }
                            }
                            if ($sq)
                            {
                                $filters .= ($filters ? ' AND ' : '') . '('.$sq.')';
                            }
                        }
                        break;
                    case 'vtype':
                        $v = (int)$v;
                        if ($v != -1)
                        {
                            $filters .= ($filters ? ' AND ' : '') . '(video.from_yt = ' . $v . ')';
                        }
                        break;

                    case 'dfrom':
                        if ($v)
                        {
                            $dc = explode('/', $v);
                            if (3 == count($dc) && $dc[0] >= 1 && $dc[0] <= 12 && $dc[1] >= 1 && $dc[1] <= 31
                                && $dc[2] >= date("Y") - 25 && $dc[2] <= date("Y")
                            )
                            {
                                $dc = mktime(0, 0, 0, $dc[0], $dc[1], $dc[2]);
                                $filters .= ($filters ? ' AND ' : '') . '(video.pdate >= '.$dc.')';
                            }
                        }
                        break;
                    case 'dto':
                        if ($v)
                        {
                            $dc = explode('/', $v);
                            if (3 == count($dc) && $dc[0] >= 1 && $dc[0] <= 12 && $dc[1] >= 1 && $dc[1] <= 31
                                && $dc[2] >= date("Y") - 25 && $dc[2] <= date("Y")
                            )
                            {
                                $dc = mktime(23, 59, 59, $dc[0], $dc[1], $dc[2]);
                                $filters .= ($filters ? ' AND ' : '') . '(video.pdate <= '.$dc.')';
                            }
                        }
                        break;
                }
            }
        }

        //video list
        $list = Video::AdminVideoList($page, $pcnt, $filters);
	

        $rcnt = $list['rcnt'];
        $list = $list['list'];
        include_once 'model/Pagging.class.php';
        $link = 'oAdmin.VideoList';
        $mpg = new Pagging($pcnt, $rcnt, $page, $link);
        $res['pagging'] = $mpg->Make($this->mSmarty, 1);
        $res['page'] = $page;

        $this->mSmarty->assignByRef('list', $list);
        $res['data'] = $this->mSmarty->Fetch('mods/admin/video/ajax/_list_ajax.html');

        echo json_encode($res);
        exit();
    }

    /**
     * Ajax delete video
     * @return void
     */
    public function VideoDelete()
    {
        $res = array('q' => OK );
        $id = _v('id', 0);

        if($id)
        {
            VideoQuery::create()->select('Id')->filterById($id)->update(array('Deleted' => 1));
            //delete video
            /*$video = Video::GetVideoInfo($id);
            if(!empty($video))
            {
                //delete video files and db record
                Video::DeleteVideo($video);
                //delete purchase info
                VideoPurchase::DeleteVideoPurchase($id);
                //delete artist log
                ShoppingLog::DeleteLog('video', array($id));
            }*/
        }
        echo json_encode($res);
        exit();
    }
	
	/* *
     * Get Video Info
     * @return void
     */
	
	public function videoInfo()
	{
		$id = _v('vId', 0);
		if($id)
        {
            $info = Video::GetVideoInfo($id);
			$this->mSmarty->assignByRef('info', $info);
        }
	
	  $this->mSmarty->display('mods/admin/video/_video_info.html');
	}

	

    /**
     * Ajax restore video
     * @return void
     */
    public function VideoRestore()
    {
        $res = array('q' => OK );
        $id = _v('id', 0);

        if($id)
        {
            VideoQuery::create()->select('Id')->filterById($id)->update(array('Deleted' => 0));
        }
        echo json_encode($res);
        exit();
    }

    /**
     * Events list in admin panel
     * @return void
     */
    public function Events()
    {
        $this->mSmarty->assign('pcnt', !empty($_SESSION['epcnt']) ? $_SESSION['epcnt'] : 10);
        $this->mSmarty->assign('no_right', 1);
		
		$event_app = _v('event_app', 0);

		$this->mSmarty->assign('event_app', $event_app);

        //show template
        $this->mSmarty->assign('amodule', 'events');
        $this->mSmarty->display('mods/admin/events/_list.html');
    }

    /**
     * Ajax events list
     * @return void
     */
    public function EventsList()
    {
        $res = array('q' => OK );

        $page = _v('page', 1);
        $pcnt = _v('pcnt', !empty($_SESSION['epcnt']) ? $_SESSION['epcnt'] : 10);
        $_SESSION['epcnt'] = $pcnt;			

		$event_app ='';
		$event_app = _v('event_app', 0 );

		$res['event_app'] = $event_app;

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
                            $filters .= ($filters ? ' AND ' : '') . '(u.email LIKE "%' . $v . '%")';
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
                                    $sq .= (!$sq ? '' : ' AND ') . '(u.first_name LIKE "%' . $v2 . '%" OR u.last_name LIKE "%' . $v2 . '%" OR u.name LIKE "%' . $v2 . '%" OR u.band_name LIKE "%' . $v2 . '%")';
                                }
                            }
                            if ($sq)
                            {
                                $filters .= ($filters ? ' AND ' : '') . '('.$sq.')';
                            }
                        }
                        break;
                    case 'title':
                        if ($v)
                        {
                            $vq = explode(' ', $v);
                            $sq = '';
                            foreach ($vq as $v2)
                            {
                                if (strlen($v2) > 1)
                                {
                                    $sq .= (!$sq ? '' : ' AND ') . '(event.title LIKE "%' . $v2 . '%" OR event.descr LIKE "%' . $v2 . '%")';
                                }
                            }
                            if ($sq)
                            {
                                $filters .= ($filters ? ' AND ' : '') . '('.$sq.')';
                            }
                        }
                        break;
                    case 'etype':
                        $v = (int)$v;
                        if ($v)
                        {
                            $filters .= ($filters ? ' AND ' : '') . '(event.event_type = ' . $v . ')';
                        }
                        break;
                    case 'location':
                        if ($v)
                        {
                            $filters .= ($filters ? ' AND ' : '') . '(event.location LIKE "%' . $v . '%")';
                        }
                        break;

                    case 'event_app':
                        if ($v)
                        {
                            $filters .= ($filters ? ' AND ' : '') . '(event.event_app = ' . $v . ')';
                        }
                        break;						

                    case 'dfrom':
                        if ($v)
                        {
                            $dc = explode('/', $v);
                            if (3 == count($dc) && $dc[0] >= 1 && $dc[0] <= 12 && $dc[1] >= 1 && $dc[1] <= 31
                                && $dc[2] >= date("Y") - 25 && $dc[2] <= date("Y")+5
                            )
                            {
                                $dc = mktime(0, 0, 0, $dc[0], $dc[1], $dc[2]);
                                $filters .= ($filters ? ' AND ' : '') . '(event.event_date >= "'.date('Y-m-d H:i:s', $dc).'")';
                            }
                        }
                        break;
                    case 'dto':
                        if ($v)
                        {
                            $dc = explode('/', $v);
                            if (3 == count($dc) && $dc[0] >= 1 && $dc[0] <= 12 && $dc[1] >= 1 && $dc[1] <= 31
                                && $dc[2] >= date("Y") - 25 && $dc[2] <= date("Y")+5
                            )
                            {
                                $dc = mktime(23, 59, 59, $dc[0], $dc[1], $dc[2]);
                                $filters .= ($filters ? ' AND ' : '') . '(event.event_date <= "'.date('Y-m-d H:i:s', $dc).'")';
                            }
                        }
                        break;
                }
            }
        }

        //video list
        $list = Event::AdminEventList($page, $pcnt, $filters, $event_app);
		
        $rcnt = $list['rcnt'];		
        $list = $list['list'];
		
        include_once 'model/Pagging.class.php';
        $link = 'oAdmin.EventsList';
        $mpg = new Pagging($pcnt, $rcnt, $page, $link);
        $res['pagging'] = $mpg->Make($this->mSmarty, 1);
        $res['page'] = $page;

        $this->mSmarty->assignByRef('list', $list);
		
        $res['data'] = $this->mSmarty->Fetch('mods/admin/events/ajax/_list_ajax.html');

        echo json_encode($res);
        exit();
    }

    /**
     * Ajax delete event
     * @return void
     */
    public function EventDelete()
    {
        $res = array('q' => OK );
        $id = _v('id', 0);

        if($id)
        {
            EventQuery::create()->select('Id')->filterById($id)->update(array('Deleted' => 1));
        }
        echo json_encode($res);
        exit();
    }
    /**
     * Ajax delete event
     * @return void
     */
    public function ChangeApproveStatus()
    {
        $res = array('q' => OK );
        
		$id = _v('id', 0);
		$event_app = _v('event_app', '');
		$user_id = _v('user_id', '');		
		
		$res['event_app'] = $event_app;				

        if($id)
        {
            EventQuery::create()->select('Id')->filterById($id)->update(array('EventApp' => $event_app));
			
			$artistInfo = Event::GetEvent($id, $user_id, $user_id);
			$UserInfo = User::GetUserFullInfo($artistInfo['UserId']);
			$name = $artistInfo['BandName'] ? $artistInfo['BandName'] : $artistInfo['FirstName'].' '.$artistInfo['LastName'];			
			 
			 	if($event_app == EVENT_APPROVED)
                {
									
                    $this->mSmarty->assign('UserInfo', $UserInfo);								
                    $this->mSmarty->assign('name', $name);				
                    $this->mSmarty->assign('eventdetails', $artistInfo);				
                    $this->mSmarty->assign('email', $artistInfo['Email']);
                    $this->mSmarty->assign('event_title', $artistInfo['Title']);
                    $this->mSmarty->assign('event_date', $artistInfo['EventDate']);
					$this->mSmarty->assign('duration', $artistInfo['Duration']);
                    $this->mSmarty->assign('SITE_NAME', SITE_NAME);
                    $this->mSmarty->assign('DOMAIN', DOMAIN);
                    $this->mSmarty->assign('id', $id);
					$fromEmail = ADMIN_EMAIL;
					$fromName = SITE_NAME;
					$toEmail = $artistInfo['Email'];
					$toName = $name;
					$subject =  "Your request for an extended event on ArtistFan has been approved!";
					$message = $this->mSmarty->fetch('mails/event_approved_mail.html');
					sendEmail($fromEmail,$fromName, $toEmail, $toName, $subject, $message);
                }
				else
				{
                    $this->mSmarty->assign('UserInfo', $UserInfo);												
                    $this->mSmarty->assign('eventdetails', $artistInfo);				
                    $this->mSmarty->assign('name', $name);
                    $this->mSmarty->assign('email', $artistInfo['Email']);
                    $this->mSmarty->assign('event_title', $artistInfo['Title']);
                    $this->mSmarty->assign('event_date', $artistInfo['EventDate']);
					$this->mSmarty->assign('duration', $artistInfo['Duration']);
                    $this->mSmarty->assign('SITE_NAME', SITE_NAME);
                    $this->mSmarty->assign('DOMAIN', DOMAIN);
                    $this->mSmarty->assign('id', $id);
					$fromEmail = ADMIN_EMAIL;
					$fromName = SITE_NAME;
					$toEmail = $artistInfo['Email'];
					$toName = $name;
					$subject =  "Your request for an extended event on ArtistFan was denied.";
					$message = $this->mSmarty->fetch('mails/event_denied_mail.html');
					sendEmail($fromEmail,$fromName, $toEmail, $toName, $subject, $message);	
				}
							
			
        }
		
        echo json_encode($res);
        exit();
    }	

    /**
     * Ajax restore event
     * @return void
     */
    public function EventRestore()
    {
        $res = array('q' => OK );
        $id = _v('id', 0);

        if($id)
        {
            EventQuery::create()->select('Id')->filterById($id)->update(array('Deleted' => 0));
        }
        echo json_encode($res);
        exit();
    }
	
	public function PaypalPreApproval()
		{
		$submit = $_REQUEST['submit'];

		if(isset($submit))
			{
			$email	=	trim($_REQUEST['email']);
			$Currencycode	=	trim($_REQUEST['Currencycode']);
			$Preapprovalstartdate	=	trim($_REQUEST['Preapprovalstartdate']);
			$Preapprovalenddate	=	trim($_REQUEST['Preapprovalenddate']);						
			$PaymentdateDateofmonth	=	trim($_REQUEST['PaymentdateDateofmonth']);
			$PaymentdateDayofweek	=	trim($_REQUEST['PaymentdateDayofweek']);
			$Maximumamountperpayment	=	trim($_REQUEST['Maximumamountperpayment']);
			$Maximumnumberofpayments	=	trim($_REQUEST['Maximumnumberofpayments']);
			$Maximumnumberofpaymentsperperiod	=	trim($_REQUEST['Maximumnumberofpaymentsperperiod']);
			$Maximumtotalamountofallpayments	=	trim($_REQUEST['Maximumtotalamountofallpayments']);
			$Paymentperiod	=	trim($_REQUEST['Paymentperiod']);
			$DisplayMaximumTotalAmount	=	trim($_REQUEST['DisplayMaximumTotalAmount']);
			
			if($email=='')
				{
				$error = true;
				$errorMsg[]	=	EMAIL_ID_IS_MISSING;
				}
			if($Currencycode=='')
				{
				$error = true;
				$errorMsg[]	=	CURRENCY_CODE_IS_MISSING;
				}
			if($Preapprovalstartdate=='')
				{
				$error = true;
				$errorMsg[]	=	PREAPPROVAL_STARTDATE_IS_MISSING;
				}
			if($Preapprovalenddate=='')
				{
				$error = true;
				$errorMsg[]	=	PREAPPROVAL_ENDDATE_IS_MISSING;
				}
			if($Maximumamountperpayment=='')
				{
				$error = true;
				$errorMsg[]	=	MAXIMUM_AMOUNT_PERPAYMENT_IS_MISSING;
				}
			if($Maximumnumberofpayments=='')
				{
				$error = true;
				$errorMsg[]	=	MAXIMUM_NUMBER_OF_PAYMENTS_IS_MISSING;
				}
			/*	
			if($Maximumnumberofpaymentsperperiod=='')
				{
				$error = true;
				$errorMsg[]	=	'Maximumnumberofpaymentsperperiod Is Missing';
				}
			if($Maximumtotalamountofallpayments=='')
				{
				$error = true;
				$errorMsg[]	=	'Maximumtotalamountofallpayments Is Missing';
				}
			if($Paymentperiod=='')
				{
				$error = true;
				$errorMsg[]	=	'Paymentperiod Is Missing';
				}
			*/				
			if($DisplayMaximumTotalAmount=='')
				{
				$error = true;
				$errorMsg[]	=	MAXIMUM_TOTAL_AMOUNT_IS_MISSING;
				}
			
			if($error)	
				{
	        $this->mSmarty->assign('errorMsg', $errorMsg);				
				}
				else
				{	
				$returnUrl = ROOT_HTTP_PATH.'/base/admin/PaypalPreApprovalSuccess';
				$cancelUrl = ROOT_HTTP_PATH.'/base/admin/PaypalPreApprovalFailure';	
				$path = 'libs';
				set_include_path(get_include_path() . PATH_SEPARATOR . $path);
				require_once('libs/Paypal/SDK/lib/services/AdaptivePayments/AdaptivePaymentsService.php');
				require_once('libs/Paypal/SDK/lib/PPLoggingManager.php');
				define("DEFAULT_SELECT", "- Select -");
				$logger = new PPLoggingManager('PreApproval');
				// create request
				$startingDate	=	$Preapprovalstartdate;
				$endingDate		=	$Preapprovalenddate;
				$currencyCode	=	$Currencycode;
				$senderEmail	=	$email;				
//				$senderEmail	=	'admina_1358762750_biz@yahoo.com';
				//$feesPayer		=	'artist_1358763075_biz@yahoo.com';
				
				$requestEnvelope = new RequestEnvelope("en_US");
				$preapprovalRequest = new PreapprovalRequest($requestEnvelope, $cancelUrl,$currencyCode, $returnUrl, $startingDate);
				// Set optional params
				
					$preapprovalRequest->dateOfMonth = $PaymentdateDateofmonth;
					$preapprovalRequest->dayOfWeek = $PaymentdateDayofweek;
					$preapprovalRequest->dateOfMonth = $dateOfMonth;
					$preapprovalRequest->endingDate = $endingDate;
					$preapprovalRequest->maxAmountPerPayment = $Maximumamountperpayment;
					$preapprovalRequest->maxNumberOfPayments = $Maximumnumberofpayments;
					$preapprovalRequest->maxNumberOfPaymentsPerPeriod = $Maximumnumberofpaymentsperperiod;
					$preapprovalRequest->maxTotalAmountOfAllPayments = $DisplayMaximumTotalAmount;
					$preapprovalRequest->paymentPeriod = '';
					$preapprovalRequest->memo = 'Admin Pre Approval';
					$preapprovalRequest->ipnNotificationUrl = '';
					$preapprovalRequest->senderEmail = $senderEmail;
					$preapprovalRequest->pinType = $pinType;
					$preapprovalRequest->feesPayer = $feesPayer;
					$preapprovalRequest->displayMaxTotalAmount = $DisplayMaximumTotalAmount;
				$logger->log("Created PreApprovalRequest Object");
				$service = new AdaptivePaymentsService();
				try {
					$response = $service->Preapproval($preapprovalRequest);
				} catch(Exception $ex) {
					require_once 'Common/Error.php';
					exit;	
				}
				//-------------------------
				$logger->error("Received PreApprovalResponse:");
				$ack = strtoupper($response->responseEnvelope->ack);
				if($ack != "SUCCESS"){
				$this->mSmarty->assign('Failureresponse',$response);
				} else {
				// Redirect to paypal.com here
				//insert here with status
				$token = $response->preapprovalKey;
				$_SESSION['preapprovalId'] = AdaptivePayment::preApprovalInsert($email,$token,$Preapprovalstartdate,$Preapprovalenddate,$DisplayMaximumTotalAmount);								
				$payPalURL = 'https://www.sandbox.paypal.com/webscr&cmd=_ap-preapproval&preapprovalkey='.$token;				
				header("location:$payPalURL");
				exit;
				$this->mSmarty->assign('Successresponse',$response);
				$this->mSmarty->assign('payPalURL',$payPalURL);								
				}

				}
				
			
			}
			else
			{
        $this->mSmarty->assign('Existingemail', AdaptivePayment::getLastUpdatedRecord());			
					
			}
        $this->mSmarty->assign('amodule', 'payments');
        $this->mSmarty->display('mods/admin/payments/paypalPreapproval.html');
		}
		
	public function PaypalPreApprovalSuccess()
		{
		AdaptivePayment::preApprovalUpdate($_SESSION['preapprovalId']);
        $tp = _v('tp', 0);
        if(!in_array($tp, array(0, 1, 2)))
        {
            $tp = 0;
        }
        $this->mSmarty->assign('tp', $tp);
        $this->mSmarty->assign('pcnt', !empty($_SESSION['ppcnt']) ? $_SESSION['ppcnt'] : 10);
        $this->mSmarty->assign('no_right', 1);

        //statuses
        $this->mSmarty->assignByRef('statuses', Payout::StatusesList());
        
        //show template
        $this->mSmarty->assign('amodule', 'payments');
        $this->mSmarty->display('mods/admin/payments/_list.html');
		}		
	public function PaypalPreApprovalFailure()
		{
		
		}	
		
	public function videoExportData()
	    {
			$email = _v('s_email', '');
			$name = _v('s_name', '');
			$title = _v('s_title', '');
			$vtype = _v('s_vtype');		
			if( _v('s_vtype') == 0)
			{
				$vtype = 0;
			}
			if( _v('s_vtype') == -1)
			{
				$vtype = -1;
			}
			if( _v('s_vtype') == 1)
			{
				$vtype = 1;
			}
			
			$dfrom = _v('s_dfrom', '');		
			$dto = _v('s_dto','');			
			$header = "User Video Information\n\n";
			
			$arr = array();
			$arr[] = 'UserName';
			$arr[] = 'VideoTitle';
			$arr[] = 'Date';
			$arr[] = 'Price';
			$arr[] = 'Featured';
			$arr[] = 'FromYoutube';
			$arr[] = 'ViewCount';
			
			$list = implode($arr,',');
		    $header .= $list."\r\n";
			
			
			
			$filters ='';
		    $sq ='';

			// filter by user email
			if($email)	
			{
				$filters .= ($filters ? ' AND ' : '') . '(u.email LIKE "%' . $email . '%")';
			}
			
			// filter by user name
			if($name)
			{
				$sq .= (!$sq ? '' : ' AND ') . '(u.first_name LIKE "%' . $name . '%" OR u.last_name LIKE "%' . $name . '%" OR u.name LIKE "%' . $name . '%" OR u.band_name LIKE "%' . $name . '%")';
				$filters .= ($filters ? ' AND ' : '') . '('.$sq.')';
				
			}
			
			// filter by video title
			if($title)
			{
				$sq .= (!$sq ? '' : ' AND ') . '(video.title LIKE "%' . $title . '%")';
				$filters .= ($filters ? ' AND ' : '') . '('.$sq.')';
			
			}
			
			// filter by youtube videos
			if($vtype != -1)
			{
				$filters .= ($filters ? ' AND ' : '') . '(video.from_yt = ' . $vtype . ')';
			}
			
			// filter by from date
			if($dfrom)
			{
				$dc = explode('/', $dfrom);
				if (3 == count($dc) && $dc[0] >= 1 && $dc[0] <= 12 && $dc[1] >= 1 && $dc[1] <= 31 && $dc[2] >= date("Y") - 25 && $dc[2] <= date("Y"))
				{
					$dc = mktime(0, 0, 0, $dc[0], $dc[1], $dc[2]);
					$filters .= ($filters ? ' AND ' : '') . '(video.pdate >= '.$dc.')';
				}
			}
			
			// filter by to date
			if($dto)
			{
				$dc = explode('/', $dto);
				if (3 == count($dc) && $dc[0] >= 1 && $dc[0] <= 12 && $dc[1] >= 1 && $dc[1] <= 31 && $dc[2] >= date("Y") - 25 && $dc[2] <= date("Y"))
				{
					$dc = mktime(23, 59, 59, $dc[0], $dc[1], $dc[2]);
					$filters .= ($filters ? ' AND ' : '') . '(video.pdate <= '.$dc.')';
				}
			}
	
			$videoList = Video::AdminExportVideoList($filters);
			
			$videoList = $videoList['list'];

			foreach($videoList as $value)
			{	
				$featured = $value['Featured'];
				if($featured == 1)
				{
					$feat = "YES";
				}
				else
				{
					$feat = "NO";
				}
				
				$fromYt = $value['FromYt'];
				if($fromYt == 1)
				{
					$fyt = "YES";
				}
				else
				{
					$fyt = "NO";
				}
					
				$ymd = strtotime($value['Pdate']);
			    $date = date("d-m-Y", $ymd);
	
				$arr = array();			
				$arr[] = $value['u.Name'];
				$arr[] = $value['Title'];
				$arr[] = $date;
				$arr[] = $value['Price'];
				$arr[] = $feat;
				$arr[] = $fyt;
				$arr[] = $value['VideoCount'];
								
				$list = implode($arr, '","');
				$list = '"'.trim($list, ',"').'"';
				$header .= $list."\r\n";		
			
			}
			header("Content-type: application/x-msdownload");
			header("Content-Disposition: attachment; filename=video_list.csv");
			header("Pragma: no-cache");
			header("Expires: 0");
			print "$header"; 
			die;
		
		}
		
}
?>