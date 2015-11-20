<?php
include 'data/ItemInfo.php';

//搜索列表展示接口

class Search {

	function __construct()
	{
		//
	}
	function search($key,$page,$uid,$n=null)
	{
		$string = "`describe` LIKE '%$key%' ORDER BY `id`";
		if(is_null($n))
		{
			$num =6;
			$limit = ($page-1)*$num;
			$limit .=','.$num;
		}
		else 
		{
			$limit =($page-1)*$n.','.$n; 
		}
		$re = new ItemInfo();
		$data = $re->iteminfo_select_like($string, $limit);
		return $data;
	}
	//搜索范围扩大，后台用
	function search_admin($key,$type,$page)
	{
			$string = "`id` LIKE '%$key%' || `describe` LIKE '%$key%' ORDER BY `id`";
			$num =50;
			$limit = ($page-1)*$num;
			$limit .=','.$num;
		$re = new ItemInfo();
		$data = $re->iteminfo_select_like($string, $limit);
		return $data;
	}
}
