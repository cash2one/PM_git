<?php
class pmpush extends spController
{
	function index()
	{
		$this->display('tool/pmPush.html');
	}
	
	function send()
	{
		$msg=spClass("m_message");
		$push_url=APP_URL."/tpl/notice/msgbox.html#".$this->spArgs("msg_context");
		$msg->init("系统消息",0,0,0,2,$push_url,0);
		
		if($this->spArgs("role1")=="1")
			$msg->toGrounp(1);
		if($this->spArgs("role2")=="1")
			$msg->toGrounp(2);	
		if($this->spArgs("role3")=="1")
			$msg->toGrounp(3);			
		if($this->spArgs("role5")=="1")
		{
			$msg->toGrounp(4);
			$msg->toGrounp(5);	
		}
		$msg->send();
		exit("<script>alert('发送成功！');history.go(-1);</script>");
	}
}


