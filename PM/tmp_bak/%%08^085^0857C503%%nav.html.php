<?php /* Smarty version 2.6.26, created on 2013-03-06 15:47:08
         compiled from tool/nav.html */ ?>
<script src="themes/js/jquery.last.js?<?php echo @RD; ?>
"></script>
<style type="text/css">
.navList {height: 30px;left: 250px;overflow: hidden;}
.navList li{display:block;float:left;background:#B5DAFF;border:1px solid #FFF;width:80px;height:25px;line-height:25px;text-align:center;font-size:12px;}
.navList li a{text-decoration:none;display:block;height:100%;width:100%;}
.navList li a:hover{background:#FFCC00}
.nav1 .nav1,.nav2 .nav2{background:#FF9900;}
.nav1 .nav1 a,.nav2 .nav2 a{color:#FFF}
</style>
		<ul class="navList" id="navList">
			<li class="nav1"><a href="?c=tool&a=quickAccess">快速入口</a></li>
			<li class="nav2"><a href="?c=tool">页面检查</a></li>
		</ul>
<script type="text/javascript">
/*
var navList=$("#navList");
var timeOut;
function navHide(){navList.stop(true,true).animate({"height":3,"top":367},300)};
function navShow(){clearTimeout(timeOut);navList.stop(true,true).animate({"height":30,"top":340},300)};
navList.hover(function(){navShow();},function(){timeOut=setTimeout(function(){navHide()},1000);});
timeOut=setTimeout(function(){navHide()},1000);
*/
</script>