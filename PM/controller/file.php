<?php
class file extends spController{

	function index(){
		import('extensions/nie-file.php');
		
		$row_count=$this->spArgs("file_row_count",0);
		
		
		if($row_count!=0||$row_count>20){
			//dump($this->spArgs());
			//exit();
			$nf=new nieFile();
			$file_name=$_POST['file_name_0'];
			$proj_id=$_POST['proj_id'];
			$project=spClass("m_project")->find(array("proj_id"=>$proj_id));
			$prod_id=$project["prod_id"];
			$pnod_id=$_POST['pnod_id'];
			$user_name=pmUser("name");
			$user_id=pmUser("id","html");
			$f = spClass('m_files');
			$counter=0;
			$file_name_list="";
			//循环上传多文件
			for($i=0;$i<$row_count;$i++)
			{
				$counter++;
				if($counter>50)
					exit('数据超出了最大范围值:50。');
				if(!isset($_FILES['p_'.$i]))
				{
					$i--;
					continue;
				}
				$newrow=array(
					'source'=>$_FILES['p_'.$i],
					'file_name'=>$_POST['file_name_'.$i],
				);
				
				$fileuri=$nf->put($newrow);
				
				$newrow=array(
							'source'=>'uploaded',
							'file_name'=>$_POST['file_name_'.$i],
							'file_intro'=>$_POST['file_intro'.$i],
							'proj_id'=>$proj_id,
							'pnod_id'=>$pnod_id,
							'user_id'=>$user_id,
							'file_url'=>$fileuri,
							'user_name'=>pmUser("name"),
							'file_time_c'=>date('Y-m-d H:i:s')
				);
				
				$f->create($newrow);
				
				$file_name_list=$file_name_list."[".$_POST['file_name_'.$i]."] ";

			}
			
			//juetion start 撤销产出物提示 
			$f->runSql("update proj_node
						set outcome='-1' where pnod_id=".$pnod_id);
			//juetion end 撤销产出物提示 
			
			//作事件记录

			//创建操作事件
			spClass('m_event')->set(1,"上传附件",$file_name_list,$proj_id,$pnod_id,$user_id);
			
			//创建通知信息
			$msg=spClass('m_message');
			$msg_context=$user_name." 上传了附件:".$file_name_list;
			$msg->init($msg_context,$proj_id,$pnod_id)->toProject($proj_id)->send();
			
			if($_POST['isSubmit']==1)
			{
				spClass("m_proj_node")->setState($pnod_id,1000);
			}
			
			$this->jump(spUrl('project_bll','project_show',array('id'=>$_POST['proj_id'])));

			

		}else{
			exit('参数错误。');
		}
	}
	
	function file_update() {
		import('extensions/nie-file.php');
		$nf=new nieFile();
		$file_name=$_POST['file_name_new'];
		$proj_id=$_POST['proj_id'];
		$user_name=pmUser("name");
		$user_id=pmUser("id","html");
		$f = spClass('m_files');
		//删除开始
		$nf->delete($_POST['file_url_old']);
		//删除结束
		
		$newrow=array(
				'source'=>$_FILES['p_new'],
				'file_name'=>$_POST['file_name_old'],
		);
		
		$fileuri=$nf->put($newrow);
		$f->update(array(file_id=>$_POST['file_id_old']),array(file_url=>$fileuri,user_id=>$user_id,user_name=>$user_name));
		
		$file_name_list="[".$_POST['file_name_old']."] ";
		
		//创建操作事件
		spClass('m_event')->set(1,"更新附件",$file_name_list,$proj_id,$_POST['pron_id_old'],$user_id);
			
		//创建通知信息
		$msg=spClass('m_message');
		$msg_context=$user_name." 更新了附件:".$_POST['file_name_old'];
		$msg->init($msg_context,$proj_id,$_POST['pron_id_old'])->toProject($proj_id)->send();
			
		$this->jump(spUrl('project_bll','project_show',array('id'=>$_POST['proj_id'])));
		
	}
	
	function upload_userface()
	{
		import('extensions/nie-file.php');
		$u=pmUser('all','html');
		$nf=new nieFile();
		$newrow=array('source'=>$_FILES['p']);
		$fileuri=$nf->upload($newrow,'/themes/images/userface/','userface_'.$u['id'].'.jpg');
		echo('上传成功  <a href="javascript:history.go(-1)">重新上传</a>');
	}
	
	function delete()
	{
		import('extensions/nie-file.php');
		if(!strstr($_GET['url'],'files')) pmResult('路径不正确');
		spClass("m_files")->delete('file_id='.$_GET['file_id']);
		function deldir($dir) 
		{
		  $dh=opendir($dir);
		  while ($file=readdir($dh)) {
		    if($file!="." && $file!="..") {
		      $fullpath=$dir."/".$file;
		      if(!is_dir($fullpath)) {
		          unlink($fullpath);
		      } else {
		          deldir($fullpath);
		      }
		    }
		  }
		  closedir($dh);
		  if(rmdir($dir))
		  {
		    return true;
		  } else {
		    return false;
		  }
		}
		$fileUrl=explode(".",$_GET['url']);
		if(count($fileUrl)<2)
		{
			if(!deldir($_GET['url']))  pmResult("0","记录已删除，但文件夹删除失败，请联系管理员。",'json');
		}
		else
		{
			$nf=new nieFile();
			if(!$nf->delete($_GET['url'])) pmResult("0","记录已删除，但删除文件时遇到错误，请联系管理员。",'json');
			
		}
		pmResult("1","文件删除成功!",'json');
	}
	
	function update(){
		/* */
		import('extensions/nie-file.php');
		
		$nf=new nieFile;
		$result=$nf->update(array(
			'uri'=>$_POST['uri'],
			'name'=>$_POST['name'],
			'descript'=>$_POST['descript']
		));
		if($result){
			$this->jump(spUrl('file','index'));
		}
	}
}
