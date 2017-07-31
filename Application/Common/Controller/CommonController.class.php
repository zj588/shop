<?php
namespace Common\Controller;

use Think\Controller;

class CommonController extends Controller
{
	public $model;

	public function __construct()
	{
		parent::__construct();

		$this->model = M(CONTROLLER_NAME);
	}
}