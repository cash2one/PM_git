<?php /* Smarty version 2.6.26, created on 2013-07-30 10:04:28
         compiled from inc/header.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'inc/header.html', 29, false),)), $this); ?>
<header id="PMS_header">
    <nav class="PMS_topbar">
        <div class="PMS_topbar_in">
            <div class="quick_list">
                <p><span>官网测试机入口</span></p>
                <ul>
                    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../tmp/cache/productTestUrl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                </ul>
            </div>
            <div class="quick_list">
                <p><span>网站组常用入口</span></p>
                <ul>
                    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/inc_nieweb.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                </ul>
            </div>

            <div class="quick_list">
                <p><span>公司系统入口</span></p>
                <ul>
                    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/inc_163.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                </ul>
            </div>

            <div class="quick_list">
                <p><span>应用</span></p>
                <ul>
                    <li><a href="index.php?c=toolAtten" target="_blank">考勤备忘</a></li>
                    <li><a href="http://nx.netease.com/tool/workbook/" target="_blank">WebApp收集(测试)</a></li>
                    <li><a href="javascript:window.open('<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'tool'), $this);?>
','','height=400,width=700,toolbar=no,menubar=no,scrollbars=no,resizable=no,location=no, status=no')">页面检查器</a></li>
                    <!-- <li><a href="" target="_blank">PM.Push</a></li> -->
                </ul>
            </div>

            <div class="quick_list">
                <p><span>帮助</span></p>
                <ul>
                    <?php if ($_COOKIE['pm_user_power'] == 0): ?>
                    <li><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'joblist'), $this);?>
" target="_blank" style="color:#F9C;font-weight:bold">> P&G系统配置</a></li>
                    <?php endif; ?>
                    <li><a href="http://192.168.10.127:20127/trac/wiki/pm/pmzn" target="_blank" style="color:#F9C;font-weight:bold">> wiki 帮助</a></li>
                    <li><a href="download/update/update.zip" target="_blank" style="color:#F9C;font-weight:bold">> 客户端下载</a></li>
                    <li><a href="download/help/updatelog.html" target="_blank" style="color:#F9C;font-weight:bold">> 更新日志</a></li>
                </ul>
            </div>
            <div class="userBar">
                <?php echo $_COOKIE['pm_user_name']; ?>
,您好！| <a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'user','a' => 'edit'), $this);?>
">修改个人信息</a> | <a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'user','a' => 'loginOut'), $this);?>
">退出登录</a>
            </div>

        </div>
    </nav>


    <nav id="PMS_mainNav" class="clearfix">
        <a class="mywork" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project_bll','a' => 'myWork'), $this);?>
">我的工作</a>
        <a class="manage" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project','a' => 'show'), $this);?>
">查询管理</a>
        <a class="create" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project','a' => 'project_add'), $this);?>
">创建项目</a>
        <!-- <a class="tools" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project_bll','a' => 'projects'), $this);?>
">百宝箱</a> -->
        <a class="pgsys" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguser','a' => 'myGrowRecord'), $this);?>
">P&G系统入口</a>
    </nav>

    <nav id="PMS_subNav">

        <figure class="mywork">
            <a class="currentWork" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project_bll','a' => 'myWork'), $this);?>
">当前的工作</a>
            <a class="myProjects" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project','a' => 'show'), $this);?>
&oUserId=<?php echo $_COOKIE['pm_user_id']; ?>
">我的项目库</a>
            <a class="myNodes" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pnode','a' => 'show'), $this);?>
&oUserId=<?php echo $_COOKIE['pm_user_id']; ?>
">我的流程库</a>
            <a class="week-report" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'toolWeekReport'), $this);?>
">周报</a>
            <?php if (@TEACHER == -1): ?>
            <a class="myStudentSkill" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project','a' => 'myStudentPorjects'), $this);?>
&teacher_Id=<?php echo $_COOKIE['pm_user_id']; ?>
">学生技能配置</a>
        	<?php endif; ?>
        </figure>

        <figure class="manage">
            <a class="projects" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project','a' => 'show'), $this);?>
">全部项目</a>
            <a class="nodes" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pnode','a' => 'show'), $this);?>
">全部流程</a>
            <a class="tool-files" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'toolFiles'), $this);?>
">设计稿</a>
            <a class="work" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'user','a' => 'work'), $this);?>
">组员工作</a>
            <a class="wraps" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'wrap'), $this);?>
">项目集</a>
            <a class="products" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'product','a' => 'slist'), $this);?>
">产品管理</a>
            <a class="users" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'user','a' => 'showlist'), $this);?>
">通讯录</a>
            <?php if ($_COOKIE['pm_user_power'] == 0): ?>
            <a class="power2" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'user','a' => 'power2'), $this);?>
">权限管理</a>
            <?php endif; ?>
        </figure>

        <figure class="tools">
            <a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'user','a' => 'showlist'), $this);?>
">通讯录</a>
        </figure>
    </nav>

</header>
<?php echo $this->_tpl_vars['topMessage']; ?>