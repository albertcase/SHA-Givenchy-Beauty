<?php
define('LANGUAGE_BLOG_1', 'Fran&ccedil;ais');
define('LANGUAGE_BLOG_2', '简体中文');

global $blog_id;
switch ($blog_id) {
	case 1: // france
	/**
 * 	define('IPHONE_LINK', 'http://store.apple.com/fr');
 * 		define('LASHBAR_LINK', 'http://www.baracilsgivenchy.fr/');
 * 		define('PLAY_LINK', 'http://www.playgivenchy.com/');
 * 				
 * // ****	PREPROD		
 * 		define('PAGE_LOOK_AND_TENDANCES_LOOK_1_ID', 190); // look 1  NATURELLEMENT RADIEUSE
 * 		define('PAGE_LOOK_AND_TENDANCES_LOOK_2_ID', 192); // look 2 TAILLEUR TENDANCE
 * 		define('PAGE_LOOK_AND_TENDANCES_LOOK_3_ID', 194); // look 3  CROISIERE CHIC
 * 		define('PAGE_LOOK_AND_TENDANCES_LOOK_4_ID', 196); // look 4 ELEGANCE STYLEE
 * 		define('PAGE_LOOK_AND_TENDANCES_LOOK_5_ID', 198); // look 5 PETILLANTE JUSQU'à L'AUBE

 * 		define('LEGAL_PAGE_ID', 46);

 * 		define('CATEGORY_GESTES_BEAUTES_ID', 3);
 * 		define('CATEGORY_PETIT_MOMENTS_ID', 11);
 * 		define('CATEGORY_INSPIRATION_COUTURE_ID', 5);
 * 		define('PAGE_STORE_LOCATOR', 291); // 253
 */
        define('IPHONE_LINK', 'http://store.apple.com/');
		define('LASHBAR_LINK', 'http://www.givenchylashbar.com/');
		define('PLAY_LINK', 'http://www.playgivenchy.com/');		
		
// ****	PREPROD	
		define('LEGAL_PAGE_ID', 8);
		define('CATEGORY_GESTES_BEAUTES_ID', 3);
		define('CATEGORY_PETIT_MOMENTS_ID', 4);
		define('CATEGORY_INSPIRATION_COUTURE_ID', 5);	
		define('PAGE_LOOK_AND_TENDANCES_LOOK_1_ID', 102); // look 1 REFINED GLOW
		define('PAGE_LOOK_AND_TENDANCES_LOOK_2_ID', 104); // look 2  BRIEFCASE ELEGANCE
		define('PAGE_LOOK_AND_TENDANCES_LOOK_3_ID', 106); // look 3 BEACH WAVE GLAM
		define('PAGE_LOOK_AND_TENDANCES_LOOK_4_ID', 109); // look 4  SERVING UP SOPHISTICATION
		define('PAGE_LOOK_AND_TENDANCES_LOOK_5_ID', 111); // look 5 DAZZLING ALL NIGHT
		define('PAGE_STORE_LOCATOR', 319); // 253
		
// ****	LOCAL		
//		define('PAGE_LOOK_AND_TENDANCES_LOOK_1_ID', 56); // look 1  NATURELLEMENT RADIEUSE
//		define('PAGE_LOOK_AND_TENDANCES_LOOK_2_ID', 60); // look 2 TAILLEUR TENDANCE
//		define('PAGE_LOOK_AND_TENDANCES_LOOK_3_ID', 62); // look 3  CROISIERE CHIC
//		define('PAGE_LOOK_AND_TENDANCES_LOOK_4_ID', 64); // look 4 ELEGANCE STYLEE
//		define('PAGE_LOOK_AND_TENDANCES_LOOK_5_ID', 66); // look 5 PETILLANTE JUSQU'À L'AUBE
//		
//		define('LEGAL_PAGE_ID', 46);
//
//		define('CATEGORY_GESTES_BEAUTES_ID', 3);
//		define('CATEGORY_PETIT_MOMENTS_ID', 11);
//		define('CATEGORY_INSPIRATION_COUTURE_ID', 5);

	break;	
	case 2: // english
		define('IPHONE_LINK', 'http://store.apple.com/');
		define('LASHBAR_LINK', 'http://www.givenchylashbar.com/');
		define('PLAY_LINK', 'http://www.playgivenchy.com/');		
		
// ****	PREPROD	
		define('LEGAL_PAGE_ID', 8);
		define('CATEGORY_GESTES_BEAUTES_ID', 3);
		define('CATEGORY_PETIT_MOMENTS_ID', 4);
		define('CATEGORY_INSPIRATION_COUTURE_ID', 5);	
		define('PAGE_LOOK_AND_TENDANCES_LOOK_1_ID', 102); // look 1 REFINED GLOW
		define('PAGE_LOOK_AND_TENDANCES_LOOK_2_ID', 104); // look 2  BRIEFCASE ELEGANCE
		define('PAGE_LOOK_AND_TENDANCES_LOOK_3_ID', 106); // look 3 BEACH WAVE GLAM
		define('PAGE_LOOK_AND_TENDANCES_LOOK_4_ID', 109); // look 4  SERVING UP SOPHISTICATION
		define('PAGE_LOOK_AND_TENDANCES_LOOK_5_ID', 111); // look 5 DAZZLING ALL NIGHT
		define('PAGE_STORE_LOCATOR', 319); // 253
        define('PAGE_STORE_game', 1422); // 游戏页面 id
        
// ****	LOCAL	
//		define('LEGAL_PAGE_ID', 8);
//		define('CATEGORY_GESTES_BEAUTES_ID', 3);
//		define('CATEGORY_PETIT_MOMENTS_ID', 4);
//		define('CATEGORY_INSPIRATION_COUTURE_ID', 5);	
//		
//		define('PAGE_LOOK_AND_TENDANCES_LOOK_1_ID', 11); // look 1 REFINED GLOW
//		define('PAGE_LOOK_AND_TENDANCES_LOOK_2_ID', 13); // look 2  BRIEFCASE ELEGANCE
//		define('PAGE_LOOK_AND_TENDANCES_LOOK_3_ID', 15); // look 3 BEACH WAVE GLAM
//		define('PAGE_LOOK_AND_TENDANCES_LOOK_4_ID', 17); // look 4  SERVING UP SOPHISTICATION
//		define('PAGE_LOOK_AND_TENDANCES_LOOK_5_ID', 19); // look 5 DAZZLING ALL NIGHT
		

	break;	
}

function getProductType3Info(){
    return array(
        '2001' => array(
            1 => '2001',
            2 => '2004',
            3 => '2007'
        ),'2004' => array(
            1 => '2001',
            2 => '2004',
            3 => '2007'
        ),'2007' => array(
            1 => '2001',
            2 => '2004',
            3 => '2007'
        ),'2010' => array(
            1 => '2010',
            2 => '2013',
            3 => '2016'
        ),'2013' => array(
            1 => '2010',
            2 => '2013',
            3 => '2016'
        ),'2016' => array(
            1 => '2010',
            2 => '2013',
            3 => '2016'
        )
    );
}

?>