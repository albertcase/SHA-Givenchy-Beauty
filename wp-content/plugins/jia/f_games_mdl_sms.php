<?php  
class f_games_mdl_sms extends mdl_dev{
    public function __construct(){
        //$this -> table_name = $wpdb -> prefix.'f_games_mdl_stock';
        $table_name = 'wp_sms';
        $pkey = 'id';
        parent :: __construct($table_name, $pkey);
    }    
}
?>