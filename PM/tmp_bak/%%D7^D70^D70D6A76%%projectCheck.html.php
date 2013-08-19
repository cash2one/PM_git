<?php /* Smarty version 2.6.26, created on 2013-07-01 18:47:35
         compiled from project/projectCheck.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'project/projectCheck.html', 32, false),array('modifier', 'default', 'project/projectCheck.html', 53, false),)), $this); ?>
<!DOCTYPE html>
<html lang="zh"> 
<head>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/base.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<link rel="stylesheet" href="themes/css/projectshow.css?<?php echo @RD; ?>
" />
<link rel="stylesheet" href="themes/css/jquery.ui.all.css" />
<script src="themes/js/jquery-ui.last.js"></script>
<script src="themes/js/jquery.ui.datepicker-zh-CN.js"></script>
<script src="themes/js/vilidate.js"></script>
<style type="text/css">
.table3 tfoot.nopage td{height:2px}
.pnode_gra li a.state1{background:#A6E3FF;color:#333;cursor:pointer;border:1px solid #8DB6D6}
.pnode_gra li a.state1:hover{background:#FFC2A6;color:#333;border:1px solid #E29B70}
.pnode_gra li a.state0{cursor:pointer;}
.pnode_gra li a.state0:hover{background:#FFC2A6;color:#333;border:1px solid #E29B70}
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
        	<h1 class="pageTitle">项目信息 - 审核设置</h1>
	        <div class="tab searchTab1">
				<?php if (@PM_power == 0): ?>
				<a title="审核项目" href="index.php?c=project_bll&a=project_show_check&id=<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
" id="searchTab1">审</a>
	            <span class="dot">&nbsp;</span>
				<?php endif; ?>
				<a title="浏览项目" href="index.php?c=project_bll&a=project_show&id=<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
" id="searchTab2">看</a>
				<?php if ($this->_tpl_vars['is_user'] == 1 || @PM_power == 0): ?>
				<span class="dot">&nbsp;</span>
				<a title="修改项目" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project_bll','a' => 'projEdit','id' => $this->_tpl_vars['rs']['proj_id']), $this);?>
" id="searchTab3">修</a>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['rs']['did']): ?>
				<span class="dot">&nbsp;</span>
				<a title="该项目的需求单" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'tdSystem','a' => 'showDetails'), $this);?>
&dId=<?php echo $this->_tpl_vars['rs']['did']; ?>
" id="searchTab4">需</a>
				<?php endif; ?>
				<?php if (@TEACHER == -1 || @PM_power == 0): ?>
				<span class="dot">&nbsp;</span>
				<a title="技能发放" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'skillSend','id' => $this->_tpl_vars['rs']['proj_id']), $this);?>
" id="searchTab5">技</a>
				<?php endif; ?>
			</div>
        </section>
		
		<section class="header"></section>
		<section class="boxstyle1 top proj_info">
			<form method="post" action="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project','a' => 'pass','pid' => $this->_tpl_vars['rs']['proj_id']), $this);?>
" id="project-data-form">
			<h2><?php echo $this->_tpl_vars['rs']['prod_name']; ?>
 - <?php echo $this->_tpl_vars['rs']['proj_name']; ?>
<span>[<?php echo $this->_tpl_vars['proj_state_list'][$this->_tpl_vars['rs']['proj_state']]; ?>
]</span></h2>
			<dl class="info clearfix2">
				<dt>项目类型：</dt>
				<dd><?php echo $this->_tpl_vars['proj_class'][$this->_tpl_vars['rs']['proj_class']]; ?>
</dd>
				<dt>所属项目集：</dt>
				<dd><?php echo ((is_array($_tmp=@$this->_tpl_vars['rs']['wrap_name'])) ? $this->_run_mod_handler('default', true, $_tmp, "无") : smarty_modifier_default($_tmp, "无")); ?>
</dd>
				<dt>负责人：</dt>
				<dd><?php echo $this->_tpl_vars['rs']['user_name']; ?>
</dd>
				<dt>访问地址：</dt>
				<dd><a href="<?php echo $this->_tpl_vars['rs']['proj_url']; ?>
" target="_blank"><?php echo $this->_tpl_vars['rs']['proj_url']; ?>
</a></dd>
				<dt>64机地址：</dt>
				<dd class="url"><input type="text" value="<?php echo $this->_tpl_vars['rs']['proj_psdUrl']; ?>
" id="psdUrl"></dd>
				<dt>预览机地址:</dt>
				<dd class="url">
					<input id="preview_address" type="text" value="<?php echo $this->_tpl_vars['rs']['preview_address']; ?>
"/></dd>
				</dd>
				<dt>项目目标：</dt>
				<dd class="url"><input type="text" value="<?php echo $this->_tpl_vars['rs']['proj_target']; ?>
" id="target"></dd>
				<dt>贡献值：</dt>
				<dd class="url"><input type="text" value="<?php echo $this->_tpl_vars['proj_contri']; ?>
" id="contri"></dd>
				
				<dt class="ps">项目备注：</dt>
				<dd class="ps_data"><textarea  style="width:100%;height:100%;overflow:auto;border:none;background:#E9E9E9;line-height:24px"><?php echo $this->_tpl_vars['rs']['proj_ps']; ?>
</textarea></dd>
				<dt>项目分级</dt>
				<dd>
					<input type="text" class="itext select date" id="proj_level1_text" autocomplete="off" readonly value="<?php echo $this->_tpl_vars['rs']['proj_level1_name']; ?>
">
					<input type="hidden" name="proj_level1" id="proj_level1" value="<?php echo $this->_tpl_vars['rs']['proj_level1']; ?>
" datatype="Number" msg="请选择项目分级1"> - 
					<input type="text" class="itext select" id="proj_level2_text" autocomplete="off" readonly value="<?php echo $this->_tpl_vars['rs']['proj_level2_name']; ?>
">
					<input type="hidden" name="proj_level2" id="proj_level2" value="<?php echo $this->_tpl_vars['rs']['proj_level2']; ?>
" datatype="Number" msg="请选择项目分级2"> 
				</dd>
				<dd><p style="font-size:12px;color:#FF0000;padding-left:90px">分级A-C才参与项目评分</p></dd>
			</dl>
			<input type="hidden" name="proj_id" value="<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
">
			<input type="hidden" name="fromModel" value="c=project_bll&a=project_show_check&id=<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
">
			</form>
		</section>
		
		<section class="boxstyle2" style="border-top:none">
			<h2>父项目</h2>
			<?php if ($this->_tpl_vars['parent_proj'] != null): ?>
				<ul class="skill_user">
					<li>
						<a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project_bll','a' => 'project_show','id' => $this->_tpl_vars['parent_proj']['proj_id']), $this);?>
" target="_blank">
							<span class="child_state_<?php echo $this->_tpl_vars['parent_proj']['proj_state']; ?>
">
								<?php echo $this->_tpl_vars['parent_proj']['proj_name']; ?>

								<span class="stateicon stateicon_<?php echo $this->_tpl_vars['parent_proj']['proj_state']; ?>
">&nbsp;&nbsp;</span>
								<?php echo $this->_tpl_vars['proj_state_list'][$this->_tpl_vars['parent_proj']['proj_state']]; ?>

							</span>
						</a>
					</li>
				</ul>
			<?php else: ?>
				<ul class="skill_user_show">
					<li>没有父项目。</li>
				</ul>
			<?php endif; ?>
			<h2>子项目</h2>			
			<ul class="skill_user">
			<?php if ($this->_tpl_vars['child_proj'] != null || $this->_tpl_vars['vritual_proj'] != null): ?>
				<?php $_from = $this->_tpl_vars['child_proj']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cp1']):
?>
					<li>
						<a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project_bll','a' => 'project_show','id' => $this->_tpl_vars['cp1']['proj_id']), $this);?>
" target="_blank">
							<span class="child_state_<?php echo $this->_tpl_vars['cp1']['proj_state']; ?>
">
								<?php echo $this->_tpl_vars['cp1']['proj_name']; ?>

								<span class="stateicon stateicon_<?php echo $this->_tpl_vars['cp1']['proj_state']; ?>
">&nbsp;&nbsp;</span>
								<?php echo $this->_tpl_vars['proj_state_list'][$this->_tpl_vars['cp1']['proj_state']]; ?>

							</span>
						</a>
					</li>
				<?php endforeach; endif; unset($_from); ?> 
				<?php $_from = $this->_tpl_vars['vritual_proj']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['vp1']):
?>
					<li>
						<span class="child_state_-1">
							<?php echo $this->_tpl_vars['vp1']['mtpl_name']; ?>

							(模板-未创建)
						</span>
					</li>
				<?php endforeach; endif; unset($_from); ?>
			<?php else: ?>
				<ul class="skill_user_show">
					<li>没有子项目。</li>
				</ul>
			<?php endif; ?>
			</ul>
		</section>

		<section class="boxstyle2 proj_gra">
			<header>
				<h2>项目流程与组员</h2>
				<div class="tab" id="calendarView_tab">
					<a class="current" id="btn_showPnod">流</a>
					<span class="dot">&nbsp;</span>
					<a class="" id="btn_showProj">集</a>
				</div>
			</header>
			<div id="project_gra"></div>
		</section>
		
		<section class="boxstyle1 clearfix">
			<h2>附件</h2>
			<ul class="adjunct-list">
			<?php $_from = $this->_tpl_vars['files']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs2']):
?>
				<li id="file_row_<?php echo $this->_tpl_vars['rs2']['file_id']; ?>
">
					<a href="<?php echo $this->_tpl_vars['rs2']['file_url']; ?>
" target="_blank" class="file <?php echo ((is_array($_tmp=@$this->_tpl_vars['rs2']['ext'])) ? $this->_run_mod_handler('default', true, $_tmp, 'floder') : smarty_modifier_default($_tmp, 'floder')); ?>
"><!-- <img src="<?php echo $this->_tpl_vars['rs2']['file_url']; ?>
" width="128" height="128"/> --></a>
					<div class="fileInfo">
						<p><?php echo $this->_tpl_vars['rs2']['file_name']; ?>
</p>
						<p>上传：<?php echo $this->_tpl_vars['rs2']['user_name']; ?>
</p>
					</div>
					<div class="fileControl">
						<a onClick="deleteFile('<?php echo $this->_tpl_vars['rs2']['file_id']; ?>
')" class="del" title="删除">删除</a>
						<?php if ($this->_tpl_vars['rs2']['ext'] == 'zip'): ?>
						　<a onClick="extractFile('<?php echo $this->_tpl_vars['rs2']['file_id']; ?>
')" class="extractFile" title="解压">解压</a>
						<?php endif; ?>
					</div>
				</li>
			<?php endforeach; endif; unset($_from); ?>
			</ul>
		</section>

		
		<section class="boxstyle2">
			<h2>流程审核设定</h2>
			<ul class="pnode_gra">
				<?php $_from = $this->_tpl_vars['proj_node']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
				<li id="row_<?php echo $this->_tpl_vars['rs']['pnod_id']; ?>
" onClick="setPnodState2(<?php echo $this->_tpl_vars['rs']['pnod_id']; ?>
,<?php if ($this->_tpl_vars['rs']['pnod_state2'] == 1): ?>0<?php else: ?>1<?php endif; ?>,'pnodState2')"><a class="state<?php echo $this->_tpl_vars['rs']['pnod_state2']; ?>
">【<?php echo $this->_tpl_vars['rs']['pnod_name']; ?>
】 by <?php echo $this->_tpl_vars['rs']['user_name']; ?>
<span class="stateicon stateicon_<?php echo $this->_tpl_vars['rs']['pnod_state2']; ?>
"><?php echo $this->_tpl_vars['state_list'][$this->_tpl_vars['rs']['pnod_state2']]; ?>
</span></a></li>
				<?php endforeach; endif; unset($_from); ?>    
			</ul>		
		</section>
		

		<section class="boxstyle1 bottom proj_control" id="origenTable">
        <?php if ($this->_tpl_vars['rs']['proj_state'] == 40): ?>
		    <input type="button" name="button" id="button" value="审核通过" onclick="passProject()" class="btn btn_main1"/>
			<input type="button" name="button" id="button" value="退回" onclick="showRejectTable()" class="btn btn_main1"/>
		<?php else: ?>
			<input type="button" name="button" id="button" value="保存修改" onclick="modifyProject()" class="btn btn_main1"/>
        <?php endif; ?>
    		<a class="btn btn_main2" onclick="delProject()">删除该项目</a>
		</section>
		
		<section class="boxstyle1 bottom proj_control" id="rejectTable" style="display:none">
			<form action="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project'), $this);?>
&a=rejectProject" method="post">
				<textarea name="rejectReason" datatype="Require" msg="内容不能为空" class="itext" style="width:400px;height:60px;">填写退回原因。</textarea><br>
				<input type="submit" name="button" id="button" value="确定退回" class="btn btn_main1" />
				<input type="button" name="button" id="button" value="取消" onclick="showOrigenTable()" class="btn btn_main1"/>
				<input type="hidden" value="<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
" name="rejectProjectId">
			</form>
		</section>
		
		<section class="footer"></section>

</article>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script type="text/javascript">
//选中项目分级1时回调
var data_pLevel1Selected=function()
{
	$("#proj_level2_text").val('');
	$("#proj_level2").val('');
}

var modifyProject=function()
{
	$("#project-data-form").attr("action","<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project','a' => 'proj_save'), $this);?>
");
	$("#project-data-form").submit();
}

function setPnodState2(pnod_id,state,action)
{
	var url='<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project_bll','a' => "{@action}",'pnod_id' => "{@pnod_id}",'state' => "{@state}"), $this);?>
';
	url=url.replace(/{@pnod_id}/,pnod_id);
	url=url.replace(/{@state}/,state);
	url=url.replace(/{@action}/,action);
	//alert(url);
	$.get(url,function(msg){
					   if(msg==1)
					   {
							if(state==1)
							{
								$("#row_"+pnod_id).unbind("click").click(function(){setPnodState2(pnod_id,0,action)});
								$("#row_"+pnod_id+" a:eq(0)").attr("class","state"+state);
								$("#row_"+pnod_id+" a span:eq(0)").attr("class","stateicon stateicon_"+state).html("需要审核");
							}
							else if(state==0)
							{
								$("#row_"+pnod_id).unbind("click").click(function(){setPnodState2(pnod_id,1,action)});
								$("#row_"+pnod_id+" a:eq(0)").attr("class","state"+state);
								$("#row_"+pnod_id+" a span:eq(0)").attr("class","stateicon stateicon_"+state).html("不需要审核");
							}						   
					   }
					   else
					   {
						   alert('操作失败！');
						}
						
					   })
	
	
}

function passProject(proj_id)
{
	$("#project-data-form").submit();
}

function delProject()
{
	if(confirm('删除项目后将不可恢复，确定要删除？'))
	{
		location.href='<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project','a' => 'proj_del','proj_id' => $this->_tpl_vars['rs']['proj_id']), $this);?>
';
	}
}

$(function()
{
	var _tem0='<a title="{@user}-{@title}【{@stateName}】{@beforeNodes}" onclick="PMS.showNode({@nodeId})" style="width:{@widthFinal}px;margin-left:{@left}px;" class="pnod node"><span style="width:{@widthEnd}px;" class="title-short rowcolor{@state}"><span class="inner">{@user}-{@title}【{@stateName}】{@beforeNodes}</span></span></a>';
	
	PMS.loadCalendar("project_gra",{projId:'<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
',type:'nodeInProject',ps:1,select:1000,"group":[['','',_tem0]]});
	
	//PMS.loadCalendar("project_gra",{projId:'<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
',type:'node',ps:1});
	
	$("#proj_level1_text").click(function() {
		PMS.showSelectList("data","proj_level1","proj_level1_text",{type:"pLevel1","autoBind":false});
	});
	
	$("#proj_level2_text").click(function() {
		PMS.showSelectList("data","proj_level2","proj_level2_text",{type:"pLevel2","supper_id":$("#proj_level1").val(),"autoBind":false,"reload":true});
	});
	
	$('#btn_showPnod').click(function(){
									  $('#calendarView_tab a').removeClass('current');
									  $(this).addClass('current');
									   PMS.loadCalendar("project_gra",{projId:'<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
',type:'nodeInProject',ps:1,select:1000,"group":[['','',_tem0]]});
									  });
	$('#btn_showProj').click(function(){
									  $('#calendarView_tab a').removeClass('current');
									  $(this).addClass('current');
									  PMS.loadCalendar("project_gra",{wrapId:'<?php echo $this->_tpl_vars['rs']['wrap_id']; ?>
',type:'project',projId:'<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
',ws:'1'});
									  });	
									  
})
function showRejectTable()
{
	$("#origenTable").hide();
	$("#rejectTable").show("fast");
} 
function showOrigenTable()
{
	$("#rejectTable").hide();
	$("#origenTable").show("fast");
} 

</script>
</body>
</html>