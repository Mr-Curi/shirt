<?php
namespace Admin\Controller;
use Think\Controller;
class PermissionUserController extends Controller {
	public function __construct(){
		parent::__construct();
		$islogin = is_login();

	}

	public function index(){
		$user = A('User');
		if(!$user->hasPermission('access','permission/PermissionUserController')) $this->error('权限不足',U('SellerManager',array('token'=>$_SESSION['token'])));
	 	$data['url'] = U('getList',array('token'=>$_SESSION['token']));
		$data['statu_url'] = U('changeStatu',array('token'=>$_SESSION['token']));
		$data['del_url'] =U('del',array('token'=>$_SESSION['token']));
		$data['add_url'] =U('add',array('token'=>$_SESSION['token']));
		$this->assign('data',$data);
		layout('Layout/common_layout');
    	$this->display('permissionUserList');
	}

	public function getList(){
		$aoData = $_POST['aoData']; //接收请求的参数，是json格式的数据。它对应第三步中的ajax中的data。
		$aoData = json_decode($aoData);//
		$iDisplayLength = 0; // 每页显示的数量
	    $iDisplayStart = 0; // 从哪一个开始显示
	    $iSortCol_0 = 'user_id';// order by 哪一列
	    $sSortDir_0 = "asc";
	    $sSearch = ''; // 搜索的内容，可结合MySQL中的like关键字实现搜索功能
	         
	        	
	    foreach($aoData as $item) { // 这里就是获取对于的数据了
	        if ($item -> name  == "iDisplayLength") {

	            $iDisplayLength = $item -> value;
	        }
	        
	        if ($item -> name  == "iDisplayStart") {
	            $iDisplayStart = $item -> value;
	        }
	        
	        if ($item -> name  == "iSortCol_0") {
	            $iSortCol_0 = $item -> value;
	        }
	        
	        if ($item -> name  == "sSortDir_0") {
	            $sSortDir_0 = $item -> value;
	        }
	        
	        if ($item -> name  == "sSearch") {
	            $sSearch = $item -> value;
	        }
	        if($item -> name == 'sEcho'){
	        	$sEcho = $item -> value;
	        }
	    }

	    if($iSortCol_0=='5'){
	    	$iSortCol_0 ='date_added';
	    }else{
	    	$iSortCol_0 ='user_id';
	    }
	    $order = $iSortCol_0.'  '.$sSortDir_0;

		$user = M('user');
		if(!empty($sSearch)){
			$condition['username'] =array('like',$sSearch);
			$count = $user->where($condition)->count();
		}else{
			$count = $user->count();
		}
		$return['aaData']= array();
		$results = $user->where($condition)->cache(false)->order($order)->limit($iDisplayStart.",".$iDisplayLength)->select();
		foreach ($results as $result) {
			if($result['user_id']==1) continue;
			$statu_action ='<a style="text-decoration:none" onClick="admin_start(this,'.$result['user_id'].')" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe631;</i></a>';
			if($result['status']){
				$statu_action ='<a style="text-decoration:none" onClick="admin_stop(this,'.$result['user_id'].')" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe615;</i></a>';
			}
			$return['aaData'][] = array(
				'check'      =>'<td><input type="checkbox" value="'.$result[user_id].'" name="selected[]"></td>',
				'user_id'    => '<td>'.$result['user_id'].'</td>',
				'username'   => '<td>'.$result['username'].'</td>',
				'status'     => '<td class="td-status">'.($result['status'] ?'启用':'禁用').'</td>',
				'date_added' => '<td>'.date('Y-m-d',strtotime($result['date_added'])).'</td>',
				'edit'       => '<td class="td-manage">'.$statu_action.'<a title="编辑" href="javascript:;" onclick="admin_edit(\'编辑信息\',\''.U("edit",array("token"=>$_SESSION['token'],"user_id"=>$result["user_id"])).'\')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>'.'</td>',
			);
		}
     	$return['iTotalRecords'] =$count;
		$return['iTotalDisplayRecords']=$count;
		echo json_encode($return);
	}


	public function add(){
		$return['statu'] = true;
		$return['msg']='添加成功';
		if(IS_POST){
			if($this->validateForm()){
				$insert['user_group_id'] = I('post.user_group_id');
				$insert['username'] = I('post.username');
				$insert['password'] = md5(I('post.password'));
				$insert['lastname'] = I('post.lastname');
				$insert['firstname'] = I('post.firstname');
				$insert['email'] = I('post.email');
				$insert['status'] =I('post.status');
				$insert['date_added'] = date('Y-m-d H:i:s',time());
				$result = M('user')->add($insert);
			}else{
				$return['statu'] =false;
				$return['msg'] = $this->error[0];
			}
			exit(json_encode($return));
		}
		$this->getForm();
	}

	public function validateForm(){
		$user = A('User');
		if(!$user->hasPermission('modify','permission/PermissionUserController')){
			$error[] = '没有操作权限';
		}
		$user_info = M('user')->where(array('username'=>I('post.username')))->find();

		if(empty(I('get.user_id'))){
			if ($user_info) {
				$error[]= '销售人员已经存在';
			}
		}else{
			if($user_info && (!I('get.user_id')==$user_info['user_id'])){
				$error[]='参数有误';
			}
		}

		$this->error = $error;
		return !$this->error;
	}

	public function getForm(){
		if(empty(I('get.user_id'))){
			$data['action'] = U('add',array('token'=>$_SESSION['token']));
		}else{
			$user_info = M('user')->where(array('user_id'=>(int)I('get.user_id')))->find();
			$data['action'] = U('edit',array('token'=>$_SESSION['token'],'user_id'=>I('get.user_id')));
			$data['username'] = $user_info['username'];
			$data['firstname'] = $user_info['firstname'];
			$data['lastname'] = $user_info['lastname'];
			$data['email'] = $user_info['email'];
			$data['user_group_id'] = $user_info['user_group_id'];
		}


		$data['user_groups'] = M('user_group')->select();

		if(!empty(I('post.status'))){
			$data['status'] =I('post.status');
		}elseif(!empty($user_info)){
			$data['status'] = $user_info['status'];
		}else{
			$data['status'] =0;
		}


		if (!empty(I('post.password'))) {
			$data['password'] = I('post.password');
		} else {
			$data['password'] = '';
		}

		if (!empty(I('post.confirm'))) {
			$data['confirm'] = I('post.confirm');
		} else {
			$data['confirm'] = '';
		}



		$this->assign('data',$data);
		layout('Layout/common_layout');
    	$this->display('permissionUserForm');

		
	}

	public function edit(){
		$return['statu'] = true;
		$return['msg']='修改成功';
		if(I('get.user_id')==1){
			$return['statu'] =false;
			$return['msg'] = '权限不足';
		}
		if(IS_POST){
			if($this->validateForm()){
				$where['user_id'] = I('get.user_id');
				$update['user_group_id'] = I('post.user_group_id');
				$update['username'] = I('post.username');
				$update['password'] = md5(I('post.password'));
				$update['lastname'] = I('post.lastname');
				$update['firstname'] = I('post.firstname');
				$update['email'] = I('post.email');
				$update['status'] =I('post.status');
				    	
				$result = M('user')->where($where)->save($update);
			}else{
				$return['statu'] =false;
				$return['msg'] = $this->error[0];
			}
			exit(json_encode($return));
		}
		$this->getForm();
	}

	public function changeStatu(){
		if(empty(I('post.id')) || I('post.id') ==1) return;

		$return['statu'] = true;
		$return['msg'] ='更改成功';

		$result = M('user')->where(array('user_id'=>(int)I('post.id')))->save(array('status'=>I('post.status')));
		if(!$result){
			$return['statu'] = false;
			$return['msg'] ='更改失败';
		}
		echo json_encode($return);


	}


	public function del(){
		$user  = A('User');
        if (!$user->hasPermission('modify', 'permission/PermissionUserController')) {
			$error= '权限不足';
		}
    	if(!empty(I('post.selected')) && !$error){
    		foreach (I('post.selected') as $user_id) {
	   			M('user')->where(array('user_id'=>$user_id))->delete();
    		}
    	}
    	if($error){
    		exit(json_encode(array('statu'=>false,'msg'=>$error)));
    	}else{
    		exit(json_encode(array('statu'=>true)));
    	}
    }

}