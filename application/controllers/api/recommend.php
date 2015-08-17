<?php
//首页推荐接口
require_once '../../models/Response.php';
require_once '../../models/Recommend.php';

$style = new Response();
if($_GET['page'])
{
	$pageId = $_GET['page'];
	$uid = isset($_GET['uid'])?$_GET['uid']:NULL;
	$rec = new Recommend();
	$data = $rec->recommend($pageId,$uid);
	$res = new Response();
	echo $res->show('200',$data);
}
else 
	echo Response::show('400');

