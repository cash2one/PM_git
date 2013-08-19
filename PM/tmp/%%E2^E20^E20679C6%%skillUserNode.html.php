<?php /* Smarty version 2.6.26, created on 2013-07-09 11:39:28
         compiled from project/skillUserNode.html */ ?>
<h2>
<?php if ($this->_tpl_vars['allSkill']): ?> 
	技能值发放-<?php echo $this->_tpl_vars['user_name']; ?>

</h2>
<hr>
<dl class="nodeInfo clearfix show_skill_dl">

	<dt>技能信息:</dt>
	<dd class="node_time">
		<table>
		<tr><td>技能</td><td>所需等级</td><td>评价等级</td></tr>
    	<?php $_from = $this->_tpl_vars['allSkill']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['table'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['table']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['rs1']):
        $this->_foreach['table']['iteration']++;
?>
    	<tr><td>
           	<?php $_from = $this->_tpl_vars['skill']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['irs']):
?>
       			<?php if ($this->_tpl_vars['rs1']['skill_id'] == $this->_tpl_vars['irs']['skill_id']): ?> 
         		   <?php echo $this->_tpl_vars['irs']['skill_name']; ?>

            	<?php endif; ?>
            <?php endforeach; endif; unset($_from); ?>
         </td>
         <td>
         	<?php echo $this->_tpl_vars['rs1']['skill_lv']; ?>

         </td>
         <td>
         	<select id="score_lv<?php echo $this->_foreach['table']['iteration']; ?>
" <?php if ($this->_tpl_vars['allSkill_enable']): ?> disabled="true" <?php endif; ?> >
		    <option value="1"  <?php if ($this->_tpl_vars['rs1']['score_lv'] == 1): ?> selected  <?php endif; ?> >A</option>
		    <option value="2"  <?php if ($this->_tpl_vars['rs1']['score_lv'] == 2 || $this->_tpl_vars['rs1']['score_lv'] == null): ?> selected  <?php endif; ?> >B</option>
		    <option value="3"  <?php if ($this->_tpl_vars['rs1']['score_lv'] == 3): ?> selected  <?php endif; ?> >C</option>
		</select>
         </td>
         </tr>
    	<?php endforeach; endif; unset($_from); ?> 
    	</table>
    </dd>
    <hr>

</dl>
<p style="text-align: center;">
        <?php if (! $this->_tpl_vars['allSkill_enable']): ?><a href="javascript:;" class="edit-sure" id="skill_send_sure">确定评价</a><?php endif; ?>
</p>
<?php else: ?>
	技能配置-<?php echo $this->_tpl_vars['user_name']; ?>

</h2>
<hr>
<dl class="nodeInfo clearfix slelect_skill_dl">

	<dt></dt>
	<dd>
    	<span class="flow-item-one"><label>选择技能1：</label>
             <select id="skill1" class="skill-exp-sel skill1-id">
				 <option value="0">无</option>
                 <?php $_from = $this->_tpl_vars['skill']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['irs']):
?>
                 <option value="<?php echo $this->_tpl_vars['irs']['skill_id']; ?>
"><?php echo $this->_tpl_vars['irs']['skill_name']; ?>
</option>
                 <?php endforeach; endif; unset($_from); ?>
             </select>
             <label class="ml10">所需等级:</label>
             <select id="skill1_lv" class="sk-lv skill1-lv">
                 <option value="1">1</option>
                 <option value="2">2</option>
                 <option value="3">3</option>
                 <option value="4">4</option>
             </select>
         </span>
         <span class="flow-item-one"><label>选择技能2：</label>
             <select id="skill2" class="skill-exp-sel skill2-id">
				 <option value="0">无</option>
                 <?php $_from = $this->_tpl_vars['skill']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['irs']):
?>
                 <option value="<?php echo $this->_tpl_vars['irs']['skill_id']; ?>
"><?php echo $this->_tpl_vars['irs']['skill_name']; ?>
</option>
                 <?php endforeach; endif; unset($_from); ?>
             </select>
             <label class="ml10">所需等级:</label>
             <select id="skill2_lv" class="sk-lv skill2-lv">
                 <option value="1">1</option>
                 <option value="2">2</option>
                 <option value="3">3</option>
                 <option value="4">4</option>
             </select>
         </span>
         <span class="flow-item-one"><label>选择技能3：</label>
             <select id="skill3" class=" skill-exp-sel skill3-id">
				<option value="0">无</option>
                 <?php $_from = $this->_tpl_vars['skill']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['irs']):
?>
                 <option value="<?php echo $this->_tpl_vars['irs']['skill_id']; ?>
"><?php echo $this->_tpl_vars['irs']['skill_name']; ?>
</option>
                 <?php endforeach; endif; unset($_from); ?>
             </select>
             <label class="ml10">所需等级:</label>
             <select id="skill3_lv" class="sk-lv skill3-lv">
                 <option value="1">1</option>
                 <option value="2">2</option>
                 <option value="3">3</option>
                 <option value="4">4</option>
             </select>
         </span>
    </dd>
    <br>
    <hr>
</dl>
	<p style="text-align: center;">
        <a href="javascript:;" class="edit-sure" id="skill_sure">确定配置</a>
    </p>
<?php endif; ?>
<div class="btn_list">
	<a class="btn_close" onclick="_$.closewin('#skill_user_popwin')" title="关闭"></a>
</div>
<script>
<?php if ($this->_tpl_vars['allSkill_enable']): ?> 
debugger;
$('#score_lv').val(<?php echo $this->_tpl_vars['score_lv']; ?>
);
<?php endif; ?>
//渲染select2
$('select').select2({width:'100px'})
$('.select2-choice').click(function(){
	$('.select2-drop').css('z-index',10000);
})
$('#skill_sure').click(function(){
	if(confirm('配置后不可修改，确定配置这些技能？'))
	{
		$.ajax({
            url:'index.php?c=pgadmin&a=skill_sure_ajax'+ '&user_id=<?php echo $this->_tpl_vars['user_id']; ?>
&proj_id=<?php echo $this->_tpl_vars['proj_id']; ?>
',
            type:'POST',
            data:{skill1:$('#skill1').val(),skill1_lv:$('#skill1_lv').val(),
            	  skill2:$('#skill2').val(),skill2_lv:$('#skill2_lv').val(),
            	  skill3:$('#skill3').val(),skill3_lv:$('#skill3_lv').val(),
            		},
            success:function (data) {
            	debugger;
            	var result = JSON.parse(data);
                if(result['return_msg']==true)
               	{
               		alert("配置成功");
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
$('#skill_send_sure').click(function(){
	if(confirm('评价后不可修改，确定评价？'))
	{
		$.ajax({
            url:'index.php?c=pgadmin&a=skill_send_sure_ajax'+ '&user_id=<?php echo $this->_tpl_vars['user_id']; ?>
&proj_id=<?php echo $this->_tpl_vars['proj_id']; ?>
'
            		+'&score_lv1='+$('#score_lv1').val()+'&score_lv2='+$('#score_lv2').val()+'&score_lv3='+$('#score_lv3').val(),
            type:'GET',
            success:function (data) {
            	debugger;
            	var result = JSON.parse(data);
                if(result['return_msg']==true)
               	{
               		alert("评价成功");
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