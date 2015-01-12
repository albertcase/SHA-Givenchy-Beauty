<?php
class mdl_new_product_relationship extends model{
    public function __construct(){
        //$this -> table_name = $wpdb -> prefix.'new_product_location';
        //$table_name = 'wp_users';
        //$pkey = 'ID';
        global $wpdb;
        parent :: __construct($wpdb -> prefix.'new_product_relationship', 'id');
        //parent :: __construct('wp_new_product_location', 'id');
    } 
}
?>