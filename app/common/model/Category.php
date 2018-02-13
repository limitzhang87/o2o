<?php
namespace app\common\model;

use think\Model;

class Category extends BaseModel
{

	public function add($data)
	{
		$data['status'] = 1;
		//$data['create_time'] = time();
		return $this->save($data);
	}

	/**
	 * 根据父类获取分类
	 * @param  integer $id [description]
	 * @return [type]      [description]
	 */
	public function getNormalFirstCategory($id = 0)
	{
		$where = [
			'status'	=> 1,
			'parent_id'	=> $id,
		];
		$order = [
			'id desc',
		];
		return $this->where($where)->order($order)->select();
	}

	/**
	 * 根据父类获取分类,根据listorder排序
	 * @param  integer $id [description]
	 * @return [type]      [description]
	 */
	public function getCommonFirstCategory($id = 0,$limit = 5)
	{
		$where = [
			'status'	=> 1,
			'parent_id'	=> $id,
		];
		$order = [
			'listorder' => 'desc',
			'id'       =>'desc',
		];
		$limit = 5;
		return $this->where($where)->order($order)->limit($limit)->select();
	}


	/**
	 *	根据父类ID获取分类
	 * @param  Interge/Array $ids [description]
	 * @return [type]      [description]
	 */
	public function getCommonCategoryByParendID($ids = 0)
	{
		$where['status'] = 1;
		if(is_array($ids)){
			$where['parent_id'] = ['in',$ids];
		}else{
			$where['parent_id'] = $ids;
		}

		$order = [
			'listorder' => 'desc',
			'id'       =>'desc',
		];
		return $this->where($where)->order($order)->select();
	}

	/**
	 * 分页获取分类，默认获取一级分类
	 * @param  integer $parent_id [description]
	 * @return [type]             [description]
	 */
	public function getFirstCategory($parent_id = 0)
	{
		$where = [
			'status'	=> ['gt', -1],
			'parent_id'	=> $parent_id,
		];

		$order = [
			'listorder desc',
			'id desc',
		];
		return $this->where($where)
					->order($order)
					->paginate();
	}



	/**
	 * 对status数据进行修改
	 * @param  [type] $value [description]
	 * @return [type]        [description]
	 */
	// public function getStatusAttr($value)
	// {
	// 	switch ($value) {
	// 		case '1':
	// 			return '<span class="label label-success raidus">正常</span>';
	// 			break;
	// 		case '0':
	// 			return '<span class="label label-danger raidus">待审</span>';
	// 			break;
	// 		case '-1':
	// 			return '<span class="label label-danger raidus">删除</span>';
	// 			break;
	// 		default:
	// 			return $value;
	// 			break;
	// 	}
	// }
}