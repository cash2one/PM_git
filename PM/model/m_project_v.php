 <?php  
class m_project_v extends spModel
{
	var $pk="proj_id";
	var $table="project_v";
		
	//ȡ����Ŀ������
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
	
	//ȡ��״ֵ̬
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
	
	//ȡ����Ŀ��id
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
	
	//ȡ�õ���ƻ���Ҫ��ɣ�����δ�ύ������
	public function getUnSumbit($user_id=0)
	{
		$sqlstr=sprintf("select * from project_v where user_id=%d and proj_state=20 and TO_DAYS(proj_end)<=TO_DAYS(NOW())",$user_id);
		$rs=$this->findSql($sqlstr);
		return $rs;
	}
	
	//ȡ����������
	public function getDelay($user_id=0)
	{
		$sqlstr=sprintf("select * from project_v where user_id=%d and proj_state=20 and TO_DAYS(proj_end)<TO_DAYS(NOW())",$user_id);
		$rs=$this->findSql($sqlstr);
		return $rs;
	}
	
	
}