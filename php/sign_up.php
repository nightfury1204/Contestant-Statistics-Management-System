<?php
/**
* user register
* update user info
* return 1 if successful
*
*/
require_once('signup_validation.php');
require_once('Bcrypt.php');
class userRegister extends signupFormValidation
{
	private $userInfoTable = "user_info";
	private $userAccountTable = "user_account";
	/**
	function __construct()
	{
		# code...
	}
	**/
	function addNewUser($username, $firstname, $lastname , $email, $country, $institute, $codeforcesuser, $uvauser, $password,$reenterpassowrd)
	{
		if(!$this->formValidation($username, $email, $password,$reenterpassowrd))
		{
			return false;
		}
		$this->dataConnect();
		$sql= "INSERT INTO ".$this->userInfoTable." (username,firstname,lastname,email,country,institute,codeforcesuser,uvauser) VALUES ('".$username."', '".$firstname."', '".$lastname."', '".$email."', '".$country."', '".$institute."', '".$codeforcesuser."', '".$uvauser."' )";
		if($this->conection->query($sql)===TRUE)
		{
			$password = Bcrypt::hashPassword($password);
			$sql= "insert into ".$this->userAccountTable." (username,email, password) values ('".$username."', '".$email."', '".$password."' )";
			if($this->conection->query($sql)===TRUE)
			{
				$this->dataClose();
				return true;	
			}
			else
			{
				$sql = "DELETE FROM ".$this->userInfoTable." WHERE username = '".$username."'";
				$this->conection->query($sql);
				$this->dataClose();
				$this->errorMsg = $this->errorMsg."Database Insertion Problem;";
				return false;
			}
		}
		else
		{
			$this->dataClose();
			$this->errorMsg = $this->errorMsg."Database Insertion Problem;";
			return false;
		}
	}
	function updateUserInfo($username, $firstname, $lastname , $email, $country, $institute, $codeforcesuser, $uvauser)
	{
		$this->dataConnect();
		$sql= "UPDATE ".$this->userInfoTable." SET firstname='".$firstname."', lastname='".$lastname."', country='".$country."', institute='".$institute."', codeforcesuser='".$codeforcesuser."', uvauser='".$uvauser."' WHERE username='".$username."' ";
		if($this->conection->query($sql)===TRUE)
		{
			$this->dataClose();
			return true;	
		}
		else
		{
			$this->dataClose();
			$this->errorMsg = $this->errorMsg."Database Insertion Problem;";
			return false;
		}
	}

}

//$addUser = new userRegister();
//echo $addUser->addNewUser("user1","dsf","dsfd","sadfds@gmail.com","ban","cuet","cf","uva","1234");
?>