<?php
class pguser extends spController
{
    function welcomeInit()
    {
        $this->isInit = true;
        $user = pmUser("all", "html");
        $user_id = $user["id"];
        $this->user_name = $user["name"]; //用户真名
        $pg_user_id = pmUser_pg("pg_user_id");
        $m_user = spClass("m_user");
        $pguser_tb = spClass("m_pg_user");
        $is_first = $pguser_tb->find(array('user_id' => $user_id));
        $is_first = $is_first['is_first'];
        if ($is_first == 1) {
            $this->jump(spUrl('pguser', 'mygrowrecord'));

        } else {
            //更新是否第一次登录字段
            $pguser_tb->update(array('user_id' => $user_id), array('is_first' => 1));
            $baseInfor = $m_user->findSql("select u.user_id,u.user_nickname,u.user_name,
				pu.pg_user_exp,pu.pg_user_gongxian,pj.job_name,pu.job_lv_num
				from user u,pg_user pu,pg_jobs pj where u.user_id = pu.user_id and
				pu.pg_user_jobid = pj.job_id and u.user_id = " . $user_id);
            $this->user_nickname = $baseInfor[0]['user_nickname']; //昵称
            $this->job_name = $baseInfor[0]['job_name']; //职业
            $this->exp = $baseInfor[0]['pg_user_exp']; //经验值
            $this->gongxian = $baseInfor[0]['pg_user_gongxian']; //贡献值
            $this->job_lv = $baseInfor[0]['job_lv_num']; //职业等级
            $m_pg_title_to_user = spClass("m_pg_title_to_user");
            $result = $m_pg_title_to_user->findSql("select a.title_name from pg_title a,
				pg_title_to_user b where a.title_id = b.title_id
				and b.pg_userid = " . $pg_user_id);
            //谓称集合
            $this->titleArr = $result;
            $this->display('pg/user/myWelcome.html');
        }
    }

    function  welcomeNotInit()
    {
    	$user = pmUser("all", "html");
        $this->isInit = false;
        $this->display('pg/user/myWelcome.html');
    }


    // 技能及战力-天赋  --我已经获得的技能
    function mySkillGift()
    {
        $parma = array(
            'pg_userid' => pmUser_pg("pg_user_id", "html")
        );
        $job_id = pmUser_pg("pg_job_id", "html");
        $m_pg_skill_to_user = spClass("m_pg_skill_to_user");
        $m_pg_skill_lv = spClass("m_pg_skill_lv");
        $m_pg_skill_to_job = spClass("m_pg_skill_to_job");
        $myskilllist = $m_pg_skill_to_user->spLinker()->spPager($this->spArgs('topage', 1), 50)->findAll($parma);
        $this->pager = $m_pg_skill_to_user->spPager()->getPager();

        $resultArray = array();
        foreach ($myskilllist as $value) {
            $parma = array(
                'skill_id' => $value ['skill_id'],
                'skill_lv' => $value ['skill_lv']
            );
            $skill_lv = $m_pg_skill_lv->find($parma);
            $parma = array(
                'job_id' => $job_id,
                'skill_id' => $value ['skill_id']
            );
            $skill_intro = $m_pg_skill_to_job->find($parma);
// 			$skill_exp = $m_pg_skill_to_job->findSql("
// 					select SUM(ps.actually_exp) as exp from
// 					pg_pron_skill ps where ps.user_id =  ".pmUser("id","html") ."
// 					and ps.skill_id = ".$value ['skill_id']);
            $ary = array(
                'skill_id' => $value ['skill_id'],
                //技能名
                'skill_name' => $value ['skillname'] ['skill_name'],
                //性质
                'skill_intro' => $skill_intro ['skill_intro'],
                //技能描述及掉落说明
                'skill_title' => $skill_lv ['skill_title'],
                //技能点
//                     'skill_exp' => $skill_exp[0] ['exp']==null?0:$skill_exp[0] ['exp'] ,
                'skill_exp' => $value ['skill_exp'],
                //当前等级
                'skill_lv' => $value ['skill_lv'],
            );
            array_push($resultArray, $ary);
        }
        $this->resultArray = $resultArray;

        $m_pg_jobs = spClass("m_pg_jobs");
        $job_name = $m_pg_jobs->find(array(job_id => $job_id), "", "job_name");
        $this->job_name = $job_name[job_name]; //职业
        $this->p_user_id = pmUser_pg("p_user_id", "html"); //导师id
        $this->display('pg/user/mySkillGift.html');
    }

    // 技能及战力-基本   --职业需要的技能
    function mySkillBase()
    {
        $m_pg_skill_to_job = spClass("m_pg_skill_to_job");
        $job_id = pmUser_pg("pg_job_id", "html");
        $skill = spClass("m_pg_skill");
        $skillParams = $m_pg_skill_to_job->spPager($this->spArgs('topage', 1), 50)->findAll(array("job_id" => $job_id));
        $this->pager = $m_pg_skill_to_job->spPager()->getPager();
        $resultArray = array();
        foreach ($skillParams as $row) {
            $skillName = $skill->find(array('skill_id' => $row["skill_id"]));
            array_push($resultArray, array(
                "skill_name" => $skillName["skill_name"],
                "skill_intro" => $row["skill_intro"],
            ));
        }
        $this->resultArray = $resultArray;

        $m_pg_jobs = spClass("m_pg_jobs");
        $job_name = $m_pg_jobs->find(array(job_id => $job_id), "", "job_name");
        $this->job_name = $job_name[job_name]; //职业
        $this->p_user_id = pmUser_pg("p_user_id", "html"); //导师id
        $this->display('pg/user/mySkillBase.html');
    }

    // 我的成就奖勋
    function myMedal()
    {
        $medallist = spClass("m_pg_medals");
        $m_pg_medal_to_user = spClass("m_pg_medal_to_user");
        $medallist_ = $medallist->spPager($this->spArgs('topage', 1), 50)->findAll();
        $this->pager = $medallist->spPager()->getPager();
        $resultArray = array();

        $this->allMedalNum = 0;
        $this->myMedalNum = 0;
        foreach ($medallist_ as $value) {
            $parma = array(
                'pg_userid' => pmUser_pg("pg_user_id", "html"),
                'medal_id' => $value['medal_id']
            );
            $myMedal = $m_pg_medal_to_user->find($parma);
            if (null != $myMedal) {
                $value = array_merge_recursive($value, array('get_time' => $myMedal['get_time']));
                $this->myMedalNum++;
            } else {
                $value = array_merge_recursive($value, array('get_time' => null));
            }
            $this->allMedalNum++;
            array_push($resultArray, $value);
        }
        $this->resultArray = $resultArray;
        $this->p_user_id = pmUser_pg("p_user_id", "html"); //导师id
        $this->display('pg/user/myMedal.html');
    }

    // 系统通知
    function myMessage()
    {
        $m_pg_message = spClass("m_pg_message");
        $this->messagelist = $m_pg_message->spPager($this->spArgs('topage', 1), 50)->findAll(array('pg_user_id' => pmUser_pg("pg_user_id", "html")), "create_date desc", "message_id,message_title,create_date,had_read");
        $this->pager = $m_pg_message->spPager()->getPager();
        $this->p_user_id = pmUser_pg("p_user_id", "html"); //导师id
        $this->display('pg/user/myMessage.html');
    }

    function messageNode()
    {
        $message_id = $this->spArgs('id');
        $m_pg_message = spClass("m_pg_message");
        $m_pg_message->update(array('message_id' => $message_id), array('had_read' => 1));
        $this->message = $m_pg_message->find(array('message_id' => $message_id));
        $this->display('pg/user/myMessageNode.html');
    }

    function delMessage_ajax()
    {
        $m_pg_message = spClass("m_pg_message");
        $result = $m_pg_message->delete(array('message_id' => $this->spArgs("message_id")));
        if ($result) {
            echo "200";
        } else {
            echo "500";
        }
    }

    function myGrowRecord()
    {

        $user = pmUser("all", "html");
        $user_id = $user["id"];

        $m_pg_user = spClass("m_pg_user");
        //如果已经初始化PG帐号则飞！
        if ($m_pg_user->checkInit($user_id)) {


            $parma = array(
                'pg_user_id' => pmUser_pg("pg_user_id", "html"),
            );
            $job_and_lv = $m_pg_user->spLinker()->find($parma, "", "pg_user_jobid,job_lv_num");
            $m_pg_jobs = spClass("m_pg_jobs");
            $job_name = $m_pg_jobs->find(array(job_id => $job_and_lv['pg_user_jobid']), "", "job_name");
            //---------职业，等级....
            $this->job_name = $job_name[job_name]; //职业
            switch ($job_and_lv[job_lv_num]) //职业等级以及职业下一级等级
            {
                case 1:
                    $this->job_lv="实习";
                    $this->job_lv_next="试用";
                    break;
                case 2:
                    $this->job_lv = "试用";
                    $this->job_lv_next = "初级";
                    break;
                case 3:
                    $this->job_lv = "初级";
                    $this->job_lv_next = "中级";
                    break;
                case 4:
                    $this->job_lv = "中级";
                    $this->job_lv_next = "高级";
                    break;
                case 5:
                    $this->job_lv = "高级";
                    break;
            }
            //--------等级要求
            $m_pg_job_up_request = spClass("m_pg_job_up_request");
            $result = $m_pg_job_up_request->findSql("select a.mtpl_proj1lv,SUM(b.num) as
                    sum from pg_mtpl a,pg_job_up_request b where a.mtpl_id = b.mtpl_id and
                    b.job_id = " . $job_and_lv['pg_user_jobid'] . " and b.job_level = " . $job_and_lv[job_lv_num] .
                " GROUP BY a.mtpl_proj1lv ORDER BY a.mtpl_proj1lv");
            $lv_array = array();
            $lv_array['lv_1'] = 0;
            $lv_array['lv_2'] = 0;
            $lv_array['lv_3'] = 0;
            $lv_array['lv_4'] = 0;
            $lv_array['lv_5'] = 0;
            $lv_array['lv_10'] = 0;
            foreach ($result as $value) {
                $key = "lv_" . $value['mtpl_proj1lv'];
                $lv_array[$key] = $value['sum'];
            }
            $this->lv_array = $lv_array; //升级要求数据
            //--------已经完成的数据统计
            $m_project_v = spClass('m_project_v');
            $sql = "select a.proj_level1,count(distinct a.proj_id) as sum
                    from project_v a,proj_node_v b where b.proj_id=a.proj_id
                    and b.user_id = " . $user_id . " and a.proj_state<20" .
                " GROUP BY a.proj_level1 ORDER BY a.proj_level1";
            $result = $m_project_v->findSql($sql);
            $flv_array = array();
            $flv_array['flv_'] = 0; //历史记录
            $flv_array['flv_0'] = 0; //历史记录
            $flv_array['flv_1'] = 0;
            $flv_array['flv_2'] = 0;
            $flv_array['flv_3'] = 0;
            $flv_array['flv_4'] = 0;
            $flv_array['flv_5'] = 0;
            $flv_array['flv_10'] = 0;
            foreach ($result as $value) {
                $key = "flv_" . $value['proj_level1'];
                $flv_array[$key] = $value['sum'];
            }
            array_shift($flv_array);
            array_shift($flv_array);
            $this->flv_array = $flv_array;
            //--------比值计算---
            $blv_array = array();
            $blv_array['blv_1'] = $this->calculateScale($flv_array['flv_1'], $lv_array['lv_1']);
            $blv_array['blv_2'] = $this->calculateScale($flv_array['flv_2'], $lv_array['lv_2']);
            $blv_array['blv_3'] = $this->calculateScale($flv_array['flv_3'], $lv_array['lv_3']);
            $blv_array['blv_4'] = $this->calculateScale($flv_array['flv_4'], $lv_array['lv_4']);
            $blv_array['blv_5'] = $this->calculateScale($flv_array['flv_5'], $lv_array['lv_5']);
            $blv_array['blv_10'] = $this->calculateScale($flv_array['flv_10'], $lv_array['lv_10']);
            $this->blv_array = $blv_array;
            //--------数据统计---
            $this->edate = date('Y-m-d', time());
            $this->bdate = date('Y-m-d', time() - 15552000);

            //--------成长记录--- (时间紧迫先采用hack写死的方法)
            $recordSql = "
            		select c.*,d.contri_num from (select distinct a.proj_id ,case a.proj_level1  
					when '1' then 'A' when '2' then'B' 
					when '3' then 'C' when '4' then 'D' 
					when '5' then 'E' else '无等级' end as proj_lv,
					a.prod_name,a.proj_name,a.proj_endDate
					from project_v a,proj_node_v b where b.proj_id=a.proj_id
					and b.user_id = " . $user_id . " and a.proj_state<20 and a.proj_endDate) c 
					LEFT JOIN pg_proj_contri d  on c.proj_id = d.proj_id 
					ORDER BY c.proj_endDate	desc limit 0,10
            		";
            $result = $m_project_v->findSql($recordSql);
            $recordResult = array();
            foreach ($result as $rs) {
                $sql = "
		            	select pk.skill_name,ps.actually_exp from pg_pron_skill ps,
		            	pg_skill pk where ps.proj_id = " . $rs['proj_id'] . " and
		            	ps.user_id = " . $user_id . "	and ps.skill_id = pk.skill_id
            			";
                $rs['skill'] = $m_project_v->findSql($sql);
                $sql = "
            			select (TO_DAYS(pn.pnod_time_r)-TO_DAYS(pn.pnod_time_e)) 
 						AS delay from proj_node pn where pn.proj_id = " . $rs['proj_id'] . "
            			and pn.user_id = " . $user_id;
                $delayData = $m_project_v->findSql($sql);
                $delay = 0;
                foreach ($delayData as $dd) {
                    if ($dd['delay'] > 0) {
                        $delay += $dd['delay'];
                    }
                }
                $rs['delay'] = floor($delay / count($delayData) * 100) / 100;
                array_push($recordResult, $rs);
            }
            $this->myProjRecord = $recordResult;
            // echo json_encode($recordResult);
            $this->p_user_id = pmUser_pg("p_user_id", "html"); //导师id
            $this->display('pg/user/myGrowRecord.html');


        } else {
            //未初始化就不能飞！
            $this->jump(spUrl('pguser', 'welcomeNotInit'));
        }
    }

    //我的记录 -- 查看更多
    function myRecord_axjx()
    {
        $p_num = $this->spArgs("p_num");
        $m_project_v = spClass('m_project_v');
        $user = pmUser("all", "html");
        $user_id = $user["id"];
        $recordSql = "
            		select c.*,d.contri_num from (select distinct a.proj_id ,case a.proj_level1
					when '1' then 'A' when '2' then'B'
					when '3' then 'C' when '4' then 'D'
					when '5' then 'E' else '无等级' end as proj_lv,
					a.prod_name,a.proj_name,a.proj_endDate
					from project_v a,proj_node_v b where b.proj_id=a.proj_id
					and b.user_id = " . $user_id . " and a.proj_state<20 and a.proj_endDate) c
					LEFT JOIN pg_proj_contri d  on c.proj_id = d.proj_id
					ORDER BY c.proj_endDate	desc limit " . $p_num . ",10
            		";
        $result = $m_project_v->findSql($recordSql);
        $recordResult = array();
        foreach ($result as $rs) {
            $sql = "
            			select pk.skill_name,ps.actually_exp from pg_pron_skill ps,
            			pg_skill pk where ps.proj_id = " . $rs['proj_id'] . " and
            			ps.user_id = " . $user_id . " 	and ps.skill_id = pk.skill_id
            			";
            $rs['skill'] = $m_project_v->findSql($sql);
            $sql = "
            			select (TO_DAYS(pn.pnod_time_r)-TO_DAYS(pn.pnod_time_e))
 						AS delay from proj_node pn where pn.proj_id = " . $rs['proj_id'] . "
            			and pn.user_id = " . $user_id;
            $delayData = $m_project_v->findSql($sql);
            $delay = 0;
            foreach ($delayData as $dd) {
                if ($dd['delay'] > 0) {
                    $delay += $dd['delay'];
                }
            }
            $rs['delay'] = floor($delay / count($delayData) * 100) / 100;
            array_push($recordResult, $rs);
        }
        echo json_encode($recordResult);
    }

    //我的记录--图表
    function myRecordChart_axjx()
    {
        $user = pmUser("all", "html");
        $user_id = $user["id"];
        $today = date('Ymd', time());
        $finishProject = array();
        $finishProjectNode = array();
        $contribute = array();
        $experience = array();
        for ($i = 14; $i > -1; $i--) {
            $today = date('Y-m-d', time() - 86400 * $i);
            $finishProject[$today] = 0;
            $finishProjectNode[$today] = 0;
            $contribute[$today] = 0;
            $experience[$today] = 0;
        }

        $m_project = spClass("m_project");
        //完成的项目数 start
        $result = $m_project->findSql("select  DATE_FORMAT(p.proj_endDate,'%Y-%m-%d') days,
							count(p.proj_id) count from project p where 
							p.proj_id in (SELECT pn.proj_id from proj_node pn where 
							pn.user_id = " . $user_id . " )  and
							TIMESTAMPDIFF(day,p.proj_endDate,now())<=15 group by days;");
        foreach ($result as $rs) {
            $finishProject[$rs['days']] = (int)$rs['count'];
        }
        //完成的项目数 end

        //完成的流程数 start
        $result = $m_project->findSql("
					select  DATE_FORMAT(p.pnod_time_r,'%Y-%m-%d') days,
					count(p.pnod_id) count from proj_node p where 
					p.user_id =" . $user_id . "  and TIMESTAMPDIFF(day,p.pnod_time_r,now())<=15
					group by days");
        foreach ($result as $rs) {
            $finishProjectNode[$rs['days']] = (int)$rs['count'];
        }
        //完成的流程数 end

        //贡献值start
        $result = $m_project->findSql("
					select  DATE_FORMAT(p.proj_endDate,'%Y-%m-%d') days,
					SUM(pc.contri_num) sum from project p left JOIN 
					pg_proj_contri pc on p.proj_id = pc.proj_id where 
					p.proj_id in (SELECT pn.proj_id from proj_node pn where 	
					pn.user_id = " . $user_id . " )  and TIMESTAMPDIFF(day,p.proj_endDate,now())<=15
					group by days
					");
        foreach ($result as $rs) {
            $contribute[$rs['days']] = (int)$rs['sum'];
        }
        ksort($contribute);
        //贡献值end

        //经验值 start
        $result = $m_project->findSql("
					select  DATE_FORMAT(ps.send_data,'%Y-%m-%d') days,
					SUM(ps.actually_exp) sum from pg_pron_skill ps where 
					ps.user_id = " . $user_id . "   and TIMESTAMPDIFF(day,ps.send_data,now())<=15
					group by days
					");
        foreach ($result as $rs) {
            $experience[$rs['days']] = (int)$rs['sum'];
        }
        ksort($experience);
        //经验值 end
        echo json_encode(array(
            finishProject => $finishProject,
            finishProjectNode => $finishProjectNode,
            contribute => $contribute,
            experience => $experience
        ));
    }

    function getFinishProject_chart_axaj()
    {
        $user = pmUser("all", "html");
        $user_id = $user["id"];
        $date = $this->spArgs("date");
        $array = explode("-", $date);
        $year = $array[0];
        $month = $array[1];
        $day = $array[2];
        $date = mktime(0, 0, 0, $month, $day, $year);

        $type = $this->spArgs("type");
        $finishProject = array();
        if ($type == 1) //向前15天
        {
            for ($i = 22; $i > 7; $i--) {
                $today = date('Y-m-d', $date - 86400 * $i);
                $finishProject[$today] = 0;
            }
            $date = date('Y-m-d H:i:s', $date - 86400 * 15);
        } else //向后15天
        {
            for ($i = 8; $i < 23; $i++) {
                $today = date('Y-m-d', $date + 86400 * $i);
                $finishProject[$today] = 0;
            }
            $date = date('Y-m-d H:i:s', $date + 86400 * 15);
        }
        $m_project = spClass("m_project");
        //完成的项目数 start
        $result = $m_project->findSql("select  DATE_FORMAT(p.proj_endDate,'%Y-%m-%d') days,
							count(p.proj_id) count from project p where
							p.proj_id in (SELECT pn.proj_id from proj_node pn where
							pn.user_id = " . $user_id . " )  and
							ABS(TIMESTAMPDIFF(day,p.proj_endDate,'
							" . $date . "
							'))<=7 group by days");
        foreach ($result as $rs) {
            $finishProject[$rs['days']] = (int)$rs['count'];
        }
        //完成的项目数 end
        echo json_encode(array(
            finishProject => $finishProject
        ));
    }

    function getFinishProjectNode_chart_axaj()
    {
        $user = pmUser("all", "html");
        $user_id = $user["id"];
        $date = $this->spArgs("date");
        $array = explode("-", $date);
        $year = $array[0];
        $month = $array[1];
        $day = $array[2];
        $date = mktime(0, 0, 0, $month, $day, $year);

        $type = $this->spArgs("type");
        $finishProjectNode = array();
        if ($type == 1) //向前15天
        {
            for ($i = 22; $i > 7; $i--) {
                $today = date('Y-m-d', $date - 86400 * $i);
                $finishProjectNode[$today] = 0;
            }
            $date = date('Y-m-d H:i:s', $date - 86400 * 15);
        } else //向后15天
        {
            for ($i = 8; $i < 23; $i++) {
                $today = date('Y-m-d', $date + 86400 * $i);
                $finishProjectNode[$today] = 0;
            }
            $date = date('Y-m-d H:i:s', $date + 86400 * 15);
        }
        $m_project = spClass("m_project");
        //完成的流程数 start
        $result = $m_project->findSql("
					select  DATE_FORMAT(p.pnod_time_r,'%Y-%m-%d') days,
					count(p.pnod_id) count from proj_node p where
					p.user_id =" . $user_id . "  and
					ABS(TIMESTAMPDIFF(day,p.pnod_time_r,'
					" . $date . "
					'))<=7 group by days");
        foreach ($result as $rs) {
            $finishProjectNode[$rs['days']] = (int)$rs['count'];
        }
        //完成的流程数 end
        echo json_encode(array(
            finishProjectNode => $finishProjectNode
        ));
    }

    function getContribute_chart_axaj()
    {
        $user = pmUser("all", "html");
        $user_id = $user["id"];
        $date = $this->spArgs("date");
        $array = explode("-", $date);
        $year = $array[0];
        $month = $array[1];
        $day = $array[2];
        $date = mktime(0, 0, 0, $month, $day, $year);

        $type = $this->spArgs("type");
        $contribute = array();
        if ($type == 1) //向前15天
        {
            for ($i = 22; $i > 7; $i--) {
                $today = date('Y-m-d', $date - 86400 * $i);
                $contribute[$today] = 0;
            }
            $date = date('Y-m-d H:i:s', $date - 86400 * 15);
        } else //向后15天
        {
            for ($i = 8; $i < 23; $i++) {
                $today = date('Y-m-d', $date + 86400 * $i);
                $contribute[$today] = 0;
            }
            $date = date('Y-m-d H:i:s', $date + 86400 * 15);
        }
        $m_project = spClass("m_project");
        //贡献值start
        $result = $m_project->findSql("
					select  DATE_FORMAT(p.proj_endDate,'%Y-%m-%d') days,
					SUM(pc.contri_num) sum from project p left JOIN
					pg_proj_contri pc on p.proj_id = pc.proj_id where
					p.proj_id in (SELECT pn.proj_id from proj_node pn where
					pn.user_id = " . $user_id . " )  and
					ABS(TIMESTAMPDIFF(day,p.proj_endDate,'
					" . $date . "'))<=7
					group by days
					");
        foreach ($result as $rs) {
            $contribute[$rs['days']] = (int)$rs['sum'];
        }
        //贡献值end
        ksort($contribute);
        echo json_encode(array(
            contribute => $contribute
        ));
    }

    function getExperience_chart_axaj()
    {
        $user = pmUser("all", "html");
        $user_id = $user["id"];
        $date = $this->spArgs("date");
        $array = explode("-", $date);
        $year = $array[0];
        $month = $array[1];
        $day = $array[2];
        $date = mktime(0, 0, 0, $month, $day, $year);

        $type = $this->spArgs("type");
        $experience = array();
        if ($type == 1) //向前15天
        {
            for ($i = 22; $i > 7; $i--) {
                $today = date('Y-m-d', $date - 86400 * $i);
                $experience[$today] = 0;
            }
            $date = date('Y-m-d H:i:s', $date - 86400 * 15);
        } else //向后15天
        {
            for ($i = 8; $i < 23; $i++) {
                $today = date('Y-m-d', $date + 86400 * $i);
                $experience[$today] = 0;
            }
            $date = date('Y-m-d H:i:s', $date + 86400 * 15);
        }
        $m_project = spClass("m_project");
        //经验值 start
        $result = $m_project->findSql("
					select  DATE_FORMAT(ps.send_data,'%Y-%m-%d') days,
					SUM(ps.actually_exp) sum from pg_pron_skill ps where
					ps.user_id = " . $user_id . "   and
					ABS(TIMESTAMPDIFF(day,ps.send_data,'
					" . $date . "'))<=7
					group by days
					");
        foreach ($result as $rs) {
            $experience[$rs['days']] = (int)$rs['sum'];
        }
        ksort($experience);
        //经验值 end
        echo json_encode(array(
            experience => $experience
        ));
    }

    //比值计算规则 $i/$j
    private function  calculateScale($i, $j)
    {
        if ($j == 0 || $i >= $j) {
            return 1;
        }
        return round($i / $j, 2);
    }

    function myDataStatistics_axjx()
    {
        $bdate = $this->spArgs("bdate");
        $edate = $this->spArgs("edate");
        $datestr = "";
        if ($bdate != "") {
            $datestr = " and (( a.proj_start between '" . $bdate .
                "' and '" . $edate . "' ) or " .
                "( a.proj_endDate between '" . $bdate .
                "' and '" . $edate . "' ) or " .
                "( a.proj_start < '" . $bdate .
                "' and a.proj_endDate > '" . $edate . "'))";


        }
        $m_project_v = spClass('m_project_v');
        $user_id = $this->spArgs("user_id", pmUser("id", "html"));
// 		$user=pmUser("all","html");
// 		$user_id=$user["id"];
        //参与的项目
        $sql = "select a.proj_level1,count(distinct a.proj_id) as sum
				from project_v a,proj_node_v b where b.proj_id=a.proj_id
				and b.user_id = " . $user_id . " and a.proj_state<20" . $datestr .
            " GROUP BY a.proj_level1 ORDER BY a.proj_level1";
        $result = $m_project_v->findSql($sql);
        $plv_array = array();
        $plv_array['plv_'] = 0; //历史记录
        $plv_array['plv_0'] = 0; //历史记录
        $plv_array['plv_1'] = 0;
        $plv_array['plv_2'] = 0;
        $plv_array['plv_3'] = 0;
        $plv_array['plv_4'] = 0;
        $plv_array['plv_5'] = 0;
        $plv_array['plv_10'] = 0;
        foreach ($result as $value) {
            $key = "plv_" . $value['proj_level1'];
            $plv_array[$key] = $value['sum'];

        }
        $plv_array['plv_0'] += $plv_array['plv_']; //合并历史记录
        array_shift($plv_array);
        //参与的流程
        $sql = "select a.proj_level1,count(distinct b.pnod_id) as sum
				from project_v a,proj_node_v b where b.proj_id=a.proj_id
				and b.user_id = " . $user_id . " and a.proj_state<40" . $datestr .
            " GROUP BY a.proj_level1 ORDER BY a.proj_level1";
        $result = $m_project_v->findSql($sql);
        $nlv_array = array();
        $nlv_array['nlv_'] = 0; //历史记录
        $nlv_array['nlv_0'] = 0; //历史记录
        $nlv_array['nlv_1'] = 0;
        $nlv_array['nlv_2'] = 0;
        $nlv_array['nlv_3'] = 0;
        $nlv_array['nlv_4'] = 0;
        $nlv_array['nlv_5'] = 0;
        $nlv_array['nlv_10'] = 0;
        $sum = 0;
        foreach ($result as $value) {
            $key = "nlv_" . $value['proj_level1'];
            $nlv_array[$key] = $value['sum'];
            $sum += $value['sum'];
        }
        $nlv_array['nlv_0'] += $nlv_array['nlv_']; //合并历史记录
        array_shift($nlv_array);
        //delay的流程数量
        $sql = "select sum(t.totle) as delay from (select a.proj_level1,
				count(distinct b.pnod_id) as totle
				from project_v a,proj_node_v b where b.proj_id=a.proj_id
				and b.user_id = " . $user_id . " and a.proj_state<40" . $datestr .
            " and ((b.pnod_time_r is null and b.pnod_time_e < NOW())
				or (b.pnod_time_r is not null and b.pnod_time_e<b.pnod_time_r)) 
				GROUP BY a.proj_level1 ORDER BY a.proj_level1) t";
        $result = $m_project_v->findSql($sql);
// 		echo $result[0]['delay']."\n";
        $delayPercent = 0;
        if ($result[0]['delay'] != null) {
            $delayPercent = floor($result[0]['delay'] * 100 / $sum) / 100;
        }
        echo json_encode(array(plv => $plv_array, nlv => $nlv_array, delayP => $delayPercent));
    }

    function myInfor_axjx()
    {
        $user = pmUser("all", "html");
        $user_id = $user["id"];
        $this->user_name = $user["name"]; //用户真名
        $pg_user_id = pmUser_pg("pg_user_id");
        $pg_job_id = pmUser_pg("pg_job_id");

        $m_user = spClass("m_user");
        $baseInfor = $m_user->findSql("select u.user_id,u.user_nickname,u.user_name,
				pu.pg_user_exp,pu.pg_user_gongxian,pj.job_name,pu.job_lv_num 
				from user u,pg_user pu,pg_jobs pj where u.user_id = pu.user_id and 
				pu.pg_user_jobid = pj.job_id and u.user_id = " . $user_id);
// 		$this->user_id = $result['user_id'];//用户id
// 		$this->user_nickname = $result['user_nickname']; //昵称
// 		$this->job_name = $result['job_name']; //职业
// 		$this->exp = $result['pg_user_exp']; //经验值
// 		$this->gongxian = $result['pg_user_gongxian'];//贡献值
// 		$this->job_lv = $result['job_lv_num'];//职业等级
        $m_pg_title_to_user = spClass("m_pg_title_to_user");
        $result = $m_pg_title_to_user->findSql("select a.title_name from pg_title a,
				pg_title_to_user b where a.title_id = b.title_id 
				and b.pg_userid = " . $pg_user_id);
        //谓称集合

        //获取未读消息数
        $m_msg_to_user = spClass("m_pg_message");
        $msg_sql = "select count(message_id) as unreadNum from pg_message  where had_read=0 and pg_user_id='$pg_user_id'";
        $unreadMsg = $m_msg_to_user->findSql($msg_sql);
        echo json_encode(array(baseInfor => $baseInfor[0], titleArray => $result, unreadMsg => $unreadMsg[0]['unreadNum']));
    }

    //个人升级要求
    function myLvUp()
    {
        $user = pmUser("all", "html");
        $user_id = $user["id"];
        $m_pg_user = spClass("m_pg_user");
        $m_project = spClass("m_project");
        //特殊任务start
        $this->result = $m_project->spPager($this->spArgs('topage', 1), 50)->findSql("
    				select p.proj_id,p.proj_name,p.proj_endDate from project p,pg_proj_contri pc 
					where p.proj_id = pc.proj_id and pc.is_special=1 and p.user_id  = " . $user_id );
        $this->pager = $m_project->spPager()->getPager();
        //特殊任务end
        //共性任务start
        
        $parma = array(
            'pg_user_id' => pmUser_pg("pg_user_id", "html"),
        );
        $job_and_lv = $m_pg_user->spLinker()->find($parma, "", "pg_user_jobid,job_lv_num");

        //--------已经完成的数据统计
        $m_project_v = spClass('m_project_v');
        $sql = "select a.proj_level1,count(distinct a.proj_id) as sum
                    from project_v a,proj_node_v b where b.proj_id=a.proj_id
                    and b.user_id = " . $user_id . " and a.proj_state<20" .
            " GROUP BY a.proj_level1 ORDER BY a.proj_level1";
        $result = $m_project_v->findSql($sql);
        $flv_array = array();
        $flv_array['flv_'] = 0; //历史记录
        $flv_array['flv_0'] = 0; //历史记录
        $flv_array['flv_1'] = 0;
        $flv_array['flv_2'] = 0;
        $flv_array['flv_3'] = 0;
        $flv_array['flv_4'] = 0;
        $flv_array['flv_5'] = 0;
        $flv_array['flv_10'] = 0;
        foreach ($result as $value) {
            $key = "flv_" . $value['proj_level1'];
            $flv_array[$key] = $value['sum'];
        }
        array_shift($flv_array);
        array_shift($flv_array);
        $this->flv_array = $flv_array;
        //--------等级要求
        $m_pg_job_up_request = spClass("m_pg_job_up_request");
        $result = $m_pg_job_up_request->findSql("select a.mtpl_proj1lv,SUM(b.num) as
                    sum from pg_mtpl a,pg_job_up_request b where a.mtpl_id = b.mtpl_id and
                    b.job_id = " . $job_and_lv['pg_user_jobid'] . " and b.job_level = " . $job_and_lv[job_lv_num] .
            " GROUP BY a.mtpl_proj1lv ORDER BY a.mtpl_proj1lv");
        $lv_array = array();
        $lv_array['lv_1'] = 0;
        $lv_array['lv_2'] = 0;
        $lv_array['lv_3'] = 0;
        $lv_array['lv_4'] = 0;
        $lv_array['lv_5'] = 0;
        $lv_array['lv_10'] = 0;
        foreach ($result as $value) {
            $key = "lv_" . $value['mtpl_proj1lv'];
            $lv_array[$key] = $value['sum'];
        }
        $this->lv_array = $lv_array; //升级要求数据
        //共性任务列表
        $this->sameTask = $m_pg_job_up_request->spLinker ()->findAll (array(job_id=>$job_and_lv['pg_user_jobid'],job_level=>$job_and_lv[job_lv_num]));
        //--------比值计算---
        $blv_array = array();
        $blv_array['blv_1'] = $this->calculateScale($flv_array['flv_1'], $lv_array['lv_1']);
        $blv_array['blv_2'] = $this->calculateScale($flv_array['flv_2'], $lv_array['lv_2']);
        $blv_array['blv_3'] = $this->calculateScale($flv_array['flv_3'], $lv_array['lv_3']);
        $blv_array['blv_4'] = $this->calculateScale($flv_array['flv_4'], $lv_array['lv_4']);
        $blv_array['blv_5'] = $this->calculateScale($flv_array['flv_5'], $lv_array['lv_5']);
        $blv_array['blv_10'] = $this->calculateScale($flv_array['flv_10'], $lv_array['lv_10']);
        $this->blv_array = $blv_array;

        //----------获取状态
        $m_pg_task_finish_state = spClass("m_pg_task_finish_state");
        $result = $m_pg_task_finish_state->findAll(array(pg_user_id => pmUser_pg("pg_user_id", "html")));
        $task_state = array();
        foreach ($result as $value) {
            $key = "lv_" . $value['lv'];
            $task_state[$key] = $value['state'];
        }
        $this->task_state = $task_state;
        //共性任务end
        $this->p_user_id = pmUser_pg("p_user_id", "html"); //导师id
        $this->display('pg/user/myLvUpl.html');
    }

    //我的技能查看
    function mySkillNode()
    {
        $id = $this->spArgs("id");
        $skill = spClass("m_pg_skill");
        $skilllv = spClass("m_pg_skill_lv");
        $this->skill = $skill->find(array(skill_id => $id));
        $this->skilllv = $skilllv->findAll(array(skill_id => $id));
        $this->display('pg/user/mySkillNode.html');
    }

    //查看我的学生的信息
    function myStudent()
    {
        $all_array = pmUser_pg("all", "html");
        $user_id = pmUser("id", "html");
        if ($all_array['p_user_id'] != -1) {
            pmResult(401, NULL, "html");
        }
        $m_pg_user = spClass("m_pg_user");
        $this->students = $m_pg_user->findSql("
				select u.user_id, u.user_name from user u,pg_user pu 
				where u.user_id = pu.user_id and pu.p_user_id = " . $user_id);
        $this->all_user = $m_pg_user->findSql("select u.user_id, u.user_name from user u where u.user_id in (select pu.user_id from pg_user pu)");
        $this->display('pg/user/myStudent.html');
    }

    //获取学生信息
    function myStudent_ajax()
    {
        $user_id = $this->spArgs("user_id");
        $m_pg_user = spClass("m_pg_user");
        $m_project = spClass("m_project");
        //特殊任务start
        $specialTask = $m_project->spPager($this->spArgs('topage', 1), 50)->findSql("
    				select p.proj_id,p.proj_name,p.proj_endDate from project p,pg_proj_contri pc
					where p.proj_id = pc.proj_id and pc.is_special=1 and p.user_id = " . $user_id );
        //特殊任务end
        //项目经历start
        $parma = array(
            'user_id' => $user_id,
        );
        $job_and_lv = $m_pg_user->spLinker()->find($parma, "", "pg_user_jobid,job_lv_num");

        //--------已经完成的数据统计
        $m_project_v = spClass('m_project_v');
        $sql = "select a.proj_level1,count(distinct a.proj_id) as sum
                    from project_v a,proj_node_v b where b.proj_id=a.proj_id
                    and b.user_id = " . $user_id . " and a.proj_state<20" .
            " GROUP BY a.proj_level1 ORDER BY a.proj_level1";
        $result = $m_project_v->findSql($sql);
        $flv_array = array();
        $flv_array['flv_'] = 0; //历史记录
        $flv_array['flv_0'] = 0; //历史记录
        $flv_array['flv_1'] = 0;
        $flv_array['flv_2'] = 0;
        $flv_array['flv_3'] = 0;
        $flv_array['flv_4'] = 0;
        $flv_array['flv_5'] = 0;
        $flv_array['flv_10'] = 0;
        foreach ($result as $value) {
            $key = "flv_" . $value['proj_level1'];
            $flv_array[$key] = $value['sum'];
        }
        array_shift($flv_array);
        array_shift($flv_array);
        //--------等级要求
        $m_pg_job_up_request = spClass("m_pg_job_up_request");
        while ($job_and_lv[job_lv_num] >= 3) {
            $job_and_lv[job_lv_num]--;
        }
        $result = $m_pg_job_up_request->findSql("select a.mtpl_proj1lv,SUM(b.num) as
                    sum from pg_mtpl a,pg_job_up_request b where a.mtpl_id = b.mtpl_id and
                    b.job_id = " . $job_and_lv['pg_user_jobid'] . " and b.job_level = " . $job_and_lv[job_lv_num] .
            " GROUP BY a.mtpl_proj1lv ORDER BY a.mtpl_proj1lv");
        $lv_array = array();
        $lv_array['lv_1'] = 0;
        $lv_array['lv_2'] = 0;
        $lv_array['lv_3'] = 0;
        $lv_array['lv_4'] = 0;
        $lv_array['lv_5'] = 0;
        $lv_array['lv_10'] = 0;
        foreach ($result as $value) {
            $key = "lv_" . $value['mtpl_proj1lv'];
            $lv_array[$key] = $value['sum'];
        }
        //升级要求数据

        //--------比值计算---
        $blv_array = array();
        $blv_array['blv_1'] = $this->calculateScale($flv_array['flv_1'], $lv_array['lv_1']);
        $blv_array['blv_2'] = $this->calculateScale($flv_array['flv_2'], $lv_array['lv_2']);
        $blv_array['blv_3'] = $this->calculateScale($flv_array['flv_3'], $lv_array['lv_3']);
        $blv_array['blv_4'] = $this->calculateScale($flv_array['flv_4'], $lv_array['lv_4']);
        $blv_array['blv_5'] = $this->calculateScale($flv_array['flv_5'], $lv_array['lv_5']);
        $blv_array['blv_10'] = $this->calculateScale($flv_array['flv_10'], $lv_array['lv_10']);
        //项目经历end
        //技能信息start
        $parma = array(
            'user_id' => $user_id
        );
        $pg_user = spClass("m_pg_user")->find($parma, null, "pg_user_id,pg_user_jobid,job_lv_num");
        $job_lv_num = $pg_user["job_lv_num"];
        $job_lv = '';
        switch ($job_lv_num) //职业等级以及职业下一级等级
        {
        	case 1:
        		$job_lv = "实习";
        		break;
        	case 2:
        		$job_lv = "试用";
        		break;
            case 3:
                $job_lv = "初级";
                break;
            case 4:
                $job_lv = "中级";
                break;
            case 5:
                $job_lv = "高级";
                break;
        }
        $pg_userid = $pg_user["pg_user_id"];
        $job_id = $pg_user["pg_user_jobid"];
        $parma = array(
            pg_userid => $pg_userid
        );
        $m_pg_skill_to_user = spClass("m_pg_skill_to_user");
        $m_pg_skill_lv = spClass("m_pg_skill_lv");
        $m_pg_skill_to_job = spClass("m_pg_skill_to_job");
        $myskilllist = $m_pg_skill_to_user->spLinker()->spPager($this->spArgs('topage', 1), 50)->findAll($parma);

        $resultArray = array();
        foreach ($myskilllist as $value) {
            $parma = array(
                'skill_id' => $value ['skill_id'],
                'skill_lv' => $value ['skill_lv']
            );
            $skill_lv = $m_pg_skill_lv->find($parma);
            $parma = array(
                'job_id' => $job_id,
                'skill_id' => $value ['skill_id']
            );
            $skill_intro = $m_pg_skill_to_job->find($parma);
            
            $skill_num = $m_pg_skill_to_job->findSql("SELECT lv,num from pg_skill_had_use 
            										where user_id = ".$user_id." and
            										skill_id = ".$value ['skill_id']." ORDER BY lv");
            $skill_num_array = array();
            for ($i=1;$i<5;$i++)
            	$skill_num_array[$i] = 0;
            foreach ($skill_num as $rs)
            	$skill_num_array[$rs['lv']] = $rs['num'];
            $ary = array(
                'skill_id' => $value ['skill_id'],
                //技能名
                'skill_name' => $value ['skillname'] ['skill_name'],
                //性质
                'skill_intro' => $skill_intro ['skill_intro'],
                //技能描述及掉落说明
                'skill_title' => $skill_lv ['skill_title'],
                //技能点
                'skill_exp' => $value ['skill_exp'],
                //当前等级
                'skill_lv' => $value ['skill_lv'],
            	//技能所用的数量
            	'skill_num'=>$skill_num_array
            );
            array_push($resultArray, $ary);
        }
        $skillArray = $resultArray;

        $m_pg_jobs = spClass("m_pg_jobs");
        $job_name = $m_pg_jobs->find(array(job_id => $job_id), "", "job_name");
        $job_name = $job_name[job_name]; //职业
        //技能信息end
        $edate = date('Y-m-d', time());
        $bdate = date('Y-m-d', time() - 15552000);
        
        $sameTask = $m_pg_job_up_request->spLinker ()->findAll (array(job_id=>$job_id,job_level=>$job_lv_num));
        
        echo json_encode(array(
            flv_array => $flv_array,
            lv_array => $lv_array,
            blv_array => $blv_array,
        	sameTask=>$sameTask,
            specialTask => $specialTask,
            skillArray => $skillArray,
            job_name => $job_name,
            job_lv => $job_lv,
            bdate => $bdate,
            edate => $edate,
        ));
    }

    //升级任务--点击完成
    function sendFinishMessage()
    {
        $lv = $this->spArgs("lv");
        $all_array = pmUser_pg("all", "html");
        $pg_user_id = $all_array["pg_user_id"];
        $p_user_id = $all_array["p_user_id"];
        if ($p_user_id == -1) {
            echo json_encode(array(msg => "你是导师，无法进行此操作。"));
            return;
        }
        if ($p_user_id == 0) {
            echo json_encode(array(msg => "你没有导师，无法进行此操作。"));
            return;
        }
        $m_pg_user = spClass("m_pg_user");
        $student = $m_pg_user->findSql("
					select u.user_name from user u,pg_user pu where 
					u.user_id = pu.user_id and pu.pg_user_id = " . $pg_user_id . "
				");
        $student_name = $student[0]['user_name'];
        $teacher = $m_pg_user->findSql("
					select pu.pg_user_id, u.user_name,u.user_mail from user u ,
					pg_user pu where u.user_id = pu.user_id and u.user_id = " . $p_user_id . "
				");
        $teacher_name = $teacher[0]['user_name'];
        $teacher_email = $teacher[0]['user_mail'];
        $teacher_pg_user_id = $teacher[0]['pg_user_id'];

        $m_pg_task_finish_state = spClass("m_pg_task_finish_state");
        $result = $m_pg_task_finish_state->find(array(pg_user_id => $pg_user_id, lv => $lv));
        $task_id = 0;
        if ($result) {
            $task_id = $result['pg_task_finish_id'];
            $m_pg_task_finish_state->update(array(pg_user_id => $pg_user_id, lv => $lv), array(state => 1));
        } else {
            $task_id = $m_pg_task_finish_state->create(array(pg_user_id => $pg_user_id, lv => $lv, state => 1));
        }
        $m_pg_message = spClass("m_pg_message");
        $title = "";
        switch ($lv) {
            case 1:
                $title = "A级别任务数量";
                break;
            case 2:
                $title = "B级别任务数量";
                break;
            case 3:
                $title = "C级别任务数量";
                break;
            case 4:
                $title = "D级别任务数量";
                break;
            case 5:
                $title = "E级别任务数量";
                break;
            case 10:
                $title = "无级别任务数量";
                break;
        }
        //发送信息
        $content = $student_name . "完成的'" . $title . "'已达到预设要求,请求审核(<a onclick='check_pass(3," . $task_id . ")'>通过</a>||<a onclick='check_pass(2," . $task_id . ")'>不通过</a>)";
        $result0 = $m_pg_message->sendNewMessage($teacher_pg_user_id, $student_name . "-任务审核", $content, $pg_user_id);
        //发送邮件
        import('extensions/nie-message/nie-mail.php');
        $mail = new nieMail;
        $result = $mail->write(array(
            'subject' => $student_name . "-任务审核",
            'body' => $student_name . "完成的'" . $title . "'已达到预设要求,正在请求审核。请进入PG系统查收系统通知进行操作。",
            'to' => array($teacher_email)
        ))->send();

        if ($result) {
            echo json_encode(array(msg => "请求成功！请耐心等待审核。"));
        } else {
            echo json_encode(array(msg => "请求失败！但邮件通知发送失败，请主动联系导师。"));
        }
    }

    //升级任务--点击完成 -- 审核是否通过
    function taskCheckPass_ajax()
    {
        $is_pass = $this->spArgs("is_pass");
        $task_id = $this->spArgs("task_id");
        $all_array = pmUser_pg("all", "html");
        $user_id = pmUser("id", "html");
        $pg_user_id = $all_array["pg_user_id"];
        $p_user_id = $all_array["p_user_id"];
        if ($p_user_id != -1) {
            echo json_encode(array(msg => "你不是导师，无权进行此操作。"));
            return;
        }
        $m_pg_user = spClass("m_pg_user");
        $student_s_p = $m_pg_user->findSql("
					select pu.p_user_id,pt.state from pg_user pu, pg_task_finish_state pt 
					where pu.pg_user_id = pt.pg_user_id and pt.pg_task_finish_id = " . $task_id . "
				");
        if (!$student_s_p || $student_s_p[0]['state'] > 1) {
            echo json_encode(array(msg => "此请求已经无效，无法审核。"));
            return;
        }
        if ($student_s_p[0]['p_user_id'] != $user_id) {
            echo json_encode(array(msg => "你不是该学生的导师，无权进行此操作。"));
            return;
        }

        $m_pg_task_finish_state = spClass("m_pg_task_finish_state");
        $result = $m_pg_task_finish_state->update(array(pg_task_finish_id => $task_id), array(state => $is_pass));
        if ($result) {
            echo json_encode(array(msg => "审核成功。"));
        } else {
            echo json_encode(array(msg => "审核失败，请重新审核。"));
        }

    }
    
    //技能数量查看
    function mySkillNum()
    {
    	$pg_user_id=pmUser_pg("pg_user_id", "html");
    	$m_pg_skill_num_give = spClass("m_pg_skill_num_give");
    	$my_skills = $m_pg_skill_num_give->findSql("select pg.*,ps.skill_name from pg_skill_num_give pg,
    									pg_skill ps where pg.skill_id = ps.skill_id 
    									and pg.pg_user_id =".$pg_user_id);
    	$this->my_skills = $my_skills;
    	$this->display('pg/user/mySKillNum.html');
    }
}