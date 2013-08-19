<?php /* Smarty version 2.6.26, created on 2013-05-27 17:09:33
         compiled from pg/user/myMessageNode.html */ ?>
<h2><?php echo $this->_tpl_vars['message']['message_title']; ?>
</h2>
<hr>
<dl class="nodeInfo clearfix">

	<dt></dt>
	<dd class="node_time">
    	<strong>时间：</strong><?php echo $this->_tpl_vars['message']['create_date']; ?>
<br/>
    </dd>
    <hr>
	<dt style="line-height:25px;padding-bottom:0"><strong>内容：</strong></dt>
	<dd style="max-height:200px;width:400px;overflow:auto;" id="popwin-event-box">
    	<?php echo $this->_tpl_vars['message']['message_content']; ?>

    </dd>

</dl>
<div class="btn_list">
	<a class="btn_close" onclick="_$.closewin('#myMessage_popwin')" title="关闭"></a>
</div>