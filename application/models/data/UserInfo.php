<?php
require_once  'DbConn.php';
class UserInfo
{
	private $con ;

	function __construct()
	{
	}


	function userinfo_select($arr,$limit)
	{
		$str = DbConn::table_select('userinfo',$arr,$limit);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}
	
	function userinfo_orderby_select($orderby,$limit)
	{
		$str = DbConn::table_select_ordby('userinfo',null,$orderby,$limit);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}

	function userinfo_insert($arr)
	{
		$str = DbConn::table_insert('userinfo',$arr);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}

	function userinfo_update($arr,$condition)
	{
		$str = DbConn::table_update('userinfo',$arr,$condition);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}

	function userinfo_delete($condition)
	{
		$str = DbConn::table_delete('userinfo',$condition);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}

}

?>