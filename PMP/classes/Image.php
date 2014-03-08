<?php
		
	class image {
		
		public $id = null;
		public $imageName = null;
		public $uploadedOn = null;
		public $imageType = null;
		public $uploadedBy = null;
		public $imageLocation = null;	
		public static $errorMessage;
		public static $errorCode;
		public static $successMessage;

		public function __construct( $data = array() ) {
			
			if( isset( $data['id'] ) ) 					$this->id = (int) $data['id'];
		    if( isset( $data['imageName'] ) ) 			$this->imageName = $data['imageName'] ;
			if( isset( $data['uploadedOn'] ) ) 			$this->uploadedOn =  $data['uploadedOn'];
			if( isset( $data['imageType'] ) ) 			$this->imageType = $data['imageType'];
			if( isset( $data['imageLocation'] ) ) 		$this->imageLocation = $data['imageLocation'];
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
	
			if( !is_null( $this->id ) ) trigger_error( "image::insert(): Attempt to insert a image object that already has its ID property set to $this->id.", E_IMAGE_ERROR );
			
			// validation for malicious images, to be added...


			$this->uploadedOn = date("Y-m-d H:i:s");  
			
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "INSERT INTO ".TABLENAME_IMAGE." ( imageName, imageType, imageLocation, uploadedOn, uploadedBy) VALUES ( :imageName, :imageType, :imageLocation, :uploadedOn, :uploadedBy)";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":imageName", $this->imageName, PDO::PARAM_STR );
			$st->bindValue( ":imageType", $this->imageType, PDO::PARAM_STR );
			$st->bindValue( ":imageLocation", $this->imageLocation, PDO::PARAM_STR );	
			$st->bindValue( ":uploadedOn", $this->uploadedOn, PDO::PARAM_INT );
			$st->bindValue( ":uploadedBy", $this->uploadedBy, PDO::PARAM_STR );
			
			$result = $st->execute();
			$this->id = $conn->lastInsertId();
			$conn = null;
			
			if( !$result ){
				self::$errorMessage = "image::insert: Insertion Failed, PDO::errorInfo(): ".$st->errorCode().": ".$st->errorInfo()[2];
				self::$errorCode = $st->errorCode();
				return false;
			}
			else{		
				self::$successMessage = "image::insert: image successfully inserted with id ".$this->id;			
				return true;
			}
		}
	

/*
		public static function getById( $id ){
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "SELECT *, UNIX_TIMESTAMP(joinDateTime) AS joinDateTime, UNIX_TIMESTAMP(lastLoginDateTime) AS lastLoginDateTime FROM ".TABLENAME_IMAGE." WHERE id = :id ";
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
			$sql = "SELECT *, UNIX_TIMESTAMP(joinDateTime) AS joinDateTime, UNIX_TIMESTAMP(lastLoginDateTime) AS lastLoginDateTime FROM ".TABLENAME_IMAGE." WHERE username = :username ";
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
			$sql = "SELECT *, UNIX_TIMESTAMP(joinDateTime) AS joinDateTime, UNIX_TIMESTAMP(lastLoginDateTime) AS lastLoginDateTime FROM ".TABLENAME_IMAGE." WHERE email = :email ";
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
			if( is_null( $this->id ) ) trigger_error( "image::delete(): Attempt to delete a image object that does not have its ID property set.", E_IMAGE_ERROR );
			
			unlink( $this->imageLocation );

			//Delete the object
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$st = $conn->prepare ( "DELETE FROM ".TABLENAME_IMAGE." WHERE id = :id LIMIT 1" );
			$st->bindValue( ":id", $this->id, PDO::PARAM_INT );
			$st->execute();
			$conn = null;

			//yet to remove image from database.....
		}		
	}
?>