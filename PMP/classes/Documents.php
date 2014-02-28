<?php
		
	class Documents {
		
		public $id = null;
		public $DocName = null;
		public $uploadedOn = null;
		public $tags = null;
		public $uploadedBy = null;
		public $DocLocation = null;
		public $activityId = null;
		public static $errorMessage;
		public static $errorCode;
		public static $successMessage;

		public function __construct( $data = array() ) {
			
			if( isset( $data['id'] ) ) 					$this->id = (int) $data['id'];
		    if( isset( $data['DocName'] ) ) 			$this->DocName = $data['DocName'] ;
			if( isset( $data['uploadedOn'] ) ) 			$this->uploadedOn =  $data['uploadedOn'];
			if( isset( $data['tags'] ) ) 				$this->tags = $data['tags'];
			if( isset( $data['DocLocation'] ) ) 		$this->DocLocation = $data['DocLocation'];
			if( isset( $data['uploadedBy'] ) ) 			$this->uploadedBy = $data['uploadedBy'];
			if( isset( $data['activityId'] ) )			$this->activityId = $data['activityId'];
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
	
			if( !is_null( $this->id ) ) trigger_error( "DOCUMENT::insert(): Attempt to insert a DOCUMENT object that already has its ID property set to $this->id.", E_DOCUMENT_ERROR );
			
			// validation for malicious Docs, to be added...


			$this->uploadedOn = date("Y-m-d H:i:s");
			
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "INSERT INTO ".TABLENAME_DOCUMENTS." ( DocName, tags, DocLocation, uploadedOn, uploadedBy) VALUES ( :DocName, :tags, :DocLocation, :uploadedOn, :uploadedBy)";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":DocName", $this->DocName, PDO::PARAM_STR );
			$st->bindValue( ":tags", $this->tags, PDO::PARAM_STR );
			$st->bindValue( ":DocLocation", $this->DocLocation, PDO::PARAM_STR );
			$st->bindValue( ":uploadedOn", $this->uploadedOn, PDO::PARAM_INT );
			$st->bindValue( ":uploadedBy", $this->uploadedBy, PDO::PARAM_STR );


			$result = $st->execute();
			$this->id = $conn->lastInsertId();
			$conn = null;
			
			if( !$result ){
				self::$errorMessage = "DOCUMENT::insert: Insertion Failed, PDO::errorInfo(): ".$st->errorCode().": ".$st->errorInfo()[2];
				self::$errorCode = $st->errorCode();
				return false;
			}
			else{
				self::$successMessage = "DOCUMENT::insert: DOCUMENT successfully inserted with id ".$this->id;
				return true;
			}
		}

/*
		public static function getById( $id ){
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "SELECT *, UNIX_TIMESTAMP(joinDateTime) AS joinDateTime, UNIX_TIMESTAMP(lastLoginDateTime) AS lastLoginDateTime FROM ".TABLENAME_USERS." WHERE id = :id ";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":id", $id, PDO::PARAM_INT );
			$st->execute();
			$row = $st->fetch();
			$conn = null;
			if( $row ) return new User( $row );
		}
			
		
		public static function getByUsername( $username ){
			$username = trim( $username );
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "SELECT *, UNIX_TIMESTAMP(joinDateTime) AS joinDateTime, UNIX_TIMESTAMP(lastLoginDateTime) AS lastLoginDateTime FROM ".TABLENAME_USERS." WHERE username = :username ";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":username", $username, PDO::PARAM_STR );
			$st->execute();
			$row = $st->fetch();
			$conn = null;
			if( $row ) return new User( $row );
		}

		public static function getByEmail( $email ){
			$email = trim( $email );
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "SELECT *, UNIX_TIMESTAMP(joinDateTime) AS joinDateTime, UNIX_TIMESTAMP(lastLoginDateTime) AS lastLoginDateTime FROM ".TABLENAME_USERS." WHERE email = :email ";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":email", $email, PDO::PARAM_STR );
			$st->execute();
			$row = $st->fetch();
			$conn = null;
			if( $row ) return new User( $row );
		}
*/		
		public function delete(){
						
			//Does the object have an ID?
			if( is_null( $this->id ) ) trigger_error( "DOCUMENT::delete(): Attempt to delete a DOCUMENT object that does not have its ID property set.", E_DOCUMENT_ERROR );
			
			unlink( $this->DocLocation );

			//Delete the object
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$st = $conn->prepare ( "DELETE FROM ".TABLENAME_DOCUMENTS." WHERE id = :id LIMIT 1" );
			$st->bindValue( ":id", $this->id, PDO::PARAM_INT );
			$st->execute();
			$conn = null;

			//yet to remove DOCUMENT from database.....
		}		
	}
?>