<?php
//wordpress自带的 显示数据库
class jia_test extends WP_List_Table {

	var $site_id;
	var $is_site_users;

	function jia_test() {
		include_once( ABSPATH . 'wp-content/plugins/jia/f_games_mdl_stock.php' );
        $this -> mdl = new f_games_mdl_stock();
        $screen = get_current_screen();
		$this->is_site_users = 'site-users-network' == $screen->id;

		if ( $this->is_site_users )
			$this->site_id = isset( $_REQUEST['id'] ) ? intval( $_REQUEST['id'] ) : 0;

		parent::WP_List_Table( array(
			'singular' => 'user',
			'plural'   => 'stock'
		) );
	}
    
	function prepare_items() {
	    include_once( ABSPATH . 'wp-content/plugins/jia/f_games_mdl_stock.php' );
        $this -> mdl = new f_games_mdl_stock();
        $page = empty($_REQUEST['paged']) ? 1 : $_REQUEST['paged'];
        $order = empty($_REQUEST['order']) ? '' : $_REQUEST['order'];
        if(!empty($_REQUEST['orderby'])){
            if(!empty($_REQUEST['order']) && ($_REQUEST['order'] == 'asc' || $_REQUEST['order'] == 'desc')){
                $orderby = ' order by '.$_REQUEST['orderby'].' '.$order;
            }else{
                $orderby = ' order by '.$_REQUEST['orderby'];
            }
        }else{
            $orderby = '';
        }
        
        if(isset($_REQUEST['s']) && !empty($_REQUEST['s'])){
            
        }
        $query = empty($_REQUEST['s']) ? array() : array( 'city' => $_REQUEST['s']);
        $result = $this -> mdl -> get_list_page( $query, 'id,name,city,stocknum,tel,address', $page, 20, $orderby);
        $this->items = $result['data'];
        $this->set_pagination_args( array(
            "total_items" => $result['total_items'],
            "total_pages" => $result['total_pages'],
            "per_page" => $result['per_page']
        ) );
    }
    
    function get_columns() {
        $columns = array( 
            'id' => '序号', 
            'name' => '名字', 
            'city' => '城市',
            'stocknum' => '库存',
            'address' => '地址',
            'tel' => '电话号码'           
        );
        $sortable = array(
            'id' => array('id'),
            'name' => array('name'),
            'city' => array('city'),
            'stocknum' => array('stocknum'),
            'address' => array('address'),
            'tel' => array('tel')
        );
        $hidden = array();
        $this -> _column_headers = array($columns,$hidden,$sortable);
    }
    
    function column_default( $item, $column_name ){
        
    }
    
    function column_name($item){
        echo $item -> name;
    }
    
    function column_city($item){
        echo $item -> city;
    }
    
    function column_id($item){
        echo $item -> id;
    }
    
    function column_stocknum($item){
        echo $item -> stocknum;
    }
    
    function column_address($item){
        echo $item -> address;
    }
    
    function column_tel($item){
        echo $item -> tel;
    }
    
    
    function extra_tablenav( $which ) {
        if ( $which == "top" ){
            //The code that goes before the table is here
            echo"Hello, I'm before the table";
        }
        if ( $which == "bottom" ){
            //The code that goes after the table is there
            echo"Hi, I'm after the table";
        }
    }
    
    function add_defaut_stock(){
        $handle = @fopen(ABSPATH . 'wp-content/plugins/jia/test.csv', "r");
        $test = '';
        if ($handle) {
            while (!feof($handle)) {
                $buffer = fgets($handle, 4096);
                $buffer =iconv("gb2312", "UTF-8", $buffer); 
                $data = explode(',', $buffer);
                $dd = array(
                    'name' => $data[1],
                    'shopid' => $data[2],
                    'stocknum' => $data[4],
                    'city' => $data[0]
                );
                $this -> mdl -> insert($dd);            
            }
            fclose($handle);
        }
        echo 3333;die();
        return true;
    }
}


$a = new jia_test();
$a->prepare_items();
echo '<form action="" method="get">';
$a->search_box( __( '搜索店铺' ), 'name');
$a->get_columns();
$a -> display();
echo '</form>';
?>