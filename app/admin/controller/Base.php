<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Base extends Controller
{

    /**
     * 修改状态
     * @param  integoer  $id     表ID
     * @param  integer $status 状态
     * @param  string  $model  默认模型，如果不填写，则使用当前控制器
     * @return [type]          [description]
     */
    public function status($id,$status = 0,$model = '')
    {

    	if($model == ''){
    		$model = request()->controller();
    	}
        if(model($model)->save(['status'=>$status],['id'=>$id])){
            return $this->success('修改状态成功');
        }else{
            return $this->error('修改状态失败');
        }
    }


    /**
     * 修改排序
     * @param  integoer  $id     表ID
     * @param  integer $listorder 状态
     * @param  string  $model  默认模型，如果不填写，则使用当前控制器
     * @return [type]          [description]
     */
    public function listorder($id,$listorder = 0,$model = '')
    {

        if($model == ''){
            $model = request()->controller();
        }
        if(model($model)->save(['listorder'=>$listorder],['id'=>$id])){
            return $this->success('修改状态成功');
        }else{
            return $this->error('修改状态失败');
        }
    }
}
