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
			$this->username = "root";
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

	class Usr_table
	{
		static function create_tb($pdo_conn)
		{
			try
			{
				$sql = "CREATE TABLE `users` (
					`uid` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
					`username` VARCHAR(25) NOT NULL UNIQUE,
					`password` VARCHAR(200) NOT NULL,
					`email` VARCHAR(100) NOT NULL,
					`name` VARCHAR(100) NOT NULL,
					`profile_pic` VARCHAR(200) NULL
				)";
				$pdo_conn->exec($sql);
				echo "User table created successfully";
			}
			catch(PDOExeption $e)
			{
				echo "Failed to create TB: " . "<br>" . $e->getMessage();
			}
			$pdo_conn = null;
		}
	}

	class Gallery_table
	{
		static function create_gallery($pdo_conn)
		{
			try
			{
				$sql = "CREATE TABLE `gallery` (
					`imgid` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
					`uid` int REFERENCES users(uid),
					`img_path` VARCHAR(200) NOT NULL,
					`description` VARCHAR(200) NULL
				)";
				$pdo_conn->exec($sql);
				echo "here";
				echo "gallery table created successfully";
			}
			catch(PDOExeption $e)
			{
				echo "Failed to create TB: " . "<br>" . $e->getMessage();
			}
			$pdo_conn = null;
		}
	}
?>