<?php
/**
 * Skeleton subclass for representing a row from the 'adaptive_payment' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.artistfan
 */ 
class AdaptivePayment extends BaseAdaptivePayment {



    public static function preApprovalInsert($ap_sender_email,$ap_approval_key,$ap_from_date,$ap_to_date,$ap_max_amount)
	{
		$cmt = new AdaptivePayment();
        $cmt->setApSenderEmail($ap_sender_email);
		$cmt->setApApprovalKey($ap_approval_key);
		$cmt->setApFromDate($ap_from_date);
        $cmt->setApToDate($ap_to_date);
        $cmt->setApMaxAmount($ap_max_amount);		
        $cmt->setApDate(mktime());
        $cmt->setApStatus(0);				
        $cmt->save();
		return $cmt->getPrimaryKey();	
	}


    public static function preApprovalUpdate($Id)
    {
		$sql = "UPDATE `adaptive_payment` SET `ap_status` = '1' WHERE `adaptive_payment`.`ap_id` = $Id;";
		$result =  Query::Execute($sql);
		return $result;	
	}
	
	public function getLastUpdatedRecord()
	{
		$sql = "SELECT max(ap_id) as Id FROM `adaptive_payment` where ap_status=1";
		$Id =  Query::GetAll($sql);	
			if($Id[0]['Id']!='')
			{
		$result	=	 Query::GetOne("SELECT * FROM `adaptive_payment` where ap_id=".$Id[0]['Id']."");
			}
	 	return $result;	
	
	}

	public function preapprovalPay($actionType,$cancelUrl,$returnUrl,$currencyCode,$feesPayer,$preapprovalKey,$ipnNotificationUrl,$memo,$pin,$reverseAllParallelPaymentsOnError,$senderEmail,$trackingId,$fundingConstraint,$emailIdentifier,$senderCountryCode,$senderPhoneNumber,$senderExtension,$useCredentials,$receiverEmail,$receiverAmount,$primaryReceiver,$invoiceId,$paymentType,$paymentSubType,$phoneNumber,$phoneExtn)
		{
		$path = '../lib';
		set_include_path(get_include_path() . PATH_SEPARATOR . $path);
		require_once('services/AdaptivePayments/AdaptivePaymentsService.php');
		require_once('PPLoggingManager.php');
		require_once('Common/Constants.php');
		
		define("DEFAULT_SELECT", "- Select -");
		
		$logger = new PPLoggingManager('Pay');
		if(isset($receiverEmail)) {
			$receiver = array(); 
			for($i=0; $i<count($receiverEmail); $i++) { 
				$receiver[$i] = new Receiver();
				$receiver[$i]->email = $receiverEmail[$i];
				$receiver[$i]->amount = $receiverAmount[$i];
				$receiver[$i]->primary = $primaryReceiver[$i];
		
				if($invoiceId[$i] != "") {
					$receiver[$i]->invoiceId = $invoiceId[$i];
				}
				if($paymentType[$i] != "" && $paymentType[$i] != DEFAULT_SELECT) {
					$receiver[$i]->paymentType = $paymentType[$i];
				}
				if($paymentSubType[$i] != "") {
					$receiver[$i]->paymentSubType = $paymentSubType[$i];
				}
				if($phoneCountry[$i] != "" && $phoneNumber[$i]) {
					$receiver[$i]->phone = new PhoneNumberType($phoneCountry[$i], $phoneNumber[$i]);
					if($phoneExtn[$i] != "") {
						$receiver[$i]->phone->extension = $phoneExtn[$i];
					}
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
			require_once 'Common/Error.php';
			exit;
		}
		$logger->log("Received payResponse:");
		//ack Msg Goes Here
		$ack = strtoupper($response->responseEnvelope->ack);
		if($ack != "SUCCESS") {
			echo "<b>Error </b>";
			echo "<pre>";
			print_r($response);
			echo "</pre>";
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
					echo "<table>";
					echo "<tr><td>Ack :</td><td><div id='Ack'>$ack</div> </td></tr>";
					echo "<tr><td>PayKey :</td><td><div id='PayKey'>$payKey</div> </td></tr>";
					echo "</table>";
					break;
				case "2" :
					echo "<table>";
					echo "<tr><td>Ack :</td><td><div id='Ack'>$ack</div> </td></tr>";
					echo "<tr><td>PayKey :</td><td><div id='PayKey'>$payKey</div> </td></tr>";
					echo "<tr><td><a href=$payPalURL><b>Redirect URL to Complete Payment </b></a></td></tr>";
					echo "</table>";
					break;
				case "3" :
					echo "<table>";
					echo "<tr><td>Ack :</td><td><div id='Ack'>$ack</div> </td></tr>";
					echo "<tr><td>PayKey :</td><td><div id='PayKey'>$payKey</div> </td></tr>";
					echo "<tr><td><a href=$payPalURL><b>Redirect URL to Complete Payment </b></a></td></tr>";
					echo "<tr><td><a href=SetPaymentOption.php?payKey=$payKey><b>Set Payment Options(optional)</b></a></td></tr>";
					echo "<tr><td><a href=ExecutePaymentOption.php?payKey=$payKey><b>Execute Payment Options</b></a></td></tr>";
					echo "</table>";
					break;
				case "4" :
					echo"Payment to \"Primary Receiver\" is Complete<br/>";
					echo"<a href=ExecutePaymentOption.php?payKey=$payKey><b>* \"Execute Payment\" to pay to the secondary receivers</b></a><br>";
					break;
			}
			echo "<pre>";
			print_r($response);
			echo "</pre>";	
		}
		require_once 'Common/Response.php';

	}	
	
	
	



} // AdaptivePayment
