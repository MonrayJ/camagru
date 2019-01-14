<?php

	// function supm_pose($overlay, $image)	//	img path to the two images to superimpose
	// {
	// 	if (!empty($overlay) && !empty($image))
	// 	{	
	// 		$temp = $image;
	// 		$get_ext = explode(".", $temp);
	// 		$ext = end($get_ext);
	// 		echo $ext;
	// 		if ($ext == "jpg" || $ext == "jpeg")
	// 		{
	// 			$under = imagecreatefromjpeg($image);
	// 		}
	// 		else if ($ext == "png")
	// 		{
	// 			$under = imagecreatefrompng($image);
	// 		}
	// 		else
	// 		{
	// 			echo "fuck off with that file type!!!<br>";
	// 			if (empty($ext))
	// 			{
	// 				echo "fucking empty";
	// 			}
	// 		}
	// 		$over = imagecreatefrompng($overlay);
	// 		imagecopyresampled($under, $over, $png_x_co, $png_y_co, 0, 0, $png_x_size, $png_y_size, imagesx($over), imagesy($over));
	// 		ob_start();		//	allows output to be stored in a internal buffer
	// 		imagejpeg($under);	//	imagejpeg() creates a JPEG file from the given image.
	// 		$contents = ob_get_contents();	//	saves the above output to $contents.
	// 		ob_end_clean();
	// 		file_put_contents("file.jpeg", $contents);
	// 	}
	// }

	// $image = "haas.jpg";
	// $overlay = "joint.png";
	// supm_pose($overlay, $image);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<style>
	body
	{
		margin: 0;
		background-color: rgb(100, 100, 100);
	}
	#mydiv
	{
		position: absolute;
		display: inline;
		z-index: 9;
		/* text-align: center; */
		width: 15%;
		height: auto;
		resize: horizontal;
	}

	#mydivheader
	{
		width: 100%;
		padding: 10px;
		/* cursor: move; */
		z-index: 10;
		color: #fff;
	}
	#photo
	{
		display: inline-block;
	}
	</style>
</head>

<body>
	<div id="photo">
		<img src="haas.jpg">
	</div>
	<a href="#" id="haas">scale/drag</a>
	<div id="mydiv" class="mydiv">
		<img src="joint.png" id="mydivheader" class="mydivheader">
	</div>
	<button id="button">suck it</button>

</body>

	<script>
	//Make the DIV element draggagle:
	setTimeout(function(){
		window.onload = dragElement(document.getElementsByClassName("mydiv")[0]);
	}, 1000);

	function dragElement(elmnt)
	{
		var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
		if (document.getElementsByClassName(elmnt.class + "header")[0])
		{
		/* if present, the header is where you move the DIV from:*/
			document.getElementsByClassName(elmnt.class + "header")[0].onmousedown = dragMouseDown;
			
		}
		else
		{
		/* otherwise, move the DIV from anywhere inside the DIV:*/
			// elmnt.onmousedown = dragMouseDown;
		}

		function dragMouseDown(e) {
			e = e || window.event;
			e.preventDefault();
		// get the mouse cursor position at startup:
			pos3 = e.clientX;
			pos4 = e.clientY;
			document.onmouseup = closeDragElement;
		// call a function whenever the cursor moves:
			document.onmousemove = elementDrag;
		}

		function elementDrag(e)
		{
			e = e || window.event;
			e.preventDefault();
		// calculate the new cursor position:
			pos1 = pos3 - e.clientX;
			pos2 = pos4 - e.clientY;
			pos3 = e.clientX;
			pos4 = e.clientY;
		// set the element's new position:
			elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
			elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
		}

		function closeDragElement()
		{
		/* stop moving when mouse button is released:*/
			document.onmouseup = null;
			document.onmousemove = null;
		}
	}

	
	var img_t, img_l, png_t, png_l;
	var img_h, img_w, png_h, png_w;

	var button = document.getElementById("button");
	setTimeout(function(){
		window.onload = getOffsetSum(document.getElementById("photo"), img_t, img_l, img_h, img_w);
	}, 1000);
	setTimeout(function(){
		window.onload = getOffsetSum(document.getElementById("mydiv"), png_t, png_l, png_h, png_w);
	}, 1000);
	
	function getOffsetSum(elem, img_t, img_l, height, width)
	{
		img_t = 0, img_l = 0, height = 0, width = 0;
		if (elem)
		{
			var rect = elem.getBoundingClientRect();
			img_l += rect.left;
			img_t += rect.top;
			width += rect.width;
			height += rect.height;
		}
		alert('top_space: ' + img_t + ', left_space: ' + img_l + ', width: ' + width + ', height: ' + height);
	}

	document.getElementById("haas").ondblclick = function()
	{
		var current = document.getElementById("mydiv").getAttribute("class");
		if (current = "mydiv")
		{
			document.getElementById("mydiv").setAttribute("class", "resize");
		}
		else if (current = "resize")
		{
			document.getElementById("mydiv").setAttribute("class", "mydiv");
		}
		dragElement(document.getElementsByClassName("mydiv")[0]);
	};
	</script>

</html>
