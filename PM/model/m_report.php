 <?php  
class m_report extends spModel
{
	var $pk="report_id";
	var $table="report";
	
	//�Ƿ���Ч�ܱ�/�û�������Ա�����ߣ�������
	//return report/false
	public function isValidUser($reportId,$user)
	{
		$report=$this->find(array('report_id'=>$reportId));
		if(!$report) return false;
		if($user['power']==0) return $report;
		if($report['user_id']==$user['id']) return $report;
		$reportUserRows=spClass("m_reportUser")->find(array("report_id"=>$reportId,"user_id"=>$user['id']));
		if($reportUserRows) 
			return $report;
		else
			return false;
	}
}