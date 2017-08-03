<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {

	public function __construct(){
		parent::__construct();
		$islogin = is_login();

	}
    public function index(){
    	$menu = $this->_menu();
    	if(!empty($_SESSION['permissions']['access']) && is_array($_SESSION['permissions']['access'])){
    		foreach ($_SESSION['permissions']['access'] as $action) {
    			$action_info = explode('/', $action);
    			$data['menu'][$action_info[0]][$action_info[1]]['name'] = $menu[$action_info[0]]['child'][$action_info[1]];
    			$data['menu'][$action_info[0]][$action_info[1]]['url'] =U($action_info[1].'/index',array('token'=>$_SESSION['token']));
    			$data['menuname'][$action_info[0]] = $menu[$action_info[0]]['name'];
    		}
    		    	
    		$this->assign('data',$data);
    	}else{
    		$this->error('权限不足',U('Login'));
    	}
    	layout('Layout/common_layout');
    	$this->display();
    }

    public function _menu(){
    	$menu['member'] =array(
    		'name'=>'用户管理',
    		'child'=>array(
    			'Index'=>'用户列表',
    		),

		);

		$menu['store']  =array(
			'name'=>'店铺管理',
    		'child'=>array(
    			'Store'=>'店铺列表',
    		),
		);


		$menu['permission'] =array(
			'name'=>'权限管理',
    		'child'=>array(
    			'PermissionUser'=>'管理员列表',
    			'PermissionGroup'=>'角色列表',
    		),

		);


		return $menu;
    }
}