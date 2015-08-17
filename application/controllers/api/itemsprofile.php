<?php
//物品详情接口
require_once '../../models/Response.php';
require_once '../../models/ItemsProfile.php';

$style = new Response();
if($_GET['itemID'] )
{
	$itemID = $_GET['itemID'];
	$rec = new ItemsProfile();
	$data = $rec->itemsProfile($itemID,$_GET['uid']);
	
	echo $style->show('200',$data);
}
else 
	echo Response::show('400');

