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
		case 'uploadFile';
			uploadFile();
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
		if ( ! isset($_FILES["file"]))
		{
    		die('file is not set...');
		}
		else
		{
			$photo = $_FILES["file"]["name"];
			$allowedExts = array("gif", "jpeg", "jpg", "png");
			$temp = explode(".", $photo);
		    $extension = end($temp);
		  	if ((($_FILES["file"]["type"] == "image/gif")
		  	|| ($_FILES["file"]["type"] == "image/jpeg")
		  	|| ($_FILES["file"]["type"] == "image/jpg")
		  	|| ($_FILES["file"]["type"] == "image/pjpeg")
		  	|| ($_FILES["file"]["type"] == "image/x-png")
		  	|| ($_FILES["file"]["type"] == "image/png"))
		  	&& ($_FILES["file"]["size"] < 20000000)
		  	&& in_array($extension, $allowedExts))
		  	{
		  		if ($_FILES["file"]["error"] > 0)
		    	{
		    		echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
		    	}
		  		else
		    	{
		  			if (file_exists("upload/" . $_FILES["file"]["name"]))
		      		{
				    	echo $_FILES["file"]["name"] . " already exists. ";
				    }
		    		else
		      		{
						$name1=$_FILES["file"]["name"];
				        move_uploaded_file($_FILES["file"]["tmp_name"],
				        "upload/" . $_FILES["file"]["name"]);
				        echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
					}
		    	}
		  	}
		  	else
		  	{
		  		echo "Invalid file";
		  	}
		}
		$user->avatarLocation = $name1;
				
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

	function uploadFile(){

		if ( !isset($results) ) {
			$results = array();
		}
		
		if ($_FILES['file']['error'] === UPLOAD_ERR_OK) 
		{ 
  			$fileData = array();
			$fileData['fileName'] = $_FILES["file"]["name"];

	        if( is_dir( FILE_UPLOAD_DIRECTORY ) == false )
	        {
            	mkdir( FILE_UPLOAD_DIRECTORY, 0777 );		// Create directory if it does not exist
            }
            if( is_file( FILE_UPLOAD_DIRECTORY.'/'.$fileData['fileName'] ) == false )
            {
                move_uploaded_file( $_FILES["file"]["tmp_name"], FILE_UPLOAD_DIRECTORY.'/'.$fileData['fileName'] );
            }
            else
            {    //rename the file if another one exist
            	$temp = explode(".", $_FILES["file"]["name"]);
                $fileData['fileName'] = $temp[0].time().".".$temp[1];
                move_uploaded_file( $_FILES["file"]["tmp_name"], FILE_UPLOAD_DIRECTORY.'/'.$fileData['fileName'] ); 
            }

            $fileData['fileType'] = $_FILES["file"]["type"];
			$fileData['fileLocation'] = FILE_UPLOAD_DIRECTORY.'/'.$fileData['fileName'];    //to add later (the location of the file)
	        $fileData['uploadedBy'] =   "dharani";             //$_SESSION['username']; kept aside for testing
	        
	        $file = new File( $fileData );

	        if( $file->insert() )
			{
				$results['successMessage'] = "File upload successful. Thank you";
				require( TEMPLATE_PATH . "/loginForm.php" );
			}
		}
		else
		{ 
			switch ( $_FILES['file']['error'] ) {
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


	function update_activity(){
		$results = array();	
		$results['pageTitle'] = " | CFI Projects Management Portal";
		$results['activity'] = Activity::getById( $_POST['id'] );
		$activity = new Activity( $_POST );
		if( $activity->update() ){
			$results['successMessage'] = "Added activity successful.";
		}			
	}


	function updatePassword(){
		$results = array();	
		$results['pageTitle'] = "Profile Update | CFI Projects Management Portal";	
		$results['user'] = User::getByUsername( $_SESSION['username'] );

		if( isset( $_POST['update_password_form'] ) && ( $_POST['password'] == $_POST['password_confirmation'] ) ){
			$user = new User( $_POST );
			$user->id = $results['user']->id;
			echo $user->id;

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
	
?>

