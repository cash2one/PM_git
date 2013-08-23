<?php

class group extends spController
{
    function index()
    {

    }

    function glist()
    {
        $group=spClass('m_group');
        $result=$group->findAll();
        for($i=0;$i<count($result);$i++){
            $re=$group->getProdArray($result[$i]['group_id']);
            $leader=$group->getLeader($result[$i]['group_id']);
            $teamlist=$group->getTeamlist($result[$i]['group_id']);
            $result[$i]['product_name_list']=$re;
            $result[$i]['leader_name']=$leader;
            $result[$i]['team_list']=$teamlist;
        }
        dump($result);
        //$this->display('group/list.html');
    }
    function test(){
        $pProject='【cc】梦幻官网';
        preg_match("|【(.*)】|U", $pProject, $ok);
        $pProd=$ok[1];
        $pGet=getRedmineProdType();
        $pProdId=$pGet[$pProd];
       dump($pProdId);
    }

    /* 替换原来旧数据
    function replace(){
        $proj=spClass('m_project');
        $a=$proj->findSql('select proj_id,proj_name from project where prod_id=10 and proj_id>2944 and proj_rdUrl <>""');

        foreach($a as $item){
            $redprd=$this->rep($item['proj_name']);
            $proj->update(
                array('proj_id'=>$item['proj_id']),
                array('proj_redprd'=>$redprd)
            );
        }
        dump($a);
    }
    */



}
