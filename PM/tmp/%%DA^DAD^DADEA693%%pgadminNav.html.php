<?php /* Smarty version 2.6.26, created on 2013-04-16 08:57:26
         compiled from pg/pgadminNav.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'pg/pgadminNav.html', 6, false),)), $this); ?>
<dl id="pgadminNav">
    <dt >
        <h3>系统配置</h3>
    </dt>
    <dd>
        <a class="job" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'jobList'), $this);?>
">职业</a>
        <a class="skill" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'skillList'), $this);?>
">技能</a>
        <a class="titles" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'titlelist'), $this);?>
">称谓</a>
        <a class="medal" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'slist'), $this);?>
">成就勋章</a>
        <a class="outcome" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'slist'), $this);?>
">产出物配置</a>
        <a class="mission" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'slist'), $this);?>
">任务</a>
    </dd>
    <dt>
        <h3>角色配置</h3>
    </dt>
    <dd>
        <a class="" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'product','a' => 'slist'), $this);?>
">初始化</a>
        <a class="" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'product','a' => 'slist'), $this);?>
">奖励掉落</a>
        <a class="" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'product','a' => 'slist'), $this);?>
" style="border-bottom: none;">数据修改</a>

    </dd>
</dl>