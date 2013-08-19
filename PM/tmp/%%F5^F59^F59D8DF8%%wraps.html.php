<?php /* Smarty version 2.6.26, created on 2013-04-15 15:46:18
         compiled from project/wraps.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'project/wraps.html', 34, false),)), $this); ?>
<!DOCTYPE html>
<html lang="zh"> 
<head>
<meta charset="utf-8">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/base.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<link type="text/css"  rel="stylesheet" href="themes/css/jquery.ui.all.css" />
<script type="text/javascript" src="themes/js/jquery-ui.last.js"></script>
<script type="text/javascript" src="themes/js/jquery.ui.datepicker-zh-CN.js"></script>
</head>
<body class="manage wraps">

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<article class="content">

	<section class="search">
		<h1>列表 - 项目集</h1>
		<div class="tab searchTab1">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "project/wrapsNav.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
	</section>

	<table class="table3 tablewrap">
	<thead>
	  <tr class="btop">
	  	<td class="bleft">所属产品名</td>
	    <td class="tleft">项目集名</td>
	    <td>状态</td>
	    <td class="bright">&nbsp;</td>
	  </tr>
	  </thead>
	  <?php $_from = $this->_tpl_vars['rows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>  
	  <tr id="wrap_id_<?php echo $this->_tpl_vars['rs']['wrap_id']; ?>
" class="rowcolor<?php echo $this->_tpl_vars['rs']['wrap_state']; ?>
">
	 	<td class="bleft"><?php echo $this->_tpl_vars['rs']['prod_name']; ?>
</td>
	    <td class="tleft"><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'wrap','a' => 'showWrap','wrapId' => $this->_tpl_vars['rs']['wrap_id']), $this);?>
"><?php echo $this->_tpl_vars['rs']['wrap_name']; ?>
</a></td>
	    <td><?php echo $this->_tpl_vars['state_list'][$this->_tpl_vars['rs']['wrap_state']]; ?>
</td>
	    <td class="bright"><?php if ($this->_tpl_vars['isManager']): ?><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'wrap','a' => 'edit','wrap_id' => $this->_tpl_vars['rs']['wrap_id']), $this);?>
">修改</a> | <a onclick="wrap_del(<?php echo $this->_tpl_vars['rs']['wrap_id']; ?>
)">删除</a><?php endif; ?></td>
	  </tr>
	  <?php endforeach; endif; unset($_from); ?>
	  
	  <tfoot>
	  	<tr>
			<td colspan="4">
			<?php if ($this->_tpl_vars['pager']): ?>
			<div class="pager">
			页码：<?php echo $this->_tpl_vars['pager']['current_page']; ?>
/<?php echo $this->_tpl_vars['pager']['total_page']; ?>

			<?php $_from = $this->_tpl_vars['pager']['all_pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['thepage']):
?>
			    <?php if ($this->_tpl_vars['thepage'] != $this->_tpl_vars['pager']['current_page']): ?>
					<a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'product','a' => 'showlist','topage' => $this->_tpl_vars['thepage']), $this);?>
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
<script type="text/javascript">
function wrap_del(wrap_id)
{
	if(confirm('此操作将不可撤销，确定要删除？'))
	{
		var url='<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'wrap','a' => 'wrap_del','wrap_id' => "{@wrap_id}"), $this);?>
';
		url=url.replace(/{@wrap_id}/,wrap_id);
		$.get(url,function(msg){
						   if(msg.rs==1)
								$('#wrap_id_'+wrap_id).remove();
							else alert(msg.des);
						   },"json")
	}
}
</script>
</body>
</html>