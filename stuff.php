<?php

	class Dbase
	{
		private $servername;
		private $username;
		private $passwoed;
		private $dbname;
		private $charset;

		public function connect()
		{
			$this->servername = "localhost";
			$this->username = "mjacobs";
			$this->password = "960206";
			$this->dbname = "testdb";
			$this->charset = "utf8mb4";

			try
			{
				$dsn = "mysql:host=".$this->servername.";dbname=".$this->dbname.";charse=".$this->charset;
				$pdo = new PDO($dsn, $this->username, $this->password);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXEPTION);
				return $pdo;
			}
			catch(PDOExeption $e)
			{
				echo $sql . "<br>" . $e->getMessage();
			}
		}
	}	
	try
	{
		$conn = new PDO("mysql:host=$servername", $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE DATABASE IF NOT EXISTS $dbase";
		// use exec() because no results are returned
		$conn->exec($sql);
		echo "Database created successfully<br>";
	}
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}

	$conn = null;
?>