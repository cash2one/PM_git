<?php /* Smarty version 2.6.26, created on 2013-05-27 18:31:11
         compiled from pg/admin/skillNode.html */ ?>
<?php if ($this->_tpl_vars['type'] == 0): ?>
	<h2>技能-<?php echo $this->_tpl_vars['result']['skill_name']; ?>
</h2>
	<hr>
	<dl class="nodeInfo clearfix">
	    <dt><strong>技能定义：</strong></dt>
		<dd class="showSkillNode">
            <textarea><?php echo $this->_tpl_vars['result']['skill_define']; ?>
</textarea>      
	    </dd>
	    <hr>
	    <dt><strong>技能要素：</strong></dt>
	    <dd class="showSkillNode">
            <textarea><?php echo $this->_tpl_vars['result']['skill_element']; ?>
</textarea>      
	    </dd>
	</dl>
<?php else: ?>
    <h2>技能-<?php echo $this->_tpl_vars['result']['skill_name']; ?>
-lv<?php echo $this->_tpl_vars['result']['skill_lv']; ?>
-<?php echo $this->_tpl_vars['result']['skill_title']; ?>
</h2>
	<hr>
	<dl class="nodeInfo clearfix">
	    <dt><strong>技能等级要求说明：</strong></dt>
	    <dd class="showSkillNode">
            <textarea><?php echo $this->_tpl_vars['result']['skill_desc']; ?>
</textarea>      
	    </dd>
	</dl>
<?php endif; ?>
<div class="btn_list">
	<a class="btn_close" onclick="_$.closewin('#myMessage_popwin')" title="关闭"></a>
</div>