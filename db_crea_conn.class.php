<?php
	class Create
	{
		protected $servername;
		protected $username;
		protected $password;
		protected $dbname;
		protected $charset;

		public function __construct()
		{
			$this->servername = "localhost";
			$this->username = "mjacobs";
			$this->password = "960206";
			$this->dbname = "testdb";
			$this->charset = "utf8mb4";
	
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
		}

		public function connect()
		{
			$this->servername = "localhost";
			$this->username = "mjacobs";
			$this->password = "960206";
			$this->dbname = "testdb";
			$this->charset = "utf8mb4";
			try
			{
				$dsn = "mysql:host=".$this->servername.";dbname=".$this->dbname;
				$pdo_conn = new PDO($dsn, $this->username, $this->password);
				$pdo_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				echo "Connection made";
				return $pdo_conn;
			}
			catch(PDOExeption $e)
			{
				echo "Connection failed: " . "<br>" . $e->getMessage();
			}
		}
	}
?>