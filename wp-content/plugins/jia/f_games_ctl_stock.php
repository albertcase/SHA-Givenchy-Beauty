<?php
//wordpress自带的 显示数据库
class f_games_ctl_stock extends ctl_dec{
	function ajax_getshop(){
        $model = $this -> get_model('stock');
        $filter = array(
            'city' => urldecode($_REQUEST['city'])
            //'city' => '上海'
        );
        //$field = 'id,stocknum,address,name';
        $field = 'id,stocknum,address';
        
        $data = $model -> getByFilter($filter, $field, 'ARRAY_A');
        
        return $data;
    }
    
    function ajax_install(){
        $model = $this -> get_model('stock');
        $handle = @fopen(ABSPATH . 'wp-content/plugins/jia/test.csv', "r");
        $test = '';
        if ($handle) {
            while (!feof($handle)) {
                $buffer = fgets($handle, 4096);
                $buffer =iconv("gb2312", "UTF-8", $buffer); 
                $data = explode(',', $buffer);
                //print_R($data);die();
                $dd = array(
                    'name' => $data[1],
                    'shopid' => $data[2],
                    'stocknum' => $data[4],
                    'city' => $data[0],
                    'address' => $data[6],
                    'tel' => $data[5]
                );
                $model -> insert($dd);            
            }
            fclose($handle);
        }
        return true;
    }
    function ajax_update_stocknum(){
        $model = $this -> get_model('stock');
        $data = array(
            'stocknum' => $_POST['stocknum']
        );
        $id = $_POST['id'];
        if(!isset($id)){
            return false;
        }
        return $model -> update($id, $data);
    }
}


?>