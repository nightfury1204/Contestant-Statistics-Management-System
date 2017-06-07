<?php
/**
* user login
*/
require_once('database_connection.php');
require_once('Bcrypt.php');
class login extends databaseConnect
{
	private $tableName = "user_account";
	/**
	function __construct()
	{
		# code...
	}
	**/
	function login_attempt($username, $password)
	{
		$this->dataConnect();
		$sql = "SELECT * FROM ".$this->tableName." WHERE username = '".$username."'";
		//echo $sql."<br>";
		$result = $this->conection->query($sql);
		if($result->num_rows==1)
		{
			$row = $result->fetch_assoc();
			if(Bcrypt::checkPassword($password, $row["password"]))
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
		else
		{
			$this->dataClose();
			return false;
		}
	}
}
/*
$tryLogin = new login();
$userName = "user1";//$_POST["username"];
$passWord = "1243";//$_POST["password"];

if($tryLogin->login_attempt($userName, $passWord)==="1")
{
	//redirect to user home
	//header("Location:home");
	echo "login successful";
}
else
{
	echo "WA";
}
*/
?>