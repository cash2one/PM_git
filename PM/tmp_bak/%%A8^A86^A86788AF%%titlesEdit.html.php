<?php /* Smarty version 2.6.26, created on 2013-04-16 09:36:20
         compiled from pg/titlesEdit.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'pg/titlesEdit.html', 16, false),)), $this); ?>
<!DOCTYPE html>
<html lang="zh"> 
<head>
<meta charset="utf-8">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/base.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</head>
<body class="pgAdmin pgAdminTitleEdit">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="wrap">
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pg/pgadminNav.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<article class="content">

<section class="search">
	<h1>添加 - 职业</h1>
    <div class="tab searchTab1">
        <a id="searchTab1" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'titlelist'), $this);?>
">表</a>
        <?php if (@PM_power == 0): ?>
        <span class="dot">&nbsp;</span>
        <a id="searchTab2" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'titleAdd'), $this);?>
" title="添加技能">加</a>
        <?php endif; ?>
    </div>
</section>

<form action="<?php if ($this->_tpl_vars['titlelist']): ?><?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'titleEditDo','title_id' => $this->_tpl_vars['titlelist']['title_id']), $this);?>
<?php else: ?><?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'titleAddDo'), $this);?>
<?php endif; ?>" method="post" >
	<section class="header clearfix"></section>
	<section class="boxstyle1 top clearfix">
	<table class="table_node">
	  <tr>
	    <td class="label">称谓名</td>
	    <td><span class="li2">
	      <input name="title_name" type="text" id="title_name" value="<?php echo $this->_tpl_vars['titlelist']['title_name']; ?>
" maxlength="45"  datatype="Require" msg="职业名不能为空" class="itext stitle"/>
	    </span></td>
	  </tr>
	  <tr>
	    <td class="label">称谓描述</td>
	    <td><span class="li2">
	      <input name="title_desc" type="text" id="title_desc" value="<?php echo $this->_tpl_vars['titlelist']['title_desc']; ?>
" maxlength="100"  datatype="Require" msg="职业描述不能为空" class="itext title"/>
	    </span></td>
	  </tr>
	</table>
	
	</section>
	<section class="boxstyle2 bottom">
		<input name="" type="submit" value="提交" class="btn btn_main1"/> <a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'titlelist'), $this);?>
" class="btn btn_main2">返回列表</a>
	</section>
	<section class="footer"></section>
	</form>
</article>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript">
 /*
PMS.showSelectList("users","user_id","user_name");

$('#btn_select').click(function(){$('#user_name').val('');$('#user_id').val('0');});

PMS.selected=function(type,user_id,user_name)
{
	var obj_uid=$('#'+$('#inputid_'+type+'_id').val());
	var obj_una=$('#'+$('#inputid_'+type+'_name').val());
	if(obj_uid.val()==0)
	{
		obj_uid.val(user_id);
		obj_una.val(user_name);
	}
	else
	{
		obj_uid.val(obj_uid.val()+'|'+user_id);
		obj_una.val(obj_una.val()+'|'+user_name);
	}
}
*/
</script>
</body>
</html>