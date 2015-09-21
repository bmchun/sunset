<?php
error_reporting(0);
require_once '../models/data/ItemInfo.php';

$obj = new ItemInfo();
$arr = array(); 
$ids = array();
$r = $obj->ItemInfo_select($arr, 1000);
while($re = mysql_fetch_array($r))
{
	$id = $re['id'];	
	if(isset($re['stockNum']))
		continue;
	$ids[$id]= rand(10, 50);
}
foreach ($ids as $id => $water)
{
	$arr = array('stockNum'=>$water);
	$condition = 'id ='.$id;	
	$obj->iteminfo_update($arr, $condition);
}