<?php /* Smarty version 2.6.26, created on 2013-05-13 10:01:33
         compiled from pg/admin/outcome.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'pg/admin/outcome.html', 15, false),)), $this); ?>
<!DOCTYPE html>
<html lang="zh"> 
<head>
<meta charset="utf-8">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/base.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</head>
<body class="pgAdmin outcome">
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
	<h1>列表 - 产出物一览</h1>
    <div class="tab searchTab1">
        <a id="searchTab1" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'outcomelist'), $this);?>
">表</a>
        <?php if (@PM_power == 0): ?>
        <span class="dot">&nbsp;</span>
        <a id="searchTab2" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'outcomeAdd'), $this);?>
" title="添加产出物">加</a>
        <?php endif; ?>
    </div>
</section>
<table class="table3">
<thead>
  <tr class="btop">
    <td class="bleft">序号</td>
    <td class="tleft">产出物</td>
    <td class="tleft">说明</td>
    <td class="bright">操作</td>
  </tr>
  </thead>
  <?php $_from = $this->_tpl_vars['outcomelist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['table'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['table']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['rs']):
        $this->_foreach['table']['iteration']++;
?>
  <tr>
    <td class="bleft"><?php echo $this->_foreach['table']['iteration']; ?>
</td>
    <td class="tleft"><?php echo $this->_tpl_vars['rs']['outcome_name']; ?>
</td>
    <td class="tleft"><?php echo $this->_tpl_vars['rs']['outcome_desc']; ?>
</td>
    <td class="bright"><?php if ($this->_tpl_vars['isManager']): ?><a href="javascript:;" class="del-btn" data-id="<?php echo $this->_tpl_vars['rs']['outcome_id']; ?>
" data-name="<?php echo $this->_tpl_vars['rs']['outcome_name']; ?>
">删除</a>&nbsp;<a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'outcomeEdit','outcome_id' => $this->_tpl_vars['rs']['outcome_id']), $this);?>
">修改</a><?php endif; ?></td>
  </tr>
  <?php endforeach; endif; unset($_from); ?>
	<tfoot>
	  	<tr>
			<td colspan="6">
			<?php if ($this->_tpl_vars['pager']): ?>
			<div class="pager">
			页码：<?php echo $this->_tpl_vars['pager']['current_page']; ?>
/<?php echo $this->_tpl_vars['pager']['total_page']; ?>

			<?php $_from = $this->_tpl_vars['pager']['all_pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['thepage']):
?>
			    <?php if ($this->_tpl_vars['thepage'] != $this->_tpl_vars['pager']['current_page']): ?>
					<a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'outcomelist','topage' => $this->_tpl_vars['thepage']), $this);?>
"><?php echo $this->_tpl_vars['thepage']; ?>
</a>
			    <?php else: ?>
			    	<span><?php echo $this->_tpl_vars['thepage']; ?>
</span>
			    <?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
			</div>
			<?php endif; ?>
			</td>
		</tr>
	  </tfoot>	  
  
</table>
</article>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>
<script>
    $(function(){
        $(".del-btn").live('click',function(){
            var outcomeId=$(this).attr('data-id');
            var outcomeName= $(this).attr('data-name');
            var result=confirm('确认删除"'+outcomeName+'"吗？');
            if(result){
                $.ajax({
                    url:'index.php?c=pgadmin&a=outcomedel&oid='+outcomeId,
                    type:'GET',
                    success:function(data){
                        debugger;
                        var result=JSON.parse(data);

                        alert(result.des);
                        location.reload();
                    },
                    error:function(){
                        alert('出错了！')
                    }
                })
            }

        })
    })
</script>
</html>