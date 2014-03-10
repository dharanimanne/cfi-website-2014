<?php
	ini_set( "display_errors", true );
	date_default_timezone_set( "Asia/Calcutta" );
	define( "DB_DSN", "mysql:host=localhost;dbname=cfi-2014" );
	define( "DB_USERNAME", "root" );
	define( "DB_PASSWORD", "" );
	define( "CLASS_PATH", "/classes" );
	define( "TEMPLATE_PATH", "/templates" );
	define( "ADMIN_USERNAME", "admin" );
	define( "ADMIN_PASSWORD", "pass" );
	define( "TABLENAME_USERS", "users" );
	define( "TABLENAME_ACTIVITY", "activity" );
	define( "TABLENAME_MEMBERSHIP", "memberships" );
	define( "TABLENAME_MESSAGES", "messages" );
	define( "TABLENAME_FILES", "files" );
	define( "MEDIA_URL", "media/" );
	define( "FILE_UPLOAD_LOCATION", "upload" );
	define( "ICON_UPLOAD_LOCATION", "upload/ActivityImages/icons" );
	define( "BGIMG_UPLOAD_LOCATION", "upload/ActivityImages/bgimages" );
	define( "DOC_UPLOAD_LOCATION", "upload/Documents" );
	define( "PROFILEPIC_UPLOAD_LOCATION", "upload/ProfilePics" );
	define( "TABLENAME_DOCUMENT", "documents" );
	define( "TABLENAME_FILE", "files" );
	
	require( CLASS_PATH . "/Activity.php" );
	require( CLASS_PATH . "/Password.php" );
	require( CLASS_PATH . "/User.php" );
	require( CLASS_PATH . "/Utility.php" );
	require( CLASS_PATH . "/Message.php" );
	require( CLASS_PATH . "/File.php" );
	require( CLASS_PATH . "/Document.php" );
	require( CLASS_PATH . "/Membership.php" );
?>