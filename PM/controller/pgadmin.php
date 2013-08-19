<?php
class pgadmin extends spController
{
    function index()
    {

    }

    //职业列表
    function jobList()
    {
        $joblist = spClass("m_pg_jobs");
        $this->joblist = $joblist->spPager($this->spArgs('topage', 1), 50)->findAll();
        $this->pager = $joblist->spPager()->getPager();
        $this->isManager = true;
        $this->display('pg/admin/jobs.html');
    }

    //职业编辑
    function jobEdit()
    {
        // pmAuth("manager");
        $joblist = spClass("m_pg_jobs");
        $this->joblist = $joblist->find(array("job_id" => $this->spArgs('job_id')));
        $this->pager = $joblist->spPager()->getPager();
        $this->display('pg/admin/jobsEdit.html');
    }

    function jobEditDo()
    {
        // pmAuth("manager","html");
        $job_e = spClass("m_pg_jobs");
        // $prod_uidlist=$this->spArgs('user_id');
        // $userArray=explode("|",$prod_uidlist);
        // $prod_unamelist=spClass("m_user")->getUserList($userArray);
        $row = array(
            'job_name' => $this->spArgs('job_name'),
            'job_desc' => $this->spArgs('job_desc'),
        );
        $conn = array('job_id' => $this->spArgs('job_id'));
        $job_e->update($conn, $row);
        $this->jump(spUrl('pgadmin', 'joblist'));
    }

    //职业添加页
    function jobAdd()
    {
        //if(pmUser("power","html")!=0)
        //    $this->productType=getProductType();
        $this->display('pg/admin/jobsEdit.html');
    }

    //职业添加，执行
    function jobAddDo()
    {
        //pmUser("power");
        $job_e = spClass("m_pg_jobs");
        $row = array(
            'job_name' => $this->spArgs('job_name'),
            'job_desc' => $this->spArgs('job_desc')
        );
        $job_e->create($row);
        //$job_e->reflash();
        $this->jump(spUrl('pgadmin', 'joblist'));
    }

    //技能列表
    function skillList()
    {
    	$type = $this->spArgs("type",1);
        $skilllist = spClass("m_pg_skill");
        $defaultReuslt = $skilllist->spPager($this->spArgs('topage', 1), 20)->findAll(array(skill_type=>$type),null,"skill_id,skill_name");
        $this->pager = $skilllist->spPager()->getPager();
        $this->skilllist = $skilllist->spLinker()->run($defaultReuslt);
        $this->isManager = true;
        // $result=$skilllist->findAll();
        // dump($result);
        $this->type = $type;
        $this->display('pg/admin/skill.html');
    }

    function skillEdit()
    {
        // pmAuth("manager");
        $skilllist = spClass("m_pg_skill");
        $skilllv = spClass("m_pg_skill_lv");
        $skillDescArr = array();
        for ($i = 1; $i < 5; $i++) {
            $tempName = 'lv' . $i . 'desc';
            $tempTitle = 'lv' . $i . 'title';
            $temp = $skilllv->find(array(
                'skill_id' => $this->spArgs('skill_id'),
                'skill_lv' => $i
            ));
            $skillDescArr[$tempName] = $temp['skill_desc'];
            $skillDescArr[$tempTitle] = $temp['skill_title'];
        }
        $this->skilllist = $skilllist->find(array("skill_id" => $this->spArgs('skill_id')));
        $this->skilldesc = $skillDescArr;
        $this->display('pg/admin/skillEdit.html');
    }

    function skillEditDo()
    {
        // pmAuth("manager","html");

        $skilllist_e = spClass("m_pg_skill");
        $newrow = array(
            'skill_name' => $this->spArgs('skill_name'),
        	'skill_type' => $this->spArgs('skill_type'),
        	'skill_define' => $this->spArgs('skill_define'),
        	'skill_element' => $this->spArgs('skill_element')
        );
        $conn = array('skill_id' => $this->spArgs('skill_id'));
        $skilllist_e->update($conn, $newrow);

        $skilllist_lv_e = spClass("m_pg_skill_lv");
        for ($i = 1; $i < 5; $i++) {
            $row = array(
                'skill_lv' => $i,
                'skill_desc' => $this->spArgs('lv' . $i . '_desc'),
            	'skill_title' => $this->spArgs('lv' . $i . '_title')
            );
            $conn = array('skill_id' => $this->spArgs('skill_id'), 'skill_lv' => $i);
            $skilllist_lv_e->update($conn, $row);
        }

        $this->jump(spUrl('pgadmin', 'skilllist'));
    }

    function skillAdd()
    {
        //if(pmUser("power","html")!=0)
        $this->display('pg/admin/skillEdit.html');
    }

    function skillAddDo()
    {
        //pmUser("power");
        $skilllist_e = spClass("m_pg_skill");
        $newrow = array(
            'skill_name' => $this->spArgs('skill_name'), // 增加到主表的记录数据
            'skill_type' => $this->spArgs('skill_type'),
        	'skill_define' => $this->spArgs('skill_define'),
        	'skill_element' => $this->spArgs('skill_element'),
        
            'lv' => array( // 增加到对应表的记录数据
                array('skill_lv' => 1, 'skill_desc' => $this->spArgs('lv1_desc'), 'skill_title' => $this->spArgs('lv1_title')), // 对应第一条记录
                array('skill_lv' => 2, 'skill_desc' => $this->spArgs('lv2_desc'), 'skill_title' => $this->spArgs('lv2_title')), // 对应第二条记录
                array('skill_lv' => 3, 'skill_desc' => $this->spArgs('lv3_desc'), 'skill_title' => $this->spArgs('lv3_title')), // 对应第三条记录
                array('skill_lv' => 4, 'skill_desc' => $this->spArgs('lv4_desc'), 'skill_title' => $this->spArgs('lv4_title')),
            ),
        );
        $skilllist_e->spLinker()->create($newrow);
        $this->jump(spUrl('pgadmin', 'skilllist'));
    }


    //称谓
    function titleList()
    {
        $titlelist = spClass("m_pg_titles");
        $this->titlelist = $titlelist->spPager($this->spArgs('topage', 1), 50)->findAll();
        $this->pager = $titlelist->spPager()->getPager();
        $this->isManager = true;
        $this->display('pg/admin/titles.html');
    }

    function titleEdit()
    {
        // pmAuth("manager");
        $titlelist = spClass("m_pg_titles");
        $this->titlelist = $titlelist->find(array("title_id" => $this->spArgs('title_id')));
        $this->pager = $titlelist->spPager()->getPager();
        $this->display('pg/admin/titlesEdit.html');
    }

    function titleEditDo()
    {
        // pmAuth("manager","html");
        $job_e = spClass("m_pg_titles");
        $row = array(
            'title_name' => $this->spArgs('title_name'),
            'title_desc' => $this->spArgs('title_desc'),
        );
        $conn = array('title_id' => $this->spArgs('title_id'));
        $job_e->update($conn, $row);
        $this->jump(spUrl('pgadmin', 'titlelist'));
    }

    function titleAdd()
    {
        //if(pmUser("power","html")!=0)
        //    $this->productType=getProductType();
        $this->display('pg/admin/titlesEdit.html');
    }

    function titleAddDo()
    {
        //pmUser("power");
        $job_e = spClass("m_pg_titles");
        $row = array(
            'title_name' => $this->spArgs('title_name'),
            'title_desc' => $this->spArgs('title_desc')
        );
        $job_e->create($row);
        //$job_e->reflash();
        $this->jump(spUrl('pgadmin', 'titlelist'));
    }

    function titleDel()
    {
        $job_e = spClass("m_pg_titles");
        $conn = array('title_id' => $this->spArgs('tid'));
        if ($job_e->delete($conn)) {
            pmResult('200', '删除成功');
        } else {
            pmResult('400', '删除出错');
        }
    }

    //产出物配置
    function outcomeList()
    {
        $outcomelist = spClass("m_pg_outcome");
        $this->outcomelist = $outcomelist->spPager($this->spArgs('topage', 1), 50)->findAll();
        $this->pager = $outcomelist->spPager()->getPager();
        $this->isManager = true;
        $this->display('pg/admin/outcome.html');
    }

    function outcomeEdit()
    {
        // pmAuth("manager");
        $outcomelist = spClass("m_pg_outcome");
        $this->outcomelist = $outcomelist->find(array("outcome_id" => $this->spArgs('outcome_id')));
        $this->pager = $outcomelist->spPager()->getPager();
        $this->display('pg/admin/outcomeEdit.html');
    }

    function outcomeEditDo()
    {
        // pmAuth("manager","html");
        $outcome_e = spClass("m_pg_outcome");
        $row = array(
            'outcome_name' => $this->spArgs('outcome_name'),
            'outcome_desc' => $this->spArgs('outcome_desc'),
        );
        $conn = array('outcome_id' => $this->spArgs('outcome_id'));
        $outcome_e->update($conn, $row);
        $this->jump(spUrl('pgadmin', 'outcomelist'));
    }

    function outcomeAdd()
    {
        //if(pmUser("power","html")!=0)
        //    $this->productType=getProductType();
        $this->display('pg/admin/outcomeEdit.html');
    }

    function outcomeAddDo()
    {
        //pmUser("power");
        $outcome_e = spClass("m_pg_outcome");
        $row = array(
            'outcome_name' => $this->spArgs('outcome_name'),
            'outcome_desc' => $this->spArgs('outcome_desc')
        );
        $outcome_e->create($row);
        $this->jump(spUrl('pgadmin', 'outcomelist'));
    }

    function outcomeDel()
    {
        $outcome_e = spClass("m_pg_outcome");
        $conn = array('outcome_id' => $this->spArgs('oid'));
        if ($outcome_e->delete($conn)) {
            pmResult('200', '删除成功');
        } else {
            pmResult('400', '删除出错');
        }
    }


    //成就勋章
    function medalList()
    {
        $medallist = spClass("m_pg_medals");
        $this->medallist = $medallist->spPager($this->spArgs('topage', 1), 50)->findAll();
        $this->pager = $medallist->spPager()->getPager();
        $this->isManager = true;
        $this->display('pg/admin/medals.html');
    }

    function medalEdit()
    {
        // pmAuth("manager");
        $medallist = spClass("m_pg_medals");
        $this->medallist = $medallist->find(array("medal_id" => $this->spArgs('medal_id')));
        $this->pager = $medallist->spPager()->getPager();
        $this->display('pg/admin/medalsEdit.html');
    }

    function medalEditDo()
    {
        // pmAuth("manager","html");
        $medal_e = spClass("m_pg_medals");
        //判断是否更改过图片
        if ($this->spArgs('medalimg_changed') == 1) {
            import('extensions/nie-file.php');
            $nf = new nieFile();
            //删除原来的图
            $oldParams = $medal_e->find(array("medal_id" => $this->spArgs('medal_id')));
            $oldImgUri = $oldParams['medal_img'];
            $nf->delete($oldImgUri);

            //添加新的图
            $imgId = time() . rand(0, 1000);
            $imgRow = array('source' => $_FILES['medal_img']);
            $imgUri = $nf->upload($imgRow, '/themes/images/pg/medal/', 'medal_' . $imgId . '.jpg');
            $rowImgUpdate = array(
                'medal_img' => $imgUri
            );
            $connImg = array('medal_id' => $this->spArgs('medal_id'));
            $medal_e->update($connImg, $rowImgUpdate);
        }
        $row = array(
            'medal_name' => $this->spArgs('medal_name'),
            'medal_desc' => $this->spArgs('medal_desc'),
        	'medal_mission' => $this->spArgs('medal_mission')
        );
        $conn = array('medal_id' => $this->spArgs('medal_id'));
        $medal_e->update($conn, $row);
        $this->jump(spUrl('pgadmin', 'medallist'));
    }

    function medalAdd()
    {
        //if(pmUser("power","html")!=0)
        //    $this->productType=getProductType();
        $this->display('pg/admin/medalsEdit.html');
    }

    function medalAddDo()
    {
        import('extensions/nie-file.php');
        // pmAuth("manager","html");
        $medal_e = spClass("m_pg_medals");
        $nf = new nieFile();
        $imgId = time() . rand(0, 1000);
        $imgRow = array('source' => $_FILES['medal_img']);
        $imgUri = $nf->upload($imgRow, '/themes/images/pg/medal/', 'medal_' . $imgId . '.jpg');

        $row = array(
            'medal_name' => $this->spArgs('medal_name'),
            'medal_desc' => $this->spArgs('medal_desc'),
        	'medal_mission' => $this->spArgs('medal_mission'),
            'medal_img' => $imgUri
        );
        $medal_e->create($row);
        $this->jump(spUrl('pgadmin', 'medallist'));
    }

    function medalDel()
    {
        $medal_e = spClass("m_pg_medals");
        $conn = array('medal_id' => $this->spArgs('mid'));
        import('extensions/nie-file.php');
        $nf = new nieFile();
        //删除原来的图
        $oldParams = $medal_e->find(array("medal_id" => $this->spArgs('mid')));
        $oldImgUri = $oldParams['medal_img'];
        $nf->delete($oldImgUri);
        if ($medal_e->delete($conn)) {

            pmResult('200', '删除成功');
        } else {
            pmResult('400', '删除出错');
        }
    }


    //职业技能配置
    function jobsklllist()
    {
        $joblist = spClass("m_pg_jobs");
        $this->joblist = $joblist->spPager($this->spArgs('topage', 1), 50)->findAll();
        // $this->pager = $medallist->spPager()->getPager();
        $this->isManager = true;
        $this->display('pg/admin/skilltojob.html');
    }

    function skilltojob_ajax()
    {
        $link = spClass("m_pg_skill_to_job");
        $skill = spClass("m_pg_skill");
        $skillParams = $link->findAll(array("job_id" => $this->spArgs('job_id')));
        $resultArr = array();
        $resultNum = array();
        foreach ($skillParams as $row) {
            $skillName = $skill->find(array('skill_id' => $row["skill_id"]));
            array_push($resultArr, array(
                "skill_name" => $skillName["skill_name"],
                "skill_type" => $row["skill_type"],
                "skill_intro" => $row["skill_intro"],
                "skill_id" => $row["skill_id"]
            ));
            array_push($resultNum, $row["skill_id"]);
        }
        $skillAll = $skill->findAll();
        echo json_encode(array(
            "data" => $resultArr, //已配置的技能详细
            "skill" => $skillAll, //全部技能
            "skillItem" => $resultNum //已配置的技能简单
        ));
    }

    function skilltojob_ajax_post()
    {
        $skillToJob = spClass("m_pg_skill_to_job");
        $data = json_decode(stripslashes($this->spArgs('data')), true);
        $jobId = $this->spArgs('job_id');
        //先删除原有的关系
        $skillToJob->delete(array('job_id' => $jobId));
        //新增关系
        foreach ($data as $row) {
            $createRow = array(
                'job_id' => $jobId,
                'skill_id' => $row['skill_id'],
                'skill_type' => $row["skill_type"],
                'skill_intro' => $row['skill_intro']
            );
            $skillToJob->create($createRow);
        }
        pmResult('200', '修改成功');
    }

    function missionlist()
    {
        $mtplTb = spClass("m_pg_mtpl");
        $this->mtpllist = $mtplTb->spPager($this->spArgs('topage', 1), 50)->findAll();
        $this->isManager = true;
        $this->display('pg/admin/mission.html');
    }
    //任务模板增加
    function mtpladd()
    {
        $projLv = getProjLevel();
        $nodeCls = getNodesClass(1);
        $outcome = spClass('m_pg_outcome');
        $skill=spClass('m_pg_skill');
        $this->skill=$skill->findAll();
        $this->outcome = $outcome->findAll();
        $this->projlv = $projLv;
        $this->nodecls = $nodeCls;
        $this->defaultA = $projLv[1]['data'];
        $this->display('pg/admin/missionAdd.html');
    }

    function mtpladd_do()
    {
        $mtpl = spClass('m_pg_mtpl');
        $mtpl_flow_tb = spClass('m_pg_mtpl_flow');
        $mtplName = $this->spArgs('mtplName');
        $is_show = $this->spArgs('is_show');
        $mtplLv = $this->spArgs('mtplLv');
        $mtplProj1lv = $this->spArgs('mtplProj1lv');
        $mtplProj2lv = $this->spArgs('mtplProj2lv');
        $mtplGx = $this->spArgs('mtplGx');
        $mtplDesc = $this->spArgs('mtplDesc');
        $mtplFlow = $this->spArgs('mtplFlowArr');
        $mtplFlow = json_decode(stripslashes($mtplFlow), true);
        $createRow = array(
            'mtpl_name' => $mtplName,
            'mtpl_lv' => $mtplLv,
            'mtpl_proj1lv' => $mtplProj1lv,
            'mtpl_proj2lv' => $mtplProj2lv,
            'mtpl_gx' => $mtplGx,
            'mtpl_desc' => $mtplDesc,
        	'is_show'=>$is_show,
        );
        $newId = $mtpl->create($createRow);
        //插入流程
        if ($newId) {
            $isCreate = false;
            foreach ($mtplFlow as $item) {
                $newRow = array(
                	'flow_name' => $item['flow_name'],
                    'flow_type1' => $item['flow_type1'],
                    'flow_type2' => $item['flow_type2'],
                    'flow_time_s' => $item['flow_time_s'],
                    'flow_time_e' => $item['flow_time_e'],
                    'flow_mtpl_id' => $newId ,
                    'flow_outcome'=>$item['flow_outcome'],
                    'flow_skill1'=>$item['flow_skill1'],
                    'flow_skill2'=>$item['flow_skill2'],
                    'flow_skill3'=>$item['flow_skill3'],
                    'flow_skill1_exp'=>$item['flow_skill1_exp'],
                    'flow_skill2_exp'=>$item['flow_skill2_exp'],
                    'flow_skill3_exp'=>$item['flow_skill3_exp'],
                    'flow_skill1_lv'=>$item['flow_skill1_lv'],
                    'flow_skill2_lv'=>$item['flow_skill2_lv'],
                    'flow_skill3_lv'=>$item['flow_skill3_lv'],
                );
                if ($mtpl_flow_tb->create($newRow)) {
                    $isCreate = true;
                }
                ;
            }
            if ($isCreate) {
                echo json_encode(array(
                    'status' => 200,
                    'data' => '更新成功',
                ));
            } else {
                echo json_encode(array(
                    'status' => 403,
                    'data' => '更新失败' ,
                ));
            }
        } else {
            echo json_encode(array(
                'status' => 403,
                'data' => '更新失败'
            ));
        }
    }

    function mtpldel_do(){
        $mtpl_id=$this->spArgs('mtpl_id');
        $mtpl = spClass('m_pg_mtpl');
        $mtpl_flow_tb = spClass('m_pg_mtpl_flow');
        if($mtpl->delete(array('mtpl_id'=>$mtpl_id))){
            if($mtpl_flow_tb->delete(array('flow_mtpl_id'=>$mtpl_id))){
                echo json_encode(array(
                    'status'=>'200',
                    'data'=>'删除成功！'
                ));
            }
        }else {
            echo json_encode(array(
                'status' => 403,
                'data' => '更新失败'
            ));
        }
    }
    //二级下拉
    function mtpl_projlv_change()
    {
        $projLv = getProjLevel();
        $id = $this->spArgs('projlv1');
        echo json_encode(array(
                'status' => 200,
                'data' => $projLv[$id]['data']
            )
        );
    }
    //任务模板修改
    function mtpledit()
    {
        $outcome = spClass('m_pg_outcome');
        $skill=spClass('m_pg_skill');
        $mtplTb=spClass('m_pg_mtpl');
        $mtplId=$this->spArgs('mtplid');
        $mtplDetails=$mtplTb->spLinker()->find(array('mtpl_id'=>$mtplId));

        $projLv = getProjLevel();
        $nodeCls = getNodesClass(1);
        $this->mtplId=$mtplId;
        $this->mtplDetails=$mtplDetails;
        $this->json_mtpldtls=json_encode($mtplDetails);
        $this->skill=$skill->findAll();
        $this->outcome = $outcome->findAll();
        $this->projlv = $projLv;
        $this->nodecls = $nodeCls;
        $this->defaultA = $projLv[1]['data'];

        $this->display('pg/admin/missionEdit.html');
    }

    //更新任务模板
    function mtplupdate_do()
    {
        $mtpl = spClass('m_pg_mtpl');
        $mtpl_flow_tb = spClass('m_pg_mtpl_flow');
        $mtplId=$this->spArgs('mtplid');
        $mtplName = $this->spArgs('mtplName');
        $is_show = $this->spArgs('is_show');
        $mtplLv = $this->spArgs('mtplLv');
        $mtplProj1lv = $this->spArgs('mtplProj1lv');
        $mtplProj2lv = $this->spArgs('mtplProj2lv');
        $mtplGx = $this->spArgs('mtplGx');
        $mtplDesc = $this->spArgs('mtplDesc');
        $mtplFlow = $this->spArgs('mtplFlowArr');
        $mtplFlow = json_decode(stripslashes($mtplFlow), true);
        $updateRow = array(
            'mtpl_name' => $mtplName,
            'mtpl_lv' => $mtplLv,
            'mtpl_proj1lv' => $mtplProj1lv,
            'mtpl_proj2lv' => $mtplProj2lv,
            'mtpl_gx' => $mtplGx,
            'mtpl_desc' => $mtplDesc,
        	'is_show' => $is_show,
        );
        $newId = $mtpl->update(array('mtpl_id'=>$mtplId),$updateRow);
        //更新流程
        if ($newId) {
            $isCreate = false;
            if(!($mtpl_flow_tb->delete(array('flow_mtpl_id'=>$mtplId)))){
                return;
            }
            //删除所有流程关联
            spClass("m_pg_mtpl_flow_before")->delete(array('mtpl_id'=>$mtplId));
            
            foreach ($mtplFlow as $item) {
                $createRow = array(
                	'flow_name' => $item['flow_name'],
                    'flow_type1' => $item['flow_type1'],
                    'flow_type2' => $item['flow_type2'],
                    'flow_time_s' => $item['flow_time_s'],
                    'flow_time_e' => $item['flow_time_e'],
                    'flow_outcome'=>$item['flow_outcome'],
                    'flow_mtpl_id' => $mtplId ,
                    'flow_skill1'=>$item['flow_skill1'],
                    'flow_skill2'=>$item['flow_skill2'],
                    'flow_skill3'=>$item['flow_skill3'],
                    'flow_skill1_exp'=>$item['flow_skill1_exp'],
                    'flow_skill2_exp'=>$item['flow_skill2_exp'],
                    'flow_skill3_exp'=>$item['flow_skill3_exp'],
                    'flow_skill1_lv'=>$item['flow_skill1_lv'],
                    'flow_skill2_lv'=>$item['flow_skill2_lv'],
                    'flow_skill3_lv'=>$item['flow_skill3_lv'],
                );
                if ($mtpl_flow_tb->create($createRow)) {
                    $isCreate = true;
                }
            }
            if ($isCreate) {
                echo json_encode(array(
                    'status' => 200,
                    'data' => '更新成功'
                ));
            } else {
                echo json_encode(array(
                    'status' => 403,
                    'data' => '更新失败'
                ));
            }
        } else {
            echo json_encode(array(
                'status' => 403,
                'data' => '更新失败'
            ));
        }
    }

    //页面转向升职要求
    function toJobUpRequest()
    {
        $jobList = spClass('m_pg_jobs');
        $mtplTb = spClass("m_pg_mtpl");
        $this->jobList = $jobList->findAll();
        $this->mtpl = $mtplTb->findAll();
        $this->display('pg/admin/leaveUpRequest.html');
    }
    //升职要求列表
    function jobUpRequestList_ajax()
    {
        $parma = array (
            'job_id' => $this->spArgs('job_id'),
            'job_level' => $this->spArgs('job_level')
        );
        $m_pg_job_up_request = spClass('m_pg_job_up_request');
        $tasklist = $m_pg_job_up_request->spLinker ()->findAll ($parma);
        echo json_encode($tasklist);

    }
    //添加升职要求
    function addJobUpRequest_ajax()
    {
        $m_pg_job_up_request = spClass("m_pg_job_up_request");
        $row = array(
            'mtpl_id' => $this->spArgs('mtpl_id'),
            'num' => $this->spArgs('num'),
            'job_id' => $this->spArgs('job_id'),
            'job_level' => $this->spArgs('job_level')
        );
        $m_pg_job_up_request->create($row);

    }
    //删除升职要求
    function delJobUpRequest_ajax()
    {
        $m_pg_job_up_request = spClass("m_pg_job_up_request");
        $parma = array(task_id=>$this->spArgs("task_id"));
        if($m_pg_job_up_request->delete($parma)) {
            echo "200";  //删除成功
        }else {
            echo "500";  //删除失败
        }
    }


    //页面转向升职
    function toJobLeaveUp()
    {
//     	$jobList = spClass('m_pg_jobs');
//     	$mtplTb = spClass("m_pg_mtpl");
//     	$this->jobList = $jobList->findAll();
//     	$this->mtpl = $mtplTb->findAll();
        $oldPmUser = spClass('m_user');
        $this->userList = $oldPmUser->findSql("SELECT u.user_id,u.user_name from pg_user pu,user u where pu.user_id = u.user_id");
        $this->display('pg/admin/leaveUp.html');
    }
    //查找个人升职
    function jobLeaveUpSearch_ajax()
    {
    	$userId = $this->spArgs("user_id");
        $parma = array(user_id=>$userId);
        $m_pg_user = spClass("m_pg_user");
        $pp = $m_pg_user->find($parma,"","pg_user_jobid,job_lv_num");
        $m_pg_job_up_request = spClass("m_pg_job_up_request");
        $tasklist = $m_pg_job_up_request->spLinker ()->findAll (array(job_id=>$pp['pg_user_jobid'],job_level=>$pp['job_lv_num']));
        

        //个性任务的查找
        $sameTask = $m_pg_job_up_request->findSql("
    				select p.proj_id,p.proj_name,p.proj_endDate from project p,pg_proj_contri pc
					where p.proj_id = pc.proj_id and pc.is_special=1 and p.user_id = ".$userId);
        echo json_encode(array(special=>$tasklist,same=>$sameTask));
    }

    //获取模板--新建项目的时候使用
    function getMtpl_ajax() 
    {
    	$mtpl_id_array = explode("_",$this->spArgs("mtpl_id"));
    	$mtpl_id = $mtpl_id_array[1];
    	$parma = array(flow_mtpl_id=>$mtpl_id);
    	
    	$mtpl_flow=spClass('m_pg_mtpl_flow');
    	$mtpl_flow_result = $mtpl_flow->findAll($parma);
    	$resultArray = array();
    	foreach($mtpl_flow_result as $value)
    	{
    		$flow_type1 = $value['flow_type1'];
    		$flow_type2 = $value['flow_type2'];
    		$nodesClass = getNodesClass(1);
    		$type_array = $nodesClass[$flow_type1];
    		$flow_type1_name = $nodesClass[$flow_type1]['name'];
    		$flow_type2_name = $nodesClass[$flow_type1]['data'][$flow_type2];
    		$value['flow_type1_name'] = $flow_type1_name;
    		$value['flow_type2_name'] = $flow_type2_name;
    		$value['totle_day'] = $value['flow_time_e']-$value['flow_time_s']+1;
    		$value['flow_time_s'] = date('Y-m-d',time()+86400*$value['flow_time_s']);
    		$value['flow_time_e'] = date('Y-m-d',time()+86400*$value['flow_time_e']);
    		
    		array_push($resultArray, $value);
    	}
    	$gx = spClass("m_pg_mtpl")->find(array(mtpl_id=>$this->spArgs("mtpl_id")),null,"mtpl_gx");
    	echo json_encode(array(mtpl_flow=>$resultArray,mtpl_gx=>$gx["mtpl_gx"]));
    }
    
    
    //技能发放页面 同项目修改页面差不多
    function skillSend()
    {
    	$proj_id=$this->spArgs('id');
    	$proj_c=spClass('m_project_v');
    	$user=pmUser("all","html");
    	$pg_user=pmUser_pg("all","html");
    	$user_id=$user["id"];
    	$this->projClass=getProjClass();
    	
    	$m_pg_pron_skill = spClass("m_pg_pron_skill");//juetion 用户获取技能情况
    	$skill_user = array();//juetion添加，要给技能的人
    	
    	//检查该项目打开人是否负责人（管理员和导师除外）
    	if($user["power"]==0||$pg_user["p_user_id"]==-1)
    		$is_user=1;
    	else
    		$is_user=0;
    		
    	//管理员和导师可以进入
    	if($is_user!=1)
    	{
    		exit("你不是导师或管理员，不能配置技能！");
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
    			//juetion 找出所有参与者
    			$user_tmp = array(user_id=>$cNode["user_id"],user_name=>$cNode["user_name"]);
    			if (!in_array($user_tmp, $skill_user)) {
    				array_push($skill_user, $user_tmp);
    			}
    			//juetion 找出所有参与者
    		}
    		//juetion 获取每个人技能的配置情况 start
    		$_skill_user = array();//juetion添加，要给技能的人
    		foreach($skill_user as &$s_user)
    		{
    			$num = $m_pg_pron_skill->check_skill($s_user["user_id"],$proj_id);
    			$user_tmp = array(user_id=>$s_user["user_id"],user_name=>$s_user["user_name"],num=>$num);
    			array_push($_skill_user, $user_tmp);
    		}
    		$skill_user = $_skill_user;
    		//juetion 获取每个人技能的配置情况 end
    		//素材支持
    		$mMeterial=spClass('m_meterial');
    		$meterialArray=$mMeterial->findAll(array('proj_id'=>$proj_id));
    		$this->meterialJson=json_encode($meterialArray);
    			
    		/** juetion add start**/
    		$skill=spClass('m_pg_skill');
    		$this->skill=$skill->findAll();
    		$mtpl=spClass("m_pg_mtpl");
    		$this->mtpl=$mtpl->findAll(null,null,"mtpl_id,mtpl_name");
    		$proj_contri=spClass("m_pg_proj_contri")->find(array(proj_id=>$proj_id));
    		$this->proj_contri=$proj_contri['contri_num']==null?0:$proj_contri['contri_num'];
    		/** juetion add end**/
    			
    		//变量输出
    		$this->skill_user = $skill_user;
    		$this->rs=$project;
    		$this->user=$user;
    		//$this->proj_node=$cNodes;
    		$this->proj_node_json=json_encode($cNodes);
    		$this->proj_state_list=getProjState();
    		$this->pnod_state_list=getPnodState();
    		$this->proj_class=getProjClass();
    		$this->plist=spClass("m_product")->findAll();
    		$this->wraplist=spClass('m_wrap')->findAll(array("wrap_state"=>"2"));
    		$this->display('project/projectSkillSend.html');
    	}
    }
    
    //查看 发放或配置技能--项目
    function SkillSend_ajax()
    {
    	$user_id=$this->spArgs('user_id');
    	$proj_id=$this->spArgs('proj_id');
    	$m_pg_pron_skill = spClass("m_pg_pron_skill");
    	
    	$allSkill = $m_pg_pron_skill->findAll(array(user_id=>$user_id,proj_id=>$proj_id));
    	$this->allSkill = $allSkill;
    	$allSkill_enable = false;
    	$score_lv = 3;
    	if ($allSkill!=null&&$allSkill[0]['send_data']!=null) //已经评价 就不能编辑
    	{	
    		$allSkill_enable = true;
    		$score_lv = $allSkill[0]['score_lv'];
    	}
    	$this->score_lv = $score_lv;
    	$this->allSkill_enable = $allSkill_enable;
    	$this->proj_id = $proj_id;
    	$this->user_id = $user_id;
    	$user_name_array = spClass("m_user")->find(array(user_id=>$user_id),null,"user_name");
    	$this->user_name = $user_name_array["user_name"];
    	//选择的技能
    	$skill=spClass('m_pg_skill');
    	$skill_id_str = join(",", get_skills_show());
    	$this->skill=$skill->findSql("select ps.skill_id,ps.skill_name,ps.skill_type from pg_skill ps where ps.skill_id in (".$skill_id_str.") ORDER BY ps.skill_type");
    	$this->display('project/skillUserNode.html');
    }
    //配置技能--项目
    function skill_sure_ajax()
    {
    	$user_id=$this->spArgs('user_id');
    	$pg_user_id=pmUser_pg("pg_user_id", "html");
    	if ($user_id==null||$user_id==""||$user_id==0) {
    		echo json_encode(array(return_msg=>false,msg=>"请先配置流程的负责人。"));
	    	return ;
    	}
    	$sk1 = $this->spArgs('skill1');
    	$sk2 = $this->spArgs('skill2');
    	$sk3 = $this->spArgs('skill3');
    	if ($sk1==0&&$sk2==0||$sk1==0&&$sk3==0||$sk2==0&&$sk3==0) {
    		
    	}else 
    	if($sk1==$sk2||$sk1==$sk3||$sk2==$sk3) {
    		echo json_encode(array(return_msg=>false,msg=>"不能配置两个及以上相同的技能。"));
    		return ;
    	}
    	
    	if(pmUser("power")!=0){ //不是管理员就要判断是否为该学生的导师
	    	//导师判断
	    	$m_pg_user = spClass("m_pg_user");
	    	$student_s_p = $m_pg_user->findSql("
						select pu.p_user_id from pg_user pu where pu.user_id = ".$user_id."
	    			");
	    	if ($student_s_p[0]['p_user_id']!=pmUser("id")) {
	    		echo json_encode(array(return_msg=>false,msg=>"你不是该学生的导师，无权进行此操作。"));
	    		return ;
	    	}
	    	//导师判断
    	}
    	
    	//判断所拥有的技能数量是否足够
    	$skill_id_str = "";
    	for ($i=1;$i<4;$i++)
    	{
    		$skill_id = $this->spArgs('skill'.$i);
    		if($skill_id == 0)
    			continue;
    		$skill_id_str = $skill_id_str.$skill_id.",";
    	}
    	$skill_id_str=substr($skill_id_str,0,strlen($skill_id_str) - 1);
    	$skill_id = $this->spArgs('skill'.$i);
    	$m_pg_skill_had_use = spClass("m_pg_skill_had_use");
    	$m_pg_skill_num_give = spClass("m_pg_skill_num_give");
    	$myHadSkillNum = $m_pg_skill_num_give->findSql("SELECT * from pg_skill_num_give where 
    										pg_user_id = ".$pg_user_id." and skill_id in (".$skill_id_str.")");
    	if ($skill_id_str != "" && !$myHadSkillNum) {
    		echo json_encode(array(return_msg=>false,msg=>"技能数量不够。"));
    		return;
    	}
    	foreach ($myHadSkillNum as $rs) {
    		for ($i=1;$i<4;$i++)
    		{
	    		if ($rs['skill_id']==$this->spArgs('skill'.$i)) {
	    			$skill_lv = $this->spArgs('skill'.$i.'_lv');
	    			if($rs['lv'.$skill_lv.'_g']-$rs['lv'.$skill_lv.'_u']<=0) {
	    				echo json_encode(array(return_msg=>false,msg=>"没有足够的技能数量。",mm=>$rs['skill_id']."g".$rs['lv'.$skill_lv.'_g']."u".$rs['lv'.$skill_lv.'_u']));
	    				return;
	    			}else {
	    				$m_pg_skill_num_give->runSql("update pg_skill_num_give
	    												set lv".$skill_lv."_u = lv".$skill_lv."_u + 1 
	    						   						where skill_num_give_id = ".$rs['skill_num_give_id']);
	    				$for_student_use = $m_pg_skill_had_use->find(array(p_pg_user_id=>$pg_user_id,
	    						user_id=>$user_id,
	    						skill_id=>$rs['skill_id'],
	    						lv=>$skill_lv));
	    				if (!$for_student_use) { //为空就创建
	    					$m_pg_skill_had_use->create(array(p_pg_user_id=>$pg_user_id,
						    						user_id=>$user_id,
						    						skill_id=>$rs['skill_id'],
						    						lv=>$skill_lv,
						    						num=>1));
	    				}else { //不为空就更新
	    					$m_pg_skill_had_use->runSql("update pg_skill_had_use
	    												set num =num +1
	    												where use_id = ".$for_student_use['use_id']);
	    				}
	    				
	    			}
	    		}
    		}
    	}
    	
    	$proj_id=$this->spArgs('proj_id');
    	$m_pg_pron_skill = spClass("m_pg_pron_skill");
    	$success = true;
    	$m_pg_pron_skill->delete(array(proj_id=>$proj_id,user_id=>$user_id));
    	for ($i=1;$i<4;$i++)
    	{
    		$skill_id = $this->spArgs('skill'.$i);
    		$skill_lv = $this->spArgs('skill'.$i.'_lv');
    		if($skill_id == 0)
    			continue;
    		if(!$m_pg_pron_skill->create(array(proj_id=>$proj_id,user_id=>$user_id,skill_id=>$skill_id,skill_lv=>$skill_lv)))
    			$success = false;
    	}
    	if($success)
    	{
    		echo json_encode(array(return_msg=>$success,msg=>"配置成功。"));
    	}else 
    	{
    		echo json_encode(array(return_msg=>$success,msg=>"配置失败。"));
    	}
    	
    }
    
    function no_skill_sure_ajax()
    {
    	$user_id=$this->spArgs('user_id');
    		//导师判断
    		$m_pg_user = spClass("m_pg_user");
    		$student_s_p = $m_pg_user->findSql("
						select pu.p_user_id from pg_user pu where pu.user_id = ".$user_id."
	    			");
    		if ($student_s_p[0]['p_user_id']!=pmUser("id")) {
    			echo json_encode(array(return_msg=>false,msg=>"你不是该学生的导师，无权进行此操作。"));
    			return ;
    		}
    		//导师判断
    	$proj_id=$this->spArgs('proj_id');
    	$m_pg_pron_skill = spClass("m_pg_pron_skill");
    	$success = true;
    	$success = $m_pg_pron_skill->create(array(proj_id=>$proj_id,
    									user_id=>$user_id,
    									skill_id=>0,
    									skill_lv=>1,
    									actually_exp=>0,
    									send_data=>date("Y-m-d H:i:s",time()),
    									score_lv=>2));
    	if ($success) {
    		$success = true;
    	}else 
    		$success = false;
    	echo json_encode(array(return_msg=>$success,msg=>"操作失败。"));
    }
    //发放技能--评价--项目
    function skill_send_sure_ajax()
    {
    	$user_id=$this->spArgs('user_id');
    		//导师判断
    		$m_pg_user = spClass("m_pg_user");
    		$student_s_p = $m_pg_user->findSql("
						select pu.p_user_id from pg_user pu where pu.user_id = ".$user_id."
	    			");
    		if ($student_s_p[0]['p_user_id']!=pmUser("id")) {
    			echo json_encode(array(return_msg=>false,msg=>"你不是该学生的导师，无权进行此操作。"));
    			return ;
    		}
    		//导师判断
    	$proj_id=$this->spArgs('proj_id');
    	$score_lv=array(s1=>$this->spArgs('score_lv1'),s2=>$this->spArgs('score_lv2'),s3=>$this->spArgs('score_lv3'));

    	$m_pg_pron_skill = spClass("m_pg_pron_skill");
    	$m_pg_skill_to_user = spClass("m_pg_skill_to_user");
    	$m_pg_user = spClass("m_pg_user");
    	$user = $m_pg_user->find(array(user_id=>$user_id),null,"pg_user_id");
    	if(!$user)
    	{
    		echo json_encode(array(return_msg=>false,msg=>"该学生尚未初始化pg角色。请先初始化他的pg账号。"));
    		return ;
    	}
    	$pg_user_id = $user["pg_user_id"];
    	$result = $m_pg_pron_skill->findAll(array(proj_id=>$proj_id,user_id=>$user_id));
    	$success = true;
    	$i_num = 0;
    	foreach($result as $skills)
    	{
    		$i_num++;
    		$result2 = $m_pg_pron_skill->findSql("
    				select ps.skill_lv from pg_skill_to_user ps 
    				where ps.pg_userid = ".$pg_user_id." 
    				and ps.skill_id = ".$skills["skill_id"]); //查出现在等级
    		$actual_exp = 0;
    		if(!$result2)  //如果用户没有这个技能，则添加新技能给用户
    		{
    			$actual_exp = getSkillScore(1,$skills["skill_lv"],$score_lv['s'.$i_num]);
    			$m_pg_skill_to_user->create(array(skill_id=>$skills["skill_id"],pg_userid=>$pg_user_id,skill_lv=>1,skill_exp=>$actual_exp));
    			$success = $m_pg_pron_skill->update(array(pg_pn_skill_id=>$skills['pg_pn_skill_id']),
    									array(actually_exp=>$actual_exp,
    									send_data=>date("Y-m-d H:i:s",time()),
    											score_lv=>$score_lv['s'.$i_num]	));
    			
    		}else{
    			$actual_exp = getSkillScore($result2[0]["skill_lv"],$skills["skill_lv"],$score_lv['s'.$i_num]);
    			$m_pg_skill_to_user->runSql("
    					update pg_skill_to_user pu
						set pu.skill_exp = pu.skill_exp + ".$actual_exp."
						where pu.pg_userid = ".$pg_user_id." and
    					pu.skill_id = ".$skills["skill_id"]." and pu.skill_lv = ".$result2[0]['skill_lv']."
    					");
    			$success = $m_pg_pron_skill->update(array(pg_pn_skill_id=>$skills['pg_pn_skill_id']),
    									array(actually_exp=>$actual_exp,
    									send_data=>date("Y-m-d H:i:s",time()),
    											score_lv=>$score_lv['s'.$i_num]	));
    		}
    		if (!$success) {
    			break;
    		}else
    		{
    			$m_pg_pron_skill->runSql("
    						update pg_user pu
							set pu.pg_user_exp = pu.pg_user_exp +".$actual_exp." 
							where pu.pg_user_id = ".$pg_user_id);
    		}
    	}
    	if($success)
    	{
    		echo json_encode(array(return_msg=>$success,msg=>"评价成功。"));
    	}else 
    	{
    		echo json_encode(array(return_msg=>$success,msg=>"评价失败。"));
    	}
    }
    
    function specialtask()
    {
    	$m_project=spClass("m_project");
    	$this->result = $m_project->spPager($this->spArgs('topage', 1), 50)->findSql("
    				select p.proj_id,p.proj_name from project p,pg_proj_contri pc 
    				where p.proj_id = pc.proj_id and pc.is_special=1");
    	$this->pager = $m_project->spPager()->getPager();
    	$this->display('pg/admin/specialTask.html');
    }
    
    function skillNode()
    {
    	$id = $this->spArgs('id', 1);
    	$type = $this->spArgs('type', 1);
    	$this->type=$type;
    	if($type==0)//技能父节点
    	{
    		$skill = spClass("m_pg_skill");
    		$this->result = $skill->find(array(skill_id=>$id));
    	}
    	if($type==1)//技能子节点
    	{	
    		$skilllv = spClass("m_pg_skill_lv");
    		$array= $skilllv->findSql("
    				select ps.skill_name,pl.skill_lv,pl.skill_title,pl.skill_desc 
    				from pg_skill ps,pg_skill_lv pl where ps.skill_id = pl.skill_id 
    				and pl.skilllv_id=".$id);
    		 $this->result = $array[0];
    	}
    	$this->display('pg/admin/skillNode.html');
    }
    
    //综合任务模板
    function integratedtasks()
    {
    	$m_pg_integrated_tasks = spClass("m_pg_integrated_tasks");
    	$this->integratedlist = $m_pg_integrated_tasks->spPager($this->spArgs('topage', 1), 50)->findAll();
    	$this->pager = $m_pg_integrated_tasks->spPager()->getPager();
    	$this->isManager = true;
    	$this->display('pg/admin/integratedtasks.html');
    }
    
    //综合任务模板添加-页面
    function integrated_tasks_add() 
    {
    	$mtplTb = spClass("m_pg_mtpl");
    	$this->mtpl = $mtplTb->findAll(null,null,"mtpl_id,mtpl_name");
    	$this->display('pg/admin/integratedtasksAdd.html');
    }
    //综合任务模板添加
    function integrated_tasks_add_do()
    {
    	$select_child = $this->spArgs("select_child");
    	$integrated_name = $this->spArgs("integrated_name");
    	$select_parent = $this->spArgs("select_parent");
    	$integrated_desc = $this->spArgs("integrated_desc");
    	
    	$m_pg_integrated_tasks = spClass("m_pg_integrated_tasks");
    	$m_pg_integrated_child = spClass("m_pg_integrated_child");
    	$integrated_id = $m_pg_integrated_tasks->create(array(integrated_tasks_name=>$integrated_name,
    										mtpl_id=>$select_parent,
    										integrated_tasks_desc=>$integrated_desc
    									));
    	if ($integrated_id) {
	    	foreach ( $select_child as $value ) {
				$m_pg_integrated_child->create(array(integrated_tasks_id=>$integrated_id,
													mtpl_id=>$value));
			}
    	}else {
    		echo json_encode(array(
    				'status' => 403,
    				'data' => '添加失败'
    		));
    		return;
    	}
    	
    	echo json_encode(array(
    			'status'=>'200',
    			'data'=>'添加成功！'
    	));
    }
    //综合任务模板删除
    function integrated_tasks_del_do()
    {
    	$integrated_id = $this->spArgs("id");
    	$m_pg_integrated_tasks = spClass("m_pg_integrated_tasks");
    	$m_pg_integrated_child = spClass("m_pg_integrated_child");
    	$m_pg_integrated_child->delete(array(integrated_tasks_id=>$integrated_id));
    	$m_pg_integrated_tasks->delete(array(integrated_tasks_id=>$integrated_id));
    	echo json_encode(array(
    			'status'=>'200',
    			'data'=>'删除成功！'
    	));
    }
    
    //综合任务模板修改-页面
    function integrated_tasks_edit()
    {
    	$integrated_id = $this->spArgs("id");
    	$mtplTb = spClass("m_pg_mtpl");
    	$this->mtpl = $mtplTb->findAll(null,null,"mtpl_id,mtpl_name");
    	
    	$m_pg_integrated_tasks = spClass("m_pg_integrated_tasks");
    	$m_pg_integrated_child = spClass("m_pg_integrated_child");
    	$this->integrate=$m_pg_integrated_tasks->find(array(integrated_tasks_id=>$integrated_id));
    	$this->integratedChild=$m_pg_integrated_child->findAll(array(integrated_tasks_id=>$integrated_id),null,"integrated_child_id,mtpl_id");
    	$this->display('pg/admin/integratedtasksEdit.html');
    }
    
    //综合任务模板修改
    function integrated_tasks_edit_do()
    {
    	$select_child = $this->spArgs("select_child");
    	$integrated_name = $this->spArgs("integrated_name");
    	$select_parent = $this->spArgs("select_parent");
    	$integrated_desc = $this->spArgs("integrated_desc");
    	$integrated_id = $this->spArgs("integrated_id");
    	 
    	$m_pg_integrated_tasks = spClass("m_pg_integrated_tasks");
    	$m_pg_integrated_child = spClass("m_pg_integrated_child");
    	$update_result=$m_pg_integrated_tasks->update(
    			array(integrated_tasks_id=>$integrated_id),
    			array(integrated_tasks_name=>$integrated_name,
    			mtpl_id=>$select_parent,
    			integrated_tasks_desc=>$integrated_desc
    	));
    	if ($update_result) {
    		$m_pg_integrated_child->delete(array(integrated_tasks_id=>$integrated_id));
    		foreach ( $select_child as $value ) {
    			$m_pg_integrated_child->create(array(integrated_tasks_id=>$integrated_id,
    					mtpl_id=>$value));
    		}
    	}else {
    		echo json_encode(array(
    				'status' => 403,
    				'data' => '添加失败'
    		));
    		return;
    	}
    	 
    	echo json_encode(array(
    			'status'=>'200',
    			'data'=>'修改成功！'
    	));
    }
    
    function flow_before()
    {
    	$flow_id = $this->spArgs('flow_id');
    	$mtpl_id = $this->spArgs('mtpl_id');
    	$this->flow_id = $flow_id;
    	$this->flow_name = $this->spArgs('flow_name');
    	$this->mtpl_id = $mtpl_id;
    	$m_pg_mtpl_flow=spClass("m_pg_mtpl_flow");
    	$flowAll = $m_pg_mtpl_flow->findSql(" select pm.flow_id as id,pm.flow_name as name
									from pg_mtpl_flow pm where pm.flow_id!=".$flow_id."
									and pm.flow_mtpl_id =".$mtpl_id);
    	$this->flowAll = $flowAll;
    	$m_pg_mtpl_flow_before = spClass("m_pg_mtpl_flow_before");
    	$selectNode_result = $m_pg_mtpl_flow_before->findAll(array(flow_id=>$flow_id),null,"p_flow_id");
    	$selectNode = array();
    	foreach ($selectNode_result as $value)
    	{
    		array_push($selectNode, $value['p_flow_id']);
    	}
    	$this->selectNode = $selectNode;
    	$this->display('pg/admin/missionFlowBefore.html');
    }
    function flow_before_do()
    {
    	$flow_id = $this->spArgs('flow_id');
    	$mtpl_id = $this->spArgs('mtpl_id');
    	$select_data = $this->spArgs('select_data');
    	$m_pg_mtpl_flow_before = spClass("m_pg_mtpl_flow_before");
    	$m_pg_mtpl_flow_before->delete(array(flow_id=>$flow_id));
    	foreach ( $select_data as $value ) {
    		$m_pg_mtpl_flow_before->create(array(flow_id=>$flow_id,mtpl_id=>$mtpl_id,p_flow_id=>$value));
    	}
    	echo json_encode(array(return_msg=>true,msg=>"选择失败。"));
    }
    
    function skillnumgive()
    {
    	$m_pg_skill = spClass("m_pg_skill");
    	$skill_id_str = join(",", get_skills_show());
    	$allSkill = $m_pg_skill->findSql("select ps.skill_id,ps.skill_name,ps.skill_type from pg_skill ps where ps.skill_id in (".$skill_id_str.") ORDER BY ps.skill_type");
    	$this->all_kills = $allSkill;
    	$all_teacher = $m_pg_skill->findSql("select pu.pg_user_id,u.user_name from 
    										user u,pg_user pu where u.user_id = pu.user_id 
    										and pu.p_user_id = -1");
    	$this->all_teacher = $all_teacher;
    	$this->skill_type = getSkillType();
    	$this->display('pg/admin/skillnumgive.html');
    }
    
    function skillnumgive_ajax()
    {
    	$teacher_id = $this->spArgs('teacher_id');
    	$new_data = $this->spArgs('new_data');
    	$m_pg_skill_num_give = spClass("m_pg_skill_num_give");
    	foreach ($new_data as &$row) {
    		if ($row['skill_num_id']==0) {  //添加
    			$row['pg_user_id']=$teacher_id;
    			$m_pg_skill_num_give->create($row);
    		}else {  //修改
    			if ($row['delete'] == 1) {
    				$m_pg_skill_num_give->delete(array(skill_num_give_id=>$row['skill_num_id'],pg_user_id=>$teacher_id));
    			}else {	
    				$row['pg_user_id']=$teacher_id;
    				$m_pg_skill_num_give->update(array(skill_num_give_id=>$row['skill_num_id']),$row);
    			}
    		}
    	}
    	if ($this->spArgs('use_suggest',0)) {
    		$m_pg_record_old_student = spClass("m_pg_record_old_student");
    		$m_pg_record_old_student->delete(array(teacher_id=>$teacher_id));
    		$result = $m_pg_record_old_student->findSql("select pu.pg_user_id from pg_user pu where pu.p_user_id in 
    											(select p.user_id from pg_user p where p.pg_user_id = ".$teacher_id.") 
    											and pu.job_lv_num = 2");//只记录实习生
    		foreach ($result as $row) {
    			$m_pg_record_old_student->create(array(teacher_id=>$teacher_id,student_id=>$row['pg_user_id']));
    		}
    	}
    	
//     	$m_pg_skill_num_give->runSql("update pg_user
//     									set record_num = ".$this->spArgs('record_num',0)." where pg_user_id=".$teacher_id);
    	echo json_encode(array(return_msg=>true,msg=>"更新失败。"));
    }
    
    function get_skillnumgive_ajax()
    {
    	$teacher_id = $this->spArgs('teacher_id');
    	$m_pg_skill_num_give = spClass("m_pg_skill_num_give");
    	$skills = $m_pg_skill_num_give->findAll(array(pg_user_id=>$teacher_id));
    	$students = $m_pg_skill_num_give->findSql("select pu.job_lv_num,COUNT(pu.pg_user_id) as count from pg_user pu 
    									where pu.p_user_id in (select u.user_id from pg_user u where u.pg_user_id =".$teacher_id.") GROUP BY pu.job_lv_num");
    	//$record_num = $m_pg_skill_num_give->findSql("select pu.record_num from pg_user pu where pu.pg_user_id =".$teacher_id);
    	$add_num = $m_pg_skill_num_give->findSql("select count(pu.pg_user_id) as num from pg_user pu where pu.p_user_id in 
    											 (select p.user_id from pg_user p where p.pg_user_id = ".$teacher_id.")  and pu.job_lv_num = 2 
    											and pu.pg_user_id not IN (select pr.student_id from pg_record_old_student pr 
    											where pr.teacher_id = ".$teacher_id.")");//job_lv_num试用的学生
    	 
    	
    	echo json_encode(array(skills=>$skills,students=>$students,add_num=>$add_num));
    }
    
    function get_oneSkillNum_ajax()
    {
    	$user_id = $this->spArgs('user_id');
    	$skill_id = $this->spArgs('skill_id');
    	$skill_lv = $this->spArgs('skill_lv');
    	$p_pg_user_id=pmUser_pg("pg_user_id", "html");
    	$m_pg_skill_had_use = spClass("m_pg_skill_had_use");
    	$haduse = $m_pg_skill_had_use->find(array(p_pg_user_id=>$p_pg_user_id,
									    			user_id=>$user_id,
									    			skill_id=>$skill_id,
									    			lv=>$skill_lv),
    										null,"num");
    	if ($haduse) {
    		$haduse = $haduse['num'];
    	}else 
    		$haduse=0;
    	
    	$m_pg_skill_num_give = spClass("m_pg_skill_num_give");
    	$had = $m_pg_skill_num_give->find(array(pg_user_id=>$p_pg_user_id,skill_id=>$skill_id),
    								null,
    								"lv".$skill_lv."_u,lv".$skill_lv."_g");
    	if (!$had) {
    		$had["lv".$skill_lv."_u"]=0;
    		$had["lv".$skill_lv."_g"]=0;
    	}
    	echo json_encode(array(hadUseIn=>$haduse,hadAndUse=>$had,which=>$this->spArgs('which'),skill_lv=>$skill_lv));
    }
    
    function medalNode ()
    {
    	$medal_id = $this->spArgs('id');
    	$this->title=$this->spArgs('title');
    	$m_pg_medal = spClass("m_pg_medals");
    	$user = $m_pg_medal->findSql("select u.user_name from user u where u.user_id in 
    						(select pu.user_id from pg_medal_to_user pm LEFT JOIN 
    						pg_user pu ON pm.pg_userid = pu.pg_user_id where pm.medal_id = ".$medal_id.")");
    	$this->users = $user;
    	$this->display('pg/admin/medalNode.html');
    }
    

}
