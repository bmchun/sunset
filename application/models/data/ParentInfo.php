<?php
require_once 'DbConn.php';
class ParentInfo
{
	private $con ;

	function __construct()
	{
		$this->con = DbConn::initDb();
	}


	function parentinfo_select($arr,$limit)
	{
		$str = DbConn::table_select('parentInfo',$arr,$limit);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}

	function parentinfo_insert($arr)
	{
		$str = DbConn::table_insert('parentInfo',$arr);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}

	function parentinfo_update($arr,$condition)
	{
		$str = DbConn::table_update('parentInfo',$arr,$condition);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}

	function table_delete($condition)
	{
		$str = DbConn::table_insert('parentInfo',$condition);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}

}

?>