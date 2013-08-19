<?php /* Smarty version 2.6.26, created on 2013-04-15 15:46:18
         compiled from project/wrapsNav.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'project/wrapsNav.html', 1, false),)), $this); ?>
			<a id="searchTab1" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'wrap'), $this);?>
">表</a>
			<?php if (@PM_power < 2): ?>
            <span class="dot">&nbsp;</span>
			<a id="searchTab2" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'wrap','a' => 'add'), $this);?>
" title="添加项目集">加</a>
			<?php endif; ?>