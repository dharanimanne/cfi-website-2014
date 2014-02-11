<!DOCTYPE html>
<!--[if IE 8]>
<html xmlns="http://www.w3.org/1999/xhtml" class=""  lang="en-US">
<![endif]-->
<!--[if !(IE 8) ]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" class=""  lang="en-US">
<!--<![endif]-->
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title><?php echo htmlspecialchars( $results['pageTitle'] ); ?></title>
	</head>
	<body>
		<div id="container">
			<div id="header">
				<div id="navbar">
					Navbar<br>
					<?php 
						if( isset( $results['user'] ) ){
							echo $results['user']->name;  echo "<br>"; echo $results['user']->email; 
						}
						else{
							echo "Please login";
						}
					?>
					<br>Navbar ends<br><br>
				</div>
			</div>