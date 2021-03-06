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
        <link rel="stylesheet" type="text/css" href="<?php echo MEDIA_URL;?>css/custom.css">
        <script src="<?php echo MEDIA_URL;?>javascript/jquery-1.11.0.min.js"></script>
        <script src="<?php echo MEDIA_URL;?>javascript/jquery.slimscroll.min.js"></script>
        <script src="<?php echo MEDIA_URL;?>javascript/jquery.cmtextconstrain.js"></script>
        <script src="<?php echo MEDIA_URL;?>javascript/custom.js"></script>
		<!--<script src="<?php echo MEDIA_URL;?>javascript/bootstrap.js"></script> -->
        <script src="<?php echo MEDIA_URL;?>javascript/bootstrap.min.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
	
	
	</head>
	<body>
		<div id="container">
			<div id="header">
				<div class="navbar navbar-fixed-top">  
				  <div class="navbar-inner">  
						<div class="container"> 
							<ul class="nav">
							  <li class="active">
								<a class="brand oswald-bold" href="index.php">CFI Projects Management Portal</a>
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
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"> Profile <b class="caret" style="margin-top:0px;"></b></a>  
								<?php
									if( !isset( $_SESSION['username'] ) ) {
								?>
									<ul class="dropdown-menu">  
										<li>
											<a href="#">Please Login</a>
										</li>
									</ul>
								<?php } else { ?>
								<ul class="dropdown-menu" style="width:350px">  
                                  	<!--<img style="position:absolute; margin-left:230px; height:100px ;size:auto;" src="../Content/Images/logo.png" /> </center>-->
                                    <img src="<?php echo $results['user']->avatarLocation; ?>" width="100" height="100"></center>
                            <!--       <li>
                                   		<?php print_r( $results['user']->avatarLocation ); ?>
                                   </li>
                            -->       <li>
										<a href="#"><?php echo $results['user']->name; ?></a>
									</li> 
									<li>
										<a href="#"><?php echo $results['user']->email; ?></a>
									</li>  
									<li>
										<a href="javascript:update_content('updateform');">Settings</a>
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


<script>
function update_content(str)
{
if (str.length==0)
  { 
  document.getElementById("content").innerHTML="";
  return;
  }
var xmlhttp=new XMLHttpRequest();
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("content").innerHTML=xmlhttp.responseText;
	var scripts = document.getElementById("content").getElementsByTagName('script');
	eval(scripts[0].text);	
    }
  }
if(str == "Clubs" || str == "Competitions" || str == "Projects") {
xmlhttp.open("GET","templates/include/membership.php?type="+str,true); }
else
{
xmlhttp.open("GET","templates/"+str+".php",true);
}
xmlhttp.send();
}
</script>