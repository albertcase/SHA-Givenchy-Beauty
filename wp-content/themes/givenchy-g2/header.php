<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />


<title><?php
    do_action('jia_url_rewrite');
    global $ischange_request_match ;
    if($ischange_request_match){
        if($wp_query ->query['category_name'] == '护肤/明星产品-护肤'){
            $new_title = '护肤';
        }else if($wp_query ->query['category_name'] == '彩妆/明星产品-彩妆'){
            $new_title = '彩妆';
        }else if($wp_query ->query['category_name'] == '香水/明星产品-香水'){
            $new_title = '香水';
        }else if($wp_query ->query['category_name'] == 'home-products'){
            $new_title = '首页';
        }
        echo $new_title.' | 纪梵希-中国';
    }else{
        /*
    	 * Print the <title> tag based on what is being viewed.
    	 */
    	global $page, $paged;
    
    	wp_title( '|', true, 'right' );
    
    	// Add the blog name.
    	bloginfo( 'name' );
    
    	// Add the blog description for the home/front page.
    	$site_description = get_bloginfo( 'description', 'display' );
    	if ( $site_description && ( is_home() || is_front_page() ) )
    		echo ""; // | $site_description";
    
    	// Add a page number if necessary:
    	if ( $paged >= 2 || $page >= 2 )
    		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );
    }


	?></title>
<meta name="description" content="<?php if ( is_single() ) {
        single_post_title('', true); echo ' '; echo strip_tags(get_the_excerpt()); 
    } else {
        bloginfo('name'); echo " - "; bloginfo('description');
    }
    ?>" /> 
<meta name="Robots" content="all"/> 
<meta name="keywords" content="纪梵希,彩妆,护肤,香水" />
    
<link rel="profile" href="http://gmpg.org/xfn/11" />




<style type="text/css">
@font-face { 
    font-family: 'FuturaBook';
    src: url('<?php bloginfo('template_directory'); ?>/fonts/futura_book_bt-webfont.eot');
    src: url('<?php bloginfo('template_directory'); ?>/fonts/futura_book_bt-webfont.eot?iefix') format('eot'),
         url('<?php bloginfo('template_directory'); ?>/fonts/futura_book_bt-webfont.woff') format('woff'),
         url('<?php bloginfo('template_directory'); ?>/fonts/futura_book_bt-webfont.ttf') format('truetype'),
         url('<?php bloginfo('template_directory'); ?>/fonts/futura_book_bt-webfont.svg#webfontOgNegxMI') format('svg');
    font-weight: normal;
    font-style: normal;
} 
</style>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/style.css?20130427" />

<!--<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/js/lightview/2.5.2.1/css/lightview.css" />-->


<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
	
?>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/prototype/prototype.js"></script>

	<!--<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE*" />-->
	<?php
		
		if(is_page(' 319')){
			$them_root = get_bloginfo( 'template_directory', 'display' );
			echo '<script type="text/javascript" src="'.$them_root.'/js/scriptaculous/scriptaculous.js"></script>';
		//	echo '<script type="text/javascript" src="'.$them_root.'/js/zoomer.js"></script>';
		//	echo '<script type="text/javascript" src="'.$them_root.'/js/livepipe.js"></script>';
		//	echo '<script type="text/javascript" src="'.$them_root.'/js/scrollbar.js"></script>';
		//	echo '<script type="text/javascript" src="'.$them_root.'/js/lightview/2.5.2.1/js/lightview.js"></script>';
		}
	?>
    <?php if (get_the_ID() == PAGE_STORE_LOCATOR) :?>
        <script type="text/javascript" src="http://www.google.com/jsapi"></script>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <?php endif;?>
    <?php /**
     *
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jsapi.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/js.js?sensor=true"></script>
     *

     **/?>
    <?php
    
        if(!defined('UN_LOAD_WP_JQUERY')){
            $them_root = get_bloginfo( 'template_directory', 'display' );
            echo '<script type="text/javascript" src="'.$them_root.'/js/jquery.js"></script>';
        }
        
    ?>
  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/PageBase.class.js"></script>
  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/store-locator/StoreLocator.class.js?version=20120701"></script>
	
    <?php
        if(get_the_ID() == PAGE_STORE_game){
            $them_root = get_bloginfo( 'template_directory', 'display' );
            $css_root = $them_root.'/css/store-game/';
            $js_root = $them_root.'/js/store-game/';
            $img_root = $them_root.'/images/store-game/';
            echo '<link type="text/css" href="'.$css_root.'reset.css" rel="stylesheet"  />'."\r\n";
            echo '<link type="text/css" href="'.$css_root.'global.css?9.3" rel="stylesheet" />'."\r\n";
            echo '<script type="text/javascript" src="'.$js_root.'jquery-1.7.2.js"></script>'."\r\n";
            echo '<script type="text/javascript" src="'.$js_root.'tiger.js?version=91413"></script>'."\r\n";
            echo '<script type="text/javascript" src="'.$js_root.'jquery.blockUI.js?version=91413"></script>'."\r\n";
            echo '<script type="text/javascript" src="'.$js_root.'form_submit.js?version=91413"></script>'."\r\n";

        }
    ?>
	<script type="text/javascript">
    givenchyFc = 'cat-item-<?php  global $term_category_id; echo isset($term_category_id) ? $term_category_id : $wp_query -> queried_object_id;?>';
	var index;
	function init() {
	<?php if (get_the_ID() == PAGE_STORE_LOCATOR) {?>
			index = new StoreLocator();
	<?php } else { ?>
			index = new PageBase();
	<?php } ?>
		}
		document.observe('dom:loaded', init);
	</script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/html5media.min.js"></script>
</head>

<body <?php body_class(); ?>>
<div id="wrapper" class="hfeed">

	<div id="main">
