<?php
	include('../config.php');
	include('session.php');
	$userDetails=$user_class->user_details($session_uid);
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
<link rel="stylesheet" type="text/css" media="screen" href="style.css" />

<style>
	.topnav
	{
		overflow: hidden;
		background-color: #222935;
		position: fixed;
		top: 0;
		width: 100%;
		z-index: 2;
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
		<a href="home.php">Home</a>
		<a href="gallery.html" class="active">Gallery</a>
		<a href="#contact">Profile</a>
		<a href="<?php echo BASE_URL; ?>logout.php">Logout</a>
		<a href="javascript:void(0);"  class="icon" onclick="myFunction()">&#9776;</a>
	</div>

	<div class="content" style="padding-left:16px;padding-top:60px">
		<script>
			function myFunction()
			{
				var x = document.getElementById("myTopnav");
				if (x.className === "topnav sticky") {
					x.className += " responsive";
				} else {
					x.className = "topnav sticky";
				}
			}
		</script>
	</div>

	<!-- Upload Images -->
	<?php
		if (isset($_POST['submit']))
		{
			$file = $_FILES['file'];
			$fileName = $_FILES['file']['name'];
			$fileTmpName = $_FILES['file']['tmp_name'];
			$fileSize = $_FILES['file']['size'];
			$fileError = $_FILES['file']['error'];
			$fileType = $_FILES['file']['type'];
			$fileExt = explode('.', $fileName);
			$fileActualExt = strtolower(end($fileExt));
			$allowed = array('jpg', 'jpeg', 'png');
			if (in_array($fileActualExt, $allowed))
			{
				if ($fileError === 0)
				{
					if ($fileSize < 3000000)
					{
						$d = strtotime("now");
						// $fileNameNew = date("Y-m-d h:i:sa", $d).".".$fileActualExt;
						$fileNameNew = time()."test.png";
						$fileDestination = 'gallery/'.$fileNameNew;
						move_uploaded_file($fileTmpName, $fileDestination);
						echo "<img src=\"".$fileDestination."\">";
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

<div id="methods">
	<!-- Capture Photo -->
	<div class="booth">
		<a id="button" class="booth-capture-button" href="#">Enable Camera</a>
		<video id="video" width="100%"></video>
		<a href="#" id="capture" class="booth-capture-button">take photo</a>
		<canvas id="canvas" width="400" height="300"></canvas>
		<img src="haas.png" alt="photo" id="photo">
		<p id="serverResponse"></p>
		<form action="" method="post">
			<input type="text" name="filedesc" placeholder="Image Description..." autocomplete="off">
		</form>
		<a href="#" id="save" class="booth-capture-button">save</a>
	</div>
	<script src="photo.js"></script>

	<!-- Upload Continued... -->
	<div id="upload">
		<form action="" method="POST" enctype="multipart/form-data">
			<input type="file" name="file">
			<button type="submit" name="submit" class="booth-capture-button" style="margin: 0px 0px 0px 0px;">upload</button>
		</form>
	</div>
</div>

</body>
</html>
