<?php

class Gallery_class
{
	public function upload_gallery($uid, $username, $img_path, $description)
	{
		try
		{
			$db_conn = get_connect();
			$gall_query = "INSERT INTO gallery (`uid`, `username`, `img_path`, `description`) VALUES (:uid, :username, :img_path, :description)";
			$stmt = $db_conn->prepare($gall_query);
			$stmt->bindParam("uid", $uid, PDO::PARAM_STR);
			$stmt->bindParam("username", $username, PDO::PARAM_STR);
			$stmt->bindParam("img_path", $img_path, PDO::PARAM_STR);
			$stmt->bindParam("description", $description, PDO::PARAM_STR);
			$stmt->execute();
			$db_conn = null;
			return true;
		}
		catch(PDOExeption $e)
		{
			echo "Upload failed: ". $e->getMessage() . "<br>";
		}
	}

	public function delete_img($imgid)
	{
		try
		{
			$db_conn = get_connect();
			$delete_query = "DELETE FROM gallery WHERE imgid=?";
			$stmnt = $db_conn->prepare($delete_query);
			$stmnt->execute(array($imgid));
			$db_conn = null;
			return true;
		}
		catch(PDOExeption $e)
		{
			echo "Delete failed: ". $e->getMessage() . "<br>";
		}
	}
}

?>