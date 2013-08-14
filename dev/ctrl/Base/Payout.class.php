<?php
/**
 * Base Fun profile class
 * User: ssergy
 * Date: 08.02.12
 * Time: 17:45
 *
 */

class Base_payout extends Base
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
	
	
public function approval()	
	{
	$returnUrl = "http://localartistfan.com/base/admin/payments?tp=1";
	$cancelUrl =  "http://localartistfan.com/base/admin/payments?tp=1";	
	$path = 'libs';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once('libs/Paypal/SDK/lib/services/AdaptivePayments/AdaptivePaymentsService.php');
require_once('libs/Paypal/SDK/lib/PPLoggingManager.php');
define("DEFAULT_SELECT", "- Select -");
$logger = new PPLoggingManager('PreApproval');
// create request
$startingDate	=	'2013-01-22';
$endingDate		=	'2013-02-01';
$currencyCode	=	'USD';
$senderEmail	=	'admina_1358762750_biz@yahoo.com';
//$feesPayer		=	'artist_1358763075_biz@yahoo.com';

$requestEnvelope = new RequestEnvelope("en_US");
$preapprovalRequest = new PreapprovalRequest($requestEnvelope, $cancelUrl,$currencyCode, $returnUrl, $startingDate);
// Set optional params

	$preapprovalRequest->dateOfMonth = $dateOfMonth;
	$preapprovalRequest->dayOfWeek = $dayOfWeek;
	$preapprovalRequest->dateOfMonth = $dateOfMonth;
	$preapprovalRequest->endingDate = $endingDate;
	$preapprovalRequest->maxAmountPerPayment = $maxAmountPerPayment;
	$preapprovalRequest->maxNumberOfPayments = 10;
	$preapprovalRequest->maxNumberOfPaymentsPerPeriod = $maxNumberOfPaymentsPerPeriod;
	$preapprovalRequest->maxTotalAmountOfAllPayments = 50.0;
	$preapprovalRequest->paymentPeriod = '';
	$preapprovalRequest->memo = 'Admin Pre Approval';
	$preapprovalRequest->ipnNotificationUrl = '';
	$preapprovalRequest->senderEmail = $senderEmail;
	$preapprovalRequest->pinType = $pinType;
	$preapprovalRequest->feesPayer = $feesPayer;
	$preapprovalRequest->displayMaxTotalAmount = $displayMaxTotalAmount;
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
	echo "<b>Error </b>";
	echo "<pre>";
	print_r($response);
	echo "</pre>";
} else {
	echo "<pre>";
	print_r($response);
	echo "</pre>";
	
	// Redirect to paypal.com here
	$token = $response->preapprovalKey;
	$payPalURL = 'https://www.sandbox.paypal.com/webscr&cmd=_ap-preapproval&preapprovalkey='.$token;
	
	echo "<table>";
	echo "<tr><td>Ack :</td><td><div id='Ack'>$ack</div> </td></tr>";
	echo "<tr><td>PreapprovalKey :</td><td><div id='PreapprovalKey'>$token</div> </td></tr>";
	echo "<tr><td><a href=$payPalURL><b>Redirect URL to Complete Preapproval Authorization</b></a></td></tr>";
	echo "</table>";
}
//require_once('lib/Common/Response.php');		
	
	
	
	}
	
public function approvalPay()	
	{

//turn php errors on
ini_set("track_errors", true);

//set PayPal Endpoint to sandbox
$api_endpoint = trim("https://svcs.sandbox.paypal.com/AdaptivePayments/Pay");
$wsdl = trim("https://svcs.sandbox.paypal.com/AdaptivePayments?wsdl");

/*
*******************************************************************
PayPal API Credentials
Replace <API_USERNAME> with your API Username
Replace <API_PASSWORD> with your API Password
Replace <API_SIGNATURE> with your Signature
*******************************************************************
*/

//PayPal API Credentials
$API_UserName = "bprome_1356081970_biz_api1.yahoo.com"; //TODO
$API_Password = "1356082022"; //TODO
$API_Signature = "AztFTKus9yA06Ly6wV9kI-ClZrW4A3-NgAruCbV4GIxnh81xMWBlczQy"; //TODO
	
//Default App ID for Sandbox	
$API_AppID = "APP-80W284485P519543T";
$API_MessageProtocol = "SOAP11";


try {	
	//create instance of the complex types classes
	$xrequestEnvelope = new RequestEnvelope();
	$xReceiverList = new ReceiverList();
	$xreceiver_1 = new Receiver();
	$xreceiver_1->amount = '10.0';
	$xreceiver_1->email = 'usabuy_1356081489_per@yahoo.com';
	$xReceiverList->receiver = $xreceiver_1;

	//creating instance of the PayRequest type for Pay Operation
	$params = new PayRequest();
   	$params->requestEnvelope = $xrequestEnvelope;
   	$params->actionType = 'PAY';
   	$params->memo = 'simple pay';
   	$params->currencyCode = 'USD';
   	$params->cancelUrl = 'http://artistfan.usawebdept.com/base/admin/payments?tp=1';
   	$params->returnUrl = 'http://artistfan.usawebdept.com/base/admin/payments?tp=1';
   	$params->ipnNotificationUrl = 'http://artistfan.usawebdept.com/ipn.php';		
   	$params->receiverList = $xReceiverList;
    $params->preapprovalKey = 'PA-419309204P3618150';
   	
 //API credentials - http headers  	
   	
	$http_headers = "X-PAYPAL-SECURITY-USERID: " . $API_UserName . "\r\n" .
                    "X-PAYPAL-SECURITY-SIGNATURE: " . $API_Signature . "\r\n" .
                 	"X-PAYPAL-SECURITY-PASSWORD: " . $API_Password . "\r\n" .
                   	"X-PAYPAL-APPLICATION-ID: " . $API_AppID . "\r\n" .
   	                "X-PAYPAL-MESSAGE-PROTOCOL: " .$API_MessageProtocol. "\r\n";
   	


$opts = array( 'http' => array('method'=>'POST','header'=>$http_headers));


$ctx = stream_context_create($opts);


$soapClient = new SoapClient($wsdl,
							array('location' => $api_endpoint, 
                                  'uri' => "urn:Pay", //define the soap action
                                  'soap_version' => SOAP_1_1, 
                                  'trace' => 1, //add this line for debugging purpose during development
                                  'stream_context' => $ctx)); //adding the stream context option containing the http headers
                    
$response = $soapClient->Pay($params);

//The $response is a PayResponse object type.
//Retriving few information from the response
echo "<pre>";
var_dump($response);
$paykey = $response->payKey;
$ackCode  = $response->responseEnvelope->ack;


    $paypalURL = "https://www.sandbox.paypal.com/webscr?cmd=_ap-payment&paykey=" .$paykey;
    echo '<p><a href="' . $paypalURL . '" target="_blank">' . $paypalURL . '</a></p>';



}

catch(SoapFault $e){
  echo "Error Id : || " .$e->detail->FaultMessage->error->errorId. "<br/>";
  echo "Error Message : || " .$e->detail->FaultMessage->error->message;	
}

catch(Exception $e){
  echo "Message : ||" .$e->getMessage();	
}



	
	}
	
public function ipnstatus()
	{
	$this->mCache->set('ipn_1', 'Checking IPN', 30*24*3600);	
	$request = "cmd=_notify-validate"; 
	foreach ($_POST as $varname => $varvalue){
		$email .= "$varname: $varvalue\n";  
		/*if(function_exists('get_magic_quotes_gpc') and get_magic_quotes_gpc()){  
			$varvalue = urlencode(stripslashes($varvalue)); 
		}
		else { 
			$value = urlencode($value); 
		} */
		$value = urlencode(stripslashes($value)); 
		$request .= "&$varname=$varvalue"; 
	} 
$this->mCache->set('ipn_2', $request, 30*24*3600);	
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,"https://www.sandbox.paypal.com/cgi-bin/webscr");
//curl_setopt($ch,CURLOPT_URL,"https://www.paypal.com");
curl_setopt($ch,CURLOPT_POST,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$request);
curl_setopt($ch,CURLOPT_FOLLOWLOCATION,false);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$result = curl_exec($ch);
curl_close($ch);
//mail('lk@usaweb.net,lenin2ud@gmail.com','TESTIPN',$result);
$this->mCache->set('ipn_3', $result, 30*24*3600);	
switch($result){
	case "VERIFIED":
		// verified payment
		mail('lenin2ud@gmail.com','IpnPayment','IPN SUBJECT');
		break;
	case "INVALID":
		// invalid/fake payment
		mail('lenin2ud@gmail.com','INVALIDIpnPayment','INVALIDIPN SUBJECT');		
		break;
	default:
		// any other case (such as no response, connection timeout...)
}
 
	}	

}




?>




