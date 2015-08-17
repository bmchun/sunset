<?php
require_once '../../models/data/UserInfo.php';
require_once '../../models/UserProfile.php';
require_once '../../models/Response.php';
//更换用户头像接口
$response = new Response();
if($_POST['uid']&&$_FILES)
{
	$uid = $_POST['uid'];
	$data = new UserProfile();
	$im = $data->upProfileImage($_FILES, $uid);
	if($im != 400)
		echo $response->show(200,$im);
	else
		echo $response->show(400);
}
else
	echo $response->show(400);