<?php
/**
 * 生成接口数据格式
 */
class Response{
	
	function __construct()
    {
    }
    	
  /**
   * [show 按综合方式输出数据]
   * @param [int] $code    [状态码]
   * @param [string] $message [提示信息]
   * @param array $data  [数据]
   * @param [string] $type [类型]
   * @return [string]    [返回值]
   */
  public static function show($code, $data = array(),$type = 'json'){
    if(!is_numeric($code)){
      return '';
    }
    	switch ($code)
    	{
    		case 200:
    			$message = '操作成功！';
    			break;
    		case 400:
    			$message =  '操作异常，请重试！';
    			break;
    		case 401:
    				$message =  '用户已存在！';
    				break;
    		case 402:
    				$message =  'Token错误或失效，请重试！';
    				break;
    		case 403:
    				$message =  '密码错误！';
    				break;
    		case 404:
    			$message =  '缺失Token！';
    			break;
    		case 405:
    			$message =  '用户不存在！';
    			break;
    		case 406:
    			$message =  '用户名或密码错误！';
    			break;
    		case 407:
    			$message =  '更新失败，请重试！';
    			break;
    		case 500:
    			$message =  '服务器内部错误';
    			break;
    		default:
    			$message =  '未知错误！';
    	}
  
    if($type == 'json'){
      return self::json($code, $message, $data);
    }elseif($type == 'xml'){
      return self::xml($code, $message, $data);
    }else{
      //TODO
    }
  }
  /**
   * [json 按json方式输出数据]
   * @param [int] $code    [状态码]
   * @param [string] $message [提示信息]
   * @param [array] $data  [数据]
   * @return [string]     [返回值]
   */
  public static function json($code, $message, $data = array()){
    if(!is_numeric($code)){
      return '';
    }
    $result = array(
      'code' => $code,
      'msg' => $message,
      'data' => $data
    );
    $result = json_encode($result);
    $result = str_replace('null', '""', $result);
    $result = str_replace('""""', '""', $result);
    return $result;
  }
  
  /**
   * [xml 按xml格式生成数据]
   * @param [int] $code    [状态码]
   * @param [string] $message [提示信息]
   * @param array $data   [数据]
   * @return [string]     [返回值]
   */
  public static function xml($code, $message, $data = array()){
    if(!is_numeric($code)){
      return '';
    }
    $result = array(
      'code' => $code,
      'message' => $message,
      'data' => $data
    );
    header("Content-Type:text/xml");
    $xml = "<?xml version='1.0' encoding='UTF-8'?>\n";
    $xml .= "<root>\n";
    $xml .= self::xmlToEncode($data);
    $xml .= "</root>";
    return $xml;
  }
  
  public static function xmlToEncode($data){
    $xml = '';
    foreach($data as $key => $value){
      if(is_numeric($key)){
        $attr = "id='{$key}'";
        $key = "item";
      }
      $xml .= "<{$key} {$attr}>\n";
      $xml .= is_array($value) ? self::xmlToEncode($value) : "{$value}\n";
      $xml .= "</{$key}>\n";
    }
    return $xml;
  }
}

?>
