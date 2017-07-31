<?php
namespace Admin\Controller;

use Admin\Controller\CommonController;

class CateController extends CommonController
{
	public function showlist()
	{
		$datas = $this->model->select();

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

			$res = $this->model->save($data);

			if ($res) {
				$this->success('修改成功', U('showlist'));
			} else {
				$this->error('修改失败');
			}
		} else {
			$id = I('id');
			//获取要修改的类型信息
			$data = $this->model->find($id);

			$this->assign('data', $data);
			$this->display();
		}
	}
}