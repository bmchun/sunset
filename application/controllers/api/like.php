<?php
require_once '../../models/UserLike.php';
require_once '../../models/Response.php';
require_once  '../../models/data/ItemInfo.php';

//收藏、取消收藏接口
//$islike =1  收藏  $islike=0 取消收藏
$res = new Response();
$ul = new UserLike();
if(isset($_POST['islike'])&&isset($_POST['uid'])&&isset($_POST['itemID']))
{
	$islike = $_POST['islike'];
	$uid = $_POST['uid'];
	$itemid = $_POST['itemID'];
	if(1 == $islike) //喜欢流程
	{
		$arr = array('userid'=>$uid);
		$limit =1;
		$re = mysql_fetch_assoc($ul->userlike_select($arr, $limit));
		$like_arr_items =explode(',', $re['items']);
		if($re)//存在用户则插入字符串
		{
			if(in_array($itemid, $like_arr_items))//如果已经喜欢过，跳过
			{
				echo $res->show(200);exit;
			}
			$arr = array('items'=>$re['items'].','.$itemid);
			$condition = '`userid`='.$uid;
			$re = $ul->userlike_update($arr, $condition);
			if($re)
				echo $res->show(200);
			else
				echo $res->show(500);
		}
		else  //不存在插入喜欢数据
		{
			$arr = array('items'=>$itemid,
								'userid' =>$uid);
			$re = $ul->userlike_insert($arr);
			if($re)
				echo $res->show(200);
			else
				echo $res->show(500);
		}
	}
	else//取消喜欢流程
	{
		$arr = array('userid'=>$uid);
		$limit =1;
		$re = mysql_fetch_assoc($ul->userlike_select($arr, $limit));
		$like_arr_items =explode(',', $re['items']);
		if(is_numeric(array_search($itemid,$like_arr_items)))
		{
			$k = array_search($itemid,$like_arr_items);
			unset($like_arr_items[$k]);
			$arr2 = array('userid'=>$uid,
								'items'=>implode(',',$like_arr_items));
			$r = $ul->userlike_update($arr2, '`userid`='.$uid);
			if($r)
				echo $res->show(200);
			else
				echo $res->show(500);
		}
		else 
			echo $res->show(200);
	}
	exit;
}
elseif(isset($_POST['uid'])&&isset($_POST['page']))//获取喜欢列表，分页加载
{
	$uid = $_POST['uid'];
	$page = $_POST['page']<0?1:$_POST['page'];
	$arr = array('userid'=>$uid);
	$re = mysql_fetch_assoc($ul->userlike_select($arr, 1));
	$items_id_arr = explode(',', $re['items']);
	$data = array();
	$ii = new ItemInfo();
	for($i=($page-1);$i<$page+4;$i++)
	{
		if($items_id_arr[$i])
		{
			$item_id = $items_id_arr[$i];
			$arr_item = array('id'=>$item_id);
			$tmp=mysql_fetch_assoc($ii->ItemInfo_select($arr_item, 1));
			if($tmp==false)
				continue;
			$data[] = $tmp;
		}
	}
	echo $res->show(200,$data);
}
else
	echo $res->show(400);

?>