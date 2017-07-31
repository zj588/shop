<?php
namespace Home\Controller;

use Think\Controller;

class UcenterController extends Controller
{
	//控制器访问增加权限,防止用户翻墙
    public function __construct()
    {
        parent::__construct();
        if (!session('?uid')) {
            $this->error('请登录后再操作!');
        }
    }

    /**
     * 用户中心
     */
    public function center()
    {
    	$uid = session('uid');
    	$userInfo = M('User')->find($uid);

    	$this->assign('userInfo', $userInfo);
    	$this->display();
    }

    /**
     * 收货地址
     */
    public function address()
    {
    	$this->display();
    }


    /**
     * 订单
     */
    public function order()
    {
    	$uid = session('uid');

    	//查询用户的订单
    	$orderDatas = M('Order')->where('user_id = ' . $uid)->select();
    	$orderTotal = M('Order')->where('user_id = ' . $uid)->group('user_id')->count();
    	// echo M('Order')->_sql();die;

    	$this->assign('orderTotal', $orderTotal);
    	$this->assign('orderDatas', $orderDatas);
    	$this->display();
    }
}