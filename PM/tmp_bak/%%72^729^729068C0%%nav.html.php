<?php /* Smarty version 2.6.26, created on 2013-04-12 16:19:48
         compiled from toolWeekReport/nav.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'toolWeekReport/nav.html', 1, false),)), $this); ?>
				<a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'toolWeekReport'), $this);?>
" id="searchTab1" title="写周报">写</a>
	            <span class="dot">&nbsp;</span>
				<a title="今天需要完成的项目" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'toolWeekReport','a' => 'check'), $this);?>
" id="searchTab2" title="查看我收到的周报">查</a> 
	            <span class="dot">&nbsp;</span>
				<a title="今天需要完成的项目" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'toolWeekReport','a' => 'my'), $this);?>
" id="searchTab3" title="我的周报">我</a> 