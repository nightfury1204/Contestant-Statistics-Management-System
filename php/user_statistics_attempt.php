<?php

require_once('user_submission.php');
require_once('user_session.php');

$userSessionData = new userSession();
$usename = $userSessionData->userName();
$userSubs = new userSubmissionClass();
//echo $usename."<br>";

$cfData = array('00'=>0 ,'10'=>0 ,'30'=>0 ,'40'=>0 ,'50'=>0 ,'60'=>0 ,'70'=>0 ,'80'=>0 ,'90'=>0);
$cfResponse = $userSubs->getUserVerdictByOj($usename,"codeforces");
if($cfResponse === false)
{
	;
}
else
{
	$len = COUNT($cfResponse);
	for($i =0 ; $i<$len; $i++)
	{
		$cfData[$cfResponse[$i]['verdict']]= (int)$cfResponse[$i]['total'];
	}
}

$uvaData = array('00'=>0,'10'=>0,'30'=>0,'40'=>0,'50'=>0,'60'=>0,'70'=>0,'80'=>0,'90'=>0);
$uvaResponse = $userSubs->getUserVerdictByOj($usename,"uva");
if($uvaResponse === false)
{
	;
}
else
{
	$len = COUNT($uvaResponse);
	for($i =0 ; $i<$len; $i++)
	{
		$uvaData[$uvaResponse[$i]['verdict']]= (int)$uvaResponse[$i]['total'];
	}
}

$data = json_encode(array("codeforces" => $cfData,"uva" => $uvaData ));

echo $data;

?>