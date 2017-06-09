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

class Uva extends databaseConnect
{
	private $baseUrl= "http://uhunt.felix-halim.net/api/";
	private $userSubmissionsTable = "user_submission";
	private $verdictId = array("90"=>"90","30"=>"30","40"=>"40","70"=>"70","80"=>"80","50"=>"50","60"=>"60","10"=>"10");
	private $languageId = array("1"=>"ANSI C","2"=>"JAVA","3"=>"C++","4"=>"PASCAL","5"=>"C++11");
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
		$url = $this->baseUrl."uname2uid/".$user;
		$response = file_get_contents($url);
		$response = trim($response);
		//echo $response." ".strlen($response)." ";
		if($response!="0")
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function getUserId($user)
	{
		$url = $this->baseUrl."uname2uid/".$user;
		$response = file_get_contents($url);
		return trim($response);
	}
	function getProblemDetails($problemId)
	{
		$url = $this->baseUrl."p/id/".$problemId;
		$response = file_get_contents($url);
		$res = json_decode($response,true);
		return $res;
	}
	function userSubmissions($user)
	{
		$user = $this->getUserId($user);
		$url = "".$this->baseUrl."subs-user/".$user;//."/18098738";
		$response = file_get_contents($url);
		//echo  $response;
		if($response)
		{
			$res = json_decode($response,true);
			/*
			   res['subs'] = all submission
			*/
			$this->dataConnect();
			foreach ($res['subs'] as $resData) {
				$username = $res['uname'];
				$oj = "Uva";
				$submissionId = $resData[0];
				$submissionTime = $resData[4];
				//$problemDetails = $this->getProblemDetails($resData[1]);
				$problemId = $resData[1];
				$problemName = '----';
				$language = $this->languageId[ $resData[5] ];
				if(array_key_exists($resData[2], $this->verdictId))
				{
					$verdict = $this->verdictId[$resData[2]];
				}
				else
				{
					$verdict = "00";
				}				
				$runtime = $resData[3];
				$sql= "INSERT INTO ".$this->userSubmissionsTable." (username, oj, submissionId,submissionTime,problemId, problemName, language, verdict, runtime ) VALUES ('".$username."', '".$oj."', '".$submissionId."', '".$submissionTime."', '".$problemId."', '".$problemName."', '".$language."', '".$verdict."', '".$runtime."' )";
				//echo $sql."<br>";
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

/*$userdata = new Uva();

if($userdata->checkUsername("nightfury12kljfldkfjlkjfddlskfjsdlk04"))
{
	echo true;
}
else
{
	echo false;
}
*/

?>