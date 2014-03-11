<?php include("templates/include/header.php"); ?>
<?php include("templates/include/sidebar.php"); ?>
   
	<div id="content">
		<ul class="breadcrumb">
			<li><a href="index.php" class="glyphicons home">CFI PMP</a></li>
			<li class="divider"></li>
			<li>Dashboard</li>
		</ul>
		<div class="separator bottom"></div>
		<div class="heading-buttons">
			<h3 class="glyphicons display"> Dashboard</h3>
			<div class="clearfix" style="clear: both;"></div>
		</div>
		<div class="separator bottom"></div>

		<div class="separator bottom"></div>
		<div class="widget widget-2 widget-tabs widget-tabs-2">
			<div class="widget-head">
				<ul>
					<li class="active"><a class="glyphicons cardio" href="#welcome-tab" data-toggle="tab">Register Preferences</a></li>
					<li><a class="glyphicons cardio" href="#activity-tab" data-toggle="tab">Your Activity</a></li>
				</ul>
			</div>
			<br>
		</div>	
		<div id="returnMessage">
			<?php if( isset( $results['errorMessage'] ) && strlen( $results['errorMessage'] ) > 0 ) { ?>
				<div class="alert alert-error"><?php echo $results['errorMessage']; ?></div>
			<?php } if( isset( $results['successMessage'] ) && strlen( $results['successMessage'] ) > 0 ) { ?>
				<div class="alert alert-success"><?php echo $results['successMessage']; ?></div>
			<?php } ?>
		</div>
	</div>

<?php include("templates/include/footer.php"); ?>