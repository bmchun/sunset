<?php
error_reporting(0);
//商品维护
require_once 'curl.php';
require_once('../../models/NewItems.php');
//头
$items = '<div class="admin-content">
			<div class="am-cf am-padding">
				<div class="am-fl am-cf">
					<strong class="am-text-primary am-text-lg">商品</strong>
				</div>
				<div class="am-g">
					<div class="am-u-sm-12 am-u-md-6">
						<div class="am-btn-toolbar">
						 	<div class="am-btn-group am-btn-group-xs">
						    	<button type="button" class="am-btn am-btn-success" id="item" onclick="window.location=\'http://120.25.250.200/application/controllers/admin/itemimport.php\'"><span class="am-icon-plus"></span> 导入</button>
							<div class="am-u-sm-12 am-u-md-3">
								<form>
          							<input type="text" class="am-form-field" style = "width:100px" name="k">
								</from>
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
							<tbody>
							';
//内容区
$pageid = isset($_GET['pageid'])?$_GET['pageid']:1;
if($_SERVER['HTTP_HOST']=='localhost')
	$uri = 'http://localhost/sunset/application/controllers/api/newitems.php?page='.$pageid.'&itemNum=10';
else
	$uri = '120.25.250.200/application/controllers/api/newitems.php?page='.$pageid.'&itemNum=50';
$re = getFn($uri);
$r = json_decode($re,TRUE);
$data = array_merge(array(0=>''), $r['data']);
//var_dump($data);exit;
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
for($i=1;$i<11;$i++)
{
	if($i == $_GET['pageid']) $active = 'am-active';
	else $active = '';
	$items.= '<li class="'.$active.'"><a href="?id=2&pageid='.$i.'">'.$i.'</a></li>';
}
if(ceil($total_num/10)>10)
	$items.='...'.'<li><a href="?id=2&pageid='.ceil($total_num/10).'">'.ceil($total_num/10).'</a></li>
    </ul>
  </div>
</div>';
function  ex_type($type)
{
	switch($type)
	{
		case 1:
			return '外套';
		case 2:
			return '裙子';
		case 3 :
			return '上衣';
		case 4:
			return '裤子';
		case 5:
			return '鞋帽配饰';
		case 6:
			return '运动装';
		case 7:
			return '家居服';
		case 8:
			return '箱包';
		case 9:
			return '化妆品';
		case 10:
			return '保健品';
		case 11:
			return '食品';
		case 12:
			return '保健器械';
		case 13:
			return '生活用品';
		default:
			return '其他';
	}
}

function select($check)
{
	$str = null;
	for($i=1;$i<15;$i++)
	{
		if($i==$check)
			$str .= '<option value="'.$i.'" selected="selected">'.ex_type($i).' </option>';
		else
			$str .= '<option value="'.$i.'">'.ex_type($i).' </option>';
	}
	return $str;
}

function isTop($status)
{
	$str = null;
	if($status=='是')
	{
		$str .= '<option value="1" selected="selected">是</option>';
		$str .= '<option value="0">否</option>';
	}
	else
	{
		$str .= '<option value="1" >是</option>';
		$str .= '<option value="0" selected="selected">否</option>';
	}
	return $str;
}

function gender($gender)
{
	$str =null;
	if($gender=='男')
	{
		$str .= '<option value="1" selected="selected">男</option>';
		$str .= '<option value="0">女</option>';
		$str .= '<option value="2">皆可</option>';
	}
	elseif($gender=='女')
	{
		$str .= '<option value="1" >男</option>';
		$str .= '<option value="0" selected="selected">女</option>';
		$str .= '<option value="2">皆可</option>';
	}
	else {
		$str .= '<option value="1" >男</option>';
		$str .= '<option value="0" >女</option>';
		$str .= '<option value="2" selected="selected">皆可</option>';
	}
	return $str;
}
?>
