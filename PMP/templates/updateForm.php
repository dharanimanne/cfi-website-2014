		<div id="UpdateDiv">
			<form name="updateForm" class="form-horizontal" action="index.php?action=update" method="POST" style="width:500px;">
            	<fieldset> 
                <legend>Update Your Profile</legend>  
                
                
				<div class="control-group">  
            <label class="control-label" for="input01">Name</label>  
            <div class="controls">  
              <input type="text" class="input-xlarge" value="<?php if( isset( $results['user']->name ) ) echo $results['user']->name; ?>" id="input01">  
              <p class="help-block"></p>  
            </div>  
          </div> 	
          
          	<div class="control-group">  
            <label class="control-label" for="input01">Room</label>  
            <div class="controls">  
              <input type="text" class="input-xlarge" value="<?php if( isset( $results['user']->room ) ) echo $results['user']->room; ?>" id="input01">  
              <p class="help-block"></p>  
            </div>  
          </div> 	
           
          	<div class="control-group">  
            <label class="control-label" for="input01">Hostel</label>  
            <div class="controls">  
              <input type="text" class="input-xlarge" value="<?php if( isset( $results['user']->hostel ) ) echo $results['user']->hostel; ?>" id="input01">  
              <p class="help-block"></p>  
            </div>  
          </div> 	
          
           
          	<div class="control-group">  
            <label class="control-label" for="input01">Phone</label>  
            <div class="controls">  
              <input type="text" class="input-xlarge" value="<?php if( isset( $results['user']->phone ) ) echo $results['user']->phone; ?>" id="input01">  
              <p class="help-block"></p>  
            </div>  
          </div> 	
          
          	<div class="control-group">  
            <label class="control-label" for="input01">Expertise</label>  
            <div class="controls">  
              <input type="text" class="input-xlarge" value="<?php if( isset( $results['user']->expertise ) ) echo $results['user']->expertise; ?>" id="input01">  
              <p class="help-block"></p>  
            </div>  
          </div> 	
          
          	<div class="control-group">  
            <label class="control-label" for="input01">SocialMediaUrl</label>  
            <div class="controls">  
              <input type="text" class="input-xlarge" value="<?php if( isset( $results['user']->socialMediaUrl ) ) echo $results['user']->socialMediaUrl; ?>" id="input01">  
              <p class="help-block"></p>  
            </div>  
          </div> 	
          
           
          	<div class="control-group">  
            <label class="control-label" for="input01">About Me</label>  
            <div class="controls">  
              <input type="text" class="input-xlarge" value="<?php if( isset( $results['user']->aboutMe ) ) echo $results['user']->aboutMe; ?>" id="input01">  
              <p class="help-block"></p>  
            </div>  
          </div> 	
          
			<div class="form-actions">  <center>
            <button type="submit" class="btn btn-primary">Save changes</button> </center>  
          </div>  
			</form>
		</div>
        
        
        
        
		<div id="UpdatePasswordDiv">    
                        	
			<form name="updatePasswordForm"  class="form-horizontal" action="index.php?action=updatePassword" method="POST" style="width:500px;">	
            	<fieldset> 
                <legend>Update your password</legend> 
                
                
          	<div class="control-group">  
            <label class="control-label" for="input01">New Password</label>  
            <div class="controls">  
              <input type="password" name="password" placeholder="Choose Password" />  
              <p class="help-block"></p>  
            </div>  
          </div> 	
                
          	<div class="control-group">  
            <label class="control-label" for="input01">Confirm New Password</label>  
            <div class="controls">  
              <input type="password" name="password_confirmation" placeholder="Re-type Password" />
              <p class="help-block"></p>  
            </div>  
          </div> 	
			
            <div class="form-actions">  <center>
            <button type="submit" class="btn btn-primary">Save changes</button> </center>  
          </div>  
			</form>
		</div>
		<div id="messageDiv">
			<?php if( isset( $results['successMessage'] ) ) { ?>
			<div class="message success">
				<?php echo $results['successMessage']; ?> 
			</div>
			<?php } 
				if( isset( $results['errorMessage'] ) ) { ?>
				<div class="message error">
					<?php echo $results['errorMessage']; ?> 
				</div>
			<?php } ?>			
		</div>
