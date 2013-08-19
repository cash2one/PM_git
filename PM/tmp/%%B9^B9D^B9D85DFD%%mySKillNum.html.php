<?php /* Smarty version 2.6.26, created on 2013-07-30 10:27:23
         compiled from pg/user/mySKillNum.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'pg/user/mySKillNum.html', 22, false),)), $this); ?>
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
    <link type="text/css"  rel="stylesheet" href="themes/css/jquery.ui.all.css?cache=<?php echo @RD; ?>
" />
    <script type="text/javascript" src="themes/js/jquery-ui.last.js?cache=<?php echo @RD; ?>
"></script>
    <link>
    <style>
        .select2-container{position: static;}/*hack select2 hidden */
    </style>
</head>
<body class="pgAdmin  myskillNum">
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
            <li><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguser','a' => 'myLvUp'), $this);?>
">升级要求</a></li>
            <li><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguser','a' => 'myStudent'), $this);?>
">学生情况</a></li>
            <li class="active"><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguser','a' => 'mySkillNum'), $this);?>
">技能数量</a></li>
        </ul>
    </div>
</nav>
<div class="wrap">
    <section class="boxstyle1 top clearfix myGrowBox_content" style="padding-top: 20px;">
    	<h2>技能数量使用情况如下：
        </h2>
        <br>
        <table id="table_num" class="table3">
<thead>
<tr class="btop">
    <td class="bleft">序号</td>
    <td class="tleft" colspan="4">技能名称</td>
    <td class="tleft" colspan="3">已用数量/剩余数量</td>
    <td class="bright"></td>
</tr>
  </thead>
  <?php $_from = $this->_tpl_vars['my_skills']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['table1'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['table1']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['asrs']):
        $this->_foreach['table1']['iteration']++;
?>
  	<tr class="skill-name">
        <td class="bleft"><?php echo $this->_foreach['table1']['iteration']; ?>
</td>
        <td class="tleft" colspan="7"><?php echo $this->_tpl_vars['asrs']['skill_name']; ?>
</td>
	    <td class="bright"></td>
    </tr>
    <tr>
        <td class="bleft"></td>
        <td class="tleft">lv1:&nbsp;<?php echo $this->_tpl_vars['asrs']['lv1_u']; ?>
/<?php echo $this->_tpl_vars['asrs']['lv1_g']-$this->_tpl_vars['asrs']['lv1_u']; ?>
</td>
        <td class="tleft"></td>
	    <td class="tleft">lv2:&nbsp;<?php echo $this->_tpl_vars['asrs']['lv2_u']; ?>
/<?php echo $this->_tpl_vars['asrs']['lv2_g']-$this->_tpl_vars['asrs']['lv2_u']; ?>
</td>
	    <td class="tleft"></td>
	    <td class="tleft">lv3:&nbsp;<?php echo $this->_tpl_vars['asrs']['lv3_u']; ?>
/<?php echo $this->_tpl_vars['asrs']['lv3_g']-$this->_tpl_vars['asrs']['lv3_u']; ?>
</td>
	    <td class="tleft"></td>
	    <td class="tleft">lv4:&nbsp;<?php echo $this->_tpl_vars['asrs']['lv4_u']; ?>
/<?php echo $this->_tpl_vars['asrs']['lv4_g']-$this->_tpl_vars['asrs']['lv4_u']; ?>
</td>
	    <td class="bright"></td>
    </tr>
  <?php endforeach; endif; unset($_from); ?>	  
  <tfoot>
	  	<tr>
			<td colspan="9">
			<?php if ($this->_tpl_vars['pager']): ?>
			<div class="pager">
			页码：<?php echo $this->_tpl_vars['pager']['current_page']; ?>
/<?php echo $this->_tpl_vars['pager']['total_page']; ?>

			<?php $_from = $this->_tpl_vars['pager']['all_pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['thepage']):
?>
			    <?php if ($this->_tpl_vars['thepage'] != $this->_tpl_vars['pager']['current_page']): ?>
					<a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'skillList','topage' => $this->_tpl_vars['thepage']), $this);?>
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
    

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>
</html>