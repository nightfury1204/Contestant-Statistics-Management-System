<?php
require_once('user_following.php');
require_once('user_submission.php');
require_once('user_session.php');

$userSessionData = new userSession();
$username = $userSessionData->userName();

$userFollowing = new userFollowingClass();

$friendList = $userFollowing->getFollowingList($username);

if($friendList)
{
	$numFriend = COUNT($friendList);

	$userSubs = new userSubmissionClass();

	$data = array();
	//echo $numFriend;

	for($j=0; $j<$numFriend; $j++)
	{
		$cfResponse = $userSubs->getUserVerdictByOj($friendList[$j], "codeforces");
		$cfAc = 0;
		$cfTotal = 0;
		$len = COUNT($cfResponse);
		for($i =0 ; $i<$len; $i++)
		{
			$cfTotal = $cfTotal +(int)$cfResponse[$i]['total'];
			if($cfResponse[$i]['verdict']==='90')
			{
				$cfAc = $cfResponse[$i]['total'];
			}
		}

		$uvaResponse = $userSubs->getUserVerdictByOj($friendList[$j], "uva");
		$uvaAc = 0;
		$uvaTotal = 0;
		$len = COUNT($uvaResponse);
		for($i =0 ; $i<$len; $i++)
		{
			$uvaTotal = $uvaTotal +(int)$uvaResponse[$i]['total'];
			if($uvaResponse[$i]['verdict']==='90')
			{
				$uvaAc = $uvaResponse[$i]['total'];
			}
		}
		$ac = $cfAc + $uvaAc;
		$total = $cfTotal + $uvaTotal;
		$data[$j] = array('username' => $friendList[$j], 'codeforces'=> array('solved' => $cfAc,'subs'=>$cfTotal ), 'uva'=> array('solved' => $uvaAc,'subs'=>$uvaTotal ), 'total'=> array('solved' => $ac,'subs'=>$total ));
	}

	$resData = json_encode($data);

	echo $resData;
}
else
	echo false;

?>













