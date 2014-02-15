<?php include("templates/include/header.php"); ?>
<?php include("templates/include/sidebar.php"); ?>
	<div id="content">
		dashboard<br>
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
				if( count( $clubs ) ){
					foreach( $clubs as $club ) {
						Utility::parseActivityToForm( $club );
						//print_r( $club );
			?> 
				<br>
			<?php 
					}
				}
				else{
					echo " No enrolled clubs to display<br>";
				}
			?>
		</div>
		<div id="competitionsDiv">
			<h1>Competition</h1><br>
			<?php 
				$competitions = $results['user']->getActivityOfUser('competition'); 
				if( count( $competitions ) ){
					foreach( $competitions as $competition ) {
						Utility::parseActivityToForm( $competition );
						//print_r( $club );
			?> 
				<br>
			<?php 
					}
				}
				else{
					echo " No enrolled competitions to display<br>";
				}
			?>
		</div>
		<div id="projectsDiv">
			<h1>Projects</h1><br>
			<?php 
				$projects = $results['user']->getActivityOfUser('project'); 
				if( count( $projects ) ){
					foreach( $projects as $project ) {
						Utility::parseActivityToForm( $project );
						//print_r( $club );
			?> 
				<br>
			<?php 
					}
				}
				else{
					echo " No enrolled projects to display<br>";
				}
			?>
		</div>
	</div>
<?php include("templates/include/footer.php"); ?>