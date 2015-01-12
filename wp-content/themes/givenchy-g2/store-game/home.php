<?php
//$game_dir_root = '/'.dirname(plugin_basename(__FILE__));
//$game_dir_root = dirname(plugin_basename(__FILE__));
$game_dir_root = ABSPATH . 'wp-content/themes/givenchy-g2/store-game';  

//var_dump($_REQUEST);
//http://test.jfx.com/store-game/?page=play
if(isset($_REQUEST['page']) && !empty($_REQUEST['page'])){
    $act = $_REQUEST['page'];
    switch($act){
        case 'play':
            include_once($game_dir_root.'/play.php');  
            break;
        case 'user_form':
            include_once($game_dir_root.'/user_form.php');  
            break;
        case 'game_rule':
            include_once($game_dir_root.'/game_rule.php');  
            break;
        default :
            include_once($game_dir_root.'/index.php');  
            break;  
    } 
}else{
    include_once($game_dir_root.'/index.php');  
}
?>
