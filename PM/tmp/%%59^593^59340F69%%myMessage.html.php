<?php /* Smarty version 2.6.26, created on 2013-06-06 17:48:30
         compiled from pg/user/myMessage.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'pg/user/myMessage.html', 15, false),)), $this); ?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/base.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <link rel="stylesheet" href="themes/css/popwin.css?cache=<?php echo @RD; ?>
" />
    <link>
    <style>
        .select2-container{position: static;}/*hack select2 hidden */
    </style>
</head>
<script type="text/javascript">
    function selectedNode(id)
    {
        var url= "<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguser','a' => 'messageNode'), $this);?>
" + "&id="+id;
        var unread=parseInt($('.unread-msg').text(),10)-1;
        unread=(unread<=0)?0:unread;
        $('.unread-msg').text(unread);
        $('#myMessage_popwin div').load(url,function(){_$.popWin("myMessage_popwin");});
        $('#read_'+id).text("【已读】");
    }
</script>
<body class="pgAdmin userDeafult">

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
            <li><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project_bll','a' => 'myWork'), $this);?>
">正在进行的工作</a></li>
            <li><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguser','a' => 'myGrowRecord'), $this);?>
">成长记录</a></li>
            <li><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguser','a' => 'mySkillGift'), $this);?>
">技能及战力</a></li>
            <li><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguser','a' => 'myMedal'), $this);?>
">成长勋章</a></li>
            <li class="active">
                <a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguser','a' => 'myMessage'), $this);?>
">系统通知
                    <span class="unread-msg">0</span>
                </a>
            </li>
            <li><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguser','a' => 'myLvUp'), $this);?>
">升级要求</a></li>
            <?php if ($this->_tpl_vars['p_user_id'] == -1): ?>
            	<li><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguser','a' => 'myStudent'), $this);?>
">学生情况</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
<div class="wrap">

    <section class="pguser-inner">
        <table class="table3">
            <thead>
            <tr class="btop">
                <td class="bleft">序号</td>
                <td class="tleft">是否已读</td>
                <td class="tleft">标题</td>
                <td class="tleft">时间</td>
                <td class="bright">操作</td>
            </tr>
            </thead>
            <?php $_from = $this->_tpl_vars['messagelist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['table'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['table']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['rs']):
        $this->_foreach['table']['iteration']++;
?>
            <tr>
                <td class="bleft"><?php echo $this->_foreach['table']['iteration']; ?>
</td>
                <td class="tleft" id="read_<?php echo $this->_tpl_vars['rs']['message_id']; ?>
">
                    <?php if ($this->_tpl_vars['rs']['had_read'] == 0): ?>
                    <font color="red">【未读】</font>
                    <?php else: ?>
                    	【已读】
                    <?php endif; ?>
                </td>
                <td class="tleft"><a onclick="javascript:selectedNode(<?php echo $this->_tpl_vars['rs']['message_id']; ?>
);";><?php echo $this->_tpl_vars['rs']['message_title']; ?>
</a></td>
                <td class="tleft"><?php echo $this->_tpl_vars['rs']['create_date']; ?>
</td>
                <td class="bright">
                	<a href="javascript:;" class="del-btn" data-id="<?php echo $this->_tpl_vars['rs']['message_id']; ?>
">删除</a>
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
                        <a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguser','a' => 'myMessage','topage' => $this->_tpl_vars['thepage']), $this);?>
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
    </section>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="myMessage_popwin" class="popwin">
    <div class="popwin_inner clearfix">

    </div>
</div>
<script>
    $("#myMessage_popwin").hide();
    $(".del-btn").live('click', function () {
    	var result = confirm('确认删除:这条系统通知吗？');
    	var _id = $(this).attr('data-id');
        if (result) {
            $.ajax({
                url:'index.php?c=pguser&a=delMessage_ajax&message_id=' + _id,
                type:'GET',
                success:function (data) {
                    debugger;
                    if (data == "200") {
                        alert("删除成功");
                        location.reload();
                    } else {
                        alert("删除失败");
                    }

                },
                error:function () {
                    alert('出错了！')
                }
            })
        }
    });
    function check_pass(is_pass,task_id)
    {
    	if(!confirm('确认审核？审核后不能修改。'))
  		{
  			return;
  		}
    	$.ajax({
            url:'index.php?c=pguser&a=taskCheckPass_ajax&is_pass=' + is_pass+'&task_id=' + task_id,
            type:'GET',
            success:function (data) {
            	var result = JSON.parse(data);
                var msg =  result['msg'];
                alert(msg);
            },
            error:function () {
                alert('出错了！')
            }
        })
    }
</script>
</body>
</html>