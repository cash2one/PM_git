 <?php  
class m_node_score extends spModel
{
	var $pk="node_score_id";
	var $table="node_score";

	public function setScore($score,$nodeId,$comment)
	{
		$userId=pmUser("id");
		if(!$userId) return pmResult(403,NULL,'return');
		$scoreNum=pmScoreToNum($score);
		if(!is_numeric($scoreNum)) return pmResult(400,'请选择正确的分数','return');
		//读取流程
		$mPnod=spClass("m_proj_node");
		$node=$mPnod->find(array("pnod_id"=>$nodeId));
		if(!$node) return pmResult(400,'流程不存在','return');
		$newNodeScore=array(
			"pnod_id"=>$nodeId,
			"proj_id"=>$node["proj_id"],
			"user_id"=>$userId,
			"score"=>$score,
			"comment"=>$comment,
			"time"=>date("Y-m-d H:i:s"),
		);
		$nodeScore=$this->find(array("pnod_id"=>$nodeId,"user_id"=>$userId));
		if(!$nodeScore)
		{
			if($this->create($newNodeScore))
			{
				$newScore;
				if($node["pnod_score"]==NULL)
					$newScore=$scoreNum;
				else
					$newScore=($node["pnod_score"]+$scoreNum)/2;
				if($mPnod->update(array("pnod_id"=>$nodeId),array("pnod_score"=>$newScore)))
					return pmResult(200,NULL,'return');
				else
					return pmResult(500,'数据记录成功，但流程分数更新失败，请联系管理员，并提供ID号：'.$nodeId,'return');
			}
			else
				return pmResult(500,'数据保存不成功，请联系管理员','return');
		}
		else
		{
			return pmResult(400,'不能重复打分','return');
		}
	}
}