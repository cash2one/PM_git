<?php /* Smarty version 2.6.26, created on 2013-04-12 14:28:49
         compiled from project/productNav.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'project/productNav.html', 1, false),)), $this); ?>
			<a id="searchTab1" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'product','a' => 'slist'), $this);?>
">表</a>
			<?php if (@PM_power == 0): ?>
            <span class="dot">&nbsp;</span>
			<a id="searchTab2" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'product','a' => 'add'), $this);?>
" title="添加产品">加</a>
			<?php endif; ?>