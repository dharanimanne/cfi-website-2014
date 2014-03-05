<?php

	function getDocuments( $id ) {
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
	    $sql = 'SELECT docName, docLocation, uploadedBy, uploadedOn FROM '. TABLENAME_DOCUMENT .' WHERE activityId ='. $id .'ORDER BY uploadedOn';
	//	$st = $conn->prepare( $sql );
	//  $st->bindValue( ":id", $id, PDO::PARAM_INT );
	 	<table>
			<tr>
				<td>S No.</td>
				<td>Document Name</td>
				<td>Document Link</td>
				<td>Uploaded By</td>
				<td>Uploaded On</td>
			</tr>
	    foreach ($conn->query($sql) as $row) {
	    	$i=1;
	        <td>echo $i++;</td>
			<td>echo $row['docName'];</td>
			<td>echo $row['docLocation'];</td>
			<td>echo $row['uploadedBy'];</td>
			<td>echo $row['uploadedOn'];</td>
	    }
		</table>
	}
?>