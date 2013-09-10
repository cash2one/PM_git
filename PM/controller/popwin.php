<?php
class popwin extends spController
{
	function data()
	{
		$type=$this->spArgs("type");
		$supper_id=$this->spArgs("supper_id");
		$html=$this->spArgs("html","default");
		$data=array();
		$user=pmUser('all');
		switch($type)
		{
			case "pState":
				$data=getProjState();break;
			case "pClass":
				$data=getProjClass();break;
			//流程分类1
			case "nClass":
				//区分移动组和网站组
				if($user['role']!=7)
					$dataTem=getNodesClass(1);
				else
					$dataTem=getNodesClass(2);
				foreach($dataTem as $key=>$value)
				{
					$data[$key]=$dataTem[$key]['name'];
				}
			//流程分类2
			case "nClass2":
				//区分移动组和网站组
				if($user['role']!=7)
					$dataTem=getNodesClass(1);
				else
					$dataTem=getNodesClass(2);
				$dataTem=$dataTem[$supper_id]['data'];
				foreach($dataTem as $key=>$value)
				{ 
					$data[$key]=$value;
				};
				break;
			//项目等级1
			case "pLevel1":
				$dataTem=getProjLevel();
				foreach($dataTem as $key=>$value)
				{
					$data[$key]=$dataTem[$key]['name'];
				}
				break;
			//项目等级2
			case "pLevel2":
				$dataTem=getProjLevel();
				$dataTem=$dataTem[$supper_id]['data'];
				foreach($dataTem as $key=>$value)
				{ 
					$data[$key]=$value;
				};
				break;
			//职能分类
			case "role":
				$data=getRoleArray();
				unset($data[100]);
				unset($data[101]);
				break;
		}
		$this->rs=$data;
		$this->type="data_".$type;
		//dump($this->rs);
		
		$this->display("public/".$html."_popwin.html");
	}
	
	function pState()
	{
		$type=$this->spArgs("type",false);
		$rs=getProjState();
		if($type)
		{
			$rs["50"]="";$rs["17"]="";$rs["5"]="";$rs["1020"]="";$rs["30"]="";
		}
		$extent[0]["name"]="全部状态";
		$extent[0]["value"]="";
		$this->rs=$rs;
		$this->extent=$extent;
		$this->type="pState_".$type;
		$this->display("public/default_popwin.html");
	}
	
	function products()
	{
		$cProducts=spCLass("m_product")->findAll();
		$this->rs=$cProducts;
		$this->display("public/products_popwin.html");
	}
	
	function pClass()
	{
		$rs=getProjClass();
		$this->rs=$rs;
		$this->type="pClass";
		$this->display("public/default_popwin.html");
	}
	
	function wraps()
	{
		$prod_id=$this->spArgs("supper_id",0);
		$wrap_c=spClass('m_wrap');
		$wrap_list=$wrap_c->findAll(array("prod_id"=>$prod_id));
		$this->type="wraps";
		$this->prod_id=$prod_id;
		$this->wrap_list=$wrap_list;
		$this->display('public/'.$this->type.'_popwin.html');
	}
	
	function users()
	{
		$mUser=spClass("m_user");
		//$role_id=$this->spArgs("role_id");
		//$user_power=$this->spArgs("user_power");
        //加入实习生选项
		$rs=$mUser->findSql('select * from user where user_power<300 order by user_power ASC,user_id ASC');
		$this->type="users";
		$this->users=$rs;
		$this->display('public/users_popwin.html');
	}
}