<?php  
class m_pg_medal_to_user extends spModel
{
	var $pk="pg_mtuid";
	var $table="pg_medal_to_user";

    var $linker = array(
        array(
            'type' => 'hasone',   // һ��һ����
            'map' => 'medalname',    // �����ı�ʶ
            'mapkey' => 'medal_id',
            'fclass' => 'm_pg_medals',
            'fkey' => 'medal_id',
            'enabled' => true
        ),

    );
}