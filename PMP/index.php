<?php
	session_start();

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
		$results = array();
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
						$result['errorMessage'] = "Username and password do not match.";
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
		$results = array();
		$results['pageTitle'] = "Home | ".$user->name." | CFI Projects Management Portal";
		$results['user'] = $user;
		require( TEMPLATE_PATH . "/dashboard.php" );
	}

	function register(){
		$results = array();	
		$results['pageTitle'] = "Register | CFI Projects Management Portal";	
		$user = new User( $_POST );
		
		var_dump($_POST);
		var_dump($_FILES);

		if ( empty($_FILES["file"]) ) {
			echo "this is insane!!!! it should not be displayed!!!";
			$fileName = "file";
			$fileLocation = FILE_UPLOAD_LOCATION;
			$user->avatarLocation = uploadFile( $fileName, $fileLocation, $_POST['email'] );
		}
		else {
			$user->avatarLocation = DEFAULT_AVATAR_LOCATION;
		}
				
		if( $user->insert() ){
			$results['successMessage'] = "Registration successful. Please login.";
			require( TEMPLATE_PATH . "/loginForm.php" );
		}		
		else{
			//echo User::errorInfo();
			if( User::errorCode() == 23000 )
				$results['errorMessage'] = "Registration unsuccessful, user already exists. <a href=\"#\">Forgot Password?</a>";
			else if( User::errorCode() == "ERR_INV_EMAIL" )
				$results['errorMessage'] = "Registration unsuccessful, invalid email address provided.";
			else if( User::errorCode() == "ERR_INV_NAME" )
				$results['errorMessage'] = "Registration unsuccessful, invalid name provided.";
			else if( User::errorCode() == "ERR_INV_ROLL" )
				$results['errorMessage'] = "Registration unsuccessful, invalid roll no provided.";
			else
				$results['errorMessage'] = "Registration unsuccessful. Please try again.";
		}	
	}

	function uploadFile( $fileName, $fileLocation, $uploadedBy ){

		if ( !isset($results) ) {
			$results = array();
		}
		
		if ($_FILES[$fileName]['error'] === UPLOAD_ERR_OK) 
		{ 
  			$fileData = array();
			$fileData['fileName'] = $_FILES[$fileName]["name"];

	        if( is_dir( $fileLocation ) == false )
	        {
            	mkdir( $fileLocation, 0777 );		// Create directory if it does not exist
            }
            if( is_file( $fileLocation.'/'.$fileData['fileName'] ) == false )
            {
                move_uploaded_file( $_FILES[$fileName]["tmp_name"], $fileLocation.'/'.$fileData['fileName'] );
            }
            else
            {    //rename the file if another one exist
            	$temp = explode(".", $_FILES[$fileName]["name"]);
                $fileData['fileName'] = $temp[0].time().".".$temp[1];
                move_uploaded_file( $_FILES[$fileName]["tmp_name"], $fileLocation.'/'.$fileData['fileName'] ); 
            }

            $fileData['fileType'] = $_FILES[$fileName]["type"];
			$fileData['fileLocation'] = $fileLocation.'/'.$fileData['fileName'];    //to add later (the location of the file)
	        $fileData['uploadedBy'] =   $uploadedBy;             //$_SESSION['username']; kept aside for testing
	        
	        $file = new File( $fileData );

	        if( $file->insert() )
			{
				$results['successMessage'] = "File upload successful. Thank you";
		//		require( TEMPLATE_PATH . "/loginForm.php" );
				return $file->fileLocation;
			}
		}
		else
		{ 
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
	                $results['errorMessage'] = "No file was uploaded";
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
	        echo $results['errorMessage'];
		}
	}


	function uploadImage( $imageName, $imageLocation ){

		if ( !isset($results) ) {
			$results = array();
		}
		
		if ($_FILES[$imageName]['error'] === UPLOAD_ERR_OK) 
		{ 
  			$imageData = array();
			$imageData['imageName'] = $_FILES[$imageName]["name"];

	        if( is_dir( $imageLocation ) == false )
	        {
            	mkdir( $imageLocation, 0777 );		// Create directory if it does not exist
            }
            if( is_file( $imageLocation.'/'.$imageData['imageName'] ) == false )
            {
                move_uploaded_file( $_FILES[$imageName]["tmp_name"], $imageLocation.'/'.$imageData['imageName'] );
            }
            else
            {    //rename the image if another one exist
            	$temp = explode(".", $_FILES[$imageName]["name"]);
                $imageData['imageName'] = $temp[0].time().".".$temp[1];
                move_uploaded_file( $_FILES[$imageName]["tmp_name"], $imageLocation.'/'.$imageData['imageName'] ); 
            }

            $imageData['imageType'] = $_FILES[$imageName]["type"];
			$imageData['imageLocation'] = $imageLocation.'/'.$imageData['imageName'];    //to add later (the location of the image)
	        $imageData['uploadedBy'] = $_SESSION['username']; 
	        
	        $image = new Image( $imageData );

	        if( $image->insert() )
			{
				$results['successMessage'] = "image upload successful. Thank you";
				return $image->imageName;
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			}
		}
		else
		{ 
			switch ( $_FILES[$imageName]['error'] ) {
	            case UPLOAD_ERR_INI_SIZE:
	                $results['errorMessage'] = "The uploaded image exceeds the upload_max_imagesize directive in php.ini";
	                break;
	            case UPLOAD_ERR_FORM_SIZE:
	                $results['errorMessage'] = "The uploaded image exceeds the MAX_image_SIZE directive that was specified in the HTML form";
	                break;
	            case UPLOAD_ERR_PARTIAL:
	                $results['errorMessage'] = "The uploaded image was only partially uploaded";
	                break;
	            case UPLOAD_ERR_NO_image:
	                $results['errorMessage'] = "No image was uploaded";
	                break;
	            case UPLOAD_ERR_NO_TMP_DIR:
	                $results['errorMessage'] = "Missing a temporary folder";
	                break;
	            case UPLOAD_ERR_CANT_WRITE:
	                $results['errorMessage'] = "Failed to write image to disk";
	                break;
	            case UPLOAD_ERR_EXTENSION:
	                $results['errorMessage'] = "image upload stopped by extension";
	                break;

	            default:
	                $results['errorMessage'] = "Unknown upload error";
	                break;
	        }
	        echo $results['errorMessage'];
		}
	}

	function add_activity(){
		$results = array();	
		$results['pageTitle'] = " Add an activity | CFI Projects Management Portal";
		$activity = new Activity( $_POST );
		
		if( $activity->insert() ){
			$results['successMessage'] = "Added activity successful.";
		}			
	}
	
	function createMessage() {
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
		$results = array();	
		$results['pageTitle'] = " | CFI Projects Management Portal";
		$results['activity'] = Activity::getById( $_POST['id'] );
		$activity = new Activity( $_POST );

		if (isset($_FILES['icon'])) {
			$imageName1 = "icon";
			$imageLocation1 = ICON_UPLOAD_LOCATION;
			$activity->icon_link = uploadImage( $imageName1, $imageLocation1 );
		}

		if (isset($_FILES['bgImg']))
		{
			$imageName2 = "bgImg";
			$imageLocation2 = BGIMG_UPLOAD_LOCATION;
			$activity->bg_image_link = uploadImage( $imageName2, $imageLocation2 );	
		}
			

		if( $activity->update() ){
			$results['successMessage'] = "Added activity successful.";
		}

		$user = User::getByUsername( $_SESSION['username'] );
		dashboard( $user );
	}


	function updatePassword(){
		$results = array();	
		$results['pageTitle'] = "Profile Update | CFI Projects Management Portal";	
		$results['user'] = User::getByUsername( $_SESSION['username'] );

		if( isset( $_POST['update_password_form'] ) && ( $_POST['password'] == $_POST['password_confirmation'] ) ){
			$user = new User( $_POST );
			$user->id = $results['user']->id;
			//echo $user->id;

			if( $user->updatePassword() )
			{
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
		require( TEMPLATE_PATH . "/updateForm.php" );
	}
	function updateProfilePic(){
		$results = array();	
		$results['pageTitle'] = "Profile Update | CFI Projects Management Portal";	
		$results['user'] = User::getByUsername( $_SESSION['username'] );
    /*    $fileName = "bgimgpic";
		$fileLocation = "update/ActivityImages"; 
		 uploadFile( $fileName, $fileLocation );
*/		$user = new User( $_POST );
		$user->id = $results['user']->id;
		$fileName = "file";
		$fileLocation = FILE_UPLOAD_LOCATION;
		$uploadedBy = $_SESSION['username'];		
		$user->avatarLocation = uploadFile( $fileName, $fileLocation, $uploadedBy );
		//echo $user->id;

		if( $user->updateProfilePic() )
		{
			$results['successMessage'] = "Update successful";
			$results['user'] = $user;
		}
		else{
			//echo User::errorInfo();
			if( User::errorCode() == "ERR_INV_PASS" )	$results['errorMessage'] = "Update unsuccessful, password should atleast be 6 characters long.";
			else    $results['errorMessage'] = "Update unsuccessful. Please try again.";
			require( TEMPLATE_PATH . "/updateForm.php" );
		}
	}

	function update(){
		$results = array();	
		$results['pageTitle'] = "Profile Update | CFI Projects Management Portal";	
		$results['user'] = User::getByUsername( $_SESSION['username'] );
   
		if( isset( $_POST['update_form'] ) ){
			$user = new User( $_POST );
			$user->id = $results['user']->id;
			
		//	echo $user->id;
		//	print_r($user);
		//	print_r($user);
		//	print_r($results['user']);
/*			$vars = get_object_vars($user);
	        foreach($vars as $name => $value) {
	      		if ( !$value ) {
	      			$results['user']->$name = $value;
	      		}
	        }
*/
			if( $user->update() )
			{
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
//		$results = array();
//		echo "yayy! this came until addMember function in index.php";
		global $username;
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

		$docLocation = DOC_UPLOAD_LOCATION;
		if( is_dir( $docLocation ) == false ){
			mkdir( $docLocation, 0777 );		
		}
/*		$docLocation = DOC_UPLOAD_LOCATION."/".$activityId;
		if( is_dir( $docLocation ) == false ){
			mkdir( $docLocation, 0777 );
		}
*/		
		if( !isset($results) ) {
			$results = array();
		}
		
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
	                $results['errorMessage'] = "No file was uploaded";
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