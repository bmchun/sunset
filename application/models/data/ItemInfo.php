<?php
require_once 'DbConn.php';
class ItemInfo {
	private $con ;	
	function __construct()
    {
		//
    }
 
	function ItemInfo_select($arr,$limit)
	{
		$str = DbConn::table_select('iteminfo',$arr,$limit);
		$this->con = DbConn::initDb();
		var_dump($str);exit;
		return mysql_query($str,$this->con);
	}
	
	function itemInfo_count($arr=null)
	{
		$str = DbConn::table_select_count('iteminfo',$arr);
		$this->con = DbConn::initDb();
		$re = mysql_query($str,$this->con);
		$data = mysql_fetch_array($re);
		return  $data[0];
	}
	
	function iteminfo_select_like($string,$limit)
	{
		$str = DbConn::table_like_select('iteminfo',$string,$limit);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}
	
	function iteminfo_select_key($key,$string,$limit)
	{
		$str = DbConn::table_key_select('iteminfo',$key,$string,$limit);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}

	function iteminfo_select_ordby($arr,$orderby,$limit)
	{
		$str = DbConn::table_select_ordby('iteminfo',$arr,$orderby,$limit);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}
	
	function iteminfo_select_count($gender)
	{
		$arr = array('itemGender' => $gender);
		$str = DbConn::table_select_count('iteminfo',$arr);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}

	function iteminfo_insert($arr)
	{
		$str = DbConn::table_insert('iteminfo',$arr);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}

	function iteminfo_update($arr,$condition)
	{
		$str = DbConn::table_update('iteminfo',$arr,$condition);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}

	function item_delete($condition)
	{
		$str = DbConn::table_insert('iteminfo',$condition);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}

}

?>