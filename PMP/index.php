<?php
	session_start();

	$results = array();
	
	require("config.php");
	$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
	$username = isset( $_SESSION['username'] ) ? $_SESSION['username']: "";
	
	// Send to login by default
	//if( $action != "login" && $action != "logout" && !$username){
		//login();
		//exit;
	//}
	
	switch( $action ){
		case 'login';
			login();
			break;
		case 'logout';
			logout();
			break;
		case 'register';
			register();
			break;
		case 'update';
			update();
			break;
		case 'updatePassword';
			updatePassword();
			break;	
		case 'add_activity';
            add_activity();		
			break;
		case 'update_activity';
            update_activity();		
			break;
		case 'addMember';
			addMember();
			break;
		case 'createMessage';
		    createMessage();
			break;		
		case 'updateProfilePic';
            updateProfilePic();
            break; 		
		case 'uploadDocument';
            uploadDoc('docName',$_POST['activityId']);
            break; 		
		case 'deleteDocument';
			if( isset( $_GET['docId'] ) && isset( $_GET['activityId'] ) )
				deleteDoc($_GET['docId'], $_SESSION['userId'], $_GET['activityId'] );
			break;
		default:
			login();
	}

	function login(){
		global $results;
		if( !$results ) $results = array();
			
		$results['pageTitle'] = "Login | CFI Projects Management Portal";
		
		/* Just to test */
		//$_POST['login_form'] = "t";
		//$_POST['username'] = "vineet.1991.483@gmail.com";
		//$_POST['password'] = "123456";
		
		 if( !isset( $_SESSION['username'] ) ){
			if( isset( $_POST['login_form'] )){
				$username = $_POST['username'];
				$password = $_POST['password'];
				$passwordHash = Password::hash( $password );
				
				if( $user = User::getByUsername( $username ) ){
					if( $passwordHash == $user->password ){
						$_SESSION['username'] = $username;
						$_SESSION['userId'] = $user->id;
						dashboard( $user );
					}
					else {
						$results['errorMessage'] = "Username and password do not match.";
						require( TEMPLATE_PATH . "/loginForm.php" );
					}
				}
				else {
					$results['errorMessage'] = "Username not found, please register first.";
					require( TEMPLATE_PATH . "/loginForm.php" );
				}
			} else {
				require( TEMPLATE_PATH . "/loginForm.php" );
			}
		}
		else{
			$user = User::getByUsername( $_SESSION['username'] );
			dashboard( $user );
		}
	}
	
	function logout(){
		unset( $_SESSION['username'] );
		header("Location: index.php");
	}

	function dashboard( $user ){
		global $results;
		if( !$results )	$results = array();
		//print_r($results);
		
		$results['pageTitle'] = "Home | ".$user->name." | CFI Projects Management Portal";
		$results['user'] = $user;
		require( TEMPLATE_PATH . "/dashboard.php" );
	}

	function register(){
		global $results;
		if( !$results )	$results = array();
		$results['pageTitle'] = "Register | CFI Projects Management Portal";	
		$user = new User( $_POST );
	
		/*if (!isset($_FILES['file'])) {
			$fileName = "file";
			$fileLocation = "upload";
			$user->avatarLocation = uploadFile( $fileName, $fileLocation );
		}*/
		$user->avatarLocation = "default.png";
		
		if( $user->insert() ){
			$results['successMessage'] = "Registration successful. Please login.";
			require( TEMPLATE_PATH . "/loginForm.php" );
		}		
		else{
			//echo User::errorInfo();
			if( User::$errorCode == 23000 )			
				$results['regErrorMessage'] = "Registration unsuccessful, user already exists. <a href=\"#\">Forgot Password?</a>";
			else 
				$results['regErrorMessage'] = "Registration unsuccessful. ".User::$errorMessage;
		}			
		require( TEMPLATE_PATH . "/loginForm.php" );
	}

	function uploadFile( $fileName, $fileLocation, $rename = true ){

		global $results;
		if( !$results )	$results = array();
		
		if( $_FILES[$fileName]['error'] === UPLOAD_ERR_OK ){ 
  			$fileData = array();
			$fileData['fileName'] = $_FILES[$fileName]["name"];

			// Create directory if it does not exist
	        if( is_dir( $fileLocation ) == false ){
            	mkdir( $fileLocation, 0777 );		
            }
			
            if( is_file( $fileLocation.'/'.$fileData['fileName'] ) == false || $rename == false ){
                move_uploaded_file( $_FILES[$fileName]["tmp_name"], $fileLocation.'/'.$fileData['fileName'] );
            }			
			// Rename the file if another one exists
            else if( $rename ){    				
            	$temp = explode(".", $_FILES[$fileName]["name"]);
				$len = count($temp); $pre = "";
				for( $i=0; $i<$len-1; $i++ ) $pre .= $temp[$i];
                $fileData['fileName'] = $pre."-".time().".".$temp[$len-1];
				
                move_uploaded_file( $_FILES[$fileName]["tmp_name"], $fileLocation.'/'.$fileData['fileName'] ); 
            }

            $fileData['fileType'] = $_FILES[$fileName]["type"];
			$fileData['fileLocation'] = $fileLocation.'/'.$fileData['fileName'];    
	        $fileData['uploadedBy'] = $_SESSION['username']; 
	        
	        $file = new File( $fileData );

	        if( $file->insert() ){
				$results['successMessage'] = "File upload successful. Thank you";
				$results['uploadedFilename'] = $file->fileName;
			}
			else {
				$results['uploadedFilename'] = null;
			}
		}
		else { 
			switch ( $_FILES[$fileName]['error'] ) {
	            case UPLOAD_ERR_INI_SIZE:
	                $results['errorMessage'] = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
	                break;
	            case UPLOAD_ERR_FORM_SIZE:
	                $results['errorMessage'] = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
	                break;
	            case UPLOAD_ERR_PARTIAL:
	                $results['errorMessage'] = "The uploaded file was only partially uploaded";
	                break;
	            case UPLOAD_ERR_NO_FILE:
	                $results['errorMessage'] = null;
	                break;
	            case UPLOAD_ERR_NO_TMP_DIR:
	                $results['errorMessage'] = "Missing a temporary folder";
	                break;
	            case UPLOAD_ERR_CANT_WRITE:
	                $results['errorMessage'] = "Failed to write file to disk";
	                break;
	            case UPLOAD_ERR_EXTENSION:
	                $results['errorMessage'] = "File upload stopped by extension";
	                break;
	            default:
	                $results['errorMessage'] = "Unknown upload error";
	                break;
	        }
			$results['uploadedFilename'] = null;
		}
		
		return $results;
	}

	function add_activity(){
		global $results;
		if( !$results )	$results = array();
		$results['pageTitle'] = " | CFI Projects Management Portal";
		$activity = new Activity( $_POST );
		
		if( $activity->insert() ){
			$results['successMessage'] = "Added activity successful.";
		}			
	}
	
	function createMessage() {
		global $results;
		if( !$results )	$results = array();
		
        if( isset( $_POST['createMessage'] ) ){ 
		
			// Message to user
			if( $_POST["to"] == "4" ){
				$message= new Message($_POST);
				if( $message->insert() ){
					$results['successMessage'] = "Message successfully sent.";
				}	
				else{
					$results['errorMessage' ] = "Error sending message.";
				}
			}
			// Message global
			else if( $_POST["to"] == "3" ){
				$_POST['to_username'] = 'globalMessage';
				$message= new Message($_POST);
				if( $message->insert() ){
					$results['successMessage'] = "Message successfully sent.";
				}	
				else{
					$results['errorMessage' ] = "Error sending message.";
				}
			}
			// Message to core team
			else if( $_POST["to"] == "3" ){
				
			}
			
			// Message to all users of the respective activity
			else if( $_POST["to"] == "1" ){
			
				$_POST['to_username'] = 'activity.'.$_POST['activityId'];
				$message= new Message($_POST);
				if( $message->insert() ){
					$results['successMessage'] = "Message successfully sent.";
				}	
				else{
					$results['errorMessage' ] = "Error sending message.";
				}
				
				// DONT DELETE: Message to all user of the respective activity
				/*$userIds = Membership::getMembersById( $_POST['activityId'] );
				if( count($userIds) == 0)
					$results['errorMessage'] = "Error sending message, no recipients!";
					
				for( $i=0; $i<count($userIds); $i++ ){
					$to_username = User::getUsernameById( $userIds[$i]['userId'] );			
					if( $to_username != $_SESSION['username'] ){
						$_POST['to_username'] = $to_username;
						$message= new Message($_POST);
						
						if( $message->insert() ){
							$results['successMessage'] = "Message successfully sent.";
						}	
						else{
							$results['errorMessage' ] = "Error sending message.";
						}
					}
				}*/				
			}
		}
		$user = User::getByUsername( $_SESSION['username'] );
		dashboard( $user );
    }

	function update_activity(){
		global $results;
		if( !$results )	$results = array();
		$results['pageTitle'] = " | CFI Projects Management Portal";
		$results['activity'] = Activity::getById( $_POST['id'] );
		$results['errorMessage'] = '';
		$results['successMessage'] = '';
		$activity = new Activity( $_POST );
		
		$uploadResult = array();
		$uploadResult = uploadFile( "icon", ICON_UPLOAD_LOCATION ); 
		$activity->icon_link = $uploadResult['uploadedFilename'];
		if( $uploadResult['uploadedFilename'] == null ){
			$results['errorMessage'] .= "<br>".$uploadResult['errorMessage'];
		}
		
		$uploadResult = uploadFile( "bgImg", BGIMG_UPLOAD_LOCATION );
		$activity->bg_image_link = $uploadResult['uploadedFilename'];		
		if( $uploadResult['uploadedFilename'] == null ){
			$results['errorMessage'] .= "<br>".$uploadResult['errorMessage'];
		}	
		
		if( $activity->update() ){
			$results['successMessage'] = "Update successful.";
		}
		
		$user = User::getByUsername( $_SESSION['username'] );
		dashboard( $user );
	}


	function updatePassword(){
		global $results;
		if( !$results )	$results = array();
		$results['pageTitle'] = "Profile Update | CFI Projects Management Portal";	
		$results['user'] = User::getByUsername( $_SESSION['username'] );

		if( isset( $_POST['update_password_form'] ) ) {
			if ( $_POST['password'] == $_POST['password_confirmation'] ){
				$user = new User( $_POST );
				$user->id = $results['user']->id;

				if( $user->updatePassword() ){
					$results['successMessage'] = "Update successful.";
					$results['user'] = $user;
				}
				else{
					//echo User::errorInfo();
					if( User::errorCode() == "ERR_INV_PASS" )
						$results['errorMessage'] = "Update unsuccessful, password should atleast be 6 characters long.";
					else
						$results['errorMessage'] = "Update unsuccessful. Please try again.";
				}
			}
			else{
				$results['errorMessage'] = "Update unsuccessful. Passwords do not match.";
			}
		}
		else{
			$results['errorMessage'] = "Invalid method.";
		}
		require( TEMPLATE_PATH . "/updateForm.php" );
	}
	
	function updateProfilePic(){
		global $results;
		if( !$results )	$results = array();
		$results['pageTitle'] = "Profile Update | CFI Projects Management Portal";	
		$results['user'] = User::getByUsername( $_SESSION['username'] );

		$user = new User( $_POST );
		$user->id = $results['user']->id;

		$ext = pathinfo( $_FILES['file']['name'], PATHINFO_EXTENSION);
		$_FILES['file']['name'] = $user->id.".".$ext;
		$user->avatarLocation = uploadFile( 'file', PROFILEPIC_UPLOAD_LOCATION, false );

		if( $user->updateProfilePic( $_FILES['file']['name'] ) ) {
			$results['successMessage'] = "Update successful.";
			$results['user'] = $user;
		}
		else{
			//echo User::errorInfo();
			if( User::errorCode() == "ERR_INV_PASS" )	$results['errorMessage'] = "Update unsuccessful, password should atleast be 6 characters long.";
			else    $results['errorMessage'] = "Update unsuccessful. Please try again.";
		}
		
		require( TEMPLATE_PATH . "/updateForm.php" );
	}

	function update(){
		global $results;
		if( !$results )	$results = array();
		$results['pageTitle'] = "Profile Update | CFI Projects Management Portal";	
		$results['user'] = User::getByUsername( $_SESSION['username'] );
   
		if( isset( $_POST['updateFormSubmit'] ) ){
			$user = new User( $_POST ); 
			$user->id = $results['user']->id;
			
			if( $user->update() ){
				$results['successMessage'] = "Update successful.";
				$results['user'] = $user;
			}
			else{
				//echo User::errorInfo();
				if( User::errorCode() == "ERR_INV_NAME" )
					$results['errorMessage'] = "Update unsuccessful, invalid name provided.";
				else if( User::errorCode() == "ERR_INV_PHONE" )
					$results['errorMessage'] = "Update unsuccessful, invalid phone number provided.";
				else
					$results['errorMessage'] = "Update unsuccessful. Please try again.";
			}
		}

		require( TEMPLATE_PATH . "/updateForm.php" );		
	}
	
	/*
	function getActivity( $activity_type )
	{
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$sql = "SELECT * FROM ".TABLENAME_ACTIVITY." WHERE activity_type = :activity_type ";
		$st = $conn->prepare( $sql );
		$st->bindValue( ":activity_type", $activity_type, PDO::PARAM_STR );
		$st->execute();
		$result = $st -> fetchAll();
		foreach( $result as $row ) {
    		echo $row['id'];
    		echo $row['title'];
		}
		$conn = null;
	}*/


	function addMember(){
		global $results;
		global $username;
		if( !$results )	$results = array();
		$data = array();
		$user = User::getByUsername( $_POST['add_username'] );
		$activity = Activity::getById( (int) $_POST['activityId'] );
		$data['userId'] = $user->id;
		$data['activityId'] = $activity->id;
		$data['activityType'] = $activity->activity_type;
		$data['membershipType'] = 'member';
		$data['memberSince'] = date("Y-m-d H:i:s");

//		print_r( $activity );
//		print_r( $data );

		$membership = new Membership( $data );

		if ( $membership->insert() ) {
			$results['successMessage'] = "".$username." added successfully into the ".$data['activityType']." ".$activity->title." as a member";
		}
		else{
			$results['errorMessage'] = "Member not added. Please retry.";
		}
	//	dashboard( User::getByUsername($username) );
	}


	function uploadDoc( $docName, $activityId ){

		$docLocation = FILE_UPLOAD_LOCATION."/Documents";
		if( is_dir( $docLocation ) == false ){
			mkdir( $docLocation, 0777 );		
		}
		$docLocation = FILE_UPLOAD_LOCATION."/Documents/".$activityId;
		if( is_dir( $docLocation ) == false ){
			mkdir( $docLocation, 0777 );		
		}
		
		global $results;
		if( !$results )	$results = array();
		
		if ($_FILES[$docName]['error'] === UPLOAD_ERR_OK) 
		{ 
  			$docData = array();
			$docData['docName'] = $_FILES[$docName]["name"];

            if( file_exists( $docLocation.'/'.$docData['docName'] ) == false )
            {
                move_uploaded_file( $_FILES[$docName]["tmp_name"], $docLocation.'/'.$docData['docName'] );
            }
            else
            {    
				// Rename the file if another one exists
            	$temp = explode(".", $_FILES[$docName]["name"]);
				$len = count($temp); $pre = "";
				for( $i=0; $i<$len-1; $i++ ) $pre .= $temp[$i];
                $docData['docName'] = $pre."-".time().".".$temp[$len-1];
				
                move_uploaded_file( $_FILES[$docName]["tmp_name"], $docLocation.'/'.$docData['docName'] ); 
            }

			$docData['tags'] = $_POST	["tags"];
			$docData['docLocation'] = $docLocation;   
	        $docData['uploadedBy'] = $_SESSION['username'];
			$docData['activityId'] = $activityId;
					
	        $doc = new Document( $docData );	
						
	        if( $doc->insert() )
			{
				$results['successMessage'] = "Document upload successful. Thank you.";
			}
			else{
				echo Document::errorInfo()."<br>";
			}
		}
		else
		{ 
			switch ( $_FILES[$docName]['error'] ) {
	            case UPLOAD_ERR_INI_SIZE:
	                $results['errorMessage'] = "The uploaded doc exceeds the upload_max_docsize directive in php.ini";
	                break;
	            case UPLOAD_ERR_FORM_SIZE:
	                $results['errorMessage'] = "The uploaded doc exceeds the MAX_doc_SIZE directive that was specified in the HTML form";
	                break;
	            case UPLOAD_ERR_PARTIAL:
	                $results['errorMessage'] = "The uploaded doc was only partially uploaded";
	                break;
	            case UPLOAD_ERR_NO_FILE:
	                $results['errorMessage'] = null;
	                break;
	            case UPLOAD_ERR_NO_TMP_DIR:
	                $results['errorMessage'] = "Missing a temporary folder";
	                break;
	            case UPLOAD_ERR_CANT_WRITE:
	                $results['errorMessage'] = "Failed to write doc to disk";
	                break;
	            case UPLOAD_ERR_EXTENSION:
	                $results['errorMessage'] = "doc upload stopped by extension";
	                break;
	            default:
	                $results['errorMessage'] = "Unknown upload error";
	                break;
	        }
	        //echo $results['errorMessage'];
		}
		
		$user = User::getByUsername( $_SESSION['username'] );
		dashboard( $user );
	}
	
	function deleteDoc( $docId, $userId, $activityId ){
		global $results;
		if( !$results )	$results = array();
		
		if( !isset($results) ) {
			$results = array();
		}			
		// Check membership for activity
		if( Membership::check( $userId, $activityId ) ){
			// Check document id and activity id
			if( Document::deleteById( $docId, $activityId ) )
				$results['successMessage'] = "File Successfully Deleted.";
			else
				$results['errorMessage'] = "Error deleting file.";			
		}
		else{
			$results['errorMessage'] = "Delete File: Permission Denied.";
		}
		
		$user = User::getByUsername( $_SESSION['username'] );
		dashboard( $user );
	}
?>