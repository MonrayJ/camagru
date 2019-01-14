<?php
	
	class Personal_gallery_class
	{
		public function display_gallery($uid)
		{
			try 
			{
				$db_conn = get_connect();
				$stmt = $db_conn->prepare("SELECT * FROM gallery WHERE uid=:uid");
				$stmt->bindParam("uid", $uid, PDO::PARAM_INT);
				$stmt->execute();
				$data = $stmt->fetchAll(PDO::FETCH_OBJ);
				return $data;
			}
			catch(PDOExeption $e)
			{
				echo "Failed to retrieve images". $e->getMessage() . "<br>";
			}
		}
		
		public function public_display($uid)
		{
			try
			{
				$db_conn = get_connect();
				$stmt = $db_conn->prepare("SELECT * FROM gallery");
				$stmt->bindParam("uid", $uid, PDO::PARAM_INT);
				$stmt->execute();
				$data = $stmt->fetchAll(PDO::FETCH_OBJ);
				return $data;
			}
			catch(PDOExeption $e)
			{
				echo "Failed to retrieve images". $e->getMessage() . "<br>";
			}
		}

		public function public_display_limit($this_page_first_result, $resutls_per_page)
		{
			try
			{
				$db_conn = get_connect();
				$stmt = $db_conn->prepare("SELECT * FROM gallery LIMIT ".$this_page_first_result.",".$resutls_per_page);
				// $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
				$stmt->execute();
				$data = $stmt->fetchAll(PDO::FETCH_OBJ);
				return $data;
			}
			catch(PDOExeption $e)
			{
				echo "Failed to retrieve images". $e->getMessage() . "<br>";
			}
		}

		public function get_comments($imgid)
		{
			try 
			{
				$db_conn = get_connect();
				$stmt = $db_conn->prepare("SELECT commenter_id, comment FROM comments WHERE imgid=:imgid");
				$stmt->bindParam("imgid", $imgid, PDO::PARAM_INT);
				$stmt->execute();
				$data = $stmt->fetchAll(PDO::FETCH_OBJ);
				return $data;
			}
			catch(PDOExeption $e)
			{
				echo "Failed to retrieve comments". $e->getMessage() . "<br>";
			}
		}
	}
?>