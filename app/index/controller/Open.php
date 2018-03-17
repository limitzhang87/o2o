<?php 
namespace app\index\controller;
use think\Controller;
use \youzan\YZTokenClient;
use \youzan\YZGetTokenClient;
/**
* youzan
*/
class Open extends Controller
{
	public function index()
	{
		$accessToken = $this->getAccessToken();
		$token = @$accessToken['access_token'];//请填入商家授权后获取的access_token
		if(!$token){
			return $this->error('获取access_token错误');
		}
		$client = new YZTokenClient($token);

		$method = 'youzan.pay.qrcode.create'; //要调用的api名称
		$api_version = '3.0.0'; //要调用的api版本号

		$my_params = [
		    'qr_name' => '測試',
		    'qr_price' => '1',
		    'qr_type' => 'QR_TYPE_NOLIMIT',
		];

		$my_files = [
		];

		$res = $client->post($method, $api_version, $my_params, $my_files);
		echo '<img src="'.$res['response']['qr_code'].'">';
		//echo '<img src="https://trade.koudaitong.com/wxpay/confirmQr?qr_id=6473885&kdt_id=40442154">';
	} 

	public function getAccessToken()
	{
		$client_id = '1f6b4529f378343de2';
		$client_secret = 'b726f57a7051a9165d7370d2e36177f0';
		$client = new YZGetTokenClient($client_id, $client_secret);

		// $my_params = [
		//     'grant_type'	=> 'silent',
		//     'kdt_id'		=> '40442154',
		// ];
		return $client->get_token('self', ['kdt_id'=>'40442154']);
	}
}

 ?>