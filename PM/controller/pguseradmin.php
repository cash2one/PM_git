<?php
class pguseradmin extends spController
{
    function index()
    {

    }

    //角色配置
    function userList()
    {
        $oldPmUser = spClass('m_user');
        $jobList = spClass('m_pg_jobs');
        $skillList = spClass('m_pg_skill');
        $this->userList = $oldPmUser->findSql("SELECT u.*,pu.p_user_id from user u LEFT JOIN pg_user pu ON u.user_id = pu.user_id");
        $this->jobList = $jobList->findAll();
        $this->skillList = $skillList->findAll();
        $this->display('pg/useradmin/pguser.html');
    }
    //搜索信息
    function userskilllist_ajax()
    {
        $skill = spClass('m_pg_skill_to_user');
        $pgUser = spClass('m_pg_user_v');
        //找pguserid

        $pgUserParams = $pgUser->find(array('user_id' => $this->spArgs('user_id')));
        $pgUserId = $pgUserParams['pg_user_id'];
        //找该ID的技能
        $pgUserSkill = $skill->spLinker()->findAll(array('pg_userid' => $pgUserId));
        echo json_encode(array(
            "isInit" => $pgUserParams,
            "skill" => $pgUserSkill,
            "pgUser" => $pgUserId
            //"userStatus"=>$pgUserParams
        ));
    }
    //删除技能
    function userskilldel_ajax()
    {
        $skill = spClass('m_pg_skill_to_user');
        $skill->delete(array('pg_stuid' => $this->spArgs('pgstuid')));
        if ($skill) {
            pmResult('200', '删除成功');
        }
    }
    //创建角色
    function pguser_create()
    {
        $pgUser = spClass('m_pg_user');
        $pgUserId = $pgUser->create(array(
            'pg_user_jobid' => $this->spArgs('jobid'),
            'job_lv_num'=>$this->spArgs('joblv'),
            'pg_user_exp' => $this->spArgs('exp'),
            'pg_user_gongxian' => $this->spArgs('gongxian'),
            'user_id' => $this->spArgs('user_id'),
        	'p_user_id' => $this->spArgs('p_id')
        ));
        pmResult('200');

    }
    //更新角色
    function pguser_update()
    {
        $pgUser = spClass('m_pg_user');

        $pgUserId = $pgUser->update(array('user_id' => $this->spArgs('user_id')),
            array(
                'pg_user_jobid' => $this->spArgs('jobid'),
                'job_lv_num'=>$this->spArgs('joblv'),
                'pg_user_exp' => $this->spArgs('exp'),
                'pg_user_gongxian' => $this->spArgs('gongxian'),
            	'p_user_id' => $this->spArgs('p_id')
            ));
        pmResult('200');

    }
    //更新技能
    function pguserskill_update()
    {
        $skill = spClass('m_pg_skill_to_user');
        //找pguserid
        $pgUserV = spClass('m_pg_user_v');
        $pgUserParams = $pgUserV->find(array('user_id' => $this->spArgs('user_id')));
        $pgUserId = $pgUserParams['pg_user_id'];
        $pgstuid = $skill->create(array(
            'skill_id' => $this->spArgs('skill_id'),
            'skill_lv' => $this->spArgs('skill_lv'),
            'pg_userid' => $pgUserId
        ));
        echo json_encode(array(
            'pgstuid' => $pgstuid,
            'des' => '新增成功！',
            'status' => '200'
        ));
    }
    //更新技能等级
    function pguserskilllv_update()
    {
        $skill = spClass('m_pg_skill_to_user');
        $pg_stuid=$this->spArgs('pg_stuid');
        $skill_lv = $this->spArgs('skill_lv');
        $skill->update(array('pg_stuid'=>$pg_stuid),array('skill_lv'=>$skill_lv,'skill_exp'=>0));
        if($skill){
        	$skillInformation=$skill->findSql("
        				select ps.skill_name,pt.pg_userid from pg_skill ps,pg_skill_to_user pt 
        				where ps.skill_id = pt.skill_id and pt.pg_stuid = ".$pg_stuid."
        			");
        	$skill_name = $skillInformation[0]['skill_name'];
        	$pg_userid = $skillInformation[0]['pg_userid'];
        	spClass("m_pg_message")->sendNewMessage($pg_userid,
        							"技能升级通知",
        							"你获得的技能《".$skill_name."》 升到".($skill_lv-1)."级。",
        							0);
            pmResult('200');
        }

    }


    //成就发放
    function medalSet()
    {
        $oldPmUser = spClass('m_user');
        $jobList = spClass('m_pg_jobs');
        $medalList = spClass('m_pg_medals');
        $this->userList = $oldPmUser->findAll();
        $this->jobList = $jobList->findAll();
        $this->medalList = $medalList->findAll();
        $this->display('pg/useradmin/medalset.html');
    }

    //
    function  medalList_ajax()
    {
        $medal2user = spClass('m_pg_medal_to_user');
        //找pguserid
        $pgUserV = spClass('m_pg_user_v');
        $pgUserParams = $pgUserV->find(array('user_id' => $this->spArgs('user_id')));
        $pgUserId = $pgUserParams['pg_user_id'];
        //该帐号下的勋章列表
        $pgUserMedal = $medal2user->spLinker()->findAll(array('pg_userid' => $pgUserId));
        echo json_encode(array(
            "isInit" => $pgUserParams,
            "medalList" => $pgUserMedal
        ));
    }
    function testMsg(){
        //全服通知
        $msg=spClass('m_message');
        $msg_context="恭喜<strong>朱志鹏</strong>获得勋章<strong>有你才有G</strong>。大家快去围观吧！";
        $msg->init($msg_context,0,0,0,1,NULL,114,4,28,114)->toUser(114)->send();
        //end
    }
    function  medalAdd_ajax()
    {
        $medal2user = spClass('m_pg_medal_to_user');
        //找pguserid
        $pgUserV = spClass('m_pg_user_v');
        $pgUserParams = $pgUserV->find(array('user_id' => $this->spArgs('user_id')));
        $pgUserId = $pgUserParams['pg_user_id'];
        //增加
        $pgUserAddMedal = $medal2user->create(array('pg_userid' => $pgUserId, 'medal_id' => $this->spArgs("medal_id"), 'get_time' => date('Y-m-d  H:i:s')));
	
        //发送系统消息 start juetion
        $medalName = spClass("m_pg_medals")->find(array('medal_id' => $this->spArgs("medal_id")),null,"medal_name");
        spClass("m_pg_message")->sendNewMessage($pgUserId,"获得新勋章","恭喜你，获得勋章-【".$medalName['medal_name']."】",pmUser("id","html"));
        //发送系统消息 end juetion

        //全服通知
        $msg=spClass('m_message');
        $msg_context="！！！恭喜<strong>".$pgUserParams['user_name']."</strong>获得勋章<strong>".$medalName['medal_name']."</strong>。大家快去围观吧！";
        $msg->init($msg_context,0,0,0,1,NULL,$this->spArgs('user_id')/*图像id*/,4,$this->spArgs("medal_id"),$this->spArgs('user_id'))->toAll()->send();
        //end

        $pgUserMedal = $medal2user->spLinker()->findAll(array('pg_userid' => $pgUserId));
        if ($pgUserAddMedal) {
            echo json_encode(array(
                "isInit" => $pgUserParams,
                "medalList" => $pgUserMedal
            ));
        }

    }

    //称谓
    function titleSet()
    {
        $oldPmUser = spClass('m_user');
        $jobList = spClass('m_pg_jobs');
        $titleList = spClass('m_pg_titles');
        $this->userList = $oldPmUser->findAll();
        $this->jobList = $jobList->findAll();
        $this->titleList = $titleList->findAll();
        $this->display('pg/useradmin/titleset.html');
    }

    //
    function  titleList_ajax()
    {
        $medal2user = spClass('m_pg_title_to_user');
        //找pguserid
        $pgUserV = spClass('m_pg_user_v');
        $pgUserParams = $pgUserV->find(array('user_id' => $this->spArgs('user_id')));
        $pgUserId = $pgUserParams['pg_user_id'];
        //该帐号下的勋章列表
        $pgUserMedal = $medal2user->spLinker()->findAll(array('pg_userid' => $pgUserId));
        echo json_encode(array(
            "isInit" => $pgUserParams,
            "titleList" => $pgUserMedal
        ));
    }

    function  titleAdd_ajax()
    {
        $title2user = spClass('m_pg_title_to_user');
        //找pguserid
        $pgUserV = spClass('m_pg_user_v');
        $pgUserParams = $pgUserV->find(array('user_id' => $this->spArgs('user_id')));
        $pgUserId = $pgUserParams['pg_user_id'];
        //增加
        $pgUserAddMedal = $title2user->create(array('pg_userid' => $pgUserId, 'title_id' => $this->spArgs("title_id"), 'get_time' => date('Y-m-d  H:i:s')));

        //发送系统消息 start juetion
        $titleName = spClass("m_pg_titles")->find(array('title_id' => $this->spArgs("title_id")),null,"title_name");
        spClass("m_pg_message")->sendNewMessage($pgUserId,"获得新称谓","恭喜你，获得称谓-【".$titleName['title_name']."】",pmUser("id","html"));
        //发送系统消息 end juetion
        
        $pgUserMedal = $title2user->spLinker()->findAll(array('pg_userid' => $pgUserId));
        if ($pgUserAddMedal) {
            echo json_encode(array(
                "isInit" => $pgUserParams,
                "titleList" => $pgUserMedal
            ));
        }

    }


}
