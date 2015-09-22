<?php
require_once '../models/data/ItemInfo.php';
//获取商品信息为空的
$items = new ItemInfo();
$key = '`id`';
$string  = '`tb_id` is NULL';
$limit =35;
$re = array();
$result = $items->iteminfo_select_key($key,$string, $limit);
while($r = mysql_fetch_array($result,true))
{
	$re[]= $r['id'];//内容为空的数据$re
}

//请求内容

$token = 'mengchun';
$appkey = '23182322';
$secret = '0bfab4f09119f33ebabb8348d314ceeb';
$tb_result = null;
if(!is_null($re))
{
	$ids = implode(',', $re);
	$url = 'http://nuannuangouwu-1.wx.jaeapp.com/?token='.$token.'&appkey='.$appkey.'&secret='.$secret.'&ids='.$ids;
	$ch = curl_init($url) ;
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回
	curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回
	$tb_result = curl_exec($ch) ;
	$tb_result_arr = json_decode($tb_result,true);
	//$tb_result = file_get_contents($url);	
	foreach ($tb_result_arr[items][x_item] as $key => $value)
	{
		$arr = array('tb_id'=>$value['open_iid'],
							'itemPic'=>$value['pic_url'],
							'itemDiscount' =>$value['price'],
							'itemPrice' =>$value['reserve_price'],
							'describe'=>$value['title'],
							'end_time'=>$value['price_end_time']
				);
		$limit = 'id = '.$value['open_id'];
		$items->iteminfo_update($arr,$limit);
	}
}



