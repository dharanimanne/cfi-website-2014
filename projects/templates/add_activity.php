<div id="content">
		<div id="registerDiv">
			Add activity <br>
			<form name="add_activity" action="../index.php?action=add_activity" method="POST">
				 <input type="text" name="title" placeholder="Title of activity" /><br>
				 <input type="text" name="brief_writeup" placeholder="Brief description" /><br>
				 <input type="text" name="detailed_writeup" placeholder="Detailed description" /><br>
				<input type="text" name="status" placeholder="status" /><br>
				<input type="text" name="tags" placeholder="Tags" /><br>
				<input type="text" name="overall_budget" placeholder="Overall budget" /><br>
				<input type="text" name="utilized_budget" placeholder="Utilized budget" /><br>
					<input type="text" name="activity_type" placeholder="Activity type" /><br>
					<input type="text" name="icon_link" placeholder="icon" /><br>
					<input type="text" name="bg_image_link" placeholder="bg_image" /><br>
				<input type="submit" name="register_form" value="Create" /> 
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
	</div>


