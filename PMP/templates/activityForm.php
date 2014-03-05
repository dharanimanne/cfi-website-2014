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
					<img src="upload/ActivityImages/<?php echo $activity->bg_image_link; ?>" />
				</center>
			<div>
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
</div>
<script>
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
	$('#edit-activity-btn').click(function(){
		$('.read-tab-content').fadeOut(0);
		$('.editAcivityFormDiv').fadeIn(100);
	});
</script>
<div id="edit-activity-btn"><div></div>Edit</div>
<div class="editAcivityFormDiv">
	<form name="update_activity" class="form-horizontal" action="index.php?action=update_activity" method="POST" style="width:500px;" enctype="multipart/form-data">
		<fieldset>	
			<div class="control-group">  
				<label class="control-label" for="input01">Activity Id</label>  
				<div class="controls">  
				  <input type="hidden" class="input-xlarge" name = "id" value="<?php echo $activity->id;?>" id="input01">  
				</div>  
			 </div> 	
			 
			<div class="control-group">  
				<label class="control-label" for="input01">Title</label>  
				<div class="controls">  
				  <input type="text" class="input-xlarge" name = "title" value="<?php echo $activity->title;?>" id="input01">  
				  <p class="help-block"></p>  
				</div>  
			</div> 		 		
			  
			<div class="control-group">  
				<label class="control-label" for="textarea">About</label>  
				<div class="controls">  
					<textarea class="input-xlarge" id="textarea" rows="3" name = "brief_writeup"><?php echo $activity->brief_writeup;?></textarea>  
				</div>  
			</div>  
		  
			<div class="control-group">  
				<label class="control-label" for="textarea">Details</label>  
				<div class="controls">  
					<textarea class="input-xlarge" id="textarea" rows="3" name = "detailed_writeup"><?php echo $activity->detailed_writeup;?></textarea>  
				</div>  
			</div>  	 	
			  
			  
			<div class="control-group">  
				<label class="control-label" for="input01">Status</label>
				<div class="controls">  
					<input type="text" class="input-xlarge" name = "status" value="<?php echo $activity->status;?>" id="input01">  
				<p class="help-block"></p>  
				</div>  
			</div> 	
			  
			<div class="control-group">  
				<label class="control-label" for="input01">Tags</label>  
				<div class="controls">  
				  <input type="text" class="input-xlarge" name = "tags" value="<?php echo $activity->tags;?>" id="input01">  
				  <p class="help-block"></p>  
				</div>  
			</div> 	
							
			<div class="control-group">  
				<label class="control-label" for="input01">Overall Budget</label>  
				<div class="controls">  
				  <input type="text" class="input-xlarge" name = "overall_budget" value="<?php echo $activity->overall_budget;?>" id="input01">  
				  <p class="help-block"></p>  
				</div>  
			</div> 	
						
			<div class="control-group">  
				<label class="control-label" for="input01">Utilized Budget</label>  
				<div class="controls">  
				  <input type="text" class="input-xlarge" name = "utilized_budget" value="<?php echo $activity->utilized_budget;?>" id="input01">  
				  <p class="help-block"></p>  
				</div>  
			</div> 	
			  
			<div class="control-group">
				<label class="control-label" for="Icon">Icon</label>
				<div class="controls">
					<input type="file" name="icon" id="exampleInputFile">
					<p class="help-block"><?php echo $activity->icon_link;?> - To be fixed later</p>
				</div>
			</div>   
			
			<div class="control-group">
				<label class="control-label" for="Icon">BG - Image</label>
				<div class="controls">
					<input type="file" name="bgImg" id="exampleInputFile">
					<p class="help-block"><?php echo $activity->bg_image_link;?> - To be fixed later</p>
				</div>
			</div>
			
			<div class="form-actions">  
				<center>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</center>  
			</div>  
			
		</fieldset>
	</form>
</div>