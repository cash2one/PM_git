<?php
class msgshow extends spController
{
    function index()
    {
        $uid = $this->spArgs('uid');
        $mid = $this->spArgs('mid');
        $medalModel = spClass('m_pg_medals');
        $userModel = spClass('m_user');
        $medal = $medalModel->find(array(
            'medal_id' => $mid
        ));
        $user = $userModel->find(array(
            'user_id' => $uid
        ));
        $wenan = array(
            '费尽九牛二虎之力',
            '历劫千辛万苦之劳',
            '轮回九九八一之劫',
            '悟透四象八卦之秘',
            '吃遍肉丝五仁之月',
            '勇闯魑魅魍魉之境',
            '踏平刀山火海之狱',
        );
        $this->wenan = $wenan[rand(0, 4)];
        $this->user_name = $user['user_name'];
        $this->medal = $medal;

        //勋章列表
        $medallist = spClass("m_pg_medals");
        $m_pg_medal_to_user = spClass("m_pg_medal_to_user");
        $medallist_ = $medallist->spPager($this->spArgs('topage', 1), 50)->findAll();
        $this->pager = $medallist->spPager()->getPager();
        $resultArray = array();

        $this->allMedalNum = count($medallist_);
        $this->myMedalNum = 0;

        $this->resultArray = $medallist_;


        $this->display('notice/msgMedal.html');
    }

}