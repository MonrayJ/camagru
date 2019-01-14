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
			$this->password = "960206@Mj";
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
				echo "User table created successfully<br>";
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
					`uid` int NOT NULL REFERENCES users(uid),
					`username` VARCHAR(25) NOT NULL REFERENCES users(username),
					`img_path` VARCHAR(200) NOT NULL,
					`description` VARCHAR(5000) NOT NULL
				)";
				$pdo_conn->exec($sql);
				echo "gallery table created successfully<br>";
			}
			catch(PDOExeption $e)
			{
				echo "Failed to create TB: " . "<br>" . $e->getMessage();
			}
			$pdo_conn = null;
		}
	}

	class Likes_table
	{
		static function public_likes($pdo_conn) // likes on the home page
		{
			try
			{
				$sql = "CREATE TABLE `likes` (
					`imgid` int NOT NULL,
					`owner_id` int NOT NULL REFERENCES users(uid),
					`liker_id` int NOT NULL REFERENCES users(uid),
					FOREIGN KEY(`imgid`) REFERENCES `testdb`.`gallery`(`imgid`) ON DELETE CASCADE
				)";
				$pdo_conn->exec($sql);
				echo "likes table created successfully<br>";
			}
			catch(PDOExeption $e)
			{
				echo "Failed to create TB: " . "<br>" . $e->getMessage();
			}
			$pdo_conn = null;
		}
	}

	class Comments_table
	{
		static function public_comments($pdo_conn) // comments on the home page
		{
			try
			{
				$sql = "CREATE TABLE `comments` (
					`imgid` int NOT NULL,
					`owner_id` int NOT NULL REFERENCES users(uid),
					`commenter_id` int NOT NULL REFERENCES users(uid),
					`comment` VARCHAR(5000) NOT NULL,
					FOREIGN KEY(`imgid`) REFERENCES `testdb`.`gallery`(`imgid`) ON DELETE CASCADE
				)";
				$pdo_conn->exec($sql);
				echo "Comments table created successfully<br>";
			}
			catch(PDOExeption $e)
			{
				echo "Failed to create TB: " . "<br>" . $e->getMessage();
			}
			$pdo_conn = null;
		}
	}
?>