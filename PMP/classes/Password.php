<?php 
	class Password {
	 
		//Blowfish
		private static $algo = '$2a';
	 
		//Cost
		private static $cost = '$10';
	 	 
		//Salt
		private static $salt = '#e$54^&de%*(sd';
	 
		//Generate password hash
		public static function hash( $password ){	 
			return crypt( $password,	self::$algo . self::$cost . '$' . self::$salt );	 
		}	 
		
		//Comapre hash and password
		public static function validate_password($hash, $password) {	 
			$full_salt = substr($hash, 0, 20);	 
			$new_hash = crypt($password, $full_salt);	 
			return ($hash == $new_hash);	 
		}	 
	}
?>