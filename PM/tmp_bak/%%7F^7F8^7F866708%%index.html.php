<?php /* Smarty version 2.6.26, created on 2013-04-15 14:45:52
         compiled from toolFiles/index.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'toolFiles/index.html', 41, false),array('modifier', 'default', 'toolFiles/index.html', 62, false),)), $this); ?>
<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="utf-8">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/base.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<link type="text/css"  rel="stylesheet" href="themes/css/jquery.ui.all.css?<?php echo @RD; ?>
" />
<link type="text/css"  rel="stylesheet" href="themes/css/projectshow.css?<?php echo @RD; ?>
" />
<script type="text/javascript" src="themes/js/jquery-ui.last.js?<?php echo @RD; ?>
"></script>
<script type="text/javascript" src="themes/js/jquery.ui.datepicker-zh-CN.js?<?php echo @RD; ?>
"></script>
<style type="text/css">
.header { height:40px }
.configSetting { padding:5px 0 0 10px }
.report-list { font-size:12px; list-style:none; padding:0; margin:0 }
.report-list li { padding-left:40px; line-height:30px }
.report-title { }
.report-row-note { }
.report-row-note .report-row-notetxt { display:none; width:300px; border:none; background:#FFF; height:20px; line-height:20px }
.report-row-act { color:#0368B0 }
.writting, .writed { background: none repeat scroll 0 0 #FFFFFF; border: 1px solid #CCCCCC; border-radius: 3px 3px 3px 3px; color: #666666; line-height: 18px; overflow: visible; padding: 5px; position: relative; white-space: normal; width: 400px; display:inline-block; }
.writting i, .writed i { background: url("themes/images/arrow.png") repeat scroll 0 0 transparent; display: block; height: 9px; left: -5px; position: absolute; top: 8px; width: 6px; }
.writting .report-row-notetxt { display:inline; border:#CCC 1px solid; background:#FFF }
.writed .report-row-notetxt { display:inline; }
.report-state-15 { color:#11AC34 }
.report-state-100 { color:#CB0004 }
.report-type-10, .report-type-30 { color:#0033FF; }
.report-type-20, .report-type-40 { color:#CC640B }
.beforeResult { height:300px; line-height:300px; font-size:14px; text-align:center; color:#0099FF }

#main-list{overflow:hidden}

.adjunct-list li{margin:10px 17px}
</style>
</head><body class="manage tool-files">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<article class="content">
	<section class="search">
		<h1 class="pageTitle">设计稿</h1>
	</section>
	<section class="header">
		<div class="configSetting"> 
		<form method="post" action="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'toolFiles','a' => 'show'), $this);?>
" id="configSetting">
			<span>查询条件</span>
			<input type="text" class="itext select" name="spn" id="spn" readonly  placeholder="选择产品"  value="<?php echo $this->_tpl_vars['spn']; ?>
"/>
			<input type="hidden" name="spid" id="spid" value="<?php echo $this->_tpl_vars['spid']; ?>
"/>
			<input type="text" class="itext select date" id="sd1" name="sd1" readonly placeholder="开始日期" value="<?php echo $this->_tpl_vars['sd1']; ?>
"/> <span>-</span>
			<input type="text" class="itext select date" id="sd2" name="sd2" readonly placeholder="结束日期"  value="<?php echo $this->_tpl_vars['sd2']; ?>
"/>
			<input type="text" class="itext select date" id="user-name" name="uname" readonly  placeholder="选择用户" value="<?php echo $this->_tpl_vars['uname']; ?>
"/>
			<input type="hidden" class="itext select date" id="uid" name="uid" value="<?php echo $this->_tpl_vars['uid']; ?>
"/>
			<input type="button" value="确定" id="btnGetFile" class="btn btns_text">
			<input type="button" value="重设" id="btnReset"  class="btn btns_text">
			<?php if ($this->_tpl_vars['files']): ?>
			<a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'toolFiles','a' => 'packDownload','sd1' => $this->_tpl_vars['sd1'],'sd2' => $this->_tpl_vars['sd2'],'spid' => $this->_tpl_vars['spid'],'uid' => $this->_tpl_vars['uid']), $this);?>
" class="btn btns_text" target="_blank">打包下载</a>
			<?php endif; ?>
		</form>
		</div>
	</section>
	<section class="boxstyle1" id="main-list">
		<?php if ($this->_tpl_vars['isShowResult']): ?>
			<ul class="adjunct-list">
			<?php $_from = $this->_tpl_vars['files']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs2']):
?>
				<li id="file_row_<?php echo $this->_tpl_vars['rs2']['file_id']; ?>
">
					<a href="<?php echo $this->_tpl_vars['rs2']['file_url']; ?>
" target="_blank" class="file <?php echo ((is_array($_tmp=@$this->_tpl_vars['rs2']['ext'])) ? $this->_run_mod_handler('default', true, $_tmp, 'floder') : smarty_modifier_default($_tmp, 'floder')); ?>
"><img src="<?php echo $this->_tpl_vars['rs2']['file_url']; ?>
" width="128" height="128"/></a>
					<div class="fileInfo">
						<a href="<?php echo $this->_tpl_vars['rs2']['file_url']; ?>
" target="_blank">
							<p><?php echo $this->_tpl_vars['rs2']['file_name']; ?>
</p>
							<p>上传：<?php echo $this->_tpl_vars['rs2']['uname']; ?>
</p>
						</a>
					</div>
					<div class="fileControl">
						<a onClick="PMS.showNode(<?php echo $this->_tpl_vars['rs2']['pnod_id']; ?>
)" class="" title="查看流程">查看流程</a>
					</div>
				</li>
			<?php endforeach; endif; unset($_from); ?> 
			</ul>
			<?php if ($this->_tpl_vars['pager']): ?>
			<div class="pager">
			<form action="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'toolFiles','a' => 'show'), $this);?>
#main-list" method="post" id="pagerForm">
				页码：<?php echo $this->_tpl_vars['pager']['current_page']; ?>
/<?php echo $this->_tpl_vars['pager']['total_page']; ?>

				<input type="button" value="上一页" id="pagerPrev"/>
				<input type="button" value="下一页" id="pagerNext"/>
				<input type="text" class="itext ipage" id="pagerToPage"/> 
				<input type="submit" value="GO" id="pagerGo"/>
				<input type="hidden" name="p" value="<?php echo $this->_tpl_vars['pager']['current_page']; ?>
"/>
				<input type="hidden" name="spid" value="<?php echo $this->_tpl_vars['spid']; ?>
"/>
				<input type="hidden" name="spn" value="<?php echo $this->_tpl_vars['spn']; ?>
"/>
				<input type="hidden" name="sd1" value="<?php echo $this->_tpl_vars['sd1']; ?>
"/>
				<input type="hidden" name="sd2" value="<?php echo $this->_tpl_vars['sd2']; ?>
"/>
				<input type="hidden" name="uid" value="<?php echo $this->_tpl_vars['uid']; ?>
"/>
				<input type="hidden" name="uname" value="<?php echo $this->_tpl_vars['uname']; ?>
"/>
			</form>
			<script type="text/javascript">PMS.listPage('<?php echo $this->_tpl_vars['pager']['current_page']; ?>
','<?php echo $this->_tpl_vars['pager']['total_page']; ?>
')</script>
			</div>
			<?php endif; ?>
		<?php else: ?>
		<p class="beforeResult">选择好条件后点击【确定】，不限定则不用选择。</p>
		<?php endif; ?>
	</section>
	<section class="footer"></section>
</article>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 
<script type="text/javascript">
$("#sd1").datepicker();
$("#sd2").datepicker();
PMS.showSelectList("products","spid","spn");
PMS.showSelectList("users","uid","user-name");
$("#btnGetFile").click(function(){
	$("#configSetting").submit();
});

$("#btnReset").click(function(){
	$("#configSetting input[type=text]").val('');
	$("#configSetting input[type=hidden]").val('');
})
</script>
</body>