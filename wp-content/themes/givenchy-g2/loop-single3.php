<?php 
define('CUSTOM_PAGE_ROOT', dirname(__FILE__).DIRECTORY_SEPARATOR.'custom-page'.DIRECTORY_SEPARATOR);
include_once(CUSTOM_PAGE_ROOT.'lib/model.php');
include_once(CUSTOM_PAGE_ROOT.'mdl/mdl_new_product_relationship.php');
//echo the_ID();
//the_title();

$product_id = get_the_ID();
$thumbnailId = get_post_thumbnail_id($product_id);
$image_url = wp_get_attachment_image_src($thumbnailId, 'full', false);

$mdl_new_product_relationship =new mdl_new_product_relationship();
$filter = array(
    'product_p' => $product_id
    //'product_id' => $thumbnailId
);
//echo $product_id;die();
//print_r($wp_query);
//die();
$result = $mdl_new_product_relationship -> get_list_page($filter, 'product_c', 1, 3, ' order by leval');
$associate_products = $result['data'];
foreach($associate_products as $key => $value){
    $associate_products[$key] -> thumbnail_id = get_post_thumbnail_id($value -> product_c );
    $posts_model = new model($wpdb -> prefix.'posts', 'ID');
    $post_rs = $posts_model -> getById($value -> product_c, 'post_title,guid');
    $associate_products[$key] -> title = $post_rs -> post_title;
    $associate_products[$key] -> url = $post_rs -> guid;
    unset($post_rs);
    //$title = wp_list_pages(array('title_li' => '', 'include' => $associate_products[$key] -> thumbnail_id, 'echo' => 0));
}


global $productType3Info,$product_id;
foreach($productType3Info[$product_id] as $key => $value){
    $posts_model = new model($wpdb -> prefix.'posts', 'ID');
    //post
    $post_rs = $posts_model -> getById($value, 'guid');
    $productType3data[$key]['thumbnail_id'] = get_post_thumbnail_id($value);   
    $productType3data[$key]['url'] = $post_rs->guid;  
    $productType3data[$key]['product_c'] = $value;  
    //$productType3data[$key]['url'] = $post_rs[0]->guid;
    //$associate_products[$key]['title'] = $post_rs -> post_title;
    //$associate_products[$key]['url'] = $post_rs -> guid;   
    unset($post_rs);
}


//var_dump($associate_products);
//die();
include_once( ABSPATH . 'wp-admin/includes/topimg.php' );
$topimg_url = get_topimg($product_id);

function del_str_by_str($str, $stare_str, $end_str){
    $first = strpos($str, $stare_str); 
    $end = strpos($str, $end_str); 
    if($first == false || $end == false){
        return $str;
    }
    $rpl_str = substr($str, $first, $end - $first + strlen($end_str));
    return str_replace($rpl_str, '', $str);
}

//print_r($associate_products);die();
if ( have_posts() ){
    while ( have_posts() ){
        the_post();
        function a(){
            
        }
        ob_start('a');
        the_content();
        
        $content = ob_get_clean();
        //$thumbnailId = -1;
        $content_txt = get_the_content($more_link_text, $stripteaser);
    	//$content_txt = apply_filters('the_content', $content);
    	$content_txt = str_replace(']]>', ']]&gt;', $content);
        $content_txt = del_str_by_str($content_txt, '<script', '</span>');
        include_once(CUSTOM_PAGE_ROOT.'view/second/new_product02.html');
    }
} 




?>