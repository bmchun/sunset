<?php
require_once '/var/www/git/application/models/NewItems.php';
//获取商品信息为空的
$items = new NewItems();
$it = new ItemInfo();
$string  = '`end_time` is  NOT NULL';
$limit =1000;
$result = $it->iteminfo_select_like($string, $limit);
while($r = mysql_fetch_array($result,true))
{
	$endTime= substr($r['end_time'], -10);//获取字符串
	if(time()>=$endTime)
	{
		$items->itemDel($r['id']);
	}
}
