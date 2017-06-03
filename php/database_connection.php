<?php

/**
* for database connection
*/
class databaseConnect
{
	protected $conection;
	private $servername;
	private $username;
	private $password;
	private $dbname;
	function __construct(argument)
	{
		$servername = "localhost";
		$username = "root";
		$password = "icui4cu";
		$dbname = "Dinning_System";
	}
	public function dataConnect()
	{
		// Create connection
		$conection = mysqli_connect($servername, $username, $password, $dbname);
		// Check connection
		if (!$conection) {
			die("Connection failed: " . mysqli_connect_error());
		}
	}
	public function dataClose()
	{
		mysqli_close($conection);
	}
}

?>