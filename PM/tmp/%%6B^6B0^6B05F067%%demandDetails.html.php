<?php /* Smarty version 2.6.26, created on 2013-03-06 15:33:39
         compiled from tdSystem/demandDetails.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'tdSystem/demandDetails.html', 33, false),array('modifier', 'strip_tags', 'tdSystem/demandDetails.html', 60, false),)), $this); ?>
<!DOCTYPE html>
<html lang="zh"> 
<head>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/base.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<link rel="stylesheet" href="themes/css/popwin.css?cache=<?php echo @RD; ?>
" />
<link rel="stylesheet" href="themes/css/projectshow.css?cache=<?php echo @RD; ?>
" />
<link type="text/css"  rel="stylesheet" href="themes/css/jquery.ui.all.css?cache=<?php echo @RD; ?>
" />
<script type="text/javascript" src="themes/js/jquery-ui.last.js?cache=<?php echo @RD; ?>
"></script>
<script type="text/javascript" src="themes/js/vilidate.js?cache=<?php echo @RD; ?>
"></script>
<style type="text/css">
.kv-list{width:100%;color:#333333}
.kv-list li{overflow:hidden;clear:both;padding:5px;line-height:30px;border-bottom:1px dotted #CCC}
.kv-list .title,.kv-list .value{float:left;}
.kv-list .title{width:90px;font-weight:bold;text-align:right}
.kv-list .value{width:780px;}
</style>
</head>
<body id="projectShow" class="manage project_show">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<article class="content">

		<section class="search">
        	<h1 class="pageTitle">需求单信息 - <?php echo $this->_tpl_vars['rs']['dName']; ?>
</h1>
<?php if ($this->_tpl_vars['project']): ?>
	        <div class="tab searchTab4">
				<?php if (@PM_power == 0): ?>
				<a title="审核项目" href="index.php?c=project_bll&a=project_show_check&id=<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
" id="searchTab1">审</a>
	            <span class="dot">&nbsp;</span>
				<?php endif; ?>
				<a title="浏览项目" href="index.php?c=project_bll&a=project_show&id=<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
" id="searchTab2">看</a>
				<?php if ($this->_tpl_vars['isCanModify']): ?>
				<span class="dot">&nbsp;</span>
				<a title="修改项目" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project_bll','a' => 'projEdit','id' => $this->_tpl_vars['rs']['proj_id']), $this);?>
" id="searchTab3">修</a>
				<?php endif; ?>
				<span class="dot">&nbsp;</span>
				<a title="该项目的需求单" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'tdSystem','a' => 'showDetails'), $this);?>
&dId=<?php echo $this->_tpl_vars['rs']['did']; ?>
" id="searchTab4">需</a>
			</div>
<?php endif; ?>
        </section>

		<section class="header"></section>
		<section class="boxstyle1 top proj_info">
			<h2><?php echo $this->_tpl_vars['rs']['dName']; ?>
</h2>
			<ul class="kv-list clearfix2">
				<li><div class="title">所属产品：</div><div class="value"><?php echo $this->_tpl_vars['rs']['pName']; ?>
</div></li>
				<li><div class="title">项目目的：</div><div class="value"><?php echo $this->_tpl_vars['rs']['dTarget']; ?>
</div></li>
				<li><div class="title">项目量级：</div><div class="value">浏览量：<?php echo $this->_tpl_vars['rs']['dPageView']; ?>
 / 分享量：<?php echo $this->_tpl_vars['rs']['dShare']; ?>
 / 参与量：<?php echo $this->_tpl_vars['rs']['dPartake']; ?>
</div></li>
				<li><div class="title">提单时间：</div><div class="value"><?php echo $this->_tpl_vars['rs']['dHandinTime']; ?>
</div></li>
				<li><div class="title">上线时间：</div><div class="value"><?php echo $this->_tpl_vars['rs']['dOnlineTime']; ?>
</div></li>
				<li>
					<div class="title">目标用户：</div>
					<div class="value">
						<p><?php echo $this->_tpl_vars['rs']['dTargetUser']; ?>
</p>
						<p><?php echo $this->_tpl_vars['rs']['dTargetSource']; ?>
</p>
					</div>
				</li>
				<li>
					<div class="title">内容概述：</div>
					<div class="value">
						<p><?php echo ((is_array($_tmp=$this->_tpl_vars['rs']['dOverView'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)); ?>
</p>
					</div>
				</li>
				<li><div class="title">功能需求：</div><div class="value"><?php echo $this->_tpl_vars['rs']['dDemand']; ?>
</div></li>
				<li><div class="title">是否勾通：</div><div class="value"><?php echo $this->_tpl_vars['rs']['dIsCom']; ?>
</div></li>
				<li>
					<div class="title">其　　它：</div>
					<div class="value">
						<p><?php echo ((is_array($_tmp=$this->_tpl_vars['rs']['dRemark'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)); ?>
</p>
					</div>
				</li>
				<li><div class="title">提 单 人：</div><div class="value"><?php echo $this->_tpl_vars['rs']['dUName']; ?>
</div></li>
			</ul>
		</section>
		<?php if (! $this->_tpl_vars['isCreated']): ?>
		<section class="boxstyle2 proj_info">
			<form id="passForm" method="post">
			<ul class="kv-list clearfix2">
				<li>
					<div class="title">按排负责人：</div>
					<div class="value">
						<input name="user_name" id="user_name" type="text"  autocomplete="off" readonly  class="itext date select" value=""/>
		       			<input name="user_id" id="user_id" type="hidden" value=""/>
					</div>
				</li>
				<li>
					<div class="title">意　　　见：</div>
					<div class="value">
						<textarea name="comment" style="width:100%;height:30px;padding:10px" placeholder="退回填写原因，通过可留空"></textarea>
					</div>
				</li>
			</ul>
			<input type="hidden" name="dId" value="<?php echo $this->_tpl_vars['rs']['dId']; ?>
">
			<input type="hidden" name="prod_id" value="<?php echo $this->_tpl_vars['rs']['dProduct']; ?>
">
			<input type="hidden" name="prod_name" value="<?php echo $this->_tpl_vars['rs']['pName']; ?>
">
			</form>
		</section>
				
		<section class="boxstyle1 bottom clearfix">
			<div class="proj_control btns-box">
				<a href="javascript:;" class="btn btn_main2" id="btn-revoke">退回</a>
				<a href="javascript:;" class="btn btn_main1" id="btn-pass">通过</a>
			</div>
		</section>
		<?php endif; ?>
		<section class="footer"></section>

</article>
<!--content end -->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript">
PMS.showSelectList("users","user_id","user_name");
$('#btn-pass').click(function(){
		$('#passForm').attr('action','<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'tdSystem','a' => 'passDemand'), $this);?>
').submit();
});

$('#btn-revoke').click(function(){
		$('#passForm').attr('action','<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'tdSystem','a' => 'revoke'), $this);?>
').submit();
})
</script>
</body>
</html>