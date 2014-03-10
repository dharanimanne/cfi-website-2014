<?php
	
	if ( isset($_POST) ){
			
		$con=mysqli_connect(DB_USERNAME, DB_PASSWORD, DB_DSN); 
		// Check connection
		if (mysqli_connect_errno())
		  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }
		else {

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
		
			$sql = "INSERT INTO preferences (name, rollNo, hostel, room, phone, email, aboutMe, preference1, preference2, uploadedOn)
			VALUES ( ".$name.", ".$rollNo.", ".$hostel.", ".$room.", ".$phone.", ".$email.", ".$aboutMe.", ".$preference1.", ".$preference2.", ".$uploadedOn.")";
			mysqli_query($con,$sql);

		mysqli_close($con);
		}
	}

?>