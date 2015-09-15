<?php
require_once  'data/KeyWord.php';

//热词列表展示接口
class HotKeys {
	
	function __construct()
    {
    	//
    }
	function showKey()
	{
		$re = KeyWord::keyword_select(null,0);
		$data = array();
		while($line = mysql_fetch_array($re,MYSQL_ASSOC))
		{
			$data[] = $line; 
		}
		return $data;
	}
	
	function hotkeyDel($id)
	{
		$con = '`id`= '.$id;
		$re = KeyWord::keyword_delete($con);
		return $re;
	}
	
	function hotkeyAdd($key)
	{
		$arr = array('');
		$su = new KeyWord();
		$orderby = '`id` desc';
		$limit =1;
		$data = mysql_fetch_assoc($su->keyword_select_oderby($orderby));
		$id = $data['id']+1;//取id号命名热词
		$arr = array('id'=>$id,'keyword'=>$key);
		$re = KeyWord::keyword_insert($arr);
		return $re;
	}
}

?>