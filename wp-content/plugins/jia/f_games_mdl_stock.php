<?php  
class f_games_mdl_stock extends mdl_dev{
    public function __construct(){
        //$this -> table_name = $wpdb -> prefix.'f_games_mdl_stock';
        $table_name = 'wp_stock';
        $pkey = 'id';
        parent :: __construct($table_name, $pkey);
    }    
    
    public function subtraction_stocknum($id, $num = 1){
        $sql = 'update '.$this -> table_name .' set stocknum = stocknum-1 where '.$this -> pkey .'='.$id;
        return $this -> tool -> query ($sql);
    }
}
?>