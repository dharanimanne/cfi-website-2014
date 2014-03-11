<?php
session_start();
	if ( isset($_POST) ){
			$connect = mysql_connect("localhost","root","") or die("check your server connection");
            $db = mysql_select_db("cfi-2014");
		 
		// Check connection
		
            
			$name = $_POST['name'];
			$rollNo = $_POST['rollNo'];
			$hostel = $_POST['hostel'];
			$room = $_POST['room'];
			$phone = $_POST['phone'];
			$email = $_POST['email'];
			$aboutMe = $_POST['aboutMe'];
			$preference1 = $_POST['preference1'];
			$preference2 = $_POST['preference2'];
			$uploadedOn = date("Y-m-d H:i:s");
		 $query = "SELECT * FROM preferences WHERE Email='$email'";
$result = mysql_query($query);
$num = mysql_num_rows($result);
if ($num==0)
{
$success="successfully added preferences,you can update the preferences!";
}
else
{
$success="successfully updated";
}

			$query = "INSERT INTO preferences (name, rollNo, hostel, room, phone, email, aboutMe, preference1, preference2, uploadedOn)
			VALUES ( '$name', '$rollNo', '$hostel', '$room', '$phone', '$email', '$aboutMe', '$preference1', '$preference2','$uploadedOn')";
			print_r($query);
			if ( mysql_query($query)) 
			{
				$_SESSION['status']=$success;
				header('location:preferenceForm.php');
			}
			else
              echo "fail :(";
	
		}
	

?>
	
	<?php /*	$con=mysqli_connect(DB_USERNAME, DB_PASSWORD, DB_DSN); 
		// Check connection
		if (mysqli_connect_errno())
		  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }
		else {
		
			$sql = "SELECT title FROM summerprojects WHERE category='".$category."'";
			$result = mysqli_query($con,$sql);

		mysqli_close($con);
		}*/
?>