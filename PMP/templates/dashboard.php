<?php include("templates/include/header.php"); ?>
<?php include("templates/include/sidebar.php"); ?>
	<!--<div id="content">
		<!--dashboard<br>

		<div id="addMemberDiv">
			Need to add a member? Please enter details below. <br>
			<form name="addMemberForm" action="index.php?action=addMember" method="POST">
				Username <input type="text" name="add_username" placeholder="Email as Username" /><br>
				Activity ID <input type="text" name="activityId" placeholder="" /><br> 
			   <input type="submit" name="add_member_form" value="addMember" /> 
			</form>	
		</div>
      <div id="createMessageDiv">
			Message <br>
			<form name="createMessageForm" action="index.php?action=create_message" method="POST">
			 <input type="text"  style="display:none;" name="from_username"  value="<?php echo $results['user']->email; ?>" /> <br>
				To <input type="text" name="to_username" placeholder="Email or Username" /><br>
				Message <input type="text" name="message" placeholder="message" /><br> 
				Tags <input type="text" name="tags" placeholder="tags" /><br> 
			   <input type="submit" name="add_member_form" value="submit" /> 
			</form>	
		</div>-->
		<?php
		//echo $results['user']->avatarLocation;
		//echo $results['user']->email; 
		//$clubs = $results['user']->getActivityOfUser('club');  
		//$competitions = $results['user']->getActivityOfUser('competition');  
		//$projects = $results['user']->getActivityOfUser('project');
		//echo $clubs['0']['activityType'];
		//print_r( $clubs );
		?>
		<!--<div id="user_profile">
		<img src="./upload/<?php echo $results['user']->avatarLocation; ?>" width="360" height="350">
		</div>
		<div id="Messages">
		<h3>Messages received</h3><br>
        <?php
		$messages_received=Message::getBytoUsername( $results['user']->email );
		
		for($i=0;$i<sizeof($messages_received);$i++)
		{
		echo $messages_received[$i]['from_username']."</br>";
		echo $messages_received[$i]['message']."</br>";
		echo $messages_received[$i][4]."</br>";
		}
		?>
		<h3>Messages sent</h3><br>
        <?php
		$messages_sent=Message::getByfromUsername( $results['user']->email );
		
		for($i=0;$i<sizeof($messages_sent);$i++)
		{
		echo $messages_sent[$i]['to_username']."</br>";
		echo $messages_sent[$i]['message']."</br>";
		echo $messages_sent[$i][4]."</br>";
		}
		?>
		<h3>Messages received by Activity</h3><br>
        
		
		
    
		</div>-->
		<!--<div id="clubsDiv">
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
		</div>-->
	</div>-->
    
    
    
    
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
					<li class="active"><a class="glyphicons cardio" href="#website-traffic-tab" data-toggle="tab">Website Traffic</a></li>
					<li><a class="glyphicons cardio" href="#website-traffic-tab2" data-toggle="tab">Secondary Tab</a></li>
				</ul>
			</div>
			<br>
		</div>
	</div>
	
<?php include("templates/include/footer.php"); ?>