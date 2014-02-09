<?php
ini_set( "display_errors", true );
define( "DB_DSN", "mysql:host=localhost;dbname=cfi" );
define( "DB_USERNAME", "username" );
define( "DB_PASSWORD", "password" );
define( "ADMIN_USERNAME", "admin" );
define( "ADMIN_PASSWORD", "pass" );

 
function handleException( $exception ) {
  echo "Sorry, a problem occurred. Please try later.";
  error_log( $exception->getMessage() );
}
 
set_exception_handler( 'handleException' );
?>