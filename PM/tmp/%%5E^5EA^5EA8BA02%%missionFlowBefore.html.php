<?php /* Smarty version 2.6.26, created on 2013-08-14 10:48:33
         compiled from pg/admin/missionFlowBefore.html */ ?>
<h2>
	前置流程选择-<?php echo $this->_tpl_vars['flow_name']; ?>

</h2>
<hr>
<dl class="nodeInfo clearfix show_skill_dl">

	<dt>前置流程:</dt>
	<dd class="node_time">
		<div>
    	</div>  
    </dd>
    	<span class="beforePnode_add">
    		添加
    	</span>
    <hr>

</dl>
<p style="text-align: center;">
        <a href="javascript:;" class="edit-sure" id="select_sure">确定</a>
</p>
<div class="btn_list">
	<a class="btn_close" onclick="_$.closewin('#pnod_before_popwin')" title="关闭"></a>
</div>
<script>
debugger;
var str = "<div class=\"before_div before_div2\"><select name=\"before_select\" >"+
			<?php $_from = $this->_tpl_vars['flowAll']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs1']):
?>
				"<option value=\"<?php echo $this->_tpl_vars['rs1']['id']; ?>
\"><?php echo $this->_tpl_vars['rs1']['name']; ?>
</option>"+
			<?php endforeach; endif; unset($_from); ?>
		 "</select><input type=\"button\" class=\"btnc btnc_del before_del before_del2\"></div>";

<?php $_from = $this->_tpl_vars['selectNode']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs2']):
?>
	addPnodeBefore(<?php echo $this->_tpl_vars['rs2']; ?>
);
<?php endforeach; endif; unset($_from); ?>

//渲染select2
$('.before_div select').select2({width:'300px'})
$('.select2-choice').click(function(){
	$('.select2-drop').css('z-index',10000);
})
$(".before_del").click(function(){
	$(this).parent().remove();
})
$('#select_sure').click(function(){
	var bb = $('.before_div select');
	var bb_length = bb.length;
	var select_data = new Array();
	for(var i=0;i<bb_length;i++)
	{
		select_data[i] = $(bb[i]).val();
	}
	debugger;
	if(confirm('确定选择这些前置流程？'))
	{
		$.ajax({
            url:'index.php?c=pgadmin&a=flow_before_do'+ '&flow_id=<?php echo $this->_tpl_vars['flow_id']; ?>
'+ '&mtpl_id=<?php echo $this->_tpl_vars['mtpl_id']; ?>
',
            type:'POST',
            data:{select_data:select_data},
            success:function (data) {
            	debugger;
            	var result = JSON.parse(data);
                if(result['return_msg']==true)
               	{
               		alert("选择成功");
               		_$.closewin('#flow_before_popwin');
               	}else
                	alert(result['msg']);

            },
            error:function () {
                alert('出错了！')
            }
        })
	}
})
$(".beforePnode_add").click(function(){
	addPnodeBefore(0);
})
function addPnodeBefore(selectId){
	$(".node_time").append(str);
	$(".node_time div:last select").val(selectId);
	//渲染select2
	$('.before_div select').select2({width:'340px'})
	$('.select2-choice').click(function(){
		$('.select2-drop').css('z-index',10000);
	})
	$(".before_del").click(function(){
		$(this).parent().remove();
	})
	
}

</script>