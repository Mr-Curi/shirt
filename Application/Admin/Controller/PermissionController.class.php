<?php 
namespace Admin\Controller;
use Think\Controller;
class PermissionController extends Controller {
	public function index(){
		$ignore = array(
			'common/dashboard',
				'common/login',
				'common/logout',
				'common/forgotten',
				'common/reset',
				'error/not_found',
				'error/permission'
			);
		$user = A('User');
		if(!in_array(ACTION_NAME, $ignore) && !$user->hasPermission('access',ACTION_NAME)){
			$this->error('没有操作权限');
		}
	}


}