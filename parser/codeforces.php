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

class Codeforces
{
	private $baseUrl= "http://codeforces.com/api/";
	private $verdictId = array("OK"=>90,"COMPILATION_ERROR"=>30,"RUNTIME_ERROR"=>40,"WRONG_ANSWER"=>70,"PRESENTATION_ERROR"=>80,"TIME_LIMIT_EXCEEDED"=>50,"MEMORY_LIMIT_EXCEEDED"=>60,"FAILED"=>10);
	
	function __construct()
	{
		//--
		//$baseUrl = "sdfsdf";
	}
	function userSubmissions($user)
	{
		
		$url = "".$this->baseUrl."user.status?handle=".$user."&from=100&count=1";
		$response = file_get_contents($url);
		if($response)
		{
			$res = json_decode($response,true);
			/*
			   res['result'] = all submission
			*/
			foreach ($res['result'] as $temp) {
				echo $temp['problem']['name'];

			}
		}
		else
		{
			echo "wrong username";
		}
	}

}

$userdata = new Codeforces();

$userdata->userSubmissions("nightfury1204");

?>