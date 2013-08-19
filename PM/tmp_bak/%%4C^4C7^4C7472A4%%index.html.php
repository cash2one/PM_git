<?php /* Smarty version 2.6.26, created on 2013-04-12 16:19:48
         compiled from toolWeekReport/index.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'toolWeekReport/index.html', 196, false),)), $this); ?>
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
.header { height:40px }
.configSetting { padding:5px 0 0 10px }
.report-list { font-size:12px; list-style:none; padding:0; margin:0 }
.report-list li { padding-left:40px; line-height:30px }
.report-title { }
.report-row-note { }
.report-row-note .report-row-notetxt { display:none; width:300px; border:none; background:#FFF; height:20px; line-height:20px }
.report-row-act { color:#0368B0 }
.writting,
.writed { background: none repeat scroll 0 0 #FFFFFF; border: 1px solid #CCCCCC; border-radius: 3px 3px 3px 3px; color: #666666; line-height: 18px; overflow: visible; padding: 5px; position: relative; white-space: normal; width: 400px; display:inline-block; }
.writting i,
.writed i { background: url("themes/images/arrow.png") repeat scroll 0 0 transparent; display: block; height: 9px; left: -5px; position: absolute; top: 8px; width: 6px; }
.writting .report-row-notetxt { display:inline; border:#CCC 1px solid; background:#FFF }
.writed .report-row-notetxt { display:inline; }
.report-state-15 { color:#11AC34 }
.report-state-100 { color:#CB0004 }
.report-type-10,
.report-type-30 { color:#0033FF;}
.report-type-20,
.report-type-40 { color:#CC640B }
.beforeResult { height:300px; line-height:300px; font-size:14px; text-align:center; color:#0099FF }
</style>
</head><body class="mywork week-report">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<article class="content">
  <section class="search">
    <h1 class="pageTitle">周报 - 写周报</h1>
    <div class="tab searchTab1"> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "toolWeekReport/nav.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> </div>
  </section>
  <section class="header">
    <div class="configSetting"> <span>选择时间</span>
      <input type="text" class="itext select date datelittle" id="sd1" name="sd1" readonly value="<?php echo $this->_tpl_vars['Start']; ?>
"/>
      <span>-</span>
      <input type="text" class="itext select date datelittle" id="sd2" name="sd2" readonly value="<?php echo $this->_tpl_vars['End']; ?>
"/>
      <input type="button" value="确定" id="btnGetWeekReport">
    </div>
  </section>
  <section class="boxstyle1">
    <p class="beforeResult">选择好时间后点击【确定】(一般情况下系统已经帮你选择好时间)</p>
    <div id="reportContent" style="display:none" class="result">
      <h2>上周工作小结</h2>
      <ul class="report-list" id="report-summary">
      </ul>
      <h2>本周工作计划</h2>
      <ul class="report-list" id="report-plan">
      </ul>
    </div>
  </section>
  <section class="boxstyle2 report-section result" id="faceback-wrap" style="display:none">
    <h2>周反馈或心得<span style="color:#F00;font-size:12px;">（* show出专业精神，让大家了解你的态度。）</span></h2>
    <textarea class="itext" style="width:913px;height:200px" id="faceback"></textarea>
  </section>
  <section class="boxstyle2 report-section result" id="notice-wrap" style="display:none">
    <h2>通知他们<span style="font-size:12px;color:#0066FF">(已默认选中周报项目中相关同学，可以继续勾选更多，<span style="color:#F00">只有被选中的同学才能查看这个周报</span>)</span></h2>
    <div id="user-checkbox-container"></div>
  </section>
  <section class="boxstyle2 report-section">
    <div id="mailControler" style="display:none;text-align:center;margin-top:50px" class="result"> <a class="btn btn_main1" id="btnSave">保存并推送</a> </div>
  </section>
  <section class="footer"></section>
</article>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="template1" style="display:none">
  <li> <span class="report-title">【{@prod_name}】 -- 【{@proj_name}】<a class="report-type-{@type}" href="{@pnod_link}">{@pnod_name}</a>----<span class="report-state-{@stateId}">{@state}</span>。</span> <span class="report-row-note">
    <input type="text" name="faceback" value="" class="report-row-notetxt" maxlength="50"/>
    <a onclick="showNoteOfRow(this)" class="report-row-act write">[填写说明]</a> <a onclick="cancelNote(this,{@type},{@proj_id},{@pnod_id})" class="report-row-act cancel" style="display:none">[取消]</a> <a onclick="comfirmNote(this,{@type},{@proj_id},{@pnod_id})" class="report-row-act comfirm" style="display:none">[确定]</a> <a onclick="modifyNote(this)" class="report-row-act modify" style="display:none">[修改]</a> <a onclick="deleteNote(this,{@type},{@proj_id},{@pnod_id})" class="report-row-act delete" style="display:none">[移除]</a> <i></i> </span> </li>
</div>

<div id="template2" style="display:none">
  <li> <span class="report-title">【{@prod_name}】 -- 【{@proj_name}】<a class="report-type-{@type}" href="{@pnod_link}">{@pnod_name}</a></span> <span class="report-row-note">
    <input type="text" name="faceback" value="" class="report-row-notetxt" maxlength="50"/>
    <a onclick="showNoteOfRow(this)" class="report-row-act write">[填写说明]</a> <a onclick="cancelNote(this,{@type},{@proj_id},{@pnod_id})" class="report-row-act cancel" style="display:none">[取消]</a> <a onclick="comfirmNote(this,{@type},{@proj_id},{@pnod_id})" class="report-row-act comfirm" style="display:none">[确定]</a> <a onclick="modifyNote(this)" class="report-row-act modify" style="display:none">[修改]</a> <a onclick="deleteNote(this,{@type},{@proj_id},{@pnod_id})" class="report-row-act delete" style="display:none">[移除]</a> <i></i> </span> </li>
</div>
<script type="text/javascript">
$("#sd1").datepicker();
$("#sd2").datepicker();

//填写说明
var currentRowId;
var checkNote=new RegExp(/\S{1,50}/);
var allReportJson=new Object();

function showNoteOfRow(_clickSource)
{
	var reportClickSource=$(_clickSource).parent().parent();
	reportClickSource.find(".write").hide();
	reportClickSource.find(".comfirm").show();
	reportClickSource.find(".cancel").show();
	reportClickSource.find(".report-row-note").addClass("writting");
	reportClickSource.find(".report-row-notetxt").removeAttr("readonly").focus();
}

function comfirmNote(_clickSource,_type,_proj_id,_pnod_id)
{
	var reportClickSource=$(_clickSource).parent().parent();
	if(checkNote.test(reportClickSource.find(".report-row-notetxt").val()))
	{
		reportClickSource.find(".report-row-note").removeClass("writting").addClass("writed");
		reportClickSource.find(".comfirm").hide();
		reportClickSource.find(".cancel").hide();
		reportClickSource.find(".modify").show();
		reportClickSource.find(".delete").show();
		allReportJson.setDescribe(_type,_proj_id,_pnod_id,reportClickSource.find(".report-row-notetxt").attr("readonly","readonly").val());
	}
	else
	{
		alert("请填写完整！");
	}
}

function cancelNote(_clickSource,_type,_proj_id,_pnod_id)
{
	var reportClickSource=$(_clickSource).parent().parent();
	reportClickSource.find(".comfirm").hide();
	reportClickSource.find(".cancel").hide();
	var dataSourceDescribe=allReportJson.getDescribe(_type,_proj_id,_pnod_id);
	if(checkNote.test(dataSourceDescribe))
	{
		reportClickSource.find(".report-row-note").removeClass("writting");
		reportClickSource.find(".modify").show();
		reportClickSource.find(".delete").show();
		reportClickSource.find(".report-row-notetxt").val(dataSourceDescribe);
	}
	else
	{
		reportClickSource.find(".modify").hide();
		reportClickSource.find(".delete").hide();
		reportClickSource.find(".write").show();
		reportClickSource.find(".report-row-note").removeClass("writting").removeClass("writed");
		reportClickSource.find(".report-row-notetxt").val('');
	}
}

function modifyNote(_clickSource)
{
	var reportClickSource=$(_clickSource).parent().parent();
	reportClickSource.find(".write").hide();
	reportClickSource.find(".comfirm").show();
	reportClickSource.find(".cancel").show();
	reportClickSource.find(".modify").hide();
	reportClickSource.find(".delete").hide();
	reportClickSource.find(".report-row-note").addClass("writting");
	reportClickSource.find(".report-row-notetxt").removeAttr("readonly").focus();;
}

function deleteNote(_clickSource,_type,_proj_id,_pnod_id)
{
	var reportClickSource=$(_clickSource).parent().parent();
	reportClickSource.find(".report-row-notetxt").val('');
	allReportJson.setDescribe(_type,_proj_id,_pnod_id,'');
	reportClickSource.find(".modify").hide();
	reportClickSource.find(".delete").hide();
	reportClickSource.find(".write").show();
	reportClickSource.find(".report-row-note").removeClass("writting").removeClass("writed");
}

function buildHtmlWithTemplate(_template,_data)
{
	return _template.replace(/{@prod_name}/g,_data.prod_name).replace(/{@proj_name}/g,_data.proj_name).replace(/{@pnod_name}/g,_data.pnod_name).replace(/{@state}/g,_data.state).replace(/{@stateId}/g,_data.stateId).replace(/{@type}/g,_data.type).replace(/{@proj_id}/g,_data.proj_id).replace(/{@pnod_id}/g,_data.pnod_id).replace(/{@pnod_link}|%7B@pnod_link%7D/g,_data.pnod_link);
}


allReportJson.getDescribe=function(_type,_proj_id,_pnod_id)
{
	for(var i=0;i<this.data.length;i++)
	{
		if(this.data[i].proj_id==_proj_id&&this.data[i].pnod_id==_pnod_id&&this.data[i].type==_type)
			return this.data[i].faceback;
	}
	return false;
}
allReportJson.setDescribe=function(_type,_proj_id,_pnod_id,_value)
{
	for(var i=0;i<this.data.length;i++)
	{
		if(this.data[i].proj_id==_proj_id&&this.data[i].pnod_id==_pnod_id&&this.data[i].type==_type)
			this.data[i].faceback=_value;
	}
}


$("#btnGetWeekReport").click(function(){
	var targetDate=$("#targetSelectedWeek").val();
	var btn=$(this);
	btn.attr("disabled","true").val('提交中...');
	$.get("<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'toolWeekReport','a' => 'getWeekReport'), $this);?>
",{"start":$("#sd1").val(),"end":$("#sd2").val()},function(data){
		btn.removeAttr("disabled").val('确定');
		$(".beforeResult").hide();
		$(".result").show();
		if(data.rs!=200) 
		{
			alert(data.des);
		}
		else
		{
			allReportJson.data=data.des.data;
			$("#mailControler").show("fast");
			var htmlTemplate=$("#template1").html();
			var htmlAll="";
			for(var i=0;i<(allReportJson.data).length;i++)
			{
				if(allReportJson.data[i].type==10||allReportJson.data[i].type==20)
					htmlAll+=buildHtmlWithTemplate(htmlTemplate,allReportJson.data[i]);
			}
			$("#report-summary").html(htmlAll);
			htmlAll="";
			htmlTemplate=$("#template2").html();
			for(var i=0;i<(allReportJson.data).length;i++)
			{
				if(allReportJson.data[i].type==30||allReportJson.data[i].type==40)
					htmlAll+=buildHtmlWithTemplate(htmlTemplate,allReportJson.data[i]);
			}
			var allRelationUser=new Array();//默认选中
			allRelationUser.push(1);
			allRelationUser.push(2);
			allRelationUser.push(3);
			for(var i=0;i<data.des.allRelationUser.length;i++)
			{
				allRelationUser.push(data.des.allRelationUser[i].user_id);
			}
			$("#report-plan").html(htmlAll);
			PMS.loadUserCheckBoxTo($("#user-checkbox-container"),{"checked":allRelationUser});
	  }
	},"json");
});

$("#btnSave").click(function(){
	var faceback=$.trim($("#faceback").val());
	if(faceback.length<2)
	{
		alert("周反馈不能为空。");
		return;
	}
	var postData=new Object();
	var noticeUserArray=$("#user-checkbox input").serializeArray();
	postData={"reportRow":allReportJson.data,"userArray":noticeUserArray,"start":$("#sd1").val(),"end":$("#sd2").val(),"faceback":faceback};
	$(this).attr("disabled","true").val('提交中...');
	$.post("<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'toolWeekReport','a' => 'postWeekReport'), $this);?>
",postData,function(data)
	{
		if(data.rs==200)
		{
			$(".result").hide();
			$(".beforeResult").html("保存成功，相关的同学马上会收到通知。").show();
		}
		else
		  alert(data.des);
		$(this).removeAttr("disabled").val('保存并推送');
	},"json");
})
</script>
</body>