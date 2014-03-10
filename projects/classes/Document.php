<?php
		
	class Document {
		
		public $id = null;
		public $docName = null;
		public $uploadedOn = null;
		public $tags = null;
		public $uploadedBy = null;
		public $docLocation = null;
		public $activityId = null;
		public static $errorMessage;
		public static $errorCode;
		public static $successMessage;

		public function __construct( $data = array() ) {
			
			if( isset( $data['id'] ) ) 					$this->id = (int) $data['id'];
		    if( isset( $data['docName'] ) ) 			$this->docName = $data['docName'] ;
			if( isset( $data['uploadedOn'] ) ) 			$this->uploadedOn =  $data['uploadedOn'];
			if( isset( $data['tags'] ) ) 				$this->tags = $data['tags'];
			if( isset( $data['docLocation'] ) ) 		$this->docLocation = $data['docLocation'];
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
	
			if( !is_null( $this->id ) ) trigger_error( "DOCUMENT::insert(): Attempt to insert a document object that already has its ID property set to $this->id.", E_DOCUMENT_ERROR );
			
			// validation for malicious docs, to be added...


			$this->uploadedOn = date("Y-m-d H:i:s");
			
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "INSERT INTO ".TABLENAME_DOCUMENT." ( docName, tags, docLocation, uploadedOn, uploadedBy, activityId) VALUES ( :docName, :tags, :docLocation, :uploadedOn, :uploadedBy, :activityId)";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":docName", $this->docName, PDO::PARAM_STR );
			$st->bindValue( ":tags", $this->tags, PDO::PARAM_STR );
			$st->bindValue( ":docLocation", $this->docLocation, PDO::PARAM_STR );
			$st->bindValue( ":uploadedOn", $this->uploadedOn, PDO::PARAM_INT );
			$st->bindValue( ":uploadedBy", $this->uploadedBy, PDO::PARAM_STR );
			$st->bindValue( ":activityId", $this->activityId, PDO::PARAM_INT );


			$result = $st->execute();
			$this->id = $conn->lastInsertId();
			$conn = null;
			
			if( !$result ){
				self::$errorMessage = "DOCUMENT::insert: Insertion Failed, PDO::errorInfo(): ".$st->errorCode().": ".$st->errorInfo()[2];
				self::$errorCode = $st->errorCode();
				return false;
			}
			else{
				self::$successMessage = "DOCUMENT::insert: document successfully inserted with id ".$this->id;
				return true;
			}
		}
		
		public function getDocumentByActivityId($activityId){		
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = 'SELECT id, docName, docLocation, tags, uploadedBy, uploadedOn FROM '. TABLENAME_DOCUMENT .' WHERE activityId ='. $activityId ;
	
			$st=$conn->prepare($sql);
			$st->execute();
			$row = $st->fetchAll();
			$conn = null;	
			
			return $row;
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
			if( is_null( $this->id ) ) trigger_error( "docUMENT::delete(): Attempt to delete a docUMENT object that does not have its ID property set.", E_DOCUMENT_ERROR );
			
			unlink( $this->docLocation );

			//Delete the object
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$st = $conn->prepare ( "DELETE FROM ".TABLENAME_DOCUMENT." WHERE id = :id LIMIT 1" );
			$st->bindValue( ":id", $this->id, PDO::PARAM_INT );
			$st->execute();
			$conn = null;

			//yet to remove docUMENT from database.....
		}

		public function deleteById( $docId, $activityId ){
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			
			$st = $conn->prepare ( "SELECT * FROM ".TABLENAME_DOCUMENT." WHERE id = :docId AND activityId = :activityId" );
			$st->bindValue( ":docId", $docId, PDO::PARAM_INT );
			$st->bindValue( ":activityId", $activityId, PDO::PARAM_INT );
			$st->execute();
			if( $st->rowCount() > 0){
				$row = $st->fetch();
				$docLocation = FILE_UPLOAD_LOCATION."/Documents/".$activityId."/".$row["DocName"];
				unlink( $docLocation );
			}
			else
				return false;
			
			$st = $conn->prepare ( "DELETE FROM ".TABLENAME_DOCUMENT." WHERE id = :docId AND activityId = :activityId" );
			$st->bindValue( ":docId", $docId, PDO::PARAM_INT );
			$st->bindValue( ":activityId", $activityId, PDO::PARAM_INT );
			$st->execute();
			$conn=null;
			
			if( $st->rowCount() > 0)
				return true;
			else 
				return false;
		}
	}
?>