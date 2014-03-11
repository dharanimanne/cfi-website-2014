<?php include("include/header.php"); ?>
<?php
if(isset($_POST['Submit']))
{
    echo $_FILES['file']['error'];
}
?>
	<div id="bgDiv"></div>
	<div id="content" style="margin-left:0px;background:none;"><br><br><br>
		<div id="loginDiv">
			<div id="whiteBgDiv"></div>
			<form name="loginForm" action="index.php?action=login" method="POST">
				<table>
					<tr>
						<td>
							Username
						</td>
						<td>
							<input type="text" name="username" placeholder="Username" />
						</td>
					</tr>
					<tr>
						<td>
							Password
						</td>
						<td>
							<input type="password" name="password" placeholder="Password" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="submit" name="login_form" value="Login" />
							<input type="button" value="New User" onClick="$('#registerDiv').fadeIn(250);" />
						</td>
					</tr>				 
				</table>
			</form>
			<div id="returnMessage">
				<?php if( isset( $results['errorMessage'] ) && strlen( $results['errorMessage'] ) > 0 ) { ?>
					<div class="alert alert-error"><?php echo $results['errorMessage']; ?></div>
				<?php } if( isset( $results['successMessage'] ) && strlen( $results['successMessage'] ) > 0 ) { ?>
					<div class="alert alert-success"><?php echo $results['successMessage']; ?></div>
				<?php } ?>
			</div>
		</div>
		<div id="registerDiv">
			<div id="whiteBgDiv"></div>
			<form name="registrationForm" action="index.php?action=register" method="POST" enctype="multipart/form-data">
				<table>
					<tr>
						<td colspan="2">
							Not registered? Please register below.
						</td>
					</tr>
					<tr>
						<td>
							Email
						</td>
						<td>
							<input type="text" name="email" placeholder="Email as Username" value="<?php if( isset( $_POST['email'] ) ) echo $_POST['email']; ?>" />
						</td>
					</tr>
					<tr>
						<td>
							Name
						</td>
						<td>
							<input type="text" name="name" placeholder="Name" value="<?php if( isset( $_POST['name'] ) ) echo $_POST['name']; ?>" />
						</td>
					</tr>
					<tr>
						<td>
							Roll No.
						</td>
						<td>
							<input type="text" name="rollNo" placeholder="Roll No." value="<?php if( isset( $_POST['rollNo'] ) ) echo $_POST['rollNo']; ?>" />
						</td>
					</tr>
					<tr>
						<td>
							Room
						</td>
						<td>
							<input type="text" name="room" placeholder="Room No." value="<?php if( isset( $_POST['room'] ) ) echo $_POST['room']; ?>" />
						</td>
					</tr>
					<tr>
						<td>
							Hostel
						</td>
						<td>
							<select name="hostel">
								<option value="-1" <?php if( !isset( $_POST['hostel'] ) ) echo "selected"; else if( $_POST['hostel'] == '-1' ) echo "selected";  ?>>Select</option>
								<option value="Alakananda" <?php if( isset( $_POST['hostel'] ) ){ if( $_POST['hostel'] == 'Alakananda' ) echo "selected"; } ?> >Alakananda</option>
								<option value="Brahmaputra" <?php if( isset( $_POST['hostel'] ) ){ if( $_POST['hostel'] == 'Brahmaputra' ) echo "selected"; } ?> >Brahmaputra</option>
								<option value="Cauvery" <?php if( isset( $_POST['hostel'] ) ){ if( $_POST['hostel'] == 'Cauvery' ) echo "selected"; } ?> >Cauvery</option>
								<option value="Ganga" <?php if( isset( $_POST['hostel'] ) ){ if( $_POST['hostel'] == 'Ganga' ) echo "selected"; } ?> >Ganga</option>
								<option value="Godavari" <?php if( isset( $_POST['hostel'] ) ){ if( $_POST['hostel'] == 'Godavari' ) echo "selected"; } ?> >Godavari</option>
								<option value="Jamuna" <?php if( isset( $_POST['hostel'] ) ){ if( $_POST['hostel'] == 'Jamuna' ) echo "selected"; } ?> >Jamuna</option>
								<option value="Krishna" <?php if( isset( $_POST['hostel'] ) ){ if( $_POST['hostel'] == 'Krishna' ) echo "selected"; } ?> >Krishna</option>
								<option value="Mahanadi" <?php if( isset( $_POST['hostel'] ) ){ if( $_POST['hostel'] == 'Mahanadi' ) echo "selected"; } ?> >Mahanadi</option>
								<option value="Mandakini" <?php if( isset( $_POST['hostel'] ) ){ if( $_POST['hostel'] == 'Mandakini' ) echo "selected"; } ?> >Mandakini</option>
								<option value="Narmada" <?php if( isset( $_POST['hostel'] ) ){ if( $_POST['hostel'] == 'Narmada' ) echo "selected"; } ?> >Narmada</option>
								<option value="Pampa" <?php if( isset( $_POST['hostel'] ) ){ if( $_POST['hostel'] == 'Pampa' ) echo "selected"; } ?> >Pampa</option>
								<option value="Saraswathi" <?php if( isset( $_POST['hostel'] ) ){ if( $_POST['hostel'] == 'Saraswathi' ) echo "selected"; } ?> >Saraswathi</option>
								<option value="Sarayu" <?php if( isset( $_POST['hostel'] ) ){ if( $_POST['hostel'] == 'Sarayu' ) echo "selected"; } ?> >Sarayu</option>
								<option value="Sarayu Ext." <?php if( isset( $_POST['hostel'] ) ){ if( $_POST['hostel'] == 'Sarayu Ext.' ) echo "selected"; } ?> >Sarayu Ext.</option>
								<option value="Sharavathi" <?php if( isset( $_POST['hostel'] ) ){ if( $_POST['hostel'] == 'Sharavathi' ) echo "selected"; } ?> >Sharavathi</option>
								<option value="Sindhu" <?php if( isset( $_POST['hostel'] ) ){ if( $_POST['hostel'] == 'Sindhu' ) echo "selected"; } ?> >Sindhu</option>
								<option value="Tamiraparani" <?php if( isset( $_POST['hostel'] ) ){ if( $_POST['hostel'] == 'Tamiraparani' ) echo "selected"; } ?> >Tamiraparani</option>
								<option value="Tapti" <?php if( isset( $_POST['hostel'] ) ){ if( $_POST['hostel'] == 'Tapti' ) echo "selected"; } ?> >Tapti</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							Phone
						</td>
						<td>
							<input type="text" name="phone" placeholder="Contact No." value="<?php if( isset( $_POST['phone'] ) ) echo $_POST['phone']; ?>" />
						</td>
					</tr>
					<tr>
						<td>
							Password
						</td>
						<td>
							<input type="password" name="password" placeholder="Choose Password" />
						</td>
					</tr>
					<!--<tr>
						<td>
							Profile Picture
						</td>
						<td>
							<input type="file" name="file" />
						</td>
					</tr>-->
					<tr>
						<td colspan="2">
							<input type="submit" name="register_form" value="Register" />
						</td>
					</tr>
				</table>				 
			</form>
			<div id="returnMessage">
				<?php if( isset( $results['regErrorMessage'] ) && strlen( $results['regErrorMessage'] ) > 0 ) { ?>
					<center><div class="alert alert-error" style="width:300px;" ><?php echo $results['regErrorMessage']; ?></div></center>
				<?php } ?>
			</div>
		</div>
		<?php if( !isset( $results['regErrorMessage'] ) ) { ?>
			<script>
				//$('#registerDiv').fadeOut(0);
			</script>
		<?php } ?>
		<!--<div id="fileUploadDiv">
			Want to upload file? Please do so below. <br>
	    	<form name="fileUploadForm" action="index.php?action=uploadFile" method="POST" enctype="multipart/form-data">
				Choose a file <input type="file" name="file"><br>
				<input type="submit" name="uploadFile" value="submit" /> 
			</form>
		</div>-->
	</div>
<?php include("include/footer.php"); ?>

