<?php /* Smarty version 2.6.26, created on 2013-03-06 15:49:36
         compiled from tool/quickAccess.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
/*reset*/
body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,code,form,fieldset,legend,input,textarea,p,blockquote,th,td{margin:0;padding:0;}
table{border-collapse:collapse;border-spacing:0;}
fieldset,img{border:0;}
li{list-style:none;}
caption,th{text-align:left;}
h1,h2,h3,h4,h5,h6{font-size:100%;font-weight:normal;}
q:before,q:after{content:'';}
abbr,acronym{border:0;font-variant:normal;}
a{outline:none;cursor:pointer;color:#000}
a:link,a:visited{}
a:hover,a:active{}
sup{vertical-align:text-top;}
sub{vertical-align:text-bottom;}
input,textarea,select{font-family:inherit;font-size:inherit;font-weight:inherit;}
input,textarea,select{}
select{font-size:14px;}
legend{color:#000;}
h1{font-size:18px;font-weight:bold;text-align:left;font-family:"Microsoft YaHei", "SimHei";}
h2 {background: none repeat scroll 0 0 #CFDBEC;display: block;font-family: "Microsoft YaHei","SimHei";font-size: 18px;height: 30px;line-height: 30px;padding:0}
.clearfix2:after{content:".";display:block;height:0;clear:both;visibility:hidden}
.clearfix2{*+height:1%}
.clearfix{overflow:hidden;_zoom:1;}
/*reset end*/
.box{margin-bottom:10px;}
.box ul{overflow:hidden;padding-top:5px;}
.box li{float:left;padding-right:15px;height:25px;font-size:14px;min-width:100px;_width:100px;display:inline;word-wrap:normal}
</style>
<script src="themes/js/jquery.last.js?<?php echo @RD; ?>
"></script>
<title>快速入口</title>

</head>
<body>
	<div id="toolheader" class="nav1">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tool/nav.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	
	</div>
	<div class="box">
		<h2>测试机入口</h2>
		<ul class="clearfix openInPM">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../tmp/cache/productTestUrl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	
		</ul>	
	</div>
	<div class="box">
		<h2>组内资源入口</h2>
		<ul class="clearfix openInPM">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/inc_nieweb.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	
		</ul>
	</div>
	<div class="box">
		<h2>公司系统入口</h2>
		<ul class="clearfix">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/inc_163.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	
		</ul>
	</div>
</body>
<script type="text/javascript">window.parent.setTitle("<?php echo $this->_tpl_vars['title']; ?>
");</script>
<script type="text/javascript">
$(".openInPM a").click(function(){
	var url=$(this).attr("href");
	window.external.openUrl(url);
	return false;})
</script>
</html>