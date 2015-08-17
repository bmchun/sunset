<?php
//父母基本信息接口
require_once '../../models/Response.php';
require_once '../../models/data/ParentInfo.php';
if(isset($_GET['uid']))
{
	$uid = $_GET['uid'];
	$arr = array('childID'=>$uid);
	$re = new ParentInfo();
	$userinfo = $re->parentinfo_select($arr, 2);//个人信息
	$data = array();
	$r = '';
	while($r = mysql_fetch_assoc($userinfo))
	{
		$data[$r['isMum']==1?'mum':'dad']=$r;
	}
	$msg = new Response();
	echo $msg->show('200',$data);
}