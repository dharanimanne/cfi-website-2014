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
		case 'create_message';
		      createMessage();
			    break;		
		case 'updateProfilePic';
              updateProfilePic();
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
	
		if (!isset($_FILES['file'])) {
			$fileName = "file";
			$fileLocation = "upload";
			$user->avatarLocation = uploadFile( $fileName, $fileLocation );
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

	function uploadFile( $fileName, $fileLocation ){

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

            if ($fileName == "icon" or $fileName == "bgimages")
            {
            	$fileData['fileName'] = "######";
            }

            $fileData['fileType'] = $_FILES[$fileName]["type"];
			$fileData['fileLocation'] = $fileLocation.'/'.$fileData['fileName'];    //to add later (the location of the file)
	        $fileData['uploadedBy'] =   "dharani";             //$_SESSION['username']; kept aside for testing
	        
	        $file = new File( $fileData );

	        if( $file->insert() )
			{
				$results['successMessage'] = "File upload successful. Thank you";
				require( TEMPLATE_PATH . "/loginForm.php" );
				return $file->fileName;
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


	function add_activity(){
		$results = array();	
		$results['pageTitle'] = " | CFI Projects Management Portal";
		$activity = new Activity( $_POST );
		
		if( $activity->insert() ){
			$results['successMessage'] = "Added activity successful.";
		}			
	}
	function createMessage() {
        	
	$message= new Message($_POST);
	if( $message->insert() ){
			$results['successMessage'] = "creating message successful.";
			dashboard( $user );
		}
    }

	function update_activity(){
		$results = array();	
		$results['pageTitle'] = " | CFI Projects Management Portal";
		$results['activity'] = Activity::getById( $_POST['id'] );
		$activity = new Activity( $_POST );

		if (isset($_FILES['icon'])) {
			$fileName1 = "icon";
			$fileLocation1 = "upload/ActivityImages/icons";
			$activity->icon_link = uploadFile( $fileName1, $fileLocation1 );
		}

		if (isset($_FILES['bgImg']))
		{
			$fileName2 = "bgImg";
			$fileLocation2 = "upload/ActivityImages/bgimages";
			$activity->bg_image_link = uploadFile( $fileName2, $fileLocation2 );	
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
		$fileLocation = "update";		
		$user->avatarLocation = uploadFile( $fileName, $fileLocation );
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


	function uploadDoc( $docName, $docLocation ){

		if ( !isset($results) ) {
			$results = array();
		}
		
		if ($_FILES[$docName]['error'] === UPLOAD_ERR_OK) 
		{ 
  			$docData = array();
			$docData['docName'] = $_FILES[$docName]["name"];

            if( is_doc( $docLocation.'/'.$docData['docName'] ) == false )
            {
                move_uploaded_doc( $_FILES[$docName]["tmp_name"], $docLocation.'/'.$docData['docName'] );
            }
            else
            {    //rename the doc if another one exist
            	$temp = explode(".", $_FILES[$docName]["name"]);
                $docData['docName'] = $temp[0].time().".".$temp[1];
                move_uploaded_doc( $_FILES[$docName]["tmp_name"], $docLocation.'/'.$docData['docName'] ); 
            }

            $docData['tags'] = $_FILES["tags"];
			$docData['docLocation'] = $docLocation.'/'.$docData['docName'];    //to add later (the location of the doc)
	        $docData['uploadedBy'] =   "dharani";             //$_SESSION['username']; should be the actual code...just kept it aside for testing
	        
	        $doc = new doc( $docData );

	        if( $doc->insert() )
			{
				$results['successMessage'] = "doc upload successful. Thank you";
				require( TEMPLATE_PATH . "/loginForm.php" );
				return $docData['docName'];
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
	            case UPLOAD_ERR_NO_doc:
	                $results['errorMessage'] = "No doc was uploaded";
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
	        echo $results['errorMessage'];
		}
	}
	
?>