<?php
require_once ('data/DbConn.php');
class AdminCheck
{
	private $name;
	private $password;
	private $con;
	
	public  function set($name,$password)
	{
		$this->name = $name;
		$this->password = $password;
	}
	//管理员登录校验
	public function check()
	{
		$this->con = DbConn::initDb();
		$table = 'admin';
		$arr = array(
				'name' => $this->name,
				'password' => $this->password
				);
		$str = DbConn::table_select('admin',$arr);
		$result =  mysql_query($str,$this->con);
		return mysql_fetch_array($result);
	}
	
	//管理员增加用户
	public function add()
	{
		$this->con = DbConn::initDb();
		$table = 'admin';
		$arr = array(
				'username' => $this->name,
				'password' => $this->password
		);
		$str = DbConn::table_insert ('admin',$arr);
		$result =  mysql_query($str,$this->con);
		if($result)
			return true;
		else
			return false;
	}
	
}

?>