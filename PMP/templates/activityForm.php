
<form name="update_activity" class="form-horizontal" action="index.php?action=update_activity" method="POST" style="width:500px;">
	<fieldset> 
          <legend><?php echo $activity->title;?></legend>  
<div class="control-group">  
            <label class="control-label" for="input01">Activity Id</label>  
            <div class="controls">  
              <input type="text" class="input-xlarge" name = "id" value="<?php echo $activity->id;?>" id="input01">  
              <p class="help-block">Do NOT edit this....</p>  
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
    <input type="file" id="exampleInputFile">
    <p class="help-block"><?php echo $activity->icon_link;?> - To be fixed later</p>
    </div>
  </div>   
    <div class="control-group">
    <label class="control-label" for="Icon">BG - Image</label>
    <div class="controls">
    <input type="file" id="exampleInputFile">
    <p class="help-block"><?php echo $activity->bg_image_link;?> - To be fixed later</p>
    </div>
  </div>
           		 			 
    
    
              <div class="form-actions">  <center>
            <button type="submit" class="btn btn-primary">Save changes</button> </center>  
          </div>  
	</fieldset>
</form>