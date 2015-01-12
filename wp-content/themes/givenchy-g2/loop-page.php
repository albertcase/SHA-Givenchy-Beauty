<?php
/**
 * The loop that displays a page.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop-page.php.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.2
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<?php switch (get_the_ID()) {
 	case PAGE_LOOK_AND_TENDANCES_LOOK_1_ID: 
//	$maxLookNumber = 5;
//	$selectedLookIndex = 1;
//	$articlesNumber = 13;
	$maxLookNumber = 5;
	$selectedLookIndex = 4;
	$articlesNumber = 11;
	$displayLookIndex = 1;
	include_once('look-tendances/home.php'); 
	
	break; 
	case PAGE_LOOK_AND_TENDANCES_LOOK_2_ID: 
	$selectedLookIndex = 2;
	$maxLookNumber = 5;
	$articlesNumber = 12;
	$displayLookIndex = 2;
	include_once('look-tendances/home.php'); 
	
	break; 
 	case PAGE_LOOK_AND_TENDANCES_LOOK_3_ID: 

	$maxLookNumber = 5;
	$selectedLookIndex = 3;
	$articlesNumber = 11;
	$displayLookIndex = 3;
	include_once('look-tendances/home.php'); 
	
	break; 
	case PAGE_LOOK_AND_TENDANCES_LOOK_4_ID:
	
//	$maxLookNumber = 5;
//	$selectedLookIndex = 4;
//	$articlesNumber = 11;
	$maxLookNumber = 5;
	$selectedLookIndex = 1;
	$articlesNumber = 13;
	$displayLookIndex = 4;
	include_once('look-tendances/home.php'); 

	break;
 	case PAGE_LOOK_AND_TENDANCES_LOOK_5_ID: 
	
	$maxLookNumber = 5;
	$selectedLookIndex = 5;
	$articlesNumber = 11;
	$displayLookIndex = 5;
	include_once('look-tendances/home.php'); 
	
 	break; 
	case PAGE_STORE_LOCATOR: 
	include_once('store-locator/home.php'); 
	
 	break; 
 	case PAGE_STORE_game: 
	 
	include_once('store-game/home.php'); 
	
 	break; 



 	default: 
?>
<div class="bread-crumb">
	<?php  bcn_display(); ?>
</div>
<div class="post-left-content">
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if ( is_front_page() ) { ?>
			<h2 class="entry-title"><?php the_title(); ?></h2>
		<?php } else { ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php } ?>

		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
			<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-## -->

	<?php // comments_template( '', true ); ?>
</div>
<?php 	break;?>
<?php } ?>
<?php endwhile; // end of the loop. ?>