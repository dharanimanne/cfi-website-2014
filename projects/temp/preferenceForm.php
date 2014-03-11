<script type="text/javascript">
	function showProjects(str,divId) {
		document.getElementById('loadImg').style.display = 'inline';
		
		if (str==""){
			document.getElementById(divId).innerHTML="";
			return;
		} 
		if (window.XMLHttpRequest){					// code for IE7+, Firefox, Chrome, Opera, Safari
		    xmlhttp=new XMLHttpRequest();
		}
		else{										// code for IE6, IE5
		    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
				//alert( xmlhttp.responseText );
				document.getElementById(divId).innerHTML = xmlhttp.responseText;
				document.getElementById('loadImg').style.display = 'none';
		    }
		}
		xmlhttp.open("GET","temp/getProjects.php?category="+str,true);
		xmlhttp.send();
	}
	
</script>
<style type="text/css">
	#preferenceDiv {
		padding: 10px;
		margin: 5px;
		border: solid 1px rgb(241, 237, 237);
	}
	#preferenceDiv select {
		font-style:normal;
		font-family:Oswald;
	}
	#preferenceDiv table {
		width: 100%;
	}
	#preferenceDiv table td {
		text-align: center;
		border: solid 1px rgb(241, 237, 237);
		padding:10px;		
	}
</style>
<div id="preferenceDiv">
	<img id="loadImg" style="display:none; position: absolute;left: 48%;top: 82%;margin-left: -5px;" src="media/images/loading1.gif" />
	
	<div class="alert alert-warning">
		<center>
		To view the list of approved projects use any of the links below: <br>
		<a target="_blank" style="font-style:normal;" href="http://cfi-iitm.org/main/approved-projects-2014/projects-cfi/">http://cfi-iitm.org/main/approved-projects-2014/projects-cfi/</a> &emsp;&emsp;&emsp;&emsp;
		<a target="_blank" style="font-style:normal;" href="http://students.iitm.ac.in/portal/cfi/approvedprojects/">http://students.iitm.ac.in/portal/cfi/approvedprojects/</a>
		</center>
	</div>
	<div class="alert alert-info">
		<center>
		 Please select project category and the project name for each of your preferences.
		</center>
	</div>
	<div class="alert alert-info">
		<center>
		 People whose projects have been approved need not add/update any preference.
		</center>
	</div>
	<form name="preferenceForm" action="index.php?action=addPreferences" method="POST">
		<center>
		<table>
			<tr>
				<td>
					Preference #1
				</td>
				<td>
					Preference #2
				</td>
			</tr>
			<tr>
				<td>
					Select Category
				
					<select name="cat_pref_1"  class="preferences" id="cat1" onchange="showProjects(this.value,'drop1')">
						<option value="Select" selected>Select a category</option>
						<option value="Creative Ideas">Creative Ideas</option>
						<option value="Socially Relevant Projects">Socially Relevant Projects</option>
						<option value="Electronics Android"> Electronics & Android</option>
						<option value="Projects from CFI">Projects by CFI</option>
						<option value="Robotics Automotive">Robotics/Automotive</option>
						<option value="Image Processing">Computer Vision/Image Processing</option>						
					</select>
				</td>
				<td>
					Select Category
			
					<select name="cat_pref_2"  class="preferences" id="cat2" onchange="showProjects(this.value,'drop2')">
						<option value="Select" selected>Select a category</option>
						<option value="Creative Ideas">Creative Ideas</option>
						<option value="Socially Relevant Projects">Socially Relevant Projects</option>
						<option value="Electronics Android">Electronics & Android</option>
						<option value="Projects from CFI">Projects by CFI</option>
						<option value="Robotics Automotive">Robotics/Automotive</option>
						<option value="Image Processing">Computer Vision/Image Processing</option>
						
					</select>
				</td>
			</tr>	
			<tr>
				<td>
					Select Project&nbsp;&nbsp;
				
					<select name="preference1" id="drop1"  >
						<option value="-1">Select a category first </option>
					</select>
				</td>
				<td>
					Select Project&nbsp;&nbsp;
				
					<select name="preference2" id="drop2"  >
						<option value="-1">Select a category first </option>
					</select>
				</td>
			</tr>					
			<tr>
				<td colspan="2" style="text-align:center;" >
					<input type="submit" name="preferance_form" value="Submit" />
				</td>
			</tr>
			<?php
				if ( !$con = mysqli_connect('localhost','cfi','cfi13iitmdb','cfi') ){
				  die('Could not connect: ' . mysqli_error($con));
				}
				mysqli_select_db($con,"cfi-2014");
				$sql="SELECT * FROM preferences WHERE uploadedBy = '".$_SESSION['username']."'"; 
				$result = mysqli_query($con, $sql);
				if( mysqli_num_rows( $result ) > 0 ){
					echo "<input type='text' style='display:none;' name='update_pref' value='true' />";
					$row = mysqli_fetch_array( $result );
					//print_r( $row );
			?>
			<tr>
				<td>
					Chosen Preference #1<br>
					Category: <?php echo $row['cat_pref_1'];?><br>
					Project: <?php echo $row['preference1'];?>
				</td>
				<td>
					Chosen Preference #2<br>
					Category: <?php echo $row['cat_pref_2'];?><br>
					Project: <?php echo $row['preference2'];?>
				</td>
			</tr>
			<?php
				}
			?>
		</table>
		</center>
	</form>
</div>

		