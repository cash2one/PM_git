<?php /* Smarty version 2.6.26, created on 2013-03-06 15:18:07
         compiled from toolWeekReport/check.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'toolWeekReport/check.html', 36, false),)), $this); ?>
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
.table3 {border-top:1px dotted #999999;}
.table3 thead td { background:#E9E9E9; border-left:#96999E solid 1px; border-right:#96999E solid 1px;  font-size:18px; color:#000; padding-left:20px; font-weight:bold }
.configSetting{padding-top:10px}
</style>
</head><body class="mywork week-report">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<article class="content">
  <section class="search">
    <h1 class="pageTitle">周报 - 我收到的周报</h1>
    <div class="tab searchTab2"> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "toolWeekReport/nav.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> </div>
  </section>
  <section class="header"></section>
  <section class="boxstyle1 top">
    <div id="user-checkbox-container"></div>
    <div class="configSetting"> 
      <strong>选择时间：</strong>
      <input type="text" class="itext select date datelittle" id="sd1" name="sd1" readonly value="<?php echo $this->_tpl_vars['Start']; ?>
"/>
      <span>-</span>
      <input type="text" class="itext select date datelittle" id="sd2" name="sd2" readonly value="<?php echo $this->_tpl_vars['End']; ?>
"/>
      <input type="button" value="确定" id="btnGetWeekReport">
    </div>
  </section>
  <table class="table3" id="reportTable">
    <tbody>
      <tr class="rowcolor20">
        <td class="bleft" style="text-align:right;padding-right:10px" width="10%">[{@user_name}]</td>
        <td class="tleft bright"><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'toolWeekReport','a' => 'details'), $this);?>
&id={@report_id}">{@start} 至 {@end}</a></td>
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="2"><div class="pager" id="main-pager"> 页码：<span class="pager_current_page"></span>/<span class="pager_total_page"></span>
            <input type="button" value="上一页" class="pagerPrev"/>
            <input type="button" value="下一页" class="pagerNext"/>
            <input type="text" class="itext ipage pagerToPage"/>
            <input type="button" value="GO" class="pagerGo"/>
          </div></td>
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
var template=$("#reportTable tbody:eq(0)").html();
$("#reportTable tbody:eq(0)").html('')
$(function(){
/*<?php if (PM_power == 0): ?>*/
	PMS.loadUserCheckBoxTo($("#user-checkbox-container"));
/*<?php endif; ?>*/
	$("#sd1").datepicker();
	$("#sd2").datepicker();
	$("#main-pager").hide();
})

$("#btnGetWeekReport").click(function(){
	var noticeUserArray=$("#user-checkbox input").serializeArray();
	PMS.listPageAjax($("#main-pager"),"<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'toolWeekReport','a' => 'getList'), $this);?>
&page={@page}",function(data){
		var rows=data.des.data;
		var length=rows.length;
		var html="";
		if(length>0)
		{
			for(var i=0;i<length;i++)
			{
				html+=template.replace(/{@user_name}/g,rows[i].user_name).replace(/{@start}/g,rows[i].start).replace(/{@end}/g,rows[i].end).replace(/{@report_id}/g,rows[i].report_id).replace(/%7B@report_id%7D/,rows[i].report_id);
			}
			$("#main-pager").show();
		}
		else
			html+='<tr class="rowcolor20" colspan="2"><td class="bleft"></td><td class="tleft bright">没有数据。</td></tr>';
		$("#reportTable tbody:eq(0)").html(html);
	},{"post":{"start":$("#sd1").val(),"end":$("#sd2").val(),"userId":noticeUserArray}});
})

$("#btnGetWeekReport").click();
</script>
</body>