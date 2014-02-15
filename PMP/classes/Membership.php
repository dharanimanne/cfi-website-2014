<?php

//	require_once('Activity.php');
//	require_once('User.php');


	class Membership {

		public $id = null;
		public $userId = null;
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
	
			if( !is_null( $this->id ) ) trigger_error( "Membership::insert(): Attempt to insert a membership object that already has its ID property set to $this->id.", E_MEMBERSHIP_ERROR );
			
			$this->memberSince = date("Y-m-d H:i:s");

			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "INSERT INTO ".TABLENAME_MEMBERSHIP." ( userId, activityId, activityType, membershipType, memberSince) VALUES ( :userId, :activityId, :activityType, :membershipType, :memberSince )";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":userId", $this->userId, PDO::PARAM_INT );
			$st->bindValue( ":activityId", $this->activityId, PDO::PARAM_INT );
			$st->bindValue( ":activityType", $this->activityType, PDO::PARAM_STR );	
			$st->bindValue( ":membershipType", $this->membershipType, PDO::PARAM_STR );
			$st->bindValue( ":memberSince", $this->memberSince, PDO::PARAM_INT);	
			$result = $st->execute();
			$this->id = $conn->lastInsertId();
			$conn = null;
		//	print_r( $result );
	/*		echo $this->userId;
			echo "<br>";
			echo $this->activityId;
			echo "<br>";
			echo $this->activityType;
			echo "<br>";
			echo $this->membershipType;
			echo "<br>";
			echo $this->memberSince;
	*/
			if( !$result ){
				self::$errorMessage = "Membership::insert: Insertion Failed, PDO::errorInfo(): ".$st->errorCode().": ".$st->errorInfo()[2];
				self::$errorCode = $st->errorCode();
				return false;
			}
			else{		
				self::$successMessage = "Membership::insert: Membership successfully inserted with id ".$this->id;			
				return true;
			}
		}

		public function update(){
				
			//Does the object have an ID?
			if( is_null( $this->id ) ) trigger_error( "Membership::update(): Attempt to update a membership object that does not have its ID property set.", E_MEMBERSHIP_ERROR );
			
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );		
			$sql = "UPDATE ".TABLENAME_MEMBERSHIP." SET membershipType=:membershipType WHERE id = :id";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":membershipType", $this->membershipType, PDO::PARAM_STR );
			$st->execute();
			$conn = null;	
			
			return true;
		}

		public function delete(){
						
			//Does the object have an ID?
			if( is_null( $this->id ) ) trigger_error( "Membership::delete(): Attempt to delete a membership object that does not have its ID property set.", E_MEMBERSHIP_ERROR );
			
			//Delete the object
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$st = $conn->prepare ( "DELETE FROM ".TABLENAME_MEMBERSHIP." WHERE id = :id LIMIT 1" );
			$st->bindValue( ":id", $this->id, PDO::PARAM_INT );
			$st->execute();
			$conn = null;		
		}
	}

?>