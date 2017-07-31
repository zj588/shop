<?php
return array(
	//'配置项'=>'配置值'
	//配置默认的URL路径
	// 'URL_MODEL' => 2,
	//配置模板常量
	'TMPL_PARSE_STRING' => array(
		'__HOME__' => __ROOT__ . '/Public/Home/',
		'__ADMIN__' => __ROOT__ . '/Public/Admin/',
        '__COMMON__' => __ROOT__ . '/Public/Common/',
		'__UPLOAD__' => __ROOT__ . '/Public/Upload/',
	),

	/* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'shop',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'aa',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'shop_',    // 数据库表前缀

    //跟踪信息
    'SHOW_PAGE_TRACE'       =>  true,

    //加载公共函数库文件
    'LOAD_EXT_FILE'         =>  'tree,treeList',

    //上传文件的类型
    'UPLOAD_PIC' => array(
        'maxSize'       =>  0, //上传的文件大小限制 (0-不做限制)
        'exts'          =>  array(), //允许上传的文件后缀
        'rootPath'      =>  UPLOAD_PATH, //保存根路径
    ),

    //支付宝配置
    'PAY_ALIPAY' => array(
        //合作身份者ID，签约账号，以2088开头由16位纯数字组成的字符串，查看地址：https://b.alipay.com/order/pidAndKey.htm
        'partner'       => '2088221626451032',

        //收款支付宝账号，以2088开头由16位纯数字组成的字符串，一般情况下收款账号就是签约账号
        'seller_id' => '2088221626451032',

        // MD5密钥，安全检验码，由数字和字母组成的32位字符串，查看地址：https://b.alipay.com/order/pidAndKey.htm
        'key'           => 'mq9n15kc0qqgrl5zkofztfs3vkv1k55s',

        // 服务器异步通知页面路径  需http://格式的完整路径，不能加?id=123这类自定义参数，必须外网可以正常访问
        'notify_url' => "http://www.tpshop.com/".ALIPAY_PATH."/notify_url.php",
        // 'notify_url'    => "http://www.tpshop.com/alipay/notify_url.php",

        // 页面跳转同步通知页面路径 需http://格式的完整路径，不能加?id=123这类自定义参数，必须外网可以正常访问
        'return_url' => "http://www.tpshop.com/".ALIPAY_PATH."/return_url.php",
        // 'return_url'    => "http://www.tpshop.com/alipay/return_url.php",

        //签名方式
        'sign_type'    => strtoupper('MD5'),

        //字符编码格式 目前支持 gbk 或 utf-8
        'input_charset'=> strtolower('utf-8'),

        //ca证书路径地址，用于curl中ssl校验
        //请保证cacert.pem文件在当前文件夹目录中
        'cacert'    => ALIPAY_PATH . '/cacert.pem',
        // 'cacert'        => VENDOR_PATH . 'cacert.pem',

        //访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
        'transport'    => 'http',

        // 支付类型 ，无需修改
        'payment_type' => "1",
                
        // 产品类型，无需修改
        'service' => "create_direct_pay_by_user",
    ),

    /**
     * 短信接口配置
     */
    'SEND_MSG' => array(
        //主帐号,对应开官网发者主账号下的 ACCOUNT SID
        'accountSid' =>  '8a216da85d158d1b015d6fe268ae2470',

        //主帐号令牌,对应官网开发者主账号下的 AUTH TOKEN
        'accountToken' =>  '00abd20e396441c78a7f4c1df5fda3b2',

        //应用Id，在官网应用列表中点击应用，对应应用详情中的APP ID
        //在开发调试的时候，可以使用官网自动为您分配的测试Demo的APP ID
        'appId' => '8a216da85d158d1b015d6fe26a952477',

        //请求地址
        //沙盒环境（用于应用开发调试）：sandboxapp.cloopen.com
        //生产环境（用户应用上线使用）：app.cloopen.com
        'serverIP' => 'sandboxapp.cloopen.com',


        //请求端口，生产环境和沙盒环境一致
        'serverPort' => '8883',

        //REST版本号，在官网文档REST介绍中获得。
        'softVersion' => '2013-12-26',
    ),


    /**
     * 短信接口配置
     */
    'SEND_EMAIL' => array(
        //链接域名邮箱的服务器地址
        'Host' =>  'smtp.163.com',

        //设置发件人姓名（昵称） 任意内容，显示在收件人邮件的发件人邮箱地址前的发件人姓名
        'FromName' =>  '邮件接口测试163',

        //smtp登录的账号 这里填入字符串格式的邮箱
        'Username' => 'zj66421180@163.com',

        //smtp登录的密码 使用生成的 授权码（就刚才叫你保存的最新的授权码）
        'Password' => 'jayz1366642',

        //设置发件人邮箱地址 这里填入上述提到的“发件人邮箱”
        'From' => 'zj66421180@163.com',
    ),
);