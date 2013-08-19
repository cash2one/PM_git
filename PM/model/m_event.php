 <?php  
class m_event extends spModel
{
	var $pk="even_id";
	var $table="event";
	
	//getNews
	public function getNews($rowsCount=50)
	{
		$sql="select event.*,product.prod_name,project.proj_name,project.proj_class,project.proj_state,proj_node.pnod_name,user.user_name From event LEFT JOIN project ON project.proj_id=event.proj_id LEFT JOIN product ON project.prod_id=product.prod_id LEFT JOIN proj_node ON proj_node.pnod_id=event.pnod_id LEFT JOIN user ON project.user_id=user.user_id ORDER BY even_time DESC limit 0,".$rowsCount;
		$events=spClass("m_event")->findSql($sql);
		$newRow=array();
		$projClass=getProjClass();
		$projState=getProjState();
		foreach($events as $event)
		{
			$event["stateName"]=$projState[$event["proj_state"]];
			$event["className"]=$projClass[$event["proj_class"]];
			if(count($newRow[$event["proj_id"]])==0) $newRow[$event["proj_id"]]=array();
			array_push($newRow[$event["proj_id"]],$event);
		}
		//dump($newRow);
		return $newRow;
	}
	
	/*
	@ insert event
	@ event_type:0:system | 1:upload | 2:modify | 3:comment
	*/
	public function set($even_type,$even_name,$even_content,$proj_id,$pnod_id=NULL,$user_id=NULL)
	{
		if(!is_numeric($proj_id)) return false;
		$row=array(
					 'even_type'=>$even_type,
					 'even_time'=>date("Y-m-d H:i:s"),
					 'even_content'=>$even_content,
					 'even_name'=>$even_name,
					 'proj_id'=>$proj_id,
					 'pnod_id'=>$pnod_id,
					 'user_id'=>$user_id
					 );
		return($this->create($row));
	}
}