<?php	
	if( isset( $_GET['ajax'] ) ){
		session_start();
		require_once("../config.php");
	}
	
	$username = isset( $_SESSION['username'] ) ? $_SESSION['username']: "";
	$user = User::getByUsername( $_SESSION['username'] );
	$results['user'] = $user;
	
	if( !isset( $_GET['ajax'] ) ){
		include("templates/include/header.php");
		include("templates/include/sidebar.php");
		echo "<div id=\"content\">";
	}
?>
	<ul class="breadcrumb">
		<li><a href="index.php" class="glyphicons home">CFI PMP</a></li>
		<li class="divider"></li>
		<li>Edit Account</li>
	</ul>
	<div class="separator bottom"></div>
	<div class="heading-buttons">
		<h3 class="glyphicons display">Edit Account</h3>
		<div class="clearfix" style="clear: both;"></div>
	</div>
	<div class="separator bottom"></div>

	<div class="separator bottom"></div>
	<div class="widget widget-2 widget-tabs widget-tabs-2">
		<div class="widget-head">
			<ul id="myTab">
				<li class="active"><a class="glyphicons cardio" href="#basic-profile-tab" data-toggle="tab">Basic Profile</a></li>
				<li><a class="glyphicons cardio" href="#password-tab" data-toggle="tab">Password</a></li>
				<li><a class="glyphicons cardio" href="#profile-pic-tab" data-toggle="tab">Profile Pic</a></li>
			</ul>
		</div>
		<div class="tab-content">
			<div class="tab-pane in active" id="basic-profile-tab">
				<div id="UpdateDiv">
					<form name="updateForm" class="form-horizontal" action="index.php?action=update" method="POST">
						<table>
							<tr>
								<td>
									<div class="control-group">  
										<label class="control-label" for="input01">Name</label>  
										<div class="controls">  
										  <input type="text" name="name" class="input-xlarge" value="<?php if( isset( $results['user']->name ) ) echo $results['user']->name; ?>" id="input01">  
										  <p class="help-block"></p>  
										</div>  
									</div> 
								</td>
								<td>
									<div class="control-group">  
										<label class="control-label" for="input02">Room</label>  
										<div class="controls">  
										  <input type="text" name="room" class="input-xlarge" value="<?php if( isset( $results['user']->room ) ) echo $results['user']->room; ?>" id="input02">  
										  <p class="help-block"></p>  
										</div>  
									</div> 	
							   </td>
								<td>
									<div class="control-group">  
										<label class="control-label" for="input03">Hostel</label>  
										<div class="controls">  
										  <input type="text" name="hostel" class="input-xlarge" value="<?php if( isset( $results['user']->hostel ) ) echo $results['user']->hostel; ?>" id="input03">  
										  <p class="help-block"></p>  
										</div>  
									</div> 	
								</td>
							</tr>
							<tr>
								<td>
									<div class="control-group">  
										<label class="control-label" for="input04">Phone</label>  
										<div class="controls">  
										  <input type="text" name="phone" class="input-xlarge" value="<?php if( isset( $results['user']->phone ) ) echo $results['user']->phone; ?>" id="input04">  
										  <p class="help-block"></p>  
										</div>  
									</div> 	
								</td>
								<td>
									<div class="control-group">  
										<label class="control-label" for="input05">Expertise</label>  
										<div class="controls">  
										  <input type="text" name="expertise" class="input-xlarge" value="<?php if( isset( $results['user']->expertise ) ) echo $results['user']->expertise; ?>" id="input05">  
										  <p class="help-block"></p>  
										</div>  
									</div> 	
								</td>
								<td>
									<div class="control-group">  
										<label class="control-label" for="input06">Social Media URL</label>  
										<div class="controls">  
										  <input type="text" name="socialMediaUrl" class="input-xlarge" value="<?php if( isset( $results['user']->socialMediaUrl ) ) echo $results['user']->socialMediaUrl; ?>" id="input06">  
										  <p class="help-block"></p>  
										</div>  
									</div> 	
								</td>
							</tr>
							<tr>
								<td colspan="3">							   
									<div class="control-group">  
										<label class="control-label" for="input07">About Me</label>  
										<div class="controls">  
										  <textarea style="width:500px; font-family:Oswald;" type="text" name="aboutMe" class="input-xlarge" id="input07"><?php if( isset( $results['user']->aboutMe ) ) echo $results['user']->aboutMe; ?></textarea>
										  <p class="help-block"></p>  
										</div>  
									</div> 	
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<div class="form-actions" style="border:none;">  
										<center>
											<input type="submit" name="updateFormSubmit" class="btn btn-primary" value="Save changes" />
										</center>  
									</div>  
								</td>
							</tr>
						</table>
					</form>
				</div>   
	
			</div>
			<div class="tab-pane fade" id="password-tab">
				<div id="UpdatePasswordDiv">                            	
					<form name="updatePasswordForm"  class="form-horizontal" action="index.php?action=updatePassword" method="POST">	     
						<table>
							<tr>
								<td>
									<div class="control-group">  
										<label class="control-label" for="input08">New Password</label>  
										<div class="controls">  
										  <input type="password" name="password" placeholder="Choose Password" id="input08"/>  
										  <p class="help-block"></p>  
										</div>  
									</div> 	
								</td>
								<td>
									<div class="control-group">  
										<label class="control-label" for="input09">Confirm New Password</label>  
										<div class="controls">  
										  <input type="password" name="password_confirmation" placeholder="Re-type Password" id="input09"/>
										  <p class="help-block"></p>  
										</div>  
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<div class="form-actions">  
										<center>
											<input name="update_password_form" type="submit" class="btn btn-primary" value="Save changes" />
										</center>  
									</div>  
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
			
			<div class="tab-pane fade" id="profile-pic-tab">
				<div id="updateProfilePic">
				   <form name="updateprofilepic"  class="form-horizontal" action="index.php?action=updateProfilePic" method="POST" enctype="multipart/form-data">
						<table>
							<tr>
								<td>
									<div class="control-group">
										<label class="control-label" for="profpic">ProfilePic</label>
										<div class="controls">
											<input type="file" name="file" id="profpic">
											<p class="help-block"></p>
										</div>
									</div>
								</td>
								<td>
									<img style="height:200px;" src="<?php echo PROFILEPIC_UPLOAD_LOCATION."/".$results['user']->avatarLocation; ?>" /> 
								</td>
							</tr>
							<tr>
								<td colspan="2">									
									<div class="form-actions" style="border:none;">  
										<center>
											<input type="submit" class="btn btn-primary" value="Update" />
										</center>  
									</div>  
								</td>
							</tr>
						</table>
					</form>
				<div>
			</div>
		</div>
	</div>	
    
	

	

	
	<div id="returnMessage">
		<?php if( isset( $results['errorMessage'] ) && strlen( $results['errorMessage'] ) > 0 ) { ?>
			<div class="alert alert-error"><?php echo $results['errorMessage']; ?></div>
		<?php } if( isset( $results['successMessage'] ) && strlen( $results['successMessage'] ) > 0 ) { ?>
			<div class="alert alert-success"><?php echo $results['successMessage']; ?></div>
		<?php } ?>
	</div>
    <script>
		$('#myTab a').click(function (e) {
		  e.preventDefault()
		  $(this).tab('show')
		})
	</script>

<?php if( !isset( $_GET['ajax'] ) ){ echo "</div>"; include("templates/include/footer.php"); } ?>