<?php
class delaymessage extends spController
{
	private static  $first = 1;
	function begin_go_on()
	{
		$k = self::$first;
		if ($k == 0) {
			return;
		}
		self::$first = 0;
		self::$first = 0;
		ignore_user_abort();//关掉浏览器，PHP脚本也可以继续执行.
		set_time_limit(0);// 通过set_time_limit(0)可以让程序无限制的执行下去
		$interval=60*3;// 每隔3分钟运行
		do{
			$run = 1; //1表示开启定时任务，0表示关闭定时任务。
			if(!$run) {
				die('Job has ended.');
			}
			//这里是你要执行的代码
			sleep(60*60*24);// 每隔一天运行,单位是秒
			$this->checkdealy();
		}while(true);
	}
	//二级delay,弹窗通知当事人，抄送组长   （delay 2~3天）
	//三级delay,弹窗通知当事人，组长   抄送主管 （delay 3天以上）
	//一级delay和二三级的弹窗通知当事人的，已经在webservice实现了。
	private function checkdealy()
	{
		$address = APP_URL."index.php?c=project_bll&a=project_show&id=";
		$m_user = spClass("m_user");
		 $headman = array();//组长们。
		 $headman[1] = array();$headman[2] = array();$headman[3] = array();$headman[6] = array();$headman[7] = array();
		 $result = $m_user->findSql("select u.user_mail,u.role_id from user u where u.user_power=1");
		 foreach ($result as $row) {
		 	array_push($headman[$row['role_id']], $row['user_mail']);
		 }
		 $boss = array();//主管们
		 $result = $m_user->findSql("select u.user_mail from user u where u.role_id=4 or u.role_id = 5");
		 foreach ($result as $row) {
		 	array_push($boss, $row['user_mail']);
		 }
		 $m_proj_node = spClass("m_proj_node");
		 $sql = "select a.proj_id,a.proj_name,b.pnod_name,b.pnod_time_e,c.user_name,c.role_id,
		 		TIMESTAMPDIFF(day,b.pnod_time_e,NOW()) as delay_day from project a,
		 		(select pn.proj_id,pn.pnod_name,pn.pnod_time_e,pn.user_id from proj_node pn 
		 		where pn.pnod_time_r is null and TIMESTAMPDIFF(day,pn.pnod_time_e,NOW())>1 
		 		and pn.pnod_time_s >'2013-05-01 00:00:00') b, user c where a.proj_id = b.proj_id 
		 		and b.user_id = c.user_id order by c.user_name";
		 $result = $m_proj_node->findSql($sql);
		 $message = array();//信息
		 $message[1] = "";$message[2] = "";$message[3] = "";$message[6] = "";$message[7] = "";
		 $message_to_boss = "";
		 if ($result) {
		 	foreach ($result as $row) {
		 		//给组长的信息
		 		$message[$row['role_id']] = $message[$row['role_id']].$row['user_name']."在流程(<a href=\"".$address.$row['proj_id']."\">".$row['proj_name']."</a>-".$row['pnod_name'].")中delay了".$row['delay_day']."天。<br>";
		 		if ($row["delay_day"]>=3) {
		 			//给主管的信息
		 			$message_to_boss = $message_to_boss.$row['user_name']."在流程(<a href=\"".$address.$row['proj_id']."\">".$row['proj_name']."</a>-".$row['pnod_name'].")中delay了".$row['delay_day']."天。<br>";
		 		}
		 	}
		 	
		 	//开始给组长发送邮件
		 	import('extensions/nie-message/nie-mail.php');
		 	foreach ($headman as $key => $value) {
		 		$mail=new nieMail;
		 		$result=$mail->write(array(
		 				'subject'=>'组员流程delay详细单-pm系统',
		 				'body'=>$message[$key],
		 				'to'=>$value
		 		))->send();
		 	}
		 	
		 	//开始给主管发送邮件
		 	if($message_to_boss!="") {
		 		$mail=new nieMail;
		 		$result=$mail->write(array(
		 				'subject'=>'员工流程delay详细单-pm系统',
		 				'body'=>$message_to_boss,
		 				'to'=>$boss
		 		))->send();
		 	}
 		}
	}
}