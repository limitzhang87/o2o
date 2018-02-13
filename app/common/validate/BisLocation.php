<?php 
namespace app\common\validate;
use think\Validate;

/**
*	分类自动验证
*/
class BisLocation extends Validate
{
	
	protected $rule = [
		['name', 'require|max:25','店名必须填写|店名不能超过25个字符'],
		['tel', 'number|max:11', '联系方式必须是数字|联系方式不能超过11位'],
		['logo', 'require', 'logo图片必须上传'],
		['contact','require', '联系人必须填写'],
		['city_id','require', '必须选择所属城市'],
		['category_id','require', '分类必须选择'],
		['address', 'require','地址必须填写'],
		['open_time', 'require','营业时间必须填写'],
		['address', 'require','地址必须填写']
	];


	/**
	 * 定义需要判定字段的情况
	 * @var [type]
	 */
	protected $scene = [
		'add'		=> ['name','tel','logo', 'contact','city_id', 'category_id', 'address', 'open_time'],
	];
}


 ?>