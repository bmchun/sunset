<?php
error_reporting(0);
require_once '../../../models/NewItems.php';
$id = $_GET['id'];
if(!isset($id)&&isset($data))
	header('Location:'.$_SERVER['HTTP_REFERER']);
$re = new NewItems();
$re->itemUpdate($id,$data);
header('Location:'.$_SERVER['HTTP_REFERER']);
?>