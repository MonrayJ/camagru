<?php

include_once('../../config.php');
include_once("../class/upload.class.php");
include_once('../session.php');
$delete = new Gallery_class;
$userDetails=$user_class->user_details($session_uid);

$imgid = $_POST['img'];
$delete->delete_img($imgid);
?>