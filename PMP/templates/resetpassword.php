<?php
//right now token expire is not implemented

$email=$_GET['email'];
$token=$_GET['token'];

$resetUpdateTime=date("Y-m-d H:i:s");
$con = mysql_connect('localhost', 'root', '');
$db = mysql_select_db('cfi-2014');
$query = "SELECT resetDateTime,email,token FROM passwordResets WHERE email='$email' ";
$result = mysql_query($query);
$num = mysql_num_rows($result);
$array=mysql_fetch_array($result);
if($array!="")
$i=strcmp($token==$array[2]);

if(($num!=0)&&($i==0))
{
$query="DELETE FROM passwordResets WHERE email='$email'";
mysql_query($query);
session_start();
$_SESSION['username']=$email;
header('location:updateForm.php');
}
else
{
$errormessage="token expired";
echo "fail,token expired!";
}


?>

