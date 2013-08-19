<?php /* Smarty version 2.6.26, created on 2013-07-30 14:07:21
         compiled from project/projects.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'project/projects.html', 18, false),array('modifier', 'default', 'project/projects.html', 25, false),array('modifier', 'date_format', 'project/projects.html', 64, false),)), $this); ?>
<!DOCTYPE html>
<html lang="zh"> 
<head>
<meta charset="utf-8">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/base.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<link type="text/css"  rel="stylesheet" href="themes/css/jquery.ui.all.css?cache=<?php echo @RD; ?>
" />
<script type="text/javascript" src="themes/js/jquery-ui.last.js?cache=<?php echo @RD; ?>
"></script>
<style>
    .table3 .fNum{padding-left: 10px;}
</style>
</head>
<body class="manage projects">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<article class="content">
	<section class="search">
		<h1><?php echo $this->_tpl_vars['title']; ?>
</h1>
        <div class="tab classTab<?php echo $this->_tpl_vars['type']; ?>
" style="left: 220px;text-align: left;">
            <a id="orginTab1" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project','a' => 'show','type' => 10), $this);?>
" title="组内的提单">内</a>
            <span class="dot">&nbsp;</span>
            <a id="orginTab2" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project','a' => 'show','type' => 100), $this);?>
" title="redmine上的单">RD</a>
        </div>
		<?php if ($this->_tpl_vars['type'] == 1 || $this->_tpl_vars['type'] == 10 || $this->_tpl_vars['type'] == 100): ?>
		<form method="post" action="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project','a' => 'show'), $this);?>
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
			<input type="text" class="itext" name="sk" id="search_sk" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['search_key'])) ? $this->_run_mod_handler('default', true, $_tmp, "输入项目标题关键字") : smarty_modifier_default($_tmp, "输入项目标题关键字")); ?>
" onclick="if(this.value == '输入项目标题关键字')this.value = ''" />
			<input type="submit" value="" title="查询" id="search_btn" class="btnc btnc_search"/>
			<span style="font-size:12px;color:#666666">结果:<?php echo $this->_tpl_vars['pager']['total_count']; ?>
条</span>
		</form>
		<?php endif; ?>
		<div class="tab searchTab<?php echo $this->_tpl_vars['type']; ?>
">
			<a id="searchTab1" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project','a' => 'show'), $this);?>
">全</a>
            <span class="dot">&nbsp;</span>
			<a id="searchTab2" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project','a' => 'show','type' => 2), $this);?>
" title="今天需要完成的项目">今</a>
            <span class="dot">&nbsp;</span>
			<a id="searchTab3" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project','a' => 'show','type' => 3), $this);?>
" title="已经延期的项目">延</a>
            <span class="dot">&nbsp;</span>
			<a id="searchTab4" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project','a' => 'news'), $this);?>
" title="项目的新动态">新</a>
		</div>

	</section>
<?php if ($this->_tpl_vars['rows']): ?>
    <table class="table3">
      <thead>
      <tr class="btop">
      	<td width="13%" class="bleft">所属产品</td>
		<td width="8%">类型</td>
        <td width="44%">项目</td>
		<td width="15%" style="padding-left: 10px;">时间</td>
        <td width="10%">负责人</td>
        <td width="10%" class="bright">进度</td>
      </tr>
      </thead>
      <?php $_from = $this->_tpl_vars['rows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
      <tr class="rowcolor<?php echo $this->_tpl_vars['rs']['proj_state']; ?>
 <?php if ($this->_tpl_vars['rs']['delay'] > 0): ?>delay<?php endif; ?>">
        <td class="bleft"><p><?php echo $this->_tpl_vars['rs']['prod_name']; ?>
</p></td>
		<td><?php echo ((is_array($_tmp=@$this->_tpl_vars['projClass'][$this->_tpl_vars['rs']['proj_class']])) ? $this->_run_mod_handler('default', true, $_tmp, "其它") : smarty_modifier_default($_tmp, "其它")); ?>
</td>
        <td><span style="color:#333;font-family: georgia;">#<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
:</span><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project_bll','a' => 'project_show','id' => $this->_tpl_vars['rs']['proj_id']), $this);?>
" target="_blank"><?php echo $this->_tpl_vars['rs']['proj_name']; ?>
</a></td>
		<td class="fNum"><?php echo ((is_array($_tmp=$this->_tpl_vars['rs']['proj_start'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d") : smarty_modifier_date_format($_tmp, "%m/%d")); ?>
 - <?php echo ((is_array($_tmp=$this->_tpl_vars['rs']['proj_end'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d") : smarty_modifier_date_format($_tmp, "%m/%d")); ?>
<span class="delayText" title="已延期<?php echo $this->_tpl_vars['rs']['delay']; ?>
天">(<?php echo $this->_tpl_vars['rs']['delay']; ?>
)</span></td>
        <td><?php echo $this->_tpl_vars['rs']['user_name']; ?>
</td>
        <td class="tleft bright"><span class="stateicon stateicon_<?php echo $this->_tpl_vars['rs']['proj_state']; ?>
"><?php echo $this->_tpl_vars['state_list'][$this->_tpl_vars['rs']['proj_state']]; ?>
</span></td>
      </tr>
      <?php endforeach; endif; unset($_from); ?>
	  <tfoot>
	  	<tr>
			<td colspan="6">
			<?php if ($this->_tpl_vars['pager']): ?>
			<div class="pager">
			<form action="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project','a' => 'show'), $this);?>
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
<?php else: ?>
<p>查无记录。</p>
<?php endif; ?>

</article>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript">
PMS.showSelectList("products","spid","spn");
PMS.showSelectList("pState","ssid","ssn",{"type":"public"});
PMS.bindDatepickers("#sd1","#sd2");
</script>
</body>
</html>