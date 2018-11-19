<?php
	include('../config.php');
	include('session.php');
	$userDetails=$user_class->user_details($session_uid);
	echo $session_uid . "<br>";
	print_r($userDetails);
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
		box-shadow: 0px 2px 3px black;

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
	<a href="gallery.php">Gallery</a>
	<a href="#contact">Profile</a>
	<a href="#about">Logout</a>
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
  <i class='fas fa-user-plus' style='font-size:24px'></i>

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

</div>
</body>
</html>

		<h1>Welcome <?php echo $userDetails->name; ?></h1>
		<h4><a href="<?php echo BASE_URL; ?>logout.php">Logout</a></h4>