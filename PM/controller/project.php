<?php
class project extends spController
{
	function index()
	{
		echo("none action!");
	}
	
	//项目库
	function show()
	{
		//dump($this->spArgs());
		$user_id=pmUser("id","html");
		$rows=spClass('m_project_v');
		$prod_id=$this->spArgs('spid',false);
		$prod_name=$this->spArgs('spn');
		$proj_state=$this->spArgs('ssid');
		$search_dates=$this->spArgs('sd1');
		$search_datee=$this->spArgs('sd2');
		$search_key=$this->spArgs('sk');
		$type=$this->spArgs('type','1');//2-今天要完成的 3-延期的  10-组内 100-redmine
		$oUserId=$this->spArgs('oUserId');
		if($search_dates=="开始日期") $search_dates="";
		if($search_datee=="结束日期") $search_datee="";
		if($search_dates!="")
			if(pmIsDate($search_dates)==false){echo('<script type="text/javascript">alert("请输入正确的日期1。")</script>');$this->jump(spUrl('project_bll','myNodes'));}
		if($search_datee!="")
			if(!pmIsDate($search_datee)){echo('<script type="text/javascript">alert("请输入正确的日期2。")</script>');$this->jump(spUrl('project_bll','myNodes'));}
		switch($type)
		{
			case "2":$condition= 'proj_state in(20,40) and (TO_DAYS(NOW())-TO_DAYS(proj_end))>=0';$this->title="今天要完成 - 项目";break;
			case "3":$condition= 'proj_state in(20,40) and (TO_DAYS(NOW())-TO_DAYS(proj_end))>0';$this->title="己经延期 - 项目";$sort=" ORDER BY delay1 DESC";break;
            case "10":$condition= ' proj_class <> 5';$this->title="组内提单 - 项目";$sort=" ORDER BY proj_id DESC";break;
            case "100":$condition= ' prod_id = 10 AND proj_class = 5';$this->title="redmine单 - 项目";$sort=" ORDER BY proj_id DESC";break;
			default:
				if($proj_state=='a')
				{
					if(!is_numeric($oUserId))  $condition= 'proj_state<>50';
				}
				elseif(is_numeric($proj_state)) $condition= 'proj_state='.$proj_state;
				$sort=" ORDER BY proj_id DESC";
				$this->title="全部 - 项目";
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
			$condition.="(proj_start>='$search_dates' and proj_start<='$search_datee' or (proj_state<=15 and proj_endDate>='$search_dates' and proj_start<='$search_datee') or (proj_state>15 and proj_end>='$search_dates' and proj_start<='$search_datee') or (proj_state<=15 and proj_start<='$search_dates' and proj_endDate>='$search_datee') or (proj_state>15 and proj_start<='$search_dates' and proj_end>='$search_datee'))";	
		}
		
		if($search_key!="")
		{
			if($condition!='') $condition.=' AND ';
			$condition.="proj_name like '%$search_key%'";
		}
		if(is_numeric($oUserId))
		{
			if($condition!='') $condition.=' AND ';
			$condition.="user_id=".$oUserId;
		}
		
		if($condition!='') $condition=' WHERE '.$condition;
		
		//$condition="WHERE pnod_name like '%flash%'";
		$sql="SELECT *,(TO_DAYS(NOW())-TO_DAYS(proj_end)) AS delay1,(TO_DAYS(proj_endDate)-TO_DAYS(proj_end)) AS delay2 FROM project_v ".$condition.$sort;
		//die($sql);
		$rows_rs=$rows->spPager($this->spArgs('p',1),50)->findSql($sql);
		$now=date("Y-m-d H:i:s");
		//dump($rows_rs);
		foreach($rows_rs as &$_temrows)
		{
			if($_temrows["proj_state"]<=15&&$_temrows["proj_state"]!="") $_temrows["delay"]=$_temrows["delay2"];
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
		if($oUserId)
		{
			$this->oUserId=$oUserId;
			$this->display('project/myProjects.html');
		}
		else $this->display('project/projects.html');
	}
	
	//最新动态
	function news()
	{
		$events=spClass("m_event")->getNews();
		//dump($events);
		$this->projClass=getProjClass();
		$this->projState=getProjState();
		$this->events=$events;
		$this->display('project/projectNews.html');
	}
	
	function project_add()
	{
		$user=pmUser("all","html");
		if($this->spArgs('dId'))
		{
			$demand=spClass('m_demand')->find(array('did'=>$this->spArgs('dId')));
			if(!$demand)
			{
				pmAlert('该需求单不存在');
			}
			else if($user['id']!=$demand['user_id'])
			{
				pmAlert('不能创建不是自己的单');
			}
			else if($demand['status']==1)
			{
				pmAlert('该需求单已经被创建过');
			}
			else
			{
				$this->demand=$demand;
			}
		}
		/** juetion add start**/
		$skill=spClass('m_pg_skill');
		$this->skill=$skill->findAll();
		$mtpl=spClass("m_pg_mtpl");
		$this->mtpl=$mtpl->findAll(array(is_show=>1),null,"mtpl_id,mtpl_name");
		$m_pg_integrated_tasks=spClass("m_pg_integrated_tasks");
		$this->integrated_tasks=$m_pg_integrated_tasks->findAll(null,null,"integrated_tasks_id,mtpl_id,integrated_tasks_name");
		$specialtask = $this->spArgs("specialtask",0);
		$this->mtpl_id = $this->spArgs("mtpl_id",0);
		$this->vritual_id = $this->spArgs("vritual_id",0);
		$this->specialtask=$specialtask;
		if ($specialtask==2) { //如果是新建子项目，需要查出父项目名称及id
			$p_proj_id = $this->spArgs("p_proj_id",0);
			$this->p_proj_id=$p_proj_id;
			$p_proj =spClass("m_project_v")->find(array(proj_id=>$p_proj_id),null,"proj_name,proj_class,prod_name,prod_id,proj_psdUrl");
			$this->p_proj = $p_proj;
			$this->proj_class=getProjClass();
		}else {
			$this->p_proj_id=0;
		}
		//如果是子项目或者是特殊任务
		if ($specialtask==1||$specialtask==2) {
			$this->allUser = spClass("m_user")->findAll(null,null,"user_id,user_name");
		}
		/** juetion add end**/
		$this->user=$user;
		$this->projClass=getProjClass();
		$this->plist=spClass("m_product")->findAll();
		$this->nav_name='project_add';
		$this->display('project/projectAdd.html');
	}
	
	//新建项目
	function project_add_do()
	{
		$session=pmUser("all","html");
		$specialtask = $this->spArgs('specialtask',0);
		if ($specialtask==1||$specialtask==2) { //如果是特殊任务或子项目
			$user_id=$this->spArgs('principal');
		}else {
			$user_id=$session["id"];
			$user_name=$session["name"];
		}
		$user_power=$session["power"];
		$nodelist=array();
		//dump($this->spArgs());
		//数组的长度
		$nlength=$this->spArgs('nodecount');
		$prod_id=$this->spArgs('prod_id');
		if($this->spArgs('projState','40')=='50')
			$proj_state='50';
		else
			$proj_state='40';
		//构造项目数组
		$project_row=array(
					  'proj_name'=>$this->spArgs('proj_name'),
					  'proj_mail'=>$this->spArgs('proj_mail'),
					  'wrap_id'=>0,//$this->spArgs('wrap_id'),
					  'prod_id'=>$prod_id,
					  'proj_date'=>date("Y-m-d H:i:s"),
					  'proj_ps'=>$this->spArgs('proj_ps'),
					  'proj_url'=>$this->spArgs('proj_url'),
					  'proj_class'=>$this->spArgs('proj_class'),
					  'proj_psdUrl'=>$this->spArgs('proj_psdUrl'),
					  'proj_state'=>$proj_state,
					  'proj_start'=>$this->spArgs('proj_start').' '.$this->spArgs('proj_startTime'),
					  'proj_end'=>$this->spArgs('proj_end').' '.$this->spArgs('proj_endTime'),
					  'proj_level1'=>$this->spArgs('proj_level1'),
					  'proj_level2'=>$this->spArgs('proj_level2'),
					  'user_id'=>$user_id,
					  'contri_num'=>0,//$this->spArgs('proj_contri',0),//juetion 项目贡献值
					  'p_proj_id'=>$this->spArgs('parent_proj',0),//juetion 父项目id
					  'specialtask'=>$specialtask,//项目是否特殊任务 1-特殊项目，2-子项目
					  'proj_target'=>$this->spArgs('proj_target'),//项目目标
					  'preview_address'=>$this->spArgs('preview_address')//项目目标
					   );
		if($this->spArgs('dId'))
		{
			$project_row['did']=$this->spArgs('dId');
		}
		//构造流程数组
		for($i=0;$i<(int)$nlength;$i++)
		{
			if($this->spArgs('pnod_time_s'.$i)=="")
				$pnod_time_s=NULL;
			else
				$pnod_time_s=$this->spArgs('pnod_time_s'.$i);
				
			if($this->spArgs('pnod_time_e'.$i)=="")
				$pnod_time_e=NULL;
			else
				$pnod_time_e=$this->spArgs('pnod_time_e'.$i);
						
			$nodelist['proj_node'.$i]['pnod_time_s']=$pnod_time_s;
			$nodelist['proj_node'.$i]['pnod_time_e']=$pnod_time_e;
			$nodelist['proj_node'.$i]['pnod_type']=$this->spArgs('pnod_type'.$i);
			$nodelist['proj_node'.$i]['pnod_type2']=$this->spArgs('pnod_type2'.$i);
			$nodelist['proj_node'.$i]['user_id']=$this->spArgs('user_id_n'.$i);
			$nodelist['proj_node'.$i]['pnod_name']=$this->spArgs('pnod_name'.$i,"none");
			$nodelist['proj_node'.$i]['pnod_state']=($proj_state=='50'?50:20);//原来是$proj_state;（小马需求，不需审核直接进行）
			$nodelist['proj_node'.$i]['pnod_state2']=1;//流程默认需要审核
            $nodelist['proj_node'.$i]['pnod_desc']=$this->spArgs('pnod_desc'.$i);//流程描述
            $nodelist['proj_node'.$i]['outcome']=$this->spArgs('pnod_outcome'.$i);//流程产出物
            $nodelist['proj_node'.$i]['flow_id']=$this->spArgs('pnod_mtpl_flow'.$i);//流程对应的模板id
			if($this->spArgs('pnod_day'.$i,NULL))
				$nodelist['proj_node'.$i]['pnod_day']=$this->spArgs('pnod_day'.$i,NULL);
		}
		
		//构造素材数组
		if($this->spArgs('support_list_json'))
		{
			$meterailArray=object_array(json_decode($this->spArgs('support_list_json')));
		}
		//dump($this->spArgs());
		
		$result=spClass('m_project')->addProject($project_row,$nodelist,
				array('user_id'=>$session["id"],
						'user_name'=>$session["name"],
						'testNode'=>false,
						'meterail'=>$meterailArray,
						'mtplSelect'=>$this->spArgs('project-mtpl-select'),
						'vritual_id'=>$this->spArgs('vritual_id')));
		if($result['rs']==200)
		{
			$this->msg='操作成功！';
			$this->url1=spUrl('project_bll','project_show',array('id'=>$result['des']['proj_id']));
			$this->urltxt1='查看该项目';
			$this->display('public/message.html');
		}
		else
		{
			$this->msg='操作不成功:'.$result['des'];
			$this->display('public/message.html');
			exit();
		}
	}
	
	function saveMeterial()
	{
		$allRowsArray=$this->spArgs("allRowsData");
		echo json_encode(spClass('m_meterial')->updateWithArray($allRowsArray,$this->spArgs('proj_id')));
	}
	
	function deleteMeterial()
	{
		$user=pmUser('all','json');
		$meterialid=$this->spArgs('meterialid');
		if(!is_numeric($meterialid))
		{
			pmResult(403,'参数不正确');
		}
		$mMeterial=spClass('m_meterial');
		$rs=$mMeterial->findSql('SELECT project.user_id as userid,meterial.did as did FROM meterial LEFT JOIN project ON meterial.proj_id=project.proj_id WHERE meterial.meterialid='.$meterialid);
		if($user['id']!=$rs[0]['userid'])
		{
			pmResult(403,'没有权限');
		}
		else
		{
			if($mMeterial->delete(array('meterialid'=>$meterialid)))
			{
				$mMeterial->pushToComandSystem($rs[0]['did']);
				pmResult(200,'删除成功');
			}
			else
			{
				pmResult(403,'删除不成功');
			}
		}
	}
	
	
	//删除项目
	function proj_del()
	{
		$proj_id=$this->spArgs('proj_id','0');
		if($proj_id==0)
			pmResult(400,"参数错误","html");
		$user_id=pmUser("id","html");
		$user=pmUser("all","html");
		$m_proj=spClass('m_project');
		$p=$m_proj->find('proj_id='.$proj_id);
		if($user['power']!=0)
		{
			if($p['proj_state']<40)
			{
				pmResult(400,"项目不允许删除","html");
			}
			if($p['proj_state']==50&&$user_id!=$p['user_id'])
			{
				pmResult(403,"你没有权限删除不是自己的项目","html");
			}
		}

		//juetion 删除该项目下对应的技能 。 start
		$m_pg_pnod_skill = spClass("m_pg_pron_skill");
		if(!$m_pg_pnod_skill->delete(array(proj_id=>$proj_id)))
			pmLogs("error.project.deleteAll.m_pg_pnod_skill".date("Ymd_His").".log",$this->spArgs(),true,$path="tmp/log/",true);
		//juetion 删除该项目下对应的技能 。  end
		//juetion 删除项目贡献值等拓展信息 start
		$m_pg_proj_contri = spClass("m_pg_proj_contri");
		if (!$m_pg_proj_contri->delete(array(proj_id=>$proj_id))) {
			pmLogs("error.project.deleteAll.m_pg_proj_contri".date("Ymd_His").".log",$this->spArgs(),true,$path="tmp/log/",true);
		}
		//juetion 删除项目贡献值等拓展信息 end
		$m_proj->deleteAll($proj_id);
		$this->msg='操作成功！';
		$this->urltxt1='返回我的项目列表';
		$this->url1=spUrl('project','show',array("oUserId="=>$user_id));
		$this->display('public/message.html');
	}
	
	//项目信息保存
	function proj_save()
	{
		$user=pmUser("all","html");
		$project=spClass('m_project');
		$proj_id=$this->spArgs('proj_id');
		if($project->isUser($proj_id)==false)
            if($user['role']!=1)
			pmResult(403,NULL,"html");

		$conn=array('proj_id'=>$this->spArgs('proj_id'));
		$aProject=array();
		if($this->spArgs('proj_name'))
			$aProject['proj_name']=$this->spArgs('proj_name');
		if($this->spArgs('prod_id'))
			$aProject['prod_id']=$this->spArgs('prod_id');
		if($this->spArgs('wrap_id'))
			$aProject['wrap_id']=0;//$this->spArgs('wrap_id');
		if($this->spArgs('proj_ps'))
			$aProject['proj_ps']=$this->spArgs('proj_ps');
		if($this->spArgs('proj_url'))
			$aProject['proj_url']=$this->spArgs('proj_url');
		if($this->spArgs('proj_mail'))
			$aProject['proj_mail']=$this->spArgs('proj_mail');
		if($this->spArgs('proj_psdUrl'))
			$aProject['proj_psdUrl']=$this->spArgs('proj_psdUrl');
		if($this->spArgs('proj_class'))
			$aProject['proj_class']=$this->spArgs('proj_class');
		if($this->spArgs('proj_target'))
			$aProject['proj_target']=$this->spArgs('proj_target');
		if($this->spArgs('preview_address'))
			$aProject['preview_address']=$this->spArgs('preview_address');
		if($user["power"]<2)
		{
			if($this->spArgs('proj_level1'))
			{
				$aProject['proj_level1']=$this->spArgs('proj_level1');
				//大于3要将没有评的评分删掉
				if($this->spArgs('proj_level1')>3)
				{
					spClass('m_proj_score')->runSql("DELETE FROM proj_score WHERE proj_id=$proj_id AND score is NULL");
				}
			}
			if($this->spArgs('proj_level2'))
				$aProject['proj_level2']=$this->spArgs('proj_level2');
		}
		if(count($aProject)<1)
		{
			pmAlert("数据不能为空","?".$this->spArgs('fromModel'));
		}
		if( !is_numeric( $this->spArgs('proj_contri',0)) )
		{
			pmAlert("贡献值只能为数字","?".$this->spArgs('fromModel'));
		}
		
		if($project->update($conn,$aProject))
		{
			//juetion start 修改贡献值
			$m_pg_proj_contri = spClass("m_pg_proj_contri");
			if (!$m_pg_proj_contri->find(array(proj_id=>$proj_id))) {
				$m_pg_proj_contri->create(array(proj_id=>$proj_id,contri_num=>$this->spArgs('proj_contri',0)));
			}else 
			{
				$m_pg_proj_contri->update(array(proj_id=>$proj_id),array(contri_num=>$this->spArgs('proj_contri',0)));
			}
			//juetion end
			pmAlert("保存成功！","?".$this->spArgs('fromModel'));
		}
		else
		{
			pmAlert("保存失败！","?".$this->spArgs('fromModel'));
		}
	}	
	
	//取得项目信息json形式返回
	function getJson()
	{
		$mProject=spClass('m_project_v');
		$proj_id=$this->spArgs('projId');
		$conn=array('proj_id'=>$proj_id);
		$oProject=$mProject->find($conn);
		$nodes=spClass('m_proj_node')->findAll(array('proj_id'=>$proj_id));
		foreach($nodes as $node){$users["u_".$node["user_id"]]=$node["user_id"];}
		$users=spClass("m_user")->getUserList($users,"array");
		array_push($oProject,$users);
		echo(json_encode(array($oProject)));
	}
	
	//项目状态操作
	function setState()
	{
		$proj_id=$this->spArgs('proj_id');
		$state=$this->spArgs('state');
		$recover_day=$this->spArgs('recover_day',0);
		$user=pmUser("all","html");
		$aProject=spClass("m_project")->find(array("proj_id"=>$proj_id));
		if($aProject['proj_state']==$state)
			pmAlert('状态不能重复设定',spUrl('project_bll','project_show',array('id'=>$proj_id)));
		$m_pg_proj_contri = spClass("m_pg_proj_contri");
		// juetion start 查看子项目是否全部完成
		$child_proj=$m_pg_proj_contri->findSql("select p.proj_state from project p,
									pg_proj_contri pc where p.proj_id = pc.proj_id and
									pc.p_proj_id=".$proj_id." and p.proj_state >15");
		if ($child_proj) {
			$this->msg='操作不成功:还有子项目未完成';
			$this->display('public/message.html');
			exit();
		}
		// juetion end 查看子项目是否全部完成
		// juetion start 查看虚子项目是否全部创建
		$vritual_proj=$m_pg_proj_contri->findSql("select pv.proj_vritual_child_id,pm.mtpl_id,pm.mtpl_name from pg_mtpl pm,
												proj_vritual_child pv where pm.mtpl_id = pv.mtpl_id
												and pv.proj_id =".$proj_id);
		if ($vritual_proj) {
			$this->msg='操作不成功:还有虚拟子项目未创建';
			$this->display('public/message.html');
			exit();
		}
		// juetion end 查看虚子项目是否全部创建
		
		$rs=spClass("m_project")->setState($proj_id,$state);
		if($rs=="done")
		{
			//项目完成时发放贡献值 juetion
			if($state==15){
				
				//juetion start 项目结束 贡献值发放到每个流程的每个人
				$contri_num = $m_pg_proj_contri->findSql("select pc.contri_num from pg_proj_contri pc where pc.proj_id = ".$proj_id);
				$contri_num = $contri_num[0]['contri_num'] == null?0:$contri_num[0]['contri_num'];
				$m_pg_proj_contri->runSql("
									update pg_user pu
									set pu.pg_user_gongxian = pu.pg_user_gongxian + ".$contri_num."
									where pu.user_id in (SELECT DISTINCT pjn.user_id from proj_node pjn
									where pjn.proj_id = ".$proj_id.")
									");
				//juetion end
			}
			
			
			//归档时随机抽取两个人必须评分
			if($state==10)
			{
				
				if($aProject["proj_level1"]>0&&$aProject["proj_level1"]<=3)
				{
					$targetUserArray=spClass("m_user")->findSql("SELECT user_id,user_name FROM user where power2&1=1");
					shuffle($targetUserArray);
					$randUserArray=array();
					array_push($randUserArray,$targetUserArray[0]);
					array_push($randUserArray,$targetUserArray[1]);
					//发送评分邀请
					$mProjectScore=spClass("m_proj_score");
					foreach($randUserArray as $randUser)
					{
						if($randUser)
						{
							$willCreateRecord=array(
							"proj_id"=>$proj_id,
							"user_id"=>$randUser["user_id"]
							);
							$mProjectScore->create($willCreateRecord);
							//发送邀请信息
							$mMsg=spClass("m_message");
							$mMsg->init("邀请了你对项目评分。",$proj_id,NULL,0,1)->toUser($randUser["user_id"])->send();
						}
					}
				}
			}
			//设置日期
			if($recover_day!=0) spClass("m_proj_node")->putDateDelay($proj_id,$recover_day);
			$this->msg='操作成功';
			if($state==10&&$aProject["proj_level1"]>0&&$aProject["proj_level1"]<=3)
			{
				$this->urltxt1='系统随机抽取了['.$randUserArray[0]['user_name'].']['.$randUserArray[1]['user_name'].']同学对本项进行评分';
				$this->url1=spUrl('project_bll','project_show',array('id'=>$proj_id))."#set-project-score-box";
			}
			else
			{
				$this->urltxt1='查看该项目';
				$this->url1=spUrl('project_bll','project_show',array('id'=>$proj_id));
			}
			
			$this->urltxt2='返回我的工作';
			$this->url2=spUrl('project_bll','myWork');			
			$this->display('public/message.html');
			exit();
		}
		else
		{
			$this->msg='操作不成功:'.$rs;
			$this->display('public/message.html');
			exit();
		}
	}
	
	function pass()
	{
		pmAuth("manager","html");
		$proj_level1=$this->spArgs("proj_level1");
		$proj_level2=$this->spArgs("proj_level2");
		$proj_id=$this->spArgs('pid');
		if(!is_numeric($proj_id)||!is_numeric($proj_level1)||!is_numeric($proj_level2)||!$proj_level1||!$proj_level2) 
			pmAlert("请先选择项目分级。",-1);
		
		$rs=spClass("m_project")->setState($proj_id,20);
		if($rs=="done")
		{
			spClass("m_project")->update(array("proj_id"=>$proj_id),array("proj_level1"=>$proj_level1,"proj_level2"=>$proj_level2));
			$this->msg='操作成功';
			$this->urltxt1='查看该项目';
			$this->url1=spUrl('project_bll','project_show',array('id'=>$proj_id));
			$this->urltxt2='返回我的工作';
			$this->url2=spUrl('project_bll','myWork');
			$this->display('public/message.html');
			exit();
		}
		else
		{
			pmAlert($rs,-1);
		}
	}
	
	//项目状态操作
	function setStateAjax()
	{
		$proj_id=$this->spArgs('proj_id');
		$state=$this->spArgs('state');
		$recover_day=$this->spArgs('recover_day',0);
		$rs=spClass("m_project")->setState($proj_id,$state);
		if($rs=="done")
		{
			pmResult('1','success!','json');
		}
		else
		{
			pmResult('0',$rs,'json');
		}
	}
	
	//退回一个项目
	function rejectProject()
	{
		$proj_id=$this->spArgs('rejectProjectId');
		$rejectReason=$this->spArgs('rejectReason');
		$rs=spClass("m_project")->setStateWithArray(array(
		"proj_id"=>$proj_id,
		"state"=>50,
		"isSetPnod"=>true,
		"describe"=>$rejectReason
		));
		if($rs=="done")
		{
			$this->msg='操作成功';
			$this->urltxt1='查看该项目';
			$this->url1=spUrl('project_bll','project_show',array('id'=>$proj_id));
			$this->urltxt2='返回我的工作';
			$this->url2=spUrl('project_bll','myWork');
			$this->display('public/message.html');
			exit();
		}
		else
		{
			$this->msg='操作不成功:'.$rs;
			$this->display('public/message.html');
			exit();
		}
	}
	
	/**
	@ Name:setScore
	@ Describe:打分过程
	@ param:
		@require
			$proj_id (int) 项目ID
			$score (int) 分数
		@optional
			$comment (string)评价
	@ return void
	*/
	function setScore()
	{
		//dump($this->spArgs());
		//die();
		$proj_id=$this->spArgs("id");
		$score=$this->spArgs("score");
		$scoreNum=pmScoreToNum($score);
		$comment=$this->spArgs("comment");
		$mProject=spClass("m_project");
		$user=pmUser("all","html");
		$isSetScoreSuccess=false;
		
		//--
		if(!is_numeric($proj_id)||!is_numeric($scoreNum))
		{
			pmResult(400,NULL,"html");
		}
		
		//读取项目
		$project=$mProject->find(array("proj_id"=>$proj_id));
		if(!$project)
		{
			pmResult(400,"您要打分的项目不存在","html");
		}
		if($project["proj_state"]!=10)
		{
			pmResult(400,"项目未归档，不能打分","html");
		}
		//检查是否有评分权
		$mProjectScore=spClass("m_proj_score");
		$isCanScore=false;
		if($project["proj_state"]==10&&$project["proj_level1"]<=3&&$project["proj_level1"]>0)
		{
			$isCanScoreUser=$mProjectScore->find(array("user_id"=>$user["id"],"proj_id"=>$proj_id));
			if($isCanScoreUser)
			{
				if($isCanScoreUser["score"]==NULL)
					$isCanScore=true;
			}
			else
			{
				if(pmAuth2(1,NULL))
					$isCanScore=true;
			}
		}
		if(!$isCanScore)
		{
			pmResult(403,"不能评分,原因可能如下<br />1、项目未归档  2、没有授权  3、您已经评过分 4、项目必须是A-C级才允许评分","html");
		}
		$scoreRecord=array(
			"proj_id"=>$proj_id,
			"user_id"=>$user["id"],
			"score"=>$score,
			"comment"=>$comment,
			"time"=>date("Y-m-d H:i:s")
		);
		//写入评分
		
		$isSuccess=false;
		if($isCanScoreUser)
			$isSuccess=$mProjectScore->update(array("proj_score_id"=>$isCanScoreUser["proj_score_id"]),$scoreRecord);
		else
			$isSuccess=$mProjectScore->create($scoreRecord);
		if($isSuccess)
		{
			$newScore;
			if($project["proj_score"]==NULL)
				$newScore=$scoreNum;
			else
				$newScore=($project["proj_score"]+$scoreNum)/2;
			$mProject->update(array("proj_id"=>$proj_id),array("proj_score"=>$newScore));
			pmAlert("评分成功！",spUrl('project_bll','project_show',array('id'=>$proj_id)));
		}
		else
		{
			pmResult(404,"分数写入失败，请重新提交或联系管理员","html");
		}
	}
	
	
	/**
	@ Name:inviteScore
	@ Describe:邀请打分
	@ param:
		@require
			$projId (int) 项目ID
			$userArray (json) 用户ID数组{user_id:key,value:id}
		@optional
	@ return json(pmResult)
	*/
	function inviteScore()
	{
		$proj_id=$this->spArgs("id");
		$userArray=$this->spArgs("userArray");
		$mProjectScore=spClass("m_proj_score");
		$userArrayForMessage=array();
		function isUserInArray($_userId,$_array)
		{
			foreach($_array as $_u)
			{
				if($_userId==$_u["user_id"])
					return true;
			}
			return false;
		}
		//--
		pmAuth("topManager","json");
		if(!is_numeric($proj_id)||!is_array($userArray))
		{
			pmResult(400,NULL,"json");
		}
		if(count($userArray)<1) 
		{
			pmResult(400,"没有选中用户","json");
		}
		$projectScoreArray=$mProjectScore->findAll(array("proj_id"=>$proj_id));
		foreach($userArray as $user)
		{
			//过虑空白的和重复的userId
			if($user["value"]&&!isUserInArray($user["value"],$projectScoreArray))
			{
				$willCreateRecord=array(
					"proj_id"=>$proj_id,
					"user_id"=>$user["value"]
				);
				$mProjectScore->create($willCreateRecord);
				array_push($userArrayForMessage,$user["value"]);
			}
		}
		//发送推送
		$mMsg=spClass("m_message");
		$mMsg->init("邀请了你对项目评分。",$proj_id,NULL,0,1)->toUser($userArrayForMessage)->send();
		pmResult(200,'邀请成功！','json');
	}
	
	//设置流程的前置流程
	function pnode_before()
	{
		$pnode_id = $this->spArgs('pnode_id');
		$proj_id = $this->spArgs('proj_id');
		$this->pnode_id = $pnode_id;
		$this->pnod_name = $this->spArgs('pnod_name');
		$mPnode=spClass("m_proj_node");
		$nodeAll = $mPnode->findSql(" select pn.pnod_id as id,pn.pnod_name as name 
									from proj_node pn where pn.pnod_id!=".$pnode_id."
									and pn.proj_id =".$proj_id);
		$this->nodeAll = $nodeAll;
		$m_pron_check = spClass("m_pron_check");
		$selectNode_result=$m_pron_check->findAll(array(pron_id=>$pnode_id),null,"p_pron_id");
		$selectNode = array();
		foreach ($selectNode_result as $value)
		{
			array_push($selectNode, $value['p_pron_id']);
		}
		$this->selectNode = $selectNode;
		$this->display('project/pnodeBefore.html');
	}
	//确定配置这些前置流程
	function pnode_before_do()
	{
		$pnode_id = $this->spArgs('pnode_id');
		$select_data = $this->spArgs('select_data');
		$m_pron_check = spClass("m_pron_check");
		$m_pron_check->delete(array(pron_id=>$pnode_id));
		foreach ( $select_data as $value ) {
			$m_pron_check->create(array(pron_id=>$pnode_id,p_pron_id=>$value));
		}
		echo json_encode(array(return_msg=>true,msg=>"选择失败。"));
	}
	
	function del_child_proj()
	{
		$proj_id = $this->spArgs('proj_id');
		$this->proj_id=$proj_id;
		$m_pg_proj_contri = spClass("m_pg_proj_contri");
		if ($proj_contri['p_proj_id']!=null||$proj_contri['p_proj_id']!=0) {
			$this->parent_proj=spClass("m_project")->find(array(proj_id=>$proj_contri['p_proj_id']),null,"proj_id,proj_name");
		}
		$child_proj=$m_pg_proj_contri->findSql("select p.proj_id,p.proj_name from project p,
									pg_proj_contri pc where p.proj_id = pc.proj_id and
									pc.p_proj_id=".$proj_id);
		$this->child_proj = $child_proj;
		$m_proj_vritual_child = spClass("m_proj_vritual_child");
		$this->vritual_proj = $m_proj_vritual_child->findSql("select pv.proj_vritual_child_id,pm.mtpl_name from pg_mtpl pm,
																proj_vritual_child pv where pm.mtpl_id = pv.mtpl_id
																and pv.proj_id =".$proj_id);
		
		$this->display('project/delChildProj.html');
	}
	function del_child_proj_do()
	{
		$m_pg_proj_contri = spClass("m_pg_proj_contri");
		$return_msg = true;
		$proj_id = $this->spArgs('proj_id');
		$select_data = $this->spArgs('select_data');
		$actual_data = array();
		$vritual_data = array();
		foreach ($select_data as $value) {
			$tmpArray = explode("_",$value);//两个，第一个是否虚子项目，第二个是项目id或者虚子项目的模板id
			if ($tmpArray[0]) { //是虚子项目
				array_push($vritual_data, $tmpArray[1]);
			}else { //真是子项目
				array_push($actual_data, $tmpArray[1]);
			}
		}
		$actual_data_string = implode($actual_data, ',');
		$vritual_data_string = implode($vritual_data, ',');
		if (count($actual_data)>0) {
			$return_msg = $m_pg_proj_contri->runSql("update pg_proj_contri p
									set p.is_special=0,p.p_proj_id=0
									where p.proj_id in(".$actual_data_string.")");
		}
		if (count($vritual_data)>0) {
			$return_msg = $m_pg_proj_contri->runSql("delete from proj_vritual_child 
										where proj_vritual_child_id in(".$vritual_data_string.")");
		}
		echo json_encode(array(return_msg=>$return_msg,msg=>"解除失败。"));
	}
	
	//学生技能需要发放列表
	function myStudentPorjects() {
		$teacher_Id = $this->spArgs('teacher_Id');
		$prod_id=$this->spArgs('spid',false);
		$prod_name=$this->spArgs('spn');
		$proj_state=$this->spArgs('ssid');
		$search_dates=$this->spArgs('sd1');
		$search_datee=$this->spArgs('sd2');
		$search_key=$this->spArgs('sk');
		$andContidiion = " ";
		if ($prod_id&&$prod_name!='选择产品') {
			$andContidiion = $andContidiion."and b.prod_name='".$prod_name."' ";
		}
		if ($search_key&&$search_key!="") {
			$andContidiion = $andContidiion."and b.proj_name LIKE '%".$search_key."%' ";
		}
		if ($proj_state) {
			$andContidiion = $andContidiion."and b.proj_state=".$proj_state." ";
		}
		$m_pg_user = spClass("m_pg_user");
		$studentProjects = $m_pg_user->findSql("select c.*,d.proj_start,d.proj_end from (select DISTINCT b.proj_id,b.proj_name,b.proj_state,b.prod_name from pg_pron_skill a RIGHT JOIN (select pjn.proj_id,pjn.proj_name,pjn.user_id,pjn.proj_state,pjn.prod_name from proj_node_v pjn where pjn.user_id in (select pu.user_id from pg_user pu where pu.p_user_id=$teacher_Id) and pjn.pnod_time_s>'2013-07-01') b on a.proj_id = b.proj_id and a.user_id = b.user_id where a.send_data is NULL ".$andContidiion." ORDER BY b.proj_id desc) c,project d where c.proj_id = d.proj_id");
		$this->studentProjects = $studentProjects;
		$this->state_list=getProjState();
		$this->teacher_Id=$teacher_Id;
		$this->prod_id=$prod_id;
		if($prod_id) $this->prod_name=$prod_name;
		$this->proj_state=$proj_state;
		$this->search_key=$search_key;
		$this->display('project/myStudentProjects.html');
	}
}
