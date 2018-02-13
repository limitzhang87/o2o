<?php
namespace app\bis\controller;
use think\Controller;
class Login extends Controller
{
	public function index()
	{
		if(request()->isPost()){
			$data = input('post.');
			$account = model('bis_account')->get(['username'=>$data['username'],'status'=>1]);
			if(!$account){
				return $this->error('账户不存在，或者审核未通过');
			}
			if($account->password != md5($data['password'] . $account->code)){
				return $this->error('密码错误');
			}

			$account->last_login_ip = request()->ip();
			$account->last_login_time = time();
			$account->save();

			//记录登录信息，并保存到session
			session('account',$account,'bis');
			return $this->success('登录成功',url('index/index'));
		}else{
			$account = session('account', '', 'bis');
			if($account && $account->id){
				return $this->redirect(url('index/index'));
			}
			return $this->fetch();
		}
		
	}


	public function logout()
	{
		session(null, 'bis');
		return $this->redirect(url('login/index'));
	}
}