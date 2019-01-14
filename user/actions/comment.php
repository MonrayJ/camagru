<?php

include_once('../../config.php');
include_once("../class/action.class.php");
include_once('../session.php');
$object = new Action_class;
$userDetails=$user_class->user_details($session_uid);
$comment = $_POST['comment'];
$owner = $_POST['user'];
$imgid = $_POST['img'];
if(!epty($comment))
{
	$object->public_comments($imgid, $owner, $session_uid, $comment);
}
else
?>