
<?php
require('cfi-website-2014/PMP/config.php');
require ('cfi-website-2014/PMP/classes/User.php');

$arbit_testing_table = array("username" => "dharani", "password" => "123456", "joinDateTime" => "21/03/2103", "lastLoginDateTime" => "04/02/2014", "lastLoginFrom" => "nowhere", "userType" => "2", "name" => "dharani", "hostel" => "ganga", "rollNo" => "me12b040", "phone" => "9043814168", "email" => "dharani.manne@gmail.com", "socialMediaUrl" => "none", "avatarLocation" => "nowhere", "expertise" => "coding", "rating" => "awesome", "aboutMe" =>"im awesome", "coreRemark" => "he is awesome");

$current_user = new User($arbit_testing_table);
$current_user->insert();

?>