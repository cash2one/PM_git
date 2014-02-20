<?php /* Smarty version 2.6.26, created on 2014-01-26 17:27:50
         compiled from project/node.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'project/node.html', 6, false),array('modifier', 'default', 'project/node.html', 17, false),array('function', 'spUrl', 'project/node.html', 45, false),)), $this); ?>
<p class="title">【<?php echo $this->_tpl_vars['pnod']['proj_name']; ?>
】-【<?php echo $this->_tpl_vars['pnod']['pnod_name']; ?>
】 by <?php echo $this->_tpl_vars['pnod']['user_name']; ?>
</p>
<dl class="nodeInfo clearfix">

	<dt></dt>
	<dd class="node_time">
    	<strong>起止时间：</strong><?php echo ((is_array($_tmp=$this->_tpl_vars['pnod']['pnod_time_s'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
 >> <?php echo ((is_array($_tmp=$this->_tpl_vars['pnod']['pnod_time_e'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
 <br/>
        <?php if ($this->_tpl_vars['pnod']['pnod_time_r']): ?>
        <strong>实际完成：</strong>　　　　　　　<?php echo ((is_array($_tmp=$this->_tpl_vars['pnod']['pnod_time_r'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>

        <?php endif; ?>
    </dd>
    
	<dt style="padding-bottom:0">相关附件</dt>
	<dd>
			<ul class="adjunct-list clearfix">
			<?php $_from = $this->_tpl_vars['files']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs2']):
?>
				<li id="file_row_<?php echo $this->_tpl_vars['rs2']['file_id']; ?>
">
					<a href="<?php echo $this->_tpl_vars['rs2']['file_url']; ?>
" target="_blank" class="file <?php echo ((is_array($_tmp=@$this->_tpl_vars['rs2']['ext'])) ? $this->_run_mod_handler('default', true, $_tmp, 'floder') : smarty_modifier_default($_tmp, 'floder')); ?>
"><img src="<?php echo $this->_tpl_vars['rs2']['file_url']; ?>
" width="128" height="128"/></a>
					<div class="fileInfo">
						<p><?php echo $this->_tpl_vars['rs2']['file_name']; ?>
</p>
					</div>
				</li>
			<?php endforeach; endif; unset($_from); ?>
			</ul>
	</dd>

    <dt style="line-height:25px;padding-bottom:0">流程描述</dt>
    <dd style="max-height:200px;overflow:auto;" >
        <p><?php echo $this->_tpl_vars['pnod']['pnod_desc']; ?>
</p>
    </dd>
 	
	<dt style="line-height:25px;padding-bottom:0">相关事件</dt>
	<dd style="max-height:200px;overflow:auto;" id="popwin-event-box">
        <?php $_from = $this->_tpl_vars['events']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs2']):
?>
		<ul class="event_list clearfix eventType<?php echo $this->_tpl_vars['rs2']['even_type']; ?>
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
        <?php endforeach; endif; unset($_from); ?>
	</dd>
	
	<dt style="line-height:25px;padding-bottom:0">反馈/建议</dt>
	<dd style="max-height:200px;overflow:auto;" id="popwin-event-box">
	<form name="event_form" id="event_form" method="post" action="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'event','a' => 'add'), $this);?>
" onSubmit="return Validator.Validate(event_form,2)" >
		<input type="hidden" name="pnod_id" id="pnod_id" value="<?php echo $this->_tpl_vars['pnod_id']; ?>
">
        <textarea name="even_content" id="even_content" cols="70" rows="5" datatype="Require" msg="内容不能为空"></textarea>
		<input type="hidden" name="proj_id" value="<?php echo $this->_tpl_vars['proj_id']; ?>
"/>
		<input type="submit" value="提 交" class="sumbit"/>
	</form>
	</dd>

</dl>

<div class="btn_list">
<?php if ($this->_tpl_vars['isShowPassBtn'] || $this->_tpl_vars['setScore']): ?>
<div>
                	<dl class="clearfix comment-box">
						<?php if ($this->_tpl_vars['pmDelayReasonArray']): ?>
                    	<dt>延期说明</dt>
						<dd>
                        	<select name="score" datatype="Require" msg="请选择分数。" id="node-delayinfo">
                            	<option value="" selected>请选择延期说明</option>
								<?php $_from = $this->_tpl_vars['pmDelayReasonArray']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                                <option value="<?php echo $this->_tpl_vars['k']; ?>
"><?php echo $this->_tpl_vars['v']; ?>
</option>
								<?php endforeach; endif; unset($_from); ?>
                            </select>
						</dd>
						<?php endif; ?>
                    	<dt>项目评分</dt>
                        <dd>
                        	<select name="score" datatype="Require" msg="请选择分数。" id="node-score">
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
                        	<textarea name="comment" id="node-comment"></textarea>
                        </dd>
						<?php if ($this->_tpl_vars['isShowPassBtn']): ?>
                        <dt></dt>
                        <dd>
                        	<!-- <label><input type="checkbox" id="isPnodeFinishOnCommitTime" value="no"/> 完成日期设为提交审核日期</label> -->
                        </dd>
						<?php endif; ?>
                    </dl>
</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['isShowPassBtn']): ?>
<input type="button" onClick="pass_pnod(<?php echo $this->_tpl_vars['pnod']['pnod_id']; ?>
,18)" value="通过审核" class="btn btn_main2" style=""/>
<input type="button" onClick="pass_pnod(<?php echo $this->_tpl_vars['pnod']['pnod_id']; ?>
,20)" value="退回修改" class="btn btn_main1" style=""/>
<?php endif; ?>

<?php if ($this->_tpl_vars['checkProject']): ?>
<a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project_bll','a' => 'project_show','id' => $this->_tpl_vars['pnod']['proj_id']), $this);?>
" class="btn btn_main1" target="_blank" onclick="_$.closewin('#pnod_details_box')">查看项目</a>
<?php endif; ?>

<?php if ($this->_tpl_vars['setScore']): ?>
<a class="btn btn_main2" target="_blank" onclick="setScoreWithPnodId(<?php echo $this->_tpl_vars['pnod']['pnod_id']; ?>
)">打  分</a>
<?php endif; ?>

<a class="btn_close" onclick="_$.closewin('#pnod_details_box')" title="关闭"></a>
</div>
<script type="text/javascript">
var setScoreWithPnodId=function(id)
{
	var postData={"score":$("#node-score").val(),"comment":$("#node-comment").val(),"pnod_id":"<?php echo $this->_tpl_vars['pnod']['pnod_id']; ?>
"};
	//alert(url);return;
	$.post("<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pnode','a' => 'setScore'), $this);?>
",postData,function(msg)
	{
		if(msg.rs==200)
		{
			alert("打分成功！");
			location.reload();
		}
		else
		{
			alert(msg.des);
		}
	},"json")
}
//$("#popwin-event-box").scrollTop(
</script>