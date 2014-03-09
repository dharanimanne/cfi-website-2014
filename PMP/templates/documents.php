<div class="divHeading1">Documents</div>
<?php
	$row = Document::getDocumentByActivityId($activity->id);
?>
<table class="document-list">
	<tr>
		<td><strong>S No.</strong></td>
		<td><strong>Document Name</strong></td>
		<td><strong>Uploaded By</strong></td>
		<td><strong>Uploaded On</strong></td>
		<td><strong>Tags</strong></td>
		<td></td>
	</tr>
	
<?php
  for($i=0; $i<sizeof($row); $i++){
  $a=$i+1;
?>
	<tr>
		<td><?php echo $a; ?></td>
		<td><?php echo "<a target=\"_blank\" href=\"{$row[$i]['docLocation']}/{$row[$i]['docName']}\">".$row[$i]['docName']."</a>"; ?></td>
		<td><?php echo $row[$i]['uploadedBy']; ?></td>
		<td><?php echo $row[$i]['uploadedOn']; ?></td>
		<td class="file-tag" ><?php echo $row[$i]['tags']; ?></td>
		<td><a class="delete-doc-link" href="index.php?action=deleteDocument&docId=<?php echo $row[$i]['id']; ?>&activityId=<?php echo $activity->id; ?>">Delete</a></td>
	</tr>
<?php } ?>

</table>

<div class="divHeading2">Upload a new document</div>
<form name="addDocument" action="index.php?action=uploadDocument" enctype="multipart/form-data" method="POST">
	<table>
		<tr>
			<td><strong>File:</strong> <input type="file" name="docName" ></td>
			<td style="max-width:200px;"><strong>Tags:	</strong> <input type="text" name="tags" placeholder="Enter File Tags" /></td>
			<td><input type="hidden" name="activityId" value="<?php echo $activity->id; ?>" /><input type="submit" value="Upload" /></td>
		</tr>
	</table>
</form>

<div id="MessageDiv">
	<div class="divHeading1">Messages</div>
	
	<div class="divHeading2">Send a new message</div>
	<form name="createMessageForm" action="index.php?action=createMessage" method="POST">
		<input type="text"  style="display:none;" name="from_username"  value="<?php echo $results['user']->email; ?>" />
		<input type="text" style="display:none;" name="activityId" value="<?php echo $activity->id; ?>" />
		<input type="text" name="message" placeholder="Type Your Message" />
		<select name="to" style="margin-top:-10px;" onchange="if(this.value == 4) document.forms.createMessageForm.to_username.style.display='inline'; else document.forms.createMessageForm.to_username.style.display='none';">
			<option value="-1" selected>Select Recipient</option>
			<option value="1"> My Team </option>
			<option value="2"> Core Team </option>
			<option value="3"> Global </option>
			<option value="4"> Select User </option>
		</select>
		<input type="text" style="display:none;" name="to_username" placeholder="Type Username" />
		<input type="text" name="tags" placeholder="Message tags" />
	    <input type="submit" style="margin-top:-8px;" name="createMessage" value="Send" /> 
	</form>	
	
	<div class="divHeading2">Message History</div>
	<div class="messageContainer">
	<?php
		$messages = Message::getAllMessages($_SESSION['username'], $activity->id);
		for( $i=0; $i < count($messages); $i++ ){
			//print_r($messages[$i]);echo "<br>";	
			if( $messages[$i]["to_username"] == 'globalMessage' ){
				$to = "All Members of CFI"; 
				$msgCSSClassSuffix = 'Global';
			}
			else if( $messages[$i]["to_username"] == 'activity.'.$activity->id ){
				$to = "Your Team"; 
				$msgCSSClassSuffix = 'Team';
			}
			else if( $messages[$i]["to_username"] == $_SESSION['username'] ){
				$to = $_SESSION['username'];	
				$msgCSSClassSuffix = 'Personal';
			}
			
			if( $messages[$i]['from_username'] == $_SESSION['username'] ){
				$messageTypeCSSClass = "sentMessage";
			}
			else{
				$messageTypeCSSClass = "receivedMessage";
			}
	?>
		<div class="message<?php echo $msgCSSClassSuffix." ".$messageTypeCSSClass; ?>">
			<?php echo $messages[$i]["message"]; ?><br>
			<p>Sent by <strong><?php echo $messages[$i]["from_username"]; ?></strong> at <strong><?php echo $messages[$i][5]; ?> IST</strong> to <strong><?php echo $to; ?></strong><br></p>		
		</div>
	<?php } ?>
	</div>
</div>