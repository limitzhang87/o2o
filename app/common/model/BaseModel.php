<?php
namespace app\common\model;

use think\Model;

class BaseModel extends Model
{
	protected $autoWriteTimestamp = true;
	//填写之后在新增和修改的时候自动填写create_time和update_time数据，同时也可以修改create_time和update_time字段
	public function add($data)
	{
		if($this->allowField(true)->save($data)){
			return $this->id;
		}else{
			return false;
		}
	}
}