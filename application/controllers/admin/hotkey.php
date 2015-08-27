<?php
//热词
require_once 'curl.php';
//头
$hotkey = '<div class="admin-content">
						    <div class="am-cf am-padding">
						      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">热词</strong>
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
										<th class="table-id">ID</th>
										<th class="table-title">热词</th>
										<th class="table-set">操作</th>
						              </tr>
						          </thead>
								<tbody>';
//内容区
if($_SERVER['HTTP_HOST']=='localhost')
	$uri = 'http://localhost/sunset/application/controllers/api/searchhotword.php';
else
	$uri = '120.25.250.200/application/controllers/api/searchhotword.php';
$re = getFn($uri);
$r = json_decode($re,TRUE);
$h= null;
foreach($r['data'] as $key=>$value)
{
	$id = $value['id'];
	$keyword = $value['keyword'];
	$h .= '<tr>
						              <td><input type="checkbox" /></td>
						              <td>'.$id.'</td>
						              <td>'.$keyword.'</td>
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
$hotkey.= $h;
//尾
$hotkey.='</tbody>
						        </table>';
?>