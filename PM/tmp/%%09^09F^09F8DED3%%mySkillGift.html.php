<?php /* Smarty version 2.6.26, created on 2013-08-14 10:38:24
         compiled from pg/user/mySkillGift.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'pg/user/mySkillGift.html', 19, false),)), $this); ?>
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
            <li><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project_bll','a' => 'myWork'), $this);?>
">正在进行的工作</a></li>
            <li><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguser','a' => 'myGrowRecord'), $this);?>
">成长记录</a></li>
            <li class="active"><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguser','a' => 'mySkillGift'), $this);?>
">人物技能</a></li>
            <li><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguser','a' => 'myMedal'), $this);?>
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
        你的职业是：<?php echo $this->_tpl_vars['job_name']; ?>
。该职业天赋技能如下。
        <a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguser','a' => 'mySkillBase'), $this);?>
" class="myInfo-btn">技能树</a>
        <a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguser','a' => 'mySkillGift'), $this);?>
" class="myInfo-btn current">在修技能</a>
    </p>
    <table class="table3">
        <thead>
        <tr class="btop">
            <td class="bleft">序号</td>
            <td class="tleft">技能名</td>
            <td class="tleft">性质</td>
            <td class="tleft">技能描述及掉落说明</td>
            <td class="tleft">技能经验</td>
            <td class="bright">下一等级</td>         
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
            <td class="tleft">
            	<a onclick="javascript:selectedNode(<?php echo $this->_tpl_vars['rs']['skill_id']; ?>
);";>
            		<?php echo $this->_tpl_vars['rs']['skill_name']; ?>

            	</a>
			</td>
            <td class="tleft"><?php echo $this->_tpl_vars['rs']['skill_intro']; ?>
</td>
            <td class="tleft"><?php echo $this->_tpl_vars['rs']['skill_title']; ?>
</td>
            <?php if ($this->_tpl_vars['rs']['skill_lv'] != 5): ?>
            <td class="tleft">
            
            	<div class="probar_com probar" id="probar">
                    <div class="probar_com probar_had" id="probar_had" style=" width:<?php echo $this->_tpl_vars['rs']['skill_exp']*2; ?>
px;">

                    </div>
                    <font><?php echo $this->_tpl_vars['rs']['skill_exp']; ?>
/100</font>
                </div>
                
            
            </td>
            <td class="bright"><?php echo $this->_tpl_vars['rs']['skill_lv']; ?>
</td>
            <?php else: ?>
            <td class="tleft"></td>
            <td class="bright">已经满级</td>
            <?php endif; ?>
        </tr>
        <?php endforeach; endif; unset($_from); ?>
        <tfoot>
        <tr>
            <td colspan="7">
                <?php if ($this->_tpl_vars['pager']): ?>
                <div class="pager">
                    页码：<?php echo $this->_tpl_vars['pager']['current_page']; ?>
/<?php echo $this->_tpl_vars['pager']['total_page']; ?>

                    <?php $_from = $this->_tpl_vars['pager']['all_pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['thepage']):
?>
                    <?php if ($this->_tpl_vars['thepage'] != $this->_tpl_vars['pager']['current_page']): ?>
                    <a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguser','a' => 'mySkillGift','topage' => $this->_tpl_vars['thepage']), $this);?>
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
<div id="myskill_popwin" class="popwin">
    <div class="popwin_inner clearfix">

    </div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script>
    $("#myskill_popwin").hide();
    function selectedNode(id)
    {
        var url= "<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguser','a' => 'mySkillNode'), $this);?>
" + "&id="+id;
        $('#myskill_popwin div').load(url,function(){_$.popWin("myskill_popwin");});
    }
</script>
</body>
</html>