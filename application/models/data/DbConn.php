<?php
class DbConn {
	
	function __construct()
    {
        //
    }
	private $host;
	private $port;
	private $user;
	private $passwd;
	private $dbname;
	
	/*
	 *	初始化数据库连接
	 */
	function initDb()
	{
		/*
		 设置当前使用的DB
		Product 生产
		Develop 开发
		*/
		//define("ENV","Product");
		$db_conf = parse_ini_file('db.ini',true);
		if($_SERVER['HTTP_HOST'] =='localhost')
		{
			$this->host = $db_conf['Dev']['host'];
			$this->port = $db_conf['Dev']['port'];
			$this->user = $db_conf['Dev']['user'];
			$this->passwd = $db_conf['Dev']['password'];
			$this->dbname = $db_conf['Dev']['dbname'];
		}
		else 
		{
			$this->host = $db_conf['Product']['host'];
			$this->port = $db_conf['Product']['port'];
			$this->user = $db_conf['Product']['user'];
			$this->passwd = $db_conf['Product']['password'];
			$this->dbname = $db_conf['Product']['dbname'];
		}

		try{
			$con = mysql_connect($this->host.':'.$this->port,$this->user,$this->passwd);
			mysql_select_db($this->dbname, $con);
			mysql_query("set names 'utf8'");
		}catch (Exception $e) {   
			print $e->getMessage();   
			exit(); 
		}
		return $con;   
	}

	/*
	 	查询通用方法
	 	$table 表名
	 	$arr 数组结构 字段=>值;
		$limit 限制字段  1、0,10 后续扩展分页 
		返回：sql字符串
	 */

	function table_select($table,$arr =array(),$limit =1 )
	{
		if(!empty($arr))
		{
			$string = null; 
			foreach($arr as $key => $value)
			{
				$string .= '`'.$key.'`'."="."'$value'".' AND ';
			}
			$string = trim($string,"AND ");
			if(isset($limit))
				$str = 'SELECT * FROM `'.$table.'` where '.$string.' LIMIT '.$limit.';';
			else
				$str = 'SELECT * FROM `'.$table.'` where '.$string.' ;';
		}
		else
			$str = 'SELECT * FROM `'.$table.'` ;';	
		//echo $str;
		return $str;
	}
	/*
	 *  查询获取喜欢总数
	 */

	function table_select_like_sum($table,$string)
	{
				$str = 'SELECT count(*)  FROM `'.$table.'` where '.$string;
				return $str;
	}
	
	/*
	 	查询排序方法
	 	$table 表名
	 	$arr 数组结构 字段=>值;
	 	$orderby 排序规则
		$limit 限制字段  1、0,10 后续扩展分页 
		返回：sql字符串
	 */

	function table_select_ordby($table,$arr=array(),$orderby,$limit)
	{
		if(!empty($arr))
		{
			$string = null; 
			foreach($arr as $key => $value)
			{
				$string .= '`'.$key.'`'."="."'$value'".' AND ';
			}
			$string = trim($string,"AND ");
			if(isset($limit) && empty($orderby))
				$str = 'SELECT * FROM `'.$table.'` WHERE '.$string.' LIMIT '.$limit.';';
			elseif(isset($limit) && isset($orderby))
				$str = 'SELECT * FROM `'.$table.'` WHERE '.$string.' ORDER BY `'.$orderby.'` desc LIMIT '.$limit.';';
			elseif(isset($limit) && isset($orderby))
				$str = 'SELECT * FROM `'.$table.'` WHERE '.$string.' ORDER BY `'.$orderby.'` desc LIMIT '.$limit.';';
			elseif(isset($string))
				$str = 'SELECT * FROM `'.$table.'  ORDER BY `'.$orderby.'` desc LIMIT '.$limit.';';
			else
				$str = 'SELECT * FROM `'.$table.'` WHERE '.$string.' ;';
		}
		else
			$str = $str = 'SELECT * FROM `'.$table.'` ORDER BY '.$orderby.' LIMIT '.$limit.';';
		return $str;
	}

	/*
	 查询总数方法
	$table 表名
	$arr 数组结构 字段=>值;
	$orderby 排序规则
	$limit 限制字段  1、0,10 后续扩展分页
	返回：sql字符串
	*/
	
	function table_select_count($table,$arr=array())
	{
		if(!empty($arr))
		{
			$string = null;
			foreach($arr as $key => $value)
			{
				$string .= '`'.$key.'`'."="."'$value'".' AND ';
			}
			$string = trim($string,"AND ");
			$str = 'SELECT COUNT(*) FROM `'.$table.'` WHERE '.$string.' ;';
		}
		else
			$str = $str = 'SELECT COUNT(*) FROM `'.$table.'`;';
		return $str;
	}
	
	/*
	 	插表通用方法
	 	$table 表名
	 	$arr 数组结构 字段=>值;
		返回：sql字符串
	 */

	function table_insert($table,$arr)
	{
		if(!empty($table)&&isset($arr))
		{
			$cols = null; 
			$values = null;
			foreach($arr as $key => $value)
			{
				$cols .= '`'.$key.'`'.',';
				$values .= '\''.$value.'\''.',';
			}
			$cols = trim($cols,",");
			$values = trim($values,",");
			$str = 'INSERT INTO '.$table.' ('.$cols.')'.' VALUES ('.$values.');';		
		}
		else
			throw new Exception("Insert table values is missing!", 1);
		return $str;
	}

	function table_insert_import($table,$conls,$values)
	{
		if(!empty($table)&&isset($conls)&&isset($values))
		{
			$str = 'INSERT INTO '.$table.' ('.$conls.')'.' VALUES '.$values;
		}
		else
			throw new Exception("Insert table values is missing!", 1);
		//echo $str."\n";exit;
		return $str;
	}
	/*
	 	改表通用方法
	 	$table 表名
	 	$arr 数组结构 字段=>值;
	 	$condition string where限制条件
		返回：sql字符串
	 */

	function table_update($table,$arr,$condition=null)
	{
		if(!empty($table)&&isset($arr))
		{
			$string = null; 
			foreach($arr as $key => $value)
			{
				$string .= '`'.$key.'`'."="."'$value'".' ,';
			}
			$string = trim($string,",");
			if($condition)
				$str = 'UPDATE '.$table.' SET '.$string.' WHERE '.$condition.' ;';
			else
				$str = 'UPDATE '.$table.' SET '.$string.' ;';			
		}
		else
			throw new Exception("Update table vars is missing!", 1);
//echo $str;exit;
		return $str;
	}

	/*
	 	删表通用方法
	 	$table 表名
	 	$condition string where限制条件
		返回：sql字符串
	 */

	function table_delete($table,$condition=null)
	{
		if(!empty($table)&&isset($condition))
		{
			$string = null; 
			$str = 'DELETE FROM '.$table.' WHERE '.$condition.' ;';
		}
		else
			throw new Exception("Delete table  missed condition!", 1);
		return $str;
	}
	/*
	 模糊查询
	$table 表名
	$arr 数组结构 字段=>值;
	返回：sql字符串
	*/
	
	function table_like_select($table,$string,$limit=1)
	{
		$str = 'SELECT * FROM `'.$table.'` where '.$string.' LIMIT '.$limit.';';
		return $str;
	}
	
	//查询局部字段
	function table_key_select($table,$key,$string,$limit=1)
	{
		$str = 'SELECT '.$key.' FROM `'.$table.'` where '.$string.' LIMIT '.$limit.';';
		return $str;
	}
}

?>
