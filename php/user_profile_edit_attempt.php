<?php
require_once('user_info.php');
require_once('user_session.php');

$userSessionData = new userSession();
$username = $userSessionData->userName();
$userInfo = new userInfoClass();
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$country= $_POST['country'];
$institute = $_POST['institute'];
$codeforcesuser = $_POST['codeforcesuser'];
$uvauser = $_POST['uvauser'];
$response = $userInfo->updateUserInfo($username, $firstname, $lastname, $country, $institute,$codeforcesuser,$uvauser);

if($response)
{
	echo true;
}
else 
{
	echo false;
}

?>
