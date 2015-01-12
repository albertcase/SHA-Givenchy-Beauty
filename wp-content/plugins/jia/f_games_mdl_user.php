<?php
class f_games_mdl_user  extends mdl_dev{
    public $tool,$table_name;
    public function __construct(){
        global $wpdb;
        $this -> tool = $wpdb;
        $this -> table_name = 'wp_users';
        $this -> pkey = 'ID';
        
                
    }    
    
    public function get_list_page($filter = array(), $field = '*',  $page = 1, $num = 10, $orderby){
        if(is_array($filter) && !empty($filter)){
            $where = '';
            foreach($filter as $k => $v){
                $where .= ' and '.$k.'="'.$v.'"';
            }
        }
        if(empty($field)){
            $field = '*';
        }
        $sql = 'select count(*) total from '.$this -> table_name.' where 1 '.$where;
        //$rs = $this -> tool -> get_results($sql);
        $rs = $this -> tool -> get_row($sql);
        $count = $rs->total;
        $start = $num * ($page - 1);
        if($count == 0){
            return ;
        }
        if($count > $start){
            $limit = ' limit '.$start.','.$num;
        }else{
            $limit = ' limit '.($count - $num).','.$num;
        }
        $sql = 'select '.$field.' from '.$this -> table_name.' where 1 '.$where.' '.$orderby.$limit;
        $rs = $this -> tool -> get_results($sql);
        $result = array(
            'data' => $rs,
            'total_items' => $count,
            "total_pages" => ceil( $count / $num ),
            "per_page" => $page
        );
        return $result;
    }
    
    function getByFilter($filter = array(), $field = '*'){
        if(is_array($filter) && !empty($filter)){
            $where = '';
            foreach($filter as $k => $v){
                $where .= ' and '.$k.'="'.$v.'"';
            }
        }
        if(empty($field)){
            $field = '*';
        }
        $sql = 'select '.$field.' from '.$this -> table_name.' where 1 '.$where;
        $rs = $this -> tool -> get_results($sql);
        return $rs;
    }
    
    function getById($id, $field = '*'){
        if(empty($id)){
            return false;
        }
        if(empty($field)){
            $field = '*';
        }
        $sql = 'select '.$field.' from '.$this -> table_name.' where '.$this -> pkey.'= '.$id.' limit 1';
        $rs = $this -> tool -> get_row($sql);
        return $rs;
    }
    
    function delById($id){
        if(empty($id)){
            return false;
        }
        $sql = 'delete from '.$this -> table_name.' where '.$this -> pkey.'= '.$id;
        $rs = $this -> tool -> query($sql);
        return $rs;
    }
    
    
    function insert($data){
        return  $this -> tool -> insert( $this -> table_name, $data);  
        
    }
    
    function update($id, $data){
        $where = array(
            $this -> pkey => $id
        );
        $rs = $this -> tool -> update($this -> table_name, $data,$where); 
        return $rs_data;
    }
    
    function addGameUser($data){
        //if($this -> tool -> insert( $this -> table_name, $data)){
//            $user_id = $this -> tool -> insert_id;
//            $data1 = array(
//                'meta_value' =>'a:1:{s:13:\"administrator\";s:1:\"1\";}',
//                'user_id' => $user_id,
//                'meta_key' => 'wp_2_capabilities'
//            );
//            $data2 = array(
//                'meta_value' =>'0',
//                'user_id' => $user_id,
//                'meta_key' => 'wp_2_user_level'
//            );
//            $this -> tool -> insert( 'wp_usermeta', $data1);
//            $this -> tool -> insert( 'wp_usermeta', $data2);
//        }
        $user_id = wp_insert_user($data);
        //update_user_meta( $user_id, 'first_name', $first_name );
        return  true; 
    }
}
?>