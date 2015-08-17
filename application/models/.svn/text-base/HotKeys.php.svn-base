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
}

?>