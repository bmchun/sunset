<?php
require_once  'DbConn.php';
class KeyWord 
{
	private $con ;

	function __construct()
	{
	}


	function keyword_select()
	{
		
		$str = DbConn::table_select('keyword',null);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}

	function keyword_select_oderby($orderby)
	{
	
		$str = DbConn::table_select_ordby('keyword',null,$orderby,1);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}
	
	function keyword_insert($arr)
	{
		$str = DbConn::table_insert('keyword',$arr);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}

	function keyword_update($arr,$condition)
	{
		$str = DbConn::table_insert('keyword',$arr,$condition);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}

	function keyword_delete($condition)
	{
		$str = DbConn::table_delete('keyword',$condition);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}

}

?>