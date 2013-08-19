// JavaScript Document

var _$=function(obj){return document.getElementById(obj)}

	/**
	* addcss
	* 添加链接样式表
	* @src {string} 地址
	**/
	_$.addcss=function(src,param)
	{
		var fileref=document.createElement("link");
		var id=_$.getPara(param,"id",null);
		fileref.setAttribute("rel", "stylesheet");
		fileref.setAttribute("type", "text/css");
		fileref.setAttribute("href", src);
		if(id!=null) fileref.setAttribute("id", id);
		if(!document.getElementById(id)) document.getElementsByTagName("head")[0].appendChild(fileref);
	};
	
	_$.getPara=function(params,val,defaultVal){return (typeof params!="undefined" &&typeof params[val]!="undefined")?params[val]:defaultVal;};

	_$.run=function(para,fn)
	{
		var fn=_$.getPara(para,fn,null);
		if($.isFunction(fn))
			fn();
	};
	
	_$.setValue=function(jqueryObj,value)
	{
		if(jqueryObj.attr("tagName").toLowerCase()=="input")
			jqueryObj.val(value);
		else
			jqueryObj.html(value);
	};
	
 	 _$.htmlEnCode=function(str)  
   	{  
         var    s    =    "";  
         if    (str.length    ==    0)    return    "";  
         s    =    str.replace(/&/g,    "&gt;");  
         s    =    s.replace(/</g,        "&lt;");  
         s    =    s.replace(/>/g,        "&gt;");  
         s    =    s.replace(/    /g,        "&nbsp;");  
         s    =    s.replace(/\'/g,      "'");  
         s    =    s.replace(/\"/g,      "&quot;");  
         s    =    s.replace(/\n/g,      "<br>");  
         return    s;  
  	}  
	
   _$.htmlDeCode=function(str)  
   {  
         var    s    =    "";  
         if    (str.length    ==    0)    return    "";  
         s    =    str.replace(/&gt;/g,    "&");  
         s    =    s.replace(/&lt;/g,        "<");  
         s    =    s.replace(/&gt;/g,        ">");  
         s    =    s.replace(/&nbsp;/g,        "    ");  
         s    =    s.replace(/'/g,      "\'");  
         s    =    s.replace(/&quot;/g,      "\"");  
         s    =    s.replace(/<br>/g,      "\n");  
         return    s;  
   }   
	
	/**
	* _$.showwin
	* 显示窗口
	* @ e {string:jquery select} 窗口
	* @ isshowbg {bool} 是否显示半透明背景
	**/
	_$.showwin=function(e,isshowbg)
	{
		var obj=$(e);
		var th=getTH();
		var toppx=document.documentElement.scrollTop+document.body.scrollTop+($(window).height()-obj.height())/2;
		obj.css('top',toppx+'px').css('left','50%').css('margin-left',(-(obj.width()/2))+'px').css('z-index','1000').fadeIn('fast');
		if(isshowbg)
		{
			if(document.getElementById('popwin_bg')) $('#popwin_bg').css('height',th.h).css('z-index','999').show();	
			else
			{
				$('body').append('<div id="popwin_bg"></div>');
				$('#popwin_bg').css('height',th.h).css('z-index','999').show();			
			}
		}
	}
	

	_$.closewin=function(obj)
	{
		$(obj).fadeOut('fast');
		$('#popwin_bg').hide();
	}
	
	
var PMS=
{
	loadCss:function(name)
	{
		switch(name)
		{
			case "popwin":_$.addcss("themes/css/popwin.css",{"id":"popwin_style"});break;
			default:_$.addcss("themes/css/popwin.css",{"id":"popwin_style"});break;
		}
		
	},

	dropCalendar:function(canvasId,params)
	{
		var obj=$("#"+canvasId+"_calendar_wrap");
		var width=parseInt(obj.css('width'));
		var width_outer=parseInt($('#'+canvasId).css('width'));		
		var currentDayLeft=parseInt($("#"+canvasId+'_current_day').css('left'));
		var fn_ondrop=_$.getPara(params,"ondrop",false);
		
		function droped()
		{
			if(fn_ondrop) fn_ondrop();
		}
		
		if(width<width_outer||currentDayLeft<width_outer/2){obj.animate({left:'0px'},300,function(){droped()});}
		else if(width-currentDayLeft-width_outer/2>0) { obj.animate({left:-(currentDayLeft-width_outer/2)+'px'},300,function(){droped()});}
		else{obj.animate({left:-(width-width_outer)+'px'},300,function(){droped()});}

		obj.draggable({
						axis: 'x',
						cursor: 'move',
						stop:function()
						{
										var leftInt=parseInt($(this).css('left'));

										if(width<width_outer)
										{
											$(this).animate({left:'0px'},300,function(){droped()});
										}
										else
										{
											if(leftInt>0)
											{
												$(this).animate({left:'0px'},300,function(){droped()});
											}
																
											if(leftInt+width-width_outer<0)
											{
												$(this).animate({left:-(width-width_outer)+'px'},300,function(){droped()});
											}
										}
											droped();
						}
				})
	},
	/**
	* loadCalendar
	* 读取日历
	* @ canvasId [string] 容器ID
	* @ params [json] 其它参数
		@ projId [int] 项目id
		@ userId [int] 用户id
		@ wrapId [int] 项目集id
		@ type [string] 请求类型 'node'(默认),'project'
		@ ws {int} 是否请求项目集 0(默认),1
		@ ps {int} 是否请求项目节点 0(默认),1
		@ groupBy [string] 分组显示根据的键值，同一组的数据必须连续，否则相同健值会被分裂到不同组
		@ groupStart [string] 分组的开始html 有默认
		@ groupEnd [string] 分组结束的html 有默认
		@ onload [function] 读取完时执行的函数
		@ ondrop {function} 拖动日历松开时执行的函数
	**/
	loadCalendar:function(canvasId,params)
	{
		var dayWidth=29;
		var wrap=$("#"+canvasId);
		var projId=_$.getPara(params,'projId','');
		var userId=_$.getPara(params,'userId','');
		var wrapId=_$.getPara(params,'wrapId','');
		var type=_$.getPara(params,'type','node');
		var showWrapSection=_$.getPara(params,'ws',0);
		var showProjSection=_$.getPara(params,'ps',0);
		var groupStart=_$.getPara(params,'groupStart','<div id="'+canvasId+'_group_{@groupId}" class="group">');
		var groupEnd=_$.getPara(params,'groupEnd','</div>');
		var groupBy=_$.getPara(params,'groupBy',false);
		var fn_onload=_$.getPara(params,'onload',false);
		var url='index.php?c=calendar&projId='+projId+'&userId='+userId+'&wrapId='+wrapId+'&type='+type+'&showWrapSection='+showWrapSection+'&showProjSection='+showProjSection;
		var html='<div id="{@canvasId}_calendar_wrap" class="calendar_wrap" style="width:{@wrapWidth}px;"><ul id="{@canvasId}_calendar" class="calendar"></ul><div class="taskbar_wrap" id="{@canvasId}_taskbar_wrap"></div><div style="left:{@crrentLeft}px" id="{@canvasId}_current_day" class="current_day"></div></div>';
		var nodeHtml;
		if(type=='node')
			nodeHtml='<a onclick="PMS.showNode({@nodeId})" style="width:{@widthFinal}px;margin-left:{@left}px;" class="pnod"><div class="tips"><span style="min-width:{@widthEnd}px;" class="tips-inner">{@title} by {@user}【{@stateName}】</span></div><span style="width:{@widthEnd}px;" class="title-short rowcolor{@state}">{@title} by {@user}【{@stateName}】</span></a>';
		else
			nodeHtml='<a href="index.php?c=project_bll&a=project_show&id={@nodeId}" style="width:{@widthFinal}px;margin-left:{@left}px;" class="pnod"><div class="tips"><span style="min-width:{@widthEnd}px;" class="tips-inner">{@title} by {@user}【{@stateName}】</span></div><span style="width:{@widthEnd}px;" class="title-short rowcolor{@state}">{@title} by {@user}【{@stateName}】</span></a>';
		var sectionHtml='<a style="left:{@left}px;" class="wnod_item"><span class="wnod_name">{@title}</span></a>';
		nodeHtml=_$.getPara(params,'nodeHtml',nodeHtml);
		var calendarHtml='';
		var week=["日","一","二","三","四","五","六"];
		
		//取得某个月的天数
		function dayCount(year,month)
		{
			var monthDay=new Array(31,28,31,30,31,30,31,31,30,31,30,31);
			if(year%400==0||(year%4==0&&year%100!=0))
			{
				monthDay[1]= 29;
			} 
			return monthDay[month];
		}
		//取得两个日期相差的天数
		function getDiffDy(d1,d2,params)
		{
			var isAbs=_$.getPara(params,'isAbs',true);
			//alert(d1+" - "+d2);
			var date1=new Date(d1);
			var date2=new Date(d2);
			var diff=date1.getTime()-date2.getTime();
			if(isAbs) return Math.abs(Math.floor(diff/(24*3600*1000)));
			else  return Math.floor(diff/(24*3600*1000));
		}
		//将 yyyy-mm-dd 的格式换为 yyyy/mm/dd 的格式，用于创建Date('yyyy/mm/dd')
		function formatDate(d)
		{
			var reg=/\d{4}-\d{1,2}-\d{1,2}/;
			var date=reg.exec(d);
			date=(date+"").replace(/\-/ig,'/');
			return date;
		}
		/**
		 * @ 取得最小和最大时间
		 * @ array [array[json]]输入数组
		**/
		function getMMDate(array)
		{
			var rss={s:"",e:""};
			for(var i=0;i<array.length;i++)
			{
				if(array[i])
				{
					for(var j=0;j<array[i].length;j++)
					{
						if(array[i][j].start!='0000-00-00 00:00:00'&&array[i][j].start!=""&&array[i][j].start!=null&&array[i][j].start!=undefined)
						{
							if(rss.s=="") rss.s=array[i][j].start;
							else if(rss.s>array[i][j].start) rss.s=array[i][j].start;
						}
						if(array[i][j].end!='0000-00-00 00:00:00'&&array[i][j].end!=""&&array[i][j].end!=null&&array[i][j].end!=undefined)
						{
							if(rss.e=="") rss.e=array[i][j].end;
							else if(rss.e<array[i][j].end) rss.e=array[i][j].end;
						}
					}
				}
			}
			return rss;
		}
		
		function replaceHTml(html,json)
		{
			if(!json.title) json.left="-9999px;display:none;";
			return html.replace(/{@title}/g,json.title).replace(/{@nodeId}/g,json.nodeId).replace(/{@user}/g,json.user).replace(/{@state}/g,json.state).replace(/{@widthEnd}/g,json.widthEnd-2).replace(/{@widthFinal}/g,json.widthFinal-2).replace(/{@left}/g,json.left).replace(/{@groupId}/g,json.groupId).replace(/{@userId}/g,json.userId).replace(/{@stateName}/g,json.stateName);
		}
		/**
		 * 取得视图html
		 * @ array [array[json]] 流程类数组[{"nodeId":"1","title":"流程名","state":"状态","user":"负责人","start":"2011-08-10 00:00:00","end":"2011-08-24 00:00:00"}]
		 * @ nodeHtml [string] 对应模板
		 * @ groupBy [string] 以哪个内容作为分组
		 * @ groupStart [string] 分组开始html模板
		 * @ groupEnd [string] 分组结束html模板
		 * @ array2 [array[json]] 节点类数组[{"nodeId":"1","title":"流程名","state":"状态","start":"2011-08-10 00:00:00"}]，不显示请传入false
		 * @ sectionHtml [string] 对应模板
		**/
		function getFormatedTask(array,nodeHtml,groupBy,groupStart,groupEnd,array2,sectionHtml)
		{
			var rs={"min":false,"max":false,"nodesHtml":"","sectionsHtml":""};
			var widthEnd=0;
			var widthFinal=0
			var left=0;
			var leftYear=0;
			var leftMonth=0;
			var isNewGroup;
			var groups=Array();
			if(!array)  return false;
			var MMDate=getMMDate([array,array2]);
			rs.min=MMDate.s;
			rs.max=MMDate.e;
			//alert(rs.min);
			//如经上面两个循环，仍找不出跨度值，则跨度值为当前日期
			if(rs.min=="") rs.min=dateCurrent;
			if(rs.max=="") rs.min=dateCurrent;
			rs.min=new Date(formatDate(rs.min));
			rs.max=new Date(formatDate(rs.max));
			leftYear=(rs.min).getFullYear();
			leftMonth=(rs.min).getMonth()+1;
			
			//生成节点html
			if(array2)
			{
				for(var i=0;i<array2.length;i++)
				{
						array2[i].left=getDiffDy(formatDate(array2[i].start),leftYear+'/'+leftMonth+'/1')*dayWidth;
						rs.sectionsHtml+=replaceHTml(sectionHtml,array2[i]);
				}
			}
			
			//生成流程条html
			for(var i=0;i<array.length;i++)
			{
				array[i].left=getDiffDy(formatDate(array[i].start),leftYear+'/'+leftMonth+'/1');
				array[i].widthEnd=getDiffDy(formatDate(array[i].start),formatDate(array[i].end))+1;
				
				if(array[i].final) array[i].widthFinal=getDiffDy(formatDate(array[i].start),formatDate(array[i].final))+1;
				else array[i].widthFinal=getDiffDy(formatDate(dateCurrent),formatDate(array[i].start),{"isAbs":false})+1;
				
				if(array[i].widthEnd) array[i].widthEnd*=dayWidth; else array[i].widthEnd=dayWidth;
				if(array[i].widthFinal&&array[i].widthFinal>1)array[i].widthFinal*=dayWidth; else array[i].widthFinal=array[i].widthEnd;
				
				if(array[i].left) array[i].left*=dayWidth; else array[i].left=0;
				//分类包裹
				if(groupBy!=false)
				{
					if(groups[array[i].userId]=='undefined') groups[array[i].userId]=replaceHTml(groupStart,array[i]);
					i==0?isNewGroup=true:eval("array["+i+"]."+groupBy)!=eval("array["+(i-1)+"]."+groupBy)?isNewGroup=true:isNewGroup=false;
					if(isNewGroup)
					{
						array[i].groupId=eval("array["+i+"]."+groupBy);
						rs.nodesHtml==""?rs.nodesHtml=replaceHTml(groupStart,array[i]):rs.nodesHtml+=groupEnd+replaceHTml(groupStart,array[i]);
					}
				}
				//alert(array[i].widthEnd);
				rs.nodesHtml+=replaceHTml(nodeHtml,array[i]);
			}
			if(groupBy!=false) rs.nodesHtml+=groupEnd;
			return rs;
		}
		
		//执行插入HTMl
		function appendHtml(eYM)
		{
			if(!eYM){wrap.append('<div class="calendarNull">木有流程</div>');return false};
			var yearCounter		=(eYM.min).getFullYear();
			var monCounter		=(eYM.min).getMonth();//alert((eYM.max).getMonth());
			var dayCounter=0;
			var temClass="";
			var temweek="";
			if(yearCounter<2010||yearCounter>2014){alert('年份低于超查询范围!');return}
			while(true)
			{
				//取得这个月有多少天
				var counter=dayCount(yearCounter,monCounter);
				dayCounter+=counter;
				calendarHtml+='<li class="separate"><span>'+yearCounter+"-"+(monCounter+1)+'</span></li>';
				for(var j=1;j<counter+1;j++)
				{
					temClass="";
					temweek=new Date(yearCounter+'/'+(monCounter+1)+'/'+j).getDay();
					if(j==1) temClass="newMonth";
					if(temweek==0||temweek==6) temClass="weekend";
					calendarHtml+='<li class="'+temClass+'">'+j+'<br/>'+week[temweek]+'</li>';
				}
				monCounter++;
				if(monCounter==12){monCounter=0;yearCounter++}
				if(getDiffDy(eYM.max,yearCounter+'/'+monCounter+'/1',{'isAbs':false})<28||!getDiffDy(eYM.max,yearCounter+'/'+monCounter+'/1',{'isAbs':false})) break;
				if(yearCounter>2013){alert('loop final....');break;}
			}
			wrap.html('');
			wrap.append(html.replace(/{@canvasId}/g,canvasId).replace(/{@wrapWidth}/,dayCounter*dayWidth+1).replace(/{@crrentLeft}/,getDiffDy(formatDate(dateCurrent),(eYM.min).getFullYear()+'/'+((eYM.min).getMonth()+1)+'/1')*dayWidth));
			$('#'+canvasId+'_calendar').append(calendarHtml);
			if(eYM.sectionsHtml) 
			{
				$('#'+canvasId+'_taskbar_wrap').append('<div id="'+canvasId+'_sections" class="calendar_Sections"></div>');
				$('#'+canvasId+'_sections').append(eYM.sectionsHtml);
			}
			$('#'+canvasId+'_taskbar_wrap').append(eYM.nodesHtml);
			if(fn_onload) fn_onload();
			PMS.dropCalendar(canvasId,{'ondrop':_$.getPara(params,"ondrop",null)});
		}
		
		//执行
		//alert(url);
		_$.addcss("themes/css/calendar.css",{"id":"calendar_style"});
		wrap.addClass('projectGra');
		


		$.getScript(url,function(){
			if(showWrapSection) appendHtml(getFormatedTask(nodes,nodeHtml,groupBy,groupStart,groupEnd,wrapSections,sectionHtml));
			else if(showProjSection) appendHtml(getFormatedTask(nodes,nodeHtml,groupBy,groupStart,groupEnd,projectSections,sectionHtml));
			else appendHtml(getFormatedTask(nodes,nodeHtml,groupBy,groupStart,groupEnd));
		});

	},
	
	
	
	/**
	* date
	* 日期显示相关
	* ->create{fn} 创建日历
	**/
	date:
	{	
		create:function(objid,type,selectedValue,para)
		{
			var _i;
			var html="";
			var tem;
			if(!document.getElementById(objid))
				return false;
			var obj=document.getElementById(objid);
			obj.innerHTML="";
			switch(type)
			{
				case "year":_i=2000;end=2013;break;
				case "month":_i=1;end=13;break;
				case "month_o":_i=1;end=13;var month_old=Array("null","一","二","三","四","五","六","七","八","九","十","十一","十二");break;				
				case "day":_i=1;end=32;break;
				case "day_o":_i=1;end=32;var day_old=Array("null","初一","初二","初三","初四","初五","初六","初七","初八","初九","初十","十一","十二","十三","十四","十五","十六","十七","十八","初九","廿十","廿一","廿二","廿三","廿四","廿五","廿六","廿七","廿八","廿九","三十","三十一");break;
			}

			for(var i=_i;i<end;i++)
			{
				if(type=="day_o") tem=day_old[i];
				else if(type=="month_o") tem=month_old[i];
				else tem=i;
				obj.options.add((new Option(tem,i)));
				if(i==parseInt(selectedValue))
					obj.options[i-1].selected=true;
			}
		}
	},
	
	
	/**
	*showSelectList
	* 选择弹出层
	* @ type{string} 类别｛product:产品｝
	* @ inputid_id{string} 放id值的元素id
	* @ inputid_name{string} 放文本值的元素id
	* @ param{json} 其它可选参数
			@ e {event}
			@ autoBind {bool} 是否自动绑定onclick显示 default:true;
			@ reload {bool} 是否每次点击都重新读取数据 default:false
			@ prod_id {int} for wraps
			@ type {string} for pState{"public":公共} default:"";
	**/
	showSelectList:function(type,inputid_id,inputid_name,param)
	{
		if(_$.getPara(param,"autoBind",true)==false) even(param.e);
		else $('#'+inputid_name).click(function(ev){ismouseover=true;even(ev)});
		function even(ev)
		{
			$('.popwin').hide();
			if(!_$(type+'_popwin'))
			{
				PMS.loadCss();
				var html='<div id="'+type+'_popwin" class="popwin"></div>';
				$('body').append(html);
				var popwin=$('#'+type+'_popwin');
				toload(type,popwin,ev);
			}
			else
			{
				var popwin=$('#'+type+'_popwin');
				//if(popwin.css("display")=="block") {popwin.fadeOut("fast");return;}
				if(_$.getPara(param,"reload",false)==true) toload(type,popwin,ev);
				$('#inputid_'+type+'_id').val(inputid_id);
				$('#inputid_'+type+'_name').val(inputid_name);
				relocation(popwin,ev);
			}
		}
		
		function toload(type,obj,ev)
		{
			var url="index.php?c=popwin&a="+type+"&prod_id="+_$.getPara(param,"prod_id",0)+"&type="+_$.getPara(param,"type","");
			//alert(url);
			obj.load(url,function(){$('#inputid_'+type+'_id').val(inputid_id);$('#inputid_'+type+'_name').val(inputid_name);});
			relocation(obj,ev);
		}
		
		function relocation(obj,ev)
		{
			var posx = 0;posy = 0;
	        e = ev || window.event;
	        if (e.pageX || e.pageY) {
	            posx = e.pageX;
	            posy = e.pageY;
	        } else if (e.clientX || e.clientY) {
	            posx = e.clientX + document.documentElement.scrollLeft + document.body.scrollLeft;
	            posy = e.clientY + document.documentElement.scrollTop + document.body.scrollTop;
	        };
			obj.css('top',posy+10).css('left',posx);
			obj.fadeIn("fast");	
		}
	},
	
	
	
	/**
	*selected
	* 弹出层被选择后激发的事件
	* @type{string} 类别｛product:产品｝
	* @inputid_id{string} 放id值的元素id
	* @inputid_name{string} 放文本值的元素id
	**/
	selected:function(type,prod_id,prod_name)
	{
		$('#'+$('#inputid_'+type+'_id').val()).val(prod_id);
		var iName=$('#'+$('#inputid_'+type+'_name').val());
		_$.setValue(iName,prod_name);
		$('#'+type+'_popwin').fadeOut("fast");
	},
	
	
	
	/**
	* rowEditorCreate
	* {用于创建用于批量添加中，行数的增删，并在提交序列号表单tagName,比如title{@Num},全部序列化为title1,title2,title3....以便后端程序接收。}
	* {id则用{@numTem},用于动态处理，跟提交到后端程序的命名无关,name用{@num}}
	* {如果主体id值为pnod:则每行id值为pnod_row_{@numTem}|pnod_rowAddBtn|_rowDelBtn_{@numTem}}
	* @ id {string} 区域所有控件id前缀,和父层id
	* @ eachrow {string->JQuery seletor} 每行重复区域
	* @ add_id  {string->JQuery seletor} 新增一行的按钮id值
	* @ del_id  {string} 删除按钮的id值前缀（每一行一个删除按钮）
	* @ params {json} 可选参数：
			@ form {string} 表单id值,赋值后会在表单提交前执行序列化表单内容。
			@ submit {string->JQuery seletor} 提交按钮,赋值后会在按钮点击后序列化表单内容。这个参数会覆盖form参数的作用。
			@ added {function(n)} 添加一行后触发执行的函数，传入一个行号值。
			@ setNumed {function} 序列号完毕后提交前执行的函数。
			@ check {bool} 是否使用Validator验证表单，默认为true。
	**/	
	rowEditorCreate:function(id,eachrow,params)
	{
		var numTem=1;
		var rowId=id+"_row_";
		var delId=id+"_rowDelBtn_";
		var addId=id+"_rowAddBtn";
		var rowCounter=id+"_rowCounter";
		var temHtml="";
		var wrap=$("#"+id);
		var form=_$.getPara(params,"form",null);
		var btn_submit=_$.getPara(params,"submit",null);
		var check=_$.getPara(params,"check",true);
		var fn_setNumed=_$.getPara(params,"setNumed",null);
		var fn_added=_$.getPara(params,"added",null);

		//读取并清空模板
		if(wrap.attr("tagName").toLowerCase()=="table") temHtml=wrap.find("tbody:eq(0)").html();
		else temHtml=wrap.html();
		wrap.html("");
		
		$("#"+addId).click(function(){
			var n=numTem;
			wrap.append(temHtml.replace(/{@numTem}/g,numTem));
			$('#'+delId+numTem).click(function(){$('#'+rowId+n).remove()});
			if(fn_added!=null){fn_added(numTem);}
			numTem++;});

		if(btn_submit!=null) {$(btn_submit).click(function(){setNum()});}
		else if(form!=null){$('#'+form).submit(function(){return setNum();})}
		function setNum()
		{
			if(check)
			{
				if(!Validator.Validate(document.getElementById(form),2)) return false;
			}
			var rowCount=$(eachrow).length;
			if(_$(rowCounter)) {$("#"+rowCounter).val(rowCount);};
			
			for(var i=0;i<rowCount;i++)
			{
				$.each($(eachrow+":eq("+i+") input"),function(){$(this).attr("name",$(this).attr("name").replace(/{@num}/g,i));$(this).attr("id",$(this).attr("id").replace(/{@num}/g,i));});
				$.each($(eachrow+":eq("+i+") textarea"),function(){$(this).attr("name",$(this).attr("name").replace(/{@num}/g,i));$(this).attr("id",$(this).attr("id").replace(/{@num}/g,i));});
				$.each($(eachrow+":eq("+i+") select"),function(){$(this).attr("name",$(this).attr("name").replace(/{@num}/g,i));$(this).attr("id",$(this).attr("id").replace(/{@num}/g,i));});
			}
			if(fn_setNumed!=null){fn_setNumed();}
			return true;
		}
	},
	
	/**
	* rowEditorEdit
	* {用于编辑行}
	* {id则用{@numTem},}
	* {如果主体id值为pnod:则每行id值为pnod_row_{@numTem}|pnod_add_{@numTem}....}
	* @ id {string} 区域所有控件id前缀,和父层id
	* @ eachrow {string->JQuery seletor} 每行重复区域
	* @ params {json} 可选参数：
			@ addRow {function(n)} 添加一行后触发执行的函数，传入一个行号值。
			@ initData {string[[]]} 初始化数据。[[id,是否可以删除(0|1),是否可以编辑(0|1),值1,值2,值3...],[......]]
			@ editSave {function(n)} 保存行时执行的函数。
			@ addSave {function(n)} 新增一行，并保存后，执行的函数。
			@ rowDel {function(n)} 删除按钮事件。
	**/	
	rowEditorEdit:function(id,eachrow,params)
	{
		var numTem=1;
		var rowId=id+"_row_";
		var rowSaveId=id+"_rowSaveBtn_";
		var delId=id+"_rowDelBtn_";
		var addId=id+"_rowAddBtn";
		var wrap=$("#"+id);
		var initData=_$.getPara(params,"initData",null);	
		var addRow_fn=_$.getPara(params,"addRow",null);
		var editSave_fn=_$.getPara(params,"editSave",null);	
		var addSave_fn=_$.getPara(params,"addSave",null);
		var rowDel_fn=_$.getPara(params,"rowDel",null);	
		var temHtml="";
		
		//读取并清空模板
		if(wrap.attr("tagName").toLowerCase()=="table") temHtml=wrap.find("tbody:eq(0)").html();
		else temHtml=wrap.html();
		wrap.html("");
		
		insertData(initData);
		
		$("#"+addId).click(function(){
			var n=numTem;
			wrap.append(temHtml.replace(/{@numTem}/g,numTem+"_tem"));
			$('#'+delId+numTem+"_tem").click(function(){$('#'+rowId+n+"_tem").remove()});
			if(addRow_fn!=null){addRow_fn(numTem+"_tem");}
			if(document.getElementById(rowSaveId+numTem+"_tem")) 
			{
				$("#"+rowSaveId+numTem+"_tem").click(function(){
					var rtData=addSave_fn(n+"_tem",id);
					if(rtData)
						insertData(rtData);
					})
			}
			numTem++;
			});		
		
		function insertData(json)
		{
			if(json!=null)
			{
				function bindEditSave(n){editSave_fn(n,id)};
				function bindDelRow(n){rowDel_fn(n,id)};
				for(var i=0;i<json.length;i++)
				{
					if(json[i]=="") break;
					var json2=json[i];
					wrap.append(temHtml.replace(/{@numTem}/g,json2[0]));
					var temrow=wrap.find("#"+rowId+json2[0]);
					
					//temrow.addClass("rowReadMode").click(function(e){var tem=e.target.id.split("_");if(tem[1]!="rowSaveBtn") $(this).removeClass("rowReadMode")});
					if(json2[2]==1){
						temrow.click(function(e){var tem=e.target.id.split("_");if(tem[1]!="rowSaveBtn") $(this).removeClass("rowReadMode")});
						addRow_fn(json2[0]);
					}
					else temrow.addClass("rowReadMode");
					
					if(editSave_fn!=null&&json2[2]==1) eval("$('#'+rowSaveId+"+json2[0]+").click(function(){bindEditSave("+json2[0]+");})");
					
						
					if(rowDel_fn!=null&&json2[1]==1) eval("$('#'+delId+"+json2[0]+").click(function(){bindDelRow("+json2[0]+");})");
					else eval("$('#'+delId+"+json2[0]+").remove()");
					
					for(var j=3;j<json2.length;j++)
					{
						if(temrow.find(".rowEditorInitdata").length==0) {alert('请将需要初始化的input设为class="rowEditorInitdata"');}
						_$.setValue(temrow.find(".rowEditorInitdata:eq("+(j-3)+")"),json2[j]);
					}
					
				}
			}
		}},
		
		
		
		
	/**
	* showNode
	* {显示流程信息}
	* {如果主体id值为pnod:则每行id值为pnod_row_{@numTem}|pnod_add_{@numTem}....}
	* @ id {string} 区域所有控件id前缀,和父层id
	* @ eachrow {string->JQuery seletor} 每行重复区域
	* @ params {json} 可选参数：
			@ addRow {function(n)} 添加一行后触发执行的函数，传入一个行号值。
			@ initData {string[]->json} 初始化数据。
			@ editSave {function(n)} 保存行时执行的函数。
			@ addSave {function(n)} 新增一行，并保存后，执行的函数。
			@ rowDel {function(n)} 删除按钮事件。
	**/	
	showNode:function(nodeId)
	{
		var url='index.php?c=project_bll&a=pnod_details&pnod_id='+nodeId;
		if(!document.getElementById('pnod_details_box'))
		{
			PMS.loadCss();
			var html='<div id="pnod_details_box" class="popwin"></div>';
			$('body').append(html);
			$('#pnod_details_box').load(url,function(){_$.showwin("#pnod_details_box");});
		}
		else
		{
			$('#pnod_details_box').load(url,function(){_$.showwin("#pnod_details_box");});
		}
	},
	
	
	/**
	* {显示delay行}
	* @ eachrow[string:jquerySelector]
	* @ target[string:jquerySelector]
	**/
	showDelay:function(eachrow,target)
	{
		$.get("index.php?a=getNow",function(data){
			var current=data;
			$.each($(eachrow),function(k,v)
			{
				;
			})
		})
	}
	

};

//返回页面的高度，和滚动到的高度
function getTH()
{
	var dHeight;//页面的高度
	var dtop;//滚动到的高度
	notIe = -[1,];  
	
	if(-[1,]){  
		// 标准浏览器代码  
		dHeight=document.documentElement.scrollHeight;
		dtop=document.documentElement.scrollTop+document.body.scrollTop;
		return {'h':dHeight,'t':dtop};
	}
	else
	{  
		// IE Only的代码  
		dHeight=document.body.scrollHeight
		dtop=document.documentElement.scrollTop;
		return {'h':dHeight,'t':dtop};
	}  
}



//弹出事件
function getEvent(even_id)
{
	var doc=getTH();
	
	if(document.getElementById('event_details'))
	{
		var url='index.php?c=event&a=show&even_id='+even_id;
		$('#event_details').css('top',doc.t+200+'px').load(url);
	}
	else
	{
		var html='<div id="event_details"></div>';
		var url='index.php?c=event&a=show&even_id='+even_id;
		$('body').append(html);
		$('#event_details').css('top',doc.t+200+'px').load(url);
	}
	$('#event_details').fadeIn('fast');
}

String.prototype.trim=function()
{
     return this.replace(/(^\s*)(\s*$)/g,'');
}
/**
* 删除左边的空格
*/
String.prototype.ltrim=function()
{
     return this.replace(/(^\s*)/g,'');
}
/**
* 删除右边的空格
*/
String.prototype.rtrim=function()
{
     return this.replace(/(\s*$)/g,'');
}



//用户列表
//key1 string 放user_id的元素id
//key2 string 放user_name的元素id
//selector json   筛选用户等其它条件
function showUserList(key1,key2,selector)
{
	var ht=getTH();
	if(selector==undefined)
		var url='index.php?c=user&a=list_ajax';
	else
		var url='index.php?c=user&a=list_ajax&role_id='+selector.role_id+'&user_power='+selector.user_power;
	if(!document.getElementById('user_box'))
	{
		var html='<div id="user_box"></div>';
		
		$('body').append(html);
		$('#user_box').load(url,function(){
											$('#ajax_user_key1').val(key1);
											$('#ajax_user_key2').val(key2);
											 });
	}
	else
	{
		$('#user_box').fadeIn();
		$('#ajax_user_key1').val(key1);
		$('#ajax_user_key2').val(key2);
	}
	$('#user_box').css('top',ht.t+100);
}

//选择用户后产生的事件，如需修改请在当页重写
function selectuser(user_id,user_name)
{
	$('#'+$('#ajax_user_key1').val()).val(user_id);
	$('#'+$('#ajax_user_key2').val()).val(user_name).html(user_name);
	$('#user_box').fadeOut();
}


//获得Cookie解码后的值
function getCookieVal(offset)
{
var endstr = document.cookie.indexOf (";", offset);
if (endstr == -1)
endstr = document.cookie.length;
return unescape(document.cookie.substring(offset, endstr));
}

 

//设定Cookie值
function setCookie(name, value)
{
var expdate = new Date();
var argv = setCookie.arguments;
var argc = setCookie.arguments.length;
var expires = (argc > 2) ? argv[2] : null;
var path = (argc > 3) ? argv[3] : null;
var domain = (argc > 4) ? argv[4] : null;
var secure = (argc > 5) ? argv[5] : false;
if(expires!=null) expdate.setTime(expdate.getTime() + ( expires * 1000 ));
document.cookie = name + "=" + escape (value) +((expires == null) ? "" : ("; expires="+ expdate.toGMTString()))
+((path == null) ? "" : ("; path=" + path)) +((domain == null) ? "" : ("; domain=" + domain))
+((secure == true) ? "; secure" : "");
}

 

//删除Cookie
function delCookie(name)
{
var exp = new Date();
exp.setTime (exp.getTime() - 1);
var cval = getCookie (name);
document.cookie = name + "=" + cval + "; expires="+ exp.toGMTString();
}

 

//获得Cookie的原始值
function getCookie(name)
{
var arg = name + "=";
var alen = arg.length;
var clen = document.cookie.length;
var i = 0;
while (i < clen)
{
var j = i + alen;
if (document.cookie.substring(i, j) == arg)
return getCookieVal (j);
i = document.cookie.indexOf(" ", i) + 1;
if (i == 0) break;
}
return null;
}


//节点状态设置
function pass_pnod(pnod_id,state)
{
	var url="index.php?c=project_bll&a=pnod_state&pnod_id="+pnod_id+"&state="+state;
	$.get(url,function(msg)
	{
		if(msg==1)
		{
			alert('操作成功！');
			location.reload();
		}
		else
		{
			alert('操作不成功！');
		}
	})
}
