<?php
$category = $_GET['category'];
$con = mysqli_connect('localhost','root','','cfi-2014');

if (!$con){
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"cfi-2014");
$sql="SELECT * FROM summerprojects WHERE category = '".$category."'"; //echo $sql;
$result = mysqli_query($con, $sql);
echo "<option value=\"-1\">Select a project</option>";
while($row = mysqli_fetch_array($result)){
   echo "<option value='".$row['title']."'>" . $row['title'] . "</option>";
}

mysqli_close($con);
?>