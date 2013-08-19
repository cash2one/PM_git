<?php /* Smarty version 2.6.26, created on 2013-05-02 10:21:54
         compiled from public/wraps_popwin.html */ ?>
	<ul class="pop_item_list">
	<?php if ($this->_tpl_vars['prod_id'] == 0): ?>
		<li>请先选择产品</li>
	<?php else: ?>
		<li><a onClick="PMS.selected('<?php echo $this->_tpl_vars['type']; ?>
','','空集')">空集</a></li>
	<?php $_from = $this->_tpl_vars['wrap_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
		<li><a onClick="PMS.selected('<?php echo $this->_tpl_vars['type']; ?>
','<?php echo $this->_tpl_vars['rs']['wrap_id']; ?>
','<?php echo $this->_tpl_vars['rs']['wrap_name']; ?>
')"><?php echo $this->_tpl_vars['rs']['wrap_name']; ?>
</a></li>
	<?php endforeach; endif; unset($_from); ?>
		
	<?php endif; ?>
	</ul>
	<!-- <a class="btn_close" onclick="_$.closewin('#<?php echo $this->_tpl_vars['type']; ?>
_popwin')" title="关闭"></a> -->
	<input type="hidden" id="inputid_<?php echo $this->_tpl_vars['type']; ?>
_id"/>
	<input type="hidden" id="inputid_<?php echo $this->_tpl_vars['type']; ?>
_name"/>