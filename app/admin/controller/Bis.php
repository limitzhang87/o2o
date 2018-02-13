<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Bis extends Controller
{
    protected $model;
    public function _initialize()
    {
        $this->model = model('bis');
    }


    public function index()
    {
        $list = $this->model->getListByStatus(1);
        return $this->fetch('',[
            'list'  => $list
        ]);
    }
    /**
     * 申请列表
     * @return [type] [description]
     */
    public function apply()
    {
        $list = $this->model->getListByStatus();
        return $this->fetch('',[
            'list'  => $list
        ]);
    }

    public function detail($id='')
    {
        if($id == ''){
            return $this->error('找不到相应数据');
        }
        $citys        = model('city')->getNormalFistCity();
        $categorys    = model('category')->getFirstCategory();
        $bisData      = model('bis')->get($id);
        $locationData = model('bisLocation')->get(['bis_id'=>$id,'is_main'=>1]);
        $accountData  = model('bisAccount')->get(['bis_id'=>$id,'is_main'=>1]);
        return $this->fetch('',[
            'citys'        => $citys,
            'categorys'    => $categorys,
            'bisData'      => $bisData,
            'locationData' => $locationData,
            'accountData'  => $accountData
        ]);
    }


    public function status($id, $status)
    {
        $data['id'] = $id;
        $data['status'] = $status;
        $validate = validate('Bis');
        if(!$validate->scene('status')->check($data)){
            return $this->error($validate->getError());
        }
        $bis = $this->model->save([
            'status' => $status
        ],['id'=>$id]);
        $this->model = model('bis')->get($id);
        $location = model('bisLocation')->save(['status'=>$data['status']], ['bis_id'=>$data['id'],'is_main'=>1]);
        $account = model('bisAccount')->save(['status'=>$data['status']], ['bis_id'=>$data['id'],'is_main'=>1]);
        if($bis && $location && $account){
            //根据状态发送右键通知
            switch ($status) {
                case '1':
                    $url = request()->domain() . url('bis/Login/index');
                    $title = 'o2o入驻申请通知';
                    $contnt = '您提交的入驻申请已经通过审核，您可以通过点击链接<a href="'.$url.'" targrt="_blank">登录</a>跳转到登录界面';
                    break;
                case '-1':
                    $title = 'o2o入驻申请通知';
                    $contnt = '您提交的入驻申请因为完全不符合，已经删除';
                    break;
                case '2':
                    $title = 'o2o入驻申请通知';
                    $contnt = '您提交的入驻申请不合格，未能通过审核';
                    break;
                default:
                    $title = false;
                    break;
            }
            if($title){
                \Email::send($this->model->email,$title,$contnt);
            }
            return $this->success('修改状态成功!');
        }else{
            return $this->error('修改状态失败');
        }
    }
}
