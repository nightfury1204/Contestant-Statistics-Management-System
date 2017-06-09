<?php

require_once('user_submission.php');
require_once('user_session.php');

$userSessionData = new userSession();
$usename = $userSessionData->userName();
$userSubs = new userSubmissionClass();
//echo $usename."<br>";
$response = $userSubs->getUserSubmissions($usename);
if($response === false)
{
	$data = json_encode(array('status'=>false,'subs'=>""));
	echo $data;
}
else
{
	$data =json_encode(array('status'=>true,'subs'=>$response));
	echo $data;
}
?>