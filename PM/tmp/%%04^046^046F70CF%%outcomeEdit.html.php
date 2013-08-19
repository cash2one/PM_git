<?php /* Smarty version 2.6.26, created on 2013-05-30 10:23:12
         compiled from pg/admin/outcomeEdit.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'pg/admin/outcomeEdit.html', 22, false),)), $this); ?>
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
<body class="pgAdmin outcome">
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
	<?php if ($this->_tpl_vars['outcomelist']): ?>
	修改 - 产出物
	<?php else: ?>
	添加 - 产出物
	<?php endif; ?>
	</h1>
    <div class="tab searchTab1">
        <a id="searchTab1" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'outcomelist'), $this);?>
">表</a>
        <?php if (@PM_power == 0): ?>
        <span class="dot">&nbsp;</span>
        <a id="searchTab2" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'outcomeAdd'), $this);?>
" title="添加产出物">加</a>
        <?php endif; ?>
    </div>
</section>

<form action="<?php if ($this->_tpl_vars['outcomelist']): ?><?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'outcomeEditDo','outcome_id' => $this->_tpl_vars['outcomelist']['outcome_id']), $this);?>
<?php else: ?><?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'outcomeAddDo'), $this);?>
<?php endif; ?>" method="post" >
	<section class="header clearfix"></section>
	<section class="boxstyle1 top clearfix">
	<table class="table_node">
	  <tr>
	    <td class="label">产出物</td>
	    <td><span class="li2">
	      <input name="outcome_name" type="text" id="outcome_name" value="<?php echo $this->_tpl_vars['outcomelist']['outcome_name']; ?>
" maxlength="45"  datatype="Require" msg="产出物不能为空" class="itext stitle"/>
	    </span></td>
	  </tr>
	  <tr>
	    <td class="label">产出物描述</td>
	    <td><span class="li2">
	      <input name="outcome_desc" type="text" id="outcome_desc" value="<?php echo $this->_tpl_vars['outcomelist']['outcome_desc']; ?>
" maxlength="100"  datatype="Require" msg="产出物描述不能为空" class="itext title"/>
	    </span></td>
	  </tr>
	</table>
	
	</section>
	<section class="boxstyle2 bottom">
		<input name="" type="submit" value="提交" class="btn btn_main1"/> <a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'outcomelist'), $this);?>
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

</script>
</body>
</html>