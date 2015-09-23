<?php
error_reporting(0);
require_once '../../../models/NewItems.php';
$id = $_POST['id'];
if(!isset($id))
	header('Location:'.$_SERVER['HTTP_REFERER'].'?id=2');
$itemName = $_POST['itemName'];
$describe = $_POST['describe'];
$itemGender = $_POST['itemGender'];
$type = $_POST['type'];
$isTop = $_POST['isTop'];
$isRecommend = $_POST['isRecommend'];
$re = new NewItems();
$data = array('itemName'=>$itemName,
					  'describe' =>$describe,
		'type'=>$type,
		'isTop'=>$isTop,
		'isRecommend'=>$isRecommend
		);
$re->itemUpdate($id,$data);
header('Location:'.$_SERVER['HTTP_REFERER'].'?id=2');
?>