<?php 
require_once  '../../sms.php';

$re = new Sms();
$tel = 15911122086;
$nickname = '22的用户';
$uri = 'http://localhost/application/controllers/api/setuserinfo.php';
echo strlen(md5($tel));
$data['data'] =array(
			'uid'=>md5($tel),
			'tel'=>$tel,
			'nickname'=>$nickname
			);
print_r($re->postFn($data, $uri));
		

?>