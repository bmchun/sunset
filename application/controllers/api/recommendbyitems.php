<?php
//物品详情相似物品推荐接口
error_reporting(E_ALL);
require_once '../../models/Response.php';
require_once '../../models/ItemsProfile.php';
$style = new Response();
if($_GET['itemID'] && $_GET['page'])
{
	$itemID = $_GET['itemID'];
	$pageID = $_GET['page'];
	$rec = new ItemsProfile();
	$data = $rec->relatedItems($itemID,$pageID);
	
	$res = new Response();
	echo $res->show('200',$data);
}
else 
	echo Response::show('400');


