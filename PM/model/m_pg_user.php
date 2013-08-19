<?php  
class m_pg_user extends spModel
{
	var $pk="pg_user_id";
	var $table="pg_user";

    var $linker = array(
        array(
            'type' => 'hasone',   // 一对一关联
            'map' => 'userdetail',    // 关联的标识
            'mapkey' => 'user_id',
            'fclass' => 'm_user',
            'fkey' => 'user_id',
            'enabled' => true
        ),
        array(
            'type' => 'hasone',   // 一对一关联
            'map' => 'jobdetail',    // 关联的标识
            'mapkey' => 'pg_user_jobid',
            'fclass' => 'm_pg_jobs',
            'fkey' => 'job_id',
            'enabled' => true
        ),

        array(
            'type' => 'hasmany',   // 一对多关联
            'map' => 'skilldetail',    // 关联的标识
            'mapkey' => 'pg_user_id',
            'fclass' => 'm_pg_skill_to_user',
            'fkey' => 'pg_userid',
            'enabled' => true
        ),

    );
    function checkInit($userid){
        $isInit=$this->find(array('user_id'=>$userid));
        if($isInit){
            return true;
        }else{
            return false;
        }
    }
	

}