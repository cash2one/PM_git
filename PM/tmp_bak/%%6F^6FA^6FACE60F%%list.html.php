<?php /* Smarty version 2.6.26, created on 2013-04-15 14:45:49
         compiled from user/list.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'user/list.html', 62, false),array('modifier', 'escape', 'user/list.html', 68, false),)), $this); ?>
<!DOCTYPE html>
<html lang="zh"> 
<head>
<meta charset="utf-8">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/base.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style type="text/css">
#birthday_dis{padding:20px}
#birthday_dis #birthday_day{font-size:14px;font-family:"Microsoft YaHei", "SimHei";color:#06F;padding-bottom:5px}
#calendarView_tab {clear: both;height: 50px;left: 400px;overflow: hidden;width: 550px;top:15px;}
#calendarView_tab a{font-size:12px;font-family:"SimSun"}
.list_box{overflow:hidden;clear:both;display:none}
.list_box.current{display:block}
.user_list{float:left;width:198px;height:200px;overflow:hidden;border:#999 solid 1px;border-radius: 15px 5px; padding:10px;margin:10px;font-size:12px;}
.user_list dt{font-size:16px;font-family:"Microsoft YaHei", "SimHei";border-bottom:#999 dotted 1px;padding:5px 0;margin:5px 0}
	.user_list dt .control {float:right}
	.user_list dt .control a{font-size:12px;font-family:"SimSun";color:#930;}
	.user_list dt .control a:hover{color:#F00}
	.user_list dd{overflow:hidden;height:22px}
	.user_list dd.line1{text-align:center}
	.user_list dd.mutiline{height:auto;border-top: 1px dotted #CCCCCC;color:#333;height:auto;padding-top: 5px;}
#search_result_box{overflow:hidden}
#list_content{overflow:hidden;clear:both}
</style>
</head>
<body class="manage users">

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<article class="content">

	<section class="search">
		<h1>列表 - 通讯录</h1>
		<div class="tab searchTab1">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "user/nav.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
	</section>
	
	<section class="header"></section>
	
	<section class="boxstyle1 top"><div id="birthday_dis"></div></section>
	
	<section class="boxstyle2">
	关健字搜索：<input type="text" id="searchKey" class="itext stitle"/>
	
	<div class="tab" id="calendarView_tab">
	<?php $_from = $this->_tpl_vars['role_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['role'] => $this->_tpl_vars['rs0']):
?>
		<a><?php echo $this->_tpl_vars['rs0']; ?>
</a>
	<?php endforeach; endif; unset($_from); ?>
		<a>搜索</a>
	</div>
	</section>
	
	<section class="boxstyle1">
	<div id="list_content">
	
		<?php $_from = $this->_tpl_vars['role_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['role'] => $this->_tpl_vars['rs0']):
?> 
		
		<div class="list_box <?php if ($this->_tpl_vars['role'] < 6): ?>current<?php endif; ?>">
			<?php $_from = $this->_tpl_vars['userlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
			<?php if ($this->_tpl_vars['rs']['role_id'] == $this->_tpl_vars['role']): ?>
			<dl class="user_list user_list_<?php echo $this->_tpl_vars['rs']['user_id']; ?>
">
				<dt><?php if ($this->_tpl_vars['isManager']): ?><span class="control"><!-- <a onclick="deleteUser(<?php echo $this->_tpl_vars['rs']['user_id']; ?>
)">删除</a> |  --><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'user','a' => 'edit','id' => $this->_tpl_vars['rs']['user_id']), $this);?>
">修改</a></span><?php endif; ?><span class="search_erea"><?php echo $this->_tpl_vars['rs']['user_name']; ?>
</span></dt>
				<dd class="search_erea line1"><?php echo $this->_tpl_vars['rs']['user_mail']; ?>
</dd>
				<?php if ($this->_tpl_vars['rs']['user_nickname']): ?><dd class="search_erea">呢称：<?php echo $this->_tpl_vars['rs']['user_nickname']; ?>
</dd><?php endif; ?>
				<?php if ($this->_tpl_vars['rs']['user_cellphone']): ?><dd class="search_erea">手机：<?php echo $this->_tpl_vars['rs']['user_cellphone']; ?>
</dd><?php endif; ?>
				<?php if ($this->_tpl_vars['rs']['user_telephone']): ?><dd class="search_erea">座机：<?php echo $this->_tpl_vars['rs']['user_telephone']; ?>
</dd><?php endif; ?>
				<?php if ($this->_tpl_vars['rs']['user_bday']): ?><dd class="search_erea">生日：<?php echo $this->_tpl_vars['rs']['user_bday']; ?>
</dd><?php endif; ?>
				<dd class="search_erea mutiline">标签：<?php echo ((is_array($_tmp=$this->_tpl_vars['rs']['user_info'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</dd>
			</dl>
			<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
		</div>
		<?php endforeach; endif; unset($_from); ?>
		
		<div id="search_result_box" class="list_box"></div>
	
	</div>
	
	</section>
	<section class="boxstyle2 footer"></section>
	
</article>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script>

	function deleteUser(user_id)
	{
		if(confirm("此操作将不可撤销，确定删除？"))
		{
			$.get("<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'user','a' => 'deleteUser'), $this);?>
&user_id="+user_id,function(){$(".user_list_"+user_id).fadeOut();});
		}
	}
	
	$.extend({
			 tab:function(objbtn,objcon,defaultIndex)
			 {
				var _objbtn=$(objbtn);
				var _objcon=$(objcon)
				var key=0;
				//active(defaultIndex);
				function active(i)
				{
					_objbtn.removeClass("current");
					_objcon.removeClass("current");
					$(_objbtn[i]).addClass("current");	
					$(_objcon[i]).addClass("current");
				}
				$.each(_objbtn,function(i){$(_objbtn[i]).click(function(){active(i)})});
			 }
			 
			 })
	
	$(function()
	{
		$.tab("#calendarView_tab a","#list_content .list_box",0);
		$.getScript("<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'user','a' => 'getBirthday'), $this);?>
", function()
		{
			var _thisDay="";
			var _thisMonth="";
			
			if(thisDay.length>0)
			{
				for(var i=0;i<thisDay.length;i++)
				{
					if(_thisDay=="") _thisDay+=thisDay[i].name;
					else  _thisDay+="、"+thisDay[i].name;
				}
				$("#birthday_dis").append("<p id=\"birthday_day\">今天的寿星："+_thisDay+"</p>")
			}
			if(thisMonth.length>0)
			{
				for(var i=0;i<thisMonth.length;i++)
				{
					if(_thisMonth=="") _thisMonth+=thisMonth[i].name+"["+thisMonth[i].date+"]";
					else  _thisMonth+="、"+thisMonth[i].name+"["+thisMonth[i].date+"]";
				}
				$("#birthday_dis").append("<p id=\"birthday_mon\">这个月的寿星："+_thisMonth+"</p>")
			}
	
		});
		
		var autoSearch;
		var search_key="";
		function autoSearchFn()
		{
			var key=$.trim($("#searchKey").val());
			if(search_key==key) return;
			if(key==""){$("#search_result_box").html("");return};
			
			$("#search_result_box").html("");
			var reg=new RegExp(".*("+key+").*","i");
			$.each($('#list_content .user_list'),function(i,o){
					var html=$(this).text();
					 if(reg.test(html)) $("#search_result_box").append($(this).clone());
			})
			$.each($('#search_result_box .user_list .search_erea'),
					 function(i,o){
						 //alert(o.innerHTML);
						 o.innerHTML=(o.innerHTML).replace(new RegExp(key,"gi"),function(txt){return "<span style='background:orange'>"+txt+"</span>"});
					 }
				   )
			//$('#search_result_box').html($('#search_result_box').html().replace(new RegExp(key,"gi"),function(txt){return "<span style='background:orange'>"+txt+"</span>"}));
			$('#calendarView_tab a:last-child').click();
			search_key=key;
		}
		$('#searchKey').bind('focus',function(){autoSearch=setInterval(autoSearchFn,1000)});
		$('#searchKey').bind('blur',function(){clearInterval(autoSearch);});
		
	})
</script>
</body>
</html>