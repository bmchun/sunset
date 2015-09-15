<?php
error_reporting(0);
require_once '../../../models/HotKeys.php';
$id = $_GET['id'];
if(!isset($id))
	header('Location:'.$_SERVER['HTTP_REFERER']);
$re = new HotKeys();
$re->hotkeyDel($id);
header('Location:'.$_SERVER['HTTP_REFERER']);
?>