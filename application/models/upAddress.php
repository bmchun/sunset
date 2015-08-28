<?php
require_once  'data/UserInfo.php';
require_once 'data/ParentInfo.php';
//增加个人地址接口
class UpAddress {
	
	function __construct()
    {
      //
    }

	function upAddress($data = array(),$uid,$isParent=0,$isMum=1)
	{
		//$condition = '`childID`='.$uid;
		$se_uid = array('uid'=>$uid);
		$arr = array('childID' => $uid,'isMum' => $isMum );
		//$p = ($isMum = 1 ? "母":"父");
		if(!$isParent)//更新个人
		{
			if(mysql_fetch_array(UserInfo::userinfo_select($se_uid,1)))
			{
				$condition = '`uid`='.$uid;
				$re = UserInfo::userinfo_update($data,$condition);
				if($re)
					return mysql_fetch_array(UserInfo::userinfo_select($se_uid,1),MYSQL_ASSOC);
				else
					return 400;
			}
			else
				return 400;
		}
		else//更新父母
		{
			if(ParentInfo::parentinfo_select_affect($arr,1))
			{
				$data['childID'] = $uid ;
				$data['isMum'] = $isMum ;
				$condition = '`childID`='.$uid.' AND `isMum`='.$isMum;
				$re = ParentInfo::parentinfo_update($data,$condition);
				if($re)
					return mysql_fetch_array(ParentInfo::parentinfo_select($arr,1),MYSQL_ASSOC);
				else
					return 400;
			}
			else//不存在信息就插入
			{
				$data['childID'] = $uid ;
				$data['isMum'] = $isMum ;
				$re = ParentInfo::parentinfo_insert($data);
				if($re)
					return mysql_fetch_array(ParentInfo::parentinfo_select($arr,1),MYSQL_ASSOC);
				else
					return 400;
			}				
		}		
	}

}

?>