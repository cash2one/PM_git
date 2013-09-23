<?php
ini_set("max_execution_time", "1800000");


class redminesys extends spController
{
    function index()
    {
    }


    function getDemand()
    {
        $userTable = spClass('m_user');
        $redmineDemand = spClass("m_redminesys");
        $content = file_get_contents("php://input");

        $content = urldecode($content);

        $pMethod = $_POST['method']; //项目的类型，create，update，delete
        $pRedmindId = $_POST['id']; //项目的redmineId
        $pType = $_POST['tracker_id']; //项目的类型

        $pProject = $_POST['project_id']; //流程属于哪个项目
        $pTitle = $_POST['subject']; // 简单描述
        $pDesc = $_POST['description']; //详细描述
        $PDuedate = $_POST['due_date']; // 预期时间
        $pExpdate=$_POST['期望完成时间'];

        $pAssto = $_POST['assigned_to_id']; //指派给谁
        $pPrio = $_POST['priority_id']; //项目紧急情况
        $pStartdate = $_POST['start_date']; //项目开始时间
        $pDonerat = $_POST['done_ratio']; //完成进度
        $pParent = $_POST['parent_id']; //父项目ID
        $pRedurl = 'http://' . $_POST['host_name'] . '/issues/' . $pRedmindId;
        $pHolder = $this->getToUserId($pAssto); //负责人
        $pHolderName = $this->getToUserName($pAssto);
        $pParent = (int)$pParent;
        if (!$PDuedate) {
            //if(!$pExpdate){
           //     $PDuedate=$pExpdate . ' 18:00:00';
           // }else{
                $PDuedate = NULL;
           // }
        } else {
            $PDuedate = $PDuedate . ' 18:00:00';
        }
        $pStartdate = $pStartdate . ' 09:00:00';
        //根据项目名称活动项目id

        preg_match("|【(.*)】|U", $pProject, $ok);
        $pProd=$ok[1];
        $pGet=getRedmineProdType();
        $pProdId=$pGet[$pProd];


        /*
        $pMethod = 'create'; //项目的类型，create，update，delete
        $pType = '业务需求'; //项目的类型
        $pProject = 'PMG与redmine打通'; //流程属于哪个项目
        $pTitle = '发布一篇头条新闻'; // 简单描述
        $pDesc = '发布一篇重要头条新闻，一定要在下午2点之前发出去。同时并发新客户端。'; //详细描述
        $PDuedate = '2013-06-28'; // 预期时间
        $pAssto = 'gzzhuzhipeng'; //指派给谁

        $pStartdate = '2013-06-27'; //项目开始时间
        */
        $track_id = '日常运维需求';
        if ($pType!=$track_id) {
            $testP = array();
            if ($pMethod == 'create') {
                //$redmineInPm = $this->getToUserId($pAssto);
                $project_row = array(
                    'proj_name' => '[RD单-' . $pProject . ']-' . $pTitle,
                    'prod_id' => 10, //其他产品
                    'proj_date' => date("Y-m-d H:i:s"),
                    'proj_ps' => $pDesc,
                    'proj_url' => $pRedurl,
                    'proj_class' => 5, //redmine单
                    'proj_state' => 20, //正在进行
                    'proj_start' => $pStartdate,
                    'proj_end' => $PDuedate==NULL?($pExpdate . ' 18:00:00'):$PDuedate,
                    'specialtask' => 0,
                    'p_proj_id' => $this->spArgs('parent_proj', 0),
                    // 'proj_level1'=>$this->spArgs('proj_level1'),
                    //  'proj_level2'=>$this->spArgs('proj_level2'),
                    'user_id' => $pHolder, //负责人
                    'contri_num' => 0, //juetion 项目贡献值
                    // 'p_proj_id'=>$this->spArgs('parent_proj',0),//juetion 父项目id
                    // 'specialtask'=>$this->spArgs('specialtask'),//项目是否特殊任务 1-特殊项目，2-子项目
                    'proj_target' => '', //项目目标
                    'proj_rdUrl' => $pRedurl, //地址  ,
                    'proj_redmineId' => $pRedmindId, //redmineId
                    'proj_redprd'=>$pProdId,

                );

                //构造流程
                $nodelist = array();
                $nodelist['proj_node1']['pnod_time_s'] = $pStartdate;
                $nodelist['proj_node1']['pnod_time_e'] = $PDuedate;
                $nodelist['proj_node1']['pnod_type'] = 10;
                $nodelist['proj_node1']['pnod_type2'] = 1;
                $nodelist['proj_node1']['user_id'] = $this->getToUserId($pAssto);
                $nodelist['proj_node1']['pnod_name'] = $pTitle;
                $nodelist['proj_node1']['pnod_state'] = 20;
                $nodelist['proj_node1']['pnod_state2'] = 0; //流程默认需要审核
                $nodelist['proj_node1']['pnod_desc'] = $pDesc; //流程描述

                $result = spClass('m_project')->addProject($project_row, $nodelist, array('user_id' => $pHolder, 'user_name' => $pHolderName, 'testNode' => false), $pParent);

            }

        }
        $row = array(
            'red_details' => $content,
            'red_ct' => $PDuedate,
            'red_sb' => $pExpdate . ' 18:00:00'
        );
        $redmineDemand->create($row);


    }

    //平台组redmine
    function webDemand()
    {
        $userTable = spClass('m_user');
        $redmineDemand = spClass("m_redminesys");
        $content = file_get_contents("php://input");

        $content = urldecode($content);

        $pMethod = $_POST['method']; //项目的类型，create，update，delete
        $pRedmindId = $_POST['id']; //项目的redmineId
        $pType = $_POST['tracker_id']; //项目的类型

        $pProject = $_POST['project_id']; //流程属于哪个项目
        $pTitle = $_POST['subject']; // 简单描述
        $pDesc = $_POST['description']; //详细描述
        $PDuedate = $_POST['due_date']; // 预期时间
        $pAssto = $_POST['assigned_to_id']; //指派给谁
        $pPrio = $_POST['priority_id']; //项目紧急情况
        $pStartdate = $_POST['start_date']; //项目开始时间
        $pDonerat = $_POST['done_ratio']; //完成进度
        $pParent = $_POST['parent_id']; //父项目ID
        $pRedurl = 'http://' . $_POST['host_name'] . '/issues/' . $pRedmindId;
        $pHolder = $this->getToUserId($pAssto); //负责人
        $pHolderName = $this->getToUserName($pAssto);
        $pParent = (int)$pParent;
        if (!$PDuedate) {
            $PDuedate = NULL;
        } else {
            $PDuedate = $PDuedate . ' 18:00:00';
        }
        $pStartdate = $pStartdate . ' 09:00:00';

        $track_id = array('前端', '动画设计', '视觉设计');
        if (in_array($pType, $track_id)) {
            // return;
            $testP = array();
            if ($pMethod == 'create') {
                //$redmineInPm = $this->getToUserId($pAssto);
                $project_row = array(
                    'proj_name' => '[RD单web平台-' . $pProject . ']-' . $pTitle,
                    'prod_id' => 10, //10变成redmine 产品ID40是其他
                    'proj_date' => date("Y-m-d H:i:s"),
                    'proj_ps' => $pDesc,
                    'proj_url' => $pRedurl,
                    'proj_class' => 5, //redmine单
                    'proj_state' => 20, //正在进行
                    'proj_start' => $pStartdate,
                    'proj_end' => $PDuedate,
                    'specialtask' => 0,
                    'p_proj_id' => $this->spArgs('parent_proj', 0),
                    // 'proj_level1'=>$this->spArgs('proj_level1'),
                    //  'proj_level2'=>$this->spArgs('proj_level2'),
                    'user_id' => $pHolder, //负责人
                    'contri_num' => 0, //juetion 项目贡献值
                    // 'p_proj_id'=>$this->spArgs('parent_proj',0),//juetion 父项目id
                    // 'specialtask'=>$this->spArgs('specialtask'),//项目是否特殊任务 1-特殊项目，2-子项目
                    'proj_target' => '', //项目目标
                    'proj_rdUrl' => $pRedurl, //地址  ,
                    'proj_redmineId' => $pRedmindId //redmineId
                );

                //构造流程
                $nodelist = array();
                $nodelist['proj_node1']['pnod_time_s'] = $pStartdate;
                $nodelist['proj_node1']['pnod_time_e'] = $PDuedate;
                $nodelist['proj_node1']['pnod_type'] = 10;
                $nodelist['proj_node1']['pnod_type2'] = 1;
                $nodelist['proj_node1']['user_id'] = $this->getToUserId($pAssto);
                $nodelist['proj_node1']['pnod_name'] = $pTitle;
                $nodelist['proj_node1']['pnod_state'] = 20;
                $nodelist['proj_node1']['pnod_state2'] = 0; //流程默认需要审核
                $nodelist['proj_node1']['pnod_desc'] = $pDesc; //流程描述

                $result = spClass('m_project')->addProject($project_row, $nodelist, array('user_id' => $pHolder, 'user_name' => $pHolderName, 'testNode' => false), $pParent);

            }
        }

        $row = array(
            'red_details' => $content,
            'red_ct' => $pParent,
            'red_sb' => in_array($pType, $track_id)
        );
        $redmineDemand->create($row);
    }


    function showDemand()
    {
        $redmineDemand = spClass("m_redminesys");
        $dd = $redmineDemand->findAll();
        dump($dd);
    }

    /*
     * 通过指派给谁获取流程的user_id
     */
    function  getToUserId($str)
    {
        //Z 朱志鹏 gzzhuzhipeng
        $userTable = spClass('m_user');
        $nameArr = explode(" ", $str);
        $name = $nameArr[2];
        $mail = $name . '@corp.netease.com';
        if ($redmine = $userTable->find(array('user_mail' => $mail))) {
            return $redmine['user_id'];
        } else {
            return 0;
        }
    }

    function  getToUserName($str)
    {
        //Z 朱志鹏 gzzhuzhipeng
        $userTable = spClass('m_user');
        $nameArr = explode(" ", $str);
        $name = $nameArr[2];
        $mail = $name . '@corp.netease.com';
        if ($redmine = $userTable->find(array('user_mail' => $mail))) {
            return $redmine['user_name'];
        } else {
            return 0;
        }
    }

    function  test()
    {
        echo $this->getToUserId('Z 朱志鹏 gzzhuzhipeng');
        echo $this->getToUserName('Z 朱志鹏 gzzhuzhipeng');
    }

    function  test2()
    {

        $strt = '[{"proj_name":"[redmineu63d0u5c","prod_id":10,"proj_date":"2013-07-10 16:42:16","proj_ps":"u7231u4e0au53d1u751fu7684","proj_url":"http://wz.pm.netease.com:8169/issues/704","proj_class":5,"proj_state":20,"proj_start":"2013-07-10 09:00:00","proj_end":"2013-07-13 18:00:00","specialtask":0,"p_proj_id":0,"user_id":"114","contri_num":0,"proj_target":"","preview_address":"http://wz.pm.netease.com:8169/issues/704","proj_redmineId":"704"},{"proj_node1":{"pnod_time_s":"2013-07-10","pnod_time_e":"2013-07-13","pnod_type":10,"pnod_type2":1,"user_id":"114","pnod_name":"u30730u65b9","pnod_state":20,"pnod_state2":0,"pnod_desc":"u7231u4e0au53d1u751fu7684"}},{"user_id":"114","user_name":"u6731u5fd7u9e4f","testNode":true},703]';
        $parm = json_decode($strt, true);
        $result = spClass('m_project')->addProject($parm[0], $parm[1], $parm[2], $parm[3]);
        dump($result);
        echo '2222';
    }
}

/*
function str2json(str){
    var obj={};
    var tmpArr1=str.split('&');
    for(var i=0;i<tmpArr1.length;i++){
        var tmpArr2=tmpArr1[i];
        var propertyName=tmpArr2.split('=')[0];
        var propertyValue=tmpArr2.split('=')[1]=='undefined'?'':tmpArr2.split('=')[1];
        obj[propertyName]=propertyValue;
    }
    return obj;
}
*/