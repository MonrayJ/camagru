<?php 
include("../config.php");
include('class/user.class.php');
$userClass = new User_class();

$errorMsgReg='';
$errorMsgLogin='';
if (!empty($_POST['loginSubmit'])) 
{
$usernameEmail=$_POST['usernameEmail'];
$password=$_POST['password'];
if(/*strlen(trim($usernameEmail))>1 && strlen(trim($password))>1 */ $password && $usernameEmail)
	 {
		// echo "<script> alert ('got here1');</script>";
		$uid=$userClass->user_login($usernameEmail,$password);
		if($uid)
		{ 
			$url=BASE_URL.'home.php';
			header("Location: $url");
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
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
<link rel="stylesheet" type="text/css" media="screen" href="style.css" />
<style>
		.topnav
		{
			overflow: hidden;
			background-color: #222935;
			position: fixed;
			top: 0;
			width: 100%;
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
	<a href="#home" class="active">Home</a>
	<a href="#news">Gallery</a>
	<a href="#contact">Profile</a>
	<a href="#about">Logout</a>
	<a class="but"><button id="loginBtn" class="button">Login</button></a>
	<a class="but"><button id="registerBtn" class="button">Register</button></a>
	<!-- <div class="dropdown">
	<button class="dropbtn">Dropdown 
		<i class="fa fa-caret-down"></i>
	</button>
	<div class="dropdown-content">
		<a href="#">Link 1</a>
		<a href="#">Link 2</a>
		<a href="#">Link 3</a>
	</div>
	</div>  -->
	<a href="javascript:void(0);"  class="icon" onclick="myFunction()">&#9776;</a>
</div>

<div class="content" style="padding-left:16px;padding-top:60px">
	<h2>Responsive Topnav with Dropdown</h2>
	<i class='fas fa-user-plus' style='font-size:24px'></i>

	<p>Resize the browser window to see how it works.</p>
	<p>Hover over the dropdown button to open the dropdown menu.</p>
</div>

<div>
	<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Explicabo repellendus eveniet blanditiis doloremque ipsum sequi sapiente animi optio voluptatibus maiores ipsa perferendis, cumque temporibus vel. Maxime corrupti modi odit odio.</p>
	<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Explicabo repellendus eveniet blanditiis doloremque ipsum sequi sapiente animi optio voluptatibus maiores ipsa perferendis, cumque temporibus vel. Maxime corrupti modi odit odio.</p>
	<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Explicabo repellendus eveniet blanditiis doloremque ipsum sequi sapiente animi optio voluptatibus maiores ipsa perferendis, cumque temporibus vel. Maxime corrupti modi odit odio.</p>
	<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Explicabo repellendus eveniet blanditiis doloremque ipsum sequi sapiente animi optio voluptatibus maiores ipsa perferendis, cumque temporibus vel. Maxime corrupti modi odit odio.</p>
	<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Explicabo repellendus eveniet blanditiis doloremque ipsum sequi sapiente animi optio voluptatibus maiores ipsa perferendis, cumque temporibus vel. Maxime corrupti modi odit odio.</p>
	<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Explicabo repellendus eveniet blanditiis doloremque ipsum sequi sapiente animi optio voluptatibus maiores ipsa perferendis, cumque temporibus vel. Maxime corrupti modi odit odio.</p>
</div>

<script>
function myFunction() {
	var x = document.getElementById("myTopnav");
	if (x.className === "topnav sticky") {
		x.className += " responsive";
	} else {
		x.className = "topnav sticky";
	}
}
</script>


<div id="loginModal" class="modal">
	<div class="modal-content">
	<div class="modal-header">
		<span class="closeBtn">&times;</span>
		<h2>Login</h2>
	</div>
	<form method="post" action="" name="login">
		<div class="modal-body">
		<label>Username or Email</label>
		<input type="text" name="usernameEmail" autocomplete="off">
		<label>Password</label>
		<input type="password" name="password" autocomplete="off">
		<div class="errorMsg">
			<?php
			echo $errorMsgLogin;
			?>
		</div>
		</div>
		<div class="modal-footer">
		<h2>footer</h2>
		<input type="submit" class="button" name="loginSubmit" value="Login">
		</div>
	</form>
	</div>
</div>
<div id="registerModal" class="modal">
	<div class="modal-content">
	<div class="modal-header">
		<span class="closeBtn">&times;</span>
		<h2>Register</h2>
	</div>
	<form method="post" action="" name="Register">
		<div class="modal-body">
		<label>Name</label>
		<input type="text" name="nameReg" autocomplete="off" />
		<label>Email</label>
		<input type="text" name="emailReg" autocomplete="off" />
		<label>Username</label>
		<input type="text" name="usernameReg" autocomplete="off" />
		<label>Password</label>
		<input type="password" name="passwordReg" autocomplete="off"/>
		<div class="errorMsg"><?php// echo $errorMsgReg; ?></div>
		</div>
		<div class="modal-footer">
		<h2>footer</h2>
		<input type="submit" class="button" name="signupSubmit" value="Signup">
		</div>
	</form>
	</div>
</div>

<script src="main.js"></script>
</body>
</html>
