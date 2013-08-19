<?php 
function pmFliterSqlInput($value)
{
	// 去除斜杠
	if (get_magic_quotes_gpc())
	{
	  $value = stripslashes($value);
	}
	
	// 如果不是数字则加引号
	if (!is_numeric($value))
	{
	  $value = "'" . mysql_real_escape_string($value) . "'";
	}
	return $value;
}

function pmIsDate($date) { //检查日期是否合法日期
     $dateArr = explode("-", $date);
	 if($dateArr=="") return false;
     if (is_numeric($dateArr[0]) && is_numeric($dateArr[1]) && is_numeric($dateArr[2])) {
         return checkdate($dateArr[1],$dateArr[2],$dateArr[0]);
     }
     return false;
}

/**
@ Name:pmFormatDate
@ Describe:格式化日期，换成常用显示日期
@ param:
	@require
		$date (string) 日期
@ return：(string)
*/
function pmFormatDate($date)
{
	$rs=getdate(strtotime($date));
	//dump($rs);
	if($rs["year"]<2000) return "";
	if($rs["mon"]<10)$rs["mon"]='0'.$rs["mon"];
	if($rs["mday"]<10)$rs["mday"]='0'.$rs["mday"];
	return $rs["year"].'-'.$rs["mon"].'-'.$rs["mday"];
}

function xmlReplace($str)
{
	if($str=="") return;
	$trans = array(
	"&" => "&amp;",
	"<"=>"&lt;",
	">"=>"&gt;",
	"'"=>"&apos;",
	'"'=>"&quot;"
	);
	return strtr($str,$trans);
}

function pmGetFileName($url,$isIncExt=false) 
{ 
	preg_match('/\/([^\/]+\.[a-z]+)[^\/]*$/',$url,$match); 
	if($isIncExt)
	{
		$rs=$match[1]; 
	}
	else
	{
		$_tem=explode(".",$match[1]);
		return $_tem[0];
	}
} 
		  
function pmGetFileExt($url) 
{ 
	$path=parse_url($url); 
	$str=explode('.',$path['path']); 
	return $str[1]; 
}

/*
if($isArray==false) $str must be string;
else $str must be array;
*/
function pmLogs($file,$str,$isArray=false,$path="tmp/cache/",$isRewrite=false)
{
	//dump($str);
	$cacheFile=$path.$file;
	if(file_exists($cacheFile)&&!$isRewrite)
	{
		if($isArray)
		{
			$_tem=file_get_contents($cacheFile);
			$_tem=json_decode(file_get_contents($cacheFile),true);
			if(is_array($_tem)) array_push($_tem,$str);
			else $_tem=array($str);
			$str=json_encode($_tem);
		}	
		else
		{
			$str=file_get_contents($cacheFile).$str;
		}
	}
	else
	{
		$_tem=array($str);
		if($isArray) $str=json_encode($_tem);
	}
	file_put_contents($cacheFile,$str);
}

/**
@ Name:pmAlert
@ Describe:提示
@ param:
	@require
		$Text (string) 提示内容
		$Url （string）跳转地址
			-1->后退
			'close' ->关闭
	@optional
		$Type (int) 提示类别 
			1->javascript:alert[default] &  die();
			2->javascript:alert[default] &continue
@ return void;
*/
function pmAlert($Text,$Url=-1,$Type=1){
	if($Type==1||$Type==2)
	{
		echo '<script language="javascript">';
		echo 'alert("' . $Text . '");';
		if(is_numeric($Url)&&$Url!=0)
		{
			echo 'history.back('.$Url.');';
		}
		else if($Url=='close')
		{
			echo'window.close();';
		}
		else if(!is_numeric($Url)&&strlen($Url)>5)
		{
			echo 'location="' . $Url . '";';
		}
		echo '</script>';
		
		if($Type==1) die();
	}
}

/**
@ Name:pmResult
@ Describe:输出ajax结果
@ param:
	@require
		$rs (string) 结果类别 
			0->失败
			200->成功
			401->未授权：登录信息已经失败效。
			403->未授权：禁止访问
	@optional
		$type (string) "json" | "html" | "return"
		$des (string)描述
@ return void;
*/
function pmResult($rs,$des=NULL,$exitType="json")
{
	//dump($rs);
	//dump($des);
	//die();
	$result=array();
	$result["rs"]=$rs;
	switch($rs)
	{
		case 400:$result["rs"]=400;$result["des"]="请求出错，可能参数有误";break;
		case 500:$result["rs"]=500;$result["des"]="服务器错误";break;
		case 401:$result["rs"]=401;$result["des"]="登陆失败";break;
		case 403:$result["rs"]=403;$result["des"]="登录信息已经失效或权限不足";break;
	}
	if($des) $result["des"]=$des;
	switch($exitType)
	{
		case "json":
			die(json_encode($result));
			break;
		case"html":
			Header("Location: php/message.php?msg=".urlencode($result["des"]));
			die();
			break;
		case "return":
			return $result;
			break;
	}
}

/**
@ Name:pmGetTablesSQL
@ Describe:生成多表联查SQL
@ param:
	@require
		$table (string) 主表名
		$pk (string) 主键名
		$colums (array) 提取的键名数组
		$leftJoinTables （array）副表名数组
	@optional
		$leftJoinOn (array) 每个副表关联条件，默认为主健跟外键健名一样，并关联，如果不是这个情况，需要输入这个参数，顺序对应$leftJoinTables
		$where （string） WHERE 条件SQL语句
@ return (string)SQL语句
*/
function pmGetTablesSQL($table,$pk,$colums,$leftJoinTables,$leftJoinOn=NULL,$where="")
	{
		$_colums="";
		$_leftJoinTables="";
		$_where=$where==""?"":" WHERE ".$where;
		if(is_array($colums))
		{
			$_colums=$colums[0];
			array_shift($colums);
			foreach($colums as $colum){$_colums.=",".$colum;}
		}
		if(is_array($leftJoinTables))
		{
			$_count=count($leftJoinTables);
			for($i=0;$i<$_count;$i++)
			{
				if(!$leftJoinOn[$i])
					$_leftJoinTables.=" LEFT JOIN ".$leftJoinTables[$i]." ON ".$table.".".$pk."=".$leftJoinTables[$i].".".$pk;
				else
					$_leftJoinTables.=" LEFT JOIN ".$leftJoinTables[$i]." ON ".$leftJoinOn[$i];
			}
		}
		$selstr="SELECT $_colums FROM $table $_leftJoinTables $_where";
		//die($selstr);
		return $selstr;
	}
	
function pmEncrypt($tex,$type="encode"){
	$key="jaykon";
    $chrArr=array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z',
                  'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
                  '0','1','2','3','4','5','6','7','8','9');
    if($type=="decode"){
        if(strlen($tex)<14)return false;
        $verity_str=substr($tex, 0,8);
        $tex=substr($tex, 8);
        if($verity_str!=substr(md5($tex),0,8)){
            //完整性验证失败
            return false;
        }    
    }
    $key_b=$type=="decode"?substr($tex,0,6):$chrArr[rand()%62].$chrArr[rand()%62].$chrArr[rand()%62].$chrArr[rand()%62].$chrArr[rand()%62].$chrArr[rand()%62];
    $rand_key=$key_b.$key;
    $rand_key=md5($rand_key);
    $tex=$type=="decode"?base64_decode(substr($tex, 6)):$tex;
    $texlen=strlen($tex);
    $reslutstr="";
    for($i=0;$i<$texlen;$i++){
        $reslutstr.=$tex{$i}^$rand_key{$i%32};
    }
    if($type!="decode"){
        $reslutstr=trim($key_b.base64_encode($reslutstr),"==");
        $reslutstr=substr(md5($reslutstr), 0,8).$reslutstr;
    }
    return $reslutstr;
}

/**
@ Name:pmUser
@ Describe:取得用户信息
@ param:
	@require
		$type (string) 返回内容 ："id"|"role"|"power"|"decode"|"all"
	@optional
		$exitType (string)  验证失败时，程序返回方式 | NULL->返回NULL | 输出json | 跳转html
@ return (string)结果($type="all"时，返回array()集合)
*/
function pmUser($type="id",$exitType=NULL)
{
	//检查cookies完整性
	if(!isset($_COOKIE['pm_proving_code'])||!isset($_COOKIE['pm_user_id'])||!isset($_COOKIE['pm_role_id'])||!isset($_COOKIE['pm_user_power'])||!isset($_COOKIE['pm_user_name'])||!isset($_COOKIE['pm_user_dcode'])||!isset($_COOKIE['pm_power2']))
	{
		if($exitType==NULL) return NULL;
		pmResult(401,NULL,$exitType);
	}
	//检查cookies是否有被篡改
	if($_COOKIE['pm_proving_code']!=md5($_COOKIE['pm_user_name'].$_COOKIE['pm_user_power'].$_COOKIE['pm_role_id'].$_COOKIE['pm_user_id'].$_COOKIE['pm_power2']."nie"))
	{
		if($exitType==NULL) return NULL;
		pmResult(401,NULL,$exitType);
	}

	switch($type)
	{
		case "id":
			return $_COOKIE['pm_user_id'];
		case "name":
			return $_COOKIE['pm_user_name'];
		case "role":
			return $_COOKIE['pm_role_id'];
		case "power":
			return $_COOKIE['pm_user_power'];
		case "decode":
			return $_COOKIE['pm_user_dcode'];
		case "power2":
			return $_COOKIE['pm_power2'];
		case "all":
			return array(
			"id"=>$_COOKIE['pm_user_id'],
			"name"=>$_COOKIE['pm_user_name'],
			"role"=>$_COOKIE['pm_role_id'],
			"power"=>$_COOKIE['pm_user_power'],
			"dcode"=>$_COOKIE['pm_user_dcode'],
			"power2"=>$_COOKIE['pm_power2']
			);
	}
	return false;
}

/**
 @ Name:pmUser_pg
 @ Describe:取得用户信息,PG部分的信息  （juetion 添加）
 @ param:
 @require
 $type (string) 返回内容 ："pg_user_id"|"pg_job_id"|"all"|"p_user_id"
 @optional
 $exitType (string)  验证失败时，程序返回方式 | NULL->返回NULL | 输出json | 跳转html
 @ return (string)结果($type="all"时，返回array()集合)
 */
function pmUser_pg($type="pg_user_id",$exitType=NULL)
{
	//检查cookies完整性
	if(!isset($_COOKIE['pg_user_id'])||!isset($_COOKIE['pg_job_id'])||!isset($_COOKIE['p_user_id']))
	{
		if($exitType==NULL) return NULL;
		pmResult(401,NULL,$exitType);
	}
	//检查cookies是否有被篡改
	if($_COOKIE['pg_proving_code']!=md5($_COOKIE['pg_user_id'].$_COOKIE['pg_job_id'].$_COOKIE['p_user_id']."miao"))
	{
		if($exitType==NULL) return NULL;
		pmResult(401,NULL,$exitType);
	}
	switch($type)
	{
		case "pg_user_id":
			return $_COOKIE['pg_user_id'];
		case "pg_job_id":
			return $_COOKIE['pg_job_id'];
		case "p_user_id":
			return $_COOKIE['p_user_id'];
		case "all":
			return array(
			"pg_user_id"=>$_COOKIE['pg_user_id'],
			"pg_job_id"=>$_COOKIE['pg_job_id'],
			"p_user_id"=>$_COOKIE['p_user_id']
			);
	}
	return false;
}
/**
@ Name:pmAuth
@ Describe:验证当前操作访问者的权限
@ param:
	@require
		$require (string) 当前操作所需权限 ：
			"login"
			"checker"
			"manager"
	@optional
		$exitType (string) 验证失败时结束方式 json | html
@ return user_id
*/
function pmAuth($require="login",$exitType="json")
{
	$user=pmUser("all");
	switch($require)
	{
		case "login":
			if(!$user) pmResult(401,NULL,$exitType);
			break;
		case "checker":
			$power=$user["power"];
			if($power==NULL||$power>1) pmResult(403,NULL,$exitType);
			break;
		case "manager":
			$power=$user["power"];
			if($power!=0||!isset($_COOKIE['pm_user_power'])) pmResult(403,NULL,$exitType);
			break;
		case "topManager":
			if($user["role"]!=5) pmResult(403,NULL,$exitType);
			break;
	}
	return $user["id"];
}

/**
@ Name:pmAuth2
@ Describe:验证当前操作访问者的权限2.0
@ param:
	@require
		$power2ID (int) 当前操作所需权限ID[参考:setting.php->pmPower2()];
	@optional
		$exitType (string) 验证失败时结束方式 json | html | NULL
@ return user_id
*/
function pmAuth2($power2ID,$exitType="json")
{
	$power2=(int)pmUser("power2");
	$power2ID=(int)$power2ID;
	if(($power2&$power2ID)==$power2ID)
		return true;
	else
		if($exitType==NULL)
			return false;
		else
			pmResult(401,NULL,$exitType);
}
//PHP stdClass Object转array
function object_array($stdclassobject)
{
    $_array = is_object($stdclassobject) ? get_object_vars($stdclassobject) : $stdclassobject;

    foreach ($_array as $key => $value) {
        $value = (is_array($value) || is_object($value)) ? object_array($value) : $value;
        $array[$key] = $value;
    }

    return $array;
}

//pm系统到提单系统的加密
function pm2td($paramArray)
{
	$str='netease2013';
	foreach($paramArray as $param)
	{
		$str.=$param;
	}
	return md5($str);
}
?>