<?php

require_once('tmhOAuth.php');
require_once('tmhUtilities.php');
require_once('OAuth.php');
/**
 * Twitter OAuth class
 */
class TwitterOAuth {

	/** 
     * This variable holds the tmhOAuth object used throughout the class 
     * 
     * @var tmhOAuth An object of the tmhOAuth class 
     */  
    public $tmhOAuth;  
    /** 
     * User's Twitter account data 
     * 
     * @var array Information on the current authenticated user 
     */  
    public $userdata;  
    /** 
     * Authentication state 
     * 
     * Values: 
     *  - 0: not authed 
     *  - 1: Request token obtained 
     *  - 2: Access token obtained (authed) 
     * 
     * @var int The current state of authentication 
     */  
    protected $state;  
    /** 
     * Initialize a new TwitterApp object 
     * 
     * @param tmhOAuth $tmhOAuth A tmhOAuth object with consumer key and secret 
     */  
	 public $http_code;
	  /* Respons format. */
	 public $format = 'json';
	  /* Decode returned json data. */
	 public $decode_json = TRUE;
	  
    public function  __construct($consumer_key, $consumer_secret, $oauth_token = NULL, $oauth_token_secret = NULL) {  
        // save the tmhOAuth object  
		$config = array('consumer_key' => $consumer_key, 'consumer_secret' => $consumer_secret, 'user_token' => $oauth_token, 'user_secret' => $oauth_token_secret);
        $this->tmhOAuth = new tmhOAuth($config);  
		$this->consumer = new OAuthConsumer($consumer_key, $consumer_secret);
		if (!empty($oauth_token) && !empty($oauth_token_secret)) {
		  $this->token = new OAuthConsumer($oauth_token, $oauth_token_secret);
		} else {
		  $this->token = NULL;
		}
    }  
	
	public function getRequestToken($oauth_callback = NULL) {  
		// send request for a request token  
		tmhUtilities::auto_fix_time_request($this->tmhOAuth,"POST", $this->tmhOAuth->url("oauth/request_token", ""), array(  
			// pass a variable to set the callback  
			'oauth_callback'    => $oauth_callback 
		));  
		/*
		$this->tmhOAuth->request("POST", $this->tmhOAuth->url("oauth/request_token", ""), array(  
			// pass a variable to set the callback  
			'oauth_callback'    => $oauth_callback 
		));  
		*/
		$this->http_code = $this->tmhOAuth->response["code"];
		/*
		echo '<hr>';
		echo $this->tmhOAuth->response["response"];
		*/
		if($this->tmhOAuth->response["code"] == 200) {  
			// get and store the request token  
			$response = $this->tmhOAuth->extract_params($this->tmhOAuth->response["response"]);
			
			/*
			$_SESSION["authtoken"] = $response["oauth_token"];  
			$_SESSION["authsecret"] = $response["oauth_token_secret"];  
			// state is now 1  
			$_SESSION["authstate"] = 1;  
			*/
			// redirect the user to Twitter to authorize  
			$url = $this->tmhOAuth->url("oauth/authorize", "") . '?oauth_token=' . $response["oauth_token"]; 
			
			$this->token = new OAuthConsumer($response['oauth_token'], $response['oauth_token_secret']);
			return $response; 
		}  
		return false;  
	}  
	
	public function getAuthorizeURL($token, $sign_in_with_twitter = TRUE) {
		if (is_array($token)) {
		  $token = $token['oauth_token'];
		}
		if (empty($sign_in_with_twitter)) {
		  //return $this->authorizeURL() . "?oauth_token={$token}";
		  return $this->tmhOAuth->url("oauth/authorize", "") . '?oauth_token=' . $token; 
		} else {
		   //return $this->authenticateURL() . "?oauth_token={$token}";
		  return $this->tmhOAuth->url("oauth/authenticate", "") . '?oauth_token=' . $token;  
		}
  	}
	
	public function getAccessToken($oauth_verifier = FALSE) {
		 $this->tmhOAuth->request("POST", $this->tmhOAuth->url("oauth/access_token", ""), array(  
        // pass the oauth_verifier received from Twitter  
        'oauth_verifier'    => $_GET["oauth_verifier"]  
    	));  
		$this->http_code = $this->tmhOAuth->response["code"];
    	if($this->tmhOAuth->response["code"] == 200) {  
			// get the access token and store it in a cookie  
			$response = $this->tmhOAuth->extract_params($this->tmhOAuth->response["response"]);  
			/*
			setcookie("access_token", $response["oauth_token"], time()+3600*24*30);  
			setcookie("access_token_secret", $response["oauth_token_secret"], time()+3600*24*30);  
			// state is now 2  
			$_SESSION["authstate"] = 2;  
			*/
			// redirect user to clear leftover GET variables 
			 $this->token = new OAuthConsumer($response['oauth_token'], $response['oauth_token_secret']);
    		return $response; 
		}  
		return false;  
	}
	
	//public function post($text) {  
	public function post($url, $parameters = array()) {
		if($parameters['status']){
			$parameters['status'] = substr($parameters['status'], 0, 140);  
		}
		// POST the text to the statuses/update method  
		$this->tmhOAuth->request("POST", $this->tmhOAuth->url("1/".$url), $parameters);  
		$this->http_code = $this->tmhOAuth->response["code"];
		if ($this->format === 'json' && $this->decode_json) {
		  	return json_decode($response);
		}
		return $response;
	} 

}
