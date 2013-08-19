<?php /* Smarty version 2.6.26, created on 2013-04-12 14:28:49
         compiled from project/products.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'project/products.html', 33, false),array('function', 'spUrl', 'project/products.html', 34, false),)), $this); ?>
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
	<h1>列表 - 产品</h1>
	<div class="tab searchTab1">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "project/productNav.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
</section>
<table class="table3">
<thead>
  <tr class="btop">
    <td class="bleft">产品id</td>
    <td class="tleft">产品名</td>
    <td class="tleft">英文缩写</td>
	<td class="tleft">分类</td>
	<td>产品负责人</td>
    <td class="bright">&nbsp;</td>
  </tr>
  </thead>
  <?php $_from = $this->_tpl_vars['plist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>  
  <tr>
    <td class="bleft"><?php echo $this->_tpl_vars['rs']['prod_id']; ?>
</td>
    <td class="tleft"><?php echo $this->_tpl_vars['rs']['prod_name']; ?>
</td>
    <td class="tleft"><?php echo $this->_tpl_vars['rs']['prod_ename']; ?>
</td>
	<td class="tleft"><?php echo $this->_tpl_vars['productType'][$this->_tpl_vars['rs']['prod_type']]; ?>
</td>
	<td><?php echo ((is_array($_tmp=@$this->_tpl_vars['rs']['prod_unamelist'])) ? $this->_run_mod_handler('default', true, $_tmp, "待定") : smarty_modifier_default($_tmp, "待定")); ?>
</td>
    <td class="bright"><?php if ($this->_tpl_vars['isManager']): ?><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'product','a' => 'edit','prod_id' => $this->_tpl_vars['rs']['prod_id']), $this);?>
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
					<a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'product','a' => 'slist','topage' => $this->_tpl_vars['thepage']), $this);?>
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
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>
</html>