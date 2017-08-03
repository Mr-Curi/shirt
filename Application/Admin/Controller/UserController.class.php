<?php 
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller {
	private $user_id;
	private $username;
	private $permission = array();

	public function __construct(){
		parent::__construct();
		if(!empty($_SESSION['user_id'])){

			$condition['user_id'] = $_SESSION['user_id'];
			$condition['status'] =1;
			$user = M('user');
			$user_query = $user->where($condition)->find();
			    
			if(!empty($user_query) && is_array($user_query)){
				$this->user_id  = $user_query['user_id'];
				$this->username = $user_query['username'];
				$this->user_group_id = $user_query['user_group_id'];
				$update['ip']	 = I('server.REMOTE_ADDR');
				$where['user_id'] = $_SESSION['user_id'];
		        $user->where($where)->save($update);

				$user_group  = M('user_group');
				$condition = array();
				$user_group_conditon['user_group_id'] = $user_query['user_group_id'];
				$user_group_query  = $user_group->where($user_group_conditon)->find();
				$permissions = json_decode($user_group_query['permission'], true);
				$_SESSION['permissions'] = $permissions;
				if(is_array($permissions)){
					foreach ($permissions as $key => $value) {
						$this->permission[$key] = $value;
					}
				}
			}else {
				$this->logout();
			}
		}

	}

	public function login($username, $password){
		$user = M('user');
		$u_conditon['username'] =$username;
		$u_conditon['ip'] =I('server.REMOTE_ADDR');
		$user_login_info = $user->where($u_conditon)->find();
		if(!empty($user_login_info) && $user_login_info['logintime']+600<time()){
			$user->where(array('username'=>$username))->save(array('login_amount'=>0,'logintime'=>time()));
		}

		
		$condition = array();
		$condition['username'] = $username;
		$condition['status'] = 1;
		$condition['password'] = md5($password);
		$user_query = $user->where($condition)->find();
		    	
		if(!empty($user_query) && is_array($user_query)){
			$_SESSION['user_id'] = $user_query['user_id'];
			$_SESSION['username'] = $user_query['username'];
			$_SESSION['user_group_id'] = $user_query['user_group_id'];
			$user->where(array('user_id'=>$user_query['user_id']))->save(array('logintime'=>time(),'login_amount'=>0));
			$ug_conditon['user_group_id'] = $user_query['user_group_id'];
			$user_group_query = M('user_group')->FIELD('permission')->where($ug_conditon)->find();
			$permissions = json_decode($user_group_query['permission'], true);
			if (is_array($permissions)) {
				foreach ($permissions as $key => $value) {
					$this->permission[$key] = $value;
				}
			}
			return true;
		}else{
			$u_data['ip'] = (string)I('server.REMOTE_ADDR');
			$u_data['logintime'] = time();
			$u_data['login_amount'] = array('exp','login_amount+1');

			$user->where(array('username'=>$username))->save($u_data);
			if($user_login_info['login_amount']>=3 && ($user_login_info['logintime']+600>time()) ){
				$this->error('操作频繁，请稍后再试');
			}
			return false;
		}
	}

	public function getLoginAttempts($username){
		$amount = M('user')->FIELD('login_amount')->where(array('username'=>$username))->find();
		return (int)$amount[0];
	}

	public function logout() {
		unset($_SESSION['user_id']);
		$this->user_id = '';
		$this->username = '';
	}

	public function hasPermission($key, $value) {
		if (isset($this->permission[$key])) {
			return in_array($value, $this->permission[$key]);
		} else {
			return false;
		}
	}

	public function isLogged() {
		return $_SESSION['user_id'];
	}

	public function getId() {
		return $_SESSION['user_id'];
	}

	public function getUserName() {
		return $_SESSION['username'];
	}

	public function getGroupId() {
		return $_SESSION['user_group_id'];
	}



}