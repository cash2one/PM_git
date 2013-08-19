<?php
require_once('extensions/pclzip.php');
class zip extends spController
{
	function index()
	{
		pmAuth("login");
		$file_id=$this->spArgs("fileId");
		$conn=array("file_id"=>$file_id);
		$mFile=spClass("m_files");
		$file=$mFile->find($conn);
		if(!$file)  pmResult(0,"操作失败，文件记录不存在！");
		$ext=pmGetFileExt($file["file_url"]);
		$fileNamePath=explode(".",$file["file_url"]);
		$fileNamePath=$fileNamePath[0];
		//dump($file["file_url"]);
		//dump($ext);
		//dump($fileNamePath);
		if($ext!="zip") pmResult(0,"操作失败，该文件不是zip文件，不能解压缩。");
		//print_r(parse_url('http://www.test.com/aa.php?id=25'));
		$zip = new PclZip($file["file_url"]);
		if($zip->extract($fileNamePath))
		{
			$updateRow=array("file_url"=>$fileNamePath);
			if($mFile->update($conn,$updateRow))
			{
				unlink($file["file_url"]);
				pmResult(1,"解压成功！",array("fileUrl"=>$fileNamePath));
			}
			else pmResult(0,"解压成功，但记录更新失败，请联系管理员。");
		}
		else  pmResult(0,"解压失败，请联系管理员。");
	}
}