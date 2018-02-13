<?php 
namespace app\index\controller;
use think\Controller;


/**
* 地图类控制器
*/
class Map extends Controller
{
	
	public function getMapImg($center)
	{
		$data = input('get.');
		$data = $data['data'];
		if(!is_array($data)){
			$data = [];
		}
		$res =  \Map::getStaticimage($center,$data);
		return $res;
	}
}


 ?>