<?php
error_reporting(0);
require_once '../../../models/HotKeys.php';
require_once '../../../models/Response.php';

$re = new Response();
$hotkey  = $_POST['key'];
if(isset($hotkey))
{
	$a = new HotKeys();
	if($a->hotkeyAdd($hotkey))
		header('Location:'.$_SERVER['HTTP_REFERER']);
	else 
		echo $re->show(400);
}
else
	echo $re->show(400);