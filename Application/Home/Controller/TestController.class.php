<?php
namespace Home\Controller;

use Think\Controller;

class TestController extends Controller
{
	public function test()
	{
		// $arr = array('1'=>'小明', '2'=>'小白', '3'=>'小红', '4'=>'小黑');
		// $this->assign('arr', $arr);
		$this->display();
	}

	public function test2()
	{
		$str = 'hello world';
		$this->assign('str', $str);
		$this->display('test');
	}

	public function test3()
	{
		$str = '';
		$this->assign('str', $str);
		$this->display('test');
	}

	public function test4()
	{
		$this->display();
	}

	public function test5()
	{
		$arr = array(
			'user1'=>'小黄', 
			'user2'=>'小白', 
			'user3'=>'小红', 
			'user4'=>'小黑'
		);
		// $arr = array('小明','小白', '小红', '小黑'
		// );
		$this->assign('arr', $arr);
		$this->display();
	}

	public function test6()
	{
		$date = date('N');
		$this->assign('date', $date);
		$this->display();
	}

	public function test7()
	{
		// $model = new \Home\Model\BrandModel();
		// $model->getList();

		$model = M('Brand');
		// dump($model);die;
		// $model->getList();

		//增加操作
		// $arr = array(
		// 	'brand_name' => 'nokia',
		// 	'brand_sort' => 1
		// );
		// $arr2 = array(
		// 	array('brand_name' => '小米', 'brand_sort' => 2),
		// 	array('brand_name' => '华为', 'brand_sort' => 3),
		// 	array('brand_name' => '三星', 'brand_sort' => 4)
		// );
		// $rs = $model->addAll($arr2);

		// 修改操作
		$arr = array(
			'brand_name' => '诺基亚',
			'brand_sort' => 1,
			'id' => 1
		);
		$rs = $model->save($arr);

		//查询操作
		//单条查询
		// $rs = $model->find(3);
		//多条查询
		// $rs = $model->select('1, 3');
		// $rs = $model->order('id desc')->select('1, 3');

		//删除操作
		// $rs = $model->delete(2);
		dump($rs);

		//联合查询
		// $data = M('User') -> alias('t1') -> field('t2.name,count(*)') -> join('left join shop_dept as t2 on t1.dept_id = t2.id') -> group('t2.name') -> select();
		// $data = M('user')->alias('u')->field('d.name dname, count(*)')->join('left join shop_dept d on u.dept_id = d.id')->group('u.dept_id')->select();
		// dump($data);
	}

	public function test8()
	{
		$data = M('User')->group('dept_id')->field('dept_id, count(*) as num')->select();
		dump($data);
	}

	public function test9()
	{
		load('@/test');
		test10();
	}
}