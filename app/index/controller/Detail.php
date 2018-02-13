<?php 
namespace app\index\controller;
use think\Controller;


/**
* 商品详情控制器
*/
class Detail extends Base
{
	
	public function index($id = '')
	{
		if(!intval($id)){
			return $this->error('找不到相关数据');
		}
		$deal = model('deal')->get($id);

		//获取分类
		$category = model('category')->get($deal->category_id);

		//获取分店
		$locations = model('bis_location')->where(['id'=>['in',$deal->location_ids]])->select();
		//获取剩余数量
		$deal->surplus = $deal->total_count - $deal->buy_count;	

		//根据开始时间和结束时间判断是否已经开始或者结束
		$flag = 0;
		if($deal->start_time  < time()){
			$flag = 1;//已经结束
		}else{
			$flag = 0;//还没开始
		}
		return $this->fetch('',[
			'_title'	=> $deal->name,
			'deal'		=> $deal,
			'category'	=> $category,
			'locations'	=> $locations,
			'flag'		=> $flag,
		]);
	}
}


 ?>