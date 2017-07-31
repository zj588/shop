<?php
namespace Admin\Model;

use Think\Model;

class BrandModel extends Model
{
	//自动验证
	protected $_validate = array(
		array('brand_name', 'require', '不能为空'),
	);

	//表单映射
	protected $_map = array(
		'name' => 'brand_name',
		'sort' => 'brand_sort',
	);
}