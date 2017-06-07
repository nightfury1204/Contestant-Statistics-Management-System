<?php

/**
* 
*/
class userSession
{
	/*
	function __construct(argument)
	{
		# code...
	}
	*/
	function startSession($username)
	{
		session_start();
		$_SESSION['auth'] = true ;
		$_SESSION['username'] = $username;
		$_SESSION['name'] = $username;
	}

	function endSession()
	{
		session_start();
		$_SESSION['auth']=false;
		unset($_SESSION['auth']);
		unset($_SESSION['username']);
		unset($_SESSION['name']);
		session_destroy();
	}

	function userAuthentication()
	{
		session_start();
		if(!isset($_SESSION['auth']))
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	function userName()
	{
		session_start();
		return $_SESSION['username'];
	}
	function userFullName()
	{
		session_start();
		return $_SESSION['name'];	
	}

}

?>