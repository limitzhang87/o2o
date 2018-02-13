<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function get_status($value)
{
	switch ($value) {
		case '1':
			return '<span class="label label-success raidus">正常</span>';
			break;
		case '0':
			return '<span class="label label-danger raidus">待审</span>';
			break;
		case '-1':
			return '<span class="label label-danger raidus">删除</span>';
			break;
		default:
			return $value;
			break;
	}
}

/**
 * 执行CURL
 * @param  string  $url  地址
 * @param  integer $type 类型 1:POST, 0:GET
 * @param  array   $data POST所需要的参数
 * @return JSON        [description]
 */
function get_curl($url, $type = 0, $data = [])
{
	//实例化cURL
	$ch = curl_init();
	//设置cURL参数
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_HEADER,0);

	if($type == 1){
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	}
	//执行并获取内容
	$res = curl_exec($ch);
	
	//关闭curl句柄
	curl_close($ch);
	return $res;
}


/**
 * 返回申请的状态
 * @param  string $status 
 * @return string
 */
function get_register_status($status = '')
{
	switch ($status) {
		case '0':
			$str = '待审核，审核后平台会通过发送右键通知您，请关注邮件';
			break;
		case '1':
			$str = '入住申请成功';
			break;
		case '2':
			$str = '非常抱歉，您提交的的材料不符合条件，请重新提交';
			break;
		default:
			$str = '该申请已被删除';
			break;
	}
	return $str;
}

/**
 * 是否
 * @param  string  $value [description]
 * @return boolean        [description]
 */
function is_main($value='')
{
	if($value == 1){
		return '是';
	}else{
		return '否';
	}
}


/**
 * 返回分页的前端代码
 * @param  Model $obj 模型
 * @return string      
 */			
function paginate_str($obj)
{
	$param = request()->param();
	$str = '<div class="cl pd-5 bg-1 bk-gray mt-20 o2o_page">' .
			$obj->appends($param)->render().
			'</div>';
	return $str;
}

/**
 * 通过city_path获取二级城市名称		
 * @param  String $cityPath [description]
 * @return [type]           [description]
 */
function get_se_city_name($cityPath = '')
{
	if($cityPath == ''){
		return '';
	}

	if(preg_match('/,/',$cityPath)){
		$arr = explode(',',$cityPath);
		$id = $arr[1];
	}else{
		$id = $cityPath;
	}
	$city = model('city')->get($id);
	return $city->name;
}
/**
 * 通过city_path获取分类名称		
 * @param  String $cityPath [description]
 * @return [type]           [description]
 */
function get_se_category_name($categoryPath = '')
{
	if($categoryPath == ''){
		return '';
	}

	if(preg_match('/,/',$categoryPath)){
		$arr = explode(',',$categoryPath);
		$path = $arr[1];
		$arrSe = explode('|', $path);
		$list = model('category')->where(['id'=>['in',$arrSe]])->field('name')->select();
		return $list;
	}else{
		return [];
	}
}

/**
 * 返回商品可用店的总数
 * @param  string $ids 分店ID字符串
 * @return interge      
 */
function count_location($ids)
{
	if(!$ids){
		return 1;
	}

	if(preg_match('/,/', $ids)){
		$arr = explode(',', $ids);
		return count($arr);
	}else{
		return 1;
	}
}

//生成订单编号
function getTradeNo()
{
	list($tr1,$tr2) = explode(' ', microtime());

	$tr3 = explode('.',$tr1*10000);

	return $tr2 . $tr3[0] . rand(10000,99999);exit;
}