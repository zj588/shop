<?php
namespace Admin\Controller;

use Admin\Controller\CommonController;

class GoodsController extends CommonController
{
	public function showlist()
	{
		//分页。。。。。。。。
		//数据总条数
		$totalRows = $this->model->count();
		//每页显示条数
		$listRows = 2;
		// echo $totalRows;die;
		//实例化分页对象
		$pageObj = new \Think\Page($totalRows, $listRows);
		$pageObj->rollPage = 5;
		$page = $pageObj->show();

		//每页显示的数据
		$goodsList = $this->model->where('goods_status != 0')->limit($pageObj->firstRow, $listRows)->select();

		$this->assign('page', $page);
		$this->assign('goodsList', $goodsList);
		$this->display();
	}

	//商品增加
	public function add()
	{
		if (IS_POST) {
			// echo __DIR__;die;
			$data = I('post.');
			// dump($data);die;

			if ($_FILES['f_goods_image']['name']) {
				//上传图片
				$info = uploadFile('UPLOAD_PIC');

				//打开要生成缩略图的图片
				$picPath = UPLOAD_PATH.$info['f_goods_image']['savepath'].$info['f_goods_image']['savename'];
				//缩略图的路径和名称
				$thumbPath = UPLOAD_PATH.$info['f_goods_image']['savepath'].'thumb_'.$info['f_goods_image']['savename'];
				thumbImg($picPath, $thumbPath);


				//保存大图
				$data['goods_big_pic'] = $info['f_goods_image']['savepath'].$info['f_goods_image']['savename'];
				//保存小图
				$data['goods_thumb_pic'] = $info['f_goods_image']['savepath'].'thumb_'.$info['f_goods_image']['savename'];
			}

			$data['goods_description'] = htmlpurify($_POST['goods_description']);
			$data['goods_addtime'] = time();

			$res = M('Goods')->add($data);

			if ($res) {
				//将属性插入到数据库
				$attrData = array();
				foreach ($data['goods_attr'] as $key => $val) {
					$attrData[] = array(
						'goods_id' => $res,
						'attr_id' => $key,
						'attr_val' => implode(',', $val)
					);
				}
				M('goods_attr')->addAll($attrData);

				$this->success('增加成功', U('showlist'));
			} else {
				$this->error('增加失败');
			}
		} else {
			$brandList = M('Brand')->field('id', 'brand_name')->select();
			$categoryList = M('Category')->field(array('id', 'category_pid'=>'pid', 'category_name'))->select();
			$categoryTree = getTree($categoryList);

			$this->assign('cate', M('Cate')->select());
			$this->assign('brandList', $brandList);
			$this->assign('categoryTree', $categoryTree);
			$this->display();
		}
	}

	//商品下架
	public function xiajia()
	{
		$id = I('id');

		$goodsInfo = $this->model->find($id);
		//判断商品的状态
		$data['goods_status'] = $goodsInfo['goods_status'] == 1 ? -1 : 1;
		$data['goods_updatetime'] = time();

		//修改商品的状态
		// $res = $this->model->save($goodsInfo);
		$res = $this->model->where('id=' . $id)->save($data);
		// echo $this->model->getLastSql();die;

		if ($res) {
			$msg = array('status'=>1, 'msg'=>'操作成功');
			$this->ajaxReturn($msg);
		} else {
			$msg = array('status'=>0, 'msg'=>'操作失败');
			$this->ajaxReturn($msg);
		}
		
	}

	//商品删除
	public function del()
	{
		$id = I('id');
		$data['goods_status'] = 0;
		$data['goods_updatetime'] = time();

		$res = $this->model->where('id=' . $id)->save($data);
		if ($res) {
			$msg = array('status'=>1, 'msg'=>'操作成功');
			$this->ajaxReturn($msg);
		} else {
			$msg = array('status'=>0, 'msg'=>'操作失败');
			$this->ajaxReturn($msg);
		}
	}

	// 商品相册
	public function pic()
	{

		if (IS_POST) {
			$goods_id = I('goods_id');
			// echo $goods_id;die;
			$goods_name = M('goods')->field('goods_name')->find($goods_id);
			// echo $goods_name['goods_name'];
			// dump($_FILES);die;
			if ($_FILES['image']['name'][0]) {
				//上传图片
				$info = uploadFile('UPLOAD_PIC');
				// dump($info);die;

				//将图片路径保存到数据库
				foreach ($info as $key => $val) {
					//生成缩略图
					//打开图片路径
					$picPath = UPLOAD_PATH . $val['savepath'] . $val['savename'];
					//生成缩略图路径
					$thumbPath = UPLOAD_PATH . $val['savepath'] . 'thumb_' . $val['savename'];
					
					thumbImg($picPath, $thumbPath);

					//将图片路径保存到数据库
					$datas[$key]['pic_path'] = $val['savepath'] . $val['savename'];
					$datas[$key]['pic_thumb_path'] = $val['savepath'] . 'thumb_' . $val['savename'];
					$datas[$key]['goods_id'] = $goods_id;
					$datas[$key]['goods_name'] = $goods_name['goods_name'];
				}

				//插入数据库
				$res = M('Pic')->addAll($datas);
				if ($res) {
					$this->success('插入成功', U('pic', 'id='.$goods_id));
				} else {
					$this->error('插入失败');
				}
			}
		} else {
			$goods_id = I('id');
			// echo $goods_id;die;
			//商品名称
			$goods = M('Goods')->find($goods_id);
			// echo $goods_name['goods_name'];die;

			$goodsPhoto = M('Pic')->where('goods_id='.$goods_id)->select();

			$this->assign('goodsPhoto', $goodsPhoto);
			$this->assign('goods', $goods);
			$this->display();
		}
		
	}

	//删除商品相册
	public function picdel()
	{
		$id = I('pic_id');

		$model = M('Pic');
		$picInfo = $model->find($id);
		if ($picInfo) {
			//要删除的图片路径
			$delPath = UPLOAD_PATH . $picInfo['pic_path'];
			$delThumbPath = UPLOAD_PATH . $picInfo['pic_thumb_path'];
			unlink($delPath);
			unlink($delThumbPath);

			$res = $model->delete($id);
			if ($res) {
				$msg = array('status'=>1, 'msg'=>'删除成功');
				$this->ajaxReturn($msg);
			} else {
				$msg = array('status'=>0, 'msg'=>'删除失败');
				$this->ajaxReturn($msg);
			}
		}
	}

	//商品修改
	public function edit()
	{
		if (IS_POST) {
			$data = I('post.');

			//上传图片
			if ($_FILES['f_goods_image']['name']) {
				//1. 删除旧图片
				$goodsInfo = $this->model->find(I('id'));
				//要删除的图片路径
				$delPath = UPLOAD_PATH . $goodsInfo['goods_big_pic'];
				$delThumbPath = UPLOAD_PATH . $goodsInfo['goods_thumb_pic'];
				unlink($delPath);
				unlink($delThumbPath);

				//2. 上传新图片
				$info = uploadFile('UPLOAD_PIC');
				// dump($info);die;

				//打开图片路径
				$picPath = UPLOAD_PATH . $info['f_goods_image']['savepath'] . $info['f_goods_image']['savename'];
				//上传缩略图
				$thumbPath = UPLOAD_PATH . $info['f_goods_image']['savepath'] . 'thumb_' . $info['f_goods_image']['savename'];

				thumbImg($picPath, $thumbPath);

				//将图片保存到数据库
				$data['goods_big_pic'] = $info['f_goods_image']['savepath'] . $info['f_goods_image']['savename'];
				$data['goods_thumb_pic'] = $info['f_goods_image']['savepath'] . 'thumb_' . $info['f_goods_image']['savename'];
			}

			//将数据修改到数据库
			$res = $this->model->save($data);

			if ($res) {
				$this->success('修改成功', U('showlist'));
			} else {
				$this->error('修改失败');
			}
		} else {
			$id = I('id');

			//查找对应的商品信息
			$goodsInfo = $this->model->find($id);
			//分类信息
			$categoryList = M('Category')->field(array('id', 'category_pid'=>'pid', 'category_name'))->select();
			$categoryTree = getTree($categoryList);
			// dump($categoryTree);die;
			//品牌信息
			$brandList = M('Brand')->select();

			$this->assign('categoryTree', $categoryTree);
			$this->assign('brandList', $brandList);
			$this->assign('goodsInfo', $goodsInfo);
			$this->display();
		}
	}
}