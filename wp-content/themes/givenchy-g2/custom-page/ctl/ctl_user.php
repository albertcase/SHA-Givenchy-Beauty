<?php
class ctl_user extends control{
    function index(){
        //echo 'index';
        //$mdl = $this -> do_login('user','11');
        //$mdl = $this -> layout();
        //$this -> forget_password();
        //$this -> send_activation_email();
        //$this -> activation_user();
        //$this -> show_user();
        //var_dump($mdl);
        //$this -> assgin_html('user/index.html');
        $this -> login();
        return;
    }   
    
    //登录页面
    function login(){
        if(is_user_logged_in()){
            header("Location: ".$this -> request_url.'?action=user_admin');
        }
        global $jia_header_css, $jia_header_js;
        $jia_header_css = array('second/register.css');
        $jia_header_js = array('second/G-form.js' );
        add_action('wp_head','jia_add_header');
        global $jia_new_title;
        $jia_new_title = '用户登录 | ';
        add_action('wp_title', 'jia_change_title');
        $this -> get_header();
        $this -> get_sidebar();
        include_once( CUSTOM_PAGE_ROOT.'/view/user/login.html');
        $this -> get_footer();    
    }
    
    
            
    //注册页面
    function register(){
        global $jia_header_css, $jia_header_js;
        $jia_header_css = array('second/register.css');
        $jia_header_js = array('second/G-form.js' );
        add_action('wp_head','jia_add_header');
        global $jia_new_title;
        $jia_new_title = '用户注册 | ';
        add_action('wp_title', 'jia_change_title');
        $this -> get_header();
        $this -> get_sidebar();
        $this -> assgin_html('user/register.html');
        include_once( CUSTOM_PAGE_ROOT.'/view/user/register.html');
        $this -> get_footer();
    }
    
    //注册成功页面
    function register_succ(){
        global $jia_header_css, $jia_header_js;
        $jia_header_css = array('second/register.css');
        $jia_header_js = array('second/G-form.js' );
        add_action('wp_head','jia_add_header');
        global $jia_new_title;
        $jia_new_title = '注册成功 | ';
        add_action('wp_title', 'jia_change_title');
        $this -> get_header();
        $this -> get_sidebar();
        $this -> assgin_html('user/register.html');
        include_once( CUSTOM_PAGE_ROOT.'/view/user/register_success.html');
        $this -> get_footer();
    }
    
    //忘记密码页面
    function forget_password(){
        global $jia_header_css, $jia_header_js;
        $jia_header_css = array('second/register.css');
        $jia_header_js = array('second/G-form.js' );
        add_action('wp_head','jia_add_header');
        global $jia_new_title;
        $jia_new_title = '忘记密码 | ';
        add_action('wp_title', 'jia_change_title');
        //update_user_option
        $this -> get_header();
        $this -> get_sidebar();
        include_once( CUSTOM_PAGE_ROOT.'/view/user/forget_password.html');
        $this -> get_footer();
    }
    
    
    
    function export(){
        if(empty($_REQUEST['stime']) || empty($_REQUEST['etime'])){
            return;
        }
        if(is_user_logged_in()){
            date_default_timezone_set('Asia/Shanghai');
            $star_time = date('Y-m-d H:i:s', $_REQUEST['stime']);
            $end_time = date('Y-m-d H:i:s', $_REQUEST['etime']);
            if($star_time === false || $end_time === false ){
                return ;
            }
            $userdata = wp_get_current_user();
            $user_roles = $userdata->roles;
            $user_role = array_shift($user_roles);
            if($user_role == 'administrator'){
                $mtime = explode( ' ', microtime() );
                $this -> query_log_start_time = $mtime[1] + $mtime[0];
                ini_set("max_execution_time", "1800"); 
                $user = $this->get_model('user');
                //$userinfos = $user->getUserInfo('display_name,user_email', 'fame_phone,user_age,user_sex,use_brand,brand_name,whetherSubscribers');
                $userinfos = $user->getUserInfoByDate('display_name,user_email', 'fame_phone,user_age,user_sex,use_brand,brand_name,whetherSubscribers', $star_time, $end_time);
                
                $log_root =  ABSPATH . 'wp-query-log/userouput/';
                $filename = $log_root.date('Y_m_d_H_i_s').'.csv';
                $title = iconv('utf-8', 'gb2312//ignore', '用户名,邮箱,手机号,年龄,称谓,已使用品牌,是否订阅');
                $age_info = $this->getAgeInfo();
                $brandinfo = $this->getBrandInfo();
                $brandinfo_key =  array_keys($brandinfo);
                $content_txt = $title."\r\n";
                $sendemailinfo = $this->getSendEmailInfo();
                $sexinfo = $this->getSexInfo();
                
                
                foreach($userinfos as $userinfo){
                    foreach($userinfo as $value){
                        //echo mb_detect_encoding($value['display_name']);
                        //die();
                        $value['display_name'] = iconv('utf-8', 'gb2312//ignore', $value['display_name']);
                        if(!empty($value['use_brand'])){
                            $value['use_brand'] = str_replace($brandinfo_key, $brandinfo,$value['use_brand'] );
                            $value['use_brand'] = str_replace(',', '，',$value['use_brand'] );
                            $value['use_brand'] = str_replace('其他', $value['brand_name'],$value['use_brand'] );
                            $value['use_brand'] = iconv('utf-8', 'gb2312//ignore', $value['use_brand']);
                        }
                        if(!empty($value['user_age'])){
                            $value['user_age'] = $age_info[$value['user_age']];
                            $value['user_age'] = iconv('utf-8', 'gb2312//ignore', $value['user_age']);
                        }
                        if(!empty($value['user_sex'])){
                            $value['user_sex'] = $sexinfo[$value['user_sex']];
                            $value['user_sex'] = iconv('utf-8', 'gb2312//ignore', $value['user_sex']);
                        }
                        if(!empty($value['whetherSubscribers']) || $value['whetherSubscribers'] !==0 ){
                            $value['whetherSubscribers'] = $sendemailinfo[$value['whetherSubscribers']];
                            $value['whetherSubscribers'] = iconv('utf-8', 'gb2312//ignore', $value['whetherSubscribers']);
                        }
                        
                        unset($value['brand_name']);
                        $info =  implode(",", $value);
                        $content_txt .= $info."\r\n";
                    }
                }
                $mtime            = explode( ' ', microtime() );
                fwrite(fopen($filename, 'w'), $content_txt);
                //$this -> query_log_end_time = $mtime[1] + $mtime[0];
                //echo $this -> query_log_start_time."<br>";
                //echo $this -> query_log_end_time."<br>";
                //echo $this -> query_log_end_time - $this -> query_log_start_time."<br>";
                //error_log($content_txt, 3, $filename);
                $this -> ouput_file($filename);
            }      
        }
    }
    
    
    private function ouput_file($file){
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
    
    //用户管理页面
    function user_admin(){
        if(is_user_logged_in()){
            $user_info = wp_get_current_user();
            //print_R($user_info);
            global $jia_new_title;
            $jia_new_title = '用户管理 | ';
            add_action('wp_title', 'jia_change_title');
            global $jia_header_css, $jia_header_js;
            $jia_header_css = array('second/register.css');
            $jia_header_js = array('second/G-form.js' );
            add_action('wp_head','jia_add_header');
            
            $brandinfo = $this->getBrandInfo();
            $ageinfo = $this->getAgeInfo();
            $this -> get_header();
            $this -> get_sidebar();
            if($user_info->user_sex == 1){
                $user_check1 = 'checked="checked"';
            }else{
                $user_check2 = 'checked="checked"';
            }
            
            if($user_info->whetherSubscribers == 1){
                $user_email_check1 = 'checked="checked"';
            }else{
                $user_email_check2 = 'checked="checked"';
            }
            
            //$P$BdEtxD.VaBsrCNqQaFtEDTgqiBXgUt/
            //echo  wp_hash_password('123456');
            include_once( CUSTOM_PAGE_ROOT.'/view/user/edit.html');
            $this -> get_footer();
        }else{
            header("Location: ".$this -> request_url);
            exit(); 
        }
        
    }
    
    //忘记密码页面
    function forget_password_view(){
        global $jia_header_css, $jia_header_js;
        $jia_header_css = array('second/register.css');
        $jia_header_js = array('second/G-form.js' );
        add_action('wp_head','jia_add_header');
        global $jia_new_title;
        $jia_new_title = '忘记密码 | ';
        add_action('wp_title', 'jia_change_title');
        //update_user_option
        $this -> get_header();
        $this -> get_sidebar();
        include_once( CUSTOM_PAGE_ROOT.'/view/user/forget_password_view.html');
        $this -> get_footer();
    }
    
    
    function do_login(){
        //$_POST['log'] = $username;
        //$_POST['pwd'] = $password;
        //$_POST['log'] = 'admin';
        //$_POST['pwd'] = '123456';
        
        $result = array(
            'success' => false,
            'message' => '',
        );
        
        if(empty($_POST['log']) || empty($_POST['pwd']) ){
            $result['message'] = '用户名或密码不能为空！';
            return $result;
        }
        
        $secure_cookie = '';
        $interim_login = isset($_REQUEST['interim-login']);
        
        // If the user wants ssl but the session is not ssl, force a secure cookie.
        if ( !empty($_POST['log']) && !force_ssl_admin() ) {
        	$user_name = sanitize_user($_POST['log']);
        	if ( $user = get_userdatabylogin($user_name) ) {
        		if ( get_user_option('use_ssl', $user->ID) ) {
        			$secure_cookie = true;
        			force_ssl_admin(true);
        		}
        	}
        }
        
        if ( isset( $_REQUEST['redirect_to'] ) ) {
        	$redirect_to = $_REQUEST['redirect_to'];
        	// Redirect to https if user wants ssl
        	if ( $secure_cookie && false !== strpos($redirect_to, 'wp-admin') )
        		$redirect_to = preg_replace('|^http://|', 'https://', $redirect_to);
        } else {
        	$redirect_to = admin_url();
        }
        
        //$reauth = empty($_REQUEST['reauth']) ? false : true;
        
        // If the user was redirected to a secure login form from a non-secure admin page, and secure login is required but secure admin is not, then don't use a secure
        // cookie and redirect back to the referring non-secure admin page.  This allows logins to always be POSTed over SSL while allowing the user to choose visiting
        // the admin via http or https.
        if ( !$secure_cookie && is_ssl() && force_ssl_login() && !force_ssl_admin() && ( 0 !== strpos($redirect_to, 'https') ) && ( 0 === strpos($redirect_to, 'http') ) )
        	$secure_cookie = false;
        
        add_action('wp_authenticate_user', 'add_user_filter');
        
        //用户名密码验证
        $user = wp_signon('', $secure_cookie);
        if(is_wp_error($user)){
            $result['message'] = '用户名或密码错误，登录失败！';
            if(isset($user -> errors['unactivation_user'])){
                $result['message'] = $user -> errors['unactivation_user'][0];
                $result['unactivation_user'] = true;
                $result['uu'] = $user -> user_id;
            }else if(isset($user -> errors['unallow_user'])){
                $result['message'] = $user -> errors['unallow_user'][0];
            }
            
        }else{
            if($user -> show_admin_bar_front == 'true'){
                update_user_meta( $user -> ID, 'show_admin_bar_front', 'false' );
            }
            //if($user -> show_admin_bar_admin == 'true'){
            //    update_user_meta( $user -> ID, 'show_admin_bar_admin', 'false' );
            //}
            
            $data = array(
                'userid' => $user->ID,
                'time' => current_time('mysql', 0),
                'type' => 1,
                'loginname' => $user->user_login
            );
            $user_log_model = new model('wp_user_log', 'id');
            $user_log_model->insert($data);
            
            $result['success'] = true;
            $result['message'] = '登录成功！';
        }
        return $result;
        
        //$redirect_to = apply_filters('login_redirect', $redirect_to, isset( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : '', $user);
        //echo $redirect_to ;
        //!is_wp_error($user) && !
//        $errors = $user;
        
//        $mss = $user -> get_error_code();
        //switch ($mss){
//            case 'incorrect_password':
//                echo '密码不正确';
//                break;
//            case 'blog_suspended':
//                echo '无效用户名';
//                break;
//            case 'invalid_username':
//                echo '用户名错误';
//                break;
//        }
        //print_r($mss);
        //var_dump(is_wp_error($user));
        //var_dump($reauth);
        //$errors = $user;
//        print_r($user);
    }
    
    
    //注销
    function layout(){
        //check_admin_referer('log-out');
        if(is_user_logged_in()){
            $user_info = wp_get_current_user();
    	    wp_logout();
            
            $data = array(
                'userid' => $user_info->ID,
                'time' => current_time('mysql', 0),
                'type' => 2,
                'loginname' => $user_info->user_login
            );
            $user_log_model = new model('wp_user_log', 'id');
            $user_log_model->insert($data);
                
            header("Location: http://".DOMAIN_CURRENT_SITE);        
        	exit();
        }else{
            header("Location: http://".DOMAIN_CURRENT_SITE);        
        	exit();
        }
    }
    
    
    function do_forget_password(){
        global $wpdb, $current_site;
        $result = array(
            'success' => false,
            'message' => '',
        );
        $errors = new WP_Error();
        //$_POST['user_login'] = 'jiarongling@163.com';
        $user_data = get_user_by_email(trim($_POST['user_login']));
    	if ( empty($user_data) ){
    		//$errors->add('invalid_email', __('<strong>ERROR</strong>: There is no user registered with that email address.'));
            $result['message'] = '邮箱填写错误！';
            return $result;
        }
        do_action('lostpassword_post');
        
        if ( $errors->get_error_code() ){
            //return $errors;
            $result['message'] = '信息有误！';
            return $result;
        }
        	
        
        if ( !$user_data ) {
        	//$errors->add('invalidcombo', __('<strong>ERROR</strong>: Invalid username or e-mail.'));
        	//return $errors;
            $result['message'] = '邮箱无效！';
            return $result;
        }
        
        // redefining user_login ensures we return the right case in the email
        $user_login = $user_data->user_login;
        $user_email = $user_data->user_email;
        
        do_action('retreive_password', $user_login);  // Misspelled and deprecated
        do_action('retrieve_password', $user_login);
        add_action('wp_mail_content_type', 'jia_setEmailType');
        $allow = apply_filters('allow_password_reset', true, $user_data->ID);
        
        $br = '<br>';
        if ( ! $allow ){
        	//return new WP_Error('no_password_reset', __('Password reset is not allowed for this user'));
            $result['message'] = '不允许该用户重置密码！';
            return $result;
        }else if ( is_wp_error($allow) ){
        	//return $allow;
            $result['message'] = '信息有误!';
            return $result;
        }
        $key = $wpdb->get_var($wpdb->prepare("SELECT user_activation_key FROM $wpdb->users WHERE user_login = %s", $user_login));
        if ( empty($key) ) {
        	// Generate something random for a key...
        	$key = wp_generate_password(20, false);
        	do_action('retrieve_password_key', $user_login, $key);
        	// Now insert the new md5 key into the db
        	$wpdb->update($wpdb->users, array('user_activation_key' => $key), array('user_login' => $user_login));
        }
        $send_url =  network_site_url("user-admin/?action=forget_password_view&key=$key&login=" . rawurlencode($user_data -> ID), 'login') ;
        $message =  '您好，'.$user_login.$br;
        $message .= '您已申请重置您的会员密码，请您点击以下链接重置您的会员密码：'.$br;
        $message .= '<a target="_blank" href="' .$send_url. '" >'.$send_url.'</a>'.$br.$br;
        //$message .= '<a '.$url.'" > 点击更改密码 </a>'.$br;
        $message .= '本邮件为系统自动发送的邮件，请不要回复本邮件。'.$br;
        $message .= '【纪梵希美妆】'.$br;
        
        if ( is_multisite() )
        	$blogname = $GLOBALS['current_site']->site_name;
        else
        	// The blogname option is escaped with esc_html on the way into the database in sanitize_option
        	// we want to reverse this for the plain text arena of emails.
        	$blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
        
        $title = '【纪梵希美妆】忘记密码';
        
        $title = apply_filters('retrieve_password_title', $title);
        $message = apply_filters('retrieve_password_message', $message, $key);
        
        if ( $message && !wp_mail($user_email, $title, $message) ){
            //wp_die( __('The e-mail could not be sent.') . "<br />\n" . __('Possible reason: your host may have disabled the mail() function...') );
            $result['message'] = '邮件发送失败!';
            return $result;
        }else{
            $result['message'] = '邮件发送成功!';
            $result['success'] = true;
            return $result;
        }
        
        
    }
    
    //激活用户
    public function activation_user(){
        $user_id = ~(int)base64_decode($_REQUEST['code']);
        $key = $_REQUEST['key'];
        if(is_int($user_id) && $user = $this -> validation_activation_key($user_id, $key)){
            $user = new WP_User($user_id);
            //修改用户角色
            $user -> set_role('receptionuser-activation');
            //$user -> set_role('administrator');
            //update_user_meta( $user_id, 'fame_send_mail', $fame_send_mail );
            $this -> send_register_success_email($user);
            $this -> set_activation_key($user_id, '');
            header("Location: ".$this -> request_url);
            exit();
        }
        return false;
    }
    
    public function do_send_activation_email(){
        $user_id = $_REQUEST['user_id'];
        if(empty($user_id)){
            return false;
        }
        $mdl_user = $this -> get_model('user');
        $rs = $mdl_user -> getById($user_id, 'user_login,user_email,ID');
        if(empty($rs)){
            return false;
        }
        if($this -> send_activation_email($rs)){
            return true;
        }else{
            return false;
        }
    }
    
    public function send_activation_email($user){
        $key = wp_generate_password(20, false);
        if($this -> set_activation_key($user -> ID, $key)){
            add_action('wp_mail_content_type', 'jia_setEmailType');
            $br = "<br>";
            $title = '【纪梵希美妆】会员账号激活';
            $url = network_site_url('user-admin/').'?key='.$key.'&code='.base64_encode(~(int)$user -> ID).'&action=activation_user';
            $message .= '感谢您注册成为纪梵希官网会员！'.$br;
            $message .= '您的会员账号为：'.$br;
            $message .= $user -> user_login.$br;
            $message .= '请点击以下链接验证您的纪梵希官网会员电子邮箱：'.$br;
            $message .= '<a  href = "' .$url.'"> '.$url.' </a>'.$br;
            $message .= '完成验证后，您可登陆纪梵希官网，完善您的个人信息，并参与纪梵希官网的各项精彩活动。谢谢您的支持！'.$br.$br;
            $message .= '本邮件为系统自动发送的邮件，请不要回复本邮件。'.$br;
            $message .= '【纪梵希美妆】'.$br;
            
            wp_mail($user -> user_email, $title, $message);  
            return true;
        }
        return false;
    }
    
    public function send_register_success_email($user){
        add_action('wp_mail_content_type', 'jia_setEmailType');
        $br = "<br>";
        $space = '&nbsp;';
        $title = '【纪梵希美妆】会员注册成功';
        $message .= '您好，'.$user -> user_login.$br;
        $message .= '恭喜成功激活您的纪梵希官网会员账号！'.$br;
        $message .= '您的会员账号:'.$user -> user_login.$br;
        $message .= '您可登陆纪梵希官网，完善个人信息，并参与纪梵希官网的各项精彩活动。谢谢支持！'.$br.$br;
        $message .= '本邮件为系统自动发送的邮件，请不要回复本邮件。'.$br;
        $message .= '【纪梵希美妆】'.$br;
        
        if(wp_mail($user -> user_email, $title, $message)){
            return true;
        }else{
            return false;
        }  
    }
    
    private function setEmailType(){
        return 'text/html';
    }
    
    public function set_activation_key($user_id, $key){
        $mdl_user = $this -> get_model('user');
        $data = array(
            'user_activation_key' => $key
        );
        return $mdl_user -> update($user_id, $data);
    }
    
    public function validation_activation_key($user_id, $key){
        $mdl_user = $this -> get_model('user');
        $filter = array(
            'user_activation_key' => $key,
            'ID' => $user_id
        );
        return $mdl_user -> get_list_page($filter, '*', 1, 1);
    }
    
    public function add_user(){
        $login_name = $_POST['name'];
        $password = $_POST['password_f'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $result = array(
            'success' => false,
            'message' => '',
        );
        
        //added by grand
		if(strlen($password)<6){
            $result['message'] = '密码位数不得少于6位！';
            return $result;
        }
        
        if(!$this->check_phone($phone)){
            $result['message'] = '该电话号码已经注册！';
            return $result;
        }
        
        $data = array(
            'user_login' => $login_name,
            'user_pass' => $password,
            'user_email' => $email,
            'user_nicename' => $login_name,
            'display_name' => $login_name,
            'role' => 'receptionuser-unactivation',
            'user_registered' => date('Y-m-d H:i:s')
        );
        
        
        
        $rs = wp_insert_user($data);
        
        
        		
        if(isset($rs -> errors)){
            $result['message'] = '创建用户失败！';
            if(isset($rs -> errors['existing_user_email'])){
                $result['message'] = $rs -> errors['existing_user_email'][0];
            }
            if(isset($rs -> errors['existing_user_login'])){
                $result['message'] = $rs -> errors['existing_user_login'][0];
            }
            return $result;
        }else{
            $user_id = $rs;
            update_user_meta( $user_id, 'show_admin_bar_front', 'false' );
            update_user_meta( $user_id, 'show_admin_bar_admin', 'false' );
            update_user_meta( $user_id, 'fame_phone', $phone);
            $mdl_user = $this -> get_model('user');
            $userinfo = $mdl_user -> getById($user_id, 'user_login,user_email,ID');
            if($this -> send_activation_email($userinfo)){
                $result['message'] = '注册成功，激活邮件发送失败请重新发送！';
            }
            $result['success'] = true;
            $result['message'] = '注册成功，请去邮箱激活用户！';
            $result['uu'] = $user_id;
            return $result;
            
        }
        //update_user_meta( $user_id, 'fame_send_mail', $fame_send_mail );
    }
    
    public function show_user(){
        if(is_user_logged_in()){
            $user_info = wp_get_current_user();
            
        }
    }
    
    public function update_password(){
        $password_o = $_POST['password_o'];
        $password_f = $_POST['password_f'];
        $password_s = $_POST['password_s'];
        $result = array(
            'success' => false,
            'message' => '',
        );
		if(strlen($password_f)<6){
			$result['message'] = '密码不得少于6位！';
			return $result;
		}
		
        if(!is_user_logged_in()){
            $result['message'] = '请先登录！';
            return $result;
        }
        $user_info = wp_get_current_user();
        if($password_f != $password_s){
            $result['message'] = '两次密码不一致，请重新输入！';
            return $result;
        }
        if(user_pass_ok($user_info -> user_login, $password_o)){
            $data = array(
                'ID' => $user_info -> ID,
                'user_pass' => $password_f,
            );
            if(wp_update_user($data)){
                $result['message'] = '修改密码成功!';
                $result['success'] = true;      
            }else{
                $result['message'] = '修改密码失败！';
            }
            
        }else{
            $result['message'] = '原始密码不正确!';
        }  
        return $result;
    }
    
    public function update_forget_password(){
        $user_id = (int)$_POST['user_id'];
        $key = $_POST['key'];
        $password_f = $_POST['password_f'];
        $password_s = $_POST['password_s'];
        $result = array(
            'success' => false,
            'message' => '',
        );
        if($password_f != $password_s){
            $result['message'] = '两次密码不一致，请重新输入！';
            return $result;
        }
        if(!empty($user_id) && $user = $this -> validation_activation_key($user_id, $key)){
            $data = array(
                'ID' => $user_id,
                'user_pass' => $password_f,
            );
            if(wp_update_user($data)){
                $this -> set_activation_key($user_id, '');
                $result['message'] = '修改密码成功!';
                $result['success'] = true;      
            }else{
                $result['message'] = '修改密码失败！';
            }
        }else{
            $result['message'] = '信息不对，修改密码失败，请重新发送邮件!';
        }
        return $result;
    }
    
    public function update_user(){
        $result = array(
            'success' => false,
            'message' => '',
        );
        if(is_user_logged_in()){
            $user_info = wp_get_current_user();
            $sex = $_POST['gender'];
            $age = $_POST['birthday'];
            $name = $_POST['myName'];
            $use_brand = $_POST['useOfBrandVal'];
            $brand_name = $_POST['otherBrand'];
            $whetherSubscribers = $_POST['whetherSubscribers'];
            
            
            //print_r($use_brand);
            
            update_user_meta( $user_info -> ID, 'display_name', $name);
            update_user_meta( $user_info -> ID, 'user_age', $age );
            update_user_meta( $user_info -> ID, 'user_sex', $sex);
            update_user_meta( $user_info -> ID, 'use_brand', implode(',', $use_brand));
            if(in_array(7, $use_brand)){
                update_user_meta( $user_info -> ID, 'brand_name', $brand_name );
            }
            update_user_meta( $user_info -> ID, 'whetherSubscribers', $whetherSubscribers );
            $result['success'] = true;
            return $result;
            
        }
        $result['message'] = '请先登录!';
        return $result;
    }    
    
    public function checklogin(){
        if(!is_user_logged_in()){
            header("Location: ".$this -> request_url);
            exit();
        }
    }
    
    private function getAgeInfo(){
        return array(
            1 => '0-18岁',
            2 => '18-25岁',
            3 => '26-30岁',
            4 => '31-35岁',
            5 => '36-40岁',
            6 => '41-45岁',
            7 => '46+岁'
        );
    }
    
    private function getBrandInfo(){
        return array(
            1 => '香奈儿 CHANEL',
            2 => '雅诗兰黛 Estée Lauder',
            3 => '兰蔻 Lancome',
            4 => '海蓝之谜 LA MER',
            5 => '希思黎 Sisley',
            6 => '莱珀妮 La Prairie',
            7 => '其他'
        );
    }
    
    private function getSexInfo(){
        return  array(
            1 => '先生',
            2 => '小姐'
        );
    }
    
    private function getSendEmailInfo(){
        return  array(
            0 => '否',
            1 => '是'
        );
    }
    
    public function check_phone($phone){
        //return true;
        $mdl_user_meate = new model('wp_usermeta', 'umeta_id');
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