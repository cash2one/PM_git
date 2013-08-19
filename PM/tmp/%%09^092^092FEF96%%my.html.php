<?php /* Smarty version 2.6.26, created on 2013-03-06 15:20:18
         compiled from toolWeekReport/my.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'toolWeekReport/my.html', 24, false),)), $this); ?>
<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="utf-8">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/base.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style type="text/css"></style>
</head><body class="mywork week-report">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<article class="content">
  <section class="search">
    <h1 class="pageTitle">周报 - 我的周报</h1>
    <div class="tab searchTab3"> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "toolWeekReport/nav.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> </div>
  </section>
  <table class="table3" id="reportTable">
    <thead>
      <tr class="btop">
        <td width="10%" class="bleft">我的周报</td>
        <td class="bright">&nbsp;</td>
      </tr>
    </thead>
    <tbody>
      <tr class="rowcolor20">
        <td class="bleft" style="text-align:right;padding-right:10px">[{@user_name}]</td>
        <td class="tleft bright"><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'toolWeekReport','a' => 'details'), $this);?>
&id={@report_id}">{@start} 至 {@end}</a></td>
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="2">
        <div class="pager" id="main-pager">
              页码：<span class="pager_current_page"></span>/<span class="pager_total_page"></span>
              <input type="button" value="上一页" class="pagerPrev"/>
              <input type="button" value="下一页" class="pagerNext"/>
              <input type="text" class="itext ipage pagerToPage"/>
              <input type="button" value="GO" class="pagerGo"/>
          </div>
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
$(function(){
	var template=$("#reportTable tbody:eq(0)").html();
	PMS.listPageAjax($("#main-pager"),"<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'toolWeekReport','a' => 'getList','userId' => 'my'), $this);?>
&page={@page}",function(data){
		var rows=data.des.data;
		var length=rows.length;
		var html="";
		for(var i=0;i<length;i++)
		{
			html+=template.replace(/{@user_name}/g,rows[i].user_name).replace(/{@start}/g,rows[i].start).replace(/{@end}/g,rows[i].end).replace(/{@report_id}/g,rows[i].report_id).replace(/%7B@report_id%7D/,rows[i].report_id);
		}
		$("#reportTable tbody:eq(0)").html(html);
	})
})
</script>
</body>