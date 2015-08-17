<?php
//搜索热词接口

require_once '../../models/Response.php';
require_once '../..//models/HotKeys.php';

$re = new HotKeys();
$data = $re->showKey();
$style = new Response();
echo $style->show(200,$data);