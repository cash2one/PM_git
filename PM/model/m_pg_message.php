<?php
class m_pg_message extends spModel
{
	var $pk="message_id";
	var $table="pg_message";

	/**
	 * 发送新系统通知  editor by juetion
	 * @param int $toUser pg_user_id-收消息的用户
	 * @param String $title 消息标题
	 * @param String $content 消息内容
	 * @param int $fromUser pg_user_id-发消息的用户
	 */
	function sendNewMessage($toUser,$title,$content,$fromUser=0)
	{
		$newArray = array(
				'message_title' => $title,
				'message_content' => $content,
				'create_date' => date('Y-m-d  H:i:s'),
				'had_read' => 0,
				'pg_user_id' => $toUser,
				'save_user_id' => $fromUser
							);
		return $this->create($newArray);
	}

}