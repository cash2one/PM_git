<?php /* Smarty version 2.6.26, created on 2013-04-15 14:45:50
         compiled from user/work.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'user/work.html', 137, false),)), $this); ?>
<!DOCTYPE html>
<html lang="zh"> 
<head>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/base.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script src="themes/js/jquery-ui.last.js"></script>
<style type="text/css">
	.boxstyle2{background:#ffffff;position:relative}
	.content section{padding:0}
	.slideWrap{width:2000px;position:relative}
	.left{position:relative;width:960px;float:left}
	
	.right{position:relative;width:960px;float:left}
	#btnBack {float: right;margin-top: 3px;display:none}
	
	.roleList{border-right:1px dotted #CCCCCC;width:780px;}
	.roleList li{border-bottom:1px dotted #CCCCCC;padding:10px 0}
	.roleList dl{position:relative;margin-left:140px;}
	.roleList dt{position:absolute;left:-120px;top:20px;width:82px;height:30px;padding-top:80px;text-align:center;font-family:"Microsoft YaHei", "SimHei";cursor:pointer}
	.roleList dd{float:left;width:68px;height:120px;margin:20px 12px 0 0;_display:inline;position:relative;background:url(themes/images/userface/nopic.png) no-repeat}
	.roleList dd p{text-align:center;position:absolute;top:0;left:0;width:100%;height:20px;padding-top:100px;cursor:pointer;*background:url(themes/images/blank.gif)}
	.roleList dd p.selected{background:url(themes/images/faceSelected.png) no-repeat;color:#3478FF}
	.roleList .role_1 dt{background:url(themes/images/role_1.png) center top no-repeat}
	.roleList .role_2 dt,.roleList .role_6 dt,.roleList .role_7 dt{background:url(themes/images/role_2.png) center top no-repeat}
	.roleList .role_3 dt{background:url(themes/images/role_3.png) center top no-repeat}
	.numcounter{width:138px;height:146px;background:url(themes/images/btn_workCheck.png);top:50%;margin-top:-73px;right:20px;position:absolute;cursor:pointer;display:block}
	.numcounter:hover{background:url(themes/images/btn_workCheck.png) 0 -138px;}
	.numcounter span{color: #FFFFFF;font-family: "Microsoft YaHei","SimHei";font-size: 20px;height: 30px;position: absolute;right: 13px;text-align: center;top: 13px;width: 32px;}
	
	/*calendar*/
	#calendarG{margin-top:20px}
	#calendarG p.line{display:block;width:100%;background:#EEEEEE;height:10px;line-height:10px;font-size:0;border-top:#999999 1px dotted;border-bottom:#999999 1px dotted;margin-bottom:10px}
	 .group{position:relative;min-height:120px;_height:120px}
	 .group .face{width:68px;height:120px;position:absolute;top:0;left:0;z-index:101;padding:10px;background:url(themes/images/userface/nopic.png) no-repeat 10px 10px #FFFFFF}
	 .group .face p{text-align:center;position:absolute;top:0;left:0;width:100%;height:20px;padding-top:100px;cursor:pointer;background:url(themes/images/faceDel.png) no-repeat 10px 10px;}
	 .group .short_pnod{display:none}
	 
	#calendarG .simple{height:30px;min-height:30px;}
	#calendarG .simple .short_pnod{background:#5EC9FF;position:absolute;top:0;height:22px;filter:alpha(opacity=20);-moz-opacity:0.2;-khtml-opacity: 0.2;opacity: 0.2;margin-top:0;padding-left:2px;z-index:2;display:none}
	#calendarG .simple .pnod{}
	#calendarG .simple .face{height:20px;}
	#calendarG .simple .face img{display:none}
	#calendarG .simple .face p{padding-top:0;background:#8BC4F9;}
	 
	#calendarG .taskbar_wrap .pnod{}
</style>
</head>
<body class="manage work">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<article class="content">

<h1>组员工作</h1>
<section class="boxstyle1 header small">
全部成员列表
<a class="btns btns_back" id="btnBack">返回</a>
</section>
<section class="boxstyle2 clearfix">

	<div class="slideWrap" id="slideWrap">
	
	<div class="left">
		<ul class="roleList" id="roleList">
			<li class="role_1 clearfix">
				<dl id="role1">
				<dt>编辑</dt>
				</dl>
			</li>	
			<li class="role_2 clearfix">
				<dl id="role2">
				<dt>设计</dt>
				</dl>
			</li>
			<li class="role_3 clearfix">
				<dl id="role3">
				<dt>前端</dt>
				</dl>
			</li>
			
			<li class="role_6 clearfix">
				<dl id="role6">
					<dt>动画</dt>
				</dl>
			</li>
			
			<li class="role_7 clearfix" style="border-bottom:none">
				<dl id="role7">
					<dt>移动</dt>
				</dl>
			</li>
		</ul>
		
		<a class="numcounter" id="btnGo" href="#">
			<span id="selectedCount">0</span>
		</a>
	</div>
	
	<div class="right">
		<div id="calendarG"></div>
	</div>
	
	</div>
	
</section>

<section class="boxstyle1 footer small" style="padding:0"></section>

</article>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript">
var btnBack=$('#btnBack');
btnBack.click(function(){$('#slideWrap').animate({left:'0'},500);btnBack.hide()})
$('#btnViewType').toggle(
function(){$('#calendarG .group').removeClass('simple');},
function(){$('#calendarG .group').addClass('simple');})
function reLocationFace(){$('#calendarG_calendar_wrap .face').css('left',-parseInt($('#calendarG_calendar_wrap').css('left'))+'px');}
function removeUser(userId){$("#userline_"+userId).remove();$("#calendarG_group_"+userId).remove()}

function pass_pnod(pnod_id,state)
{
	var postData={"score":$("#node-score").val(),"comment":$("#node-comment").val(),"pnod_id":pnod_id,"state":state};
	var url="index.php?c=pnode&a=setState";
	$.post(url,postData,function(msg)
	{
		if(msg.rs==200)
		{
			alert('操作成功！');
			$("#pnod-row-id-"+pnod_id).find(".title-short").removeClass("rowcolor17").addClass("rowcolor"+state);
			_$.closewin('#pnod_details_box');
		}
		else
		{
			alert(msg.des);
		}
	},"json");
}

$.getJSON("<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'user','a' => 'getUserJson'), $this);?>
",function(user_list){
	var selectedCount=0;
	var html=Array("","","","","","","","");
	var temhtml='<dd><img src="themes/images/userface/userface_{@user_id}.jpg" alt="" width="65" height="90"><p rel="{@user_id}">{@user_name}</p></dd>';
	for(var i=0;i<user_list.length;i++)
	{
		//alert(temhtml.replace(/{@user_id}/g,user_list[i].user_id).replace(/{@user_name}/g,user_list[i].user_name));
		if(user_list[i].role_id==1||user_list[i].role_id==4||user_list[i].role_id==5) html[1]+=temhtml.replace(/{@user_id}/g,user_list[i].user_id).replace(/{@user_name}/g,user_list[i].user_name);
		else if(user_list[i].role_id==2) html[2]+=temhtml.replace(/{@user_id}/g,user_list[i].user_id).replace(/{@user_name}/g,user_list[i].user_name);
		else if(user_list[i].role_id==3) html[3]+=temhtml.replace(/{@user_id}/g,user_list[i].user_id).replace(/{@user_name}/g,user_list[i].user_name);
		else if(user_list[i].role_id==6) html[6]+=temhtml.replace(/{@user_id}/g,user_list[i].user_id).replace(/{@user_name}/g,user_list[i].user_name);
		else if(user_list[i].role_id==7) html[7]+=temhtml.replace(/{@user_id}/g,user_list[i].user_id).replace(/{@user_name}/g,user_list[i].user_name);
		else html[4]+=temhtml.replace(/{@user_id}/g,user_list[i].user_id).replace(/{@user_name}/g,user_list[i].user_name);
	}
	
	for(var i=1;i<html.length;i++)
	{
		$("#role"+i).append(html[i]);
	}
	
	//角色分类点击
	$('#roleList dt').click(function(){
		var nodes=$(this).parent().find('p');
		var nodesSelected=$(this).parent().find('p.selected');
		var diff=nodes.length-nodesSelected.length;
		if(diff==0){nodes.removeClass('selected');selectedCount-=nodes.length;}
		else{nodes.addClass('selected');selectedCount+=diff;}
		$('#selectedCount').html(selectedCount);
		
	})
	
	
	//个人点击
	$('#roleList dd p').click(function(){
		if($(this).attr('class')!="selected"){$(this).addClass('selected');selectedCount++;$('#selectedCount').html(selectedCount)}
		else{$(this).removeClass("selected");selectedCount--;$('#selectedCount').html(selectedCount)}
	})
	
	
	$('#btnGo').click(function(){
		var userId;
		var element=$('#roleList p.selected');
		if(element.length==0) {alert("选好人无呢？");return}
		else if(element.length==1) userId=$('#roleList p.selected:eq(0)').attr('rel');
		else
		{
			userId="";
			$.each(element,function(i,n){
				i==(element.length-1)?userId+=$(n).attr('rel'):userId+=$(n).attr('rel')+",";
				//alert($(n).attr('rel'));
			})
		}
		//alert(userId);
		var htmlUserGroupStart='<p class="line" id="userline_{@userId}"></p><div id="calendarG_group_{@userId}" class="group"><div class="face" onclick="removeUser({@userId})"><img src="themes/images/userface/userface_{@userId}.jpg" width="65" height="90"><p rel="{@userId}">{@user}</p></div>';
		PMS.loadCalendar("calendarG",{
			"userId":userId,
			"type":"work",
			"group":[[htmlUserGroupStart,'</div>',''],['{@PS}','{@PE}','{@NC}'],['','','{@NC}']],
			"onload":function(){
				btnBack.show();
				reLocationFace();
				$('#calendarG_calendar_wrap .face').click(function(){$(this)})
				$('#slideWrap').animate({left:'-960px'},500);},
			"ondrop":function(){reLocationFace();}
			})
	})

	})
</script>
</body>
</html>