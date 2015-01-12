<?php
/*
Plugin Name: jiatest
Plugin URI: http://jrl
Description: 左半部分连接重新定向
Version: 1.0
Author: jrl
Author URI: http://jrl
*/
if(!class_exists('AbitnoInHead')) {
    class AbitnoInHead {
        //对菜单栏做判断
        function abitno_in_head($output) {
            global $wp,$ischange_request_match;
            $matched_query = $wp -> matched_rule;
            if($ischange_request_match){
                if($matched_query == '$'){
                    $output = str_replace('current-cat-parent', '', $output);
                    $output = str_replace('current-cat', '', $output);
                }else{
                    $output = str_replace('current-cat-parent', 'current-cat', $output);
                }
            }
            return $output;
        }
        
        function url_rewrite(){
            global $wp,$rewrite2,$ischange_request_match,$wp_query;
            $matched_query = $wp -> matched_rule;
            if(isset($rewrite2[$matched_query])){
                $ischange_request_match = true;
            }
            if($ischange_request_match){
                if($wp_query ->query['category_name'] == 'skin-care/star-product-skin-care'){
                    $request_match_de = 'skin-care';
                }else if($wp_query ->query['category_name'] == 'makeup/star-product-makeup'){
                    $request_match_de = 'makeup';
                }else if($wp_query ->query['category_name'] == 'perfume/star-product-perfume'){
                    $request_match_de = 'perfume';
                }
            }
            return $output;
        }
        
    }
}

if( class_exists('AbitnoInHead') ) {
    $abitno_head = new AbitnoInHead();
}

if(isset ($abitno_head)){
    //定义url重写
    $rewrite = get_option('rewrite_rules');
    
    if(isset($rewrite['$'])){
        unset($rewrite['$']);    
    }
    
    $rewrite2 = array();
    $ischange_request_match = false;
    $rewrite2['category/makeup$'] = 'index.php?category_name=makeup/star-product-makeup'; 
    $rewrite2['category/perfume$'] = 'index.php?category_name=perfume/star-product-perfume';
    $rewrite2['category/skin-care$'] = 'index.php?category_name=skin-care/star-product-skin-care';
    $rewrite2['$'] = 'index.php?category_name=home-products';
    $new_rewrite = array_merge($rewrite2, $rewrite);
    //print_R($new_rewrite);die();
    update_option('rewrite_rules', $new_rewrite);
    add_filter('wp_list_categories', array($abitno_head, 'abitno_in_head'), 1);
    add_filter('jia_url_rewrite', array($abitno_head, 'url_rewrite'), 1);   
}



function user_explort_add_admin(){
    global $wpdb, $wp_roles;
    $wp_roles->add_cap( 'administrator', 'user_export_admin');
}
register_activation_hook(__FILE__,'user_explort_add_admin');

/**
 * Add menu pages 
 */
function user_add_admin_menu() {
  	if (current_user_can('user_export_admin') )  {
  		add_submenu_page( 'users.php', __("用户导出", "user_export"), __("用户导出", "user_export"), 'user_export_admin', 'jiatest/user_explort_clt.php' );
  	}
    //debug_print_backtrace();die();
    //global $submenu;
    
    //print_r($submenu);die();
    
}
add_action('admin_menu', 'user_add_admin_menu');

if(isset($_REQUEST['page']) && $_REQUEST['page'] == 'jiatest/user_explort_clt.php'){
    add_action('admin_head', 'user_export_add_scripts' );
}


function user_export_add_scripts(){
    echo '<link rel="stylesheet" href="'.network_site_url('wp-includes/css/jquery-ui.css').'">';
    echo '<script type=\'text/javascript\' src="'.network_site_url('wp-includes/js/new_user_admin/jquery-1.7.2.js').'"></script>';
    echo '<script type=\'text/javascript\' src="'.network_site_url('wp-includes/js/new_user_admin/jquery.ui.core.js').'"></script>';
    echo '<script type=\'text/javascript\' src="'.network_site_url('wp-includes/js/new_user_admin/jquery.ui.widget.js').'"></script>';
    echo '<script type=\'text/javascript\' src="'.network_site_url('wp-includes/js/new_user_admin/jquery.ui.datepicker.js').'"></script>';
}

$meta_box = array(
    "name" => "theme_type",
    "std" => "1",
    "title" => "文章模板类型:"
);



function new_meta_boxes() {
    global $post,$meta_box;
    
    $meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);
    
    if($meta_box_value == ""){
        $meta_box_value = $meta_box['std'];
    }
    
    echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
    
    // 自定义字段标题
    echo'<h4 style="display:inline;margin-right:10px;">'.$meta_box['title'].'</h4>';
    
    // 自定义字段输入框
    //echo '<textarea cols="60" rows="3" name="'.$meta_box['name'].'_value">'.$meta_box_value.'</textarea><br />';
    for($i = 1; $i < 4; $i++){
        if($i == $meta_box_value){
            $selected = ' checked="checked" ';
        }else{
            $selected = '';
        }
        echo '<input type="radio" '.$selected.' name="'.$meta_box['name'].'_value" value="'.$i.'"  >'.$i;
    }
}

function create_meta_box() {
    global $theme_name;
    
    if ( function_exists('add_meta_box') ) {
        add_meta_box( 'new-meta-boxes', '自定义模块', 'new_meta_boxes', 'post', 'normal', 'high' );
    }
}

function save_postdata( $post_id ) {
    global $post, $meta_box;
    
    if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) ))  {
        return $post_id;
    }
    
    if ( 'page' == $_POST['post_type'] ) {
        if ( !current_user_can( 'edit_page', $post_id ))
        return $post_id;
    }
    else {
        if ( !current_user_can( 'edit_post', $post_id ))
        return $post_id;
    }
    
    $data = $_POST[$meta_box['name'].'_value'];
    
    if(get_post_meta($post_id, $meta_box['name'].'_value') == ""){
        add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
    }elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true)){
        update_post_meta($post_id, $meta_box['name'].'_value', $data);
    }elseif($data == ""){
        delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
    }
        
}

add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata');

?>