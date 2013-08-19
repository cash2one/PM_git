<?php /* Smarty version 2.6.26, created on 2013-07-15 14:10:52
         compiled from pg/useradmin/pguser.html */ ?>
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
<body class="pgAdmin userDeafult pguser">
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
            <h1>角色初始化配置</h1>

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
        <div class="user-skill-setting">

        </div>
    </article>
</div>
<div class="tc-bg">
</div>
<div class="tc-container">
    <h2>添加技能<a class="close">关闭</a></h2>

    <p>
        <label>选择技能：<select class="skill-list-sel">
            <?php $_from = $this->_tpl_vars['skillList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
            <option value="<?php echo $this->_tpl_vars['rs']['skill_id']; ?>
"><?php echo $this->_tpl_vars['rs']['skill_name']; ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
        </select>
        </label>
    </p>
    <p>
        <label>技能等级：<select class="skill-lv-sel">
            <option value="1">1级</option>
            <option value="2">2级</option>
            <option value="3">3级</option>
            <option value="4">4级</option>
        </select>
        </label>
    </p>
    <p style="text-align: center;">
        <a href="javascript:;" class="edit-sure" id="skill-add-btn">确定</a>
    </p>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script id="templateIsInit" type="text/template">
    {{#isInit}}
    <div class="info">
        <h3>该帐号信息如下：</h3>
        职业类型：<select class="job-type"><?php $_from = $this->_tpl_vars['jobList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
        <option value="<?php echo $this->_tpl_vars['rs']['job_id']; ?>
"><?php echo $this->_tpl_vars['rs']['job_name']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?></select>
        &nbsp;职业等级：<select class="job-lv">
        <option value="1">实习</option>
        <option value="2">试用</option>
        <option value="3">初级</option>
        <option value="4">中级</option>
        <option value="5">高级</option>
    </select>
        &nbsp;经验值：<input type="text" class="exp-input" value="{{pg_user_exp}}"/>
        &nbsp;贡献度：<input type="text" class="gongxian-input" value="{{pg_user_gongxian}}"/>
		
		<br>
		<div>
		<span class="is_teacher_span">
			是否导师:<input class="is_teacher" type="checkbox" onclick="is_teacher_click()" />
		</span>
		<span class="select_teacher_span">选择导师：<select class="userlist2">
					<option value="0">无</option>
            		<?php $_from = $this->_tpl_vars['userList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
						<?php if ($this->_tpl_vars['rs']['p_user_id'] == -1): ?>
            		<option value="<?php echo $this->_tpl_vars['rs']['user_id']; ?>
"><?php echo $this->_tpl_vars['rs']['user_name']; ?>
</option>
						<?php endif; ?>
            		<?php endforeach; endif; unset($_from); ?>
       		   </select>
		</span>
		</div>
		<br>
        <p><a href="#" class="add-skill" id="add-skill-btn">添加技能</a></p>
    </div>
    {{/isInit}}
    <table class="table3">
        <thead>
        <tr class="btop">
            <td class="bleft">技能名称</td>
            <td class="tleft">战力系数</td>
            <td class="tleft">技能描述及掉落说明</td>
			<td class="tleft">当前经验</td>
            <td class="tleft">下一等级</td>
            <td class="bright">操作</td>
        </tr>
        </thead>
        {{#skill}}
        <tr class="skill-name">
            <td class="bleft">{{skillname.skill_name}}</td>
            <td class="tleft">暂缺</td>
            <td class="tleft">暂缺</td>
            <td class="tleft">{{skill_exp}}/100</td>
			<td class="tleft"><a class="minus-skill-lv" data-pgstuid="{{pg_stuid}}">-</a><span class="skill-lv-num">{{skill_lv}}</span><a class="add-skill-lv" data-pgstuid="{{pg_stuid}}">+</a></td>
            <td class="bright"><a href="#" data-pgstuid="{{pg_stuid}}" class="sure-del-btn">删除</a>
            </td>
        </tr>
        {{/skill}}
        <tfoot>
        <td colspan="6"></td>
        </tfoot>
    </table>
    <p class="skill-bottom"><a href="javascript:;" class="edit-sure" id="all-edit-sure">确认配置</a></p>
</script>
<script id="templateIsNotInit" type="text/template">
    <div class="info">
        <h3>该账号还未初始化,请进行基础配置再进行技能配置：</h3>
        职业类型：<select class="job-type"><?php $_from = $this->_tpl_vars['jobList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
        <option value="<?php echo $this->_tpl_vars['rs']['job_id']; ?>
"><?php echo $this->_tpl_vars['rs']['job_name']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?></select>&nbsp;职业等级：<select class="job-lv">
        <option value="5">实习</option>
        <option value="4">试用</option>
        <option value="1">初级</option>
        <option value="2">中级</option>
        <option value="3">高级</option>
    </select>
        &nbsp;经验值：<input type="text" class="exp-input" value=""/>
        &nbsp;贡献度：<input type="text" class="gongxian-input" value=""/>
		<br>
		<div>
		<span class="is_teacher_span">
			是否导师:<input class="is_teacher" type="checkbox"  onclick="is_teacher_click()"/>
		</span>
		<span class="select_teacher_span">选择导师：<select class="userlist2">
					<option value="0">无</option>
            		<?php if ($this->_tpl_vars['rs']['p_user_id'] == -1): ?>
            			<option value="<?php echo $this->_tpl_vars['rs']['user_id']; ?>
"><?php echo $this->_tpl_vars['rs']['user_name']; ?>
</option>
					<?php endif; ?>
       		   </select>
		</span>
		</div>
		<br>
    </div>


    <p class="skill-bottom"><a href="javascript:;" class="edit-sure" id="all-init-sure">确认初始化</a></p>
</script>
<script>
	var teacher_id = 0;
    var G7DataSpace = {};
    //定义一个“全局”对象
    //返回的数据结果存放
    G7DataSpace.ajaxResult = '';
    //pgid的存放
    G7DataSpace.pgUserId = '';
    //待更新数据集
    G7DataSpace.addSkillArray = [];
    G7DataSpace.templateIsInit = $("#templateIsInit").html();
    G7DataSpace.templateIsNotInit = $("#templateIsNotInit").html();
    //模板渲染

    //初始化页面
    function defaultPage() {

        var value = getPassArgs('initUid') || $(".userlist").val();
        var setValue = $(".userlist").val(value);
        getData(value);
    }
    //获取其他页传过来的初始化参数
    function getPassArgs(argsName) {
        var arr = location.search.substring(1, location.search.length).split('&');
        for (var i = 0; i < arr.length; i++) {
            if (argsName == arr[i].split('=')[0]) {
                return arr[i].split('=')[1];
            }
        }
        return false;
    }
    function getData(Id, callbackFn) {
        $(".loading").css("visibility", "visible");
        $.ajax({
            url:'index.php?c=pguseradmin&a=userskilllist_ajax',
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
                    $(".user-skill-setting").html(output);

                    $('.job-type').val(result.isInit.job_id).select2({width:'120px'});
                    $('.job-lv').val(result.isInit.job_lv_num).select2({width:'80px'});
                    if(result.isInit.p_user_id==-1)
                   	{
                        $('.userlist2').select2({width:'200px'});
                        $(".select_teacher_span").hide();
                        $('.is_teacher').attr('checked','true');
                   	}else
               		{
                   		$('.userlist2').val(result.isInit.p_user_id).select2({width:'200px'});
               		}
                } else {
                    var output = Mustache.render(G7DataSpace.templateIsNotInit, result);
                    $(".user-skill-setting").html(output);
                    $('.job-type').select2({width:'120px'});
                    $('.job-lv').select2({width:'80px'});
                    $('.userlist2').select2({width:'200px'});
                }
                $(".userlist2").change(function () {
                    teacher_id = $(this).val();
                });
                if (typeof callbackFn == 'function') {
                    callbackFn();
                }
            },
            error:function () {
                alert('鼠标别点那么快！人家还在loading！')
            }
        })
    }
    function is_teacher_click() {
    	var checkbox = $('.is_teacher').attr('checked');
    	if(checkbox)
   		{
    		$(".select_teacher_span").hide();
    		teacher_id = -1;
   		}else
		{
   			$(".select_teacher_span").show();
    		teacher_id = 0;
		}
    }

    $(function () {

        defaultPage();
        $('select').select2({
            width:'200px'
        });
        //弹窗
        $(".userlist").change(function () {
            $(".loading").css("visibility", "visible");
            $(".btn").hide();
            getData($(this).val());
        });
        $(".close").click(function () {
            $('.tc-bg').hide();
            $('.tc-container').hide();
        });

        $(".add-skill").live('click', function () {
            $(".tc-bg").css({"height":$(document).height()}).show();
            $(".tc-container").show();
        });

        //添加技能
        $("#skill-add-btn").click(function () {
            var skill_id = $('select.skill-list-sel').val();
            var skill_lv = $('select.skill-lv-sel').val();
            var skill_name = $("select.skill-list-sel").find("option:selected").text();
            $('.close').click();
            $("#add-skill-btn").removeClass("add-skill").addClass('enabled').text('正在与服务器同步……');
            $.ajax({
                url:'index.php?c=pguseradmin&a=pguserskill_update&user_id=' + $('select.userlist').val(),
                type:'POST',
                data:'skill_id=' + skill_id+'&skill_lv='+skill_lv,
                success:function (data) {
                    //alert(JSON.parse(data).des);
                    $("#add-skill-btn").removeClass("enabled").addClass('add-skill').text('添加技能');
                    var str = '<tr class="skill-name"><td class="bleft">' + skill_name + '</td><td class="tleft">暂缺</td><td class="tleft">暂缺</td><td class="tleft">0/100</td><td class="tleft"><a class="minus-skill-lv" data-pgstuid="'+JSON.parse(data).pgstuid+'">-</a><span class="skill-lv-num">' + skill_lv + '</span><a class="add-skill-lv" data-pgstuid="'+JSON.parse(data).pgstuid+'">+</a></td><td class="bright"><a href="#"  class="sure-del-btn" data-pgstuid=' + JSON.parse(data).pgstuid + '>删除</a></td></tr>';
                    $(".table3").append(str);
                },
                error:function () {
                    alert('出错了！')
                }
            })
        });

        //删除现有的技能
        $(".sure-del-btn").live('click', function () {

            var pgstuid = $(this).attr('data-pgstuid');
            var parentTR = $(this).parent().parent();
            var cf = confirm('确定删除？');
            if (cf) {
                $(".loading").css("visibility", "visible");
                $.ajax({
                    url:'index.php?c=pguseradmin&a=userskilldel_ajax',
                    type:'POST',
                    data:'pgstuid=' + pgstuid,
                    success:function (data) {
                        $(".loading").css("visibility", "hidden");
                        if (JSON.parse(data).rs == '200') {
                        //    alert(JSON.parse(data).des);
                            parentTR.detach();
                        }

                    },
                    error:function () {
                        alert('出错了！')
                    }
                })
            }
        })

        $(".minus-skill-lv").live('click',function(){
            var $this=$(this);
            var value=parseInt($this.next().html(),10)-1;
			
            
            if((value+1)=='1'){
                alert('都1级了还想降级啊！！');
            }else{
            	if(!confirm('确定减少等级？一旦减少则之前的技能值将会归零！'))
    			{
    				return ;
    			}
                $(".loading").css("visibility", "visible");
                $.ajax({
                    url:'index.php?c=pguseradmin&a=pguserskilllv_update&pg_stuid=' + $(this).attr('data-pgstuid')+'&skill_lv='+value,
                    type:'GET',
                    success:function (data) {
                        $(".loading").css("visibility", "hidden");
                        $this.next().html(value);
                        $this.parent().prev().html("0/100");
                    },
                    error:function () {
                        alert('出错了！')
                    }
                })
            }
        })

        $(".add-skill-lv").live('click',function(){
            var $this=$(this);

            var value=parseInt($this.prev().html(),10)+1;
            
            if((value-1)=='5'){
                alert('都满级了还想升级啊！！');
            }else{
            	if(!confirm('确定增加等级？一旦增加则之前的技能值将会归零！'))
    			{
    				return ;
    			}
                $(".loading").css("visibility", "visible");
                $.ajax({
                    url:'index.php?c=pguseradmin&a=pguserskilllv_update&pg_stuid=' + $(this).attr('data-pgstuid')+'&skill_lv='+value,
                    type:'GET',
                    success:function (data) {
                        $(".loading").css("visibility", "hidden");
                        $this.prev().html(value);
                        $this.parent().prev().html("0/100");
                    },
                    error:function () {
                        alert('出错了！')
                    }
                })
            }
        })


        //角色若未初始化
        $("#all-init-sure").live('click', function () {
        	if(teacher_id == $('select.userlist').val()) {
        		alert("不能选择本人作为导师！");
        		return;
        	}
            $.ajax({
                url:'index.php?c=pguseradmin&a=pguser_create&user_id=' + $('select.userlist').val(),
                type:'POST',
                data:'exp=' + $('.exp-input').val() + 
                	'&gongxian=' + $('.gongxian-input').val() + 
                	'&jobid=' + $('select.job-type').val()+
                	'&joblv='+$('select.job-lv').val()+
                	'&p_id='+teacher_id,
                success:function (data) {
                    alert('初始化成功，现在可以配置技能');
                    getData($('select.userlist').val());
                },
                error:function () {
                    alert('出错了！');
                }
            })
        });

        //角色更新
        $("#all-edit-sure").live('click', function () {
        	if(teacher_id == $('select.userlist').val()) {
        		alert("不能选择本人作为导师！");
        		return;
        	}
            $(".loading").css("visibility", "visible");
            $.ajax({
                url:'index.php?c=pguseradmin&a=pguser_update&user_id=' + $('select.userlist').val(),
                type:'POST',
                data:'exp=' + $('.exp-input').val() + 
                	'&gongxian=' + $('.gongxian-input').val() + 
                	'&jobid=' + $('select.job-type').val()+
                	'&joblv='+$('select.job-lv').val()+
                	'&p_id='+teacher_id,
                success:function (data) {
                    $(".loading").css("visibility", "hidden");
                    alert('更新成功');
                    //getData($('select.userlist').val());
                },
                error:function () {
                    alert('出错了！')
                }
            })
        });
        

    })
</script>

</body>
</html>