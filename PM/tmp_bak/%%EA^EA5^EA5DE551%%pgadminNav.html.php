<?php /* Smarty version 2.6.26, created on 2013-07-01 18:43:51
         compiled from pg/admin/pgadminNav.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'pg/admin/pgadminNav.html', 6, false),)), $this); ?>
<dl id="pgadminNav">
    <dt >
    <h3>系统配置</h3>
    </dt>
    <dd>
        <a class="job" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'jobList'), $this);?>
">职业类型配置</a>
        <a class="skill" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'skillList'), $this);?>
">技能配置</a>
        <a class="jobskill" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'jobsklllist'), $this);?>
">职业技能配置</a>
        <a class="titles" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'titlelist'), $this);?>
">特殊称谓</a>
        <a class="medals" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'medallist'), $this);?>
">成就勋章</a>
        <a class="jobup" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'toJobUpRequest'), $this);?>
">升职要求</a>
        <!-- <a class="outcome" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'medallist'), $this);?>
">升级要求</a> -->
    </dd>
    <dt>
    <h3>任务配置</h3>
    </dt>
    <dd>
        <a class="mission-outcome" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'outcomelist'), $this);?>
">产出物配置</a>
        <a class="mission" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'missionlist'), $this);?>
">任务模板</a>
        <a class="integrated-tasks " href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'integratedtasks'), $this);?>
">综合任务模板</a>
        <a class="mission-special" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'specialtask'), $this);?>
">特殊任务（转正）</a>
    </dd>
    <dt>
    <h3>角色配置</h3>
    </dt>
    <dd>
        <a class="pguser" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguseradmin','a' => 'userlist'), $this);?>
">初始化&数据修改</a>
        <a class="medalSet" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguseradmin','a' => 'medalset'), $this);?>
">成就发放</a>
        <a class="titleSet" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguseradmin','a' => 'titleset'), $this);?>
">称谓发放</a>
        <a class="jobupperson" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'toJobLeaveUp'), $this);?>
">升职</a>


    </dd>
</dl>