<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
define('CUSTOM_PAGE_ROOT', dirname(__FILE__).DIRECTORY_SEPARATOR.'custom-page'.DIRECTORY_SEPARATOR);
include_once(CUSTOM_PAGE_ROOT.'lib/model.php');
include_once(CUSTOM_PAGE_ROOT.'mdl/mdl_new_terms.php');
$terms_id = $wp_query -> queried_object_id;
$mdl_new_terms_model = new mdl_new_terms();
$filter = array(
    'terms_id' => $terms_id
);

function addnewUrl($url){
    global $wp_query;
    //return $url.'?fc=cat-item-'.$wp_query -> queried_object_id;
    return $url;
}
add_action('the_permalink', addnewUrl);

$result_terms = $mdl_new_terms_model -> get_list_page($filter, 'id', 1, 1);
if($wp_query ->post_count == 1){
	if($wp_query->posts[0]->post_title != '魅彩甲油'){
		$url = apply_filters('the_permalink', get_permalink()); 
		//echo "<script type='text/javascript'> location.href = '$url'; </script>";
		//ob_clean();
		//ob_start();
	   
		header("Location: ".$url);    
		exit(); 
	}

       
}


if(!empty($result_terms['data'])){
    global $jia_header_css;
    $jia_header_css = array('second/reset.css', 'second/products_list.css' );
    add_action('wp_head','jia_add_header');
}

get_header(); ?>
<?php get_sidebar(); ?>
		<div id="container">
			<div id="content" role="main">

<?php

if(empty($result_terms['data'])){
    if ( !($ischange_request_match && $wp_query ->query['category_name'] == '首页产品') ){
        echo '<div class="bread-crumb">';
        bcn_display();
        echo '</div>';
    }
    /* Run the loop for the category page to output the posts.
    * If you want to overload this in a child theme then include a file
    * called loop-category.php and that will be used instead.
    */
    get_template_part( 'loop', 'category' );
}else{
    get_template_part( 'loop2', 'category' );
}


?>

			</div><!-- #content -->
		</div><!-- #container --> 
		
				


<?php get_footer(); ?>
