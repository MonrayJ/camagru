var butn = document.getElementById('button');
var elementIsClicked = false;

function clickHandler()
{
  elementIsClicked = true;
}
butn.addEventListener('click', clickHandler);

if (elementIsClicked === false)
{
	butn.addEventListener('click', function() {
		var video = document.getElementById('video'),
			canvas = document.getElementById('canvas'),
			context = canvas.getContext('2d'),
			photo = document.getElementById('photo'),
			vendorUrl = window.URL || window.webkitURL;
		
		butn.addAttribute

		navigator.getMedia =	navigator.getUserMedia ||
								navigator.webkitGetUserMedia ||
								navigator.mozGetUserMedia ||
								navigator.msGetUserMedia;

		navigator.getMedia(
		{
			video: true,
			audio: false
		},
		function(stream)
		{
			console.log("here");
			video.src = vendorUrl.createObjectURL(stream);
			video.play();
		},
		function(_error)
		{
		});

		document.getElementById('capture').addEventListener('click', function()
		{
			context.drawImage(video, 0, 0, 400, 300);
			photo.setAttribute('src', canvas.toDataURL('image/png'));

		});

		document.getElementById('save').addEventListener('click', function()
		{
			var filedesc = document.getElementById('description').value;
			var src = photo.getAttribute('src');
			const xhr = new XMLHttpRequest();
			xhr.onload = function()
			{
				const serverResponse = document.getElementById("serverResponse");
				serverResponse.innerHTML = this.responseText;
			};
			xhr.open("POST", "photo.php");
			xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
			xhr.send("name="+src+"&message="+filedesc);
			alert("shit happened");
		});
	});
}
