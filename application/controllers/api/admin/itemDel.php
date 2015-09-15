<?php
error_reporting(0);
require_once '../../../models/NewItems.php';
$id = $_GET['id'];
if(!isset($id))
	header('Location:'.$_SERVER['HTTP_REFERER']);
$re = new NewItems();
$re->itemDel($id);
header('Location:'.$_SERVER['HTTP_REFERER']);
?>