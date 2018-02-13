<?php
namespace app\common\model;
use think\Model;

/**
 * 用户模型
 */
class User extends BaseModel
{

	protected $insert = ['status'=>1];

	protected function setPasswordAttr($value, $data)
	{
		return md5($value . $data['code']);
	}


	public function updateById($data = [], $id)
	{
		return $this->save($data, $id);
	}
}