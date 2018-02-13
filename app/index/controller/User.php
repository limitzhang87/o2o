<?php
namespace app\index\controller;
use think\Controller;
class User extends Controller
{
    public function login()
    {
        $user = session('o2o_user', '', 'o2o');
        if($user && $user->id){
            return $this->redirect('index/index');
        }
        return $this->fetch();
    }


    public function logincheck()
    {
        if(!request()->isPost()){
            $this->error('非法访问');
        }

        $data = input('post.');

        //校验数据
        $validate = validate('user');
        if(!$validate->scene('login')->check($data)){
            $this->error($validate->getError());
        }

        try{
            $user = model('user')->get(['username'=>$data['username'] ]);
        }catch(\Exception $e){
            $this->error($e->getMessage());
        }

        //判断登录
        if(!md5($data['password'] . $user->code) == $user->password){
            $this->error('密码错误');
        }

        //更新最新登录时间和登录
        $update = [
            'last_login_ip'     => request()->ip(),
            'last_login_time'   => time(),
        ];
        $user->updateById($update, $user->id);

        //记录登录信息
        session('o2o_user',$user, 'o2o');

        $this->success('登录成功',url('index/index'));
    }

    public function logout()
    {
        session(null, 'o2o');

        $this->redirect('user/login');
    }


    /**
     * 注册界面
     * @return [type] [description]
     */
    public function register()
    {
    	if(request()->isPost()){
    		$data = input('post.');
    		if(!captcha_check($data['verifycode'])){
    			return $this->error('验证码错误');
    		}

            if($data['password'] != $data['repassword']){
                return $this->error('两次密码不相同');
            }
            $data['code'] = mt_rand(100,10000);
    		if(model('user')->add($data)){
                return $this->success('注册成功', url('user/login'));
            }else{
                return $this->error('注册失败');
            }
    		return ;
    	}
        return $this->fetch();
    }

}
