<div class="read-tab-content">
	<table>
		<tr>
			<td>UID <?php echo $activity->id; ?></td>
			<td><strong><?php echo $activity->title; ?></strong></td>
		</tr>
		<tr>
		<td colspan="2">
				<div class="brief-writeup"><p class="text"><?php echo $activity->brief_writeup; ?></p></div>
			</td>
		</tr>
		<tr>
		<td colspan="2">
			<div class="detail-writeup-left"><p class="text"><?php echo $activity->detailed_writeup; ?></p></div>
			<div class="detail-writeup-right">
				<center>
					<img src="upload/ActivityImages/bgimages/<?php echo $activity->bg_image_link; ?>" />
				</center>
			</div>
		</td>
		</tr>
		<tr>
			<td><strong>Status: </strong><?php echo $activity->status; ?></td>
			<td><strong>Tags: </strong><?php echo $activity->tags; ?></td>
		</tr>
		<tr>
			<td><strong>Overall Budget: </strong><?php echo $activity->overall_budget; ?></td>
			<td><strong>Utilized Budget: </strong><?php echo $activity->utilized_budget; ?></td>
		</tr>
	</table>
	<div class="edit-activity-btn"><div></div>Edit</div>
</div>

<div class="editAcivityFormDiv">

	<form name="update_activity" class="form-horizontal" action="index.php?action=update_activity" method="POST" enctype="multipart/form-data">
	<input type="hidden" class="input-xlarge" name = "id" value="<?php echo $activity->id;?>" > 
	<table>
		<tr>
			<td>UID <?php echo $activity->id; ?></td>
			<td><input type="text" class="input-xlarge" name = "title" value="<?php echo $activity->title;?>"></td>
		</tr>
		<tr>
			<td colspan="2">
				<div class="brief-writeup"><textarea class="input-xlarge" id="textarea" rows="2" name = "brief_writeup"><?php echo $activity->brief_writeup;?></textarea></div>
			</td>
		</tr>
		<tr>
		<td colspan="2">
			<div class="detail-writeup-left"><textarea class="input-xlarge" id="textarea" rows="6" name = "detailed_writeup"><?php echo $activity->detailed_writeup;?></textarea></div>
			<div class="detail-writeup-right">
				<center>
					<img src="upload/ActivityImages/<?php echo $activity->bg_image_link; ?>" />
				</center>
			</div>
		</td>
		</tr>
		<tr>
			<td><strong>Status: </strong><?php echo $activity->status; ?></td>
			<td><strong>Tags: </strong><input type="text" class="input-xlarge" name = "tags" value="<?php echo $activity->tags;?>" id="input01"></td>
		</tr>
		<tr>
			<td><strong>Overall Budget: </strong><input type="text" class="input-xlarge" name = "overall_budget" value="<?php echo $activity->overall_budget;?>"></td>
			<td><strong>Utilized Budget: </strong><input type="text" class="input-xlarge" name = "utilized_budget" value="<?php echo $activity->utilized_budget;?>"></td>
		</tr>
		<tr>
			<td><strong>Icon: </strong><input type="file" name="icon" id="exampleInputFile"></td>
			<td><strong>BG Image: </strong><input type="file" name="bgImg" id="exampleInputFile"></td>
		</tr>
	</table>
	<button type="submit" class="btn btn-primary">Save</button>
	<button type="button" class="btn btn-primary close-edit-activity-btn">Back</button>
	</form>
</div>

<div class="documentsDiv">	
	<!-- Documents Secction -->
	<?php include ("documents.php"); ?>
	<!-- End Documents Section-->	
</div>

<script>
	$('.editAcivityFormDiv').fadeOut(0);
	$('.detail-writeup-left>.text').cmtextconstrain({
		event: 'click', 
		onExpose: function(){}, 
		onConstrain: function(){}, 
		restrict: {type: 'words', limit: 60}, 
		showControl: {string: '[ More ]', title: 'Show More', addclass: ''}, 
		hideControl: {string: '[ Less ]', title: 'Show Less', addclass: ''}, 
		trailingString: '....'
    });
	$('.brief-writeup>.text').cmtextconstrain({
		event: 'click', 
		onExpose: function(){}, 
		onConstrain: function(){}, 
		restrict: {type: 'words', limit: 30}, 
		showControl: {string: '[ More ]', title: 'Show More', addclass: ''}, 
		hideControl: {string: '[ Less ]', title: 'Show Less', addclass: ''}, 
		trailingString: '....'
    });
	$('.documentsDiv table .file-tag').cmtextconstrain({
		event: 'click', 
		onExpose: function(){}, 
		onConstrain: function(){}, 
		restrict: {type: 'words', limit: 4}, 
		showControl: {string: '[ More ]', title: 'Show More', addclass: ''}, 
		hideControl: {string: '[ Less ]', title: 'Show Less', addclass: ''}, 
		trailingString: '....'
    });
	$('.edit-activity-btn').click(function(){
		$('.read-tab-content').fadeOut(0);
		$('.editAcivityFormDiv').fadeIn(100);
	});
	$('.close-edit-activity-btn').click(function(){
		$('.read-tab-content').fadeIn(100);
		$('.editAcivityFormDiv').fadeOut(0);
	});
</script>

<div class="messages">
	<div class="messages-sent" style="">
		<?php
		$tags=$activity->title;
		//echo $tags;//echo $results['user']->email;
		$messages_sent=Message::getByTagSent( $tags,$results['user']->email );
		?>

		<button type="button" class="btn btn-primary " id="dropdownMenu1" data-toggle="dropdown" style="margin-top:2%;margin-left:2%;">
		Messages sent <span class="badge "><?php echo sizeof($messages_sent)?></span>
		</button>
		
		<ul id="messages_sent" class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
		<?php

				for($i=0;$i<sizeof($messages_sent);$i++)
				{
				?>
				<li style="padding:10px;">
				<?php
				echo $messages_sent[$i]['to_username']."</br>";
				echo $messages_sent[$i]['message']."</br>";
				echo $messages_sent[$i][4]."</br>";
				?>
				</li>
				<?php
				
				}
		?>
		</ul>
	</div>
	<div class="messages-received" style="">
		<?php
		$tags=$activity->title;
		//echo $tags;//echo $results['user']->email;
		$messages_received=Message::getByTagReceived( $tags,$results['user']->email );
		?>

		<button type="button" class="btn btn-primary " id="dropdownMenu1" data-toggle="dropdown" style="margin-top:2%;margin-left:2%;">Messages Received <span class="badge "><?php echo sizeof($messages_received)?></span></button>
		<ul id="messages_sent" class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
		<?php

				for($i=0;$i<sizeof($messages_received);$i++)
				{
				?>
				<li style="padding:10px;">
				<?php
				echo $messages_received[$i]['from_username']."</br>";
				echo $messages_received[$i]['message']."</br>";
				echo $messages_received[$i][4]."</br>";
				?>
				</li>
				<?php
				
				}
		?>
		</ul>
	</div>
</div>