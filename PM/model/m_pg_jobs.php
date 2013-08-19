<?php  
class m_pg_jobs extends spModel
{
	var $pk="job_id";
	var $table="pg_jobs";
	
	//取得一个产品的负责人列表
	//@param:$prod_id[int]
	//@param:$fron_str[string]|返回数组的前缀，比如$fron_str="p",array("p4"=>"4");
	public function getUserArray($prod_id,$fron_str="")
	{
		$product=$this->find(array("prod_id"=>$prod_id));
		if(!$product["prod_uidlist"]) return false;
		$user_array=explode("|",$product["prod_uidlist"]);
		if($fron_str=="") return $user_array;
		else
		{
			foreach($user_array as $rs)
			{
				$user_array2[$fron_str.$rs]=$rs;
			}
			
			return $user_array2;
		}
	}
	

}