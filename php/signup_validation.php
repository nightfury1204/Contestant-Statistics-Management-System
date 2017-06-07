<?php
/**
* 
*/

require_once('database_connection.php');

class signupFormValidation extends databaseConnect
{
	private $userInfoTable = "user_info";
	public $errorMsg = "";
	function passwordCheck($password , $reenterpassword)
	{
		if($password === $reenterpassword)
		{
			return true ;
		}
		else
		{
			return false ;
		}
	}
	function usernameCheck($username)
	{
		$this->dataConnect();
		$sql = "SELECT * FROM ".$this->userInfoTable." WHERE username = '".$username."' ";
		$result = $this->conection->query($sql);
		if($result->num_rows>o)
		{
			$this->dataClose();
			return false;
		}
		else
		{
			$this->dataClose();
			return true;
		}
		
	}
	function emailCheck($email)
	{
		$this->dataConnect();
		$sql = "SELECT * FROM ".$this->userInfoTable." WHERE email = '".$email."' ";
		$result = $this->conection->query($sql);
		if($result->num_rows>o)
		{
			$this->dataClose();
			return false;
		}
		else
		{
			$this->dataClose();
			return true;
		}
	}

	function formValidation($username,$email,$password, $reenterpassword)
	{
		$res = true;
		if(!$this->passwordCheck($password,$reenterpassword))
		{
			$this->errorMsg = $this->errorMsg."password didn't match;";
			$res = false;
		}
		if(!$this->usernameCheck($username))
		{
			$this->errorMsg = $this->errorMsg." change username;";
			$res = false;
		}
		if(!$this->emailCheck($email))
		{
			$this->errorMsg = $this->errorMsg."change email;";
			$res = false;
		}

		return $res;
	}
}

?>