<?php 
namespace app\index\controller;
use think\Controller;
use youzan\YZTokenClient;
use youzan\YZGetTokenClient;
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

	/**
	 * 支付界面
	 * @param  string $id 订单ID
	 * @return [type]           [description]
	 */
	public function index($id = '')
	{
		if(!intval($id)){
			return $this->error('找不到箱单订单数据',url('Index/index/index'));
		}
		// if(empty(input('server.HTTP_REFERER'))){
		// 	return $this->error('非法访问');
		// }

		$orderData = model('order')->find($id);

		if($orderData->pay_status !== 0){
			$this->redirect(url('pay/payStatus',['id'=>$id]));
		}

		$dealData = model('deal')->find($orderData->deal_id);
		$accessToken = $this->getAccessToken();
		$token = @$accessToken['access_token'];//请填入商家授权后获取的access_token
		if(!$token){
			return $this->error('获取access_token错误');
		}
		$client = new YZTokenClient($token);

		$method = 'youzan.pay.qrcode.create'; //要调用的api名称
		$api_version = '3.0.0'; //要调用的api版本号

		$qr_price = intval($orderData->total_price * 100) ;
		$qr_price = $qr_price ? $qr_price : 0;
		$my_params = [
		    'qr_name' => 'o2o团购网-' . $dealData->name,
		    'qr_price' => $qr_price,
		    'qr_type' => 'QR_TYPE_NOLIMIT',
		    'label_ids'	=> '['.$id.']',
		];

		$my_files = [
		];

		$qrData = $client->post($method, $api_version, $my_params, $my_files);
		// dump($orderData);
		//dump($dealData);
		return $this->fetch('', [
			'orderData'	=> $orderData,
			'dealData'	=> $dealData,
			'qrData'	=> $qrData['response']
		]);
	}


	public function getAccessToken()
	{
		$client_id = '1f6b4529f378343de2';
		$client_secret = 'b726f57a7051a9165d7370d2e36177f0';
		$client = new YZGetTokenClient($client_id, $client_secret);

		return $client->get_token('self', ['kdt_id'=>'40442154']);
	}


	/**
	 * 获取支付状态
	 * @return [type] [description]
	 */
	public function getTradeInfo()
	{
		$qr_id = input('qr_id');
		$id    = input('id');
		if(!$qr_id || !$id){
			return $this->error(2);
		}
		$accessToken = $this->getAccessToken();
		$token = @$accessToken['access_token'];//请填入商家授权后获取的access_token
		if(!$token){
			return $this->error('获取access_token错误');
		}
		$client = new YZTokenClient($token);
		$method = 'youzan.trades.qr.get'; //要调用的api名称
		$api_version = '3.0.0'; //要调用的api版本号
		$my_params = [
		    'qr_id' => $qr_id,
		];
		$my_files = [
		];
		$qrData = $client->post($method, $api_version, $my_params, $my_files);

		//return $this->error($qrData);
		if($qrData['response']['total_results'] == 1 && $qrData['response']['qr_trades'][0]['status'] ==  'TRADE_RECEIVED'){
			$data['pay_status'] = 1;
			$data['transaction_id'] = $qr_id;
			$data['pay_amount'] = $qrData['response']['qr_trades'][0]['real_price'];
			$data['pay_time'] = strtotime($qrData['response']['qr_trades'][0]['created_date']);
			$data['update_time'] = $data['pay_time'];
			$res = model('order')->save($data,['id'=>$id]);
			if($res !== false){
				return $this->success(1);
			}else{
				return $this->error(0);
			}
		}
		return $this->error(0);
	}


	public function payStatus($id = '')
	{
		if($id == ''){
			return $this->error('找不到订单信息',url('index/index'));
		}
		$order = model('order')->find($id);
		if(!$order || $order->status != 1){
			return $this->error('找不到订单信息',url('index/index'));
		}
		if($order->pay_status ==1){
			$msg = '支付成功';
		}else{
			$msg = '支付失败';
		}
		$dealData	= model('deal')->find($order->deal_id);
		return $this->fetch('',[
			'msg'	=> $msg,
			'orderData'	=> $order,
			'dealData'	=> $dealData
		]);
	}
}


 ?>