<?php
require_once 'DbConn.php';
class Token {
	private $con ;	
	function __construct()
    {
		//
    }
 
	function token_select($arr,$limit)
	{
		$str = DbConn::table_select('token',$arr,$limit);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}
	
	function token_select_like($string,$limit)
	{
		$str = DbConn::table_like_select('token',$string,$limit);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}

	function token_select_ordby($arr,$orderby,$limit)
	{
		$str = DbConn::table_select_ordby('token',$arr,$orderby,$limit);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}

	function token_insert($arr)
	{
		$str = DbConn::table_insert('`token`',$arr);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}

	function token_update($arr,$condition)
	{
		$str = DbConn::table_update('token',$arr,$condition);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}

	function token_delete($condition)
	{
		$str = DbConn::table_update('token',$condition);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}

}

?>