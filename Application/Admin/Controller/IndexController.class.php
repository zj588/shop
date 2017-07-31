<?php
namespace Admin\Controller;

use Think\Controller;

class IndexController extends Controller 
{
	public function __construct()
	{
		parent::__construct();
		if (!session('?username')) {
			$this->error('请先登录...', U('login/login'));
		}
	}

    public function index()
    {
        $this->display();
    }

    public function left()
    {
    	$role_id = session('role_id');

    	//查找当前角色的全部权限(菜单)
        //判断是否超级管理员admin
        if (session('username') == 'admin') {
            $menuList = M('Menu')->where('is_show = 1')->select();
        } else {
            $menuList = M('Access')->alias('a')->field('a.*, m.*')->join('left join shop_menu m on a.menu_id = m.id')->where(array('a.role_id'=>$role_id, 'm.is_show'=>1))->select();
        }
    	
    	$menuTree = list_to_tree($menuList);
    	// dump($menuTree);die;

    	$this->assign('menuTree', $menuTree);
        $this->display();
    }
}