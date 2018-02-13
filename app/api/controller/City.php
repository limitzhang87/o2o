<?php
namespace app\api\controller;
use think\Controller;
use app\common\model\City as CityModel;
class City extends Controller
{

	protected $model;
    public function _initialize()
    {
        $this->model = new CityModel;
    }
	public function getCityByParentId()
	{
		$id = input('id',0);
		$citys = $this->model->getNormalFistCity($id);
		if($citys){
			return $this->success('success','',$citys);
		}else{
			return $this->error('获取城市错误');
		}
	}
}