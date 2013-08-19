<?php /* Smarty version 2.6.26, created on 2013-04-16 09:56:21
         compiled from user/userface_upload.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'user/userface_upload.html', 8, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<form action="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'file','a' => 'upload_userface'), $this);?>
" method="post" enctype="multipart/form-data">
<input type="file" name="p" />
<input type="submit" value="上传" />
</form> 
</body>
</html>