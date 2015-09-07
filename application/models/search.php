<?php
include 'data/ItemInfo.php';

//搜索列表展示接口

class Search {

	function __construct()
	{
		//
	}
	function search($key,$page,$uid)
	{
		$string = "`describe` LIKE '%$key%' ORDER BY `id`";
		$limit = ($page-1)*4;
		$limit .=',4';
		$re = new ItemInfo();
		$data = $re->iteminfo_select_like($string, $limit);
		return $data;
	}
}