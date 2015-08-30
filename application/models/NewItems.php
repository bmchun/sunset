<?php
require_once  'data/ItemInfo.php';
//首页最新上架商品数据接口
class NewItems{
	
	function __construct()
    {
		//
    }

	function newItems($pageId,$itemNum=null)
	{
		$itemsNum = isset($itemNum)?$itemNum:4; //控制次调用返回的数据数量
		$from = $itemsNum * ($pageId - 1);
		$to = $itemsNum ;
		$limit = ' '.$from.','.$to.' ';// 每页5条数据
		$orderby = '`itemDate` desc';
		$re = ItemInfo::iteminfo_select_ordby(NULL,$orderby,$limit);
		$data = array();
		while($line = mysql_fetch_array($re,MYSQL_ASSOC))
		{
			$data[] = $line; 
		}
		return $data;
	}
	
	function itemsNum()
	{
		return  ItemInfo::itemInfo_count();
	}

}

?>
