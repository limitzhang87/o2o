<?php
namespace app\admin\controller;
use think\Controller;
class Index extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function getMap()
    {
    	return \Map::getStaticimage('海口市长流镇长康路');
    }
    public function welcome()
    {
        // $res = \Email::send('yijiushigelaji@163.com','o2o测试','这是一封邮件测试2');
        // //$res =  \Email::send('470299041@qq.com','o2o测试','这是一封邮件测试2');
        // if($res){
        //     return 1;
        // }else{
        //     return 2;
        // }
    	return '欢迎来到O2O后台首页';
    }
}
