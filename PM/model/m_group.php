 <?php  
class m_group extends spModel
{
	var $pk="group_id";
	var $table="pgroup";
    /*
     * 取得该组负责的产品
     * @param:$group_id[int]
     * @return:[Array]
     */
    public function getProdArray($group_id){
        $prod=spClass('m_product');
        $return_array=array();
        $prdStr=$this->find(array(
            "group_id"=>$group_id
        ));
        if(!$prdStr['group_product']) return false;
        $prod_array=explode("|",$prdStr['group_product']);
        foreach($prod_array as $prod_item){
            $re_item=$prod->find(array(
                'prod_id'=>$prod_item
            ));
            array_push($return_array,array(
                'prod_id'=>$prod_item,
                'prod_name'=>$re_item['prod_name']
            ));
        }
        return $return_array;
    }

    public function getLeader($group_id){
        $user=spClass('m_user');
        $group_details=$this->find(array(
            'group_id'=>$group_id
        ));
        $leader=$user->find(array(
            'user_id'=>$group_details['group_leader']
        ));
        return $leader['user_name'];
    }

    public function getTeamlist($group_id){
        $user=spClass('m_user');
        $result_array=array();
        $details=$user->findAll(array(
            'group_id'=>$group_id
        ));
        foreach($details as $item){
            array_push($result_array,array(
                'user_name'=>$item['user_name'],
                'user_id'=>$item['user_id']
            ));
        }
        return $result_array;
    }


    var $linker=array(
        array(
            'type' => 'hasone',   // 一对yi关联
            'map' => 'leader',    // 关联的标识
            'mapkey' => 'group_leader',
            'fclass' => 'm_user',
            'fkey' => 'user_id',
            'enabled' => true
        )
    );

}