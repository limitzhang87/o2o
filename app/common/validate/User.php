<?php 
namespace app\common\validate;
use think\Validate;

/**
* 用户自动验证
*/
class User extends Validate
{
	
	protected $rule = [
		['username', 'require','用户名必须填写'],
		['password', 'require','密码必须填写'],
	];


	/**
	 * 定义需要判定字段的情况
	 * @var [type]
	 */
	protected $scene = [
		'add'		=> ['username'],
		'login'		=> ['name', 'password'],
	];
}


 ?>