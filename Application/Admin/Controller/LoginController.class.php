<?php
namespace Admin\Controller;

use Think\Controller;

class LoginController extends Controller
{
	public function login()
	{
		if (IS_POST) {
			$data = I('post.');

			//判断验证码
			$verify = new \Think\Verify();
			if (!$verify->check($data['captcha'])) {
				$this->error('验证码有误');
			}

			//判断用户名或密码
			$adminModel = M('Admin');
			$userInfo = $adminModel->where(array('username'=>$data['admin_user'], 'password'=>md5($data['admin_psd'])))->find();

			if ($userInfo) {
				session('uid', $userInfo['id']);
				session('username', $userInfo['username']);
				session('role_id', $userInfo['role_id']);
				$this->success('登陆成功', U('index/index'));
			} else {
				$this->error('用户名或密码错误');
			}
		} else {
			$this->display();
		}
	}

	public function logout()
	{
		session(null);
		$this->success('退出成功', U('login'));
	}

	public function verify()
	{
		$config = array(
			'useZh'     =>  false,           // 使用中文验证码
			'useCurve'  =>  false,            // 是否画混淆曲线
	        'useNoise'  =>  false,            // 是否添加杂点
			'imageW'    =>  120,               // 验证码图片宽度
			'imageH'    =>  30,               // 验证码图片宽度
	        'length'    =>  4,               // 验证码位数
	        'fontSize'  =>  15,					//字体大小
	        'fontttf'   =>  '2.ttf',              // 验证码字体，不设置随机获取
		);

		$captcha = new \Think\Verify($config);
		$captcha->entry();
	}
}