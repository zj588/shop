<?php
namespace Admin\Controller;

use Admin\Controller\CommonController;

class CategoryController extends CommonController
{
    public function showlist()
    {
    	$categoryList = $this->model->select();

    	$categoryTree = getTree($categoryList);

    	$this->assign('categoryTree', $categoryTree);
        $this->display();
    }

    public function add()
    {
    	$categoryList = $this->model->field(array('id', 'category_pid'=>'pid', 'category_name'))->select();

    	$categoryTree = getTree($categoryList);
    	// dump($categoryTree);die;

    	$this->assign('categoryTree', $categoryTree);
        $this->display();
    }
}