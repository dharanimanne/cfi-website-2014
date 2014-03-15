
<?php
//configuration changes for different users on line 6
//link changes on line 51
include('password.php');
$con = mysql_connect('localhost', 'root', '');
$db = mysql_select_db('cfi-2014');

$email1=$_POST['email1'];
$email2=$_POST['email2'];
$email1 = mysql_real_escape_string($email1);
$email1 = strip_tags($email1);
$email2 = mysql_real_escape_string($email2);
$email2 = strip_tags($email2);
if($email1!=$email2)
{
//make sure to enter both same
echo "make sure to enter both same";
}
else
{
$query = "SELECT email FROM users WHERE email='$email1'";
$result = mysql_query($query);
$num = mysql_num_rows($result);
if($num==0)
{
//user does not exist
echo "f off";
}
else
{
$resetDateTime = date("Y-m-d H:i:s");
$options = [
    'cost' => 10,
    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
];
$token=password_hash($email1, PASSWORD_BCRYPT, $options)."\n";
echo $token;
$query = "SELECT email FROM passwordResets WHERE email='$email1'";
$result = mysql_query($query);
$num = mysql_num_rows($result);
if($num==0)
{
$query = "INSERT INTO passwordResets
	(resetDateTime, email, token)
	VALUES
	('$resetDateTime','$email1','$token')";
	mysql_query($query); 
	
$message="hurray!message is delivered to me!";
$link='click the link shown <b>below!</b><br>http://localhost/cfi-website-2014/PMP/templates/resetpassword.php?email='.$email1.'&token='.$token.'&resetDateTime='.$resetDateTime;
include('mailexample.php');
$successMessage="A mail is sent to respective e-mail account click it to reset the password";
header('location:/cfi-website-2014/PMP/templetes/loginForm.php?successMessage='.$successMessage);
//send mail
}
else
{
$successMessage="A mail is already sent to respective e-mail account click it to reset the password";
header('location:/cfi-website-2014/PMP/templates/loginForm.php?successMessage='.$successMessage);
}
}
}
?>