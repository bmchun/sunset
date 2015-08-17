<?php
require_once '../../models/Token.php';
error_reporting(0);
require_once '../../models/Response.php';
$res = new Response();
if($_GET['tel'] && $_GET['send']==1)
{
	$obj = new Token_SMS();
	$tel = $_GET['tel'];
	$uid = '';
	$obj->__set($uid, $tel);
	$token =  $obj->sendSMS();
}
elseif($_GET['tel'] && isset($_GET['token']))
{
	$token = $_GET['token'];
	$tel = $_GET['tel'];
	$status = checkToken($tel, $token);
	$res->show($status);
	}
else 
	$res->show(400);

//检查验证码与tel对应关系
function checkToken($tel,$token)
{
	$obj = new Token_SMS();
	$uid = '';
	$obj->__set($uid, $tel);
	return  $obj->getToken($tel, $token);
}



/* $obj = new Sms();
 $tel = '15911122086';
$uid = md5($tel);
echo '<br />';
$obj->__set($uid, $tel);
print_r($obj->sendSMS()); */