<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

<?php get_sidebar(); ?>
		<div id="container">
			<div id="content" role="main">
				
				<div class="post-previews">
				
					<?php 
						$size = array('width' => 410, 'height' => 250);
					?>
					<div class="post-preview post-preview-1" style="width: <?php echo $size['width']; ?>px; height: <?php echo $size['height']; ?>px;">
						<h2 class="entry-title" style="width: <?php echo $size['width'] - 20; ?>px;">
							<a href="<?php echo get_page_link(PAGE_LOOK_AND_TENDANCES_LOOK_1_ID);?>" rel="bookmark">
								<?php echo __('Looks &amp; Tendances', 'givenchyg2'); ?>
							</a>
						</h2>
						<div class="img-wrapper" >
							<a href="<?php echo get_page_link(PAGE_LOOK_AND_TENDANCES_LOOK_1_ID);?>">
								<img src="<?php bloginfo('template_directory'); ?>/images/home/LookAndTendances.jpg" alt""/>
							</a>
						</div>
							
					</div>
					  
					<!-- -------------------------------------------------------- -->
					<?php query_posts( array( 'cat' => CATEGORY_INSPIRATION_COUTURE_ID, 'posts_per_page' => 1, 'order' => 'DESC' ) );?>
					<?php $category = get_category(CATEGORY_INSPIRATION_COUTURE_ID ); // post can be in multiple categories ?>
					<?php while ( have_posts() ) : the_post(); ?>
					
					<?php 
						$size = array('width' => 280, 'height' => 250);
						$thumbnailId = get_post_thumbnail_id();
						$thumbnailMetadata = wp_get_attachment_metadata($thumbnailId);
						$thumbnailSize = $thumbnailMetadata;
					?>
					<div class="post-preview post-preview-3 post-preview-odd" style="width: <?php echo $size['width']; ?>px; height: <?php echo $size['height']; ?>px;">
						<h2 class="entry-title" style="width: <?php echo $size['width'] -20; ?>px;">
							<a href="<?php echo get_permalink(); //echo get_category_link($category->term_id); ?>" rel="bookmark">
								<span class="small"><?php echo $category->name; ?></span>
								<span class="font17px"><?php echo the_title(); ?></span>
							</a>
						</h2>
						<div class="img-wrapper" style="left: <?php echo round(($size['width'] - $thumbnailSize['width']) / 2) ; ?>px; top: <?php echo round(($size['height'] - $thumbnailSize['height']) / 2) ; ?>px">
							<a href="<?php echo get_permalink(); //echo get_category_link($category->term_id); ?>">
								<?php echo wp_get_attachment_image($thumbnailId, 'full'); ?>
							</a>
						</div>
						
					</div>
					<?php endwhile; ?>
					  

					
					<!-- -------------------------------------------------------- -->
					
					
					
					<!-- -------------------------------------------------------- -->
						<div class="post-preview post-preview-3 home-citation" style="width: 340px; height: 175px;">	
						<div class="playWrapper" style="overflow: hidden; position: relative;">
						<?php 
						global $blog_id;
						switch ($blog_id) {
							case 1: // france
								$cat = 169;
							break;	
							case 2: // ch_zn
								$cat = 86;
							break;
							
						}	
						?>	
						<?php query_posts( array( 'cat' => $cat, 'posts_per_page' => 1, 'order' => 'DESC' ) );?>
						<?php $category = get_category($cat ); // post can be in multiple categories ?>
						<?php while ( have_posts() ) : the_post(); ?>
						
						<?php 
							$size = array('width' => 340, 'height' => 180);
							$thumbnailId = get_post_thumbnail_id();
							$thumbnailMetadata = wp_get_attachment_metadata($thumbnailId);
							$thumbnailSize = $thumbnailMetadata;
						?>	
							<div class="img-wrapper" style=" background-color: #000; left: <?php echo round(($size['width'] - $thumbnailSize['width']) / 2) ; ?>px; top: <?php echo round(($size['height'] - $thumbnailSize['height']) / 2) ; ?>px">
								<a href="<?php echo get_permalink(); //echo get_category_link($category->term_id); ?>">
									<?php echo wp_get_attachment_image($thumbnailId, 'full'); ?>
								</a>
							</div>
							<h2 class="entry-title" style="width: 320px;">
								<a class="font17px" href="<?php echo get_permalink(); //echo get_category_link($category->term_id); ?>"><?php echo the_title(); ?></a>
							</h2>
							
						</div>
						<?php endwhile; ?>
						
					</div>
					<!-- -------------------------------------------------------- -->
					<?php query_posts( array( 'cat' => 3, 'posts_per_page' => 1, 'order' => 'DESC' ) );?>
					<?php $category = get_category(3); // post can be in multiple categories ?>
					<?php while ( have_posts() ) : the_post(); ?>
					
					<?php 
						$size = array('width' => 350, 'height' => 350);
						$thumbnailId = get_post_thumbnail_id();
						$thumbnailMetadata = wp_get_attachment_metadata($thumbnailId);
						$thumbnailSize = $thumbnailMetadata;
					?>
					<div class="post-preview post-preview-3 post-preview-odd" style="width: <?php echo $size['width']; ?>px; height: <?php echo $size['height']; ?>px;">
						<h2 class="entry-title" style="width: <?php echo $size['width'] -20; ?>px;">
							<a href="<?php echo get_permalink(); ?>" rel="bookmark">
								<span class="small"><?php echo $category->name; ?></span>
								<span class="font17px"><?php echo the_title(); ?></span>
							</a>
						</h2>
						<div class="img-wrapper" style="left: <?php echo round(($size['width'] - $thumbnailSize['width']) / 2) ; ?>px; top: <?php echo round(($size['height'] - $thumbnailSize['height']) / 2) ; ?>px">
							<a href="<?php echo get_permalink(); ?>">
								<?php echo wp_get_attachment_image($thumbnailId, 'full'); ?>
							</a>
						</div>
						
					</div>
					<?php endwhile; ?>
					  
					
				</div>
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>
