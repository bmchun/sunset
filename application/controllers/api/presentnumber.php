<?php
require_once '../..//models/Discovery.php';
require_once '../..//models/Response.php';
//获取发现页中的给爸/妈礼物数量
$re = new Discovery();
$data['father'] = $re->numForHuman(1);
$data['mother'] =$re->numForHuman(0);
echo Response::show('200',$data);
