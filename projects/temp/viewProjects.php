<html>
<head>
	<style type="text/css">
		body{
			font-family:"Calibri";
		}
		td{
			border:solid 1px #999;
			padding: 4px 10px;
		}
	</style>
</head>
<body>
<?php
$pref_id = $_GET['preference'];
$con = mysqli_connect('localhost','cfi','&CFI$13i3DbPw0','cfi');

if (!$con){
  die('Could not connect: ' . mysqli_error($con));
}

if( isset( $_GET['preference'] ) ){

	$sql="SELECT DISTINCT preference".$pref_id." FROM preferences "; //echo $sql;
	$result = mysqli_query($con, $sql);

	while( $row = mysqli_fetch_array( $result ) ){
		echo "<center><table>";
		echo "<tr><td colspan='8' style='text-align:center;color:#fff;background:#2d2d2d;'>".$row["preference$pref_id"]."</td></tr>";
		$sql2 = "SELECT uploadedBy, uploadedOn FROM preferences WHERE preference".$pref_id." = '".$row["preference$pref_id"]."'"; 
		$result2 = mysqli_query($con, $sql2);
		$i = 1;
		while( $row2 = mysqli_fetch_array( $result2 ) ){
			$sql3 = "SELECT * FROM users WHERE username = '".$row2['uploadedBy']."'";
			$result3 = mysqli_query($con, $sql3);
			while( $row3 = mysqli_fetch_array( $result3 ) ){
				echo "<tr>"."<td>".$i."</td>".
					 "<td>".$row3['name']."</td>".
					 "<td>".$row3['rollNo']."</td>".
					 "<td>".$row3['email']."</td>".
					 "<td>".$row3['phone']."</td>".
					 "<td>".$row3['room']."</td>".
					 "<td>".$row3['hostel']."</td>".
					 "<td>".$row2['uploadedOn']."</td>"."</tr>";
					 $i++;
			}
		}
		echo "</table></center><br>";
	}
}
else if( isset( $_GET['users'] ) ){
	$sql3 = "SELECT * FROM users";
	$result3 = mysqli_query($con, $sql3);
	echo "<center><table>";
	$i = 1;
	while( $row3 = mysqli_fetch_array( $result3 ) ){
		echo "<tr>"."<td>".$i."</td>".
			 "<td>".$row3['name']."</td>".
			 "<td>".$row3['rollNo']."</td>".
			 "<td>".$row3['email']."</td>".
			 "<td>".$row3['phone']."</td>".
			 "<td>".$row3['room']."</td>".
			 "<td>".$row3['hostel']."</td>"."</tr>";
			 $i++;
	}
	echo "</table></center><br>";
}

?>
</body>
</html>