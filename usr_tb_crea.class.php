<?php

	class Usr_table
	{
		static function createTb($pdo_conn)
		{
			$sql = "CREATE TABLE `users` (
				`uid` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
				`username` VARCHAR(25) NOT NULL UNIQUE,
				`password` VARCHAR(200) NOT NULL,
				`email` VARCHAR(100) NOT NULL,
				`name` VARCHAR(100) NOT NULL,
				`profile_pic` VARCHAR(200) NOT NULL
			)";
			$pdo_conn->exec($sql);
			echo "User table created successfully";
		}
	}

?>