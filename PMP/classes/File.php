<?php
	require_once('Password.php');
	require_once('Activity.php');
	define("MINIMUM_NAME_LENGTH", 4);
	define("MINIMUM_ROLLNO_LENGTH", 8);
	define("MINIMUM_PASSWORD_LENGTH", 6);
		
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
		    if( isset( $data['flieName'] ) ) 				$this->name = preg_replace( "/[^a-zA-Z0-9]/", "", $data['name'] );
			}
			if( isset( $data['uploadedOn'] ) ) 		$this->uploadedOn =  $data['uploadedOn'];
			if( isset( $data['fileType'] ) ) 			$this->fileType = $data['fileType'];
			if( isset( $data['fileLocation'] ) ) 			$this->fileLocation = $data['fileLocation'];
			
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
			
			// Set Values
			// Validation
			if( !filter_var( $this->email, FILTER_VALIDATE_EMAIL ) ){
				self::$errorCode ="ERR_INV_EMAIL";
				return false;
			}
			else if( strlen( $this->name ) < MINIMUM_NAME_LENGTH || preg_match("/[^a-zA-Z'-]/", $this->name) ){
				self::$errorCode ="ERR_INV_NAME";
				return false;
			}
			else if( strlen( $this->phone ) != 10 || preg_match("/[^[0-9]{10}]/", $this->phone) ){
				self::$errorCode ="ERR_INV_PHONE";
				return false;
			}
			else if( strlen( $this->rollNo ) < MINIMUM_ROLLNO_LENGTH || preg_match("/[^a-zA-Z0-9'-]/", $this->rollNo) ){
				self::$errorCode ="ERR_INV_ROLL";
				return false;
			}
			
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "INSERT INTO ".TABLENAME_FILES." ( fileName, fileType, fileLocation, uploadedOn, uploadedById) VALUES ( :fileName, :fileType, :fileLocation, :uploadedOn, :uploadedById)";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":fileName", $this->fileName, PDO::PARAM_STR );
			$st->bindValue( ":fileType", $this->fileType, PDO::PARAM_STR );
			$st->bindValue( ":fileLocation", $this->fileLocation, PDO::PARAM_STR );	
			$st->bindValue( ":uploadedOn", $this->uploadedOn, PDO::PARAM_INT );

		//	What to do with userId>
		//	$st->bindValue( ":phone", $this->phone, PDO::PARAM_STR );
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
			
			//Delete the object
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$st = $conn->prepare ( "DELETE FROM ".TABLENAME_FILES." WHERE id = :id LIMIT 1" );
			$st->bindValue( ":id", $this->id, PDO::PARAM_INT );
			$st->execute();
			$conn = null;		
		}		
	}
?>