<?php include("header.php"); ?>

<style>
#preferenceDiv{
	float:left;
	margin-left:15%;
	position: relative;
	box-shadow: 10px 10px 25px #EEE8E8;
	padding: 25px;
	border: solid 1px #E4DDDD;
}
input[type=text], input[type=password], select{
	padding: 15px;
	border-radius: 7px;
	border-color: rgb(240, 231, 234);
	font-family: Arial;
	box-shadow: 0px;
	color: rgb(124, 117, 117);
	font-style: italic;
	width:255px;
}
</style>

<script>
	$(document).ready(function(){
		$('').on('change',function(){                                         					// Add the id of the div here...
			$con=mysqli_connect(DB_USERNAME, DB_PASSWORD, DB_DSN); 
			// Check connection
			if (mysqli_connect_errno())
			  {
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			  }
			else {
				$category = ;																	//category can be obtained from the value in the form field
				$sql = "SELECT title FROM summerprojects WHERE category='".$category."'";
				$result = mysqli_query($con,$sql);

			mysqli_close($con);
			}
		});
	});
</script>
	<div id="bgDiv"></div>
     <div id="content" style="margin-left:0px;background:none;"><br><br><br>
		<div id="preferenceDiv">
			<div id="whiteBgDiv"></div>
			<form name="preferenceForm" action="/cfi_exchange/PMP/index.php?action=projectPreference" method="POST">
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
							Roll no
						</td>
						<td>
							<input type="text" name="username" placeholder="Username" />
						</td>
					</tr>
						<tr>
						<td>
							Hostel
						</td>
						<td>
							<input type="text" name="username" placeholder="Username" />
						</td>
					</tr>
						<tr>
						<td>
							Room
						</td>
						<td>
							<input type="text" name="username" placeholder="Username" />
						</td>
					</tr>
						<tr>
						<td>
							Phone number
						</td>
						<td>
							<input type="text" name="username" placeholder="Username" />
						</td>
					</tr>
						<tr>
						<td>
						   E-mail 
						</td>
						<td>
							<input type="text" name="username" placeholder="Username" />
						</td>
					</tr>
				    <tr>
						<td>
							Preference-1
						</td>
						<td>
							<select name="hostel" onClick="$('#registerDiv').fadeIn(250);" >
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
					<?php 
					if(isset($results))
					{
					?>
					<tr>
						<td>
							Preference-2
						</td>
						<td>
							<select name="hostel" onClick="$('#registerDiv').fadeIn(250);" >
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
					<?php 
					}
					?>
					<tr>
						<td colspan="2">
							<input type="submit" name="preference_form" value="submit" />
						</td>
					</tr>				 
				</table>
			</form>
		</div>
		</div>

<?php include("footer.php"); ?>		
		