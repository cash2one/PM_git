<?php /* Smarty version 2.6.26, created on 2013-05-20 11:39:53
         compiled from pg/admin/leaveUpRequest.html */ ?>
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
<body class="pgAdmin jobup">
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
            <h1>升职要求</h1>

        </section>

        <p class="user-skill-select">职业：<select class="joblist">

            <?php $_from = $this->_tpl_vars['jobList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
            <option value="<?php echo $this->_tpl_vars['rs']['job_id']; ?>
"><?php echo $this->_tpl_vars['rs']['job_name']; ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
        </select>
            级别：<select class="joblvlist">

                <option value="1">初级</option>
                <option value="2">中级</option>
                <option value="3">高级</option>
            </select>
            <span class="loading">Loading……</span>
        </p>
        <br>
        <table class="table3" id="table3">
            <thead>
            <tr class="btop">
                <td class="bleft">序号</td>
                <td class="tleft">任务</td>
                <td class="tleft">数量</td>
                <td class="bright">操作</td>
            </tr>
            </thead>
            <tr id="hide_tr">
                <td class="bleft"></td>
                <td class="tleft"></td>
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
        <p style="text-align: center;margin-top: -35px;"><a href="javascript:;" class="edit-sure"
                                                            id="add-title">添加任务</a></p>
    </article>

</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="tc-bg">
</div>
<div class="tc-container">
    <h2>添加升职要求<a class="close">关闭</a></h2>

    <p style="margin-left: 10px;position: relative;height: 20px;
    "><span
            class="pre-desc"
            style="line-height: 25px;position: absolute;left: 60px;"><?php echo $this->_tpl_vars['titleList'][0]['title_desc']; ?>
</span></p>

    <p style="margin-left: 50px;">
        选择任务：<select class="tasklist" id="tasklist">
        <?php $_from = $this->_tpl_vars['mtpl']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
        <option value="<?php echo $this->_tpl_vars['rs']['mtpl_id']; ?>
">
            <?php echo $this->_tpl_vars['rs']['mtpl_name']; ?>

        </option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
        数量:<input class="num">
    </p>

    <p style="text-align: center;">
        <a href="javascript:;" class="edit-sure" id="title-add-btn">确定</a>
    </p>
</div>
</body>
<script>
    var job_id = $('.joblist').val();
    var job_level = $('.joblvlist').val();
    getData(job_id, job_level);
    function getData(job_id, job_level) {
        $(".loading").css("visibility", "visible");
        $.ajax({
            url:'index.php?c=pgadmin&a=jobUpRequestList_ajax&job_id='
                    + job_id + '&job_level=' + job_level,
            type:'GET',
            success:function (data) {
                $(".loading").css("visibility", "hidden");
                var result = JSON.parse(data);
                $("#table3 tr:gt(1):not(:last)").remove();
                for (var key in result) {
                    var serial = key / 1 + 1;
                    var content =
                            "<tr>" +
                                    "<td class=\"bleft\">" + serial + "</td>" +
                                    "<td class=\"tleft\">" + result[key].mtpl.mtpl_name + "</td>" +
                                    "<td class=\"tleft\">" + result[key].num + "</td>" +
                                    "<td class=\"bright\">" +
                                    "<a href=\"javascript:;\" class=\"del-btn\" data-id=\"" + result[key].task_id + "\" data-name=\"" + result[key].mtpl.mtpl_name + "\" data-num=\"" + result[key].num + "\">删除</a>" +
                                    "</td>" +
                                    "</tr>";
                    $(content).insertAfter($("#table3 tr:eq(" + serial + ")"));
                }

            },
            error:function () {
                $(".loading").css("visibility", "hidden");
                alert('出错了！')
            }
        })
    }

    $(function () {
        $('#hide_tr').hide();
        $('.tasklist').select2({
            width:'150px'
        });
        $('.joblist').select2({
            width:'150px'
        });
        $('.joblvlist').select2({
            width:'100px'
        });
        $(".close").click(function () {
            $('.tc-bg').hide();
            $('.tc-container').hide();
        })
        $(".joblist").change(function () {
            job_id = $(this).val();
            getData(job_id, job_level);
        })
        $(".joblvlist").change(function () {
            job_level = $(this).val();
            getData(job_id, job_level);
        })
        $("#title-add-btn").click(function () {
            var mtpl_id = $("#tasklist").val();
            var num = $(".num").val();
            if (isNaN(num)) {
                alert("数量：'" + num + "'不是数字");
                return;
            }
            $.ajax({
                url:'index.php?c=pgadmin&a=addJobUpRequest_ajax&job_id='
                        + job_id + '&job_level=' + job_level
                        + '&mtpl_id=' + mtpl_id + '&num=' + num,
                type:'GET',
                success:function (data) {
                    getData(job_id, job_level);
                    $('.tc-bg').hide();
                    $('.tc-container').hide();
                    $(".num").val("");
                },
                error:function () {
                    alert('出错了！')
                }
            })
        })
        $("#add-title").live('click', function () {
            $(".tc-bg").css({"height":$(document).height()}).show();
            $(".tc-container").css({top:$(window).scrollTop() + 300}).show();
        })
        $(".del-btn").live('click', function () {
            var task_id = $(this).attr('data-id');
            var mtpl_name = $(this).attr('data-name');
            var task_num = $(this).attr('data-num');
            var result = confirm('确认删除:\n"' + mtpl_name + '"\n数量：' + task_num + '\n这个任务吗？');
            if (result) {
                $.ajax({
                    url:'index.php?c=pgadmin&a=delJobUpRequest_ajax&task_id=' + task_id,
                    type:'GET',
                    success:function (data) {
                        debugger;
                        if (data == "200") {
                            alert("删除成功");
                            getData(job_id, job_level);
                        } else {
                            alert("删除失败");
                        }

                    },
                    error:function () {
                        alert('出错了！')
                    }
                })
            }

        })
    })
</script>
</html>