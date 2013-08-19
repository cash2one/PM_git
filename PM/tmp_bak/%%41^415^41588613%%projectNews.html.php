<?php /* Smarty version 2.6.26, created on 2013-05-12 09:20:12
         compiled from project/projectNews.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'project/projectNews.html', 23, false),array('modifier', 'default', 'project/projectNews.html', 47, false),array('modifier', 'date_format', 'project/projectNews.html', 51, false),)), $this); ?>
<!DOCTYPE html>
<html lang="zh"> 
<head>
<meta charset="utf-8">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/base.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript" src="themes/js/jquery.last.js"></script>
<script type="text/javascript" src="themes/js/comm.ui.js"></script>
<style type="text/css">
.table3 a{color:#0165B0;text-decoration:underline}
.table3 a:hover{text-decoration:none}
.table3 .event{font-size:12px;line-height: 20px;padding-left:15px;background:url(themes/images/icon3.png) 0 5px no-repeat;margin-bottom:5px;}
.table3 .time{color:#989898;display:block;}
.table3 td p{height:auto}
</style>
</head>
<body class="manage projects">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<article class="content">

	<section class="search">
		<h1>项目动态</h1>
		<div class="tab searchTab4">
			<a id="searchTab1" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project','a' => 'show'), $this);?>
">全</a>
            <span class="dot">&nbsp;</span>
			<a id="searchTab2" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project','a' => 'show','type' => 2), $this);?>
" title="今天需要完成的项目">今</a>
            <span class="dot">&nbsp;</span>
			<a id="searchTab3" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project','a' => 'show','type' => 3), $this);?>
" title="已经延期的项目">延</a>
            <span class="dot">&nbsp;</span>
			<a id="searchTab4" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project','a' => 'news'), $this);?>
" title="项目的新动态">新</a>
		</div>
	</section>
	
<?php if ($this->_tpl_vars['events']): ?>
    <table class="table3">
      <thead>
      <tr class="btop">
      	<td width="10%" class="bleft">产品</td>
		<td width="10%">类型</td>
        <td width="50%" class="tleft">项目/最新动态</td>
        <td width="10%">负责人</td>
        <td width="20%" class="bright">进度</td>
      </tr>
      </thead>
      <?php $_from = $this->_tpl_vars['events']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
      <tr class="rowcolor<?php echo $this->_tpl_vars['rs'][0]['proj_state']; ?>
">
        <td class="bleft" valign="top"><?php echo $this->_tpl_vars['rs'][0]['prod_name']; ?>
</td>
		<td valign="top"><?php echo ((is_array($_tmp=@$this->_tpl_vars['rs'][0]['className'])) ? $this->_run_mod_handler('default', true, $_tmp, "其它") : smarty_modifier_default($_tmp, "其它")); ?>
</td>
        <td class="tleft" valign="top">
			<p class="title"><a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project_bll','a' => 'project_show','id' => $this->_tpl_vars['rs'][0]['proj_id']), $this);?>
" target="_blank"><?php echo $this->_tpl_vars['rs'][0]['proj_name']; ?>
</a></p>
			<?php $_from = $this->_tpl_vars['rs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rows']):
?>
			<p class="event"> <?php echo $this->_tpl_vars['rows']['user_name']; ?>
 <?php echo $this->_tpl_vars['rows']['even_name']; ?>
 <?php if ($this->_tpl_vars['rows']['pnod_name']): ?>（<a onclick="PMS.showNode(<?php echo $this->_tpl_vars['rows']['pnod_id']; ?>
)"><?php echo $this->_tpl_vars['rows']['pnod_name']; ?>
</a>）<?php endif; ?><?php echo $this->_tpl_vars['rows']['even_content']; ?>
 <span class="time fNum"><?php echo ((is_array($_tmp=$this->_tpl_vars['rows']['even_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d %h:%n:%s") : smarty_modifier_date_format($_tmp, "%m/%d %h:%n:%s")); ?>
</span></p>
			<?php endforeach; endif; unset($_from); ?>
		</td>
        <td valign="top"><?php echo $this->_tpl_vars['rs'][0]['user_name']; ?>
</td>
        <td valign="top" class="bright"><span class="stateicon stateicon_<?php echo $this->_tpl_vars['rs'][0]['proj_state']; ?>
"><?php echo $this->_tpl_vars['rs'][0]['stateName']; ?>
</span></td>
      </tr>
      <?php endforeach; endif; unset($_from); ?>
	  <tfoot>
	  	<tr>
			<td colspan="5">
			<?php if ($this->_tpl_vars['pager']): ?>
			<div class="pager">
			页码：<?php echo $this->_tpl_vars['pager']['current_page']; ?>
/<?php echo $this->_tpl_vars['pager']['total_page']; ?>

			<?php $_from = $this->_tpl_vars['pager']['all_pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['thepage']):
?>
			    <?php if ($this->_tpl_vars['thepage'] != $this->_tpl_vars['pager']['current_page']): ?>
					<a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project_bll','a' => 'projects','p' => $this->_tpl_vars['thepage'],'ssid' => $this->_tpl_vars['proj_state'],'spid' => $this->_tpl_vars['prod_id'],'sd1' => $this->_tpl_vars['search_dates'],'sd2' => $this->_tpl_vars['search_datee']), $this);?>
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
<?php else: ?>
<p>查无记录。</p>
<?php endif; ?>

</article>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>
</html>