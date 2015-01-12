<?php
/*
Template Name: custom-page
*/
//$game_dir_root = ABSPATH . 'wp-content/themes/givenchy-g2/store-game'; 
$page_id = get_the_ID();
$page_data = get_post($id, OBJECT);
$custom_page_root = '';
$option = get_custom_page_option();
//define('custom-page-root', WP_CONTENT_DIR.'wp-content/plugins/jia/f_games_mdl_'.$name.'.php');
define('CUSTOM_PAGE_ROOT', dirname(__FILE__).DIRECTORY_SEPARATOR.'custom-page'.DIRECTORY_SEPARATOR);

$ctl_name = $option[$page_data -> post_name];
//$ctl_name = '';

//var_dump($ctl_name);
if(empty($ctl_name)){
    status_header( 404 );
	die( '404 &#8212; page not found.' );
}
include_once(CUSTOM_PAGE_ROOT.'lib/control.php');
include_once(CUSTOM_PAGE_ROOT.'lib/model.php');
include_once(CUSTOM_PAGE_ROOT.'ctl/'.$ctl_name.'.php');

//http://test.jfx.com/user-admin/?action=login
$action = empty($_REQUEST['action']) ? 'index' : $_REQUEST['action'];

$ctl = new $ctl_name ();
$ctl -> request_url = network_site_url('/'.$page_data -> post_name.'/');
$ctl = $ctl -> run($action);
//echo 3444;
//echo $page_id;
//print_r($page_data); control.php   model.php
//if ( have_posts() ){
//    while ( have_posts() ){
//        the_post(); 
//        get_the_ID();
//        $page_data = get_post($id, OBJECT);
//        
//    }
//} 
?>
