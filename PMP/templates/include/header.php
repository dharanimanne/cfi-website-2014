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
        
        <link rel="stylesheet" type="text/css" href="<?php echo MEDIA_URL;?>css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="<?php echo MEDIA_URL;?>css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo MEDIA_URL;?>css/glyphicons.css">
        <link rel="stylesheet" type="text/css" href="<?php echo MEDIA_URL;?>css/style.css">
        <script src="<?php echo MEDIA_URL;?>javascript/jquery-1.11.0.min.js"></script>
        <script src="<?php echo MEDIA_URL;?>javascript/jquery.slimscroll.min.js"></script>
        <script src="<?php echo MEDIA_URL;?>javascript/custom.js"></script>
     <!--   <script src="<?php echo MEDIA_URL;?>javascript/bootstrap.js"></script> -->
        <script src="<?php echo MEDIA_URL;?>javascript/bootstrap.min.js"></script>
	
	
	</head>
	<body>
		<div id="container">
			<div id="header">
				<div class="navbar navbar-fixed-top">  
				  <div class="navbar-inner">  
						<div class="container"> 
							<ul class="nav">
							  <li class="active">
								<a class="brand" href="index.php">CFI Projects Management Portal</a>
							  </li>	
							  <li>
								<a href="#">About</a>
							  </li>
							  <li>
								<a href="#">Help</a>
							  </li>
							  <li>
								<a href="#">Contacts</a>
							  </li>
							</ul>
                            
							<ul class="nav pull-right">
							  <li class="dropdown" >  
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"> Profile <b class="caret"></b></a>  
								<?php
									if( !isset( $_SESSION['username'] ) ) {
								?>
									<ul class="dropdown-menu">  
										<li>
											<a href="#">Please Login</a>
										</li>
									</ul>
								<?php } else { ?>
								<ul class="dropdown-menu">  
									<li>
										<a href="#"><?php echo $results['user']->name; ?></a>
									</li> 
									<li>
										<a href="#"><?php echo $results['user']->email; ?></a>
									</li>  
									<li>
										<a href="index.php?action=update">Settings</a>
									</li>  
									<li>
										<a href="index.php?action=logout">Logout</a>
									</li>  
								</ul> 
								<?php } ?>
							  </li>  
							</ul> 
						</div>
					</div>
				</div>
			</div>
<!--
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
-->