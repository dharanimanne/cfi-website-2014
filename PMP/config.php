﻿<?php
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
	define( "MEDIA_URL", "/CFI/PMP/media/" );
	
	require( CLASS_PATH . "/Activity.php" );
	require( CLASS_PATH . "/Password.php" );
	require( CLASS_PATH . "/User.php" );
?>