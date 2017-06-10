<?php
require_once('user_following.php');
require_once('user_session.php');

$userSessionData = new userSession();
$username = $userSessionData->userName();

$userFollowing = new userFollowingClass();

$friendUsername = $_POST["username"];

$friendUsername = trim($friendUsername);

if($userFollowing->addToFollowingList($username , $friendUsername))
{
	echo true;
}
else
{
	echo  $userFollowing->errorMsg;
}

?>
