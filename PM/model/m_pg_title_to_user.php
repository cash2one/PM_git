<?php  
class m_pg_title_to_user extends spModel
{
	var $pk="pg_ttuid";
	var $table="pg_title_to_user";

    var $linker = array(
        array(
            'type' => 'hasone',   // һ��һ����
            'map' => 'titlename',    // �����ı�ʶ
            'mapkey' => 'title_id',
            'fclass' => 'm_pg_titles',
            'fkey' => 'title_id',
            'enabled' => true
        ),

    );
}