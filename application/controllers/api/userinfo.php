<?php
//用户基本信息接口
require_once '../../models/Response.php';
require_once '../..//models/UserProfile.php';
require_once '../../models/UserProfile.php';
$msg = new Response();
$page = isset($_GET['page'])?$_GET['page']:null;
if(isset($_GET['uid'])||$_GET['tel'])
{
	$uid =$_GET['uid'];
	$re = new UserProfile();
	if(isset($_GET['password'])&&isset($_GET['tel']))
	{
		$tel = $_GET['tel'];
		$pwd =md5($_GET['password']);
		$userinfo  = $re->checkAuth($tel, $pwd);//登录验证密码
		if($userinfo ==FALSE)
			echo $msg->show('406');
		else
		{
			$userinfo = $re->userinfo(null,$tel);
			if(!isset($userinfo['nickname']))//首次手机注册用户，初始化名字为手机号
			{
				$data = array('nickname'=>$tel);
				$condition = '`tel`='.$tel;
				$re->updateUserInfo($data,$condition);
			}
			$parentpercent = $re->parentpercent($uid);//父母信息完成比例
			$likeNum = $re->likeNum($uid);//收藏个数
			$data = array('userinfo'=>$userinfo,
					'parentpercent'=>$parentpercent,
					'likeNum'=>$likeNum);
			echo $msg->show('200',$data);
		}
		exit;
	} 
	$userinfo = $re->userinfo($uid,null,$page);//个人信息
	if(!$userinfo)
	{
		echo $msg->show(405);exit;
	}
	$parentpercent = $re->parentpercent($uid);//父母信息完成比例
	$likeNum = $re->likeNum($uid);//收藏个数
	$data = array('userinfo'=>$userinfo,
						  'parentpercent'=>$parentpercent,
						  'likeNum'=>$likeNum);
	
	echo $msg->show('200',$data);
}
else 
{
	//第三方用户信息查询
	if(isset($_GET['usid']))
	{
		$re = new UserProfile();
		$userinfo = $re->userinfo_3($_GET['usid']);
		if($userinfo)
			echo $msg->show('200',$userinfo);
		else 
			echo $msg->show(405);
	}
	else
		echo $msg->show(400);
}
