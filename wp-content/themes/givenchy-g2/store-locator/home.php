<?php

$imgPath = get_bloginfo('template_directory').'/images/store-locator/';

?>
<div id="map-loading" style="display: none;"><div></div><img src="<?=$imgPath;?>ajax-loader.gif" border="0"/></div>
<input type="hidden" id="imgPath" value="<?=$imgPath;?>"/>
<input type="hidden" id="text_perfume" value="<?=__('perfume', 'store-locator');?>"/>
<input type="hidden" id="text_makeup" value="<?=__('makeup', 'store-locator');?>"/>
<input type="hidden" id="text_care" value="<?=__('care', 'store-locator');?>"/>
<input type="hidden" id="text_spa" value="<?=__('spa', 'store-locator');?>"/>

<div id="locator_content">
	<div id="map_title"><img src="<?=$imgPath;?><?=__('lang', 'store-locator');?>/salesPoints.png" border="0"/></div>
	
	<div id="search_container"></div>		
	<div class="search_switch" id="search_foldout"><img src="<?=$imgPath;?>fold_out.png" border="0"/></div>
	<div class="search_switch" style="display: none;" id="search_foldin"><img src="<?=$imgPath;?>fold_in.png" border="0"/></div>
	<div id="search_title"><?= __('find-sales-point', 'store-locator');?></div>
	<div id="search_separator"></div>
	
	<div id="search_details" style="display: none;">
		<table>
			<tr>
				<td colspan="2" width="178px"><?= __('search-for-sales-point', 'store-locator');?></td>
				<td colspan="3"><span class="screen-input"><?= __('default-query', 'store-locator');?></span><input name="searchQuery" id="searchQuery" class="text" type="text" value=""/></td>
				<td id="goSearch" rowspan="2"><img id="map-geolocate" src="<?=$imgPath;?><?=__('lang', 'store-locator');?>/goSearch.png" border="0"/></td>				
			</tr>
			<tr style="display:none;">
				<td><?= __('Produits :', 'store-locator');?></td>
				<td class="tdc"><input type="checkbox" id="searchPerfume" class="check"> <?= __('perfume', 'store-locator');?></td>
				<td class="tdc"><input type="checkbox" id="searchMakeup" class="check"> <?= __('makeup', 'store-locator');?></td>
				<td class="tdc"><input type="checkbox" id="searchCare" class="check"> <?= __('care', 'store-locator');?></td>
				<td class="tdc"><input type="checkbox" id="searchSpa" class="check"> <?= __('spa', 'store-locator');?></td>
			</tr>
		</table>
	</div>
	
	<div id="map_canvas"></div>
	
	<img id="map-zoom-in" src="<?=$imgPath;?>map/zoom_in.png" border="0"/>
	<img id="map-zoom-out" src="<?=$imgPath;?>map/zoom_out.png" border="0"/>
	
	<div id="map-locate-me" style="display:none;">
		<div id="map-locate-me-bg"></div>
		<div id="map-locate-me-content">
			<img style="margin-bottom: 20px;" src="<?=$imgPath;?><?=__('lang', 'store-locator');?>/locateMe.png" border="0"/><br/>
			<?= __('locate-me', 'store-locator');?>
			<img id="map-locate-me-refuse" src="<?=$imgPath;?><?=__('lang', 'store-locator');?>/locateMe-refuse.png" border="0"/>
			<img id="map-locate-me-accept" src="<?=$imgPath;?><?=__('lang', 'store-locator');?>/locateMe-accept.png" border="0"/>			
			
		</div>
	</div>
	
</div>
