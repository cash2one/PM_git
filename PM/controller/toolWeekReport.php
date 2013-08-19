<?php
class toolWeekReport extends spController
{
	function index()
	{
		pmAuth("login","html");
		$now=getdate(strtotime(date('Y-m-d H:i:s')));
		$now["wday"]==0?$thisWday=7:$thisWday=$now["wday"];
		//dump($now["mday"]);
		$nowS=date('Y-m-d', strtotime('-'.($thisWday+6).' DAY'));
		$nowE=date('Y-m-d', strtotime('-'.($thisWday).' DAY'));
		$this->Start=$nowS;
		$this->End=$nowE;
		$this->display('toolWeekReport/index.html');
	}
	
	function my()
	{
		pmAuth("login","html");
		$this->display('toolWeekReport/my.html');
	}
	
	function check()
	{
		pmAuth("login","html");
		$this->display('toolWeekReport/check.html');
	}
	
	function getWeekReport()
	{
		$userName=pmUser("name");
		$start=$this->spArgs("start");
		$end=$this->spArgs("end");
		$pnodStateArray=getPnodState();
		if(!pmIsDate($start)||!pmIsDate($end)) pmResult('0','输入日期错误');
		$userId=pmUser("id","json");
		$targetDateS=date("Y-m-d H:i:s", strtotime($start));;
		$targetDateE=date("Y-m-d H:i:s", strtotime($end));
		$targetDateNext=date("Y-m-d H:i:s", strtotime("$end +7 DAY"));
		$mNode=spClass("m_proj_node_v");
		$mNode2=spClass("m_proj_node");
		$allRowArray=array();
		$allRelationUserArray=array();
		$allProjectIdArray=array();
		//dump($targetDateS);
		//dump($targetDateE);
		//dump($targetDateNext);
		//上周
		//项目
		$sql="select prod_name,proj_name,proj_state,prod_id,proj_id,TO_DAYS(proj_endDate)-TO_DAYS(proj_end) as finishDelay,(TO_DAYS(NOW())-TO_DAYS(proj_end)) AS unfinishDelay from project_v where ((proj_state<=15 and proj_endDate>='$targetDateS' and proj_endDate<'$targetDateE')";
		$sql.=" or (proj_state=20 AND proj_start<'$targetDateE')";
		$sql.=") and user_id=".pmFliterSqlInput($userId);
		$sql.=" ORDER BY proj_state ASC";
		$nodes=$mNode->findSql($sql);
		foreach($nodes as &$node)
		{
			$node["pnod_name"]="项目整体跟进";
			$node["faceback"]="";
			$node["pnod_id"]=0;
			$node["type"]=10;
			$node["pnod_link"]=spUrl("project_bll","project_show",array("id"=>$node["proj_id"]));
			if($node["proj_state"]<=15)
			{
				$node["stateId"]=15;
				$node["state"]='完成';
				if($node["finishDelay"]>0)
					$node["state"].='(延期'.$node["finishDelay"].'天)';
			}
			elseif($node["proj_state"]==20&&$node["unfinishDelay"]>0)
			{
				$node["stateId"]=100;
				$node["state"]='延期 '.$node["unfinishDelay"].' 天';
			}
			else
			{
				$node["stateId"]=20;
				$node["state"]='进行中';
			}
			array_push($allRowArray,$node);	
			$allProjectIdArray[$node["proj_id"]]=$node["proj_id"];
		}
		//dump($this->lastWeekDataProjects);
		//流程:(state<=15 && r>=a && s<b )  or  (state in(17,20) && s<b)
		$sql="select pnod_id,prod_name,prod_id,proj_id,pnod_id,proj_name,pnod_name,pnod_state,TO_DAYS(pnod_time_r)-TO_DAYS(pnod_time_e) as finishDelay,(TO_DAYS(NOW())-TO_DAYS(pnod_time_e)) AS unfinishDelay from proj_node_v where ((pnod_state<=15 AND pnod_time_r>='$targetDateS' AND pnod_time_s<'$targetDateE')";
		$sql.=" or (pnod_state in(17,20) AND pnod_time_s<'$targetDateE')";
		$sql.=") and user_id=".pmFliterSqlInput($userId);
		$sql.=" ORDER BY pnod_state ASC";
		$nodes=$mNode->findSql($sql);
		foreach($nodes as &$node)
		{
			$node["type"]=20;
			$node["faceback"]="";
			$node["pnod_link"]="javascript:PMS.showNode(".$node["pnod_id"].")";
			if($node["pnod_state"]<=15)
			{
				$node["stateId"]=15;
				$node["state"]='完成';
				if($node["finishDelay"]>0)
					$node["state"].='(延期'.$node["finishDelay"].'天)';
			}
			elseif($node["pnod_state"]==20&&$node["unfinishDelay"]>0)
			{
				$node["stateId"]=100;
				$node["state"]='延期 '.$node["unfinishDelay"].' 天';
			}
			else
			{
				$node["stateId"]=20;
				if($node["pnod_state"]==20)
					$node["state"]='进行中';
				else if($node["pnod_state"]==17)
					$node["state"]='审核中';
			}
			array_push($allRowArray,$node);	
			$allProjectIdArray[$node["proj_id"]]=$node["proj_id"];
		}
		//dump($nodes);

		//今周 (state<=15 && r>=b && r<c)  or  (40>=state>=20 && s<c)
		//项目
		$sql="SELECT prod_name,proj_name,prod_id,proj_id FROM project_v WHERE ((proj_state>=20 AND proj_state<=40 AND proj_start< '$targetDateNext')";
		$sql.="or (proj_state<=15 AND proj_endDate>='$targetDateE' AND proj_endDate<'$targetDateNext')";
		$sql.=") AND user_id=".pmFliterSqlInput($userId);
		$nodes=$mNode->findSql($sql);
		foreach($nodes as &$node)
		{
			$node["stateId"]=20;
			$node["state"]='';
			$node["pnod_name"]="项目整体跟进";
			$node["faceback"]="";
			$node["pnod_id"]=0;
			$node["type"]=30;
			$node["pnod_link"]=spUrl("project_bll","project_show",array("id"=>$node["proj_id"]));
			array_push($allRowArray,$node);	
			$allProjectIdArray[$node["proj_id"]]=$node["proj_id"];
		}
		//流程
		$sql="SELECT pnod_id,prod_name,proj_name,pnod_name,prod_id,proj_id,pnod_id FROM proj_node_v WHERE ((pnod_state>=20 AND pnod_state<=40 AND pnod_time_s< '$targetDateNext') ";
		$sql.="or (pnod_state<=17 AND pnod_time_r>='$targetDateE' AND pnod_time_r<'$targetDateNext')";
		$sql.=") AND user_id=".pmFliterSqlInput($userId);
		$nodes=$mNode->findSql($sql);
		foreach($nodes as &$node)
		{
			$node["type"]=40;
			$node["faceback"]="";
			$node["stateId"]=20;
			$node["state"]='';
			$node["pnod_link"]="javascript:PMS.showNode(".$node["pnod_id"].")";
			array_push($allRowArray,$node);
			$allProjectIdArray[$node["proj_id"]]=$node["proj_id"];
		}
		
		//读取相关联系人
		if($allProjectIdArray)
		{
			$allProjectIdString="";
			foreach($allProjectIdArray as $allProjectId)
			{
				if($allProjectId)
				{
			 		$allProjectIdString.=$allProjectIdString?",".$allProjectId:$allProjectId;
				}
			}
			$allRelationUserArray=$mNode2->findSql("SELECT distinct user_id FROM proj_node WHERE proj_id in(".$allProjectIdString.")");
			
		}
		//dump($mNode2->dumpSql());

		pmResult("200",array("data"=>$allRowArray,"allRelationUser"=>$allRelationUserArray),'json');
		//$rs=array("project_summary"=>$this->lastWeekDataProjects,"pnode_summary"=>$this->lastWeekDataNodes,"project_plan"=>$this->thisWeekDataProjects,"pnode_plan"=>$this->thisWeekDataNodes);	
		//$this->mailTitle="【周报】".pmUser("name")." ".$targetDateNext=date("Y-m-d");
		
		//$this->mailSubjectGB2312=urlencode(iconv("UTF-8","GB2312","【周报】".pmUser("name")))." ".$targetDateNext=date("Y-m-d");
		//this->mailSubjectUTF8=urlencode("【周报】".pmUser("name"))." ".$targetDateNext=date("Y-m-d");
		//$this->display('toolWeekReport/reportBody.html');
	}
	
	function postWeekReport()
	{
		$start=$this->spArgs("start");
		$end=$this->spArgs("end");
		$reportRow=$this->spArgs("reportRow");
		/*
		if(!is_array($reportRow)||count($reportRow)<1)
			pmResult('0','传入的数据为空。');
		*/
		if(!pmIsDate($start)||!pmIsDate($end))
			pmResult('0','输入日期错误','json');
		$userId=pmUser("id","json");
		$mReport=spClass("m_report");
		$mReportDts=spClass("m_reportDts");
		$mReportUser=spClass("m_reportUser");
		if($reprotId=$mReport->create(array("user_id"=>$userId,"start"=>$start,"end"=>$end,"faceback"=>$this->spArgs("faceback"))))
		{
			foreach($reportRow as $row)
			{
				$newRow=array();
				$newRow["prod_name"]=$row["prod_name"];
				$newRow["prod_id"]=$row["prod_id"];
				$newRow["proj_name"]=$row["proj_name"];
				$newRow["proj_id"]=$row["proj_id"];
				$newRow["pnod_name"]=$row["pnod_name"];
				$newRow["pnod_id"]=$row["pnod_id"];
				$newRow["stateid"]=$row["stateId"];
				$newRow["state"]=$row["state"];
				$newRow["faceback"]=$row["faceback"];
				$newRow["report_id"]=$reprotId;
				$newRow["type"]=$row["type"];
				$mReportDts->create($newRow);
			}
			$userArray=$this->spArgs("userArray");
			$userArrayForMessage=array();
			if(is_array($userArray)&&count($userArray)>1)
			{
				foreach($userArray as $user)
				{
					$mReportUser->create(array("report_id"=>$reprotId,"user_id"=>$user["value"]));
					array_push($userArrayForMessage,$user["value"]);
				}
			}
			//发送推送
			$mMsg=spClass("m_message");
			$mMsg->init("我写了周报，欢迎围观！",$reprotId,0,0,1,NULL,$userId,3)->toUser($userArrayForMessage)->send();
			pmResult(200,'保存成功！','json');
		}
		else
		{
			pmResult('0','保存数据失败。','json');
		}
	}
	
	function getList()
	{
		$userPower=pmUser("power","json");
		$mReport=spClass("m_report");
		$userId=$this->spArgs("userId");
		$uid=pmUser("id","json");
		//dump($userId);
		$userString="";
		//判断传过来的是不是数组
		if(is_numeric($userId))
			$userString=$userId;
		else
		{
			if(is_array($userId))
			{
				//dump($userId);
				foreach($userId as $u)
				{
					$userString.=$userString?",".$u["value"]:$u["value"];
				}
			}
		}
		//dump($userString);
		$page=$this->spArgs("page",1);
		if(!is_numeric($page))
			pmResult(400,"参数错误。",'json');
		$start=$this->spArgs("start");
		$end=$this->spArgs("end");
		if($start&&!$end||!$start&&$end)
			pmResult(400,"请填写完成时间",'json');
		$sqlstr="";
		//传入用户ID，则取指定用户数据，否则取全部数据（需要管理员权限）
		if($userId)
		{
			if($userId=="my")
				$sqlstr="SELECT report_id,start,end,user_name FROM report LEFT JOIN user on user.user_id=report.user_id WHERE report.user_id=$uid ORDER BY report_id DESC";
			else
			{ 
				if($userString!=pmUser("id","json")&&$userPower!=0)
					pmResult(403,NULL,'json');
				if($start&&$end)
					$sqlstr="SELECT report_id,start,end,user_name FROM report LEFT JOIN user on user.user_id=report.user_id WHERE report.user_id IN($userString) AND ( start>='$start' AND start<='$end' OR end>='$start' AND end <='$end' ) ORDER BY report_id DESC";
				else
					$sqlstr="SELECT report_id,start,end,user_name FROM report LEFT JOIN user on user.user_id=report.user_id WHERE report.user_id IN($userString) ORDER BY report_id DESC";
			}
		}
		else
		{
			if($userPower==0)
			{
				if($start&&$end)
					$sqlstr="SELECT report_id,start,end,user_name FROM report LEFT JOIN user on user.user_id=report.user_id  WHERE start>='$start' AND start<='$end' OR end>='$start' AND end <='$end' ORDER BY report_id DESC";
				else
					$sqlstr="SELECT report_id,start,end,user_name FROM report LEFT JOIN user on user.user_id=report.user_id ORDER BY report_id DESC";
			}
			else
			{
				if($start&&$end)
					$sqlstr="SELECT report.report_id,start,end,user_name FROM report_user LEFT JOIN report on report_user.report_id=report.report_id LEFT JOIN user on report.user_id=user.user_id WHERE report_user.user_id=$uid AND( start>='$start' AND start<='$end' OR end>='$start' AND end <='$end') ORDER BY report.report_id DESC";
				else
					$sqlstr="SELECT report.report_id,start,end,user_name FROM report_user LEFT JOIN report on report_user.report_id=report.report_id LEFT JOIN user on report.user_id=user.user_id WHERE report_user.user_id=$uid ORDER BY report.report_id DESC";
			}
		}
		if($result=$mReport->spPager($page,35)->findSql($sqlstr))
		//dump($mReport->dumpSql());
		//dump($mReport->spPager()->getPager());
		$pager=$mReport->spPager()->getPager();
		if(!$mReport->spPager()->getPager())
		{
			$pager["total_count"]=count($result);
			$pager["page_size"]=35;
			$pager["total_page"]=1;
			$pager["first_page"]=1;
			$pager["prev_page"]=1;
			$pager["next_page"]=1;
			$pager["last_page"]=1;
			$pager["current_page"]=1;
			$pager["all_pages"]=array(1);
		}
		pmResult(200,array("data"=>$result,"pager"=>$pager));
	}
	
	function details()
	{
		$reportId=$this->spArgs("id");
		if(!is_numeric($reportId))
			pmResult(400,NULL,"html");
		$user=pmUser("all","html");
		$mReport=spClass("m_report");
		$reportRows=$mReport->findSql("SELECT report.*,user_name FROM report LEFT JOIN user ON user.user_id=report.user_id WHERE report_id=$reportId");
		if(!$reportRows)
			pmResult(404,"数据不存在!","html");
		//如果不是管理员且该条周报不是本人,要进行验证是否有被抄送
		if(!$mReport->isValidUser($reportId,$user))
		{
			pmResult(403,NULL,"html");
		}
		$reportDtsRows=spClass("m_reportDts")->findAll(array("report_id"=>$reportId));
		//读取抄送的人
		$ccUser=spClass("m_reportUser")->findSql("SELECT user_name FROM report_user LEFT JOIN user on user.user_id=report_user.user_id WHERE report_id=$reportId");
		//dump($ccUser);
		//dump($mReport->dumpSql());
		$reportRows[0]["faceback"]=nl2br($reportRows[0]["faceback"]);
		/*评价*/
		$mReportFb=spClass('m_report_fb');
		$reportfbArray=$mReportFb->findAll(array('report_id'=>$reportId));
		foreach($reportfbArray as &$reportfb)
		{
			$reportfb['content']=nl2br($reportfb['content']);
		}
		$this->reportfb=$reportfbArray;
		/*e评价*/
		$this->ccUser=$ccUser;
		$this->report=$reportRows[0];
		$this->reportdts=$reportDtsRows;
		$this->display("toolWeekReport/details.html");
	}
	
	function postFaceback()
	{
		$user=pmUser('all','html');
		$content=$this->spArgs('faceback_content');
		$reportId=$this->spArgs('faceback_report_id');
		$mReport=spClass("m_report");
		$mReportFb=spClass('m_report_fb');
		if(strlen($content)<2) pmAlert('返馈字数不能少于2');
		//如果不是管理员且该条周报不是本人,要进行验证是否有被抄送
		$report=$mReport->isValidUser($reportId,$user);
		if(!$report)
		{
			pmResult(403,"没有权限查看此周报","html");
		}
		$newReportFB=array();
		$newReportFB['report_id']=$reportId;
		$newReportFB['content']=$content;
		$newReportFB['ctime']=date("Y-m-d H:i:s");
		$newReportFB['user_id']=$user['id'];
		$newReportFB['user_name']=$user['name'];
		if($mReportFb->create($newReportFB))
		{
			$mMsg=spClass("m_message");
			$mMsg->init("我评论了您的周报。",$reportId,0,0,1,NULL,$user['id'],3)->toUser($report['user_id'])->send();
			pmAlert('提交成功');
		}
		else
		{
			pmAlert('提交失败');
		}
	}
}


