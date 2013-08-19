<?php
require_once(APP_PATH."/lib/functions.php");
//周报邮件
function sendWeekMail()
{
	import('extensions/nie-message/nie-mail.php');
	//在服务器才发，测试机不发
	if($_SERVER['HTTP_HOST']=='192.168.10.16:8080')
	{
		$mailcontent=file_get_contents("http://192.168.10.16:8080/oa/index.php?c=notice&a=weekMail");
		$mail=new nieMail;
		$result=$mail->write(array(
		'subject'=>'网站组每周需求类项目汇总（PM自动邮件）'.date("Y-m-d"),
					'body'=>$mailcontent,
					'to'=>array('web.marketing@list.nie.netease.com'),
					//'cc'=>array('ethan@corp.netease.com')
					))->send();
		if($result){
			//echo 'Mail sented!';
			}
	}
}

function pushBaseInfo($WCONFIG)
{
	$tasklist='';
	$updatelist='';
	foreach($WCONFIG["tasklist"] as $task){$tasklist.='<task time="'.$task[1].'">'.xmlReplace($task[0]).'</task>';}
	foreach($WCONFIG["updatelist"] as $update){$updatelist.='<update>'.xmlReplace($update[0]).'</update>';}
	$xml="<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
	$xml.="<root>";
	$xml.="<xmlinfo>";
	$xml.="<client_version>".$WCONFIG["client_version"]."</client_version>";
	$xml.="<updater_version>".$WCONFIG["updater_version"]."</updater_version>";
	$xml.="<request_time>".$WCONFIG["request_time"]."</request_time>";
	$xml.="<self_time>".$WCONFIG["self_time"]."</self_time>";
	$xml.="<tasklist>".$tasklist."</tasklist>";
	$xml.="<updatelist>".$updatelist."</updatelist>";
	$xml.="</xmlinfo>";
	$xml.="</root>";
	echo(trim($xml));
}

class webservice extends spController
{
	function index()
	{
		$user_account=$this->spArgs("userAccrount");
		require_once(APP_PATH."/WebServiceConfig.php");
		$todayArray=getdate();
		$m_sys=spClass('m_sys_config');
		$conf=$m_sys->find();
		$lastdate=strtotime(date('Y-m-d',strtotime($conf['sys_last_ct'])));
		$today=strtotime(date('Y-m-d'));
		
		//以下程序每天由且仅由第一个访问的人执行
		if($conf['sys_last_ct']=="" || $lastdate!=$today)
		{
				//先更新时间
				$m_sys->update(NULL,array('sys_last_ct'=>date('Y-m-d')));
				$m_msg=spClass("m_message");
				
				//***发送当天要完成的提醒***
				$sqlstr="select wrap_node.*,wrap.*,product.* from wrap_node left join wrap on wrap_node.wrap_id=wrap.wrap_id left join product on wrap.prod_id=product.prod_id  where TO_DAYS(NOW())-TO_DAYS(wnod_time)=0";
				$wnod_list=spClass("m_wrap_node")->findSql($sqlstr);
								
				foreach($wnod_list as $wnod)
				{
					$msg_context="【项目集节点提醒】：".$wnod["prod_name"]." -> ".$wnod["wrap_name"]." -> ".$wnod["wnod_name"]." ".date('Y-m-d')." 内须要完成。";
					$m_msg->toWrap($wnod["wrap_id"],$msg_context);
				}
				//***end  发送当天要完成的提醒***
				
				//删除5天之前的消息
				$sqlstr="delete from message where TO_DAYS(NOW())-TO_DAYS(msg_time)>5";
				$m_msg->findSql($sqlstr);
				
				//将过期的项目集设为完成
				spClass("m_wrap")->checkIsValid();
				
				//删除审核记录
				pmLogs("projectLastState10.txt","",false,"tmp/cache/",true);
				pmLogs("projectLastState20.txt","",false,"tmp/cache/",true);
				pmLogs("projectLastState50.txt","",false,"tmp/cache/",true);
				pmLogs("pNodesLastState15.txt","",false,"tmp/cache/",true);
				pmLogs("pNodesLastState20.txt","",false,"tmp/cache/",true);

				//**** 逢周一发周报邮件
				if($todayArray["wday"]==1){sendWeekMail();}
		}
		
		//以下程序每月由且仅由第一个访问的人执行:生日
		$sysBirthdayCreatMonth=strtotime(date('Y-m',strtotime($conf['sys_birthday_creat_date'])));
		$thisMonth=strtotime(date('Y-m'));
		if($conf['sys_birthday_creat_date']=="" || $sysBirthdayCreatMonth!=$thisMonth)
		{
			//先更新时间，减少多用户并发
			$m_sys->update(NULL,array('sys_birthday_creat_date'=>date('Y-m-d')));
			//生成生日流程
			spClass('m_user')->createBirthdayProjectWithMoth($todayArray['mon']);
		}
		pushBaseInfo($WCONFIG);
	}
	
	//通过帐号和加密密码登陆
	//string user_account
	//string user_pwd
	function login()
	{
		require_once(APP_PATH."/WebServiceConfig.php");
		$currentDate=strtotime(date('Y-m-d'));
		$user_account=$this->spArgs('user_account');
		$user_pwd=$this->spArgs('user_pwd');
		$m_user=spClass('m_user');
		$user=$m_user->loginForWebservice($user_account,$user_pwd);
		if(!$user) die("error");
		else
		{
			$todayArray=getdate();
			$user_dcode=rand(10000,99999);
			$m_user->setDCode($user_account,$user_dcode);
			//签到
			$last_login=strtotime(date('Y-m-d',strtotime($user['last_login'])));
			if($last_login<$currentDate&&$todayArray["wday"]!=6&&$todayArray["wday"]!=0)
				spClass("m_atten")->reach($user['user_id'],$WCONFIG["late"]);
			//输出登陆成功信息
			header("Content-Type: text/html; charset=utf-8");
			echo $user_dcode."|".$user['user_id'];
		}
	}
	
	//通过动态码登陆
	//string user_account
	//string checkcode
	function checkcode()
	{
		//if(isset($_GET["pwd123456"])){setcookie("pm_tester","true");}
		//if(!isset($_GET["pwd123456"])&&$_COOKIE["pm_tester"]=="") exit("hello!系统正在升级，新版本即将和大家见面！这个过程将维待一个小时左右，造成不便之处，敬请谅解。");
		$checkcode_ext="ER_OIdsw";
		$user_account=trim($this->spArgs('user_account'));
		$checkcode=$this->spArgs('checkcode');
		if($user_account==''||$checkcode=='')
			pmResult(401,NULL,"html");
		$m_user=spClass('m_user');
		$user=$m_user->find(array("user_account"=>$user_account));
		$checkcode2=strtoupper(md5($user["user_dcode"].$checkcode_ext));
		if($checkcode2==$checkcode)
		{
			if($m_user->loginSuccess($user['user_name'],$user['user_power'],$user['role_id'],$user['user_id'],$user['user_dcode'],$user['power2']))
			{
				$isInitPguser=$m_user->loginSuccess_pg($user['user_id']);
				if($isInitPguser){
					$this->jump(spUrl('pguser','welcomeInit'));
				}else{
					// $this->jump(spUrl('pguser','welcomeNotInit'));
					$this->jump(spUrl('project_bll','myWork'));
				}
			}
		}
		else
			pmResult(401,NULL,"html");;
	}
	
	
	//读取消息（暂时不带验证）
	function getmsg()
	{
		require_once(APP_PATH."/WebServiceConfig.php");
		$user_id=$_GET["userId"];
		$user_dcode=$_GET["user_dcode"];
		$now=getDate();
		if($user_id=="") die("no userId!");
		$user=spClass("m_user")->find(array("user_id"=>$user_id));
		$msgs=spClass("m_message")->getMsg($user_id);
		
		$_msgsstr="";
		foreach($msgs as &$v)
		{
			$v["title"]=str_replace("<strong>","",$v["title"]);
			$v["title"]=str_replace("</strong>","",$v["title"]);
			$v["title"]=str_replace("<br/>","\n",$v["title"]);
			if($v["type"]==1) $v["url"]=APP_URL."tpl/notice/msgbox.html#?c=webservice&a=loginJump&type=msg&act=message&userAccount={@userAccount}&userPwd={@userPwd}";
			$_msgsstr.="<msg>";
			$_msgsstr.="<type>".$v["type"]."</type>";
			$_msgsstr.="<url><![CDATA[".$v["url"]."]]></url>";
			$_msgsstr.="<value><![CDATA[".$v["title"]."]]></value>";
			$_msgsstr.="</msg>";
		}
		$xml="<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
		$xml.="<root>";
		$xml.="<data>";
		$xml.="<servertime>".($now["hours"].":".$now["minutes"].":".$now["seconds"])."</servertime>";
		$xml.=$_msgsstr;
		$xml.="</data>";
		$xml.="</root>";
		echo $xml;
	}
	
	//完成登陆并跳转
	function loginJump()
	{
		$user_account=$this->spArgs('userAccount');
		$user_pwd=$this->spArgs('userPwd');
		$type=$this->spArgs('type');
		$mUser=spClass('m_user');
		$user=$mUser->loginForWebservice($user_account,$user_pwd);
		if($user)
		{
			$mUser->loginSuccess($user['user_name'],$user['user_power'],$user['role_id'],$user['user_id'],$user['user_dcode'],$user['power2']);
			switch($type)
			{
				case"msg":
					$this->jump(spUrl("notice",$this->spArgs("act")));break;//type=1的推送内容，也就是每个信息的入口,下面的是入口点击后在浏览器打开的动作
				case"project":
					$this->jump(spUrl("project_bll","project_show",array("id"=>$this->spArgs("projId"))));break;
				case"projectC":
					$this->jump(spUrl("project_bll","project_show_check",array("id"=>$this->spArgs("projId"))));break;
				case"weekreport":
					$this->jump(spUrl("toolWeekReport","details",array("id"=>$this->spArgs("id"))));break;
				case"index":
					$this->jump(spUrl("project_bll","myWork"));break;
			}
			
		}
		else
		{
			die("地址己经过期，请重新登陆。");
		}
	}
}
