<?php

	class user {
	
		
		public $id = null;
		public $username = null;
		public $password = null;
		public $name = null;
		public $email = null;
		
			public function __construct( $data = array() ) {
			if( isset( $data['id'] ) ) 					$this->id = (int) $data['id'];
			if( isset( $data['username'] ) ) 			$this->username = preg_replace ( "/[^\.\_ a-zA-Z0-9]/", "", $data['username'] );
			if( isset( $data['password'] ) ) 			$this->password = $data['password'];
		    if( isset( $data['name'] ) ) 				$this->name = preg_replace( "/[^a-zA-Z0-9]/", "", $data['name'] );
			if( isset( $data['email'] ) ) 				$this->email = preg_replace ( "/[^\.\@\_ a-zA-Z0-9]/", "", $data['email'] );
			
			}
			
		
		public function insert(){
	
	
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$sql = "INSERT INTO cfi_users ( username, password, name, email) VALUES ( :username, :password, :name, :email )";
		$st = $conn->prepare( $sql );
		$st->bindValue( ":username", $this->username, PDO::PARAM_STR );
		$st->bindValue( ":password", $this->password, PDO::PARAM_STR );
		$st->bindValue( ":name", $this->name, PDO::PARAM_STR );
		$st->bindValue( ":email", $this->email, PDO::PARAM_STR );
		$st->execute();
	$this->id = $conn->lastInsertId();
	echo $this->id;
	$conn = null;	
	
        echo "insertion successful!!!!"		;
	}
	public function update(){
		
		if( is_null( $this->ID ) ) trigger_error( "User::update(): Attempt to update a user object that does not have its ID property set.", E_USER_ERROR );
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );		
		$sql = "UPDATE users SET username=:username, name=:name, email=:email  WHERE id = :id";
		$st = $conn->prepare( $sql );
		$st->bindValue( ":name", $this->name, PDO::PARAM_STR );
		$st->bindValue( ":email", $this->email, PDO::PARAM_STR );
		$st->bindValue( ":id", $this->id, PDO::PARAM_INT );
		$st->execute();
		$conn = null;		
	}
	
	
	
	
	
	
}
	?>