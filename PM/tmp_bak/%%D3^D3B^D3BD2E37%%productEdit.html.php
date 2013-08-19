<?php /* Smarty version 2.6.26, created on 2013-04-12 14:56:39
         compiled from project/productEdit.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'project/productEdit.html', 18, false),array('modifier', 'default', 'project/productEdit.html', 54, false),)), $this); ?>
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
<body class="manage products">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<article class="content">

<section class="search">
	<h1>添加 - 产品</h1>
	<div class="tab searchTab2">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "project/productNav.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
</section>

<form action="<?php if ($this->_tpl_vars['product']): ?><?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'product','a' => 'editDo','prod_id' => $this->_tpl_vars['product']['prod_id']), $this);?>
<?php else: ?><?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'product','a' => 'addDo'), $this);?>
<?php endif; ?>" method="post"  onSubmit="return Validator.Validate(this,2)">
	<section class="header clearfix"></section>
	<section class="boxstyle1 top clearfix">
	<table class="table_node">
	  <tr>
	    <td>产品名</td>
	    <td><span class="li2">
	      <input name="prod_name" type="text" id="prod_name" value="<?php echo $this->_tpl_vars['product']['prod_name']; ?>
" maxlength="45"  datatype="Require" msg="产品名不能为空" class="itext title"/>
	    </span></td>
	  </tr>
	  <tr>
	    <td>英文缩写</td>
	    <td><span class="li2">
	      <input name="prod_ename" type="text" id="prod_ename" value="<?php echo $this->_tpl_vars['product']['prod_ename']; ?>
" maxlength="20"  datatype="Require" msg="英文给缩写不能为空" class="itext stitle"/>
	    </span></td>
	  </tr>
	  <tr>
	    <td>分类</td>
	    <td><span class="li2">
			<select class="itext" name="prod_type" id="prod_type">
				<option></option>
				<?php $_from = $this->_tpl_vars['productType']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if ($this->_tpl_vars['product']['prod_type'] == $this->_tpl_vars['k']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['v']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
	    </span></td>
	  </tr>
	  <tr>
	    <td>测试机地址</td>
	    <td><span class="li2">
	      <input name="prod_Url" type="text" id="prod_Url" value="<?php echo $this->_tpl_vars['product']['prod_Url']; ?>
" maxlength="30" class="itext stitle"/>
	    </span></td>
	  </tr>  
	  <tr>
	    <td>负责人<span style="color:#F00;cursor:pointer" id="btn_select">[清空]</span></td>
	    <td>
		<input id="user_name" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['product']['prod_unamelist'])) ? $this->_run_mod_handler('default', true, $_tmp, "待定") : smarty_modifier_default($_tmp, "待定")); ?>
" readonly class="itext stitle select"/></input>
		<input name="user_id" type="hidden" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['product']['prod_uidlist'])) ? $this->_run_mod_handler('default', true, $_tmp, '0') : smarty_modifier_default($_tmp, '0')); ?>
"  id="user_id"/>
		</td>
	  </tr>
	</table>
	
	</section>
	<section class="boxstyle2 bottom">
		<input name="" type="submit" value="提交" class="btn btn_main1"/> <a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'product','a' => 'slist'), $this);?>
" class="btn btn_main2">返回列表</a>
	</section>
	<section class="footer"></section>
	</form>
</article>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript">

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

</script>
</body>
</html>