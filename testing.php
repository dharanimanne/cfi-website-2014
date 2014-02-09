<?php
require('/tuts/config.php');
require ('/tuts/user.php');

$arbit_testing_table = array( "username" => "dharani", "password" => "123456", "joinDateTime" => "2013-01-03", "lastLoginDateTime" => "2013-04-02", "lastLoginFrom" => "nowhere", "userType" => "2", "name" => "dharani", "hostel" => "ganga", "rollNo" => "me12b040", "phone" => "9043814168", "email" => "dharani.manne@gmail.com", "socialMediaUrl" => "none", "avatarLocation" => "nowhere", "expertise" => "coding", "rating" => "2.5", "aboutMe" =>"im awesome", "coreRemark" => "he is awesome");

$current_user = new user($arbit_testing_table);
$current_user->insert();

?>