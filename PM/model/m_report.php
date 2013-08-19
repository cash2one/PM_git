 <?php  
class m_report extends spModel
{
	var $pk="report_id";
	var $table="report";
	
	//是否有效周报/用户：管理员，作者，抄送人
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