<?php
class m_pg_pron_skill extends spModel
{
	var $pk="pg_pn_skill_id";
	var $table="pg_pron_skill";

	/**
	 * 判读是否已经配置技能 
	 * @param int $user_id 用户id
	 * @param int $proj_id 项目id
	 * @return number 1-没有配置技能，2-配置了技能没有评价，3-已经完成了评价（不能修改）
	 */
	public function check_skill($user_id,$proj_id)
	{
		$result = $this->find(array(user_id=>$user_id,proj_id=>$proj_id));
		if ($result) {
			if ($result["send_data"]==null) {
				return 2;
			}else 
				return 3;
		}else
			return 1;
	}
}