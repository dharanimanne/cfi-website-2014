<?php include("templates/include/header.php"); ?>
	<div id="content">
		<div id="loginDiv">
			<form name="loginForm" action="index.php?action=login" method="POST">
				Username <input type="text" name="username" placeholder="Username" /> <br>
				Password <input type="password" name="password" placeholder="Password" /> <br>
				<input type="submit" name="login_form" value="Login" /> 
			</form>
		</div>
		<div id="registerDiv">
			Not registered? Please register below. <br>
			<form name="registrationForm" action="index.php?action=register" method="POST">
				Email <input type="text" name="email" placeholder="Email as Username" /><br>
				Name <input type="text" name="name" placeholder="Name" /><br>
				Roll No. <input type="text" name="rollNo" placeholder="Roll No." /><br>
				Room <input type="text" name="room" placeholder="Room No." /><br>
				Hostel <input type="text" name="hostel" placeholder="Hostel" /><br>
				Phone <input type="text" name="phone" placeholder="Contact No." /><br>
				Password <input type="password" name="password" placeholder="Choose Password" /><br>
				<input type="submit" name="register_form" value="Register" /> 
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

