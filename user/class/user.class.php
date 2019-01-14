<?php

class User_class
{
	/* User Login */
	public function user_login($usernameEmail,$password)
	{
		$db_conn = get_connect();
		$hash_password = hash('sha256', $password);
		
		$stmt = $db_conn->prepare("SELECT uid FROM users WHERE  (username=:usernameEmail or email=:usernameEmail) AND  password=:hash_password");
		$stmt->bindParam("usernameEmail", $usernameEmail, PDO::PARAM_STR);
		$stmt->bindParam("hash_password", $hash_password, PDO::PARAM_STR);
		$stmt->execute();
		$count = $stmt->rowCount();
		$data = $stmt->fetch(PDO::FETCH_OBJ);
		$db_conn = null;
		if ($count)
		{	
			$_SESSION['uid'] = $data->uid;
			return true;
		}
		else
		{
			return false;
		}
	}

	// $register_query_str = "INSERT INTO `users` (`firstname`, `lastname`, `user_name`, `password`) VALUES (:firstname, :lastname, :user_name, :password)";
	// $stmt = $this->$db_conn->prepare($register_query_str);

	/* User Registration */
	public function user_registration($username, $password, $email, $name)
	{
		try
		{
			$db_conn = get_connect();
			$st = $db_conn->prepare("SELECT uid FROM users WHERE username=:username OR email=:email");
			$st->bindParam("username", $username, PDO::PARAM_STR);
			$st->bindParam("email", $email, PDO::PARAM_STR);
			$st->execute();
			$count = $st->rowCount();
			if ($count < 1)
			{
				$regstr_query = "INSERT INTO users (`username`, `password`, `email`, `name`) VALUES (:username, :hash_password, :email, :name)";
				$stmt = $db_conn->prepare($regstr_query);
				$stmt->bindParam("username", $username, PDO::PARAM_STR);
				$hash_password = hash('sha256', $password);
				$stmt->bindParam("hash_password", $hash_password, PDO::PARAM_STR);
				$stmt->bindParam("email", $email, PDO::PARAM_STR);
				$stmt->bindParam("name", $name, PDO::PARAM_STR);
				$stmt->execute();
				echo "what went wrong";
				$uid = $db_conn->lastInsertId();
				$db_conn = null;
				$_SESSION['uid'] = $uid;
				return true;
			}
			else
			{
				$db_conn = null;
				return false;
			}
		}
		catch(PDOException $e)
		{
			echo "Registration failed: ". $e->getMessage() . "<br>";
		}
	}

	/* User Details */
	public function user_details($uid)
	{
		try 
		{
			$db_conn = get_connect();
			$stmt = $db_conn->prepare("SELECT email, username, name FROM users 	WHERE uid=:uid");
			$stmt->bindParam("uid", $uid, PDO::PARAM_INT);
			$stmt->execute();
			$data = $stmt->fetch(PDO::FETCH_OBJ);
			return $data;
		}
		catch(PDOException $e)
		{
			echo "Error fetching". $e->getMessage() . "<br>";
		}
	}
}

?>