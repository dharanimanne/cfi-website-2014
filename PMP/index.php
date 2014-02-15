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
		$results['pageTitle'] = "Login | CFI Projects Management Portal";	
		$user = new User( $_POST );
		print_r($user);echo $_FILES["file"]["name"];
$allowedExts = array("gif", "jpeg", "jpg", "png");
  $temp = explode(".", $_FILES["file"]["name"]);
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
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
	  $_FILES["file"]["name"]=$Roll_no.".".$extension;
	  $name1=$_FILES["file"]["name"];
	  echo $name1;
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
		
		if( $user->insert() ){
			$results['successMessage'] = "Registration successful. Please login.";
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
			echo $user->id;
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
	}
	
?>
