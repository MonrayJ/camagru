<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>
	<div id="draggable">
	</div>

	<div id="pngs">
	<img src="joint.png" alt="" id="joint" value="0" onclick="getIt(this)">
	<img src="shades.png" alt="" id="shades" value="0" onclick="getIt(this)">
	</div>

<script>
	function getIt(element)
	{
		var path = ".png";
		if (element.getAttribute('value') == 0)
		{
			element.setAttribute('value', 1);
			var elem = document.createElement("img");
			elem.setAttribute("src", element.id+path);
			elem.setAttribute("class", "supper");
			elem.setAttribute("id", element.id+"_png");
			document.getElementById("draggable").appendChild(elem);
		}
		else
		{
			element.setAttribute('value', 0);
		   	var remove = document.getElementById(element.id+"_png");
			remove.parentNode.removeChild(remove);
		}
	}
	</script>

</body>
</html>