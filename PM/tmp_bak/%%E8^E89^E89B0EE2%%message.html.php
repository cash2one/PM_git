<?php /* Smarty version 2.6.26, created on 2013-05-02 10:29:18
         compiled from public/message.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'public/message.html', 24, false),)), $this); ?>
<!DOCTYPE html>
<html lang="zh"> 
<head>
<meta charset="utf-8">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/base.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style type="text/css">
.msgbox {background: none repeat scroll 0 0 #8ADFF7;border: 1px solid #FFFFFF;border-radius: 5px 5px 5px 5px;height: 200px;margin: 100px auto 0;padding-top: 40px;text-align: center;width: 600px;}
.msgbox p{line-height:25px;}
.ussallynav1,.ussallynav2{text-align:left;padding-left:50px;padding-top:20px;}
.ussallynav1 a{color:#FF0000;}
.ussallynav2{padding-top:20px;font-size:12px}
.ussallynav2 span{color:#666666}
</style>
</head>
<body>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<article class="content">
	
<div class="msgbox">
        <p style="background: none repeat scroll 0% 0% rgb(255, 255, 255); margin-top: 50px; padding: 10px;" class="ussallyNav"><?php echo $this->_tpl_vars['msg']; ?>
!</p>
		<p class="ussallynav1"><a href="<?php echo $this->_tpl_vars['url1']; ?>
"><?php echo $this->_tpl_vars['urltxt1']; ?>
</a>　<a href="<?php echo $this->_tpl_vars['url2']; ?>
"><?php echo $this->_tpl_vars['urltxt2']; ?>
</a></p>
		<p class="ussallynav2">
			<span>快捷跳转:</span>
			<a class="mywork" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project_bll','a' => 'myWork'), $this);?>
">我的工作</a> | 
			<a class="manage" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project_bll','a' => 'projects'), $this);?>
">查询管理</a> | 
			<a class="create" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project','a' => 'project_add'), $this);?>
">创建项目</a> | 
			<a class="projects" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project_bll','a' => 'projects'), $this);?>
">全部项目</a> | 
            <a class="projects" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'user','a' => 'showlist'), $this);?>
">通讯录</a> | 
			<a class="wraps" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'wrap'), $this);?>
">项目集列表</a>
		</p>
</div>
	
	
</article>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>
</html>