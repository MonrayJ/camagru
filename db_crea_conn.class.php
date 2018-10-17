<?php
	class Create
	{
		protected $servername = "localhost";
		protected $username = "mjacobs";
		protected $password = "960206";
		protected $dbname = "testdb";
		protected $charset = "utf8mb4";

		public function __construct()
		{
			try
			{
				$conn = new PDO("mysql:host=".$this->servername, $this->username, $this->password);
				// set the PDO error mode to exception
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "CREATE DATABASE ".$this->dbname;
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

	class Connect extends Create
	{
		public function __construct()
		{
			try
			{
				$dsn = "mysql:host=".$this->servername.";dbname=".$this->dbname.";charse=".$this->charset;
				$pdo_conn = new PDO($dsn, $this->username, $this->password);
				$pdo_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXEPTION);
				echo "Connection made";
				return $pdo_conn;
			}
			catch(PDOExeption $e)
			{
				echo $sql . "<br>" . $e->getMessage();
			}
		}
	}
?>