<?php include("templates/include/header.php"); ?>
	<div id="content">
		dashboard<br>
		<?php echo $results['user']->email; ?>;
		<?php print_r( $results['user']->getActivityOfUser('club') ) ?>
	</div>
<?php include("templates/include/footer.php"); ?>