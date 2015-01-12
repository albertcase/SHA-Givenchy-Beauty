<?php
class GivenchySms {
    private $url = 'sdk2.entinfo.cn';
    private $sn = 'SDK-BBX-010-14086';
    private $pwd = '996161';

    public function send_sms($phone, $text, $rs_id) {
        $send_text =  iconv("UTF-8", "gb2312//ignore", $text);
        $param = array(
            'mobile' => $phone, //手机号 多个用英文的逗号隔开 post理论没有长度限制.推荐群发一次小于等于10000个手机号
            'content' => $send_text, //短信内容//base64_encode();
            'ext' => '',
            'rrid' => $rs_id, //默认空 如果空返回系统生成的标识串 如果传值保证值唯一 成功则返回传入的值
            'stime' => '' //定时时间 格式为2011-6-29 11:09:21
        );
        $rs = $this->http($param, 'z_mdsmssend.aspx');
        return $rs;
    }

    function GetBalance() {
        $line = $this->http(array(), 'webservice.asmx/balance');
        $line = str_replace("<string xmlns=\"http://tempuri.org/\">", "", $line);
        $line = str_replace("</string>", "", $line);
        $result = explode("-", $line);
        if (count($result) > 1){
            //echo '发送失败返回值为:' . $line;
            return false;
        }else{
            //echo '发送成功 返回值为:' . $line;
            return $line;
        }
        return $line;
    }

    function http($params, $mothed) {
        $argv1 = array(
            'sn' => $this->sn, //提供的账号
            'pwd' => strtoupper(md5($this->sn . $this->pwd)), //此处密码需要加密 加密方式为 md5(sn+password) 32位大写
        );
        $argv = array_merge($params, $argv1);
        $params = "";
        $flag = 0;
        //构造要post的字符串
        foreach ($argv as $key => $value) {
            if ($flag != 0) {
                $params .= "&";
                $flag = 1;
            }
            $params .= $key . "=";
            $params .= urlencode($value);
            $flag = 1;
        }
        $length = strlen($params);
        //创建socket连接
        $fp = fsockopen($this->url, 80, $errno, $errstr, 10) or exit($errstr . "--->" .
            $errno);
        //构造post请求的头
        $header = "POST /" . $mothed . " HTTP/1.1\r\n";
        $header .= "Host:" . $this->url . "\r\n";
        $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $header .= "Content-Length: " . $length . "\r\n";
        $header .= "Connection: Close\r\n\r\n";
        //添加post的字符串
        $header .= $params . "\r\n";
        //发送post的数据
        fputs($fp, $header);
        $inheader = 1;
        while (!feof($fp)) {
            $line = fgets($fp, 1024); //去除请求包的头只显示页面的返回数据
            if ($inheader && ($line == "\n" || $line == "\r\n")) {
                $inheader = 0;
            }
            //if ($inheader == 0) {
                //var_dump($line);
            //}
        }
        fclose($fp);
        return $line;
    }
}
//$text = 'Givenchy纪梵希美妆 感谢您参加”十二星座蛋白质女孩”活动，恭喜您已申领成功，请凭短信，于9月4日-10月7日期间，前往¡°*****（如上海新世界）纪梵希专柜，（南京西路2-88号新世界商场一层Givenchy专柜）¡±，电话****，领取焕颜美肌乳液体验装2ML，守护你的肌肤蛋白质';
//echo strlen($text);
//'mobile' => '18637703726', //手机号 多个用英文的逗号隔开 post理论没有长度限制.推荐群发一次小于等于10000个手机号
//'mobile' => '18621816755', //手机号 多个用英文的逗号隔开 post理论没有长度限制.推荐群发一次小于等于10000个手机号
//'mobile' => '13916809199', //手机号 多个用英文的逗号隔开 post理论没有长度限制.推荐群发一次小于等于10000个手机号

//$test = new GivenchySms();
//$text = '短信测试！';
//$phone = 18637703726;

//$test->send_sms($phone, $text);
//$test -> GetBalance();


?>
