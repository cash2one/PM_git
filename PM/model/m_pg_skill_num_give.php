<?php  
class m_pg_skill_num_give extends spModel
{
	var $pk="skill_num_give_id";
	var $table="pg_skill_num_give";
	
	var $linker = array(
			array(
					'type' => 'hasone',   // 一对一关联
					'map' => 'skillname',    // 关联的标识
					'mapkey' => 'skill_id',
					'fclass' => 'm_pg_skill',
					'fkey' => 'skill_id',
					'field' => 'skill_name',
					'enabled' => true
			),
	
	);


}