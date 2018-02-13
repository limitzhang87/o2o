<?php 
namespace app\index\controller;
use think\Controller;

/**
* 支付类
*/
class Pay extends Base
{
	
	public function _initialize()
	{
		parent::_initialize();
		if(!$this->isLogin()){
			return $this->error('您还有登陆，正在跳转..',url('user/login'));
		}
	}

	public function index($order_id = '')
	{
		echo  '支付成功';
	}
}


 ?>