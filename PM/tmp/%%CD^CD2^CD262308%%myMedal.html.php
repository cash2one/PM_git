<?php /* Smarty version 2.6.26, created on 2013-08-14 10:38:20
         compiled from pg/user/myMedal.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'pg/user/myMedal.html', 15, false),)), $this); ?>
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
    function selectedNode(id,title)
    {
        var url= "<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'medalNode'), $this);?>
" + "&id="+id + "&title="+title;
        $('#myMedal_popwin div').load(url,function(){_$.popWin("myMedal_popwin");});
    }
</script>
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
            <li class="active"><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguser','a' => 'myMedal'), $this);?>
">成长勋章</a></li>
            <li>
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
            	<li><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguser','a' => 'mySkillNum'), $this);?>
">技能数量</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
<div class="wrap">

    <p class="mySkill-common">
        共<?php echo $this->_tpl_vars['allMedalNum']; ?>
个勋章，你已获得<?php echo $this->_tpl_vars['myMedalNum']; ?>
个勋章
    </p>
    <table class="table3">
        <thead>
        <tr class="btop">
            <td class="bleft">序号</td>
            <td class="tleft">勋章图</td>
            <td class="tleft">成就</td>
            <td class="tleft">勋章说明</td>
            <td class="bright">掉落说明</td>
        </tr>
        </thead>
        <?php $_from = $this->_tpl_vars['resultArray']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['table'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['table']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['rs']):
        $this->_foreach['table']['iteration']++;
?>
        <tr>
            <td class="bleft"><?php echo $this->_foreach['table']['iteration']; ?>
</td>
            <td class="tleft"><img src="<?php echo $this->_tpl_vars['rs']['medal_img']; ?>
" width="30" height="30" style="float: left;"></td>
            <td class="tleft">
            <a onclick="javascript:selectedNode(<?php echo $this->_tpl_vars['rs']['medal_id']; ?>
,'<?php echo $this->_tpl_vars['rs']['medal_name']; ?>
');"><?php echo $this->_tpl_vars['rs']['medal_name']; ?>
</a>
            </td>
            <td class="tleft">
                <?php echo $this->_tpl_vars['rs']['medal_desc']; ?>
<br>
                <?php if ($this->_tpl_vars['rs']['get_time']): ?>
                【<font color="red">获得时间：<?php echo $this->_tpl_vars['rs']['get_time']; ?>
</font>】
                <?php else: ?>
                【<font color="blue">尚未获得</font>】
                <?php endif; ?>
            </td>
            <td class="bright"><?php echo $this->_tpl_vars['rs']['medal_mission']; ?>
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
                    <a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguser','a' => 'myMedal','topage' => $this->_tpl_vars['thepage']), $this);?>
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
<div id="myMedal_popwin" class="popwin">
    <div class="popwin_inner clearfix">

    </div>
</div>
</body>
</html>