<?php
session_start();
$connect = mysql_connect("localhost","username","password") or die("check your server connection");
$db = mysql_select_db("cfi");
$email=$_POST['user_email'];
 echo $email;
$p=$_POST['user_password_new'];
  $sql = "SELECT * FROM users WHERE email='$email'";
	 $result = mysql_query($sql);
	 $row = mysql_fetch_array($result);
 $email1=$row['email'];
 echo $email1;
	 if($email=='')
{   
    session_start();
    $_SESSION['error']="Please enter valid inputs";
    header('Location: login.html');
}
	 else
	 {
	 if ($email==$email1&&$email1!=null)
	 {
	 echo "success";
	 $_SESSION['email']=$_POST['user_email'];
	 }
	 else
	 {
	 echo "wrong email";
	 }
	 }
?>


