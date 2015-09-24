<?php
//模糊搜索接口
error_reporting(0);
require_once '../../models/Response.php';
require_once '../..//models/search.php';
require_once '../../models/UserLike.php';
//require_once 'admin/itemImport.php';
$style = new Response();
if($_GET['key']&&(!$_GET['type']))
{
	$data = array();
	$uid = isset($_GET['uid'])?$_GET['uid']:null;
	$page = isset($_GET['page'])?$_GET['page']:1;
	$n = isset($_GET['limit'])?$_GET['limit']:null;
	$search= new Search();
	$like = new UserLikeModel();
	$re =  $search->search($_GET['key'], $page,$uid,$n);	
	while($line = mysql_fetch_array($re,MYSQL_ASSOC))
	{
		$line['islike'] = $like->checkUserLike($uid,$line['id']);
		$line['likesum'] = $like->itemLikeSum($line['id']);
		$data[] = $line;
	}
	echo $style->show(200,$data);
}
elseif($_GET['key']&&$_GET['type'])
{
	$data = array();
	$uid = isset($_GET['uid'])?$_GET['uid']:null;
	$page = isset($_GET['page'])?$_GET['page']:1;
	if(isset($_GET['type']))
	{
		$type= type($_GET['type']);
	}
	$search= new Search();
	$like = new UserLikeModel();
	$re =  $search->search_admin($_GET['key'],$type,$page);
	while($line = mysql_fetch_array($re,MYSQL_ASSOC))
	{
		$line['islike'] = $like->checkUserLike($uid,$line['id']);
		$line['likesum'] = $like->itemLikeSum($line['id']);
		$data[] = $line;
	}
	echo $style->show(200,$data);
}
else
	echo $style->show(400);

function  type($type)
{
	switch($type)
	{
		case '外套':
			return 1;
		case '裙子':
			return 2;
		case '上衣':
			return 3;
		case '裤子':
			return 4;
		case '鞋帽配饰':
			return 5;
		case '运动装':
			return 6;
		case '家居服':
			return 7;
		case '箱包':
			return 8;
		case '化妆品':
			return 9;
		case '保健品':
			return 10;
		case '食品':
			return 11;
		case '保健器械':
			return 12;
		case '生活用品':
			return 13;
		default:
			return 0;
	}
}