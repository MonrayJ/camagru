<?php

$images = $display->display_gallery($session_uid);
// echo $session_uid;
if (!empty($images))
{
	foreach(array_reverse($images) as $img)
	{
		echo "<div class=\"column\" id=\"width\">
		<img src=\"".$img->img_path."\" id=\"".$img->imgid."\" class=\"gallery_display\">
	
		<script>
		function like_unlike(user_id, img_id)
		{   
			const xhr = new XMLHttpRequest();
			xhr.onload = function()
			{
				const serverResponse = document.getElementById(\"likes\");
				serverResponse.innerHTML = this.responseText;
			};
			xhr.open(\"POST\", \"actions/like.php\");
			xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
			xhr.send(\"user=\"+user_id+\"&img=\"+img_id);
		}
		</script>		
	
		<a id=\"option-".$img->imgid."\" 
		data-id=\"".$img->uid."\" 
		data-option=\"".$img->imgid."\" 
		href=\"#\" 
		onclick=\"like_unlike(this.getAttribute('data-id'), this.getAttribute('data-option'));\" class=\"icon toggle-like fa fa-heart\" style=\"font-size:16px;\">
		</a>
	
		<script>
		function delete_img(img_id)
		{   
			const xhr = new XMLHttpRequest();
			xhr.onload = function()
			{
				const serverResponse = document.getElementById(\"deletes\");
				serverResponse.innerHTML = this.responseText;
			};
			xhr.open(\"POST\", \"actions/delete.php\");
			xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
			xhr.send(\"img=\"+img_id);
			location.reload();
		}
		</script>

		<a id=\"option-".$img->imgid."\" 
		data-id=\"".$img->imgid."\" 
		href=\"#\"
		onclick=\"delete_img(this.getAttribute('data-id'));\" class=\"icon delete fas fa-trash\" style=\"font-size:16px;\">
		</a>
		<p class=\"description\">".$img->description."</p>

		</div>";
	}
}
?>
