 <?php  
class m_wrap extends spModel
{
	var $pk="wrap_id";
	var $table="wrap";
	
	//�����ڵ���Ŀ����Ϊ���
	public function checkIsValid()
	{
		$wnod_c=spClass("m_wrap_node");
		$wraps=$this->findAll(array("wrap_state"=>"2"));
		foreach($wraps as $rs)
		{
			$wnod_c->checkIsValid($rs["wrap_id"]);
		}
	}
}