<?php /* Smarty version 2.6.26, created on 2013-07-30 10:27:27
         compiled from pg/user/myStudent.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'pg/user/myStudent.html', 22, false),)), $this); ?>
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
<body class="pgAdmin  userDeafult">
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
            <li class="active"><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguser','a' => 'myStudent'), $this);?>
">学生情况</a></li>
            <li><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguser','a' => 'mySkillNum'), $this);?>
">技能数量</a></li>
        </ul>
    </div>
</nav>
<div class="wrap">
    <p class="mySkill-common">
    <?php if ($_COOKIE['pm_user_power'] != 0): ?>
    	 选择组员：<select class="studentlist" id="studentlist">
            <?php $_from = $this->_tpl_vars['students']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
            <option value="<?php echo $this->_tpl_vars['rs']['user_id']; ?>
"><?php echo $this->_tpl_vars['rs']['user_name']; ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
        </select>
    <?php else: ?><!-- 管理员的 -->
    	<span id="studentselect1">
  		  选择组员：<select class="studentlist" id="studentlist">
            <?php $_from = $this->_tpl_vars['students']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
            <option value="<?php echo $this->_tpl_vars['rs']['user_id']; ?>
"><?php echo $this->_tpl_vars['rs']['user_name']; ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
        </select>
        </span>
        <span id="studentselect2">
    	 选择组员：<select class="studentlist" id="studentlist">
            <?php $_from = $this->_tpl_vars['all_user']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
            <option value="<?php echo $this->_tpl_vars['rs']['user_id']; ?>
"><?php echo $this->_tpl_vars['rs']['user_name']; ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
        </select>
        </span>
        <input type="checkbox" id="show_all">全部
    <?php endif; ?>
       
        <span class="loading">Loading……</span>
    </p>
    <section class="boxstyle1 top clearfix myGrowBox_content" style="padding-top: 20px;">
    	<h2>现在是<font color="red" id="job_lv_name"></font>。
            	
        </h2>
        <br>
        <!-- 
        <div>
		<span class="grow-record-num">A级别数量：
			<span class="probar_com probar">
					<span class="probar_com probar_had probar_1">

					</span>
                    <font class="blv_1" value=""></font>
			</span>
		</span>
		<span class="grow-record-num">B级别数量：
			<span class="probar_com probar">
					<span class="probar_com probar_had probar_2">

					</span>
                    <font class="blv_2" value=""></font>
			</span>
		</span>
        </div>
        <br>
        <div>
		<span class="grow-record-num" >C级别数量：
			<span class="probar_com probar">
					<span class="probar_com probar_had probar_3">

					</span>
                    <font class="blv_3" value=""></font>
			</span>
		</span>
		<span class="grow-record-num">D级别数量：
			<span class="probar_com probar">
					<span class="probar_com probar_had probar_4">

					</span>
                    <font class="blv_4" value=""></font>
			</span>
		</span>
        </div>
        <br>
        <div>
		<span class="grow-record-num">E级别数量：
			<span class="probar_com probar">
					<span class="probar_com probar_had probar_5">

					</span>
                    <font class="blv_5" value=""></font>
			</span>
		</span>
		<span class="grow-record-num">无级别数量：
			<span class="probar_com probar">
					<span class="probar_com probar_had probar_10">

					</span>
                    <font class="blv_10" value=""></font>
			</span>
		</span>
        </div>
         -->
        <hr>
        <h2 style="margin-top: 20px;">数据统计:</h2>
        <section class="myGrowBox_search">
            <span>选择项目开始时间段:</span>
            <input type="text" name="pnod_time_s00" id="pnod_time_s00" readonly class="itext date select" value="<?php echo $this->_tpl_vars['bdate']; ?>
"/>
            <span>至</span>
            <input type="text" name="pnod_time_e00" id="pnod_time_e00" readonly class="itext date select" value="<?php echo $this->_tpl_vars['edate']; ?>
"/>
            <input type="button" value="" title="查询" id="search" class="btnc btnc_search myGrowBox_search"/>
        </section>

        <div class="myGrowBox_div2" style="background: #fff;padding: 20px;">

            <ul>
                <li><span class="myPro-num">参加项目数：</span>A级 <span class="plv_1"></span>个; B级 <span class="plv_2"></span>个; C级 <span class="plv_3"></span>个; D级 <span class="plv_4"></span>个; E级 <span class="plv_5"></span>个; 无级别 <span class="plv_10"></span>个; 旧历史 <span class="plv_0"></span>个;</li>
                <li><span class="myPro-num">参加流程数：</span>A级 <span class="nlv_1"></span>个; B级 <span class="nlv_2"></span>个; C级 <span class="nlv_3"></span>个; D级 <span class="nlv_4"></span>个; E级 <span class="nlv_5"></span>个; 无级别 <span class="nlv_10"></span>个; 旧历史 <span class="nlv_0"></span>个; 流程delay率： <span class="delayP"></span></li>
            </ul>
        </div>
    </section>
<p class="mySkill-common">
     共性任务
</p>
    <table class="table3" id="table3">
        <thead>
        <tr class="btop">
            <td class="bleft">序号</td>
            <td class="tleft">任务名</td>
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
            </td>
        </tr>
        </tfoot>
    </table>
<p class="mySkill-common">
     特殊任务
</p>
    <table class="table3" id="table2">
        <thead>
        <tr class="btop">
            <td class="bleft">序号</td>
            <td class="tleft">任务名</td>
            <td class="bright">是否完成</td>
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
            </td>
        </tr>
        </tfoot>
    </table>
<p class="mySkill-common">
        技能信息
</p>
    <table class="table3 myStudentSkill" id="table1">
        <thead>
        <tr class="btop">
            <td class="bleft">序号</td>
            <td class="tleft">技能名</td>
            <td class="tleft">性质</td>
            <td class="tleft">技能描述及掉落说明</td>
            <td class="tleft">技能经验</td>
            <td class="bright">下一等级</td>         
        </tr>
        </thead>
        <tr class="hide_tr">
            <td class="bleft"></td>
            <td class="tleft"></td>
            <td class="tleft"></td>
            <td class="tleft"></td>
            <td class="tleft"></td>
            <td class="bright"></td>
        </tr>
        <tfoot>
        <tr>
            <td colspan="7">
            </td>
        </tr>
        </tfoot>

    </table>

</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="myskill_popwin" class="popwin">
    <div class="popwin_inner clearfix">

    </div>
</div>
</body>
<script>

getData($('#studentlist').val());
$('.hide_tr').hide();
$('.studentlist').select2({
    width:'150px'
});
$('.studentlist').change(function(){
	getData($(this).val());
});
<?php if ($_COOKIE['pm_user_power'] == 0): ?>
$('#studentselect2').hide();
$('#show_all').click(function(){
	if ($(this).attr("checked")) {
		$('#studentselect2').show();
    	$('#studentselect1').hide();
    	getData($('#studentselect2 select').val());
    }else {
		$('#studentselect2').hide();
		$('#studentselect1').show();
		getData($('#studentselect1 select').val());
    }
});
<?php endif; ?>
PMS.bindDatepickers("#pnod_time_s00","#pnod_time_e00");
$("#myskill_popwin").hide();
$("#search").click(function(){
	getData_p_n($("#pnod_time_s00").val(),$("#pnod_time_e00").val(),$('#studentlist').val());
});
function selectedNode(id)
{
    var url= "<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguser','a' => 'mySkillNode'), $this);?>
" + "&id="+id;
    $('#myskill_popwin div').load(url,function(){_$.popWin("myskill_popwin");});
}
function getData(user_id) {
	$(".loading").css("visibility", "visible");
    $.ajax({
        url:'index.php?c=pguser&a=myStudent_ajax&user_id=' + user_id,
        type:'GET',
        success:function (data) {
        	$(".loading").css("visibility", "hidden");
            debugger;
            var result = JSON.parse(data);
            var flv_array = result["flv_array"];
            var lv_array = result["lv_array"];
            var blv_array = result["blv_array"];
            for(var i = 1;i<6;i++)
            {
            	$(".blv_"+i).html(flv_array['flv_'+i]+"/"+lv_array['lv_'+i]);
            	$(".blv_"+i).attr("value",blv_array['blv_'+i]);
            }
            for(var i = 1;i<6;i++)
            {
                $(".probar_"+i).width($(".blv_"+i).attr("value")*$(".probar").width());
            }
            $(".blv_10").attr("value",blv_array['blv_10']);
        	$(".blv_10").html(flv_array['flv_10']+"/"+lv_array['lv_10']);
            $(".probar_10").width($(".blv_10").attr("value")*$(".probar").width());
            var sameTask = result["sameTask"];
            $("#table3 tr:gt(1):not(:last)").remove();
            for (var key in sameTask) {
                var serial = key / 1 + 1;
                var content =
                        "<tr>" +
                                "<td class=\"bleft\">" + serial + "</td>" +
                                "<td class=\"tleft\">" + 
                                	sameTask[key].mtpl.mtpl_name +
                                "</td>" +
                                "<td class=\"bright\">" +
                                	sameTask[key].num +
                                "</td>" +
                        "</tr>";
                $(content).insertAfter($("#table3 tr:eq(" + serial + ")"));
            }
            var specialTask = result["specialTask"];
            $("#table2 tr:gt(1):not(:last)").remove();
            for (var key in specialTask) {
                var serial = key / 1 + 1;
                var content =
                        "<tr>" +
                                "<td class=\"bleft\">" + serial + "</td>" +
                                "<td class=\"tleft\">" + 
                                	"<a href=\"<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project_bll','a' => 'project_show'), $this);?>
&id="+specialTask[key].proj_id+"\">"+
                                		specialTask[key].proj_name +
                          			"</a>" + 
                                "</td>" +
                                "<td class=\"bright\">" +
                                (specialTask[key].proj_endDate == null? "【<font color=\"blue\">尚未完成</font>】":"【<font color=\"red\">完成时间："+specialTask[key].proj_endDate+"</font>】")+ 
                                "</td>" +
                        "</tr>";
                $(content).insertAfter($("#table2 tr:eq(" + serial + ")"));
            }
            $("#job_lv_name").html(result["job_lv"]+result["job_name"]);
            var skillArray = result["skillArray"];
            $("#table1 tr:gt(1):not(:last)").remove();
            for (var key in skillArray) {
            	var serial = key / 1 + 1;
            	var content =
                    "<tr class=\"skill-name\">" +
                            "<td class=\"bleft\">" + serial + "</td>" +
                            "<td class=\"tleft\">" + 
                            	"<a onclick=\"selectedNode("+skillArray[key].skill_id+")\">"+
                            		skillArray[key].skill_name +
                      			"</a>" + 
                            "</td>" +
                            "<td class=\"tleft\">" +
                        		(skillArray[key].skill_intro == null?"":skillArray[key].skill_intro)+ 
                        	"</td>" +
                       		"<td class=\"tleft\">" +
                    			(skillArray[key].skill_title == null?"":skillArray[key].skill_title)+ 
                    		"</td>" +
                    		"<td class=\"tleft\">" +
                				(skillArray[key].skill_lv==5?"":
                				"<div class=\"probar_com probar\" id=\"probar\">"+
                                "<div class=\"probar_com probar_had\" id=\"probar_had\" style=\" width:"+skillArray[key].skill_exp*2+"px;\">"+
								"</div>"+
                                "<font>"+skillArray[key].skill_exp+"/100</font>"+
                            	"</div>")+
                			"</td>" +
                            "<td class=\"bright\">" +
                            	(skillArray[key].skill_lv==5?"已经满级":skillArray[key].skill_lv)+ 
                            "</td>" +
                    "</tr>" +
                    "<tr>" +
	                    "<td class=\"bleft\"></td>" +
	                    "<td class=\"tleft\"  colspan=\"4\">" + 
	                    	"技能使用数量:\t Lv1:"+skillArray[key].skill_num[1] +
	                    	" —— "+
	                    	"Lv2:"+skillArray[key].skill_num[2] +
	                    	" —— "+
	                    	"Lv3:"+skillArray[key].skill_num[3] +
	                    	" —— "+
	                    	"lv4:"+skillArray[key].skill_num[4] +
	                    "</td>" +
	                    "<td class=\"bright\">" +
	                    "</td>" +
           			 "</tr>";
            	$(content).insertAfter($("#table1 tr:eq(" + ((serial-1)*2+1) + ")"));
            }
            $("#pnod_time_s00").val(result["bdate"]);
            $("#pnod_time_e00").val(result["edate"]);
            getData_p_n(result["bdate"],result["edate"],user_id);
        },
        error:function () {
            alert('出错了！');
        }
    })
}
function getData_p_n(bdate,edate,user_id) {
    $.ajax({
        url:'index.php?c=pguser&a=myDataStatistics_axjx&bdate='+bdate+'&edate='+edate+'&user_id='+user_id,
        type:'GET',
        success:function(data){
            var result = JSON.parse(data);
            var plv = result['plv'];
            for(var key in plv){
                $("."+key).html(plv[key]);
            }
            var nlv = result['nlv'];
            for(var key in nlv){
                $("."+key).html(nlv[key]);
            }
            var delayP = result['delayP'];
            delayP = (delayP.toFixed(4)*100+"").substring(0,5) + "%";
            $(".delayP").html(delayP);
        },
        error:function(){
            alert('出错了！')
        }
    })
}
</script>
</html>