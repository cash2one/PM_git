<?php /* Smarty version 2.6.26, created on 2013-04-15 08:51:58
         compiled from main.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'main.html', 14, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo @WebTitle; ?>
</title>
<link type="text/css"  rel="stylesheet" href="themes/css/base.css" />
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<body>

<h1 style="text-align:center">网站组项目管理系统</h1>

<div style="width:500px;margin:100px auto">
	<form method="post" action="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'user','a' => 'login'), $this);?>
">
	
	用户名：<input name="user_account" type="text" id="user_account" />
	密  码：<input name="user_pwd" type="password" id="user_pwd" />
	<input name="" type="submit" value="登陆" />
	
	</form>
</div>

</body>
</html>