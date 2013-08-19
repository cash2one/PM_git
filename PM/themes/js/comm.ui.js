// JavaScript Document

var _$=function(obj){return document.getElementById(obj)}

	/**
	* addcss
	* 添加链接样式表
	* @ src {string} 地址
	* @ param
		{
			int id:样式id
		}
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
	* _$.dayCount
	* 取得某个月的天数
	**/
	_$.dayCount=function(year,month)
	{
		var monthDay=new Array(null,31,28,31,30,31,30,31,31,30,31,30,31);
		if(year%400==0||(year%4==0&&year%100!=0)){monthDay[2]= 29;} 
		return monthDay[month];
	}
	
	/* fn:取得两个日期相差的天数 日期格式 yyyy/mm/dd || params{bool isAbs:是否返回绝对值(true)}*/
	_$.getDiffDy=function(d1,d2,params)
	{
		var isAbs=_$.getPara(params,'isAbs',true);
		//alert(d1+" - "+d2);
		var date1=new Date(d1);
		var date2=new Date(d2);
		var diff=date1.getTime()-date2.getTime();
		if(isAbs) return Math.abs(Math.floor(diff/(24*3600*1000)));
		else  return Math.floor(diff/(24*3600*1000));
	}
	
	/* fn:将 yyyy-mm-dd 的格式换为 yyyy/mm/dd 的格式或者是date Object，用于创建Date('yyyy/mm/dd') */
	_$.formatDate=function (d)
	{
		if(d==null) d=dateCurrent;
		if(typeof d=='string')
		{
			var reg=/\d{4}-\d{1,2}-\d{1,2}/;
			var date=reg.exec(d);
			date=(date+"").replace(/\-/ig,'/');
		}
		else if(typeof d=='object'){date=d.getFullYear()+'/'+(d.getMonth()+1)+'/'+d.getDate();}
		return date;
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
		obj.css('top',toppx+'px').css('left','50%').css('margin-left',(-(obj.width()/2))+'px').css('z-index','9999').fadeIn('fast');
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
	
	
	/**
	* $.ui.popWin
	* 显示窗口
	* @ e {string} win id
	* @ params{json} 其它参数
			@ html {string} 弹窗内容，默认:不使用。
			@ bg {bool} 是否显示半透明背景，默认:true
			@ fix {bool} 是否固定窗口位置，默认:true;[ie6||e高度超出可视高度时=false]
			@ open(e) {function} 显示时执行函数
			@ close(e) {function} 关闭时执行函数
	**/
	_$.popWin=function(e,params)
	{
		var bg=_$.getPara(params,"bg",true);
		var fix=_$.getPara(params,"fix",true);
		var html=_$.getPara(params,"html",false);
		var open_fn=_$.getPara(params,"open",false);
		var close_fn=_$.getPara(params,"close",false);
		var isIe6=!-[1,]&&!window.XMLHttpRequest;
		if(html&&!$('#'+e).length)  $("body").append(html);
		var obj=$('#'+e);
		obj.css({'display':'none','z-index':'10000','position':'fixed','visibility':'hidden'});
		var bh=$(document).height();
		var toppx=0;
		var toppxForIe6=0;
		setTimeout(function(){
			toppx=($(window).height()-obj.height())/2;
			var scrollTop=document.documentElement.scrollTop+document.body.scrollTop;
			//窗口高度少于obj高度时，居中，否则置顶
			if(obj.height()<$(window).height())
				toppxForIe6=document.documentElement.scrollTop+document.body.scrollTop+($(window).height()-obj.height())/2;
			else
			{
				toppxForIe6=scrollTop;
				fix=false;
			}
			if(isIe6||!fix) obj.css({'position':'absolute'});
			obj.css({'top':toppx+'px','visibility':'visible','left':'50%','margin-left':(-(obj.width()/2))+'px'});
			if(isIe6||!fix) obj.css({'top':toppxForIe6+'px'});
			obj.fadeIn("fast",function(){if(open_fn) open_fn(e);});
		},100);
		
		$("#"+e+" .btn_close").click(function(){obj.fadeOut('fast');if(bg)$('#'+e+'_popwin_bg').hide();if(close_fn)close_fn(e);});
		if(bg)
		{
			var css={"background":"#000","filter":"alpha(opacity=50)","-moz-opacity":"0.5","-khtml-opacity": "0.5", "opacity":" 0.5","width":"100%","z-index":"9999","position":"absolute","top":"0","left":"0"};
			if(document.getElementById(e+'_popwin_bg')) $('#'+e+'_popwin_bg').css('height',bh).css(css).show();	
			else
			{
				$('body').append('<div id="'+e+'_popwin_bg" class="popwin-bg"></div>');
				$('#'+e+'_popwin_bg').css('height',bh).css(css).show().click(function(){obj.fadeOut('fast');$(this).hide();if(close_fn)close_fn(e);});
			}
		}
	}

	_$.closewin=function(obj)
	{
		$(obj).fadeOut('fast');
		$('#popwin_bg').hide();
		$('.popwin-bg').hide();
	}
	
	
	_$.GetCookie=function (check_name) {
		// first we'll split this cookie up into name/value pairs
		// note: document.cookie only returns name=value, not the other components
		var a_all_cookies = document.cookie.split( ';' );
		var a_temp_cookie = '';
		var cookie_name = '';
		var cookie_value = '';
		var b_cookie_found = false; // set boolean t/f default f

		for ( i = 0; i < a_all_cookies.length; i++ ){
			// now we'll split apart each name=value pair
			a_temp_cookie = a_all_cookies[i].split( '=' );

			// and trim left/right whitespace while we're at it
			cookie_name = a_temp_cookie[0].replace(/^\s+|\s+$/g, '');

			// if the extracted name matches passed check_name
			if ( cookie_name == check_name ){
				b_cookie_found = true;
				// we need to handle case where cookie has no value but exists (no = sign, that is):
				if ( a_temp_cookie.length > 1 ){
					cookie_value = unescape( a_temp_cookie[1].replace(/^\s+|\s+$/g, '') );
				}
				// note that in cases where cookie is initialized but no value, null is returned
				return cookie_value;
				break;
			}
			a_temp_cookie = null;
			cookie_name = '';
		}
		if ( !b_cookie_found ){
			return null;
		}
	}
	
	_$.SetCookie=function ( name, value, expires, path, domain, secure){
		var today = new Date();
		today.setTime( today.getTime() );
		if(expires){expires = expires * 1000 * 60 * 60;}
		var expires_date = new Date( today.getTime() + (expires) );
		document.cookie = name + "=" +escape( value ) +
		( ( expires ) ? ";expires=" + expires_date.toGMTString(): "" ) +
		( ( path ) ? ";path=" + path : "" ) +
		( ( domain ) ? ";domain=" + domain : "" ) +
		( ( secure ) ? ";secure" : "" );
	}
	
	_$.DeleteCookie=function (name,path,domain){
		if(GetCookie( name )){
			document.cookie=name+"=" +(( path ) ? ";path=" + path : "") +((domain)?";domain=" + domain : "" ) +";expires=Thu, 01-Jan-2000 00:00:01 GMT";
		}
	}
	
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

//节点状态设置
function pass_pnod(pnod_id,state)
{
	var postData={"score":$("#node-score").val(),"comment":$("#node-comment").val(),"pnod_id":pnod_id,"state":state};
	var url="index.php?c=pnode&a=setState";
	$.post(url,postData,function(msg)
	{
		if(msg.rs==200)
		{
			alert('操作成功！');
			location.reload();
		}
		else
		{
			alert(msg.des);
		}
	},"json");
}
