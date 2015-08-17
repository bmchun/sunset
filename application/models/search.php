<?php
include 'data/ItemInfo.php';

//搜索列表展示接口

class Search {

	function __construct()
	{
		//
	}
	function search($key,$uid)
	{
		$string = "`itemName` LIKE '%$key%'";
		$re = new ItemInfo();
		$data = $re->iteminfo_select_like($string, 4);
		return $data;
	}
}