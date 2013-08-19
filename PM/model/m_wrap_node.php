 <?php  
class m_wrap_node extends spModel
{
	var $pk="wnod_id";
	var $table="wrap_node";
	
	public function insertlist($nodes)
	{

		foreach($nodes as $node)
		{
			$this->create($node);
		}
	}
	
	//ȡ��һ����Ŀ����Xʱ��
	//$type:string "s"�����翪ʼ��ʱ��;"e":��ٽ�����ʱ��;
	public function getExtTime($wrap_id,$type)
	{
		if($type=="s")
			$sql='select wnod_time from wrap_node where wrap_id='.$wrap_id.' order by wnod_time ASC limit 0,1';
		else if($type=="e")
			$sql='select wnod_time from wrap_node where wrap_id='.$wrap_id.' order by wnod_time DESC limit 0,1';
		$rs=$this->findSql($sql);
		if(count($rs)==0)
			return false;
		else
			return $rs[0]['wnod_time'];
	}	
	
	//���ָ����Ŀ�����������ڵ���Ŀ����Ϊ���
	public function checkIsValid($wrap_id)
	{
		$sql=sprintf("update wrap set wrap_state=1 where wrap_id =(select wrap_id from wrap_node where wrap_id=%d and (select TO_DAYS(wnod_time) from wrap_node where wrap_id=%d order by wnod_time DESC limit 0,1)<TO_DAYS(NOW()) limit 0,1)",$wrap_id,$wrap_id);
		$this->findSql($sql);
	}
}