<?php

function topimg_insert($id,$imgurl){
    global $wpdb;
    $sql = 'select ID from '.$wpdb->prefix.'posts where  post_parent='.$id.' and post_type = "topimg"';
    $rs = $wpdb->get_results($sql);
    if(empty($rs)){
        $data = array(
            'post_parent' => $id,
            'guid' => $imgurl,
            'post_name' => 'topimg',
            'post_title' => 'topimg',
            'post_author' => get_current_user_id(),
            'post_date' => date('Y-m-d H:i:s'),
            'post_type' => 'topimg',
            
            'post_content' => '',
            'post_title' => '',
            'post_excerpt' => '',
            'to_ping' => '',
            'pinged' => '',
            'post_content_filtered' => '',
        );  
        $rs = $wpdb->insert($wpdb->prefix.'posts',$data);  
    }else{
        $data = array(
            'guid' => $imgurl,
            'post_author' =>  get_current_user_id(),
            'post_date' => date('Y-m-d H:i:s'),
        ); 
        $where = array(
            'post_parent' => $id,
            'post_type' => 'topimg'
        );
        $rs = $wpdb->update($wpdb->prefix.'posts',$data,$where);  
    }
    $rs_data = array(
        'suc' => 'true',
        'data' => array(
            'url' => $imgurl
        )
    );
    return $rs_data;
}

function get_topimg($id){
    global $wpdb;
    $sql = 'select guid from '.$wpdb->prefix.'posts where  post_parent='.$id.' and post_type="topimg" limit 1';
    $rs = $wpdb->get_results($sql);
    if(!empty($rs)){
        return $rs[0] -> guid;
    }else{
        return false;
    }
}

function del_topimg($id){
    global $wpdb;
    $sql = 'delete from '.$wpdb->prefix.'posts where  post_parent='.$id.' and post_type="topimg"';
    $rs = $wpdb->query($sql);
    $rs_data = array('suc' => 'true');
    return $rs_data;
}

?>