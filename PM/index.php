<?php
header("Content-Type: text/html; charset=UTF-8");
define("SP_PATH",dirname(__FILE__)."/SpeedPHP");
define("APP_PATH",dirname(__FILE__));
define("WebTitle",'网站组项目管理系统');
define("APP_URL",'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].(str_replace('index.php','',$_SERVER['PHP_SELF'])));
define("TD_URL","http://go.nie.netease.com/php");
define("RD",'20111135'); 
//exit("系统维护几分钟。");
$spConfig = array(
	"mode"=>"debug",
	"db" => array(
		'host' => 'localhost',
		'login' => 'root',
		'password' => '',
		'database' => 'pmonline',
	),
	'view' => array(
		'enabled' => TRUE, // 开启视图
		'config' =>array(
			'template_dir' => APP_PATH.'/tpl', // 模板目录
			'compile_dir' => APP_PATH.'/tmp', // 编译目录
			'cache_dir' => APP_PATH.'/tmp', // 缓存目录
			'left_delimiter' => '<{',  // smarty左限定符
			'right_delimiter' => '}>', // smarty右限定符
		),
	)
);
require(SP_PATH."/SpeedPHP.php");
require(APP_PATH."/lib/functions.php");
require(APP_PATH."/setting.php");
define("PM_power",pmUser("power")); 
define("TEACHER",pmUser_pg("p_user_id"));
spRun(); // SpeedPHP 3新特性