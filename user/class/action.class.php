<?php

class Action_class
{
	public function public_likes($imgid, $owner_id, $liker_id)
	{
		try
		{
			$db_conn = get_connect();
			$like_query = "INSERT INTO likes (`imgid`, `owner_id`, `liker_id`) VALUES (:imgid, :owner_id, :liker_id)";
			$stmt = $db_conn->prepare($like_query);
			$stmt->bindParam("imgid", $imgid, PDO::PARAM_INT);
			$stmt->bindParam("owner_id", $owner_id, PDO::PARAM_INT);
			$stmt->bindParam("liker_id", $liker_id, PDO::PARAM_INT);
			$stmt->execute();
			$db_conn = null;
			return true;
		}
		catch(PDOExeption $e)
		{
			echo "Like failed: ". $e->getMessage() . "<br>";
		}
	}

	public function unlike($imgid, $owner_id, $liker_id)
	{
		try
		{
			$db_conn = get_connect();
			$unlike_query = "DELETE FROM likes WHERE imgid=? AND owner_id=? AND liker_id=?";
			$stmnt = $db_conn->prepare($unlike_query);
			$stmnt->execute(array($imgid, $owner_id, $liker_id));
			$db_conn = null;
			return true;
		}
		catch(PDOExeption $e)
		{
			echo "Unlike failed: ". $e->getMessage() . "<br>";
		}
	}

	public function check_like($imgid, $liker_id)
	{
		try
		{
			$db_conn = get_connect();
			$stmnt = $db_conn->prepare("SELECT * FROM likes WHERE imgid=:imgid AND liker_id=:liker_id");
			$stmnt->bindParam("imgid", $imgid, PDO::PARAM_INT);
			$stmnt->bindParam("liker_id", $liker_id, PDO::PARAM_INT);
			$stmnt->execute();
			$data = $stmnt->fetch(PDO::FETCH_OBJ);
			$db_conn = null;
			return $data;
		}
		catch(PDOExeption $e)
		{
			echo "Error fetching". $e->getMessage() . "<br>";
		}
	}

	public function public_comments($imgid, $owner_id, $commenter_id, $comment)
	{
		try
		{
			$db_conn = get_connect();
			$comment_query = "INSERT INTO comments (`imgid`, `owner_id`, `commenter_id`, `comment`) VALUES (:imgid, :owner_id, :commenter_id, :comment)";
			$stmt = $db_conn->prepare($comment_query);
			$stmt->bindParam("imgid", $imgid, PDO::PARAM_INT);
			$stmt->bindParam("owner_id", $owner_id, PDO::PARAM_INT);
			$stmt->bindParam("commenter_id", $commenter_id, PDO::PARAM_INT);
			$stmt->bindParam("comment", $comment, PDO::PARAM_STR);
			echo $comment;
			$stmt->execute();
			$db_conn = null;
			return true;
		}
		catch(PDOExeption $e)
		{
			echo "Like failed: ". $e->getMessage() . "<br>";
		}
	}
}

?>