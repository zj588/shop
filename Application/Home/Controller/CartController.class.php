<?php
namespace Home\Controller;

use Common\Controller\CommonController;

class CartController extends CommonController
{
	public function add()
	{
		//接受数据
		$data = I('post.');
		$goods_id = $data['goods_id'];
		// dump($data);die;
		//查找对应的商品信息
		$goodsData = M('Goods')->find($goods_id);

		$cartDatas['goods_id'] = $goods_id;
		$cartDatas['cart_count'] = $data['number'];
		$cartDatas['goods_attr'] = json_encode($data['attr_val']);
		$cartDatas['goods_name'] = $goodsData['goods_name'];
		$cartDatas['goods_pic'] = $goodsData['goods_thumb_pic'];
		$cartDatas['goods_mprice'] = $goodsData['goods_mprice'];
		$cartDatas['goods_price'] = $goodsData['goods_price'];
		$cartDatas['goods_count'] = $goodsData['goods_count'];
		// dump($cartDatas);die;

		//判断用户是否登录，确定保存数据的方式
		if (session('?uid')) {
			$cartDatas['user_id'] = session('uid');

			//判断是否商品已经存在数据表中
			$oldGoods = $this->model->where("goods_id = $goods_id and user_id = " . session('uid'))->find();
			// dump($oldGoods);die;

			if ($oldGoods) {
				$res = $this->model->where("goods_id = $goods_id and user_id = " . session('uid'))->save($cartDatas);
			} else {
				//将商品信息加入购物车表
				$res = $this->model->add($cartDatas);
			}


			if ($res) {
				$this->redirect('showlist');
			} else {
				$this->error('该商品已加入购物车！');
			}
		} else {
			//判断购物车中是否已经有商品
			$oldDatas = cookie('cartDatas');
			if ($oldDatas) {
				$oldDatas = unserialize($oldDatas);
				// dump($oldDatas);die;
				$oldDatas[$goods_id] = $cartDatas;

				cookie('cartDatas', serialize($oldDatas), 3600);
			} else {
				$newDatas[$goods_id] = $cartDatas;
				cookie('cartDatas', serialize($newDatas), 3600);
			}
		}

		$this->redirect('showlist');
	}

	public function showlist()
	{
		if (session('?uid')) {
			$user_id = session('uid');

			//从购物车查找相应的商品信息
			$cartDatas = $this->model->where("user_id = $user_id")->select();
			
		} else {
			$cartDatas = unserialize(cookie('cartDatas'));
		}

		//计算总价
		$totalP = 0;
		foreach ($cartDatas as $key => $val) {
			$cartDatas[$key]['goods_attr'] = json_decode($val['goods_attr'], true);
			$totalP += $val['goods_price'] * $val['cart_count'];
		}

		// dump($cartDatas);die;
		
		$this->assign('totalP', $totalP);
		$this->assign('cartDatas', $cartDatas);
		$this->assign('cart_goods', serialize($cartDatas));
		$this->display();
	}

	public function del()
	{
		$goods_id = I('goods_id');

		if (session('?uid')) {
			$res = $this->model->where("goods_id = $goods_id and user_id = " . session('uid'))->delete();

			//判断cookie中是否也有该商品，有也将其删除
			// $oldDatas = unserialize(cookie('cartDatas'));
			// if (isset($oldDatas[$goods_id])) {
			// 	unset($oldDatas[$goods_id]);
			// }

			if ($res) {
				$this->ajaxReturn(array('status' => 1, 'msg' => '删除成功'));
			} else {
				$this->ajaxReturn(array('status' => 0, 'msg' => '删除失败'));
			}
		} else {
			$oldDatas = unserialize(cookie('cartDatas'));

			unset($oldDatas[$goods_id]);

			cookie('cartDatas', serialize($oldDatas), 3600);

			$this->ajaxReturn(array('status' => 1, 'msg' => '删除成功'));
		}
	}

	public function delAll()
	{
		if (session('?uid')) {
			$res = $this->model->where("user_id = " . session('uid'))->delete();

			//判断cookie中是否也有该商品，有也将其删除
			// $oldDatas = unserialize(cookie('cartDatas'));
			// if (isset($oldDatas[$goods_id])) {
			// 	unset($oldDatas[$goods_id]);
			// }

			if ($res) {
				$this->ajaxReturn(array('status' => 1, 'msg' => '删除成功'));
			} else {
				$this->ajaxReturn(array('status' => 0, 'msg' => '删除失败'));
			}
		} else {
			cookie('cartDatas', null);

			$this->ajaxReturn(array('status' => 1, 'msg' => '删除成功'));
		}
	}

	public function edit()
	{
		$goods_id = I('goods_id');
		$cart_count = I('cart_count');

		if (session('?uid')) {
			$this->model->where("goods_id = $goods_id and user_id = " . session('uid'))->save(array('cart_count' => $cart_count));
		} else {
			$cartDatas = unserialize(cookie('cartDatas'));

			$cartDatas[$goods_id]['cart_count'] = $cart_count;

			cookie('cartDatas', serialize($cartDatas), 3600);
		}
	}
}