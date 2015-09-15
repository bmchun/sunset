<?php
error_reporting(0);
require_once '../../../models/UserProfile.php';
$id = $_GET['id'];
if(!isset($id))
	header('Location:'.$_SERVER['HTTP_REFERER']);
$re = new UserProfile();
$re->delUser($id);
header('Location:'.$_SERVER['HTTP_REFERER']);
?>