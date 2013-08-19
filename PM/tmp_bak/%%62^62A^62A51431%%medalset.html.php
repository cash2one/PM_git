<?php /* Smarty version 2.6.26, created on 2013-05-03 10:50:55
         compiled from pg/useradmin/medalset.html */ ?>
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
    <style>
        .select2-container{position: static;}/*hack select2 hidden */
    </style>
</head>
<body class="pgAdmin  userDeafult medalSet">
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
            <h1>角色配置-成就发放</h1>

        </section>

        <p class="user-skill-select">选择帐号：<select class="userlist">

            <?php $_from = $this->_tpl_vars['userList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
            <option value="<?php echo $this->_tpl_vars['rs']['user_id']; ?>
"><?php echo $this->_tpl_vars['rs']['user_name']; ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
        </select>
            <span class="loading">正在与服务器进行同步……</span>

        </p>
        <div class="job-skill-setting user-skill-setting">

        </div>
    </article>
</div>
<div class="tc-bg">
</div>
<div class="tc-container">
    <h2>添加勋章<a class="close">关闭</a></h2>

    <p style="margin-left: 50px;position: relative;height: 50px;"><img height="50" width="50" class="pre-img"
                                                                       src="<?php echo $this->_tpl_vars['medalList'][0]['medal_img']; ?>
"
                                                                       style="position: absolute;"><span
            class="pre-desc"
            style="line-height: 25px;position: absolute;left: 60px;"><?php echo $this->_tpl_vars['medalList'][0]['medal_desc']; ?>
</span></p>

    <p style="margin-left: 50px;">
        选择勋章：<select class="medal-list-sel">
        <?php $_from = $this->_tpl_vars['medalList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
        <option value="<?php echo $this->_tpl_vars['rs']['medal_id']; ?>
" data-img="<?php echo $this->_tpl_vars['rs']['medal_img']; ?>
" data-desc="<?php echo $this->_tpl_vars['rs']['medal_desc']; ?>
">
            <?php echo $this->_tpl_vars['rs']['medal_name']; ?>

        </option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    </p>
    <p style="text-align: center;">
        <a href="javascript:;" class="edit-sure" id="medal-add-btn">确定</a>
    </p>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/template" id="templateIsInit">
    {{#isInit}}
    <div class="info">
        <h3>该帐号信息已获得成就勋章如下：</h3>

        <div class="medal-list">
            {{#medalList}}
            <div class="medal-item">
                <h4> {{medalname.medal_name}}</h4>
                <img src="{{medalname.medal_img}}" width="50" height="50">
                <span class="medal-desc">勋章描述：{{medalname.medal_desc}}</span>
                <span class="medal-">获得条件：暂缺</span>
                <span class="get-time">获得时间：{{get_time}}</span>
            </div>
            {{/medalList}}
            <div class="space" style="height:30px;"></div>
        </div>
    </div>
    {{/isInit}}
    <p class="skill-bottom"><a href="javascript:;" class="edit-sure" id="add-medal">添加勋章</a></p>
</script>
<script type="text/template" id="templateIsNotInit">

    <div class="info">
        <h3 style="border:none; ">该帐号未进行初始化，请点击<a href="javascript:;" class="jumpHref">进行初始化</a>。</h3>
    </div>


</script>
<script>
    var G7DataSpace = {};
    //定义一个“全局”对象
    //返回的数据结果存放
    G7DataSpace.ajaxResult = '';
    //pgid的存放
    G7DataSpace.pgUserId = '';
    //待更新数据集
    G7DataSpace.addSkillArray = [];
    //模板渲染
    G7DataSpace.templateIsInit = $("#templateIsInit").html();
    G7DataSpace.templateIsNotInit=$("#templateIsNotInit").html();


    function defaultPage() {
        getData($(".userlist").val());
    }
    function getData(Id, callbackFn) {
        $(".loading").css("visibility", "visible");
        $.ajax({
            url:'index.php?c=pguseradmin&a=medalList_ajax',
            type:'POST',
            data:'user_id=' + Id,
            success:function (data) {
                $(".loading").css("visibility", "hidden");
                $(".btn").show();
                var result = JSON.parse(data);
                G7DataSpace.ajaxResult = result;
                console.log(result);
                if (result.isInit) {
                    var output = Mustache.render(G7DataSpace.templateIsInit, result);
                    $(".job-skill-setting").html(output);
                } else {
                    var output = Mustache.render(G7DataSpace.templateIsNotInit, result);
                    $(".job-skill-setting").html(output);
                }
                if (typeof callbackFn == 'function') {
                    callbackFn();
                }
            },
            error:function () {
                alert('鼠标别点那么快！人家还在loading！')
            }
        })
    }
    $(function () {
        defaultPage();
        $('select').select2({
            width:'200px'
        });
        $(".userlist").change(function () {
            $(".loading").css("visibility", "visible");
            $(".btn").hide();
            getData($(this).val());
        })
        $(".close").click(function () {
            $('.tc-bg').hide();
            $('.tc-container').hide();
        })
        $("#medal-add-btn").click(function () {
            var medal_id = $('select.medal-list-sel').val();
            var user_id = $('select.userlist').val();
            var cf = confirm('确定添加？一旦添加则没法删除！')
            if (cf) {
                $.ajax({
                    url:'index.php?c=pguseradmin&a=medalAdd_ajax&user_id=' + user_id + "&medal_id=" + medal_id,
                    type:'GET',
                    success:function (data) {
                        alert("更新成功");
                        $(".close").click();
                        $(".btn").show();
                        var result = JSON.parse(data);
                        G7DataSpace.ajaxResult = result;
                        if (result.isInit) {
                            var output = Mustache.render(G7DataSpace.templateIsInit, result);
                            $(".job-skill-setting").html(output);
                        }
                    },
                    error:function () {
                        alert('出错了！')
                    }
                })
            }
        })


        $("#add-medal").live('click', function () {
            $(".tc-bg").css({"height":$(document).height()}).show();
            $(".tc-container").css({top:$(window).scrollTop() + 300}).show();
        })

        $('.tb-del-btn').live('click', function () {
            var skill_id = $(this).attr("data-id");
            for (var i = 0; i < G7DataSpace.addSkillArray.length; i++) {

                if (G7DataSpace.addSkillArray[i].skill_id == skill_id) {
                    G7DataSpace.addSkillArray.splice(i, 1);
                }
            }
            console.log(G7DataSpace.addSkillArray);
            $(this).parent().parent().detach();
        })


        $('select.medal-list-sel').live('change', function () {
            var img = $("select.medal-list-sel").find("option:selected").attr("data-img");
            var desc = $("select.medal-list-sel").find("option:selected").attr("data-desc")
            $('.pre-img').attr('src', img);
            $('.pre-desc').html(desc);
        })

        $(".jumpHref").live('click',function(){
            var value=$('select.userlist').val();
            location.href="?c=pguseradmin&a=userlist&initUid="+value;
        })

    })
</script>

</body>
</html>