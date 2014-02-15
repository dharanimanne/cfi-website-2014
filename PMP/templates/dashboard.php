<?php include("templates/include/header.php"); ?>
<?php include("templates/include/sidebar.php"); ?>
	<div id="content">
		dashboard<br>
		<?php

		echo $results['user']->email; 
		$clubs = $results['user']->getActivityOfUser('club');  
		$competitions = $results['user']->getActivityOfUser('competition');  
		$projects = $results['user']->getActivityOfUser('project');
		echo $clubs['0']['activityType'];
	//	print_r( $clubs );
		?>
	</div>
<?php include("templates/include/footer.php"); ?>