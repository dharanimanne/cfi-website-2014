<?php
	include_once("db.php");
	
	$sql = "SELECT * from memberships WHERE userId = {$_SESSION['userId']} AND activityType = 'project' ";
	$result = mysql_query( $sql );
	$projects = array();
	$team_members = array();
	$i = 0;
	
	while( $row = mysql_fetch_array( $result ) ){
		$sql = "SELECT * FROM activity WHERE id = {$row['activityId']}";
		$result2 = mysql_query( $sql );
		$row2 = mysql_fetch_array( $result2 );
		array_push( $projects, $row2['title'] );
		
		$team_members[$i] = array();
		$sql = "SELECT * FROM memberships WHERE activityId = {$row['activityId']} and activityType = 'project'";
		$result3 = mysql_query( $sql );
		while( $row3 = mysql_fetch_array( $result3 ) ){
			$sql = "SELECT * FROM users WHERE id = {$row3['userId']}";
			$result4 = mysql_query( $sql );
			while( $row4 = mysql_fetch_array( $result4 ) ){
				array_push( $team_members[$i], $row4 );
			}
		}
		$i++;
	}
?>
<style type="text/css">
	#welcomeDiv {
		padding: 10px;
		margin: 5px;
		border: solid 1px rgb(241, 237, 237);
	}
	#welcomeDiv select {
		font-style:normal;
		font-family:Oswald;
	}
	#welcomeDiv table {
		width: 100%;
	}
	#welcomeDiv table td {
		text-align: center;
		border: solid 1px rgb(241, 237, 237);
		padding:2px 5px;		
	}
	.preview{
		cursor:pointer;
		text-transform:capitalize;
	}
	.member{
		float:left;
		padding:5px 10px;
		border:solid 1px #E4DEDE;
		margin-right:8px;
		margin-bottom:4px;
		background:rgb(235, 235, 235);
		color:rgb(99, 85, 85);
		font-weight:300;
	}
	.member-container{
		margin-left:20px;
	}
	.member-self{
		background: rgb(212, 85, 85);
		color: #fff;
		border: rgb(241, 199, 150);
	}
	h5{
		font-family:Oswald;
	}
</style>
<div id="welcomeDiv">
	<h5>Congratulations, you have been allocated to the following project(s) :</h5>
	
	<center>
		<?php
			$i = 0;
			foreach($projects as $project){
				echo "<div class='alert alert-success'>$project</div>
						<div class=\"member-container\">";
				foreach( $team_members[$i] as $team_member ){
					$addedClass = '';
					if( $team_member['email'] == $_SESSION['username'] ) $addedClass = "member-self";
		?>
				<div class="member <?php echo $addedClass; ?>">
					<span class='preview' data-container="body" data-toggle="popover" data-placement="top" >	<?php echo $team_member['name']; ?>
						<p style="display:none;">
							<?php echo $team_member['name']; ?><br>
							<?php echo $team_member['rollNo']; ?><br>
							<?php echo $team_member['email']; ?><br>
							<?php echo $team_member['phone']; ?><br>
							<?php echo $team_member['hostel']; ?>
						</p>
					</span>
				</div>
		<?php
				}
				echo "</div><br><br><br><br>";
				$i++;
			}
		?>
		
	</center>
	

</div>