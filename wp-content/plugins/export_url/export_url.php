<?php
/*
Plugin Name: export_url
Plugin URI: http://jrl
Description: 测试
Version: 1.0
Author: jrl
Author URI: http://jrl
*/
ob_start();
//添加权限
function export_url_activate(){
    global $wpdb, $wp_roles;
    $wp_roles->add_cap( 'administrator', 'export_url_csv');
}
register_activation_hook(__FILE__,'export_url_activate');

//移除权限
function export_url_deactivate(){
    global $wpdb, $wp_roles;
    $roles = $wp_roles->get_names(); // get a list of values, containing pairs of: $role_name => $display_name
    foreach ( $roles as $rolename => $key) {
    	$wp_roles->remove_cap( $rolename, 'export_url_csv');		
    }
}


register_deactivation_hook( __FILE__, 'export_url_deactivate' );


/**
 * Add menu pages 
 */
function export_url_add_admin_menu() {
    global $submenu;
    if ( current_user_can('export_url_csv') )  {
  		add_submenu_page( 'edit.php', __("url导出", "export_url"), __("url导出", "export_url"), 'export_url_csv', 'export_url/export_url_list_tab.php' );
  	}
}
add_action('admin_menu', 'export_url_add_admin_menu');

?>