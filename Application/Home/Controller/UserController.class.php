<?php
namespace Home\Controller;

use Common\Controller\CommonController;

class UserController extends CommonController
{
	//用户注册
	public function reg()
	{
		if (IS_POST) {
			//获取提交的数据
			$data = I('post.');
			// dump($data);

			//验证码是否正确
			// $captcha = new \Think\Verify();
			// if (!$captcha->check($data['captcha'])) {
			// 	$this->error('验证码有误');
			// }

			// 验证手机验证码
			if ($data['msg_code'] != session('msg_code')) {
				session('msg_code', null);
				$this->error('手机验证码有误');
			}

			$model = D('User');

			$datas = $model->create($data);
			// echo session('captcha');
			// dump($datas);die;
			if (!$datas) {
				$this->error($model->getError());
			}

			$datas['user_addtime'] = time();

			$res = $model->add($datas);
			session('msg_code', null);
			if ($res) {
				// 发送激活邮件
				// 生成邮箱令牌
				$email_data['email_code'] = md5(time() . $res . rand(1000, 9999));
				$this->model->where('id = ' . $res)->save($email_data);
				sendEmail($datas['user_email'], '用户激活邮件', '恭喜您，注册成功请 <a href="http://shop.com/index.php?m=Home&c=user&a=active&uid=' . $res . '&email_code=' . $email_data['email_code'] . '">点击</a> 激活账号');

				$this->success('注册成功', U('login/login'));
			} else {
				$this->error('注册失败');
			}
		} else {
			$this->display();
		}
	}

	//用户激活
	public function active()
	{
		$data = I('get.');
		// dump($data);die;
		$res = $this->model->where('id = ' . $data['uid'] . ' and email_code = "' . $data['email_code'] . '"')->save(array('email_status' => 1));
		

		if ($res) {
			$this->success('激活成功', U('login/login'));
		} else {
			$this->error('非法操作');
		}
	}


	//验证码
	public function verify()
	{
		$config = array(
			'useZh'     =>  false,           // 使用中文验证码
			'useCurve'  =>  false,            // 是否画混淆曲线
	        'useNoise'  =>  true,            // 是否添加杂点
			'imageW'    =>  120,               // 验证码图片宽度
			'imageH'    =>  30,               // 验证码图片宽度
	        'length'    =>  4,               // 验证码位数
	        'fontSize'  =>  15,					//字体大小
	        'fontttf'   =>  '2.ttf',              // 验证码字体，不设置随机获取
		);
		$captcha = new \Think\Verify($config);

		$captcha->entry();
	}

	//查询用户名
	public function getUserName()
	{
		$user_name = I('user_name');
		// echo $user_name;

		$res = $this->model->where("user_name = '$user_name'")->find();

		if ($res) {
			$this->ajaxReturn(array('status'=>1, 'msg'=>'该用户名已存在'));
		} else {
			$this->ajaxReturn(array('status'=>0, 'msg'=>'该用户名可用'));
		}
	}
}