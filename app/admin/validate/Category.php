<?php 
namespace app\admin\validate;
use think\Validate;

/**
*	分类自动验证
*/
class Category extends Validate
{
	
	protected $rule = [
		['name', 'require|max:10','分类名称必须填写|分类名称不能超过10个字符'],
		['id', 'number'],
		['parent_id', 'number'],
		['status', 'number|in:-1,0,1' ,'状态必须是数字|状态范围不合法'],
		['listorder', 'number']
	];


	/**
	 * 定义需要判定字段的情况
	 * @var [type]
	 */
	protected $scene = [
		'add'		=> ['name','parent_id'],
		'listorder'	=> ['id','listorder'],
		'status'	=> ['id', 'status'],
	];
}


 ?>