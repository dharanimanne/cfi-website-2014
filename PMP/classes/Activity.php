<?php

	/**
	* 
	*/
	class Activity
	{
		/* All fields are very self explanatory... */
		public $id = null;

		public $title = null;

		public $brief_writeup = null;

		public $detailed_writeup = null;

		public $status = null;

		public $tags = null;

		public $overall_budget = null;

		public $utilized_budget = null;


		function __construct(argument)
		{
			# code...
			if( isset( $data['id'] ) ) 					$this->id = (int) $data['id'];
			if( isset( $data['title'] ) ) 			    $this->title = $data['title'];
			if( isset( $data['brief_writeup'] ) ) 		$this->brief_writeup = $data['brief_writeup'];
			if( isset( $data['detailed_writeup'] ) ) 	$this->detailed_writeup = $data['detailed_writeup'];
			if( isset( $data['status'] ) ) 	            $this->status = $data['status'];
			if( isset( $data['tags'] ) ) 				$this->tags = $data['tags'];
			if( isset( $data['overall_budget'] ) ) 		$this->overall_budget = (int) $data['overall_budget'];
			if( isset( $data['utilized_budget'] ) ) 	$this->utilized_budget = (int) $data['utilized_budget'];
		}


		public function storeFormValues( $params ){
			$this->__construct( $params );
		}

		public static function getById( $id ){
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "SELECT * FROM ".TABLENAME_ACTIVITY." WHERE `id` = :id ";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":id", $id, PDO::PARAM_INT );
			$st->execute();
			$row = $st->fetch();
			$conn = null;
			if( $row ) return new Activity( $row );
		}

		public function insert(){
		
			//Does the object already have an ID?
			if( !is_null( $this->ID ) ) trigger_error( "Activity::insert(): Attempt to insert an Activity object that already has its ID property set to $this->id.", E_ACTIVITY_ERROR );
		
			//Insert the object
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "INSERT INTO ".TABLENAME_ACTIVITY." ( title, brief_writeup, detailed_writeup, status, tags, overall_budget, utilized_budget ) VALUES ( :title, :brief_writeup, :detailed_writeup, :status, :tags, :overall_budget, :utilized_budget )";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":title", $this->title, PDO::PARAM_STR );
			$st->bindValue( ":brief_writeup", $this->brief_writeup, PDO::PARAM_STR );
			$st->bindValue( ":detailed_writeup", $this->detailed_writeup, PDO::PARAM_STR );
			$st->bindValue( ":status", $this->status, PDO::PARAM_STR );
			$st->bindValue( ":tags", $this->tags, PDO::PARAM_STR );
			$st->bindValue( ":overall_budget", $this->overall_budget, PDO::PARAM_INT );
			$st->bindValue( ":utilized_budget", $this->utilized_budget, PDO::PARAM_INT );
			$st->execute();
			$this->id = $conn->lastInsertId();
			$conn = null;		
		}

		public function update(){
		
			//Does the object have an ID?
			if( is_null( $this->ID ) ) trigger_error( "Activity::update(): Attempt to update an Activity object that does not have its ID property set.", E_ACTIVITY_ERROR );
			
			//Update the object
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );		
			$sql = "UPDATE ".TABLENAME_ACTIVITY." SET title = :title, brief_writeup = :brief_writeup, detailed_writeup = :detailed_writeup, status = :status, tags = :tags, overall_budget = :overall_budget, utilized_budget = :utilized_budget WHERE id = :id";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":title", $this->title, PDO::PARAM_STR );
			$st->bindValue( ":brief_writeup", $this->brief_writeup, PDO::PARAM_STR );
			$st->bindValue( ":detailed_writeup", $this->detailed_writeup, PDO::PARAM_STR );
			$st->bindValue( ":status", $this->status, PDO::PARAM_STR );
			$st->bindValue( ":tags", $this->tags, PDO::PARAM_STR );
			$st->bindValue( ":overall_budget", $this->overall_budget, PDO::PARAM_INT );
			$st->bindValue( ":utilized_budget", $this->utilized_budget, PDO::PARAM_INT );
			$st->bindValue( ":id", $this->id, PDO::PARAM_INT );
			$st->execute();
			$conn = null;
		}

		public function delete(){
				
			//Does the object have an ID?
			if( is_null( $this->ID ) ) trigger_error( "Activity::delete(): Attempt to delete an Activity object that does not have its ID property set.", E_ACTIVITY_ERROR );
			
			//Delete the object
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$st = $conn->prepare ( "DELETE FROM ".TABLENAME_ACTIVITY." WHERE id = :id LIMIT 1" );
			$st->bindValue( ":id", $this->id, PDO::PARAM_INT );
			$st->execute();
		}
	}

?>