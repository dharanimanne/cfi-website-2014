
<form name="update_activity" action="index.php?action=update_activity" method="POST">
	Activity Id <input type="text" name="id" value="<?php echo $activity->id;?>" /><br>	 		
	Title <input type="text" name="title" value="<?php echo $activity->title;?>" /><br>	 		
	About <textarea name="brief_writeup"><?php echo $activity->brief_writeup;?></textarea><br>	 	
	Details <textarea name="detailed_writeup"><?php echo $activity->detailed_writeup;?></textarea><br>	 
	Status <input type="text" name="status" value="<?php echo $activity->status;?>" /><br>	 		
	Tags <input type="text" name="tags" value="<?php echo $activity->tags;?>" /><br>	 		
	Overall Budget <input type="text" name="overall_budget" value="<?php echo $activity->overall_budget;?>" /><br>	 		
	Utilized Budget <input type="text" name="overall_budget" value="<?php echo $activity->utilized_budget;?>" /><br>	 
	Icon <input type="text" name="icon_link" value="<?php echo $activity->icon_link;?>" /><br>	 
	BG Image <input type="text" name="bg_image_link" value="<?php echo $activity->bg_image_link;?>" /><br>	
	<input type="submit" name="update_activity" value="Update"/>
</form>