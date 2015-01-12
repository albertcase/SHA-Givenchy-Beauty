<?php
//wordpress自带的 显示数据库
class f_games_ctl_user extends ctl_dec{
	function ajax_add_fgame_user(){
        //$model = $this -> get_model('user');
        include_once( ABSPATH . 'wp-includes/pluggable.php' );
        $name = $_REQUEST['inputName'];
        $email = $_REQUEST['inputEmail'];
        $shop_id = $_REQUEST['shopId'];
        $name = $_REQUEST['inputName'];
        $phone = $_REQUEST['inputPhone'];
        $fame_send_mail = empty($_REQUEST['textBoxFlag']) ? '0' : '1';
        //$phone = 18621816755;
        $data = array(
            'user_login' => $email,
            'user_pass' => '111111',
            'user_email' => $email,
            'user_nicename' => $name,
            'display_name' => $name,
            'role' => 'gameuser',
            'user_registered' => date('Y-m-d H:i:s')
        );
        
        if($this -> check_phone($phone)){
            $result = wp_insert_user($data);
            if(isset($result -> errors)){
                $message = '';
                if(isset($result -> errors['existing_user_email'])){
                    $message = $result -> errors['existing_user_email'][0];
                }
                if(isset($result -> errors['existing_user_login'])){
                    $message = $result -> errors['existing_user_login'][0];
                }
                
                $rs = array(
                    'error' => '创建用户失败！',
                    'success' => 'false',
                    'error_message' => $message
                );
                return $rs;
            }else{
                $user_id = $result;
            }
            
            update_user_meta( $user_id, 'fame_phone', $phone );
            update_user_meta( $user_id, 'fame_send_mail', $fame_send_mail );
            
            $mdl_shop = $this -> get_model('stock');
            $shop = $mdl_shop -> getById($shop_id, 'stocknum,address,tel');
            $sign = '【纪梵希】';
                        
            $code = mt_rand(100000, 999999);
            $address = $shop -> address;
            $tel = $shop -> tel;
            $text = '感谢您参加”十二星座蛋白质女孩”活动，短信验证码'.$code.'，请凭此短信，于9月4日-10月14日前往'.$address.'，电话'.$tel.'，领取焕颜美肌乳液体验装2ML，赠完即止。'.$sign;
            //$text = '短信测试！';
            //echo $text;die();
            $send_data = array(
                'user_id' => $user_id,
                'phone' => $phone,
                'content' => $text,
                'code' => $code,
                'tel' => $shop -> tel,
                'add_time' => time(),
                'shop_id' => $shop_id,
            );
            $send_rs = $this -> send_sms($send_data);
            if($send_rs){
                $mdl_shop -> subtraction_stocknum($shop_id);
                $rs = array(
                    'success' => 'true'
                );
            }else{
                $rs = array(
                    'error' => '短信发送失败！',
                    'error_message' => '短信发送失败！',
                    'success' => 'false'
                );
            }
            return $rs;
        }else{
            $rs = array(
                'error' => '电话号码已注册!',
                'error_message' => '电话号码已注册!',
                'success' => 'false'
            );
            return $rs;
        }
    }
    
    public function send_sms($data){
        include_once( ABSPATH . 'wp-content/plugins/jia/f_game_sms.php' );
        $sms = $this -> get_model('sms');
        if($sms -> insert($data)){
            $sms_id = $sms -> tool -> insert_id;
            $GivenchySms = new GivenchySms();
            $balance = $GivenchySms -> GetBalance(); 
            //var_dump($balance);die();
            if($balance === false || $balance < 4){
                //return '余额不足';
                return false;
            }else{
                $text = $data['content'];
                $phone = $data['phone'];
                $send_rs = $GivenchySms->send_sms($phone, $text, $sms_id);
                if( $send_rs ==  $sms_id){
                     $update_data = array(
                        'send_time' => time(),
                        'is_send' => 2
                    );
                    $sms -> update($sms_id, $update_data);
                    return true;
                }else{
                    return false;
                }
            }
            
        }
    }
    
    public function check_phone($phone){
        //return true;
        $mdl_user_meate = new mdl_dev('wp_usermeta', 'umeta_id');
        $filter = array(
            'meta_key' => 'fame_phone',
            'meta_value' => $phone
        );
        $rs = $mdl_user_meate -> getByFilter($filter, 'umeta_id');
        if(empty($rs)){
            return true;
        }else{
            return false;
        }
    }
}


?>