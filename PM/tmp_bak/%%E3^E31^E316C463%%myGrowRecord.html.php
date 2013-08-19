<?php /* Smarty version 2.6.26, created on 2013-07-08 12:19:22
         compiled from pg/user/myGrowRecord.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'pg/user/myGrowRecord.html', 26, false),)), $this); ?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/base.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <link type="text/css"  rel="stylesheet" href="themes/css/jquery.ui.all.css?cache=<?php echo @RD; ?>
" />
    <link type="text/css"  rel="stylesheet" href="themes/css/morris.css?cache=<?php echo @RD; ?>
" />
    <script type="text/javascript" src="themes/js/jquery-ui.last.js?cache=<?php echo @RD; ?>
"></script>
    <script type="text/javascript" src="themes/js/raphael-min.js?cache=<?php echo @RD; ?>
"></script>
    <script type="text/javascript" src="themes/js/morris.min.js?cache=<?php echo @RD; ?>
"></script>
    <link>
    <style>
        .select2-container{position: static;}/*hack select2 hidden */
        .myproj-record-chart{background: #fff;}
        .chart-box{border: 1px solid #ccc;margin: 20px;box-shadow: 1px 1px 1px #ddd;border-radius: 5px;overflow: hidden;height: 400px;margin-top: 0;}
        .chart-title{text-align: center;font-size: 18px;padding-top: 30px;margin-bottom: 10px;color: #006dcc;text-shadow: 1px 1px 1px #efefef;}
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
            <li><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project_bll','a' => 'myWork'), $this);?>
">正在进行的工作</a></li>
            <li class="active"><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguser','a' => 'myGrowRecord'), $this);?>
">成长记录</a></li>
            <li><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguser','a' => 'mySkillGift'), $this);?>
">技能及战力</a></li>
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
            <?php if ($this->_tpl_vars['p_user_id'] == -1): ?>
            	<li><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguser','a' => 'myStudent'), $this);?>
">学生情况</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
<div class="wrap">
    <section class="boxstyle1 top clearfix myGrowBox_content" style="padding-top: 20px;">
        <h2>你现在是<font color="red"><?php echo $this->_tpl_vars['job_lv']; ?>
</font><?php echo $this->_tpl_vars['job_name']; ?>
，
            <?php if ($this->_tpl_vars['job_lv_next']): ?>
            你的下个职级是<font color="red"><?php echo $this->_tpl_vars['job_lv_next']; ?>
</font><?php echo $this->_tpl_vars['job_name']; ?>
，你的项目经历如下:
            <?php else: ?>
            你已经是最高等级，无需升级。
            <?php endif; ?>
        </h2>
        <?php if ($this->_tpl_vars['job_lv_next']): ?>
        <br>
        <div>
		<span class="grow-record-num">A级别数量：
			<span class="probar_com probar">
					<span class="probar_com probar_had probar_1">

					</span>
                    <font class="blv_1" value="<?php echo $this->_tpl_vars['blv_array']['blv_1']; ?>
"><?php echo $this->_tpl_vars['flv_array']['flv_1']; ?>
/<?php echo $this->_tpl_vars['lv_array']['lv_1']; ?>
</font>
			</span>
		</span>
		<span class="grow-record-num">B级别数量：
			<span class="probar_com probar">
					<span class="probar_com probar_had probar_2">

					</span>
                    <font class="blv_2" value="<?php echo $this->_tpl_vars['blv_array']['blv_2']; ?>
"><?php echo $this->_tpl_vars['flv_array']['flv_2']; ?>
/<?php echo $this->_tpl_vars['lv_array']['lv_2']; ?>
</font>
			</span>
		</span>
        </div>
        <br>
        <div>
		<span class="grow-record-num" >C级别数量：
			<span class="probar_com probar">
					<span class="probar_com probar_had probar_3">

					</span>
                    <font class="blv_3" value="<?php echo $this->_tpl_vars['blv_array']['blv_3']; ?>
"><?php echo $this->_tpl_vars['flv_array']['flv_3']; ?>
/<?php echo $this->_tpl_vars['lv_array']['lv_3']; ?>
</font>
			</span>
		</span>
		<span class="grow-record-num">D级别数量：
			<span class="probar_com probar">
					<span class="probar_com probar_had probar_4">

					</span>
                    <font class="blv_4" value="<?php echo $this->_tpl_vars['blv_array']['blv_4']; ?>
"><?php echo $this->_tpl_vars['flv_array']['flv_4']; ?>
/<?php echo $this->_tpl_vars['lv_array']['lv_4']; ?>
</font>
			</span>
		</span>
        </div>
        <br>
        <div>
		<span class="grow-record-num">E级别数量：
			<span class="probar_com probar">
					<span class="probar_com probar_had probar_5">

					</span>
                    <font class="blv_5" value="<?php echo $this->_tpl_vars['blv_array']['blv_5']; ?>
"><?php echo $this->_tpl_vars['flv_array']['flv_5']; ?>
/<?php echo $this->_tpl_vars['lv_array']['lv_5']; ?>
</font>
			</span>
		</span>
		<span class="grow-record-num">无级别数量：
			<span class="probar_com probar">
					<span class="probar_com probar_had probar_10">

					</span>
                    <font class="blv_10" value="<?php echo $this->_tpl_vars['blv_array']['blv_10']; ?>
"><?php echo $this->_tpl_vars['flv_array']['flv_10']; ?>
/<?php echo $this->_tpl_vars['lv_array']['lv_10']; ?>
</font>
			</span>
		</span>
        </div>
        <?php endif; ?>
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

        <h2 style="margin-top: 20px;">详细记录:</h2>
        <nav class="clearfix2" style="margin-bottom: 20px;">
            <a class="myGrowRecord_chart myInfo-btn ">图表</a>
            <a class="myGrowRecord_word myInfo-btn current">文字</a>
        </nav>
        <div class="myGrowBox_div2">
                <ul class="myproj-record-txt">
                    <?php $_from = $this->_tpl_vars['myProjRecord']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
                    <li>
                        <h3><?php echo $this->_tpl_vars['rs']['proj_endDate']; ?>
</h3>
                        <p class="l1"><span style="color: #B94A48"> <?php echo $this->_tpl_vars['rs']['proj_lv']; ?>
级</span>项目“<span style="color: #B94A48;"><?php echo $this->_tpl_vars['rs']['prod_name']; ?>
-<?php echo $this->_tpl_vars['rs']['proj_name']; ?>
</span>”顺利结束，我在项目中平均delay<span style="color: #B94A48"><?php if ($this->_tpl_vars['rs']['delay'] == null || $this->_tpl_vars['rs']['delay'] < 0): ?>0<?php else: ?><?php echo $this->_tpl_vars['rs']['delay']; ?>
<?php endif; ?>天</span>。
                        	获得贡献值<span style="color: #B94A48"><?php if ($this->_tpl_vars['rs']['contri_num'] == null || $this->_tpl_vars['rs']['contri_num'] < 0): ?>0<?php else: ?><?php echo $this->_tpl_vars['rs']['contri_num']; ?>
<?php endif; ?></span></p>
                        <p class="l2">
                        	<?php if ($this->_tpl_vars['rs']['skill'] == null): ?>
                        		<span>没有获得任何技能值。</span>
                        	<?php else: ?>
	                        	<span>获得技能值：</span>
								<?php $_from = $this->_tpl_vars['rs']['skill']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs2']):
?>
								<span><?php echo $this->_tpl_vars['rs2']['skill_name']; ?>
<span style="color: #B94A48">+<?php echo $this->_tpl_vars['rs2']['actually_exp']; ?>
</span>；</span>
								<?php endforeach; endif; unset($_from); ?>
							<?php endif; ?>
						</p>
                    </li>
                    <?php endforeach; endif; unset($_from); ?>
                    <div style="text-align:center">

                        <a href="javascript:void(0);" id="btn_load_more" class="myInfo-btn" style="float: none;">加载更多</a>
                	</div>
                </ul>
                <section class="myproj-record-chart">

                </section>
                
        </div>
    </section>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>
<script>
	var p_num = 10;
	var finishP_date = null;
	var finishProject_chart = null;
	var finishPN_date = null;
	var finishProjectNode_chart = null;
	var contri_date = null;
	var contri_chart = null;
	var exper_date = null;
	var exper_chart = null;
    for(var i = 1;i<6;i++)
    {
        $(".probar_"+i).width($(".blv_"+i).attr("value")*$(".probar").width());
    }
    $(".probar_10").width($(".blv_10").attr("value")*$(".probar").width());
    var flv_array = <?php echo $this->_tpl_vars['flv_array']; ?>
;
    getData($("#pnod_time_s00").val(),$("#pnod_time_e00").val());
    //getData("","");//获取全部
    PMS.bindDatepickers("#pnod_time_s00","#pnod_time_e00");
    function getData(bdate,edate) {
        $.ajax({
            url:'index.php?c=pguser&a=myDataStatistics_axjx&bdate='+bdate+'&edate='+edate,
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
    $("#search").click(function(){
        getData($("#pnod_time_s00").val(),$("#pnod_time_e00").val());
    });
    $(".myGrowRecord_word").click(function(){
    	$(".myGrowRecord_chart").removeClass('current');
        $(this).addClass('current');
        $(".myproj-record-chart").html("");
        $(".myproj-record-txt").show();
    });
    $(".myGrowRecord_chart").click(function(){
        $(".myGrowRecord_word").removeClass('current');
        $(this).addClass('current');
        $(".myproj-record-txt").hide();
        $(".myproj-record-chart").html(
        		"<div class=\"mainBox\">"+
        		"<h3 class='chart-title'>完成的项目数量</h3>"+
        		"<div id=\"finishProject\" class='chart-box'></div>"+
        		"<a onclick=\"finishP(1)\"><span class=\"left\"></span></a>"+
        		"<a onclick=\"finishP(2)\"><span class=\"right\"></span></a>"+
        		"</div>"+
        		"<div class=\"mainBox\">"+
        		"<h3 class='chart-title'>完成的流程数量</h3>"+
        		"<div id=\"finishProjectNode\" class='chart-box'></div>"+
        		"<a onclick=\"finishPN(1)\"><span class=\"left\"></span></a>"+
        		"<a onclick=\"finishPN(2)\"><span class=\"right\"></span></a>"+
        		"</div>"+
        		"<div class=\"mainBox\">"+
        		"<h3 class='chart-title'>贡献值</h3>"+
        		"<div id=\"contribute\" class='chart-box'></div>"+
        		"<a onclick=\"contri(1)\"><span class=\"left\"></span></a>"+
        		"<a onclick=\"contri(2)\"><span class=\"right\"></span></a>"+
        		"</div>"+
        		"<div class=\"mainBox\">"+
        		"<h3 class='chart-title'>经验值</h3>"+
        		"<div id=\"experience\" class='chart-box'></div>"+
        		"<a onclick=\"exper(1)\"><span class=\"left\"></span></a>"+
        		"<a onclick=\"exper(2)\"><span class=\"right\"></span></a>"+
        		"</div>"
        		);
        
        $.ajax({
            url:'index.php?c=pguser&a=myRecordChart_axjx',
            type:'GET',
            success:function(data){
            	var result = JSON.parse(data);
            	//完成的项目数
            	var finishProject = result["finishProject"];
            	var finishProjectData = [];
            	for (var key in finishProject) {
            		var temp = Object();
            		temp.x=key;
            		temp.y=finishProject[key];
            		finishProjectData.push(temp);
            	}
            	finishP_date = finishProjectData[7].x;
            	finishProject_chart = Morris.Bar({
              	  element: 'finishProject',
              	  data: finishProjectData,
              	  xkey: 'x',
              	  ykeys: ['y'],
              	  labels: ['数量']
              	}).on('click', function(i, row){
              	  console.log(i, row);
              	});
            	//完成的流程数
            	var finishProject = result["finishProjectNode"];
            	var finishProjectNodeData = [];
            	for (var key in finishProject) {
            		var temp = Object();
            		temp.x=key;
            		temp.y=finishProject[key];
            		finishProjectNodeData.push(temp);
            	}
            	finishPN_date = finishProjectNodeData[7].x;
            	finishProjectNode_chart = Morris.Bar({
              	  element: 'finishProjectNode',
              	  data: finishProjectNodeData,
              	  xkey: 'x',
              	  ykeys: ['y'],
              	  labels: ['数量']
              	}).on('click', function(i, row){
              	  console.log(i, row);
              	});
            	//贡献值
            	var contribute = result["contribute"];
            	var contributeData = [];
            	var num = 0;
            	for (var key in contribute) {
            		var temp = Object();
            		temp.x=key;
            		num += contribute[key];
            		temp.y = num;
            		contributeData.push(temp);
            	}
            	contri_date = contributeData[7].x;
            	contri_chart = Morris.Line({
          		  element: 'contribute',
          		  data: contributeData,
          		  xkey: 'x',
          		  ykeys: ['y' ],
          		  labels: ['贡献值']
          		});
            	//经验值
            	var experience = result["experience"];
            	var experienceData = [];
            	var num = 0;
            	for (var key in experience) {
            		var temp = Object();
            		temp.x=key;
            		num += experience[key];
            		temp.y = num;
            		experienceData.push(temp);
            	}
            	exper_date = experienceData[7].x;
            	exper_chart = Morris.Line({
          		  element: 'experience',
          		  data: experienceData,
          		  xkey: 'x',
          		  ykeys: ['y' ],
          		  labels: ['经验值']
          		});
                $(".myproj-record-chart").show();
            	
            },
            error:function(){
                alert('出错了！')
            }
        });
        
    });
    function finishP(type)
    {
    	//alert(type);	
    	//alert(finishP_date);
    	$.ajax({
            url:'index.php?c=pguser&a=getFinishProject_chart_axaj&type='+type
            		+'&date='+finishP_date,
            type:'GET',
            success:function(data){
            	var result = JSON.parse(data);
            	//完成的项目数
            	var finishProject = result["finishProject"];
            	var finishProjectData = [];
            	for (var key in finishProject) {
            		var temp = Object();
            		temp.x=key;
            		temp.y=finishProject[key];
            		finishProjectData.push(temp);
            	}
            	finishP_date = finishProjectData[7].x;
            	finishProject_chart.setData(finishProjectData);
            },
            error:function(){
                alert('出错了！')
            }
        })
    }
    function finishPN(type)
    {
    	//alert(type);	
    	//alert(finishP_date);
    	$.ajax({
            url:'index.php?c=pguser&a=getFinishProjectNode_chart_axaj&type='+type
            		+'&date='+finishPN_date,
            type:'GET',
            success:function(data){
            	var result = JSON.parse(data);
            	//完成的流程数
            	var finishProjectNode = result["finishProjectNode"];
            	var finishProjectNodeData = [];
            	for (var key in finishProjectNode) {
            		var temp = Object();
            		temp.x=key;
            		temp.y=finishProjectNode[key];
            		finishProjectNodeData.push(temp);
            	}
            	finishPN_date = finishProjectNodeData[7].x;
            	finishProjectNode_chart.setData(finishProjectNodeData);
            },
            error:function(){
                alert('出错了！')
            }
        })
    }
    function contri(type)
    {
    	//alert(type);	
    	//alert(finishP_date);
    	$.ajax({
            url:'index.php?c=pguser&a=getContribute_chart_axaj&type='+type
            		+'&date='+contri_date,
            type:'GET',
            success:function(data){
            	var result = JSON.parse(data);
            	//贡献值
            	var contribute = result["contribute"];
            	var contributeData = [];
            	var num = 0;
            	for (var key in contribute) {
            		var temp = Object();
            		temp.x=key;
            		num += contribute[key];
            		temp.y = num;
            		contributeData.push(temp);
            	}
            	contri_date = contributeData[7].x;
            	contri_chart.setData(contributeData);
            },
            error:function(){
                alert('出错了！')
            }
        })
    }
    
    function exper(type)
    {
    	//alert(type);	
    	//alert(finishP_date);
    	$.ajax({
            url:'index.php?c=pguser&a=getExperience_chart_axaj&type='+type
            		+'&date='+exper_date,
            type:'GET',
            success:function(data){
            	var result = JSON.parse(data);
            	//经验值
            	var experience = result["experience"];
            	var experienceData = [];
            	var num = 0;
            	for (var key in experience) {
            		var temp = Object();
            		temp.x=key;
            		num += experience[key];
            		temp.y = num;
            		experienceData.push(temp);
            	}
            	exper_date = experienceData[7].x;
            	exper_chart.setData(experienceData);
            },
            error:function(){
                alert('出错了！')
            }
        })
    }
    $("#btn_load_more").click(function(){
    	
    	$(this).html("加载中...");
    	$.ajax({
            url:'index.php?c=pguser&a=myRecord_axjx&p_num='+p_num,
            type:'GET',
            success:function(data){
            	p_num += 10;
            	var result = JSON.parse(data);
            	debugger;
            	if(result.length==0)
            	{
                    $('<p class="no-more-tips">已经是最后一条了。</p>').insertAfter($("#btn_load_more"));

            		$("#btn_load_more").hide();

            	}
            	else
            	{
            		$("#btn_load_more").html("加载更多");
            		for (var key in result) {
                    var content ="<li>"+
                                    "<h3>"+result[key].proj_endDate+"</h3>"+
                                    "<p class=\"l1\"><span style=\"color: #B94A48\">"+result[key].proj_lv+"级</span>项目“<span style=\"color: #B94A48;\">"+result[key].prod_name+"-"+result[key].proj_name+"</span>”顺利结束，我在项目中平均delay<span style=\"color: #B94A48\">";
                                    
                    if(result[key].delay == null || result[key].delay < 0)
                    {
                    	content += "0";
                    }else
                    {
                    	content += result[key].delay;
                    }
                    content +=  "天</span>。获得经验值<span style=\"color: #B94A48\">";
                    if(result[key].contri_num == null || result[key].contri_num < 0)
                    {
                    	content += "0";
                    }else
                    {
                    	content += result[key].contri_num;
                    }
                    content +="</span></p><p class=\"l2\">";
                    if(result[key].skill == false)
                    {
                    	content += "<span>没有获得任何技能值。</span>";
                    }else
                    {
                    	for (var j in result[key].skill) {
                    		content += "<span>获得技能值：</span><span>"+(result[key].skill)[j].skill_name+"<span style=\"color: #B94A48\">+"+(result[key].skill)[j].skill_exp+"</span>；</span>"
                    	}
                    }                
                    content +="</p></li>";           	
            						
                                
                    $(content).insertAfter($(".myproj-record-txt li:last"));
                }
            	}
            },
            error:function(){
                alert('出错了！')
            }
        })
    });
</script>
</html>