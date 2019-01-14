<?php

	include('session.php');
	include_once('class/edit.info.class.php');
	$userDetails=$user_class->user_details($session_uid);
	$userUpdate = new Edit_info_class;

	if (!empty($_POST['basicsubmit'])) 
	{
		
		$username=$_POST['username'];
		$email=$_POST['email'];
		$username_check = preg_match('~^[A-Za-z0-9_]{3,20}$~i', $username);
		$email_check = preg_match('~^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$~i', $email);
		if ($username_check && $email_check) 
		{
			$userUpdate->udate_basic_info($session_uid, $username, $email);
			echo "<br>Got past the update class<br>";
		}
		else
		{
			echo "username or email to weak or not valid<br>";
		}
	}
?>