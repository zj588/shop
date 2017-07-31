<?php
/**
 * 防止翻墙
 */
function checkLogin() {
	//防止翻墙
	if (!session('?username')) {
		redirect(U('login/login'), 3, '请先登录...');die;
	}

	//admin超级管理员可以访问任意权限
	if (session('username') != 'admin') {
		//防止越权访问
		//当前用户访问的控制器
		$conName = strtolower(CONTROLLER_NAME . '/' . ACTION_NAME);
		// echo $conName;

		//当前用户拥有的权限
		$menuList = M('Access')->alias('a')->field('a.*, m.menu_url')->join('left join shop_menu m on a.menu_id = m.id')->where(array('a.role_id'=>session('role_id')))->select();

		$menuArr = array();
		foreach ($menuList as $val) {
			if ($val['menu_url']) {
				$menuArr[] = strtolower($val['menu_url']);
			}
		}
		// dump($menuArr);die;

		//判断当前访问是否在权限范围内
		if (!in_array($conName, $menuArr)) {
			redirect(U('login/login'), 3, '抱歉，你没有权限访问该功能！');die;
		}
	}
	
}


/**
 * 防止xss攻击
 */
function htmlpurify($dirty_html) {
	vendor('htmlpurifier.library.HTMLPurifier#auto');

	//创建配置项
	$config = HTMLPurifier_Config::createDefault();
	//实例化对象
	$purifier = new HTMLPurifier($config);
	//过滤xss攻击
	$clean_html = $purifier->purify($dirty_html);

	return $clean_html;
}


/**
 * 上传图片
 */
function uploadFile($config) {
	$upload = new \Think\Upload(C($config));
	$info = $upload->upload();
	if (!$info) {
		echo $upload->getError();die;
	}

	return $info;
}

/**
 * 生成缩略图
 * @param $picPath string 要生成缩略图的原图路径
 * @param $thumbPath string 生成的缩略图的路径
 * @return $thumbObj obj 缩略图对象
 */
function thumbImg($picPath, $thumbPath) {
	//实例化缩略图对象
	$image = new \Think\Image();
	//打开要生成缩略图的图片
	$image->open($picPath);
	//生成缩略图
	$thumbObj = $image->thumb(50, 50)->save($thumbPath);

	return $thumbObj;
}

/**
 * 定义获取商品状态的函数
 */
function getGoodsStatus($key) {
	$arr = array(
		'0' => '删除',
		'1' => '上架中',
		'-1' => '已下架',
	);
	return $arr[$key];
}

/**
 * 定义获取菜单状态的函数
 */
function getMenuStatus($key) {
	$arr = array(
		'0' => '否',
		'1' => '是',
	);
	return $arr[$key];
}

/**
 * 定义获取菜单状态的函数
 */
function getAttrType($key) {
	$arr = array(
		'1' => '单选，下拉框',
		'2' => '输入框',
	);
	return $arr[$key];
}

/**
 * 定义价格区间
 */
function getPrice() {
	$arr = array(
		'0-200' => '0-200元',
		'200-500' => '200-500元',
		'500-1000' => '500-1000元',
		'1000' => '1000元以上',
	);
	return $arr;
}

/**
 * 定义配送方式
 */
function getSendType($key) {
	$arr = array(
		'1' => '申通',
		'2' => '圆通',
		'3' => '顺丰',
	);
	return $arr[$key];
}

/**
 * 定义支付方式
 */
function getPayType($key) {
	$arr = array(
		'1' => '余额',
		'2' => '支付宝',
	);
	return $arr[$key];
}

/**
 * vip等级
 */
function getVIPType($key) {
  $arr = array(
    '0' => '注册用户',
    '1' => 'VIP',
  );
  return $arr[$key];
}

/**
 * 订单状态
 */
function getOrderStatus($key) {
  $arr = array(
    '0' => '待付款',
    '1' => '已付款',
    '2' => '已发货',
    '3' => '确认收货',
    '4' => '订单完成',
    '5' => '取消订单'
  );
  return $arr[$key];
}


/**
 * 获取IP的地理位置
 */
function getLocation($ip) {
  //预定义接口参数
  // 类初始化操作，一定要指定IP数据库文件
  $location = new \Org\Net\IpLocation('qqwry.dat');
  //根据IP地址来获取地理信息
  $data = $location->getlocation($ip);
  // print_r($data);die;

  // $str     = $data['country'] . $data['area'];
  $country = iconv('GB2312', 'UTF-8', $data['country']);
  $area    = iconv('GB2312', 'UTF-8', $data['area']);
  
  return $country . $area;
}


/*
 * 封装curl
 *@param $url 请求API的地址  string
 *@param $method 请求方式 get/post
 *@param $param  请求参数 格式 username=1234&pwd=123
 *@return $content 请求结果返回 string
 */

function request($url, $method = 'get', $param = '')
{

    //请求初始化
    $ch = curl_init($url);
    //为了保险，我们增加一个设置  ，返回请求的数据
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //设置post请求参数
    if ($method == 'post') {
        //定义参数 格式：username=xiaohong&pwd=123
        //设置post请求
        curl_setopt($ch, CURLOPT_POST, true);
        //设置请求参数
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
    }
    //如果是get请求不需要设置请参数
    $content = curl_exec($ch); //执行发送请求
    curl_close(); //关闭连接资源

    return $content;
}

/**
 * CURL请求
 * @param $url 请求url地址
 * @param $method 请求方法 get post
 * @param null $postfields post数据数组
 * @param array $headers 请求header信息
 * @param bool|false $debug  调试开启 默认false
 * @return mixed
 */
function httpRequest($url, $method = "GET", $postfields = null, $headers = array(), $debug = false)
{
    $method = strtoupper($method);
    $ci     = curl_init();
    /* Curl settings */
    curl_setopt($ci, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
    curl_setopt($ci, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.2; WOW64; rv:34.0) Gecko/20100101 Firefox/34.0");
    curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 60); /* 在发起连接前等待的时间，如果设置为0，则无限等待 */
    curl_setopt($ci, CURLOPT_TIMEOUT, 7); /* 设置cURL允许执行的最长秒数 */
    curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
    switch ($method) {
        case "POST":
            curl_setopt($ci, CURLOPT_POST, true);
            if (!empty($postfields)) {
                $tmpdatastr = is_array($postfields) ? http_build_query($postfields) : $postfields;
                curl_setopt($ci, CURLOPT_POSTFIELDS, $tmpdatastr);
            }
            break;
        default:
            curl_setopt($ci, CURLOPT_CUSTOMREQUEST, $method); /* //设置请求方式 */
            break;
    }
    $ssl = preg_match('/^https:\/\//i', $url) ? true : false;
    curl_setopt($ci, CURLOPT_URL, $url);
    if ($ssl) {
        curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false); // https请求 不验证证书和hosts
        curl_setopt($ci, CURLOPT_SSL_VERIFYHOST, false); // 不从证书中检查SSL加密算法是否存在
    }
    //curl_setopt($ci, CURLOPT_HEADER, true); /*启用时会将头文件的信息作为数据流输出*/
    curl_setopt($ci, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ci, CURLOPT_MAXREDIRS, 2); /*指定最多的HTTP重定向的数量，这个选项是和CURLOPT_FOLLOWLOCATION一起使用的*/
    curl_setopt($ci, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ci, CURLINFO_HEADER_OUT, true);
    /*curl_setopt($ci, CURLOPT_COOKIE, $Cookiestr); * *COOKIE带过去** */
    $response    = curl_exec($ci);
    $requestinfo = curl_getinfo($ci);
    $http_code   = curl_getinfo($ci, CURLINFO_HTTP_CODE);
    if ($debug) {
        echo "=====post data======\r\n";
        var_dump($postfields);
        echo "=====info===== \r\n";
        print_r($requestinfo);
        echo "=====response=====\r\n";
        print_r($response);
    }
    curl_close($ci);
    return $response;
    //return array($http_code, $response,$requestinfo);
}


/**
  * 发送模板短信（短信接口）
  * @param to 手机号码集合,用英文逗号分开
  * @param datas 内容数据 格式为数组 例如：array('Marry','Alon')，如不需替换请填 null
  * @param $tempId 模板Id,测试应用和未上线应用使用测试模板请填写1，正式应用上线后填写已申请审核通过的模板ID
  */       
function sendTemplateSMS($to,$datas,$tempId)
{
     // 初始化REST SDK
	$config = C('SEND_MSG');
    // dump($config);die;
    //初始化配置项
    $accountSid = $config['accountSid'];
    $accountToken = $config['accountToken'];
    $appId = $config['appId'];
    $serverIP = $config['serverIP'];
    $serverPort = $config['serverPort'];
    $softVersion = $config['softVersion'];

    //加载REST类文件
    vendor('sendmsg.CCPRestSmsSDK');
     $rest = new \REST($serverIP,$serverPort,$softVersion);
     $rest->setAccount($accountSid,$accountToken);
     $rest->setAppId($appId);
    
     // 发送模板短信
     // echo "Sending TemplateSMS to $to <br/>";
     $result = $rest->sendTemplateSMS($to,$datas,$tempId);
     if($result == NULL ) {
     	return array('status' => 0, 'msg' => '消息发送失败');
         // echo "result error!";
         break;
     }
     if($result->statusCode!=0) {
     	$status = 0;
     	$msg = '消息发送失败';
         // echo "error code :" . $result->statusCode . "<br>";
         // echo "error msg :" . $result->statusMsg . "<br>";
         //TODO 添加错误处理逻辑
     }else{
     	$status = 1;
     	$msg = '消息发送成功';
         // echo "Sendind TemplateSMS success!<br/>";
         // // 获取返回信息
         // $smsmessage = $result->TemplateSMS;
         // echo "dateCreated:".$smsmessage->dateCreated."<br/>";
         // echo "smsMessageSid:".$smsmessage->smsMessageSid."<br/>";
         //TODO 添加成功处理逻辑
     }

     return array('status' => $status, 'msg' => $msg);
}


/*发送邮件方法
 *@param $to：接收者 $title：标题 $content：邮件内容
 *@param $accessory: 附件 array('附件路径' => '附件名称')
 *@param $toName：收件人昵称
 *@return bool true:发送成功 false:发送失败
 */
function sendEmail($to, $title, $content, $accessory = array(), $toName = '') {
	//引入邮箱的配置
	$config = C('SEND_EMAIL');

    //引入PHPMailer的核心文件 使用require_once包含避免出现PHPMailer类重复定义的警告
    vendor('PHPMailer.PHPMailerAutoload');
    //实例化PHPMailer核心类
    $mail = new \PHPMailer();

    //是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
    $mail->SMTPDebug = 1;

    //使用smtp鉴权方式发送邮件
    $mail->isSMTP();

    //smtp需要鉴权 这个必须是true
    $mail->SMTPAuth = true;

    //链接qq域名邮箱的服务器地址
    $mail->Host = $config['Host'];

    //设置使用ssl加密方式登录鉴权
    $mail->SMTPSecure = 'ssl';

    //设置ssl连接smtp服务器的远程服务器端口号，以前的默认是25，但是现在新的好像已经不可用了 可选465或587
    $mail->Port = 465;

    //设置发送的邮件的编码 可选GB2312 我喜欢utf-8 据说utf8在某些客户端收信下会乱码
    $mail->CharSet = 'UTF-8';

    //设置发件人姓名（昵称） 任意内容，显示在收件人邮件的发件人邮箱地址前的发件人姓名
    $mail->FromName = $config['FromName'];

    //smtp登录的账号 这里填入字符串格式的qq号即可
    $mail->Username = $config['Username'];

    //smtp登录的密码 使用生成的授权码（就刚才叫你保存的最新的授权码）
    $mail->Password = $config['Password'];

    //设置发件人邮箱地址 这里填入上述提到的“发件人邮箱”
    $mail->From = $config['From'];

    //邮件正文是否为html编码 注意此处是一个方法 不再是属性 true或false
    $mail->isHTML(true);

    //设置收件人邮箱地址 该方法有两个参数 第一个参数为收件人邮箱地址 第二参数为给该地址设置的昵称 不同的邮箱系统会自动进行处理变动 这里第二个参数的意义不大
    $mail->addAddress($to, $toName);

    //添加多个收件人 则多次调用方法即可
    // $mail->addAddress('xxx@163.com','lsgo在线通知');

    //添加该邮件的主题
    $mail->Subject = $title;

    //添加邮件正文 上方将isHTML设置成了true，则可以是完整的html字符串 如：使用file_get_contents函数读取本地的html文件
    $mail->Body = $content;

    //为该邮件添加附件 该方法也有两个参数 第一个参数为附件存放的目录（相对目录、或绝对目录均可）
    // $mail->addAttachment('./Jlib-1.1.0.js','Jlib.js'); 第二参数为在邮件附件中该附件的名称
    //同样该方法可以多次调用 上传多个附件
    // $mail->addAttachment('./Jlib-1.1.0.js','Jlib.js');
    if (!empty($accessory)) {
    	foreach ($accessory as $key => $val) {
    		$mail->addAttachment($key,$val);
    	}
    }

    $status = $mail->send();

    //简单的判断与提示信息
    if ($status) {
        return true;
    } else {
        return false;
    }
}









function getTime() {
  return date('Y-m-d H:i:s', time());
}