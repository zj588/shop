<?php
namespace Home\Controller;

use Think\Controller;

class ApiController extends Controller
{
	public function curl()
	{
		//使用CURL来实现天气接口的访问
        $url = 'http://api.map.baidu.com/telematics/v2/weather?location=%E4%B8%9C%E8%8E%9E&ak=B8aced94da0b345579f481a1294c9094';

        //1.初始化curl
        $ch = curl_init();

        //2.配置
        //2.1 请求地址
        curl_setopt($ch, CURLOPT_URL, $url);
        //2.2 将数据流返回而不是直接输出（说明：true则curl_exec有返回值，返回没有）
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //3. 发送http请求
        $data = curl_exec($ch);

        //4.关闭curl http请求
		curl_close($ch);


		var_dump($data);
	}

	/**
	 * 短信接口（发送手机短信）
	 */
	public function send_msg()
	{
		$phone = I('user_phone');
		$msg_code = rand(1000, 9999);

		//记录号码
		session('msg_code', $msg_code);
		//*假设您用测试Demo的APP ID，则需使用默认模板ID 1，发送手机号是13800000000，传入参数为6532和5，则调用方式为
		//*result = sendTemplateSMS("13800000000" ,array('6532','5'),"1");
		$res = sendTemplateSMS($phone, array($msg_code, '1'), '1');

		$this->ajaxReturn($res);
	}

	/**
	 * 邮件接口
	 */
	public function send_email()
	{
		/*发送邮件方法
		 *@param $to：接收者 $title：标题 $content：邮件内容
		 *@param $accessory: 附件 array('附件路径' => '附件名称')
		 *@param $toName：收件人昵称
		 *@return bool true:发送成功 false:发送失败
		 */
		$accessory = array(
			'./1.jpg' => '1.jpg',
			'./2.jpg' => '2.jpg'
		);
		sendEmail('1045481256@qq.com', '测试三：多附件上传', 'hello world 2', $accessory);
	}

	/**
	 * 快递接口
	 */
	public function get_express()
	{
		$url = 'https://www.kuaidi100.com/query?type=jd&postid=VC34438354672';

		$data = file_get_contents($url);
		$data = json_decode($data, true);
		// dump($data);
		foreach ($data['data'] as $key => $val) {
			echo $val['time'] . ' ' . $val['context'] . '<br>';
		}
	}

	/**
	 * 商品详情接口
	 * http://shop.com/index.php/Home/api/goodsApi/id/1.html
	 */
	public function goodsApi()
	{
		//接受商品id
		$id = I('id');

		//商品信息
		$goodsData = M('Goods')->find($id);

		echo json_encode($goodsData);
	}

	/**
	 * 物理地址接口
	 */
	public function iplocationApi()
	{
		//预定义接口参数
        $ip = I('ip');
        // 类初始化操作，一定要指定IP数据库文件
        $location = new \Org\Net\IpLocation('qqwry.dat');
        //根据IP地址来获取地理信息
        $data = $location->getlocation($ip);
        // print_r($data);die;

        $str     = $data['country'] . $data['area'];
        $country = iconv('GB2312', 'UTF-8', $data['country']);
        $area    = iconv('GB2312', 'UTF-8', $data['area']);
        echo json_encode(array('country' => $country, 'area' => $area));exit;
	}

	public function html()
	{
		$url = 'http://shop.com/index.php/Home/index/index';
		$html = file_get_contents($url);
		file_put_contents('index.html', $html);
	}
}