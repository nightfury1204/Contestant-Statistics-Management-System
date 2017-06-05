<?php
/**
* user register
* update user info
* return 1 if successful
*
*/
require_once('database_connection.php');
class userRegister extends databaseConnection
{
	private userInfoTable = "user_info";
	private userAccountTable = "user_account";
	function __construct()
	{
		# code...
	}
	function addNewUser($username, $firstname, $lastname , $email, $country, $institute, $codeforcesuser, $uvauser, $password)
	{
		$this->dataConnect();
		$sql= "INSERT INTO ".$this->userInfoTable." (username,firstname,lastname,email,country,institute,codeforcesuser,uvauser) VALUES ('".$username."', '".$firstname."', '".$lastname."', '".$email."', '".$country."', '".$institute."', '".$codeforcesuser."', '".$uvauser."' )";
		if($this->conection->query($sql)===TRUE)
		{
			$password = Bcrypt::hashPassword($password);
			$sql= "insert into ".$this->userAccountTable." (username,email,lastname,email, password) values ('".$username."', '".$email."', '".$password."' )";
			if($this->conection->query($sql)===TRUE)
			{
				$this->dataClose();
				return "1";	
			}
			else
			{
				$sql = "DELETE FROM ".$this->userInfoTable." WHERE username = '".$username."'";
				$this->conection->query($sql);
				$this->dataClose();
				return "-1";
			}
		}
		else
		{
			$this->dataClose();
			return "-1";
		}
	}
	function updateUserInfo($username, $firstname, $lastname , $email, $country, $institute, $codeforcesuser, $uvauser)
	{
		$this->dataConnect();
		$sql= "UPDATE ".$this->userInfoTable." SET firstname='".$firstname."', lastname='".$lastname."', country='".$country."', institute='".$institute."', codeforcesuser='".$codeforcesuser."', uvauser='".$uvauser."' WHERE username='".$username."' ";
		if($this->conection->query($sql)===TRUE)
		{
			$this->dataClose();
			return "1";	
		}
		else
		{
			$this->dataClose();
			return "-1";
		}
	}

}
?>