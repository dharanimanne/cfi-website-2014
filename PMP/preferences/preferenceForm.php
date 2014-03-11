<?php include("header.php"); 
session_start();
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
	function showProjects(str,divId)
		{
	//	document.getElementById('test').innerHTML=divId;
		if (str=="")
		  {
		  document.getElementById(divId).innerHTML="";
		  return;
		  } 
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		    {
		    document.getElementById(divId).innerHTML=xmlhttp.responseText;
		    }
		  }
		xmlhttp.open("GET","getProjects.php?category="+str,true);
		xmlhttp.send();
		}
	
</script>
	<div id="bgDiv"></div>
     <div id="content" style="margin-left:0px;background:none;"><br><br><br>
		<div id="preferenceDiv">
		<div>

	<?php
		
	if(isset($_SESSION['status']))
	{
	echo $_SESSION['status'];
	
	}
	?>
	</div>
			<div id="whiteBgDiv"></div>
	<!--		<div id="test">akshay</div>
	-->		<form name="preferenceForm" action="preferences.php" method="POST">
				<table>
		<!--		<tr>
						<td>
							Username
						</td>
						<td>
							<input type="text" name="name" placeholder="Username" />
						</td>
					</tr>
					<tr>
						<td>
							Roll No
						</td>
						<td>
							<input type="text" name="rollNo" placeholder="Roll No" />
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
							<input type="text" name="room" placeholder="Room no" />
						</td>
					</tr>
					<tr>
						<td>
							Phone Number
						</td>
						<td>
							<input type="text" name="phone" placeholder="Phone Number" />
						</td>
					</tr>
					<tr>
						<td>
							E-mail
						</td>
						<td>
							<input type="text" name="email" placeholder="Username" />
						</td>
					</tr>
					<tr>
						<td>
							Tell about yourself
						</td>
						<td>
							<input type="text" name="aboutMe" placeholder="...." />
						</td>
					</tr>
			-->	    <tr>
						<td>
							Preference-1 Category
						</td>
						<td>
							<select name="category"  class="preferences" id="cat1" onchange="showProjects(this.value,'drop1')">
								<option value="Select" selected>Select</option>
								<option value="Creative Ideas">Creative Ideas</option>
								<option value="Socially Relevant Projects">Socially Relevant Projects</option>
								<option value="Electronics Android">Electronics & Android Application</option>
								<option value="Projects from CFI">Projects by CFI</option>
								<option value="Robotics Automotive">Robotics/Automotive</option>
				                <option value="Image Processing">Computer Vision/Image Processing</option>
								
							</select>
						</td>
					</tr>
							     <tr>
						<td>
							Preference-1 
						</td>
						<td>
							<select name="preference1" id="drop1"  >
							</select>
						</td>
					</tr>	
                 	  	 <tr>
						<td>
							Preference-2 Category
						</td>
						<td>
							<select name="category"  class="preferences" id="cat2" onchange="showProjects(this.value,'drop2')">
								<option value="Select" selected>Select</option>
								<option value="Creative Ideas">Creative Ideas</option>
								<option value="Socially Relevant Projects">Socially Relevant Projects</option>
								<option value="Electronics Android">Electronics & Android Application</option>
								<option value="Projects from CFI">Projects by CFI</option>
								<option value="Robotics Automotive">Robotics/Automotive</option>
				                <option value="Image Processing">Computer Vision/Image Processing</option>
								
							</select>
						</td>
					</tr>
							     <tr>
						<td>
							Preference-2
						</td>
						<td>
							<select name="preference2" id="drop2"  >
							</select>
						</td>
					</tr>					
					<tr>
						<td colspan="2">
							<input type="submit" name="preferance_form" value="<?php if(!isset($_SESSION['status']))
                                  {
                                    echo "submit";
									}
                                  else
                                   {
                                    echo "update";                                       
									   }								   ?>" />
						</td>
					</tr>
				</table>
			</form>
		</div>
		</div>

<?php include("footer.php");
 ?>		
		