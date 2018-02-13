<?php
namespace app\bis\controller;
use think\Controller;
use think\Request;
use app\common\model\City;
use app\common\model\Category;
class Register extends Controller
{
	public function index()
	{
		$city = new City;
		$citys =$city->getNormalFistCity();
		$category = new Category;
		$categorys = $category->getFirstCategory();
		return $this->fetch('',[
			'citys'      => $citys,
			'categorys' => $categorys
		]);
	}

	public function add(Request $reuqest)
	{
		if(!$reuqest->isPost()){
			return $this->error('请求错误');
		}

		$data = input('post.');//获取表单数据
		//验证商户信息
		$validate = validate('bis');
		if(!$validate->scene('add')->check($data)){
			return $this->error($validate->getError());
		}

		//验证商户门店信息
		$validate = validate('bis_location');
		if(!$validate->scene('add')->check($data)){
			return $this->error($validate->getError());
		}

		//验证商户账号信息
		$validate = validate('bis_account');
		if(!$validate->scene('add')->check($data)){
			return $this->error($validate->getError());
		}
		//判断用户是否已经存在
		$BisAccount = model('bis_account')->get(['username'=>$data['username']]);
		if($BisAccount){
			$this->error('该用户名已存在，请重新分配!');
		}
		unset($BisAccount);
		//获取经纬度
		$map = \Map::getLngLat($data['address']);
		if($map['status'] != 0 || $map['result']['precise'] != 1){
			$this->error('地址无法匹配或者匹配不精确');
		}
		$map = $map['result']['location'];

		$dataBis = [];
		$dataBis['name']         = $data['name'];
		$dataBis['city_id']      = $data['city_id'];
		$dataBis['city_path']      = empty($data['se_city_id']) ? $data['city_id']: $data['city_id'] . ',' . $data['se_city_id'];
		$dataBis['logo']         = $data['logo'];
		$dataBis['licence_logo'] = $data['licence_logo'];
		$dataBis['description']  = empty($data['description']) ? '' : $data['description'];
		$dataBis['bank_info']    = $data['bank_info'];
		$dataBis['bank_name']    = $data['bank_name'];
		
		$dataBis['bank_user']    = $data['bank_user'];
		$dataBis['faren']        = $data['faren'];
		$dataBis['faren_tel']    = $data['faren_tel'];
		$dataBis['email']        = $data['email'];
		$BId = model('Bis')->add($dataBis);
		if(!$BId){
			return $this->error('添加商户信息错误');
		}

		//获取分类路径
		$data['cat'] = '';
		if(!empty($data['se_category_id'])){
			$data['cat'] = implode('|', $data['se_category_id']);
		}
		$dataBisL = [
			'bis_id'        => $BId,
			'name'          => $data['name'],
			'tel'           => $data['tel'],
			'logo'          => $data['logo'],
			'address'       => $data['address'],
			'contact'       => $data['contact'],
			'category_id'   => $data['category_id'],
			'category_path' =>  $data['category_id'] . ',' . $data['cat'],
			'city_id'       => $data['city_id'],
			'city_path'     => empty($data['se_city_id']) ? $data['city_id']: $data['city_id'] . ',' . $data['se_city_id'],
			'api_address'           => $data['address'],
			'open_time'           => $data['open_time'],
			'content'  => empty($data['content']) ? '' : $data['content'],
			'is_main'           => 1,//设置为总店
			'xpoint'		=> $map['lng'] ? $map['lng'] : '',
			'ypoint'		=> $map['lat'] ? $map['lat'] : '',
		];
		

		$Lid = model('bis_location')->add($dataBisL);
		if(!$Lid){
			return $this->error('添加商户总店信息错误');
		}
		$code = mt_rand(100, 10000);
		$dataBisA = [
			'bis_id'   => $BId,
			'username' => $data['username'],
			'code'     => $code,
			'password' => $data['password'] . $code,
			'is_main'  => 1,
		];


		$Aid = model('bis_account')->add($dataBisA);
		if(!$Aid){
			return $this->error('添加商户哟过户信息错误');
		}

		//发送右键右键通知申请人
		$url = request()->domain() . url('bis/register/waiting',['id'=>$BId]);
		$title = 'o2o入住申请通知';
		$contnt = '您提交的入住申请需要等待平台审核，您可以通过点击链接<a href="'.$url.'" targrt="_blank">查看链接</a>查看审核状体';
		
		\Email::send($data['email'],$title, $contnt);
		return $this->success('申请成功',url('register/waiting',['id'=>$BId]));
	}


	public function waiting($id)
	{
		if (empty($id)) {
			return $this->error('找不到对应数据！');
		}
		$detail = model('bis')->get($id);
		return $this->fetch('',[
			'detail'	=> $detail
		]);
	}
}