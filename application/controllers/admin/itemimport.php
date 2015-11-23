<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>物品导入</title>
</head>
<body>
<?php 
require_once 'cookie.php';
ck();
?>
<form action="../api/admin/itemImport_sd.php" enctype="multipart/form-data"  method="post">
  <p>CSV文件: <input type="file" name="subjectImage" /></p>
  <input type="submit" value="Submit" />
</form>
</body>
</html>