<?php 
require_once('../../models/adminCheck.php');
require_once 'subject.php';
require_once 'items.php';
require_once 'hotkey.php';
require_once 'userinfo.php';
require_once 'search.php';
//var_dump($_POST);exit;
require_once 'cookie.php';
require_once 'push.php';
ck();
require_once 'header.php';
?>

<body>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，Amaze UI 暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
  以获得更好的体验！</p>
<![endif]-->

<header class="am-topbar admin-header">
  <div class="am-topbar-brand">
    <strong>暖暖</strong> <small>后台管理</small>
  </div>

  <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

  <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

    <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list">
      <li class="am-dropdown" data-am-dropdown>
        <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
          <span class="am-icon-users"></span> 管理员 <span class="am-icon-caret-down"></span>
        </a>
        <ul class="am-dropdown-content">
          <li><a href="#"><span class="am-icon-cog"></span>修改密码</a></li>
          <li><a href="logout.php"><span class="am-icon-power-off"></span> 退出</a></li>
        </ul>
      </li>
      <li class="am-hide-sm-only"><a href="javascript:;" id="admin-fullscreen"><span class="am-icon-arrows-alt"></span> <span class="admin-fullText">开启全屏</span></a></li>
    </ul>
  </div>
</header>

<div class="am-cf admin-main">
  <!-- sidebar start -->
  <div class="admin-sidebar am-offcanvas" id="admin-offcanvas">
    <div class="am-offcanvas-bar admin-offcanvas-bar">
      <ul class="am-list admin-sidebar-list">
        <li><a href="admin-index.php"><span class="am-icon-home"></span> 首页</a></li>
        <li class="admin-parent">
          <a class="am-cf" data-am-collapse="{target: '#collapse-nav'}"><span class="am-icon-file"></span> 功能 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
          <ul class="am-list am-collapse admin-sidebar-sub am-in" id="collapse-nav">
            <li><a href="?id=1"><span class="am-icon-th"></span> 专题</a></li>
            <li><a href="?id=2"><span class="am-icon-pencil-square-o"></span> 商品</a></li>
            <li><a href="?id=3"><span class="am-icon-check"></span> 热词维护</a></li>
            <li><a href="?id=4"><span class="am-icon-calendar"></span> 用户信息</a></li>
            <li><a href="?id=5"><span class="am-icon-puzzle-piece"></span> 消息Push</a></li>
            <!-- 
            <li><a href="admin-user.html" class="am-cf"><span class="am-icon-check"></span> 修改密码<span class="am-icon-star am-fr am-margin-right admin-icon-yellow"></span></a></li>
            <li><a href="admin-help.html"><span class="am-icon-puzzle-piece"></span> 帮助页</a></li>
            <li><a href="admin-gallery.html"><span class="am-icon-th"></span> 相册页面<span class="am-badge am-badge-secondary am-margin-right am-fr">24</span></a></li>
            <li><a href="admin-log.html"><span class="am-icon-calendar"></span> 系统日志</a></li>
            <li><a href="admin-404.html"><span class="am-icon-bug"></span> 404</a></li>
         	<li><a href="admin-table.html"><span class="am-icon-table"></span> 表格</a></li>
        		<li><a href="admin-form.html"><span class="am-icon-pencil-square-o"></span> 表单</a></li>
         	 -->
          </ul>
        </li>
        <li><a href="logout.php"><span class="am-icon-sign-out"></span> 注销</a></li>
      </ul>

      <div class="am-panel am-panel-default admin-sidebar-panel">
        <div class="am-panel-bd">
          <p ><span class="am-icon-bookmark"></span> Tips </p>
          <p>创业不易，勿忘初衷。</p>
        </div>
      </div>
    </div>
  </div>
  <!-- sidebar end -->

  <!-- content start -->
  <div class="admin-content">
<?php
if(isset($_GET['id']))
{
	$_GET['id'] = isset($_GET['id'])?$_GET['id']:null; 
	$arr = array();
	switch ($_GET['id'])
	{
		case 1:	//专题管理
			echo $subject;
			break;
		case 2:	//商品管理
			echo $items;
			break;
		case 3:	//热词管理
			echo $hotkey;
			break;
		case 4:	//用户信息管理
			echo $userinfo;
			break;
		case 5: //第三方短信平台
			echo $push;
			break;
		default:
				echo '<div class="am-cf am-padding">
      					<div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">首页</strong> / <small>假数据，占坑</small></div>
						    </div>
						    <ul class="am-avg-sm-1 am-avg-md-4 am-margin am-padding am-text-center admin-content-list ">
						      <li><a href="#" class="am-text-success"><span class="am-icon-btn am-icon-file-text"></span><br/>新增页面<br/>2300</a></li>
						      <li><a href="#" class="am-text-warning"><span class="am-icon-btn am-icon-briefcase"></span><br/>成交订单<br/>308</a></li>
						      <li><a href="#" class="am-text-danger"><span class="am-icon-btn am-icon-recycle"></span><br/>昨日访问<br/>80082</a></li>
						      <li><a href="#" class="am-text-secondary"><span class="am-icon-btn am-icon-user-md"></span><br/>在线用户<br/>3000</a></li>
						    </ul>';
	}
}
if(isset($_GET['k']))
{
	$_GET['k'] = isset($_GET['k'])?$_GET['k']:null;
	echo $content;
}
?>
    

    <!-- <div class="am-g">
      <div class="am-u-sm-12">
        <table class="am-table am-table-bd am-table-striped admin-content-table">
          <thead>
          <tr>
            <th>ID</th><th>用户名</th><th>最后成交任务</th><th>成交订单</th><th>管理</th>
          </tr>
          </thead>
          <tbody>
          <tr><td>1</td><td>John Clark</td><td><a href="#">Business management</a></td> <td><span class="am-badge am-badge-success">+20</span></td>
            <td>
              <div class="am-dropdown" data-am-dropdown>
                <button class="am-btn am-btn-default am-btn-xs am-dropdown-toggle" data-am-dropdown-toggle><span class="am-icon-cog"></span> <span class="am-icon-caret-down"></span></button>
                <ul class="am-dropdown-content">
                  <li><a href="#">1. 编辑</a></li>
                  <li><a href="#">2. 下载</a></li>
                  <li><a href="#">3. 删除</a></li>
                </ul>
              </div>
            </td>
          </tr>
          <tr><td>2</td><td>风清扬</td><td><a href="#">公司LOGO设计</a> </td><td><span class="am-badge am-badge-danger">+2</span></td>
            <td>
              <div class="am-dropdown" data-am-dropdown>
                <button class="am-btn am-btn-default am-btn-xs am-dropdown-toggle" data-am-dropdown-toggle><span class="am-icon-cog"></span> <span class="am-icon-caret-down"></span></button>
                <ul class="am-dropdown-content">
                  <li><a href="#">1. 编辑</a></li>
                  <li><a href="#">2. 下载</a></li>
                  <li><a href="#">3. 删除</a></li>
                </ul>
              </div>
            </td>
          </tr>
          <tr><td>3</td><td>詹姆斯</td><td><a href="#">开发一款业务数据软件</a></td><td><span class="am-badge am-badge-warning">+10</span></td>
            <td>
              <div class="am-dropdown" data-am-dropdown>
                <button class="am-btn am-btn-default am-btn-xs am-dropdown-toggle" data-am-dropdown-toggle><span class="am-icon-cog"></span> <span class="am-icon-caret-down"></span></button>
                <ul class="am-dropdown-content">
                  <li><a href="#">1. 编辑</a></li>
                  <li><a href="#">2. 下载</a></li>
                  <li><a href="#">3. 删除</a></li>
                </ul>
              </div>
            </td>
          </tr>
          <tr><td>4</td><td>云适配</td><td><a href="#">适配所有网站</a></td><td><span class="am-badge am-badge-secondary">+50</span></td>
            <td>
              <div class="am-dropdown" data-am-dropdown>
                <button class="am-btn am-btn-default am-btn-xs am-dropdown-toggle" data-am-dropdown-toggle><span class="am-icon-cog"></span> <span class="am-icon-caret-down"></span></button>
                <ul class="am-dropdown-content">
                  <li><a href="#">1. 编辑</a></li>
                  <li><a href="#">2. 下载</a></li>
                  <li><a href="#">3. 删除</a></li>
                </ul>
              </div>
            </td>
          </tr>

          <tr>
            <td>5</td><td>呵呵呵</td>
            <td><a href="#">基兰会获得BUFF</a></td>
            <td><span class="am-badge">+22</span></td>
            <td>
              <div class="am-dropdown" data-am-dropdown>
                <button class="am-btn am-btn-default am-btn-xs am-dropdown-toggle" data-am-dropdown-toggle><span class="am-icon-cog"></span> <span class="am-icon-caret-down"></span></button>
                <ul class="am-dropdown-content">
                  <li><a href="#">1. 编辑</a></li>
                  <li><a href="#">2. 下载</a></li>
                  <li><a href="#">3. 删除</a></li>
                </ul>
              </div>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
    </div> -->
  </div>
  <!-- content end -->
	</div>

<a href="#" class="am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}">
  <span class="am-icon-btn am-icon-th-list"></span>
</a>

<footer>
  <hr>
  <p class="am-padding-left">Copyright © 2015 NuanBuy.com 暖暖购物 京ICP备15039252号</p>
</footer>

</body>
</html>
