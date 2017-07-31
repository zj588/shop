<?php
namespace Home\Controller;

use Common\Controller\CommonController;

class GoodsController extends CommonController
{
	public function detail()
	{
		$id = I('id');
		//商品信息
		$goodsInfo = $this->model->alias('g')->join('left join shop_brand as b on g.brand_id = b.id')->field('g.*, b.brand_name')->where('g.id='.$id)->find();
		// echo M('Goods')->_sql();die;
		// dump($goodsInfo);die;

		//商品属性
		//SELECT g.*, a.attr_name, a.attr_type FROM `shop_goods_attr` g left join shop_attribute a on g.attr_id = a.id where g.goods_id = 1;
		$attrInfo = M('goods_attr')->alias('g')->field('g.*, a.attr_name, a.attr_type')->join('left join shop_attribute a on g.attr_id = a.id')->where('g.goods_id = ' . $id)->select();
		foreach ($attrInfo as $key => $val) {
			if ($val['attr_type'] == '1') {
				$attrInfo[$key]['attr_arr'] = explode(',', $val['attr_val']);
			}
		}

		//相册
		$picInfo = M('Pic')->where('goods_id=' . $id)->select();
		// dump($picInfo);die;
		
		// dump($attrInfo);die;

		$this->assign('attrInfo', $attrInfo);
		$this->assign('goodsInfo', $goodsInfo);
		$this->assign('picInfo', $picInfo);
		$this->display();
	}

	public function goodslist()
	{
		//获取所有的品牌
		$brandDatas = M('Brand')->select();

		//获取价格区间
		$priceDatas = getPrice();


		//获取对应的商品信息
		$where = 'goods_status = 1';

		//品牌删选
		$brand_id = I('brand_id');
		if (!empty($brand_id)) {
			$where .= ' and brand_id = ' . $brand_id;
		}

		//价格筛选
		$goods_price = I('goods_price');
		// echo $goods_price;die;
		if (!empty($goods_price)) {
			$priceArr = explode('-', $goods_price);

			if (count($priceArr) == 1) {
				$where .= ' and goods_price  >  ' . $priceArr[0];
			} else {
				$where .= ' and (goods_price  >  ' . $priceArr[0] . ' and goods_price <= ' . $priceArr[1] . ')';
			}
		}

		//分页。。。。。。。。
		//数据总条数
		$totalRows = $this->model->where($where)->count();
		// echo $this->model->_sql();die;
		//每页显示条数
		$listRows = 8;
		// echo $totalRows;die;
		//实例化分页对象
		$pageObj = new \Think\Page($totalRows, $listRows);
		// $pageObj->rollPage = 5;
		$page = $pageObj->show();


		$goodsDatas = M('Goods')->where($where)->limit($pageObj->firstRow, $pageObj->listRows)->select();
		

		$this->assign('brandDatas', $brandDatas);
		$this->assign('priceDatas', $priceDatas);
		$this->assign('goodsDatas', $goodsDatas);
		$this->assign('page', $page);
		$this->display();
	}
}