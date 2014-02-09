<html>
<head>
	<title>forms</title>
	<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>
		<link type="text/css" rel="stylesheet" href="css/bootstrap-theme.css"/>
		<link type="text/css" rel="stylesheet" href="css/bootstrap-theme.min.css"/>
</head>
<body class="well">
	<form action="testing.php" method="post" enctype="multipart/form-data">
		<label>USER NAME:</label><br/>
		<input type="text" class="span3" name="username" value=""/>
		<br/>
		<label>PASSWORD:</label><br/>
		<input type="password" class="span3" name="password" value=""/>
		<br/>
		<label>NAME:</label><br/>
		<input type="text" class="span3" name="name" value=""/>
		<br/>
		<label>ROLL NUMBER:</label><br/>
		<input type="text" name="roll" value=""/>
		<br/>
		
		<label>HOSTEL:</label><br/>
		<input type="text" name="hostel" value=""/>
		<br/>
		<label>ROOM NUMBER:</label><br/>
		<input type="text" name="room" value=""/>
		<br/>
		
		<br/>
		<button  class="btn btn-primary"/>SUBMIT</button>
    </form>
	<script src="js/bootstrap.js"></script>
</body>
</html>