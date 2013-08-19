<?php /* Smarty version 2.6.26, created on 2013-04-12 14:17:48
         compiled from project/myWork.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'project/myWork.html', 40, false),array('modifier', 'default', 'project/myWork.html', 157, false),)), $this); ?>
<!DOCTYPE html>
<html lang="zh"> 
<head>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/base.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<link type="text/css"  rel="stylesheet" href="themes/css/jquery.ui.all.css?cache=<?php echo @RD; ?>
" />
<script type="text/javascript" src="themes/js/jquery-ui.last.js?cache=<?php echo @RD; ?>
"></script>
<script type="text/javascript" src="themes/js/vilidate.js?cache=<?php echo @RD; ?>
"></script>
<style type="text/css">
.header.myview{height:40px;position:relative}
.boxstyle2.myview{padding:0px 0px 0 0;border-top:none;}
.myview .tab{position:absolute;top:-50px;}
.mywork h2 {margin-top: 30px;padding-bottom: 10px;padding-left: 20px;}
#tableView{margin-top:-40px;position: relative;}
#tableView .date{font-family: Arial,Helvetica,sans-serif;font-size: 8pt;color:#323232}
.itext{height: 21px;line-height: 21px;}
</style>
</head>
<body class="mywork currentWork">

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<article class="content">

<section class=""></section>

<?php if ($this->_tpl_vars['disPassDemandArray']): ?>
<h2>待审核-需求单</h2>
<table class="table3 clickRecord">
	<thead>
	  <tr class="btop">
	    <td width="30%" class="bleft">所属产品</td>
	    <td width="40%" class="tleft">项目名称</td>
	    <td width="15%" class="tleft">产品接口人</td>
		<td width="15%" class="bright">提单时间</td>
	  </tr>
	</thead>
  <?php $_from = $this->_tpl_vars['disPassDemandArray']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
  <tr>
    <td class="bleft"><?php echo $this->_tpl_vars['rs']['pName']; ?>
</td>
    <td class="tleft"><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'tdSystem','a' => 'showDetails'), $this);?>
&dId=<?php echo $this->_tpl_vars['rs']['dId']; ?>
" target="_blank"><?php echo $this->_tpl_vars['rs']['dName']; ?>
</a></td>
    <td class="tleft"><?php echo $this->_tpl_vars['rs']['uName']; ?>
</td>
    <td class="bright"><?php echo $this->_tpl_vars['rs']['dHandinTime']; ?>
</td>
  </tr>
  <?php endforeach; endif; unset($_from); ?>
  <tfoot class="nopage"><tr><td colspan="6"></td></tr></tfoot>
</table>
<?php endif; ?>

<?php if ($this->_tpl_vars['unBuildProjectArray']): ?>
<h2>待建立-项目</h2>
<table class="table3 clickRecord">
	<thead>
	  <tr class="btop">
	    <td width="20%" class="bleft">所属产品</td>
	    <td width="40%" class="tleft">项目名称</td>
	    <td width="10%" class="tleft">产品接口人</td>
		<td width="10%" class="tleft">操作</td>
		<td width="20%" class="bright">时间</td>
	  </tr>
	</thead>
  <?php $_from = $this->_tpl_vars['unBuildProjectArray']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
  <tr>
    <td class="bleft"><?php echo $this->_tpl_vars['rs']['prod_name']; ?>
</td>
    <td class="tleft"><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project','a' => 'project_add'), $this);?>
&dId=<?php echo $this->_tpl_vars['rs']['did']; ?>
" target="_blank"><?php echo $this->_tpl_vars['rs']['dname']; ?>
</a></td>
	<td class="tleft"><?php echo $this->_tpl_vars['rs']['duname']; ?>
</td>
	<td class="tleft"><?php echo $this->_tpl_vars['rs']['passby']; ?>
</td>
    <td class="bright"><?php echo $this->_tpl_vars['rs']['ctime']; ?>
</td>
  </tr>
  <?php endforeach; endif; unset($_from); ?>
  <tfoot class="nopage"><tr><td colspan="6"></td></tr></tfoot>
</table>
<?php endif; ?>


<article id="unPlanNodesBox" style="display:none">
<h2>待安排-流程 <?php if (@PM_power == 0): ?><span id="unPlanNodesControl" style="cursor:pointer">[读取]</span><?php endif; ?></h2>
<table class="table3" id="unPlanNodesTable">
	<thead>
	  <tr class="btop">
	    <td width="12%" class="bleft">所属产品</td>
	    <td width="18%">流程内容</td>
	    <td width="20%">所属项目</td>
		<td width="10%">执行人</td>
		<td width="25%">时间安排</td>
		<?php if (@PM_power < 2): ?>
		<td width="10%">工作日</td>
		<?php endif; ?>
	    <td width="5%" class="bright">&nbsp;</td>
	  </tr>
  </thead>
  <tbody id="unfullRows">
	  <tr id="unfullRows_row_{@numTem}" class="unfull_row">
	    <td class="bleft rowEditorInitdata">{@prod_name}</td>
	    <td><p><a href="javascript:PMS.showNode({@pnod_id})">{@pnod_name}</a><input type="hidden" value="{@pnod_name}" name="pnod_name"></p></td>
	    <td><p><a href="index.php?c=project_bll&a=projEdit&id={@proj_id}" target="_blank">{@proj_name}</a></p></td>
		<td>
			<input id="pnod_user_name{@numTem}"  type="text" value="{@user_name}" autocomplete="off"  class="itext select date" name="user_name">
	        <input name="user_id_n" type="hidden" id="user_id_n{@numTem}" value="{@user_id}"/>
		</td>
		<td>
			<input id="pnod_time_s{@numTem}" name="pnod_time_s" class="itext select date" type="text" value="{@pnod_time_s}"> - 
			<input id="pnod_time_e{@numTem}" name="pnod_time_e" class="itext select date" type="text" value="{@pnod_time_e}">
		</td>
		<?php if (@PM_power < 2): ?>
		<td>
			<input type="text" name="pnod_day" id="pnod_day{@numTem}" value="{@pnod_day}" class="itext num"/> 天
		</td>
		<?php endif; ?>
	    <td class="bright"><input name="pnod_id" type="hidden" value="{@numTem}"/><input type="button" id="unfullRows_rowSaveBtn_{@numTem}" class="btnc btnc_save" title="保存"></td>
	  </tr>
	</tbody>
   <tfoot class="nopage"><tr><td colspan="7"></td></tr></tfoot>
</table>
</article>

<?php if ($this->_tpl_vars['unScoreProjectArray']): ?>
<h2>待评分-项目</h2>
<table class="table3 clickRecord">
	<thead>
	  <tr class="btop">
	    <td width="10%" class="bleft">所属产品</td>
	    <td width="35%">项目</td>
	    <td width="25%" >所属项目集</td>
		<td width="10%" class="bright">负责人</td>
	  </tr>
	</thead>
  <?php $_from = $this->_tpl_vars['unScoreProjectArray']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
  <tr>
    <td class="bleft"><?php echo $this->_tpl_vars['rs']['prod_name']; ?>
</td>
    <td class="tleft"><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project_bll','a' => 'project_show','id' => $this->_tpl_vars['rs']['proj_id']), $this);?>
#set-project-score-box" target="_blank"><?php echo $this->_tpl_vars['rs']['proj_name']; ?>
</a></td>
    <td class="tleft"><?php echo $this->_tpl_vars['rs']['wrap_name']; ?>
</td>
    <td class="bright"><?php echo $this->_tpl_vars['rs']['user_name']; ?>
</td>
  </tr>
  <?php endforeach; endif; unset($_from); ?>
  <tfoot class="nopage"><tr><td colspan="6"></td></tr></tfoot>
</table>
<?php endif; ?>

<?php if (( $this->_tpl_vars['isShowCheckAll'] || $this->_tpl_vars['isShowCheckDesign'] ) && $this->_tpl_vars['rows_node_check'] || $this->_tpl_vars['rows_node_last'] || $this->_tpl_vars['rows_node_last_reject']): ?>
<h2>待审核-流程</h2>
<table class="table3">
	<thead>
	  <tr class="btop">
	    <td width="14%" class="bleft">所属产品</td>
	    <td width="30%">流程内容</td>
	    <td width="30%">所属项目</td>
		<td width="10%">执行人</td>
		<td width="10%">状态</td>
		<td width="6%" class="bright">审核人</td>
	  </tr>
	</thead>
  <?php $_from = $this->_tpl_vars['rows_node_check']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
  <tr id="check_pnod_row_<?php echo $this->_tpl_vars['rs']['pnod_id']; ?>
">
    <td class="bleft"><?php echo $this->_tpl_vars['rs']['prod_name']; ?>
</td>
    <td><a href="javascript:PMS.showNode(<?php echo $this->_tpl_vars['rs']['pnod_id']; ?>
,{pass:1})"><?php echo $this->_tpl_vars['rs']['pnod_name']; ?>
</a></td>
    <td><?php echo $this->_tpl_vars['rs']['proj_name']; ?>
</td>
    <td><?php echo ((is_array($_tmp=@$this->_tpl_vars['rs']['user_name'])) ? $this->_run_mod_handler('default', true, $_tmp, "待定") : smarty_modifier_default($_tmp, "待定")); ?>
</td>
	<td></td>
	<td class="bright"></td>
  </tr>
  <?php endforeach; endif; unset($_from); ?>
  <?php $_from = $this->_tpl_vars['rows_node_last']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
  <tr id="check_pnod_row_<?php echo $this->_tpl_vars['rs']['pnod_id']; ?>
" class="rowcolor10">
    <td class="bleft"><?php echo $this->_tpl_vars['rs']['prod_name']; ?>
</td>
    <td><a href="javascript:PMS.showNode(<?php echo $this->_tpl_vars['rs']['pnod_id']; ?>
)"><?php echo $this->_tpl_vars['rs']['pnod_name']; ?>
</a></td>
    <td class="tleft"><?php echo $this->_tpl_vars['rs']['proj_name']; ?>
</td>
    <td><?php echo ((is_array($_tmp=@$this->_tpl_vars['rs']['user_name'])) ? $this->_run_mod_handler('default', true, $_tmp, "待定") : smarty_modifier_default($_tmp, "待定")); ?>
</td>
	<td>审核通过</td>
	<td class="bright"><?php echo $this->_tpl_vars['rs']['passBy']; ?>
</td>
  </tr>
  <?php endforeach; endif; unset($_from); ?>
  <?php $_from = $this->_tpl_vars['rows_node_last_reject']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
  <tr id="check_pnod_row_<?php echo $this->_tpl_vars['rs']['pnod_id']; ?>
" class="rowcolor10">
    <td class="bleft"><?php echo $this->_tpl_vars['rs']['prod_name']; ?>
</td>
    <td><a href="javascript:PMS.showNode(<?php echo $this->_tpl_vars['rs']['pnod_id']; ?>
)"><?php echo $this->_tpl_vars['rs']['pnod_name']; ?>
</a></td>
    <td class="tleft"><?php echo $this->_tpl_vars['rs']['proj_name']; ?>
</td>
    <td><?php echo ((is_array($_tmp=@$this->_tpl_vars['rs']['user_name'])) ? $this->_run_mod_handler('default', true, $_tmp, "待定") : smarty_modifier_default($_tmp, "待定")); ?>
</td>
	<td>退回</td>
	<td class="bright"><?php echo $this->_tpl_vars['rs']['passBy']; ?>
</td>
  </tr>
  <?php endforeach; endif; unset($_from); ?>
  <tfoot class="nopage"><tr><td colspan="6"></td></tr></tfoot>
</table>
<?php endif; ?>

<?php if ($this->_tpl_vars['isShowCheckAll'] && ( $this->_tpl_vars['rows_project'] || $this->_tpl_vars['rows_project_last'] || $this->_tpl_vars['rows_project_last_50'] )): ?>
<h2>待审核-项目</h2>
<table class="table3 clickRecord">
	<thead>
	  <tr class="btop">
	    <td width="10%" class="bleft">所属产品</td>
	    <td width="35%" class="tleft">项目</td>
	    <td width="25%" class="tleft">所属项目集</td>
		<td width="10%">负责人</td>
		<td width="10%">状态</td>
		<td width="10%" class="bright">审核人</td>
	  </tr>
	</thead>
  <?php $_from = $this->_tpl_vars['rows_project']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
  <tr>
    <td class="bleft"><?php echo $this->_tpl_vars['rs']['prod_name']; ?>
</td>
    <td class="tleft"><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project_bll','a' => 'project_show_check','id' => $this->_tpl_vars['rs']['proj_id']), $this);?>
" target="_blank"><?php echo $this->_tpl_vars['rs']['proj_name']; ?>
</a></td>
    <td class="tleft"><?php echo $this->_tpl_vars['rs']['wrap_name']; ?>
</td>
    <td><?php echo $this->_tpl_vars['rs']['user_name']; ?>
</td>
    <td><?php echo $this->_tpl_vars['state_list'][$this->_tpl_vars['rs']['proj_state']]; ?>
</td>
    <td class="bright">&nbsp;</td>
  </tr>
  <?php endforeach; endif; unset($_from); ?>
  <?php $_from = $this->_tpl_vars['rows_project_last']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
  <tr class="rowcolor10">
    <td class="bleft"><?php echo $this->_tpl_vars['rs']['prod_name']; ?>
</td>
    <td class="tleft"><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project_bll','a' => 'project_show','id' => $this->_tpl_vars['rs']['proj_id']), $this);?>
" target="_blank"><?php echo $this->_tpl_vars['rs']['proj_name']; ?>
</a></td>
    <td class="tleft"><?php echo $this->_tpl_vars['rs']['wrap_name']; ?>
</td>
    <td><?php echo $this->_tpl_vars['rs']['user_name']; ?>
</td>
    <td>审核通过</td>
    <td class="bright"><?php echo $this->_tpl_vars['rs']['passBy']; ?>
</td>
  </tr>
  <?php endforeach; endif; unset($_from); ?>
  <?php $_from = $this->_tpl_vars['rows_project_last_50']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
  <tr class="rowcolor10">
    <td class="bleft"><?php echo $this->_tpl_vars['rs']['prod_name']; ?>
</td>
    <td class="tleft"><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project_bll','a' => 'project_show','id' => $this->_tpl_vars['rs']['proj_id']), $this);?>
" target="_blank"><?php echo $this->_tpl_vars['rs']['proj_name']; ?>
</a></td>
    <td class="tleft"><?php echo $this->_tpl_vars['rs']['wrap_name']; ?>
</td>
    <td><?php echo $this->_tpl_vars['rs']['user_name']; ?>
</td>
    <td>退回</td>
    <td class="bright"><?php echo $this->_tpl_vars['rs']['passBy']; ?>
</td>
  </tr>
  <?php endforeach; endif; unset($_from); ?>
  <tfoot class="nopage"><tr><td colspan="6"></td></tr></tfoot>
</table>
<?php endif; ?>


<?php if ($this->_tpl_vars['isShowCheckFinish'] && ( $this->_tpl_vars['rows_proj_finish'] || $this->_tpl_vars['rows_proj_finish_last'] )): ?>
<h2>待归档-项目</h2>
<table class="table3 clickRecord">
	<thead>
	  <tr class="btop">
	    <td width="10%" class="bleft">所属产品</td>
	    <td width="35%" class="tleft">项目</td>
	    <td width="25%" class="tleft">所属项目集</td>
		<td width="10%">执行人</td>
		<td width="10%">状态</td>
		<td width="10%" class="bright">审核人</td>
	  </tr>
	</thead>
  <?php $_from = $this->_tpl_vars['rows_proj_finish']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
  <tr>
    <td class="bleft"><?php echo $this->_tpl_vars['rs']['prod_name']; ?>
</td>
    <td class="tleft"><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project_bll','a' => 'project_show','id' => $this->_tpl_vars['rs']['proj_id']), $this);?>
" target="_blank"><?php echo $this->_tpl_vars['rs']['proj_name']; ?>
</a></td>
    <td class="tleft"><?php echo $this->_tpl_vars['rs']['wrap_name']; ?>
</td>
    <td><?php echo $this->_tpl_vars['rs']['user_name']; ?>
</td>
    <td><?php echo $this->_tpl_vars['state_list'][$this->_tpl_vars['rs']['proj_state']]; ?>
</td>
    <td class="bright">&nbsp;</td>
  </tr>
  <?php endforeach; endif; unset($_from); ?>
  <?php $_from = $this->_tpl_vars['rows_proj_finish_last']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
  <tr class="rowcolor10">
    <td class="bleft"><?php echo $this->_tpl_vars['rs']['prod_name']; ?>
</td>
    <td class="tleft"><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project_bll','a' => 'project_show','id' => $this->_tpl_vars['rs']['proj_id']), $this);?>
" target="_blank"><?php echo $this->_tpl_vars['rs']['proj_name']; ?>
</a></td>
    <td class="tleft"><?php echo $this->_tpl_vars['rs']['wrap_name']; ?>
</td>
    <td><?php echo $this->_tpl_vars['rs']['user_name']; ?>
</td>
    <td>已归档</td>
    <td class="bright"><?php echo $this->_tpl_vars['rs']['passBy']; ?>
</td>
  </tr>
  <?php endforeach; endif; unset($_from); ?>
  <tfoot class="nopage"><tr><td colspan="6"></td></tr></tfoot>
</table>
<?php endif; ?>

<h2>我的项目</h2>
<section class="header myview">
	<div class="tab" id="calendarView_tab">
		<a class="current" id="btn_showGrap">图</a><span class="dot">&nbsp;</span><a class="" id="btn_showTable">表</a>
	</div>
</section>

<section id="grapView"><div class="boxstyle2 myview"><div id="project_gra"></div></div><div class="footer"></div></section>
<div id="tableView"></div>

</article>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript">
function pass_pnod(pnod_id,state)
{
	//alert($("#isPnodeFinishOnCommitTime").attr("checked"));
	var isPnodeFinishOnCommitTime=0;
	if($("#isPnodeFinishOnCommitTime").attr("checked"))
		isPnodeFinishOnCommitTime=1;
	var postData={"score":$("#node-score").val(),"comment":$("#node-comment").val(),"pnod_id":pnod_id,"state":state,"isPnodeFinishOnCommitTime":isPnodeFinishOnCommitTime,"delayinfo":$("#node-delayinfo").val()};
	//alert(url);return;
	$.post("<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pnode','a' => 'setState'), $this);?>
",postData,function(msg)
	{
		if(msg.rs==200)
		{
			$('#check_pnod_row_'+pnod_id).addClass("rowcolor10");
			if(state==15)
				$('#check_pnod_row_'+pnod_id+" td:eq(4)").html("审核通过");
			else if(state==20)
				$('#check_pnod_row_'+pnod_id+" td:eq(4)").html("退回");
			$('#check_pnod_row_'+pnod_id+" td:eq(5)").html("<?php echo $_COOKIE['pm_user_name']; ?>
");
			$('#pnod_details_box').hide();
			$('#pnod_details_box_popwin_bg').hide();
			$('check_pnod_btn1_'+pnod_id).hide();
		}
		else
		{
			alert(msg.des);
		}
	},"json")
}

function loadPNodes(proj_id)
{
	var row=$("#projrow_"+proj_id);

		if(row.attr("class")=="wraped"){row.removeClass("wraped").addClass("unwrap");$("#myWorkTable .mywork_nodes_"+proj_id).show()}
		else{row.removeClass("unwrap").addClass("wraped");$("#myWorkTable .mywork_nodes_"+proj_id).hide();}
}


function rowadded(n)
{
		PMS.bindDatepickers("#pnod_time_s"+n,"#pnod_time_e"+n);
		PMS.showSelectList("users","user_id_n"+n,"pnod_user_name"+n);
}	

var MyWork=
{
	grapView:$('#grapView'),
	tableView:$('#tableView'),
	nav:$("#calendarView_tab a"),
	
	//日历样式
	loadCalendar:function()
	{
		MyWork.nav.removeClass('current');
		MyWork.nav.eq(0).addClass("current");
		if(MyWork.grapView.attr('rel')!='loaded'){
			PMS.loadCalendar("project_gra",{
			'userId':'<?php echo $this->_tpl_vars['userId']; ?>
',
			'type':'mix',
			'group':[['','',''],['{@PS}','{@PE}','{@NC}'],['','','{@NC}']]
			});
		}
		MyWork.grapView.show();
		MyWork.tableView.hide();
		MyWork.grapView.attr('rel','loaded');
		_$.SetCookie("PM_myworkView","gra",10000);
	},
	
	//表格样式
	loadTable:function()
	{
		MyWork.nav.removeClass('current');
		MyWork.nav.eq(1).addClass("current");
		if(MyWork.tableView.attr('rel')!='loaded'){MyWork.tableView.load("<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project_bll','a' => 'myProjectsTable'), $this);?>
",function(){MyWork.tableView.attr('rel','loaded');});}
		MyWork.grapView.hide();
		MyWork.tableView.show();
		_$.SetCookie("PM_myworkView","table",10000);
	},
	//未安排流程
	loadUnPlanNodes:function()
	{
		$.get("index.php?c=pnode&a=getUnfull",function(data){
			  	if(data.length>0)
				{
					$("#unPlanNodesBox").show();
					$("#unPlanNodesTable").show();
					PMS.rowEditorEdit("unfullRows","pnod_id","#unfullRows tr",data,{
						"addRowFn":function(n){rowadded(n);},
						"editSaveUrl":"index.php?c=pnode&a=pnodSave&type=mywork"
					});
				}
		},"json");
	},
	
	//跟据cookies记录展示样式
	init:function()
	{
		if(_$.GetCookie("PM_myworkView")=="table") MyWork.loadTable();
		else MyWork.loadCalendar();
		$('#btn_showGrap').click(function(){MyWork.loadCalendar()});
		$('#btn_showTable').click(function(){MyWork.loadTable()});
	}
}

$('document').ready(function()
{
	MyWork.init();
	//因为数量多，管理员默认情况下不读取未安排流程
	if($("#unPlanNodesControl").length>0)
	{
		$("#unPlanNodesBox").show();
		$("#unPlanNodesTable").hide();
		$("#unPlanNodesControl").click(function(){
			MyWork.loadUnPlanNodes();
			$(this).remove();
		});
	}
	else
	{
		MyWork.loadUnPlanNodes();
	}
	
	$('.clickRecord tr td a').click(function(){$(this).parent().parent().addClass('rowcolor10')});
});
</script>
</body>
</html>