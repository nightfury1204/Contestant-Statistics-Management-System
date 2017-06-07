<?php
require_once('user_login.php');
require_once('user_session.php');
$tryLogin = new login();
$userName = $_POST["username"];
$passWord = $_POST["password"];

if($tryLogin->login_attempt($userName, $passWord))
{
	//redirect to user home
	$sessionVar = new userSession();
	$sessionVar->startSession($userName);
	echo "success";
	
}
else
{
	echo "Wrong Username or password";
	//header("Location: http://localhost/Contestant-Statistics-Management-System/parsar/");
	//die();
}

?>