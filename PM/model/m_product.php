<?php  
class m_product extends spModel
{
	var $pk="prod_id";
	var $table="product";
	
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
	
	public function reflash()
	{
		$products=$this->findAll();
		$productForDemandSystem=array();
		$html='';
		foreach($products as $product)
		{
			if($product["prod_Url"])
			{
				$html.='<li><a class="pmLink" href="'.$product["prod_Url"].'" target="_blank">'.$product["prod_name"].'</a></li>';
			}
			array_push($productForDemandSystem,array('prod_id'=>$product['prod_id'],'prod_name'=>$product['prod_name']));
		}
		require_once('extensions/HttpClient.class.php');
		$pageContents = HttpClient::quickPost(TD_URL.'/slim/code/updateProd',array('data'=>json_encode($productForDemandSystem)));
		pmLogs("productTestUrl.html",$html,false,"tmp/cache/",true);
	}
}