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
									  <div class="am-modal-dialog" align=left>
											<div class="am-modal-bd" >
											<form action="../api/admin/subjectAdd.php" enctype="multipart/form-data"  method="post">
 												 <div class="am-modal-hd" align=left>专题名称: <input type="text" name="subjectName" /></div>
  												 <div class="am-modal-hd" align=left>专题URL: <input type="text" name="subjectUrl" /></div>
  												<div class="am-modal-hd" align=left> 专题图片: <input type="file" name="subjectImage" /></div></br>
  												<input type="submit" value="提交" />
											</form>
											</div>
						<script>
								$("#subject").on("click",function(){
								  $("#createSubject").modal({
									});
								});
							</script>
									  </div>
									</div>
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
	$uri = 'http://localhost/sunset/application/controllers/api/subject.php?page=all';
else
	$uri = '120.25.250.200/application/controllers/api/subject.php?page=all';
$re = getFn($uri);
$r = json_decode($re,TRUE);
$data = $r['data'];
$h= null;
foreach($data as $key=>$value)
{
	$h .= '<tr id=>
						              <td><input type="checkbox" /></td>
						              <td >'.$value['id'].'</td>
						              <td><a href="'.$value['subjectURL'].'" target="_blank">'.$value['subjectName'].'</a></td>
						              <td class="am-hide-sm-only">'.$value['subjectTime'].'</td>
						              <td>
						                <div class="am-btn-toolbar">
						                  <div class="am-btn-group am-btn-group-xs">
						              		<a href="../api/admin/subjectDel.php?id='.$value['id'] .'">删除</a>
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