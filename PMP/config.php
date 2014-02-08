<?php
ini_set( "display_errors", true );
date_default_timezone_set( "Asia/Calcutta" );
define( "DB_DSN", "mysql:host=localhost;dbname=pmp" );
define( "DB_USERNAME", "username" );
define( "DB_PASSWORD", "password" );
define( "CLASS_PATH", "classes" );
define( "TEMPLATE_PATH", "templates" );
define( "ADMIN_USERNAME", "admin" );
define( "ADMIN_PASSWORD", "pass" );
define( "TABLENAME_USERS", "user" );
require( CLASS_PATH . "/index.php" );
 
function handleException( $exception ) {
  echo "Sorry, a problem occurred. Please try later.";
  error_log( $exception->getMessage() );
}
 
set_exception_handler( 'handleException' );
?>