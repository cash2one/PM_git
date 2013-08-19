<?php /* Smarty version 2.6.26, created on 2013-05-02 10:28:49
         compiled from public/users_popwin.html */ ?>
    <ul class="pop_tab_nav clearfix" id="user_tab_nav">
		<li>编辑</li>
		<li>设计</li>
        <li>前端</li>
		<li>动画</li>
		<li>移动</li>
        <li style="border-right:1px solid #B7B7B7">管理</li>
    </ul>

    <div class="pop_tab_con clearfix" id="user_tab_content">
        <ul class="name_list clearfix">
		<?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
		<?php if ($this->_tpl_vars['rs']['role_id'] == 1): ?>
			<li><a href="javascript:PMS.selected('<?php echo $this->_tpl_vars['type']; ?>
','<?php echo $this->_tpl_vars['rs']['user_id']; ?>
','<?php echo $this->_tpl_vars['rs']['user_name']; ?>
')"><?php echo $this->_tpl_vars['rs']['user_name']; ?>
</a></li>
		<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		</ul>
		
        <ul class="name_list clearfix">
		<?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
		<?php if ($this->_tpl_vars['rs']['role_id'] == 2): ?>
			<li><a href="javascript:PMS.selected('<?php echo $this->_tpl_vars['type']; ?>
','<?php echo $this->_tpl_vars['rs']['user_id']; ?>
','<?php echo $this->_tpl_vars['rs']['user_name']; ?>
')"><?php echo $this->_tpl_vars['rs']['user_name']; ?>
</a></li>
		<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		</ul>
		
        <ul class="name_list clearfix">
		<?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
		<?php if ($this->_tpl_vars['rs']['role_id'] == 3): ?>
			<li><a href="javascript:PMS.selected('<?php echo $this->_tpl_vars['type']; ?>
','<?php echo $this->_tpl_vars['rs']['user_id']; ?>
','<?php echo $this->_tpl_vars['rs']['user_name']; ?>
')"><?php echo $this->_tpl_vars['rs']['user_name']; ?>
</a></li>
		<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		</ul>
		
        <ul class="name_list clearfix">
		<?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
		<?php if ($this->_tpl_vars['rs']['role_id'] == 6): ?>
			<li><a href="javascript:PMS.selected('<?php echo $this->_tpl_vars['type']; ?>
','<?php echo $this->_tpl_vars['rs']['user_id']; ?>
','<?php echo $this->_tpl_vars['rs']['user_name']; ?>
')"><?php echo $this->_tpl_vars['rs']['user_name']; ?>
</a></li>
		<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		</ul>
		
        <ul class="name_list clearfix">
		<?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
		<?php if ($this->_tpl_vars['rs']['role_id'] == 7): ?>
			<li><a href="javascript:PMS.selected('<?php echo $this->_tpl_vars['type']; ?>
','<?php echo $this->_tpl_vars['rs']['user_id']; ?>
','<?php echo $this->_tpl_vars['rs']['user_name']; ?>
')"><?php echo $this->_tpl_vars['rs']['user_name']; ?>
</a></li>
		<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		</ul>
		
        <ul class="name_list clearfix">
		<?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
		<?php if ($this->_tpl_vars['rs']['role_id'] == 4 || $this->_tpl_vars['rs']['role_id'] == 5): ?>
			<li><a href="javascript:PMS.selected('<?php echo $this->_tpl_vars['type']; ?>
','<?php echo $this->_tpl_vars['rs']['user_id']; ?>
','<?php echo $this->_tpl_vars['rs']['user_name']; ?>
')"><?php echo $this->_tpl_vars['rs']['user_name']; ?>
</a></li>
		<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		</ul>
    </div>
    <input type="hidden" value="" id="inputid_<?php echo $this->_tpl_vars['type']; ?>
_id">
    <input type="hidden" value="" id="inputid_<?php echo $this->_tpl_vars['type']; ?>
_name">
	<!-- <a class="btn_close" onclick="_$.closewin('#<?php echo $this->_tpl_vars['type']; ?>
_popwin')" title="关闭"></a> -->
	
<script type="text/javascript">
/*
$.getScript("cache_data/user_list.js",function(data){
	var html=Array("","","","");
	var temhtml='<li onClick="PMS.selected(\'user\',\'{@user_id}\',\'{@user_name}\')">{@user_name}</li>';
	for(var i=0;i<user_list.length;i++)
	{
		//alert(temhtml.replace(/{@user_id}/g,user_list[i].user_id).replace(/{@user_name}/g,user_list[i].user_name));
		if(user_list[i].role_id==2) html[0]+=temhtml.replace(/{@user_id}/g,user_list[i].user_id).replace(/{@user_name}/g,user_list[i].user_name);
		else if(user_list[i].role_id==3) html[1]+=temhtml.replace(/{@user_id}/g,user_list[i].user_id).replace(/{@user_name}/g,user_list[i].user_name);
		else if(user_list[i].role_id==1) html[2]+=temhtml.replace(/{@user_id}/g,user_list[i].user_id).replace(/{@user_name}/g,user_list[i].user_name);
		else html[3]+=temhtml.replace(/{@user_id}/g,user_list[i].user_id).replace(/{@user_name}/g,user_list[i].user_name);
	}
	
	for(var i=0;i<html.length;i++)
	{
		$("#user_tab_content ul:eq("+i+")").html(html[i]);
	}
	})
	*/
$.getScript("themes/js/tab.js",function(){$.tab("#user_tab_nav li","#user_tab_content ul");})
</script>