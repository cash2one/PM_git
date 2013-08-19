<?php
class notice extends spController
{
	function weekReport()
	{
		import('extensions/nie-message/nie-mail.php');
		$mailcontent=file_get_contents("http://192.168.10.16:8080/oa/index.php?c=notice&a=weekMail");
		$mail=new nieMail;
		$result=$mail->write(array(
			'subject'=>'网站组每周需求类项目汇总（PM自动邮件） 抄送测试'.date("Y-m-d"),
			'body'=>$mailcontent,
			'to'=>array('web.marketing@list.nie.netease.com'),
			'cc'=>array('ethan@corp.netease.com')
		))->send();
		if($result){
			//echo 'Mail sented!';
		}
	}
	
	function weekMail()
	{
		$now=getdate(strtotime(date('Y-m-d H:i:s')));
		$mProject=spClass("m_project");
		//$nowS=$nowE=getdate(strtotime(date('2011-09-18 00:00:00')));
		//dump($now);
		$now["wday"]==0?$thisWday=7:$thisWday=$now["wday"];
		$nowS=date('Y-m-d H:i:s', strtotime('-'.($thisWday+7).' DAY'));
		$nowE=date('Y-m-d H:i:s', strtotime('-'.($thisWday-1).' DAY'));
		//dump($nowS);
		//dump($nowE);
		$arrayLast=array();
		$arrayNext=array();
		$cProjectsLast=$mProject->findSql("SELECT project.prod_id,prod_ename,proj_name,proj_url,prod_name FROM project LEFT JOIN product on project.prod_id=product.prod_id where proj_endDate>'$nowS' and proj_endDate<'$nowE' and proj_state<=15 ORDER BY project.prod_id");
		//dump($mProject->dumpSql());
		foreach($cProjectsLast as $cProjectLast)
		{
			//$arrayLast[$cProjectLast["prod_id"]]
			if($arrayLast[$cProjectLast["prod_id"]]=="") $arrayLast[$cProjectLast["prod_id"]]=array();
			array_push($arrayLast[$cProjectLast["prod_id"]],$cProjectLast);
		}
		
		//dump($arrayLast);
		$cProjectsNext=spClass("m_project")->findSql("SELECT project.prod_id,project.proj_id,prod_ename,proj_name,proj_url,prod_name FROM project LEFT JOIN product on project.prod_id=product.prod_id where proj_state=20 ORDER BY project.prod_id");
		//dump($cProjectsNext);
		
		$connString;

		$cNodesNext=spClass("m_project")->findSql("SELECT proj_id,pnod_name FROM proj_node where pnod_state=20 ORDER BY pnod_time_s ASC");
		
		foreach($cProjectsNext as &$p)
		{
			foreach($cNodesNext as $next)
			{
				if($next["proj_id"]==$p["proj_id"])
				$p["nodes"]==""?$p["nodes"]=$next["pnod_name"]:$p["nodes"].=" | ".$next["pnod_name"];
			}
			if($p["nodes"]=="") $p["nodes"]="流程均已完成，请进行提交。";
			if($arrayNext[$p["prod_id"]]=="") $arrayNext[$p["prod_id"]]=array();
			array_push($arrayNext[$p["prod_id"]],$p);
		}
		//dump($arrayNext);
		
		$this->arrayLast=$arrayLast;
		$this->arrayNext=$arrayNext;
		$this->cNodesNext=$cNodesNext;
		$this->display("notice/weekReport.html");
	}
	
	function message()
	{
		$mMessage=spClass("m_msg_user");
		$user_id=pmUser("id","html");
		$user=spClass("m_user")->find(array("user_id"=>$user_id));
		$user_power=$user["user_power"];
		$user_role=$user["role_id"];
		$sqlstr="SELECT  prod_name,project.proj_id,proj_name,proj_node.pnod_name,message.*,pnod_state,proj_state,mu_id";
		$sqlstr.=" FROM msg_user";
		$sqlstr.=" LEFT JOIN message ON msg_user.msg_id=message.msg_id";
		$sqlstr.=" LEFT JOIN project ON project.proj_id=message.proj_id";
		$sqlstr.=" LEFT JOIN proj_node ON proj_node.pnod_id=message.pnod_id";
		$sqlstr.=" LEFT JOIN product ON project.prod_id=product.prod_id";
		$sqlstr.=" WHERE msg_user.user_id=$user_id";
		$msglist=$mMessage->findSql($sqlstr);
		$mMessage->delete(array("user_id"=>$user_id));
		$this->msglist=$msglist;
		$this->display("notice/message.html");
	}
	
	function todayWork()
	{
		$user_id=pmUser("id","html");
		$pnodes=spClass("m_proj_node_v")->getUnFinish($user_id);
		$projects=spClass("m_project_v")->findAll(array("user_id"=>$user_id,"proj_state"=>20));
		
		$this->pnodState=getPnodState();
		$this->title="今天未完成的工作";
		$this->pnodes=$pnodes;
		$this->projects=$projects;
		$this->display("notice/taskList.html");
	}
	
	function delayWork()
	{
		$user_id=pmUser("id","html");
		$pnodes=spClass("m_proj_node_v")->getDelay($user_id);
		$projects=spClass("m_project_v")->getDelay($user_id);
		$this->pnodState=getPnodState();
		$this->title="己经延期的工作";
		$this->pnodes=$pnodes;
		$this->projects=$projects;
		$this->display("notice/taskList.html");
	}
	
	function unSubmitWork()
	{
		$user_id=pmUser("id","html");
		$pnodes=spClass("m_proj_node_v")->getUnSumbit($user_id);
		$projects=spClass("m_project_v")->getUnSumbit($user_id);
		$this->pnodState=getPnodState();
		$this->title="还没提交的工作";
		$this->pnodes=$pnodes;
		$this->projects=$projects;
		$this->display("notice/taskList.html");
	}
	
	function atten()
	{
		$this->today=date("Y-m-d");
		$this->attendId=$this->spArgs("attendId");
		$this->display("notice/atten.html");
	}
	
	function attenDo()
	{
		$atten_id=$this->spArgs("attendId");
		$describe=$this->spArgs("describe");
		$type=$this->spArgs("lateType");
		spClass("m_atten")->update(array("atten_id"=>$atten_id),array("describes"=>$describe,"type"=>$type));
		$this->display("notice/atten.html");
	}
}