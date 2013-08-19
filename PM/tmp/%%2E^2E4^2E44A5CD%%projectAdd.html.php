<?php /* Smarty version 2.6.26, created on 2013-07-18 15:26:54
         compiled from project/projectAdd.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'project/projectAdd.html', 23, false),)), $this); ?>
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
</head>
<body class="project create">

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<article class="content">
	
	<h1 class="pageTitle">
	<?php if ($this->_tpl_vars['specialtask'] == 1): ?>
		创建新特殊任务
	<?php elseif ($this->_tpl_vars['specialtask'] == 2): ?>
		创建子项目（父项目：<?php echo $this->_tpl_vars['p_proj']['proj_name']; ?>
）
	<?php else: ?>
		创建新项目
	<?php endif; ?>
	</h1>
	<form action="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project','a' => 'project_add_do'), $this);?>
" method="post" id="project_main_form" onSubmit="return beforeSubmit()">
	<p class="project-mtpl-common">
              选择模板:
        <select name="project-mtpl-select" id="project-mtpl-select" <?php if ($this->_tpl_vars['mtpl_id'] != 0): ?>disabled="true"<?php endif; ?> >
        		 <option value="0">无</option>
                 <?php $_from = $this->_tpl_vars['mtpl']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['irs']):
?>
                 <option value="0_<?php echo $this->_tpl_vars['irs']['mtpl_id']; ?>
"><?php echo $this->_tpl_vars['irs']['mtpl_name']; ?>
</option>
                 <?php endforeach; endif; unset($_from); ?>
                 <?php $_from = $this->_tpl_vars['integrated_tasks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['irts']):
?>
                 <option value="1_<?php echo $this->_tpl_vars['irts']['mtpl_id']; ?>
_<?php echo $this->_tpl_vars['irts']['integrated_tasks_id']; ?>
"><?php echo $this->_tpl_vars['irts']['integrated_tasks_name']; ?>
</option>
                 <?php endforeach; endif; unset($_from); ?>
        </select>
      <?php if ($this->_tpl_vars['specialtask'] == 1 || $this->_tpl_vars['specialtask'] == 2): ?>
      	负责人:
      		<select name="principal" id="principal">
      			<?php $_from = $this->_tpl_vars['allUser']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['aurs']):
?>
      			<option value="<?php echo $this->_tpl_vars['aurs']['user_id']; ?>
"><?php echo $this->_tpl_vars['aurs']['user_name']; ?>
</option>
      			<?php endforeach; endif; unset($_from); ?>
      		</select>
      <?php endif; ?>
        <span class="loading">Loading……</span>
    </p>
	<section class="header clearfix"></section>
	<section class="boxstyle1 top clearfix">
			<dl class="info clearfix2">
				<dt>项目名称</dt>
				<dd><input name="proj_name" type="text" id="proj_name" value="<?php echo $this->_tpl_vars['demand']['dname']; ?>
" maxlength="100" datatype="Require" msg="项目名不能为空" class="itext stitle"/></dd>					
				<dt>项目类型</dt>
				<dd>
					<input type="text" class="itext select" id="proj_class_text" autocomplete="off" readonly value="<?php echo $this->_tpl_vars['proj_class'][$this->_tpl_vars['p_proj']['proj_class']]; ?>
">
					<input type="hidden" name="proj_class" id="proj_class"  value="<?php echo $this->_tpl_vars['p_proj']['proj_class']; ?>
">
					<input type="hidden" name="vritual_id" id="vritual_id" value="<?php echo $this->_tpl_vars['vritual_id']; ?>
">
				</dd>						
				<dt>所属产品</dt>
				<dd>
					<input type="text" class="itext select" id="prod_id_text" autocomplete="off" readonly value="<?php echo $this->_tpl_vars['p_proj']['prod_name']; ?>
"><!-- 原来是 <?php echo $this->_tpl_vars['demand']['prod_name']; ?>
-->
					<input type="hidden" name="prod_id" id="prod_id" datatype="Require" msg="请选择产品" value="<?php echo $this->_tpl_vars['p_proj']['prod_id']; ?>
" datatype="Require" msg="请选择产品"><!-- 原来是 <?php echo $this->_tpl_vars['demand']['prod_id']; ?>
-->
				</dd>
				<!--  
				<dt>所属项目集</dt>
				<dd>
				-->
					<input type="hidden" class="itext select stitle" id="wrap_id_text" autocomplete="off" readonly>
					<input type="hidden" name="wrap_id" id="wrap_id">
				<!--
				</dd>
				-->
				<!--  
				<dt>贡献值</dt>
				<dd>
				-->
					<input name="proj_contri" type="hidden" id="proj_contri"  maxlength="100" class="itext" value="0"/></dd>
				<!-- 
				</dd>
				-->
				<dt>项目目标</dt>
				<dd><input name="proj_target" type="text" id="proj_target" value="" maxlength="200" class="itext stitle"  /></dd>
				
				
			</dl>
			<dl class="info clearfix2">
				<dt>预览机地址</dt>
				<dd>
					<input name="preview_address" type="text" id="preview_address"  maxlength="200"  class="itext stitle" value=""/></dd>
				</dd>
				<dt>上线网址</dt>
				<dd><input type="text" class="itext stitle" id="proj_url" name="proj_url" placeholder="只填写一个，更多请在[项目备注]填写" datatype="Require" msg="上线网址请填写一个，更多请在[项目备注]填写"> <a href="http://bbs.nb.netease.com/viewthread.php?tid=810&highlight=" target="_blank" style="color:#0267B1;font-size:12px">专题规范查询</a></dd>
				<dt>64机地址</dt>
				<dd><input name="proj_psdUrl" type="text" id="proj_psdUrl" value="<?php echo $this->_tpl_vars['p_proj']['proj_psdUrl']; ?>
" maxlength="200" class="itext stitle" datatype="Require" msg="请先在64机上建立好备份文件夹，并填在创建项目时填写。"/></dd>
				
				<dt class="ps">项目备注</dt>
				<dd class="ps_data" style="height:100px"><textarea name="proj_ps" id="proj_ps" class="itext" style="width:350px;height:100px"></textarea></dd>
				<input name="specialtask" type="hidden" value="<?php echo $this->_tpl_vars['specialtask']; ?>
"/>
				<input name="parent_proj" type="hidden" value="<?php if ($this->_tpl_vars['p_proj_id'] == null): ?>0<?php else: ?><?php echo $this->_tpl_vars['p_proj_id']; ?>
<?php endif; ?>"/>
			</dl>

	</section>
        <!--
	<section class="boxstyle2">
		<h2 class="clearfix">素材支持</h2>
		<ul id="support_list" class="table_node">
			<li id="support_list_row_{@numTem}">
				<input name="meterial_name" type="text" class="itext" placeholder="素材名称" datatype="Require" msg="素材名不能为空">
				<input name="meterial_time" id="meterial_time_{@numTem}" type="text" class="itext date select" placeholder="到位时间">
				<label><input type="radio" name="meterial_type___{@numTem}" value="1" checked="checked">素材</label>
				<label><input type="radio" name="meterial_type___{@numTem}" value="2">文案</label>
				<input type="button" value="" class="btnc btnc_del" id="support_list_rowDelBtn_{@numTem}"/>
			</li>
		</ul>
		<input type="hidden" id="support_list_json" name="support_list_json">
		<div class="row_add" id="support_list_rowAddBtn"><a>添加素材</a></div>	
	</section>
	-->
	<section class="boxstyle2">
		<h2>涉及流程与组员</h2>
        <ul id="pnodes" class="table_node">
        	<li id="pnodes_row_{@numTem}">
            	<dl>
                	<dt>流程名</dt>
                    <dd><input name="pnod_name{@num}" type="text" id="pnod_name{@num}" maxlength="45" datatype="Require" msg="流程名不能为空" class="itext stitle" placeholder="流程名"/></dd>
                    <dt>类型</dt>
                    <dd>
		               <input name="pnod_type_name{@num}" type="text" id="pnod_type_name{@numTem}" autocomplete="off" readonly  class="itext date select" value=""/>
				       <input name="pnod_type{@num}" type="hidden" id="pnod_type{@numTem}" value="" class="" datatype="Number" msg="请选择流程类型1"/>
		               <input name="pnod_type2_name{@num}" type="text" id="pnod_type2_name{@numTem}" autocomplete="off" readonly  class="itext date select" value=""/>
                       <input name="pnod_type2{@num}" type="hidden" id="pnod_type2{@numTem}" value="" class="" datatype="Number" msg="请选择流程类型2"/>
                    </dd>
                    <dt>执行人</dt>
                    <dd>
						<input type="text" class="itext date select" id="pnod_user_name{@numTem}" autocomplete="off" readonly/>
				        <input name="user_id_n{@num}" type="hidden" id="user_id_n{@numTem}" value="0"  />
                    </dd>
                    <dt>
                    	<input type="button" value="" class="btnc btnc_del" id="pnodes_rowDelBtn_{@numTem}"/>
                    </dt>           	  		
                
                    <dt style="clear:left;padding-left:42px">时间安排</dt>
                    <dd>
			            <input type="text" name="pnod_time_s{@num}" id="pnod_time_s{@numTem}" readonly class="itext date select" value=""/>
			            <input type="text" name="pnod_time_e{@num}" id="pnod_time_e{@numTem}" readonly class="itext date select" value=""/>
                    	
                    	<!-- 产出物 -->
                    	<input type="hidden" name="pnod_outcome{@num}" id="pnod_outcome{@numTem}" value="0"/>
                    	<!-- 流程模板id -->
                    	<input type="hidden" name="pnod_mtpl_flow{@num}" id="pnod_mtpl_flow{@numTem}" value="0"/>
                    
                    
                    </dd>
                    <?php if ($this->_tpl_vars['user']['power'] < 2): ?>
                    <dt>预估工作量</dt>
                    <dd>
			            <input type="text" name="pnod_day{@num}" id="pnod_day{@numTem}" value="" class="itext num"/> 天
                    </dd>
                    <?php endif; ?>
                    <!-- 
                    <dt style="clear: both;margin-left: 60px;">流程描述</dt>
                    <dd>
                        <input type="text" name="pnod_desc{@num}" id="pnod_desc{@numTem}" class="itext" style="
    width: 580px;">
                    </dd>
                     -->
                </dl>
            </li>
        </ul>
        
		<div class="row_add" id="pnodes_rowAddBtn"><a>添加流程</a></div>	
	</section>
	
	<section class="boxstyle1">
		<h2>项目的节点</h2>
	    <table id="sections" class="table_node">
	      <tr id="sections_row_{@numTem}">
	        <th width="93" height="25" class="tleft">节点名</th>
	        <td width="200"><input type="text" class="itext stitle"  value="项目启动" readonly/></td>
	        <th width="75">时间</th>
	        <td width="100">
	            <input type="text" name="proj_start" id="proj_start" readonly class="itext date select" value="" datatype="Require" msg="请填写项目启动时间" />
	        </td>
            <td>
            	<select name="proj_startTime" class="itext" id="proj_startTime">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/timeSelect.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</select>
            </td>
	        <td>&nbsp;</td>
	      </tr>
	      <tr id="sections_row_{@numTem}">
	        <th height="25" class="tleft">节点名</th>
	        <td><input type="text" class="itext stitle"  value="项目上线" readonly/></td>
	        <th>时间</th>
	        <td>
	            <input type="text" name="proj_end" id="proj_end" readonly class="itext date select" value="" datatype="Require" msg="请填写项目上线时间" />
	        </td>
            <td>
				<select name="proj_endTime" class="itext" id="proj_endTime">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/timeSelect.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</select>
            </td>
	        <td width="10%">&nbsp;</td>
	      </tr>
	    </table>
	</section>	
	
	
	<section class="boxstyle1 bottom">
	  <input type="hidden" name="nodecount" id="pnodes_rowCounter" value="0" />
	  <input type="hidden" name="projState" id="projState" value="4" />
	  <input type="hidden" name="dId" value="<?php echo $this->_tpl_vars['demand']['did']; ?>
" />
	  <input name="input" type="submit" value="提交审核" class="btn btn_main1" id="btn_submit_project"/>
	  <input name="input" type="submit" value="保存草稿" class="btn btn_main2" onclick="setProjState()"/>	
	</section>
	<section class="footer"></section>
	</form>
	
</article>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script type="text/javascript">
<?php if ($this->_tpl_vars['mtpl_id'] != 0): ?>
$('#project-mtpl-select').val("0_<?php echo $this->_tpl_vars['mtpl_id']; ?>
");
getData("0_<?php echo $this->_tpl_vars['mtpl_id']; ?>
");
<?php endif; ?>
<?php if ($this->_tpl_vars['specialtask'] == 1 || $this->_tpl_vars['specialtask'] == 2): ?>
$('#principal').val(<?php echo $this->_tpl_vars['user']['id']; ?>
);
<?php endif; ?>
$('#project-mtpl-select').select2({width:'200px'});


//选中产品时回调
var productsSelected=function()
{
	$("#wrap_id_text").val('');
	$("#wrap_id").val('');
}

//选中流程类型1时回调
var current_nClassID=0;
var data_nClassSelected=function()
{
	$("#pnod_type2_name"+current_nClassID).val('');
	$("#pnod_type2"+current_nClassID).val('');
}


var supportList;
$(function(){
	PMS.bindDatepickers("#proj_start","#proj_end");
	$("#proj_endTime option:eq(1)").attr("selected","selected");
	PMS.showSelectList("products","prod_id","prod_id_text");
	PMS.showSelectList("pClass","proj_class","proj_class_text");
	$("#wrap_id_text").click(function() {
		PMS.showSelectList("wraps","wrap_id","wrap_id_text",{"supper_id":$("#prod_id").val(),"autoBind":false,"reload":true});
	});
	
	PMS.rowEditorCreate("pnodes","#pnodes li",{
			"form":"project_main_form",
			"check":true,
			"added":function(n){
				PMS.bindDatepickers("#pnod_time_s"+n,"#pnod_time_e"+n);
				PMS.showSelectList("users","user_id_n"+n,"pnod_user_name"+n);
				$("#pnod_type_name"+n).click(function() {
					current_nClassID=n;
					PMS.showSelectList("data","pnod_type"+n,"pnod_type_name"+n,{type:"nClass","autoBind":false});
				});
				$("#pnod_type2_name"+n).click(function() {
					PMS.showSelectList("data","pnod_type2"+n,"pnod_type2_name"+n,{"supper_id":$("#pnod_type"+n).val(),type:"nClass2","reload":true,"autoBind":false});
				});
				//渲染select2
				$('select:not(#project-mtpl-select)').select2({width:'100px'});
				}
			});
     /*
	supportList=PMS.rowEditorCreate2("support_list","li",{
			"added":function(n){
					$('#meterial_time_'+n).datepicker();
				}
			});
     */
	 $('#btn_wrap_add').click(function(){$('#wrap_add_tips').fadeIn();});
	    
 });
	
function beforeSubmit()
{
	//supportList.makeJsonTo('#support_list_json');
	var lastNodeEndDate=null;
	if(isNaN($("#proj_contri").val())){
		   alert("错误：贡献值只能是数字。");
		   return false;
	}
	$("#pnodes .hasDatepicker").each(function(index, element) {
		if($(this).val())
		{
			if(!lastNodeEndDate) lastNodeEndDate=$(this).val();
			else
			{
				if(lastNodeEndDate<$(this).val())
					lastNodeEndDate=$(this).val();
			}
		}
	});
	if(lastNodeEndDate==$("#proj_end").val())
		if(confirm("预留的测试时间小于1天，可能无法测试！确定创建项目？"))
			return true
		else
			return false
	else if(lastNodeEndDate>$("#proj_end").val())
	{
		alert("流程结束日期超出了项目上线时间");
		return false;
	}
}
	
function setProjState(){$('#projState').val('50');}
//juetion 选择模板时 自动注入 start
$("#project-mtpl-select").change(function(){
	
	var mtpl_id = $(this).val();
	if(mtpl_id == 0) {
		$('.btnc_del').click();
		$('#pnodes_rowAddBtn').click();
	}else {
		getData($(this).val());
	}
	
});
function getData(mtpl_id) {
    $(".loading").css("visibility", "visible");
    $.ajax({
        url:'index.php?c=pgadmin&a=getMtpl_ajax&mtpl_id='+ mtpl_id,
        type:'GET',
        success:function (data) {
        	$(".loading").css("visibility", "hidden");
        	var result = JSON.parse(data);
        	var mtpl_flow = result["mtpl_flow"];
        	$('.btnc_del').click();
        	for (var key in mtpl_flow) {
        		
        		$('#pnodes_rowAddBtn').click();
        		var rs =  mtpl_flow[key];
        		var pnode_dt = $('#pnodes li:eq('+key+') dl dt:eq(6)');
        		
        		var pnode_dd = $('#pnodes li:eq('+key+') dl dd:eq(0)');
        		$(pnode_dd).find('input').eq(0).val(rs.flow_name);
        		
        		var pnode_dd = $('#pnodes li:eq('+key+') dl dd:eq(1)');
				$(pnode_dd).find('input').eq(0).val(rs.flow_type1_name);
				$(pnode_dd).find('input').eq(1).val(rs.flow_type1);
				$(pnode_dd).find('input').eq(2).val(rs.flow_type2_name);
				$(pnode_dd).find('input').eq(3).val(rs.flow_type2);
				
				var pnode_dd = $('#pnodes li:eq('+key+') dl dd:eq(3)');
				$(pnode_dd).find('input').eq(0).val(rs.flow_time_s);
				$(pnode_dd).find('input').eq(1).val(rs.flow_time_e);
				//产出物
				$(pnode_dd).find('input').eq(2).val((rs.flow_outcome==""?"0":rs.flow_outcome));
				//模板流程id
				$(pnode_dd).find('input').eq(3).val(rs.flow_id);
				
				var pnode_dd = $('#pnodes li:eq('+key+') dl dd:eq(4)');
				$(pnode_dd).find('input').eq(0).val(rs.totle_day);
				
				
        	}
        	var mtpl_gx = result["mtpl_gx"];
        	$("#proj_contri").val(mtpl_gx);
        	//渲染select2
        	$('select:not(#project-mtpl-select)').select2({width:'100px'});
        },
        error:function () {
            alert('出错了！')
        }
    })
	
}
//juetion 选择模板时 自动注入 end
</script>
</body>
</html>