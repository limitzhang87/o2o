<?php

namespace app\bis\controller;

use think\Controller;
use think\Request;

class Location extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $list = model('bis_location')->where(['bis_id'=>$this->isLogin()->bis_id])->select();
        return $this->fetch('', [
            'list'  => $list
        ]);
    }

    /**
     * 添加分店页面
     *
     * @return \think\Response
     */
    public function add()
    {
        if(request()->isPost()){
            $data = input('post.');
            //验证商户门店信息
            $validate = validate('bis_location');
            if(!$validate->scene('add')->check($data)){
                return $this->error($validate->getError());
            }

            //获取分类路径
            $data['cat'] = '';
            if(!empty($data['se_category_id'])){
                $data['cat'] = implode('|', $data['se_category_id']);
            }
            //获取经纬度
            $map = \Map::getLngLat($data['address']);
            if($map['status'] != 0 || $map['result']['precise'] != 1){
                $this->error('地址无法匹配或者匹配不精确');
            }
            $map = $map['result']['location'];
            $dataBisL = [
                'bis_id'        => $this->isLogin()->bis_id,
                'name'          => $data['name'],
                'tel'           => $data['tel'],
                'logo'          => $data['logo'],
                'address'       => $data['address'],
                'contact'       => $data['contact'],
                'category_id'   => $data['category_id'],
                'category_path' =>  $data['category_id'] . ',' . $data['cat'],
                'city_id'       => $data['city_id'],
                'city_path'     => empty($data['se_city_id']) ? $data['city_id']: $data['city_id'] . ',' . $data['se_city_id'],
                'api_address'   => $data['address'],
                'open_time'     => $data['open_time'],
                'content'       => empty($data['content']) ? '' : $data['content'],
                'is_main'       => 1,//设置为总店
                'xpoint'        => $map['lng'] ? $map['lng'] : '',
                'ypoint'        => $map['lat'] ? $map['lat'] : '',
            ];

            $Lid = model('bis_location')->add($dataBisL);
            if(!$Lid){
                return $this->error('添加分店错误');
            }else{
                return $this->success('添加分店成功');
            }
            return ;
        }
        $citys = model('city')->getNormalFistCity();
        $categorys = model('category')->getFirstCategory();
        return $this->fetch('',[
            'citys'      => $citys,
            'categorys' => $categorys
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
