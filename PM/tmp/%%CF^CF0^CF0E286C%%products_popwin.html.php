<?php /* Smarty version 2.6.26, created on 2013-04-15 15:45:47
         compiled from public/products_popwin.html */ ?>
	<ul class="pop_item_list game">
		<li class="title">游戏产品</li>
		<?php $_from = $this->_tpl_vars['rs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
		<?php if ($this->_tpl_vars['v']['prod_type'] == 0): ?>
		<li class="iconGame iconGame_<?php echo $this->_tpl_vars['v']['prod_ename']; ?>
"><a onClick="PMS.selected('products','<?php echo $this->_tpl_vars['v']['prod_id']; ?>
','<?php echo $this->_tpl_vars['v']['prod_name']; ?>
')" class="<?php echo $this->_tpl_vars['v']['prod_ename']; ?>
"><?php echo $this->_tpl_vars['v']['prod_name']; ?>
</a></li>
		<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
	</ul>
	<ul class="pop_item_list order">
		<li class="title">其它产品</li>
		<?php $_from = $this->_tpl_vars['rs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
		<?php if ($this->_tpl_vars['v']['prod_type'] == 1): ?>
		<li class="iconGame iconGame_<?php echo $this->_tpl_vars['v']['prod_ename']; ?>
"><a onClick="PMS.selected('products','<?php echo $this->_tpl_vars['v']['prod_id']; ?>
','<?php echo $this->_tpl_vars['v']['prod_name']; ?>
')" class="<?php echo $this->_tpl_vars['v']['prod_ename']; ?>
"><?php echo $this->_tpl_vars['v']['prod_name']; ?>
</a></li>
		<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		<li><a onClick="PMS.selected('products','','全部产品')" class="all">全部产品</a></li>
	</ul>
	<!-- <a class="btn_close" onclick="_$.closewin('#products_popwin')" title="关闭"></a> -->
	<input type="hidden" id="inputid_products_id"/>
	<input type="hidden" id="inputid_products_name"/>