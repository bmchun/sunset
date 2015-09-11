<?php
require_once  'data/ItemInfo.php';
require_once 'UserLike.php';
//首页最新上架商品数据接口
class NewItems{
	
	function __construct()
    {
		//
    }

	function newItems($pageId,$itemNum=null,$uid=0)
	{
		$itemsNum = isset($itemNum)?$itemNum:4; //控制次调用返回的数据数量
		$from = $itemsNum * ($pageId - 1);
		$to = $itemsNum ;
		$limit = ' '.$from.','.$to.' ';// 每页5条数据
		$orderby = '`itemDate` desc';
		$re = ItemInfo::iteminfo_select_ordby(NULL,$orderby,$limit);
		$data = array();
		$like = new UserLikeModel();
		while($line = mysql_fetch_array($re,MYSQL_ASSOC))
		{
			$line['islike'] = $like->checkUserLike($uid,$line['id']);
			$line['likesum'] = $like->itemLikeSum($line['id']);
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
