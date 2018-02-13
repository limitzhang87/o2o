<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;

class Deal extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data = input('get.');
        $where = [];
        if(!empty($data['category_id'])){
            $where['category_id'] = $data['category_id'];
        }else{
            $data['category_id'] = '';
        }

        if(!empty($data['city_id'])){
            $where['city_id'] = $data['city_id'];
        }else{
            $data['city_id'] = '';
        }


        if(!empty($data['start_time']) && !empty($data['end_time']) && strtotime($data['start_time'])  < strtotime($data['end_time'])){
            $where['create_time']   = [
                ['egt', strtotime($data['start_time'])],
                ['lt', strtotime($data['end_time'])]
            ];
        }else{
            $data['start_time'] = '';
            $data['end_time'] = '';
        }

        if(!empty($data['name'])){
            $where['name'] = ['like','%'.$data['name'].'%'];
        }else{
            $data['name'] = '';
        }
        $categorys = model('category')->getFirstCategory();
        $categorysArr = [];
        if($categorys){
            foreach ($categorys as $value) {
                $categorysArr[$value->id] = $value->name;
            }
        }
        $citys = model('city')->getSeCity();
        $citysArr = [];
        if($citys){
            foreach ($citys as $value) {
                $citysArr[$value->id] = $value->name;
            }
        }
        $deals = model('deal')->getNormalDeal($where);
        return $this->fetch('', [
            'deals'     => $deals,
            'categorys' => $categorys,
            'citys'     => $citys,
            'categorysArr' => $categorysArr,
            'citysArr'  => $citysArr,
            'data'      => $data
        ]);
    }

    public function apply()
        {
        $data = input('get.');
        $where = [];
        if(!empty($data['category_id'])){
            $where['category_id'] = $data['category_id'];
        }else{
            $data['category_id'] = '';
        }

        if(!empty($data['city_id'])){
            $where['city_id'] = $data['city_id'];
        }else{
            $data['city_id'] = '';
        }


        if(!empty($data['start_time']) && !empty($data['end_time']) && strtotime($data['start_time'])  < strtotime($data['end_time'])){
            $where['create_time']   = [
                ['egt', strtotime($data['start_time'])],
                ['lt', strtotime($data['end_time'])]
            ];
        }else{
            $data['start_time'] = '';
            $data['end_time'] = '';
        }

        if(!empty($data['name'])){
            $where['name'] = ['like','%'.$data['name'].'%'];
        }else{
            $data['name'] = '';
        }
        $categorys = model('category')->getFirstCategory();
        $categorysArr = [];
        if($categorys){
            foreach ($categorys as $value) {
                $categorysArr[$value->id] = $value->name;
            }
        }
        $citys = model('city')->getSeCity();
        $citysArr = [];
        if($citys){
            foreach ($citys as $value) {
                $citysArr[$value->id] = $value->name;
            }
        }
        $deals = model('deal')->getNormalDeal($where,0);
        return $this->fetch('', [
            'deals'     => $deals,
            'categorys' => $categorys,
            'citys'     => $citys,
            'categorysArr' => $categorysArr,
            'citysArr'  => $citysArr,
            'data'      => $data
        ]);
    }


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
