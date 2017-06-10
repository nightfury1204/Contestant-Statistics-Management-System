<?php
require_once('user_following.php');
require_once('user_session.php');

$userSessionData = new userSession();
$username = $userSessionData->userName();

$userFollowing = new userFollowingClass();

$friendUsername = $_POST["username"];

//echo $friendUsername."<br>";

$friendUsername = trim($friendUsername);

if($userFollowing->deleteFromFollowingList($username , $friendUsername))
{
	echo true;
}
else
{
	echo  $userFollowing->errorMsg;
}

?>
