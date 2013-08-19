 <?php  
class m_proj_node extends spModel
{
	var $pk="pnod_id";
	var $table="proj_node";
	
	//$nodes=array[i][pnod_key]...
	public function insertlist($nodes,$mtpl_id)
	{
		$isSuccess=true;
		$mtplFlowId_to_nodeId = array();
		foreach($nodes as $node)
		{
			if(!$node_id = $this->create($node))
			{
				$isSuccess=false;
			}else {
				$mtplFlowId_to_nodeId[$node['flow_id']]=$node_id;
			}
		}
		//juetion add 根据模板的流程关系 实现真实的流程关系
		$m_pg_mtpl_flow_before = spClass("m_pg_mtpl_flow_before");
		$flow_before_result = $m_pg_mtpl_flow_before->findAll(array(mtpl_id=>$mtpl_id));
		$m_pron_check = spClass("m_pron_check");
		foreach ($flow_before_result as $value) {
			$flow_id = $value['flow_id'];
			$p_flow_id = $value['p_flow_id'];
			$pron_id = $mtplFlowId_to_nodeId[$flow_id];
			$p_pron_id = $mtplFlowId_to_nodeId[$p_flow_id];
			if ($pron_id&&$p_pron_id) {
				$m_pron_check->create(array(pron_id=>$pron_id,p_pron_id=>$p_pron_id));
			}
		}
		//juetion end 根据模板的流程关系 实现真实的流程关系
		return $isSuccess;
	}
	
	//根据pnod_id取得延期时间
	public function delayDayCountWithId($pnod_id)
	{
		$node=$this->find(array('pnod_id'=>$pnod_id));
		if($node)
			return $this->dalayDayCountWithNode($node);
	}
	//根据一行pnod数组，取得延期时间
	public function dalayDayCountWithNode($node)
	{
		$pnodEndDate=strtotime(date('Y-m-d',strtotime($node['pnod_time_e'])));
		$pnodEndDateR=strtotime(date('Y-m-d',strtotime($node['pnod_time_r'])));
		return $pnodEndDateR-$pnodEndDate;
	}
	
	//状态设置操作
	//$pnod_id int 流程id
	//$state int 状态值｛参考lib/setting.php,1000=提交，有可能是设为完成，有可能是设为审核｝
	//$isCreateEvent bool 是否开启创建事件记录
	//$isSendMessage bool 是否开启发信息
	/*$others
		array(
		'setDate'=>string 设置时间:"Now"是当前时间 "Last"为上提交时间
		'delayinfo'=>int delay 类别
		'score'=> 分数
		'comment'=>意见
		))
	*/
	//return string "done"|string 错误信息
	public function setState($pnod_id,$state,$isCreateEvent=true,$isSendMessage=true,$others=array('setDate'=>'Now','delayinfo'=>1))
	{
		$user=pmUser('all');
		if(!$user) return '402:';
		$user_role=$user['role'];
		$user_id=$user['id'];
		$user_power=$user['power'];
		$user_name=$user['name'];
		$pnod_state=getPnodState();
		
		$pnod=spClass('m_proj_node_v')->find(array('pnod_id'=>$pnod_id));
		if(!$pnod) return '401:流程不存在';
		
		$proj_id=$pnod['proj_id'];
		$isProjFinished=false;
		$PMChecker=PMChecker();
		//dump($PMChecker);
		//dump($PMChecker[$pnod["pnod_type"]]);
		//die();
		if(!$pnod_state[$state]) return '401:state参数错误';
		
		//如果设置了日期
		//dump($setDate);
		if($others['setDate']=="Now"||!$pnod['pnod_time_r']||$pnod['pnod_time_r']=='0000-00-00 00:00:00')
		{
			$others['setDate']=date("Y-m-d H:i:s");
		}
		elseif($others['setDate']=="Last"&&$state==15)
			$others['setDate']=$pnod['pnod_time_r'];
		

		//如果权限是普通
		if($user_power>=2&&$pnod['pnod_state']!=18)
		{
			//编辑只能修改自己创建的项目的流程,普通人员只可修改自己的。
			if($user_id!=$pnod['res_user_id']&&$user_id!=$pnod['user_id']&&$user_id!=$pnod['respon_id'])
			{
				return "403:权限不足，你只可以修改自己的流程";
			}
		}
		//若是从进行中到审核，需要检查器产出物是否有。
		if($pnod['pnod_state']==20&&$state==17&&($pnod['outcome']!='0'&&$pnod['outcome']!='-1')) {
			return "403:流程产出物还未提交，不能进入审核状态。";
		}

		if($pnod['pnod_state']==$state&&$state!=18) return "done";
		//二审状态下，判断是否有权限审核，之后下一个流程的人可以审核。普通人权限下
		$is_pass = 0;
		if($pnod['pnod_state']==$state&&$state==18)  
		{
			$m_pron_check = spClass("m_pron_check");
			$condition_user = " in(";
			$respon_user_ids = $m_pron_check->findSql("select user_id from user where respon_id = ".$user_id);
			if ($respon_user_ids) {
				foreach ($respon_user_ids as $rs) {
					$condition_user = $condition_user.$rs['user_id'].",";
				}
				$condition_user = $condition_user.$user_id.") ";
			}else {
				$condition_user = " =".$user_id." ";
			}
			$pron_id_result = $m_pron_check->findSql("SELECT pn.pnod_id from proj_node pn where 
					pn.user_id".$condition_user." and pn.pnod_id in(select pc.pron_id from pron_check 
					pc where pc.state=0 and pc.p_pron_id=".$pnod_id.")");
			if (!$pron_id_result) {
				return "403:权限不足，你不能检测这个流程。";
			}else {
				foreach ($pron_id_result as $rs) {
					$next_pron_id = $rs["pnod_id"];
					$m_pron_check->update(array(pron_id=>$next_pron_id,p_pron_id=>$pnod_id),array(state=>1));
					spClass('m_event')->set(0,'审核通过',$pnod_state[$state],$proj_id,$pnod_id,$user_id);
				}
				//判断是否还需要二审
				$pron_check_result = $m_pron_check->findAll(array(p_pron_id=>$pnod_id,state=>0));
				if (!$pron_check_result) { //如果不需要二审
					$state=15;
					$is_pass = 1;
				}else
					return "done";
			}
		}

		$condition=array('pnod_id'=>$pnod_id);
		
		//如果将状态设置为完成或提交审核，需要记录标注时间
		if($state==15||$state==17||$state==18) //juetion添加18这个状态
		{
			if(!$pnod['user_id']||!$pnod['pnod_time_s']||!$pnod['pnod_time_e']) return'提交流程前必须安排好负责人，以及起止时间！';
			if($state==15) {
				if ($is_pass==1) { //经过二审的结束，时间用最后审核结束的时间
					$row=array(
						   'pnod_state'=>$state,
						   'pnod_time_r'=>$others['setDate'],
					);
				}else {//没有二审的结束，时间用实际完成时间
					$row=array(
							'pnod_state'=>$state,
					);
				}
				if ($pnod['pnod_state2']==0) {//如果是不需要审核的单，直接给时间结束
					$row=array(
						   'pnod_state'=>$state,
						   'pnod_time_r'=>$others['setDate'],
					);
				}
			}
				
			else if($state==17)//计实际结束时间的
				$row=array(
						'pnod_state'=>$state,
						'pnod_time_r'=>$others['setDate'],
					);
			if($state==18) //判断是否需要二审   juetion
			{
				$m_pron_check = spClass("m_pron_check");
				$pron_check_result = $m_pron_check->findAll(array(p_pron_id=>$pnod_id,state=>0));
				if (!$pron_check_result) { //如果不需要二审,直接用它的直接的结束时间。
					$state=15;
					$row=array(
						   'pnod_state'=>$state,
						   //'pnod_time_r'=>$others['setDate'],
						   );
					
				}else {  //需要二审
					$state=18;
					$row=array(
							'pnod_state'=>$state,
							//'pnod_time_r'=>$others['setDate'],
					);
				}
			}
			//当要设为一审时，同时该流程需要审核时，验证合法性:管理员、相关职能的审核员可以
			if($pnod['pnod_state']==17&&($state==18||$state==15)&&$pnod['pnod_state2']==1)
			{
				if($user_power==1&&$user_role!=$pnod['role_id']||$user_power>1)
					return "403:权限不足";
				if($this->dalayDayCountWithNode($pnod)>0&&!$others['delayinfo']) 
					return'401:延期的流程请选择相应的描述';
				$resultInfo=spClass('m_node_score')->setScore($others['score'],$pnod_id,$others['comment']);
				if($resultInfo['rs']!=200)
				{
					return $resultInfo['des'];
				}
				$row['delayinfo']=$others['delayinfo'];
			}
		}
		elseif($state==10)
		{
			if($user_role!=5) return "只有经理才能归档项目。";
		}
		elseif($state==1000)
		{
			//这个操作的前提是流程状态是正在进行
			if($pnod['pnod_state']!=20) return false;
			//在请求下一步时，如果该流需要审核
			elseif($pnod['pnod_state2']==1)
			{
				$row=array('pnod_time_r'=>$others['setDate'],'pnod_state'=>17);
				$state=17;
			}
			//不需要核审就直接设为完成
			else
			{
				$row=array('pnod_time_r'=>$others['setDate'],'pnod_state'=>15);
				$state=15;
			}
		}
		else
		{
			$row=array('pnod_state'=>$state);			
		}
		
		//dump($row);
		//die();
		
		if($this->update($condition,$row))
		{
			if($isCreateEvent)
			{
				spClass('m_event')->set(0,'更改态改为',$pnod_state[$state],$proj_id,$pnod_id,$user_id);
				//如果是设为完成的，则自动检查是否所有流程都己完成
				if($state==15)
				{
					//检查该项目的流程是否都通过了，如果是，则通知编辑进行提交。
					if(spClass("m_project")->getIsFinish($proj_id))
					{
						$isProjFinished=true;	
					}
				}
			}
			if($isSendMessage)
			{
				$msg=spClass('m_message');
				$nodeTypeCN=array("1"=>"编辑","2"=>"设计","3"=>"前端");
				//必发
				$msg_context=$user_name." 更改了流程 <strong>".$pnod['pnod_name']."</strong> 的状态，现在的状态是【".$pnod_state[$state]."】。";
				if($pnod["pnod_state"]==17&&$state==20)
				{
					$msg_context=$user_name." <strong>退回</strong> 流程 <strong>".$pnod['pnod_name']."</strong> ，现在的状态是【".$pnod_state[$state]."】。";
				}
				else if($pnod["pnod_state"]==17&&$state==15)
				{
					$msg_context=$user_name." 对<strong>".$nodeTypeCN[$pnod["pnod_type"]]."</strong>流程 <strong>".$pnod['pnod_name']."</strong> 检查完毕，现在状态是【完成】。";
				}
				$msg->init($msg_context,$proj_id,$pnod_id)->toProject()->send();
				
				//选发
				if($state==17)
				{
					$msg_context=$user_name." 提交".$nodeTypeCN[$pnod["pnod_type"]]."流程 <strong>".$pnod['pnod_name']."</strong> ，<strong>现等待您进行检查</strong>。";
					$msg->init($msg_context,$proj_id,$pnod_id,1)->toUser($PMChecker[$pnod["role_id"]])->send();
				}

				//不经过检查提交接完成时通知技能组长
				if($pnod["pnod_state"]==20&&$state==15)
				{
					$msg_context=$user_name." 完成了一个".$nodeTypeCN[$pnod["pnod_type"]]."流程 <strong>".$pnod['pnod_name']."</strong>。";
					$msg->init($msg_context,$proj_id,$pnod_id,0)->toUser($PMChecker[$pnod["role_id"]])->send();
				}
				/*
				else if($state==40&&$pnod['role_id']!=2)
				{
					$msg_context=$user_name." 提交流程 [".$pnod['pnod_name']."]，现等待您进行审核。";
					$msg->init($msg_context,$proj_id,$pnod_id,1)->toManagers()->send();
				}
				*/
				if($state==15&&$isProjFinished==true)
				{
					$msg_context="项目所有流程已完成，<strong>现在请您将项目设为完成</strong>。";
					$msg->init($msg_context,$proj_id,0,2)->toUser($pnod['res_user_id'])->send();
				}
			}
			 //make cache
			//return($pnod["pnod_state"]." - ".$state);
			if($pnod["pnod_state"]==17&&($state==15||$state==20))
			{
				$pnod["passBy"]=$user_name;
				pmLogs("pNodesLastState$state.txt",$pnod,true);
			}
			
			return "done";
		}
		else
		{
			return "修改时发生未知错误。";
		}
	}

	/*
	public function pass($pnod_id,$score=NULL,$comment=NULL,$delayReason=NULL,$setDate="Now")
	{
		$node=$this->find(array("pnod_id"=>$pnod_id));
		//检查评分
		if($node["pnod_state2"]==1)
		{
			if(!$score) return '401:分数不能为空';
		}
		if('done'==spClass("m_proj_node_v")->setState($pnod_id,15,true,true,$setDate))
		{
			spClass("m_node_score")->setScore($score,$pnod_id,$user["id"],$this->spArgs('comment'));
		}
	}
	*/
	
	//将未完成的流程时间整体延后
	public function putDateDelay($proj_id,$toDate)
	{
		if($proj_id==""||$toDate=="") return false;
		$_toDate=$this->escape($toDate);
		$_proj_id=$this->escape($proj_id);
		$diff_day=$this->findSql("select (date($_toDate)-date(pnod_time_s)) as daycount from proj_node where pnod_state in(20,30,40) and proj_id=$_proj_id order by pnod_time_s ASC limit 0,1");
		$diff_day=$diff_day[0]['daycount'];
		$sqlstr="update proj_node set pnod_time_s=date_add(pnod_time_s,interval $diff_day day),pnod_time_e=date_add(pnod_time_e,interval $diff_day day) where pnod_state in(20,30,40) and proj_id=$_proj_id";
		return $this->findSql($sqlstr);
	}
	
	//返回某个项目否所有流程都完成了
	public function getIsFinish($proj_id)
	{
		$cond='proj_id='.$proj_id.' and pnod_state>=20';
		if($this->findCount($cond)==0)
			return true;
		else
			return false;
	}
	
	
	//取得一个项目最X时间
	//$type:string 
	//		"s"：最早开始的时间;
	//		"e":最迟结束的时间;
	public function getYM($proj_id,$type)
	{
		if($type=="s")
			$sql='select pnod_time_s as pnod_datetime from proj_node where proj_id='.$proj_id.' and pnod_time_s<>"" order by pnod_datetime ASC limit 0,1';
		else if($type=="e")
			$sql='select pnod_time_e as pnod_datetime from proj_node where proj_id='.$proj_id.' and pnod_time_s<>"" order by pnod_datetime DESC limit 0,1';
		$rs=$this->findSql($sql);
		if(count($rs)==0)
			return false;
		else
			return $rs[0]['pnod_datetime'];
	}	
}