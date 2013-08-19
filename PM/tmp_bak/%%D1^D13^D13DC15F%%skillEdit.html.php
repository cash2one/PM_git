<?php /* Smarty version 2.6.26, created on 2013-04-16 09:53:54
         compiled from pg/admin/skillEdit.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'pg/admin/skillEdit.html', 17, false),)), $this); ?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/base.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</head>
<body class="pgAdmin pgAdminSkillEdit skill">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="wrap">
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pg/admin/pgadminNav.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <article class="content">

        <section class="search">
            <h1>添加 - 技能</h1>

            <div class="tab searchTab1">
                <a id="searchTab1" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'skilllist'), $this);?>
">表</a>
                <?php if (@PM_power == 0): ?>
                <span class="dot">&nbsp;</span>
                <a id="searchTab2" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'skillAdd'), $this);?>
" title="添加技能">加</a>
                <?php endif; ?>
            </div>
        </section>

        <form action="<?php if ($this->_tpl_vars['skilllist']): ?><?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'skillEditDo','skill_id' => $this->_tpl_vars['skilllist']['skill_id']), $this);?>
<?php else: ?><?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'skillAddDo'), $this);?>
<?php endif; ?>"
              method="post" onSubmit="return Validator.Validate(this,2)">
            <section class="header clearfix"></section>
            <section class="boxstyle1 top clearfix">
                <dl class="skill-edit">
                    <dt>技能名</dt>
                    <dd>
                        <input name="skill_name" type="text" id="skill_name" value="<?php echo $this->_tpl_vars['skilllist']['skill_name']; ?>
"
                               maxlength="20"
                               datatype="Require" msg="技能不能为空" class="itext stitle"/>
                    </dd>
                    <dt class="label">lv1要求说明</dt>
                    <dd>
                        <textarea name="lv1_desc" type="text" id="lv1_desc"  maxlength="255"
                                  datatype="Require" ><?php echo $this->_tpl_vars['skilldesc']['lv1desc']; ?>
</textarea>
                    </dd>
                    <dt class="label">lv2要求说明</dt>
                    <dd>
                        <textarea name="lv2_desc" type="text" id="lv2_desc"  maxlength="255"
                                  datatype="Require" ><?php echo $this->_tpl_vars['skilldesc']['lv2desc']; ?>
</textarea>
                    </dd>
                    <dt class="label">lv3要求说明</dt>
                    <dd>
                        <textarea name="lv3_desc" type="text" id="lv3_desc"  maxlength="255"
                                  datatype="Require" ><?php echo $this->_tpl_vars['skilldesc']['lv3desc']; ?>
</textarea>
                    </dd>
                    <dt class="label">lv4要求说明</dt>
                    <dd>
                        <textarea name="lv4_desc" type="text" id="lv4_desc"  maxlength="255"
                                  datatype="Require" ><?php echo $this->_tpl_vars['skilldesc']['lv4desc']; ?>
</textarea>
                    </dd>


                </dl>
                <!--
                <table class="table_node">
                    <tr>
                        <td class="label">技能名</td>
                        <td><span class="li2">
	      <input name="skill_name" type="text" id="skill_name" value="<?php echo $this->_tpl_vars['skilllist']['skill_name']; ?>
" maxlength="20"
                 datatype="Require" msg="职业名不能为空" class="itext stitle"/>
	    </span></td>
                    </tr>
                    <tr>
                        <td class="label">lv1要求说明</td>
                        <td><span class="li2">
	      <textarea name="lv1_desc" type="text" id="lv1_desc" value="<?php echo $this->_tpl_vars['joblist']['job_desc']; ?>
" maxlength="100"
                    datatype="Require" msg="职业描述不能为空" class="itext title"></textarea>
	    </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">lv2要求说明</td>
                        <td><span class="li2">
	      <input name="lv2_desc" type="text" id="lv2_desc" value="<?php echo $this->_tpl_vars['joblist']['job_desc']; ?>
" maxlength="100"
                 datatype="Require" msg="职业描述不能为空" class="itext title"/>
	    </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">lv3要求说明</td>
                        <td><span class="li2">
	      <input name="lv3_desc" type="text" id="lv3_desc" value="<?php echo $this->_tpl_vars['joblist']['job_desc']; ?>
" maxlength="100"
                 datatype="Require" msg="职业描述不能为空" class="itext title"/>
	    </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">lv4要求说明</td>
                        <td><span class="li2">
	      <input name="lv4_desc" type="text" id="lv4_desc" value="<?php echo $this->_tpl_vars['joblist']['job_desc']; ?>
" maxlength="100"
                 datatype="Require" msg="职业描述不能为空" class="itext title"/>
	    </span>
                        </td>
                    </tr>
                </table>
                 -->
            </section>
            <section class="boxstyle2 bottom">
                <input name="" type="submit" value="提交" class="btn btn_main1"/> <a
                    href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'skilllist'), $this);?>
"
                    class="btn btn_main2">返回列表</a>
            </section>
            <section class="footer"></section>
        </form>
    </article>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript">
    /*
     PMS.showSelectList("users","user_id","user_name");

     $('#btn_select').click(function(){$('#user_name').val('');$('#user_id').val('0');});

     PMS.selected=function(type,user_id,user_name)
     {
     var obj_uid=$('#'+$('#inputid_'+type+'_id').val());
     var obj_una=$('#'+$('#inputid_'+type+'_name').val());
     if(obj_uid.val()==0)
     {
     obj_uid.val(user_id);
     obj_una.val(user_name);
     }
     else
     {
     obj_uid.val(obj_uid.val()+'|'+user_id);
     obj_una.val(obj_una.val()+'|'+user_name);
     }
     }
     */
</script>
</body>
</html>