<?php /* Smarty version 2.6.26, created on 2013-07-09 11:36:21
         compiled from pg/admin/missionAdd.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'pg/admin/missionAdd.html', 16, false),)), $this); ?>
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
<body class="pgAdmin mission">
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
	<h1>添加 - 任务模板</h1>
    <div class="tab searchTab1">
        <a id="searchTab2" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'missionlist'), $this);?>
">表</a>
        <?php if (@PM_power == 0): ?>
        <span class="dot">&nbsp;</span>
        <a id="searchTab1" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'mtplAdd'), $this);?>
" title="添加任务模板">加</a>
        <?php endif; ?>
    </div>
</section>

<form action="<?php if ($this->_tpl_vars['joblist']): ?><?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'jobEditDo','job_id' => $this->_tpl_vars['joblist']['job_id']), $this);?>
<?php else: ?><?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'jobAddDo'), $this);?>
<?php endif; ?>" method="post" id="mtpl-form">
	<section class="header clearfix"></section>
	<section class="boxstyle1 top clearfix" style="padding-left: 10px;">
	<table class="table_node" style="width: 680px;padding: 0;">
	  <tr>
	    <td class="label">任务模板名</td>
	    <td><span class="li2">
	      <input name="mtpl-name" type="text" id="mtpl-name" value="<?php echo $this->_tpl_vars['joblist']['job_name']; ?>
" maxlength="45"  datatype="Require" msg="任务模板名不能为空" class="itext stitle"/>
	    </span></td>
	  </tr>
	  <tr>
	    <td class="label">是否显示</td>
	    <td><span class="li2">
	      <input type="checkbox" name="is_show" id="is_show" checked>
	    </span></td>
	  </tr>
	  <tr>
	    <td class="label">任务级别</td>
	    <td><span class="li2">
	     <select id="mtpl-lv"><option>入门级别</option><option>新手级别</option><option>菜鸟级别</option></select>
	    </span></td>
	  </tr>
      <tr>
        <td class="label">项目分级</td>
        <td><span class="li2">
	            <select id="proj1-lv"><?php $_from = $this->_tpl_vars['projlv']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['rs']):
?><option value="<?php echo $this->_tpl_vars['k']; ?>
"><?php echo $this->_tpl_vars['rs']['name']; ?>
</option> <?php endforeach; endif; unset($_from); ?></select> -
                <select id="proj2-lv"><?php $_from = $this->_tpl_vars['defaultA']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['rs']):
?><option value="<?php echo $this->_tpl_vars['k']; ?>
"><?php echo $this->_tpl_vars['rs']; ?>
</option> <?php endforeach; endif; unset($_from); ?></select>
	    </span></td>
      </tr>
      <tr>
         <td class="label" style="vertical-align: top;">任务流程</td>
         <td class="flow-box">

             <a href="javascript:;" id="add-flow-btn">添加流程</a>
         </td>
      </tr>
      <tr>
          <td class="label">任务奖励</td>
          <td>贡献值：<input class="itext" id="mtpl-gx"></span> </td>
      </tr>
      <tr>
          <td class="label" style="vertical-align: top;">模板描述</td>
          <td><span class="li2">
              <textarea class="itext" style="resize: none;width: 436px;line-height: 24px;padding: .5em;" rows="5" id="mtpl-desc"></textarea>
          </span> </td>
      </tr>
	</table>

	</section>
	<section class="boxstyle2 bottom">
		<input id="submit-btn" type="button" value="提交" class="btn btn_main1"/> <a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'missionlist'), $this);?>
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
<script type="text/template" id="nodeclass">
    {<?php $_from = $this->_tpl_vars['nodecls']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['mycounta'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['mycounta']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['rs']):
        $this->_foreach['mycounta']['iteration']++;
?>
    "<?php echo $this->_tpl_vars['k']; ?>
":{"name":"<?php echo $this->_tpl_vars['rs']['name']; ?>
","data":[<?php $_from = $this->_tpl_vars['rs']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['mycountb'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['mycountb']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['ik'] => $this->_tpl_vars['irs']):
        $this->_foreach['mycountb']['iteration']++;
?>{"value":"<?php echo $this->_tpl_vars['ik']; ?>
","name":"<?php echo $this->_tpl_vars['irs']; ?>
"}<?php if (($this->_foreach['mycountb']['iteration'] == $this->_foreach['mycountb']['total']) == 1): ?><?php else: ?>,<?php endif; ?><?php endforeach; endif; unset($_from); ?>]}<?php if (($this->_foreach['mycounta']['iteration'] == $this->_foreach['mycounta']['total']) == 1): ?><?php else: ?>,<?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>
    }
</script>

<script type="text/template" id="flow-item-tpl">
     <span class="li2 flow-item">
	 流程名：<input type="text"  maxlength="45" class="itext stitle flow-name"/><br>
	     流程类型：
         <select class="flow-type1"><?php $_from = $this->_tpl_vars['nodecls']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['rs']):
?><option value="<?php echo $this->_tpl_vars['k']; ?>
"><?php echo $this->_tpl_vars['rs']['name']; ?>
</option> <?php endforeach; endif; unset($_from); ?></select>&nbsp;
         <select class="flow-type2">
             <?php $_from = $this->_tpl_vars['nodecls'][1]['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ik'] => $this->_tpl_vars['irs']):
?><option value="<?php echo $this->_tpl_vars['ik']; ?>
"><?php echo $this->_tpl_vars['irs']; ?>
</option> <?php endforeach; endif; unset($_from); ?>
	     </select>
         时间安排：
         <select class="flow-start-time"></select> 至
         <select class="flow-end-time"></select>
         <a class="del-flow-btn" href="javascript:;"></a>

         
         <span class="flow-item-one flow-item-outcome">
              <!-- <a href="javascript:;" class="add-outcome-btn">添加产出物</a> -->
             <strong style="font-weight:bold">产出物</strong>：<input class="outcome-list">
          </span>
         <span class="flow-item-count">1</span>
	 </span>
</script>
<script type="text/javascript">
$(function(){
    //流程模板
    var flowItemTpl=$('#flow-item-tpl').html();
    //服务器获取到的json
    var flowTypeData=JSON.parse($('#nodeclass').html());
    //第几天
    function renderDays(ele,days){
        var $ele=$(ele);
        var html='';
        for(var i=1;i<=days;i++){
            html+='<option value="'+i+'">第'+i+'天</option>';
        }
        $ele.html(html);
    }

    //渲染select2
    $('select').select2({});
    $("#proj2-lv").select2({width:'220px'});

    //增加流程
    $("#add-flow-btn").click(function(){
         $(flowItemTpl).insertBefore($(this));
         var $newNode=$(this).prev();
         var len=$('.flow-item').length;
         var outcomeArr='<?php $_from = $this->_tpl_vars['outcome']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['mycountb'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['mycountb']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['ik'] => $this->_tpl_vars['irs']):
        $this->_foreach['mycountb']['iteration']++;
?><?php echo $this->_tpl_vars['irs']['outcome_name']; ?>
<?php if (($this->_foreach['mycountb']['iteration'] == $this->_foreach['mycountb']['total']) == 1): ?><?php else: ?>,<?php endif; ?><?php endforeach; endif; unset($_from); ?>'.split(',');
         $newNode.find('.flow-item-count').html(len);
         renderDays($newNode.find('select.flow-start-time'),30);
         renderDays($newNode.find('select.flow-end-time'),30);
         $(this).parent().find('select').select2({});
         /*下拉框的样式*/
         $('select.flow-type2').select2({width:'110px'});
         $('select.skill-exp-sel').select2({width:'130px'});
         $('select.sk-lv').select2({width:'30px'});
         /*end*/
         $newNode.find('.outcome-list').select2({
             width:'396px',
             tags:outcomeArr
         });
    });
    // 删除流程
    $(".del-flow-btn").live('click',function(){
         $(this).parent().detach();
         $('.flow-item .flow-item-count').each(function(index){
              $(this).html(index+1);
         })
    });

    //绑定触发
    $("#proj1-lv").change(function(){
        var Id=$(this).val();
        $.ajax({
            url:'index.php?c=pgadmin&a=mtpl_projlv_change',
            type:'GET',
            data:'projlv1=' + Id,
            success:function (data) {
                var re=JSON.parse(data).data;
                var html='';
                $.each(re ,function(i){
                    html+='<option value="'+i+'">'+re[i]+'</option>';
                });
                console.log(html);
                $("#proj2-lv").html(html).select2({width:'200px'});
            },
            error:function () {
                alert('鼠标别点那么快！人家还在loading！')
            }
        })
    })
    //绑定流程数据
    $(".flow-type1").live('change',function(){
        var selHtml2='';
        var topValue=$(this).val();
        var data=flowTypeData[topValue].data;
        $.each(data,function(i){
            selHtml2+='<option value="'+data[i].value+'">'+data[i].name+'</option>';
        })
        $(this).parent().find('.flow-type2').html(selHtml2);
        $(this).parent().find('select.flow-type2').select2({width:'110px'});
    })
    //确认提交
    $("#submit-btn").click(function(){
    	var bb = $('#is_show:checked');
    	var is_show=bb.length;
        var url='<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'mtpladd_do'), $this);?>
';
        var mtplName=$("#mtpl-name").val();
        var mtplLv=$("#mtpl-lv").val();
        var mtplProj1lv=$("#proj1-lv").val();
        var mtplProj2lv=$("#proj2-lv").val();
        var mtplGx=$("#mtpl-gx").val();
        var mtplDesc=$('#mtpl-desc').val();
        var mtplFlow=[];
        $(".flow-item").each(function(i){
            mtplFlow.push({
            	'flow_name':$(this).find('input.flow-name').val(),
                'flow_type1':$(this).find('select.flow-type1').val(),
                'flow_type2':$(this).find('select.flow-type2').val(),
                'flow_time_s':$(this).find('select.flow-start-time').val(),
                'flow_time_e':$(this).find('select.flow-end-time').val(),
                'flow_outcome': $(this).find('input.outcome-list').val(),
                'flow_skill1':$(this).find('select.skill1-id').val(),
                'flow_skill1_exp':$(this).find('input.skill1-exp').val(),
                'flow_skill2':$(this).find('select.skill2-id').val(),
                'flow_skill2_exp':$(this).find('input.skill2-exp').val(),
                'flow_skill3':$(this).find('select.skill3-id').val(),
                'flow_skill3_exp':$(this).find('input.skill3-exp').val(),
                'flow_skill3_lv':$(this).find('select.skill3-lv').val(),
                'flow_skill2_lv':$(this).find('select.skill2-lv').val(),
                'flow_skill1_lv':$(this).find('select.skill1-lv').val()
            })
        })
        $.ajax({
            url:url,
            type:'POST',
            data:'mtplName='+mtplName+'&is_show='+is_show+'&mtplLv='+mtplLv+'&mtplProj1lv='+mtplProj1lv+'&mtplProj2lv='+mtplProj2lv+'&mtplGx='+mtplGx+'&mtplDesc='+mtplDesc+"&mtplFlowArr="+JSON.stringify(mtplFlow),
            success:function(data){
                if(JSON.parse(data).status=='200'){
                    alert('更新成功！')
                    window.location.href='<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'missionlist'), $this);?>
';
                }else{
                    alert(JSON.parse(data).data);
                }
            }
        })
    })



})
</script>
</body>
</html>