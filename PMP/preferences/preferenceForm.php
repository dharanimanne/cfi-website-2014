<?php include("header.php"); 
$RESULTS = array();
?>

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
		$('.preferences').on('change',function(){                                         					// Add the id of the div here...
			$con=mysqli_connect(DB_USERNAME, DB_PASSWORD, DB_DSN); 
			// Check connection
			if (mysqli_connect_errno())
			  {
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			  }
			else {
				$category = document.getElementById('cat1').value;																	//category can be obtained from the value in the form field
				$sql = "SELECT title FROM summerprojects WHERE category='".$category."'";
				$RESULTS = mysqli_query($con,$sql);

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
							<input type="text" name="name" placeholder="Username" />
						</td>
					</tr>
						<tr>
						<td>
							Roll no
						</td>
						<td>
							<input type="text" name="rollNo" placeholder="Roll no" />
						</td>
					</tr>
						<tr>
						<td>
							Hostel
						</td>
						<td>
							<input type="text" name="hostel" placeholder="Hostel" />
						</td>
					</tr>
						<tr>
						<td>
							Room
						</td>
						<td>
							<input type="text" name="room" placeholder="Room" />
						</td>
					</tr>
						<tr>
						<td>
							Phone number
						</td>
						<td>
							<input type="text" name="phone" placeholder="Phone number" />
						</td>
					</tr>
						<tr>
						<td>
						   E-mail 
						</td>
						<td>
							<input type="text" name="email" placeholder="E-mail" />
						</td>
					</tr>
				    <tr>
						<td>
							Preference-1 Category
						</td>
						<td>
							<select name="category"  class="preferences" id="cat1"  >
								<option value="Select" selected>Select</option>
								<option value="creative Ideas">Creative Ideas</option>
								<option value="Socially Relevant Projects">Socially Relevant Projects</option>
								<option value="Electronics/Android Application">Electronics/Android Application</option>
								<option value="Projects by CFI">Projects by CFI</option>
								<option value="Robotics/Automotive">Robotics/Automotive</option>
				                <option value="Computer Vision/Image Processing">Computer Vision/Image Processing</option>
								
							</select>
						</td>
					</tr>
					<?php 
					if(!empty($RESULTS))
					{
					?>
					<tr>
						<td>
							Preference-1
						</td>
						<td>
							<select name="preference_1">
							
							<option value="Select" selected>Select</option>
							<?php
							for ($a=0;$a<sizeof($i);$a++)
							{
							?>
								<option value="<?PHP echo $RESULTS[$a]; ?>"><?PHP echo $RESULTS[$a]; ?></option>
							
							<?php } ?>
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
		