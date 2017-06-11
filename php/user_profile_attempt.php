<?php
require_once('user_info.php');
require_once('user_session.php');

$userSessionData = new userSession();
$username = $userSessionData->userName();
$userInfo = new userInfoClass();

$response = $userInfo->getUserInfo($username);

if($response)
{
	$data = json_encode($response);
	echo $data;
}
else 
{
	echo false;
}

?>
