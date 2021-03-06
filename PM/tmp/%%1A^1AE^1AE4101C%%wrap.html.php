<?php /* Smarty version 2.6.26, created on 2013-03-12 15:12:03
         compiled from project/wrap.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'project/wrap.html', 40, false),array('modifier', 'date_format', 'project/wrap.html', 43, false),array('modifier', 'default', 'project/wrap.html', 43, false),)), $this); ?>
<!DOCTYPE html>
<html lang="zh"> 
<head>
<meta charset="utf-8">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/base.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<link type="text/css"  rel="stylesheet" href="themes/css/jquery.ui.all.css" />
<script type="text/javascript" src="themes/js/jquery-ui.last.js"></script>
<script type="text/javascript" src="themes/js/jquery.ui.datepicker-zh-CN.js"></script>
<style type="text/css">
.table3 .date{font-family: Arial,Helvetica,sans-serif;font-size: 8pt;color:#323232}
</style>
</head>
<body class="manage wraps">

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<article class="content">

	<section class="search">
		<h1>查看明细 - 项目集 - <?php echo $this->_tpl_vars['wrap']['wrap_name']; ?>
</h1>
		<div class="tab searchTab0">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "project/wrapsNav.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
	</section>

	<table class="table3" id="myWorkTable">
	 <thead>
	  <tr class="btop">
	    <td width="15%" class="bleft">所属产品</td>
	    <td width="10%">类型</td>
	    <td width="45%" class="tleft">项目/流程</td>
	    <td width="10%">负责/执行人</td>
	    <td width="10%" class="tleft">状态/进度</td>
	    <td width="10%"class="bright">时间</td>
	  </tr>
	  </thead>
	  <?php $_from = $this->_tpl_vars['myProjects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
	  <tr id="projrow_<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
" class="wraped">
	    <td class="bleft"><p><?php echo $this->_tpl_vars['rs']['prod_name']; ?>
</p></td>
	    <td><?php echo $this->_tpl_vars['rs']['proj_class']; ?>
</td>
	    <td class="tleft"><span class="icon2" onClick="loadPNodes(<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
)"></span><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project_bll','a' => 'project_show','id' => $this->_tpl_vars['rs']['proj_id']), $this);?>
"><?php echo $this->_tpl_vars['rs']['proj_name']; ?>
</a></td>
	    <td><?php echo $this->_tpl_vars['rs']['user_name']; ?>
</td>
	    <td class="tleft"><span class="stateicon stateicon_<?php echo $this->_tpl_vars['rs']['proj_state']; ?>
"><?php echo $this->_tpl_vars['state_list'][$this->_tpl_vars['rs']['proj_state']]; ?>
</span></td>
	    <td class="bright date"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['rs']['proj_start'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d") : smarty_modifier_date_format($_tmp, "%m/%d")))) ? $this->_run_mod_handler('default', true, $_tmp, "待定") : smarty_modifier_default($_tmp, "待定")); ?>
 - <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['rs']['proj_end'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d") : smarty_modifier_date_format($_tmp, "%m/%d")))) ? $this->_run_mod_handler('default', true, $_tmp, "待定") : smarty_modifier_default($_tmp, "待定")); ?>
</td>
	  </tr>
		  <?php $_from = $this->_tpl_vars['rs']['nodes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rsNode']):
?>
		  <tr class="node_row mywork_nodes_<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
">
		    <td class="bleft">&nbsp;</td>
		    <td>&nbsp;</td>
		    <td class="tleft lineOfParent"><span></span><a href="javascript:PMS.showNode(<?php echo $this->_tpl_vars['rsNode']['pnod_id']; ?>
)"><?php echo $this->_tpl_vars['rsNode']['pnod_name']; ?>
</a></td>
		    <td><?php echo ((is_array($_tmp=@$this->_tpl_vars['rsNode']['user_name'])) ? $this->_run_mod_handler('default', true, $_tmp, "待定") : smarty_modifier_default($_tmp, "待定")); ?>
</td>
		    <td class="tleft"><span class="stateicon stateicon_<?php echo $this->_tpl_vars['rsNode']['pnod_state']; ?>
"><?php echo $this->_tpl_vars['state_list'][$this->_tpl_vars['rsNode']['pnod_state']]; ?>
</span></td>
		    <td class="bright date"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['rsNode']['pnod_time_s'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d") : smarty_modifier_date_format($_tmp, "%m/%d")))) ? $this->_run_mod_handler('default', true, $_tmp, "待定") : smarty_modifier_default($_tmp, "待定")); ?>
 - <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['rsNode']['pnod_time_e'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d") : smarty_modifier_date_format($_tmp, "%m/%d")))) ? $this->_run_mod_handler('default', true, $_tmp, "待定") : smarty_modifier_default($_tmp, "待定")); ?>
</td>
		  </tr>
		  <?php endforeach; endif; unset($_from); ?>
	  <?php endforeach; endif; unset($_from); ?>
	  <?php $_from = $this->_tpl_vars['myNodes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
	  <tr>
	    <td class="bleft"><?php echo $this->_tpl_vars['rs']['prod_name']; ?>
</td>
	    <td><?php echo $this->_tpl_vars['rs']['proj_class']; ?>
</td>
	    <td class="tleft"><a href="javascript:PMS.showNode(<?php echo $this->_tpl_vars['rs']['pnod_id']; ?>
)"><?php echo $this->_tpl_vars['rs']['pnod_name']; ?>
</a></td>
	    <td>&nbsp;</td>
	    <td class="tleft"><span class="stateicon stateicon_<?php echo $this->_tpl_vars['rs']['pnod_state']; ?>
"><?php echo $this->_tpl_vars['state_list'][$this->_tpl_vars['rs']['pnod_state']]; ?>
</span></td>
	    <td class="bright date"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['rs']['pnod_time_s'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d") : smarty_modifier_date_format($_tmp, "%m/%d")))) ? $this->_run_mod_handler('default', true, $_tmp, "待定") : smarty_modifier_default($_tmp, "待定")); ?>
 - <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['rs']['pnod_time_e'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d") : smarty_modifier_date_format($_tmp, "%m/%d")))) ? $this->_run_mod_handler('default', true, $_tmp, "待定") : smarty_modifier_default($_tmp, "待定")); ?>
</td>
	  </tr>
	  <?php endforeach; endif; unset($_from); ?>
	  
	  <tfoot class="nopage"><tr><td colspan="6"></td></tr></tfoot>
	</table>
	
</article>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript">
function loadPNodes(proj_id)
{
	var row=$("#projrow_"+proj_id);

		if(row.attr("class")=="wraped"){row.removeClass("wraped").addClass("unwrap");$("#myWorkTable .mywork_nodes_"+proj_id).show()}
		else{row.removeClass("unwrap").addClass("wraped");$("#myWorkTable .mywork_nodes_"+proj_id).hide();}
}
</script>
</body>
</html>