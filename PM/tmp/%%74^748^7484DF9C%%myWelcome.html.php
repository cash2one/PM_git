<?php /* Smarty version 2.6.26, created on 2013-07-30 10:09:36
         compiled from pg/user/myWelcome.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'spUrl', 'pg/user/myWelcome.html', 76, false),)), $this); ?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/base.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <link type="text/css" rel="stylesheet" href="themes/css/jquery.ui.all.css?cache=<?php echo @RD; ?>
"/>
    <script type="text/javascript" src="themes/js/jquery-ui.last.js?cache=<?php echo @RD; ?>
"></script>
    <link>
    <style>
        .bubblingG {
            text-align: center;
            width:100px;
            height:63px;
            margin: 10px auto;
        }

        .bubblingG span {
            display: inline-block;

            vertical-align: middle;
            width: 13px;
            height: 13px;
            margin: 31px auto;
            background: #3697EB;
            -webkit-border-radius: 63px;
            -webkit-animation: bubblingG 1.2s infinite alternate;
        }

        #bubblingG_1 {
            -webkit-animation-delay: 0s;
        }

        #bubblingG_2 {
            -webkit-animation-delay: 0.36s;
        }

        #bubblingG_3 {
            -webkit-animation-delay: 0.72s;
        }

        @-webkit-keyframes bubblingG {
            0% {
                width: 13px;
                height: 13px;
                background-color:#3697EB;
                -webkit-transform: translateY(0);
            }

            100% {
                width: 30px;
                height: 30px;
                background-color:#fff;
                -webkit-transform: translateY(-26px);
            }
        }

    </style>

</head>
<body class="pgAdmin  userDeafult">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="wrap">
    <section class="clearfix myGrowBox_content"
             style="padding-top: 20px;padding-bottom: 20px;margin-top: 30px;text-align: center;">
        <?php if ($this->_tpl_vars['isInit']): ?>
        <div class="isinit-box" style="width: 90%;margin: 0 auto;text-align: left;">
            <h2>欢迎，<?php echo $this->_tpl_vars['user_nickname']; ?>
(<?php echo $this->_tpl_vars['user_name']; ?>
)</h2>
            <p style="font-family: microsoft yahei;">根据以往的贡献和经验，，我们为你专门配置了初始化礼包，请领取！</p>
            <ul style="margin-top: 10px;border: 1px solid #ddd;font-family: microsoft yahei;padding: 10px;background: #fff;width: 80%;">
                <li>经验：<?php echo $this->_tpl_vars['exp']; ?>
</li>
                <li>贡献：<?php echo $this->_tpl_vars['gongxian']; ?>
</li>
                <li>称谓：<?php if ($this->_tpl_vars['titleArr']): ?><?php $_from = $this->_tpl_vars['titleArr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['mycount'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['mycount']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['rs']):
        $this->_foreach['mycount']['iteration']++;
?><?php echo $this->_tpl_vars['rs']['title_name']; ?>
<?php if (($this->_foreach['mycount']['iteration'] == $this->_foreach['mycount']['total']) == 1): ?><?php else: ?>、<?php endif; ?><?php endforeach; endif; unset($_from); ?><?php else: ?>暂无<?php endif; ?></li>
            </ul>
            <a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'pguser','a' => 'mygrowrecord'), $this);?>
" class="myInfo-btn" style="float: left;" id="get-btn">点击领取</a>
        </div>
        <?php else: ?>
        <h2>HI,请联系造物主为你造一个P&G系统的角色人偶吧！</h2>

        <p style="font-family: microsoft yahei;line-height: 24px;">（该帐号下暂无PG角色）</p>
        <a href="<?php echo $this->_plugins['function']['spUrl'][0][0]->__template_spUrl(array('c' => 'project_bll','a' => 'mywork'), $this);?>
" class="myInfo-btn" style="float: none;display: block;width: 300px;margin: 10px auto;">帮你订好离开的飞机票了！点我吧</a>
        <div class="bubblingG">
            <span id="bubblingG_1">
            </span>
            <span id="bubblingG_2">
            </span>
            <span id="bubblingG_3">
            </span>
        </div>

        <?php endif; ?>
    </section>
</div>

</body>
<script>
    $(function(){
        $(".myInfo-btn").hover(function(){
            $(this).addClass('current');
        },function(){
            $(this).removeClass('current');
        })
    })
</script>
</html>