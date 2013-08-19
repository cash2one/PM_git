<?php /* Smarty version 2.6.26, created on 2013-06-08 10:56:07
         compiled from pg/admin/leaveUp.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'pg/admin/leaveUp.html', 74, false),)), $this); ?>
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
</head>
<body class="pgAdmin jobupperson">
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
            <h1>升职</h1>
        </section>

        <p class="user-skill-select">
            选择已有的帐号：<select class="userlist">

            <?php $_from = $this->_tpl_vars['userList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
            <option value="<?php echo $this->_tpl_vars['rs']['user_id']; ?>
"><?php echo $this->_tpl_vars['rs']['user_name']; ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
        </select>
            <span class="loading">Loading……</span>
        </p>
        <div id="first_hide">
            <h1>共性任务</h1>
            <table class="table3" id="table3">
                <thead>
                <tr class="btop">
                    <td class="bleft">序号</td>
                    <td class="tleft">任务</td>
                    <td class="bright">数量</td>
                </tr>
                </thead>
                <tr class="hide_tr">
                    <td class="bleft"></td>
                    <td class="tleft"></td>
                    <td class="bright"></td>
                </tr>
                <tfoot>
                <tr>
                    <td colspan="6">
                        <div class="pager">
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
            <h1>个性任务</h1>
            <table class="table3" id="table4">
                <thead>
                <tr class="btop">
                    <td class="bleft">序号</td>
                    <td class="bright">任务名</td>
                </tr>
                </thead>
                <tr class="hide_tr">
                    <td class="bleft"></td>
                    <td class="bright"></td>
                </tr>
                <tfoot>
                <tr>
                    <td colspan="6">
                        <div class="pager">

                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
            <p style="text-align: center;margin-top: -35px;">
            <a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project','a' => 'project_add','specialtask' => 1), $this);?>
" class="edit-sure" id="add-title">添加任务</a>
            </p>
        </div>
    </article>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>
<script>
    getData($('.userlist').val());
    $('.userlist').select2({
        width:'150px'
    });
    $('.hide_tr').hide();
    function getData(user_id) {
        $(".loading").css("visibility", "visible");
        $.ajax({
            url:'index.php?c=pgadmin&a=jobLeaveUpSearch_ajax&user_id=' + user_id,
            type:'GET',
            success:function (data) {
                debugger;
                $(".loading").css("visibility", "hidden");
                var result = JSON.parse(data);
                $("#table3 tr:gt(1):not(:last)").remove();
                $("#table4 tr:gt(1):not(:last)").remove();
                var special = result["special"];
                for (var key in special) {
                    var serial = key / 1 + 1;
                    var content =
                            "<tr>" +
                                    "<td class=\"bleft\">" + serial + "</td>" +
                                    "<td class=\"tleft\">" + special[key].mtpl.mtpl_name + "</td>" +
                                    "<td class=\"bright\">" + special[key].num + "</td>" +
                                    "</tr>";
                    $(content).insertAfter($("#table3 tr:eq(" + serial + ")"));
                }
                var same = result["same"];
                for (var key in same) {
                    var serial = key / 1 + 1;
                    var content =
                            "<tr>" +
                                    "<td class=\"bleft\">" + serial + "</td>" +
                                    "<td class=\"bright\">" + 
                                    "<a href=\"<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project_bll','a' => 'project_show'), $this);?>
"+
                                    "&id="+same[key].proj_id+"\">"+
                                    same[key].proj_name +
                              		"</a>"+
                                    "</td>" +
                                    "</tr>";
                    $(content).insertAfter($("#table4 tr:eq(" + serial + ")"));
                }

            },
            error:function () {
                alert('出错了！')
            }
        })
    }
    $('.userlist').change(function () {
        getData($(this).val());
    });

</script>
</html>