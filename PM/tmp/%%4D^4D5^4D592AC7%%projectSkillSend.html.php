<?php /* Smarty version 2.6.26, created on 2013-07-09 11:39:25
         compiled from project/projectSkillSend.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'project/projectSkillSend.html', 30, false),array('modifier', 'default', 'project/projectSkillSend.html', 60, false),)), $this); ?>
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
#skill_user_popwin .flow-item-one label{font-size: 14px;line-height: 34px;}
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
        	<h1>技能配置及发放 - 项目 - <?php echo $this->_tpl_vars['rs']['proj_name']; ?>
</h1>
	        <div class="tab searchTab5">
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
				<span class="dot">&nbsp;</span>
				<a title="技能发放" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'skillSend','id' => $this->_tpl_vars['rs']['proj_id']), $this);?>
" id="searchTab5">技</a>
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
" disabled="true "/></dd>					
					<dt>项目类型</dt>
					<dd>
						<input type="text" class="itext select" id="proj_class_text" autocomplete="off" readonly value="<?php echo $this->_tpl_vars['proj_class'][$this->_tpl_vars['rs']['proj_class']]; ?>
" disabled="true">
						<input type="hidden" name="proj_class" id="proj_class" value="<?php echo $this->_tpl_vars['rs']['proj_class']; ?>
">
					</dd>						
					<dt>所属产品</dt>
					<dd>
						<input type="text" class="itext select" id="prod_id_text" autocomplete="off" readonly value="<?php echo $this->_tpl_vars['rs']['prod_name']; ?>
" disabled="true ">
						<input type="hidden" name="prod_id" id="prod_id" datatype="Require" msg="请选择产品" value="<?php echo $this->_tpl_vars['rs']['prod_id']; ?>
" datatype="Require" msg="请选择产品">
					</dd>
					<!--  
					<dt>所属项目集</dt>
					<dd>
						<input type="text" class="itext select stitle" id="wrap_id_text" autocomplete="off" readonly value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['rs']['wrap_name'])) ? $this->_run_mod_handler('default', true, $_tmp, "空集") : smarty_modifier_default($_tmp, "空集")); ?>
" disabled="true ">
						<input type="hidden" name="wrap_id" id="wrap_id" value="<?php echo $this->_tpl_vars['rs']['wrap_id']; ?>
">
					</dd>
					<dt>贡献值</dt>
					<dd>
						<input name="proj_contri" type="text" id="proj_contri"  maxlength="100" datatype="Require" msg="贡献值不能为空" class="itext" value="<?php echo $this->_tpl_vars['proj_contri']; ?>
" disabled="true "/></dd>
					</dd>
					-->
					<dt>项目目标</dt>
					<dd><input name="proj_target" type="text" id="proj_target" value="<?php echo $this->_tpl_vars['rs']['proj_target']; ?>
" maxlength="200" class="itext stitle"  disabled="true "/></dd>
					
					
				</dl>
				<dl class="info clearfix2">
					<dt>预览机地址</dt>
					<dd class="url">
						<input id="preview_address" name="preview_address" type="text" maxlength="200" value="<?php echo $this->_tpl_vars['rs']['preview_address']; ?>
" class="itext stitle"  disabled="true "/></dd>
					</dd>
					<dt>上线网址</dt>
					<dd><input type="text" class="itext stitle" id="proj_url" name="proj_url" value="<?php echo $this->_tpl_vars['rs']['proj_url']; ?>
" placeholder="只填写一个，更多请在[项目备注]填写" datatype="Require" msg="上线网址请填写一个，更多请在[项目备注]填写" disabled="true "> <a href="http://bbs.nb.netease.com/viewthread.php?tid=810&highlight=" target="_blank" style="color:#0267B1;font-size:12px">专题规范查询</a></dd>
					<dt>64机地址</dt>
					<dd><input name="proj_psdUrl" type="text" id="proj_psdUrl" value="<?php echo $this->_tpl_vars['rs']['proj_psdUrl']; ?>
" maxlength="200" class="itext stitle" datatype="Require" msg="请先在64机上建立好备份文件夹，并填在创建项目时填写。" disabled="true "/></dd>
					<dt class="ps">项目备注</dt>
					<dd class="ps_data"  style="height:100px">
					<textarea name="proj_ps" id="proj_ps" class="itext" style="width:350px;height:100px" disabled="true "><?php echo $this->_tpl_vars['rs']['proj_ps']; ?>
</textarea>
					</dd>
				</dl>
	         </div>
			<input type="hidden" id="proj_id" name="proj_id" value="<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
" />
			<input type="hidden" name="fromModel" value="c=project_bll&a=projEdit&id=<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
">
			<p align="center"></p>
		</form>
	</section>
	
	<section class="boxstyle2" style="border-top:none">
			<h2>技能配置及发送</h2>
			<ul class="skill_user">
			<?php $_from = $this->_tpl_vars['skill_user']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs1']):
?>
				<li>
					<a onclick="javascript:selectedUser(<?php echo $this->_tpl_vars['rs1']['user_id']; ?>
,<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
);";>
						<span class="
							<?php if ($this->_tpl_vars['rs1']['num'] == 1): ?>
								"><?php echo $this->_tpl_vars['rs1']['user_name']; ?>
(点击进行技能配置)
							<?php endif; ?>
							<?php if ($this->_tpl_vars['rs1']['num'] == 2): ?>
								needSend"><?php echo $this->_tpl_vars['rs1']['user_name']; ?>
(点击进行评价)
							<?php endif; ?>
							<?php if ($this->_tpl_vars['rs1']['num'] == 3): ?>
								finish"><?php echo $this->_tpl_vars['rs1']['user_name']; ?>
(已完成评价)
							<?php endif; ?>
						</span>
					</a>
				</li>
			<?php endforeach; endif; unset($_from); ?> 
			</ul>
	</section>

	<section class="boxstyle2" style="display: none;">
		<h2 class="clearfix">素材支持</h2>
		<form id="support_list_form">
		<ul id="support_list" class="table_node">
			<li id="support_list_row_{@numTem}">
				<input name="name" type="text" class="itext" placeholder="素材名称" value="{@name}" datatype="Require" msg="素材名不能为空" disabled="true ">
				<input name="ntime" id="meterial_time_{@numTem}" type="text" class="itext date select" placeholder="到位时间" value="{@ntime}" datatype="Require" msg="素材到达时间不能为空" disabled="true ">
				<select name="type" id="meterial_type_{@numTem}" disabled="true ">
					<option value="1">素材</option>
					<option value="2">文案</option>
				</select>
				<select name="iscommit" id="meterial_iscommit_{@numTem}" disabled="true ">
					<option value="0">未到达</option>
					<option value="1">已经到达</option>
				</select>
				<input type="text" name="url" id="meterial_url_{@numTem}" class="itext stitle" placeholder="64机存放地址" value="{@url}" disabled="true ">
				<input name="meterialid" type="hidden" value="{@meterialid}">
				<input name="proj_id" type="hidden" value="{@proj_id}">
			</li>
		</ul>
		<input type="hidden" id="support_list_json" name="support_list_json">
		</form>
		<div class="row_add" id="support_list_rowAddBtn"><a>添加素材</a></div>
        <div style="text-align:center;margin-top:10px"><a class="btn btn_main1" id="support_list_SaveAll">保存素材修改</a></div>
	</section>

	<section class="boxstyle2 proj_gra">
		<h2>项目流程</h2>
		<div id="project_gra"></div>
        <form id="nodesEditForm">
        <ul id="pnodes" class="table_node">
        	<li id="pnodes_row_{@numTem}">
            	<dl>
                	<dt>流程名</dt>
                    <dd><input name="pnod_name" type="text" id="pnod_name{@numTem}" maxlength="45" class="itext stitle" value="{@pnod_name}" datatype="Require" msg="流程名不能为空" disabled="true "/></dd>
                    <dt>类型</dt>
                    <dd>
						<input name="pnod_type_name" type="text"id="pnod_type_name{@numTem}" autocomplete="off" readonly  class="itext date select" value="{@pnod_type_name}" disabled="true "/>
						<input name="pnod_type2_name" type="text"id="pnod_type2_name{@numTem}" autocomplete="off" readonly  class="itext date select" value="{@pnod_type_name2}" disabled="true "/>
                    </dd>
                    <dt>执行人</dt>
                    <dd>
						<input name="user_name" type="text"id="pnod_user_name{@numTem}" autocomplete="off" readonly  class="itext date select" value="{@user_name}" disabled="true "/>
                    </dd>    
                    <dt>
                    </dt>
                
                    <dt style="clear:left;padding-left:42px">时间安排</dt>
                    <dd>
						<input type="text" name="pnod_time_s" id="pnod_time_s{@numTem}" readonly class="itext date select" value="{@pnod_time_s}" disabled="true "/> - 
		            	<input type="text" name="pnod_time_e" id="pnod_time_e{@numTem}" readonly class="itext date select" value="{@pnod_time_e}" disabled="true "/>
                    </dd>
					<?php if ($this->_tpl_vars['user']['power'] < 2): ?>
                    <dt>预估工作量</dt>
                    <dd>
                    	
			            <input type="text" name="pnod_day" id="pnod_day{@numTem}" value="{@pnod_day}" class="itext num" disabled="true "/> 天
                    </dd>
					<?php endif; ?>
                </dl>
            </li>
        </ul>
          </form>	
	</section>
	
	
	<section class="footer"></section>

</article>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="skill_user_popwin" class="popwin">
    <div class="popwin_inner clearfix">

    </div>
</div>
<script type="text/javascript">

$("#skill_user_popwin").hide();

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
	
	function selectedUser(user_id,proj_id)
    {
        var url= "<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'SkillSend_ajax'), $this);?>
" + "&user_id="+user_id + "&proj_id="+proj_id;
        $('#skill_user_popwin div').load(url,function(){_$.popWin("skill_user_popwin");});
    }
	
</script>
</body>
</html>