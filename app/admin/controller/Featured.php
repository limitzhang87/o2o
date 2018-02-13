<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Featured extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $type = input('get.type', 0 ,'intval');
        $featureds = model('featured')->getFeaturedByStatus($type);
        return $this->fetch('',[
            'types'     => config('featured.featured_type'),
            'featureds' => $featureds,
            'type'      => $type,
        ]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function add()
    {
        if(request()->isPost()){
            $data = input('post.');
            if(model('featured')->add($data)){
                $this->success('添加推荐位成功');
            }else{
                $this->error('添加推荐位失败');
            }
        }else{
            return $this->fetch('',[
                'types' => config('featured.featured_type'),
            ]);
        }
    }

    // public function status($id,$status)
    // {
    //     if(model('featured')->save(['status'=>$status],['id'=>$id])){
    //         return $this->success('修改状态成功');
    //     }else{
    //         return $this->error('修改状态失败');
    //     }
    // }
    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
