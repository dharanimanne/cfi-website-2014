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
				foreach( $clubs as $club ) {
					print_r( $club );
			?> 
				<br>
			<?php } ?>
		</div>
		<div id="competitionsDiv">
			<h1>Clubs</h1><br>
			<?php $clubs = $results['user']->getActivityOfUser('competition'); ?> 
		</div>
		<div id="projectsDiv">
			<h1>Clubs</h1><br>
			<?php $clubs = $results['user']->getActivityOfUser('project'); ?> 
		</div>
	</div>
<?php include("templates/include/footer.php"); ?>