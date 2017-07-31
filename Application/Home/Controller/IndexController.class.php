<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller 
{
	public function __construct()
	{
		parent::__construct();
			// dump(cookie('userData'));die;
		if (!session('?uid') && cookie('userData')) {
			$infoArr = unserialize(cookie('userData'));
			// dump($infoArr);die;

			session('uid', $infoArr['uid']);
			session('user_name', $infoArr['username']);
		}
	}

    public function index()
    {
        //获取商品分类
        $categoryList = M('Category')->select();
        $categoryTree = list_to_tree($categoryList, 'id', 'category_pid');
        // dump($categoryTree);die;

        $goodsModel = M('Goods');
        
        //最新商品
        $newGoods = $goodsModel->order('goods_addtime desc')->limit(3)->select();
        // dump($newGoods);die;
        //推荐商品
        $recGoods = $goodsModel->order('goods_sort')->limit(3)->select();
        //热卖商品
        $hotGoods = $goodsModel->order('goods_click desc')->limit(3)->select();


        $this->assign('categoryTree', $categoryTree);
        $this->assign('newGoods', $newGoods);
        $this->assign('recGoods', $recGoods);
        $this->assign('hotGoods', $hotGoods);
        $this->display();
    }

    //最新商品
    public function getNew()
    {
        $goodsModel = M('Goods');
        $where = 'goods_status = 1';

        $category_id = I('category_id');
        !empty($category_id) ? $category_id : 0;
        if ($category_id) {
            $where .= " and category_id = $category_id";
        }

        $newGoods = $goodsModel->where($where)->order('goods_addtime desc')->limit(3)->select();
        // dump($newGoods);die;
        $this->ajaxReturn($newGoods);
    }

    //推荐商品
    public function getRec()
    {
        $goodsModel = M('Goods');
        $where = 'goods_status = 1';

        $category_id = I('category_id');
        !empty($category_id) ? $category_id : 0;
        if ($category_id) {
            $where .= " and category_id = $category_id";
        }

        $recGoods = $goodsModel->where($where)->order('goods_sort')->limit(3)->select();
        // dump($recGoods);die;
        $this->ajaxReturn($recGoods);
    }

    //热卖商品
    public function getHot()
    {
        $goodsModel = M('Goods');
        $where = 'goods_status = 1';

        $category_id = I('category_id');
        !empty($category_id) ? $category_id : 0;
        if ($category_id) {
            $where .= " and category_id = $category_id";
        }

        $hotGoods = $goodsModel->where($where)->order('goods_click desc')->limit(3)->select();
        // dump($hotGoods);die;
        $this->ajaxReturn($hotGoods);
    }
}