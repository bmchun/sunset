<?php
require_once '../../models/data/UserInfo.php';
require_once '../../models/upAddress.php';
require_once '../../models/Response.php';
//增加地址接口

$response = new Response();
$add = new UpAddress();

//更新个人资料
if(isset($_POST['uid'])&&$_POST['data']&&$_POST['isParent']==0)
{
	$uid =$_POST['uid'];
	$data = $_POST['data'];
	$re = $add->upAddress($data,$uid);
	echo $response->show(200,$re);
}

//更新父母资料
elseif (isset($_POST['uid'])&&$_POST['data']&&$_POST['isParent']==1)
{
	$uid = $_POST['uid'];
	$data = $_POST['data'];
	$isParent = $_POST['isParent'];
	$isMum = $_POST['isMum'];
	$re = $add->upAddress($data,$uid,$isParent,$isMum);
	echo $response->show(200,$re);
}
else
	echo $response->show(400);