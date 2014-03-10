<?php
	
		
	class Message {
		
		public $id = null;
		public $from_username = null;
		public $to_username = null;
		public $message = null;
		public $messageSentTime  = null;
		public $isReceived = null;
		public $isRead = null;
		public $tags = null;
		public $activityId = null;
		
		public static $errorMessage;
		public static $errorCode;
		public static $successMessage;

		public function __construct( $data = array() ) {
			
		    if( isset( $data['from_username'] ) ) $this->from_username = $data['from_username'];
			if( isset( $data['to_username'] ) ) $this->to_username = preg_replace ( "/[^\.\@\_ a-zA-Z0-9]/", "", $data['to_username'] );	
			if( isset( $data['message'] ) ) $this->message = $data['message'];
			if( isset( $data['messageSentTime'] ) ) $this->messageSentTime = $data['messageSentTime'];
			if( isset( $data['isReceived'] ) ) $this->isReceived = $data['isReceived'];
			if( isset( $data['isRead'] ) ) $this->isRead = $data['isRead'];
	        if( isset( $data['tags'] ) ) $this->tags = $data['tags'];
	        if( isset( $data['activityId'] ) ) $this->activityId = $data['activityId'];
					
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
			if( !is_null( $this->id ) ) trigger_error( "User::insert(): Attempt to insert a message object that already has its ID property set to $this->id.", E_USER_ERROR );
			
			// Set Values		
			$this->messageSentTime = date("Y-m-d H:i:s");   
			   
			// Validation
			/*   
			else if( strlen( $this->to_username ) < MINIMUM_NAME_LENGTH || preg_match("/[^a-zA-Z'-]/", $this->to_username) ){
				self::$errorCode ="ERR_INV_NAME";
				return false;
			}
			*/
			
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "INSERT INTO ".TABLENAME_MESSAGES." ( from_username, to_username, message, messageSentTime, tags, activityId) VALUES ( :from_username, :to_username, :message, :messageSentTime, :tags, :activityId)";
			
			$st = $conn->prepare( $sql );
			$st->bindValue( ":from_username", $this->from_username, PDO::PARAM_STR );		
			$st->bindValue( ":to_username", $this->to_username, PDO::PARAM_STR );	
			$st->bindValue( ":message", $this->message, PDO::PARAM_STR );				
			$st->bindValue( ":messageSentTime", $this->messageSentTime, PDO::PARAM_INT);			
			$st->bindValue( ":tags", $this->tags, PDO::PARAM_STR );				
			$st->bindValue( ":activityId", $this->activityId, PDO::PARAM_INT );				
			$result = $st->execute();			
			$this->id = $conn->lastInsertId();		
			$conn = null;
			
			if( !$result ){
				$err = $st->errorInfo();
				self::$errorMessage = "message::insert: Insertion Failed, PDO::errorInfo(): ".$st->errorCode().": ".$err[2];
				self::$errorCode = $st->errorCode();
				return false;
			}
			else{		
				self::$successMessage = "User::insert: message successfully created with id: ".$this->id;			
				return true;
				echo "successfully inserted!";
			}
		}
	
		
		public static function getById( $id ){
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "SELECT *, UNIX_TIMESTAMP(messageSentTime) AS messageSentTime FROM ".TABLENAME_MESSAGES." WHERE id = :id ";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":id", $id, PDO::PARAM_INT );
			$st->execute();
			$row = $st->fetch();
			$conn = null;
			if( $row ) return new Message( $row );
		}
		
		public static function getBytags( $tags ){
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "SELECT *, UNIX_TIMESTAMP(messageSentTime) AS messageSentTime FROM ".TABLENAME_MESSAGES." WHERE tags = :tags ";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":tags", $tags, PDO::PARAM_STR );
			$st->execute();
			$row = $st->fetchAll();
			$conn = null;
			if( $row ) return new  $row ;
		}	
		
		public static function getBytoUsername( $username ){  //all messages user received 
			$username = trim( $username );
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "SELECT *, UNIX_TIMESTAMP(messageSentTime) AS messageSentTime FROM ".TABLENAME_MESSAGES." WHERE to_username = :username ";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":username", $username, PDO::PARAM_STR );
			$st->execute();
			$row = $st->fetchAll();
			$conn = null;
			if( $row ) return  $row ;
		}
		public static function getByfromUsername( $username ){  //all messages user sent
				$username = trim( $username );
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "SELECT *, UNIX_TIMESTAMP(messageSentTime) AS messageSentTime FROM ".TABLENAME_MESSAGES." WHERE from_username = :username ";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":username", $username, PDO::PARAM_STR );
			$st->execute();
			$row = $st->fetchAll();
			$conn = null;
			if( $row ) return  $row ;
		}
		public static function getByConversation( $from_username,$to_username ){  //conversation between two people
			$from_username = trim( $from_username );
			$to_username = trim( $to_username );
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			//if(isset($from_username)&&!isset(to_username))
			//$sql = "SELECT *, UNIX_TIMESTAMP(messageSentTime) AS messageSentTime FROM ".TABLENAME_messages." WHERE from_username = :from_username ";
			//elseif(!isset($from_username) && isset($to_username))
			//$sql = "SELECT *, UNIX_TIMESTAMP(messageSentTime) AS messageSentTime FROM ".TABLENAME_messages." WHERE to_username = :to_username ";
			//else
			$sql = "SELECT *, UNIX_TIMESTAMP(messageSentTime) AS messageSentTime FROM ".TABLENAME_MESSAGES." WHERE (to_username = :to_username AND from_username = :from_username)  OR (to_username = :from_username AND from_username = :to_username)";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":from_username", $from_username, PDO::PARAM_STR );
			$st->bindValue( ":to_username", $to_username, PDO::PARAM_STR );
			$st->execute();
			$row = $st->fetchAll();
			$conn = null;
			if( $row ) return  $row ;
		}
			public static function getByTagReceived( $tags,$to_username ){  //all messages in that activity received
				$tags = trim( $tags );
				$to_username = trim( $to_username );
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "SELECT *, UNIX_TIMESTAMP(messageSentTime) AS messageSentTime FROM ".TABLENAME_MESSAGES." WHERE to_username = :to_username AND tags=:tags ";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":to_username", $to_username, PDO::PARAM_STR );
			$st->bindValue( ":tags", $tags, PDO::PARAM_STR );
			$st->execute();
			$row = $st->fetchAll();
			$conn = null;
			if( $row ) return  $row ;
		}
	public static function getByTagSent( $tags,$from_username ){  //all messages in that activity Sent
				$tags = trim( $tags );
				$from_username = trim( $from_username );
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "SELECT *, UNIX_TIMESTAMP(messageSentTime) AS messageSentTime FROM ".TABLENAME_MESSAGES." WHERE from_username = :from_username AND tags=:tags ";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":from_username", $from_username, PDO::PARAM_STR );
			$st->bindValue( ":tags", $tags, PDO::PARAM_STR );
			$st->execute();
			$row = $st->fetchAll();
			$conn = null;
			if( $row ) return  $row ;
		}
		
		public function delete(){
						
			//Does the object have an ID?
			if( is_null( $this->id ) ) trigger_error( "User::delete(): Attempt to delete a message object that does not have its ID property set.", E_USER_ERROR );
			
			//Delete the object
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$st = $conn->prepare ( "DELETE FROM ".TABLENAME_messages." WHERE id = :id LIMIT 1" );
			$st->bindValue( ":id", $this->id, PDO::PARAM_INT );
			$st->execute();
			$conn = null;		
		}
		
		public function getAllMessages($username, $activityId){
			
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "SELECT *, UNIX_TIMESTAMP(messageSentTime) AS messageSentTime FROM ".TABLENAME_MESSAGES." WHERE (( (to_username = :to_username AND activityId = $activityId) OR to_username = 'globalMessage' OR to_username = 'activity.".$activityId."') OR (from_username = :from_username AND to_username = 'activity.".$activityId."')) ORDER BY messageSentTime DESC"; 
			$st = $conn->prepare( $sql );
			$st->bindValue( ":from_username", $username, PDO::PARAM_STR );
			$st->bindValue( ":to_username", $username, PDO::PARAM_STR );
			$st->execute();
			$conn = null;		
			$result = $st->fetchAll();
			//print_r($result);
			return $result;
		}	

	
	}
?>