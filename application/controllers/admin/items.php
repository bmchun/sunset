<?php
//商品维护
require_once 'curl.php';
require_once('../../models/NewItems.php');
//头
$items = '<div class="admin-content">
						    <div class="am-cf am-padding">
						      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">商品</strong>
						    </div>
						    <div class="am-g">
						      <div class="am-u-sm-12 am-u-md-6">
						        <div class="am-btn-toolbar">
						        <div class="am-btn-group am-btn-group-xs">
						            <button type="button" class="am-btn am-btn-success" id="item"><span class="am-icon-plus"></span> 导入</button>
						            <div class="am-modal am-modal-prompt" tabindex="-1" id="creatItem">
									  <div class="am-modal-dialog" align=left>
											<div class="am-modal-bd" >
											<form action="../api/admin/itemImport.php" enctype="multipart/form-data"  method="post">
  												<div class="am-modal-hd" align=left> 导入文件: </br>
												 <input type="file" name="subjectImage" /></div></br>
  												<input type="submit" value="导入" />
											</form>
									<pre> 格式要求：商品ID | 性别 | 类型 | URL </pre>
											</div>
						<script>
								$("#item").on("click",function(){
								  $("#creatItem").modal({
									});
								});
							</script>
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
										<th class="table-id">商品ID</th>
										<th class="table-title">商品名称</th>
										<th class="table-title">商品链接</th>
										<th class="table-title">收藏数</th>
										<th class="table-title">适合性别</th>
										<th class="table-title">是否推荐</th>
										<th class="table-date am-hide-sm-only">修改日期</th>
										<th class="table-set">操作</th>
						              </tr>
						          </thead>
								<tbody>';
//内容区
$pageid = isset($_GET['pageid'])?$_GET['pageid']:1;
if($_SERVER['HTTP_HOST']=='localhost')
	$uri = 'http://localhost/sunset/application/controllers/api/newitems.php?page='.$pageid.'&itemNum=11';
else
	$uri = '120.25.250.200/application/controllers/api/newitems.php?page='.$pageid.'&itemNum=11';
$re = getFn($uri);
$r = json_decode($re,TRUE);
$data = $r['data'];
$h= null;
foreach($data as $key=>$value)
{
	$itemGender = $value['itemGender']==0?'女':'男';
	$isRecommend = $value['isRecommend']==0?'否':'是';
	$h .= '<tr>
						              <td><input type="checkbox" /></td>
						              <td>'.$value['id'].'</td>
						              <td>'.$value['describe'].'</td>
						              <td><a href="'.$value['itemName'].'" target="_blank">链接</a></td>
						              <td>'.$value['collectNum'].'</td>
						              <td>'.$itemGender.'</td>
						              <td>'.$isRecommend.'</td>
						              <td class="am-hide-sm-only">'.$value['itemDate'].'</td>
						              <td>
						                <div class="am-btn-toolbar">
						                  <div class="am-btn-group am-btn-group-xs">
						                    <a href="../api/admin/itemDel.php?id='.$value['id'] .'">删除</a>
						                  </div>
						                </div>
						              </td>
						            </tr>';
}
$items.= $h;
//尾
$items.='</tbody>
						        </table>';
//分页展示
$obj = new NewItems;
$total_num = $obj->itemsNum();
$items.='
		<div class="am-cf">
  共 '.$total_num.' 条记录
  <div class="am-fr">
    <ul class="am-pagination">';
$_GET['pageid'] = isset($_GET['pageid'])?$_GET['pageid']:1;
for($i=1;$i<6;$i++)
{
	if($i == $_GET['pageid']) $active = 'am-active';
	else $active = '';
	$items.= '<li class="'.$active.'"><a href="?id=2&pageid='.$i.'">'.$i.'</a></li>';
}
$items.='
    </ul>
  </div>
</div>';

?>