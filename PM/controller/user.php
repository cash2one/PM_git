<?php
function getOld($md)
{
    $_tem=explode("-",$md);
    $oldNum=array("null","一","二","三","四","五","六","七","八","九","十","十一","十二");
    $oldDay=array("null","初一","初二","初三","初四","初五","初六","初七","初八","初九","初十","十一","十二","十三","十四","十五","十六","十七","十八","初九","廿十","廿一","廿二","廿三","廿四","廿五","廿六","廿七","廿八","廿九","三十","三十一");
    return $oldNum[$_tem[0]]."月".$oldDay[$_tem[1]];
}

class user extends spController
{
    function index()
    {

    }


    function apply()
    {
        $this->display('user/apply.html');
    }

    function apply_do()
    {
        $user=spClass("m_user");
        if($user->isAccountExit($this->spArgs('user_account')))
        {
            echo"帐号己经存在！";
            exit();
        }
        //dump($this->spArgs());
        $row=array(
            'user_name'=>$_POST["user_name"],
            'user_account'=>$this->spArgs('user_account'),
            'user_pwd'=>md5($this->spArgs('user_pwd')),
            'user_mail'=>$this->spArgs('user_mail'),
            'role_id'=>$_POST["role_id"],
            'user_power'=>'2',
            'user_birth'=>$this->spArgs('user_birth'),
            'user_dcode'=>rand(10000,99999)
        );
        $user_id=$user->create($row);
        $this->user_account=$this->spArgs('user_account');
        $msg_context="欢迎首次登陆项目管理系统客户端！";
        spClass("m_message")->toUser($msg_context,$user_id);
        $this->display("user/apply_ed.html");
    }

    function add()
    {
        pmAuth("login");
        $user_power=pmUser("power");
        $this->isShowAll=true;
        $this->showUpload=false;
        if($user_power==0)
        {
            $this->role_list=getRoleArray();
            $this->power_list=getPowerArray();
            $this->all_user = spClass("m_user")->findAll(null,null,"user_id,user_name");
        }
        else
        {
            $this->actionType="addByUser";
            $this->role_list=array('100'=>'组外接口人','101'=>'邮件列表');
            $this->power_list=array('100'=>'非系统使用者');
        }
        $this->display('user/edit.html');
    }

    function add_do()
    {
        $manger=pmUser("all","html");
        $row=array(
            'user_name'=>$_POST["user_name"],
            'user_account'=>$this->spArgs('user_account'),
            'user_mail'=>$this->spArgs('user_mail'),
            'role_id'=>$this->spArgs('role_id'),
            'user_power'=>$this->spArgs('user_power',100),
            'user_pwd'=>md5($this->spArgs('user_pwd')),
            'user_cellphone'=>$this->spArgs('user_cellphone'),
            'user_telephone'=>$this->spArgs('user_telephone'),
            'user_bdaytype'=>$this->spArgs('user_bdaytype'),
            'user_info'=>$this->spArgs('user_info'),
            'user_nickname'=>$this->spArgs('user_nickname'),
            'user_bday'=>($this->spArgs('user_month')."-".$this->spArgs('user_day')),
        	'respon_id'=>$this->spArgs('respon_id',0)
        );
        if($manger["power"]!=0)
        {
            if($row["role_id"]<100||$row["user_power"]<10)
                pmResult(403,NULL,"html");
        }
        if($row["user_account"]=="") $row["user_account"]=rand(0,99999999);
        $user=spClass("m_user");
        if($user->isAccountExit($row["user_account"])) {pmResult(403,"帐号己经存在！","html");}
        $user->create($row);
        $this->msg='添加成功！';
        $this->url1=spUrl("user","showlist");
        $this->urltxt1="返回列表";
        $this->display('public/message.html');
    }

    function deleteUser($user_id)
    {
        pmAuth("manager","json");
        spClass("m_user")->delete(array("user_id"=>$_GET["user_id"]));
        pmResult(200,"操作成功！","json");
    }

    function showlist()
    {
        $user_power=pmUser("power","html");
        $userlist=spClass("m_user");

        $_users=$userlist->findAll();

        foreach($_users as &$user)
        {
            if($user["user_bdaytype"]==4) $user["user_bday"]=getOld($user["user_bday"]);
        }
        if($user_power==0) $this->isManager=true;else  $this->isManager=false;
        $this->userlist=$_users;
        $this->pager=$userlist->spPager()->getPager();
        $roles=getRoleArray();
        $roles["2"]="设计";
        $roles["3"]="前端";
        $roles["6"]="动画";
        $roles["100"]="组外";
        $roles["101"]="邮件";
        $this->role_list=$roles;
        $this->power_list=getPowerArray();
        $this->nav_name='user';
        $this->display('user/list.html');
    }

    function edit()
    {
        $user=spClass("m_user");
        $user_id=$this->spArgs('id');
        $isShowAll=true;
        if($user_id=="")
        {
            $user_id=pmUser("id","html");
            $isShowAll=false;
        }
        else
        {
            pmAuth("manager");
        }

        $condition=array('user_id'=>$user_id);
        $user_o=$user->find($condition);

        if($user_o["user_bdaytype"]==4) $user_o["user_bday2"]=getOld($user_o["user_bday"]);
        else $user_o["user_bday2"]=$user_o["user_bday"];
        if($user_o["user_bday"]!="") $user_bmd=explode("-",$user_o["user_bday"]);
        $user_o["user_bmonth"]=$user_bmd[0];
        $user_o["user_bday"]=$user_bmd[1];
        if($user_o["user_bmonth"]=="") $user_o["user_bmonth"]=1;
        if($user_o["user_bday"]=="") $user_o["user_bday"]=1;

        if($user_id==pmUser("id","html"))
            $this->showUpload=true;
        $this->all_user = $user->findAll(null,null,"user_id,user_name");
        $this->isShowAll=$isShowAll;
        $this->user=$user_o;
        $this->role_list=getRoleArray();
        $this->power_list=getPowerArray();
        $this->display('user/edit.html');
    }

    function edit_do()
    {
        //dump($this->spArgs());die();
        $manger=pmUser("all","html");
        $user_power=$manger["power"];
        $user_id=$_GET["user_id"];
        $user=spClass("m_user");
        $condition=array('user_id'=>$user_id);
        $user_o=$user->find($condition);

        if($manger["id"]!=$user_id&&$user_power!=0) die("无权限操作!");

        $row=array(
            'user_name'=>$_POST["user_name"],
            'user_mail'=>$this->spArgs('user_mail'),
            'user_cellphone'=>$this->spArgs('user_cellphone'),
            'user_telephone'=>$this->spArgs('user_telephone'),
            'user_info'=>$this->spArgs('user_info'),
        	'respon_id'=>$this->spArgs('respon_id',0)
        );


        if($user->isAccountExit($this->spArgs('user_account'),$_GET["user_id"]))
        {
            pmResult(400,"帐号已经存在","html");
        }

        if($this->spArgs('user_pwd')!='') $row['user_pwd']=md5($this->spArgs('user_pwd'));
        if($user_o["user_nickname"]=="") $row['user_nickname']=$this->spArgs('user_nickname');
        if($user_o["user_bdaytype"]=="") $row['user_bdaytype']=$this->spArgs('user_bdaytype');
        if($user_o["user_bday"]=="") $row['user_bday']=($this->spArgs('user_month')."-".$this->spArgs('user_day'));
        if($user_power==0)
        {
            if($this->spArgs('user_account')!="") $row['user_account']=$this->spArgs('user_account');
            if($this->spArgs('role_id')!="") $row['role_id']=$this->spArgs('role_id');
            if($this->spArgs('user_power')!="") $row['user_power']=$this->spArgs('user_power');
            $row['user_nickname']=$this->spArgs('user_nickname');
            $row['user_bdaytype']=$this->spArgs('user_bdaytype');
            if($this->spArgs('ismodifyoder')!="") $row['user_bday']=($this->spArgs('user_month')."-".$this->spArgs('user_day'));
        }

        if($row["role_id"]>=100)
        {
            $row["user_power"]=100;
            $row["user_bday"]="";
            $row["user_nickname"]="";
        }

        if($row['user_nickname']!="")
        {
            if($user->isNicknameExit($this->spArgs('user_nickname'),$_GET["user_id"])) exit("呢称己经存在！");
        }

        $user->update($condition,$row);
        $this->msg='修改成功！';
        $this->nav_name='user';
        $this->display('public/message.html');
    }

    function upload_face()
    {
        $this->display('user/userface_upload.html');
    }

    //登陆
    function login()
    {
        $user_account=trim($this->spArgs('user_account'));
        $user_pwd=$this->spArgs('user_pwd');
        if($user_account==''||$user_pwd=='')
        {
            Header("Location: php/message.php?msg=输入数据错误  ！");
            exit();
        }
        $user_pwd=md5($user_pwd);
        $m_user=spClass('m_user');
        if($user=$m_user->isValid($user_account,$user_pwd))
        {
            if($m_user->loginSuccess($user['user_name'],$user['user_power'],$user['role_id'],$user['user_id'],$user['user_dcode'],$user['power2']))
            {
                $isInitPguser=$m_user->loginSuccess_pg($user['user_id']); //juetion:这句是后期PG部分需要添加
                //	$this->jump(spUrl('project_bll','myWork'));   //g7：2013.05.18修改入口为PG的个人页。
                // 第一次登录直接就跳去PG那里。系统的初始化礼包仅在这一次显示，
                // 所以后期控制器mygrowrecord那里不必再刻意判断初始化礼包。
                // 假如未初始化，则mygrowrecord控制器就强跳转到未初始化的界面。
                if($isInitPguser){
                    $this->jump(spUrl('pguser','welcomeInit'));
                }else{
                   // $this->jump(spUrl('pguser','welcomeNotInit'));
                    $this->jump(spUrl('project_bll','myWork'));
                }

            }
            else
                pmResult(400,"数据设置错误。","html");
        }
        else
        {
            pmResult(400,"帐号或密码错误！","html");
            exit();
        }
    }

    function loginOut()
    {
        spClass('m_user')->logout();
        $this->jump(spUrl('main'));
    }

    function work()
    {
        pmAuth("login");
        $this->nav_name='work';
        $this->display('user/work.html');
    }

    //检查帐号是否存在
    //result：1己存在，0不存在
    //ars:string user_account|[int user_id]
    function isAccountExit()
    {
        $user_account=$this->spArgs("user_account");
        if($user_account=="")
        {
            echo 'error';
        }
        $user_id=$this->spArgs("user_id",0);
        if(spClass("m_user")->isAccountExit($user_account,$user_id))
        {
            echo "1";
        }
        else
        {
            echo "0";
        }
    }

    //检查昵称是否存在
    //result：1己存在，0不存在
    //ars:string user_account|[int user_id]
    function isAccountExit2()
    {
        $user_account=$this->spArgs("user_account");
        if($user_account=="")
        {
            echo 'error';
        }
        $user_id=$this->spArgs("user_id",0);
        if(spClass("m_user")->isNicknameExit($user_account,$user_id))
        {
            echo "1";
        }
        else
        {
            echo "0";
        }
    }

    /*
    * 输出本月生日的人json
    */
    function getBirthday()
    {
        require_once(APP_PATH."/lib/calendarExchage.php");
        $lunar = new Lunar();
        $now=explode("-",date("Y-m-d"));
        $month=$now[1];
        $day=$now[2];
        $this_month=array();
        $this_day=array();
        $mUser=spClass("m_user");
        echo("var thisMonth=".json_encode($mUser->getBirthdayUserWithDate($month)).";");
        echo("var thisDay=".json_encode($mUser->getBirthdayUserWithDate($month,$day)));
    }

    function getUserJson()
    {
        echo(json_encode(spClass("m_user")->rebuiltJSON()));
    }

    function power2()
    {
        //全新设计的权限系统说明

        $list=array(
            '1'=>"允许在项目归档时被随机抽取评分；允许主动对已归档项目进行评分。",
            /*
            '2'=>"未定义",
            '4'=>"未定义",
            '8'=>"未定义",
            '16'=>"未定义",
            '32'=>"未定义",
            '64'=>"未定义"
            */
        );
        pmAuth("manager","html");
        $power2Array=pmPower2();
        $userArray=spClass('m_user')->findSql('SELECT user_id,user_name,power2 FROM user where user_power<3 order by power2 DESC,user_id ASC');
        foreach($userArray as &$user)
        {
            $user['power2Array']=array();
            $user['power2notHasArray']=array();
            foreach($power2Array as $key=>$value)
            {
                if(($user["power2"]&$key)==$key)
                {
                    $user["power2Array"][$key]=$value;
                }
            }
        }
        $this->userArray=$userArray;
        $this->power2=$power2Array;
        $this->power2DescribeArray=$list;
        $this->display('user/power_manager.html');
    }

    function getCanUsePower2()
    {
        pmAuth("manager","json");
        $userId=$this->spArgs("user_id");
        $power2=pmPower2();
        $user=spClass('m_user')->find(array("user_id"=>$userId));
        $userOutputArrayOut=array();
        foreach($power2 as $key=>$value)
        {
            if(($user["power2"]&$key)!=$key)
            {
                array_push($userOutputArrayOut,array("key"=>$key,"value"=>$value));
            }
        }
        if(count($userOutputArrayOut)<1) pmResult(201,'没有可选权限');
        pmResult(200,$userOutputArrayOut);
    }

    function addPower2()
    {
        pmAuth("manager","json");
        $userId=$this->spArgs("user_id");
        $power2=$this->spArgs("power2");
        $mUser=spClass('m_user');
        if(!pmPower2($power2)) pmResult(401,'不存在该权限！');
        $user=$mUser->find(array("user_id"=>$userId));
        if($user)
        {
            if(((int)$user["power2"]&$power2)==$power2)
            {
                pmResult(201,'该用户已经授权过该权限');
            }
            else
            {
                if($mUser->runSql("UPDATE user set power2=power2|$power2 WHERE user_id=$userId"))
                {
                    pmResult(200,'授权成功');
                }
                else
                {
                    pmResult(401,'授权失败');
                }
            }
        }
        else
            pmResult(401,'用户不存在！');
    }

    function deletePower2()
    {
        pmAuth("manager","json");
        $userId=$this->spArgs("user_id");
        $power2=$this->spArgs("power2");
        $mUser=spClass('m_user');
        if(!pmPower2($power2)) pmResult(401,'不存在该权限！');
        $user=$mUser->find(array("user_id"=>$userId));
        //dump($user);
        if($user)
        {
            //dump($user["power2"]."|".$power2);
            //dump($user["power2"]&$power2);
            //dump(126&1);
            if(((int)$user["power2"]&$power2)!=$power2)
            {
                pmResult(201,'该用户没有该权限');
            }
            else
            {
                if($mUser->runSql("UPDATE user set power2=power2^$power2 WHERE user_id=$userId"))
                {
                    pmResult(200,'解除授权成功');
                }
                else
                {
                    pmResult(401,'解除授权失败');
                }
            }
        }
        else
            pmResult(401,'用户不存在！');
    }
}
