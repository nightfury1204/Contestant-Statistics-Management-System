<?php

require_once('sign_up.php');

$addUser = new userRegister();
$username = $_POST['username'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$country = $_POST['country'];
$institute = $_POST['institute'];
$cfusername = $_POST['cfusername'];
$uvausername = $_POST['uvausername'];
$password = $_POST['password'];
$reenterpassword = $_POST['reenterpassword'];

$response = $addUser->addNewUser($username,$firstname,$lastname,$email,$country,$institute,$cfusername,$uvausername,$password,$reenterpassword);

if($response)
{
	echo $response;
}
else
{
	echo $addUser->errorMsg;
}

?>