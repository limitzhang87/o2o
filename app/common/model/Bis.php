<?php
namespace app\common\model;
use think\Model;

class Bis extends BaseModel
{
	protected $autoWriteTimestamp = true;
	//填写之后在新增和修改的时候自动填写create_time和update_time数据，同时也可以修改create_time和update_time字段
	protected $insert = ['status'=>0];

	public function getListByStatus($status = 0)
	{
		$where = [
			'status'	=> $status,
		];

		$order = [
			'id'		=> 'desc',
		];

		$result = $this->where($where)
				->order($order)
				->paginate();
		return $result;
	}
}