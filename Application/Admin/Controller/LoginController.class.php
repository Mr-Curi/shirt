<?php 
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
	public function index(){
		$user = A('user');
		if($user->isLogged() && !empty(I('get.token'))&& I('get.token')==$_SESSION['token']){
			$this->redirect('Index');
		}
		if(IS_POST && $this->validate()){
			$_SESSION['token'] = token(32);

			if(!empty(I('post.redirect'))&& (strpos(I('post.redirect'),HTTP_SERVER)==0 || strpos(I('post.redirect'),HTTPS_SERVER)==0)){
				$this->redirect(I('post.redirect'),array('token'=>$_SESSION['token']));
			}else {
				$this->redirect('/Admin/Index/index',array('token'=>$_SESSION['token']));
			}
		}
		$data['title'] = '后台登录';
		$data['css'][]= '/Public/static/css/H-ui.login';	
		$data['action'] = U('index');
		$this->assign('data',$data);

		layout('Layout/common_layout');
    	$this->display();
	}

	public function validate(){
		$user = A('user');

		if(empty(I("post.username")) || empty(I('post.password')) || !$user->login(I('post.username'),html_entity_decode(I('post.password'), ENT_QUOTES, 'UTF-8'))){
			$this->error('用户名或者密码错误','/Admin/Login',5);
		}
		return true;
	}
}