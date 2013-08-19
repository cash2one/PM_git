 <?php  
class m_meterial extends spModel
{
	var $pk="meterialid";
	var $table="meterial";
		
	public function updateWithArray($dataArray,$proj_id)
	{
		$mProject=spClass('m_project');
		foreach($dataArray as $data)
		{
			if($data['isNew']==1)
			{//新增的
				$check=$mProject->isCanMidify($proj_id);
				if($check['rs']!=1)
				{
					return pmResult(403,$check['des'],'return');
				}
				else
				{
					$data['proj_id']=$proj_id;
					if($check['project']['did'])
					{
						$data['did']=$check['project']['did'];
					}
				}
				$this->create($data);
			}	
			else
			{//修改的
				$check=$mProject->isCanMidify($data['proj_id']);
				if($check['rs']==1)
					$this->update(array('meterialid'=>$data['meterialid']),$data);
			}
		}
		if($check['project']['did'])
			$this->pushToComandSystem($check['project']['did']);
		return pmResult(200,'保存成功','return');
	}
	
	public function pushToComandSystem($did)
	{
		$meterialArray=$this->findAll(array("did"=>$did));
		$rs=spClass('m_tdsystem')->setMaterial($meterialArray[0]['proj_id'],$did,$meterialArray);
	}
}