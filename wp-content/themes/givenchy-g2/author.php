<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>
<?php get_sidebar(); ?>
		<div id="container">
			<div id="content" role="main">
				<div class="bread-crumb">
					<?php  bcn_display(); ?>
				</div>
<?php
	/* Queue the first post, that way we know who
	 * the author is when we try to get their name,
	 * URL, description, avatar, etc.
	 *
	 * We reset this later so we can run the loop
	 * properly with a call to rewind_posts().
	 */
	if ( have_posts() )
		the_post();
?>

<?php
// If a user has filled out their description, show a bio on their entries.
if ( get_the_author_meta( 'description' ) ) : ?>
	<div id="entry-author-info" class="entry-author-page">
		<div class="entry-author-bg">
			<div id="author-avatar">
				<?php echo userphoto_the_author_photo(); ?>
			</div><!-- #author-avatar -->
			<div id="author-description">
				<h2><?php the_author(); ?></h2>
				<div><?php the_author_meta( 'description' ); ?></div>
			</div><!-- #author-description	-->
		</div>
	</div><!-- #entry-author-info -->
	<div class="countAuthorPost">
		<?php the_author_posts(); ?> articles par <?php the_author(); ?>
	</div>
<?php endif; ?>

<?php
	/* Since we called the_post() above, we need to
	 * rewind the loop back to the beginning that way
	 * we can run the loop properly, in full.
	 */
	rewind_posts();

	/* Run the loop for the author archive page to output the authors posts
	 * If you want to overload this in a child theme then include a file
	 * called loop-author.php and that will be used instead.
	 */
	 get_template_part( 'loop', 'author' );
?>
			</div><!-- #content -->
		</div><!-- #container -->


<?php get_footer(); ?>
