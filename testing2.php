<?php

require('/PMP/config.php');
require ('/PMP/classes/Activity.php');

$arbit_testing_table = array('title' => 'projects', 'brief_writeup' => 'this is the brief writeup', 'detailed_writeup' => 'This is detailed writeup', 'status' => 'complete', 'tags' => 'nothing', 'overall_budget' => '10000', 'utilized_budget' => '5000', 'icon_link' => '/nothing', 'bg_image_link' => '/nothing' );
$act = new Activity($arbit_testing_table);
$act->insert();
?>