<?php
namespace Home\Model;

use Think\Model;

class UserModel extends Model
{
	protected $_validate = array(
		array('user_name', '/^\w{6,12}$/', ' 必须为6-12位字母数字下划线', 0,'regex'),
		array('user_pwd', 'require', '密码不能为空'),
		array('user_pwd2', 'user_pwd', '两次密码不一致', 0, 'confirm')
	);

	protected $_auto = array(
		array('roleid', '1'),
		array('addtime', 'time', 3, 'function')
	);

}

// protected $_validate = array(
	// 	array('user_name', 'require', '用户名不能为空'),
	// 	array('user_name', '/^\w{6,12}$/', '6-12位', 0,'regex' ),
	// 	array('user_pwd', 'require', '密码不能为空'),
	// 	array('user_pwd2', 'user_pwd', '两次密码不一致', 0, 'confirm'),
	// 	array('user_email', 'email', '邮件格式不正确'),
	// );

	// public function _before_insert(&$data)
	// {
	// 	$data['user_pwd'] = md5($data['user_pwd']);
	// }