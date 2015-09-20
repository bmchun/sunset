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
	
	function addSubject($name,$file,$url)
	{
		$arr = array('');
		$su = new Subject();
		$orderby = '`id` desc';
		$limit =1;
		$data = mysql_fetch_assoc($su->subject_select_ordby(null, $orderby, $limit));
		$id = $data['id']+1;//取id号命名图片
			$image_path  = $_SERVER['DOCUMENT_ROOT'].'/img/subject/';
			$ext = explode('.', $file['subjectImage']['name']);
			//取下一个插入的值
			$file['subjectImage']['name'] = $id.'.'.$ext[1];
			if ((($file['subjectImage']["type"] == "image/jpg")|| ($file['subjectImage']["type"] == "image/jpeg")|| ($file['subjectImage']["type"] == "image/pjpeg"))&& ($file['subjectImage']["size"] < 200000))
			{
				if ($file['subjectImage']["error"] > 0)
				{
					echo $file['subjectImage']["error"] . "<br />";
				}
				else
				{
					move_uploaded_file($file['subjectImage']["tmp_name"],$image_path.$file['subjectImage']["name"]);
					$_SERVER['HTTP_ORIGIN'] = isset($_SERVER['HTTP_ORIGIN'])?$_SERVER['HTTP_ORIGIN']:'http://120.25.250.200/';
					$image_url_path = $_SERVER['HTTP_ORIGIN'].'/img/subject/';
					$set = array('subjectURL'=>$url,
										'subjectName' =>$name,
										'subjectPic' =>$image_url_path.$file['subjectImage']["name"],
										'subjectTime'=>date('Y-m-d h:i:s')
							);
					$status = $su->subject_insert($set);
					return $status;
				}
			}
			else
				return 400;
		}
		
		function delSubject($id)
		{
			$su = new Subject();
			$condition = '`id`='.$id;
			$r = $su->subject_delete($condition);
			header('Location:'.$_SERVER['HTTP_REFERER']);
		}

}
