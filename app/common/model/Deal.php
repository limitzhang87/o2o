<?php

namespace app\common\model;

use think\Model;

class Deal extends BaseModel
{

	protected $insert = ['status'=>0];

	public function getNormalDeal($where = [],$status = 1)
	{
		$where['status'] = $status;

		$order = [
			'id'		=> 'desc',
		];

		$result = $this->where($where)
				->order($order)
				->paginate();
		//echo $this->getLastSql();
		return $result;
	}


	public function getRecommondDeal($where=[])
	{

		$order = [
			'id'		=> 'desc',
		];

		$result = $this->where($where)
				->order($order)
				->paginate();
		//echo $this->getLastSql();
		return $result;
	}


	/**
	 * 根据城市ID和分类ID获取团购商品
	 * @param  Interge  $id     分类DI
	 * @param  Interge  $cityID 城市ID
	 * @param  integer $limit  条数
	 * @return Array          商品数据对象数组
	 */
	public function getDealByCategoryCity($id,$cityID,$limit = 10)
	{
		$where = [
			'category_id'	=> $id,
			'city_id'		=> $cityID,
			'end_time'		=> ['gt',time()],
			'status'		=> 1
		];

		$order  = [
			'listorder'		=> 'desc',
			'id'			=> 'desc',
		];

		$res = $this->where($where)
					->order($order)
					->select();
		return $res;
	}


	public function getDealByCondition($where = [],$orders = '')
	{
		$where['status'] = 1;
		if($orders != ''){
			$order[$orders]	= 'desc';
		}
		$order['id']	= 'desc';
		$wheres[] = '1 = 1 ';
		if(!empty($where['category_id'])){
			$wheres[]= ' category_id = ' . $where['category_id'];
		}

		if(!empty($where['se_category_id'])){
			$wheres[] = 'find_in_set("'.$where['se_category_id'].'",se_category_id)';
		}
		$wheres[] = 'status = 1';
		$res = $this->where(implode(' AND ',$wheres))
					->order($order)
					->paginate();
		//echo $this->getLastSql();
		return $res;
	}
}
