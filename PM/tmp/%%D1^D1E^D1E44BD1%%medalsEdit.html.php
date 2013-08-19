<?php /* Smarty version 2.6.26, created on 2013-06-17 13:52:40
         compiled from pg/admin/medalsEdit.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'pg/admin/medalsEdit.html', 23, false),)), $this); ?>
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
<body class="pgAdmin pgAdminMedalEdit medals">
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
            <h1>
     <?php if ($this->_tpl_vars['medallist']): ?>    
            	修改 - 职业 
     <?php else: ?>
     			添加 - 职业 
     <?php endif; ?>
       </h1>

            <div class="tab searchTab1">
                <a id="searchTab1" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'medallist'), $this);?>
">表</a>
                <?php if (@PM_power == 0): ?>
                <span class="dot">&nbsp;</span>
                <a id="searchTab2" href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'medalAdd'), $this);?>
" title="添加勋章">加</a>
                <?php endif; ?>
            </div>
        </section>

        <form action="<?php if ($this->_tpl_vars['medallist']): ?><?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'medalEditDo','medal_id' => $this->_tpl_vars['medallist']['medal_id']), $this);?>
<?php else: ?><?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'medalAddDo'), $this);?>
<?php endif; ?>"
              method="post" enctype="multipart/form-data">
            <section class="header clearfix"></section>
            <section class="boxstyle1 top clearfix">
                <table class="table_node">
                    <tr>
                        <td class="label">勋章图</td>
                        <td>
                            <img class="medal-pre-img" width="50" height="50" src="<?php echo $this->_tpl_vars['medallist']['medal_img']; ?>
">
                            <input name="medal_img" type="file" id="medal_img" class="medal-input"
                                   onchange="handleFiles(this.files)"/>
                            <input type="hidden" value="0" class="medal-is-change" name="medalimg_changed">
                            <input type="hidden" value="" class="medal-base64" name="medalimg_base64">
                        </td>
                    </tr>
                    <tr>
                        <td class="label">成就名</td>
                        <td>
                            <span class="li2">
	                             <input name="medal_name" type="text" id="medal_name" value="<?php echo $this->_tpl_vars['medallist']['medal_name']; ?>
" maxlength="45" class="itext stitle"/>
	                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">称谓描述</td>
                        <td>
                            <span class="li2">
	                            <input name="medal_desc" type="text" id="medal_desc" value="<?php echo $this->_tpl_vars['medallist']['medal_desc']; ?>
" maxlength="100" class="itext title"/>
	                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">掉落条件或说明</td>
                        <td>
                            <span class="li2">
	                            <input name="medal_condition" type="text" id="medal_condition" value="<?php echo $this->_tpl_vars['medallist']['medal_desc']; ?>
" maxlength="100" class="itext title"/>
	                        </span>
                        </td>
                    </tr>
                </table>

            </section>
            <section class="boxstyle2 bottom">
                <input name="" type="submit" value="提交" class="btn btn_main1"/> <a
                    href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pgadmin','a' => 'medallist'), $this);?>
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
<script type="text/javascript">
    /*
     PMS.showSelectList("users","user_id","user_name");

     $('#btn_select').click(function(){$('#user_name').val('');$('#user_id').val('0');});

     PMS.selected=function(type,user_id,user_name)
     {
     var obj_uid=$('#'+$('#inputid_'+type+'_id').val());
     var obj_una=$('#'+$('#inputid_'+type+'_name').val());
     if(obj_uid.val()==0)
     {
     obj_uid.val(user_id);
     obj_una.val(user_name);
     }
     else
     {
     obj_uid.val(obj_uid.val()+'|'+user_id);
     obj_una.val(obj_una.val()+'|'+user_name);
     }
     }
     */

    function handleFiles(files) {
        //遍历files并处理

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var imageType = /image.*/;
            //通过type属性进行图片格式过滤
            if (!file.type.match(imageType)) {
                continue;
            }
            //读入文件
            var reader = new FileReader();
            reader.onload = function (e) {
                //e.target.result返回的即是图片的dataURI格式的内容
                var imgData = e.target.result,
                        img = document.createElement('img');
                //img.src = imgData;
                //展示img
                $(".medal-pre-img").attr("src", imgData).css("visibility", "visible");
                $(".medal-is-change").val('1');
                $(".medal-base64").val(imgData);
            }
            reader.readAsDataURL(file);
        }

    }

</script>
</body>
</html>