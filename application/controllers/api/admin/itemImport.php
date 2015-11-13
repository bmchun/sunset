<?php
var_dump($_FILES);exit;
require_once '../../../models/data/ItemInfo.php';

error_reporting(0);
if(!isset($_FILES))
	header('Location:'.$_SERVER['HTTP_REFERER']);

$file = $_FILES;
$des_path  = $_SERVER['DOCUMENT_ROOT'].'/upload/';
$des_name = time();
$im = new ItemInfo();

try {
	$r = move_uploaded_file($file['subjectImage']["tmp_name"],$des_path.$des_name);
	if(!$r)
		exit;
	$fp = fopen($des_path.$des_name,'r');
	//$fp = fopen('/Users/bmc/Downloads/12345','r');
	$data = array();
	while(!feof($fp))
	{
		$line = fgets($fp);
		$line= preg_replace('/\t{1,}/',' ',$line);//去掉多个tab制表位
		$line = preg_replace('/\s{2,}/',' ',$line);//去掉多个空格
		
		$l = explode(" ", $line);
		$l[1] = gender($l[1]);
		$l[2] = type($l[2]);
		if($l[0]==null)
			continue;
		$data[]=$l;
	}
	$cons = '`id`,`itemGender`,`type`,`itemName`,`itemDate`';
	$ln = null;
	foreach ($data as $k => $v)
	{
		$time = time();;
		array_walk($v, 'trim_arr');
		$ln.= '(\'';
		$ln.= join($v,'\',\'');
		$ln.='\',\''.$time.'\'),';
	} 
	$ln = trim($ln,",").';';
	$im->iteminfo_import($cons,$ln);
	header('Location:'.$_SERVER['HTTP_REFERER']);
} catch (Exception $e) {
	print $e->getMessage();
	header('Location:'.$_SERVER['HTTP_REFERER']);
}

function trim_arr(&$value)
{
	$value = trim($value);
}

function gender($gender)
{
	switch($gender)
	{
		case '妈':
			return 0;
		case '爸':
			return 1;
		case '皆可':
			return 2;
		default:
			return 3;
	}
}

function  type($type)
{
	switch($type)
	{
		case '外套':
			return 1;
		case '裙子':
			return 2;
		case '上衣':
			return 3;
		case '裤子':
			return 4;
		case '鞋帽配饰':
			return 5;
		case '运动装':
			return 6;
		case '家居服':
			return 7;
		case '箱包':
			return 8;
		case '化妆品':
			return 9;
		case '保健品':
			return 10;
		case '食品':
			return 11;
		case '保健器械':
			return 12;
		case '生活用品':
			return 13;
		default:
			return 0;
	}
	
}
