<?php 
namespace app\index\controller;
use think\Controller;

/**
*	订单控制器
*/
class Order extends Base
{
	public function _initialize()
	{
		parent::_initialize();
		if(!$this->isLogin()){
			return $this->error('您还有登陆，正在跳转..',url('user/login'));
		}
	}

	/**生成订单页面*/
	public function index($id = '', $count = 1)
	{
		//判断是否是从本页面中跳转过来
		//dump($_SERVER['HTTP_REFERER']);
		//dump(request()->server('HTTP_REFERER'));
		if(!preg_match('/o2o.zjx.com/',request()->server('HTTP_REFERER'))){
			return $this->error('非法访问',url('index/index'));
		}
		if(!intval($id)){
			return $this->error('数据不合法',url('index/index'));
		}
		if(!intval($count)){
			return $this->error('数据不合法',url('index/index'));
		}
		$total_price = input('get.total_price',0,'floatval');
		$data = [
			'out_trade_no'	=> getTradeNo(),
			'user_id'		=> $this->user->id,
			'username'		=> $this->user->username,
			'deal_id'		=> intval($id),
			'deal_count'	=> $count,
			'total_price'	=> $total_price,
			'referer'		=> request()->server('HTTP_REFERER'),
		];
		try{
			$orderId = model('order')->add($data);
		}catch(\Exception $e){
			return $this->error('下单失败！','');
		}

		if(!$orderId){
			return $this->error('下单失败!');
		}
		$this->redirect(url('pay/index',['id'=>$orderId]));
	}
	

	/**
	 * 商品订单确认页面
	 * @param  string  $id    商品ID
	 * @param  integer $count 数量
	 * @return [type]         [description]
	 */
	public function confirm($id = '',$count = 1)
	{
		if(!intval($id)){
			return $this->error('数据不合法!');
		}
		$deal = model('deal')->get($id);

		return $this->fetch('',[
			'_controller'	=> 'pay',
			'_title'		=> '订单确认',
			'deal'			=> $deal,
			'count'			=> $count,
		]);
	}
}

 ?>