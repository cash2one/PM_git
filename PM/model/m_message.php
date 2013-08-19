 <?php 
  /*客户端推送*/
class m_message extends spModel
{
	var $pk="msg_id";
	var $table="message";
	/*
	example:向一个项目ID为163的相关人及管理层发送一个基于项目信息：“测试”。
		$m1=spClass("m_message");
		$m1->init("测试",163,0,1);
		$m1->toProject();
		$m1->toManagers();
		$m1->send();
		也可以合并成:
		spClass("m_message")->init("测试",163,0,1)->toProject()->toManagers()->send();
	*/
	public $userList=array();
	public $msg_context;
	public $proj_id;//项目id,但也可以用来存其它id值，比如周报的report_id就用到
	public $pnod_id;//流程id
	public $msg_response;//消息响应类别：{0:不响应,1:请求下一步操作,如审核通过,2:请求完成项目 3：归档时}
	public $push_type;//（对应数据库type）,推送类别{1:一般,2:PMPUSH,3:command}
	public $push_url;//推送链接（项目和流程会自动生成）
	public $sender;//发送人id（默认会读取当前操作者）
	public $msg_type;//$msg_type{0->普通消息,1->项目的消息,2->流程的消息,3->周报}  0,1,2默认会根据参数断
	
	public function init($msg_context,$proj_id=0,$pnod_id=0,$msg_response=0,$push_type=1,$push_url=NULL,$sender=NULL,$msg_type=NULL)
	{
		if($msg_context=="") die("请在在init()中输入信息内容.");
		$this->msg_context=$msg_context;
		$this->proj_id=$proj_id;
		$this->pnod_id=$pnod_id;
		$this->push_type=$push_type;
		$this->push_url=$push_url;
		$this->msg_response=$msg_response;
		$this->sender=$sender;
		$this->msg_type=$msg_type;
		return $this;
	}

	
	//发送信息
	public function send()
	{
		if(count($this->userList)<1) return false;
		if($this->sender===NULL) $this->sender=pmUser("id","html");
		if($this->msg_type==NULL)
		{
			if($this->pnod_id) $this->msg_type=2;
			elseif($this->proj_id&&!$this->pnod_id) $this->msg_type=1;
			else $this->msg_type=0;
		}
		$msg=array(
				   'msg_context'=>$this->msg_context,
				  	'msg_time'=>date("Y-m-d H:i:s"),
				   	'proj_id'=>$this->proj_id,
					'pnod_id'=>$this->pnod_id,
					'msg_type'=>$this->msg_type,
					'user_id'=>$this->sender,
					'msg_response'=>$this->msg_response
				   );
		
		//若不指定项目id，则不构造信息头(当信息内容是项目或流程信息时)
		if($this->proj_id!=0&&$this->msg_type<=2)
		{
			$project=spClass('m_project_v')->find(array("proj_id"=>$this->proj_id));
			$_msg='【'.$project["prod_name"].'-'.$project["proj_name"].'】：'.$msg["msg_context"];		
		}
		
		//添加信息
		$msg_id=$this->create($msg);
		
		//过滤重复的用户
		foreach($this->userList as $k=>$v){if($v!=0)$user_array_final["p".$v]=$v;}
		
		//dump($user_array_final);die();
		
		//添加信息与用户关系
		$mMsgUser=spClass("m_msg_user");
		$_temArray=array(
			"msg_id"=>$msg_id,
			"title"=>$_msg?$_msg:$this->msg_context,
			"type"=>$this->push_type,
			"url"=>$this->push_url
			);
		foreach($user_array_final as $user=>$value)
		{
			$_temArray["user_id"]=$value;
			$mMsgUser->create($_temArray);
		}
		
		//发送完成后将所有参数重置
		$this->init("reset");
		$this->msg_context="";
		$this->userList=array();
		$this->sender=NULL;
		
		return true;
	}	
	
	//添加向产品负责人发信息
	public function toProduct($prod_id)
	{
		$product=spCLass("m_product")->find(array("prod_id"=>$prod_id));
		if($product["prod_uidlist"]!="")
		{
			$user_array=explode("|",$product["prod_uidlist"]);
			$this->userList=array_merge($this->userList,$user_array);
		}
		return $this;
	}
	
	//添加向某个项目所有相关人发消息
	//$isIncPuser[bool]:是否同时发给项目负责人 default:true
	//$isIncProdUser[bool]:是否同时发给产品负责人 default:true
	public function toProject($isIncPuser=true,$isIncProdUser=true)
	{
		if(!is_numeric($this->proj_id)) die("请在init()中传入项目ID");
		$user_array=array();
		$project=spClass("m_project")->find(array("proj_id"=>$this->proj_id));
		//取得项目所有相关人员
		$user_rela=$this->findSql("select user_id from proj_node where proj_id=".$this->proj_id." and user_id<>''");
		foreach($user_rela as $k=>$v){array_push($user_array,$v["user_id"]);}
		//$user_array=array_merge($user_array,$user_rela);
		//加入项目负责人
		if($isIncPuser) array_push($user_array,$project["user_id"]);
		//加入产品负责人
		if($isIncProdUser)
		{
			$user_array2=spCLass("m_product")->getUserArray($project["prod_id"],$fron_str="p");
			//dump($user_array2);
			if($user_array2) $user_array=array_merge($user_array,$user_array2);
		}
		//dump($user_array); die();
		$this->userList=array_merge($this->userList,$user_array);
		return $this;
	}
	
	//添加向某个项目集所有相关人发送消息
	public function toWrap($wrap_id)
	{
		if(!is_numeric($wrap_id)) die("请传入项目集ID");
		$user_array=array();
		$proj_list=spClass("m_project")->findAll("wrap_id=".$wrap_id);
		foreach($proj_list as $proj)
		{
			$user_array[$proj["user_id"]]=$proj["user_id"];
			$pnod_list=spClass("m_proj_node")->findSql("select distinct user_id from proj_node where user_id<>0 and proj_id=".$proj["proj_id"]);
			foreach($pnod_list as $pnod)
			{
				$user_array[$pnod["user_id"]]=$pnod["user_id"];
			}
		}
		//if($msg_context=="")
		//$msg_context="【项目集节点提醒】：".$wnod["prod_name"]." -> ".$wnod["wrap_name"]." -> ".$wnod["wnod_name"]." 今天内须要完成。";
		$this->userList=array_merge($this->userList,$user_array);
		return $this;
	}
	
/**
@ Name:toUser
@ Describe:添加发送指定用户消息
@ param:
	@require
		$user_id (int or array(int,int...)) 用户ID
@ return $this
*/
	public function toUser($user_id)
	{
		if(is_array($user_id))
		{
			foreach($user_id as $aUserId )
			{
				if(is_numeric($aUserId))
					array_push($this->userList,$aUserId);
			}
		}
		else if(is_numeric($user_id))
		{
			array_push($this->userList,$user_id);
		}
		return $this;
	}
	
	//添加向管理层(经理，组长)发消息
	public function toManagers()
	{
		$userList=spClass("m_user")->findAll("role_id=5 or role_id=4");
		$user_array;
		foreach($userList as $user)
		{
			$user_array[$user["user_id"]]=$user["user_id"];
		}
		$this->userList=array_merge($this->userList,$user_array);
		return $this;
	}
	
	//添加向最高管理层发消息
	public function toTopManagers()
	{
		$userList=spClass("m_user")->findAll("role_id=5");
		$user_array;
		foreach($userList as $user)
		{
					$user_array[$user["user_id"]]=$user["user_id"];
		}
		$this->userList=array_merge($this->userList,$user_array);
		return $this;
	}	
	
	
	//添加向某职能组组长发消息
	public function toGrounpLeader($role_id)
	{
		$userList=spClass("m_user")->findAll("role_id=".$role_id." and user_power<=1");
		$user_array;
		foreach($userList as $user)
		{
			$user_array[$user["user_id"]]=$user["user_id"];
		}
		$this->userList=array_merge($this->userList,$user_array);
		return $this;
	}
	
	//添加向某职能组发消息
	public function toGrounp($role_id)
	{
		$userList=spClass("m_user")->findAll("role_id=".$role_id);
		$user_array;
		foreach($userList as $user)
		{
			$user_array[$user["user_id"]]=$user["user_id"];
		}
		$this->userList=array_merge($this->userList,$user_array);
		return $this;
	}	
	
	
	//添加取得某个用户的所有消息
	public function getMsg($user_id)
	{
		$sqlstr="select * from msg_user where isnew=1 and user_id=".$user_id;
		$rs=$this->findSql($sqlstr);
		$this->query("delete from msg_user where user_id=$user_id and type in(2,3)");
		$this->query("update msg_user set isnew=0 where user_id=$user_id");
		return $rs;
	}
	
	//
	public function bug($msg)
	{
		$this->init($msg)->toUser(4)->send();
	}
}