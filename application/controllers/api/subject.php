<?php
require_once '../../models/subjectview.php';
require_once '../../models/Response.php';
//活动专题接口
$res = new Response();
if(isset($_GET['page']))
	$page = $_GET['page'];
else
{
	echo $res->show(400);
	exit;
}
$re = new SubjectView();
$data = $re->subject($page);
echo $res->show(200,$data);
