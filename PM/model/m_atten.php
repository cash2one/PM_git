 <?php 
 /*考勤备忘*/
class m_atten extends spModel
{
	var $pk="atten_id";
	var $table="atten";
	
	public function reach($userId,$lateTime)
	{
		$currentTime=date('H:i:s');
		$currentDate=date('Y-m-d');
		$currentTimeNum=strtotime($currentTime);
		$type=$currentTimeNum>$lateTime?4:0;
		$attenId=$this->create(array("user_id"=>$userId,"type"=>$type,"rtime"=>$currentDate.' '.$currentTime));
		spClass("m_user")->update(array("user_id"=>$userId),array("last_login"=>$currentDate.' '.$currentTime));
		if($currentTimeNum>$lateTime)
		{
			spClass("m_message")->init("考勤备忘",0,0,1,2,APP_URL."tpl/notice/msgbox.html#?c=notice&a=atten&attendId=".$attenId,0)->toUser($userId)->send();
		}
		
	}

}