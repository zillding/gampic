<?php
/**
 * Twitter model
 */
Class Twitter
{
	private $_consumerKey = 'l0v2ziRQal9GRz2d4ETA';
	private $_consumerSecret = 'uKKfMYwiECQx2B9sAMV8gWR60N9v0LDh0G6B4DV7s4';

	public $tmhOAuth;
	public $userdata;

	public function __construct()
	{
		// import the lib
		Yii::import('ext.tmhOAuth.*');
		// initialize the oauth instance
		$this->tmhOAuth = new tmhOAuth(array(
			'consumer_key'    => $this->_consumerKey,
			'consumer_secret' => $this->_consumerSecret,
		));
	}

	/**
	 * Obtain a request token from Twitter
	 *
	 * @return bool False if request failed
	 */
	public function getRequestToken() {
		$params = array('oauth_callback' => tmhUtilities::php_self(),
			'x_auth_access_type' => 'write');

		// send request for a request token
		$code = $this->tmhOAuth->request("POST", $this->tmhOAuth->url("oauth/request_token", ""), $params);
		if($code == 200) {
			// get and store the request token
			$_SESSION['oauth'] = $this->tmhOAuth->extract_params($this->tmhOAuth->response['response']);
			// state is now 1
			$_SESSION["authstate"] = 1;
			// set the url to redirect user to twitter
			$url = $this->tmhOAuth->url("oauth/authorize", "") . '?oauth_token=' . $_SESSION["oauth"]["oauth_token"];
			header("Location: " . $url);
			exit;
		}
		return false;
	}

	/**
	 * Obtain an access token from Twitter
	 *
	 * @return bool False if request failed
	 */
	public function getAccessToken() {
		// set the request token and secret we have stored
		$this->tmhOAuth->config["user_token"] = $_SESSION["oauth"]["oauth_token"];
		$this->tmhOAuth->config["user_secret"] = $_SESSION["oauth"]["oauth_token_secret"];
		// send request for an access token
		$params = array('oauth_verifier'=>r('oauth_verifier'));
		$code = $this->tmhOAuth->request("POST", $this->tmhOAuth->url("oauth/access_token", ""), $params);
		if($code == 200) {
			unset($_SESSION['oauth']);
			// get the access token and store it in a cookie
			$_SESSION["access_token"] = $this->tmhOAuth->extract_params($this->tmhOAuth->response["response"]);
			// setcookie("access_token", $response["oauth_token"], time()+3600*24*30);
			// setcookie("access_token_secret", $response["oauth_token_secret"], time()+3600*24*30);
			// state is now 2
			$_SESSION["authstate"] = 2;
			// redirect user to clear leftover GET variables
			header("Location: " . tmhUtilities::php_self());
			exit;
		}
		return false;
	}

	/**
	 * Verify the validity of our access token
	 *
	 * @return bool Access token verified
	 */
	public function verifyAccessToken() {
		$this->tmhOAuth->config["user_token"] = $_SESSION["access_token"]["oauth_token"];
		$this->tmhOAuth->config["user_secret"] = $_SESSION["access_token"]["oauth_token_secret"];
		// send verification request to test access key
		$code = $this->tmhOAuth->request("GET", $this->tmhOAuth->url("1/account/verify_credentials"));
		if ($code == 200) {
			// store the user data returned from the API
			$this->userdata = json_decode($this->tmhOAuth->response["response"]);
			return true;
		}
		return false;
	}
}
