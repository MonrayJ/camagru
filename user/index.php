<?php 
include("config.php");
include('class/user.class.php');
$userClass = new User_class();

$errorMsgReg='';
$errorMsgLogin='';
if (!empty($_POST['loginSubmit'])) 
{
$usernameEmail=$_POST['usernameEmail'];
$password=$_POST['password'];
 if(strlen(trim($usernameEmail))>1 && strlen(trim($password))>1 )
   {
	$uid=$userClass->user_login($usernameEmail,$password);
	if($uid)
	{
		$url=BASE_URL.'home.php';
		header("Location: $url");
		echo "login working";
	}
	else
	{
		$errorMsgLogin="Please check login details.";
	}
   }
}

if (!empty($_POST['signupSubmit'])) 
{

	$username=$_POST['usernameReg'];
	$email=$_POST['emailReg'];
	$password=$_POST['passwordReg'];
	$name=$_POST['nameReg'];
	$username_check = preg_match('~^[A-Za-z0-9_]{3,20}$~i', $username);
	$email_check = preg_match('~^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$~i', $email);
	$password_check = preg_match('~^[A-Za-z0-9!@#$%^&*()_]{6,20}$~i', $password);
	if($username_check && $email_check && $password_check && strlen(trim($name))>0) 
	{
		$uid=$userClass->user_registration($username,$password,$email,$name);
		echo "Second test to see where the problem is!";
		if($uid)
		{
			$url=BASE_URL.'home.php';
			header("Location: $url");
		}
		else
		{
		$errorMsgReg="Username or Email already exits.";
		}
	}
	else
		echo "not working";
}
?>
<!DOCTYPE html>
<html>
<head>
<style>
html
{
	width: 100%;
	height: 100%;
	background: url(https://www.zastavki.com/pictures/originals/2014/Nature___Sundown_Starry_sky_at_sunset_082927_.jpg);
}
#container
{
	width: 100%;
	height: 100%;
}
#login,#signup
{
	position: relative;
	margin: auto;
	margin-top: 20%;
	width: 50%;
	max-width: 400px;
	border: 1px solid #d6d7da;
	padding: 0px 15px 15px 15px;
	border-radius: 5px;
	font-family: arial;
	line-height: 16px;
	color: #333333;
	font-size: 14px;
	background: rgba(255, 255, 255, 0.5);
}
#login
{
}
#signup
{
	float:right;
}
h3
{
	color:#365D98;
}
form label
{
	font-weight: bold;
}
form label, form input
{
	display: block;
	margin-bottom: 5px;
	width: 90%;
}
form input
{
	border: solid 1px #666666;
	padding: 10px;
	border: solid 1px #BDC7D8;
	margin-bottom: 20px;
}
.button
{
	background-color: #5fcf80 !important;
	border-color: #3ac162 !important;
	font-weight: bold;
	padding: 12px 15px;
	max-width: 100px;
	color: #ffffff;
}
.errorMsg
{
	color: #cc0000;
	margin-bottom: 10px;
}
</style>
</head>
<body>
	<div id="background">
	<div id="container">

		<div id="login">
			<h3>Login</h3>
			<form method="post" action="" name="login">
				<label>Username or Email</label>
				<input type="text" name="usernameEmail" autocomplete="off" />
				<label>Password</label>
				<input type="password" name="password" autocomplete="off"/>
				<div class="errorMsg">
					<?php
					echo $errorMsgLogin;
					?>
				</div>
				<input type="submit" class="button" name="loginSubmit" value="Login">
			</form>
		</div>
	
		<!-- <div id="signup"> -->
			<!-- <h3>Registration</h3> -->
			<!-- <form method="post" action="" name="signup"> -->
				<!-- <label>Name</label> -->
				<!-- <input type="text" name="nameReg" autocomplete="off" /> -->
				<!-- <label>Email</label> -->
				<!-- <input type="text" name="emailReg" autocomplete="off" /> -->
				<!-- <label>Username</label> -->
				<!-- <input type="text" name="usernameReg" autocomplete="off" /> -->
 
				<!-- <label>Password</label> -->
				<!-- <input type="password" name="passwordReg" autocomplete="off"/> -->
				<!-- <div class="errorMsg"><?php// echo $errorMsgReg; ?></div> -->
				<!-- <input type="submit" class="button" name="signupSubmit" value="Signup"> -->
			<!-- </form> -->
		<!-- </div> -->
	
	</div>
</div>
</body>
</html>