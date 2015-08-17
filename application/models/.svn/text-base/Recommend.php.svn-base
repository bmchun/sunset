<?php
require_once  'data/ItemInfo.php';
require_once  'UserLike.php';
//首页推荐数据接口
class Recommend{
	
	function __construct()
    {
		//
    }
// uid 用户ID
	function recommend($pageId,$uid=null)
	{
		$itemsNum = 5; //控制次调用返回的数据数量$itemsNum-1个
		$from = $itemsNum * ($pageId - 1);
		$to = $itemsNum * $pageId -1 ;
		$limit = ' '.$from.','.$to.' ';// 每页4条数据
		if(isset($uid))
		{
			$items = UserLikeModel::getUserItems($uid);
			$arr = array('isRecommend'=>1);
			$re = ItemInfo::iteminfo_select($arr,$limit);
			$data = array();
			while($line = mysql_fetch_array($re,MYSQL_ASSOC))
			{
				if(in_array($line['id'], $items))
					$line['isFavorite'] = 1;
				else
					$line['isFavorite'] = 0;
				$data[] = $line;
			}
			return $data;
		}
		else 
		{
			$arr = array('isRecommend'=>1);
			$re = ItemInfo::iteminfo_select($arr,$limit);
			$data = array();
			while($line = mysql_fetch_array($re,MYSQL_ASSOC))
			{
				$line['isFavorite'] = 0;
				$data[] = $line;
			}
			return $data;
		}
	}

}

?>