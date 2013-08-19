<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>
<body>

<?php 
$msg=$_GET['msg'];
$msg=urldecode($msg);
echo $msg;
?>
<br />
<a href="javascript:history.go(-1)">后退</a>　<a href="../index.php">重新登陆</a>
</body>
</html>