<?php /* Smarty version 2.6.26, created on 2013-08-12 19:49:09
         compiled from user/edit.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'user/edit.html', 22, false),array('modifier', 'escape', 'user/edit.html', 154, false),)), $this); ?>
<!DOCTYPE html>
<html lang="zh"> 
<head>
<meta charset="utf-8">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/base.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript" src="themes/js/vilidate.js"></script>
</head>

<body class="manage users">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<article class="content">

	<section class="search">
		<h1>添加/修改 - 通讯通</h1>
		<div class="tab searchTab2">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "user/nav.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
	</section>
	
	<form id="userform" action="
	<?php if ($this->_tpl_vars['user']): ?>
	<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'user','a' => 'edit_do','user_id' => $this->_tpl_vars['user']['user_id']), $this);?>

	<?php else: ?>
	<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'user','a' => 'add_do'), $this);?>

	<?php endif; ?>
	" method="post" onSubmit="return checkit()">
	<section class="header clearfix"></section>
	<section class="boxstyle1 top clearfix">


	<table class="table1 f2" width="900">
	
	<?php if ($this->_tpl_vars['isShowAll'] == true): ?>
	  <tr>
	    <td>类型</td>
	    <td>
	      <select name="role_id" id="role_id" class="itext" onchange="roleChange(this.value)">
		  <?php $_from = $this->_tpl_vars['role_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['value'] => $this->_tpl_vars['roleName']):
?>
		  <?php if ($this->_tpl_vars['value'] == $this->_tpl_vars['user']['role_id']): ?>
	        <option value="<?php echo $this->_tpl_vars['value']; ?>
" selected="selected"><?php echo $this->_tpl_vars['roleName']; ?>
</option>	  	
		  <?php else: ?>
	        <option value="<?php echo $this->_tpl_vars['value']; ?>
"><?php echo $this->_tpl_vars['roleName']; ?>
</option>
		  <?php endif; ?>
		  <?php endforeach; endif; unset($_from); ?>
	      </select>
	    </td>
	  </tr>
	  
	  <tr id="row_power">
	    <td>权限</td>
	    <td>
	      <select name="user_power" id="user_power" class="itext" >
		  <?php $_from = $this->_tpl_vars['power_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['value'] => $this->_tpl_vars['name']):
?>
		  <?php if ($this->_tpl_vars['value'] == $this->_tpl_vars['user']['user_power']): ?>
	        <option value="<?php echo $this->_tpl_vars['value']; ?>
" selected="selected"><?php echo $this->_tpl_vars['name']; ?>
</option>	  	
		  <?php else: ?>
	        <option value="<?php echo $this->_tpl_vars['value']; ?>
"><?php echo $this->_tpl_vars['name']; ?>
</option>
		  <?php endif; ?>
		  <?php endforeach; endif; unset($_from); ?>		
	      </select>    
	    </td>
	  </tr>  
	<?php endif; ?>
	
	  <tr>
	    <td width="12%">姓名</td>
	    <td width="88%">
	      <input name="user_name" type="text" id="user_name" value="<?php echo $this->_tpl_vars['user']['user_name']; ?>
" class="itext stitle"  datatype="Require" msg="姓名不能为空"<?php if ($this->_tpl_vars['isShowAll'] != true): ?>readonly="readonly" style="background:#E9E9E9;border:none" <?php else: ?> <?php endif; ?>/>
	    <?php if ($this->_tpl_vars['all_user'] != null): ?>
	    	外包<input type="checkbox" id="is_out" name="isout" onclick="is_out_click()">
	    	<input type="hidden" id="respon_id" name="respon_id" value="0">
	    	<span id="respon_span">
	    	负责人:<select id="respon" name="respon">
	    		<?php $_from = $this->_tpl_vars['all_user']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
	    		<option value="<?php echo $this->_tpl_vars['rs']['user_id']; ?>
"><?php echo $this->_tpl_vars['rs']['user_name']; ?>
</option>
	    		<?php endforeach; endif; unset($_from); ?>
	    	</select>
	    	</span>
	    <?php endif; ?>
	    </td>
	  </tr>
	  
	  <tr id="row_nickname">
	    <td>昵称</td>
	    <td>
	      <input name="user_nickname" type="text" id="user_nickname" value="<?php echo $this->_tpl_vars['user']['user_nickname']; ?>
" class="itext stitle" <?php if ($this->_tpl_vars['user']['user_nickname'] != "" && $this->_tpl_vars['isShowAll'] != true): ?>readonly="readonly" style="background:#E9E9E9;border:none" <?php else: ?>  onblur="sAccountExit2(this)" rel="check"<?php endif; ?> />
		  <span id="account_error2" style="padding:0 10px"></span><span style="color:#666;font-size:12px">此信息会写入网页的meta标签里，作为负责人识别，推荐使用英文名。</span>
	    </td>
	  </tr>  
	  
	  <tr id="row_account">
	    <td>帐号</td>
	    <td>
	      <input name="user_account" type="text" id="user_account" value="<?php echo $this->_tpl_vars['user']['user_account']; ?>
" class="itext stitle"
		  <?php if ($this->_tpl_vars['isShowAll'] != true): ?>readonly="readonly" style="background:#E9E9E9;border:none" <?php else: ?> onblur="sAccountExit(this)" rel="check" <?php endif; ?>/>
		  <span id="account_error" style="padding:0 10px"></span>
	    </td>
	  </tr>
	  <tr id="row_pwd">
	    <td>密码</td>
	    <td>
	      <input name="user_pwd" type="password" id="user_pwd" value="" class="itext stitle" /><span style="padding:0 10px;font-size:12px;color:#666">不修改请留空</span>
	    </td>
	  </tr>
	  <tr>
	    <td>邮箱</td>
	    <td>
	      <input name="user_mail" type="text" id="user_mail" value="<?php echo $this->_tpl_vars['user']['user_mail']; ?>
" class="itext stitle" datatype="Require" msg="邮件不能为空"/>
	    </td>
	  </tr>
	  
	  <tr id="row_cellphone">
	    <td>手机号码</td>
	    <td>
	      <input name="user_cellphone" type="text" id="user_cellphone" value="<?php echo $this->_tpl_vars['user']['user_cellphone']; ?>
" class="itext stitle"/>
	    </td>
	  </tr>
	  
	  <tr id="row_telephone">
	    <td>座机号码</td>
	    <td>
	      <input name="user_telephone" type="text" id="user_telephone" value="<?php echo $this->_tpl_vars['user']['user_telephone']; ?>
" class="itext stitle"/>
	    </td>
	  </tr>    
	  
	  
	  <?php if ($this->_tpl_vars['user']['user_bdaytype'] == "" || $this->_tpl_vars['isShowAll'] == true): ?> 
	  <tr id="row_birthday1">
	    <td>生日</td>
	    <td>
			<label><input type="radio" name="user_bdaytype" <?php if ($this->_tpl_vars['user']['user_bdaytype'] == '3' || $this->_tpl_vars['user']['user_bdaytype'] == ""): ?> checked="checked" <?php endif; ?> value="3" class="calendarClass"/> 新历</label>
			<label><input type="radio" name="user_bdaytype" <?php if ($this->_tpl_vars['user']['user_bdaytype'] == '4'): ?> checked="checked" <?php endif; ?>  value="4" class="calendarClass"/> 农历</label>
	   </td>
	  </tr>  
	  
	  <tr id="row_birthday2">
	    <td>&nbsp;</td>
	    <td>
			<select name="user_month" id="user_month" style="width:80px;text-align:center" class="itext"></select>月　
			<select name="user_day" id="user_day" style="width:80px;text-align:center" class="itext"></select>日
	   </td>
	  </tr>
	  <?php else: ?>
	  <tr id="row_birthday1">
	    <td>生日</td>
	    <td>
			<?php echo $this->_tpl_vars['user']['user_bday2']; ?>

			
	   </td>
	  </tr>  
	  <?php endif; ?> 
	  <tr>
	  	<td>标签</td>
	  	<td><input name="user_info" id="user_info" type="text" class="itext title" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['user']['user_info'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" maxlength="200"/></td>
	  </tr>
	  <?php if ($this->_tpl_vars['showUpload']): ?>
	  <tr>
	  	<td valign="top">头像</td>
	  	<td valign="middle">
			<iframe src="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'user','a' => 'upload_face'), $this);?>
" frameborder="0" width="500" height="35"></iframe>
			<p>请自行裁切 65*90 像素的 .jpg 图片</p>
	  	</td>
	  </tr>
	  <?php endif; ?>
	</table>
	
	</section>
	
	<section class="boxstyle2 bottom" style="height:42px;overflow:hidden">
		<input type="hidden" name="ismodifyoder" value="<?php echo $_GET['id']; ?>
" />
		<input name="input" type="submit" value="提交" class="btn btn_main1"/>
		<a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'user','a' => 'showlist'), $this);?>
" class="btn btn_main2">返回</a>
	</section>
	<section class="footer"></section>
	
</form>
</article>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script>

<?php if ($this->_tpl_vars['user'] && $this->_tpl_vars['user']['respon_id'] != 0): ?>
$('#is_out').attr('checked',true);
$('#respon_id').val(<?php echo $this->_tpl_vars['user']['respon_id']; ?>
);
$('#respon').val(<?php echo $this->_tpl_vars['user']['respon_id']; ?>
);
<?php else: ?>
$("#respon_span").hide();
<?php endif; ?>
$('#respon').select2({
    width:'200px'
});
$('#s2id_respon').attr('style','width: 200px;top: -8px;position: relative;');
$("#respon").change(function () {
	$('#respon_id').val($(this).val());
});
function is_out_click() {
	var checkbox = $('#is_out').attr('checked');
	if(!checkbox)
	{
		$("#respon_span").hide();
		$('#respon_id').val("0");
	}else
	{
		$("#respon_span").show();
		$('#respon_id').val($("#respon").val());
	}
}
	function sAccountExit(e)
	{
		$('#account_error').html('checking...');
		var user_id="<?php echo $this->_tpl_vars['user']['user_id']; ?>
";
		if(user_id=="")
			user_id=0;
		var user_account=e.value;
		var reg=/^\w{3,20}$/;
		if(!reg.test(e.value)) {$('#account_error').html('不可用').css('color','red'); return;}		
		$.get(
			  '<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'user','a' => 'isAccountExit'), $this);?>
&user_account='+user_account+'&user_id='+user_id,
			  function(rs)
			  {
				  if(rs==0)
				  	$('#account_error').html('可用').css('color','green');
				  else
				  	$('#account_error').html('不可用').css('color','red');
			  })
	}
	
	function sAccountExit2(e)
	{
		$('#account_error2').html('checking...');
		var user_id="<?php echo $this->_tpl_vars['user']['user_id']; ?>
";
		if(user_id=="")
			user_id=0;
		var user_account=e.value;
		var reg=/^[\+\w]{1,20}$/;
		if(!reg.test(e.value)) {$('#account_error2').html('不可用').css('color','red'); return;}
		$.get(
			  '<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'user','a' => 'isAccountExit2'), $this);?>
&user_account='+user_account+'&user_id='+user_id,
			  function(rs)
			  {
				  if(rs==0)
				  	$('#account_error2').html('可用').css('color','green');
				  else
				  	$('#account_error2').html('不可用').css('color','red');
			  })
	}	
	
	
	function checkit()
	{
		if($('#account_error2').html()=='不可用'&&$('#account_error').html()=='不可用'){alert("表单仍有错误在，请检查。");return false;};
		var reg=/^[\+\w]{1,20}$/;
		return Validator.Validate(document.getElementById("userform"),2);
	}
	
	
	function roleChange(param)
	{
		if(param==100||param==101)
		{
			$("#row_account").hide();
			$("#row_nickname").hide();
			$("#row_pwd").hide();
			$("#row_birthday1").hide();
			$("#row_birthday2").hide();
			if(param==101)
			{
				$("#row_cellphone").hide();
				$("#row_telephone").hide();
			}
			else
			{
				$("#row_cellphone").show();
				$("#row_telephone").show();
			}
			$("#user_power option[value=100]").attr("selected","selected");
			$("#user_power").attr("disabled","true");
			$("#row_power").hide();
		}
		else
		{
			$("#row_account").show();
			$("#row_nickname").show();
			$("#row_pwd").show();
			$("#row_birthday1").show();
			$("#row_birthday2").show();
			$("#row_cellphone").show();
			$("#row_telephone").show();
			$("#user_power").removeAttr("disabled");
		}
	}	
	
	$(function()
	{
		<?php if ($this->_tpl_vars['actionType'] == 'addByUser'): ?>
		roleChange(100);
		<?php endif; ?>
		var user_bmonth="<?php echo $this->_tpl_vars['user']['user_bmonth']; ?>
";
		var user_bday="<?php echo $this->_tpl_vars['user']['user_bday']; ?>
";
		if (user_bmonth=="") user_bmonth=1;
		if (user_bday=="") user_bday=1;
		var user_birthtype =$("input[name='user_bdaytype']:checked").val(); 
		if(user_birthtype==4){PMS.date.create("user_month","month_o",user_bmonth);PMS.date.create("user_day","day_o",user_bday);}
		else {PMS.date.create("user_month","month",user_bmonth);PMS.date.create("user_day","day",user_bday);}
		$(".calendarClass").click(function(){
										   if($(this).val()==3){PMS.date.create("user_month","month",user_bmonth);PMS.date.create("user_day","day",user_bday);}
										   else if($(this).val()==4){PMS.date.create("user_month","month_o",user_bmonth);PMS.date.create("user_day","day_o",user_bday);}
										   })
	})
</script>
</body>
</html>