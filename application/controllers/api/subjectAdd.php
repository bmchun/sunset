<?php
require_once '../../models/subjectview.php';
require_once '../../models/Response.php';

$re = new Response();
$name  = $_POST['subjectName'];
$file = $_FILES;
$url = $_POST['subjectUrl'];
if(isset($name)&&isset($file)&isset($url))
{
	$a = new SubjectView();
	if($a->addSubject($name, $file, $url))
		$re->show(200);
	else 
		$re->show(400);
}
else
	$re->show(400);