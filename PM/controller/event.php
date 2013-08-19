<?php
class event extends spController
{
	function index()
	{

	}
	
	function add()
	{
		$user_id=pmUser("id","html");
		$user_name=pmUser("name");
		$proj_id=$this->spArgs('proj_id');
		$pnod_id=is_numeric($this->spArgs('pnod_id'))?$this->spArgs('pnod_id'):0;
		if(spClass('m_event')->set(3,"提交反馈",$this->spArgs('even_content'),$proj_id,$pnod_id,$user_id))
		{
			//创建通知信息
			$msg=spClass('m_message');
			$msg_context="$user_name 提交反馈:".$this->spArgs('even_content');
			$msg->init($msg_context,$proj_id,$pnod_id)->toProject()->send();
			$this->jump(spUrl('project_bll','project_show',array('id'=>$this->spArgs('proj_id'))));
		}
	}
	
	function show()
	{
		$even_id=$this->spArgs('even_id');
		$con=array('even_id'=>$even_id);
		$event=spClass('m_event_v')->find($con);
		$this->event=$event;
		$this->display('project/event_show.html');
	}
	
	
}