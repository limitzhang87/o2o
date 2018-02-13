<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\model\Category as CategoryModel;

class Category extends Controller
{

    protected $model;
    public function _initialize()
    {
        $this->model = new CategoryModel();
    }
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $parent_id = input('get.parent_id',0,'intval');
        //$categorys = $this->model->getFirstCategory($parent_id);
        $categorys = model('category')->getFirstCategory($parent_id);
        return $this->fetch('',[
            'categorys'     => $categorys
        ]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function add()
    {
        $categorys = $this->model->getNormalFirstCategory();
        return $this->fetch('',[
            'categorys'=>$categorys,
        ]);
    }

    public function edit($id)
    {
        if(!intval($id)){
            $this->error('找不到相应数据!');
        }

        $category = $this->model->get($id);
        $categorys = $this->model->getNormalFirstCategory();
        return $this->fetch('',[
            'category'  => $category,
            'categorys' => $categorys
        ]);
    }

    /**
     *  保存数据.
     *
     * @return \think\Response
     */
    public function save()
    {
        if(!request()->isPost()){
            return $this->error('非法请求!');
        }
        $data = input('post.');
        $validate = validate('Category');
        if(!$validate->scene('add')->check($data)){
            $this->error($validate->getError() );
        }
        if(isset($data['id'])){
            $res = $this->model->save($data, ['id' => intval($data['id'])]);
            if( $res ){
                $this->success('更新分类成功!');
            }else{
                $this->error('更新分类失败!');
            }
        }else{
            $res = $this->model->add($data);
            if( $res ){
                $this->success('添加分类成功!');
            }else{
                $this->error('添加分类失败!');
            }
        }
        
    }

    public function listorder($id, $listorder)
    {
        if(!request()->isPost()){
           return $this->error('更新排序失败!');;
        }
        $res = $this->model->save([
            'listorder'=>$listorder
        ],['id'=>$id]);
        if($res){
            return $this->success('更新排序成功!');
        }else{
            return $this->error('更新排序失败!');
        }
    }


    public function status($id, $status)
    {
        $data['id'] = $id;
        $data['status'] = $status;
        $validate = validate('Category');
        if(!$validate->scene('status')->check($data)){
            $this->error($validate->getError());
        }

        if($this->model->save([
            'status' => $status
        ],['id'=>$id])){
            return $this->success('修改状态成功!');
        }else{
            return $this->error('修改状态失败');
        }
    }
}
