 <?php
class m_user extends spModel
{
	var $pk="user_id";
	var $table="user";
	
	//登陆成功时写入
	function loginSuccess($user_name,$user_power,$role_id,$user_id,$user_dcode,$power2)
	{
		setcookie("pm_user_name",$user_name);
		setcookie("pm_user_power",$user_power);
		setcookie("pm_role_id",$role_id);
		setcookie("pm_user_id",$user_id);
		setcookie("pm_user_dcode",md5($user_dcode));
		setcookie("pm_power2",$power2);
		setcookie("pm_proving_code",md5($user_name.$user_power.$role_id.$user_id.$power2."nie"));
		return true;
	}
	
	//登陆成功时写入pg部分的cookie
	//juetion 编写
	function loginSuccess_pg($user_id)
	{
		$m_pg_user = spClass("m_pg_user");
		$result = $m_pg_user->find(array(user_id=>$user_id),"","pg_user_id,pg_user_jobid,p_user_id");
        if($result){
            setcookie("pg_user_id",$result['pg_user_id']);
            setcookie("pg_job_id",$result['pg_user_jobid']);
            setcookie("p_user_id",$result['p_user_id']);
            setcookie("pg_proving_code",md5($result['pg_user_id'].$result['pg_user_jobid'].$result['p_user_id']."miao"));
            return true;
        }else{
            return false;
        }

	}
	
	function logout()
	{
		setcookie("pm_user_name",NULL,time()-3600);
		setcookie("pm_user_power",NULL,time()-3600);
		setcookie("pm_role_id",NULL,time()-3600);
		setcookie("pm_user_id",NULL,time()-3600);
		setcookie("pm_proving_code",NULL,time()-3600);
		setcookie("pm_power2",NULL,time()-3600);
		setcookie("pm_user_dcode",NULL,time()-3600);
		
		setcookie("pg_user_id",NULL,time()-3600);
		setcookie("pg_job_id",NULL,time()-3600);
		setcookie("p_user_id",NULL,time()-3600);
		setcookie("pg_proving_code",NULL,time()-3600);
		
		return true;
	}
	
	//用户是否合法
	public function isValid($user_account,$user_pwd)
	{
		$conn=array('user_account'=>$user_account,'user_pwd'=>$user_pwd);
		$user=$this->find($conn);
		if($user['power']>2) return false;
		return $user;
	}
	
	//客户端登陆
	public function loginForWebservice($user_account,$user_pwd)
	{
		if($user_account==''||$user_pwd==''){return false;}
		$user=$this->find(array("user_account"=>$user_account));
		$user_pwd_md5=strtoupper(md5($user_account.strtoupper($user['user_pwd'])));
		$ext = "ER_OIdsw";//附加后缀
		$user_pwd_md5=$user_pwd_md5.$ext;
		if($user_pwd_md5==$user_pwd)
		{
			if($user['power']>2) return false;
			return $user;
		}
		else return false;
	}
	
	//输出本月生日的人[array]
	public function getBirthdayUserWithDate($month,$day=NULL)
	{
		require_once(APP_PATH."/lib/calendarExchage.php");
		$lunar = new Lunar();
		$result=array();
		$now=explode("-",date("Y-m-d"));
		$userlist=$this->findAll('user_power <=2');
		foreach($userlist as $user)
		{
			if($user["user_bdaytype"]==4)
			{
				//农历转公历
				$user["user_bday"] = date("m-d",$lunar->L2S($now[0]."-".$user["user_bday"]));
			}
			$user_bday=explode("-",$user["user_bday"]);
			
			if($day)
			{//如果指定月日
				if($user_bday[0]==$month&&$user_bday[1]==$day)
				{
					array_push($result,array('user_id'=>$user['user_id'],'name'=>$user['user_name'],'date'=>$user['user_bday']));
				}
			}
			else
			{//仅指定月份
				if($user_bday[0]==$month)
				{
					array_push($result,array('user_id'=>$user['user_id'],'name'=>$user['user_name'],'date'=>$user['user_bday']));
				}
			}
		}
		return $result;
	}
	
	//生成生日项目
	public function createBirthdayProjectWithMoth($month)
	{
		if(!is_numeric($month)) return false;
		$month=$month+0;
		$now=getdate();
		$title="帮".$month."月份生日同事庆祝生日";
		//dump($now);
		$lastMonth=$month-1;
		if($lastMonth<1)
		{
			$lastMonth=12;
		}
		$userArray=$this->getBirthdayUserWithDate($lastMonth);
		$userCount=count($userArray);
		$startDateOfMonth=$now['year'].'-'.$month.'-'.$now['mday'].' 09:00:00';
		$endDateOfNode=$now['year'].'-'.$month.'-'.($now['mday']+5).' 18:00:00';
		//dump($userArray);
		if($userCount>0)
		{
			$project=array(
				'proj_name'=>$title,
				'proj_ps'=>'本月生日的同学名单，请到【查询/管理】-【通讯录】处实时查询',
				'prod_id'=>10,//其它
				'proj_date'=>date("Y-m-d H:i:s"),
				'proj_class'=>0,//其它
				'proj_state'=>40,
				'proj_start'=>$startDateOfMonth,
				'proj_end'=>$endDateOfNode,
				'proj_level1'=>10,
				'proj_level2'=>2
			);
			$nodeArray=array();
			if(count($userArray)>1)
			{
				shuffle($userArray);
				$project['user_id']=$userArray[0]['user_id'];
			}
			foreach($userArray as $user)
			{
				array_push($nodeArray,array(
					'pnod_time_s'=>$startDateOfMonth,
					'pnod_time_e'=>$endDateOfNode,
					'pnod_type'=>10,
					'pnod_type2'=>1,
					'user_id'=>$user['user_id'],
					'pnod_name'=>$title,
					'pnod_state'=>$project['proj_state'],
					'pnod_state2'=>1,
					'pnod_day'=>1
				));
			}
			//dump($project);
			//dump($nodeArray);
			return spClass('m_project')->addProject($project,$nodeArray,array(
									'user_name'=>'PM系统',
									'testNode'=>false
									));
		}
	}
	
	//设置动态码
	public function setDCode($user_account,$user_dcode)
	{
		$this->update("user_account='".$user_account."'",array('user_dcode'=>$user_dcode));
	}
	
	//输入user_id数组，取得user_name
	//@param:$userArray 数组形式的user_id,如array(1,2,3);
	//@return:string|如"梁杰康|付振华"
	public function getUserList($userArray,$returnType="string")
	{
		$condition="";
		foreach($userArray as $rs)
		{
			if($condition=="") $condition=$rs;
			else $condition=$condition.",".$rs;
		}
		$condition="SELECT user_id,role_id,user_name,user_nickname from user where user_id in(".$condition.")";
		$users=$this->findSql($condition);
		if($returnType=="string")
		{
			foreach($users as $user)
			{
				if($result=="") $result=$user["user_name"];
				else  $result.="|".$user["user_name"];
			}
		}
		elseif($returnType=="array") return  $users;
		return $result;
		
	}
	
	//检查用户帐号是否存在
	//$user_account string 用户帐号
	//$user_id int 用户id,新建帐号时参数为0,修改时为用户的user_id值
	public function isAccountExit($user_account,$user_id=0)
	{
		$u=$this->find(array("user_account"=>$user_account));
		if($user_id==0)
		{
			if($u)
				return true;
			else
				return false;
		}
		else
		{
			if($u)
			{
				if($u["user_id"]==$user_id)
				{
					return false;
				}
				else
				{
					return true;
				}
			}
			else
			{
				return false;
			}
		}
	}
	
	//检查用户昵称是否存在
	//$user_account string 用户帐号
	//$user_id int 用户id,新建帐号时参数为0,修改时为用户的user_id值
	public function isNicknameExit($user_account,$user_id=0)
	{
		$u=$this->find(array("user_nickname"=>$user_account));
		if($user_id==0)
		{
			if($u)
				return true;
			else
				return false;
		}
		else
		{
			if($u)
			{
				if($u["user_id"]==$user_id)
				{
					return false;
				}
				else
				{
					return true;
				}
			}
			else
			{
				return false;
			}
		}
	}
	
	public function rebuiltJSON()
	{
		$userlist=$this->findSQL("SELECT user_id,role_id,user_power,user_name FROM user where role_id<10 ORDER BY user_power ASC,user_id ASC");
		return $userlist;
		//file_put_contents("cache_data/user_list.js","var user_list=".json_encode($userlist).";");
	}
}