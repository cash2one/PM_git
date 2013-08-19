<?php 
/**
 * send e-mail
 * 
 * This file include some classes for e-mail management.
 * 
 * @author <zhfu@corp.netease.com> zhefu
 * @package nie-message.php
 * @method 
 */
 
 require 'class.phpmailer.php';
 
 class nieMail extends phpmailer{
	
	public $CharSet='utf-8';
	public $ContentType='text/html';
	public $From='nieweb@service.netease.com';
	public $FromName='PM系统';
	public $Mailer='smtp';
	public $SMTPDebug=1;
	public $SMTPAuth=true;
	public $SMTPSecure='';
	public $Host='service.netease.com';
	public $Port=25;
	public $Username='nieweb';
	public $Password='wangzengye';
	
	public function write($mail,$setting=NULL){
		$this->Subject=$mail['subject'];
		$this->Body=$mail['body'];
		foreach($mail['to'] as $to){$this->AddAddress($to, '');}
		foreach($mail['cc'] as $cc){$this->AddCC($cc, '');}
		if($setting)
		{
			if($setting["account"]) $this->Username=$setting["account"];
			if($setting["pwd"]);
				
		}
		return $this;
	}
 }
 
?>