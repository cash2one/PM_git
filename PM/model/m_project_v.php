 <?php  
class m_project_v extends spModel
{
	var $pk="proj_id";
	var $table="project_v";
		
	//取得项目负责人
	public function getUserId($proj_id)
	{
		$condition=array('proj_id'=>$proj_id);
		if($project=$this->find($condition))
		{
			return $project['user_id'];
		}
		else
		{
			return false;
		}
	}
	
	//取得状态值
	public function getState($proj_id)
	{
		$condition=array('proj_id'=>$proj_id);
		if($project=$this->find($condition))
		{
			return $project['proj_state'];
		}
		else
		{
			return false;
		}		
	}
	
	//取得项目集id
	public function getWrapId($proj_id)
	{
		$condition=array('proj_id'=>$proj_id);
		if($project=$this->find($condition))
		{
			return $project['wrap_id'];
		}
		else
		{
			return false;
		}		
	}	
	
	//取得当天计划须要完成，但又未提交的流程
	public function getUnSumbit($user_id=0)
	{
		$sqlstr=sprintf("select * from project_v where user_id=%d and proj_state=20 and TO_DAYS(proj_end)<=TO_DAYS(NOW())",$user_id);
		$rs=$this->findSql($sqlstr);
		return $rs;
	}
	
	//取得延期流程
	public function getDelay($user_id=0)
	{
		$sqlstr=sprintf("select * from project_v where user_id=%d and proj_state=20 and TO_DAYS(proj_end)<TO_DAYS(NOW())",$user_id);
		$rs=$this->findSql($sqlstr);
		return $rs;
	}
	
	
}