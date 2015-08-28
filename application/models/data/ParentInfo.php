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
		$str = DbConn::table_select('parentinfo',$arr,$limit);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}
	
	function parentinfo_select_affect($arr,$limit)
	{
		$str = DbConn::table_select('parentinfo',$arr,$limit);
		$this->con = DbConn::initDb();
		 mysql_query($str,$this->con);
		 return mysql_affected_rows($this->con);
	}

	function parentinfo_insert($arr)
	{
		$str = DbConn::table_insert('parentinfo',$arr);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}

	function parentinfo_update($arr,$condition)
	{
		$str = DbConn::table_update('parentinfo',$arr,$condition);
		$this->con = DbConn::initDb();
		echo $str;
		return mysql_query($str,$this->con);
	}

	function table_delete($condition)
	{
		$str = DbConn::table_insert('parentinfo',$condition);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}

}

?>