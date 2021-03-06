<?php
require_once  'data/ItemInfo.php';
require_once  'data/UserLike.php';
error_reporting(0);
//商品详情页
class ItemsProfile {
	
	function __construct()
    {
        //
    }

//物品详情
	function itemsProfile($itemID,$uid=null)
	{
		$arr = array('id'=>$itemID);
		$re = ItemInfo::iteminfo_select($arr,$limit);
		$data = array();
		while($line = mysql_fetch_array($re,MYSQL_ASSOC))
		{		
			$line['relatedItems'] = self::relatedItems($itemID,$uid);
			if(isset($uid))
				$line['isFavorite'] = self::isFavorite($itemID, $uid);
			else
				$line['isFavorite'] = null;
			$data[] = $line; 
		}
		return $data;
	}

//相关物品推荐
//该字段默认以 “,” 分隔存储物品ID
//返回的数据格式key代表物品ID，value为信息。
	function relatedItems($itemID,$pageId,$uid = null)
	{
		$arr = array('id'=>$itemID);
		$re = ItemInfo::iteminfo_select($arr,$limit);
		$data = array();
		$line = mysql_fetch_array($re,MYSQL_ASSOC);
		$items = $line['relatedItems']; 
		if(!empty($items))
		{
			$ids = explode(",", $items);
			$data = array();
			foreach($ids as $key => $value)
			{
				//取字段，分隔处理....
				$arr = array('id'=>$itemID);
				$itemsNum = 5; //控制次调用返回的数据数量$itemsNum-1个
				$from = $itemsNum * ($pageId - 1);
				$to = $itemsNum * $pageId -1 ;
				$limit = ' '.$from.','.$to.' ';// 每页4条数据
				$re = ItemInfo::iteminfo_select($arr,$limit);
				while($line = mysql_fetch_array($re,MYSQL_ASSOC))
				{
					$favorite = self::isFavorite($itemID, $uid);
					$data[] = array($value=>array('itemName'=>$line['itemName'],
											  'itemPrice'=>$line['itemPrice'],
											  'itemPic'=>$line['itemPic'],
											  'isFavorite'=>$favorite
												));
				}
			}
		}
		return $data;	
	}
	
	//是否喜欢
	function isFavorite($itemId,$uid)
	{
		$arr = array('userid' => $uid);
		$re = UserLike::userlike_select($arr,$limit);
		$line = mysql_fetch_array($re,MYSQL_ASSOC);
		$items = explode(',',$line['items']);
		$re = in_array($itemId,$items);
		return $re;	
	}

}

?>
