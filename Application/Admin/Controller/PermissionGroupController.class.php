<?php
namespace Admin\Controller;
use Think\Controller;
class PermissionGroupController extends Controller {

	public function __construct(){
		parent::__construct();
		$islogin = is_login();

	}
    public function index(){
    	$user_group = M('user_group');
    	$results = $user_group->select();

		foreach ($results as $result) {
			$data['user_groups'][] = array(
				'user_group_id' => $result['user_group_id'],
				'name'          => $result['name'],
				'edit'          => U('add',array('user_group_id'=>$result['user_group_id'],'token'=>$_SESSION['token'])),
				'del'           =>U('del',array('user_group_id'=>$result['user_group_id'],'token'=>$_SESSION['token'])),
			);
		}
    	
    	
    	$data['title']='角色管理';
    	$this->assign('data',$data);
    	$data['action']['del'] = U('del',array('token'=>$_SESSION['token']));
    	$this->assign('data',$data);
    	layout('Layout/common_layout');
    	$this->display('permisonGroupList');
    }

    public function add(){
    	if(IS_POST){
	    	if($this->validateForm()){
	    		$return['statu'] = true;
	    		$return['msg']='添加成功';
	    		$data['name'] = I('post.name');
	    		$data['permission'] = json_encode(I('post.permission'));
	    		if(I('get.user_group_id')>0){
	    			$result = M('user_group')->where(array('user_group_id'=>I('get.user_group_id')))->save($data);
	    		}else{
	    			$result = M('user_group')->add($data);
	    		}
	    		

	    		if(!$result){
	    			$return['statu'] = false;
	    			$return['msg']='添加失败';
	    		}	    	     
	    	}else{
	    		$return['statu'] = false;
	    		$return['msg'] = $this->err[0];
	    	}
	    	exit(json_encode($return));
    	}

    	$this->getForm();
    }

    protected function validateForm(){
    	$user  =A('User');
    	if(!$user->hasPermission('modify','permission/PermisionGroupController')){
    		$err[] = '权限不足';
    	}

    	if(strlen(I('post.name'))<3 ||strlen(I('post.name'))>64 ){
    		$err[] = '角色名称建议在3-64字符';
    	}
    	$this->err = $err;
    	return !$this->err;

    }

    public function getForm(){
    	$user_group = M('user_group');
    	if (!empty(I('get.user_group_id'))) {
			$data['action'] = U('add',array('token'=>$_SESSION['token']));
		} else {
			$data['action'] = U('edit',array('token'=>$_SESSION['token'],'user_group_id'=>I('get.user_group_id')));
		}
		    

		if(I('get.user_group_id')){
			$user_group_info =  $user_group->where(array('user_group_id'=>(int)I('get.user_group_id')))->find();
			$data['name'] = $user_group_info['name'];
		}else{
			$user_group_info = $user_group->where(array('user_group_id'=>$_SESSION['user_group_id']))->find();
		}
		    	
		    	    
		$user_group_info['permission'] = json_decode($user_group_info['permission'],true);
		    	    	
		$ignore = array(
			'dashboard',
			'startup',
			'LoginController',
			'logout',
			'forgotten',
			'reset',			
			'footer',
			'header',
			'not_found',
			'permission'
		);
		$data['permissions'] = array();
		$files = array();

		// Make path into an array
		$path = array(__DIR__.'/*');

		while (count($path) != 0) {
			$next = array_shift($path);

			foreach (glob($next) as $file) {
				// If directory add to path array
				if (is_dir($file)) {
					$path[] = $file . '/*';
				}

				// Add the file to the files to be deleted array
				if (is_file($file)) {
					$files[] = $file;
				}
			}
		}

		// Sort the file array
		sort($files);

		foreach ($files as $file) {
			$controller = substr($file,strrpos($file, '/')+1);
			$permission = substr($controller, 0, strrpos($controller, '.class'));
			if (!in_array($permission, $ignore)) {
				$data['permissions'][] = $permission;
			}

		}
		  
		      
		if(!empty(I('post.permission.access'))){
			$data['access'] = I('post.permission.access');
		}elseif(isset($user_group_info['permission'])){
			$data['access'] = $user_group_info['permission']['access'];
		}else{
			$data['access'] = array();
		}

		if (!empty(I('post.permission.modify'))) {
			$data['modify'] = I('post.permission.modify');
		} elseif (isset($user_group_info['permission'])) {
			$data['modify'] = $user_group_info['permission']['modify'];
		} else {
			$data['modify'] = array();
		}

		if (empty(I('get.user_group_id'))) {
			$data['action'] = U('add',array('token'=>$_SESSION['token']));
		} else {
			$data['action'] = U('add',array('token'=>$_SESSION['token'],'user_group_id'=>I('get.user_group_id')));
		}
		    	
		layout('Layout/common_layout');
		$data['jss'][]='/Public/lib/jquery.validation/1.14.0/jquery.validate';
		$data['jss'][] ='/Public/lib/jquery.validation/1.14.0/validate-methods';
		$data['jss'][] ='/Public/lib/jquery.validation/1.14.0/messages_zh';
		$data['menu'] = $this->_menu();

		$this->assign('data',$data);
		$this->display('groupForm');

    }

    private function _menu(){
    	return array(
    		'IndexController'=>'用户列表',
    		'PermisionGroupController'=>'人员列表',
    		'PermissionController'=>'店铺列表',
    		'UserController'=>'销售人员列表',
    		'UserGroupController'=>'销售人员群组列表'
    	);
    }

    public function del(){
    	if(!empty(I('post.selected')) && $this->_validateDelete()){
    		foreach (I('post.selected') as $group_id) {
    			M('user_group')->delete($group_id);
    		}
    	}
    	exit(json_encode(array('statu'=>true)));
    }

    private function _validateDelete(){
    	$user  = A('User');
        if (!$user->hasPermission('modify', 'permission/PermisionGroupController')) {
			$error[] = '权限不足';
		}
		$user_model  = M('user');
		foreach (I('post.selected') as $user_group_id) {
			$user_total = $user_model->where(array('user_group_id'=>$user_group_id))->count();

			if ($user_total) {
				$error[] = '该角色绑定销售人员，不能删除';
			}
		}
		$this->error = $error;
		return !$this->error;
    }
}