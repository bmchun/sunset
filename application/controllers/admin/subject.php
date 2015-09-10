<?php
require_once 'curl.php';
//头
$subject = '<div class="admin-content">
						    <div class="am-cf am-padding">
						      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">专题</strong>
						    </div>
						    <div class="am-g">
						      <div class="am-u-sm-12 am-u-md-6">
						        <div class="am-btn-toolbar">
						          <div class="am-btn-group am-btn-group-xs">
						            <button type="button" class="am-btn am-btn-success" id="subject"><span class="am-icon-plus"></span> 新增</button>
						            <div class="am-modal am-modal-prompt" tabindex="-1" id="createSubject">
									  <div class="am-modal-dialog">
											<div class="am-modal-bd">
											<form action="../controllers/api/subjectAdd.php" enctype="multipart/form-data"  method="post">
 												 <div >name: <input type="text" name="subjectName" /></div>
  												 <div >url: <input type="text" name="subjectUrl" /></div>
  												<div > Image: <input type="file" name="subjectImage" /></div>
  												<input type="submit" value="Submit" />
											</form>
											</div>
									  </div>
									</div>
							<script>
								$("#subject").on("click",function(){
								  $("#createSubject").modal({
									relatedTarget: this,
									onConfirm: function sub(e) {
										alert("你输入的是：" + e.data || "");
									},
									onCancel: function(e) {
										//alert("不想说!");
									}
									});
								});
							</script>
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
										<th class="table-title">标题</th>
										<th class="table-date am-hide-sm-only">修改日期</th>
										<th class="table-set">操作</th>
						              </tr>
						          </thead>
								<tbody>';
//内容区
if($_SERVER['HTTP_HOST']=='localhost')
	$uri = 'http://localhost//sunset/application/controllers/api/subject.php?page=all';
else
	$uri = '120.25.250.200/application/controllers/api/subject.php?page=all';
$re = getFn($uri);
$r = json_decode($re,TRUE);
$data = $r['data'];
$h= null;
foreach($data as $key=>$value)
{
	$h .= '<tr>
						              <td><input type="checkbox" /></td>
						              <td>'.$value['id'].'</td>
						              <td><a href="'.$value['subjectURL'].'">'.$value['subjectName'].'</a></td>
						              <td class="am-hide-sm-only">'.$value['subjectTime'].'</td>
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
$subject.= $h;
//尾
$subject.='</tbody>
						        </table>';
?>