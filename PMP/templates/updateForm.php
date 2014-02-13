<?php include("templates/include/header.php"); ?>
	<div id="content">
		<div id="UpdateDiv">
			Update your profile. <br>
			<form name="updateForm" action="index.php?action=update" method="POST">
				Email <input type="text" name="email" placeholder="Email as Username" value="<?php if( isset( $results['user']->email ) ) echo $results['user']->email; ?>" /><br>
				Name <input type="text" name="name" placeholder="Name" value="<?php if( isset( $results['user']->name ) ) echo $results['user']->name; ?>" /><br>
				Roll No. <input type="text" name="rollNo" placeholder="Roll No." value="<?php if( isset( $results['user']->rollNo ) ) echo $results['user']->rollNo; ?>" /><br>
				Room <input type="text" name="room" placeholder="Room No." value="<?php if( isset( $results['user']->room ) ) echo $results['user']->room; ?>" /><br>
				Hostel <input type="text" name="hostel" placeholder="Hostel" value="<?php if( isset( $results['user']->hostel ) ) echo $results['user']->hostel; ?>" /><br>
				Phone <input type="text" name="phone" placeholder="Contact No." value="<?php if( isset( $results['user']->phone ) ) echo $results['user']->phone; ?>" /><br>
				Password <input type="password" name="password" placeholder="Choose Password" /><br>
				<input type="submit" name="update_form" value="Update" /> 
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

