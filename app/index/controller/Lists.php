<?php 
namespace app\index\controller;
use think\Controller;


/**
* 分类下的团购列表
*/
class Lists extends Base
{
	
	public function index($id = '')
	{
		$id = intval($id);
		//获取一级分类
		$firstCate = model('category')->getCommonCategoryByParendID();
		$firstCateIds  = [];
		$where = [];
		foreach ($firstCate as $vo) {
			$firstCateIds[] = $vo->id;//一级分类ID数组
		}
		$category = '';
		//判断ID  0:没有    一级分类   二级分类
		if(in_array($id, $firstCateIds) ){//一级分类
			$pId = $id;
			$category = model('category')->get($id);
			$where['category_id'] = $id;
		}else if($id){//二级分类
			$category = model('category')->get($id);
			$pId = $category->parent_id;
			$where['se_category_id'] = $id;
		}else{//0
			$pId = 0;
		}
		try{
			$_title = $category->name;
		}catch(\Exception $e){
			$_title = '全部分类';
		}
		if($pId){
			//根据父类ID获取所有子分类ID
			$seCate = model('category')->getCommonCategoryByParendID($pId);
		}else{
			$seCate = [];
		}

		//获取排序条件
		$order = input('get.order');
		$deals = model('deal')->getDealByCondition($where,$order);

		return $this->fetch('',[
			'_title'	=> $_title,
			'firstCate'	=> $firstCate,
			'seCate'	=> $seCate,
			'id'		=> $id,
			'pId'		=> $pId,
			'deals'		=> $deals,
			'order'		=> $order
		]);
	}
}


 ?>