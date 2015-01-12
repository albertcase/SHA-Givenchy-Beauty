<?php 
include_once(CUSTOM_PAGE_ROOT.'mdl/mdl_new_product_location.php');

$mdl_new_product_location =new mdl_new_product_location();
//print_R($mdl_new_product_location);
//die();


$query_category_name = urldecode($wp_query -> query['category_name']);
$query_category = explode('/', $query_category_name);

if($query_category[0] == 'perfume'){
    $Select_category_name = $query_category[2];
}else{
    $Select_category_name = $query_category[0];
}

switch ($Select_category_name){
    case 'lady-perfume':
        $Select_category_class[1] = 'class="current"';   
        break;
    case 'man':
        $Select_category_class[2] = 'class="current"';   
        break;
    case 'skin-care':
        $Select_category_class[3] = 'class="current"';   
        break;
    case 'makeup':
        $Select_category_class[4] = 'class="current"';   
        break;
} 

$terms_id = $wp_query -> queried_object_id;

//$urlParams = '?type=2&fc=cat-item-'.$terms_id;

$them_root = get_bloginfo( 'template_directory', 'display' );
$img_root = $them_root.'/images/second/';    
switch($wp_query -> queried_object -> name){
    //case '粉底液':
    //    $category_top_page_img = $img_root.'second_top_1.jpg';
    //    break;
    //case '粉妆':
    //    $category_top_page_img = $img_root.'second_top_2.jpg';
    //    break;
    case '水漾活妍系列':
       $category_top_page_img = $img_root.'second_top_13.jpg';
        break;
    case '净白盈采系列':
        $category_top_page_img = $img_root.'second_top_3.jpg?v=1';
        break;
    case '墨藻珍萃系列':
        $category_top_page_img = $img_root.'second_top_4_3.jpg';
        break;
    case '特殊护理':
        $category_top_page_img = $img_root.'second_top_5.jpg';
        break;
    case '完美紧致系列':
        $category_top_page_img = $img_root.'second_top_6.jpg';
        break;
    case '笑卓欢颜系列':
        $category_top_page_img = $img_root.'second_top_7.jpg';
        break;   
    case '焕颜美肌系列':
        $category_top_page_img = $img_root.'second_top_8.jpg';
        break;   
    case '唇部':
        $category_top_page_img = $img_root.'second_top_9.jpg';
        break;   
    case '眼影':
        $category_top_page_img = $img_root.'second_top_10.jpg';
        break;   
    case '睫毛膏':
        $category_top_page_img = $img_root.'second_top_10.jpg';
        break;   
    case '粉饼':
        $category_top_page_img = $img_root.'second_top_12.jpg';
        break;   
    case '粉底液':
        $category_top_page_img = $img_root.'second_top_12.jpg';
        break;   
    case '甲油':
        $category_top_page_img = $img_root.'second_top_11.jpg';
        break;
    case '大丽诺系列':
        $category_top_page_img = $img_root.'second_top_16.jpg';
        break;	   
    
        
}


//echo $terms_id;

$query_post = $wpdb -> get_results(str_replace('LIMIT 0, 6', '', $wp_query -> request ));
$product_data =array();
foreach($query_post as $value){
    $thumbnailId = get_post_thumbnail_id($value -> ID );
    $image = wp_get_attachment_image_src($thumbnailId, 'full', false);
    $value -> product_images = $image;
    $product_data[$value -> ID ] = $value;
}
//print_r($product_data);die();

//$thumbnailMetadata = wp_get_attachment_metadata($thumbnailId);
$filter = array(
    'terms_id' => $terms_id
    //'product_id' => $thumbnailId
);
$result = $mdl_new_product_location -> get_list_page($filter, 'row_num,column_num,product_id', 1, 100);
$new_product_location_data = array();
foreach($result['data'] as $value){
    $new_product_location_data[$value -> row_num ][$value -> column_num ] = $value -> product_id;
}
krsort($new_product_location_data);
$count = 0;
foreach($new_product_location_data as $k => $v){
    $count = $k + 1;
    break;
}
include_once(CUSTOM_PAGE_ROOT.'view/second/list.html');
?>
