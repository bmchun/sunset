<?php
require_once  'data/ItemInfo.php';
require_once 'UserLike.php';
//发现页面
class Discovery{
	
	function __construct()
    {
        //
    }
	//gender = 1 送爸爸 
	//gender = 0  送妈妈
	function presentForHuman($gender,$type=0,$pageId = 1,$uid=0)
	{
		$itemsNum = 6; //控制次调用返回的数据数量
		$from = $itemsNum * ($pageId - 1);
		$to = $itemsNum;
		$limit = ' '.$from.','.$to.' ';// 数据
		$like = new UserLikeModel();
		if($gender == NULL)
		{
			if($type==0)
				$arr = array("isRecommend"=>1);
			else 
				$arr = array("isRecommend"=>1,"type"=>$type);
			$orderby = 'itemDate';
			$re = ItemInfo::iteminfo_select_ordby($arr,$orderby,$limit);
			$data = array();
			while($line = mysql_fetch_array($re,MYSQL_ASSOC))
			{
				$line['islike'] = $like->checkUserLike($uid,$line['id']);
				$line['likesum'] = $like->itemLikeSum($line['id']);
				$data[] = $line;
			}
			return $data;
		}
		if($type==0)
			$arr = array("isRecommend"=>1,"itemGender"=>$gender);
		else
			$arr = array("itemGender"=>$gender,'type'=>$type,"isRecommend"=>1);
		$orderby = 'itemDate';
		$re = ItemInfo::iteminfo_select_ordby($arr,$orderby,$limit);

		$data = array();
		while($line = mysql_fetch_array($re,MYSQL_ASSOC))
		{
			$line['islike'] = $like->checkUserLike($uid,$line['id']);
			$line['likesum'] = $like->itemLikeSum($line['id']);
			$data[] = $line; 
		}
		return $data;
	}
	
	function presentForHuman2($pageId = 1)
	{
		$itemsNum = 4; //控制次调用返回的数据数量
		$from = $itemsNum * ($pageId - 1);
		$to = $itemsNum * $pageId -1 ;
		$limit = ' '.$from.','.$to.' ';// 每页5条数据
		$arr = array("isRecommend"=>1);
		$orderby = 'itemDate';
		$re = ItemInfo::iteminfo_select_ordby($arr,$orderby,$limit);
	
		$data = array();
		while($line = mysql_fetch_array($re,MYSQL_ASSOC))
		{
			$data[] = $line;
		}
		return $data;
	}
	
	function numForHuman($gender=0)
	{
		$re = ItemInfo::iteminfo_select_count($gender);
		$line = mysql_fetch_row($re);
		return $line[0] ;
	}

}

?>

