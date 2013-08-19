<?php
ini_set("max_execution_time", "1800000");


class tdSystem extends spController
{
	function index()
	{
	}
	
	function showDetails()
	{
		$user=pmUser('all');
		$dId=$this->spArgs('dId');
		$mDemand=spClass('m_demand');
		$rs=spClass('m_tdsystem')->getDetails($dId);
		//dump($rs);
		if($rs['status']==200)
		{
			if($rs['data']['dStatus']=='草稿') pmAlert('需求状态是草稿或已经被退回',-1);;
			$demand=$mDemand->find(array('did'=>$dId));
			if($demand)
			{
				$this->isCreated=true;
			}
			$project=spClass('m_project')->find(array('did'=>$dId));
			$rs['data']['proj_id']=$project['proj_id'];
			if($user['power']==1||$user['power']==0||$user['id']==$project['user_id'])
			{
				$this->isCanModify=true;
			}
			//$rs['dOverView']=htmlspecialchars($rs['dOverView']);
			$this->project=$project;
			$this->rs=$rs['data'];
			$this->display('tdSystem/demandDetails.html');
		}
		else
		{
			if(!$user_id) pmAlert('需求不存在',-1);
		}
	}
	
	function passDemand()
	{
		$user=pmUser('all','html');
		$dId=$this->spArgs('dId');
		$user_id=$this->spArgs('user_id');
		$mDemand=spClass('m_demand');
		if(!$dId) pmAlert('请传入需求ID',-1);
		if(!$user_id) pmAlert('请选择负责人',-1);
		$demand=spClass('m_tdsystem')->getDetails($dId);
		if(!$demand['status']==200)
		{
			pmAlert('该需求不存在');
		}
		$demand=$demand['data'];
		$newDemand=array(
			'did'=>$dId,
			'user_id'=>$user_id,
			'ctime'=>date("Y-m-d H:i:s"),
			'passby'=>$user['name'],
			'dname'=>$demand['dName'],
			'prod_id'=>$this->spArgs('prod_id'),
			'duname'=>$demand['dUName'],
			'prod_name'=>$this->spArgs('prod_name')
		);
		if($mDemand->find(array('did'=>$dId)))
		{
			pmAlert('该需求已经被创建过',-1);
		}
		$rs=spClass('m_tdsystem')->setPass($dId,$this->spArgs('user_name'));
		if($rs['status']==200)
		{
			if($mDemand->create($newDemand))
			{
				spClass('m_message')->init($user['name'].'给您分配了一个项目【'.$demand['dName'].'】，请您进行创建。')->toUser($user_id)->send();
				pmAlert('操作成功,点击关闭窗口','close');
			}
			else
			{
				 pmAlert('系统出现错误');
			}
		}
		else
		{
			pmAlert($rs['data']);
		}
	}
	
	function revoke()
	{
		$user_id=$this->spArgs('user_id');
		$dId=$this->spArgs('dId');
		$comment=$this->spArgs('comment');
		if(!$dId) pmAlert('请传入需求ID',-1);
		if(strlen($comment)<1) pmAlert('请输入原因',-1);
		$rs=spClass('m_tdsystem')->revoke($dId,$comment);
		if($rs['status']==200)
		{
			pmAlert('操作成功,点击关闭窗口','close');
		}
		else
		{
			pmAlert($rs['data']);
		}
	}
}