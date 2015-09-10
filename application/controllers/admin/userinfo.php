<?php
//用户基本信息
require_once 'curl.php';
//头
$userinfo = '<div class="admin-content">
						    <div class="am-cf am-padding">
						      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">用户信息</strong>
						    </div>
						    <div class="am-g">
						      <div class="am-u-sm-12 am-u-md-6">
						        <div class="am-btn-toolbar">
						          <div class="am-btn-group am-btn-group-xs">
						            <button type="button" class="am-btn am-btn-default"><span class="am-icon-plus"></span> 新增</button>
						            <button type="button" class="am-btn am-btn-default"><span class="am-icon-save"></span> 保存</button>
						            <button type="button" class="am-btn am-btn-default"><span class="am-icon-trash-o"></span> 删除</button>
						          </div>
						        </div>
						      </div>
						    </div>
							<div class="am-g">
						      <div class="am-u-sm-12">
						        <form class="am-form">
						          <table class="am-table am-table-striped am-table-hover table-main">
						            <thead>
						              <tr>
						                <th class="table-check"><input type="checkbox" /></th>
										<th class="table-id">uid</th>
										<th class="table-title">手机</th>
										<th class="table-title">昵称</th>
										<th class="table-title">性别</th>
										<th class="table-title">图片</th>
										<th class="table-title">省份</th>
										<th class="table-title">注册时间</th>
										<th class="table-title">平台</th>
										<th class="table-title">usid</th>
										<th class="table-set">操作</th>
						              </tr>
						          </thead>
								<tbody>';
//内容区
$page = isset($_GET['page'])?$_GET['page']:1;
if($_SERVER['HTTP_HOST']=='localhost')
	$uri = 'http://localhost/sunset/application/controllers/api/userinfo.php?page='.$page.'&uid=-1';
else
	$uri = '120.25.250.200/application/controllers/api/userinfo.php?page='.$page.'&uid=-1';
$re = getFn($uri);
$r = json_decode($re,TRUE);
$h= null;
foreach($r['data']['userinfo'] as $key=>$value)
{
	$uid = $value['uid'];
	$tel = $value['tel'];
	$nickname = $value['nickname'];
	$gender = $value['gender'];
	$image = $value['image'];
	$provice = $value['provice'];
	$registerDate = $value['registerDate'];
	$platformName = $value['platformName'];
	$usid = $value['usid'];
	$h .= '<tr>
						              <td><input type="checkbox" /></td>
						              <td>'.$uid.'</td>
						              <td>'.$tel.'</td>
						              <td>'.$nickname.'</td>
						              <td>'.$gender.'</td>
						              <td>'.$image.'</td>
						              <td>'.$provice.'</td>
						              <td>'.$registerDate.'</td>
						              <td>'.$platformName.'</td>
						              <td>'.$usid.'</td>
						              <td>
						                <div class="am-btn-toolbar">
						                  <div class="am-btn-group am-btn-group-xs">
						                    <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
						                    <button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><span class="am-icon-copy"></span> 复制</button>
						                    <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><span class="am-icon-trash-o"></span> 删除</button>
						                  </div>
						                </div>
						              </td>
						            </tr>';
}
$userinfo.= $h;
//尾
$userinfo.='</tbody>
						        </table>';
?>