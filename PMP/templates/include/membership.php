<?php 
	if($_GET['type']=="Projects")
		$type = "project";
	else if($_GET['type']=="Clubs")
		$type = "club";
	else if($_GET['type']=="Competitions")
		$type = "competition";
	
	session_start();
	require("../../config.php");
	$username = isset( $_SESSION['username'] ) ? $_SESSION['username']: "";
	$user = User::getByUsername( $_SESSION['username'] );
	$results['user'] = $user;		
 ?> 
			
<div>     
    <ul class="breadcrumb">
		<li><a href="index.php" class="glyphicons home">CFI PMP</a></li>
		<li class="divider"></li>
		<li>Dashboard</li>
		<li class="divider"></li>
		<li><?php echo $_GET['type']; ?></li>
	</ul>
	<div class="separator bottom"></div>
	<div class="heading-buttons">
		<h3 class="glyphicons display"> <?php echo $_GET['type']; ?></h3>
		<div class="clearfix" style="clear: both;"></div>
	</div>
	<div class="separator bottom"></div>
	<div class="separator bottom"></div>
	<div class="widget widget-2 widget-tabs widget-tabs-2">
		<?php 
			$types = $results['user']->getActivityOfUser($type); 
			if( count( $types ) ){
		?> 
		<div class="widget-head">
			<ul id="myTab">
			<?php foreach( $types as $type ) {
					$activity = $type; ?>
					
					
				<li><a class="glyphicons cardio" href="#<?php echo $activity->id; ?>" data-toggle="tab"><?php echo $activity->title; ?></a></li>
				
				<?php } ?>
			</ul>
		</div>
			 
		<div class="tab-content">
			<div class="tab-pane in active" id="default" style="padding:40px;">
				Click On Any Of the Tabs Above for Your Membership Details.
			</div>		
			<?php foreach( $types as $type ) {
				$activity = $type;
			?> 
			<div class="tab-pane fade" id="<?php echo $activity->id; ?>">
				<?php require("../activityForm.php"); ?>
			</div>
			<?php } ?>
		</div>
			<?php }
			else{ 
			?>
			<div class="tab-content">
				<div class="tab-pane in active" id="default" style="padding:40px;">
				<?php
					echo " No enrolled activities to display<br>";
				} ?>	
				</div>
			</div>
	</div>
</div>
        
    <script>
		$('#myTab a').click(function (e) {
		  e.preventDefault()
		  $(this).tab('show')
		})
	</script>