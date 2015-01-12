<?php 
$imgPath = get_bloginfo('template_directory').'/images/look-tendances/';

if ($displayLookIndex == $maxLookNumber) {
	$nextLookIndex = 1;
	$previousLookIndex = $maxLookNumber - 1;
} else if ($displayLookIndex == 1) {
	$nextLookIndex = 2;
	$previousLookIndex = $maxLookNumber;
} else {
	$nextLookIndex = $displayLookIndex + 1;
	$previousLookIndex = $displayLookIndex - 1;
}

$previousLookUrl = get_page_link(constant('PAGE_LOOK_AND_TENDANCES_LOOK_'.$previousLookIndex.'_ID'));
$nextLookUrl = get_page_link(constant('PAGE_LOOK_AND_TENDANCES_LOOK_'.$nextLookIndex.'_ID'));
?>

<div id="look-tendances">
	<div id="content">
		<div class="faceContainer">
			<a hidefocus="hidefocus" href="<?php echo $imgPath; ?>look<?php echo $selectedLookIndex; ?>/face-large.jpg" id="faceWrapper">
				<img src="<?php echo $imgPath; ?>look<?php echo $selectedLookIndex; ?>/face.jpg" alt="" />
			</a>
			<div class="number">0<?php echo $displayLookIndex; ?></div>
			<div class="arrowLeft"><a href="<?php echo $previousLookUrl; ?>"><img src="<?php echo $imgPath; ?>shared/left-arrow.jpg" alt="" /></a></div>
			<div class="arrowRight"><a href="<?php echo $nextLookUrl; ?>"><img src="<?php echo $imgPath; ?>shared/right-arrow.jpg" alt="" /></a></div>
			<a id="zoom"></a>
			<div class="popupWrapperContainer">
				<div id="descriptionPopup" class="popupWrapper" style="display: none;">
					<a class="close"></a>
					<div class="scrollbar_track"><div class="scrollbar_handle"></div></div>
					<div class="popup scrollbar_container">
						<div class="scrollbar_content">
							<h1>
								<?php if($selectedLookIndex==1){echo __('都市名媛');}?>
								<?php if($selectedLookIndex==2){echo __('干练御姐');}?>
								<?php if($selectedLookIndex==3){echo __('title3');}?>
								<?php if($selectedLookIndex==4){echo __('幻变电眼');}?>
								<?php if($selectedLookIndex==5){echo __('title5');}?>
							<!--<?php echo __('look'.$selectedLookIndex.'-title', 'look-tendances'); ?>--></h1>
							<p align="justify" style="width: 230px;">
								<?php echo __('look'.$selectedLookIndex.'-description', 'look-tendances'); ?>
							</p>
						</div>
					</div>
				</div>
				<div id="applicationPopup" class="popupWrapper" style="display: none;">
					<a class="close"></a>
					<div class="scrollbar_track"><div class="scrollbar_handle"></div></div>
					<div class="popup scrollbar_container">
						<div class="scrollbar_content">
							<?php /* ?>
							<h1><?php echo __("Conseils d'applications", 'look-tendances'); ?></h1>
							<?php */ ?>
							
							<?php 
							$imageCount = 0;
							
							$list = array('Skincare', 'Complexion', 'Eyebrows', 'Eyes', 'Lips'); 
							$count = count($list);
							for ($i = 0; $i < $count; $i++) {
								$item = $list[$i];
								echo '<h2>'.__($item, 'look-tendances').'</h2>';
								$str = __('look'.$selectedLookIndex.'-application-'.$item, 'look-tendances');
								$strSplit = explode('<p>', $str);
								$strSplitCount = count($strSplit);
								
								for ($j = 1; $j < $strSplitCount; $j++) { $imageCount++; $strItem = $strSplit[$j]; ?>
									<div class="application-item-container">
										<div style="float:left; width: 160px;">
											<img src="<?php echo $imgPath.'look'.$selectedLookIndex ?>/look-<?php echo $imageCount; ?>.jpg" />
										</div>
										<div style="float:left; width: 320px;">
											<?php echo '<p align="justify">'.$strItem; ?>
										</div>
									</div>
							<?php }
							}
							?>
						</div>
					</div>
				</div>
				<div id="productPopup" class="popupWrapper" style="display: none;">
					<a class="close"></a>
					<div class="scrollbar_track"><div class="scrollbar_handle"></div></div>
					<div class="popup scrollbar_container">
						<div class="scrollbar_content">
							<?php /* ?>
							<h1><?php echo __("Produits du look", 'look-tendances'); ?></h1>
							<?php */ ?>
							<?php 
								$text = __("look".$selectedLookIndex."-products", 'look-tendances');	
								$split = explode('|', $text);	
								$canceled = 0;					
							?>
							<?php for ($i = 1; $i <= $articlesNumber; $i++) { 
								$item = $split[$i -1]; 
								$split2 = explode('::', $item);
								$text = $split2[0];
								if (strpos($text, '#') !== false) {
									$canceled++;
									continue;
								}
								$link = @$split2[1];
							?>
							<div class="product">
								<?php if ($link != '') {?>
								<a href="<?php echo $link; ?>" target="_blank">
								<?php } ?>
									<img alt="<?php echo $text; ?>" src="<?php echo $imgPath; ?>look<?php echo $selectedLookIndex; ?>/product<?php echo $i; ?>.jpg" />
								<?php if ($link != '') {?>
								</a>
								<?php } ?>
								<div align="center">
									<?php if ($link != '') {?>
									<a href="<?php echo $link; ?>" target="_blank">
									<?php } ?>
										<?php echo $text; ?>
									<?php if ($link != '') {?>
									</a>
									<?php } ?>
								</div>
							</div>
							<?php } ?>
							<?php $num = $articlesNumber - $canceled; ?>
							<?php if ($num % 3 != 0) { ?>
								<?php for ($i = 0; $i < 3 - ($num % 3); $i++) { ?>
									<div class="product no-product"></div>
								<?php } ?>
							<?php } ?>
						</div>	
					</div>
				</div>
				<div id="commentPopup" class="popupWrapper" style="display: none;">
					<a class="close"></a>
					<div class="popup">
						<?php comments_template( '/look-tendances/comments.php', true ); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="footer">
			<div class="addthis_toolbox addthis_default_style ">
				<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
				<a class="addthis_button_tweet"></a>
			</div>
			<ul id="menu">
				<li><a name="descriptionPopup" href="#description"><?php echo __('Description', 'look-tendances'); ?></a></li>	
				<li><a name="applicationPopup" href="#application"><?php echo __("Conseils d'applications", 'look-tendances'); ?></a></li>	
				<li><a name="productPopup" href="#product"><?php echo __("Produits du look", 'look-tendances'); ?></a></li>	
				<li><a name="commentPopup" href="#comment" class="num-comments"><?php comments_number('0', '1', '%'); ?></a></li>	
			</ul>
		</div>
	</div>
	
	<ol id="tabs">
		<li class="navigator">
			<a href="<?php echo $previousLookUrl; ?>"><img src="<?php echo $imgPath; ?>shared/up.jpg" alt="" /></a>
			<a href="<?php echo $nextLookUrl; ?>"><img src="<?php echo $imgPath; ?>shared/down.jpg" alt="" /></a>
		</li>
		<?php for ($i = 1; $i <= 5; $i++) {?>
		<li class="tab<?php echo ($i == $displayLookIndex) ? ' selected' : ''; ?>">
			<a href="<?php echo get_page_link(constant('PAGE_LOOK_AND_TENDANCES_LOOK_'.$i.'_ID')); ?>"><span>0<?php echo $i; ?></span></a> 
		</li>
		<?php } ?>
	</ol>
</div>
<div id="modalCommentWrapper" style="display:none">
	<div id="modalComment">
		<div class="modalCommentContent">
			<strong class="pseudo"></strong><br />
			<div class="date"></div>
			<p class="text"></p>
		</div>
	</div>
</div>