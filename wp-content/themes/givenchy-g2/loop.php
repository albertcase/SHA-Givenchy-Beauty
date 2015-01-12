<?php 
function getPostPreviewSize($index) {
	$sizes = array();
	switch ($index) {
		case 1:
			$sizes['width'] = 345;
			$sizes['height'] = 290; //330;
		break;	
		case 2:
			$sizes['width'] = 345;
			$sizes['height'] = 290; //330;
		break;	
		case 3:
			$sizes['width'] = 345;
			$sizes['height'] = 290;
		break;	
		case 4:
			$sizes['width'] = 345;
			$sizes['height'] = 290;
		break;	
		case 5:
			$sizes['width'] = 345;
			$sizes['height'] = 290;
		break;	
		case 6:
			$sizes['width'] = 345;
			$sizes['height'] = 290;
			$sizes['height'] = 290;
		break;	
	}
	return $sizes;
}

?>
<div class="post-previews">	 
<?php $postCount = 0;  ?>

<?php while ( have_posts() ) : the_post(); ?>
<?php 	
		  
$thumbnailId = get_post_thumbnail_id();
if (!$thumbnailId) continue;
$postCount++;
$thumbnailMetadata = wp_get_attachment_metadata($thumbnailId);
$thumbnailSize = $thumbnailMetadata;
$size = getPostPreviewSize($postCount);
?>		
	<div class="post-preview post-preview-<?php echo $postCount; ?> <?php echo $postCount % 2 == 0 ? ' post-preview-odd' : ''; ?>" style="width: <?php echo $size['width']; ?>px; height: <?php echo $size['height']; ?>px;">
		<h2 style="width:<?php echo $size['width'] - 20; ?>px" class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark">
				<?php the_title(); ?><span></span>
			</a>
		</h2>
		<div class="img-wrapper">
			<a href="<?php the_permalink(); ?>">
				<?php echo wp_get_attachment_image($thumbnailId, 'full',false,'',array('height' => 290 ,'width' => 345)); ?>
			</a>
		</div>
		<div class="entry-stats">
			<div class="num-comments">
				<?php comments_number('0', '1', '%'); ?>
			</div>
			<div class="num-likes">
				<div class="addthis_toolbox addthis_default_style ">
					<a class="addthis_button_facebook_like" fb:like:layout="button_count"  addthis:url="<?php echo the_permalink(); ?>"></a>
				</div>
			</div>
		</div>
	</div>
<?php endwhile; ?>
</div>	

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
<div id="nav-below" class="navigation">
	<div class="nav-previous"><?php next_posts_link( __( 'Articles pr&eacute;c&eacute;dents', 'givenchyg2' ) ); ?></div>
	<div class="nav-next"><?php previous_posts_link( __( 'Articles suivants', 'givenchyg2' ) ); ?></div>
</div><!-- #nav-below -->
<?php endif; 

