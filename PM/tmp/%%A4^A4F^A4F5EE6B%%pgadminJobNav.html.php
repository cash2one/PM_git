<?php /* Smarty version 2.6.26, created on 2013-07-08 15:50:39
         compiled from pg/admin/pgadminJobNav.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'pg/admin/pgadminJobNav.html', 1, false),)), $this); ?>
			<a id="searchTab1" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'joblist'), $this);?>
">表</a>
			<?php if (@PM_power == 0): ?>
            <span class="dot">&nbsp;</span>
			<a id="searchTab2" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'jobAdd'), $this);?>
" title="添加职业">加</a>
			<?php endif; ?>