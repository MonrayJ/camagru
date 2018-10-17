<?php
	class Create
	{
		private $servername = "localhost";
		private $username = "mjacobs";
		private $password = "960206";
		private $dbname = "testdb";
		private $charset = "utf8mb4";

		public function __construct()
		{
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
		}
	}

	class Dbase extends Create
	{
		public function __construct()
		{}

		public function connect()
		{
			try
			{
				$dsn = "mysql:host=".$this->servername.";dbname=".$this->dbname.";charse=".$this->charset;
				$pdo_conn = new PDO($dsn, $this->username, $this->password);
				$pdo_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXEPTION);
				return $pdo_conn;
			}
			catch(PDOExeption $e)
			{
				echo $sql . "<br>" . $e->getMessage();
			}
		}
	}
?>