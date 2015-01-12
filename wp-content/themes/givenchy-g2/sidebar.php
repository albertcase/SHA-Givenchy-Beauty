<div id="primary" class="widget-area" role="complementary">
	<a class="logo" href="<?php echo home_url( '/' ); ?>">
		<img src="<?php bloginfo('template_directory'); ?>/images/menu/logo.jpg" width="182" height="44" />
	</a>
	
	
    <?php 
        if(is_user_logged_in()){
            $user_info = wp_get_current_user();
            echo '<div class="second-login"><a href="'.network_site_url('user-admin/?action=user_admin').'" id="displayName" title="'.$user_info -> display_name.'">'.$user_info -> display_name.'</a><br/>
					<a href="'.network_site_url('user-admin/?action=user_admin').'">用户中心</a>| <a href="'.network_site_url('user-admin/?action=layout').'">退出本站</a></div>';
        }else{
            echo '<div class="second-login"><a href="'.network_site_url('user-admin').'">登录</a>|<a href="'.network_site_url('user-admin/?action=register').'">注册</a></div>';
        }
    ?>
	<script type="text/javascript">
		jQuery.noConflict();
		jQuery(document).ready(function(){
			var nameString=jQuery("#displayName")||{};
			if(!nameString.size==0){
				var displayName=nameString.html();
				if(displayName){
					displayTemp=displayName.slice(0,17);
					nameString.html(displayTemp+"..欢迎您！");
				}
			}
		});
		jQuery(document).ready(function(){
			jQuery(".page-item-319").click(function(){
				top.location="/store-locator/";
				return false;
			});
		});
	</script>
    
	<ul class="you-and-us" id="catalog_left">
		<li class="you-and-us-item" style="margin:15px 0 10px 0"><?php echo __('VOUS&NOUS', 'givenchyg2'); ?></li>
		<?php //$cat = get_the_category(); ?>
		<?php wp_list_categories(array('depth' => '4', 'title_li' => '', 'orderby' => 'id' /*, 'current_category' => $cat[0]->cat_ID*/)) ?>
		<li class="page_item page-item-2012-11-16 shiney"><a href="http://dahlianoir.givenchybeauty.cn" title="大丽&middot;诺香水">大丽&middot;诺香水</a></li>	
		<?php wp_list_pages(array('title_li' => '', 'include' => PAGE_STORE_LOCATOR)); ?>	
        <?php wp_list_pages(array('title_li' => '', 'include' => PAGE_STORE_HISTORY)); ?>	
        
        	
		<div class="shining_gif"><?php wp_list_pages(array('title_li' => '', 'include' => PAGE_STORE_game)); ?></div>

	</ul>
	
	<?php /* ?>
	<ul class="products">
		<li><a href="http://www.parfumsgivenchy.com/maquillage/"><?php echo __('MAQUILLAGES'); ?></a></li>
		<li><a href="http://www.parfumsgivenchy.com/parfums/"><?php echo __('PARFUMS'); ?></a></li>
		<li><a href="http://www.parfumsgivenchy.com/soin/"><?php echo __('SOINS'); ?></a></li>
	</ul>
	<?php */ ?>
	

	
	<?php /* ?>
	<ul class="stores">
	<?php
		global $blog_id;
		if ($blog_id == 1) { // only for france
	?>
		<li><a href="http://www.parfumsgivenchy.com/e-boutique/"><?php echo __('BOUTIQUE EN LIGNE', 'givenchyg2'); ?></a></li>
	<?php } ?>
	<?php /* ?>
		<li><a href="http://www.parfumsgivenchy.com/"><?php echo __('NOS BOUTIQUES', 'givenchyg2'); ?></a></li>
	<?php ?>
	</ul>
	<?php */ ?>

	<?php get_search_form(); ?>
	
	<div class="separator"></div>
	<span id="newsletterSubscribeLabel"><?php echo __("S'abonner &agrave; la newsletter", 'givenchyg2'); ?></span>		
	<?php echo ALO_em_show_widget_form(); ?>
	<div id="social">
		<ul>			
			<!--
			<li class="facebook"><a href="http://www.facebook.com/pages/Parfums-GIVENCHY/39253099575"><?php echo __('Nous rejoindre sur', 'givenchyg2'); ?></a></li>
			<li class="twitter"><a href="https://twitter.com/#!/ParfumsGIVENCHY"><?php echo __('Suivez nous sur'); ?></a></li>
			-->
			<li class="kaixin"><a href="http://www.kaixin001.com/rest/records.php?url=http://www.givenchybeauty.cn/&style=11&content=邀您进入纪梵希-中国&stime=&sig=&pic=http://www.givenchybeauty.cn/files/2012/09/电光幻影四色眼影345.jpg,http://www.givenchybeauty.cn/files/2012/09/大丽诺浓香345.jpg,http://www.givenchybeauty.cn/files/2012/09/滋养修护粉底液345.jpg,http://www.givenchybeauty.cn/files/2012/09/墨藻珍萃系列1.jpg,http://www.givenchybeauty.cn/files/2012/09/笑卓欢颜精华乳345.jpg" style="display:inline;margin-left:20px;line-height:35px;" target="_blank"><?php echo __('分享至我的开心网');?></a></li>
			<li class="weibo"><a href="http://e.weibo.com/parfumsgivenchy" style="display:inline;margin-left:20px;line-height:35px;"><?php echo __('关注纪梵希官方微博');?></a></li>
			
		</ul>
	</div>
	
	
</div>
<div id="sidebarFooter">


	<!--  *add languages 2012-7-5  -->
<form method="post">
	<label for="chooseLanguage"><?php echo __('Choose your language'); ?></label>
	<select id="chooseLanguage">
		<option value="http://www.givenchyconversations.com/fr-fr/">France</option>
		<option value="http://www.givenchyconversations.com">English</option>
		<option value="http://www.givenchyconversations.com/ru-ru">Россия</option>
		<option value="http://www.givenchyconversations.com/ar-me/">الشرق الأوسط</option>
		<option value="http://<?php echo $_SERVER['SERVER_NAME']; ?>" selected="selected" >中国</option>
		<option value="http://www.givenchyconversations.com/zh-tw/">台灣</option>
		<option value="http://www.givenchyconversations.com/pt-br/">Brasil</option>
		<option value="http://www.givenchyconversations.com/es-es/">Espa&ntilde;a</option>
		<option value="http://www.givenchyconversations.com/es-mx/">M&eacute;xico</option>
	</select> 
</form>
	<?php /* ?>
	 <form method="post">
		<label for="chooseLanguage"><?php echo __('Choose your language'); ?></label>
		
	<?php $blogs = get_blogs_of_user(1); // TODO Find better than that... ?>
		<select id="chooseLanguage">
	<?php for ($i = 1; $i <= count($blogs); $i++) { $blog = $blogs[$i]; ?>	
	<?php 
			global $blog_id;
	?>
			<option  value="<?php echo $blog->siteurl; ?>" <?php echo ($blog_id == $blog->userblog_id) ? 'selected="selected"' : ''; ?>><?php echo constant('LANGUAGE_BLOG_'.$i); ?></option>
	<?php } ?>		
		</select>
	</form>
	<?php */ ?>
	<?php $pageId = LEGAL_PAGE_ID; ?>
	<?php $legal = get_page($pageId); ?>
	
	<a href="<?php echo get_permalink($pageId); ?>"><?php echo $legal->post_title; ?></a>
	<br /><br />
	<?php echo __('© Parfums Givenchy 2012'); ?>
	
</div>

