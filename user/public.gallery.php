<?php
// get all elements from database needs to change to get elements based on the limit
$num_elements = $display->public_display($session_uid);
// get number of elements and number of pages
$elements = count((array)$num_elements);
$elem_per_page = 6;
$number_of_pages = ceil($elements/$elem_per_page); 
// get wich page we're on
if (!isset($_GET['page']))
{
	$page = 1;
}
else
{
	$page = $_GET['page'];
}
$this_page_first_result = ($number_of_pages - $page) * $elem_per_page;
// get all from db based on current limit aka $this_page_first_result....
$images = $display->public_display_limit($this_page_first_result, $elem_per_page);
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
		onclick=\"like_unlike(this.getAttribute('data-id'), this.getAttribute('data-option'));\" class=\"toggle-like fa fa-heart\" style=\"font-size:16px;\">
		</a>
		<p class=\"description\"><strong>".$img->username.": </strong>".$img->description."</p>
		<h3 class=\"head\">Comments</h3>
		<div class=\"comments\">";

		$comments = $display->get_comments($img->imgid);
		foreach(array_reverse($comments) as $comment)
		{
			$commenterDetails=$user_class->user_details($comment->commenter_id);
			echo"
			<p><strong>".$commenterDetails->username.": </strong>".$comment->comment."</p>
			";
		}

		echo "</div>
		<script>
		function comment".$img->imgid."(user_id, img_id)
		{   
			var comment = document.getElementById('comment-".$img->imgid."').value;
			const xhr = new XMLHttpRequest();
			xhr.onload = function()
			{
				const serverResponse = document.getElementById(\"likes\");
				serverResponse.innerHTML = this.responseText;
			};
			xhr.open(\"POST\", \"actions/comment.php\");
			xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
			alert(\"comment=\"+comment+\"&user=\"+user_id+\"&img=\"+img_id);
			xhr.send(\"comment=\"+comment+\"&user=\"+user_id+\"&img=\"+img_id);
		}
		</script>
		
		<form id=\"comment-form\" action=\"actions/comment.php\" method=\"POST \" enctype=\"multipart/form-data\">
		<input id=\"comment-".$img->imgid."\" class=\"gallery-input\"type=\"text\" placeholder=\"Comment...\" autocomplete=\"off\">
		<a
		data-id=\"".$img->uid."\" 
		data-option=\"".$img->imgid."\" 
		href=\"#\" 
		onclick=\"comment".$img->imgid."(this.getAttribute('data-id'), this.getAttribute('data-option'));\" class=\"gallery-input gallery-submit fas fa-comment\" style=\"font-size:14px;\">
		</a>
		</form>
		</div>";
	}
}
for ($page = 1; $page <= $number_of_pages; $page++)
{
	echo '<a class="pagination" href="home.php?page='.$page.'">'.$page.'</a> ';
}
?>
