<?php 
namespace app\common\validate;
use think\Validate;

/**
*	分类自动验证
*/
class Bis extends Validate
{
	
	protected $rule = [
		['name', 'require|max:25','店名必须填写|店名不能超过25个字符'],
		['email', 'email', '邮箱不正确'],
		['logo', 'require' ,'logo图片必须上传'],
		['licence_logo', 'require' ,'营业执照片必须上传'],
		['city_id', 'require' ,'城市必须填写'],
		['bank_info', 'require' ,'银行帐号必须填写'],
		['bank_name', 'require' ,'银行名称必须填写'],
		['bank_user', 'require' ,'银行用户名必须填写'],
		['faren', 'require' ,'法人必须填写'],
		['faren_tel', 'require' ,'法人联系必须填写'],
		['status', 'number|in:-1,0,1,2' ,'状态必须是数字|状态范围不合法'],
	];


	/**
	 * 定义需要判定字段的情况
	 * @var [type]
	 */
	protected $scene = [
		'add'		=> ['name','email','logo','licence_logo','city_id', 'bank_info', 'bank_name', 'bank_user', 'faren','faren_tel'],
		'status'	=> ['status'],
	];
}


 ?>