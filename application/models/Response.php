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
    			$message = 'Success';
    			break;
    		case 400:
    			$message =  'Bad request';
    			break;
    		case 401:
    				$message =  'User already exist';
    				break;
    		case 402:
    				$message =  'Token Failed';
    				break;
    		case 403:
    				$message =  'Password error';
    				break;
    		case 404:
    			$message =  'Missing token';
    			break;
    		case 405:
    			$message =  'User not exist';
    			break;
    		case 500:
    			$message =  'Internal server error';
    			break;
    		default:
    			$message =  'Unknow Error';
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
