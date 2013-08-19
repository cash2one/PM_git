<?php
ini_set("max_execution_time", "1800000");
class main extends spController
{
	function index()
	{
		/*
		dump($todayArray=getdate());
		dump(date('Y-m-d H:i:s', mktime(0,0,0,$month,date('d'),$now['year'])));
		$now=getdate();
		echo date('Y-m-t',strtotime($now['year'].'-11-1 00:00:00'));
		*/
		//spClass('m_user')->createBirthdayProjectWithMoth(1);
		//dump(getdate());
		$this->display("main.html");
	}
	
	function cBirthday()
	{
		spClass('m_user')->createBirthdayProjectWithMoth(1);
	}
	
	function post()
	{
						require_once('extensions/HttpClient.class.php');
						$postData=array(
							'proj_id'=>'ÎÒÎÒÎÒ',
							'did'=>$project['did'],
							'data'=>$newMeterailArray
						);
						$pageContents = HttpClient::quickPost('http://192.168.22.101/oa/index.php?a=postdo', $postData);
						dump($pageContents);
	}
	
	function postdo()
	{
		echo($_POST['proj_id']);
		dump($this->spArgs());
	}
	
	function b()
	{
		phpinfo();
	}
	
	function json()
	{
		dump(json_decode('{"0":{"meterial\u005fname":"\u6211\u6211","meterial\u005ftime":"2012\u002d12\u002d26","meterial\u005ftype":"1"},"1":{"meterial\u005fname":"\u4ecd\u4eba","meterial\u005ftime":"2012\u002d12\u002d27","meterial\u005ftype":"2"}}'));
	}
	
	function getNow()
	{
		$seperator=$this->spArgs("s","/");
		
		echo(date("Y".$seperator."m".$seperator."d H:i:s"));
	}
}