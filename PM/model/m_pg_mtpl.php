 <?php  
class m_pg_mtpl extends spModel
{
	var $pk="mtpl_id";
	var $table="pg_mtpl";
	
    var $linker=array(
        array(
            'type' => 'hasmany',   // 一对多关联
            'map' => 'flow_list',    // 关联的标识
            'mapkey' => 'mtpl_id',
            'fclass' => 'm_pg_mtpl_flow',
            'fkey' => 'flow_mtpl_id',
            'enabled' => true
        )
    );
}