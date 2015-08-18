<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <title>暖暖管理后台</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="format-detection" content="telephone=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <link rel="alternate icon" type="image/png" href="./favicon.ico">
  <link rel="stylesheet" href="assets/css/amazeui.min.css"/>
  <style>
    .header {
      text-align: center;
    }
    .header h1 {
      font-size: 200%;
      color: #333;
      margin-top: 30px;
    }
    .header p {
      font-size: 14px;
    }
  </style>
</head>
<body>
<div class="header">
  <div class="am-g">
    <h1>暖暖管理后台</h1>
    </div>
  <hr />
</div>
<div class="am-g">
  <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
    <form method="post" class="am-form" action="admin-index.php">
      <label for="email">用户邮箱：</label>
      <input type="email" name="email" id="email" value="">
      <br>
      <label for="password">密码:</label>
      <input type="password" name="password" id="password" value="">
      <br>
      <label for="remember-me">
        <input id="remember-me" type="checkbox">
        记住密码
      </label>
       <br />
      <div class="am-cf">
        <input type="submit" name="login_btn" value="登录" class="am-btn am-btn-primary am-btn-sm am-fl">
      </div>
    </form>
    <br />
    <br />
    <hr>
    
    <p>Copyright © 2015 NuanBuy.com 暖暖购物 京ICP备15039252号</p>
  </div>
</div>
</body>
</html>