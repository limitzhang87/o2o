<?php

namespace app\common\model;

use think\Model;

class City extends Model
{

    // public function getNormalFistCity()
    // {
    // 	$where = [
    // 		'parent_id'	=> 0,
    // 		'status'	=> 1
    // 	];

    // 	$res = $this->where($where)->select();
    // 	return $res;
    // }

    public function getNormalFistCity($id = 0)
    {

    	$where = [
    		'parent_id'	=> $id,
    		'status'	=> 1
    	];

    	$res = $this->where($where)->select();
    	return $res;
    }

    public function getSeCity()
    {
        $where = [
            'parent_id' => ['gt', 0],
            'status'    => 1
        ];

        $res = $this->where($where)->select();
        return $res;
    }
}
