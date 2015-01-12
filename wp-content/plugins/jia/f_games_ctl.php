<?php
//$ctl = 'stock'; 
//$act = 'add_defaut_stock'; 
//switch($ctl){
//    case 'stock' :
//        include_once( ABSPATH . 'wp-content/plugins/jia/f_games_ctl_stock.php' );
//        $ctl = new ctl_stock();
//        $ctl -> $act();
//        break;
//    case 'user' :
//        include_once( ABSPATH . 'wp-content/plugins/jia/f_games_ctl_stock.php' );
//        $ctl = new ctl_stock();
//        $ctl -> $act();
//        break;
//}

//include_once( ABSPATH . 'wp-content/plugins/jia/f_games_mdl_stock.php' );
//$stock = new stock();

//$data = $stock -> get_list_page( array(), 'option_id', 30);
//$data = $stock -> getById( 1, 'option_id');
//$data = $stock -> getByFilter( array('blog_id' => '0'), 'option_id');
//$data = $stock -> delById( 4268);
//$data = $stock -> insert( array('blog_id' => '5'));
//$data = $stock -> update(4272, array('option_name' => '5111'));

//include_once( ABSPATH . 'wp-content/plugins/jia/f_games_mdl_user.php' );
//$stock = new GameUser();
//$data = array(
//    'user_login' => 'test',
//    'user_pass' => '',
//    'user_email' => 'test@163.com',
//    'user_nicename' => 'test',
//    'display_name' => 'test',
//    'user_registered' => date('Y-m-d H:i:s')
//);
//$data = array(
//    'user_login' => 'www',
//    'user_email' => 'wwwww@123.com',
//    'user_pass' => '111111',
//    'role' => 'gameuser'
//);
//$data = $stock -> addGameUser($data);
//print_r($data);
class ctl_dec{
    
    public  function run($action = 'default', $type = ''){
        if($type == 'ajax'){ //ajax 调用
            $rel_action = 'ajax_'.$action;
        }else{ //get调用
            $rel_action = $action;
        }
        return $this -> $rel_action();
    }
    
    public function get_model($name){
        include_once( ABSPATH . 'wp-content/plugins/jia/f_games_mdl_'.$name.'.php' );
        $model_name = 'f_games_mdl_'.$name;
        $model = new $model_name();
        return $model;
    }
    
    public function __call($method, $param){
        return;
    }
}

?>