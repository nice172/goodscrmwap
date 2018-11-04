<?php

// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

// 定义 hash 各常量
define("PBKDF2_HASH_ALGORITHM", "sha256"); // 哈希算法名称:例如 md5，sha256 等
define("PBKDF2_ITERATIONS", 1000); // 进行导出时的迭代次数。
define("PBKDF2_SALT_BYTE_SIZE", 24); // SALT密钥导出数据的长度
define("PBKDF2_HASH_BYTE_SIZE", 24); // HASH密钥导出数据的长度

define("HASH_SECTIONS", 4);
define("HASH_ALGORITHM_INDEX", 0);
define("HASH_ITERATION_INDEX", 1);
define("HASH_SALT_INDEX", 2);
define("HASH_PBKDF2_INDEX", 3);
define('ENCODE_KEY', '|}+——--JFIEOAJFP()#*@&&!&@^$%":?>,,');

//格式金额
function _formatMoney($MoenyCount){
	return substr(sprintf("%.3f",$MoenyCount),0,-1);
}

//检测格式
function checkemail($email){
	$pattern="/([a-z0-9]*[-_.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[.][a-z]{2,3}([.][a-z]{2})?/i";
	if(preg_match($pattern,$email)){
		return true;
	}
	return false;
}

/**
 *数字金额转换成中文大写金额的函数
 *String Int $num 要转换的小写数字或小写字符串
 *return 大写字母
 *小数位为两位
 **/
function _formatMoneyChinese($num){
	$c1 = "零壹贰叁肆伍陆柒捌玖";
	$c2 = "分角元拾佰仟万拾佰仟亿";
	$num = round($num, 2);
	//将数字转化为整数
	$num = $num * 100;
	if (strlen($num) > 10) {
		return "金额太大，请检查";
	}
	$i = 0;
	$c = "";
	while (1) {
		if ($i == 0) {
			//获取最后一位数字
			$n = substr($num, strlen($num)-1, 1);
		} else {
			$n = $num % 10;
		}
		//每次将最后一位数字转化为中文
		$p1 = substr($c1, 3 * $n, 3);
		$p2 = substr($c2, 3 * $i, 3);
		if ($n != '0' || ($n == '0' && ($p2 == '亿' || $p2 == '万' || $p2 == '元'))) {
			$c = $p1 . $p2 . $c;
		} else {
			$c = $p1 . $c;
		}
		$i = $i + 1;
		//去掉数字最后一位了
		$num = $num / 10;
		$num = (int)$num;
		//结束循环
		if ($num == 0) {
			break;
		}
	}
	$j = 0;
	$slen = strlen($c);
	while ($j < $slen) {
		//utf8一个汉字相当3个字符
		$m = substr($c, $j, 6);
		//处理数字中很多0的情况,每次循环去掉一个汉字“零”
		if ($m == '零元' || $m == '零万' || $m == '零亿' || $m == '零零') {
			$left = substr($c, 0, $j);
			$right = substr($c, $j + 3);
			$c = $left . $right;
			$j = $j-3;
			$slen = $slen-3;
		}
		$j = $j + 3;
	}
	if (substr($c, strlen($c)-3, 3) == '零') {
		$c = substr($c, 0, strlen($c)-3);
	}
	if (empty($c)) {
		return "零元整";
	}else{
		return $c . "整";
	}
}

/*加密解密 ENCODE 加密   DECODE 解密*/
function _encrypt($string, $operation = 'ENCODE', $key = '', $expiry = 0){
	if($operation == 'DECODE') {
		$string =  str_replace('_', '/', $string);
	}
	$key_length = 4;
	$key = md5($key != '' ? $key : ENCODE_KEY);
	$fixedkey = md5($key);
	$egiskeys = md5(substr($fixedkey, 16, 16));
	$runtokey = $key_length ? ($operation == 'ENCODE' ? substr(md5(microtime(true)), -$key_length) : substr($string, 0, $key_length)) : '';
	$keys = md5(substr($runtokey, 0, 16) . substr($fixedkey, 0, 16) . substr($runtokey, 16) . substr($fixedkey, 16));
	$string = $operation == 'ENCODE' ? sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$egiskeys), 0, 16) . $string : base64_decode(substr($string, $key_length));
	
	$i = 0; $result = '';
	$string_length = strlen($string);
	for ($i = 0; $i < $string_length; $i++){
		$result .= chr(ord($string{$i}) ^ ord($keys{$i % 32}));
	}
	if($operation == 'ENCODE') {
		$retstrs =  str_replace('=', '', base64_encode($result));
		$retstrs =  str_replace('/', '_', $retstrs);
		return $runtokey.$retstrs;
	} else {
		if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$egiskeys), 0, 16)) {
			return substr($result, 26);
		} else {
			return '';
		}
	}
}

/*
 * 格式化的dump
 **/
function p($var) {
    header("Content-Type: text/html; charset=utf-8");
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}

/**
 * 生产hash值
 * @param $password 创建的密码
 * @return string
 */
function create_hash($password)
{
    // MCRYPT_DEV_URANDOM：从随机源创建初始向量
    $salt = base64_encode(mcrypt_create_iv(PBKDF2_SALT_BYTE_SIZE, MCRYPT_DEV_URANDOM));
    return PBKDF2_HASH_ALGORITHM . ":" . PBKDF2_ITERATIONS . ":" .  $salt . ":" .
        base64_encode(pbkdf2(
            PBKDF2_HASH_ALGORITHM,
            $password,
            $salt,
            PBKDF2_ITERATIONS,
            PBKDF2_HASH_BYTE_SIZE,
            true
        ));
}

/**
 * 验证密码做对比
 * 提交的密码与数据库的hash值对比，成功返回true
 * @param $password  提交密码
 * @param $correct_hash 数据库保存数据
 * @return bool true || false
 */
function validate_password($password, $correct_hash)
{
    $params = explode(":", $correct_hash);
    if (count($params) < HASH_SECTIONS) {
        return false;
    }
    $pbkdf2 = base64_decode($params[HASH_PBKDF2_INDEX]);
    return slow_equals(
        $pbkdf2,
        pbkdf2(
            $params[HASH_ALGORITHM_INDEX],
            $password,
            $params[HASH_SALT_INDEX],
            (int)$params[HASH_ITERATION_INDEX],
            strlen($pbkdf2),
            true
        )
    );
}

// 比较两个字符串 $A 和 $B 的长度常数时间.
function slow_equals($a, $b)
{
    $diff = strlen($a) ^ strlen($b);
    for($i = 0; $i < strlen($a) && $i < strlen($b); $i++)
    {
        $diff |= ord($a[$i]) ^ ord($b[$i]);
    }
    return $diff === 0;
}

/*
 * PBKDF2密钥导出函数由RSA的PKCS # 5定义：https://www.ietf.org/rfc/rfc2898.txt
 * $algorithm 散列算法的使用。推荐：SHA256
 * $password 密码。
 * $salt  一个唯一的密码是唯一的。
 * $count 迭代计数。越高越好，但速度越慢。推荐：至少1000。
 * $key_length 导出密钥字节长度。
 * $raw_output 如果是真的，关键是在原始的二进制格式返回。其他编码的十六进制。
 * Returns: 来自密码和盐key_length-byte关键。
 *
 * 测试可以在这里找到：https://www.ietf.org/rfc/rfc6070.txt
 *
 * 本实现PBKDF2最初是由https://defuse.ca
 * 改进的http://www.variations-of-shadow.com
 */
function pbkdf2($algorithm, $password, $salt, $count, $key_length, $raw_output = false)
{
    $algorithm = strtolower($algorithm);
    if(!in_array($algorithm, hash_algos(), true))
        trigger_error('PBKDF2 ERROR: Invalid hash algorithm.', E_USER_ERROR);
    if($count <= 0 || $key_length <= 0)
        trigger_error('PBKDF2 ERROR: Invalid parameters.', E_USER_ERROR);

    if (function_exists("hash_pbkdf2")) {
        // 输出长度处于半字节 （4 位），如果 $raw_output 是假的 ！
        if (!$raw_output) {
            $key_length = $key_length * 2;
        }
        return hash_pbkdf2($algorithm, $password, $salt, $count, $key_length, $raw_output);
    }

    $hash_length = strlen(hash($algorithm, "", true));
    $block_count = ceil($key_length / $hash_length);

    $output = "";
    for($i = 1; $i <= $block_count; $i++) {
        // $i 编码为 4 个字节，大字节序。
        $last = $salt . pack("N", $i);
        // 第一次迭代
        $last = $xorsum = hash_hmac($algorithm, $last, $password, true);
        // 执行其他 $count-1 迭代
        for ($j = 1; $j < $count; $j++) {
            $xorsum ^= ($last = hash_hmac($algorithm, $last, $password, true));
        }
        $output .= $xorsum;
    }

    if($raw_output) {
        return substr($output, 0, $key_length);
    } else {
        return bin2hex(substr($output, 0, $key_length));
    }
}

function getParams($id){
   $id = intval($id);
   $find = db('params')->where(['id' => $id])->find();
   if (empty($find)) return [];
   $find['params_value'] = explode("\n", $find['params_value']);
   return $find;
}

function getTextParams($id){
    $id = intval($id);
    $find = db('params')->where(['id' => $id])->find();
    if (empty($find)) return '';
    return $find['params_value'];
}

function getFileParams($id){
    $id = intval($id);
    $find = db('params')->where(['id' => $id])->find();
    if (empty($find)) return '';
    return $find['file'];
}

function send_email($user,$Subject='',$file='',$Body='',$copyTo='',$AltBody=''){
    $mail = new PHPMailer\PHPMailer();
    try {
        //Server settings
        $mail->SMTPDebug = false;                                 // Enable verbose debug output
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = config('syc_email_smtp');  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = config('syc_webemail');                 // SMTP username
        $mail->Password = config('syc_email_pwd');                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = config('syc_port');                                    // TCP port to connect to
        
        //Recipients
        $mail->setFrom(config('syc_webemail'), 'Admin');
        if (empty($user)) return false;
        if (is_array($user)){
            foreach ($user as $val){
                $mail->addAddress($val);     // Add a recipient
            }
        }else{
            $mail->addAddress($user);
        }
        // 	        $mail->addAddress('ellen@example.com');               // Name is optional
        // 	        $mail->addReplyTo('info@example.com', 'Information');
        
        if (!empty($copyTo)){
            if (is_array($copyTo)){
                foreach ($copyTo as $val){
                    $mail->addCC($val);
                }
            }else{
                $mail->addCC($copyTo); //抄送
            }
        }
        // 	$mail->addBCC('bcc@example.com'); //密送
        
        //Attachments
        if (!empty($file)){
            if (is_array($file)){
                foreach ($file as $path){
                    $mail->addAttachment($path);         // Add attachments
                }
            }else{
                $mail->addAttachment($file);         // Add attachments
            }
        }
        
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        
        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $Subject?:'Here is the subject';
        $mail->Body    = $Body?:$Subject;
        $mail->AltBody = $AltBody?:'alt';
        
        $mail->send();
        //echo 'Message has been sent';
        return true;
    } catch (\Exception $e) {
        //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
    return false;
}

/**
 * 递归子节点
 * @param array $data
 * @param number $parentid
 * @return array
 */
function getChild($data = array(),$parentid = 0){
	$array = array();
	foreach ($data as $key => $value){
		if ($value['parentid'] == $parentid){
			$value['child'] = getChild($data,$value['id']);
			$array[] = $value;
		}
	}
	return $array;
}

/**
 * 递归到最顶级
 * @param array $data
 * @param unknown $parentid
 * @return unknown
 */
function getParent($data = array(),$parentid){
	foreach ($data as $key => $value){
		if ($value['id'] == $parentid){
			if ($value['parentid']){
				return getParent($data,$value['parentid']);
			}else{
				return $value;
			}
		}
	}
}

/**
 * https请求（支持GET和POST）
 * @param $url
 * @param string $data
 * @return mixed
 */
function https_request($url, $data = null){
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
	//如果$data不是空使用POST
	if (!empty($data)){
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	}
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($curl);
	curl_close($curl);
	return $output;
}


/*
 * 订单号生成系统
 * 生成唯一标识符
 * 如：103 6 2 30 8492，103为2015算起的第三年，6为下半年，2为下半年第二个月也就是8月份，30为号，后面四位是随机数
 * */
if (!function_exists('StrOrderOne'))
{
    function StrOrderOne() {
        $y = date('Y');
        $upper = array('1'=>'01','2'=>'02','3'=>'03','4'=>'04','5'=>'05','6'=>'06');
        $unde  = array('1'=>'07','2'=>'08','3'=>'09','4'=>'10','5'=>'11','6'=>'12');
        $date_y = date('Y') - $y;
        if ($date_y <= 0) {
            $yea = '1';
        } else {
            $yea = $date_y + 1;
        }
        $date_m = date('m');
        $date_d = date('d');
        //$date_h = date('h');
        if ($date_m <= '06') {
            $half = '5'; // 设定上半年为5
            $key = array_search($date_m, $upper); // 取得上半年的键值
        } else {
            $half = '6'; // 设定下半年为6
            $key = array_search($date_m, $unde);  // 取得下半年的键值
        }
        $arr = NoRand(0,9,4);
        $orders = '100' + $yea . $half . $key . $date_d  . implode('',$arr);
        
        //$orders = $date_h;
        return date('Y').(mt_rand(100000,999999)+$orders);
    }
}

function StrOrderOne2() {
        $date = date('Ymd');
        $arr = NoRand(0,9,3);
        $orders = $date . implode('',$arr);
        $result = \think\Db::name('purchase')->where('pnumber',$orders)->find();
		if ($result) {
			StrOrderOne2();
		}
        return $orders;
    }

/*
 * 随机数
 * */
if (! function_exists('NoRand')) {
    function NoRand($begin=1, $end=9, $limit=4) {
        $rand_array = range($begin,$end);
        shuffle($rand_array); //调用现成的数组随机排列函数
        return array_slice($rand_array,0,$limit); //截取前$limit个
    }
}

/*
 *  配置写入文件
 *
 */
function Setting_Config(){
    //取出数据
    $query = new \think\db\Query();
    $config = $query->table('syc_config')->field('name,value')->select();
    //开始进行数据写入
    $_fp = @fopen(APP_PATH.'Setting.php','w') or die ("Unable to open file!"); //文件地址 W表示可写
    flock($_fp, LOCK_EX); //锁定文件
    fwrite($_fp, "<"."?php\r\n");
    fwrite($_fp,"return array(\r\n");
    $result = array_change_key_case($config,CASE_LOWER);//将数组中的键值转换为小写
    foreach ($result AS $k => $v){
        $_string = "  '$v[name]' => '$v[value]',\r\n";  //数据格式排列
        fwrite($_fp, $_string, strlen($_string));  //循环开始写入
    }
    fwrite($_fp, ");"); //文件结束
    flock($_fp, LOCK_UN);
    fclose($_fp); //解锁文件
}

/**
 *  增加减少天数
 *
 * @param     int  $ntime  当前时间
 * @param     int  $aday   增加天数用正数，减少天数用负数
 * @return    int
 */
if (!function_exists('AddSubDay'))
{
    function AddSubDay($ntime, $aday) {
        $dayst = 3600 * 24;
        $oktime = $ntime + ($aday * $dayst);
        return $oktime;
    }
}

/**
 *  获取执行时间
 *  例如:$t1 = ExecTime();
 *       在一段内容处理之后:
 *       $t2 = ExecTime();
 *  我们可以将2个时间的差值输出:echo $t2-$t1;
 *
 *  @return    int
 */
if (!function_exists('ExecTime'))
{
    function ExecTime() {
        $time = explode(" ", microtime());
        $usec = (double)$time[0];
        $sec = (double)$time[1];
        return $sec + $usec;
    }
}

/*
 * 一个论坛上的代码 自己修改了下，可以在模版中使用菜单形式，不过就是需要自己输入当前的URL，所以这个用处不是很大
 * @return $rule 要验证的规则名称；
 * @return $uid  用户的id；
 * @return $relation 规则组合方式，默认为‘or’，以上三个参数都是根据Auth的check（）函数来的，
 * @return $true  符合规则后，执行的代码
 * @return $false  不符合规则的，执行代码，默认为抛出字符串‘没有权限’
 * */
function authCheck($rule, $uid, $true, $false='没有权限') {
    //判断当前用户UID是否在定义的超级管理员参数里
    if( in_array(intval($uid), Config('AUTH_ADMINISTRATOR_ID'))){
        return $true;    //如果是，则直接返回真值，不需要进行权限验证
    } else {
        //如果不是，则进行权限验证；
        $Auth = new \Auth();
        return $Auth->check($rule, $uid) ? $true : $false;
    }
}

/**
 * 检查是否为超管
 * $uid 用户ID
 * $session  session id
 * @return bool true: 管理员，false: 非管理员
 */
//function IS_ROOT($uid = null, $session) {
//    $uid = is_null($uid) ? $session : $uid ;
    //对比设定的超管ID数组，存在即可通过
//    return in_array(intval($uid), Config('AUTH_ADMINISTRATOR_ID'));
    //return $uid && intval($uid) === Config('AUTH_ADMINISTRATOR_ID');
//}

function IS_ROOT($item=array()) {
    return true;
    $arr = is_array($item) ? $item : '';
    $id = \think\Session::get('user_auth');
    //ctype_digit(strval($arr));
    if (empty($arr)) {
        return false;
    } else {
        //
        $result = in_array($id, $arr);
        if ($result == true) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * 简洁的 分类形成树状直接输出
 * 数组的KEY值必须大于0起步
 * $items
 * @return array
 */
// 将分类id作为数组key
// $items = array();
// foreach($data as $key=>$val){
//     $items[$val['id']] = $val;
// }
function getAuthGroupTree($data){
    $items = array();
    $tree = array();
    // 将分类id作为数组key
    foreach ($data as $val) {
        $items[$val['id']] = $val;
    }
    foreach($items as $val){
        if(isset($items[$val['user_auth']])){
            $items[$val['user_auth']]['son'][] = &$items[$val['id']];
        }else{
            $tree[] = &$items[$val['id']];
        }
    }
    //return $tree;
    p($tree);
}

/*
 * 判断是否整数或浮点数做四舍五入并保留2位浮点数，不够以0充数
 * */
if (!function_exists('get_numeric')) {
    function get_numeric($val) {
        if (is_numeric($val)) {
            return sprintf("%.2f",$val + 0);
        }
        return 0;
    }
}

/*
 * 过滤字符串中只能有中文字母数字和小点-
 * */
if (!function_exists('filterOrders')) {
    function filterOrders($val) {
        preg_match_all('/[\x{4e00}-\x{9fa5}a-zA-Z0-9.-]/u',$val,$item);
        return join('',$item[0]);
    }
}

/*
 * 过滤字符串中只能有数字和小点
 */
function filter_mount($val) {
    preg_match_all('/[0-9.]/u',$val,$item);
    return join('',$item[0]);
}

/*
 * 过滤字符串中只能有数字
 */
function filter_numbers($val) {
    preg_match_all('/[0-9]/u',$val,$item);
    return join('',$item[0]);
}

/*
 * 取得剩余天数
 * $start='2017-01-01' 开始时间
 *  $exec='2017-01-01' 结束时间
 *
 * */
function CountDownDays($exec) {
    //date_default_timezone_set("PRC");//设置中国时区
    //$time  = time(); //获取当前时间
    $time  = date('Y-m-d'); //获取当前时间
    //$she = \think\Config::get('delivery_period');
    $date = (strtotime($exec) - strtotime($time)) / (60 * 60 * 24); //相差时间
    $tian='发货';
    switch (true)
    {
        case $date == 1:
            $item = '明天'.$tian;
            break;
        case $date == 2:
            $item = '后天'.$tian;
            break;
        case $date >= 3:
            $item = '还有'.$date.'天'.$tian;
            break;
        case $date == 7:
            $item = '还有'.$date.'天'.$tian;
            break;
        case $date < 0:
            $item = '<code>已超期'.filter_numbers($date).'天</code>';
            break;
        default :
            $item = '今天正好'.$tian;
            break;
    }
    return $item;
}


/*
 * 生产周期
 * */
function Shengchanzq($pstart, $pend) {
    $date = (strtotime($pend) - strtotime($pstart)) / (60 * 60 * 24); //取得时间
    return $date.'天';
}

/*
 * 销售订单状况
 *
 * */
function purchase_status($value, $list='list') {
    if ('list' == $list) {
        switch ($value)
        {
            case -1:
                $item = '<span class="label label-sm status-n">已废除</span>';
                break;
            case 0:
                $item = '<span class="label label-sm status-0">审核中</span>';
                break;
            case 1:
                $item = '<span class="label label-sm status-1">已收订</span>';
                break;
            case 2:
                $item = '<span class="label label-sm status-2">生产中</span>';
                break;
            case 3:
                $item = '<span class="label label-sm status-3">生产完</span>';
                break;
            case 4:
                $item = '<span class="label label-sm status-4">待出库</span>';
                break;
            case 5:
                $item = '<span class="label label-sm status-5">已出库</span>';
                break;
            default:
                $item = '<span class="label label-sm status-6"> 其 他 </span>';
                break;

        }
    } else {
        switch ($value)
        {
            case -1:
                $item = '已废除';
                break;
            case 0:
                $item = '审核中';
                break;
            case 1:
                $item = '已收订';
                break;
            case 2:
                $item = '生产中';
                break;
            case 3:
                $item = '生产完';
                break;
            case 4:
                $item = '待出库';
                break;
            case 5:
                $item = '已出库';
                break;
            default:
                $item = ' 其 他 ';
                break;
        }
    }
    return $item;
}


/*
 * 判断是否0以上数字
 * 可带引号判断
 * 带小数点为false
 *
 * */
function isInteger($input){
    return(ctype_digit(strval($input)));
}

//去除Html所有标签、空格以及空白
function cutstr_html($string){
    $str = trim($string); //清除字符串两边的空格
    $str = preg_replace("/\t/","",$str); //使用正则表达式替换内容，如：空格，换行，并将替换为空。
    $str = preg_replace("/\r\n/","",$str);
    $str = preg_replace("/\r/","",$str);
    $str = preg_replace("/\n/","",$str);
    $str = preg_replace("/《/","",$str);
    $str = preg_replace("/》/","",$str);
    $str = preg_replace("/</","",$str);
    $str = preg_replace("/>/","",$str);
    $str = preg_replace ('/&nbsp;/is', '', $str);;
    $str = preg_replace("/ /","",$str);  //匹配html中的空格
    $str = preg_replace("/  /","",$str);  //匹配html中的空格
    $str = preg_replace("/(s*?r?ns*?)+/","n",$str); //去除字符串内部的空行
    $str = preg_replace('/($s*$)|(^s*^)/m', '',$str); //去除全部的空行，包括内部和头尾
    return trim($str); //返回字符串
}

//过滤字符串中特殊字符
function strFilter($str){
    $str = str_replace('`', '', $str);
    $str = str_replace('·', '', $str);
    $str = str_replace('~', '', $str);
    $str = str_replace('!', '', $str);
    $str = str_replace('！', '', $str);
    $str = str_replace('@', '', $str);
    $str = str_replace('#', '', $str);
    $str = str_replace('$', '', $str);
    $str = str_replace('￥', '', $str);
    $str = str_replace('%', '', $str);
    $str = str_replace('^', '', $str);
    $str = str_replace('……', '', $str);
    $str = str_replace('&', '', $str);
    $str = str_replace('*', '', $str);
    $str = str_replace('(', '', $str);
    $str = str_replace(')', '', $str);
    $str = str_replace('（', '', $str);
    $str = str_replace('）', '', $str);
    $str = str_replace('-', '', $str);
    $str = str_replace('_', '', $str);
    $str = str_replace('——', '', $str);
    $str = str_replace('+', '', $str);
    $str = str_replace('=', '', $str);
    $str = str_replace('|', '', $str);
    $str = str_replace('\\', '', $str);
    $str = str_replace('[', '', $str);
    $str = str_replace(']', '', $str);
    $str = str_replace('【', '', $str);
    $str = str_replace('】', '', $str);
    $str = str_replace('{', '', $str);
    $str = str_replace('}', '', $str);
    $str = str_replace(';', '', $str);
    $str = str_replace('；', '', $str);
    $str = str_replace(':', '', $str);
    $str = str_replace('：', '', $str);
    $str = str_replace('\'', '', $str);
    $str = str_replace('"', '', $str);
    $str = str_replace('“', '', $str);
    $str = str_replace('”', '', $str);
    $str = str_replace(',', '', $str);
    $str = str_replace('，', '', $str);
    $str = str_replace('<', '', $str);
    $str = str_replace('>', '', $str);
    $str = str_replace('《', '', $str);
    $str = str_replace('》', '', $str);
    $str = str_replace('.', '', $str);
    $str = str_replace('。', '', $str);
    $str = str_replace('/', '', $str);
    $str = str_replace('、', '', $str);
    $str = str_replace('?', '', $str);
    $str = str_replace('？', '', $str);
    return trim($str);
}

//去除JSON中的双引号或单引号、空格以及空白
function cutstr_json($string) {

}


/**
 * 获取时间戳
 * $Ymd = Y 年
 * $Ymd = m 月
 * $Ymd = d 日
 * $Ymd = NULL 当前时间戳
 * $xia = true 是否取下次开始时间戳：取下年开始时间戳 或者下月开始时间戳  或者明日开始时间戳
 */
function getTime($Ymd=NULL,$xia=false){
    if($Ymd=='Y' && $xia==true){
        //取下个年度开始时间戳
        return strtotime((date('Y',time())+1).'-01-01 00:00:00');
    }
    else if($Ymd=='Y'){
        //取本年度开始时间戳
        return strtotime(date('Y',time()).'-01-01 00:00:00');
    }
    else if($Ymd=='m' && $xia==true){
        //取下个月度开始时间戳
        $xiayue_nianfen    =    date('Y',time());
        $xiayue_yuefen    =    date('m',time());
        if($xiayue_yuefen==12){
            $xiayue_nianfen    +=    1;    //如果月份等于12月，那么下月年份+1
            $xiayue_yuefen    =    1;    //如果月份等于12月，那么下月月份=1月
        }
        else{
            $xiayue_yuefen    +=    1;    //如果月份不是12月，那么在当前月份上+1
        }
        return strtotime($xiayue_nianfen.'-'.$xiayue_yuefen.'-01 00:00:00');
    }
    else if($Ymd=='m'){
        //取本月度开始时间戳
        return strtotime(date('Y-m',time()).'-01 00:00:00');
    }
    else if($Ymd=='d' && $xia==true){
        //取明日开始时间戳
        return strtotime(date('Y-m-d',time()).' 00:00:00')+86400;
    }
    else if($Ymd=='d'){
        //取今日开始时间戳
        return strtotime(date('Y-m-d',time()).' 00:00:00');
    }
    else{
        //取当前时间戳
        return time();
    }
}