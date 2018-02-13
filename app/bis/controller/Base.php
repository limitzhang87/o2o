<?php 
namespace app\bis\controller;
use think\Controller;
/**
* 基础控制器
*/
class Base extends Controller
{

	public $account = '';
	public function _initialize()
	{
		//判断用户登录
		if(!$this->isLogin()){
			return $this->error('尚未登陆','login/index');
		}
	}


	//判断是否登录，返回用户对象或者false
	public function isLogin()
	{
		if(!$this->account){
			$this->account = session('account','','bis');
		}
		
		if(@$this->account->id){
			return $this->account ;
		}else{
			return false;
		}
	}

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


 ?>