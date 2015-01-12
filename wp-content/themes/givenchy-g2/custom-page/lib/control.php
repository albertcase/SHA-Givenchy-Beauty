<?php
class control{
    public $request_url = '';
    public  function run($action = 'index'){
        if(empty($action)){
            $action = 'index';
        }
        $rel_action = $action;
        return $this -> $rel_action();
    }
    
    public function get_model($name){
        include_once( CUSTOM_PAGE_ROOT.'/mdl/mdl_'.$name.'.php' );
        $model_name = 'mdl_'.$name;
        $model = new $model_name();
        return $model;
    }
    
    public function defau12321321_1(){
        return true;
    }
    
    public function __call($method, $param){
        return;
    }
    
    
    public function get_header(){
        get_header();
    }
    
    
    public function get_sidebar(){
        get_sidebar();
    }
    
    public function get_footer(){
        get_footer();
    }

}

?>