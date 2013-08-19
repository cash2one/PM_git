<?php
class m_pg_job_up_request extends spModel
{
	var $pk="task_id";
	var $table="pg_job_up_request";
	
	var $linker = array(
			array(
					'type' => 'hasone',   // 一对一关联
					'map' => 'mtpl',    // 关联的标识
					'mapkey' => 'mtpl_id',
					'fclass' => 'm_pg_mtpl',
					'fkey' => 'mtpl_id',
					'enabled' => true
			),
	
	);


}