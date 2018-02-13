<?php

namespace app\common\model;

use think\Model;

class Featured extends BaseModel
{
	protected $insert = ['status'=>0];

	/**
	 * 根据类型获取推荐位
	 * @param  integer $type 类型
	 * @return array        
	 */
	public function getFeaturedByStatus($type = 0)
	{
		$where	= [
			'status'	=> ['neq',-1],
			'type'		=> $type,
		];

		$order = [
			'id'	=> 'desc',
		];

		$res = $this->where($where)
					->order($order)
					->paginate();
		return $res;
	}

	/**
	 * 前台根据类型获取广告
	 * @param  integer $type [description]
	 * @return [type]        [description]
	 */
	public function getCommondByType($type = 0)
	{
		$where	= [
			'status'	=> ['neq',-1],
			'type'		=> $type,
		];

		$order = [
			'listorder'	=> 'desc',
			'id'		=> 'desc',
		];

		$res = $this->where($where)
					->order($order)
					->select();
		return $res;
	}

	/**
	 * 前台根据类型获取广告（至获取一条）
	 * @param  integer $type [description]
	 * @return [type]        [description]
	 */
	public function getCommondByTypeOne($type = 1)
	{
		$where	= [
			'status'	=> ['neq',-1],
			'type'		=> $type,
		];

		$order = [
			'listorder'	=> 'desc',
			'id'		=> 'desc',
		];

		$res = $this->where($where)
					->order($order)
					->find();
		return $res;
	}
}
