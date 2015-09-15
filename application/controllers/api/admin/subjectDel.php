<?php
error_reporting(0);
require_once '../../../models/subjectview.php';
$id = $_GET['id'];
if(!isset($id))
	header('Location:'.$_SERVER['HTTP_REFERER']);
$re = new SubjectView();
$re->delSubject($id);
?>