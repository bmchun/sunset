<?php
error_reporting(0);
require_once '../../../models/subjectview.php';
require_once '../../../models/Response.php';

$re = new Response();
$name  = $_POST['subjectName'];
$file = $_FILES;
$url = $_POST['subjectUrl'];
if(isset($name)&&isset($file)&isset($url))
{
	$a = new SubjectView();
	if($a->addSubject($name, $file, $url))
		header('Location:'.$_SERVER['HTTP_REFERER']);
	else 
		echo $re->show(400);
}
else
	echo $re->show(400);