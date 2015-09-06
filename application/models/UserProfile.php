<?php
require_once  'data/UserInfo.php';
require_once 'data/UserLike.php';
require_once 'data/ParentInfo.php';
error_reporting(0);
//个人页面
class UserProfile {
	
	function __construct()
    {
       //
    }
    
    function checkAuth($tel,$password)
    {
    		$array = array('tel'=>$tel);
    		$limit =1;
    		$re = UserInfo::userinfo_select($array,$limit);
    		$selfinfo = mysql_fetch_array($re,MYSQL_ASSOC);
    		if($password == $selfinfo['password'])
    			return  true;
    		else
    			return false;
    }
	//获取个人信息
	function userinfo($uid,$tel=null)
	{
		$arr = isset($tel)?array("tel"=>$tel):array("uid"=>$uid);
		$limit = 1;
		$re = UserInfo::userinfo_select($arr,$limit);
		$selfinfo = mysql_fetch_array($re,MYSQL_ASSOC);
		$a = array('nickname','image','gender','provice');
		$count = 0;
		foreach($selfinfo as $key => $value)
		{
			if(in_array($key,$a))
			{
					if(isset($value))
						$count++;
			}
		}
		$selfinfo['percent'] = floor($count/4 *100);
		return $selfinfo;
	}
	//获取第三方个人信息
	function userinfo_3($usid,$tel=null)
	{
		$arr = isset($tel)?array("tel"=>$tel):array("usid"=>$usid);
		$limit = 1;
		$re = UserInfo::userinfo_select($arr,$limit);
		$selfinfo = mysql_fetch_array($re,MYSQL_ASSOC);
		return $selfinfo;
	}

	//获取父母信息
	function parentinfo($uid)
	{
		$arr = array("childID" =>$uid);
		$re = ParentInfo::parentinfo_select($arr,2);
		$parent = array();
		while($line = mysql_fetch_array($re,MYSQL_ASSOC))
		{
			($line['isMum'] == 1) ? ($parent['mum'] = $line):($parent['dad'] = $line); 
		}

		return $parent;
	}

	//父母信息完成度计算方法
	//固定行信息为3个，全部填写的信息为7。
	function percent($arr = array())
	{
		$cot =0;
		foreach($arr as $key =>$value)
		{
			if($value!=null)
				$cot++;
		}		
		return (count($arr) - 3 > 0)?floor((($cot-3)/ 7 * 100)) : 0;
	}
	
	function parentpercent($uid)
	{
		$re = self::parentinfo($uid);
		$data = array();
		if(isset($re))
		{
			$data['mum'] = self::percent($re['mum'])."%";
			$data['dad'] = self::percent($re['dad'])."%";
			return $data;
		}
		else
			return array('mum'=>'0%','dad'=>'0%');
	}

	//处理上传的头像
	function upProfileImage($file,$uid)
	{
		$image_path  = $_SERVER['DOCUMENT_ROOT'].'/upload/';
		$ext = explode('.', $file['file']['name']);
		$file['file']['name'] = $uid.'.'.$ext[1];

		if ((($file['file']["type"] == "image/jpg")|| ($file['file']["type"] == "image/jpeg")|| ($file['file']["type"] == "image/pjpeg"))&& ($file['file']["size"] < 200000))
		{
	  		if ($file['file']["error"] > 0)
	    		{
	    			echo $file['file']["error"] . "<br />";
	    		}
	  		else
	    		{
	    			move_uploaded_file($file['file']["tmp_name"],$image_path.$file['file']["name"]);
	    			$condition = 'uid='.$uid;
	    			$_SERVER['HTTP_ORIGIN'] = isset($_SERVER['HTTP_ORIGIN'])?$_SERVER['HTTP_ORIGIN']:'http://120.25.250.200/';
	    			$image_url_path = $_SERVER['HTTP_ORIGIN'].'/upload/';
	    			$set = array('image'=>$image_url_path.$file['file']["name"]);
	    			UserInfo::userinfo_update($set,$condition);
	      		return $image_url_path.$file['file']["name"];
	    		}
	 	}
		else
	  		return 400;
	}
	//收藏数
	function  likeNum($uid)
	{
		$arr = array('userid'=>$uid);
		$limit =1 ;
		$re = new UserLike();
		$data = $re->userlike_select($arr, $limit);
		$line = mysql_fetch_array($data,MYSQL_ASSOC);
		$items = explode(',', $line['items']);
		return count($items);
	}
	
	function setUserInfo($uid,$data)
	{
		$re = new UserInfo();
		return mysql_fetch_row($re->userinfo_insert($data));
	}
}

?>
