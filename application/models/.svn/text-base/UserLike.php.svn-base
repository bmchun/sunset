<?php
require_once 'data/UserLike.php';

class UserLikeModel
{
	function getUserItems($uid)
	{
		$data = array('userid'=>$uid);
		$re = UserLike::userlike_select($data,1);
		$line = mysql_fetch_array($re,MYSQL_ASSOC);
		$items = explode(',', $line['items']);
		return $items;
	}
}