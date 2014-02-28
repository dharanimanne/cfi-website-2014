<?php
	session_start();
	require("../config.php");
	$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
	$username ="rajiuser@gmail.com";
	$user= new User::getByUsername( "dharani.manne@gmail.com" );
	$clubs=$user::getActivityOfUser( "club" );
	$projects=$user::getActivityOfUser( "project" );
	$competitions=$user::getActivityOfUser( "competition" );
	if($user['membership']=="leader")
	{
	?>
	<div id="registerDiv">
			Add activity <br>
			<form name="add_activity" action="../index.php?action=update_activity" method="POST">
				   <select class="form-control" placeholder="Activity" name="id" >
				   
				  <?php
				  echo "clubs";
				  for ($j=0; $j<sizeof($clubs); $j++)
{
echo "<option value='".$clubs['id']."'>".$clubs['title']."</option>"
}
			  echo "projects";
				  for ($j=0; $j<sizeof($projects); $j++)
{
echo "<option value='".$projects['id']."'>".$projects['title']."</option>"
}
			  echo "clubs";
				  for ($j=0; $j<sizeof($competitions); $j++)
{
echo "<option value='".$competitions['id']."'>".$competitions['title']."</option>"
}
?>				  

</select>
			<input type="text" name="title" placeholder="New Title of activity" /><br>
				 <input type="text" name="brief_writeup" placeholder="Brief description" /><br>
				 <input type="text" name="detailed_writeup" placeholder="Detailed description" /><br>
				<input type="text" name="status" placeholder="status" /><br>
				<input type="text" name="tags" placeholder="Tags" /><br>
				<input type="text" name="overall_budget" placeholder="Overall budget" /><br>
				<input type="text" name="utilized_budget" placeholder="Utilized budget" /><br>
				<input type="submit" name="register_form" value="Create" /> 
			</form>
		</div>
		<?php
	}
	else
	{
	?>
	<div id="registerDiv">
			Add activity <br>
			<form name="add_activity" action="../index.php?action=update_activity" method="POST">
			 <select class="form-control" placeholder="Activity" name="id" >
				   
				  <?php
				  echo "clubs";
				  for ($j=0; $j<sizeof($clubs); $j++)
{
echo "<option value='".$clubs['id']."'>".$clubs['title']."</option>"
}
			  echo "projects";
				  for ($j=0; $j<sizeof($projects); $j++)
{
echo "<option value='".$projects['id']."'>".$projects['title']."</option>"
}
			  echo "clubs";
				  for ($j=0; $j<sizeof($competitions); $j++)
{
echo "<option value='".$competitions['id']."'>".$competitions['title']."</option>"
}
?>				  

</select>
				 <input type="text" name="title" placeholder="New Title of activity" /><br>
				 <input type="text" name="brief_writeup" placeholder="Brief description" /><br>
				 <input type="text" name="detailed_writeup" placeholder="Detailed description" /><br>
				<input type="text" name="status" placeholder="status" /><br>
				<input type="text" name="tags" placeholder="Tags" /><br>
				<input type="text" name="overall_budget" placeholder="Overall budget" /><br>
				<input type="text" name="utilized_budget" placeholder="Utilized budget" /><br>
				<input type="submit" name="register_form" value="Create" /> 
			</form>
		</div>
		<?php
	}
	// Send to login by default
	//if( $action != "login" && $action != "logout" && !$username){
		//login();
		//exit;
	//}
?>	