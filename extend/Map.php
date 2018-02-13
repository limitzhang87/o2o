<?php 
/**
* 百度地图类
*/
class Map
{
	
	/**
	 * 根据地址获取经纬度
	 * @param  string $address 地址信息
	 * @return Array         
	 */
	public static function getLngLat($address = '')
	{
		if(!$address){
			return '';
		}
		$data = [
			'address'	=> $address,
			'ak'		=> config('map.ak'),
			'output'	=> 'json',
		];

		$url = config('map.baidu_map_url') . config('map.geocoder') .'?' . http_build_query($data);
		$res = json_decode(get_curl($url),true) ;
		return $res;
	}

	/**
	 * 根据地址获取地图图片信息
	 * @param  string $center [description]
	 * @return [type]         [description]
	 */
	public static function getStaticimage($center = '',$data = [])
	{
		if(!$center){
			return '';
		}
		if(!is_array($data)){
			return '';
		}
		$data1 = [
			'ak'		=> config('map.ak'),
			'width'		=> config('map.width'),
			'height'	=> config('map.height'),
			'center'	=> $center,
			'markers'	=> $center,
			'output'	=> 'json',
		];
		$data = array_merge($data1, $data);
		$url = config('map.baidu_map_url') . config('map.staticimage') .'?' . http_build_query($data);
		//$res = json_decode(get_curl($url),true) ;
		$res = get_curl($url) ;
		return $res;
	}
}

 ?>