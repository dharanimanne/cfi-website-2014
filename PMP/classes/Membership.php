<?php

	require_once('Activity.php');
	require_once('User.php');

	class Membership {

		public $id = null;
		public $userId - null;
		public $activityId = null;
		public $activityType = null;
		public $membershipType = null;
		public $memberSince = null;
		public static $errorMessage;
		public static $errorCode;
		public static $successMessage;

		public function __construct( $data = array() ) {
			
			if( isset( $data['id'] ) ) 					$this->id = (int) $data['id'];
			// if( isset( $data['username'] ) ) 		$this->username = preg_replace ( "/[^\.\@\_ a-zA-Z0-9]/", "", $data['username'] );
			if( isset( $data['userId'] ) ) 				$this->userId = (int) $data['userId'];
			if( isset( $data['activityId'] ) ) 			$this->activityId = (int) $data['activityId'];
		    if( isset( $data['activityType'] ) ) 		$this->activityType = $data['activityType'];
			if( isset( $data['membershipType'] ) ) 		$this->membershipType = $data['membershipType'];
			if( isset( $data['memberSince'] ) ) 		$this->memberSince =  $data['memberSince'];
		}

		public static function errorInfo(){
			return self::$errorMessage;
		}
		
		public static function errorCode(){
			return self::$errorCode;
		}
		
		public function storeFormValues( $params ){
			$this->__construct( $params );
		}

		public function insert(){
	
			if( !is_null( $this->id ) ) trigger_error( "User::insert(): Attempt to insert a user object that already has its ID property set to $this->id.", E_USER_ERROR );
			
			$this->joinDateTime = date("Y-m-d H:i:s");	
		}
	}

?>