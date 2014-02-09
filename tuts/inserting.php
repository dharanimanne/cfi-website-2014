<?php
require('/../PMP/config.php');
require ('/../PMP/classes/User.php');
$details = array("username" => $_POST['username'], "password" => $_POST['password'],"name" => $_POST['name'],"email" => $_POST['email'], "joinDateTime" => "2013-01-03", "lastLoginDateTime" => "2013-03-03", "expertise" => "nothing", "rating" => "4", "userType" => "2", "socialMediaUrl" => "/nothing", "avatarLocation" => "/nothing", "aboutMe" => "i am me myself", "coreRemark" => "infi enthu", "phone" => "9043814168", "rollNo" => "me12b040", "room" => "250", "hostel" => "ganga", "lastLoginFrom" => "nowhere lol");
$akshay = new User($details);
$akshay->insert();

?>