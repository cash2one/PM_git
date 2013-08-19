<?php  
class m_pg_skill_to_user extends spModel
{
	var $pk="pg_stuid";
	var $table="pg_skill_to_user";

    var $linker = array(
        array(
            'type' => 'hasone',   // 一对一关联
            'map' => 'skillname',    // 关联的标识
            'mapkey' => 'skill_id',
            'fclass' => 'm_pg_skill',
            'fkey' => 'skill_id',
            'enabled' => true
        ),

    );
}