<?php
require_once 'DbConn.php';
class UserLike
{
	private $con ;

	function __construct()
	{
	}


	function userlike_select($arr,$limit)
	{
		$str = DbConn::table_select('userlike',$arr,$limit);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}

	function userlike_insert($arr)
	{
		$str = DbConn::table_insert('userlike',$arr);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}

	function userlike_update($arr,$condition)
	{
		$str = DbConn::table_update('userlike',$arr,$condition);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}

	function table_delete($condition)
	{
		$str = DbConn::table_delete('userlike',$condition);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}

}

?>