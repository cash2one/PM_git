 <?php  
//PHP stdClass Object转array
class m_redminesys extends spModel
{
	var $pk="red_did";
	var $table="redminesys";
	
	public function getUnpassList()
	{
		$passPort=pm2td(array(5));
		$resultJson=file_get_contents(TD_URL.'/getlist/5/'.$passPort);
		//dump($resultJson);
		//dump(json_decode($resultJson));
		//$disPassDemandJson=file_get_contents(APP_URL.'index.php?c=tdSystem&a=getList');
		$disPassDemandArray=object_array(json_decode($resultJson));
		//dump($disPassDemandArray);
		if($disPassDemandArray['status']!=200)
		{
			spClass('m_message')->bug('提单系统=>查看列表失败:error=>'.$rs['data'].',state=>5'.',passport=>'.$passPort);
			pmAlert($disPassDemandArray['data'],0,2);
		}
		return $disPassDemandArray['list'];
	}
	
	public function getDetails($dId)
	{
		$passPort=pm2td(array($dId));
		$resultJson=file_get_contents(TD_URL.'/pdetail/'.$dId.'/'.$passPort);
		$resultArray=object_array(json_decode($resultJson));
		if($resultArray['status']!=200) pmAlert($disPassDemandArray['data'],0,2);
		//dump($resultArray);
		return($resultArray);
	}
	

}