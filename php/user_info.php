<?php
/**
*    user information
*/

require_once('database_connection.php');

class userInfoClass extends databaseConnect
{
	private $userInfoTable = "user_info";

	function getUserInfo($username)
	{
		// return an array;
		$this->dataConnect();
		$sql = "SELECT * FROM ".$this->userInfoTable." WHERE username = '".$username."'";

		$result = $this->conection->query($sql);

		if($result->num_rows == 1)
		{
			$resData = $result->fetch_assoc();
			$this->dataClose();
			return $resData;
		}
		else
		{
			$this->dataClose();
			return false;
		}
	}
	function updateUserInfo($username, $firstname,$lastname, $country, $institute,$codeforcesuser,$uvauser)
	{
		$this->dataConnect();
		$sql = "UPDATE ".$this->userInfoTable." SET firstname = '".$firstname."',lastname = '".$lastname."',country ='".$country."' , institute = '".$institute."' , codeforcesuser = '".$codeforcesuser."' , uvauser = '".$uvauser."'  WHERE username= '".$username."'";
		$result = $this->conection->query($sql);
		$this->dataClose();
		if($result)
		{
			return ture;
		}
		else
		{
			return false;
		}
	}
	function checkUsername($username)
	{
		// return an array;
		$this->dataConnect();
		$sql = "SELECT * FROM ".$this->userInfoTable." WHERE username = '".$username."'";

		$result = $this->conection->query($sql);

		if($result->num_rows == 1)
		{
			$this->dataClose();
			return true;
		}
		else
		{
			$this->dataClose();
			return false;
		}
	}
}
?>