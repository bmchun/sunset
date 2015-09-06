<?php
#error_reporting(E_ALL);
## curl -d "zh=nngwtest&mm=123123&hm=15911122086&dxlbid=28&extno=28&nr=\"尊敬的用户，您的验\"码
##为595358，有效期为60秒，如有疑虑请详询400-820-3122（客服电话）【金互行】\"" "http://114.113.101.250:8087/Service.asmx/sendsms"
class Sms
{
	private $uid ;
	private $url;
	private $port;
	private $id;
	private $pwd;
	private $product;
	private $mobile;
	
	function __set($uid,$mobile)
	{
		$this->uid = $uid ;
		$this->url = 'http://114.113.101.250';
		$this->port = '8087';
		$this->id = 'nngwtest';
		$this->pwd = '123123';
		$this->product ='28';
		$this->mobile =$mobile;
	}
	
	function sendSMS()
	{
		$token = self::randToken();
		$data = array (
				'zh' => $this->id,
				'mm'=>$this->pwd,
				'dxlbid'=>$this->product,
				'extno'=>$this->product,
				'hm'=>$this->mobile,
		);
		$data['nr'] ='【暖暖购物】'.$token.'（暖暖购物手机注册验证码，请完成验证），如非本人操作，请忽略本短信。' ;
		//$data['message'] =urlencode('尊敬的用户，您的验证码为'.$token.'【暖暖】') ;
		$status = self::postFn($data, $this->url.':'.$this->port.'/Service.asmx/sendsms');
		print_r($status);
	}
	function randToken()
	{
		$pos = 4 ; //字符串为4位
		//$str = "0123456789ABCDEFGHIGKLMNPQRSTUVWXY";//随机字符字典，去除模糊字母
		$str = "0123456789";//敏说，用数字就行了，改下
		$token = "";
		$len = strlen($str)-1;
		for($i = 0 ; $i <$pos ; $i++)
		{
			$token .= $str[rand(0,$len)];
		}
		return $token ;
	}
	
	function getAccountBalance()
	{
		$data = array(
				'zh'=>$this->id,
				'mm'=>$this->pwd,
				'dxlbid'=>$this->product
		);	
		$uri = $this->url.":".$this->port."/Service.asmx/Balance";
		$status = self::postFn($data, $uri);
		
	}
	function postFn($data,$uri)
	{
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, $uri );
		curl_setopt ( $ch, CURLOPT_POST, 1 );
		curl_setopt ( $ch, CURLOPT_HEADER, 0 );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, http_build_query($data) );
		$re = curl_exec ( $ch );
		//var_dump($uri,$data,$re);exit;
		curl_close ( $ch );
		return $re;
	}
}


/* $obj = new Sms();
$tel = '15911122086';
$uid = md5($tel);
echo '<br />';
$obj->__set($uid, $tel);
print_r($obj->sendSMS()); */