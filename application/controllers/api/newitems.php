<?php
//首页新品接口
require_once '../../models/Response.php';
require_once '../../models/NewItems.php';

$style = new Response();
if($_GET['page'])
{
	$pageId = $_GET['page'];
	$rec = new NewItems();
	$data = $rec->newItems($pageId);
	$res = new Response();
	echo $res->show('200',$data);
}
else 
	echo Response::show('400');

