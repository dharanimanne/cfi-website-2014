<?php include("header.php"); 
$results = array();
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
	function showProjects(str)
		{
		if (str=="")
		  {
		  document.getElementById("drop").innerHTML="";
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
		    document.getElementById("drop").innerHTML=xmlhttp.responseText;
		    }
		  }
		xmlhttp.open("GET","getProjects.php?category="+str,true);
		xmlhttp.send();
		}
	
</script>
	<div id="bgDiv"></div>
     <div id="content" style="margin-left:0px;background:none;"><br><br><br>
		<div id="preferenceDiv">
			<div id="test">akshay</div>
			<div id="whiteBgDiv"></div>
			<form name="preferenceForm" action="/cfi_exchange/PMP/index.php?action=projectPreference" method="POST">
				<table>
				    <tr>
						<td>
							Preference-1 Category
						</td>
						<td>
							<select name="category"  class="preferences" id="cat1" onchange="showProjects(this.value)">
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
							     <tr>
						<td>
							Preference-1 Category
						</td>
						<td>
							<select name="dropdown" id="drop"  >
							</select>
						</td>
					</tr>		 
				</table>
			</form>
		</div>
		</div>

<?php include("footer.php");
print_r($results);
 ?>		
		