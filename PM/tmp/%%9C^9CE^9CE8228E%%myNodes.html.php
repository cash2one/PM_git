<?php /* Smarty version 2.6.26, created on 2013-04-12 16:19:51
         compiled from project/myNodes.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'project/myNodes.html', 17, false),array('modifier', 'default', 'project/myNodes.html', 19, false),array('modifier', 'date_format', 'project/myNodes.html', 45, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/base.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<link type="text/css"  rel="stylesheet" href="themes/css/jquery.ui.all.css" />
<script type="text/javascript" src="themes/js/jquery-ui.last.js"></script>
<script type="text/javascript" src="themes/js/jquery.ui.datepicker-zh-CN.js"></script>
<stype>
</stype>
</head>
<body class="mywork myNodes">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<article class="content">

	<section class="search">
		<form method="post" action="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pnode','a' => 'show','oUserId' => $this->_tpl_vars['oUserId']), $this);?>
" onsubmit="return PMS.checkSearch()">
			<span>搜索</span>
			<input type="text" class="itext select" name="spn" id="spn" readonly value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['prod_name'])) ? $this->_run_mod_handler('default', true, $_tmp, "选择产品") : smarty_modifier_default($_tmp, "选择产品")); ?>
"/>
			<input type="hidden" name="spid" id="spid" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['prod_id'])) ? $this->_run_mod_handler('default', true, $_tmp, '0') : smarty_modifier_default($_tmp, '0')); ?>
"/>
			<input type="text" class="itext select date" id="ssn" readonly value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['state_list'][$this->_tpl_vars['proj_state']])) ? $this->_run_mod_handler('default', true, $_tmp, "选择状态") : smarty_modifier_default($_tmp, "选择状态")); ?>
"/>
			<input type="hidden" name="ssid" id="ssid" value="<?php echo $this->_tpl_vars['proj_state']; ?>
"/>
			<input type="text" class="itext select date" id="sd1" name="sd1" readonly value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['search_dates'])) ? $this->_run_mod_handler('default', true, $_tmp, "开始日期") : smarty_modifier_default($_tmp, "开始日期")); ?>
"/> <span>-</span>
			<input type="text" class="itext select date" id="sd2" name="sd2" readonly value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['search_datee'])) ? $this->_run_mod_handler('default', true, $_tmp, "结束日期") : smarty_modifier_default($_tmp, "结束日期")); ?>
"/>
			<input type="text" class="itext" name="sk" id="search_sk" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['search_key'])) ? $this->_run_mod_handler('default', true, $_tmp, "输入流程标题关键字") : smarty_modifier_default($_tmp, "输入流程标题关键字")); ?>
" onclick="if(this.value == '输入流程标题关键字')this.value = ''" />
			<input type="submit" value="" title="查询" id="search_btn" class="btnc btnc_search"/>
		</form>
	</section>

	<table class="table3">
      <thead>
      <tr class="btop">
      	<td width="12%" class="bleft">产品</td>
		<td width="20%">项目</td>
        <td width="33%">流程</td>
		<td width="15%">时间</td>
        <td width="20%" class="bright">进度</td>
      </tr>
      </thead>
      <?php $_from = $this->_tpl_vars['rows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
      <tr class="rowcolor<?php echo $this->_tpl_vars['rs']['pnod_state']; ?>
 <?php if ($this->_tpl_vars['rs']['delay'] > 0): ?>delay<?php endif; ?>">
        <td class="bleft"><?php echo $this->_tpl_vars['rs']['prod_name']; ?>
</td>
		<td><p><?php echo $this->_tpl_vars['rs']['proj_name']; ?>
</p></td>
        <td><a onclick="PMS.showNode(<?php echo $this->_tpl_vars['rs']['pnod_id']; ?>
)"><?php echo $this->_tpl_vars['rs']['pnod_name']; ?>
</a></td>
		<td class="tleft fNum"><?php echo ((is_array($_tmp=$this->_tpl_vars['rs']['pnod_time_s'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d") : smarty_modifier_date_format($_tmp, "%m/%d")); ?>
 - <?php echo ((is_array($_tmp=$this->_tpl_vars['rs']['pnod_time_e'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d") : smarty_modifier_date_format($_tmp, "%m/%d")); ?>
<span class="delayText" title="已延期<?php echo $this->_tpl_vars['rs']['delay']; ?>
天">(<?php echo $this->_tpl_vars['rs']['delay']; ?>
)</span></td>
        <td class="tleft bright"><span class="stateicon stateicon_<?php echo $this->_tpl_vars['rs']['pnod_state']; ?>
"><?php echo $this->_tpl_vars['state_list'][$this->_tpl_vars['rs']['pnod_state']]; ?>
</span></td>
      </tr>
      <?php endforeach; endif; unset($_from); ?>
	  <tfoot>
	  	<tr>
			<td colspan="5">
			<?php if ($this->_tpl_vars['pager']): ?>
			<div class="pager">
			<form action="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pnode','a' => 'show','oUserId' => $this->_tpl_vars['oUserId']), $this);?>
" method="post" id="pagerForm">
				页码：<?php echo $this->_tpl_vars['pager']['current_page']; ?>
/<?php echo $this->_tpl_vars['pager']['total_page']; ?>

				<input type="button" value="上一页" id="pagerPrev"/>
				<input type="button" value="下一页" id="pagerNext"/>
				<input type="text" class="itext ipage" id="pagerToPage"/> <input type="submit" value="GO" id="pagerGo"/>
				<input type="hidden" name="p" value="<?php echo $this->_tpl_vars['pager']['current_page']; ?>
"/>
				<input type="hidden" name="ssid" value="<?php echo $this->_tpl_vars['proj_state']; ?>
"/>
				<input type="hidden" name="spid" value="<?php echo $this->_tpl_vars['prod_id']; ?>
"/>
				<input type="hidden" name="sd1" value="<?php echo $this->_tpl_vars['search_dates']; ?>
"/>
				<input type="hidden" name="sd2" value="<?php echo $this->_tpl_vars['search_datee']; ?>
"/>
				<input type="hidden" name="type" value="<?php echo $this->_tpl_vars['type']; ?>
"/>
				<input type="hidden" name="sk" value="<?php echo $this->_tpl_vars['search_key']; ?>
"/>
			</form>
			<script type="text/javascript">PMS.listPage('<?php echo $this->_tpl_vars['pager']['current_page']; ?>
','<?php echo $this->_tpl_vars['pager']['total_page']; ?>
')</script>
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
PMS.showSelectList("products","spid","spn");
PMS.showSelectList("pState","ssid","ssn",{"type":"public"});
$("#sd1").datepicker();
$("#sd2").datepicker();
</script>
</body>
</html>