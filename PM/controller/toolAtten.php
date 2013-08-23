<?php

class toolAtten extends spController
{
    function index()
    {
        require_once(APP_PATH . "/WebServiceConfig.php");
        $user = pmUser("all", "html");
        $this->isShowAll = $user["power"];
        $this->lateTime = $WCONFIG_lateTime;
        $this->display("tool/attend.html");
    }

    function show()
    {
        $year = $this->spArgs("year");
        $month = $this->spArgs("month");
        $isall = $this->spArgs("isall");
        if (!$year || !$month) pmResult("0", "参数错误。", 'json');
        $mAtten = spClass("m_atten");
        $mUser = spClass("m_user");
        $user = pmUser("all", "html");
        if ($isall == 1) {
            $users = spClass("m_user")->findSql("select user_id,user_name from user where user_power<3 and role_id>0");
            $attenList = $mAtten->findSql("select *,DAY(rtime) AS day FROM atten where YEAR(rtime)=$year and MONTH(rtime)=$month");
        } else {
            $users = $mUser->findSql("select user_id,user_name from user where user_id=" . $user["id"]);
            $attenList = $mAtten->findSql("select *,DAY(rtime) AS day FROM atten where YEAR(rtime)=$year and MONTH(rtime)=$month and user_id=" . $user['id']);
        }
        echo("var userlist=" . json_encode($users));
        echo(";var attenlist=" . json_encode($attenList));
    }
    //热点分析小工具
    function yoyo()
    {
        $gamelist = spClass('m_pg_pa');
        $urllist = spClass('m_pg_pagurl');

        $this->gamelist = $gamelist->findAll();
        $this->display("tool/participle.html");
    }
    //test github push
    //how can I get the point
    function yoyoGeturllist()
    {
        $id = $this->spArgs('gameid');
        $urllist = spClass('m_pg_pagurl');
        $result = $urllist->findAll(
            array('game_id' => $id), 'des DESC',null,null
        );
        echo json_encode(array('re' => $result));
    }
    function yoyoAddsite(){
        $urllist=spClass('m_pg_pagurl');
        $gameid=$this->spArgs('gameRadio');
        $code=$this->spArgs('code');
        $sign=$this->spArgs('sign');
        $link=$this->spArgs('baseLink');
        $des=$this->spArgs('des');
        $addRow=array(
            "game_id"=>$gameid,
            "sign"=>$sign,
            "des"=>$des,
            "page_sign"=>$link,
            "charset"=>$code
        );

        if($urllist->create($addRow)){
            echo json_encode(array(
                "status"=>200,
                "msg"=>'添加成功'
            ));
        }else{
            echo json_encode(
                array(
                    "status"=>500,
                    "msg"=>' 操作失败'
                )
            );
        }

    }
    function yoyoRecord(){
        $recordlist=spClass('m_pg_parecord');
        $start=$this->spArgs('startTime');
        $end=$this->spArgs('endTime');
        $result=$recordlist->findSql("select * from pg_parecord where record_date>='$start' and record_date<='$end' limit 50");
        echo json_encode(
            array('re'=>$result,'status'=>200)
        );
    }
    function participleA()
    {
        $addRecord=false;
        $page_code = $this->spArgs("pageCode");
        $baseLink = $this->spArgs("baseLink");
        $showNum = $this->spArgs("showNum", 0);
        $pageNum=$this->spArgs('page-num',1);
        $type=$this->spArgs('type',0);
        $recordlist=spClass('m_pg_parecord');
        $sign = $this->spArgs("sign", 0);
        $filtrs=$this->spArgs('filtr-list');
        import('extensions/simple_html_dom.php');
        $result = "";
        $baseLinks=array();
        for($i=0;$i<$pageNum;$i++){
            array_push($baseLinks,str_replace('{@}',($i+1),$baseLink));
        }
        $filtrArr=explode("|", $filtrs);
        // $baseLinks = explode("\r\n", $baseLink);
        if ($baseLink) {
            for ($i = 0; $i < count($baseLinks); $i++) {
                //从一个URL创建一个DOM对象
                $html = file_get_html($baseLinks[$i]);
                $es = $html->find($sign . ' a');
                for ($j = 0; $j < count($es); $j++) {
                    $result = $result . $es[$j]->plaintext;
                }
            }
            for($index=0;$index<count($filtrArr);$index++){
                $result=str_replace($filtrArr[$index],'',$result);
            }
            $post_data = array();
            $post_data ['stats'] = "yes";
            $post_data ['limit'] = $showNum;
            $post_data ['xattr'] = "";
            $post_data ['mydata'] = $result;


            $url = 'http://www.xunsearch.com/scws/demo/v48.php';
            $o = "";
            foreach ($post_data as $k => $v) {
                $o .= "$k=" . urlencode($v) . "&";
            }
            $post_data = substr($o, 0, -1);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'http://www.xunsearch.com/scws/demo/v48.php');
            // curl_setopt($ch, CURLOPT_URL, 'http://www.ftphp.com/scws/api.php');
            curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
            // curl_setopt($ch, CURLOPT_POSTFIELDS, 'data='.$result.'&respond=json&ignore=yes');
            $data = curl_exec($ch);
            curl_close($ch);

            $count = strpos($data, "分词结果");
            $data = substr($data, $count, -1);
            $count = strpos($data, "<textarea");
            $data = substr($data, $count);
            $count = strpos($data, "<small");
            $data = substr($data, 0, $count);
        }
        $addRow=array(
            'record_url'=>str_replace('{@}',$pageNum,$this->spArgs("baseLink")),
            'record_date'=>date('Y-m-d'),
            'record_cont'=>$data,
            'record_type'=>$type,
        );
        if($recordlist->create($addRow)){
            $addRecord=true;
        }

        echo json_encode(array('re' => $data,'ar'=>$filtrArr));
    }
}