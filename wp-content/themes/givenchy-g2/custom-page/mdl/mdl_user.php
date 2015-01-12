<?php
class mdl_user extends model{
    public function __construct(){
        //$this -> table_name = $wpdb -> prefix.'f_games_mdl_stock';
        $table_name = 'wp_users';
        $pkey = 'ID';
        parent :: __construct($table_name, $pkey);
    } 
    
    public function getUserInfo($user_field = '*', $usermeat_field = '', $num = 1000){
        $sql = 'select '.$field.' from '.$this -> table_name.' where 1 '.$where.' '.$orderby.$limit;
        $usermeat_field_str = '';
        $usermeat_field = explode(',', $usermeat_field);
        foreach($usermeat_field as $v){
            $usermeat_field_str .= ',max(case when  wp_usermeta.meta_key="'.$v.'" then wp_usermeta.meta_value else null end) '.$v.' ';
        }
        $sql = 'SELECT '.$user_field.$usermeat_field_str.'  
                FROM wp_users LEFT JOIN wp_usermeta on wp_users.ID = wp_usermeta.user_id GROUP BY wp_users.ID ';
                
        $user_info = array();
        $page = 0;
        do{
            $limit = 'limit '.$page*$num.','.$num;
            $rs = $this -> tool -> get_results($sql.$limit, ARRAY_A);
            $user_info[] = $rs;
            $page++;
        }while(count($rs) == $num);
        return $user_info;
    }
    
    public function getUserInfoByDate($user_field = '*', $usermeat_field = '', $start_time,  $end_time, $num = 1000){
        $sql = 'select '.$field.' from '.$this -> table_name.' where 1 '.$where.' '.$orderby.$limit;
        $usermeat_field_str = '';
        $usermeat_field = explode(',', $usermeat_field);
        foreach($usermeat_field as $v){
            $usermeat_field_str .= ',max(case when  wp_usermeta.meta_key="'.$v.'" then wp_usermeta.meta_value else null end) '.$v.' ';
        }
        $sql = 'SELECT '.$user_field.$usermeat_field_str.'  
                FROM wp_users LEFT JOIN wp_usermeta on wp_users.ID = wp_usermeta.user_id where user_registered BETWEEN "'.$start_time.'" and "'.$end_time.'" GROUP BY wp_users.ID ';
             
        $user_info = array();
        $page = 0;
        do{
            $limit = 'limit '.$page*$num.','.$num;
            $rs = $this -> tool -> get_results($sql.$limit, ARRAY_A);
            $user_info[] = $rs;
            $page++;
        }while(count($rs) == $num);
        return $user_info;
    }
    
    
}
?>