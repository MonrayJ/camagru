<?php

include_once('../../config.php');
include_once("../class/action.class.php");
include_once('../session.php');
$like = new Action_class;
$userDetails=$user_class->user_details($session_uid);

$owner = $_POST['user'];
$imgid = $_POST['img'];
$liked = $like->check_like($imgid, $session_uid);
if (empty($liked))
{
	$like->public_likes($imgid, $owner, $session_uid);
	echo "liked";
}
else
{
	$like->unlike($imgid, $owner, $session_uid);
	echo "unliked";
}
?>