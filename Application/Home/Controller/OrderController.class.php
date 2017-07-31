<?php
namespace Home\Controller;

use Think\Controller;

class OrderController extends Controller
{
	//控制器访问增加权限,防止用户翻墙
    public function __construct()
    {
        parent::__construct();
        if (!session('?uid')) {
            $this->error('请登录后再操作!');
        }
    }
    
	public function show()
	{
		$data = $_POST;
		// dump($data);die;
		if (is_array($data['goods_id'])) {
			//购物车提交多个商品的时候
			// echo $data['cart_goods'];
			$goodsData = unserialize($data['cart_goods']);
			// dump($goodsData);die;
			$order_data = array();//每个商品的信息
			$order_goods_datas = array();//订单的全部信息
			foreach ($goodsData as $key => $val) {
				//商品信息
				$order_data['goods_id'] = $val['goods_id'];
				$order_data['goods_name'] = $val['goods_name'];
				$order_data['goods_attr'] = $val['goods_attr'];
				$order_data['goods_mprice'] = $val['goods_mprice'];
				$order_data['goods_price'] = $val['goods_price'];
				$order_data['cart_count'] = $val['cart_count'];

				$order_goods_datas[] = $order_data;
			}
		} else {
			//直接从商品页面购买**********
			$goodsData = M('Goods')->find($data['goods_id']);
			//商品信息
			$order_data['goods_id'] = $data['goods_id'];
			$order_data['goods_name'] = $goodsData['goods_name'];
			$order_data['goods_attr'] = $data['attr_val'];
			$order_data['goods_mprice'] = $goodsData['goods_mprice'];
			$order_data['goods_price'] = $goodsData['goods_price'];
			$order_data['cart_count'] = $data['number'];

			$order_goods_datas[$data['goods_id']] = $order_data;
		}
		

		// dump($order_goods_datas);die;
		//计算总价
		$totalP = 0;
		foreach ($order_goods_datas as $key => $val) {
			$order_goods_datas[$key]['subtotal'] = $val['goods_price'] * $val['cart_count'];
			$totalP += $val['goods_price'] * $val['cart_count'];
		}

		//获取收货信息
		$addr_data = M('Address')->where('user_id = ' . session('uid'))->select();


		$this->assign('totalP', $totalP);
		$this->assign('order_goods_datas', $order_goods_datas);
		$this->assign('form_goods_data', serialize($order_goods_datas));
		$this->assign('addr_data', $addr_data);
		$this->display();
	}

	public function add() {
		$data = $_POST;
		// dump($data);die;
		//查询收货信息
		$addr_data = M('Address')->where('user_id = ' . session('uid'))->find();
		// dump($addr_data);die;

		//将订单信息添加到order主表
		$order_data['order_number'] = date('YmdHis', time()) . session('uid') . rand(1000, 9999);
		$order_data['user_id'] = session('uid');
		$order_data['order_name'] = $addr_data['addr_name'];
		$order_data['order_address'] = $addr_data['addr_address'];
		$order_data['order_phone'] = $addr_data['addr_phone'];
		$order_data['order_addtime'] = $order_data['order_updatetime'] = time();
		$order_data['order_send'] = $data['order_send'];
		$order_data['order_pay_type'] = $data['order_pay_type'];

		//查询总价
		$form_goods_data = unserialize($data['form_goods_data']);
		// dump($form_goods_data);die;

		$totalP = 0;
		foreach ($form_goods_data as $val) {
			$totalP += $val['goods_price'] * $val['cart_count'];
		}
		$order_data['order_price'] = $totalP;
		//数据入表
		$order_id = M('order')->add($order_data);

		//商品信息添加到goods_order从表
		if ($order_id) {
			foreach ($form_goods_data as $val) {
				$goods_data['goods_name'] = $val['goods_name'];
				$goods_data['goods_attr'] = serialize($val['goods_attr']);
				$goods_data['goods_count'] = $val['cart_count'];
				$goods_data['goods_price'] = $val['goods_price'];
				$goods_data['order_id'] = $order_id;
				$goods_data['goods_id'] = $val['goods_id'];

				$res = M('goods_order')->add($goods_data);
			}

			if ($res) {
				$this->redirect('pay', 'oid='.$order_id);
			} else {
				$this->error('服务器繁忙，请稍后再试');
			}
		}
	}

	public function pay()
	{
		$order_id = I('oid');
		// echo $order_id;die;
		//查询订单信息
		$order_data = M('Order')->find($order_id);
		// dump($order_data);die;

		$this->assign('order_data', $order_data);
		$this->display();
	}

	public function paynow()
	{
		//订单ID
		$order_id = I('oid');

		//查询订单信息
		$order_data = M('Order')->find($order_id);

		switch ($order_data['order_pay_type']) {
			case 1:
				# code...
				//待完成************************************************************************************************************************************************************************
				break;

			case 2:
				vendor("alipay.lib.alipay_submit#class");

				$alipay_config = C('PAY_ALIPAY');

				//订单信息
				//商户订单号，商户网站订单系统中唯一订单号，必填
		        $out_trade_no = $order_data['order_number'];

		        //订单名称，必填
		        $subject = '雍达商城订单提交';

		        //付款金额，必填
		        $total_fee = $order_data['order_price'];

		        //商品描述，可空
		        $body = '商品购买';

		        //构造要请求的参数数组，无需改动
				$parameter = array(
						"service"       => $alipay_config['service'],
						"partner"       => $alipay_config['partner'],
						"seller_id"  => $alipay_config['seller_id'],
						"payment_type"	=> $alipay_config['payment_type'],
						"notify_url"	=> $alipay_config['notify_url'],
						"return_url"	=> $alipay_config['return_url'],
						
						"anti_phishing_key"=>$alipay_config['anti_phishing_key'],
						"exter_invoke_ip"=>$alipay_config['exter_invoke_ip'],
						"out_trade_no"	=> $out_trade_no,
						"subject"	=> $subject,
						"total_fee"	=> $total_fee,
						"body"	=> $body,
						"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
						//其他业务参数根据在线开发文档，添加参数.文档地址:https://doc.open.alipay.com/doc2/detail.htm?spm=a219a.7629140.0.0.kiX33I&treeId=62&articleId=103740&docType=1
				        //如"参数名"=>"参数值"
						
				);

				//建立请求
				$alipaySubmit = new \AlipaySubmit($alipay_config);
				$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
				echo $html_text;
				break;
			
			default:
				break;
		}
	}


	/**
	 * 通过用户名订单查询
	 */
	public function getOrderByName()
	{
		$user_name = I('user_name');
		//查询用户ID
		$userData = M('user')->where("user_name like '$user_name'")->select();

		//查询订单
		$datas = array();
		foreach ($userData as $key => $val) {
			$orderData = M('order')->alias('o')->field('o.*, g.goods_name, g.goods_count')->join('left join shop_goods_order g on o.id = g.order_id')->where('user_id = ' . $val['id'])->find();
			$orderData['user_name'] = $val['user_name'];
			$datas[] = $orderData;
		}
		

		$this->ajaxReturn($datas);
	}

	/**
	 * 通过用户名订单查询
	 */
	public function getOrderByTime()
	{
		$timeData = I('post.');

		//查询订单
		$orderData = M('order')->alias('o')->field('o.*, g.goods_name, g.goods_count')->join('left join shop_goods_order g on o.id = g.order_id')->where('user_id = ' . $val['id'])->find();
		

		$this->ajaxReturn($datas);
	}
}