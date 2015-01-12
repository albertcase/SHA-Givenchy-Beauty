<?php
switch($_REQUEST['action']){
    case 1:
        wp(Array('post_type' => 'post','posts_per_page' => 10000 ));
        $post_data = $wp_query->posts;
        $str = '';
        foreach($post_data as $value){
            if($value->post_status == 'pending' || $value->post_status == 'draft'){//等待复审、草稿
                continue;
            }
            $str .= $value->ID.','.$value->post_title.','.urldecode(get_permalink($value -> ID))."\r\n";
        }
        $file_path = dirname(__FILE__).DIRECTORY_SEPARATOR.'post.csv';
        fwrite(fopen($file_path, 'w'), iconv('utf-8', 'gb2312//ignore', $str));
        ouput_file($file_path);    
        break;
    case 2:
        $term_datas = get_terms('category') ;
        $str = '';
        
        foreach($term_datas as $value){
            if($value->name == '首页产品'){
                continue;
            }
            $str .= $value->term_id.','.$value->name.','.urldecode(get_category_link($value -> term_id))."\r\n";
        }
        $file_path = dirname(__FILE__).DIRECTORY_SEPARATOR.'tag.csv';
        fwrite(fopen($file_path, 'w'), iconv('utf-8', 'gb2312//ignore', $str));
        ouput_file($file_path);    
        break;
    default:
        echo '<br><a  target="_blank" href="/wp-admin/edit.php?page=export_url/export_url_list_tab.php&action=1">导出文章url</a><br><br>';
        echo '<a   target="_blank" href="/wp-admin/edit.php?page=export_url/export_url_list_tab.php&action=2">导出分类url</a>';
        break;
}

function ouput_file($file){
    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        readfile($file);
        exit;
    }
    die();
}
?>