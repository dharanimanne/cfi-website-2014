<?php

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
public $activity_type = null;
public $icon_link = null;
public $bg_image_link = null;

public function __construct( $data = array() )
{
# code...
if( isset( $data['id'] ) ) $this->id = (int) $data['id'];
if( isset( $data['title'] ) )    $this->title = $data['title'];
if( isset( $data['brief_writeup'] ) ) $this->brief_writeup = $data['brief_writeup'];
if( isset( $data['detailed_writeup'] ) ) $this->detailed_writeup = $data['detailed_writeup'];
if( isset( $data['status'] ) )            $this->status = $data['status'];
if( isset( $data['tags'] ) ) $this->tags = $data['tags'];
if( isset( $data['overall_budget'] ) ) $this->overall_budget = (int) $data['overall_budget'];
if( isset( $data['utilized_budget'] ) ) $this->utilized_budget = (int) $data['utilized_budget'];
if( isset( $data['activity_type'] ) )	 $this->activity_type = $data['activity_type'];
if( isset( $data['icon_link'] ) ) $this->icon_link = $data['icon_link'];
if( isset( $data['bg_image_link'] ) ) $this->bg_image_link = $data['bg_image_link'];
}




public function insert(){


//Insert the object
$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
$sql = "INSERT INTO activity ( title, brief_writeup, detailed_writeup, status, tags, overall_budget, utilized_budget,activity_type, icon_link, bg_image_link) VALUES ( :title, :brief_writeup, :detailed_writeup, :status, :tags, :overall_budget, :utilized_budget, :activity_type, :icon_link, :bg_image_link )";
$st = $conn->prepare( $sql );
$st->bindValue( ":title", $this->title, PDO::PARAM_STR );
//       echo $this->title;	
    $st->bindValue( ":brief_writeup", $this->brief_writeup, PDO::PARAM_STR );
  //          echo $this->brief_writeup;	  
 $st->bindValue( ":detailed_writeup", $this->detailed_writeup, PDO::PARAM_STR );
 // echo $this->detailed_writeup;
$st->bindValue( ":status", $this->status, PDO::PARAM_STR );
//echo $this->status;
$st->bindValue( ":tags", $this->tags, PDO::PARAM_STR );
//echo $this->tags;
$st->bindValue( ":overall_budget", $this->overall_budget, PDO::PARAM_INT );
//echo $this->overall_budget;
$st->bindValue( ":utilized_budget", $this->utilized_budget, PDO::PARAM_INT );
//echo $this->utilized_budget;
$st->bindValue( ":activity_type", $this->activity_type, PDO::PARAM_STR );
//echo $this->activity_type;
$st->bindValue( ":icon_link", $this->icon_link, PDO::PARAM_STR );
//echo $this->icon_link;
$st->bindValue( ":bg_image_link", $this->bg_image_link, PDO::PARAM_STR );
//echo $this->bg_image_link;
$st->execute();
$this->id = $conn->lastInsertId();
//echo $this->id;
$conn = null;	

echo "insertion successful!";
}

public function update(){

//Does the object have an ID?
if( is_null( $this->id ) ) trigger_error( "Activity::update(): Attempt to update an Activity object that does not have its ID property set.", E_ACTIVITY_ERROR );

//Update the object
$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );	
$sql = "UPDATE ".TABLENAME_ACTIVITY." SET icon_link =:icon_link , bg_image_link = :bg_image_link, title = :title, brief_writeup = :brief_writeup, detailed_writeup = :detailed_writeup, status = :status, tags = :tags, overall_budget = :overall_budget, utilized_budget = :utilized_budget WHERE id = :id";
$st = $conn->prepare( $sql );
$st->bindValue( ":title", $this->title, PDO::PARAM_STR );
$st->bindValue( ":brief_writeup", $this->brief_writeup, PDO::PARAM_STR );
$st->bindValue( ":detailed_writeup", $this->detailed_writeup, PDO::PARAM_STR );
$st->bindValue( ":status", $this->status, PDO::PARAM_STR );
$st->bindValue( ":tags", $this->tags, PDO::PARAM_STR );
$st->bindValue( ":overall_budget", $this->overall_budget, PDO::PARAM_INT );
$st->bindValue( ":utilized_budget", $this->utilized_budget, PDO::PARAM_INT );
$st->bindValue( ":id", $this->id, PDO::PARAM_INT );
$st->bindValue( ":icon_link", $this->icon_link, PDO::PARAM_STR );
$st->bindValue( ":bg_image_link", $this->bg_image_link, PDO::PARAM_STR );
$st->execute();
$conn = null;
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

public static function getByActivityType( $activity_type ){
$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
$sql = "SELECT * FROM ".TABLENAME_ACTIVITY." WHERE activity_type = :activity_type ";
$st = $conn->prepare( $sql );
$st->bindValue( ":activity_type", $activity_type, PDO::PARAM_STR );
$st->execute();
$row = $st->fetch();
$conn = null;
if( $row ) return new Activity( $row );
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