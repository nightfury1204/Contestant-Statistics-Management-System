<?php
/**
* 
verdict:
00 : others
10 : Submission error
15 : Can't be judged
20 : In queue
30 : Compile error
35 : Restricted function
40 : Runtime error
45 : Output limit
50 : Time limit
60 : Memory limit
70 : Wrong answer
80 : PresentationE
90 : Accepted
*/
require_once('../php/database_connection.php');

class Codeforces extends databaseConnect
{
	private $baseUrl= "http://codeforces.com/api/";
	private $userSubmissionsTable = "user_submission";
	private $verdictId = array("OK"=>"90","COMPILATION_ERROR"=>"30","RUNTIME_ERROR"=>"40","WRONG_ANSWER"=>"70","PRESENTATION_ERROR"=>"80","TIME_LIMIT_EXCEEDED"=>"50","MEMORY_LIMIT_EXCEEDED"=>"60","FAILED"=>"10");
	/***
	function __construct()
	{
		//--
		//$baseUrl = "sdfsdf";
		//parent::__construct();

	}
	***/
	function checkUsername($user)
	{
		$url = "".$this->baseUrl."user.info?handles=".$user;
		//echo $url;
		$response = file_get_contents($url);
		if($response)
		{
			$res = json_decode($response,true);
			if($res['status']==="OK")
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	function userSubmissions($user)
	{
		
		$url = "".$this->baseUrl."user.status?handle=".$user;
		$response = file_get_contents($url);
		if($response)
		{
			$res = json_decode($response,true);
			/*
			   res['result'] = all submission
			*/
			$this->dataConnect();
			foreach ($res['result'] as $resData) {
				$username = $user;
				$oj = "Codeforces";
				$submissionId = $resData['id'];
				$submissionTime = $resData['creationTimeSeconds'];
				$problemId = $resData['problem']['contestId']."-".$resData['problem']['index'];
				$problemName = $resData['problem']['name'];
				$language = $resData['programmingLanguage'];				
				if(array_key_exists( $resData['verdict'], $this->verdictId))
				{
					$verdict = $this->verdictId[ $resData['verdict'] ];
				}
				else
				{
					$verdict = "00";
				}				
				$runtime = $resData['timeConsumedMillis'];
				$sql= "INSERT INTO ".$this->userSubmissionsTable." (username, oj, submissionId,submissionTime,problemId, problemName, language, verdict, runtime ) VALUES ('".$username."', '".$oj."', '".$submissionId."', '".$submissionTime."', '".$problemId."', '".$problemName."', '".$language."', '".$verdict."', '".$runtime."' )";

				$this->conection->query($sql);
			}
			$this->dataClose();
			return true;
		}
		else
		{
			return false;
		}
	}

}

/*$userdata = new Codeforces();

if($userdata->checkUsername("nightfury1204kjsdfhksjdfkjsdfkjdfkjdsfhksdjfhskdjfdkj"))
{
	echo true;
}
else
{
	echo false;
}
*/

?>