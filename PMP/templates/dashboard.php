<?php include("templates/include/header.php"); ?>
<?php include("templates/include/sidebar.php"); ?>
	<div id="content">
		dashboard<br>

		<div id="addMemberDiv">
			Need to add a member? Please enter details below. <br>
			<form name="addMemberForm" action="index.php?action=addMember" method="POST">
				Username <input type="text" name="username" placeholder="Email as Username" /><br>
				Activity ID <input type="text" name="activityId" placeholder="" /><br> 
			   <input type="submit" name="add_member_form" value="addMember" /> 
			</form>	
		</div>

		<?php
		//echo $results['user']->email; 
		//$clubs = $results['user']->getActivityOfUser('club');  
		//$competitions = $results['user']->getActivityOfUser('competition');  
		//$projects = $results['user']->getActivityOfUser('project');
		//echo $clubs['0']['activityType'];
		//print_r( $clubs );
		?>
		<div id="clubsDiv">
			<h1>Clubs</h1><br>
			<?php 
				$clubs = $results['user']->getActivityOfUser('club'); 
				foreach( $clubs as $club ) {
					echo $club->title;
					//print_r( $club );
			?> 
				<br>
			<?php } ?>
		</div>
		<div id="competitionsDiv">
			<h1>Competition</h1><br>
			<?php 
				$competitions = $results['user']->getActivityOfUser('competition'); 
				foreach( $competitions as $competition ) {
					echo $competition->title;
					//print_r( $club );
			?> 
				<br>
			<?php } ?>
		</div>
		<div id="projectsDiv">
			<h1>Projects</h1><br>
			<?php 
				$projects = $results['user']->getActivityOfUser('project'); 
				foreach( $projects as $project ) {
					echo $project->title;
					//print_r( $club );
			?> 
				<br>
			<?php } ?>
		</div>
	</div>
<?php include("templates/include/footer.php"); ?>