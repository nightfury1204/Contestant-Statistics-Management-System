<?php

require_once('user_submission.php');
require_once('user_session.php');

$userSessionData = new userSession();
$usename = $userSessionData->userName();
$userSubs = new userSubmissionClass();

$cfResponse = $userSubs->getUserSolvedProblemByOj($usename,"codeforces");
$cfData = array();
if($cfResponse === false)
{
	;
}
else
{
	$len = COUNT($cfResponse);
	for($i =0 ; $i<$len; $i++)
	{
		$cfData[$i]= $cfResponse[$i]['problemId'];
	}
}

$uvaResponse = $userSubs->getUserSolvedProblemByOj($usename,"uva");
$uvaData = array();
if($uvaResponse === false)
{
	;
}
else
{
	$len = COUNT($uvaResponse);
	for($i =0 ; $i<$len; $i++)
	{
		$uvaData[$i]= $uvaResponse[$i]['problemId'];
	}
}

$data = json_encode(array("codeforces" => $cfData,"uva" => $uvaData ));

echo $data;

?>