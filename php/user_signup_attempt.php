<?php

require_once('sign_up.php');
require_once('../parser/codeforces.php');
require_once('../parser/uva.php');
$addUser = new userRegister();
$username = $_POST['username'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$country = $_POST['country'];
$institute = $_POST['institute'];
$cfusername = trim($_POST['cfusername']);
$uvausername = trim($_POST['uvausername']);
$password = $_POST['password'];
$reenterpassword = $_POST['reenterpassword'];

$errorMsg = "";
$flag = true;
if(strlen($cfusername)>0)
{
	$userdata = new Codeforces();
		if($userdata->checkUsername($cfusername))
	{
		;
	}
	else
	{
		$errorMsg = "Wrong codeforces username;";
		$flag = false;
	}
}

if(strlen($uvausername)>0)
{
	$userdata = new Uva();
		if($userdata->checkUsername($uvausername))
	{
		;
	}
	else
	{
		$errorMsg = "Wrong uva username;";
		$flag = false;
	}
}



if($flag)
{
	$response = $addUser->addNewUser($username,$firstname,$lastname,$email,$country,$institute,$cfusername,$uvausername,$password,$reenterpassword);
	if($response)
	{
		echo $response;
		$cfSubs = new Codeforces();
		$cfSubs->userSubmissions($cfusername);

		$uvaSubs = new Uva();
		$uvaSubs->userSubmissions($uvausername);
	}
	else
	{
		echo $this->errorMsg;
	}
}
else
{
	echo $errorMsg;
}

?>