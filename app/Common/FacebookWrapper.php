<?php

/**
 *	@see https://github.com/facebook/facebook/php-sdk-v4
 */

namespace App\Common;

use Facebook\FacebookRequest;
use Facebook\FacebookSession;
use Facebook\GraphUser;
use Log;
use Facebook\FacebookRequestException;
use Exception;

class FacebookWrapper {

	/**
	 *	The current facebook session
	 *	@var FacebookSession
	 */
	public $session = NULL;

	public function __construct($appSecretProof = false) {
		FacebookSession::setDefaultApplication(
				env('FACEBOOK_APP_ID', '316613108839801'),
				env('FACEBOOK_SECRET_ID', '2994f71dc31e2bfebb79dee05d3a2257')
			);
        
        FacebookSession::enableAppSecretProof($appSecretProof); 		
	}

	public function loginAsUser( $access_token ) {
		$this->session = new FacebookSession( $access_token );
		return $this;
	}

	public function loginAsApp() {
		$this->session = FacebookSession::newAppSession();
		return $this;
	}

	public function loginAsSignedRequest( $signed_request ) {
		$this->session = FacebookSession::newSessionFromSignedRequest( $signed_request );
		return $this;
	}

	public function isLoggedIn() {
		$logged = false;
		if ( !empty( $this->session ) ){
			try {
				$this->session->validate();
				$logged = true;
			}
			catch (FacebookRequestException $ex) {
			  	// Session not valid, Graph API returned an exception with the reason.
			  	Log::warning( $ex->getMessage() );
			} catch (Exception $ex) {
			  	// Graph API returned info, but it may mismatch the current app or have expired.
			  	Log::warning( $ex->getMessage() );
			}
			return $logged;
		}
		else return $logged;
	}

	public function makeRequest( $http_method , $path, $params = NULL, $version = NULL ) {
		return new FacebookRequest( $this->session , $http_method, $path, $params, $version );
	}

	public function post($path, $classname, $params=NULL, $version = NULL) {
		$profile = null;
		try {
			$profile = $this->makeRequest('POST', $path, $params, $version )->execute()->getGraphObject( $classname );
		}
		catch(FacebookRequestException $ex) {
			Log::warning( "Facebook Request Exception occured, code: " . $ex->getCode() . " with message: " . $ex->getMessage() );
			$profile =  array('error' => $ex->getMessage() );
		}
		catch (Exception $ex) {
			Log::warning( "Exception occured, code: " . $ex->getCode() . " with message: " . $ex->getMessage() );
			$profile =  array('error' => $ex->getMessage() );
		}
		return $profile;
	}

	public function get($path, $classname, $params=NULL, $version = NULL) {
		$profile = null;
		try {
			$profile = $this->makeRequest('GET', $path, $params, $version)->execute()->getGraphObject( $classname );
		}
		catch(FacebookRequestException $ex) {
			Log::warning( "Facebook Request Exception occured, code: " . $ex->getCode() . " with message: " . $ex->getMessage() );
			$profile =  array('error' => $ex->getMessage() );
		}
		catch (Exception $ex) {
			Log::warning( "Exception occured, code: " . $ex->getCode() . " with message: " . $ex->getMessage() );
			$profile =  array('error' => $ex->getMessage() );
		}
		return $profile;
	}

	public function getMe( $params=NULL, $version = NULL ) {
		$profile = null;
        
		try {
			$profile = $this->makeRequest('GET', '/me', $params, $version)->execute()->getGraphObject( GraphUser::className() );
		}
		catch(FacebookRequestException $ex) {
			Log::warning( "Facebook Request Exception occured, code: " . $ex->getCode() . " with message: " . $ex->getMessage() );
			$profile =  array('error' => $ex->getMessage() );
		}
		catch (Exception $ex) {
			Log::warning( "Exception occured, code: " . $ex->getCode() . " with message: " . $ex->getMessage() );
			$profile =  array('error' => $ex->getMessage() );
		}
		return $profile;
	}

	public function getUserById( $uid, $params=NULL, $version = NULL ) {
		$profile = null;
		try {
			$profile = $this->makeRequest('GET', '/'.$uid, $params, $version)->execute()->getGraphObject( GraphUser::className() );
		}
		catch(FacebookRequestException $ex) {
			Log::warning( "Facebook Request Exception occured, code: " . $ex->getCode() . " with message: " . $ex->getMessage() );
			$profile =  array('error' => $ex->getMessage() );
		}
		catch (Exception $ex) {
			Log::warning( "Exception occured, code: " . $ex->getCode() . " with message: " . $ex->getMessage() );
			$profile =  array('error' => $ex->getMessage() );
		}
		return $profile;
	}


}