<?php 
//class declaration of complex data type RequestEnvelope
class RequestEnvelope {
    public $detailLevel;
    public $errorLanguage;
}

//class declaration of complex data type PreapprovalRequest
class PreapprovalRequest { 
public $requestEnvelope;
public $cancelUrl;
public $currencyCode;  
public $dateOfMonth;
public $dayofWeek;
public $endingDate;
public $ipnNotificationUrl;
public $maxAmountPerPayment;
public $maxNumberOfPayments;
public $maxNumberOfPaymentsPerPeriod;
public $maxTotalAmountOfAllPayments;
public $memo; 
public $paymentPeriod;
public $pinType;
public $returnUrl;  
public $startingDate;
}  
?>