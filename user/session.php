<?php
	if (!empty($_SESSION['uid']))
	{
		$session_uid = $_SESSION['uid'];
		include('class/user.class.php');
		$user_class = new User_class();
	}
	if (empty($session_uid))
	{
		$url = BASE_URL . 'index.php';
		header("Location: $url");
	}
?>