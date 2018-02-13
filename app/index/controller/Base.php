<?php
namespace app\index\controller;
use think\Controller;
class Base extends Controller
{

    protected $user = '';
    public function _initialize()
    {
        //获取城市数据
        $citys = model('city')->getSeCity();
        $this->assign('citys',$citys);
        $defaultCity = $this->getDefalut($citys);
        $this->assign('defaultCity',$defaultCity);

        //获取用户数据
        $this->assign('user', $this->isLogin());

        //获取所有分类
        $this->assign('cates', $this->getCommondCate());

        $this->assign('_title', 'o2o团购网');
        $this->assign('_controller',strtolower(request()->controller()));
    }


    /**
     * 获取默认城市
     * @param  Object $citys 城市列表
     * @return Object        默认城市数据对象
     */
    protected function getDefalut($citys)
    {
        
        if(session('defaultCity','','o2o') && !input('get.cityuname')){
            //如果存在session并且没有重新定义
            $defaultCity = session('defaultCity','', 'o2o');
        }else{
            $cityuname = input('get.cityuname','','trim');
            //从所有数据中找到默认城市
            if($cityuname == ''){
                $cityuname = '';
                foreach ($citys as $city) {
                    if($city->is_default == 1){
                        $cityuname = $city->uname;
                        break;
                    }
                }
                $cityuname = $cityuname ? $cityuname : 'nanchang';
            }
            
            $defaultCity = model('city')->where(['uname'=>$cityuname])->find();
            session('defaultCity',$defaultCity,'o2o');
        }
        return $defaultCity;
    }


    /**
     * 获取分类
     */
    public function getCommondCate()
    {
        //获取一级分类
        $firstCats = model('category')->getCommonFirstCategory();
        $firstIds = $sedArr = $cates = [];
        foreach ($firstCats as $cate) {
            $firstIds[] = $cate->id;
        }

        //获取二级分类
        $sedCats = model('category')->getCommonCategoryByParendID($firstIds);
        foreach ($sedCats as $cate) {
            $sedArr[$cate->parent_id][] = [
                'id'    => $cate->id,
                'name'  => $cate->name,
            ];
        }
        foreach ($firstCats as $cate) {
            $cates[] = [
                'id'    => $cate->id,
                'name'  => $cate->name,
                'se'    => empty($sedArr[$cate->id]) ? [] : $sedArr[$cate->id],
            ];
        }
        return $cates;
    }

    //判断是否登录，返回用户对象或者false
    public function isLogin()
    {
        if(!$this->user){
            $this->user = session('o2o_user','','o2o');
        }
        
        if(@$this->user->id){
            return $this->user ;
        }else{
            return false;
        }
    }
}
