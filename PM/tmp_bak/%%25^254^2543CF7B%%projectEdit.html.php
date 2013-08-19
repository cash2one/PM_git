<?php /* Smarty version 2.6.26, created on 2013-07-03 10:04:12
         compiled from project/projectEdit.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'project/projectEdit.html', 29, false),array('modifier', 'default', 'project/projectEdit.html', 62, false),array('modifier', 'date_format', 'project/projectEdit.html', 242, false),)), $this); ?>
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
<link type="text/css"  rel="stylesheet" href="themes/css/jquery.ui.all.css?cache=<?php echo @RD; ?>
" />
<script type="text/javascript" src="themes/js/jquery-ui.last.js?cache=<?php echo @RD; ?>
"></script>
<script type="text/javascript" src="themes/js/vilidate.js?cache=<?php echo @RD; ?>
"></script>
<style type="text/css">
.proj_gra{padding:20px 0}
.proj_gra h2{padding-left:20px;}
#project_gra{margin-bottom:20px;}
</style>
</head>
<body class="manage project project_edit">

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<article class="content">
	<section class="search">
        	<h1>修改 - 项目 - <?php echo $this->_tpl_vars['rs']['proj_name']; ?>
</h1>
	        <div class="tab searchTab3">
				<?php if (@PM_power == 0): ?>
				<a title="审核项目" href="index.php?c=project_bll&a=project_show_check&id=<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
" id="searchTab1">审</a>
	            <span class="dot">&nbsp;</span>
				<?php endif; ?>
				<a title="浏览项目" href="index.php?c=project_bll&a=project_show&id=<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
" id="searchTab2">看</a>
				<span class="dot">&nbsp;</span>
				<a title="修改项目" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project_bll','a' => 'projEdit','id' => $this->_tpl_vars['rs']['proj_id']), $this);?>
" id="searchTab3">修</a>
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
	
	<section class="header clearfix"></section>
	<section class="boxstyle1 top clearfix">
		<form action="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project','a' => 'proj_save'), $this);?>
" method="post"  onSubmit="return Validator.Validate(this,2)" >
        	<div class="clearfix">
				<dl class="info clearfix2">
					<dt>项目名称</dt>
					<dd><input name="proj_name" type="text" id="proj_name" maxlength="100" datatype="Require" msg="项目名不能为空" class="itext stitle" value="<?php echo $this->_tpl_vars['rs']['proj_name']; ?>
"/></dd>					
					<dt>项目类型</dt>
					<dd>
						<input type="text" class="itext select" id="proj_class_text" autocomplete="off" readonly value="<?php echo $this->_tpl_vars['proj_class'][$this->_tpl_vars['rs']['proj_class']]; ?>
">
						<input type="hidden" name="proj_class" id="proj_class" value="<?php echo $this->_tpl_vars['rs']['proj_class']; ?>
">
					</dd>						
					<dt>所属产品</dt>
					<dd>
						<input type="text" class="itext select" id="prod_id_text" autocomplete="off" readonly value="<?php echo $this->_tpl_vars['rs']['prod_name']; ?>
">
						<input type="hidden" name="prod_id" id="prod_id" datatype="Require" msg="请选择产品" value="<?php echo $this->_tpl_vars['rs']['prod_id']; ?>
" datatype="Require" msg="请选择产品">
					</dd>
					<!-- 
					<dt>所属项目集</dt>
					<dd>
					 -->
						<input type="hidden" class="itext select stitle" id="wrap_id_text" autocomplete="off" readonly value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['rs']['wrap_name'])) ? $this->_run_mod_handler('default', true, $_tmp, "空集") : smarty_modifier_default($_tmp, "空集")); ?>
">
						<input type="hidden" name="wrap_id" id="wrap_id" value="<?php echo $this->_tpl_vars['rs']['wrap_id']; ?>
">
					<!--
					</dd>
					<dt>贡献值</dt>
					<dd>
					-->
						<input name="proj_contri" type="hidden" id="proj_contri"  maxlength="100" datatype="Require" msg="贡献值不能为空" class="itext" value="<?php echo $this->_tpl_vars['proj_contri']; ?>
"/></dd>
					<!--
					</dd>
					-->
					<dt>项目目标</dt>
					<dd><input name="proj_target" type="text" id="proj_target" value="<?php echo $this->_tpl_vars['rs']['proj_target']; ?>
" maxlength="200" class="itext stitle"/></dd>
					
					
				</dl>
				<dl class="info clearfix2">
					<dt>预览机地址</dt>
					<dd class="url">
						<input id="preview_address" name="preview_address" type="text" maxlength="200" value="<?php echo $this->_tpl_vars['rs']['preview_address']; ?>
" class="itext stitle"/></dd>
					</dd>
					<dt>上线网址</dt>
					<dd><input type="text" class="itext stitle" id="proj_url" name="proj_url" value="<?php echo $this->_tpl_vars['rs']['proj_url']; ?>
" placeholder="只填写一个，更多请在[项目备注]填写" datatype="Require" msg="上线网址请填写一个，更多请在[项目备注]填写"> <a href="http://bbs.nb.netease.com/viewthread.php?tid=810&highlight=" target="_blank" style="color:#0267B1;font-size:12px">专题规范查询</a></dd>
					<dt>64机地址</dt>
					<dd><input name="proj_psdUrl" type="text" id="proj_psdUrl" value="<?php echo $this->_tpl_vars['rs']['proj_psdUrl']; ?>
" maxlength="200" class="itext stitle" datatype="Require" msg="请先在64机上建立好备份文件夹，并填在创建项目时填写。"/></dd>
					
					<dt class="ps">项目备注</dt>
					<dd class="ps_data"  style="height:100px">
					<textarea name="proj_ps" id="proj_ps" class="itext" style="width:350px;height:100px"><?php echo $this->_tpl_vars['rs']['proj_ps']; ?>
</textarea>
					</dd>
				</dl>
	         </div>
			<input type="hidden" id="proj_id" name="proj_id" value="<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
" />
			<input type="hidden" name="fromModel" value="c=project_bll&a=projEdit&id=<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
">
			<p align="center"><input type="submit" value="保存项目修改"  class="btn btn_main1"/></p>
		</form>
	</section>

	<section class="boxstyle2" style="display: none;">
		<h2 class="clearfix">素材支持</h2>
		<form id="support_list_form">
		<ul id="support_list" class="table_node">
			<li id="support_list_row_{@numTem}">
				<input name="name" type="text" class="itext" placeholder="素材名称" value="{@name}" datatype="Require" msg="素材名不能为空">
				<input name="ntime" id="meterial_time_{@numTem}" type="text" class="itext date select" placeholder="到位时间" value="{@ntime}" datatype="Require" msg="素材到达时间不能为空">
				<select name="type" id="meterial_type_{@numTem}">
					<option value="1">素材</option>
					<option value="2">文案</option>
				</select>
				<select name="iscommit" id="meterial_iscommit_{@numTem}">
					<option value="0">未到达</option>
					<option value="1">已经到达</option>
				</select>
				<input type="text" name="url" id="meterial_url_{@numTem}" class="itext stitle" placeholder="64机存放地址" value="{@url}">
				<input type="button" value="" class="btnc btnc_del" id="support_list_rowDelBtn_{@numTem}"/>
				<input name="meterialid" type="hidden" value="{@meterialid}">
				<input name="proj_id" type="hidden" value="{@proj_id}">
			</li>
		</ul>
		<input type="hidden" id="support_list_json" name="support_list_json">
		</form>
		<div class="row_add" id="support_list_rowAddBtn"><a>添加素材</a></div>
        <div style="text-align:center;margin-top:10px"><a class="btn btn_main1" id="support_list_SaveAll">保存素材修改</a></div>
	</section>
	
		<section class="boxstyle2" style="border-top:none">
			<h2>父项目</h2>
			<?php if ($this->_tpl_vars['parent_proj'] != null): ?>
				<ul class="skill_user">
					<li>
						<a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project_bll','a' => 'project_show','id' => $this->_tpl_vars['parent_proj']['proj_id']), $this);?>
">
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
			<div class="add_child_proj_div">
			<a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project','a' => 'project_add','p_proj_id' => $this->_tpl_vars['rs']['proj_id'],'specialtask' => 2), $this);?>
"><span class="add_proj">新增子项目</span></a>
			<?php if ($this->_tpl_vars['child_proj'] != null || $this->_tpl_vars['vritual_proj'] != null): ?>
				<a href="javascript:delChildProj(<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
);"><span class="add_proj del_proj">解除关系</span></a>
			<?php endif; ?>
			</div>
			
			<ul class="skill_user">
			<?php if ($this->_tpl_vars['child_proj'] != null || $this->_tpl_vars['vritual_proj'] != null): ?>
				<?php $_from = $this->_tpl_vars['child_proj']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cp1']):
?>
					<li>
						<a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project_bll','a' => 'project_show','id' => $this->_tpl_vars['cp1']['proj_id']), $this);?>
">
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
						<a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project','a' => 'project_add','p_proj_id' => $this->_tpl_vars['rs']['proj_id'],'specialtask' => 2,'mtpl_id' => $this->_tpl_vars['vp1']['mtpl_id'],'vritual_id' => $this->_tpl_vars['vp1']['proj_vritual_child_id']), $this);?>
">
							<span class="child_state_-1">
								<?php echo $this->_tpl_vars['vp1']['mtpl_name']; ?>

								(模板-未创建)
							</span>
						</a>
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
		<h2>项目流程修改</h2>
		<div id="project_gra"></div>
        <form id="nodesEditForm">
        <ul id="pnodes" class="table_node">
        	<li id="pnodes_row_{@numTem}">
            	<dl>
                	<dt>流程名</dt>
                    <dd><input name="pnod_name" type="text" id="pnod_name{@numTem}" maxlength="45" class="itext stitle" value="{@pnod_name}" datatype="Require" msg="流程名不能为空" /></dd>
                    <dt>类型</dt>
                    <dd>
						<input name="pnod_type_name" type="text"id="pnod_type_name{@numTem}" autocomplete="off" readonly  class="itext date select" value="{@pnod_type_name}"/>
						<input name="pnod_type" type="hidden" id="pnod_type{@numTem}" value="{@pnod_type}" class="" datatype="Number" msg="请选择流程类型1"/>
						<input name="pnod_type2_name" type="text"id="pnod_type2_name{@numTem}" autocomplete="off" readonly  class="itext date select" value="{@pnod_type_name2}"/>
						<input name="pnod_type2" type="hidden" id="pnod_type2{@numTem}" value="{@pnod_type2}" class="" datatype="Number" msg="请选择流程类型2"/>
                    </dd>
                    <dt>执行人</dt>
                    <dd>
						<input name="user_name" type="text"id="pnod_user_name{@numTem}" autocomplete="off" readonly  class="itext date select" value="{@user_name}"/>
		       			<input name="user_id_n" type="hidden" id="user_id_n{@numTem}" value="{@user_id}"/>
                    </dd>    
                    <dt>
                    	<input id="pnod_id{@numTem}" name="pnod_id" type="hidden" value="{@pnod_id}"><input type="button" value="" class="btnc btnc_del" id="pnodes_rowDelBtn_{@numTem}"/>
                    </dt>
                
                    <dt style="clear:left;padding-left:42px">时间安排</dt>
                    <dd>
						<input type="text" name="pnod_time_s" id="pnod_time_s{@numTem}" readonly class="itext date select" value="{@pnod_time_s}"/> - 
		            	<input type="text" name="pnod_time_e" id="pnod_time_e{@numTem}" readonly class="itext date select" value="{@pnod_time_e}"/>
                    </dd>
					<?php if ($this->_tpl_vars['user']['power'] < 2): ?>
                    <dt>预估工作量</dt>
                    <dd>
                    	
			            <input type="text" name="pnod_day" id="pnod_day{@numTem}" value="{@pnod_day}" class="itext num"/> 天
                    </dd>
					<?php endif; ?>
					<dt>
                    	<span class="beforePnode_add beforePnode_set" id="pnodes_before_{@numTem}">
				    		前置流程设置
				    	</span>
                    </dt>
                </dl>
            </li>
        </ul>
          </form>
		  <div class="row_add" id="pnodes_rowAddBtn"><a>添加流程</a></div>	
          <div style="text-align:center;margin-top:10px"><a class="btn btn_main1" id="pnodes_SaveAll">保存流程修改</a></div>
	</section>
	
	<section class="boxstyle1">
		<h2>项目的节点</h2>
	    <table id="sections" class="table_node">
	      <tr id="sections_row_{@numTem}">
	        <th width="93" height="25" class="tleft">节点名</th>
	        <td width="200"><input type="text" class="itext stitle"  value="项目启动" readonly/></td>
	        <td width="100">
	            <input type="text" name="proj_start" id="proj_start" readonly class="itext date select"  value="<?php echo ((is_array($_tmp=$this->_tpl_vars['rs']['proj_start'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
"  datatype="Require" msg="请填写项目启动时间" />
	        </td>
            <td width="125">
				<select name="proj_startTime" id="proj_startTime" class="itext">
				<?php if ($this->_tpl_vars['rs']['proj_start']): ?><option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['rs']['proj_start'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M:%S") : smarty_modifier_date_format($_tmp, "%H:%M:%S")); ?>
" selected="selected"><?php echo ((is_array($_tmp=$this->_tpl_vars['rs']['proj_start'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H") : smarty_modifier_date_format($_tmp, "%H")); ?>
时</option><?php endif; ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/timeSelect.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</select>
            </td>
	        <th width="450">
			<?php if ($this->_tpl_vars['rs']['proj_state'] >= 20): ?>
			<?php if ($this->_tpl_vars['rs']['proj_state'] == 20): ?>
			更改原因<input type="text" id="proj_start_modiReson" class="itext stitle" value="" /> 
			<?php endif; ?>
			<input type="button" value="" onclick="sectionEdit('start')" class="btnc btnc_save" title="保存"/>
			<?php endif; ?>
			</th>
	      </tr>
	      <tr id="sections_row_{@numTem}">
	        <th height="25" class="tleft">节点名</th>
	        <td><input type="text" class="itext stitle"  value="项目上线" readonly/></td>
	        <td>
	            <input type="text" name="proj_end" id="proj_end" readonly class="itext date select" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['rs']['proj_end'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
" datatype="Require" msg="请填写项目上线时间" />
	        </td>
            <td width="175">
            	<select name="proj_endTime" id="proj_endTime" class="itext">
				<?php if ($this->_tpl_vars['rs']['proj_end']): ?><option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['rs']['proj_end'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M:%S") : smarty_modifier_date_format($_tmp, "%H:%M:%S")); ?>
" selected="selected"><?php echo ((is_array($_tmp=$this->_tpl_vars['rs']['proj_end'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H") : smarty_modifier_date_format($_tmp, "%H")); ?>
时</option><?php endif; ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/timeSelect.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</select>
            </td>
			<th>
			<?php if ($this->_tpl_vars['rs']['proj_state'] >= 20): ?>
			<?php if ($this->_tpl_vars['rs']['proj_state'] == 20): ?>
			更改原因<input type="text" id="proj_end_modiReson" class="itext stitle" value="" /> 
			<?php endif; ?>
			<input type="button" value="" onclick="sectionEdit('end')" class="btnc btnc_save" title="保存"/>
			<?php endif; ?>
			</th>
	      </tr>
	    </table>
	</section>
	
	<section class="footer"></section>

</article>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="pnod_before_popwin" class="popwin">
    <div class="popwin_inner clearfix">

    </div>
</div>
<div id="del_child_proj_popwin" class="popwin">
    <div class="popwin_inner clearfix">

    </div>
</div>
<script type="text/javascript">

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


var _tem0='<a title="{@user}-{@title}【{@stateName}】{@beforeNodes}" onclick="PMS.showNode({@nodeId})" style="width:{@widthFinal}px;margin-left:{@left}px;" class="pnod node"><span style="width:{@widthEnd}px;" class="title-short rowcolor{@state}"><span class="inner">{@user}-{@title}【{@stateName}】{@beforeNodes}</span></span></a>';
	function reloadCanlendar(){PMS.loadCalendar("project_gra",{projId:'<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
',type:'nodeInProject',ps:1,select:1000,"group":[['','',_tem0]]});}
	
	function rowadded(n)
	{
		PMS.bindDatepickers("#pnod_time_s"+n,"#pnod_time_e"+n);
		PMS.showSelectList("users","user_id_n"+n,"pnod_user_name"+n);
		PMS.showSelectList("users","user_id_n"+n,"pnod_user_name"+n);
				$("#pnod_type_name"+n).click(function() {
					current_nClassID=n;
					PMS.showSelectList("data","pnod_type"+n,"pnod_type_name"+n,{type:"nClass","autoBind":false});
				});
		$("#pnod_type2_name"+n).click(function() {
					PMS.showSelectList("data","pnod_type2"+n,"pnod_type2_name"+n,{"supper_id":$("#pnod_type"+n).val(),type:"nClass2","reload":true,"autoBind":false});
				});
		$("#pnodes_before_"+n).click(function() {
			pnode_before_pnode(<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
,$("#pnod_id"+n).val(),$("#pnod_name"+n).val());
		});
	}
	
	//节点编辑
	function sectionEdit(ac)
	{
		var date=$('#proj_'+ac).val();
		var time=$('#proj_'+ac+'Time').val();
		var reson=$('#proj_'+ac+'_modiReson').val();
		var sendData={'date':date,'time':time,'reson':reson,'type':ac,'proj_id':<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
};
		$.post("<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project_bll','a' => 'sectionEidtDo'), $this);?>
",sendData,function(rs){alert(rs.des)},"json");
	}
	
	//执行
	$(function(){
		
		PMS.rowEditorEdit("support_list","meterialid","#support_list li",<?php echo $this->_tpl_vars['meterialJson']; ?>
,{
		"addRowFn":function(n,row)
		{
			$('#meterial_time_'+n).datepicker();
			if(row)
			{
				$('#meterial_type_'+n+' option[value='+row['type']+']').attr('selected','selected');
				$('#meterial_iscommit_'+n+' option[value='+row['iscommit']+']').attr('selected','selected');
			}
		},
		"addSaveAllUrl":"index.php?c=project&a=saveMeterial&proj_id=<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
",
		"rowDelUrl":"index.php?c=project&a=deleteMeterial",
		"vForm":"support_list_form"
		});	
		

		PMS.bindDatepickers("#proj_start","#proj_end");
		reloadCanlendar();
		PMS.showSelectList("products","prod_id","prod_id_text");
		PMS.showSelectList("pClass","proj_class","proj_class_text");
		$("#wrap_id_text").click(function(e) {
			PMS.showSelectList("wraps","wrap_id","wrap_id_text",{"supper_id":$("#prod_id").val(),"e":e,"autoBind":false,"reload":true});
		});
		PMS.rowEditorEdit("pnodes","pnod_id","#pnodes li",<?php echo $this->_tpl_vars['proj_node_json']; ?>
,{
		"editSaveUrl":"index.php?c=pnode&a=pnodSave",
		"editSaveFn":function(n){reloadCanlendar();},
		"addRowFn":function(n){rowadded(n);},
		"addSaveAllUrl":"index.php?c=pnode&a=pnodSaveAll&proj_id=<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
",
		"addSaveFn":function(n,wrapid){reloadCanlendar();},
		"rowDelUrl":"index.php?c=pnode&a=pnodDel",
		"rowDelFn":function(n){reloadCanlendar()},
		"vForm":"nodesEditForm"
		});	
	})
	function pnode_before_pnode(proj_id,pnode_id,pnod_name)
    {
        var url= "<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project','a' => 'pnode_before'), $this);?>
" + "&pnode_id="+pnode_id + "&proj_id="+proj_id+ "&pnod_name="+pnod_name;
        $('#pnod_before_popwin div').load(url,function(){_$.popWin("pnod_before_popwin");});
    }
	function delChildProj(proj_id)
	{
		var url= "<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project','a' => 'del_child_proj'), $this);?>
" +  "&proj_id="+proj_id ;
        $('#del_child_proj_popwin div').load(url,function(){_$.popWin("del_child_proj_popwin");});
	}
	
</script>
</body>
</html>