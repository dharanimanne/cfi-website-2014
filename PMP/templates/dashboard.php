<?php include("templates/include/header.php"); ?>
<?php include("templates/include/sidebar.php"); ?>
	<div id="content">
		dashboard<br>
		<?php echo $results['user']->email; ?>;
		<?php print_r( $results['user']->getActivityOfUser('club') ) ?>
	</div>
<?php include("templates/include/footer.php"); ?>