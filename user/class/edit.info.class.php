<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Edit_info_class
{
	public function update_basic_info($uid, $username, $email)
	{
		try
		{
			$db_conn = get_connect();
			$stmt = $db_conn->prepare("UPDATE `users` SET `username`=:user, `email`=:email WHERE `uid`=:uid");
            $stmt->execute(['user'=>$username, 'email'=>$email, 'uid'=>$uid]);
			echo "got here";
		}
		catch(PDOException $e)
		{
			echo "Update failed: ". $e->getMessage() . "<br>";
		}
	}

	public function update_pwd($uid, $username, $email)
	{
		try
		{
			$db_conn = get_connect();
			$stmt = $db_conn->prepare("UPDATE `users` SET `username`=:user, `email`=:email WHERE `uid`=:uid");
            $stmt->execute(['user'=>$username, 'email'=>$email, 'uid'=>$uid]);
			echo "got here";
		}
		catch(PDOException $e)
		{
			echo "Update failed: ". $e->getMessage() . "<br>";
		}
	}
	
	public function check_pwd($username, $password)
	{
		try
		{
			$hash_password = hash('sha256', $password);
			$db_conn = get_connect();
			$stmnt = $db_conn->prepare("SELECT uid FROM users WHERE username=:user AND password=:hash_password");
			$stmnt->execute(['user'=>$username, 'hash_password'=>$hash_password]);
			$data = $stmnt->fetch(PDO::FETCH_OBJ);
			$db_conn = null;
			$uid = $data->uid;
			if (!empty($uid))
			{
				$db_conn = get_connect();
				$stmt = $db_conn->prepare("UPDATE `users` SET `username`=:user, `email`=:email WHERE `uid`=:uid");
				$stmt->execute(['user'=>$username, 'email'=>$email, 'uid'=>$uid]);
				echo "got here";
			}
		}
		catch(PDOException $e)
		{
			echo "Error Updating". $e->getMessage() . "<br>";
		}
	}
}

?>