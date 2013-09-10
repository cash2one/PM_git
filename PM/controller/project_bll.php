<?php
class project_bll extends spController
{
	
	//我的工作
	function myWork()
	{
       // $this->jump("http://192.168.10.16:8080/oa/index.php?c=project_bll&a=project_show&id=2893");
		//我的待办流程输出
		$user=pmUser("all","html");
		$user_id=$user["id"];
		$role_id=$user["role"];
		$mNode=spClass('m_proj_node_v');
		$mProject=spClass('m_project_v');
		$projClass=getProjClass();
		$this->state_list=getPnodState();
		$this->userId=$user_id;
		if($user["power"]==0)
		{
			$this->isShowCheckAll=true;
			//待审核的需求
			//$disPassDemandArray=spClass('m_tdsystem')->getUnpassList();
			//$this->disPassDemandArray=$disPassDemandArray;
			
			//我的待审核流程-13.8.22 改 分组内
			//$condition=array('pnod_state'=>'17');
            $sql="select * from proj_node_v where pnod_state=17";
            $sql.=$this->groupIn();
			$rows_rs=$mNode->spPager($this->spArgs('topage',1),50)->findSql($sql);
			$this->rows_node_check=$rows_rs;
            //13.09.04 不显示已搞掂的东西
			//$this->rows_node_last=json_decode(file_get_contents("tmp/cache/pNodesLastState15.txt"),true);
			//$this->rows_node_last_reject=json_decode(file_get_contents("tmp/cache/pNodesLastState20.txt"),true);

	
			//我的待审核项目-13.8.22 改 分组内
			$rows=spClass('m_project_v');
			//$condition=array('proj_state'=>'40');
            $sql2="select * from project_v where proj_state=40";
            $sql2.=$this->groupIn();
			//$this->rows_project=$mProject->spPager($this->spArgs('topage',1),50)->findAll($condition);
            $this->rows_project=$mProject->spPager($this->spArgs('topage',1),50)->findSql($sql2);

            //13.09.04 不显示已搞掂的东西
			//$this->rows_project_last=json_decode(file_get_contents("tmp/cache/projectLastState20.txt"),true);
			//$this->rows_project_last_50=json_decode(file_get_contents("tmp/cache/projectLastState50.txt"),true);
			
			if($role_id==5)
			{
				$this->isShowCheckFinish=true;
				//我的待归档项目
				$condition=array('proj_state'=>'15');
				$this->rows_proj_finish=$mProject->spPager($this->spArgs('topage',1),50)->findAll($condition);
                //13.09.04 不显示已搞掂的东西
				//$this->rows_proj_finish_last=json_decode(file_get_contents("tmp/cache/projectLastState10.txt"),true);
				$this->state_list=getPnodState();
			}
		}
		
		if($user["power"]==1)//职位是审核员
		{
			$this->isShowCheckDesign=true;
			$condition=array('pnod_state'=>'17','role_id'=>$role_id);
			$rows_rs=$mNode->spPager($this->spArgs('topage',1),50)->findAll($condition);

            //13.09.04 不显示已搞掂的东西
			//$this->rows_node_last=json_decode(file_get_contents("tmp/cache/pNodesLastState15.txt"),true);
			$this->rows_node_check=$rows_rs;
		}
		
		//等待评分的项目
		$sql="SELECT proj_score.proj_id,prod_name,wrap_name,proj_name,user_name FROM proj_score LEFT JOIN project ON project.proj_id=proj_score.proj_id LEFT JOIN product ON project.prod_id=product.prod_id LEFT JOIN wrap ON project.wrap_id=wrap.wrap_id LEFT JOIN user ON project.user_id=user.user_id WHERE proj_score.score is NULL AND proj_score.user_id=$user_id";
		$unScoreProjectArray=spClass("m_proj_score")->findSql($sql);
		$this->unScoreProjectArray=$unScoreProjectArray;
		
		//等待建立的项目
		//$mDemand=spClass('m_demand');
		//$this->unBuildProjectArray=$mDemand->findAll(array('status'=>0,'user_id'=>$user_id));
		
		//不显示指引
		$this->showIntroduction=0;
		
		//输出
		$this->display('project/myWork.html');
	}
	
	//我的项目表格视图
	function myProjectsTable()
	{
		$user_id=pmUser("id","html");
		$projClass=getProjClass();
		$mProject=spClass('m_project_v');
		$mNode=spClass('m_proj_node_v');
		 //我的项目
		$condition='';
        /*  2013.6.25 未审核也能开工
		$rows_rs=$mProject->findSql("SELECT * FROM project_v WHERE user_id=$user_id AND proj_state>=15 AND proj_state<=40 ORDER BY proj_state DESC");
		$row_nodes=$mNode->findSql("select * from proj_node_v where proj_id in(select proj_id from project where user_id=$user_id and proj_state>=15 and proj_state<=40)");
        */
        $rows_rs=$mProject->findSql("SELECT * FROM project_v WHERE user_id=$user_id AND proj_state>=15 AND proj_state<=50 ORDER BY proj_state DESC");
        $row_nodes=$mNode->findSql("select * from proj_node_v where proj_id in(select proj_id from project where user_id=$user_id and proj_state>=15 and proj_state<=50)");

		foreach($rows_rs as &$rs)
		{
			$rs["proj_class"]=$projClass[$rs["proj_class"]];
			foreach($row_nodes as $row_node)
			{
				if($rs["proj_id"]==$row_node["proj_id"])
				{
					if(!$rs["nodes"]) $rs["nodes"]=array();
					array_push($rs["nodes"],$row_node);
				}
			}
		}
		$this->myProjects=$rows_rs;
		 //非我创建的项目，但我负责的流程
		$condition="";
        /*   2013.6.25 未审核也能开工
		$rows_rs=$mNode->spPager($this->spArgs('topage',1),30)->findSql("SELECT * FROM proj_node_v WHERE user_id=$user_id and res_user_id<>$user_id and proj_state>=15 and proj_state<=40 ORDER BY pnod_state DESC");
        */
        $rows_rs=$mNode->spPager($this->spArgs('topage',1),30)->findSql("SELECT * FROM proj_node_v WHERE (user_id=$user_id or respon_id=$user_id) and res_user_id<>$user_id and proj_state>=15 and proj_state<=50 ORDER BY pnod_state DESC");
        $this->myNodes=$rows_rs;
		$this->state_list=getPnodState();
		$this->display('project/myWork_list_ajax.html');
	}

	
	//待审项目
	function project_check()
	{
		pmAuth("manager");
		$rows=spClass('m_project_v');
		$condition=array(
						 'proj_state'=>'30',
						 );
        $con='';
        if(pmUser("group")){
            $con=$this->groupIn();
        }
		//$this->rows=$rows->spPager($this->spArgs('topage',1),50)->findAll($condition);
        //die('select * from project_v where proj_state=30'.$con);
        $this->rows=$rows->spPager($this->spArgs('topage',1),50)->findSql('select * from project_v where proj_state=30'.$con);
		$this->state_list=getProjState();
		$this->display('project/project_check.html');		
	}
    //组内项目
    function groupIn(){
        $condition='';
        if(pmUser('group')){
            $groupId=pmUser("group");
            $group=spClass('m_group');
            $returnArr=array();
            $prodArr=$group->getProdArray($groupId);
            foreach($prodArr as $item){
                array_push($returnArr,$item['prod_id']);
            }
            $returnStr=join($returnArr,',');

            $condition= " and (prod_id in (".$returnStr.") or proj_redprd in (".$returnStr."))";
            // dump($condition);
        }
        return $condition;
    }
	
	
	//项目显示
	function project_show()
	{
		$proj_id=$this->spArgs('id');
		$proj_c=spClass('m_project_v');
		$user=pmUser("all","html");
		$mProjectScore=spClass("m_proj_score");
		
		$skill_user = array();//juetion添加，参与者
		$m_pg_pron_skill = spClass("m_pg_pron_skill");//juetion 用户获取技能情况
				
		//检查该项目打开人是否负责人（管理员和审核员除外）
        //20130730新增：编辑可以修改所有项目（试行）
		if($user["id"]==$proj_c->getUserId($proj_id)||$user["power"]==0||$user["power"]==1||$user["role"]==1)
			$is_user=1;
		else
			$is_user=0;
			
		//项目资料
		$condition=array('proj_id'=>$proj_id,);

		if(!$project=$proj_c->find($condition))
		{
			$this->msg='该项目己不存在！';
			$this->display('public/message.html');
			exit();
		}
		else
		{
			
			//项目对应流程
			$proj_node=spClass('m_proj_node_v');
			$condition=array('proj_id'=>$proj_id);		
			$proj_node_arr=$proj_node->findAll($condition,"pnod_time_s ASC");
			foreach($proj_node_arr as &$rs)
			{
				if($rs['pnod_time_s']) $rs['pnod_time_s']=date('Y-m-d',strtotime($rs['pnod_time_s']));
				if($rs['pnod_time_e']) $rs['pnod_time_e']=date('Y-m-d',strtotime($rs['pnod_time_e']));
				if(''!=$rs['pnod_time_r'])
				   $rs['pnod_time_r']=date('Y-m-d',strtotime($rs['pnod_time_r']));
				//juetion 找出所有参与者
				$user_tmp = array(user_id=>$rs["user_id"],user_name=>$rs["user_name"]);

				if (!in_array($user_tmp, $skill_user)) {
					array_push($skill_user, $user_tmp);
				}
                //dump($skill_user);


			}
            //g7 09.04 实习生权限
            if(pmUser("power")==255){
                $person=array(
                    'user_id' => pmUser('id'),
                    'user_name' =>  pmUser('name')
                );
                if((pmUser('id')!=$project['user_id'])&&!in_array($person,$skill_user)){

                    $this->msg='权限不足！没法查看该项目';
                    $this->display('public/message.html');
                    exit();
                }
            }
			//juetion 获取每个人技能的配置情况 start
			$_skill_user = array();//juetion添加，要给技能的人
			foreach($skill_user as &$s_user)
			{
				$skills = $m_pg_pron_skill->findSql("
						select ps.skill_name from pg_skill ps,pg_pron_skill pp 
						where pp.user_id = ".$s_user["user_id"]." and ps.skill_id = pp.skill_id
						and pp.proj_id=".$proj_id);
				$user_tmp = array(user_id=>$s_user["user_id"],user_name=>$s_user["user_name"],skills=>$skills);
				array_push($_skill_user, $user_tmp);
			}
			$this->skill_user = $_skill_user;
			//juetion 获取每个人技能的配置情况 end
			
			//变量输出
			$this->proj_node=$proj_node_arr;
			$this->proj_state_list=getProjState();
			$this->pnod_state_list=getPnodState();
			$this->proj_class=getProjClass();
			$this->plist=spClass("m_product")->findAll();
			
			//附件
			$mFile=spClass('m_files');
			$files=$mFile->findAll(array('proj_id'=>$proj_id));
			foreach($files as &$file)
			{
				$file["ext"]=pmGetFileExt($file["file_url"]);
			}
			$this->files=$files;
				
			//项目对应事件
			$events=spClass('m_event')->findSql("select event.*,user_name FROM event LEFT JOIN user on event.user_id=user.user_id where proj_id=$proj_id");
			foreach($events as &$even)
			{
				$even["even_content"]=nl2br($even["even_content"]);
			}
			
			if(spClass("m_project")->getIsFinish($proj_id))
				$this->isFinished=1;
			else
				$this->isFinished=0;
				
				
			//检查是否有评分权
			$isCanScore=false;
			$isShowInviteScore=false;//是否显示邀请评分
			if($project["proj_state"]==10&&$project["proj_level1"]<=3&&$project["proj_level1"]>0)
			{
				if($user["id"]==1)
					$isShowInviteScore=true;
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
			$this->isCanScore=$isCanScore;
			$this->isShowInviteScore=$isShowInviteScore;
			
			//管理员查看打分
			if($user["power"]==0)
			{
				$this->projectScore=$project["proj_score"];
				$scoreArray=$mProjectScore->findSql("SELECT proj_score.*,user_name FROM proj_score LEFT JOIN user ON user.user_id=proj_score.user_id WHERE proj_id=$proj_id");
				$this->scoreArray=$scoreArray;
			}
			
			//管理员查看打分
			if($user["power"]==0)
			{
				$ungroupNodeScoreArray=$mProjectScore->findSql("SELECT node_score.*,user_name FROM node_score LEFT JOIN user ON user.user_id=node_score.user_id WHERE proj_id=$proj_id");
				$nodeScoreArray=array();
				foreach($ungroupNodeScoreArray as $_node)
				{
					if(!$nodeScoreArray[$_node["pnod_id"]]) $nodeScoreArray[$_node["pnod_id"]]=array();
					array_push($nodeScoreArray[$_node["pnod_id"]],$_node);
				}
				$this->nodeScoreArray=$nodeScoreArray;
				//dump($nodeScoreArray);
			}
			//dump($proj_node_arr);
			//项目等级
			$proj_level=getProjLevel();
			$project["proj_level1_name"]=$proj_level[$project["proj_level1"]]['name'];
			$project["proj_level2_name"]=$proj_level[$project["proj_level1"]]['data'][$project["proj_level2"]];
			//项目等级 end
			
			/** juetion add start**/
			$m_pg_proj_contri = spClass("m_pg_proj_contri");
			$proj_contri=$m_pg_proj_contri->find(array(proj_id=>$proj_id));
			$this->proj_contri=$proj_contri['contri_num']==null?0:$proj_contri['contri_num'];
			if ($proj_contri['p_proj_id']!=null||$proj_contri['p_proj_id']!=0) {
				$this->parent_proj=spClass("m_project")->find(array(proj_id=>$proj_contri['p_proj_id']),null,"proj_id,proj_name,proj_state");
			}
			$child_proj=$m_pg_proj_contri->findSql("select p.proj_id,p.proj_name,p.proj_state from project p,
									pg_proj_contri pc where p.proj_id = pc.proj_id and 
									pc.p_proj_id=".$proj_id);
			$this->child_proj = $child_proj;
			//虚拟子项目
			$m_proj_vritual_child = spClass("m_proj_vritual_child");
			$this->vritual_proj = $m_proj_vritual_child->findSql("select pm.mtpl_id,pm.mtpl_name from pg_mtpl pm, 
																proj_vritual_child pv where pm.mtpl_id = pv.mtpl_id 
																and pv.proj_id =".$proj_id);
			
			/** juetion add end**/
			
			$this->scoreNameArray=pmScoreNameArray();
			$this->rs=$project;
			$this->role_id=$user["role"];
			$this->user_id=$user["id"];
			$this->power=$user["power"];
			$this->is_user=$is_user;
			$this->event=$events;
			$this->display('project/project.html');	
		}
	}
	
	
	
	
	// 编辑项目显示
	function projEdit()
	{
		$proj_id=$this->spArgs('id');
		$proj_c=spClass('m_project_v');
		$user=pmUser("all","html");
		$user_id=$user["id"];
		$this->projClass=getProjClass();
		
		//检查该项目打开人是否负责人（管理员和审核员除外）
		if($user_id==$proj_c->getUserId($proj_id)||$user["power"]==0||$user["power"]==1||$user["role"]==1)
			$is_user=1;
		else
			$is_user=0;
			
		//管理员可以修改，其它人都不能修改。
		if($user["power"]>1)
		{
				if($is_user!=1)
				{
					exit("你不能编辑不是自己的项目！");
				}
		}
		
		//项目资料
		$condition=array('proj_id'=>$proj_id);
		$project=$proj_c->find($condition);
		
		if(!$project)
		{
			$this->msg='该项目己不存在！';
			$this->display('public/message.html');
			exit();
		}
		else if($project['proj_state']==10&&$isEdit==1)
		{
			$this->msg='该项目己归档，不能再修改。';
			$this->display('public/message.html');
			exit();
		}
		else if($project==50&&$is_user==0)
		{
			pmResult(400,"不能修改别人的草稿","html");
		}
		else
		{
			$proj_level=getProjLevel();
			$project["proj_level1_name"]=$proj_level[$project["proj_level1"]]['name'];
			$project["proj_level2_name"]=$proj_level[$project["proj_level1"]]['data'][$project["proj_level2"]];
			if($dProject['proj_start']=="0000-00-00 00:00:00") $dProject['proj_start']="";
			if($dProject['proj_end']=="0000-00-00 00:00:00") $dProject["proj_end"]="";
			//项目对应流程
			$mNode=spClass('m_proj_node_v');
			$condition=array('proj_id'=>$proj_id);		
			$cNodes=$mNode->findAll($condition,"pnod_time_s ASC");
			
			//区分移动组和网站组
			if($user['role']!=7)
				$nodeClass=getNodesClass(1);
			else
				$nodeClass=getNodesClass(2);
					
			foreach($cNodes as &$cNode)
			{
				if($cNode["pnod_state"]<20&&$user['power']>1){$cNode["pmui_isEidt"]=0;$cNode["pmui_isDel"]=0;};
				if($cNode["pnod_time_s"]) $cNode["pnod_time_s"]=date('Y-m-d',strtotime($cNode["pnod_time_s"]));
				if($cNode["pnod_time_e"]) $cNode["pnod_time_e"]=date('Y-m-d',strtotime($cNode["pnod_time_e"]));
				$cNode["pnod_type_name"]=$nodeClass[$cNode["pnod_type"]]['name'];
				$cNode["pnod_type_name2"]=$nodeClass[$cNode["pnod_type"]]['data'][$cNode["pnod_type2"]];
				$cNode["user_id_n"]=$cNode["user_id"];
			}
			
			//素材支持
			$mMeterial=spClass('m_meterial');
			$meterialArray=$mMeterial->findAll(array('proj_id'=>$proj_id));
			$this->meterialJson=json_encode($meterialArray);
			
			/** juetion add start**/
			$skill=spClass('m_pg_skill');
			$this->skill=$skill->findAll();
			$mtpl=spClass("m_pg_mtpl");
			$this->mtpl=$mtpl->findAll(null,null,"mtpl_id,mtpl_name");
			
			$m_pg_proj_contri = spClass("m_pg_proj_contri");
			$proj_contri=$m_pg_proj_contri->find(array(proj_id=>$proj_id));
			$this->proj_contri=$proj_contri['contri_num']==null?0:$proj_contri['contri_num'];
			if ($proj_contri['p_proj_id']!=null||$proj_contri['p_proj_id']!=0) {
				$this->parent_proj=spClass("m_project")->find(array(proj_id=>$proj_contri['p_proj_id']),null,"proj_id,proj_name,proj_state");
			}
			$child_proj=$m_pg_proj_contri->findSql("select p.proj_id,p.proj_name,p.proj_state from project p,
									pg_proj_contri pc where p.proj_id = pc.proj_id and
									pc.p_proj_id=".$proj_id);
			$this->child_proj = $child_proj;
			//虚拟子项目
			$m_proj_vritual_child = spClass("m_proj_vritual_child");
			$this->vritual_proj = $m_proj_vritual_child->findSql("select pv.proj_vritual_child_id,pm.mtpl_id,pm.mtpl_name from pg_mtpl pm,
																proj_vritual_child pv where pm.mtpl_id = pv.mtpl_id
																and pv.proj_id =".$proj_id);
				
			/** juetion add end**/
			
			//变量输出
			$this->rs=$project;
			$this->user=$user;
			//$this->proj_node=$cNodes;
			$this->proj_node_json=json_encode($cNodes);
			$this->proj_state_list=getProjState();
			$this->pnod_state_list=getPnodState();
			$this->proj_class=getProjClass();
			$this->plist=spClass("m_product")->findAll();
			$this->wraplist=spClass('m_wrap')->findAll(array("wrap_state"=>"2"));
			$this->display('project/projectEdit.html');
		}
	}

	//项目显示_管理员端
	function project_show_check()
	{
		pmAuth("manager","html");
		$mProject=spClass('m_project_v');
		$proj_node=spClass('m_proj_node_v');
		$proj_id=$this->spArgs('id');
		$condition=array('proj_id'=>$this->spArgs('id'));
		$project=$mProject->find($condition);
		if(!$project)
		{
			pmAlert("项目不存在");
		}
		
		//附件
		$mFile=spClass('m_files');
		$files=$mFile->findAll(array('proj_id'=>$proj_id));
		foreach($files as &$file)
		{
			$file["ext"]=pmGetFileExt($file["file_url"]);
		}
		$this->files=$files;
		
		$proj_level=getProjLevel();
		$project["proj_level1_name"]=$proj_level[$project["proj_level1"]]['name'];
		$project["proj_level2_name"]=$proj_level[$project["proj_level1"]]['data'][$project["proj_level2"]];
		//if($this->rs["proj_state"]<=20) $this->jump(spUrl("project_bll","project_show",array("id"=>$this->spArgs('id'))));
		$condition=array( 'proj_id'=>$this->spArgs('id'));
		$proj_node_arr=$proj_node->findAll($condition);
		
		/** juetion add start**/
		$m_pg_proj_contri = spClass("m_pg_proj_contri");
		$proj_contri=$m_pg_proj_contri->find(array(proj_id=>$proj_id));
		$this->proj_contri=$proj_contri['contri_num']==null?0:$proj_contri['contri_num'];
		if ($proj_contri['p_proj_id']!=null||$proj_contri['p_proj_id']!=0) {
			$this->parent_proj=spClass("m_project")->find(array(proj_id=>$proj_contri['p_proj_id']),null,"proj_id,proj_name,proj_state");
		}
		$child_proj=$m_pg_proj_contri->findSql("select p.proj_id,p.proj_name,p.proj_state from project p,
								pg_proj_contri pc where p.proj_id = pc.proj_id and
								pc.p_proj_id=".$proj_id);
		$this->child_proj = $child_proj;
		//虚拟子项目
		$m_proj_vritual_child = spClass("m_proj_vritual_child");
		$this->vritual_proj = $m_proj_vritual_child->findSql("select pm.mtpl_id,pm.mtpl_name from pg_mtpl pm,
																proj_vritual_child pv where pm.mtpl_id = pv.mtpl_id
																and pv.proj_id =".$proj_id);
			
		/** juetion add end**/
		
		$this->rs=$project;
		$this->proj_node=$proj_node_arr;
		$this->proj_class=getProjClass();
		$this->state_list=getPnodState2();
		$this->proj_state_list=getProjState();
		$this->display('project/projectCheck.html');		
	}		

	//流程状态2更改
	function pnodState2()
	{
		pmAuth("manager");
		
		$pnod_id=$this->spArgs('pnod_id');
		$state=$this->spArgs('state');
		$node_c=spClass('m_proj_node_v');
		
		$node=$node_c->find('pnod_id='.$pnod_id);
		
		//取得流程所属项目id
		$proj_id=$node['proj_id'];
		
		//进行操设置操作
		if(true==$node_c->setState2($pnod_id,$state))
		{
			echo '1';
		}
		
		else
		{
			 echo 'error.';
		}
	}
	
	//节点修改
	function sectionEidtDo()
	{
		pmAuth("login");
		$user_name=pmUser("name");
		$user_id=pmUser("id","html");
		//dump($this->spArgs());die();
		$date=$this->spArgs("date");
		$time=$this->spArgs("time");
		$reason=$this->spArgs("reson");
		$type=$this->spArgs("type");
		$proj_id=$this->spArgs("proj_id");
		if($proj_id==""||!is_numeric($proj_id)) die('{"rs":"0","des":"parameter error:need proj_id."}');
		if($type=="") die('{"rs":"0","des":"parameter error:need type."}');
		$mProject=spClass("m_project");
		$mCondition=array("proj_id"=>$proj_id);
		$project=$mProject->find($mCondition);
		//dump($project);
		if($project["proj_state"]<20)  die('{"rs":"0","des":"this project state cant be modify."}');
		if($project["proj_state"]==20&&$reason=="") die('{"rs":"0","des":"请输入修改的原因。"}');
		$row=array();
		$row["proj_".$type]=$date." ".$time;
  		//dump($row);
		//dump($mCondition);
		$mProject->update($mCondition,$row);
		//dump($mProject->dumpSql());
		if($project["proj_state"]==20)
		{
			$msg_name="修改项目".($type=="start"?"开始":"上线")."时间";
			$msg_content="从".($type=="start"?$project['proj_start']:$project['proj_end'])." 改为 【 $date $time 】，原因是：".$reason;
			
			//创建信息通知
			$messageContext="$user_name ".$msg_name."，$msg_content";
			spClass("m_message")->init($messageContext,$proj_id)->toProject()->toManagers()->send();
			
			//创建操作事件
			spClass('m_event')->set(2,$msg_name,$msg_content,$proj_id,NULL,$user_id);
		}
		echo('{"rs":"1","des":"修改成功!"}');
	}	

	//生成项目meta信息
	function getMeta()
	{
		$proj_id=$this->spArgs('proj_id');
		if(!$proj_id) die('parameter error.');
		$porject=spClass('m_project')->find(array('proj_id'=>$proj_id));
		$nodes=spClass('m_proj_node')->findAll(array('proj_id'=>$proj_id));
		foreach($nodes as $node)
		{
			$users["u_".$node["user_id"]]=$node["user_id"];
		}
		$users["u_".$porject["user_id"]]=$porject["user_id"];
		$users=spClass("m_user")->getUserList($users,"array");
		echo "var metadata=".json_encode($users).";";
	}

}