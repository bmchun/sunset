<?php
require_once  'data/Subject.php';
//首页运营列表

class SubjectView{

	function __construct()
	{
		//
	}

	function subject($pageId)
	{
		//后台使用
		if($pageId == 'all')
		{
			$re = Subject::subject_select(NULL,0);
			$data = array();
			while($line = mysql_fetch_array($re,MYSQL_ASSOC))
			{
				$data[] = $line;
			}
			return $data;
		}
		$itemsNum = 4; //控制次调用返回的数据数量
		$from = ($pageId-1)*$itemsNum;
		$to = $itemsNum;
		$limit = ' '.$from.','.$to.' ';// 每页5条数据
		$orderby = '`subjectTime` desc';
		$re = Subject::subject_select_ordby(NULL,$orderby,$limit);
		$data = array();
		while($line = mysql_fetch_array($re,MYSQL_ASSOC))
		{
			$data[] = $line;
		}
		return $data;
	}

}
