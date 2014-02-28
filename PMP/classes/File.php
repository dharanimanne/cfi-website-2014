<?php
		
	class File {
		
		public $id = null;
		public $fileName = null;
		public $uploadedOn = null;
		public $fileType = null;
		public $uploadedById = null;
		public $fileLocation = null;	
		public static $errorMessage;
		public static $errorCode;
		public static $successMessage;

		public function __construct( $data = array() ) {
			
			if( isset( $data['id'] ) ) 					$this->id = (int) $data['id'];
		    if( isset( $data['fileName'] ) ) 			$this->name = preg_replace( "/[^a-zA-Z0-9]/", "", $data['name'] );
			if( isset( $data['uploadedOn'] ) ) 			$this->uploadedOn =  $data['uploadedOn'];
			if( isset( $data['fileType'] ) ) 			$this->fileType = $data['fileType'];
			if( isset( $data['fileLocation'] ) ) 		$this->fileLocation = $data['fileLocation'];
			if( isset( $data['uploadedBy'] ) ) 			$this->uploadedBy = $data['uploadedBy'];
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
	
			if( !is_null( $this->id ) ) trigger_error( "File::insert(): Attempt to insert a file object that already has its ID property set to $this->id.", E_FILE_ERROR );
			
			// validation for malicious files, to be added...


			$this->uploadedOn = date("Y-m-d H:i:s");  
			
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "INSERT INTO ".TABLENAME_FILES." ( fileName, fileType, fileLocation, uploadedOn, uploadedBy) VALUES ( :fileName, :fileType, :fileLocation, :uploadedOn, :uploadedBy)";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":fileName", $this->fileName, PDO::PARAM_STR );
			$st->bindValue( ":fileType", $this->fileType, PDO::PARAM_STR );
			$st->bindValue( ":fileLocation", $this->fileLocation, PDO::PARAM_STR );	
			$st->bindValue( ":uploadedOn", $this->uploadedOn, PDO::PARAM_INT );
			$st->bindValue( ":uploadedBy", $this->uploadedBy, PDO::PARAM_STR );

		
			$result = $st->execute();
			$this->id = $conn->lastInsertId();
			$conn = null;
			
			if( !$result ){
				self::$errorMessage = "File::insert: Insertion Failed, PDO::errorInfo(): ".$st->errorCode().": ".$st->errorInfo()[2];
				self::$errorCode = $st->errorCode();
				return false;
			}
			else{		
				self::$successMessage = "File::insert: File successfully inserted with id ".$this->id;			
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
			if( is_null( $this->id ) ) trigger_error( "File::delete(): Attempt to delete a file object that does not have its ID property set.", E_FILE_ERROR );
			
			unlink( $this->fileLocation );

			//Delete the object
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$st = $conn->prepare ( "DELETE FROM ".TABLENAME_FILES." WHERE id = :id LIMIT 1" );
			$st->bindValue( ":id", $this->id, PDO::PARAM_INT );
			$st->execute();
			$conn = null;

			//yet to remove file from database.....
		}		
	}
?>