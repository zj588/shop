<?php
namespace Admin\Controller;

use Admin\Controller\CommonController;

class AttributeController extends CommonController
{
	public function showlist()
	{
		$datas = $this->model->alias('a')->field('a.*, c.cate_name')->join('left join shop_cate c on a.cate_id = c.id')->select();

		$this->assign('datas', $datas);
		$this->display();
	}

	public function add()
	{
		if (IS_POST) {
			$data = I('post.');

			$res = $this->model->add($data);

			if ($res) {
				$this->success('添加成功', U('showlist'));
			} else {
				$this->error('添加失败');
			}
		} else {
			//获取商品类型
			$this->assign('datas', M('Cate')->select());
			$this->display();
		}
	}

	public function del()
	{
		$id = I('id');

		$res = $this->model->delete($id);

		if ($res) {
			$this->success('删除成功', U('showlist'));
		} else {
			$this->error('删除失败');
		}
	}

	public function edit()
	{
		if (IS_POST) {
			$data = I('post.');
			// dump($data);die;

			$res = $this->model->save($data);

			if ($res) {
				$this->success('修改成功', U('showlist'));
			} else {
				$this->error('修改失败');
			}
		} else {
			$id = I('id');
			// echo $id;die;
			$data = $this->model->find($id);
			// dump($data);die;

			$this->assign('data', $data);
			$this->assign('datas', M('Cate')->select());
			$this->display();
		}
	}

	//获取对应商品分类的属性列表
	public function getAttr()
	{
		$cate_id = I('cate_id');

		$datas = $this->model->where('cate_id=' . $cate_id)->select();

		$this->ajaxReturn($datas);
	}
}