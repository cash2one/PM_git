<?php /* Smarty version 2.6.26, created on 2013-08-14 10:38:54
         compiled from pg/admin/jobsEdit.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'pg/admin/jobsEdit.html', 26, false),)), $this); ?>
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
<body class="pgAdmin pgAdminJobEdit jobs">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="wrap">
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pg/admin/pgadminNav.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<article class="content">

<section class="search">
	<h1>
	<?php if ($this->_tpl_vars['joblist']): ?>    
          			修改 - 职业
     <?php else: ?>
     			添加 - 职业
     <?php endif; ?>
	</h1>
	<div class="tab searchTab2">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pg/admin/pgadminJobNav.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
</section>

<form action="<?php if ($this->_tpl_vars['joblist']): ?><?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'jobEditDo','job_id' => $this->_tpl_vars['joblist']['job_id']), $this);?>
<?php else: ?><?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'jobAddDo'), $this);?>
<?php endif; ?>" method="post" >
	<section class="header clearfix"></section>
	<section class="boxstyle1 top clearfix">
	<table class="table_node">
	  <tr>
	    <td class="label">职业名</td>
	    <td><span class="li2">
	      <input name="job_name" type="text" id="job_name" value="<?php echo $this->_tpl_vars['joblist']['job_name']; ?>
" maxlength="45"  datatype="Require" msg="职业名不能为空" class="itext stitle"/>
	    </span></td>
	  </tr>
	  <tr>
	    <td class="label">职业描述</td>
	    <td><span class="li2">
	      <input name="job_desc" type="text" id="job_desc" value="<?php echo $this->_tpl_vars['joblist']['job_desc']; ?>
" maxlength="100"  datatype="Require" msg="职业描述不能为空" class="itext title"/>
	    </span></td>
	  </tr>
	</table>
	
	</section>
	<section class="boxstyle2 bottom">
		<input name="" type="submit" value="提交" class="btn btn_main1"/> <a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'joblist'), $this);?>
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