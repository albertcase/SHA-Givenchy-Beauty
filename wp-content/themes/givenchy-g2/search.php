<?php
/**
 * The template for displaying Search Results pages.
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
<?php if ( have_posts() ) : ?>
				<?php
				/* Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called loop-search.php and that will be used instead.
				 */
				 get_template_part( 'loop', 'search' );
				?>
<?php else : ?>
				<div id="post-0" class="post no-results not-found">
					<div class="post-left-content">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentyten' ); ?></h1>
						<div class="entry-content">
							<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentyten' ); ?></p>
							<?php get_search_form(); ?>
						</div><!-- .entry-content -->
					</div>
				</div><!-- #post-0 -->
<?php endif; ?>
			</div><!-- #content -->
		</div><!-- #container -->


<?php get_footer(); ?>
