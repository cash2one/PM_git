<?php /* Smarty version 2.6.26, created on 2013-06-07 15:48:48
         compiled from pg/admin/skilltojob.html */ ?>
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
<body class="pgAdmin skilltojob">
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
            <h1>职业技能配置</h1>

        </section>

        <p class="job-skill-select">选择职业：<select class="joblist">

            <?php $_from = $this->_tpl_vars['joblist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
            <option value="<?php echo $this->_tpl_vars['rs']['job_id']; ?>
"><?php echo $this->_tpl_vars['rs']['job_name']; ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
        </select>
            <span class="loading">Loading……</span>

            <a class="btn edit-btn" href="javascript:;">配置技能</a>
            <a class="btn view-btn" href="javascript:;">查看技能</a>
        </p>
        <div class="job-skill-setting">

        </div>
    </article>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script>
    var G7DataSpace = {};
    //定义一个“全局”对象
    G7DataSpace.ajaxResult = '';
    G7DataSpace.templateSkillTable = '<table class="table3">'
            + '<thead>'
            + '<tr class="btop">'

            + '<td class="bleft">技能名称</td>'
            + '<td class="bright">性质</td>'
            + '</tr>'
            + '</thead>'
            + '{{#data}}'
            + '<tr class="skill-name">'

            + '<td class="bleft">{{skill_name}}</td>'
            + '<td class="bright">{{skill_intro}}</td>'
            + '</tr>'
            + '{{/data}}'
            + '<tfoot><td colspan="2"></td></tfoot>'
            + '</table>';

    G7DataSpace.templateSkillList = '<p class="skill-title">选择技能</p><form class="tform"><ul class="skill-list">'
            + '{{#skill}}'
            + '<li>'
            + '<label class="mother-ck-node"><input type="checkbox" name="skill_name" data-skill-id="{{skill_id}}" class="ck">{{skill_name}}</label> '
            + '<label class="children-rd-node"><input type="radio" name="{{skill_name}}_type" value="1" data-skill-id="{{skill_id}}">必修</label>'
            + '<label class="children-rd-node"><input type="radio" name="{{skill_name}}_type" value="0" data-skill-id="{{skill_id}}">选修</label>'
            + '</li>'
            + '{{/skill}}'
            + '</ul></form> '
            + '<p class="skill-bottom"><a href="javascript:;" class="edit-sure">确定</a></p>';

    function compareSkill() {
        var eleCk = $('.skill-list li .ck');
        for (var i = 0; i < G7DataSpace.ajaxResult.skill.length; i++) {
            //查看该技能是否在已配置技能列表中
            if (G7DataSpace.ajaxResult.skillItem.indexOf(G7DataSpace.ajaxResult.skill[i].skill_id) != '-1') {
                //复选框打钩
                var num = G7DataSpace.ajaxResult.skillItem.indexOf(G7DataSpace.ajaxResult.skill[i].skill_id);
                eleCk.eq(i).attr("checked", "checked");
                var type = G7DataSpace.ajaxResult.data[num].skill_type;
                var name = G7DataSpace.ajaxResult.data[num].skill_name;
                //单选框打钩
                if (type == '1') {
                    $(".skill-list li").find("input[name='" + name + "_type']").eq(0).attr("checked", "checked");
                } else {
                    $(".skill-list li").find("input[name='" + name + "_type']").eq(1).attr("checked", "checked");
                }
            }
        }
    }
    function defaultPage() {
        getData($(".joblist").val());
    }
    function getData(jobId,callbackFn){
        $(".loading").css("visibility", "visible");
        $.ajax({
            url:'index.php?c=pgadmin&a=skilltojob_ajax&job_id=' + jobId,
            type:'GET',
            success:function (data) {
                $(".loading").css("visibility", "hidden");
                $(".btn").show();
                var result = JSON.parse(data);
                G7DataSpace.ajaxResult = result;
                if (result.data.length > 0) {
                    var output = Mustache.render(G7DataSpace.templateSkillTable, result);
                    $(".job-skill-setting").html(output);
                } else {
                    $(".job-skill-setting").html("<div class='no-skill'>该职业还没配置技能！</div> ")
                }

                if(typeof callbackFn=='function'){
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

        $('select').select2({width:'200px'});
        $(".joblist").change(function () {
            $(".loading").css("visibility", "visible");
            $(".btn").hide();
            getData($(this).val());
        })

        $(".edit-btn").click(function () {
            var output = Mustache.render(G7DataSpace.templateSkillList, G7DataSpace.ajaxResult);
            $(".job-skill-setting").html(output);
            compareSkill();
        })

        $(".view-btn").click(function () {
            if (G7DataSpace.ajaxResult.data.length > 0) {
                var output = Mustache.render(G7DataSpace.templateSkillTable, G7DataSpace.ajaxResult);
                $(".job-skill-setting").html(output);
            } else {
                $(".job-skill-setting").html("<div class='no-skill'>该职业还没配置技能！</div> ")
            }
        })

        $(".edit-sure").live('click', function () {
            $('.tform').serialize();
            var radioArr = $('input[type=radio]:checked');
            var postArr = [];
            var job_id = $("select.joblist").val();
            for (var i = 0; i < radioArr.length; i++) {
                var skill_id = radioArr.eq(i).attr("data-skill-id");
                var skill_type = radioArr.eq(i).val();
                var skill_intro = (skill_type == "1") ? "必修" : "选修";
                var itemArr = {
                    skill_id:skill_id,
                    skill_type:skill_type,
                    skill_intro:skill_intro
                }
                postArr.push(itemArr);
            }
            var postData = JSON.stringify(postArr);
            $.ajax({
                url:'index.php?c=pgadmin&a=skilltojob_ajax_post&job_id=' + job_id,
                type:'POST',
                data:'data=' + postData,
                success:function (data) {
                    alert(JSON.parse(data).des);
                    getData(job_id);
                },
                error:function () {
                    alert('出错了！')
                }
            })
        })
        //绑定复选框和单选框的选中关系
        $(".ck").live('click',function(){
            var value=$(this).attr('checked');
            if(value==false){
                $(this).parent().parent().find('.children-rd-node input').attr('checked','');
            }else{
                $(this).parent().parent().find('.children-rd-node').find('input[value="1"]').click();
            }
        })

        $('.children-rd-node input').live('click',function(){
            $(this).parent().parent().find('.ck').attr('checked','checked');
        });



    })
</script>
</body>
</html>