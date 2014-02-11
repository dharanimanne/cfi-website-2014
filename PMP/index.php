<?php
	session_start();

	require("config.php");
	$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
	$username = isset( $_SESSION['username'] ) ? $_SESSION['username']: "";
	
	// Send to login by default
	if( $action != "login" && $action != "logout" && !$username && != 'register'){
		login();
		exit;
	}
	
	switch( $action ){
		case 'login';
			login();
			break;
		case 'logout';
			logout();
			break;
		case 'register';
			register();
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

		$user_table = array();
		$user_table['username'] = $_POST['user_name'];
		$user_table['password'] = $_POST['user_password'];
		$user_table['user_email'] = $_POST['user_email'];
		$user_table['name'] = $_POST['name'];
		$user_table['user_roll'] = $_POST['user_roll'];
		$user_table['user_hostel'] = $_POST['user_hostel'];
		$user_table['user_room'] = $_POST['user_room'];

		if ( $user = new User($user_table) ) {
			if ( $user->insert() ) {
				echo "Registration successful. Please enjoy yourself";
				dashboard( $user );
			}		
		}
		else
		{
			$result['errorMessage'] = "Registration unsuccessful. Please try again.";
			require( TEMPLATE_PATH . "/register.php" );
		}		
	}
	
?>
