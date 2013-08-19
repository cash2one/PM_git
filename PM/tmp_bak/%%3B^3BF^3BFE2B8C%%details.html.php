<?php /* Smarty version 2.6.26, created on 2013-03-06 15:18:14
         compiled from toolWeekReport/details.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'toolWeekReport/details.html', 43, false),)), $this); ?>
<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="utf-8">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/base.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style type="text/css">
h1 { padding:0 }
h2 { margin-top:10px; font-size:16px; }
.report-list { font-size:12px; list-style:none; padding:0; margin:0 }
.report-list li { padding-left:40px; line-height:30px; }
.report-title { }
.report-row-note { background: none repeat scroll 0 0 #FFFFFF; border: 1px solid #CCCCCC; border-radius: 3px 3px 3px 3px; color: #666666; display: inline-block; line-height: 18px; overflow: visible; padding: 5px; position: relative; white-space: normal; }
.report-row-note i { background: url("themes/images/arrow.png") repeat scroll 0 0 transparent; display: block; height: 9px; left: -5px; position: absolute; top: 8px; width: 6px; }
.report-state-15 { color:#11AC34 }
.report-state-100 { color:#CB0004 }
.report-type-10,
.report-type-30 { color:#0033FF }
.report-type-20,
.report-type-40 { color:#CC640B }
.report-faceback,.report-cc-users { color:#656565; padding:5px 35px; font-size:12px; line-height:2em}
.table3 thead td { background:#E9E9E9; border-left:#96999E solid 1px; border-right:#96999E solid 1px; border-top:1px dotted #999999; font-size:18px; color:#000; padding-left:20px; font-weight:bold }

.reportfb_list{ color:#656565;font-size:12px;width:auto;padding:20px}
.reportfb_list li{margin-bottom:10px;border-bottom:1px dotted #C9C9C9;padding:10px;line-height:2em}
.reportfb_user_name{font-weight:bold}
.reportfb_user_name span{color:#CCCCCC}
.reportfb_content{padding-left:20px}
</style>
</head><body class="mywork currentWork">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<article class="content">
  <section class="search">
    <h1 class="pageTitle">周报 - 查看</h1>
    <div class="tab searchTab4"> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "toolWeekReport/nav.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> </div>
  </section>
  <section class="header boxstyle1 small"> 周报详情 </section>
  <section class="boxstyle2">
    <h1>[<?php echo $this->_tpl_vars['report']['user_name']; ?>
]<?php echo $this->_tpl_vars['report']['start']; ?>
 至 <?php echo $this->_tpl_vars['report']['end']; ?>
</h1>
    <h2>上周工作小结</h2>
    <ul class="report-list" id="report-summary">
      <?php $_from = $this->_tpl_vars['reportdts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
      <?php if ($this->_tpl_vars['rs']['type'] <= 20): ?>
      <li> <span class="report-title">【<?php echo $this->_tpl_vars['rs']['prod_name']; ?>
】 -- 【<?php echo $this->_tpl_vars['rs']['proj_name']; ?>
】<a class="report-type-<?php echo $this->_tpl_vars['rs']['type']; ?>
" href="<?php if ($this->_tpl_vars['rs']['pnod_id'] != 0): ?>javascript:PMS.showNode(<?php echo $this->_tpl_vars['rs']['pnod_id']; ?>
)<?php else: ?><?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project_bll','a' => 'project_show'), $this);?>
&id=<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['rs']['pnod_name']; ?>
</a>----<span class="report-state-<?php echo $this->_tpl_vars['rs']['stateid']; ?>
"><?php echo $this->_tpl_vars['rs']['state']; ?>
</span></span> <?php if ($this->_tpl_vars['rs']['faceback']): ?> <span class="report-row-note">
        <p><?php echo $this->_tpl_vars['rs']['faceback']; ?>
</p>
        <i></i></span> <?php endif; ?> </li>
      <?php endif; ?>
      <?php endforeach; endif; unset($_from); ?>
    </ul>
    <h2>本周工作计划</h2>
    <ul class="report-list" id="report-plan">
      <?php $_from = $this->_tpl_vars['reportdts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
      <?php if ($this->_tpl_vars['rs']['type'] > 20): ?>
      <li> <span class="report-title">【<?php echo $this->_tpl_vars['rs']['prod_name']; ?>
】 -- 【<?php echo $this->_tpl_vars['rs']['proj_name']; ?>
】<a class="report-type-<?php echo $this->_tpl_vars['rs']['type']; ?>
" href="javascript:PMS.showNode(<?php echo $this->_tpl_vars['rs']['pnod_id']; ?>
)"><?php echo $this->_tpl_vars['rs']['pnod_name']; ?>
</a></span> <?php if ($this->_tpl_vars['rs']['faceback']): ?> <span class="report-row-note">
        <p><?php echo $this->_tpl_vars['rs']['faceback']; ?>
</p>
        <i></i></span> <?php endif; ?> </li>
      <?php endif; ?>
      <?php endforeach; endif; unset($_from); ?>
    </ul>
    <h2>周反馈或心得</h2>
    <div class="report-faceback"> <?php echo $this->_tpl_vars['report']['faceback']; ?>
 </div>
    <h2>抄送</h2>
    <div class="report-cc-users">
    	<?php $_from = $this->_tpl_vars['ccUser']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
        	<?php echo $this->_tpl_vars['rs']['user_name']; ?>
、
        <?php endforeach; endif; unset($_from); ?>
    </div>
  </section>
  <section class="boxstyle2 report-section result" id="faceback-wrap">
  	<form method="post" action="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'toolWeekReport','a' => 'postFaceback'), $this);?>
">
	    <h2>评论/反馈<span style="color:#F00;font-size:12px;">（* 内容抄送的人均可见，提交后周报作者收到PM消息）</span></h2>
		<ul class="reportfb_list">
			<?php $_from = $this->_tpl_vars['reportfb']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
			<li>
				<p class="reportfb_user_name"><?php echo $this->_tpl_vars['rs']['user_name']; ?>
<span>[<?php echo $this->_tpl_vars['rs']['ctime']; ?>
]</span>:</p>
				<p class="reportfb_content"><?php echo $this->_tpl_vars['rs']['content']; ?>
</p>
			</li>
			<?php endforeach; endif; unset($_from); ?>
		</ul>
	    <textarea class="itext" style="width:913px;height:100px" name="faceback_content"></textarea>
		<input type="hidden" value="<?php echo $this->_tpl_vars['report']['report_id']; ?>
" name="faceback_report_id">
		<div id="mailControler" style="text-align:center;margin-top:50px" class="result"> <input class="btn btn_main1" type="submit" value="提交评论"></div>
	</form>
  </section>
  <?php if (PM_power == 0): ?>
  <table class="table3" id="reportTable">
    <thead>
      <tr class="btop">
        <td width="10%" colspan="2">TA的更多周报</td>
      </tr>
    </thead>
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
  <?php else: ?>
  <section class="footer"></section>
  <?php endif; ?>
</article>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 
<script type="text/javascript">
$(function(){
	/*<?php if (PM_power == 0): ?>*/
	setTimeout(function(){
	var template=$("#reportTable tbody:eq(0)").html();
	PMS.listPageAjax($("#main-pager"),"<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'toolWeekReport','a' => 'getList','userId' => $this->_tpl_vars['report']['user_id']), $this);?>
&page={@page}",function(data){
		var rows=data.des.data;
		var length=rows.length;
		var html="";
		for(var i=0;i<length;i++)
		{
			html+=template.replace(/{@user_name}/g,rows[i].user_name).replace(/{@start}/g,rows[i].start).replace(/{@end}/g,rows[i].end).replace(/{@report_id}/g,rows[i].report_id).replace(/%7B@report_id%7D/,rows[i].report_id);
		}
		$("#reportTable tbody:eq(0)").html(html);
	},500);
	})
	/*<?php endif; ?>*/
})
</script>
</body>