<?php
require_once '../../models/upAddress.php';
require_once '../../models/Response.php';
require_once 'token.php';

$debug = 1;//打印日志开关
if($debug)
{
	$fp = fopen('./log','w+');
	fwrite($fp,json_encode($_POST)."\n");
	fclose($fp);
}
//增加用户个人信息
$res = new Response();
if(isset($_POST['data']))
{
	$arr = $_POST['data'];
	$arr_select = array('uid'=>$arr['uid']);
	//$arr['uid'] = md5($arr['tel']);
	$arr['password'] = md5($arr['password']);
	$arr['registerDate'] = date("Y/m/d");
	$condition = isset($arr['tel'])?('tel=\''.$arr['tel'].'\''):('uid=\''.$arr['uid'].'\'');
	$setUser = new UserInfo();
	$re_select = $setUser->userinfo_select($arr_select,1);
	//如果已经存在的用户，更新资料
	if(mysql_fetch_row($re_select))
	{
		$arr['gender']=isset($arr['gender'])?$arr['gender']:0;
		$arr['age']=isset($arr['age'])?$arr['age']:0;
		$arr['idCard']=isset($arr['idCard'])?$arr['idCard']:'';
		$arr['realName']=isset($arr['realName'])?$arr['realName']:'';
		$checkArr = array('uid'=>$arr['uid']);
		//找回密码，要验证token
		if(isset($arr['token']) )
		{
			$token = $arr['token'];
			if(checkToken($arr['tel'],$token)==200)
			{
					unset($arr['token']);
					$re = $setUser->userinfo_update($arr, $condition);
					if($re==1)
						echo $res->show(200,mysql_fetch_assoc($setUser->userinfo_select($arr_select,1)));
					else
						echo $res->show(401);
						exit;
			}
			else
			{
				echo $res->show(402);exit;
			}
			
		}
		//更新个人信息
		$r = $setUser->userinfo_select($checkArr, 1);
		if(!mysql_fetch_assoc($r))
		{
			echo $res->show(403);exit;
		}
		$re = $setUser->userinfo_update($arr, $condition);
		if($re==1)
			echo $res->show(200,mysql_fetch_assoc($setUser->userinfo_select($arr_select,1)));
		else
			echo $res->show(401);
		exit;
	}
	//不存在的用户，新创建
	if(isset($arr['token']))
	{
		$token = $arr['token'];
		if(checkToken($arr['tel'],$token)==200)
		{
			unset($arr['token']);
			$re = $setUser->userinfo_insert($arr);
			if($re ==1)
				echo $res->show(200,mysql_fetch_assoc($setUser->userinfo_select($arr_select,1)));
		}
		else
			echo $res->show(402);
	}
	//第三方注册
	elseif(isset($arr['usid']))
	{
		$arr['nickname'] = $arr['userName'];
		$arr_select = array('usid'=>$arr['usid']);
		//$setUser->userinfo_select($arr_select,1);
		$re = $setUser->userinfo_insert($arr);
		if($re ==1)
			echo $res->show(200,mysql_fetch_assoc($setUser->userinfo_select($arr_select,1)));
		else
			echo $res->show(401);
	}
	else 
			echo $res->show(404);
}
else
		echo $res->show(400);

