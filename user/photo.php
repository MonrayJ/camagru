<?php

$img_src = $_POST['name'];
$photo_info = "gallery/".time()."test.png";
$photo = str_replace("data:image/png;base64,", "", $img_src);
$photo = str_replace(' ', '+', $photo);
$decodedPhoto = base64_decode($photo);
file_put_contents($photo_info, $decodedPhoto);
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
