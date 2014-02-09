<?php
require('config.php');
require ('class_real.php');
$details = array("username" => $_POST['username'], "password" => $_POST['password'],"name" => $_POST['name'],"email" => $_POST['email']);
$akshay = new user($details);
$akshay->insert();

?>