<!DOCTYPE html>
<!--[if IE 8]>
<html xmlns="http://www.w3.org/1999/xhtml" class=""  lang="en-US">
<![endif]-->
<!--[if !(IE 8) ]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" class=""  lang="en-US">
<!--<![endif]-->
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title><?php if( isset( $results['pageTitle'] )){ echo htmlspecialchars( $results['pageTitle'] ); } else{ echo "Centre For Innovation";} ?></title>
	</head>
	<body>
		<div id="container">
			<div id="header">
				<div id="navbar">
					Navbar<br>
					<?php 
						if( isset( $results['user'] ) ){
							echo $results['user']->name;  echo "<br>"; echo $results['user']->email; 
							echo "<a href='/updateForm.php'>Update Profile</a>";
						}
						else{
							echo "Please login";
						}
					?>
					<br>Navbar ends<br><br>
				</div>
			</div>