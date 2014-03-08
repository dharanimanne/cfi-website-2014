<?php include("templates/include/header.php"); ?>
<?php include("templates/include/sidebar.php"); ?>
   	
   	<style>
   		.messageDisplay{
   			margin-left: 460px;
   			width: 500px;
   			height: 30px;
   			position: absolute;
   			z-index: 100;
   			background-color: rgb(200,200,200);
   		}
   	</style>
   	
	<div id="content">
		<div class="messageDisplay">
   			<?php 	
   				if( isset($results['successMessage']) ) 
   					echo $results['successMessage']; 
   				elseif ( isset($results['errorMessage']) ) {
   					echo $results['errorMessage'];
   				?>
   		</div>
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
					<li class="active"><a class="glyphicons cardio" href="#welcome-tab" data-toggle="tab">Welcome</a></li>
					<li><a class="glyphicons cardio" href="#activity-tab" data-toggle="tab">Your Activity</a></li>
				</ul>
			</div>
			<br>
		</div>	
	</div>

<script>
	$(document).ready(function()  {
    setTimeout(function() {
        $(".messageDisplay").fadeOut(1500);
    },5000);
        });
</script>
<?php include("templates/include/footer.php"); ?>
