<?php
require_once 'data/UserLike.php';

class UserLikeModel
{
	function getUserItems($uid)
	{
		$data = array('userid'=>$uid);
		$re = UserLike::userlike_select($data,1);
		$line = mysql_fetch_array($re,MYSQL_ASSOC);
		$items = array_filter(explode(',', $line['items']));
		return $items;
	}
	
	function checkUserLike($uid,$itemID)
	{
		if(0==$uid)
			return "0";
		$items = self::getUserItems($uid);
		if(in_array($itemID, $items))
			return "1";
		else
			return "0";
	}
	
	function itemLikeSum($itemID)
	{
		$re = UserLike::userlike_sum($itemID);
		$line = mysql_fetch_array($re);
		$data = array('id'=>$itemID);
		$re2 = mysql_fetch_array(ItemInfo::ItemInfo_select($data,1));
		$water = $re2['stockNum'];//加水收藏
		$sum = $line[0]+$water;
		return $sum;
	}
}