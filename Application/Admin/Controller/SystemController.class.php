<?php
namespace Admin\Controller;

use Think\Controller;

class SystemController extends Controller
{
	public function __construct()
	{
		parent::__construct();
		// if (!session('?username')) {
		// 	$this->error('请先登录...', U('login/login'));
		// }
		checkLogin();
	}

	/**
	 * 菜单列表
	 */
	public function menulist()
	{
		$data = M('Menu')->where('is_show = 1')->select();
		$data = getTree($data);

		$this->assign('data', $data);
		$this->display();
	}

	/**
	 * 菜单增加
	 */
	public function menuadd()
	{
		if (IS_POST) {
			$data = I('post.');
			$data['menu_url'] = $data['menu_url'];
			$res = M('Menu')->add($data);

			if ($res) {
				$this->success('增加成功', U('menulist'));
			} else {
				$this->error('增加失败');
			}
		} else {
			$data = M('Menu')->where('is_show = 1')->select();
			$data = getTree($data);

			$this->assign('data', $data);
			$this->display();
		}
	}

	/**
	 * 菜单删除
	 */
	public function menudel()
	{
		$id = I('id');
		// dump($id);die;

		$model = M('Menu');
		//所有的菜单信息
		$menuList = $model->select();
		foreach ($menuList as $val) {
			if ($val['pid'] == $id) {
				$this->error('不能删除父级菜单');die;
			}
		}

		$data['id'] = $id;
		$data['is_show'] = 0;
		$res = $model->save($data);

		if ($res) {
			$this->success('删除成功', U('menulist'));die;
		} else {
			$this->error('删除失败');die;
		}
	}

	/**
	 * 菜单修改
	 */
	public function menuedit()
	{
		if (IS_POST) {
			$data = I('post.');
			// dump($data);die;
			$model = M('menu');

			//修改分类  所属父级ID   不可以是自己的ID
			if ($data['pid'] == $data['id']) {
				$this->error('不能将分类的PID改为自己的ID');die;
			}
			//修改分类  所属父级ID   不可以是自己的子级
			//查询所有的菜单信息
			$menuList = $model->select();
			$menuTree = getTree($menuList, $data['id']);
			if (!empty($menuTree)) {
				foreach ($menuTree as $son) {
					if ($data['pid'] == $son['id']) {
						$this->error('不能将分类的PID改为自己子级的ID');die;
					}
				} 
			}

			//修改到数据库
			$res = $model->save($data);

			if ($res) {
				$this->success('修改成功', U('menulist'));die;
			} else {
				$this->error('修改失败');die;
			}
		} else {
			$id = I('id');
			$model = M('Menu');

			//要修改的商品信息
			$menuData = $model->find($id);

			$data = M('Menu')->select();
			$data = getTree($data);

			$this->assign('menuData', $menuData);
			$this->assign('data', $data);
			$this->display();
		}
	}




	/**
	 * 角色列表
	 */
	public function rolelist()
	{
		$data = M('Role')->select();

		$this->assign('data', $data);
		$this->display();
	}

	/**
	 * 角色增加
	 */
	public function roleadd()
	{
		if (IS_POST) {
			$data = I('post.');
			$res = M('Role')->add($data);

			if ($res) {
				$this->success('增加成功', U('rolelist'));
			} else {
				$this->error('增加失败');
			}
		} else {
			$this->display();
		}
	}

	/**
	 * 角色删除
	 */
	public function roledel()
	{
		$id = I('id');

		$res = M('Role')->delete($id);

		if ($res) {
			$this->success('删除成功', U('rolelist'));
		} else {
			$this->error('删除失败');
		}
	}

	/**
	 * 角色修改
	 */
	public function roleedit()
	{
		if (IS_POST) {
			$data = I('post.');

			$res = M('Role')->save($data);

			if ($res) {
				$this->success('修改成功', U('rolelist'));
			} else {
				$this->error('修改失败');
			}
		} else {
			$id = I('id');

			$model = M('Role');
			$roleInfo = $model->find($id);

			$this->assign('roleInfo', $roleInfo);
			$this->display();
		}
		
	}


	/**
	 * 权限管理
	 */
	public function accesslist()
	{
		$role_id = I('role_id');
		//对应的角色信息
		$roleInfo = M('Role')->find($role_id);

		//菜单分类信息
		$menuList = M('Menu')->where('is_show = 1')->select();
		$menuTree = list_to_tree($menuList);
		// dump($menuTree);die;

		//查询对应角色拥有的权限
		$accessList = M('Access')->where('role_id=' . $role_id)->select();
		// $accessArr = array_column($accessList, 'menu_id');//PHP版本大于等于5.5才能使用
		$accessArr = array();
		foreach ($accessList as $val) {
			$accessArr[] = $val['menu_id'];
		}


		$this->assign('roleInfo', $roleInfo);
		$this->assign('menuTree', $menuTree);
		$this->assign('accessArr', $accessArr);
		$this->display();
	}

	/**
	 * 权限增加
	 */
	public function accessedit()
	{
		$role_id = I('role_id');
		$menu_id = I('menu_id');
		// dump($role_id);
		// dump($menu_id);die;
		//删除该ID下的全部权限
		M('Access')->where('role_id=' . $role_id)->delete();

		$data['role_id'] = $role_id;
		foreach ($menu_id as $val) {
			$data['menu_id'] = $val;
			$res = M('Access')->add($data);
		}

		if ($res) {
			$this->success('修改成功', U('accesslist', 'role_id=' . $role_id));
		} else {
			$this->error('修改失败');
		}
	}
}