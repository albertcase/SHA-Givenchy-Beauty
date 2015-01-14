<?php
/**
 * The loop that displays a single post.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop-single.php.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.2
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php 
// detecting youtube
function a() {}
ob_start('a');
the_content();
$content = ob_get_clean();
$thumbnailId = -1;
if (strpos($content, 'http://www.youtube') === false && strpos($content, 'video-js-box') === false) {
	$thumbnailId = get_post_thumbnail_id();
}
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-left">
		<div class="bread-crumb">
			<?php  bcn_display(); ?>
		</div>
		<div class="post-left-content"> 
			<h1 class="entry-title"><?php the_title(); ?></h1> 
			<div class="entry-meta">
				<?php twentyten_posted_on(); ?>
				
				<!--
				<div class="addthis_toolbox addthis_default_style ">
					<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
					<a class="addthis_button_tweet"></a>
					<a class="addthis_counter addthis_pill_style"></a>
				</div>
				-->
				
			</div><!-- .entry-meta -->
			<?php if ($topimg_url) { ?>
			<div class="entry-image">
            <!--
                <?php //$attach =  wp_get_attachment_image_src($thumbnailId, 'full'); ?>
				<img src="<?php //echo $attach[0]; ?>" width="470" alt="" />
            -->
				<?php 
                    $id = get_the_ID();
                    include_once( ABSPATH . 'wp-admin/includes/topimg.php' );
                    $topimg_url = get_topimg($id);
                ?>
				<img src="<?php echo $topimg_url; ?>" width="470" alt="" />
            </div>
			<?php } ?>
			
			<div class="entry-content">
				<?php the_content(); ?>
				<!-- Baidu Button BEGIN -->
				<div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare">
				<!--<a class="bds_qzone"></a>
				<a class="bds_tsina"></a>
				<a class="bds_tqq"></a>
				<a class="bds_renren"></a>
				<a class="bds_t163"></a>-->
				<span class="bds_more">分享</span>
				<!--<a class="shareCount"></a>-->
				</div>
				<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=0" ></script>
				<script type="text/javascript" id="bdshell_js"></script>
				<script type="text/javascript">
				document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
				</script>
				<!-- Baidu Button END -->
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->
		
			<div class="entry-utility">
				<?php twentyten_posted_in(); ?>
				<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-utility -->
		</div>
	</div><!-- #post-## -->
	<div class="post-right">
		<div class="post-right-content">
			<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
			<div id="entry-author-info">
				<h2><span><?php printf( esc_attr__( 'About %s', 'twentyten' ), '' ); ?></span><?php echo get_the_author(); ?></h2>
				<div id="author-avatar">
					<?php echo userphoto_the_author_photo(); ?>
				</div><!-- #author-avatar -->
				<div id="author-description">
					<?php echo wp_html_excerpt(get_the_author_meta( 'description' ), 200); ?>...
					<div id="author-link">
						<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
							<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'twentyten' ), get_the_author() ); ?><span class="arrow-small"></span>
						</a>
					</div><!-- #author-link	-->
				</div><!-- #author-description -->
			</div><!-- #entry-author-info -->
			<?php endif; ?>
			<?php comments_template( '', true ); ?>
		</div>
	</div>
</div>
<div id="nav-below" class="navigation">
	<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '', 'Previous post link', 'twentyten' ) . '</span> %title' ); ?></div>
	<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '', 'Next post link', 'twentyten' ) . '</span>' ); ?></div>
</div><!-- #nav-below -->

<?php 
$res = apply_filters('erp-get-related-posts', array('title'=>__('D&eacute;couvrez aussi', 'givenchyg2'), 'num_to_display'=>5, 'no_rp_text'=>'No Related Posts Found')); 
if (strpos($res, 'No Related Posts Found') === false) { 
	echo '<div id="related-post">'.$res.'<div>';
} 
?>

<?php endwhile; // end of the loop. ?>

<div id="modalCommentWrapper" style="display:none">
	<div id="modalComment">
		<div class="modalCommentContent">
			<strong class="pseudo"></strong><br />
			<div class="date"></div>
			<div class="aboveQuote">&nbsp;</div>
			<p class="text"></p>
			<div class="belowQuote">&nbsp;</div>
		</div>
	</div>
</div>