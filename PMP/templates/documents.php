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

<div id="createMessageDiv">
	<div class="divHeading1">Messages</div>
	<form name="createMessageForm" action="index.php?action=createMessage" method="POST">
		<input type="text"  style="display:none;" name="from_username"  value="<?php echo $results['user']->email; ?>" />
		<input type="text" style="display:none;" name="activityId" value="<?php echo $activity->id; ?>" /><br>
		<input type="text" name="message" placeholder="Type Message" />
		<select name="to" onchange="if(this.value == 4) document.forms.createMessageForm.to_username.style.display='inline'; else document.forms.createMessageForm.to_username.style.display='none';">
			<option value="-1" selected>Select</option>
			<option value="1"> My Team </option>
			<option value="2"> Core Team </option>
			<option value="3"> Global </option>
			<option value="4"> Select User </option>
		</select>
		<input type="text" style="display:none;" name="to_username" placeholder="Type Username" />
		Tags <input type="text" name="tags" placeholder="tags" /><br> 
	   <input type="submit" name="createMessage" value="submit" /> 
	</form>	
</div>