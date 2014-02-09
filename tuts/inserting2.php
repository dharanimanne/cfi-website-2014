<?php

require('/../PMP/config.php');
require ('/../PMP/classes/Activity.php');
$details = array("title" => $_POST['title'], "brief_writeup" => $_POST['brief_writeup'], "detailed_writeup" => "this is the detailed writeup", "status" => $_POST['status'], "tags" => $_POST['tags'], "overall_budget" => "10000", "utilised_budget" => "5000", "icon_link" => "absent", "bg_image_link" => "absent");
$dharani = new Activity($details);
$dharani->insert();
?>