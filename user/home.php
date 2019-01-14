<?php
	include('../config.php');
	include_once('class/prsnl.dsp.gal.class.php');
	include('session.php');
	$userDetails=$user_class->user_details($session_uid);
	$display = new Personal_gallery_class;
	// echo $session_uid . "<br>";
	// print_r($userDetails);
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
<link rel="stylesheet" href="photo.css">
<link rel="stylesheet" type="text/css" media="screen" href="user.gallery.css" />
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
		<a href="#home" class="active">Home</a>
		<a href="gallery.php">Gallery</a>
		<a href="profile.php">Profile</a>
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
<div id="row" style="display: block;">
	<h2 style="width: 100%; border-top: 1px solid black; border-radius: 15px; padding: 5px 0px 0px 10px;">Photos</h2>
	<?php
		require_once("public.gallery.php");
	?>
</div>
<p id="likes"></p>
<p id="deletes"></p>
<script>
	window.addEventListener('load',function()
	{
		var x = document.getElementById("row").querySelectorAll(".column");
		var width = document.getElementById("width").clientWidth;
	    var i;
		for (i = 0; i < x.length; i++)
		{
	        x[i].style.height = width*1.5+"px";
	    }
	});
	
	var resizeTimer;

	window.addEventListener('resize', function(e)
	{
  		clearTimeout(resizeTimer);
		resizeTimer = setTimeout(function()
		{
			var x = document.getElementById("row").querySelectorAll(".column");
			var width = document.getElementById("width").clientWidth;
		    var i;
			for (i = 0; i < x.length; i++)
			{
		        x[i].style.height = width*1.5+"px";
		    }
		}, 250);
	});
</script>

</body>
</html>