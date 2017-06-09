<?php
/**
* 
*/
require_once('database_connection.php');

class userSubmissionClass extends databaseConnect 
{
	private $submissionTable = "user_submission";
	public $errorMsg = "";
    function executeSelectSql($sql)
    {
    	$this->dataConnect();
		//echo $sql.'<br>';
		$result = $this->conection->query($sql);
		if($result->num_rows > 0)
		{
			$rowData = array();
			$cnt = 0;
			while ($resData = $result->fetch_assoc())
			{
				$rowData[$cnt] = $resData ; 
				$cnt++;
			}
			$this->dataClose();	

			return $rowData;
		}
		else
		{
			$this->dataClose();
			return false;
		}
    }
	function getUserSubmissions($username)
	{
		$sql = "SELECT * FROM ".$this->submissionTable." WHERE username = '".$username."' ORDER BY submissionTime DESC";
		return $this->executeSelectSql($sql);
	}

	function getUserSubmissionsByOj($username,$oj)
	{
		$sql = "SELECT * FROM ".$this->submissionTable." WHERE username = '".$username."' AND oj = '".$oj."' ORDER BY submissionTime DESC";
		//echo $sql.'<br>';
		return $this->executeSelectSql($sql);
	}
	function getUserVerdictByOj($username,$oj)
	{
		$sql = "SELECT COUNT(submissionId) AS total,verdict FROM ".$this->submissionTable." WHERE username = '".$username."' AND oj = '".$oj."' GROUP BY verdict";
		return $this->executeSelectSql($sql);
	}
	function getUserVerdict($username)
	{
		$sql = "SELECT COUNT(submissionId) AS total,verdict FROM ".$this->submissionTable." WHERE username = '".$username."' GROUP BY verdict";
		return $this->executeSelectSql($sql);
	}
	function getUserAcSubmissions($username)
	{
		$sql = "SELECT * FROM ".$this->submissionTable." WHERE username = '".$username."' AND verdict = '90' ORDER BY submissionTime DESC";
		//echo $sql.'<br>';
		return $this->executeSelectSql($sql);
	}
	function getUserAcSubmissionsByOj($username,$oj)
	{
		$sql = "SELECT * FROM ".$this->submissionTable." WHERE username = '".$username."' AND verdict = '90' AND oj = '".$oj."' ORDER BY submissionTime DESC";
		//echo $sql.'<br>';
		return $this->executeSelectSql($sql);
	}
	function getUserSolvedProblemByOj($username, $oj)
	{
		$sql = "SELECT DISTINCT problemId FROM ".$this->submissionTable." WHERE username = '".$username."' AND verdict = '90' AND oj = '".$oj."' ORDER BY problemId";
		//echo $sql."<br>";
		return $this->executeSelectSql($sql);
	}
}
?>