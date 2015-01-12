<?php
/*
Plugin Name: jia
Plugin URI: http://jrl
Description: 测试
Version: 1.0
Author: jrl
Author URI: http://jrl
*/

//获取插件的目录
$game_dir_root =  ABSPATH . 'wp-content/plugins/jia/';
include_once( ABSPATH . 'wp-content/plugins/jia/f_games_ctl.php' );
include_once( ABSPATH . 'wp-content/plugins/jia/f_games_mdl.php' );  

function f_games_activate(){
    global $wpdb, $wp_roles;
    $wp_roles->add_cap( 'administrator', 'stock_manage_games');
}
register_activation_hook(__FILE__,'f_games_activate');

function f_games_deactivate(){
    global $wpdb, $wp_roles;
    $roles = $wp_roles->get_names(); // get a list of values, containing pairs of: $role_name => $display_name
    foreach ( $roles as $rolename => $key) {
    	$wp_roles->remove_cap( $rolename, 'stock_manage_games');		
    }
}


register_deactivation_hook( __FILE__, 'f_games_deactivate' );

function jia_register_jia_type () {
    global $wp_roles;
	$labels = array(
		'name' => __( '游戏管理', "f_games" ),
		'singular_name' => __( '游戏管理', "f_games" ),
		'add_new' => __( 'Add New', "f_games" ),
		'add_new_item' => __( 'Add New Newsletter', "f_games" ),
		'edit_item' => __( 'Edit Newsletter', "f_games" ),
		'new_item' => __( 'New Newsletter', "f_games" ) ,
		'view_item' => __( 'View Newsletter', "f_games" ),
		'search_items' => __( 'Search Newsletters', "f_games" ),
		'not_found' =>  __( 'No Newsletters found', "f_games" ),
		'not_found_in_trash' => __( 'No Newsletters found in Trash', "f_games" ), 
		'parent_item_colon' => __( 'Parent Newsletter', "f_games" ),
		'menu_name' => __( '游戏管理', "f_games" ),
		'parent' => __( 'Parent 游戏管理', "f_games" ),
	);
	$args = array(
		'labels' => $labels,
		'public' => true, 
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'exclude_from_search' => false,
		'rewrite' => array('slug' => 'f_games'),
		'capability_type' => 'post',
		'has_archive' => true, 
		'hierarchical' => false,
		'menu_position' => false,
		'menu_icon' => ALO_EM_PLUGIN_URL.'/images/16-email-letter.png',
		'can_export' => true,
		'supports' => array( 'title' , 'editor', 'custom-fields', 'thumbnail' )
	); 
	// If it doesn't allow newsletter publication online
	if ( get_option('alo_em_publish_newsletters') == "no" ) {
		$args['public'] = false;
		$args['publicly_queryable'] = false;
		$args['show_ui'] = true;
		$args['show_in_menu'] = true;
		$args['query_var'] = false;
		$args['exclude_from_search'] = true; // TODO read here: http://jandcgroup.com/2011/09/14/exclude-custom-post-types-from-wordpress-search-do-not-use-exclude_from_search/
	}
	$args = apply_filters ( 'alo_easymail_register_newsletter_args', $args ); 
	register_post_type( 'f_games', $args );
    
    if(isset($wp_roles) && empty($wp_roles -> roles['gameuser'])){
        $role_name = 'gameuser';
        $display_name = '游戏用户';
        $capabilities = '';
        //$option = $wp_roles -> roles['subscriber']['capabilities'];
        $option = array();
        //$wp_roles  -> remove_role($role_name);
        $wp_roles  -> add_role($role_name, $display_name, $option);
    }
    
}
add_action('init', 'jia_register_jia_type');
	
/**
 * Add menu pages 
 */
function f_game_add_admin_menu() {
  	if ( current_user_can('stock_manage_games') )  {
  		add_submenu_page( 'edit.php?post_type=f_games', __("库存管理", "f_games"), __("库存管理", "f_games"), 'stock_manage_games', 'jia/f_games_ctt_stock.php' );
  	}

    global $submenu;
    foreach($submenu['edit.php?post_type=f_games'] as $key => $value){
        if($value[0] != '库存管理'){
            unset($submenu['edit.php?post_type=f_games'][$key]);
        }
    }
}
add_action('admin_menu', 'f_game_add_admin_menu');


//添加游戏到前台展示页
//function add_games($output){
//    if(defined('PAGE_STORE_game')){
//        /*$rs = wp_list_pages(array('title_li' => '', 'include' => PAGE_STORE_game, 'echo' => false));*/
//        return $output.$rs;  
//    }
//}
//add_action('wp_list_categories', 'add_games');

function fgame_load_admin($value){
    //$url = remove_query_arg(array('_wp_http_referer', '_wpnonce'), stripslashes($_SERVER['REQUEST_URI']));
    //echo $url;die();
    //print_r($_REQUEST);die();
    if ( !empty($_GET['_wp_http_referer']) ) {
    	$http_referer = urldecode($_GET['_wp_http_referer']);
        //print_r ($_REQUEST);die();
        if(strpos($http_referer, 'jia/f_games_ctt_stock.php') !== false){
    	   if(isset($_REQUEST['s']) && !empty($_REQUEST['s'])){
    	       $url = remove_query_arg(array('_wp_http_referer', '_wpnonce','s'), stripslashes($http_referer));
    	       //$http_referer .= '&s='.$_REQUEST['s'];
               $redit_url = urldecode($url).'&s='.urlencode($_REQUEST['s']);
               //$url = remove_query_arg(array('_wp_http_referer', '_wpnonce'), stripslashes($_SERVER['REQUEST_URI']))
    	   }else{
    	       $redit_url = urldecode(remove_query_arg(array('_wp_http_referer', '_wpnonce','s'), stripslashes($http_referer)));
           }
           //echo $redit_url;die();
           wp_redirect($redit_url);
    	   exit;
        }
        
    }
}
add_action('load-admin.php', 'fgame_load_admin');
add_action('load-edit.php', 'fgame_load_admin');


function fgame_ctl_user(){
    //$ctl = 'stock'; 
    //$ctl = 'user'; 
    $ctl = $_REQUEST['ctl']; 
    
    $action = empty($_REQUEST['fgame_action']) ? 'default' : $_REQUEST['fgame_action'];
    //$action = 'add_fgame_user';
    //$action = 'getshop';
    //$action = 'install';
    //echo $action;die();
    
    switch($ctl){
        case 'stock' :
            include_once( ABSPATH . 'wp-content/plugins/jia/f_games_ctl_stock.php' );
            $stock = new f_games_ctl_stock();
            $rs = $stock -> run($action, 'ajax');
            break;
        case 'user' :
            include_once( ABSPATH . 'wp-content/plugins/jia/f_games_ctl_user.php' );
            $user = new f_games_ctl_user();
            $rs = $user -> run($action, 'ajax');
            
            break;
    }
    echo json_encode($rs);
    //print_r($rs);
    exit();
            
}

//fgame_ctl_user();
//添加ajax
//do_action( 'wp_ajax_nopriv_' . $_REQUEST['action'] );
add_action( 'wp_ajax_nopriv_fgame_ctl_user' , 'fgame_ctl_user' );
add_action( 'wp_ajax_fgame_ctl_user' , 'fgame_ctl_user' );

//http://test.jfx.com/wp-admin/admin-ajax.php?action=fgame_ctl_user&fgame_action=getshop&ctl=stock&city=上海
//http://d1server/wp-admin/admin-ajax.php?action=fgame_ctl_user&fgame_action=getshop&ctl=stock&city=上海
?>