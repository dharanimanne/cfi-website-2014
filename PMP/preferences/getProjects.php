<?php
$category = $_GET['category'];

$con = mysqli_connect('localhost','root','','cfi-2014');
if (!$con)
  {
  die('Could not connect: ' . mysqli_error($con));
  }

mysqli_select_db($con,"cfi-2014");
$sql="SELECT * FROM summerprojects WHERE category = '".$category."'";

$result = mysqli_query($con,$sql);

echo $sql;

while($row = mysqli_fetch_array($result))
  {
  echo "<option value='".$row['title']."'>" . $row['title'] . "</option>";
//  echo "hey dude!!!";
//    echo "<option value='yo'>yo</option>";
  }

mysqli_close($con);
?>