<?php
	include_once('../config.php');
	include_once("class/upload.class.php");
	include_once('session.php');
	include_once('class/prsnl.dsp.gal.class.php');
	$display = new Personal_gallery_class;
	$upload = new Gallery_class;
	$userDetails=$user_class->user_details($session_uid);
	// echo $session_uid . "<br>";
	// print($userDetails->username);
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
<link rel="stylesheet" href="photo.css">
<link rel="stylesheet" type="text/css" media="screen" href="user.gallery.css" />

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
		<a href="home.php">Home</a>
		<a href="gallery.html" class="active">Gallery</a>
		<a href="profile.php">Profile</a>
		<a href="<?php echo BASE_URL; ?>logout.php">Logout</a>
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

	<!-- Upload Images -->
	<?php
		if (isset($_POST['submit']) && isset($_FILES['file']))
		{
			$file = $_FILES['file'];
			$fileName = $_FILES['file']['name'];
			$fileTmpName = $_FILES['file']['tmp_name'];
			$fileSize = $_FILES['file']['size'];
			$fileError = $_FILES['file']['error'];
			$fileType = $_FILES['file']['type'];
			$fileExt = explode('.', $fileName);
			$fileActualExt = strtolower(end($fileExt));
			$desription = $_POST['filedesc'];
			// echo var_export($_POST['filedesc'], true);
			$allowed = array('jpg', 'jpeg', 'png');
			if (in_array($fileActualExt, $allowed))
			{
				if ($fileError === 0)
				{
					if ($fileSize < 3000000)
					{
						$d = strtotime("now");
						$fileNameNew = time().$userDetails->username.".".$fileActualExt;
						$fileDestination = 'gallery/'.$fileNameNew;
						move_uploaded_file($fileTmpName, $fileDestination);
						echo "<img src=\"".$fileDestination."\">";
						$upload->upload_gallery($session_uid, $userDetails->username, $fileDestination, $desription);
						// header("Location: gallery.php?uploadsucess");
					}
					else
					{
						echo "File too big!";
					}
				}
				else
				{
					echo "Error uploading file!";
				}
			}
			else
			{
				echo "File type not supported!";
			}
		}
	?>
<script>
	if ( window.history.replaceState )
	{
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<div id="methods">
	<h2 style="width: 100%; border-top: 1px solid black; border-radius: 15px; padding: 5px 0px 0px 10px;">Capture / Upload</h2>

	<!-- Capture Photo -->
	<div class="booth">
		<a href="#" id="button" class="booth-capture-button">Enable Camera</a>
		<video id="video" width="100%">
		<img src="../png/beard1" alt="">
		</video>
		<a href="#" id="capture" class="booth-capture-button">Capture</a>
		<canvas id="canvas" width="400" height="300"></canvas>
		<img src="haas.png" alt="photo" id="photo" width="100%">
		<p id="serverResponse" style="display: none;"></p>
		<form action="" method="post">
			<input type="text" id="description" name="filedesc" placeholder="Image Description..." autocomplete="off">
		</form>
		<a href="#" id="save" class="booth-capture-button upload">Save</a>
	</div>
	<script src="photo.js"></script>

	<!-- Upload Continued... -->
	<div id="upload">
		<form action="" method="POST" enctype="multipart/form-data">
			<input type="file" name="file" id="file" class="inputfile inputfile-6" onchange="loadFile(event)"/>
			<label for="file">
				<span></span>
				<strong>Choose a file&hellip;</strong>
			</label>
			<img id="output" style="display: none;"/>
			<input type="text" name="filedesc" placeholder="Image Description..." autocomplete="off">
			<input id="upbtn" type="submit" name="submit" class="booth-capture-button" style="font-size: 14px; padding: 10px 20px;" value="Upload">
			<script>
				var loadFile = function(event)
				{
					var output = document.getElementById('output');
					output.src = URL.createObjectURL(event.target.files[0]);
					output.style.display = 'block';
					output.style.margin = '0px 0px 7px 0px';
				};
			</script>
		</form>
	</div>
</div>
<!-- Display user gallery -->
<div style="display: inline-block; width: 100%; height: 1px;"></div>
<div id="row" style="display: block;">
	<h2 style="width: 100%; border-top: 1px solid black; border-radius: 15px; padding: 5px 0px 0px 10px;">Photos</h2>
	<?php
		require_once("personal.gallery.php");
	?>
	<script>
		var upbtn = document.getElementById("upbtn");
		var save = document.getElementById("save");
		upbtn.addEventListener('click', afunction);
		save.addEventListener('click', afunction);

		function afunction()
		{
			$.get("personal.gallery.php");
		}
	</script>
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

	window.addEventListener('resize', function(e) {

  	clearTimeout(resizeTimer);
  	resizeTimer = setTimeout(function() {
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
<!-- <button class="fa fa-heart" style="font-size:48px;color:red"></button> -->
<script src="./custom-file-input.js"></script>
</body>
</html>