<?php
header("Content-type: text/html; charset=utf-8");
require_once '../../../third_party/TopSdk.php';
function generateSign($params)
{
	ksort($params);

	$stringToBeSigned = '70ae4ec986cf0e9bcfbcd61c3f52d8cf';
	foreach ($params as $k => $v)
	{
		if("@" != substr($v, 0, 1))
		{
			$stringToBeSigned .= "$k$v";
		}
	}
	unset($k, $v);
	$stringToBeSigned .= '70ae4ec986cf0e9bcfbcd61c3f52d8cf';

	return strtoupper(md5($stringToBeSigned));
}

 function curl($url, $postFields = null)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_FAILONERROR, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
	//https 请求
	if(strlen($url) > 5 && strtolower(substr($url,0,5)) == "https" ) {
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	}

	if (is_array($postFields) && 0 < count($postFields))
	{
		$postBodyString = "";
		$postMultipart = false;
		foreach ($postFields as $k => $v)
		{
			if("@" != substr($v, 0, 1))//判断是不是文件上传
			{
				$postBodyString .= "$k=" . urlencode($v) . "&";
			}
			else//文件上传用multipart/form-data，否则用www-form-urlencoded
			{
				$postMultipart = true;
			}
		}
		unset($k, $v);
		curl_setopt($ch, CURLOPT_POST, true);
		if ($postMultipart)
		{
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		}
		else
		{
			$header = array("content-type: application/x-www-form-urlencoded; charset=UTF-8");
			curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
			curl_setopt($ch, CURLOPT_POSTFIELDS, substr($postBodyString,0,-1));
		}
	}
	$reponse = curl_exec($ch);

	if (curl_errno($ch))
	{
		throw new Exception(curl_error($ch),0);
	}
	else
	{
		$httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if (200 !== $httpStatusCode)
		{
			throw new Exception($reponse,$httpStatusCode);
		}
	}
	curl_close($ch);
	return $reponse;
}

function execute( $session = null)
{
	//组装系统参数
	$sysPara['timestamp'] = date('Y-m-d H:i:s');
	$sysPara['format'] = 'json';
	$sysPara['app_key'] = '23210056';
	$sysPara['v'] = '2.0';
	$sysPara['sign_method'] = 'md5';
	$sysPara['method'] = 'taobao.tbk.items.detail.get';
	
	$userPara['fields'] = 'num_iid,seller_id,nick,title,price,volume,pic_url,item_url,shop_url';
	$userPara['open_iids'] = '41287527724';
	
	if (null != $session)
	{
		$sysPara["session"] = $session;
	}

	//签名
	$sysPara["sign"] = generateSign(array_merge($userPara, $sysPara));

	//系统参数放入GET请求串
	$requestUrl = 'http://gw.api.taobao.com/router/rest' . "?";
	foreach ($sysPara as $sysParamKey => $sysParamValue)
	{
		$requestUrl .= "$sysParamKey=" . urlencode($sysParamValue) . "&";
	}
	$requestUrl = substr($requestUrl, 0, -1);

	//发起HTTP请求
	//var_dump($requestUrl,$userPara);exit;
		//$resp = curl($requestUrl, $userPara);
		try
		{
			var_dump($requestUrl,$userPara);
			$resp = curl($requestUrl, $userPara);
			var_dump($resp);exit;
		}
		catch (Exception $e)
		{
			$result['code'] = $e->getCode();
			$result['msg'] = $e->getMessage();
			print_r($result);return $result;
		}
		
		//解析TOP返回结果
		if (true)
		{
			$respObject = json_decode($resp);
			if (null !== $respObject)
			{
				$respWellFormed = true;
				foreach ($respObject as $propKey => $propValue)
				{
					$respObject = $propValue;
				}
			}
		}
		else if("xml" == $this->format)
		{
			$respObject = @simplexml_load_string($resp);
			if (false !== $respObject)
			{
				$respWellFormed = true;
			}
		}
		//return $respObject;
		var_dump($respObject) ;
}

execute();
	



?>