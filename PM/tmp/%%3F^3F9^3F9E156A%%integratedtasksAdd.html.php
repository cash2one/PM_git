<?php /* Smarty version 2.6.26, created on 2013-07-09 11:36:30
         compiled from pg/admin/integratedtasksAdd.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'pg/admin/integratedtasksAdd.html', 16, false),)), $this); ?>
<!DOCTYPE html>
<html lang="zh" xmlns="http://www.w3.org/1999/html">
<head>
<meta charset="utf-8">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/base.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</head>
<body class="pgAdmin integrated-tasks">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="wrap">
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pg/admin/pgadminNav.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<article class="content">

<section class="search">
	<h1>添加 - 综合任务模板</h1>
    <div class="tab searchTab1">
        <a id="searchTab2" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'integratedtasks'), $this);?>
">表</a>
        <?php if (@PM_power == 0): ?>
        <span class="dot">&nbsp;</span>
        <a id="searchTab1" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'integrated_tasks_add'), $this);?>
" title="添加任务模板">加</a>
        <?php endif; ?>
    </div>
</section>

<form action="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'integrated_tasks_add_do'), $this);?>
" method="post" id="mtpl-form">
	<section class="header clearfix"></section>
	<section class="boxstyle1 top clearfix" style="padding-left: 10px;">
	<table class="table_node" style="width: 680px;padding: 0;">
	  <tr>
	    <td class="label">综合任务模板名</td>
	    <td><span class="li2">
	      <input name="integrated_name" type="text" id="integrated_name" value="" maxlength="45"  datatype="Require" msg="综合任务模板名不能为空" class="itext stitle"/>
	    </span></td>
	  </tr>
	  <tr>
	    <td class="label">父任务模板</td>
	    <td><span class="li2">
	     <select name="select_parent" id="select_parent">
			<?php $_from = $this->_tpl_vars['mtpl']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs1']):
?>
				<option value="<?php echo $this->_tpl_vars['rs1']['mtpl_id']; ?>
"><?php echo $this->_tpl_vars['rs1']['mtpl_name']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
			</select>
	    </span></td>
	  </tr>
      <tr>
         <td class="label" style="vertical-align: top;">子任务模板</td>
         <td class="flow-box">
             <div>
    		 </div> 
         </td>
      </tr>
      <tr>
      	<td colspan="2">
    		<span class="beforePnode_add">
    		添加-子任务模板
    		</span>
    	</td>
      </tr>
      <tr>
          <td class="label" style="vertical-align: top;">模板描述</td>
          <td><span class="li2">
              <textarea class="itext" style="resize: none;width: 436px;line-height: 24px;padding: .5em;" rows="5" id="integrated_desc"></textarea>
          </span> </td>
      </tr>
	</table>

	</section>
	<section class="boxstyle2 bottom">
		<input id="submit-btn" type="button" value="提交" class="btn btn_main1"/> <a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'integratedtasks'), $this);?>
" class="btn btn_main2">返回列表</a>
	</section>
	<section class="footer"></section>
	</form>
</article>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!--nodeclass data-->

<script type="text/javascript">
var str = "<div class=\"integrated_div\"><select name=\"before_select\" >"+
			<?php $_from = $this->_tpl_vars['mtpl']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs1']):
?>
				"<option value=\"<?php echo $this->_tpl_vars['rs1']['mtpl_id']; ?>
\"><?php echo $this->_tpl_vars['rs1']['mtpl_name']; ?>
</option>"+
			<?php endforeach; endif; unset($_from); ?>
			"</select><input type=\"button\" class=\"btnc btnc_del integrated_del\"></div>";


$(".beforePnode_add").click(function(){
	addChildren(0);
})
$(function(){
   

    //渲染select2
    $('select').select2({width:'320px'});

    
    

    
    
    //确认提交
    $("#submit-btn").click(function(){
    	
    	var bb = $('.integrated_div select');
    	var bb_length = bb.length;
    	var select_data = new Array();
    	for(var i=0;i<bb_length;i++)
    	{
    		select_data[i] = $(bb[i]).val();
    	}
        var url='<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'integrated_tasks_add_do'), $this);?>
';
        var integrated_name = $('#integrated_name').val();
        var integrated_desc = $('#integrated_desc').val();
        var select_parent = $('#select_parent').val();
        $.ajax({
            url:url,
            type:'POST',
            data:{integrated_name:integrated_name,select_parent:select_parent,select_child:select_data,integrated_desc:integrated_desc},
            success:function(data){
                if(JSON.parse(data).status=='200'){
                	alert(JSON.parse(data).data);
                    window.location.href='<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'integratedtasks'), $this);?>
';
                }else{
                    alert(JSON.parse(data).data);
                }
            }
        })
    })



})

function addChildren(selectId){
	$(".flow-box").append(str);
	$(".flow-box div:last select").val(selectId);
	
	$(".integrated_del").click(function(){
		$(this).parent().remove();
	})
	$('select').select2({width:'320px'});
}
</script>
</body>
</html>