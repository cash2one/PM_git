 <?php  
//PHP stdClass Object转array
class m_tdsystem extends spModel
{
	var $pk="did";
	var $table="demand";
	
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
	
	public function revoke($dId,$comment)
	{
		$passPort=pm2td(array($dId,$comment));
		$rs=object_array(json_decode(file_get_contents(TD_URL.'/setreturn/'.$dId.'/'.$comment.'/'.$passPort)));
		if($rs['status']!=200){spClass('m_message')->bug('提单系统=>项目退回失败:error=>'.$rs['data'].',did=>'.$dId.',comment=>'.$comment.',passport=>'.$passPort);}
		return $rs;
	}
	
	public function setPass($dId,$uname)
	{
		$passPort=pm2td(array($dId,$uname));
		$rs=object_array(json_decode(file_get_contents(TD_URL.'/setpass/'.$dId.'/'.$uname.'/'.$passPort)));
		if($rs['status']!=200){spClass('m_message')->bug('提单系统=>项目通过失败:error=>'.$rs['data'].',did=>'.$dId.',uname=>'.$uname.',passport=>'.$passPort);}
		return $rs;
	}
	
	public function setFinish($dId)
	{
		$passPort=pm2td(array($dId));
		$rs=object_array(json_decode(file_get_contents(TD_URL.'/setover/'.$dId.'/'.$passPort)));
		if($rs['status']!=200){spClass('m_message')->bug('提单系统=>项目完成失败:error=>'.$rs['data'].',did=>'.$dId.',proj_id=>'.$proj_id.',passport=>'.$passPort);}
		return $rs;
	}
	
	public function setMaterial($proj_id,$dId,$data)
	{
		require_once('extensions/HttpClient.class.php');
		if(!is_numeric($proj_id))
			return pmResult(500,'项目id不能为空','return');
		if(!is_numeric($dId))
			return pmResult(500,'提单id不能为空','return');
			
		$postData=array(
				'proj_id'=>$proj_id,
				'did'=>$dId,
				'data'=>$data
		);
		$postData=json_encode($postData);
		$passPort=pm2td(array($postData));
		$pageContents = HttpClient::quickPost(TD_URL.'/setMaterial',array('data'=>$postData,'passport'=>$passPort));
		$rs=object_array(json_decode($pageContents));
		if($rs['status']!=200){spClass('m_message')->bug('提单系统=>数材同步失败:error=>'.$rs['data'].',data=>'.json_encode($postData).',passport=>'.$passPort);}
		return $rs;
	}
}