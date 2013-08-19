 <?php
class m_proj_node_v extends spModel
{
	var $pk="pnod_id";
	var $table="proj_node_v";

	//状态2设置操作
	public function setState2($id,$state)
	{
		$condition=array('pnod_id'=>$id);
		$row=array('pnod_state2'=>$state);		
		return $this->update($condition,$row);
	}	
	
	//取得一个项目集，所有流程中最早开始的年份
	public function getWrapStartYear($wrap_id)
	{
		$sql='select YEAR(pnod_time_s) as pnod_year from proj_node_v where wrap_id='.$wrap_id.' order by pnod_year ASC limit 0,1';
		$rs=$this->findSql($sql);
		if(count($rs)==0)
			return false;
		else
			return $rs[0]['pnod_year'];
	}
	
	//取得一个项目集，所有流程中最早开始的月份
	public function getWrapStartMonth($wrap_id)
	{
		$sql='select Month(pnod_time_s) as pnod_month from proj_node_v where wrap_id='.$wrap_id.' order by pnod_month ASC limit 0,1';
		$rs=$this->findSql($sql);
		if(count($rs)==0)
			return false;
		else
			return $rs[0]['pnod_month'];
	}	
	
	//取得一个项目，所有流程中最X始的时间
	//type int:0=start|1=end
	public function getLimitsTime($type,$wrap_id=0,$proj_id=0,$role_id=0,$res_user_id=0,$user_id=0,$seletor="")
	{
		$condition="";
		
		if($wrap_id!=0)
			$condition=$condition." and wrap_id=".$wrap_id;
		elseif($proj_id!=0)
			$condition=$condition." and proj_id=".$proj_id;
			
		if($role_id!=0)
			$condition=$condition." and role_id=".$role_id;		

		if($res_user_id!=0)
			$condition=$condition." and res_user_id=".$res_user_id;			
		elseif($user_id!=0)
			$condition=$condition." and user_id=".$user_id;
			
		if($seletor!="")
			$condition=$condition." and (".$seletor.")";			
			
		if($type==0)
			$sql='select pnod_time_s as limitstime from proj_node_v where pnod_time_s <>"" '.$condition.' order by limitstime ASC limit 0,1';
		elseif($type==1)
			$sql='select pnod_time_e as limitstime from proj_node_v where pnod_time_e <>"" '.$condition.' order by limitstime DESC limit 0,1';
		else
			return false;
			
		$rs=$this->findSql($sql);
		
		if(count($rs)==0)
			return false;
		else
		{
			$tem_d_s=date('d',strtotime($rs[0]['limitstime']));
			$rs_array["full"]=$rs[0]['limitstime'];
			if($rs[0]['limitstime']!="")
			{
				$rs_array["y"]=date('Y',strtotime($rs[0]['limitstime']));
				$rs_array["m"]=date('m',strtotime($rs[0]['limitstime']))+0;
				$rs_array["d"]=date('d',strtotime($rs[0]['limitstime']))+0;
			}
			else
				return false;
			return $rs_array;
		}
	}
	
	//取得还没有完成的流程
	public function getUnFinish($user_id=0)
	{
		$sqlstr=sprintf("select * from proj_node_v where user_id=%d and pnod_state=20",$user_id);
		$rs=$this->findSql($sqlstr);
		return $rs;
	}	
	

	//取得当天计划须要完成，但又未提交的流程
	public function getUnSumbit($user_id=0)
	{
		$sqlstr=sprintf("select * from proj_node_v where user_id=%d and pnod_state=20 and TO_DAYS(pnod_time_e)<=TO_DAYS(NOW())",$user_id);
		$rs=$this->findSql($sqlstr);
		return $rs;
	}
	
	//取得延期流程
	public function getDelay($user_id=0)
	{
		$sqlstr=sprintf("select * from proj_node_v where user_id=%d and pnod_state=20 and TO_DAYS(pnod_time_e)<TO_DAYS(NOW())",$user_id);
		$rs=$this->findSql($sqlstr);
		return $rs;
	}
}