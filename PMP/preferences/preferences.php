<?php
	
	if ( isset($_POST) ){
			
		$con=mysqli_connect( 'localhost', DB_USERNAME, DB_PASSWORD, DB_DSN); 
		// Check connection
		if (mysqli_connect_errno())
		  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  header("Location:preferenceForm.php");
		  }
		else {

			$name = $_POST['name'];
			$preference1 = $_POST['preference1'];
			$preference2 = 'this is second preference'//$_POST['preference2'];
			$uploadedOn = date("Y-m-d H:i:s");
		
			$sql = "INSERT INTO preferences (name, preference1, preference2, uploadedOn)
			VALUES ( ".$name.", ".$preference1.", ".$preference2.", ".$uploadedOn.")";
			if ( mysqli_query($con,$sql) )
			{
				echo "Successfully registered your preferences. Thank you.";
			}

		mysqli_close($con);
		header("Location:preferenceForm.php");
		}
	}

?>
