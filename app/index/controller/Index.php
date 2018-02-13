<?php
namespace app\index\controller;
use think\Controller;
class Index extends Base
{
    public function index()
    {
    	//获取首页广告图
    	$featured0 = model('featured')->getCommondByType(0);
    	$featured1 = model('featured')->getCommondByTypeOne(1);

        //获取没事栏目下面的团购商品以及美食分类
        $city = session('defaultCity','','o2o');
        $meishiData = model('deal')->getDealByCategoryCity(1,$city->id);
        $meishiCate = model('category')->getCommonFirstCategory(1,4);

        return $this->fetch('', [
            'featured0'  => $featured0,
            'featured1'  => $featured1,
            'empty'      => '<span style="color:red;font-size:24px;">该城市没有该分类商品</span>',
            'meishiData' => $meishiData,
            'meishiCate' => $meishiCate
        ]);


    }
}
