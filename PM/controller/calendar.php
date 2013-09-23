<?php
class calendar extends spController
{
	function index()
	{
		$proj_id=$this->spArgs('projId');
		$wrap_id=$this->spArgs('wrapId');
		$role_id=$this->spArgs('roleId');
		$user_id=$this->spArgs('userId');
		$showWrapSection=$this->spArgs('showWrapSection',0);
		$showProjSection=$this->spArgs('showProjSection',0);
		$stateSelect=$this->spArgs('select');//99:正在进行
		$type=$this->spArgs('type','0');//用于显示的对像string "project"->项目 "node"->流程,"nodeInProject"->项目中的流程,"mix"->混合项目和流程 "work"->工作查询}

		$dateCurrent=date('Y-m-d');
		
		if($type=='node'||$type=='nodeInProject')
		{
			$rs=json_encode(getPnod($proj_id,$user_id,$type,$stateSelect));
			echo "var nodes=".$rs.";";
		}
		elseif($type=='project')
		{
			$rs=json_encode(getProj($wrap_id,$user_id,$stateSelect,$proj_id));
			echo "var nodes=".$rs.";";
		}
		elseif($type=='mix')
		{
			echo"var nodes=".json_encode(work($wrap_id,$user_id,$stateSelect,$proj_id,$user_id)).";";
		}
		elseif($type=='work')
		{
			echo"var nodes=".json_encode(work($wrap_id,$user_id,$stateSelect,$proj_id,$user_id)).";";
		}
		
		if($showWrapSection)
		{
			if($wrap_id=="") die("error params need wrapId");
			echo "var wrapSections=".json_encode(getWrap($wrap_id)).";";
		}
		
		if($showProjSection)
		{
			if($proj_id=="") die("error params : need projId");
			echo "var projectSections=".json_encode(getSections($proj_id)).";";
		}
		
		echo "var dateCurrent='".$dateCurrent."';";
		die();
	}
	
}


//取得适合显示的项目集数组
function getWrap($wrap_id)
{
	$mWnod=spClass('m_wrap_node');
	$sql="SELECT wnod_id AS nodeId,wnod_name AS title,wnod_state AS state,wnod_time AS start FROM wrap_node where wrap_id=$wrap_id";
	$wnod=$mWnod->findSql($sql);
	return $wnod;
}

//取得适合显示的项目节点数组
function getSections($proj_id)
{
	$mProject=spClass('m_project');
	$cProject1=$mProject->findSql("SELECT proj_id AS nodeId,proj_name AS title,proj_state AS state,proj_start AS start,proj_start AS end FROM project where proj_id=$proj_id");
	$cProject1[0]["title"]=date('H',strtotime($cProject1[0]["start"]))."时 项目启动";
	$cProject2=$mProject->findSql("SELECT proj_id AS nodeId,proj_name AS title,proj_state AS state,proj_end AS start,proj_end AS end FROM project where proj_id=$proj_id");
	$cProject2[0]["title"]=date('H',strtotime($cProject2[0]["start"]))."时 项目上线";
	return array_merge($cProject1,$cProject2);
}


//构造适合显示项目进度条的数组
function getProj($wrap_id,$user_id,$stateSelect=0,$proj_id=0)
{
		$proj_c=spClass('m_project_v');
		//构造查询条件
		$sql="SELECT proj_id AS nodeId,proj_name AS title,prod_name AS title2,proj_psdUrl as nodeType,proj_state AS state,user_name AS user,proj_start AS start,proj_end AS end,proj_endDate AS final,user_id AS userId FROM project_v";
		$order=" order by start ASC";
		
		$conn="";
		if(is_numeric($wrap_id)&&$wrap_id!=0)
			($conn=="")? $conn.=" wrap_id=".$wrap_id : $conn.=" AND wrap_id=".$wrap_id;
		if($user_id!="")
			($conn=="")? $conn.=" user_id in($user_id)": $conn.=" AND user_id in($user_id)";
		if($proj_id!=""&&$conn=="") $conn.=" proj_id=$proj_id ";
		switch($stateSelect)
		{
			case 99:$conn.=" and proj_state in(20,30,40)";break;
			default:$conn.=" and proj_state <>50";break;
		}
		if($conn!="") $sql.=" WHERE ";
		$plist=$proj_c->findSql($sql.$conn.$order);
		//dump($sql.$conn.$order);
		$stateList=getProjState();
		foreach($plist as &$pl)
		{
			$pl["stateName"]=$stateList[$pl["state"]];
			$pl["title"]="【".$pl["title2"]."】".$pl["title"];
		}
		return $plist;
}


//构造适合显示流程进度条的数组
function getPnod($proj_id,$user_id,$type,$stateSelect=100)
{
		$proj_c=spClass('m_proj_node_v');
		//构造查询条件
		$sql="SELECT pnod_id AS nodeId,pnod_name AS title,proj_psdUrl as nodeType,proj_name AS title2,prod_name AS title3,pnod_state AS state,user_name AS user,pnod_time_s AS start,pnod_time_e AS end,pnod_time_r AS final,user_id AS userId,proj_id AS pId,res_user_id AS puserId FROM proj_node_v";
		$conn="";
		$order=" order by start ASC";

		if(is_numeric($proj_id))
			($conn=="")? $conn.=" proj_id=$proj_id": $conn.=" AND proj_id=$proj_id";
				
		if($user_id!="")
		{
				//如果是混合查询
				if($type=="mix") ($conn=="")? $_conn=" (user_id in($_user_id) or res_user_id in($user_id))": $_conn=" AND  (user_id in($_user_id) or res_user_id in($user_id))";
				else ($conn=="")? $conn.=" user_id in($user_id)": $conn.=" AND user_id in($user_id)";
		}
		
		$conn2="";
		switch($stateSelect)
		{
			case 99:$conn2.="pnod_state in(17,18,20,30)";break;
			case 1000:break;
		//	default:$conn2.="pnod_state in(15,17,20,30)";break;   剔除完成了的项目
            default: $conn2.="pnod_state in(15,17,18,20,30)";break;
		}
		if($conn!=""&&$conn2!="") $conn2=" AND ".$conn2;
		if($conn!=""||$conn2!="") $sql.=" WHERE ";
		//dump($sql.$conn);
    //    return $sql.$conn.$conn2.$order;
    /*      测试返回的查询语句   */
		$plist=$proj_c->findSql($sql.$conn.$conn2.$order);
		$stateList=getPnodState();
		$m_pron_check = spClass("m_pron_check");//juetion 查找前置节点
		foreach($plist as &$pl)
		{
			if($type=="nodeInProject")
				$pl["title"]=$pl["title"];
			else
				$pl["title"]="【".$pl["title3"]."】".$pl["title2"]."-".$pl["title"];
				
			$pl["stateName"]=$stateList[$pl["state"]];
            if($type!="mix"){
                //20130710志鹏 个人查询界面先不显示前置流程
                //juetion 添加 start  用于获取前置节点的名称
                $beforeNodes = $m_pron_check->findSql("select pn.pnod_name from proj_node pn where
                        pn.pnod_id in (select pc.p_pron_id from pron_check pc where
                        pc.pron_id = ".$pl["nodeId"]." )");

                $pl["beforeNodes"] = "";
                if($beforeNodes)
                {
                    $pl["beforeNodes"] = " --前置流程：";
                }
                foreach ($beforeNodes as $rs)
                {
                    $pl["beforeNodes"] = $pl["beforeNodes"].$rs["pnod_name"].";";
                }

                //juetion 添加 end

            }
		}
		return $plist;
   /* */
}


//type=work
function work($wrap_id,$user_id,$stateSelect,$proj_id,$user_id)
{
	$user=spClass("m_user")->findSql("select user_id AS userId,user_name AS user from user where user_id in($user_id) or respon_id in($user_id)");
	$projects=getProj($wrap_id,$user_id,$stateSelect,$proj_id);
	$nodes=getPnod($proj_id,$user_id,"mix",0);
   // dump($projects);
  //  dump($nodes);

	$_user=array();
	//dump($nodes);
	$i=0;
	$_tem;
	
	//将流程装入项目
	foreach($nodes as $node)
	{
			foreach($projects as &$p)
			{
				if($node["pId"]==$p["nodeId"]||$node["pId"]==$p[0]["nodeId"])
				{
					if($p["nodeId"]!="")
					{
						$_tem=$p;$p=array();$p["0"]=$_tem;
					}
					array_push($p,$node);
				}
			}
	}
	
	foreach($user as &$u)
	{
		if($u["userId"]!="")
		{
			$_tem=$u;$u=array();$u["0"]=$_tem;
		}
	}
	
	//dump($projects);
	
	//将项目装入每个人
	foreach($projects as $p2)
	{
		foreach($user as &$u)
		{
			if($u[0]["userId"]==$p2[0]["userId"])
			{
				array_push($u,$p2);
			}
		}
	}
	
	//每个人装入不是自己创建的项目面里自己负责的流程
	foreach($user as &$u2)
	{
		foreach($nodes as $node)
		{
			
			if($node["userId"]==$u2[0]["userId"]&&$node["puserId"]!=$u2[0]["userId"])
				array_push($u2,$node);
		}
	}
	
	//dump($user);
	return $user;

}
