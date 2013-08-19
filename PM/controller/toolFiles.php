<?php
function pmGetFilesSql($spid,$sd1,$sd2,$uid)
{
		if($sd1!=""||$sd2!="")
			if(!pmIsDate($sd1)||!pmIsDate($sd2)){pmAlert('请输入正确日期范围',-1);};
		if($spid)
			if(!is_numeric($spid)) pmAlert('产品ID错误',-1);
		if($uid)
			if(!is_numeric($uid)) pmAlert('用户ID错误',-1);
		$sql="SELECT files.*,user.user_name AS uname FROM files LEFT JOIN user ON user.user_id=files.user_id LEFT JOIN project ON files.proj_id=project.proj_id LEFT JOIN product ON project.prod_id=product.prod_id";
		$where="role_id=2";
		if($spid) $where.=($where==NULL?"":" AND ")." product.prod_id=$spid";
		if($uid)  $where.=($where==NULL?"":" AND ")."files.user_id=$uid";
		if($sd1)  $where.=($where==NULL?"":" AND ")."(file_time_c>='$sd1 00:00:00' AND file_time_c<='$sd2 00:00:00')";
		if($where) $sql=$sql." WHERE ".$where;
		return $sql;
}

class toolFiles extends spController
{
	function index()
	{
		pmAuth("login","html");
		$this->display('toolFiles/index.html');
	}
	
	function show()
	{
		pmAuth("login","html");
		$spid=$this->spArgs("spid");
		$sd1=$this->spArgs("sd1");
		$sd2=$this->spArgs("sd2");
		$uid=$this->spArgs("uid");
		$mFiles=spClass("m_files");
		$sql=pmGetFilesSql($spid,$sd1,$sd2,$uid);
		$files=$mFiles->spPager($this->spArgs('p',1),15)->findSql($sql);
		$this->pager=$mFiles->spPager()->getPager();
		$this->isShowResult=true;
		$this->files=$files;
		$this->spid=$spid;
		$this->sd1=$sd1;
		$this->sd2=$sd2;
		$this->uid=$uid;
		$this->spn=$this->spArgs('spn');
		$this->uname=$this->spArgs('uname');
		$this->display('toolFiles/index.html');
	}
	
	function packDownload()
	{
		if(file_exists("tmp/zipcache/writting.txt")) 
		{
			$lastBuild=file_get_contents("tmp/zipcache/writting.txt");
			pmResult("500","有另一个进程正在压缩，请稍后再试。","html");
		}
		pmLogs("writting.txt",date("Y-m-d H:i:s"),false,"tmp/zipcache/",true);
		$user=pmUser("all","html");
		echo("正在生成...");
		require_once('extensions/pclzip.php');
		$spid=$this->spArgs("spid");
		$sd1=$this->spArgs("sd1");
		$sd2=$this->spArgs("sd2");
		$uid=$this->spArgs("uid");
		$mFiles=spClass("m_files");
		$sql=pmGetFilesSql($spid,$sd1,$sd2,$uid);
		$files=$mFiles->findSql($sql);
		$zipUrl="tmp/zipcache/archive".$user["id"].".zip";
		$zip = new PclZip($zipUrl);
		$fileList=NULL;
		if(count($files)>500&&$user["id"]!=4) pmResult("500","数量超过500个，将占用大量资源，请联系JK进行操作","html");
		foreach($files as $f)
		{
			if(file_exists($f["file_url"]))
				$fileList.=$fileList==NULL?$f["file_url"]:",".$f["file_url"];
			else
				echo("<br />文件不存在，被果断抛弃：".$f["file_url"]);
		}
		//dump($fileList);
		$rs=$zip->create($fileList,PCLZIP_OPT_REMOVE_ALL_PATH);
		//dump($rs);
		
		if($rs)
		{
			$this->jump($zipUrl);
			echo("<br/>生成完毕，请在下载...");
		}
		else
			echo("<br/>生成出错！");
			
		unlink("tmp/zipcache/writting.txt");
	}
}


