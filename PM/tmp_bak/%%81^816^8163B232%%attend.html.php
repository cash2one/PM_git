<?php /* Smarty version 2.6.26, created on 2013-03-12 09:56:18
         compiled from tool/attend.html */ ?>
<!DOCTYPE html>
<html lang="zh"> 
<head>
<meta charset="utf-8"/>
<title><?php echo @WebTitle; ?>
</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<link rel="shortcut icon" href="favicon.ico"/>
<link rel="stylesheet" href="themes/css/base.css?<?php echo @RD; ?>
" />
<link rel="stylesheet" href="themes/css/tool.css?<?php echo @RD; ?>
" />
<style>
	.timeSelect{}
	.timeSelect li{float:left;height:30px;line-height:30px;padding-right:10px;}
</style>
<script src="themes/js/jquery.last.js?<?php echo @RD; ?>
"></script>
<script src="themes/js/html5.js?<?php echo @RD; ?>
"></script>
<script src="themes/js/comm.ui.js?<?php echo @RD; ?>
"></script>
</head>
<body>
<header>
	<nav class="PMS_topbar">
		应用:　<a>考勤备忘</a> | <a>PM.Push</a>
	</nav>
</header>
<article class="content">
	<h1 class="pageTitle">考勤备忘</h1>
	<section class="header"></section>
	<section class="boxstyle1 top">
		<ul class="timeSelect clearfix">
			<li>选择时间</li>
			<li><select name="year" id="year"><option value="" selected="selected"></option></select> 年</li>
			<li><select name="month" id="month"></select> 月</li>
			<li><input type="checkbox" id="isShowAll"> 查看全体</li>
			<li><input type="button" value="查询" onClick="check()" id="btnCheck" /></li>
		</ul>
	</section>
	<section class="boxstyle1 proj_gra" id="calendarWrap">
	</section>
	<section class="boxstyle2 bottom" id="attenData"></section>
	<section class="footer" id="footer"><p>暂定时间： <?php echo $this->_tpl_vars['lateTime']; ?>
 以后会弹出备忘窗口，并作为估计的参数。</p></section>
</article>
<div id="tips">
	<p></p>
	<p></p>
	<p></p>
</div>
<script type="text/javascript">
//初始化
	var lateTimeArr='<?php echo $this->_tpl_vars['lateTime']; ?>
'.split(':');
	var lateTimeNum=lateTimeArr[0]*60+parseInt(lateTimeArr[1]);
	var tips=$("#tips");
	var tipsType=tips.find("p:eq(0)");
	var tipsTime=tips.find("p:eq(1)");
	var tipsDes=tips.find("p:eq(2)");
	var typeName=["准时","准时","加班调休","请假","迟到","旷工"];
	var today;
	
	$.get("index.php?a=getnow",function(rs){
		//生成日期选项
		var date=rs.split('/');
		date[1]=parseInt(date[1],10);
		var _html='';
		for(var i=2012;i<date[0];i++){_html+='<option value="'+i+'">'+i+'</option>';}
		_html+='<option value="'+date[0]+'" selected="selected">'+date[0]+'</option>';
		$("#year").html(_html);
		_html='';
		for(var i=1;i<date[1];i++){_html+='<option value="'+i+'">'+i+'</option>';}
		_html+='<option value="'+date[1]+'" selected="selected">'+date[1]+'</option>';
		$("#month").html(_html);
		
		today=date[2];
	})
//开始查询
	function check()
	{
		$("#calendarWrap").html('');
		var year=$("#year").val();
		var month=$("#month").val();
		var isShowAll=$("#isShowAll").attr("checked")==true?1:0;
		var lateCount=0;//迟到次数
		var lateTimeCount=0;//迟到分钟数
		//生成日历
		var week=["日","一","二","三","四","五","六"];
		var counter=_$.dayCount(year,month);
		var calendarHtml='<li class="weekend"></li><li class="weekend"></li>';
		calendarHtml+='<li class="separate"><span>'+year+"-"+month+'</span></li>';
		var dataTemplate='';
		var userTemplate='';
		for(var j=1;j<counter+1;j++)
		{
			temClass="";
			temweek=new Date(year+'/'+month+'/'+j).getDay();
			if(j==1) temClass="newMonth";
			if(temweek==0||temweek==6) temClass="weekend";
			calendarHtml+='<li class="'+temClass+'">'+j+'<br/>'+week[temweek]+'</li>';
			dataTemplate+='<li class="'+temClass+' hasdata" time="没有记录" des=" " types=" "></li>';
		}
		for(var j=0;j<31-counter;j++){calendarHtml+='<li class="weekend"></li>';dataTemplate+='<li class="weekend" time="没有记录" des=" " types=" "></li>';}
		$("#calendarWrap").append('<ul id="datelist" class="calendar">'+calendarHtml+'</ul>');
		//读取数据
		$.getScript('index.php?c=toolAtten&a=show&year='+year+'&month='+month+'&isall='+isShowAll,function(rs)
		{
			if(typeof userlist=='undefined') alert('读取数据失败。');
			var userLateCount=Array();
			var userLateTimeCount=Array();
			var userCount=userlist.length;
			var attenlistCount=attenlist.length;
			var _temTime;
			for(var i=0;i<userCount;i++)
			{
				userTemplate+='<ul id="user_'+userlist[i].user_id+'" class="calendar user"><li class="username" uid="'+userlist[i].user_id+'">'+userlist[i].user_name+'</li>'+dataTemplate+'</ul>';
				userLateCount[userlist[i].user_id]=0;
				userLateTimeCount[userlist[i].user_id]=0;
			}
			$("#calendarWrap").append(userTemplate);
			for(var i=0;i<attenlistCount;i++)
			{
				if(attenlist[i].describes==null) attenlist[i].describes='';
				$("#user_"+attenlist[i].user_id+" li").eq(attenlist[i].day).attr("time",attenlist[i].rtime).attr("des",attenlist[i].describes).attr("types",typeName[attenlist[i].type]).addClass("type_"+attenlist[i].type);
				//对迟到的数据统计
				if(attenlist[i].type==4)
				{
					//总体数据
					lateCount++;
					_temTime=(attenlist[i].rtime).split(" ");
					_temTime=_temTime[1].split(":");
					_temTime=parseInt(_temTime[0]*60)+parseInt(_temTime[1])-lateTimeNum;
					lateTimeCount+=_temTime;
					//个人数据
					userLateCount[attenlist[i].user_id]++;
					userLateTimeCount[attenlist[i].user_id]+=_temTime;
				}
			}
			$(".user .hasdata").hover(
				function(e)
				{
					tipsType.html($(this).attr("types"))
					tipsTime.html($(this).attr("time"));
					tipsDes.html($(this).attr("des"));
            		var posx = e.clientX + document.documentElement.scrollLeft + document.body.scrollLeft;
            		var posy = e.clientY + document.documentElement.scrollTop + document.body.scrollTop;
					tips.stop(true,true).css({'top':posy+5,'left':posx+10}).show('fast');
				},
				function(){tips.stop(true,true).hide();}
			);
			$(".user .username").hover(
				function(e)
				{
					var uid=$(this).attr("uid");
					tipsType.html('迟到天数：'+userLateCount[uid]);
					tipsTime.html('迟到分钟：'+userLateTimeCount[uid]);
            		var posx = e.clientX + document.documentElement.scrollLeft + document.body.scrollLeft;
            		var posy = e.clientY + document.documentElement.scrollTop + document.body.scrollTop;
					tips.stop(true,true).css({'top':posy+5,'left':posx+10}).show('fast');
				},
				function(){tips.stop(true,true).hide();}
			);
			
			//输出统计
			$("#attenData").html('').append('<span>估计数据：</span>')
						.append('<span>迟到次数：'+lateCount+'</span> | ')
						.append('<span>人均迟到次数：'+parseInt(lateCount/userCount)+'</span> | ')
						.append('<span>迟到分钟：'+lateTimeCount+'</span> | ')
						.append('<span>人均迟到分钟：'+parseInt(lateTimeCount/userCount)+'</span>');
		});
	}
</script>
</body>
</html>