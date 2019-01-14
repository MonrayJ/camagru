<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../config.php');
	include_once('class/edit.info.class.php');
	include('session.php');
	$userDetails=$user_class->user_details($session_uid);
	$userUpdate = new Edit_info_class;
	// echo $session_uid . "<br>";
	// print_r($userDetails);

	if (!empty($_POST['basicsubmit'])) 
	{
		
		$username=$_POST['username'];
		echo $username."<br>";
		$email=$_POST['email'];
		if (empty($email) && !empty($username))
		{
			$email = $userDetails->email;
		}
		if (!empty($email) && empty($username))
		{
			$username = $userDetails->username;
		}
		echo $email."<br>";
		echo $session_uid."<br>";
		$username_check = preg_match('~^[A-Za-z0-9_]{3,20}$~i', $username);
		$email_check = preg_match('~^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$~i', $email);
		if ($username_check && $email_check) 
		{
			$userUpdate->update_basic_info($session_uid, $username, $email);
			echo "<br>Updated succesfully apperently...<br>";
		}
		else
		{
			echo "username or email to weak or not valid<br>";
		}
		header('Location: http://localhost:8080/camagru/user/profile.php');
	}
	
	if (!empty($_POST['passwdsubmit'])) 
	{
		$oldpwd = $_POST['oldpwd'];
		$newpwd = $_POST['newpwd'];
		$confirm = $_POST['conpwd'];
		// if ($userUpdate->check_pwd($oldpwd))

	}
	if (!empty($_POST['passwdsubmit'])) 
	{
		$oldpwd = $_POST['oldpwd'];
		$newpwd = $_POST['newpwd'];
		$confirm = $_POST['conpwd'];
		$password_check = preg_match('~^[A-Za-z0-9!@#$%^&*()_]{6,20}$~i', $password);
		if ($newpwd == $confirm && $password_check)
		{
			// check if old password is same as oldpassword
		}
	}
	
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
<link rel="stylesheet" href="photo.css">
<link rel="stylesheet" type="text/css" media="screen" href="profile.css" />
<!-- <link rel="stylesheet" type="text/css" media="screen" href="style.css" /> -->
<style>
	.topnav
	{
		overflow: hidden;
		background-color: #222935;
		position: fixed;
		top: 0;
		width: 100%;
		z-index: 2;
		box-shadow: 0px 2px 3px #222935;
	}

	.topnav a
	{
		float: left;
		display: block;
		color: #f2f2f2;
		text-align: center;
		padding: 14px 16px;
		text-decoration: none;
		font-size: 17px;
	}

	.topnav .but
	{
	  float: left;
	  display: block;
	  color: #f2f2f2;
	  text-align: center;
	  padding: 10px 16px;
	}
	.topnav a:hover
	{
		background-color: #ddd;
		color: black;
	}

	.topnav .but:hover
	{
		background-color: #222935;
		color: black;
	}

	.active
	{
		background-color: #4CAF50;
		color: white;
	}

	.topnav .icon
	{
		display: none;
	}

	@media screen and (max-width: 606px)
	{
		.topnav a:not(:first-child)
		{
			display: none;
		}
		.topnav a.icon
		{
			float: right;
			display: block;
		}
	}

	@media screen and (max-width: 606px)
	{
		.topnav.responsive .icon
		{
			position: absolute;
			right: 0;
			top: 0;
		}
		.topnav.responsive a
		{
			float: none;
			display: block;
			text-align: left;
		}
	}
	.sticky
	{
		position: fixed;
		top: 0;
		width: 100%;
	}
	.content
	{
		padding-top: 60px;
	}
</style>
</head>
<body>
  
	<div class="topnav sticky" id="myTopnav">
		<a href="#home">Home</a>
		<a href="gallery.php">Gallery</a>
		<a href="#contact" class="active">Profile</a>
		<a href="#about">Logout</a>
		<a href="javascript:void(0);"  class="icon" onclick="myFunction()">&#9776;</a>
	</div>

	<script>
		function myFunction()
		{
			var x = document.getElementById("myTopnav");
			if (x.className === "topnav sticky")
			{
				x.className += " responsive";
			}
			else
			{
				x.className = "topnav sticky";
			}
		}
	</script>

	<div class="content" style="padding-left:16px;padding-top:60px">
	</div>


<div style="display: inline-block; width: 100%; height: 1px;"></div>

<div class="edit">
	<h2 style="width: 100%; border-top: 1px solid black; border-radius: 15px; padding: 5px 0px 0px 10px;">Edit Profile</h2>
	<form action="" method="POST">
		BASIC USER INFO<br>
		<br>
		DISPLAY NAME
		<input type="text" name="username" placeholder="<?php echo $userDetails->username; ?>">
		EMAIL
		<input type="text" name="email" placeholder="<?php echo $userDetails->email; ?>">
		<input type="submit" name="basicsubmit" value="save changes">
	</form>
	<form action="" method="post">
		PASSWORD
		<br><br>
		OLD PASSWORD
		<input type="password" name="oldpwd" placeholder="Old Password...">
		NEW PASSWORD
		<input type="password" name="newpwd" placeholder="New Password...">
		<input type="password" name="newpwd" placeholder="Confirm Password...">
		<input type="submit" name="passwdsubmit" value="save changes">
	</form>
</div>