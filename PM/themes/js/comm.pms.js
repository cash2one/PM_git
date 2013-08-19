var PMS=
{
	randum:Math.random(),
	loadCss:function(name)
	{
		switch(name)
		{
			case "popwin":_$.addcss("themes/css/popwin.css?cache="+PMS.randum,{"id":"popwin_style"});break;
			default:_$.addcss("themes/css/popwin.css?cache="+PMS.randum,{"id":"popwin_style"});break;
		}
		
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
		@ ws [int] 是否请求项目集 0(默认),1
		@ ps [int] 是否请求项目节点 0(默认),1
		@ select[int] 项目状态选择
		@ onload [function] 读取完时执行的函数
		@ ondrop {function} 拖动日历松开时执行的函数
		@ group [array[array["第一级模板开始","第一级模板结束","第一级模板内容"],array["第二级模板开始","第二级结束","第二级内容"],.....]] 传入模板
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
		var selects=_$.getPara(params,'select',"");
		var group=_$.getPara(params,'group',false);
		var fn_onload=_$.getPara(params,'onload',false);
		var url='index.php?c=calendar&projId='+projId+'&userId='+userId+'&wrapId='+wrapId+'&type='+type+'&showWrapSection='+showWrapSection+'&showProjSection='+showProjSection+'&select='+selects;
		var html='<div id="{@canvasId}_calendar_wrap" class="calendar_wrap" style="width:{@wrapWidth}px;"><ul id="{@canvasId}_calendar" class="calendar fNum"></ul><div class="taskbar_wrap" id="{@canvasId}_taskbar_wrap"></div><div style="left:{@crrentLeft}px" id="{@canvasId}_current_day" class="current_day"></div></div>';
		var sectionHtml='<a style="left:{@left}px;" class="wnod_item"><span class="wnod_name">{@title}</span></a>';
		var calendarHtml='';
		var week=["日","一","二","三","四","五","六"];
		group=groupSetDetault(group,type);
		/* fn:默认模板 */
		function groupSetDetault(_group,_type)
		{
			var pnodTemplateC='<a title="{@user}-{@title}【{@stateName}】" id="pnod-row-id-{@nodeId}" onclick="PMS.showNode({@nodeId})" style="width:{@widthFinal}px;margin-left:{@left}px;" class="pnod node" title="{@user}-{@title}【{@stateName}】"><span style="width:{@widthEnd}px;" class="title-short rowcolor{@state}"><span class="inner">{@title} by {@user}【{@stateName}】</span></span></a>';
			var pnodTemplateE='</div>';
			var projectTemplateS='<div class="projectWrap"><div class="wrapline" style="left: {@left}px; width:{@widthFinal}px;"><div class="wrapline_i"></div></div><a href="index.php?c=project_bll&a=project_show&id={@nodeId}" style="width:{@widthFinal}px;margin-left:{@left}px;" class="pnod project" title="{@title} by {@user}【{@stateName}】"><span style="width:{@widthEnd}px;" class="title-short rowcolor{@state}"><span class="icon"></span><span class="inner">{@title} by {@user}【{@stateName}】</span></span></a>';
			var projectTemplateE='</div>';
			var projectTemplateC='<a href="index.php?c=project_bll&a=project_show&id={@nodeId}" style="width:{@widthFinal}px;margin-left:{@left}px;" class="pnod" class="title-short rowcolor{@state}"><span style="width:{@widthEnd}px;" class="title-short rowcolor{@state}">{@title} by {@user}【{@stateName}】</span></a>';
			if(_group!=false)
			{
				for(var i=0;i<_group.length;i++)
				{
					for(var j=0;j<3;j++)
					{
						_group[i][j]=_group[i][j].replace(/{@NC}/g,pnodTemplateC).replace(/{@NE}/g,pnodTemplateE).replace(/{@PS}/g,projectTemplateS).replace(/{@PE}/g,projectTemplateE).replace(/{@PC}/g,projectTemplateC);
					}
				}
				debugger;
				return _group;
			}
			else if(_type=="node"){return [['','',pnodTemplateC]];}
			else if(_type=="mix"||_type=="project"){return [[projectTemplateS,projectTemplateE,projectTemplateC],['','',pnodTemplateC]];}
		}
		
		
		/* fn:日历拖动 */
		function dropCalendar(canvasId,params)
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
		}

		

		/**
		 * @ 取得最小和最大时间
		 * @ array [array[json]]输入数组
		**/
		function getMMDate(array0)
		{
			var rss={s:"",e:""};
			var tem_e;
			
			function getMMDate_loop(array)
			{
				if(typeof array =="undefined") return;
				if(typeof array.length!="undefined")//如果仍然为数组
				{
					for(var _i=0;_i<array.length;_i++){getMMDate_loop(array[_i]);}
				}
				else
				{
					if(array.start!='0000-00-00 00:00:00'&&array.start!=""&&array.start!=null&&array.start!=undefined)
					{
						if(rss.s=="") rss.s=array.start;
						else if(rss.s>array.start) rss.s=array.start;
					}
						
					if(array.end!='0000-00-00 00:00:00'&&array.end!=""&&array.end!=null&&array.end!=undefined)
					{
						tem_e=array.end;
						if(array.state==20&&tem_e<dateCurrent){tem_e=dateCurrent}//如果流程未结束，且他的结束时间小于当前时间，最大时间即为当前时间
						if(rss.e=="") rss.e=tem_e;
						else if(rss.e<tem_e) rss.e=tem_e;
					}
				}
			}
			getMMDate_loop(array0,0);
			return rss;
		}
		//将传入的html模板插入实际数据
		function replaceHTml(html,json)
		{
			if(!json.title) json.left="-9999px;display:none;";
			return html.replace(/{@title}/g,json.title).replace(/{@nodeId}/g,json.nodeId).replace(/{@user}/g,json.user).replace(/{@state}/g,json.state).replace(/{@widthEnd}/g,json.widthEnd-2).replace(/{@widthFinal}/g,json.widthFinal-2).replace(/{@left}/g,json.left).replace(/{@groupId}/g,json.groupId).replace(/{@userId}/g,json.userId).replace(/{@stateName}/g,json.stateName).replace(/{@projectId}/g,json.projectId).replace(/{@beforeNodes}/g,json.beforeNodes);
		}
		/**
		 * 取得视图html
		 * @ group [araay[araay]] 模板数组
		 * @ array [array[json]] 流程类数组[{"nodeId":"1","title":"流程名","state":"状态","user":"负责人","start":"2011-08-10 00:00:00","end":"2011-08-24 00:00:00"}]
		 * @ array2 [array[json]] 节点类数组[{"nodeId":"1","title":"流程名","state":"状态","start":"2011-08-10 00:00:00"}]，不显示请传入false
		 * @ sectionHtml [string] 对应模板
		**/
		function getFormatedTask(group,array2,sectionHtml)
		{
			var rs={"min":false,"max":false,"nodesHtml":"","sectionsHtml":""};
			var widthEnd=0;
			var widthFinal=0
			var left=0;
			var leftYear=0;
			var leftMonth=0;
			var _html="";
			var MMDate=getMMDate([nodes,array2]);
			rs.min=MMDate.s;
			rs.max=MMDate.e;
			//如出跨度值为空，则跨度值为当前日期
			if(rs.min=="") rs.min=dateCurrent;
			if(rs.max=="") rs.max=dateCurrent;
			rs.min=new Date(_$.formatDate(rs.min));
			rs.max=new Date(_$.formatDate(rs.max));
			leftYear=(rs.min).getFullYear();
			leftMonth=(rs.min).getMonth()+1;
			if(group)
			{
				loop0(nodes);
				//alert(_html);
				rs.nodesHtml=_html;
			}
			
			function loop0(array)
			{
				for(var i=0;i<array.length;i++)
				{
					if(typeof array[i].length!="undefined") _html+=replaceHTml(group[0][0],array[i][0]);
					loop(array[i],0,1);
					if(typeof array[i].length!="undefined") _html+=replaceHTml(group[0][1],array[i][0]);
				}
			}
			
			function loop(array,counter,_i)
			{
				//alert(typeof array[].nodeId);
				if(typeof array.length!="undefined")
				{
					counter++;
					for(_i=1;_i<array.length;_i++)
					{
						//alert(array[0].userId);
						if(typeof array[_i].length!="undefined") _html+=makehtml(group[counter][0],array[_i][0]);
						loop(array[_i],counter,_i);
						if(typeof array[_i].length!="undefined") _html+=makehtml(group[counter][1],array[_i][0]);
						//alert(_html);
					}
				}
				else
				{
						//alert(array.templateLevel);
						_html+=makehtml(group[counter][2],array);
				}
			}
			
			//生成节点html
			if(array2)
			{
				for(var i=0;i<array2.length;i++)
				{
					array2[i].left=_$.getDiffDy(_$.formatDate(array2[i].start),leftYear+'/'+leftMonth+'/1')*dayWidth;
					rs.sectionsHtml+=replaceHTml(sectionHtml,array2[i]);
				}
			}
			
			function makehtml(html,array)
			{
				var formatDateStart=_$.formatDate(array.start);
				var formatDateEnd=_$.formatDate(array.end);
				var formatCurrent=_$.formatDate(dateCurrent);
				if(formatDateStart=='0000/00/00')  formatDateStart=formatCurrent;
				if(formatDateEnd=='0000/00/00')  formatDateEnd=formatCurrent;
				if(formatDateStart>formatDateEnd) formatDateStart=formatDateEnd;
	
				array.left=_$.getDiffDy(formatDateStart,leftYear+'/'+leftMonth+'/1');
				array.widthEnd=_$.getDiffDy(formatDateStart,formatDateEnd)+1;
					
				if(array.final) array.widthFinal=_$.getDiffDy(_$.formatDate(array.final),formatDateStart,{"isAbs":false})+1;
				else array.widthFinal=_$.getDiffDy(formatCurrent,formatDateStart,{"isAbs":false})+1;
				
				if(array.widthFinal<array.widthEnd) array.widthFinal=array.widthEnd;
					
				if(array.widthEnd) array.widthEnd*=dayWidth; 
				else array.widthEnd=dayWidth;
				
				if(array.widthFinal&&array.widthFinal>1)array.widthFinal*=dayWidth;
				else array.widthFinal=array.widthEnd;
					
				if(array.left) array.left*=dayWidth; else array.left=0;
				return replaceHTml(html,array);
			}
			
			return rs;
		}
		
		//执行插入HTMl
		function appendHtml(eYM)
		{
			if(!eYM){wrap.append('<div class="calendarNull">木有流程</div>');return false};
			var yearCounter		=(eYM.min).getFullYear();
			var monCounter		=(eYM.min).getMonth()+1;
			var dayCounter=0;
			var temClass="";
			var temweek="";
			if(yearCounter<2010||yearCounter>2024){alert('年份边界不在显示范围内!');return}
			while(true)
			{
				//取得这个月有多少天
				var counter=_$.dayCount(yearCounter,monCounter);
				dayCounter+=counter;
				calendarHtml+='<li class="separate"><span>'+yearCounter+"-"+monCounter+'</span></li>';
				for(var j=1;j<counter+1;j++)
				{
					temClass="";
					temweek=new Date(yearCounter+'/'+monCounter+'/'+j).getDay();
					if(j==1) temClass="newMonth";
					if(temweek==0||temweek==6) temClass="weekend";
					calendarHtml+='<li class="'+temClass+'">'+j+'<br/>'+week[temweek]+'</li>';
				}
				monCounter++;
				if(monCounter>12){monCounter=1;yearCounter++}
				if(_$.getDiffDy(_$.formatDate(eYM.max),yearCounter+'/'+monCounter+'/1',{'isAbs':false})<0) break;
				//if(yearCounter>2024){alert('loop final....');break;}
			}
			wrap.html('');
			wrap.append(html.replace(/{@canvasId}/g,canvasId).replace(/{@wrapWidth}/,dayCounter*dayWidth+1).replace(/{@crrentLeft}/,_$.getDiffDy(_$.formatDate(dateCurrent),(eYM.min).getFullYear()+'/'+((eYM.min).getMonth()+1)+'/1')*dayWidth));
			$('#'+canvasId+'_calendar').append(calendarHtml);
			if(eYM.sectionsHtml) 
			{
				$('#'+canvasId+'_taskbar_wrap').append('<div id="'+canvasId+'_sections" class="calendar_Sections"></div>');
				$('#'+canvasId+'_sections').append(eYM.sectionsHtml);
			}
			$('#'+canvasId+'_taskbar_wrap').append(eYM.nodesHtml);

			//执行读取日历完成时的函数
			if(fn_onload) fn_onload();
			//拖动日历
			dropCalendar(canvasId,{'ondrop':_$.getPara(params,"ondrop",null)});
			
			$('#'+canvasId+"_taskbar_wrap .icon").toggle(function(){$(this).parent().parent().parent().addClass("spread");return false;},function(){$(this).parent().parent().parent().removeClass("spread");return false;})

		}
		
		//执行
		//alert(url);
		_$.addcss("themes/css/calendar.css",{"id":"calendar_style"});
		wrap.addClass('projectGra');
		
		$.getScript(url,function(){
			debugger;
			if(showWrapSection) appendHtml(getFormatedTask(group,wrapSections,sectionHtml));
			else if(showProjSection) appendHtml(getFormatedTask(group,projectSections,sectionHtml));
			else appendHtml(getFormatedTask(group));
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
	* showSelectList
	* 选择弹出层
	* @ type{string} 类别｛product:产品,users：用户,data:通用｝//具体参考controller/popwin.php
	* @ inputid_id{string} 放id值的元素id
	* @ inputid_name{string} 放文本值的元素id
	* @ param{json} 其它可选参数
			@ autoBind {bool} 是否自动绑定onclick显示 default:true;
			@ reload {bool} 是否每次点击都重新读取数据 default:false
			@ supper_id {id} 上一级id
			@ type {string} 二级分类：
				pState{"public":公共} default:"";
				data "pState"|"pClass"|"nClass"
	**/
	showSelectList:function(type,inputid_id,inputid_name,param)
	{
		var popwin;
		var type2=_$.getPara(param,"type",'');
		if(type2!='')
			var typeCombine=type+'_'+type2;
		else
			var typeCombine=type;
		var inputer=$('#'+inputid_name);
		inputer.attr("rel",type);
		if(_$.getPara(param,"autoBind",true)==false) even();
		else inputer.click(function(ev){even()});
		function even(ev)
		{
			$('.popwin').hide();
			if(!_$(typeCombine+'_popwin'))
			{
				PMS.loadCss();
				var html='<div id="'+typeCombine+'_popwin" class="popwin"><div class="popwin_inner clearfix"></div></div>';
				$('body').append(html);
				popwin=$('#'+typeCombine+'_popwin');
				toload();
			}
			else
			{
				popwin=$('#'+typeCombine+'_popwin');
				if(_$.getPara(param,"reload",false)==true) toload();
				$('#inputid_'+typeCombine+'_id').val(inputid_id);
				$('#inputid_'+typeCombine+'_name').val(inputid_name);
				relocation();
			}
		}
		
		function toload()
		{
			var url="index.php?c=popwin&a="+type+"&supper_id="+_$.getPara(param,"supper_id",0)+"&type="+_$.getPara(param,"type","");
			//alert(url);
			popwin.find(".popwin_inner").load(url,function(){
				$('#inputid_'+typeCombine+'_id').val(inputid_id);
				$('#inputid_'+typeCombine+'_name').val(inputid_name);
				relocation();
			});
		}
		
		function relocation()
		{
			var objOffset=inputer.offset();
			popwin.css('top',objOffset.top+inputer.height()+3).css('left',objOffset.left).attr("rel",type).fadeIn("fast");
			//alert("b");
			setTimeout(function(){$(document).bind("click",function(a){closewin(a.target)});},200);
		}
		
		//点击弹层外的区域关闭窗口
		function closewin(obj2)
		{
			//alert("a");
			//如果是同一类型的窗口，就不必关闭了，直接定位到新的位置
			if(obj2.getAttribute("rel")==popwin.attr("rel")) return;
 			if(obj2.tagName.toLowerCase()=="body")
			{
				popwin.fadeOut("fast");	
				$(document).unbind("click");
				return;
			}
			//如果点击在popwin上或者在相关的对像上时，不进入递归，否则会一直寻找body,然后让popwin消失
			if(obj2.id!=typeCombine+'_popwin'&&obj2.id!=inputid_name)
			{
				closewin(obj2.parentNode);
			}
		}
	},
	
	
	
	/**
	*selected
	* 弹出层被选择后激发的事件
	* @type{string} 类别｛product:产品｝callback:type()
	* @inputid_id{string} 放id值的元素id
	* @inputid_name{string} 放文本值的元素id
	**/
	selected:function(type,prod_id,prod_name)
	{
		$('#'+$('#inputid_'+type+'_id').val()).val(prod_id);
		var iName=$('#'+$('#inputid_'+type+'_name').val());
		_$.setValue(iName,prod_name);
		$('#'+type+'_popwin').fadeOut("fast");
		if(type+"Selected" in window)
		  eval(type+"Selected")();
	},
	
	rowEditorMakeJson:
	{
		from:null,
		init:function(from)
		{
			this.from=from;
			return this;
		},
		makeJsonTo:function(target)
		{
			/*
			function isArray(obj)
			{
				return obj && !(obj.propertyIsEnumerable('length')) && typeof obj === 'object' && typeof obj.length === 'number';
			};
			*/
			//序列化json
			function json_encode_js(aaa) 
			{
				function je(str) 
				{
				        var a = [],
				        i = 0;
				        var pcs = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
				        for (; i < str.length; i++) 
						{
				            if (pcs.indexOf(str[i]) == -1) a[i] = "\\u" + ("0000" + str.charCodeAt(i).toString(16)).slice( - 4);
				            else a[i] = str[i];
				        }
				        return a.join("");
				}
				var i, s, a, aa = [];
				if (typeof(aaa) != "object") {
				        alert("ERROR json");
				        return;
				}
				for (i in aaa) 
				{
					        s = aaa[i];
					        a = '"' + je(i) + '":';
					        if (typeof(s) == 'object') 
							{
					            a += json_encode_js(s);
					        } 
							else 
							{
					            if (typeof(s) == 'string') a += '"' + je(s) + '"';
					            else if (typeof(s) == 'number') a += s;
					        }
					        aa[aa.length] = a;
				}
				return "{" + aa.join(",") + "}";
			}
			//序列化json
			
			var finalJson=Array();
			$(this.from).each(function(index, element) {
	  				var rowAllData=$(this).find(" :input").serializeArray();//当行的所有数据
	  				var rowAllDataCount=rowAllData.length;
	  				var rowAllDataHandled=new Object();//临时
	  				//收集内容
	  				for(var i=0;i<rowAllDataCount;i++)
	  				{
	  					for(var key in rowAllData[i])
	  					{
	  						rowAllDataHandled[((rowAllData[i]["name"]).split('___'))[0]]=rowAllData[i]["value"];
	  					}
	  				}
					finalJson.push(rowAllDataHandled);
			});
			$(target).val(json_encode_js(finalJson));
		}
	},

	
	
	/**
	* rowEditorCreate2
	* {用于创建批量添加行，动态id值{@numTem}，如果遇到radio分组，可使用"___{@numTem}"作为name值，生成json时会自动去除这部分}
	* @ id {string} 区域所有控件id前缀,和父层id
	*				{行后缀id+“-row-{@numTem}”，删除按钮后缀id+“-rowDelBtn-{@numTem}”，添加按钮后缀id+“-rowAddBtn”}
	* @ row {string->JQuery seletor} 每行标签，如：“li”，则意思为$("#"+id+" li");
	* @ params {json} 可选参数：
			@ added {function(n)} 添加一行后触发执行的函数，传入一个行号值。
	* @ return object
	*		   object.makeJsonTo(string->JQuery seletor) 将数据序列化成json，存储到一个指定的Input DOM的value中
	**/	
	rowEditorCreate2:function(id,row,params)
	{
		var numTem=1;
		var rowId=id+"_row_";
		var delId=id+"_rowDelBtn_";
		var addId=id+"_rowAddBtn";
		var rowHtml="";
		var wrap=$("#"+id);
		var fn_added=_$.getPara(params,"added",null);
		//读取并清空模板
		rowHtml=$(wrap).html();
		wrap.html("");
		$("#"+addId).click(function()
		{
			var n=numTem;
			wrap.append(rowHtml.replace(/{@numTem}/g,numTem));
			$('#'+delId+numTem).click(function(){$('#'+rowId+n).remove()});
			if(fn_added!=null){fn_added(numTem);}
			numTem++;
		});
		//建立返回的对像
		return PMS.rowEditorMakeJson.init('#'+id+' '+row);
	},
	
	/**
	* rowEditorCreate
	* {用于创建用于批量添加中，行数的增删 tagName 用 {@Num}, Id用{@numTem}}
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
		
		$("#"+addId).click();
		
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
	* @ id {string}id前缀
	* 如果id前缀为pnod，id值为：
						行：pnod_row_{@numTem}|....
						保存按钮：pnod_rowSaveBtn_{@numTem}
						删除按钮：pnod_rowDelBtn_{@numTem}}
						添加行按钮:pnod_rowAddBtn
						保存全部:pnod_SaveAll
	* @ p_key {string} 数据表主键
	* @ eachrow {string->JQuery seletor} 每行重复区域
	* @ p_data {string[json]} 初始化数据。{"pmui_isEidt|是否可以编辑":1,"pmui_isDel|是否可以删除":1}//注意：模版表单元素里面name值要和json里的key一一对应，否则会影响保存检查是否有改动;
	* @ params {json} 可选参数：
			@ addRowFn {function(rowId)} 添加一行后触发执行的函数，传入一个行号值。
			@ editSaveUrl {string} 编辑保存一行接口地址。
			@ editSaveFn {function(rowId)} 编辑时保存点击保存时执行的函数。
			@ addSaveUrl {string} 新增一行并保存时接口地址。
			@ addSaveFn {function(rowId)} 新增一行，保存时执行的函数。
			@ addSaveAllUrl {string} 保存全部接口地址。
			@ rowDelUrl {string} 删除一行接口地址。
			@ rowDelFn {function(rowId)} 删除按钮事件。
			@ saveAllUrl {string} 保存全部的接口地址。
			@ vForm (string) 使用Validator验证表单，默认为null。 
			@ vPronSkillFn {function()} 验证技能等信息是否有被修改。editor by juetion
	**/	
	rowEditorEdit:function(id,p_key,eachrow,p_data,params)
	{
		var numTem=1;
		var rowId=id+"_row_";
		var rowSaveId=id+"_rowSaveBtn_";
		var delId=id+"_rowDelBtn_";
		var addId=id+"_rowAddBtn";
		var wrap=$("#"+id);
		var addRow_fn=_$.getPara(params,"addRowFn",null);
		var editSaveUrl=_$.getPara(params,"editSaveUrl",false);
		var editSave_fn=_$.getPara(params,"editSaveFn",null);
		var addSaveUrl=_$.getPara(params,"addSaveUrl",false);
		var addSaveAllUrl=_$.getPara(params,"addSaveAllUrl",false);
		var addSave_fn=_$.getPara(params,"addSaveFn",null);
		var rowDelUrl=_$.getPara(params,"rowDelUrl",false);
		var rowDel_fn=_$.getPara(params,"rowDelFn",null);	
		var vForm=_$.getPara(params,"vForm",null);	
		var temHtml="";
		
		//处理原始数据
		var initData=Object();
		var rowCount=p_data.length;
		for(var i=0;i<rowCount;i++)
		{
			initData[p_data[i][p_key]]=p_data[i];
		}
		
		//读取并清空模板
		if(wrap.attr("tagName").toLowerCase()=="table") temHtml=wrap.find("tbody:eq(0)").html();
		else temHtml=wrap.html();
		wrap.html("");
		insertData(initData);
		
		$("#"+addId).click(function(){rowAdd()});	
		
		//保存全部
		var _isSaving=false;
		var _resetSaveBtn=function(){$("#"+id+"_SaveAll").html('保存流程修改');_isSaving=false;}
		$("#"+id+"_SaveAll").click(function(){
			if(!_isSaving)
			{
				_isSaving=true;
	  			$(this).html('稍候...');
	  			var allRowsData=new Object();//表单所有数据
	  			$.each($(eachrow),function(index){
	  				var rowAllData=$(this).find(" :input").serializeArray();//当行的所有数据
	  				var rowAllDataCount=rowAllData.length;
	  				var rowAllDataHandled=new Object();//临时
	  				//收集内容
	  				for(var i=0;i<rowAllDataCount;i++)
	  				{
	  					for(var key in rowAllData[i])
	  					{
	  						rowAllDataHandled[((rowAllData[i]["name"]).split('___'))[0]]=rowAllData[i]["value"];
	  					}
	  				}
	  				//判断是不是新增的行
	  				if(rowAllDataHandled[p_key]=="")
	  				{
	  					rowAllDataHandled["isNew"]=1;
	  					allRowsData["new_"+index]=rowAllDataHandled;
	  				}
	  				else
	  				{
	  					rowAllDataHandled["isNew"]=0;
	  					allRowsData[rowAllDataHandled[p_key]]=rowAllDataHandled;//添加到所有数据
	  				}
	  				
	  			});
	  			//检查有修改的行
	  			var isHaveDataToPost=false;
	  			var allModifiedRowsData=new Object();//所有修改数据
	  			for(var key in allRowsData)
	  			{
	  				if(allRowsData[key]["isNew"]==0)
	  				{
	  					for(var key2 in allRowsData[key])
	  					{
	  						if(typeof initData[key][key2]!='undefined')//initData：初始数据
	  		  					if((initData[key][key2]&&initData[key][key2]!=allRowsData[key][key2])||(!initData[key][key2]&&allRowsData[key][key2]!=""))
	  		  					{
	  		  						allModifiedRowsData[key]=allRowsData[key];
	  								isHaveDataToPost=true;
	  		  						break;
	  		  					}
	  					}
	  				}
	  				else
	  				{
	  					allModifiedRowsData[key]=allRowsData[key];
	  					isHaveDataToPost=true;
	  				}
	  			}
	  			if(vForm)
	  			{
	  				if(typeof Validator=='undefined')
	  				{
	  					alert("缺少Validator类库，请在页面引用！");
	  				}
	  				if(!Validator.Validate(document.getElementById(vForm),2))
					{ 
						_resetSaveBtn();
						return false;
					}
	  			}
	  			
	  			
	  			if(isHaveDataToPost)
	  				$.post(addSaveAllUrl,{"allRowsData":allModifiedRowsData},function(rs){
	  					//如果成功，将临时行替换成正式行(未完成)
	  					alert(rs.des);
	  					if(rs.rs==1||rs.rs==200)
	  					{
	  						location.reload();
	  					}
						_resetSaveBtn();
	  					},'json');
	  			
	  			if(!isHaveDataToPost)
				{
	  				alert("内容没有变动。");
					_resetSaveBtn();
				}
			}
			
		})

		function rowAdd()
		{
			var n=numTem;
			var regx=/\{@[^=\n\r]+\}|%7B@[^=\n\r]+%7D/g;
			wrap.append(temHtml.replace(/{@numTem}/g,numTem+"_tem").replace(regx,'""').replace(/""""/g,'""'));
			//$("#proj_ps").val(temHtml.replace(/{@numTem}/g,numTem+"_tem").replace(regx,'""').replace('""""','""'));
			$('#'+delId+numTem+"_tem").click(function(){$('#'+rowId+n+"_tem").remove()});
			if(addRow_fn!=null){addRow_fn(numTem+"_tem");}
			if(document.getElementById(rowSaveId+numTem+"_tem")) 
			{
				$("#"+rowSaveId+numTem+"_tem").click(function(){addSave(n)})
			}
			numTem++;
		}
			
		function addSave(rowid)
		{
			var postData=$("#"+id+"_row_"+rowid+"_tem input").serialize();
			$.post(addSaveUrl,postData,function(data){
				if(data.rs==1||data.rs==200)
				{
					//data.des 要求传回一个插入值的json数组格式为 [{"key":"value"},......]
					insertData(eval(data.des));
					$("#"+id+"_row_"+rowid+"_tem").remove();
					alert("保存成功！");
					if(addSave_fn) addSave_fn(rowid);
				}
				else alert(data.des);
				
				},"json")
		}

			
		function editSave(rowid)
		{
			var postData=$("#"+id+"_row_"+rowid+" input").serialize();
			$.get(editSaveUrl+"&PMS_id="+rowid,postData,function(data){
				if(data.rs==1){$("#"+id+"_row_"+rowid).addClass("rowReadMode");if(editSave_fn) editSave_fn(rowid);}
				alert(data.des);
				},"json");
		}
		
		function rowDel(rowid)
		{
			if(confirm('删除后不可恢复，确认删除？'))
			{
				_isSaving=true;
				$("#"+id+"_SaveAll").html('稍候...');
				$("#"+id+"_row_"+rowid).css('opacity','0.5'); 
				var postData=$("#"+id+"_row_"+rowid+" input[name='"+p_key+"']").val();
				$.get(rowDelUrl+"&"+p_key+"="+postData,function(data){
					  if(data.rs==1||data.rs==200)
					  {
						  $("#"+id+"_row_"+rowid).remove(); 
						  if(rowDel_fn) rowDel_fn(rowid);
					  }
					  else 
					  {
					  	alert(data.des);
					  }
					  _resetSaveBtn();
					  
				},"json");
			}
		}
		
		//json 输入json数组
		function insertData(json)
		{
			if(json!=null)
			{
				function bindEditSave(rowid){if(editSaveUrl) editSave(rowid);else if(editSave_fn) editSave_fn(rowid)};
				function bindDelRow(rowid){if(rowDelUrl) rowDel(rowid);else if(rowDel_fn) rowDel_fn(rowid)};
				var rowsHtml;
				var allowEidt;
				var allowDel;
				var json2;
				for(var key in json)
				{
					if(json[key]=="") break;
					json2=json[key];
					rowsHtml=temHtml;
					allowEidt=_$.getPara(json2,"pmui_isEidt","1");
					allowDel=_$.getPara(json2,"pmui_isEidt","1");
					//set data
					for(var key2 in json2)
					{
						var regx=new RegExp("\\{@"+key2+"\\}|%7B@"+key2+"%7D","g");
						if(json2[key2])
						{
							//过虑日期里面的时间，可选
							json2[key2]=(json2[key2]+'').replace(" 00:00:00","");
							rowsHtml=rowsHtml.replace(regx,json2[key2]);
						}
						else  rowsHtml=rowsHtml.replace(regx,'""').replace(/""""/g,'""');
					}
					wrap.append(rowsHtml.replace(/{@numTem}/g,json2[p_key]));
					
					//find current row
					var temrow=wrap.find("#"+rowId+json2[p_key]);
					
					//temrow.addClass("rowReadMode").click(function(e){var tem=e.target.id.split("_");if(tem[1]!="rowSaveBtn") $(this).removeClass("rowReadMode")});
					
					//if current row allow edit
					if(addRow_fn&&allowEidt){
						temrow.click(function(e){var tem=e.target.id.split("_");if(tem[1]!="rowSaveBtn") $(this).removeClass("rowReadMode")});
						addRow_fn(json2[p_key],json2);
					}
					else temrow.addClass("rowReadMode");
					
					//如果有编辑后执行的函数，并且允许编辑.
					if(allowEidt) eval("$('#'+rowSaveId+"+json2[p_key]+").click(function(){bindEditSave("+json2[p_key]+");})");
					else eval("$('#'+rowSaveId+"+json2[p_key]+").remove()");
					
					//如果有删除后执行的函数，并且允许删除.
					if(allowDel) eval("$('#'+delId+"+json2[p_key]+").click(function(){bindDelRow("+json2[p_key]+");})");
					else eval("$('#'+delId+"+json2[p_key]+").remove()");
				}
			}
		}},
		
/*****
* Name:showNode
* Describe:流程信息弹窗
* param:
	* require
		@ nodeId (int) 流程id
	* optional
		@ option (json)
		{
			"score":(bool)是否打分,
			"project":(bool)是否显示查看项目
			"pass":(bool)是否显示通过按钮
		}
* return void
******/
	showNode:function(nodeId,option)
	{
		if((typeof option).toLowerCase()=="object")
		{
			var setScore=_$.getPara(option,"score",null);
			var checkProject=_$.getPara(option,"project",null);
			var pass=_$.getPara(option,"pass",null);
		}
		var url='index.php?c=pnode&a=getNode&pnod_id='+nodeId;
		if(setScore)
			url+="&setScore=1";
		if(checkProject==0)
			url+="&checkProject=0";
		if(pass)
			url+="&pass=1";
		if(!document.getElementById('pnod_details_box'))
		{
			PMS.loadCss();
			var html='<div id="pnod_details_box" class="popwin"><div class="popwin_inner clearfix"></div></div>';
			$('body').append(html);
			$('#pnod_details_box div').load(url,function(){_$.popWin("pnod_details_box");});
		}
		else
		{
			$('#pnod_details_box div').load(url,function(){_$.popWin("pnod_details_box");});
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
	},
	
	checkSearch:function()
	{
		var date1=$('#sd1').val();
		var date2=$('#sd2').val();
		var dateRex=/(\d{4}-\d{2}-\d{2})|结束日期|开始日期/;
		var key=$('#search_sk').val();
		if(key=='输入流程标题关键字'||key=='输入项目标题关键字') $('#search_sk').val('');
		if(!dateRex.test(date1)||!dateRex.test(date2)){alert('请正确输入日期!');return false;}
		if(date1.length>4&&date2.length<=4){alert('请输入结束日期!');return false;}
		if(date1.length<=4&&date2.length>4){alert('请输入开始日期!');return false;}
		
	},
	
	listPage:function(currentPage,maxPage)
	{
		currentPage=parseInt(currentPage);
		maxPage=parseInt(maxPage);
		var objPage=$("#pagerForm input[name=p]");
		var page=objPage.val();
		var isFinal=false;
		if(currentPage>1)
			$("#pagerPrev").click(function(){goPage("prev");isFinal=true;$("#pagerForm").submit();});
		else
			$("#pagerPrev").attr("disabled","disabled");
		if(currentPage<maxPage)
			$("#pagerNext").click(function(){goPage("next");isFinal=true;$("#pagerForm").submit();});
		else
			$("#pagerNext").attr("disabled","disabled");
		$("#pagerForm").submit(function(){
			goPage();
			if(!(/\d{1,5}/).test(page)||page>maxPage||page<1)
			{
				alert("请输入正确的页码!");
				return false;
			};
		});
		function goPage(type)
		{
			if(isFinal) return true;
			switch(type)
			{
				case "next":page++;break;
				case "prev":page--;break;
				default:page=$("#pagerToPage").val();
			}
			objPage.val(page);
		}
	},
/*****
* Name:listPageAjax
* Describe:异步加载分页（不含html）
* param:
	* require
		@ object (object) JQSelect object
		@ url (string) 请求地址，｛@page｝为动态页值
		@ callBack(data) (function) 加载数据后回调，传入数据
	* optional
		@ param (json){
						post (json): 请求数据时post的参数
					  }
* return void
******/
	listPageAjax:function(object,url,callBack,optional)
	{
		var postData=_$.getPara(optional,"post",false);
		var totalPage;
		var currentPage=1;
		var prevPageBtn=object.find(".pagerPrev");
		var nextPageBtn=object.find(".pagerNext");
		var goBtn=object.find(".pagerGo");
		function loadPage(_page)
		{
			if(_page<1)
			{
				currentPage=1
				return;
			} 
			if(_page>totalPage)
			{
				currentPage=totalPage;
				return;
			}
			$.post(url.replace(/{@page}/,_page),postData,function(r){
				if(r.rs==200)
				{
				object.find(".pager_current_page").html(currentPage);
				object.find(".pager_total_page").html(r.des.pager.total_page);
				totalPage=parseInt(r.des.pager.total_page);
				if(currentPage>=totalPage)
					nextPageBtn.attr("disabled","disabled");
				else
					nextPageBtn.removeAttr("disabled","disabled");
				if(totalPage==1||currentPage==1)
					prevPageBtn.attr("disabled","disabled");
				else
					prevPageBtn.removeAttr("disabled","disabled");
				callBack(r);
				}
				else
				{
					alert(r.des);
				}
			},"json");
		}
		
		prevPageBtn.click(function(){
			currentPage--;
			loadPage(currentPage);
		});
		
		nextPageBtn.click(function(){
			currentPage++;
			loadPage(currentPage);
		});
		
		object.find(".pagerToPage").click(function(){$(this).val('')})
		
		goBtn.click(function(){
			var toPage=parseInt(object.find(".pagerToPage").val());
			if(!(/\d{1,5}/).test(toPage)||toPage>totalPage||toPage<1)
			{
				alert("请输入正确的页码!");return false;
			}
			else
			{
				currentPage=parseInt(toPage);
				loadPage(toPage);
			}
		})
		
		loadPage(1);
	},
	
/*****
* Name:loadUserCheckBoxTo
* Describe:加载用户选择框
* param:
	* require
		@ element (object) JQSelect object
	* optional
		@ param (json){
						done (function): 加载完时回调,
						checked (Array) : 默认选中的checkbox value值组数
					  }
* return void
******/
	loadUserCheckBoxTo:function(element,param)
	{
		var donefn=_$.getPara(param,"done",false);
		var _checkedArray=_$.getPara(param,"checked",false);
		var _header='<ul class="user-checkbox-group ucg-top"><li class="user-checkbox-group-title">选择人员：</li><li><label><input type="checkbox" id="user-select-all"/> 全选</label></li></ul>';
		var _htmlRole4='<li class="user-checkbox-group-title">管理:</li>';
		var _htmlRole3='<li class="user-checkbox-group-title">前端:</li>';
		var _htmlRole2='<li class="user-checkbox-group-title">设计:</li>';
		var _htmlRole1='<li class="user-checkbox-group-title">编辑:</li>';
		var _htmlRole6='<li class="user-checkbox-group-title">动画:</li>';
		var _htmlRole7='<li class="user-checkbox-group-title">移动:</li>';
		_$.addcss("themes/css/user-checkbox.css",{"id":"user-checkbox-style"});
		$.get('index.php?c=user&a=getUserJson',function(_rs){
			for(var i=0;i<_rs.length;i++)
			{
				if(_rs[i].user_power<=2)
				{
					if(_rs[i].role_id>3&&_rs[i].role_id<6)
						_htmlRole4+='<li><label><input type="checkbox" name="user_id" value="'+_rs[i].user_id+'"/> '+_rs[i].user_name+'</label></li>';
					if(_rs[i].role_id==3)
						_htmlRole3+='<li><label><input type="checkbox" name="user_id" value="'+_rs[i].user_id+'"/> '+_rs[i].user_name+'</label></li>';
					if(_rs[i].role_id==2)
						_htmlRole2+='<li><label><input type="checkbox" name="user_id" value="'+_rs[i].user_id+'"/> '+_rs[i].user_name+'</label></li>';
					if(_rs[i].role_id==1)
						_htmlRole1+='<li><label><input type="checkbox" name="user_id" value="'+_rs[i].user_id+'"/> '+_rs[i].user_name+'</label></li>';
					if(_rs[i].role_id==6)
						_htmlRole6+='<li><label><input type="checkbox" name="user_id" value="'+_rs[i].user_id+'"/> '+_rs[i].user_name+'</label></li>';
					if(_rs[i].role_id==7)
						_htmlRole7+='<li><label><input type="checkbox" name="user_id" value="'+_rs[i].user_id+'"/> '+_rs[i].user_name+'</label></li>';
						
				}
			}
			_htmlRole4='<ul class="user-checkbox-group">'+_htmlRole4+'</ul>';
			_htmlRole3='<ul class="user-checkbox-group">'+_htmlRole3+'</ul>';
			_htmlRole2='<ul class="user-checkbox-group">'+_htmlRole2+'</ul>';
			_htmlRole1='<ul class="user-checkbox-group">'+_htmlRole1+'</ul>';
			_htmlRole6='<ul class="user-checkbox-group">'+_htmlRole6+'</ul>';
			_htmlRole7='<ul class="user-checkbox-group">'+_htmlRole7+'</ul>';
			element.html('<div class="user-checkbox" id="user-checkbox">'+_header+_htmlRole4+_htmlRole1+_htmlRole2+_htmlRole3+_htmlRole6+_htmlRole7+'</div>');
			$("#user-select-all").change(function(){
				if($(this).attr("checked"))
				{
					$("#user-checkbox input[type]='checkbox'").attr("checked","checked").parent().parent().addClass("user-selected");
				}
				else
				{
					$("#user-checkbox input[type]='checkbox'").removeAttr("checked").parent().parent().removeClass("user-selected");
				}
			});
			$("#user-checkbox input").change(function(){$(this).parent().parent().toggleClass("user-selected");});
			if(_checkedArray)
			{
				for(var i=0;i<_checkedArray.length;i++)
				{
					$("#user-checkbox input[value='"+_checkedArray[i]+"']").attr("checked","checked").parent().parent().addClass("user-selected");
				}
			}
			if(donefn)
				donefn();
		},"json")
	},
/*****
* Name:bindDatepickers
* Describe:绑定两个日期组件，基于jquery.ui.datepicker
* return void
******/
	bindDatepickers:function(startObject,endObject)
	{
		var _pnod_time_start=$(startObject);
		var _pnod_time_end=$(endObject);
		_pnod_time_end.datepicker({onSelect:function(dateText,inst)
							{
								if(_pnod_time_start.val()>dateText)
									_pnod_time_start.val(dateText);
							}
						});
		_pnod_time_start.datepicker({onSelect:function(dateText,inst){
							if((_pnod_time_end.val()).length<1||_pnod_time_end.val()<dateText)
							{
								_pnod_time_end.val(dateText);
							}
							setTimeout(function(){_pnod_time_end.trigger("focus");},200);
						}});		
	}
};