<?php
namespace app\api\controller;
use think\Controller;
use app\common\model\Category as CategoryModel;
class Category extends Controller
{

	protected $model;
    public function _initialize()
    {
        $this->model = new CategoryModel;
    }
	public function getCategoryByParentId()
	{
		$id = input('id',0);
		$citys = $this->model->getNormalFirstCategory($id);
		if($citys){
			return $this->success('success','',$citys);
		}else{
			return $this->error('获取分类错误');
		}
	}
}