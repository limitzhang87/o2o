<?php 
namespace app\common\validate;
use think\Validate;

/**
*	分类自动验证
*/
class BisAccount extends Validate
{
	
	protected $rule = [
		['username', 'require|max:25','用户名必须填写|用户名不能超过25个字符'],
		['password', 'require', '密码必须填写']
	];


	/**
	 * 定义需要判定字段的情况
	 * @var [type]
	 */
	protected $scene = [
		'add'		=> ['username','password'],
	];
}


 ?>