<?php /* Smarty version 2.6.26, created on 2013-07-08 15:50:39
         compiled from pg/admin/jobs.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'pg/admin/jobs.html', 32, false),)), $this); ?>
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
<body class="pgAdmin jobs">
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
	<h1>列表 - 职业一览</h1>
	<div class="tab searchTab1">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pg/admin/pgadminJobNav.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
</section>
<table class="table3">
<thead>
  <tr class="btop">
    <td class="bleft">职业id</td>
    <td class="tleft">职业名</td>
    <td class="tleft">职业描述</td>
    <td class="bright">&nbsp;</td>
  </tr>
  </thead>
  <?php $_from = $this->_tpl_vars['joblist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
  <tr>
    <td class="bleft"><?php echo $this->_tpl_vars['rs']['job_id']; ?>
</td>
    <td class="tleft"><?php echo $this->_tpl_vars['rs']['job_name']; ?>
</td>
    <td class="tleft"><?php echo $this->_tpl_vars['rs']['job_desc']; ?>
</td>
    <td class="bright"><?php if ($this->_tpl_vars['isManager']): ?><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'jobEdit','job_id' => $this->_tpl_vars['rs']['job_id']), $this);?>
">修改</a><?php endif; ?></td>
  </tr>
  <?php endforeach; endif; unset($_from); ?>
	<tfoot>
	  	<tr>
			<td colspan="6">
			<?php if ($this->_tpl_vars['pager']): ?>
			<div class="pager">
			页码：<?php echo $this->_tpl_vars['pager']['current_page']; ?>
/<?php echo $this->_tpl_vars['pager']['total_page']; ?>

			<?php $_from = $this->_tpl_vars['pager']['all_pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['thepage']):
?>
			    <?php if ($this->_tpl_vars['thepage'] != $this->_tpl_vars['pager']['current_page']): ?>
					<a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'jobList','topage' => $this->_tpl_vars['thepage']), $this);?>
"><?php echo $this->_tpl_vars['thepage']; ?>
</a>
			    <?php else: ?>
			    	<span><?php echo $this->_tpl_vars['thepage']; ?>
</span>
			    <?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
			</div>
			<?php endif; ?>
			</td>
		</tr>
	  </tfoot>	  
  
</table>
</article>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>
</html>