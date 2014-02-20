<?php
class pnode extends spController
{
	//流程详细显示
	function getNode()
	{
		$user=pmUser("all","html");
		$pnod_id=$this->spArgs('pnod_id');
		$pnod_c=spClass('m_proj_node_v');
		$mPnod=spClass('m_proj_node');
		if($pnod=$pnod_c->find('pnod_id='.$pnod_id))
		{
			//流程状态处于待审核并且是管理员才显示通过审核按钮
			if($pnod['pnod_state']=='17'&&$this->spArgs('pass')&&($user["power"]=='0'||$user["power"]=='1'))
			{
				$this->isShowPassBtn='1';
				//如果延期，显示相关选项
				$dalayDayCount=$mPnod->dalayDayCountWithNode($pnod);
				if($dalayDayCount>0)
				{
					$this->pmDelayReasonArray=pmDelayReasonArray();
				}
			}
			else
				$this->isShowPassBtn='0';

			$events=spClass('m_event')->findSql("select event.*,user_name FROM event LEFT JOIN user on event.user_id=user.user_id where pnod_id=$pnod_id");
			$f=spClass('m_files');
			$this->setScore=$this->spArgs('setScore');
			$this->scoreNameArray=pmScoreNameArray();
			$this->checkProject=$this->spArgs('checkProject','1');
			$this->files=$f->findAll('pnod_id='.$pnod_id);
			$this->pnod=$pnod;
			$this->events=$events;
			$this->pnod_id = $pnod_id;
			$this->proj_id = $pnod['proj_id'];
			$this->display('project/node.html');
		}
		else
		{
			pmResult(404,"流程不存在","html");
			exit();
		}
	}
		
	function getNodes()
	{
		$proj_id=$this->spArgs("projId");
		if(!is_numeric($proj_id)) pmResult('0','错误的参数。','json');
		$pnodes=spClass("m_proj_node")->findSql("SELECT pnod_name,pnod_state,pnod_time_s,pnod_time_e,user_name FROM proj_node LEFT JOIN user on proj_node.user_id=user.user_id WHERE pnod_state>=20 and proj_id=$proj_id");
		foreach($pnodes as &$pnode)
		{
			$pnode["pnod_time_s"]=date('Y-m-d',strtotime($pnode["pnod_time_s"]));
			$pnode["pnod_time_e"]=date('Y-m-d',strtotime($pnode["pnod_time_e"]));
		}
		echo(json_encode($pnodes));
	}
	
	//流程保存
	function pnodSave()
	{
		$user_id=pmUser("id","json");
		$user_name=pmUser("name");
		$m_pnod=spClass('m_proj_node');
		$pnod_name=$this->spArgs('pnod_name');
		$pnod_id=$this->spArgs('pnod_id');
		$pnod_user_name=$this->spArgs('user_name');
		$pnod_day=$this->spArgs('pnod_day');
		$type=$this->spArgs('type');
		if($type=="mywork") 
			{if(!is_numeric($pnod_id)) pmResult("0","修改失败，传入正确的主键值是必须的。",'json');}
		else
			{if(!is_numeric($pnod_id)||$pnod_name=="") pmResult("0","修改失败，传入正确的流程名和主键值是必须的。",'json');}
			
		$Sql=pmGetTablesSQL("proj_node","pnod_id",array("proj_node.*","user.user_name"),array("user"),array("proj_node.user_id=user.user_id"),"pnod_id=".pmFliterSqlInput($pnod_id));
		//dump($Sql);
		//die();
		if($pnod_day&&!is_numeric($pnod_day)) pmResult("0","预计工作天数必须是数字",'json');
		
		$oPnods=$m_pnod->findSql($Sql);
		$oPnod=$oPnods[0];
		
		//if($oPnod["pnod_state"]<20&&PM_power>1)  die('{"rs":"0","des":"修改失败，已经完成的流程是不能修改的。"}');
		
		$m_proj=spClass("m_project");
		
		if($m_proj->isUser($oPnod["proj_id"])==false) die('{"rs":"0","des":"修改失败，你没有修改这个流程的权限。"}');
		
		if($this->spArgs('pnod_time_s')!="")
			$pnod["pnod_time_s"]=$this->spArgs('pnod_time_s');
		if($this->spArgs('pnod_time_e')!="")
			$pnod["pnod_time_e"]=$this->spArgs('pnod_time_e');			
		if($this->spArgs('user_id_n')!="")
			$pnod["user_id"]=$this->spArgs('user_id_n');
		if($this->spArgs('pnod_name')!="")
		$pnod["pnod_name"]=$pnod_name;
		if($pnod_day)
			$pnod["pnod_day"]=$pnod_day;
		
		$conn=array('pnod_id'=>$pnod_id);
		if($aa=$m_pnod->update($conn,$pnod))
		{
			//如果流程己经开始，则需要进行记录
			if($oPnod["pnod_state"]!=50)
			{
				//创建操作事件
				$oPnodString=$oPnod['pnod_name'].",".$oPnod["user_name"].",".date('Y-m-d',strtotime($oPnod["pnod_time_s"]))." -> ".date('Y-m-d',strtotime($oPnod["pnod_time_e"])). " 改为  <br/>";
				$nPnodString='<strong>'.$pnod['pnod_name'].",".$pnod_user_name.",".$pnod["pnod_time_s"]." -> ".$pnod["pnod_time_e"]."</strong><br/>";			
				spClass('m_event')->set(2,"修改了流程","$oPnodString$nPnodString",$oPnod["proj_id"],$oPnod["pnod_id"],$user_id);
				
				//创建通知信息
				$msg_context.=$user_name." 修改了流程 <strong>".$pnod['pnod_name']."</strong> ，最新的状态是:".$pnod["pnod_name"]."，".$pnod_user_name."，".$pnod["pnod_time_s"]."->".$pnod["pnod_time_e"]."<br/>";
				$msg=spClass('m_message');
				$msg->init($msg_context,$oPnod["proj_id"],$pnod_id)->toProject()->send();
			}
			
			//输出成功标识
			echo '{"rs":"1","des":"修改成功！"}';
		}
		else
		{
			echo '{"rs":"0","des":"修改过程中出现了某些错误，请向系统管理员反映。"}';
		}
	}
	//2013.10.15 外包设计同步一个单到CC & doudou 17
    function pnodAnsyc($pnode,$proj_id,$pnod_state=20){
        $role=pmUser('role');
        $power=pmUser('power');
        $mPnod=spClass('m_proj_node');
       // if(/*$role==2&&$power==1*/pmUser('id')==114){
            //MAX.设计师审核员
            $pnode['proj_id']=$proj_id;
            $pnode['pnod_state']=$pnod_state;
			/*
            $pnode['user_id']=83;//hack  写死了CCuserid
            if(!$mPrond_id=$mPnod->create($pnode))
                pmResult('0','操作失败：流程插入失败','json');
			*/
            $pnode['user_id']=17;//hack  写死了doudou userid
            if(!$mPrond_id=$mPnod->create($pnode))
                pmResult('0','操作失败：流程插入失败','json');

        //  }
        return $mPrond_id;
    }
    function getCPId(){
        //hack! 写死外包设计的id 145
        return 145;
    }
    function getCPId2(){
        return 88;
    }
	//保存全部流程
	function pnodSaveAll()
	{
		$proj_id=$this->spArgs('proj_id');
		$checkrs=spClass('m_project')->isCanMidify($proj_id);//已经带验证
		$userInfo=$checkrs['userInfo'];
		$oProject=$checkrs['project'];
        $user=pmUser("all","html");
		$userName=pmUser("name");
		if($checkrs['rs']!=1)
            if($user['role']!=1)
			pmResult('0','操作失败：'.$checkrs['des'],'json');

		$allRowsArray=$this->spArgs("allRowsData");
		$mPnod=spClass('m_proj_node');
		$pnodSQLSelect=array();

        //改为发邮件 2014.01.24 -志鹏
        $projectName=spClass('m_project')->find(array('proj_id'=>$proj_id));
        $projectName=$projectName['proj_name'];
        //echo $projectName;
		
		//过滤生成最终要写入数据库的数据
		function getModifyArray($array)
		{
			if(count($array)<3) return NULL;
			$newArray=array();
			if($array["pnod_name"]) $newArray["pnod_name"]=$array["pnod_name"]; //else return NULL;//必填
			if($array["pnod_type"]) $newArray["pnod_type"]=$array["pnod_type"]; //else return NULL;//必填
			if($array["pnod_type2"]) $newArray["pnod_type2"]=$array["pnod_type2"]; //else return NULL;//必填
			if($userInfo["power"]<2&&$array["pnod_day"])  $newArray["pnod_day"]=$array["pnod_day"];
			if($array["user_id_n"]) $newArray["user_id"]=$array["user_id_n"];
			if($array["pnod_time_s"]) $newArray["pnod_time_s"]=$array["pnod_time_s"];
			if($array["pnod_time_e"]) $newArray["pnod_time_e"]=$array["pnod_time_e"];
			return $newArray;
		}

		
		//
		$Sql=pmGetTablesSQL("proj_node","pnod_id",array("proj_node.*","user.user_name"),array("user"),array("proj_node.user_id=user.user_id"),"proj_id=".pmFliterSqlInput($proj_id));
		//dump($Sql);
		//die();
		$oPnods=$mPnod->findSql($Sql);
		
		$mMessage=spClass('m_message');
  		$msg_context="<strong>"."$userName </strong>进行了如下操作：<br/>";
		
		//是否需要记录和通知
		if($oProject["proj_state"]==50) $isWillRecord=false;
		else $isWillRecord=true;;
		
		//dump($oPnods);
		//修改
		foreach($oPnods as $oPnod)
		{
			//dump($allRowsArray[$oPnod["pnod_id"]]);
			if($allRowsArray[$oPnod["pnod_id"]])
			{
				$aRow=$allRowsArray[$oPnod["pnod_id"]];
				if($oPnod['pnod_state']<17) pmResult('0','操作失败：['.$oPnod['pnod_name'].']这个流程不能修改','json');
				if($aRow["isNew"]==0)
				{
					$targetData=getModifyArray($aRow);
					//dump($targetData);
					if($targetData)
					{
						$pnodSQLSelect=array("pnod_id"=>$aRow["pnod_id"]);
						if(!$mPnod->update($pnodSQLSelect,$targetData)) pmResult('0','操作失败：['.$oPnod['pnod_name'].']流程修改失败','json');
                        //外包单同步！！！1.外包合同类
                        if($targetData['user_id']==$this->getCPId()){
                            $cpPnodId=$this->pnodAnsyc($targetData,pmFliterSqlInput($proj_id),$oPnod['pnod_state']);
                            $mMessage->init("有新的外包设计单到啦！具体情况鸡胖懒得写了，程序逻辑很复杂啊。总之就是有新的外包设计单啦！快去看看(￣▽￣)/",$proj_id,$cpPnodId)->toUser(array(83,17,114))->send();
                        }
                        //外包单同步！！！2.外包设计类
                        if($targetData['user_id']==$this->getCPId2()){
                            $cpPnodId=$this->pnodAnsyc($targetData,pmFliterSqlInput($proj_id),$oPnod['pnod_state']);
                            $mMessage->init("有新的外包设计单到啦！这是设计外包的，非合同类的！快去看看(￣▽￣)/",$proj_id,$cpPnodId)->toUser(array(17,114))->send();
                        }

						//如果流程己经开始，则需要进行记录和通知
						if($isWillRecord)
						{
							$msg_context.="修改了流程 <strong>".$oPnod['pnod_name']."</strong> ,最新的状态是:".$aRow["pnod_name"].",".$aRow["user_name"].",".$aRow["pnod_time_s"]."->".$aRow["pnod_time_e"]."<br/>";
							$oPnodString=$oPnod['pnod_name'].",".$oPnod["user_name"].",".date('Y-m-d',strtotime($oPnod["pnod_time_s"]))." -> ".date('Y-m-d',strtotime($oPnod["pnod_time_e"])). " 改为  <br/>";
							$nPnodString='<strong>'.$aRow['pnod_name'].",".$aRow["user_name"].",".$aRow["pnod_time_s"]." -> ".$aRow["pnod_time_e"]."</strong><br/>";
							
							spClass('m_event')->set(2,"修改了流程","$oPnodString$nPnodString",$oPnod["proj_id"],$oPnod["pnod_id"],$userInfo["id"]);
							
							//如果负责人有变，则双方都发出通知
							if($oPnod["user_id"]!=$aRow["user_id_n"])
							{
								if($oPnod["user_id"])
									$mMessage->init("$userName 将您负责的流程 <strong>".$oPnod['pnod_name']."</strong> 转移给 <strong>".$aRow["user_name"]."</strong> 负责",$proj_id,$oPnod["pnod_id"])->toUser($oPnod["user_id"])->send();
								if($aRow["user_id_n"])
									$mMessage->init("$userName 将流程 <strong>".$oPnod['pnod_name']."</strong> 转移给您负责",$proj_id,$oPnod["pnod_id"])->toUser($aRow["user_id_n"])->send();
							}
						}
					}
				}
			}
		}
		
		
		
		//插入
		foreach($allRowsArray as $aRow)
		{
			if($aRow["isNew"]==1)
			{
				$targetData=getModifyArray($aRow);
				$targetData['proj_id']=$proj_id;
				$targetData['pnod_state']=20;//juetion 改为直接进入进行
				//$targetData['pnod_state']=$oProject["proj_state"];
				//流程默认要求审核
				$targetData["pnod_state2"]=1;
				//dump($targetData);
				if($targetData){
					if(!$mPrond_id=$mPnod->create($targetData))  
						pmResult('0','操作失败：流程插入失败','json');
                    //外包单同步！！！
                    if($targetData['user_id']==$this->getCPId()){
                        $cpPnodId=$this->pnodAnsyc($targetData,pmFliterSqlInput($proj_id));
                        $mMessage->init("有新的外包设计单到啦！具体情况鸡胖懒得写了，程序逻辑很复杂啊。总之就是有新的外包设计单啦！快去看看(￣▽￣)/",$proj_id,$cpPnodId)->toUser(array(83,17,114))->send();
                    }
                    if($targetData['user_id']==$this->getCPId2()){
                        $cpPnodId=$this->pnodAnsyc($targetData,pmFliterSqlInput($proj_id),$oPnod['pnod_state']);
                        $mMessage->init("有新的外包设计单到啦！这是设计外包的，非合同类的！快去看看(￣▽￣)/",$proj_id,$cpPnodId)->toUser(array(17,114))->send();
                    }
                    //外包单同步end。
                }
				if($isWillRecord)
				{
					$mMessage->init("$userName 将流程 <strong>".$aRow['pnod_name']."</strong> 按排给您负责",$proj_id)->toUser($aRow["user_id_n"])->send();
					$msg_context.="添加流程 <strong>".$aRow['pnod_name']."</strong> :负责人：".$aRow["user_name"]." 时间:".$aRow["pnod_time_s"]."->".$aRow["pnod_time_e"]."</br>";
				}
			}
		}
		if($isWillRecord){
            //$mMessage->init($msg_context,$proj_id,$pnod_id)->toProject()->send();
            $isIncPuser=true;
            $isIncProdUser=false;
            $user_array=array();
        //2014.01.22 改为发邮件，太懒了，不抽象类了，直接在这里写吧
            //取得项目所有相关人员
            $user_rela = spClass("m_project")->findSql("select user_id from proj_node where proj_id=" . $proj_id . " and user_id<>''");
            foreach ($user_rela as $k) {
                array_push($user_array, $k["user_id"]);
            }
            //$user_array=array_merge($user_array,$user_rela);
            //加入项目负责人
            $project = spClass("m_project")->find(array("proj_id" => $proj_id));
            if ($isIncPuser) array_push($user_array, $project["user_id"]);
            //加入产品负责人
            if ($isIncProdUser) {
                $user_array2 = spCLass("m_product")->getUserArray($project["prod_id"], $fron_str = "p");
                //dump($user_array2);
                if ($user_array2) $user_array = array_merge($user_array, $user_array2);
            }
            //dump($user_array); die();
            //$userList = array_merge($userList, $user_array);
           // echo json_encode($user_array);
            //构造邮件主题内容：
            $mailContent='<!DOCTYPE html><head><style>strong{color:#FF3000;}</style></head><body style="font-family:microsoft yahei;padding:10px;line-height:2"><p style="font-size:16px;line-height:28px;">PM项目：<a href="http://192.168.10.16:8080/oa/index.php?c=project_bll&a=project_show&id='.$proj_id.'">'.$projectName.'</a><p><hr><p style="font-size:14px;">'.$msg_context.'</p></body></html>';
           // echo $mailContent;
            import('extensions/nie-message/nie-mail.php');
            $mailToArray=array();
            foreach($user_array as $id){
                $mailTo=spClass('m_user')->find(array('user_id'=>$id));
               array_push($mailToArray,$mailTo['user_mail']);
            }
            $mail=new nieMail;
            $result=$mail->write(array(
                'subject'=>'【PM系统通知】项目流程变动通知-'.date("Y-m-d"),
                'body'=>$mailContent,
                'to'=>$mailToArray
            ))->send();
        }

        //2014.01.22 改为发邮件，太懒了，不抽象类了，直接在这里写吧 end

		pmResult('1','操作成功！','json');
	}
	

	//流程删除_用于 ajax请求
	function pnodDel()
	{
		$pnod_id=$this->spArgs('pnod_id');
		$mPnod=spClass('m_proj_node');
		$user_name=pmUser("name");
		if(!is_numeric($pnod_id)) pmResult("0","修改失败，传入正确的主键值是必须的。",'json');
		$oPnod=$mPnod->find(array("pnod_id"=>$pnod_id));
		if($oPnod["pnod_state"]<20) pmResult("0","删除失败，修改失败，已经完成的流程是不能删除的。",'json');
		if(spClass('m_project')->isUser($oPnod["proj_id"])==false) pmResult("0","删除失败，只能修改自己的项目，或者登陆信息已经失效。",'json');
		$userCount = $mPnod->findSql("select pp.proj_id,pp.user_id,count(pp.user_id) as count from proj_node pp
									where pp.proj_id in (select pn.proj_id from proj_node pn where pn.pnod_id =".$pnod_id.")
									and pp.user_id in (select pn.user_id from proj_node pn where pn.pnod_id =".$pnod_id.")
									GROUP BY pp.user_id");
		if($mPnod->deleteByPk($pnod_id))
		{
			//juetion start 删除流程对应的技能
			$m_pg_pron_skill = spClass("m_pg_pron_skill");
			
			if ($userCount) {
				$userCount_first = $userCount[0];
				if ($userCount_first['count']==1) {
					$m_pg_pron_skill->delete(array(proj_id=>$userCount_first['proj_id'],user_id=>$userCount_first['user_id']));
				}
			}
			//删除对应的前置流程配置
			$m_pg_pron_skill->runSql("DELETE from pron_check where pron_id =".$pnod_id." or p_pron_id =".$pnod_id);
			//juetion end
			spClass('m_message')->init("流程 <strong>".$oPnod["pnod_name"]."</strong> 已经被 $user_name 删除。",$oPnod["proj_id"],$pnod_id)->toUser($oPnod["user_id"])->toProject()->send();
			pmResult("1","删除成功！",'json');
		}
		else
		{
			pmResult("1","删除失败，请联系管理员。",'json');
		}
	}
	
	//待安排流程
	function getUnfull()
	{
		$user_id=pmUser("id","json");
		$user_power=pmUser("power");
		$user_role=pmUser("role","html");
		$mNode=spClass('m_proj_node_v');
		if($user_power<2)
		{
			//审核员以上安排流程
            // 2013.10.24 MAX 增加一个留空设计师的需求。 留空设计师的id为147
			$condition="(user_id=0 or user_id=147 or pnod_time_s is NULL or pnod_time_e is NULL) and pnod_state<50 and pnod_state>15 and res_user_id<>$user_id";
            //max只需要 2013.10.30 读取待安排的设计流程
            if($user_role==2){
                $condition.=" and pnod_type=$user_role";
            }
            // end max
			if($user_power==1)
				$condition.=" and pnod_type=$user_role";
			$rows_rs=$mNode->findAll($condition);
			if(!$rows_rs)$rows_rs=array();
		}

		//一般人安排的流程
		$condition="(user_id=0 or pnod_time_s is NULL or pnod_time_e is NULL) and pnod_state<50 and pnod_state>15 and res_user_id=".$user_id;
		$rows_rs2=$mNode->findAll($condition);
		if(!$rows_rs) $rows_rs=array();
		if(!$rows_rs2)$rows_rs2=array();
		$rows_rs=array_merge($rows_rs,$rows_rs2);
		foreach($rows_rs as &$cNode)
		{
			if($cNode["pnod_time_s"])$cNode["pnod_time_s"]=pmFormatDate($cNode["pnod_time_s"]);
			if($cNode["pnod_time_e"])$cNode["pnod_time_e"]=pmFormatDate($cNode["pnod_time_e"]);
		}
		echo(json_encode($rows_rs));
	}
	
	//流程库
	function show()
	{
		$user_id=pmUser("id","html");
        $powerSHIXI=pmUser("power");

		$rows=spClass('m_proj_node_v');
		$prod_id=$this->spArgs('spid',false);
		$prod_name=$this->spArgs('spn');
		$srole=$this->spArgs('srole');
		$sroleid=$this->spArgs('sroleid');
		$proj_state=$this->spArgs('ssid');
		$search_dates=$this->spArgs('sd1');
		$search_datee=$this->spArgs('sd2');
		$search_key=$this->spArgs('sk');
		$toPage=$this->spArgs('p','1');
		if(!is_numeric($toPage)) $toPage=1;
		$type=$this->spArgs('type','1');//2-今天要完成的 3-延期的 10-组内
		$oUserId=$this->spArgs('oUserId');
        if($powerSHIXI==255&&!$oUserId){
            pmResult(403,'实习生权限不足，请按后退。程序猿太懒，懒得写界面了。','html');
        }
        $ctype=$this->spArgs('ctype');
		if($search_dates=="开始日期") $search_dates="";
		if($search_datee=="结束日期") $search_datee="";
		if($search_dates!="")
			if(pmIsDate($search_dates)==false){echo('<script type="text/javascript">alert("请输入正确的日期1。")</script>');$this->jump(spUrl('pnode','show'));}
		if($search_datee!="")
			if(!pmIsDate($search_datee)){echo('<script type="text/javascript">alert("请输入正确的日期2。")</script>');$this->jump(spUrl('pnode','show'));}

		switch($type)
		{
            /*
			case "2":$condition= 'pnod_state in(17,20) and (TO_DAYS(NOW())-TO_DAYS(pnod_time_e))>=0';$this->title="今天要完成 - 流程";break;
			case "3":$condition= 'pnod_state in(17,20) and (TO_DAYS(NOW())-TO_DAYS(pnod_time_e))>0';$this->title="己经延期 - 流程";$sort=" ORDER BY delay1 DESC";break;
            */

            case "10":
                $condition= ' proj_class <> 5';
                $condition=$this->childQuery($ctype,$condition);
                $this->title="网站组内提单 - 项目";
                $sort=" ORDER BY proj_id DESC";
                break;
            case "100":
                $condition= ' prod_id = 10 AND proj_class = 5';
                $condition=$this->childQuery($ctype,$condition);
                $this->title="redmine单 - 项目";
                $sort=" ORDER BY proj_id DESC";
                break;
            case "1000":
                $condition=$this->groupInSearch();
                $condition=$this->childQuery($ctype,$condition);
                $this->title="小组内 - 项目";
                $sort=" ORDER BY proj_id DESC";
                break;
			default:
                $condition='';
                switch($ctype)
                {
                    case "2":
                        $condition.= 'pnod_state in(20,40) and (TO_DAYS(NOW())-TO_DAYS(pnod_time_e))>=0';
                        break;
                    case "3":
                        $condition.= 'pnod_state in(20,40) and (TO_DAYS(NOW())-TO_DAYS(pnod_time_e))>0';
                        break;
                    default:
                        break;
                }
				if($proj_state=='a')
				{
					$condition= 'pnod_state<>50';
				}
				elseif(is_numeric($proj_state)) $condition= 'pnod_state='.$proj_state;
				$sort=" ORDER BY pnod_id DESC";
				$this->title="全部 - 流程";
				break;
		}
		
		if($prod_id)
		{
			if($condition!='') $condition.=' AND ';
			$condition.='prod_id='.$prod_id;
		}
		
		if($search_dates!=""&&$search_datee!="")
		{
			if($condition!='') $condition.=' AND ';
			$search_datee2=$search_datee." 23:59:59";
			//$condition.="(pnod_time_s>='".$search_dates."' and pnod_time_s<='".$search_datee."' or (pnod_time_r>='".$search_dates."' and pnod_state<=15 or pnod_time_e>='".$search_dates."') and  (pnod_state>15 and pnod_time_r<='".$search_datee2."' and pnod_state<=15 or pnod_time_e<='".$search_datee2."' and  pnod_state>15))";	
			$condition.="(pnod_time_s>='$search_dates' and pnod_time_s<='$search_datee' or (pnod_state<=15 and pnod_time_r>='$search_dates' and pnod_time_s<='$search_datee') or (pnod_state>15 and pnod_time_e>='$search_dates' and pnod_time_s<='$search_datee') or (pnod_state<=15 and pnod_time_s<='$search_dates' and pnod_time_r>='$search_datee') or (pnod_state>15 and pnod_time_s<='$search_dates' and pnod_time_e>='$search_datee'))";	
			
		}
		if($sroleid!=0)
		{
			if($condition!='') $condition.=' AND ';
			$condition.="role_id=$sroleid";
			$this->sroleid=$sroleid;
			$this->srole=$srole;
		}
		if($search_key!="")
		{
			if($condition!='') $condition.=' AND ';
			$condition.="pnod_name like '%$search_key%'";
		}
		if(is_numeric($oUserId))
		{
			if($condition!='') $condition.=' AND ';
			$condition.="user_id=".$oUserId;
		}
		
		if($condition!='') $condition=' WHERE '.$condition;
		
		//$condition="WHERE pnod_name like '%flash%'";
		
		$sql="SELECT *,(TO_DAYS(NOW())-TO_DAYS(pnod_time_e)) AS delay1,(TO_DAYS(pnod_time_r)-TO_DAYS(pnod_time_e)) AS delay2 FROM proj_node_v ".$condition.$sort;
        //die($sql);
		$rows_rs=$rows->spPager($toPage,50)->findSql($sql);
		$now=date("Y-m-d H:i:s");
		//dump($rows_rs);
		foreach($rows_rs as &$_temrows)
		{
			if($_temrows["pnod_state"]<=15&&$_temrows["pnod_state"]!="")
			{
				$_temrows["delay"]=$_temrows["delay2"];
				//流程完成时，将结束时间改为实际完成时间（暂停了）
				//$_temrows["pnod_time_e"]=$_temrows["pnod_time_r"];
			}
			else  $_temrows["delay"]=$_temrows["delay1"];
		}
		$this->pager=$rows->spPager()->getPager();
		$this->rows=$rows_rs;
		$this->prod_id=$prod_id;
		if($prod_id) $this->prod_name=$rows_rs[0]["prod_name"];
		$this->proj_state=$proj_state;
		$this->search_dates=$search_dates;
		$this->search_datee=$search_datee;
		$this->search_key=$search_key;	
		$this->state_list=getPnodState();
        $this->type=$type;
        $this->ptype=$type;
        $this->ctype=$ctype;
        if(pmUser("group")){
            $this->hasGroup=pmUser("group");
        }
		if($oUserId)
		{
			$this->oUserId=$oUserId;
			$this->display('project/myNodes.html');
		}
		else $this->display('project/nodes.html');
	}

    //查询组内单
    function groupInSearch(){
        $groupId=pmUser("group");
        $condition='';
        if($groupId){
            $group=spClass('m_group');
            $returnArr=array();
            $prodArr=$group->getProdArray($groupId);
            foreach($prodArr as $item){
                array_push($returnArr,$item['prod_id']);
            }
            $returnStr=join($returnArr,',');

            $condition= "(prod_id in (".$returnStr.") or proj_redprd in (".$returnStr."))";
        }
        // dump($condition);
        return $condition;
    }
    //二级菜单
    function childQuery($type,$condition){
        $re=$condition;
        switch($type)
        {
            case "2":
                $re.= ' and pnod_state in(20,40) and (TO_DAYS(NOW())-TO_DAYS(pnod_time_e))>=0';
                break;
            case "3":
                $re.= ' and pnod_state in(20,40) and (TO_DAYS(NOW())-TO_DAYS(pnod_time_e))>0';
                break;
            default:
                break;
        }
        return $re;
    }

	
//流程状态更改
	function setState()
	{
		$user=pmUser("all","json");
		$pnod_id=$this->spArgs('pnod_id');
		$state=$this->spArgs('state');
		$isPnodeFinishOnCommitTime=$this->spArgs('isPnodeFinishOnCommitTime');
		if($isPnodeFinishOnCommitTime==1)
			$isPnodeFinishOnCommitTime="Last";
		else
			$isPnodeFinishOnCommitTime="Now";
			
		//流程设为完成时，要检查评分
		/*
		if($state==15&&$node["pnod_state2"]==1)
		{
			$score=$this->spArgs('score');
			if(!$score)
				pmResult(400,"请选择分数","json",'json');
		}
		*/
			
		//进行操设置操作
		$rs=spClass("m_proj_node")->setState($pnod_id,$state,true,true,array(
																		'setDate'=>$isPnodeFinishOnCommitTime,
																		'score'=>$this->spArgs('score'),
																		'comment'=>$this->spArgs('comment'),
																		'delayinfo'=>$this->spArgs('delayinfo',1)
																		));
		if($rs=="done")
		{
			//流程设为完成时，要进行评分
			/*
			if($state==15&&$node["pnod_state2"]==1)
			{
				$setScoreRs=spClass("m_node_score")->setScore($score,$pnod_id,$this->spArgs('comment'));
				if($setScoreRs==200)
					pmResult(200,'修改成功.','json');
				else
					
					pmResult(500,'状态修改成功，但打分失败：'.$setScoreRs,'json');
			}
			*/
			pmResult(200,'修改成功.','json');
		}
		else
		{
			 pmResult(500,$rs,'json');
		}
	}
	
	//设分数
	function setScore()
	{
		$userId=pmAuth("manager");
		$pnod_id=$this->spArgs('pnod_id');
		$score=$this->spArgs('score');
		$setScoreRs=spClass("m_node_score")->setScore($score,$pnod_id,$this->spArgs('comment'));
		if($setScoreRs['rs']==200)
			pmResult(200,'打分成功!','json');
		else
			pmResult(500,'打分失败：'.$setScoreRs['des'],'json');
	}
	

}