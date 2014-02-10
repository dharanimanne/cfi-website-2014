<?php

require('/../PMP/config.php');
require ('/../PMP/classes/Activity.php');
$details = array("title" => "title", "brief_writeup" => "brief", "detailed_writeup" => "this is the detailed writeup", "status" => "status", "tags" => "tags", "overall_budget" => 10000, "utilized_budget" => 15000, "activity_type" => "club", "icon_link" => "absent", "bg_image_link" => "absent");
$dharani = new Activity($details);
$dharani->insert();
?>