<?php  
class m_pg_skill extends spModel
{
	var $pk="skill_id";
	var $table="pg_skill";


	var $linker=array(
        array(
            'type' => 'hasmany',   // 关联类型，这里是一对duo关联
            'map' => 'lv',    // 关联的标识
            'mapkey' => 'skill_id', // 本表与对应表关联的字段名
            'fclass' => 'm_pg_skill_lv', // 对应表的类名
            'fkey' => 'skill_id',    // 对应表中关联的字段名
        	'field' => 'skilllv_id,skill_lv,skill_title',
            'enabled' => true     // 启用关联
        )
    );

}