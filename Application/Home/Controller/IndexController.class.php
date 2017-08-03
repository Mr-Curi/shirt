<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	layout('Layout/common_layout');
    	$this->display();
    }
}