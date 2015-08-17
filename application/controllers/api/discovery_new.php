<?php
//发现页面数据调用接口
require_once '../../models/Response.php';
require_once '../..//models/Discovery.php';

$style = new Response();
//$gender = isset($_GET['gender'])?$_GET['gender']:0;
$pageId = isset($_GET['pageId'])?$_GET['pageId']:1;
$re = new Discovery();
$data = $re->presentForHuman2($pageId);
echo $style->show('200',$data);