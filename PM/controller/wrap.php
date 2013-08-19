<?php
class wrap extends spController
{
	function index()
	{
		$rows=spClass("m_wrap_v");
		$sort="wrap_state DESC,wrap_id DESC";
		if(pmUser("power")<2) $this->isManager=true;else  $this->isManager=false;
		$this->rows=$rows->spPager($this->spArgs('topage',1),50)->findAll("",$sort);
		$this->pager=$rows->spPager()->getPager();	
		$this->state_list=getWrapState();
		$this->nav_name='wrap';
		$this->display('project/wraps.html');
	}
	
	//项目某个表格视图
	function showWrap()
	{
		$wrap_id=$this->spArgs('wrapId');
		if(!$wrap_id) die("no params");
		$this->wrap=spClass('m_wrap_v')->find(array('wrap_id'=>$wrap_id));
		$projClass=getProjClass();
		$mProject=spClass('m_project_v');
		$mNode=spClass('m_proj_node_v');
		$condition="wrap_id=$wrap_id";
		$rows_rs=$mProject->findAll($condition);
		$row_nodes=$mNode->findAll("wrap_id=$wrap_id");
		foreach($rows_rs as &$rs)
		{
			$rs["proj_class"]=$projClass[$rs["proj_class"]];
			foreach($row_nodes as $row_node)
			{
				if($rs["proj_id"]==$row_node["proj_id"])
				{
					if(!$rs["nodes"]) $rs["nodes"]=array();
					array_push($rs["nodes"],$row_node);
				}
			}
		}
		$this->myProjects=$rows_rs;
		$this->state_list=getPnodState();
		$this->display('project/wrap.html');
	}
	
	
	
	//项目集添加页
	function add()
	{
		pmAuth("login");
		$plist=spClass("m_product");
		$this->plist=$plist->findAll();
		$this->nav_name='wrap';
		$this->display('project/wrapAdd.html');
	}
	
	//插入项目集及节点
	function addDo()
	{
		pmAuth("login");
		//dump($this->spArgs());die();
		$nodelist=array();
		//数组的长度
		$nlength=$this->spArgs('nodecount');
		$wrap_row=array(
					  'wrap_name'=>$this->spArgs('wrap_name'),
					  'wrap_mail'=>$this->spArgs('wrap_mail'),
					  'prod_id'=>$this->spArgs('prod_id'),
					  'wrap_date'=>date("Y-m-d H:i:s"),
					   );
		//dump($wrap_row);
		$wrap=spClass('m_wrap');
		//插入项目集，并取得其主键
		if(false==$wrap_id=$wrap->create($wrap_row))
		{
			$this->msg='操作失败！';
			$this->display('public/message.html');
			exit();
		}
		//构造插入项目集节点数组
		for($i=0;$i<(int)$nlength;$i++)
		{
			$nodelist['wrap_node'.$i]['wrap_id']=$wrap_id;
			$nodelist['wrap_node'.$i]['wnod_time']=$this->spArgs('wnod_time_'.$i);
			$nodelist['wrap_node'.$i]['wnod_name']=$this->spArgs('wnod_name_'.$i);
		}
		$nodes=spClass('m_wrap_node');
		//插入项目集节点
		$nodes->insertlist($nodelist);
		pmAlert("添加成功!",spUrl('wrap'));
	}	
	
	function edit()
	{
		pmAuth("login");
		$plist=spClass("m_product");
		$this->plist=$plist->findAll();
		$wrap=spClass('m_wrap_v');
		$condition=array('wrap_id'=>$this->spArgs('wrap_id'));
		$this->wrap=$wrap->find($condition);
		$mWnod=spClass('m_wrap_node');
		$wnodes=$mWnod->findAll(array("wrap_id"=>$this->spArgs('wrap_id')));
		if($wnodes)
			$this->wnods=json_encode($wnodes);
		else
			$this->wnods="null";
		//dump($this->wnods);
		$this->nav_name='wrap';
		$this->wrap_state=getWrapState();
		$this->display('project/wrapEdit.html');
	}
	
	
	function editDo()
	{
		pmAuth("login");
		$wrap_c=spClass('m_wrap');
		$condition=array('wrap_id'=>$this->spArgs('wrap_id'));	
		$row=array(
				   'wrap_name'=>$this->spArgs('wrap_name'),
				   'wrap_mail'=>$this->spArgs('wrap_mail'),
				   'wrap_state'=>$this->spArgs('wrap_state'),
				   'prod_id'=>$this->spArgs('prod_id')
				   );
		$wrap_c->update($condition,$row);
		pmAlert("修改成功!",spUrl('wrap'));
		//$this->jump(spUrl('wrap','edit',array('wrap_id'=>$this->spArgs('wrap_id'))));
	}	
	
	function wrap_del()
	{
		pmAuth("login");
		$wrap_id=$this->spArgs('wrap_id');
		if($wrap_id=='') die('parameter cant be null.');
		if(spClass('m_wrap')->deleteByPk($wrap_id))
		{
			pmResult("1","操作成功！");
		}
		else
		{
			pmResult("0","操作失败！");
		}
		
	}
	
	function wnodAddDo()
	{
		pmAuth("login");
		$wnod_c=spClass('m_wrap_node');
		$row=array(
				   'wrap_id'=>$this->spArgs('wrap_id'),
				   'wnod_name'=>$this->spArgs('wnod_name'),
				   'wnod_time'=>$this->spArgs('wnod_time')
				   );
		if($row["wnod_id"]=$wnod_c->create($row))
			pmResult("1","[".json_encode($row)."]");
		else
			pmResult("0","添加失败");  
	}
	
	function wnodDel()
	{
		pmAuth("login");
		$wnod_id=$this->spArgs('wnod_id');
		if($wnod_id=='') die('parameter cant be null.');
		if(spClass('m_wrap_node')->deleteByPk($wnod_id))
		{
			pmResult("1","删除成功！");
		}
		else
		{
			pmResult("0","删除失败！");
		}
	}
	
	function wnodSave()
	{
		pmAuth("login");
		//dump($this->spArgs());
		$row=array(
					'wnod_name'=>$this->spArgs('wnod_name'),
					'wnod_time'=>$this->spArgs('wnod_time')
					);
		$con=array('wnod_id'=>$this->spArgs('wnod_id'));
		if($aa=spClass('m_wrap_node')->update($con,$row))
		{
			pmResult("1","保存成功！");
		}
		else
		{
			pmResult("0","保存失败！");
		}		
	}
}


