<?php

	require('config.php');
	require('index.php');

	$action = isset( $_GET['action'] ) ? $_GET['action'] : "";

	if( $action != "register" ){
		register();
		exit;
	}

	function register(){
		$results = array();
		$results['pageTitle'] = "Login | CFI Projects Management Portal";

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