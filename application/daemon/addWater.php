<?php
//error_reporting(0);
require_once '/var/www/git/application/models/data/ItemInfo.php';

$obj = new ItemInfo();
$arr = array(
	'stockNum'=>0	
); 
$ids = array();
$r = $obj->ItemInfo_select($arr, 1000);
while($re = mysql_fetch_array($r))
{
	$id = $re['id'];	
	$ids[$id]= rand(10, 50);
}
foreach ($ids as $id => $water)
{
	$arr = array('stockNum'=>$water);
	$condition = 'id ='.$id;	
	$obj->iteminfo_update($arr, $condition);
}
