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
							<input type="text" name="email" placeholder="Email as Username" />
						</td>
					</tr>
					<tr>
						<td>
							Name
						</td>
						<td>
							<input type="text" name="name" placeholder="Name" />
						</td>
					</tr>
					<tr>
						<td>
							Roll No.
						</td>
						<td>
							<input type="text" name="rollNo" placeholder="Roll No." />
						</td>
					</tr>
					<tr>
						<td>
							Room
						</td>
						<td>
							<input type="text" name="room" placeholder="Room No." />
						</td>
					</tr>
					<tr>
						<td>
							Hostel
						</td>
						<td>
							<select name="hostel">
								<option value="Select" selected>Select</option>
								<option value="Alakananda">Alakananda</option>
								<option value="Brahmaputra">Brahmaputra</option>
								<option value="Cauvery">Cauvery</option>
								<option value="Ganga">Ganga</option>
								<option value="Godavari">Godavari</option>
								<option value="Jamuna">Jamuna</option>
								<option value="Krishna">Krishna</option>
								<option value="Mahanadi">Mahanadi</option>
								<option value="Mandakini">Mandakini</option>
								<option value="Narmada">Narmada</option>
								<option value="Pampa">Pampa</option>
								<option value="Saraswathi">Saraswathi</option>
								<option value="Sarayu">Sarayu</option>
								<option value="Sarayu Ext.">Sarayu Ext.</option>
								<option value="Sharavathi">Sharavathi</option>
								<option value="Sindhu">Sindhu</option>
								<option value="Tamiraparani">Tamiraparani</option>
								<option value="Tapti">Tapti</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							Phone
						</td>
						<td>
							<input type="text" name="phone" placeholder="Contact No." />
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
					<tr>
						<td>
							Profile Picture
						</td>
						<td>
							<input type="file" name="file" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="submit" name="register_form" value="Register" />
						</td>
					</tr>
				</table>
				 
			</form>
		</div>
		<script>$('#registerDiv').fadeOut(0);</script>
		<!--<div id="fileUploadDiv">
			Want to upload file? Please do so below. <br>
	    	<form name="fileUploadForm" action="index.php?action=uploadFile" method="POST" enctype="multipart/form-data">
				Choose a file <input type="file" name="file"><br>
				<input type="submit" name="uploadFile" value="submit" /> 
			</form>
		</div>-->
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
<?php include("include/footer.php"); ?>

