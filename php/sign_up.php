<?php
/**
* user register
* update user info
*
*/
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
		dataConnect();
		$sql= "INSERT INTO ".$userInfoTable." (username,firstname,lastname,email,country,institute,codeforcesuser,uvauser) VALUES ('".$username."', '".$firstname."', '".$lastname."', '".$email."', '".$country."', '".$institute."', '".$codeforcesuser."', '".$uvauser."' )";
		if($conection->query($sql)===TRUE)
		{
			$password = Bcrypt::hashPassword($password);
			$sql= "insert into ".$userAccountTable." (username,email,lastname,email, password) values ('".$username."', '".$email."', '".$password."' )";
			if($conection->query($sql)===TRUE)
			{
				dataClose();
				return "1";	
			}
			else
			{
				$sql = "DELETE FROM ".$userInfoTable." WHERE username = '".$username."'";
				$conection->query($sql);
				dataClose();
				return "-1";
			}
		}
		else
		{
			dataClose();
			return "-1";
		}
	}
	function updateUserInfo($username, $firstname, $lastname , $email, $country, $institute, $codeforcesuser, $uvauser)
	{
		dataConnect();
		$sql= "UPDATE ".$userInfoTable." SET firstname='".$firstname."', lastname='".$lastname."', country='".$country."', institute='".$institute."', codeforcesuser='".$codeforcesuser."', uvauser='".$uvauser."' WHERE username='".$username."' ";
		if($conection->query($sql)===TRUE)
		{
			dataClose();
			return "1";	
		}
		else
		{
			dataClose();
			return "-1";
		}
	}

}
?>