 <?php  
class m_project extends spModel
{
	var $pk="proj_id";
	var $table="project";
	/*
	 $info 附加信息 array(
	 	'user_id'=>(string)创建项目者id,作通知时头像使用,
	 	'user_name'=>(string)创建项目者名称,作通知时显示使用,
		'testNode'=>(bool)是否自动生成测试流程
		'meterail'=>array 添加的素材
		)
	//return $result['des']['proj_id']
	*/
	public function addProject($project,$nodeArray,$info,$parentId=NULL)
	{
		//用户信息提取=
		//$user=pmUser("all");
		//if(!$user) return pmResult(403,NULL,'return');
		//end
		if(!$info['user_id'])$info['user_id']=0;
		//项目信息验证
		if(!$project['user_id']) return pmResult(400,'项目负责人不能为空','return');
		if(!$project['proj_name']) return pmResult(400,'标题不能为空','return');
		//end
		//dump($info['meterail']);
		//dump($project);
		//die();
		
		//流程信息验证
		$nodeCount=count($nodeArray);
		foreach($nodeArray as &$node)
		{
			if(!$node['pnod_name']) return pmResult(400,'流程名不能为空','return');
			if(!is_numeric($node['pnod_type'])) return pmResult(400,'['.$node['pnod_name'].']流程类型1不能为空','return');
			if(!is_numeric($node['pnod_type2'])) return pmResult(400,'['.$node['pnod_name'].']流程类型2不能为空','return');
		}
		//end
		if($project['did'])
		{
			if($this->findSql('select * from project where did='.$project['did'].' and did is not null'))
				return pmResult(500,'不能重复创建项目','return');
		}
		
		//插入项目集，并取得其主键
		if(!$proj_id=$this->create($project))
		{
			return pmResult(500,'项目保存不成功','return');
		}
		else
		{

			
			//juetion start 添加虚拟子项目
			$mtplSelect = $info['mtplSelect'];
			$m_proj_vritual_child = spClass("m_proj_vritual_child");
			//最多三个，第一个：是否综合模板，第二个，模板id，第三个：综合模板id。如果不是综合模板，则只有两个
			$mtplSelectArray = explode("_",$mtplSelect);
			if ($mtplSelectArray[0]) { //是综合模板才需要虚拟子项目
				$m_pg_integrated_child = spClass("m_pg_integrated_child");
				
				$child_mtpl = $m_pg_integrated_child->findAll(array(integrated_tasks_id=>$mtplSelectArray[2]),null,"mtpl_id");
				foreach ($child_mtpl as $value) {
					$m_proj_vritual_child->create(array(proj_id=>$proj_id,mtpl_id=>$value['mtpl_id']));
				}
			}
			//juetion end 添加虚拟子项目
			//juetion start 删除虚拟子项目
			$vritual_id = $info['vritual_id'];
			if ($vritual_id!=0) {
				$m_proj_vritual_child->delete(array(proj_vritual_child_id=>$vritual_id));
			}
			//juetion end 删除虚拟子项目
			$project['proj_id']=$proj_id;
			//设置proj_id
			foreach($nodeArray as &$node)
			{
				$node['proj_id']=$proj_id;
			}
			//写入贡献值 juetion
			spClass("m_pg_proj_contri")->create(array(proj_id=>$proj_id,contri_num=>$project['contri_num'],is_special=>$project['specialtask'],p_proj_id=>$project['p_proj_id']));
			//end
			//插入流程
			if(spClass('m_proj_node')->insertlist($nodeArray,$mtplSelectArray[1]))
			{
				//插入测试流程
				if($info['testNode'])
				{
					$this->addTestNode($project);
				}
				
				//素材支持
				if($info['meterail'])
				{
					$mMeterial=spClass('m_meterial');
					$newMeterailArray=array();
					foreach($info['meterail'] as $meterail)
					{
						$newMeterail=array(
							'name'=>$meterail['meterial_name'],
							'type'=>$meterail['meterial_type'],
							'ntime'=>$meterail['meterial_time'],
							'iscommit'=>0,
							'proj_id'=>$proj_id,
							'did'=>$project['did'],
							'isNew'=>1
						);
						array_push($newMeterailArray,$newMeterail);
					}
					$mMeterial->updateWithArray($newMeterailArray,$proj_id);
				}
				
				//将需求单设为已经创建
				if($project['did'])
				{
					$mDemand=spClass('m_demand');
					$mDemand->update(array('did'=>$project['did']),array('status'=>1));
				}
				
				//如果是保存草稿
				if($project['proj_state']==50) {
					//创建操作事件
					$m_event = spClass("m_event");
					$m_event->set(0,"创建项目","当前状态为【草稿】",$proj_id,NULL,$info['user_id']);
					if ($project['specialtask']==1||$project['specialtask']==2) { //juetion 如果是子项目或特殊项目，创建子项目指定负责人事件
						$respon_name = $m_event->findSql("select user_name from user where user_id=".$project['user_id']);
						$m_event->set(0,"指定项目负责人","负责人：".$respon_name[0]['user_name'],$proj_id,NULL,$info['user_id']);
					}
				}
				//果如不是保存草稿，就创建事件和提醒
				if($project['proj_state']!=50)
				{
					//创建操作事件
					$m_event = spClass("m_event");
					$m_event->set(0,"创建项目","当前状态为【待审核】",$proj_id,NULL,$info['user_id']);
					if ($project['specialtask']==1||$project['specialtask']==2) { //juetion 如果是子项目或特殊项目，创建子项目指定负责人事件
						$respon_name = $m_event->findSql("select user_name from user where user_id=".$project['user_id']);
						$m_event->set(0,"指定项目负责人","负责人：".$respon_name[0]['user_name'],$proj_id,NULL,$info['user_id']);
					}
					//创建通知信息
					$msg=spClass('m_message');
					$msg_context=$info['user_name']." 创建项目，并给您分配了相关工作。";
					$msg->init($msg_context,$proj_id,0,0,1,NULL,$info['user_id'])->toProject(false,false)->send();
				
					$msg_context=$info['user_name']." 创建了项目。";
					$msg->init($msg_context,$proj_id,0,0,1,NULL,$info['user_id'])->toProduct($prod_id)->send();
				
					$msg_context=$info['user_name']." 创建项目，等待您进行审核。";
					$msg->init($msg_context,$proj_id,0,1,1,NULL,$info['user_id'])->toManagers()->send();
				}

                //redmine传过来时候的父子项目关系
                if($parentId!=0){
                    $pg_proj_relate=spClass("m_pg_proj_contri");
                    $p_proj_id=$this->find(array('proj_redmineId' => $parentId));

                    $p_proj_id=$p_proj_id['proj_id'];
                    $row=array(
                        "is_special"=>2,
                        "p_proj_id"=>$p_proj_id
                    );
                    $pg_proj_relate->update(array("proj_id"=>$proj_id),$row);
                }

				return pmResult(200,array("proj_id"=>$proj_id),'return');
			}
			else
			{
				pmLogs("error.project.project_add_do.addNode.".date("Ymd_His").".log",$this->spArgs(),true,$path="tmp/log/",true);
				return pmResult(400,'项目创建成功，但流程保存失败。','return');
			}
		}
	}
	
	//插入测试流程
	//$id 可以是proj_id,也可以是一个project数组
	public function addTestNode($id)
	{
		$project;
		if(is_array($id))
		{
			$project=$id;
		}
		else
		{
			$project=$this->find(array('proj_id'=>$id));
		}
		$mPnode=spClass('m_proj_node');
		$lastNodeDateTime=$mPnode->getYM($project['proj_id'],"e");
		if(!$lastNodeDateTime)
		{
			$testNodeStartDateTime=$project['proj_end'];
		}
		else
		{
			//$testNodeStartDateTime=date('Y-m-d H:i:s',strtotime("$lastNodeDateTime +1 day"));
			$testNodeStartDateTime=$lastNodeDateTime;
		}
		$diffDayCount=(strtotime($project['proj_end'])-strtotime($testNodeStartDateTime))/3600/24;
		$newNode=array();
		$newNode['proj_id']=$project['proj_id'];
		$newNode['pnod_time_s']=$testNodeStartDateTime;
		$newNode['pnod_time_e']=$project['proj_end'];
		$newNode['pnod_type']=1;
		$newNode['pnod_type2']=6;
		$newNode['user_id']=$project['user_id'];
		$newNode['pnod_name']='测试上线';
		$newNode['pnod_state']=20;//原来是$project['proj_state'];
		$newNode['pnod_state2']=0;
        $newNode['pnod_desc']='在项目上线前对项目进行全面测试';
		$newNode['pnod_day']=$diffDayCount;
		if($mPnode->create($newNode))
		{
			return true;
		}
		else
			pmLogs("error.project.project_add_do.addtest".date("Ymd_His").".log",$this->spArgs(),true,$path="tmp/log/",true);
	}
	//插入数据反馈流程
	//$id 可以是proj_id,也可以是一个project数组
	public function addDataReportNode($id)
	{
		$project;
		if(is_array($id))
		{
			$project=$id;
		}
		else
		{
			$project=$this->find(array('proj_id'=>$id));
		}
		$mPnode=spClass('m_proj_node');
		$newNodeStartDateTime=$project['proj_end'];
		if(!$newNodeStartDateTime) return false;
		$newNodeStartDateTime=date('Y-m-d H:i:s',strtotime("$newNodeStartDateTime +14 day"));
		$newNodeEndDateTime=date('Y-m-d H:i:s',strtotime("$newNodeStartDateTime +3 day"));
		$newNode=array();
		$newNode['proj_id']=$project['proj_id'];
		$newNode['pnod_time_s']=$newNodeStartDateTime;
		$newNode['pnod_time_e']=$newNodeEndDateTime;
		$newNode['pnod_type']=1;
		$newNode['pnod_type2']=2;
		$newNode['user_id']=$project['user_id'];
		$newNode['pnod_name']='项目数据反馈';
		$newNode['pnod_state']=20;
		$newNode['pnod_state2']=1;
		$newNode['pnod_day']=3;
		if($mPnode->create($newNode))
		{
			return true;
		}
		else
		{
			pmLogs("error.project.project_add_do.addtest".date("Ymd_His").".log",$this->spArgs(),true,$path="tmp/log/",true);
			return false;
		}
	}

	//项目状态设置操作
	//return string "done"|string 错误信息
	public function setStateWithArray($array)
	{
		if(!isset($array["isCreateEvent"])) $array["isCreateEvent"]=true;
		if(!isset($array["isSendMessage"])) $array["isSendMessage"]=true;
		if(!isset($array["isSetWrap"])) $array["isSetWrap"]=true;
		if(!isset($array["isSetPnod"])) $array["isSetPnod"]=true;
		if(!isset($array["describe"])) $array["describe"]=false;
		return $this->setState($array["proj_id"],$array["state"],$array["isCreateEvent"],$array["isSendMessage"],$array["isSetWrap"],$array["isSetPnod"],$array["describe"]);
	}
	
	public function setState($proj_id,$state,$isCreateEvent=true,$isSendMessage=true,$isSetWrap=false,$isSetPnod=true,$describe=false)
	{
		$session=pmUser("all");
		if(!$session) return "用户信息无效。";
		$user_power=$session["power"];
		$user_role=$session["role"];
		$user_id=$session["id"];
		$user_name=pmUser("name");
		$proj_state=getProjState();
		if($proj_state[$state]=="") return "状态参数无效。";
		$ppstate;//更改项目状态时，其所有流程设为这个值;
		$condition=array('proj_id'=>$proj_id);
		$project=$this->find($condition);
		if(!$project) return "项目不存在";
		//只能更改自己的项目，管理员和审核员不受此限制
		if($user_power>1)
			if($user_id!=$project["user_id"]){return "权限错误1";}
		//归档操作只能经理进行
		if($state==10&&$user_role!=5) return "归档只能由经理权行进行。";
		if($state==15&&!$this->getIsFinish($proj_id)) return "由于其它流程没有完成，项目无法直接设为完成。";
		if($project["proj_state"]==$state) return "done";
		$isUpdateProjSuccess=false;
		switch($state)
		{
			case 100:$this->query("UPDATE project set proj_statebak=proj_state WHERE proj_id=$proj_id");break;
			case 1020:$ppstate=1020;break;
			default:$ppstate=$state;break;
		}
		switch($state)
		{
			case 1020:$isUpdateProjSuccess=$this->query("UPDATE project set proj_state=proj_statebak WHERE proj_id=$proj_id");break;
			default:$isUpdateProjSuccess=$this->updateField($condition,'proj_state',$state);break;
		}
		if($isUpdateProjSuccess)
		{
			//审核通过时记录审核人
			if($project["proj_state"]==40&&$state==20) 
				$this->query("UPDATE project set proj_passTime=NOW(),proj_passBy='$user_name' WHERE proj_id=$proj_id");
			
			//连同流程状态一并修改
			if($isSetPnod)
			{
				$mPnods=spClass('m_proj_node');
				if($state==100)
				{
					$this->query("update proj_node set pnod_statebak=pnod_state,pnod_state=100 where proj_id=$proj_id");
				}
				elseif($ppstate==1020)
				{
					$this->query("update proj_node set pnod_state=pnod_statebak where proj_id=$proj_id");
				}
				elseif($ppstate==10)
				{
					$rows=array('pnod_state'=>$ppstate);
					$mPnods->update(array('proj_id'=>$proj_id,'pnod_state'=>15),$rows);
				}
				elseif ($ppstate==20) {
					//juetion 若流程审核通过，不改变状态，因为流程创建后默认是正在进行，（小马需求）
				}else if ($ppstate==40) {
					//提交草稿审核的时候，提交审核时，直接进入正在进行
					$rows=array('pnod_state'=>20);
					$mPnods->update(array('proj_id'=>$proj_id,'pnod_state'=>50),$rows);
				}
				else
				{
					$rows=array('pnod_state'=>$ppstate);
					$mPnods->update($condition,$rows);
				}
			}
			
			if($state==15)
			{
                /*  2013.06.21 取消自动生成数据反馈流程
				//项目完成时添加数据反馈流程
				$this->addDataReportNode($project);
				//项目完成时，通知提单系统
				if($project['did'])
				{
					$rs=spClass('m_tdsystem')->setFinish($project['did']);
				}
                */
			}
			
			//创建事件记录
			if($isCreateEvent)
			{
				switch($state)
				{
					case 100:$_actionName="取消了项目";$_actionRs="原因是：".$_POST["cancel_reason"];break;
					case 1020:$_actionName="恢复了项目";$_actionRs="项目继续进行";break;
					case 50:
						switch($project["proj_state"])
						{
							case 40:$_actionName="退回项目";$_actionRs="项目变草稿";break;
							default:$_actionName="更改态改为";$_actionRs=$proj_state[$state];
						}
						break;
					default:$_actionName="更改态改为";$_actionRs=$proj_state[$state];
				}
				$mEvent=spClass('m_event');
				if($describe)
					$_actionRs=$_actionRs.",说明:".$describe;
				$mEvent->set(0,$_actionName,$_actionRs,$proj_id,NULL,$user_id);
			}
			
			if($isSendMessage)
			{
				$msg=spClass('m_message');
				if($state==40)
				{
					$msg_context=$user_name." 创建项目 ，并给您分配了相关工作。";
					$msg->init($msg_context,$proj_id)->toProject(false,false)->send();
			
					$msg_context=$user_name." 创建了项目。";
					$msg->init($msg_context,$proj_id)->toProduct($prod_id)->send();
					
					if($project["proj_state"]==50)
					{
						$msg_context=$user_name." 提交了项目，请进行审核。";
						$msg->init($msg_context,$proj_id,0,1)->toManagers()->send();
					}
				}
				elseif($state==100)
				{
					$msg_context=$user_name." 取消了项目，原因是：".$_POST["cancel_reason"];
					$msg->init($msg_context,$proj_id)->toProject()->toManagers()->send();
				}
				elseif($ppstate==1020&&$state==20)
				{
					$msg_context=$user_name." 恢复了项目,项目继续进行。";
					$msg->init($msg_context,$proj_id)->toProject()->toManagers()->send();
				}
				elseif($project["proj_state"]==40&&$state==50)
				{
					$msg_context=$user_name." 退回了项目,原因是：".$describe;
					$msg->init($msg_context,$proj_id)->toProject()->toManagers()->send();
				}
				else
				{
					$msg_context=$user_name." 更改了项目的状态，当前状态是【".$proj_state[$state]."】。";
					$msg->init($msg_context,$proj_id)->toProject()->toManagers()->send();
				}

				if($state==15)
				{
					$this->updateField($condition,'proj_endDate',date("Y-m-d H:i:s"));
					$msg_context="项目完成了，请您进行归档。";
					$msg->init($msg_context,$proj_id,0,3)->toTopManagers()->send();
				}
				
				if($state==20)
				{
					$this->updateField($condition,'proj_date',date("Y-m-d H:i:s"));
				}
			}
			
			//如果将项目集设为归档，则检查该项目所属的项目集下，是否所有项目状态都己归档，如果是，则将项目集设为完成。
			if($state==10&&$isSetWrap)
			{
				$proj=$this->find(array("proj_id"=>$proj_id));
				
				//如果有项目集
				if($proj['wrap_id']!=0)
				{
					$m_wrap=spClass("m_wrap");
					$cond='wrap_id='.$proj['wrap_id'].' and proj_state>=1';
					$wrap_count=$this->findCount($cond);
					if($wrap_count==0)
					{
						$m_wrap->updateField(array('wrap_id'=>$proj['wrap_id']),'wrap_state','1');
						$wrap=$m_wrap->find(array('wrap_id'=>$proj['wrap_id']));
						//创建向客户端发送的信息
						$msg=spClass('m_message');
						$msg_context="项目集 [".$wrap['wrap_name']."] 已经完成!";
						$msg->toManagers($msg_context);
						$msg->toUser($msg_context,$proj['user_id']);
					}
				}
			}
			//make cache
			if(($project["proj_state"]==40&&$state==20)||($project["proj_state"]==15&&$state==10)||($project["proj_state"]==40&&$state==50))
			{
				$projectCache=$this->findSql("select proj_id,prod_name,proj_name,wrap_name,user_name from project_v where proj_id=$proj_id");
				$projectCache[0]["passBy"]=$user_name;
				pmLogs("projectLastState$state.txt",$projectCache[0],true);
			}
			return "done";
		}
		return "修改失败。";
	}

	//取得项目负责人
	public function getUserId($proj_id)
	{
		$condition=array('proj_id'=>$proj_id);
		if($project=$this->find($condition))
		{
			return $project['user_id'];
		}
		else
		{
			return false;
		}
	}
	
	//取得项目某个健值
	public function getValue($proj_id,$key)
	{
		$condition="proj_id=".$proj_id;
		if($project=$this->find($condition))
		{
			return $project[$key];
		}
		else
		{
			return false;
		}
	}
	
	//判断是不是该项目负责人
	//@proj_id [int]:need
	//@$user_id [int]:不填则从seesion中提取。
	//@verifyManager [bool]:管理员是否跳过验证
	//return [bool]
	public function isUser($proj_id,$user_id=0,$allowManager=true)
	{
		if(!$proj_id) return false;
		$session=pmUser("all");
		
		if($allowManager)
		{
			if(!$session) return false;
			if($session["power"]<2) return true;
		}		
		
		if($user_id==0)
		{
			if(!$session) return false;
			$user_id=$session["id"];
		}
		
		$proj=$this->find(array("proj_id"=>$proj_id));
		//echo($proj_id);
		//echo($proj["user_id"]."-".$user_id);
		if($proj["user_id"]==$user_id) return true;
		else return false;	
	}
	
	//查询项目和项目集联表
	public function getView_wrap($proj_id=0)
	{
		if($proj_id==0)
			$sqlstr="select project.*,wrap.wrap_name From project,wrap where project.wrap_id=wrap.wrap_id";
		else
			$sqlstr="select project.*,wrap.wrap_name From project,wrap where project.wrap_id=wrap.wrap_id and project.proj_id=".$proj_id;
		$rs=$this->findSql($sqlstr);
		return $rs;
	}	
	
	//返回某个项目否所有流程都完成了
	public function getIsFinish($proj_id)
	{
		$cond='proj_id='.$proj_id.' and pnod_state>=17';
		if(spClass("m_proj_node")->findCount($cond)==0)
			return true;
		else
			return false;
	}
	
	/**
		@ Name:isCanMidify
		@ Describe:判断没有有修改项目的权限
		@ param:
			@require
				$proj_id (int) 项目ID
			@optional
				$type (int) 验证类型：
									1(默认)-> 用户自己创建的且proj_state>=20 或 power<2者，可以修改
		@ return (array("rs"=>"结果：0失败，1成功"，"des"=>"描述"，"project"=>project Array，"userInfo"=>array()用户信息包，参考文件：/lib/functions.php?a=getUserInfo))
	*/
	public function isCanMidify($proj_id,$type=1,$user_id=false)
	{
		$userInfo=pmUser("all","json");
		if(!$userInfo) return array("rs"=>0,"des"=>"用户登陆信息无效。");
		if(!$proj_id) return array("rs"=>0,"des"=>"请传入项目ID。","userInfo"=>$userInfo);
		$oProject=$this->find(array("proj_id"=>$proj_id));
		return $this->_isCanModifyWithUserAndProject($userInfo,$oProject,$type);
	}
	private function _isCanModifyWithUserAndProject($userInfo,$oProject,$type)
	{
		switch($type)
		{
			case 1:
				if($userInfo["power"]>1)
				{
					if($oProject["proj_state"]<20||$oProject["proj_state"]>100) return array("rs"=>0,"des"=>"现在项目的状态不允许修改其流程。","userInfo"=>$userInfo); 
					if($oProject["user_id"]!=$userInfo["id"])
						 return array("rs"=>0,"des"=>"没有修改该项目的权限。","userInfo"=>$userInfo); 
				}
				return array("rs"=>1,"des"=>"","userInfo"=>$userInfo,"project"=>$oProject); 
		}
	}

	
	//删除项目,及其相关的：流程，事件，附件,评分，素材
	public function deleteAll($proj_id)
	{
		$selectorArray=array('proj_id'=>$proj_id);
		if($this->delete($selectorArray))
		{
			if(!spClass('m_event')->delete($selectorArray))
				pmLogs("error.project.deleteAll.event".date("Ymd_His").".log",$this->spArgs(),true,$path="tmp/log/",true);
			if(!$pron_delete=spClass('m_proj_node')->delete($selectorArray))
				pmLogs("error.project.deleteAll.node".date("Ymd_His").".log",$this->spArgs(),true,$path="tmp/log/",true);
			if(!spClass('m_proj_score')->delete($selectorArray))
				pmLogs("error.project.deleteAll.projectscore".date("Ymd_His").".log",$this->spArgs(),true,$path="tmp/log/",true);
			if(!spClass('m_node_score')->delete($selectorArray))
				pmLogs("error.project.deleteAll.m_node_score".date("Ymd_His").".log",$this->spArgs(),true,$path="tmp/log/",true);
			if(!spClass('m_meterial')->delete($selectorArray))
				pmLogs("error.project.deleteAll.m_meterial".date("Ymd_His").".log",$this->spArgs(),true,$path="tmp/log/",true);
			
			//删除相关附件
			//fn:仅删除文件夹
			function deldir($dir) 
			{
			  $dh=opendir($dir);
			  while ($file=readdir($dh)) {
			    if($file!="." && $file!="..") {
			      $fullpath=$dir."/".$file;
			      if(!is_dir($fullpath)) {
			          unlink($fullpath);
			      } else {
			          deldir($fullpath);
			      }
			    }
			  }
			  closedir($dh);
			  if(rmdir($dir))
			  {
			    return true;
			  } else {
			    return false;
			  }
			}
			
			$fileArray=spClass('m_files')->find($selectorArray);
			import('extensions/nie-file.php');
			$nf=new nieFile();
			foreach($fileArray as $file)
			{
				$fileUrl=explode(".",$file['file_url']);
				if(count($fileUrl)<2)
				{
					deldir($file['file_url']);
				}
				else
				{
					
					$nf->delete($file['file_url']);
				}
			}
			if(!spClass('m_files')->delete($selectorArray))
				pmLogs("error.project.deleteAll.m_files".date("Ymd_His").".log",$this->spArgs(),true,$path="tmp/log/",true);
			//删除相关附件 end				
		}
	}

	
}