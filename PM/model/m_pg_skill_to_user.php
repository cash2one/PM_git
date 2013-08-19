<?php  
class m_pg_skill_to_user extends spModel
{
	var $pk="pg_stuid";
	var $table="pg_skill_to_user";

    var $linker = array(
        array(
            'type' => 'hasone',   // һ��һ����
            'map' => 'skillname',    // �����ı�ʶ
            'mapkey' => 'skill_id',
            'fclass' => 'm_pg_skill',
            'fkey' => 'skill_id',
            'enabled' => true
        ),

    );
}