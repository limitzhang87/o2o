<?php 
namespace app\common\validate;
use think\Validate;

/**
* 团购商品自动验证
*/
class Deal extends Validate
{
	
	protected $rule = [
		['name', 'require|max:25','团购名必须填写|店名不能超过25个字符'],
	];


	/**
	 * 定义需要判定字段的情况
	 * @var [type]
	 */
	protected $scene = [
		'add'		=> ['name']
	];
}


 ?>