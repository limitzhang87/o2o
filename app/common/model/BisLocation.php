<?php
namespace app\common\model;

use think\Model;

class BisLocation extends BaseModel
{
	protected $insert = ['status'=>0];

	protected function setOpenTimeAttr($value){
		return strtotime($value);
	}

	protected function setCloseTimedAttr($value){
		return strtotime($value);
	}


	public function getNormalLocationByBisId($id = '')
	{
		$where = [
			'bis_id'	=> $id,
			'status'	=> 1
		];
		$res = $this->where($where)
				->order('id desc')
				->select();
		return $res;
	}
}