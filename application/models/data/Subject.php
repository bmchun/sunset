<?php
require_once 'DbConn.php';
class Subject {
	private $con ;	
	function __construct()
    {
		//
    }
 
	function subject_select($arr,$limit)
	{
		$str = DbConn::table_select('Subject',$arr,$limit);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}
	
	function subject_select_like($string,$limit)
	{
		$str = DbConn::table_like_select('subject',$string,$limit);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}

	function subject_select_ordby($arr,$orderby,$limit)
	{
		$str = DbConn::table_select_ordby('subject',$arr,$orderby,$limit);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}
	
	function subject_select_count($gender)
	{
		$arr = array('itemGender' => $gender);
		$str = DbConn::table_select_count('subject',$arr);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}

	function subject_insert($arr)
	{
		$str = DbConn::table_insert('subject',$arr);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}

	function subject_update($arr,$condition)
	{
		$str = DbConn::table_insert('subject',$arr,$condition);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}

	function subject_delete($condition)
	{
		$str = DbConn::table_delete('subject',$condition);
		$this->con = DbConn::initDb();
		return mysql_query($str,$this->con);
	}

}

?>