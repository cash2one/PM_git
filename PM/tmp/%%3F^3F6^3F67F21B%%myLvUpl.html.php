<?php /* Smarty version 2.6.26, created on 2013-08-14 10:38:28
         compiled from pg/user/myLvUpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'pg/user/myLvUpl.html', 21, false),)), $this); ?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/base.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <link>
    <style>
        .select2-container{position: static;}/*hack select2 hidden */
        .table3 .myInfo-btn{float: none;margin-bottom: 8px;}
        .table3 .probar{margin-top: 10px;}
    </style>
</head>
<body class="pgAdmin  userDeafult">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pg/user/myInformation.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<nav class="myNav clearfix">
    <div class="myNav-inner">
        <a class="brand">个人空间导航&nbsp;&#187;</a>
        <ul>
            <li><a href="#">正在进行的工作</a></li>
            <li><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguser','a' => 'myGrowRecord'), $this);?>
">成长记录</a></li>
            <li><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguser','a' => 'mySkillGift'), $this);?>
">人物技能</a></li>
            <li><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguser','a' => 'myMedal'), $this);?>
">成长勋章</a></li>
            <li>
                <a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguser','a' => 'myMessage'), $this);?>
">系统通知
                    <span class="unread-msg">0</span>
                </a>
            </li>
            <li class="active"><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguser','a' => 'myLvUp'), $this);?>
">升级要求</a></li>
            <?php if ($this->_tpl_vars['p_user_id'] == -1): ?>
            	<li><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguser','a' => 'myStudent'), $this);?>
">学生情况</a></li>
            	<li><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguser','a' => 'mySkillNum'), $this);?>
">技能数量</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
<div class="wrap">
<!-- 暂时隐藏
<p class="mySkill-common">
      我的共性任务
    </p>
    <table class="table3">
        <thead>
        <tr class="btop">
            <td class="bleft">序号</td>
            <td class="tleft">任务名</td>
            <td class="tleft">进度</td>
            <td class="bright">状态/操作</td>
        </tr>
        </thead>
  <tr>
    <td class="bleft">1</td>
    <td class="tleft">
    		A级专题数量
    </td>
    <td class="tleft">
		<span class="probar_com probar">
			<span class="probar_com probar_had probar_1">

			</span>
            <font class="blv_1" value="<?php echo $this->_tpl_vars['blv_array']['blv_1']; ?>
"><?php echo $this->_tpl_vars['flv_array']['flv_1']; ?>
/<?php echo $this->_tpl_vars['lv_array']['lv_1']; ?>
</font>
		</span>
	</td>
	<td class="bright">
		<?php if ($this->_tpl_vars['task_state']['lv_1'] == 1): ?>
			<font color="red">审核中</font>
		<?php elseif ($this->_tpl_vars['task_state']['lv_1'] == 2): ?>
			<font color="red">审核不通过</font>|-><input class="finish" lv="1" type="button" value="重新点击完成">
		<?php elseif ($this->_tpl_vars['task_state']['lv_1'] == 3): ?>
			完成
		<?php else: ?>
			<input class="finish myInfo-btn" lv="1" type="button" value="点击完成"/>

		<?php endif; ?>
	</td>
  </tr>
  <tr>
    <td class="bleft">2</td>
    <td class="tleft">
    		B级专题数量
    </td>
    <td class="tleft">
		<span class="probar_com probar">
			<span class="probar_com probar_had probar_2">

			</span>
            <font class="blv_2" value="<?php echo $this->_tpl_vars['blv_array']['blv_2']; ?>
"><?php echo $this->_tpl_vars['flv_array']['flv_2']; ?>
/<?php echo $this->_tpl_vars['lv_array']['lv_2']; ?>
</font>
		</span>
	</td>
	<td class="bright">
		<?php if ($this->_tpl_vars['task_state']['lv_2'] == 1): ?>
			<font color="red">审核中</font>
		<?php elseif ($this->_tpl_vars['task_state']['lv_2'] == 2): ?>
			<font color="red">审核不通过</font>|-><input class="finish" lv="2" type="button" value="重新点击完成">
		<?php elseif ($this->_tpl_vars['task_state']['lv_2'] == 3): ?>
			完成
		<?php else: ?>
			<input class="finish myInfo-btn" lv="2" type="button" value="点击完成">
		<?php endif; ?>
	</td>
  </tr>
  <tr>
    <td class="bleft">3</td>
    <td class="tleft">
    		C级专题数量
    </td>
    <td class="tleft">
		<span class="probar_com probar">
			<span class="probar_com probar_had probar_3">

			</span>
            <font class="blv_3 " value="<?php echo $this->_tpl_vars['blv_array']['blv_3']; ?>
"><?php echo $this->_tpl_vars['flv_array']['flv_3']; ?>
/<?php echo $this->_tpl_vars['lv_array']['lv_3']; ?>
</font>
		</span>
	</td>
	<td class="bright">
		<?php if ($this->_tpl_vars['task_state']['lv_3'] == 1): ?>
			<font color="red">审核中</font>
		<?php elseif ($this->_tpl_vars['task_state']['lv_3'] == 2): ?>
			<font color="red">审核不通过</font>|-><input type="button" class="finish" lv="3" value="重新点击完成">
		<?php elseif ($this->_tpl_vars['task_state']['lv_3'] == 3): ?>
			完成
		<?php else: ?>
			<input class="finish myInfo-btn" lv="3" type="button" value="点击完成">
		<?php endif; ?>
	</td>
  </tr>
  <tr>
    <td class="bleft">4</td>
    <td class="tleft">
    		D级专题数量
    </td>
    <td class="tleft">
		<span class="probar_com probar">
			<span class="probar_com probar_had probar_4">

			</span>
            <font class="blv_4" value="<?php echo $this->_tpl_vars['blv_array']['blv_4']; ?>
"><?php echo $this->_tpl_vars['flv_array']['flv_4']; ?>
/<?php echo $this->_tpl_vars['lv_array']['lv_4']; ?>
</font>
		</span>
	</td>
	<td class="bright">
		<?php if ($this->_tpl_vars['task_state']['lv_4'] == 1): ?>
			<font color="red">审核中</font>
		<?php elseif ($this->_tpl_vars['task_state']['lv_4'] == 2): ?>
			<font color="red">审核不通过</font>|-><input class="finish" lv="4" type="button" value="重新点击完成">
		<?php elseif ($this->_tpl_vars['task_state']['lv_4'] == 3): ?>
			完成
		<?php else: ?>
			<input class="finish myInfo-btn" lv="4" type="button" value="点击完成">
		<?php endif; ?>
	</td>
  </tr>
  <tr>
    <td class="bleft">5</td>
    <td class="tleft">
    		E级专题数量
    </td>
    <td class="tleft">
		<span class="probar_com probar">
			<span class="probar_com probar_had probar_5">

			</span>
            <font class="blv_5" value="<?php echo $this->_tpl_vars['blv_array']['blv_5']; ?>
"><?php echo $this->_tpl_vars['flv_array']['flv_5']; ?>
/<?php echo $this->_tpl_vars['lv_array']['lv_5']; ?>
</font>
		</span>
	</td>
	<td class="bright">
		<?php if ($this->_tpl_vars['task_state']['lv_5'] == 1): ?>
			<font color="red">审核中</font>
		<?php elseif ($this->_tpl_vars['task_state']['lv_5'] == 2): ?>
			<font color="red">审核不通过</font>|-><input class="finish" lv="5" type="button" value="重新点击完成">
		<?php elseif ($this->_tpl_vars['task_state']['lv_5'] == 3): ?>
			完成
		<?php else: ?>
			<input class="finish myInfo-btn" lv="5" type="button" value="点击完成">
		<?php endif; ?>
	</td>
  </tr>
  <tr>
    <td class="bleft">6</td>
    <td class="tleft">
    		无级别专题数量
    </td>
    <td class="tleft">
		<span class="probar_com probar">
			<span class="probar_com probar_had probar_10">

			</span>
            <font class="blv_10" value="<?php echo $this->_tpl_vars['blv_array']['blv_10']; ?>
"><?php echo $this->_tpl_vars['flv_array']['flv_10']; ?>
/<?php echo $this->_tpl_vars['lv_array']['lv_10']; ?>
</font>
		</span>
	</td>
	<td class="bright">
		<?php if ($this->_tpl_vars['task_state']['lv_10'] == 1): ?>
			<font color="red">审核中</font>
		<?php elseif ($this->_tpl_vars['task_state']['lv_10'] == 2): ?>
			<font color="red">审核不通过</font>|-><input class="finish" lv="10" type="button" value="重新点击完成">
		<?php elseif ($this->_tpl_vars['task_state']['lv_10'] == 3): ?>
			完成
		<?php else: ?>
			<input class="finish myInfo-btn" lv="10" type="button" value="点击完成">
		<?php endif; ?>
	</td>
  </tr>
        <tfoot>
        <tr>
        <td colspan="6"></td>
        </tr>
        </tfoot>
 </table>
  -->
 
 <p class="mySkill-common">
     共性任务
    </p>
    <table class="table3">
        <thead>
        <tr class="btop">
            <td class="bleft">序号</td>
            <td class="tleft">任务类型</td>
            <td class="bright">数量</td>
        </tr>
        </thead>
  <?php $_from = $this->_tpl_vars['sameTask']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['table0'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['table0']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['strs']):
        $this->_foreach['table0']['iteration']++;
?>
  <tr>
    <td class="bleft"><?php echo $this->_foreach['table0']['iteration']; ?>
</td>
    <td class="tleft">
    	<?php echo $this->_tpl_vars['strs']['mtpl']['mtpl_name']; ?>

    </td>
    <td class="bright">
		<?php echo $this->_tpl_vars['strs']['num']; ?>

	</td>
  </tr>
  <?php endforeach; endif; unset($_from); ?>
        <tfoot>
        <tr>
            <td colspan="6">
            </td>
        </tr>
        </tfoot>
 </table>
    <p class="mySkill-common">
     我的特殊任务
    </p>
    <table class="table3">
        <thead>
        <tr class="btop">
            <td class="bleft">序号</td>
            <td class="tleft">任务名</td>
            <td class="bright">是否完成</td>
        </tr>
        </thead>
  <?php $_from = $this->_tpl_vars['result']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['table'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['table']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['rs']):
        $this->_foreach['table']['iteration']++;
?>
  <tr>
    <td class="bleft"><?php echo $this->_foreach['table']['iteration']; ?>
</td>
    <td class="tleft">
    	<a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project_bll','a' => 'project_show','id' => $this->_tpl_vars['rs']['proj_id']), $this);?>
">
    		<?php echo $this->_tpl_vars['rs']['proj_name']; ?>

      	</a>
    </td>
    <td class="bright">
		<?php if ($this->_tpl_vars['rs']['proj_endDate']): ?>
                【<font color="red">完成时间：<?php echo $this->_tpl_vars['rs']['proj_endDate']; ?>
</font>】
                <?php else: ?>
                【<font color="blue">尚未完成</font>】
                <?php endif; ?>
	</td>
  </tr>
  <?php endforeach; endif; unset($_from); ?>
        <tfoot>
        <tr>
            <td colspan="6">
                <?php if ($this->_tpl_vars['pager']): ?>
                <div class="pager">
                    页码：<?php echo $this->_tpl_vars['pager']['current_page']; ?>
/<?php echo $this->_tpl_vars['pager']['total_page']; ?>

                    <?php $_from = $this->_tpl_vars['pager']['all_pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['thepage']):
?>
                    <?php if ($this->_tpl_vars['thepage'] != $this->_tpl_vars['pager']['current_page']): ?>
                    <a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguser','a' => 'myLvUp','topage' => $this->_tpl_vars['thepage']), $this);?>
"><?php echo $this->_tpl_vars['thepage']; ?>
</a>
                    <?php else: ?>
                    <span><?php echo $this->_tpl_vars['thepage']; ?>
</span>
                    <?php endif; ?>
                    <?php endforeach; endif; unset($_from); ?>
                </div>
                <?php endif; ?>
            </td>
        </tr>
        </tfoot>

    </table>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>
<script>
for(var i = 1;i<6;i++)
{
    $(".probar_"+i).width($(".blv_"+i).attr("value")*$(".probar").width());
}
$(".probar_10").width($(".blv_10").attr("value")*$(".probar").width());
$('.finish').click(function(){
	if(!confirm('确认完成吗？\n将会发送审核信息给你的导师'))
	{
		return;
	}
	var lv= $(this).attr("lv");
	$.ajax({
        url:'index.php?c=pguser&a=sendFinishMessage&lv='+lv,
        type:'GET',
        success:function(data){
            var result = JSON.parse(data);
            var msg =  result['msg'];
            alert(msg);
            location.reload();
        },
        error:function(){
            alert('出错了！')
        }
    })
});
</script>
</html>