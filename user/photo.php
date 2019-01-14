<?php
	include_once('../config.php');
	include_once("class/upload.class.php");
	include_once('session.php');
	$upload = new Gallery_class;
	$userDetails=$user_class->user_details($session_uid);
	
	$img_src = $_POST['name'];
	$description = $_POST['message'];
	$photo_info = "gallery/".time().$userDetails->username.".png";
	$photo = str_replace("data:image/png;base64,", "", $img_src);
	$photo = str_replace(' ', '+', $photo);
	$decodedPhoto = base64_decode($photo);
	file_put_contents($photo_info, $decodedPhoto);
	$upload->upload_gallery($session_uid, $userDetails->username, $photo_info, $description);
?>

<!-- 
$login = $_POST['login'];
$img_src = $_POST['img_src'];

$photo_info = "gallery/".time().$login.".png";
$photo = str_replace("data:image/png;base64,", "", $img_src);
$photo = str_replace(' ', '+', $photo);
$decodedPhoto = base64_decode($photo);
file_put_contents($photo_info, $decodedPhoto);
-->
