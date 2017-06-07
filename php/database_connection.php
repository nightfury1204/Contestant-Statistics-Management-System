<?php

/**
* for database connection
*/
class databaseConnect
{
	protected $conection;
	private $servername = "localhost";
	private $username = "root";
	private $password = "icui4cu";
	private $dbname = "Contestant_statistics";
	/**
	function __construct()
	{
		echo "this is from parent\n";
	}
	**/
	public function dataConnect()
	{
		// Create connection
		//echo $this->username."\n".$this->servername."\n".$this->password."\n".$this->dbname."\n";
		$this->conection = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
		// Check connection
		if ($this->conection->connect_error) {
			die("Connection failed: " . $this->conection->connect_error);
		}
	}
	public function dataClose()
	{
		$this->conection->close();
	}
}

?>