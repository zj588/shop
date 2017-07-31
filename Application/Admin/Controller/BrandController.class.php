<?php
namespace Admin\Controller;

use Admin\Controller\CommonController;

class BrandController extends CommonController 
{
	/**
	 * 列表页
	 */
    public function showlist()
    {
    	$brandList = $this->model->where('status = 1')->select();

    	$this->assign('brandList', $brandList);
        $this->display();
    }

    /**
     * 删除方法
     */
    public function del()
    {
    	$id = $_GET['id'];

    	$datas['id'] = $id;
    	$datas['status'] = 0;

    	//AR模式
    	// $model = M('Brand');
    	// $model->id = $id;
    	// $model->status = 0;

    	$res = $this->model->save($datas);

    	if ($res) {
			$this->success('删除成功', U('showlist'));
		}else {
			$this->error('删除失败', U('showlist'));
		}
    }

    /**
     * 修改方法
     */
    public function edit()
    {
    	if (IS_POST) {
    		// $data = I('post.');
    		// dump($data);die;
    		$model = D('Brand');
    		$data = $model->create();

    		$res = $model->save($data);

    		if ($res) {
				$this->success('修改成功', U('showlist'));
			}else {
				$this->error('修改失败', U('edit'));
			}
    	}else {
    		$id = I('id');

    		$brand = $this->model->find($id);

    		$this->assign('brand', $brand);
    		$this->display();
    	}
    }

    /**
     * 增加方法
     */
    public function add()
    {
    	if (IS_POST) {
    		// $datas = I('post.');

    		// $res = M('Brand')->add($datas);

    		$model = D('Brand');
    		$data = $model->create();
            $data['time'] = time();
    		if (!$data) {
	            $this->error($model->getError());
	        }
    		// dump($data);die;
    		$res = $model->add();

    		if ($res) {
    			$this->success('增加成功', U('showlist'));
    		}else {
    			$this->error('增加失败', U('add'));
    		}
    	}else {
    		$this->display();
    	}
        
    }
}