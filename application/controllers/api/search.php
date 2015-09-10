<?php
//模糊搜索接口
error_reporting(0);
require_once '../../models/Response.php';
require_once '../..//models/search.php';
require_once '../../models/UserLike.php';

$style = new Response();
if($_GET['key'])
{
	$data = array();
	$uid = isset($_GET['uid'])?$_GET['uid']:null;
	$page = isset($_GET['page'])?$_GET['page']:1;
	$search= new Search();
	$like = new UserLikeModel();
	$re =  $search->search($_GET['key'], $page,$uid);	
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