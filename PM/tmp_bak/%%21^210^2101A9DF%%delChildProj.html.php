<?php /* Smarty version 2.6.26, created on 2013-07-01 18:45:29
         compiled from project/delChildProj.html */ ?>
<h2>
	解除父子项目关系
</h2>
<hr>
<dl class="nodeInfo clearfix show_skill_dl">

	<dt>选择要解除关系的子项目:</dt>
	<dd class="node_time">
		<ul class="skill_user">
			<?php if ($this->_tpl_vars['child_proj'] != null || vritual_proj != null): ?>
				<?php $_from = $this->_tpl_vars['child_proj']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cp1']):
?>
					<li>
						<span>
							<input class="checkbox_select" type="checkbox" value="0_<?php echo $this->_tpl_vars['cp1']['proj_id']; ?>
"/>
							<?php echo $this->_tpl_vars['cp1']['proj_name']; ?>

						</span>
					</li>
				<?php endforeach; endif; unset($_from); ?> 
				<?php $_from = $this->_tpl_vars['vritual_proj']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['vp1']):
?>
					<li>
						<span class="child_state_-1">
							<input class="checkbox_select" type="checkbox" value="1_<?php echo $this->_tpl_vars['vp1']['proj_vritual_child_id']; ?>
"/>
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
    </dd>
    <hr>

</dl>
<p style="text-align: center;">
        <a href="javascript:;" class="edit-sure" id="select_sure">确定</a>
</p>
<div class="btn_list">
	<a class="btn_close" onclick="_$.closewin('#del_child_proj_popwin')" title="关闭"></a>
</div>
<script>



$('#select_sure').click(function(){
	var bb = $('.checkbox_select:checked');
	var bb_length = bb.length;
	var select_data = new Array();
	for(var i=0;i<bb_length;i++)
	{
		select_data[i] = $(bb[i]).val();
	}
	debugger;
	if(confirm('确定解除这些子项目的关系（只是解除关系，并不删除）？\n一旦解除关系，将不能恢复！'))
	{
		$.ajax({
            url:'index.php?c=project&a=del_child_proj_do'+ '&proj_id=<?php echo $this->_tpl_vars['proj_id']; ?>
',
            type:'POST',
            data:{select_data:select_data},
            success:function (data) {
            	debugger;
            	var result = JSON.parse(data);
                if(result['return_msg']==true)
               	{
               		alert("解除成功");
               		location.reload();
               	}else
                	alert(result['msg']);

            },
            error:function () {
                alert('出错了！')
            }
        })
	}
})

</script>