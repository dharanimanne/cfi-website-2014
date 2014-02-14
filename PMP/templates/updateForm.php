<?php include("templates/include/header.php"); ?>
	<div id="content">
		<div id="UpdateDiv">
			Update your profile. <br>
			<form name="updateForm" action="index.php?action=update" method="POST">
				Name <input type="text" name="name" placeholder="Name" value="<?php if( isset( $results['user']->name ) ) echo $results['user']->name; ?>" /><br>
				Room <input type="text" name="room" placeholder="Room No." value="<?php if( isset( $results['user']->room ) ) echo $results['user']->room; ?>" /><br>
				Hostel <input type="text" name="hostel" placeholder="Hostel" value="<?php if( isset( $results['user']->hostel ) ) echo $results['user']->hostel; ?>" /><br>
				Phone <input type="text" name="phone" placeholder="Contact No." value="<?php if( isset( $results['user']->phone ) ) echo $results['user']->phone; ?>" /><br>
				Expertise <input type="text" name="expertise" placeholder="coding" value="<?php if( isset( $results['user']->expertise ) ) echo $results['user']->expertise; ?>" /><br>
				SocialMediaUrl <input type="text" name="socialMediaUrl" placeholder="" value="<?php if( isset( $results['user']->socialMediaUrl ) ) echo $results['user']->socialMediaUrl; ?>" /><br>
				About Me <input type="text" name="aboutMe" placeholder="I am the dude" value="<?php if( isset( $results['user']->aboutMe ) ) echo $results['user']->aboutMe; ?>" /><br><br>
				<input type="submit" name="update_form" value="Update" /> 
			</form>
		</div>
		<div id="UpdatePasswordDiv">
			Update your password. <br>
			<form name="updatePasswordForm" action="index.php?action=updatePassword" method="POST">
				New Password <input type="password" name="password" placeholder="Choose Password" /><br>
				Confirm New Password <input type="password" name="password_confirmation" placeholder="Re-type Password" /><br>
				<input type="submit" name="update_password_form" value="Update Password" /> 
			</form>
		</div>
		<div id="messageDiv">
			<?php if( isset( $results['successMessage'] ) ) { ?>
			<div class="message success">
				<?php echo $results['successMessage']; ?> 
			</div>
			<?php } 
				if( isset( $results['errorMessage'] ) ) { ?>
				<div class="message error">
					<?php echo $results['errorMessage']; ?> 
				</div>
			<?php } ?>			
		</div>
	</div>
<?php include("templates/include/footer.php"); ?>

