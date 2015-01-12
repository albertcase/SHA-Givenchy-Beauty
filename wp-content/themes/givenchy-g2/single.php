<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

$term_category_id = '';
if(empty($_GET['fc'])){
    $bcn_object = get_the_terms($post->ID, 'category');
    
    $bcn_object_partent = array();
    foreach($bcn_object as $k => $v){
        if($v->name == '首页产品'){
            unset($bcn_object[$k]);
            continue;
        }else if($v->name == '明星产品' && $v->parent == 0){
            unset($bcn_object[$k]);
            continue;
        }
        
        if($v->parent != 0){
            $bcn_object_partent[] = $v->parent;
        }
    }
    foreach($bcn_object as $k => $v){
        if(!in_array($k, $bcn_object_partent)){
            $term_category_id = $k;
            break;
        }
    }    
}



$product_id = get_the_ID();

$theme_value = get_post_meta($product_id, 'theme_type_value', true);  

$productType3Info = getProductType3Info();
$productType3InfoName = array_keys($productType3Info);
$type3 = false;
if(in_array($product_id, $productType3InfoName) || $theme_value == 3 ){
    $type3 = true;
}

if($theme_value == 2 || $type3){
    global $jia_header_css, $jia_header_js;
    $jia_header_css = array('second/reset.css', 'second/products_list.css', 'second/jquery.jqzoom.css' );
    $jia_header_js = array('second/jquery-1.7.2.js', 'second/jquery.jqzoom-core.js' );
    add_action('wp_head','jia_add_header');
    define('UN_LOAD_WP_JQUERY', true);
}

get_header(); ?>
<?php get_sidebar(); ?>
		<div id="container">
			<div id="content" role="main">
			<?php
			/* Run the loop to output the post.
			 * If you want to overload this in a child theme then include a file
			 * called loop-single.php and that will be used instead.
			 */
            
            //echo $page_title;
            //print_r($productType3InfoName);
            //var_dump(in_array($page_title, $productType3InfoName));
            //die();
            
            if($type3){
			    get_template_part( 'loop', 'single3' );
			}else if(!empty($theme_value) && $theme_value == 2 ){
                get_template_part( 'loop', 'single2' );
			}else{
                get_template_part( 'loop', 'single' );
			}
            
            ?>

			</div><!-- #content -->
		</div><!-- #container -->


<?php get_footer(); ?>
