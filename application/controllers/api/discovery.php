<?php
//发现页面数据调用接口
require_once '../../models/Response.php';
require_once '../..//models/Discovery.php';

$style = new Response();
$gender = isset($_GET['gender'])?$_GET['gender']:NULL;
$pageId = isset($_GET['page'])?$_GET['page']:1;
$uid = isset($_GET['uid'])?$_GET['uid']:1;
$re = new Discovery();
$data = $re->presentForHuman($gender,$pageId,$uid);
echo $style->show('200',$data);