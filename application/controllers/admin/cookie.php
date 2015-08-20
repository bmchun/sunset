<?php
function ck()
{
	session_start();
	if($_POST)
	{
		$o = new AdminCheck();
		$o->set($_POST['email'],$_POST['password']);
		if($o->check())
		{
			$re = setcookie('admin','1') ;
		}
		else
			header('Location: login.php');
	}
	elseif($_COOKIE['admin'])
		header('Location: login.php');
	else
		header('Location: login.php');
}
?>