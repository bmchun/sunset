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
		$itemsNum = isset($itemNum)?$itemNum:6; //控制次调用返回的数据数量
		$from = $itemsNum * ($pageId - 1);
		$to = $itemsNum ;
		$limit = ' '.$from.','.$to.' ';
		$orderby = 'auto_id';
		$arr = array('isTop'=>0);
		
		//第一页加上置顶内容
		if($pageId==1)
		{
			$arr_top = array('isTop'=>1);
			$re1 = ItemInfo::iteminfo_select_ordby($arr_top,$orderby,null);
			$re2 = ItemInfo::iteminfo_select_ordby($arr,$orderby,$limit);
			$data = array();
			$like = new UserLikeModel();
			while($line = mysql_fetch_array($re1,MYSQL_ASSOC))
			{
				$line['islike'] = $like->checkUserLike($uid,$line['id']);
				$line['likesum'] = $like->itemLikeSum($line['id']);
				$data[] = $line;
			}
			while($line = mysql_fetch_array($re2,MYSQL_ASSOC))
			{
				$line['islike'] = $like->checkUserLike($uid,$line['id']);
				$line['likesum'] = $like->itemLikeSum($line['id']);
				$data[] = $line;
			}
			return $data;
		}
		else 
		{
			$re = ItemInfo::iteminfo_select_ordby($arr,$orderby,$limit);
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
	}
	
	function itemsNum()
	{
		return  ItemInfo::itemInfo_count();
	}
	
	function itemDel($id)
	{
		$su = new ItemInfo();
		$condition = '`id`='.$id;
		$r = $su->item_delete($condition);
	}
	function itemUpdate($id,$data=array())
	{
		$su = new ItemInfo();
		$condition = '`id`='.$id;
		$r = $su->iteminfo_update($data,$condition);
		return mysql_fetch_assoc($r);
	}

}

?>
