<?php
//模糊搜索接口
require_once '../../models/Response.php';
require_once '../..//models/search.php';

$style = new Response();
if($_GET['key'])
{
	$data = array();
	$uid = isset($_GET['uid'])?$_GET['uid']:null;
	//$pageId = isset($_GET['pageId'])?$_GET['pageId']:1;
	$search= new Search();
	$re =  $search->search($_GET['key'], $uid);	
	while($line = mysql_fetch_array($re,MYSQL_ASSOC))
	{
		$data[] = $line;
	}
	echo $style->show(200,$data);
}
else
	echo $style->show(400);