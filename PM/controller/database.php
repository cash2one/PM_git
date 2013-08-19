
<?php
class database extends spController
{
	function index()
	{
		echo("数据库处理，额外的功能!");
	}
	
	function recountScore()
	{
		pmAuth("manager","html");
		$mProject=spClass('m_project');
		$mProjScore=spClass('m_proj_score');
		$mNode=spClass('m_proj_node');
		$mNodeScore=spClass('m_node_score');
		$scoreNum=pmScoreToNum();
		//重置项目
		$projectArray=$mProject->findSql('SELECT proj_id,proj_score from project where proj_score>0');
		foreach($projectArray as $p)
		{
			$scoreArray=$mProjScore->findSql("SELECT score FROM proj_score WHERE proj_id=".$p['proj_id']);
			$scoreRowCount=0;
			$scoreTotal=0;
			foreach($scoreArray as $r)
			{
				if($scoreNum[$r["score"]]>0)
				{
					$scoreRowCount++;
					$scoreTotal+=$scoreNum[$r["score"]];
				}
			}
			if($scoreRowCount&&$scoreTotal)
				$mProject->runSql("UPDATE project set proj_score=$scoreTotal/$scoreRowCount WHERE proj_id=".$p['proj_id']);
		}
		//重置流程
		$nodeArray=$mNode->findSql('SELECT pnod_id,pnod_score from proj_node where pnod_score>0');
		foreach($nodeArray as $n)
		{
			$scoreArray=$mNodeScore->findSql("SELECT score FROM node_score WHERE pnod_id=".$n['pnod_id']);
			$scoreRowCount=0;
			$scoreTotal=0;
			foreach($scoreArray as $r)
			{
				if($scoreNum[$r["score"]]>0)
				{
					$scoreRowCount++;
					$scoreTotal+=$scoreNum[$r["score"]];
				}
			}
			if($scoreRowCount&&$scoreTotal)
				$mProject->runSql("UPDATE proj_node set pnod_score=$scoreTotal/$scoreRowCount WHERE pnod_id=".$n['pnod_id']);
		}
		echo("success!");
	}
}
