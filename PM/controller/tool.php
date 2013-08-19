<?php
class tool extends spController
{
	function index()
	{
		$this->title="PM工具 - 页面检查";
		$this->display("tool/pageCheck.html");
	}
	//页面检查器
	function pageCheck()
	{
		$url=$this->spArgs("url");
		$html=file_get_contents($url);
		$html = iconv("gb2312", "utf-8//IGNORE",$html);
		echo($html);
	}
	
	function quickAccess()
	{
		$this->title="PM工具 - 快速入口";
		$this->display("tool/quickAccess.html");
	}
}