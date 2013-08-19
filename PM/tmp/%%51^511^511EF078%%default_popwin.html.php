<?php /* Smarty version 2.6.26, created on 2013-04-15 15:45:49
         compiled from public/default_popwin.html */ ?>
	<ul class="pop_item_list">
	<?php $_from = $this->_tpl_vars['rs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['obj']):
?>
	<?php if ($this->_tpl_vars['obj']): ?>
		<li><a onClick="PMS.selected('<?php echo $this->_tpl_vars['type']; ?>
','<?php echo $this->_tpl_vars['k']; ?>
','<?php echo $this->_tpl_vars['obj']; ?>
')"><?php echo $this->_tpl_vars['obj']; ?>
</a></li>
	<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	<?php $_from = $this->_tpl_vars['extent']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k2'] => $this->_tpl_vars['obj2']):
?>
		<li><a onClick="PMS.selected('<?php echo $this->_tpl_vars['type']; ?>
','<?php echo $this->_tpl_vars['k2']['value']; ?>
','<?php echo $this->_tpl_vars['obj2']['name']; ?>
')"><?php echo $this->_tpl_vars['obj2']['name']; ?>
</a></li>
	<?php endforeach; endif; unset($_from); ?>
    <?php if (! $this->_tpl_vars['obj'] && ! $this->_tpl_vars['extent']): ?>
    	<li>请先选择上一层</li>
    <?php endif; ?>
	</ul>
	<!-- <a class="btn_close" onclick="_$.closewin('#<?php echo $this->_tpl_vars['type']; ?>
_popwin')" title="关闭"></a> -->
	<input type="hidden" id="inputid_<?php echo $this->_tpl_vars['type']; ?>
_id"/>
	<input type="hidden" id="inputid_<?php echo $this->_tpl_vars['type']; ?>
_name"/>