<?php /* Smarty version 2.6.26, created on 2013-03-06 15:47:08
         compiled from tool/pageCheck.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'tool/pageCheck.html', 83, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="themes/js/jquery.last.js?<?php echo @RD; ?>
"></script>
<style type="text/css">
/*reset*/
body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,code,form,fieldset,legend,input,textarea,p,blockquote,th,td{margin:0;padding:0;}
table{border-collapse:collapse;border-spacing:0;}
fieldset,img{border:0;}
li{list-style:none;}
caption,th{text-align:left;}
h1,h2,h3,h4,h5,h6{font-size:100%;font-weight:normal;}
q:before,q:after{content:'';}
abbr,acronym{border:0;font-variant:normal;}
a{outline:none;cursor:pointer;color:#000}
a:link,a:visited{}
a:hover,a:active{}
sup{vertical-align:text-top;}
sub{vertical-align:text-bottom;}
input,textarea,select{font-family:inherit;font-size:inherit;font-weight:inherit;}
input,textarea,select{}
select{font-size:14px;}
legend{color:#000;}
h1{font-size:18px;margin:30px 0px;font-weight:bold;text-align:left;font-family:"Microsoft YaHei", "SimHei";display:block;padding:5px 20px}
h1 span{color:#F00}
h2{font-size:18px;height:30px;line-height:30px;font-family:"Microsoft YaHei", "SimHei";}
/*reset end*/
.header{background:#CFDBEC;padding:3px;height:30px;}
.header span{float:left;height:30px;line-height:30px;overflow:hidden;_zoom:1}
.itext{height:30px;line-height:30px;border:#CCCCCC solid 1px;padding-left:3px;}
#checkResult{font-size:14px;}
#checkResult dl{background:url(themes/images/notice/dot.png) left bottom repeat-x;overflow:hidden;_zoom:1}
#checkResult dt,#checkResult dd{float:left;line-height:30px;margin-top:100px;}
#checkResult dt{width:15%;text-align:right;padding-right:10px}
#checkResult dd{width:82%}
.right{color:#360;font-weight:bold}
.alert{color:#F90;font-weight:bold}
.error{color:#FF0000;font-weight:bold}
#btnStart.disable{background-position: 0 -168px;color:#666;}
</style>
</head>
<body>


<div class="content">
	<div id="toolheader" class="nav2">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tool/nav.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	
	</div>
	<div class="header">
		<span>页面地址：</span>
		<span><input type="text" class="itext title" id="checkUrl" value="http://tx3.163.com/fab/" style="width:450px"/> </span>
		<span><input type="button" value="开始检查" id="btnStart" style="height:25px;margin-top:2px;margin-left:8px"/></span>
	</div>
	<div  class="boxstyle2">
		<div id="checkResult" class="clearfix"></div>
	</div>
	<div class="boxstyle1 bottom"><textarea name="" id="htmlContent" cols="30" rows="10" style="width:100%;height:300px;display:none"></textarea></div>
	<div class="footer"></div>
</div>



<script type="text/javascript">
	var checkResult=$("#checkResult");
	var roleList=["",'编辑','设计','前端'];
	var txtStyleList=["","right","alert","error"];
	var rowId=0;
	var btnStartCheck=$("#btnStart");
	var pmidGet=(location.hash).replace('#','');
	function checkStart()
	{
		checkResult.html("");
		btnStartCheck.val('checking..').addClass("disable").attr('disabled','disabled');
		var url=$("#checkUrl").val();
		append('查询地址','<a href="'+url+'" target="_blank">'+url+'</a>');
		if(pmidGet){
			//alert(getPmid());
			url=getBaseInfo(pmidGet);
			$("#checkUrl").val(url);
			checkResult.find("dd:eq(0)").html(url);
			};
		$.get("<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'tool','a' => 'pageCheck'), $this);?>
&url="+url,function(html)
		{
			$("#htmlContent").val(html);
			if(html=="") {append(['3','错误'],['3','您查询的地址无法访问。']);btnChange();return}
			checkPageInfo(html);
			if(!pmidGet) getBaseInfo(getPmid(html));
			getClickCounter(html);
			getAllyesCounter(html);
			getPromark(html);
			//alert(txt);
			btnChange();
		});
	}
	
	if(pmidGet) checkStart();
	
	btnStartCheck.click(function(){pmidGet=false;checkStart()});
	
	function btnChange()
	{
		btnStartCheck.fadeOut(function(){btnStartCheck.val('检查完毕!').removeAttr('disabled').removeClass('disable').fadeIn()});
		setTimeout(function(){btnStartCheck.fadeOut(function(){btnStartCheck.val('开始检查').fadeIn()})},2000);
	}
	
	
	function checkPageInfo(html)
	{
		var regx=new RegExp('<meta http-equiv="refresh"|http-equiv=refresh');
		if(regx.test(html)) 
			append(['2','警告'],['2','这可能是一个跳转页面！']);
		regx=new RegExp('<meta http-equiv="refresh" content="0;url=.*|<meta http-equiv=refresh content="0;url=.*');
		var tUrl=html.match(regx)
		if(tUrl)
		{
			tUrl=tUrl[0].replace('<meta http-equiv="refresh" content="0;url=','').replace('<meta http-equiv=refresh content="0;url=','').replace('/">',"").replace('">',"");
			append('','页面可能跳转到:'+tUrl+',您可以偿试输入这个地址进行查询。');
		}
	}
	
	function getPmid(html)
	{
		if(!pmidGet)
		{
			var regx=new RegExp('<meta name="pmid" content=".*"');
			var pmid=html.match(regx);
			if(!pmid){append(['3','错误'],['3','没有检测到页面有pmid的meta信息，因此无法进行一些查询，比如项目名、相关负责人等。']);return };
			return pmid[0].replace('<meta name="pmid" content="27','').replace('"',"");
		}
		else
		{
			return pmidGet;
		}
	}
	
	function getBaseInfo(pmid)
	{
		var pmUrl='<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project_bll','a' => 'project_show'), $this);?>
&id='+pmid;
		var url;
		$.ajax({
			type:"get",
			async:false,
			dataType:"json",
			url:"<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project','a' => 'getJson'), $this);?>
&projId="+pmid,
			success:function(rs){
				//append('查询地址','<a href="'+rs[0].proj_url+'" target="_blank">'+rs[0].proj_url+'</a>');
				append('项目名称','<strong>'+rs[0].proj_name+'</strong>');
				append('PM','<a href="'+pmUrl+'" target="_blank">http://192.168.22.101'+pmUrl+'</a>');
				append('项目负责人',rs[0].user_name);
				var usersLength=rs[0][0].length;
				for(var i=1;i<4;i++)
				{
					var _users="";
					for(var j=0;j<usersLength;j++)
					{
						if(rs[0][0][j].role_id==i){_users+=(_users==""?rs[0][0][j].user_name:'、'+rs[0][0][j].user_name)};
					}
					append(roleList[i],'&nbsp;'+_users);
				}
				url=rs[0].proj_url;
			}
		})
		return url;
	}
	
	function getPromark(html)
	{
		var regx=new RegExp('name="promark" value=".*"|value=".*" name="promark"');
		var promark=html.match(regx);
		if(promark)
		{
			promark=promark[0].replace('name="promark" value="','').replace('value="','').replace(' name="promark"','').replace('"',"");
			append('注册端口',['1',promark]);
		}
		else
			append('注册端口',['2',"没有检测到"]);
	}
	
	function getClickCounter(html)
	{
		var regx=new RegExp('nie\.config\.stats\.clickStats=true;');
		var isClick=regx.test(html);
		isClick=isClick==true?['1',"已开启"]:['2',"没有检测到"];
		append('点击统计',isClick);
	}
	
	function getAllyesCounter(html)
	{
		var regx=/http:\/\/allyes\.nie\.163\.com\/main\/adftrack\?db=afanie\&point=\d*\&cache=/gi;
		var regx2=/<!-- AdForward I-Point:.*Begin -->/gi;
		var allYes=html.match(regx);
		var allYesDes=html.match(regx2);
		if(allYes)
		{
			var _allYes;
			var allYes_length=allYes.length;
			for(var i=0;i<allYes_length;i++)
			{
				_allYes=allYes[i].replace('http://allyes.nie.163.com/main/adftrack?db=afanie&point=','').replace('&cache=','');
				if(allYesDes)if(allYesDes[i]) _allYes+=' --> ['+allYesDes[i].replace('<!-- AdForward I-Point:','').replace(' Begin -->','')+']';
				append('营销统计'+(i+1),['1',_allYes]);
			}
		}
		else
			append('营销统计',['2',"没有检测到"]);
	}
	
	//string||object:['typeId','txt'];
	function append(title,content)
	{
		var _title;
		var _content;
		typeOfTitle=(typeof title).toLowerCase();
		typeOfContent=(typeof content).toLowerCase();
		if(typeOfTitle=='string') _title='<dl><dt class="rsRow'+rowId+'">'+title+'</dt>';
		else if(typeOfTitle=='object')  _title='<dl><dt class="'+txtStyleList[title[0]]+' rsRow'+rowId+'">'+title[1]+'</dt>';
		
		if(typeOfContent=='string') _content='<dd class="rsRow'+rowId+'">'+content+'</dd></dl>';
		else if(typeOfContent=='object')  _content='<dd class="'+txtStyleList[content[0]]+' rsRow'+rowId+'">'+content[1]+'</dd></dl>';
		//checkResult.append('<dt id='+rowId+' style="margin-top:100px;width:100%"></dt>');
		checkResult.append(_title+_content);
		$(".rsRow"+rowId).animate({'margin-top':'0'},300);
		rowId++;
	}
</script>
<script type="text/javascript">window.parent.setTitle("PM工具 - 页面检查器");</script>
</body>
</html>