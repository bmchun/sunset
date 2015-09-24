<?php
//商品维护
require_once 'curl.php';
require_once('../../models/NewItems.php');
//头
$content=null;
$content.= '<div class="admin-content">
						    <div class="am-cf am-padding">
						      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">商品</strong>
						    </div>
						    <div class="am-g">
						      <div class="am-u-sm-12 am-u-md-6">
						        <div class="am-btn-toolbar">
						        <div class="am-btn-group am-btn-group-xs">
						            <button type="button" class="am-btn am-btn-success" id="item"><span class="am-icon-plus"></span> 导入</button>
		<div class="am-u-sm-12 am-u-md-3">
		<form>
          <input type="text" class="am-form-field" style = "width:100px" name="k">
		</from>
      </div>
		
		<script>
		</script>			            
		<div class="am-modal am-modal-prompt" tabindex="-1" id="creatItem">
									  <div class="am-modal-dialog" align=left>
											<div class="am-modal-bd" >
											<form action="../api/admin/itemImport.php" enctype="multipart/form-data"  method="post">
  												<div class="am-modal-hd" align=left> 导入文件: </br>
												 <input type="file" name="subjectImage" />
									   			</div></br>
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
										<th class="table-id">ID</th>
										<th class="table-title">名称</th>
										<th class="table-title">类型</th>
										<th class="table-title">性别</th>
										<th class="table-title">置顶</th>
										<th class="table-title">推荐</th>
										<th class="table-date am-hide-sm-only">修改日期</th>
										<th class="table-set">操作</th>
						              </tr>
						          </thead>
								<tbody>';
//内容区
$pageid = isset($_GET['pageid'])?$_GET['pageid']:1;
$k = isset($_GET['k'])?$_GET['k']:null;
$type = $k;
if($_SERVER['HTTP_HOST']=='localhost')
	$uri = 'http://localhost/sunset/application/controllers/api/search.php?page='.$pageid.'&type='.$type.'&key='.$k;
else
	$uri = '120.25.250.200/application/controllers/api/search.php?page='.$pageid.'&type='.$type.'&key='.$k;
$re = getFn($uri);
$r = json_decode($re,TRUE);
$data = $r['data'];
$h= null;
foreach($data as $key=>$value)
{
	if($value['itemGender']==2)
		$itemGender='皆可';
	else
		$itemGender = $value['itemGender']==0?'女':'男';
	$isRecommend = $value['isRecommend']==0?'否':'是';
	$isTop = $value['isTop']==0?'否':'是';
	$type = ex_type($value['type']);
	$h .= '<tr>
						              <td><input type="checkbox" /></td>
						              <td><a href="'.$value['itemName'].'" target="_blank">'.$value['id'].'</a></td>
						              <td>'.mb_substr($value['describe'],0,5,'utf-8').'</td>
						              <td>'.$type.'</td>
						              <td>'.$itemGender.'</td>
						              <td>'.$isTop.'</td>
						              <td>'.$isRecommend.'</td>
						              <td class="am-hide-sm-only">'.$value['itemDate'].'</td>
						              <td>
<div class="am-btn-toolbar">
		<button type="button" class="am-btn am-btn-success" id="btn'.$value['id'].'"><span class="am-icon-plus"></span> 编辑</button>
		<div class="am-modal am-modal-prompt am-modal-out" tabindex="-1" id="'.$value['id'].'">
			<div class="am-modal-dialog" align=left>
				<div class="am-modal-bd" >
					<form action="../api/admin/itemUpdate.php"  method="post">
						<input type="text" name="auto_id"  readOnly="true" value='.$value['auto_id'].'>
						<input type="text" name="id"  readOnly="true" value='.$value['id'].'></br>
							商品链接<input type="text" name="itemName"  value='.$value['itemName'].'/></br>
							商品名<input type="text" name="describe" value='.$value['describe'].' /></br>
							商品类型 <select name="type" id="type" >
								'.select($value['type']).'
							</select>
							商品性别<select name="itemGender" id="itemGender" >
								'.gender($itemGender).'
							</select>
							置顶<select name="isTop" id="isTop" >
								'.isTop($isTop).'
							</select>
							推荐<select name="isRecommend" id="isRecommend" >
								'.isTop($isRecommend).'
						</select>
		  				<input type="submit"  value="更新" />
					</form>
				</div>
			</div>
		</div>
		<a href="../api/admin/itemDel.php?id='.$value['id'] .'"> 删除</a>	
</div>
<script>
				$("#btn'.$value['id'].'").on("click",function(){
	  			$("#'.$value['id'].'").modal({
					});
				});
</script>				              		
						              </td>
						            </tr>';
}
$content.= $h;
//尾
$content.='</tbody>
						        </table>';
	$content.='
    </ul>
  </div>
</div>';

?>