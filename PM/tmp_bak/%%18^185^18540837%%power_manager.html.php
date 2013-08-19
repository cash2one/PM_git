<?php /* Smarty version 2.6.26, created on 2013-04-12 14:28:33
         compiled from user/power_manager.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'user/power_manager.html', 87, false),)), $this); ?>
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
.user-list{width:700px}
.user-list li{border:1px #999 solid;overflow:hidden;background:#FFF;}
.user-name{float:left;width:100px;padding:10px;border-right:#CCC dotted 1px}
.power-list{float:left;border:#FFFFCC dotted 1px;overflow:hidden;min-height:35px}
.over-target{border:#009900 1px dotted;background:#66FFFF}
.power-list span{display:block;float:left;padding:5px;border:#0066FF 1px dotted;background:#66CCFF;font-size:12px;margin:5px;/* CSS3 transition rules */
    -webkit-transition: all 0.2s ease;
    -moz-transition: all 0.2s ease;
    -o-transition: all 0.2s ease;
    transition: all 0.2s ease}
.power-list span:hover{background:#FFF;cursor:pointer}
.power-list i{float:left;background: url("themes/images/sprites.png") no-repeat 6px 5px #0CF;height: 25px;width: 25px;margin:5px;cursor:pointer}
.power-list i:hover{background-color:#F90}
#main-wrap{position:relative}
.target-power-contenter{width:575px;position:relative;
	/* CSS3 transition rules */
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;}
.target-power-contenter span:hover{background:url(themes/images/icon.png) no-repeat 4px -145px;padding-left:20px}
.target-power-contenter span.loading{background:url(themes/images/loading3.gif) no-repeat 4px 4px;background-size:15px auto;padding-left:20px}
#all-power2-list{position:absolute;width:240px;top:0;right:0;padding:5px;}
#all-power2-list span{display:block;float:none;margin:0}
#all-power2-list p{background:#FFF;font-size:12px;padding:5px 15px;color:#666666}
#all-power2-list span:hover{cursor:move}
#power-options-box{position:absolute;width:565px;background:#EEF7FF;border:#09F 1px dotted;padding:15px 5px;min-height:50px;font-size:12px;}
#power-options-box .btn_close{position:absolute;right: 2px;bottom: 2px;}

</style>
</head>
<body class="manage power2">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<article class="content">
<section class="search">
	<h1>权限2.0管理</h1>
</section>
<section id="main-wrap">
	<ul class="user-list" id="user-list">
		<?php $_from = $this->_tpl_vars['userArray']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
		<li>
			<div class="user-name"><?php echo $this->_tpl_vars['rs']['user_name']; ?>
</div>
			<div class="power-list target-power-contenter" id="">
				<?php $_from = $this->_tpl_vars['rs']['power2Array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<span onClick="deletePower2(<?php echo $this->_tpl_vars['rs']['user_id']; ?>
,<?php echo $this->_tpl_vars['k']; ?>
,this)"><?php echo $this->_tpl_vars['v']; ?>
</span>
				<?php endforeach; endif; unset($_from); ?>
				<i id="add-btn-<?php echo $this->_tpl_vars['rs']['user_id']; ?>
" class="add" data="<?php echo $this->_tpl_vars['rs']['user_id']; ?>
"></i>
			</div>
		</li>
		<?php endforeach; endif; unset($_from); ?>
	</ul>
	<div id="all-power2-list" class="power-list">
		<div style="margin-bottom:10px">权限列表</div>
		<?php $_from = $this->_tpl_vars['power2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		<span draggable="true"><?php echo $this->_tpl_vars['v']; ?>
</span>
		<p><?php echo $this->_tpl_vars['power2DescribeArray'][$this->_tpl_vars['k']]; ?>
</p>
		<?php endforeach; endif; unset($_from); ?>
	</div>
</section>
</article>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="power-options-box" style="display:none" class="popwin">
	<div id="power-options-list" class="power-list">
	</div>
	<a class="btn_close" onclick="closeList()" title="关闭"></a>
</div>
<script type="text/javascript">
	var uid;
	var powerOptionsBox=$("#power-options-box");
	var powerOptionsList=$("#power-options-list");
	var parentBox;
	$("#user-list .add").click(function(){
		if(uid) $("#add-btn-"+uid).show();
		var btn=$(this);
		btn.hide();
		parentBox=$(this).parent();
		uid=btn.attr("data");
		powerOptionsBox.hide("fast",function(){
			powerOptionsList.html('<img src="themes/images/loading.gif" width="30" height="30">');
			powerOptionsBox.css({"left":parentBox.offset().left,"top":parentBox.offset().top+37}).show("fast",function(){
				$.getJSON("<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'user','a' => 'getCanUsePower2'), $this);?>
&user_id="+uid,function(rs){
					if(rs.rs==200)
					{
						var html='';
						for(var i=0;i<(rs.des).length;i++)
						{
							html+='<span onclick="addPower2('+uid+','+rs.des[i].key+',\''+rs.des[i].value+'\',this)">'+rs.des[i].value+'</span>';
						}
						powerOptionsList.html(html);
					}
					else
					{
						powerOptionsList.html('该用户没有可选的权限');
					}
				});
			});
		});
	});
	
	var addPower2=function(_uid,_powerkey,_powerName,source)
	{
		$(source).css({"position":"absolute","left":$(source).position().left})
		.animate({"top":-40,"left":0},200,function(){
			$(this).remove();
			parentBox.prepend('<span onClick="deletePower2('+uid+','+_powerkey+',this)" class="loading">'+_powerName+'</span>');
			$.getJSON("<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'user','a' => 'addPower2'), $this);?>
&user_id="+uid+"&power2="+_powerkey,function(rs){
				if(rs.rs==200)
				{
					parentBox.find(".loading").removeClass("loading");
				}
				else
					alert(rs.des);
			});
		});
	}
	
	var deletePower2=function(_uid,_powerkey,source)
	{
		var btn=$(source);
		btn.addClass("loading");
		$.getJSON("<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'user','a' => 'deletePower2'), $this);?>
&user_id="+_uid+"&power2="+_powerkey,function(rs){
			if(rs.rs==200)
			{
					btn.css({"position":"absolute","left":btn.position().left,"top":-50});
					setTimeout(function(){btn.remove();},400);
					
			}
			else
			{
				btn.removeClass("loading");
				alert(rs.des);
			}
		});
		
	}
	
	var closeList=function()
	{
		$("#add-btn-"+uid).show();
		powerOptionsBox.hide("fast");
	}
	
	$("#all-power2-list span").bind("dragstart",function()
	{
		
	});
	$(".target-power-contenter").bind("dragover",function(ev)
	{
		ev.preventDefault();
		$(this).addClass("over-target");
    	return true;
	})
	$(".target-power-contenter").bind("dragleave",function(ev)
	{
		ev.preventDefault();
		$(this).removeClass("over-target");
	})
	$(".target-power-contenter").bind("drop",function(ev)
	{
		$(this).removeClass("over-target");
		alert("拖拉设定正在开发中....");
	})
</script>
</body>
</html>