 <?php  
class m_pg_mtpl extends spModel
{
	var $pk="mtpl_id";
	var $table="pg_mtpl";
	
    var $linker=array(
        array(
            'type' => 'hasmany',   // һ�Զ����
            'map' => 'flow_list',    // �����ı�ʶ
            'mapkey' => 'mtpl_id',
            'fclass' => 'm_pg_mtpl_flow',
            'fkey' => 'flow_mtpl_id',
            'enabled' => true
        )
    );
}