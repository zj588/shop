<?php
namespace Home\Controller;

use Think\Controller;

class LoginController extends Controller
{
	public function login()
	{
		if (IS_POST) {
			$data = I('post.');

			$data['user_pwd'] = md5($data['user_pwd']);

			$res = M('User')->where($data)->find();

			if ($res) {
				session('uid', $res['id']);
				session('user_name', $res['user_name']);

				//保存cookie
				$remember = I('remember');
				if (!empty($remember)) {
					$infoStr = serialize(array('uid'=>$res['id'], 'username'=>$res['user_name']));
					// echo $infoArr;die;
					cookie('userData', $infoStr, 3600);
					// echo cookie('userData');die;
				}
				

				$this->success('登陆成功', U('index/index'));
			} else {
				$this->error('登录失败');
			}
		} else {
			$this->display();
		}
	}


	public function logout()
	{
		session(null);

		cookie('userData', null);

		$this->success('退出成功',U('index/index'));
	}
}