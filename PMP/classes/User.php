<?php
	require_once('Password.php');
	require_once('Activity.php');
	define("MINIMUM_NAME_LENGTH", 4);
	define("MINIMUM_ROLLNO_LENGTH", 8);
	define("MINIMUM_PASSWORD_LENGTH", 6);
		
	class User {
		
		public $id = null;
		public $username = null;
		public $password = null;
		public $lastLoginFrom = null;
		public $name = null;
		public $room = null;	
		public $rollNo = null;
		public $hostel = null;
		public $phone = null;
		public $email = null;
		public $membership = null;
		public $joinDateTime = null;
		public $lastLoginDateTime = null;
		public $expertise = null;
		public $rating = null;
		public $socialMediaUrl = null;
		public $avatarLocation = null;
		public $aboutMe = null;
		public $coreRemark = null;
		public $userType = null;
		public static $errorMessage;
		public static $errorCode;
		public static $successMessage;

		public function __construct( $data = array() ) {
			
			if( isset( $data['id'] ) ) 					$this->id = (int) $data['id'];
			// if( isset( $data['username'] ) ) 		$this->username = preg_replace ( "/[^\.\@\_ a-zA-Z0-9]/", "", $data['username'] );
			if( isset( $data['password'] ) ) 			$this->password = $data['password'];
		    if( isset( $data['name'] ) ) 				$this->name = preg_replace( "/[^a-zA-Z0-9]/", "", $data['name'] );
			/* Email as username */
			if( isset( $data['email'] ) ){ 				
				$this->email = trim( preg_replace( "/[^\.\@\_ a-zA-Z0-9]/", "", $data['email'] ) );
				$this->username = $this->email;
			}
			if( isset( $data['joinDateTime'] ) ) 		$this->joinDateTime =  $data['joinDateTime'];
			if( isset( $data['lastLoginDateTime'] ) ) 	$this->lastLoginDateTime = $data['lastLoginDateTime'];
			if( isset( $data['expertise'] ) ) 			$this->expertise = $data['expertise'];
			if( isset( $data['rating'] ) ) 				$this->rating = (float) $data['rating'];
			if( isset( $data['userType'] ) ) 			$this->userType = $data['userType'];
			if( isset( $data['socialMediaUrl'] ) ) 		$this->socialMediaUrl = $data['socialMediaUrl'];
			if( isset( $data['avatarLocation'] ) ) 		$this->avatarLocation = $data['avatarLocation'];
			if( isset( $data['aboutMe'] ) ) 			$this->aboutMe = $data['aboutMe'];
			if( isset( $data['coreRemark'] ) ) 			$this->coreRemark = $data['coreRemark'];
			if( isset( $data['membership'] ) ) 			$this->membership = $data['membership'];
			if( isset( $data['phone'] ) ) 				$this->phone = preg_replace ( "/[^\+ 0-9]/", "", $data['phone'] );
			if( isset( $data['rollNo'] ) ) 				$this->rollNo = preg_replace( "/[^a-zA-Z0-9]/", "", $data['rollNo'] );
			if( isset( $data['hostel'] ) ) 				$this->hostel = preg_replace ( "/[^a-zA-Z]/", "", $data['hostel'] );
			if( isset( $data['room'] ) ) 				$this->room = preg_replace ( "/[^a-zA-Z0-9]/", "", $data['room'] );
			if( isset( $data['lastLoginFrom'] ) ) 		$this->lastLoginFrom = $data['lastLoginFrom'];
			
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
		//	echo "im a man";
			if( !is_null( $this->id ) ) trigger_error( "User::insert(): Attempt to insert a user object that already has its ID property set to $this->id.", E_USER_ERROR );
		//	echo "yo boy";
			// Set Values
			$this->password = Password::hash($this->password);
			$this->joinDateTime = date("Y-m-d H:i:s");   
			$this->userType = "0";
/*			echo "oh boy";
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
			echo "yo man";	
*/			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "INSERT INTO ".TABLENAME_USERS." ( username, password, name, lastLoginFrom, membership, rollNo, hostel, room, phone, email, joinDateTime, lastLoginDateTime, expertise, rating, userType, socialMediaUrl, avatarLocation, aboutMe, coreRemark) VALUES ( :username, :password, :name, :lastLoginFrom, :membership, :rollNo, :hostel, :room, :phone, :email, :joinDateTime, :lastLoginDateTime, :expertise, :rating, :userType, :socialMediaUrl, :avatarLocation, :aboutMe, :coreRemark)";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":username", $this->username, PDO::PARAM_STR );
			$st->bindValue( ":password", $this->password, PDO::PARAM_STR );
			$st->bindValue( ":name", $this->name, PDO::PARAM_STR );	
			$st->bindValue( ":lastLoginFrom", $this->lastLoginFrom, PDO::PARAM_STR );
			$st->bindValue( ":email", $this->email, PDO::PARAM_STR );
			$st->bindValue( ":rollNo", $this->rollNo, PDO::PARAM_STR );
			$st->bindValue( ":hostel", $this->hostel, PDO::PARAM_STR );
			$st->bindValue( ":room", $this->room, PDO::PARAM_STR );
			$st->bindValue( ":joinDateTime", $this->joinDateTime, PDO::PARAM_INT);
			$st->bindValue( ":lastLoginDateTime", $this->lastLoginDateTime, PDO::PARAM_INT );
			$st->bindValue( ":expertise", $this->expertise, PDO::PARAM_STR );
			$st->bindValue( ":rating", $this->rating, PDO::PARAM_STR );
			$st->bindValue( ":userType", $this->userType, PDO::PARAM_STR );
			$st->bindValue( ":socialMediaUrl", $this->socialMediaUrl, PDO::PARAM_STR );
			$st->bindValue( ":avatarLocation", $this->avatarLocation, PDO::PARAM_STR );
			$st->bindValue( ":aboutMe", $this->aboutMe, PDO::PARAM_STR );
			$st->bindValue( ":membership", $this->membership, PDO::PARAM_STR );
			$st->bindValue( ":coreRemark", $this->coreRemark, PDO::PARAM_STR );
			$st->bindValue( ":phone", $this->phone, PDO::PARAM_STR );
		//	print_r( $st );
			$result = $st->execute();
			$this->id = $conn->lastInsertId();
			$conn = null;
			
			if( !$result ){
				self::$errorMessage = "User::insert: Insertion Failed, PDO::errorInfo(): ".$st->errorCode().": ".$st->errorInfo()[2];
				self::$errorCode = $st->errorCode();
		//		echo $errorMessage;
				return false;
			}
			else{		
				self::$successMessage = "User::insert: User successfully inserted with id ".$this->id;			
				return true;
			}
		}
	

		public function update(){
				
			//Does the object have an ID?
			if( is_null( $this->id ) ) trigger_error( "User::update(): Attempt to update a user object that does not have its ID property set.", E_USER_ERROR );
			
			else if( strlen( $this->name ) < MINIMUM_NAME_LENGTH || preg_match("/[^a-zA-Z'-]/", $this->name) ){
				self::$errorCode ="ERR_INV_NAME";
				return false;
			}
			else if( strlen( $this->phone ) != 10 || preg_match("^[0-9]{10}", $this->phone) ){
				self::$errorCode ="ERR_INV_PHONE";
				return false;
			}

			//Update the object
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );		
			$sql = "UPDATE ".TABLENAME_USERS." SET name=:name, hostel=:hostel, room=:room, phone=:phone, socialMediaUrl=:socialMediaUrl, expertise=:expertise, aboutMe=:aboutMe WHERE id = :id";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":name", $this->name, PDO::PARAM_STR );
			echo $this->name ;
			$st->bindValue( ":hostel", $this->hostel, PDO::PARAM_STR );
			echo $this->hostel;
			$st->bindValue( ":room", $this->room, PDO::PARAM_STR );
			echo $this->room;
			$st->bindValue( ":phone", $this->phone, PDO::PARAM_STR );
			echo $this->phone;
			$st->bindValue( ":socialMediaUrl", $this->socialMediaUrl, PDO::PARAM_STR );
			echo $this->socialMediaUrl;
			
			
			$st->bindValue( ":expertise", $this->expertise, PDO::PARAM_STR );
			echo $this->expertise;
			$st->bindValue( ":aboutMe", $this->aboutMe, PDO::PARAM_STR );
			echo $this->aboutMe;
			$st->bindValue( ":id", $this->id, PDO::PARAM_INT );
			echo $this->id;
			echo "<br>";
			$st->execute();
		//	print_r($st->errorInfo());
			$conn = null;	
			
			return true;
		}
        public function updateProfilePic(){
				
			//Does the object have an ID?
			if( is_null( $this->id ) ) trigger_error( "User::update(): Attempt to update a user object that does not have its ID property set.", E_USER_ERROR );
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );		
			$sql = "UPDATE ".TABLENAME_USERS." SET avatarLocation=:avatarLocation WHERE id = :id";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":avatarLocation", $this->avatarLocation, PDO::PARAM_STR );
			
			$st->bindValue( ":id", $this->id, PDO::PARAM_INT );
			$st->execute();
			$conn = null;

			return true;
			
			}
			
		public function updatePassword(){

			if( is_null( $this->id ) ) trigger_error( "User::update(): Attempt to update a user object that does not have its ID property set.", E_USER_ERROR );
			
			if( strlen( $this->password ) < MINIMUM_PASSWORD_LENGTH ){
				self::$errorCode ="ERR_INV_PASS";
				return false;
			}
			//Update the object
			$this->password = Password::hash($this->password);
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );		
			$sql = "UPDATE ".TABLENAME_USERS." SET password=:password WHERE id = :id";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":password", $this->password, PDO::PARAM_STR );
			echo $this->password;
			$st->bindValue( ":id", $this->id, PDO::PARAM_INT );
			$st->execute();
			$conn = null;

			return true;
			}
		
		
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
		
		public static function getUsernameById( $id ){
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "SELECT username FROM ".TABLENAME_USERS." WHERE id = :id ";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":id", $id, PDO::PARAM_INT );
			$st->execute();
			$row = $st->fetch();
			$conn = null;
			if( $row ) return $row['username'];
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
		
		public function delete(){
						
			//Does the object have an ID?
			if( is_null( $this->id ) ) trigger_error( "User::delete(): Attempt to delete a user object that does not have its ID property set.", E_USER_ERROR );
			
			//Delete the object
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$st = $conn->prepare ( "DELETE FROM ".TABLENAME_USERS." WHERE id = :id LIMIT 1" );
			$st->bindValue( ":id", $this->id, PDO::PARAM_INT );
			$st->execute();
			$conn = null;		
		}

		public function getActivityOfUser( $activityType ){
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "SELECT * FROM ".TABLENAME_MEMBERSHIP." WHERE userId = :userId AND activityType = :activityType ";
	//		print_r($sql);
			$st = $conn->prepare( $sql );
			$st->bindValue( ":userId", $this->id, PDO::PARAM_INT );
	//		echo $this->id;
			$st->bindValue( ":activityType", $activityType, PDO::PARAM_STR );
	//		echo $activityType;
	//		print_r($st->errorLog());
			$st->execute();
	//		$row = $st->fetch();
	//		echo "hey there...$row is printed next";
	//		print_r($row);
	//		echo "$row is in between these comments";
	//		$activityId = $row['activityId'];
	//		echo $activityId;
			$i = 0;
	//		for multiple activities, we can use fetchAll() and a foreach loop to get all of them.
			$result = $st->fetchAll();
			$activities = array();
			foreach( $result as $row ) {
				$activities[$i] = Activity::getById( $row['activityId'] );
				$i++;
	//			print_r( $row );
				//echo $i;				
			}
			
			$conn = null;
			if( $activities ) return $activities;
			
		}		
	}
?>