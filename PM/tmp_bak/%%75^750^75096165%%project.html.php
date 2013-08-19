<?php /* Smarty version 2.6.26, created on 2013-07-03 09:38:27
         compiled from project/project.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'project/project.html', 24, false),array('modifier', 'default', 'project/project.html', 47, false),)), $this); ?>
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
<link rel="stylesheet" href="themes/css/projectshow.css?cache=<?php echo @RD; ?>
" />
<link type="text/css"  rel="stylesheet" href="themes/css/jquery.ui.all.css?cache=<?php echo @RD; ?>
" />
<script type="text/javascript" src="themes/js/jquery-ui.last.js?cache=<?php echo @RD; ?>
"></script>
<script type="text/javascript" src="themes/js/vilidate.js?cache=<?php echo @RD; ?>
"></script>
</head>
<body id="projectShow" class="manage project_show">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<article class="content">
		<section class="search">
        	<h1 class="pageTitle">项目信息</h1>
	        <div class="tab searchTab2">
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
		
		<section style="padding-bottom:10px;">
			<p><a class="btns btns_meta" id="btn_getMeta">提取meta</a></p>
			<div id="metaConetnt"></div>
		</section>
        
		<section class="header"></section>
		<section class="boxstyle1 top proj_info">
			<h2><?php echo $this->_tpl_vars['rs']['prod_name']; ?>
 - <?php echo $this->_tpl_vars['rs']['proj_name']; ?>
<span>[<?php echo $this->_tpl_vars['proj_state_list'][$this->_tpl_vars['rs']['proj_state']]; ?>
]</span></h2>
			<dl class="info clearfix2">
				<dt>项目分级：</dt>
				<dd><?php echo ((is_array($_tmp=@$this->_tpl_vars['rs']['proj_level1_name'])) ? $this->_run_mod_handler('default', true, $_tmp, '未定') : smarty_modifier_default($_tmp, '未定')); ?>
</dd>
				<dt>项目类型：</dt>
				<dd><?php echo $this->_tpl_vars['proj_class'][$this->_tpl_vars['rs']['proj_class']]; ?>
</dd>
				<!--
				<dt>所属项目集：</dt>
				<dd><?php if ($this->_tpl_vars['rs']['wrap_name']): ?><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'wrap','a' => 'showWrap','wrapId' => $this->_tpl_vars['rs']['wrap_id']), $this);?>
"><?php echo $this->_tpl_vars['rs']['wrap_name']; ?>
<a/><?php else: ?>空集<?php endif; ?></dd>			
				-->
				<dt>负责人：</dt>
				<dd><?php echo $this->_tpl_vars['rs']['user_name']; ?>
</dd>
				<dt>访问地址：</dt>
				<dd class="url"><a id="toolPageCheck">[查]</a> <a href="<?php echo $this->_tpl_vars['rs']['proj_url']; ?>
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
				<!-- 
				<dt>贡献值：</dt>
				<dd class="url"><input type="text" value="<?php echo $this->_tpl_vars['proj_contri']; ?>
" id="contri"></dd>
				 -->
				<dt class="ps">项目备注：</dt>
				<dd class="ps_data">
				<textarea  style="width:100%;height:100%;overflow:auto;border:none;background:#E9E9E9;line-height:24px"><?php echo $this->_tpl_vars['rs']['proj_ps']; ?>
</textarea>
				</dd>
			</dl>
            <?php if ($this->_tpl_vars['power'] == 0 && $this->_tpl_vars['projectScore']): ?>
            <div class="project-score">项目得分：<strong><?php echo $this->_tpl_vars['projectScore']; ?>
</strong></div>
            <?php endif; ?>
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
		
		<section class="boxstyle1" style="border-top:none">
			<h2>组员可获得技能情况</h2>
			<ul class="skill_user_show">
			<?php $_from = $this->_tpl_vars['skill_user']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs1']):
?>
				<li>
					<span>
						<?php echo $this->_tpl_vars['rs1']['user_name']; ?>
:
					</span>
					<span class="skills_show">
						<?php $_from = $this->_tpl_vars['rs1']['skills']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs2']):
?>
							<span><?php echo $this->_tpl_vars['rs2']['skill_name']; ?>
</span>
						<?php endforeach; endif; unset($_from); ?> 
					</span>
				</li>
			<?php endforeach; endif; unset($_from); ?> 
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
		
		<section class="boxstyle2" style="border-top:none">
			<h2>项目进度操作</h2>
			<ul class="pnode_gra">
			<?php $_from = $this->_tpl_vars['proj_node']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
				<?php if ($this->_tpl_vars['is_user'] == '1' || $this->_tpl_vars['rs']['user_id'] == $this->_tpl_vars['user_id']): ?>
				
				  <?php if ($this->_tpl_vars['rs']['pnod_state'] == 20 && $this->_tpl_vars['rs']['pnod_state2'] == 0): ?>
						<li onClick="setState(<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
,<?php echo $this->_tpl_vars['rs']['pnod_id']; ?>
,15,'pnod_state')"><a class="state<?php echo $this->_tpl_vars['rs']['pnod_state']; ?>
"><?php if ($this->_tpl_vars['rs']['pnod_day']): ?>（<?php echo $this->_tpl_vars['rs']['pnod_day']; ?>
）<?php endif; ?>【<?php echo $this->_tpl_vars['rs']['pnod_name']; ?>
】 by <?php echo $this->_tpl_vars['rs']['user_name']; ?>
<span class="stateicon stateicon_<?php echo $this->_tpl_vars['rs']['pnod_state']; ?>
"><?php echo $this->_tpl_vars['pnod_state_list'][$this->_tpl_vars['rs']['pnod_state']]; ?>
</span></a></li>
				  <?php elseif ($this->_tpl_vars['rs']['pnod_state'] == 20 && $this->_tpl_vars['rs']['pnod_state2'] == 1): ?>
						<li onClick="setState(<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
,<?php echo $this->_tpl_vars['rs']['pnod_id']; ?>
,17,'pnod_state')"><a class="state<?php echo $this->_tpl_vars['rs']['pnod_state']; ?>
"><?php if ($this->_tpl_vars['rs']['pnod_day']): ?>（<?php echo $this->_tpl_vars['rs']['pnod_day']; ?>
）<?php endif; ?>【<?php echo $this->_tpl_vars['rs']['pnod_name']; ?>
】 by <?php echo $this->_tpl_vars['rs']['user_name']; ?>
<span class="stateicon stateicon_<?php echo $this->_tpl_vars['rs']['pnod_state']; ?>
"><?php echo $this->_tpl_vars['pnod_state_list'][$this->_tpl_vars['rs']['pnod_state']]; ?>
</span></a></li>
				  <?php elseif ($this->_tpl_vars['rs']['pnod_state'] == 18 && $this->_tpl_vars['rs']['pnod_state2'] == 1): ?>
						<li onClick="setState(<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
,<?php echo $this->_tpl_vars['rs']['pnod_id']; ?>
,18.1,'pnod_state')"><a class="state20"><?php if ($this->_tpl_vars['rs']['pnod_day']): ?>（<?php echo $this->_tpl_vars['rs']['pnod_day']; ?>
）<?php endif; ?>【<?php echo $this->_tpl_vars['rs']['pnod_name']; ?>
】 by <?php echo $this->_tpl_vars['rs']['user_name']; ?>
<span class="stateicon stateicon_20"><?php echo $this->_tpl_vars['pnod_state_list'][$this->_tpl_vars['rs']['pnod_state']]; ?>
</span></a></li>
				  
				  <?php else: ?>
                  		<!-- 管理员或该流程的审核员可以直接提交 -->
                    	<?php if ($this->_tpl_vars['rs']['pnod_state'] == 17 && ( $this->_tpl_vars['role_id'] == $this->_tpl_vars['rs']['pnod_type'] && @PM_power < 2 || @PM_power == 0 )): ?>
                        	<li onClick="PMS.showNode(<?php echo $this->_tpl_vars['rs']['pnod_id']; ?>
,{project:0,pass:1})"><a class="state<?php echo $this->_tpl_vars['rs']['pnod_state']; ?>
 controlEnable"><?php if ($this->_tpl_vars['rs']['pnod_day']): ?>（<?php echo $this->_tpl_vars['rs']['pnod_day']; ?>
）<?php endif; ?>【<?php echo $this->_tpl_vars['rs']['pnod_name']; ?>
】 by <?php echo $this->_tpl_vars['rs']['user_name']; ?>
<span class="stateicon stateicon_<?php echo $this->_tpl_vars['rs']['pnod_state']; ?>
"><?php echo $this->_tpl_vars['pnod_state_list'][$this->_tpl_vars['rs']['pnod_state']]; ?>
</span></a></li>
                        <?php else: ?>
                        	<li><a class="state<?php echo $this->_tpl_vars['rs']['pnod_state']; ?>
"><?php if ($this->_tpl_vars['rs']['pnod_day']): ?>（<?php echo $this->_tpl_vars['rs']['pnod_day']; ?>
）<?php endif; ?>【<?php echo $this->_tpl_vars['rs']['pnod_name']; ?>
】 by <?php echo $this->_tpl_vars['rs']['user_name']; ?>
<span class="stateicon stateicon_<?php echo $this->_tpl_vars['rs']['pnod_state']; ?>
"><?php echo $this->_tpl_vars['pnod_state_list'][$this->_tpl_vars['rs']['pnod_state']]; ?>
</span></a></li>
                        <?php endif; ?>
				  <?php endif; ?>
				  
				<?php elseif ($this->_tpl_vars['rs']['pnod_state'] == 18 && $this->_tpl_vars['rs']['pnod_state2'] == 1): ?>
						<li onClick="setState(<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
,<?php echo $this->_tpl_vars['rs']['pnod_id']; ?>
,18.1,'pnod_state')"><a class="state20"><?php if ($this->_tpl_vars['rs']['pnod_day']): ?>（<?php echo $this->_tpl_vars['rs']['pnod_day']; ?>
）<?php endif; ?>【<?php echo $this->_tpl_vars['rs']['pnod_name']; ?>
】 by <?php echo $this->_tpl_vars['rs']['user_name']; ?>
<span class="stateicon stateicon_20"><?php echo $this->_tpl_vars['pnod_state_list'][$this->_tpl_vars['rs']['pnod_state']]; ?>
</span></a></li>
				  
				<?php else: ?>
					<li><a class="state<?php echo $this->_tpl_vars['rs']['pnod_state']; ?>
" style="cursor:default"><?php if ($this->_tpl_vars['rs']['pnod_day']): ?>（<?php echo $this->_tpl_vars['rs']['pnod_day']; ?>
）<?php endif; ?>【<?php echo $this->_tpl_vars['rs']['pnod_name']; ?>
】 by <?php echo $this->_tpl_vars['rs']['user_name']; ?>
<span class="stateicon stateicon_<?php echo $this->_tpl_vars['rs']['pnod_state']; ?>
"><?php echo $this->_tpl_vars['pnod_state_list'][$this->_tpl_vars['rs']['pnod_state']]; ?>
</span></a></li>
				<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
			</ul>
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
			<?php $_from = $this->_tpl_vars['proj_node']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['pn_rs']):
?>
				<?php if ($this->_tpl_vars['pn_rs']['outcome'] != '0' && $this->_tpl_vars['pn_rs']['outcome'] != "-1"): ?>
					<li class="btn_show_upload_box" data_id="<?php echo $this->_tpl_vars['pn_rs']['pnod_id']; ?>
">
						<a class="file a_waitfile"></a>
						<div class="fileInfo waitfile">
							<p><?php echo $this->_tpl_vars['pn_rs']['pnod_name']; ?>
</p>
							<p><?php echo $this->_tpl_vars['pn_rs']['user_name']; ?>
</p>
							<p><?php echo $this->_tpl_vars['pn_rs']['outcome']; ?>
</p>
						</div>
					</li>
				<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
				<li class="btn_show_upload_box"><a class="add">添加</a></li>
			</ul>
		</section>
        
        <!-- 打分记录 -->
        <?php if ($this->_tpl_vars['power'] == 0 && ( $this->_tpl_vars['scoreArray'] || $this->_tpl_vars['nodeScoreArray'] )): ?>
        <section class="boxstyle2 event">
        	<h2>打分记录</h2>
            <dl class="event_list" id="project-score">
            	<!-- 项目评分 -->
              	<?php if ($this->_tpl_vars['scoreArray']): ?>
            	<dt>整体项目<span class="score"><?php echo ((is_array($_tmp=@$this->_tpl_vars['projectScore'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
</span></dt>
                <?php $_from = $this->_tpl_vars['scoreArray']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
                <dd>
					<ul class="clearfix eventType3">
						<li class="date"><?php echo $this->_tpl_vars['rs']['time']; ?>
</li>
						<li class="userName"><?php echo $this->_tpl_vars['rs']['user_name']; ?>
</li>
						<li class="evenName">项目评分</li>
						<li class="evenContent"><?php if ($this->_tpl_vars['rs']['score']): ?><p class="score"><?php echo $this->_tpl_vars['rs']['score']; ?>
</p><?php echo $this->_tpl_vars['rs']['comment']; ?>
<?php else: ?>未打分<?php endif; ?><span></span></li>
					</ul>
                </dd>
                <?php endforeach; endif; unset($_from); ?>
                <?php endif; ?>
                <!-- 流程评分 -->
              	<?php if ($this->_tpl_vars['nodeScoreArray']): ?>
                <?php $_from = $this->_tpl_vars['proj_node']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
                <?php if (count ( $this->_tpl_vars['nodeScoreArray'][$this->_tpl_vars['rs']['pnod_id']] ) > 0): ?>
            	<dt><?php echo $this->_tpl_vars['rs']['pnod_name']; ?>
<span class="score"><?php echo ((is_array($_tmp=@$this->_tpl_vars['rs']['pnod_score'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
</span><span class="btns_text set-score" onClick="PMS.showNode(<?php echo $this->_tpl_vars['rs']['pnod_id']; ?>
,{score:1,project:0})">打分</span></dt>
                <?php $_from = $this->_tpl_vars['nodeScoreArray'][$this->_tpl_vars['rs']['pnod_id']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['nodeScore']):
?>
                <dd>
					<ul class="clearfix eventType3">
						<li class="date"><?php echo $this->_tpl_vars['nodeScore']['time']; ?>
</li>
						<li class="userName"><?php echo $this->_tpl_vars['nodeScore']['user_name']; ?>
</li>
						<li class="evenName">专业评分</li>
						<li class="evenContent"><?php if ($this->_tpl_vars['nodeScore']['score']): ?><p class="score"><?php echo $this->_tpl_vars['nodeScore']['score']; ?>
</p><?php echo $this->_tpl_vars['nodeScore']['comment']; ?>
<?php else: ?>未打分<?php endif; ?><span></span></li>
					</ul>
                </dd>
                <?php endforeach; endif; unset($_from); ?>
                <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
                <?php endif; ?>
            </dl>
        </section>
        <?php endif; ?>
        
        
		<!-- 事件记录 -->
		<section class="boxstyle2 event">
			<h2>项目事件记录</h2>
			<dl class="event_list" id="project-event">
				<dt style="display:block">整体项目</dt>
				<?php $_from = $this->_tpl_vars['event']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs2']):
?>
				<?php if (! $this->_tpl_vars['rs2']['pnod_id']): ?>
				<dd style="display:block">
					<ul class="clearfix eventType<?php echo $this->_tpl_vars['rs2']['even_type']; ?>
">
						<li class="date"><?php echo $this->_tpl_vars['rs2']['even_time']; ?>
</li>
						<li class="userName"><?php echo $this->_tpl_vars['rs2']['user_name']; ?>
</li>
						<li class="evenName"><?php echo $this->_tpl_vars['rs2']['even_name']; ?>
</li>
						<li class="evenContent"><?php echo $this->_tpl_vars['rs2']['even_content']; ?>
<span></span></li>
					</ul>
				</dd>
				<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?> 
			<?php $_from = $this->_tpl_vars['proj_node']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
				<dt onClick="showEventWithNodeId(<?php echo $this->_tpl_vars['rs']['pnod_id']; ?>
)">（+）<?php echo $this->_tpl_vars['rs']['pnod_name']; ?>
</dt>
				<?php $_from = $this->_tpl_vars['event']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs2']):
?>
				<?php if ($this->_tpl_vars['rs2']['pnod_id'] == $this->_tpl_vars['rs']['pnod_id']): ?>
				<dd class="project-event-<?php echo $this->_tpl_vars['rs2']['pnod_id']; ?>
">
					<ul class="clearfix eventType<?php echo $this->_tpl_vars['rs2']['even_type']; ?>
">
						<li class="date"><?php echo $this->_tpl_vars['rs2']['even_time']; ?>
</li>
						<li class="userName"><?php echo $this->_tpl_vars['rs2']['user_name']; ?>
</li>
						<li class="evenName"><?php echo $this->_tpl_vars['rs2']['even_name']; ?>
</li>
						<li class="evenContent"><?php echo $this->_tpl_vars['rs2']['even_content']; ?>
<span></span></li>
					</ul>
				</dd>
				<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?> 
			<?php endforeach; endif; unset($_from); ?> 
			</dl>

			<div id="event_add" class="event_add">
			    <form name="event_form" id="event_form" method="post" action="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'event','a' => 'add'), $this);?>
" onSubmit="return Validator.Validate(event_form,2)" >
					<dl class="clearfix">
						<dt>反馈/建议</dt>
						<dd>
							 <select name="pnod_id" id="pnod_id" datatype="Require" msg="请选择流程名">
			                	<option value="" selected="selected" style="color:#999">选择项目或流程</option>
								<option value="all">项目</option>
			                    <?php $_from = $this->_tpl_vars['proj_node']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs_node']):
?>  
			               		<option value="<?php echo $this->_tpl_vars['rs_node']['pnod_id']; ?>
"><?php echo $this->_tpl_vars['rs_node']['pnod_name']; ?>
 by <?php echo $this->_tpl_vars['rs_node']['user_name']; ?>
</option>
			                    <?php endforeach; endif; unset($_from); ?>
			                </select>
						</dd>
						<dt>内容</dt>
						<dd>
							<textarea name="even_content" id="even_content" cols="38" rows="5" datatype="Require" msg="内容不能为空"></textarea>
						</dd>
					</dl>
					<input type="submit" value="提 交" class="sumbit"/>
					<input type="hidden" name="proj_id" value="<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
"/>
			     </form>
			</div>
			
		</section>
		
        <?php if ($this->_tpl_vars['isCanScore']): ?>
        <section class="boxstyle2 clearfix" id="set-project-score-box">
        	<h2>项目评分</h2>
			<form action="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project','a' => 'setScore','id' => $this->_tpl_vars['rs']['proj_id']), $this);?>
" method="post" style="padding-top:20px;" onSubmit="return Validator.Validate(this,2)">
                	<dl class="clearfix comment-box">
                    	<dt>项目评分</dt>
                        <dd>
                        	<select name="score" datatype="Require" msg="请选择分数。">
                            	<option value="" selected>请选择分数</option>
								<?php $_from = $this->_tpl_vars['scoreNameArray']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                                <option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if ($this->_tpl_vars['k'] == 'C'): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['v']; ?>
</option>
								<?php endforeach; endif; unset($_from); ?>
                            </select>
                        </dd>
                        <dt>评价内容</dt>
                        <dd>
                        	<textarea name="comment"></textarea>
                        </dd>
                    </dl>
                    <div class="btns-box">
                    	<input type="submit" class="btn btn_main1" value="确认打分">
                    </div>
             </form>
        </section>
        <?php endif; ?>
		
        <?php if ($this->_tpl_vars['isShowInviteScore']): ?>
        <section class="boxstyle2 clearfix">
        	<h2>邀请打分</h2>
        	<div id="user-checkbox-container" style="padding-left:40px"></div>
            <div class="btns-box">
				<input type="submit" class="btn btn_main1" value="邀请打分" onClick="inviteUserToScore()" id="inviteUserToScoreBtn">
            </div>
            <script type="text/javascript">
				PMS.loadUserCheckBoxTo($("#user-checkbox-container"));
				var inviteUserToScore=function()
				{
					$("#inviteUserToScoreBtn").attr("disabled","true").val('提交中...');
					var noticeUserArray=$("#user-checkbox input").serializeArray();
					var postData={"id":"<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
","userArray":noticeUserArray};
					$.post("<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project','a' => 'inviteScore'), $this);?>
",postData,function(data)
					{
						if(data.rs==200)
						{
							alert("邀请成功！");
						}
						else
						  alert(data.des);
						$("#inviteUserToScoreBtn").removeAttr("disabled").val('邀请打分');
					},"json");
				}
            </script>
        </section>
        <?php endif; ?>
		
		<section class="boxstyle1 bottom clearfix">
			<!-- 暂停项目 -->
			<div style="padding:10px;background:#FFF0E1;border:1px solid #F90;display:none" id="cancel_project_box">
				<form name="form_cancel" action="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project','a' => 'setState','proj_id' => $this->_tpl_vars['rs']['proj_id'],'state' => 100), $this);?>
" method="post" onSubmit="return Validator.Validate(this,2)">
				<p>暂停原因：</p>
				<textarea class="itext" name="cancel_reason" style="width:100%;height:30px;margin:10px 0" datatype="Require" msg="请填写取消项目的原因。"></textarea>
				<p align="center"><input type="submit" value=" 确定 "/>　　　<input type="button" value=" 返回 " onClick="switchController('#btn_project_cancle','#cancel_project_box')"/></p>
				</form>
			</div>
			<!-- 恢复项目 -->
			<div style="padding:10px;background:#FFF0E1;border:1px solid #F90;display:none" id="recover_project_box">
				<form name="form_restore" action="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project','a' => 'setState','proj_id' => $this->_tpl_vars['rs']['proj_id'],'state' => 1020), $this);?>
" method="post" onSubmit="return Validator.Validate(this,2)">
				<p>将未完成的流程整体调整为从这个日期开始：<input class="itext" name="recover_day" id="recover_day" datatype="Require" msg="请填写日期。" value="0"/>(不改动时间，请填0)</p>
				<p align="center"><input type="submit" value=" 确定 "/>　　　<input type="button" value=" 返回 "  onClick="switchController('#btn_project_cancle','#recover_project_box')"/></p>
				</form>
			</div>
			
				<?php if ($this->_tpl_vars['is_user'] == 1): ?>
				<div class="proj_control btns-box">
					<?php if ($this->_tpl_vars['rs']['proj_state'] == 50): ?>
						<a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project','a' => 'setState','proj_id' => $this->_tpl_vars['rs']['proj_id'],'state' => 40), $this);?>
" class="btn btn_main1" style="float:left;margin-left:350px;">提交审核</a>
						<a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project','a' => 'proj_del','proj_id' => $this->_tpl_vars['rs']['proj_id']), $this);?>
" class="btn btn_main1" style="float:left;margin-left:20px;">删除该项目</a>
					<?php elseif ($this->_tpl_vars['isFinished'] == 1 && $this->_tpl_vars['rs']['proj_state'] == 20): ?>
						<a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project','a' => 'setState','proj_id' => $this->_tpl_vars['rs']['proj_id'],'state' => 15), $this);?>
" class="btn btn_main1" style="float:left;margin-left:350px;">项目完成</a>
						<a class="btn btn_main2 btn_cancel" style="float:left;margin-left:20px;" id="btn_project_cancle">暂停/取消项目</a>
					<?php elseif ($this->_tpl_vars['rs']['proj_state'] > 15 && $this->_tpl_vars['rs']['proj_state'] < 50): ?>
						<a class="btn btn_main1 btn_cancel" id="btn_project_cancle">暂停/取消项目</a>
					<?php elseif ($this->_tpl_vars['rs']['proj_state'] == 100): ?>
						<a class="btn btn_main1" id="btn_recover_project">恢复项目</a>
					<?php endif; ?>
				</div>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['rs']['proj_state'] == 15 && $this->_tpl_vars['power'] == 0 && $this->_tpl_vars['role_id'] == 5): ?>
				<div class="proj_control btns-box">
					<a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project','a' => 'setState','proj_id' => $this->_tpl_vars['rs']['proj_id'],'state' => 10), $this);?>
" class="btn btn_main1">确定归档</a>
				</div>
				<?php endif; ?>	
		</section>
		
		<section class="footer"></section>

</article>


<!--content end -->

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="file_add" class="popwin file_add">
	<div class="popwin_inner clearfix">
			<p class="title">上传附件(格式不限制，但服务器资源有限，建议文件不要超过10M。)</p>
            <form name="file_form" id="file_form" action="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'file'), $this);?>
" onSubmit="return setNum('table_file','file_row_count');"  method="post" enctype="multipart/form-data">
				<div style="padding:10px 0">
						相对流程名：
						<select name="pnod_id" id="pnod_id" style="font-size:12px;">
							<?php $_from = $this->_tpl_vars['proj_node']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs_node']):
?>
							<?php if ($this->_tpl_vars['rs_node']['user_id'] == $this->_tpl_vars['user_id']): ?>
							<option value="<?php echo $this->_tpl_vars['rs_node']['pnod_id']; ?>
" selected="selected"><?php echo $this->_tpl_vars['rs_node']['pnod_name']; ?>
【<?php echo $this->_tpl_vars['rs_node']['user_name']; ?>
】</option>
							<?php else: ?>
							<option value="<?php echo $this->_tpl_vars['rs_node']['pnod_id']; ?>
"><?php echo $this->_tpl_vars['rs_node']['pnod_name']; ?>
【<?php echo $this->_tpl_vars['rs_node']['user_name']; ?>
】</option>
							<?php endif; ?>
							<?php endforeach; endif; unset($_from); ?>
						</select>
				</div>
				<table id="table_file" class="table_node">
				  <tr id="table_file_row_{@numTem}">
					<td>附件</td>
					<td>
						<input name="p_{@num}" type="file" id="p_{@numTem}" datatype="Require" msg="没有选择上传的文件。" onChange="checkExt(this)"/>
					 </td>
					 <td>
						 <input name="file_name_{@num}" type="text" id="file_name_{@numTem}" datatype="Require" msg="没有填写附件标题。" class="itext" value="附件标题" style="width:180px;"/>
					 </td>
					 <td>
					 	<input type="button" value="" class="btnc btnc_del" title="移除" id="table_file_rowDelBtn_{@numTem}"/>
					 </td>
				  </tr>
				</table>
				
				<div class="row_add" id="table_file_rowAddBtn"><a class="btnadd">点击我，支持多文件一次上传。</a></div> 
				<?php if ($this->_tpl_vars['rs']['proj_state'] == 20): ?>
				<div style="padding:10px;color:#F00"><input type="checkbox" name="isSubmit" value="1"/>同时提交审核</div>
				<?php endif; ?>
				<div style="text-align:center">
				<input type="submit" value="提 交" class="btn btns_text" />
				<input type="hidden" name="proj_id" value="<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
"/>
                <input type="hidden" name="proj_id" value="<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
"/>
				<input type="hidden" name="file_row_count" id="table_file_rowCounter" value="0"/>
				</div>
        </form>
		<a title="关闭" onclick="_$.closewin('#file_add')" class="btn_close"></a>
	<div class="popwin_inner clearfix">
</div>

<script type="text/javascript">

var table_file_html=$('#table_file tbody:eq(0)').html();

var showEventWithNodeId=function(id)
{
	$("#project-event .project-event-"+id).toggle();
}


function deleteFile(fileId)
{
		if(confirm('删除后不可恢复，确定？'))
		{
			$("#file_row_"+fileId).append('<div class="loading"></div>');
			url='<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'file','a' => 'delete'), $this);?>
&url='+$("#file_row_"+fileId+" a:eq(0)").attr('href')+'&file_id='+fileId;
			$.get(url,function(msg){
							   if(msg.rs==1)
							   		$('#file_row_'+fileId).remove();
								else
								{
									alert(msg.des);
								}
							   },"json");

		}
}

function extractFile(fileId)
{
		if(confirm('将解压该文件，确定？'))
		{
			$("#file_row_"+fileId).append('<div class="loading"></div>');
			url='<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'zip'), $this);?>
&fileId='+fileId;
			$.get(url,function(msg){
							   if(msg.rs==1)
							   {
							   		$("#file_row_"+fileId+" a:eq(0)").attr('href',msg.fileUrl).addClass('floder');
									$("#file_row_"+fileId+" .loading").remove();
									$("#file_row_"+fileId+" .extractFile").remove();
							   }
							   else
							   {
							    	alert(msg.des);
							   }
					},"json");
		}
}

function setState(proj_id,pnod_id,state,action)
{
	//alert(arg);
	if(state==15)
		msger='确定流程已经完成？';
    else if(state==17)
		msger='确定将流程提交给上级审核？';
    else if(state==18)
		msger='确定提交检查并进入流程检查二？';
    else if(state==18.1)
		{msger='确定检查通过？';state=18;}
	if(confirm(msger+'（此操作无法撤销）'))
	{
		var url='<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pnode','a' => 'setState','proj_id' => "{@proj_id}",'pnod_id' => "{@pnod_id}",'state' => "{@state}"), $this);?>
';
		url=url.replace(/{@proj_id}/,proj_id);
		url=url.replace(/{@pnod_id}/,pnod_id);
		url=url.replace(/{@state}/,state);
		url=url.replace(/{@action}/,action);
		$.get(url,function(msg){
						   if(msg.rs==200)
								location.reload();
							else
								alert(msg.des);
						   },"json")
	}
}

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
			location.reload();
		}
		else
		{
			alert(msg.des);
		}
	},"json")
}



function checkExt(e)
{
	var url=e.value;
	var tem=url.split('.');
	var ext=tem[tem.length-1].toLowerCase();
	if(ext=="exe"||ext=="php"||ext=="psd")
	{
		e.value="";
		alert("暂时不允许上传exe、php、psd文件。");
		return;
	}
	var fileName=tem[0].substring(tem[0].lastIndexOf("\\")+1);
	e.parentNode.parentNode.getElementsByTagName("input")[1].value=fileName;
}

var switchController=function(obj1,obj2){$(obj1).toggle();$(obj2).toggle();}


$(function()
{
	var _tem0='<a title="{@user}-{@title}【{@stateName}】{@beforeNodes}" onclick="PMS.showNode({@nodeId},{project:0})" style="width:{@widthFinal}px;margin-left:{@left}px;" class="pnod node"><span style="width:{@widthEnd}px;" class="title-short rowcolor{@state}"><span class="inner">{@user}-{@title}【{@stateName}】{@beforeNodes}</span></span></a>';
	
	PMS.loadCalendar("project_gra",{projId:'<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
',type:'nodeInProject',ps:1,select:1000,"group":[['','',_tem0]]});
	
	$("#toolPageCheck").click(function(){window.open("?c=tool#<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
","",'height=400,width=700,toolbar=no,menubar=no,scrollbars=no,resizable=no,location=no, status=no')});
	
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
	
	$('#event_list li:last').css('color','#2b7300');
											
	var upload_isclick = 'false';
	$('.btn_show_upload_box').click(function(){
		_$.popWin("file_add",{fix:false});
		//if($(this).attr('isclick')!='true'){PMS.rowEditorCreate("table_file","#table_file tr",{"form":"file_form","check":true});$(this).attr('isclick','true')}
		if(upload_isclick!='true'){PMS.rowEditorCreate("table_file","#table_file tr",{"form":"file_form","check":true});upload_isclick='true';}
		$('#file_form #pnod_id').val($(this).attr('data_id'));
	});
		
	$('.btn_cancel').click(function(){$('#cancel_project_box').show();$(this).hide();})
	
	$('#btn_recover_project').click(function(){$('#recover_project_box').fadeIn();})
	$("#recover_day").datepicker();
	
	//meta信息提取
	$('#btn_getMeta').click(function(){
		var metaConetnt=$('#metaConetnt');
		metaConetnt.show().html('loadding...^-^');
		var metaTemplate=new Array();
		var userNickName=new Array();
		var result="";
		metaTemplate[0]=_$.htmlEnCode('<meta name="author" content="网易，NetEase Inc." />')+"<br/>"+_$.htmlEnCode('<meta name="copyright" content="网易，NetEase Inc." />')+'<br/>';
		metaTemplate[1]=_$.htmlEnCode('<meta name="editor" content="{@userNickName}" />');
		metaTemplate[2]=_$.htmlEnCode('<meta name="designer" content="{@userNickName}" />');
		metaTemplate[3]=_$.htmlEnCode('<meta name="front-end technicist" content="{@userNickName}" />');
		metaTemplate[6]=_$.htmlEnCode('<meta name="animator" content="{@userNickName}" />');
		metaTemplate[10]=_$.htmlEnCode('<meta name="pmid" content="27<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
" />');
		result=metaTemplate[10]+"</br>";
		$.getScript('index.php?c=project_bll&a=getMeta&proj_id=<?php echo $this->_tpl_vars['rs']['proj_id']; ?>
',function(data){
			for(var i=0;i<metadata.length;i++)
			{
				if(metadata[i].user_nickname==undefined||metadata[i].user_nickname=="") metadata[i].user_nickname="没有昵称";
				userNickName[metadata[i].role_id]==undefined? userNickName[metadata[i].role_id]=metadata[i].user_nickname : userNickName[metadata[i].role_id]+=","+metadata[i].user_nickname;
			}
			for(var i=1;i<7;i++)
			{
				//alert(userNickName[i]);
				if(userNickName[i]!=undefined) result+=metaTemplate[i].replace(/{@userNickName}/,userNickName[i])+"</br>";
			}
			result=metaTemplate[0]+result+'<input type="button" class="btn_close" title="关闭">'; 
			metaConetnt.html(result);
			$("#metaConetnt .btn_close").click(function(){metaConetnt.hide()})
			})});
})
</script>
</body>
</html>