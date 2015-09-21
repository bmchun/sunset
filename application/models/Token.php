<?php
require_once 'data/Token.php';
require_once '../../models/Response.php';
## curl -d "zh=nngwtest&mm=123123&hm=15911122086&dxlbid=28&extno=28&nr=\"尊敬的用户，您的验\"码
##为595358，有效期为60秒，如有疑虑请详询400-820-3122（客服电话）【金互行】\"" "http://114.113.101.250:8087/Service.asmx/sendsms"
class Token_SMS
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
		$this->url = 'http://219.142.105.9';
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
		$data['nr'] ='暖暖的用户，您的验证码为'.$token.'，如非本人操作，请忽略本短信【暖暖购物】' ;
		//$data['message'] =urlencode('尊敬的用户，您的验证码为'.$token.'【暖暖】') ;
		$status = self::postFn($data, $this->url.':'.$this->port.'/Service.asmx/sendsms');
		$status =0;//跳过短信环节；
		$re = new Token();
		$arr = array('tel'=>$this->mobile,'token'=>$token,'timeout'=>(time()+300));//失效时间为5分钟
		$arr_search = array('tel'=>$this->mobile);
		$reponse = new Response();
		if(mysql_fetch_assoc($re->token_select($arr_search, 1)))
			$re->token_update($arr, "tel=$this->mobile");
		else
			$re->token_insert($arr);
		if(!$status)
			echo $reponse->show(200);
			//echo $token;
	}
	function getToken($tel,$token)
	{
		$reponse = new Response();
		$re = new Token();
		$arr = array('tel'=>$tel);
		$result = mysql_fetch_assoc($re->token_select($arr, 1)) ;
		if($result['timeout'] >= time() && $token ==$result['token'])
		{
			$arr = array('timeout'=>time());//成功就销毁该验证码
			$re->token_update($arr, "tel=$this->mobile");
			return 200;
		}
		else
			return 400;
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
