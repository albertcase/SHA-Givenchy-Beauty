<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ) ?>" >
	<div><label class="screen-reader-text" for="s"><?php echo __('Search'); ?></label>
	<input type="text" value=" <?php echo get_search_query() ?>" name="s" id="s" />
	<input type="hidden" value="true" name="newsearch" id="newsearch" />
	<input type="submit" id="searchsubmit" value="OK" />
	</div>
</form>