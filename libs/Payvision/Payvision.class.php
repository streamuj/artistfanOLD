<?php 
class Payvision {

    private $postUrl = 'https://testprocessor.payvisionservices.com/Gateway/BasicOperations.asmx/Payment';
    private $request;
    private $response;
    private $memberId;
    private $memberGuid;

    private $_xml_elementName;
    private $_xml_elementValue;

    private $request_fields = array('countryId', 'amount',
        'currencyId', 'trackingMemberCode', 'cardNumber', 'cardHolder',
        'cardExpiryMonth', 'cardExpiryYear', 'cardCvv', 'cardType', 'issueNumber',
        'merchantAccountType', 'dynamicDescriptor', 'avsAddress', 'avsZip');

    private $default_values = array(
        'currencyId' => 840,
        'merchantAccountType' => 1
        );

    public function __construct($memberId, $memberGuid) 
    {
        $this->memberId = $memberId;
        $this->memberGuid = $memberGuid;
    }

    private function setRequest($array)
    {
        $this->request = '';
        $this->request .= 'memberId=' . $this->memberId . '&';
        $this->request .= 'memberGuid=' . $this->memberGuid . '&';
        foreach($this->request_fields as $item)
        {
            if(!empty($array[$item]))
            {
                $this->request .= $item . '=' . urlencode($array[$item]) . '&';
            }
            else if(!empty($this->default_values[$item]))
            {
                $this->request .= $item . '=' . urlencode($this->default_values[$item]) . '&';
            }
            else
            {
                $this->request .= $item . '=&';
            }
        }
        $this->request = rtrim($this->request, '& ');
    }

    public function sendRequest($array)
    {
        $this->setRequest($array);
        $header = array();
        $header[] = 'Content-Type: application/x-www-form-urlencoded';
        $header[] = 'Content-length: ' . strlen($this->request);

        $curl_request = curl_init($this->postUrl);
        curl_setopt($curl_request, CURLOPT_POST, 1);
        curl_setopt($curl_request, CURLOPT_POSTFIELDS, $this->request);
        curl_setopt($curl_request, CURLOPT_HEADER, 0);
        curl_setopt($curl_request, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl_request, CURLOPT_TIMEOUT, 45);
        curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_request, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER, FALSE);

        $result = curl_exec($curl_request);
        
        $succeeded  = curl_errno($curl_request) == 0 ? true : false;
        curl_close($curl_request);

        if($succeeded)
        {
            $this->setResponse($result);
        }
        else
        {
            $this->response['Result'] = 100;//curl error
        }
    }
    
    private function startElement($parser, $name, $attrs='')
    {
        $this->_xml_elementName = $name;
    }
    
    private function elementData($parser, $data)
    {
        $this->_xml_elementValue .= $data;
    }
    
    private function endElement($parser, $name)
    {
        
         $this->response[$this->_xml_elementName] = trim($this->_xml_elementValue);
         $this->_xml_elementName = "";
         $this->_xml_elementValue = "";
    }

    private function setResponse($string)
    {

        $xml_parser = xml_parser_create();
        $string =  preg_replace("/\n/", "", $string);
        
        xml_parser_set_option($xml_parser, XML_OPTION_CASE_FOLDING, FALSE);
        xml_set_element_handler($xml_parser, array($this, "startElement"), array($this, "endElement"));
        xml_set_character_data_handler($xml_parser, array($this, "elementData"));

        $result = xml_parse($xml_parser, $string);
        if($result == 0 || !isset($this->response['Result']))
        {
            $this->response['Result'] = 100;//error xml parsing
        }

        xml_parser_free($xml_parser);
    }

    public function getResponse()
    {
        return $this->response;
    }
}
?>
